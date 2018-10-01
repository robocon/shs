<?php 
// just for testing

// include 'bootstrap.php';

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

$db = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $db) or die( mysql_error() );

$sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`ptname`,a.`age`,a.`diag`,a.`icd10`,a.`doctor`,
a.`sex`, 
CONCAT(SUBSTRING(a.`thidate`,1,10),a.`hn`) AS `date_hn` 
FROM `opday` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
WHERE a.`thidate` >= '2560-10-01 00:00:00' AND a.`thidate` <= '2560-12-31 23:59:59' 
AND a.`an` IS NULL 
AND ( a.`icd10` <> '' AND a.`icd10` IS NOT NULL ) ";
$q = mysql_query($sql, $db) or die( mysql_error() );

$opday_list = array();
while ( $item = mysql_fetch_assoc($q) ) {
    
    $opday_list[] = $item;

}

mysql_close($db);


$db_rdu = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('rdu', $db_rdu) or die( mysql_error() );

foreach ($opday_list as $key => $item) { 

    $row_id = $item['row_id'];
    $thidate = $item['thidate'];
    $hn = $item['hn'];
    $ptname = $item['ptname'];
    $age = $item['age'];
    $diag = $item['diag'];
    $icd10 = $item['icd10'];
    $doctor = $item['doctor'];

    $sql = "INSERT INTO `opday` ( 
        `id`,`row_id`,`date`,`hn`,`ptname`,
        `gender`,`age`,`diag`,`icd10`,`doctor`,
        `date_hn`,`date_generate`
    ) VALUES ( 
        NULL,'$row_id','$thidate','','',
        '','','','','',
        '',''
    )";


}