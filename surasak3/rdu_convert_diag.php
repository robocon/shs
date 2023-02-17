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

$date_start_en = $yearEn.date('-m', $pastDay).'-01';
$date_end_en = $yearEn.date('-m', $pastDay).'-'.$endOfMonth;

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

$sql_diag = "SELECT a.`row_id`,a.`hn`,a.`an` AS `vn`,a.`diag`,a.`icd10`,a.`type`,a.`svdate`, 
CONCAT(SUBSTRING(a.`svdate`,1,10),a.`hn`) AS `date_hn`, 
CONCAT(SUBSTRING(a.`svdate`,9,2),'-',SUBSTRING(a.`svdate`,6,2),'-',SUBSTRING(a.`svdate`,1,4),a.`hn`) AS `date_opday`, 
a.`office`, CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`,b.`dbirth`, 
TIMESTAMPDIFF(YEAR, toEn(b.`dbirth`), NOW()) AS `age` 
FROM `diag` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE ( a.`svdate_en` >= '$date_start_en' AND a.`svdate_en` <= '$date_end_en' ) 
AND a.`icd10` <> '' 
AND a.`status` = 'Y' 
GROUP BY `date_opday`, `icd10` ";
$q_diag = $dbi->query($sql_diag);

$sql_header = "INSERT INTO `rdu_diag` ( `id`, `diag_id`, `svdate`, `hn`, `ptname`,`age`,`an`, `diag`, `icd10`, `type`, `doctor`, `date_hn`, `date_generate`, `quarter` , `year`, `date_en`) VALUES ";

while ( $item = $q_diag->fetch_assoc() ) {

    $hn = $item['hn'];
    $age = $item['age'];
    $ptname = $item['ptname'];
    $vn = $item['vn'];

    $diag_id = $item['row_id'];
    $svdate = $item['svdate'];
    $pre_diag = htmlspecialchars($item['diag'], ENT_QUOTES);
    $diag_txt = trim(preg_replace('/\s+/',' ',$pre_diag));
    $icd10 = $item['icd10'];
    $type = $item['type'];
    $date_hn = $item['date_hn'];

    $doctor = $item['office'];

    $date_en = (substr($item['svdate'],0,4)-543).substr($item['svdate'],4,6);

    $sql_value = $sql_header."( NULL, '$diag_id', '$svdate', '$hn', '$ptname','$age','$vn', '$diag_txt', '$icd10', '$type', '$doctor', '$date_hn', NOW(), '$quarter', '$yearEn', '$date_en');";
    $insert = $dbi->query($sql_value);
    
}

echo "Success";