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

// mysql_query('SET NAMES TIS620', $db);

$date_start = '2562-04-01';
$date_end = '2562-06-30';
$quarter = 3;
$year = '2562';

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_diag_'.$quarter.'.sql';

unlink($filePath);

$sql = "SELECT *, 
CONCAT(SUBSTRING(`svdate`,1,10),`hn`) AS `date_hn`
FROM `diag`
WHERE ( `svdate` >= '$date_start 00:00:00' AND `svdate` <= '$date_end 23:59:59' ) 
AND ( 
    ( `diag` NOT LIKE '%dog%' AND `diag` NOT LIKE '%bit%' ) 
    OR 
    ( `diag` NOT LIKE '%cat%' AND `diag` NOT LIKE '%bit%' ) 
    OR 
    ( `diag` NOT LIKE '%mammals%' AND `diag` NOT LIKE '%bit%' ) 
);";
$q = mysql_query($sql, $db) or die( mysql_error() );

$sql_header = "INSERT INTO `diag` ( `id`, `diag_id`, `svdate`, `hn`, `an`, `diag`, `icd10`, `type`, `doctor`, `date_hn`, `date_generate`, `quarter` , `year`) VALUES ";
$sql_data_list = '';

$test_i = 0;

while ( $item = mysql_fetch_assoc($q) ) {

    $diag_id = $item['row_id'];
    $svdate = $item['svdate'];
    $hn = $item['hn'];
    $an = $item['an'];
    $diag = htmlspecialchars($item['diag'], ENT_QUOTES);
    $diag = trim(preg_replace('/\s+/',' ',$diag));
    $icd10 = $item['icd10'];
    $type = $item['type'];
    $doctor = $item['office'];
    $date_hn = $item['date_hn'];

    $sql_data_list = $sql_header."( NULL, '$diag_id', '$svdate', '$hn', '$an', '$diag', '$icd10', '$type', '$doctor', '$date_hn', NOW(), '$quarter', '$year');\n";
    
    file_put_contents($filePath, $sql_data_list, FILE_APPEND);

    $test_i++;
}

mysql_close($db);

echo "Success";