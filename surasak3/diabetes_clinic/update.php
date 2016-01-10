<?php define('NEW_SITE', true);
include '../bootstrap.php';

$sql = "
CREATE TEMPORARY TABLE `diabetes_mini`
( `dateN` DATE NOT NULL, `orderdate` DATETIME NOT NULL )
SELECT a.`dm_no`,a.`hn`,b.`profilecode`,b.`autonumber`,b.`orderdate`,c.`labname`,c.`result`,c.`unit`
FROM `diabetes_clinic` as a 
LEFT JOIN `resulthead` as b ON b.`hn` = a.`hn` 
LEFT JOIN `resultdetail` as c ON c.`autonumber` = b.`autonumber`
WHERE a.`dateN` >= '2014-07'
AND b.`orderdate` >= '2014-07'
AND b.`profilecode` = 'UA'
AND c.`labname` = 'Protein';
";
$q = mysql_query($sql);
// dump($q);

$sql = "SELECT dm_no,hn,orderdate,profilecode,autonumber,labname,result,unit FROM `diabetes_mini`;";
$q = mysql_query($sql) or die( mysql_error($Conn) );
// dump($q);
while($item = mysql_fetch_assoc($q)){
	
	
	// $sql = "INSERT INTO `diabetes_lab` (dm_no,labname,dateY,result_lab,dummy_no) VALUES 
	// ('{$item['dm_no']}','Protein','{$item['orderdate']}','{$item['result']}','$dummy_no')";
	
	// dump($sql);
	
	
} 