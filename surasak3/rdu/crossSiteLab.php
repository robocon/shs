<?php 
set_time_limit(0);
require '../includes/rduCrossSite.php';

// นับปีตามปีงบ
// $year = get_year_checkup();
// $quarter = get_quarter();
$year = '2564';
$quarter = '1';

$time = strtotime("-1 month");
// $setMonth = (date('Y')+543).date('-m', $time);
// $setMonthEn = date('Y-m', $time);

$setMonth = '2563-10';
$setMonthEn = '2020-10';

// $date_start = $setMonth.'-01';
// $date_end = $setMonth.date('-t', $time);

$date_start = $setMonth.'-01';
$date_end = $setMonth.'-31';

// $date_start_lab = $setMonthEn.'-01';
// $date_end_lab = $setMonthEn.date('-t', $time);

$date_start_lab = $setMonthEn.'-01';
$date_end_lab = $setMonthEn.'-31';

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
WHERE c.`labname` LIKE 'Creatinine%' 
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