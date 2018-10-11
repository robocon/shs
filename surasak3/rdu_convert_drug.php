<?php 
// just for testing
set_time_limit(0);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$db = mysql_connect('192.168.1.13', 'dottow', '') or die( mysql_error() );
mysql_select_db('smdb', $db) or die( mysql_error() );

// mysql_query('SET NAMES TIS620', $db);

$date_start = '2561-07-01';
$date_end = '2561-09-31';
$quarter = 4;

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_drug_'.$quarter.'.sql';

unlink($filePath);

$sql = "SELECT `row_id`,`date`,`hn`,`drugcode`,TRIM(`part`) AS `part`,`amount`,CONCAT(SUBSTRING(`date`,1,10),`hn`) AS `date_hn` 
FROM `drugrx` 
WHERE `date` >= '$date_start 00:00:00' AND `date` <= '$date_end 23:59:59' 
AND `an` IS NULL 
AND `reject` != 'Y' 
AND `amount` > 0 ";
$q = mysql_query($sql, $db) or die( mysql_error() );

$sql_header = "INSERT INTO `drugrx` ( `id`,`row_id`,`date`,`hn`,`drugcode`,`part`,`amount`,`date_hn`,`date_generate`,`quarter`) VALUES ";
$sql_data = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $row_id = $item['row_id'];
    $date = $item['date'];
    $hn = $item['hn'];
    $drugcode = $item['drugcode'];
    $part = $item['part'];
    $amount = $item['amount'];
    $date_hn = $item['date_hn'];

    $sql_data = $sql_header."( NULL,'$row_id','$date','$hn','$drugcode','$part','$amount','$date_hn',NOW(),'$quarter');\n";
    file_put_contents($filePath, $sql_data, FILE_APPEND);

}

mysql_close($db);

echo "Success";