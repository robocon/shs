<?php 
// just for testing
set_time_limit(0);

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

include 'includes/connect_sv13.php';

// mysql_query('SET NAMES TIS620', $db);

// $date_start = '2562-04-01';
// $date_end = '2562-06-30';

$date_start = '2563-01-01';
$date_end = '2563-01-31';

$quarter = 2;
$year = '2563';

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_opday_'.$quarter.'.sql';

unlink($filePath);

$sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`ptname`,a.`age`,a.`diag`,a.`icd10`,a.`doctor`,SUBSTRING(TRIM(a.`toborow`),1,4) AS `toborow`, 
CONCAT(SUBSTRING(a.`thidate`,1,10),a.`hn`) AS `date_hn` 
FROM `opday` AS a 
WHERE a.`thidate` >= '$date_start 00:00:00' AND a.`thidate` <= '$date_end 23:59:59' 
AND a.`an` IS NULL 
AND ( a.`icd10` <> '' AND a.`icd10` IS NOT NULL ) 
AND a.`doctor` <> '' ";
$q = mysql_query($sql, $db) or die( mysql_error() );


$sql_header = "INSERT INTO `opday` ( `id`,`row_id`,`date`,`hn`,`ptname`,`gender`,`age`,`diag`,`icd10`,`doctor`,`toborow`,`date_hn`,`date_generate`,`quarter`,`year`) VALUES ";
$sql_data_list = '';

$test_i = 0;

while ( $item = mysql_fetch_assoc($q) ) {

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

    // $match = preg_match('/(¹Ò§|Ë­Ô§|¹.Ê|´.­|ms|mis)/', iconv('TIS620','UTF-8',$ptname), $matchs);
    $match = preg_match('/(¹Ò§|Ë­Ô§|¹.Ê|´.­|ms|mis)/', $ptname, $matchs);
    $gender = 'm';
    if( $match > 0 ){
        $gender = 'f';
    }

    $sql_data_list = $sql_header."( NULL,'$row_id','$thidate','$hn','$ptname','$gender','$age','$diag','$icd10','$doctor','$toborow','$date_hn',NOW(),'$quarter','$year');\n";
    
    
    file_put_contents($filePath, $sql_data_list, FILE_APPEND);

    // if ( $test_i > 100 ) {
    //     exit;
    // }

    $test_i++;
}

mysql_close($db);

echo "Success";