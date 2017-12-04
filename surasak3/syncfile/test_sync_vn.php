<?php

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM< 0 ) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}

    return $pAge;
}

function to_tis620($txt){
    $txt = iconv('UTF-8', 'TIS-620', $txt);
    return $txt;
}

$drcom = mysql_connect('192.168.1.4','surasak','1234') or die( mysql_error() );
mysql_select_db('sync', $drcom ) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $drcom);

// $shs = mysql_connect('192.168.1.13','root','1234') or die( mysql_error() );
// mysql_select_db('smdb2560', $shs) or die( mysql_error() );
$shs = mysql_connect('localhost','root','1234') or die( mysql_error() );
mysql_select_db('smdb', $shs) or die( mysql_error() );

// !!!! ระวังตอนเอาขึ้นเซิฟเวอร์ !!!! บางทีมันจะไม่อ่าน
mysql_query("SET NAMES TIS620", $shs);
$date_create = date('Y-m-d');

$th_date = ( date('Y') + 543 ).date('-m-d');

$sql = "SELECT * 
FROM `sync_vn` 
WHERE `DATE_CREATE` LIKE  '$date_create%' 
AND `STATUS` IS NULL 
AND `VN` != '' 
GROUP BY `HN`,`VN`
ORDER BY `DATE_CREATE` ASC ";
$q = mysql_query($sql, $drcom) or die( mysql_error() );
$user_row = mysql_num_rows($q);

if( $user_row > 0 ){

    while ( $item = mysql_fetch_assoc($q) ) {
        
        $cHn = $item['HN'];
        $nVn = $item['VN'];

        // ถ้าฝั่งรพ.ยังไม่มีข้อมูลให้เพิ่มเข้าไปได้เลย
        $sql = "SELECT `hn`,`vn` FROM `opday` 
        WHERE `thidate` LIKE '$th_date%' 
        AND `hn` = '$cHn' 
        AND `vn` = '$nVn' ";
        $opday_query = mysql_query($sql, $shs) or die( mysql_error() );
        $opday_row = mysql_num_rows($opday_query);
        if( $opday_row === 0 ){

            $opcard_sql = "SELECT `dbirth`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`,`idcard`,`ptright`,`goup`,`camp`,`note`  
            FROM `opcard` WHERE `hn` = '$cHn' ";
            $opcard_query = mysql_query($opcard_sql, $shs) or die( mysql_error() );
            $opcard = mysql_fetch_assoc($opcard_query);

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
            $result = mysql_query($query, $shs) or die( mysql_error() );

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
            $result = mysql_query($query, $shs) or die( mysql_error() );

            // ดึงเลขนัมเบอร์
            $sql = "SELECT title,prefix,runno FROM runno WHERE title = 'depart'";
            $query = mysql_query($sql, $shs) or die( mysql_error() );
            $runno = mysql_fetch_assoc($query);
            $nRunno = $runno['runno'] + 1;

            $query = "INSERT INTO depart(chktranx,date,ptname,hn,an,
            depart,item,detail,price,sumyprice,
            sumnprice,paid, idname,accno,tvn,ptright
            )VALUES(
            '$nRunno','$thidate','$cPtname','$cHn','','OTHER',
            '1','(55020/55021 ค่าบริการผู้ป่วยนอก)', '50','50','0',
            '','$sOfficer','0','$nVn','$cPtright');";
            $result = mysql_query($query, $shs) or die( mysql_error() );
            $idno = mysql_insert_id($shs);

            // อัพเดทเลขนัมเบอร์
            $query ="UPDATE runno SET runno = '$nRunno' WHERE title='depart'";
            $result = mysql_query($query, $shs) or die( mysql_error() );

            $query = "INSERT INTO patdata(date,hn,an,ptname,item,
            code,detail,amount,price,yprice,
            nprice,depart,part,idno,ptright
            ) VALUES(
            '$thidate','$cHn','','$cPtname','1',
            'SERVICE','(55020/55021 ค่าบริการผู้ป่วยนอก)','1','50','50',
            '0','OTHER','OTHER','$idno','$cPtright');";
            $result = mysql_query($query, $shs) or die( mysql_error() );

            $query ="UPDATE opday SET other=(other+50) WHERE thdatehn= '$thdatehn' AND vn = '$nVn' ";
            $result = mysql_query($query, $shs) or die( mysql_error() );

            $update_sql = "UPDATE `sync_vn`
            SET
            `DATE_UPDATE` = NOW(),
            `USR_UPDATE` = 'surasak', 
            `STATUS` = '1'
            WHERE `ROW_ID` = '$id';";
            $update = mysql_query($update_sql, $drcom) or die( mysql_error() );
            dump($update_sql);
            dump($update);

        }

    }

}