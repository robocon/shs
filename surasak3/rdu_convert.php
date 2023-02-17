<?php 
require_once 'config.php';
error_reporting(E_ALL);
set_time_limit(0);

/**
 * READ ME PLEASE อ่านตรงนี้หน่อย
 * 
 * ไตรมาสแบ่งออกเป็นดังนี้
 * 1 ตค ธค
 * 2 มค มีค
 * 3 เมย มิย
 * 4 กค กย
 * 
 * ไฟล์มี 4ไฟล์ คือ rdu_convert + _diag, _drug, _lab 
 * ให้รันใน localhost ได้เลย
 * พอได้ 4ไฟล์ที่เป็น .sql ค่อย import เข้าไปที่เซิฟ 192.168.1.13 -> rdu
 */

$dbi = new mysqli(HOST,USER,PASS,DB);
if($dbi->connect_errno){
    echo "Connection Error: ".$dbi->connect_errno;
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

// $dirPath = realpath(dirname(__FILE__))."/rdu";
// if(!file_exists($dirPath)){
//     mkdir($dirPath);
// }

$sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`ptname`,a.`age`,a.`diag`,a.`icd10`,a.`doctor`,SUBSTRING(TRIM(a.`toborow`),1,4) AS `toborow`, 
CONCAT(SUBSTRING(a.`thidate`,1,10),a.`hn`) AS `date_hn` 
FROM `opday` AS a 
WHERE a.`thidate` >= '$date_start 00:00:00' AND a.`thidate` <= '$date_end 23:59:59' 
AND a.`an` IS NULL 
AND ( a.`icd10` <> '' AND a.`icd10` IS NOT NULL ) 
AND a.`doctor` <> '' ";
$q = $dbi->query($sql);
if($q == false){
    dump($dbi->error);
    exit;
}

$sql_header = "INSERT INTO `rdu_opday` ( `id`,`row_id`,`date`,`hn`,`ptname`,`gender`,`age`,`diag`,`icd10`,`doctor`,`toborow`,`date_hn`,`date_generate`,`quarter`,`year`,`date_en`) VALUES ";

while ( $item = $q->fetch_assoc() ) {
    $row_id = $item['row_id'];
    $thidate = $item['thidate'];
    $hn = $item['hn'];
    $ptname = $item['ptname'];
    $age = $item['age'];
    $diag = htmlspecialchars($item['diag'], ENT_QUOTES);
    $icd10 = $item['icd10'];
    $doctor = $item['doctor'];
    $toborow = $item['toborow'];
    $date_hn = $item['date_hn'];
    $date_en = (substr($item['thidate'],0,4)-543).substr($item['thidate'],4,6);

    $match = preg_match('/(นาง|หญิง|น.ส|ด.ญ|ms|mis)/', $ptname, $matchs);
    $gender = 'm';
    if( $match > 0 ){
        $gender = 'f';
    }

    $sql_insert = $sql_header."( NULL,'$row_id','$thidate','$hn','$ptname','$gender','$age','$diag','$icd10','$doctor','$toborow','$date_hn',NOW(),'$quarter','$yearEn','$date_en');";
    $insert = $dbi->query($sql_insert);

}
echo "Success";