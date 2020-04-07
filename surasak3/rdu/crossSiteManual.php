#!/usr/bin/php
<?php 
set_time_limit(0);
require '../includes/rduCrossSite.php';

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

function get_year_checkup(){
	$d = date('d');
	$m = date('m');
	$y = date('Y') + 543 ;

	if( $m >= 10 && $d >= 1 ){
		$y += 1;
	}

	return $y;
}

function get_quarter(){

    $m = date('n');

    if( $m >= 10 && $m <= 12 ){
        $quarter = 1;

    }elseif ( $m >= 1 && $m <= 3 ) {
        $quarter = 2;

    }elseif ( $m >= 4 && $m <= 6 ) {
        $quarter = 3;

    }elseif ( $m >= 7 && $m <= 9 ) {
        $quarter = 4;

    }

    return $quarter;
}

/**
 * ตั้งค่าใน Crontab ไว้ว่า ถ้าถึง 5ทุ่ม ในวันที่ 5ของแต่ละเดือน ให้ดึงข้อมูลเดือนก่อนหน้าจำนวน 1เดือนมาใส่ไว้ใน rduของเซิฟ .13
 * 
 * ไตรมาสแบ่งออกเป็นดังนี้
 * 1 ตค ธค
 * 2 มค มีค
 * 3 เมย มิย
 * 4 กค กย
 * 
 */

// นับปีตามปีงบ
// $year = get_year_checkup();
// $quarter = get_quarter();
$year = '2563';
$quarter = '2';

$time = strtotime("-1 month");
// $setMonth = (date('Y')+543).date('-m', $time);
// $setMonthEn = date('Y-m', $time);

$setMonth = '2563-03';
$setMonthEn = '2020-03';

// $date_start = $setMonth.'-01';
// $date_end = $setMonth.date('-t', $time);

$date_start = $setMonth.'-01';
$date_end = $setMonth.'-31';

// $date_start_lab = $setMonthEn.'-01';
// $date_end_lab = $setMonthEn.date('-t', $time);

$date_start_lab = $setMonthEn.'-01';
$date_end_lab = $setMonthEn.'-31';


// rdu_convert.php << ต้นฉบับอยู่นี่
$sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`ptname`,a.`age`,a.`diag`,a.`icd10`,a.`doctor`,SUBSTRING(TRIM(a.`toborow`),1,4) AS `toborow`, 
CONCAT(SUBSTRING(a.`thidate`,1,10),a.`hn`) AS `date_hn` 
FROM `opday` AS a 
WHERE a.`thidate` >= '$date_start 00:00:00' AND a.`thidate` <= '$date_end 23:59:59' 
AND a.`an` IS NULL 
AND ( a.`icd10` <> '' AND a.`icd10` IS NOT NULL ) 
AND a.`doctor` <> '' ";
$result = $shs->query($sql);

$rduHeader = "INSERT INTO `opday` ( `id`,`row_id`,`date`,`hn`,`ptname`,`gender`,`age`,`diag`,`icd10`,`doctor`,`toborow`,`date_hn`,`date_generate`,`quarter`,`year`) VALUES ";
while ( $item = $result->fetch_assoc() ) {

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

    $match = preg_match('/(นาง|หญิง|น.ส|ด.ญ|ms|mis)/', $ptname, $matchs);
    $gender = 'm';
    if( $match > 0 ){
        $gender = 'f';
    }

    $opday = $rduHeader."( NULL,'$row_id','$thidate','$hn','$ptname','$gender','$age','$diag','$icd10','$doctor','$toborow','$date_hn',NOW(),'$quarter','$year');";
    $rdu->query($opday);

}


// rdu_convert_diag.php
$sql = "SELECT a.*,b.`ptname`,b.`doctor` 
FROM ( 
	SELECT `row_id`,`hn`,`an` AS `vn`,`diag`,`icd10`,`type`,`svdate`, 
	CONCAT(SUBSTRING(`svdate`,1,10),`hn`) AS `date_hn`,
	CONCAT(SUBSTRING(`svdate`,9,2),'-',SUBSTRING(`svdate`,6,2),'-',SUBSTRING(`svdate`,1,4),`hn`) AS `date_opday`
	FROM `diag`
	WHERE ( `svdate` >= '$date_start 00:00:00' AND `svdate` <= '$date_end 23:59:59' ) 
) AS a 
LEFT JOIN `opday` AS b ON b.`thdatehn` = a.`date_opday` 
WHERE b.`doctor` <> '' ";
$resultDiag = $shs->query($sql);

