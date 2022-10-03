<?php 
// just for testing
set_time_limit(0);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

define('HOST', '192.168.131.240');
define('PORT', '3306');
define('DB', 'sm3db-utf8');
define('USER', 'sm3db_user');
define('PASS', 'sm3dbPassword');

$dbi = new mysqli(HOST,USER,PASS,DB);
if($dbi->connect_errno){
    echo $dbi->connect_errno;
    exit;
}
$dbi->query("SET NAMES UTF8");

$date_start = '2022-07-01';
$date_end = '2022-09-30';

$quarter = 4;
$year = '2565';

$dirPath = realpath(dirname(__FILE__))."/rdu";
if(!file_exists($filePath)){
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

$sql_header = "INSERT INTO `lab` ( `id`,`autonumber`,`orderdate`,`hn`,`gender`,`age`,`egfr`,`date_hn`,`quarter`,`year`) VALUES ";
$sql_data_list = array();

while ( $item = $q->fetch_assoc() ) {
    dump($item);
    $autonumber = $item['autonumber'];
    $orderdate = $item['orderdate'];
    $hn = $item['hn'];
    $gender = strtolower($item['sex']);
    $age = $item['age'];
    $egfr = $item['egfr'];
    $date_hn = $item['date_hn'];

    if( $egfr != '' && $egfr > 0 ){
        $sql_data_list[] = "( NULL,'$autonumber','$orderdate','$hn','$gender','$age','$egfr','$date_hn','$quarter','$year')";
    }

}
$sql_value = implode(',', $sql_data_list);
$sql_header.$sql_value;
file_put_contents($filePath, $sql_header.$sql_value, FILE_APPEND);

echo "Success";