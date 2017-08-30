#!/usr/local/bin/php
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
$th_datetime = $th_date.' '.date('H:i:s');

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
		// ��������͹�㹡�õ�Ǩ�ͺ��� basic_opd.php ����բ�����㹵��ҧ opd �������ѧ
		// ����ѧ������������ ��������������Ѿഷ
		$id = $item['ROW_ID'];
		// $hn = $item['V_HN'];
		$hn = substr($item['V_HN'], 0, 2).'-'.substr($item['V_HN'], 2);
		
		$vn = $item['V_VN'];
		$date_hn = $th_date.$hn;
		$temp = $item['V_TEMP'];
		$pulse = $item['V_PULSE'];
		$rate = $item['V_RATE'];
		$weight = $item['V_WEIGHT'];
		$bp1 = $item['V_PRESSURE1'];
		$bp2 = $item['V_PRESSURE2'];
		$drugreact = $item['ALLERGY'];
		$disease = to_tis620($item['DISEASE']);
		$cigarette = $item['CIGARETTE'];
		$alcohol = $item['ALCOHOL'];
		$type = $item['REFERIN'];
		$pain_score = $item['PAIN_SCORE'];
		$height = $item["V_HEIGHT"];
		$sOfficer = $item["USR_CREATE"];

		$shs = new SHSDB();

		$sql = "SELECT `row_id` FROM `opd` WHERE `thdatehn` '$date_hn'";
		$shs->query($sql);
		$opd_rows = $shs->rows();
		
		// �֧�ҡ opday 
		$opday_thdatehn = $th_date.$hn;
		$sql = "SELECT * FROM `opday` WHERE `thdatehn` = '$opday_thdatehn'";
		$shs->query($sql);
		$opday = $shs->fetch_single();
		$toborow = $opday["toborow"];
		$cAge = $opday['age'];

		// ������
		$organ = to_tis620($item['V_SYMPTOM']);
		$waist = ''; // $_POST["waist"]
		$doctorname = '';
		$clinic = ''; // $_POST["clinic"]
		$member2 = ''; // $_POST["member2"]
		$typediag = ''; // $_POST["typediag"]
		$room = ''; // $_POST["room"]

		if( $opd_rows === 0 ){

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
			NULL , '$th_datetime', '$date_hn', '$hn', '$ptname', 
			'$temp', '$pulse', '$rate', '$weight', '$bp1', 
			'$bp2', '$drugreact', '$disease', '$type', '$organ', 
			'$doctorname', '$sOfficer', '$vn', '$toborow', '$height', 
			'$clinic', '$cigarette', '$alcohol', '$member2', '$waist', 
			'$typediag', '$room', '$pain_score' ,'$cAge');";

			$shs->query($sql);



		}else{

			$sql = "UPDATE `opd` SET 
			`thidate` = '$th_date', 
			`temperature` = '$temp', 
			`pause` = '$pulse', 
			`rate` = '$rate', 
			`weight` = '$weight', 
			`bp1` = '$bp1', 
			`bp2` = '$bp2', 
			`drugreact` = '$drugreact', 
			`congenital_disease` = '$disease', 
			`type` = '$type', 
			`organ` = '$organ', 
			`doctor` = '$doctorname',  
			`officer` = '$sOfficer', 
			`vn`= '$vn', 
			`toborow` = '$toborow', 
			`height` = '$height', 
			`clinic`  = '$clinic', 
			`cigarette`= '$cigarette', 
			`alcohol`= '$alcohol', 
			`cigok`= '$member2', 
			`waist`= '$waist', 
			`chkup`= '$typediag', 
			`room`= '$room',
			`painscore`= '$pain_score',
			`age`='$cAge' 
			WHERE `thdatehn` = '$date_hn' 
			LIMIT 1 ";
			$shs->query($sql);

		}

		// exit;

		// 
		$update_sql = "UPDATE `sync_vitalsign`
        SET
        `DATE_UPDATE` = NOW(),
        `USR_UPDATE` = 'surasak', 
        `STATUS` = '1'
        WHERE `ROW_ID` = '$id';";
        $drcom->query($update_sql);
		
		var_dump($update_sql);

	}
}