$sql_header = "INSERT INTO `diag` ( `id`, `diag_id`, `svdate`, `hn`, `ptname`, `an`, `diag`, `icd10`, `type`, `doctor`, `date_hn`, `date_generate`, `quarter` , `year`) VALUES ";
while ( $item = $resultDiag->fetch_assoc() ) {

    $diag_id = $item['row_id'];
    $svdate = $item['svdate'];
    $hn = $item['hn'];
    $ptname = $item['ptname'];
    $vn = $item['vn'];
    $diag = htmlspecialchars($item['diag'], ENT_QUOTES);
    $diag = trim(preg_replace('/\s+/',' ',$diag));
    $icd10 = $item['icd10'];
    $type = $item['type'];
    $doctor = $item['doctor'];
    $date_hn = $item['date_hn'];

    $diagSql = $sql_header."( NULL, '$diag_id', '$svdate', '$hn', '$ptname', '$vn', '$diag', '$icd10', '$type', '$doctor', '$date_hn', NOW(), '$quarter', '$year');";
    $rdu->query($diagSql);

}


// rdu_convert_drug.php
$sql = "SELECT `row_id`,`date`,`hn`,`drugcode`,TRIM(`part`) AS `part`,`amount`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' 
AND `an` IS NULL 
AND `reject` != 'Y' 
AND `amount` > 0 ";
$resultDrugrx = $shs->query($sql);

$sql_header = "INSERT INTO `drugrx` ( `id`,`row_id`,`date`,`hn`,`drugcode`,`part`,`amount`,`date_hn`,`date_generate`,`quarter`,`year`) VALUES ";
while ( $item = $resultDrugrx->fetch_assoc() ) {

    $row_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];
    $drugcode = $item['drugcode'];
    $part = $item['part'];
    $amount = $item['amount'];
    $date_hn = $item['date_hn'];

    $drugrxSql = $sql_header."( NULL,'$row_id','$date','$hn','$drugcode','$part','$amount','$date_hn',NOW(),'$quarter','$year');";
    $rdu->query($drugrxSql);

}


// rdu_convert_lab.php 
// eGFR() เป็น function อยู่ใน Mysql
// อ่านต่อ : https://www.mysqltutorial.org/mysql-stored-procedure/mysql-show-function/
$sql = "SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`sex`,c.`result`,
TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(NOW(), 1, 10)) AS `age`, 
eGFR(TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(NOW(), 1, 10)),b.`sex`,c.`result`) AS `egfr`, 
CONCAT(SUBSTRING(b.`orderdate`,1,10),b.`hn`) AS `date_hn`
FROM ( 

	SELECT MAX(`autonumber`) as `latest_id`
	FROM `resulthead` 
	WHERE (`orderdate` >= '$date_start_lab 00:00:00' AND `orderdate` <= '$date_end_lab 23:59:59' ) 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
	GROUP BY `hn` 

) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
LEFT JOIN `opcard` AS d ON d.`hn` = b.`hn` 
WHERE c.`labname` = 'Creatinine' 
AND c.`result` != '*' 
ORDER BY b.`autonumber` ASC ";
$resultLab = $shs->query($sql);

$sql_header = "INSERT INTO `lab` ( `id`,`autonumber`,`orderdate`,`hn`,`gender`,`egfr`,`date_hn`,`quarter`,`year`) VALUES ";
while ( $item = $resultLab->fetch_assoc() ) {

    $autonumber = $item['autonumber'];
    $orderdate = $item['orderdate'];
    $hn = $item['hn'];
    $gender = strtolower($item['sex']);
    $egfr = $item['egfr'];
    $date_hn = $item['date_hn'];

    if( $egfr != '' && $egfr > 0 ){
        $LabSql = $sql_header."( NULL,'$autonumber','$orderdate','$hn','$gender','$egfr','$date_hn','$quarter','$year');";
        $rdu->query($LabSql);
    }

}


// rdu_convert_trauma.php
$sql = "SELECT *, 
CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn`
FROM `trauma`
WHERE ( `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' ) ";
$resultTrauma = $shs->query($sql);

$sql_header = "INSERT INTO `trauma` (`id`, `trauma_id`, `date`, `hn`, `ptright`, `dx`, `organ`, `maintenance`, `cure`, `doctor`, `trauma`, `type_wounded`, `type_wounded2`, `date_hn`, `quarter`, `year`) VALUES ";
while ( $item = $resultTrauma->fetch_assoc() ) {

    $trauma_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];

    $ptright = $item['list_ptright'];
    $dx = htmlspecialchars($item['dx'], ENT_QUOTES);
    $dx = trim(preg_replace('/\s+/',' ',$dx));

    $organ = htmlspecialchars($item['organ'], ENT_QUOTES);
    $organ = trim(preg_replace('/\s+/',' ',$organ));

    $maintenance = htmlspecialchars($item['maintenance'], ENT_QUOTES);
    $maintenance = trim(preg_replace('/\s+/',' ',$maintenance));

    $cure = $item['cure'];
    $doctor = $item['doctor'];
    $trauma = $item['trauma'];
    $type_wounded = $item['type_wounded'];
    $type_wounded2 = $item['type_wounded2'];
    $date_hn = $item['date_hn'];


    $traumaSql = $sql_header."(NULL, '$trauma_id', '$date', '$hn', '$ptright', '$dx', '$organ', '$maintenance', '$cure', '$doctor', '$trauma', '$type_wounded', '$type_wounded2', '$date_hn', '$quarter', '$year');\n";
    $rdu->query($traumaSql);

}
?>