<?php 

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


function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

include 'includes/connect_sv13.php';
// $db = mysql_connect("192.168.1.13","remoteuser","");
// if (!$db) {
//     die('Not connected : ' . mysql_error());
// }

// $db_selected = mysql_select_db('rdu_test', $db);
// if (!$db_selected) {
//     die ('Can\'t use foo : ' . mysql_error());
// }

// mysql_query('SET NAMES TIS620', $db);

$date_start = '2564-01-01';
$date_end = '2564-03-31';
$quarter = 2;
$year = '2564';

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_diag_'.$quarter.'.sql';

unlink($filePath);

// file_put_contents($filePath, "DELETE FROM `diag` WHERE `quarter` = '$quarter' AND `year` = '$year';\n", FILE_APPEND);


$sql = "SELECT a.*,b.`ptname`,b.`doctor`, b.`pre_age` 
FROM ( 

	SELECT `row_id`,`hn`,`an` AS `vn`,`diag`,`icd10`,`type`,`svdate`, 
	CONCAT(SUBSTRING(`svdate`,1,10),`hn`) AS `date_hn`, 
	CONCAT(SUBSTRING(`svdate`,9,2),'-',SUBSTRING(`svdate`,6,2),'-',SUBSTRING(`svdate`,1,4),`hn`) AS `date_opday`
	FROM `diag` 
	WHERE ( `svdate` >= '$date_start 00:00:00' AND `svdate` <= '$date_end 23:59:59' ) 
	AND `icd10` <> '' 
	AND `status` = 'Y' 

) AS a 
LEFT JOIN ( 

	SELECT `thdatehn`,`ptname`,`doctor`,`hn`,SUBSTRING(toEn(`thidate`), 1, 10) AS `pre_age` 
	FROM `opday` 
	WHERE `thidate` >= '$date_start 00:00:00' AND `thidate` <= '$date_end 23:59:59' 
	AND `doctor` <> '' 

) AS b ON b.`thdatehn` = a.`date_opday` 
WHERE b.`ptname` IS NOT NULL ";
$q = mysql_query($sql, $db) or die( mysql_error() );

$sql_header = "INSERT INTO `diag` ( `id`, `diag_id`, `svdate`, `hn`, `ptname`,`age`,`an`, `diag`, `icd10`, `type`, `doctor`, `date_hn`, `date_generate`, `quarter` , `year`) VALUES ";
$sql_data_list = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $preAge = $item['pre_age'];
    $hn = $item['hn'];
    
    $sql = "SELECT `dbirth`,`hn`,TIMESTAMPDIFF(YEAR, SUBSTRING(toEn(`dbirth`), 1, 10), '$preAge') AS `age` 
    FROM `opcard` 
    WHERE `hn` = '$hn' ";
    $qOP = mysql_query($sql, $db) or die( mysql_error() );
    $opc = mysql_fetch_assoc($qOP);

    $diag_id = $item['row_id'];
    $svdate = $item['svdate'];
    $ptname = $item['ptname'];
    $age = $opc['age'];
    $vn = $item['vn'];
    $diag = htmlspecialchars($item['diag'], ENT_QUOTES);
    $diag = trim(preg_replace('/\s+/',' ',$diag));
    $icd10 = $item['icd10'];
    $type = $item['type'];
    // $doctor = $item['office'];
    $doctor = $item['doctor'];
    $date_hn = $item['date_hn'];

    $sql_data_list = $sql_header."( NULL, '$diag_id', '$svdate', '$hn', '$ptname','$age','$vn', '$diag', '$icd10', '$type', '$doctor', '$date_hn', NOW(), '$quarter', '$year');\n";
    
    file_put_contents($filePath, $sql_data_list, FILE_APPEND);

}

mysql_close($db);

echo "Success";