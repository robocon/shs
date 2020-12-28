<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * ปี63 มันจะมีแบ่งสองวัน
 * สอบตำรวจ63 กับ สอบตำรวจ63_02
 */


$sql = "SELECT * FROM `log_opcardchk` WHERE `log_part` = 'สอบตำรวจ64_02' ORDER BY `log_id` ASC ";
$db->select($sql);
$items = $db->get_items();

$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "ค่าบริการตรวจสุขภาพตำรวจ";
$price = 880.00;
$paid  = 880.00;
$idname='นางนทีพร เรียงสุข';
$credit="ตรวจสุขภาพตำรวจ";

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    $logId = $value['log_id'];
    $billno = $value['bill'];
    
    $sqlOpacc = "INSERT INTO `opacc` ( 
        `date` , `txdate` , `hn` , `depart` , `detail` , 
        `price` , `paid` , `idname` , `credit` , `ptright` , 
        `credit_detail` , `billno`
    ) VALUES ( 
        '$Thidate2', '$Thidate2', '$hn', '$depart', '$detail', 
        '$price', '$paid', '$idname',  '$credit', 'R01 เงินสด', 
        '', '$billno'
    );";
    dump($sqlOpacc);

    $insert = $db->insert($sqlOpacc);
    $opaccId = $db->get_last_id();
    dump($insert);

    
    $logQL = "UPDATE `log_opcardchk` SET 
    `opacc_id` = '$opaccId' 
    WHERE `log_id` = '$logId' ";
    $db->update($logQL);

    echo "<hr>";
}

exit;