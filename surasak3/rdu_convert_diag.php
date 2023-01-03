<?php 
require_once 'bootstrap.php';
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

$date_start = '2565-11-01';
$date_end = '2565-11-30';

$date_start_en = '2022-11-01';
$date_end_en = '2022-11-30';

$quarter = 1;
$year = '2566';

$dirPath = realpath(dirname(__FILE__))."/rdu";
if(!file_exists($dirPath)){
    mkdir($dirPath);
}

$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_diag_'.$quarter.'.sql';
if(file_exists($filePath))
{
    unlink($filePath);
}

// $sql = "SELECT SUBSTRING(`thidate`,1,10) AS `thiDateShort`,`thdatehn`,`ptname`,`doctor`,`hn`,`vn`,SUBSTRING(toEn(`thidate`), 1, 10) AS `pre_age` 
// FROM `opday` 
// WHERE `thidate` >= '$date_start 00:00:00' AND `thidate` <= '$date_end 23:59:59' 
// AND `doctor` <> '' ";
// $q = $dbi->query($sql);

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
$sql_data_list = array();

while ( $item = $q_diag->fetch_assoc() ) {
    // dump($item);
    // $preAge = $item['pre_age'];
    $hn = $item['hn'];

    // $sql_opcard = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname`, `dbirth`,`hn`,TIMESTAMPDIFF(YEAR, SUBSTRING(toEn(`dbirth`), 1, 10), NOW()) AS `age` 
    // FROM `opcard` 
    // WHERE `hn` = '$hn' ";
    // $qOP = $dbi->query($sql_opcard);
    // $opc = $qOP->fetch_assoc();
    $age = $item['age'];
    // $age = '';

    $ptname = $item['ptname'];
    // $ptname = '';
    $vn = $item['vn'];
    // $doctor = $item['doctor'];

    // list($y,$m,$d)=explode('-',$item['thiDateShort']);
    // $thidate_short = ($y-543)."-$m-$d";
    

    // while ($diag = $q_diag->fetch_assoc()) { 

        // dump($diag);
        $diag_id = $item['row_id'];
        $svdate = $item['svdate'];
        $pre_diag = htmlspecialchars($item['diag'], ENT_QUOTES);
        $diag_txt = trim(preg_replace('/\s+/',' ',$pre_diag));
        $icd10 = $item['icd10'];
        $type = $item['type'];
        $date_hn = $item['date_hn'];

        $doctor = $item['office'];

        $date_en = (substr($item['svdate'],0,4)-543).substr($item['svdate'],4,6);

        $sql_value = "( NULL, '$diag_id', '$svdate', '$hn', '$ptname','$age','$vn', '$diag_txt', '$icd10', '$type', '$doctor', '$date_hn', NOW(), '$quarter', '$year', '$date_en');\n";
        
        file_put_contents($filePath, $sql_header.$sql_value, FILE_APPEND);

    // }
    
}
// $sql_value = implode(',', $sql_data_list);
// $sql_header.$sql_value;


echo "Success";