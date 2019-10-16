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

$date_start = '2019-07-01';
$date_end = '2019-09-30';
$quarter = 4;
$year = '2562';

$dirPath = realpath(dirname(__FILE__))."/rdu";
$filePath = $dirPath.'/'.$date_start.'_'.$date_end.'_lab_'.$quarter.'.sql';

unlink($filePath);

$sql = "SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`sex`,c.`result`,
TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(NOW(), 1, 10)) AS `age`, 
eGFR(TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(NOW(), 1, 10)),b.`sex`,c.`result`) AS `egfr`, 
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
WHERE c.`labname` = 'Creatinine' 
AND c.`result` != '*' 
ORDER BY b.`autonumber` ASC ";
$q = mysql_query($sql, $db) or die( mysql_error() );


$sql_header = "INSERT INTO `lab` ( `id`,`autonumber`,`orderdate`,`hn`,`gender`,`egfr`,`date_hn`,`quarter`,`year`) VALUES ";
$sql_data = '';

while ( $item = mysql_fetch_assoc($q) ) {

    $autonumber = $item['autonumber'];
    $orderdate = $item['orderdate'];
    $hn = $item['hn'];
    $gender = strtolower($item['sex']);
    $egfr = $item['egfr'];
    $date_hn = $item['date_hn'];

    if( $egfr != '' && $egfr > 0 ){
        $sql_data = $sql_header."( NULL,'$autonumber','$orderdate','$hn','$gender','$egfr','$date_hn','$quarter','$year');\n";
        file_put_contents($filePath, $sql_data, FILE_APPEND);
    }

}

mysql_close($db);

echo "Success";