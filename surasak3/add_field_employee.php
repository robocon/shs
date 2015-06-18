<?php
session_start();
error_reporting(1); // Show all error

include 'connect.inc';

/**
!!! REMOVE employee field !!!
ALTER TABLE `opcard` DROP `employee` ;

!!! ADD employee field !!!
ALTER TABLE `opcard` ADD `employee` VARCHAR(  ) NULL ;
 */

// !!! FOR DEVELOP ONLY !!!
// $host = "localhost";
// $db = "smdb";
// $user = "root"; 
// $pass = "1234";
// $conn = mysql_connect($host,$user,$pass) or die ("Can not connect to server");
// mysql_select_db($db,$conn) or die ("Can not connect to database");


mysql_query("SET NAMES tis620");
// !!! FOR DEVELOP ONLY !!!

$sql = "SELECT `hn`,`vn`,`ptname`,`temperature`,`pause`,`rate`,`weight`,`height`,`bp1`,`bp2`,`organ`,`thidate`,`toborow` 
FROM `opd` 
WHERE (`thidate` LIKE '2558-03%' OR `thidate` LIKE '2558-04%') 
AND ( 
	`organ` LIKE '%ตรวจสุขภาพประจำปี58ลูกจ้างรพ.ค่าย%' 
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้างประจำปีรพ.ค่ายปี 58%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างชั่วคราว รพ.ค่าย%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้าง%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างรพ.ค่ายฯ%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างรพ.ค่าย%' 
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้างรพ.ค่ายฯ%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้าง ร.พ. ค่าย%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้าง ร.พ.ค่ายฯ%'
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างชั่วคราว รพ.ค่าย ปี58%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้างร.พ. ค่าย%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้าง%'
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้าง ร.พ. ค่ายฯ%'
	OR `organ` LIKE '1.ตรวจสุขภาพประจำปี%'
	OR `organ` = 'ตรวจสุขภาพประจำปี'
	OR `organ` = ' ตรวจสุขภาพประจำปี'
	
	OR `organ` LIKE '%ลูกจ้าง%'
	) 
GROUP BY `hn` 
ORDER BY `row_id` DESC ";

$result = mysql_query($sql);
if (!$result) {
    die('Invalid query: ' . mysql_error());
}

$i = 0;
while ($row = mysql_fetch_assoc($result)) {	
	
	$sql = "SELECT `row_id`,`name`,`surname`,`employee` FROM `opcard` WHERE `hn` = '".$row['hn']."';";
	$res = mysql_query($sql);
	$item = mysql_fetch_assoc($res);
	if($item !== false && $item['employee'] != 'y'){
		
		$sql = "UPDATE `opcard` SET `employee` = 'y' WHERE `hn` = '".$row['hn']."' ";
		$update = mysql_query($sql);
		
		if($update){
			echo '<p>'.$item['name'].' '.$item['surname'].'</p>';
			$i++;
		}
		
	}
	
}

echo '<p><b>รวมทั้งสิ้น '.$i.' คน ที่ปรับค่าให้เป็น พนักงานโรงพยาบาล</b></p>';