<?php 
include 'bootstrap.php';

$db = Mysql::load();

$db->select("SELECT SUBSTRING(`yearchk`,3,2) AS `yearchk` FROM `chk_company_list` WHERE `code` = 'สวนดุสิต63_2'");
$company = $db->get_item();
$year = $company['yearchk'];

$sql = "SELECT * 
FROM `chk_lab_items` 
WHERE `part` = 'สวนดุสิต63_2' 
AND ( `labnumber` >= '630205118' AND `labnumber` <= '630205147' ) ";
$db->select($sql);
$items = $db->get_items();

foreach ($items as $key => $item) { 

    $id = $item['id'];

    $hn = $item['hn'];
    $ptname = $item['ptname'];
    $labnumber = $item['labnumber'];
    $dob = $item['dob'];
    $sex = $item['sex'];
    $clinicalinfo = "ตรวจสุขภาพประจำปี$year";

    ////////////////////////
    // ORDER HEAD
    ////////////////////////
    $orderhead_sql = "INSERT INTO `orderhead` ( 
        `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
        `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
        `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
    ) VALUES ( 
        NULL, NOW(), '$labnumber', '$hn', 'OPD', 
        '$ptname', '$sex', '$dob', '', '', 
        '','', 'MD022 (ไม่ทราบแพทย์)', 'R', '$clinicalinfo'
    );";
    $insert = $db->insert($orderhead_sql);
    if( $insert !== true ){
        $msg = errorMsg(NULL, $insert['id']);
    }
    dump($orderhead_sql);
    dump($msg);

    // ถ้าในรายการปกติไม่มีให้ไปหาใน labsuit
    $sql_at = "SELECT `code` FROM `labsuit` WHERE `suitcode` LIKE '@stool'";
    $db->select($sql_at);
    $suit_list = $db->get_items();

    if( count($suit_list) > 0 ){

        foreach ($suit_list as $key => $suit_item) {
            
            $suit_code = $suit_item['code'];
            $sql_detail = "SELECT `code`,`oldcode`,`detail` 
            FROM `labcare` 
            WHERE `code` = '$suit_code' 
            LIMIT 1 ";
            $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
            $test_row = mysql_num_rows($q);
            if ( $test_row > 0 ) {
                
                list($code, $oldcode, $detail) = mysql_fetch_row($q);   
            
                $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                    `labnumber` , `labcode`, `labcode1` , `labname` 
                ) VALUES ( 
                    '$labnumber', '$code', '$oldcode', '$detail'
                );";
                $insert_detail = $db->insert($orderdetail_sql);

                if( $insert_detail !== true ){
                    $msg .= errorMsg(NULL, $insert_detail['id']);
                }

                dump($msg);

            }
            
        } // foreach

    } // count($suit_list)

    echo "<hr>";

}





?>