<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * ปี63 มันจะมีแบ่งสองวัน
 * สอบตำรวจ63 กับ สอบตำรวจ63_02
 */


$sql = "SELECT * FROM `log_opcardchk` WHERE `log_part` = 'ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 67' ORDER BY `book`,`bill` ASC ";
// $sql = "SELECT * FROM `log_opcardchk` WHERE `log_id` = 1675";
$db->select($sql);
$items = $db->get_items();

// $Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "ค่าบริการตรวจสุขภาพตำรวจ";
$price = 880.00;
$paid  = 880.00;
$idname='นางสาว นทีพร เรียงสุข';
$credit="ตรวจสุขภาพตำรวจ";

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    $logId = $value['log_id'];
    $billno = $value['book'].'/'.$value['bill'];
    $moneyType = $value['type'];

    $Thidate2 = (date('Y')+543).substr($value['log_datechk'],4);

    // var_dump($Thidate2);
    // exit;

    // $Thidate2 = $value['log_datechk'];
    
    $sqlOpacc = "INSERT INTO `opacc` ( 
        `date` , `txdate` , `hn` , `depart` , `detail` , 
        `price` , `paid` , `idname` , `credit` , `ptright` , 
        `credit_detail` , `billno`
    ) VALUES ( 
        '$Thidate2', '$Thidate2', '$hn', '$depart', '$detail', 
        '$price', '$paid', '$idname',  '$credit', 'R01 เงินสด', 
        '$moneyType', '$billno'
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