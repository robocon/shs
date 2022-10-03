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

$date_start = '2565-07-01';
$date_end = '2565-09-30';

$quarter = 4;
$year = '2565';

$dirPath = realpath(dirname(__FILE__))."/rdu";
if(!file_exists($filePath)){
    mkdir($dirPath);
}

$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_drug_'.$quarter.'.sql';
if(file_exists($filePath))
{
    unlink($filePath);
}

$sql = "SELECT `row_id`,`date`,`hn`,`drugcode`,TRIM(`part`) AS `part`,`amount`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' 
AND `an` IS NULL 
AND `reject` != 'Y' 
AND `amount` > 0 ";
$q = $dbi->query($sql);

$sql_header = "INSERT INTO `drugrx` ( `id`,`row_id`,`date`,`hn`,`drugcode`,`part`,`amount`,`date_hn`,`date_generate`,`quarter`,`year`) VALUES ";
$sql_data = array();

while ( $item = $q->fetch_assoc() ) {
    $row_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];
    $drugcode = $item['drugcode'];
    $part = $item['part'];
    $amount = $item['amount'];
    $date_hn = $item['date_hn'];

    $sql_data[] = "( NULL,'$row_id','$date','$hn','$drugcode','$part','$amount','$date_hn',NOW(),'$quarter','$year')";

}
$sql_value = implode(',', $sql_data);
$sql_header.$sql_value;
file_put_contents($filePath, $sql_header.$sql_value, FILE_APPEND);

echo "Success";