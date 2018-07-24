<?php

include 'bootstrap.php';
$db = Mysql::load();

?>

<form action="chk_lotushourse_orderlab.php" method="post">
    <div>
        <h3>สั่งแลป บ.โลตัสฮอสฯ</h3>
    </div>
    <div>
        <button type="submit">พิมพ์</button>
        <input type="hidden" name="action" value="orderlab">
    </div>
</form>
<?php

$action = input_post('action');

if ( $action == 'orderlab' ) {
    
    $sql = "SELECT * FROM `opcardchk` WHERE `part` = 'โลตัสฮอส61' ";
    $db->select($sql);
    $users = $db->get_items($sql);

    foreach ($users as $key => $user) {

        $idcard = $user['idcard'];

        // หาวันเกิดจากเลขบัตรประชาชน
        $sql_opcard = "SELECT CONCAT( (SUBSTRING(`dbirth`,1,4) - 543) ,SUBSTRING(`dbirth`,5,6)) AS `birthday_en`
        FROM `opcard` WHERE `idcard` = '$idcard' ";
        $db->select($sql_opcard);
        $opcard = $db->get_item();


        $ptname = $user['name'].' '.$user['surname'];
        $hn = $user['HN'];
        $exam_no = $user['exam_no'];
        $nLab = "180724".$exam_no;

        $lab_lists = array('CBC','TRI','HDL','BUN','CR','AMP');

        // ตะกั่ว7คน
        if( $hn == '614035' 
        OR $hn == '614036' 
        OR $hn == '614088' 
        OR $hn == '614089' 
        OR $hn == '614090' 
        OR $hn == '614091' 
        OR $hn == '614092' ){ 

            $lab_lists[] = 'MG';

        }

        $orderdate = date('Y-m-d H:i:s');
        $patienttype = "OPD";
        $clinicalinfo = "ตรวจสุขภาพประจำปี61";
        $dbirth = $opcard['birthday_en'];
        $priority = "R";
        $cliniciancode = '';

        $chkgender = substr($user["name"],0,4);
        if($chkgender == "น.ส."){
            $gender = "F";
        }else{
            $chkgender = substr($user["name"],0,3);
            if($chkgender == "นาง"){
                $gender = "F";
            }else{
                $gender = "M";
            }
        }

        $orderhead_sql = "INSERT INTO `orderhead` ( 
            `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
            `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
            `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
        ) VALUES ( 
            NULL, '$orderdate', '$nLab', '$hn', '$patienttype', 
            '$ptname', '$gender', '$dbirth', '', '', 
            '','$cliniciancode', 'MD022 (ไม่ทราบแพทย์)', '$priority', '$clinicalinfo' 
        );";
        dump($orderhead_sql);
        $insert = $db->insert($orderhead_sql);
        dump($insert);


        foreach ($lab_lists as $lab_key => $lab_code) {
        
            // 
            $sql_detail = "SELECT `code`,`oldcode`,`detail` 
            FROM `labcare` 
            WHERE `code` = '$lab_code' 
            LIMIT 1 ";
            $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
            list($code, $oldcode, $detail) = mysql_fetch_row($q);   
            
            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                `labnumber` , `labcode`, `labcode1` , `labname` 
            ) VALUES ( 
                '$nLab', '$code', '$oldcode', '$detail'
            );";
            dump($orderdetail_sql);
            $insert_detail = $db->insert($orderdetail_sql);
            dump($insert_detail);
    
        }
    
        echo "<hr>";
        
    }

}

