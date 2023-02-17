<?php 
require_once 'config.php';
error_reporting(E_ALL);
set_time_limit(0);

$dbi = new mysqli(HOST,USER,PASS,DB);
if($dbi->connect_errno){
    echo $dbi->connect_errno;
    exit;
}
$dbi->query("SET NAMES UTF8");

$pastDay = strtotime("-1 month");
$yearEn = date('Y', $pastDay);
$yearTh = $yearEn +543;

$endOfMonth = date('t', strtotime($yearEn.'-'.date('-m', $pastDay).'-01'));

$date_start = $yearTh.date('-m', $pastDay).'-01';
$date_end = $yearTh.date('-m', $pastDay).'-'.$endOfMonth;

$pastMonth = date('n', $pastDay);
if($pastMonth>=10 && $pastMonth<=12){
    $quarter = 1;
}elseif ($pastMonth>=1 && $pastMonth<=3) {
    $quarter = 2;
}elseif ($pastMonth>=4 && $pastMonth<=6) {
    $quarter = 3;
}elseif ($pastMonth>=7 && $pastMonth<=9) {
    $quarter = 4;
}

$sql = "SELECT `row_id`,`date`,`hn`,`drugcode`,TRIM(`part`) AS `part`,`amount`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' 
AND `an` IS NULL 
AND `reject` != 'Y' 
AND `amount` > 0 ";
$q = $dbi->query($sql);

$sql_header = "INSERT INTO `rdu_drugrx` ( `id`,`row_id`,`date`,`hn`,`drugcode`,`part`,`amount`,`date_hn`,`date_generate`,`quarter`,`year`,`date_en`) VALUES ";

while ( $item = $q->fetch_assoc() ) {
    $row_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];
    $drugcode = $item['drugcode'];
    $part = $item['part'];
    $amount = $item['amount'];
    $date_hn = $item['date_hn'];

    $date_en = (substr($item['date'],0,4)-543).substr($item['date'],4,6);

    $rdu_drugrx = $sql_header."( NULL,'$row_id','$date','$hn','$drugcode','$part','$amount','$date_hn',NOW(),'$quarter','$yearEn','$date_en');";
    $insert = $dbi->query($rdu_drugrx);

}

echo "Success";