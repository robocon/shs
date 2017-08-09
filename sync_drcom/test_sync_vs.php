#!/usr/bin/php
<?php

define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
define('EXTENDED_ABLE', 1);

include ROOT_DIR.'config.php';
include ROOT_DIR.'base_fun.php';

/**
 * DEFAULT VARIABLE
 */
$date_create = date('Y-m-d');
$th_date = ( date('Y') + 543 ).date('-m-d');

$drcom = new DRDB();

$sql = "SELECT * 
FROM `sync_vitalsign` 
WHERE `DATE_CREATE` LIKE  '$date_create%' 
AND `STATUS` IS NULL 
AND `V_VN` != '' 
GROUP BY `V_HN`,`V_VN`
ORDER BY `DATE_CREATE` ASC ";
$drcom->query($sql);
$user_row = $drcom->rows();

if( $user_row > 0 ){

	$items = $drcom->fetch();
	foreach ($items as $key => $item) {
		
		// @todo
		// เหลือเงื่อนไขในการตรวจสอบตาม basic_opd.php ว่ามีข้อมูลในตาราง opd แล้วรึยัง
		// ถ้ายังไม่มีให้เพิ่ม แต่ถ้ามีแล้วให้อัพเดท

		$hn = $item['V_HN'];
		$vn = $item['V_VN'];
		$date_hn = $th_date.$hn;
		$temp = $item['V_TEMP'];
		$pulse = $item['V_PULSE'];
		$rate = $item['V_RATE'];
		$weight = $item['V_WEIGHT'];
		$bp1 = $item['V_PRESSURE1'];
		$bp2 = $item['V_PRESSURE2'];
		$drugreact = $item['ALLERGY'];
		$disease = $item['DISEASE'];
		$cigarette = $item['CIGARETTE'];
		$alcohol = $item['ALCOHOL'];
		$type = $item['REFERIN'];
		$pain_score = $item['PAIN_SCORE'];
		$height = $_SESSION["V_HEIGHT"];
		$sOfficer = $item["USR_CREATE"];

		// ดึงจาก opday 
		$opday_thdatehn = $th_date.$hn;
		$sql = "SELECT * FROM `opday` WHERE `thidatehn` = '$opday_thdatehn'";
		$shs->query($sql);
		$opday = $shs->fetch_single();
		$toborow = $opday["toborow"];
		$cAge = $opday['age'];

		// ไม่แน่ใจ
		$organ = $item['V_SYMPTOM'];
		$waist = $_POST["waist"];
		$doctorname = '';
		$clinic = $_POST["clinic"];
		$member2 = $_POST["member2"];
		$typediag = $_POST["typediag"];
		$room = $_POST["room"];

		$shs = new SHSDB();

		$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn'";
		$shs->query($sql);
		$user = $shs->fetch_single();
		$ptname = $user['ptname'];

		$sql = "INSERT INTO `opd` (
		`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,
		`temperature` ,`pause` ,`rate` ,`weight` ,`bp1`  ,
		`bp2` ,`drugreact` ,`congenital_disease` ,`type` ,`organ` ,
		`doctor`, `officer`, `vn` , `toborow`, `height`, 
		`clinic`, `cigarette`, `alcohol`,`cigok`,`waist`,
		`chkup`,`room`,`painscore`,`age`
		)VALUES (
		NULL , '$th_date', '$date_hn', '$hn', '$ptname', 
		'$temp', '$pulse', '$rate', '$weight', '$bp1', 
		'$bp2', '$drugreact, '$disease', '$type', '$organ', 
		'$doctorname', '$sOfficer', '$vn', '$toborow', '$height', 
		'$clinic', '$cigarette', '$alcohol', '$member2', '$waist', 
		'$typediag', '$room', '$pain_score' ,'$cAge');";
		$shs->query($sql);

	}
}