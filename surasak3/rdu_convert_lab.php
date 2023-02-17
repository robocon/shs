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

$sql = "SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`sex`,c.`result`,
TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(b.`orderdate`, 1, 10)) AS `age`, 
eGFR(TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(b.`orderdate`, 1, 10)),b.`sex`,c.`result`) AS `egfr`, 
CONCAT(SUBSTRING(b.`orderdate`,1,10),b.`hn`) AS `date_hn`
FROM (  

	SELECT MAX(`autonumber`) as `latest_id`
	FROM `resulthead` 
	WHERE (`orderdate` >= '$date_start_en 00:00:00' AND `orderdate` <= '$date_end_en 23:59:59' ) 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
	GROUP BY `hn` 

) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
LEFT JOIN `opcard` AS d ON d.`hn` = b.`hn` 
WHERE c.`labcode` = 'CREA' 
AND c.`result` != '*' 
ORDER BY b.`autonumber` ASC ";
$q = $dbi->query($sql);

$sql_header = "INSERT INTO `rdu_lab` ( `id`,`autonumber`,`orderdate`,`hn`,`gender`,`age`,`egfr`,`date_hn`,`quarter`,`year`,`date_en`) VALUES ";
while ( $item = $q->fetch_assoc() ) {
    
    $autonumber = $item['autonumber'];
    $orderdate = $item['orderdate'];
    $hn = $item['hn'];
    $gender = strtolower($item['sex']);
    $age = $item['age'];
    $egfr = $item['egfr'];
    $date_hn = $item['date_hn'];
    $date_en = substr($item['orderdate'],0,10);

    if( $egfr != '' && $egfr > 0 ){
        $sql_rud_lab = $sql_header."( NULL,'$autonumber','$orderdate','$hn','$gender','$age','$egfr','$date_hn','$quarter','$yearEn','$date_en');";
        $insert = $dbi->query($sql_rud_lab);

    }

}

echo "Success";