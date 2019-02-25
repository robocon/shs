<?php 

set_time_limit(0);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$db = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $db) or die( mysql_error() );

// mysql_query('SET NAMES TIS620', $db);
// äµÃÁÒÊ
// µ¤ ¸¤
// Á¤ ÁÕ¤
// àÁÂ ÁÔÂ
// ¡¤ ¡Â
$date_start = '2561-10-01';
$date_end = '2561-12-31';
$quarter = 1;
$year = '2562';

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_diag_'.$quarter.'.sql';

unlink($filePath);

$sql = "SELECT *, 
CONCAT(SUBSTRING(`regisdate`,1,10),`hn`) AS `date_hn`
FROM `diag`
WHERE ( `regisdate` >= '$date_start 00:00:00' AND `regisdate` <= '$date_end 23:59:59' ) 
AND ( 
    ( `diag`LIKE '%dog%' AND `diag` LIKE '%bit%' ) 
    OR 
    ( `diag`LIKE '%cat%' AND `diag` LIKE '%bit%' ) 
    OR 
    ( `diag`LIKE '%mammals%' AND `diag` LIKE '%bit%' ) 
) 
GROUP BY `icd10` ";
$q = mysql_query($sql, $db) or die( mysql_error() );

$sql_header = "INSERT INTO `diag` ( `id`, `diag_id`, `regisdate`, `hn`, `an`, `diag`, `icd10`, `type`, `doctor`, `date_hn`, `date_generate`, `quarter` , `year`) VALUES ";
$sql_data_list = '';

$test_i = 0;

while ( $item = mysql_fetch_assoc($q) ) {

    $diag_id = $item['row_id'];
    $regisdate = $item['regisdate'];
    $hn = $item['hn'];
    $an = $item['an'];
    $diag = $item['diag'];
    $icd10 = $item['icd10'];
    $type = $item['type'];
    $doctor = $item['office'];
    $date_hn = $item['date_hn'];

    $sql_data_list = $sql_header."( NULL, '$diag_id', '$regisdate', '$hn', '$an', '$diag', '$icd10', '$type', '$doctor', '$date_hn', NOW(), '$quarter', '$year');\n";
    
    file_put_contents($filePath, $sql_data_list, FILE_APPEND);

    $test_i++;
}

mysql_close($db);

echo "Success";