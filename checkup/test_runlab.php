#!/usr/bin/php
<?php
$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $conn) or die( mysql_error() );

//title	prefix	runno	startday
//lab	 	30	2015-12-31

#autonumber	orderdate	labnumber

/*
$sql = "SELECT `runno` AS `id`,`startday` 
FROM `smdb`.`test_runno` 
WHERE `title` = 'lab' ";
$q = mysql_query($sql);
$runno = mysql_fetch_assoc($q);
*/

// Lock ให้ write ไม่ให้ read
mysql_query("LOCK TABLES `test_runno` WRITE, `test_orderhead` WRITE;", $conn) or die( mysql_error() );

// เหมือนเป็น exam_no ใน opcardchk
$users = range(1, 100);
$last_labnumber = false;

$i = 1;
$prefix_number = date('ymd');
foreach( $users as $key => $user ){

	$run_number = sprintf('%03d', $i);
	$labnumber = $prefix_number.$run_number;

	// ทดสอบการบันทึกข้อมูลใน
	$sql = "INSERT INTO  `test_orderhead` (  `autonumber` ,  `orderdate` ,  `labnumber`,`test_hn` ) 
	VALUES (
	'',  NOW(),  '$labnumber','$run_number'
	);";
	$q = mysql_query($sql) or die( mysql_error() );
	var_dump($q);

	$last_labnumber = $run_number;
	$i++;
}

$update_date = date('Y-m-d');

// update runno
$sql = "UPDATE  `test_runno` SET  
`runno` =  '$last_labnumber',
`startday` =  '$update_date'
WHERE  `title` =  'lab' 
AND  `prefix` =  '' 
LIMIT 1 ;";
mysql_query($sql) or die( mysql_error() );

// หลังจากที่ write แล้วค่อยปล่อย lock
mysql_query("UNLOCK TABLES ;", $conn) or die( mysql_error() );