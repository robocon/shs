#!/usr/local/bin/php
<?php

/*
On Server .13
#!/usr/local/bin/php

On Docker
#!/usr/bin/php
*/

define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
define('EXTENDED_ABLE', 1);

include ROOT_DIR.'config.php';
include ROOT_DIR.'base_fun.php';

/**
 * DEFAULT VARIABLE
 */
$date_create = date('Y-m-d');
$th_date = ( date('Y') + 543 ).date('-m-d');

$drcom = new DRDB();

$sql = "SELECT * 
FROM `sync_vn` 
WHERE `DATE_CREATE` LIKE  '$date_create%' 
AND `STATUS` IS NULL 
AND `VN` != '' 
GROUP BY `HN`,`VN`
ORDER BY `DATE_CREATE` ASC ";
$drcom->query($sql);
$drcom_users = $drcom->rows();

if( $drcom_users > 0 ){

    $items = $drcom->fetch();
    foreach( $items as $key => $item ){ 
        
        $cHn = $item['HN'];
        $nVn = $item['VN'];

        // ถ้าฝั่งรพ.ยังไม่มีข้อมูลให้เพิ่มเข้าไปได้เลย
        $shs = new SHSDB();
        $sql = "SELECT `hn`,`vn` FROM `opday` 
        WHERE `thidate` LIKE '$th_date%' 
        AND `hn` = '$cHn' 
        AND `vn` = '$nVn' ";
        $shs->query($sql);
        $shs_users = $shs->rows();
        if(  $shs_users === 0 ){

            $opcard_sql = "SELECT `dbirth`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`idcard`,`ptright`,`goup`,`camp`,`note`  
            FROM `opcard` WHERE `hn` = '$cHn' ";
            $shs->query($opcard_sql);
            $opcard = $shs->fetch_single();

            $id = $item['ROW_ID'];
            $thidate = (date("Y")+543).date("-m-d H:i:s"); 
            $pre_dmy = date('d-m-').(date('Y')+543);

            // $thdatehn = $item['THDATE_HN'];
            $thdatehn = $pre_dmy.$cHn;

            // $thdatevn = $item['THDATE_VN'];
            $thdatevn = $pre_dmy.$nVn;

            $cPtname = $opcard['ptname'];
            $cAge = calcage($opcard['dbirth']);
            $cPtright = $opcard['ptright'];
            $cGoup = $opcard['goup'];
            $cCamp = $opcard['camp'];
            $cNote = $opcard['note'];
            $toborow = to_tis620($item['TYPE_OPD']);
            $cIdcard = $opcard['idcard'];
            $sOfficer = $item['USR_CREATE'];

            $query = "INSERT INTO opday(thidate,thdatehn,hn,vn,thdatevn,
                ptname,age,ptright,goup,camp,
                note,toborow,idcard,officer
            )VALUES(
                '$thidate','$thdatehn','$cHn','$nVn','$thdatevn',
                '$cPtname','$cAge','$cPtright','$cGoup','$cCamp',
                '$cNote','$toborow',' $cIdcard','$sOfficer'
            );";
            $shs->query($query);

            $R03true1 = "NULL";
            if(substr($toborow,0,4) == "EX03"){  //สมัครโครงการเบิกจ่ายตรง
                $R03true1 = '1';	
            }

            $query = "INSERT INTO opday2(thidate,thdatehn,hn,vn,thdatevn,
                ptname,age,ptright,goup,camp,
                note,idcard,toborow,borow,dxgroup,
                officer,withdraw
            )VALUES(
                '$thidate','$thdatehn','$cHn','$nVn','$thdatevn',
                '$cPtname','$cAge','$cPtright','$cGoup','$cCamp',
                '$cNote','$cIdcard','$toborow','','21',
                '$sOfficer','$R03true1'
            );";
            $shs->query($query);

            // ดึงเลขนัมเบอร์
            $sql = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
            $shs->query($sql);
            $runno = $shs->fetch_single();
            $nRunno = $runno['runno'] + 1;

            $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,
            depart,item,detail,price,sumyprice,
            sumnprice,paid, idname,accno,tvn,ptright
            )VALUES(
            '$nRunno','$thidate','$cPtname','$cHn','','OTHER',
            '1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0',
            '','$sOfficer','0','$nVn','$cPtright');";
            $shs->query($query);
            $idno = $shs->get_last_id();

            // อัพเดทเลขนัมเบอร์
            $query ="UPDATE runno SET runno = '$nRunno' WHERE title='depart'";
            $shs->query($query);
            // $result = query($query, $shs);
            
            $query = "INSERT INTO patdata(date,hn,an,ptname,item,
            code,detail,amount,price,yprice,
            nprice,depart,part,idno,ptright
            ) VALUES(
            '$thidate','$cHn','','$cPtname','1',
            'SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50',
            '0','OTHER','OTHER','$idno','$cPtright');";
            $shs->query($query);

            $query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '$nVn' ";
            $shs->query($query);

            // set_system_log($update_sql);

        } else {
            // มีข้อมูลแล้ว อัพเดทข้อมูล
        }

        $update_sql = "UPDATE `sync_vn`
        SET
        `DATE_UPDATE` = NOW(),
        `USR_UPDATE` = 'surasak', 
        `STATUS` = '1'
        WHERE `ROW_ID` = '$id';";
        $drcom->query($update_sql);

    }

}