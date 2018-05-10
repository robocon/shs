<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT * FROM `opcardchk` WHERE `part` = 'ÊÇ¹´ØÊÔµ61' ORDER BY `exam_no` ASC ";

$db->select($sql);

$items = $db->get_items();


$orderdate = date("Y-m-d H:i:s");
$patienttype = "OPD";
$clinicalinfo = "µÃÇ¨ÊØ¢ÀÒ¾»ÃĞ¨Ó»Õ61";
$dbirth = "00-00-00 00:00:00";

foreach ($items as $key => $item) {
    
    $lab_list = array('UA','CBC','BS','BUN','CR','URIC','CHOL','TRI','HDL','LDL','SGOT','SGPT','ALK');
    if( $item['course'] == '2' ){
        $lab_list = array_merge_recursive($lab_list, array('10502','HBSAG','10446','ST','C-S'));
        
    }

    $hn = $item['HN'];
    $ptname = $item["name"]." ".$item["surname"];
    $nLab = '180510'.$item['exam_no'];

    $chkgender = substr($item["name"],0,4);
    if($chkgender == "¹.Ê."){
        $gender = "F";
    }else{
        $chkgender = substr($item["name"],0,3);
        if($chkgender == "¹Ò§"){
            $gender = "F";
        }else{
            $gender = "M";
        }
    }

    $priority = "R";
    $cliniciancode = '';

    $orderhead_sql = "INSERT INTO `orderhead` ( 
        `autonumber` , `orderdate` , `labnumber` , `hn` , `patienttype` , 
        `patientname` , `sex` , `dob` , `sourcecode` , `sourcename` , 
        `room` , `cliniciancode` , `clinicianname` , `priority` , `clinicalinfo`  
    ) VALUES ( 
        NULL, '$orderdate', '$nLab', '$hn', '$patienttype', 
        '$ptname', '$gender', '$dbirth', '', '', 
        '','$cliniciancode', 'MD022 (äÁè·ÃÒºá¾·Âì)', '$priority', '$clinicalinfo' 
    );";

    $insert = $db->insert($orderhead_sql);
    dump($insert);


    foreach ($lab_list as $lab_key => $lab_code) {
        
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

        $insert_detail = $db->insert($orderdetail_sql);
        dump($insert_detail);

    }

    echo "<hr>";

}