<?php 
require_once 'bootstrap.php';
error_reporting(E_ALL);
set_time_limit(0);

$dbi = new mysqli(HOST,USER,PASS,DB);
if($dbi->connect_errno){
    echo $dbi->connect_errno;
    exit;
}
$dbi->query("SET NAMES UTF8");

$date_start = '2022-12-01';
$date_end = '2022-12-30';

$quarter = 1;
$year = '2566';

$dirPath = realpath(dirname(__FILE__))."/rdu";
if(!file_exists($dirPath)){
    mkdir($dirPath);
}

$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_lab_'.$quarter.'.sql';
if(file_exists($filePath))
{
    unlink($filePath);
}

$sql = "SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`sex`,c.`result`,
TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(b.`orderdate`, 1, 10)) AS `age`, 
eGFR(TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(b.`orderdate`, 1, 10)),b.`sex`,c.`result`) AS `egfr`, 
CONCAT(SUBSTRING(b.`orderdate`,1,10),b.`hn`) AS `date_hn`
FROM (  

	SELECT MAX(`autonumber`) as `latest_id`
	FROM `resulthead` 
	WHERE (`orderdate` >= '$date_start 00:00:00' AND `orderdate` <= '$date_end 23:59:59' ) 
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
// $sql_data_list = array();

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
        $sql_insert = $sql_header."( NULL,'$autonumber','$orderdate','$hn','$gender','$age','$egfr','$date_hn','$quarter','$year','$date_en');\n";
        file_put_contents($filePath, $sql_insert, FILE_APPEND);
    }

}
// $sql_value = implode(',', $sql_data_list);
// $sql_header.$sql_value;
// file_put_contents($filePath, $sql_header.$sql_value, FILE_APPEND);

echo "Success";