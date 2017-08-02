<?php

include 'bootstrap.php';
$db = Mysql::load();

$exam_no = 301;
$checkup_date_code = '170503';

$part = 'อบจ60';
$title_part = 'องค์การบริหารส่วนจังหวัดลำปาง';

$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
$en_date = date("Y-m-d H:i:s");

$action = input('action');
if( $action === 'import' ){

	exit;

	$file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);

	$sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
	$db->select($sql);
	$chk = $db->get_item();
	$last_id = (int) $chk['lastrow'];

	foreach ($items as $key => $item) {
		
		if( !empty($item) ){
		
			++$last_id;

			list($exam_no, $name, $surname, $age, $hn, $course, $ptright) = explode(',', $item);

			$hn = trim(str_replace(' ', '', $hn));

			$sql = "SELECT `yot`,`name`,`surname`,`idcard`
			,CONCAT((SUBSTRING(`dbirth`,1,4) - 543),SUBSTRING(`dbirth`,5,15)) AS `dbirth` 
			FROM `opcard` 
			WHERE `hn` = '$hn'";
			$db->select($sql);
			$user = $db->get_item();

			$idcard = $user['idcard'];
			$dbirth = $user['dbirth'];

			$name = $user['yot'].$user['name'];
			$surname = trim($surname);
			$age = trim($age);

			$sql = "INSERT INTO `opcardchk`
			(`HN`, 
			`row`, 
			`exam_no`, 
			`idcard`, 
			`name`, 
			`surname`, 
			`dbirth`, 
			`agey`, 
			`part`, 
			`course`, 
			`branch`, 
			`datechkup`)
			VALUES (
			'$hn',
			'$last_id',
			'$exam_no',
			'$idcard',
			'$name',
			'$surname',
			'$dbirth',
			'$age',
			'อบจ60',
			'$course',
			'$ptright',
			NOW());";
			$insert = $db->insert($sql);
			dump($sql);
			dump($insert);
			
		}
	}
	
	// exit;

	header('Location: aorborjor_print_lab.php');
	exit;

} else if( $action === 'money_lab' ){
	
	// exit;

	include 'includes/cu_sso.php';
	$sso = new CU_SSO();
	
	##############################
	### ทดสอบดูว่ามีค่าใช้จ่ายเกิดขึ้นแล้วรึยัง
	##############################
	$test_depart = "SELECT b.*, COUNT(b.`depart`) AS `count_depart`
	FROM ( 
		SELECT * FROM `opcardchk`WHERE `part` = 'อบจ60' 
	 ) AS a 
	LEFT JOIN ( 
		SELECT * FROM `depart` WHERE `date` LIKE '2560-05-04%'
	) AS b ON b.`hn` = a.`HN`
	WHERE b.`row_id` IS NOT NULL 

	#
	AND b.`depart` = 'PATHO' 
	#AND count_depart >= 2 
	GROUP BY b.`hn` 
	#

	ORDER BY a.`exam_no` ASC 

	";
	// dump($test_depart);
	// exit;

	// ดูใน opday ก่อนว่ามีใครบ้างที่ได้ VN
	// !!!!!!!!!!!!!!!!!!!!!!!!!!
	// !!! อย่าลืมดูตรง thidate !!!!
	// !!!!!!!!!!!!!!!!!!!!!!!!!!
	$sql = "SELECT a.* 
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth` 
	,c.`thidate`,c.`vn`,c.`ptright` 
	FROM ( 
		SELECT *, CONCAT('$checkup_date_code',`exam_no`) AS `labnumber`
		FROM `opcardchk`
		WHERE ( `part` = 'อบจ60' 
			#AND `course` = 'อบจ' 
			#AND ( 
			#AND `branch` != 'เงินสด' 
				AND `branch` != 'ประกันสังคม' 
			#) 
		) 
		AND `hn` != '60-1987' 
		AND ( `hn` != '60-3216' OR `hn` != '50-8820' OR `hn` != '48-20145' ) 
	) AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE `thidate` LIKE '2560-05-04%' 
	) AS c ON c.`hn` = a.`HN` 
	WHERE c.`vn` IS NOT NULL 
	ORDER BY c.`ptright` ASC 
	LIMIT 300";

	dump($sql);
	exit;

	$db->select($sql);
	$items = $db->get_items();
	// dump($items);
	// exit;

	$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
	$en_date = date("Y-m-d H:i:s");
	$end_runno = 0;

	// $user_i = 1;
	// $test_case = true;
	
	// เรียงไปทีละคน 
	foreach ($items as $key => $item) {
		
		$hn = $item['HN'];
		$exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$ptname = $item['name'].' '.$item['surname'];
		$gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
		$dbirth = $item['dbirth'];

		$ptright = $item['ptright'];
		$labnumber = $item['labnumber'];

		/**
		 * เอาข้อมูลจากที่เคยดีดไว้ใน orderhead + orderdetail มาคำนวณ คชจ. เลยจ้า
		 */
		$sql = "SELECT a.*,b.`code`,b.`oldcode`,b.`detail`,b.`price`,b.`yprice`,b.`nprice`
		FROM `orderdetail` AS a 
		LEFT JOIN `labcare` AS b ON b.`code` = a.`labcode` 
		WHERE a.`labnumber` = '$labnumber' ";
		$db->select($sql);
		$all_lists = $db->get_items();
		// dump($all_lists);

		// หาราคารวมเพื่อใส่ใน depart
		$price = 0;
		$sumyprice = 0;
		$sumnprice = 0;
		$count_item = count($all_lists);
		$vn = $item['vn'];
		// $ptright = 'R07 ประกันสังคม';

		foreach ($all_lists as $key => $list) {
			$price += $list['price'];
			$sumyprice += $list['yprice'];
			$sumnprice += $list['nprice'];
		}
		
		// runno stktranx
		$db->select("SELECT runno, startday FROM runno WHERE title = 'stktranx'");
		$nStktranx = $db->get_item();
		$end_runno = $runno = $nStktranx['runno']+1;

		// depart
		$depart_sql = "INSERT INTO `depart` SET 
		`chktranx` = '$runno',
		`date` = '$thai_date',
		`ptname` = '$ptname',
		`hn` = '$hn',
		`doctor` = 'MD022 (ไม่ทราบแพทย์)',
		`depart` = 'PATHO',
		`item` = '$count_item',
		`detail` = 'ค่าตรวจวิเคราะห์โรค',
		`price` = '$price',
		`sumyprice` = '$sumyprice',
		`sumnprice` = '$sumnprice',
		`paid` = '0',
		`idname` = 'พัชรี คำฟู',
		`diag` = 'ตรวจสุขภาพ',
		`tvn` = '$vn',
		`ptright` = '$ptright',
		`lab` = '$exam_no',
		`status` = 'Y';";
		dump($depart_sql);
		$depart = $db->insert($depart_sql);
		$depart_id = $db->get_last_id();

		// $depart_id = rand(10000, 20000);
		// dump($depart_sql);
		dump($depart_id);
		
		// เอารายการตรวจมาเพิ่มใน patdata
		foreach ($all_lists as $key => $list) {

			// $lab_item = $lab_lists[$list];
			$code = $list['code'];
			$price = $list['price'];
			$yprice = $list['yprice'];
			$nprice = $list['nprice'];
			$detail = $list['detail'];
			
			$patdata_sql = "INSERT INTO `patdata` SET 
			`date` = '$thai_date',
			`hn` = '$hn',
			`ptname` = '$ptname',
			`doctor` = 'MD022 (ไม่ทราบแพทย์)',
			`item` = '$count_item',
			`code` = '$code',
			`detail` = '$detail',
			`amount` = '1',
			`price` = '$price',
			`yprice` = '$yprice',
			`nprice` = '$nprice',
			`depart` = 'PATHO',
			`part` = 'LAB',
			`idno` = '$depart_id',
			`ptright` = '$ptright',
			`status` = 'Y';";
			// dump($patdata_sql);
			$patdata = $db->insert($patdata_sql);
			dump($patdata);

		} // end patdata
		
		// $runno = $runno + 1;
		$run = $db->update("UPDATE runno SET runno = $runno WHERE title='stktranx'");

		echo "<hr>";
		
	} // end insert into depart & patdata

	++$end_runno;
	dump($end_runno);
	$db->update("UPDATE runno SET runno = $end_runno WHERE title='stktranx'");

	exit;

} else if( $action === 'money_xray' ){

	exit;

	$sql = "SELECT a.* 
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth` 
	,c.`thidate`,c.`vn`,c.`ptright` 
	FROM ( 
		SELECT *, CONCAT('$checkup_date_code',`exam_no`) AS `labnumber`
		FROM `opcardchk`
		WHERE ( `part` = 'อบจ60' 
			#AND `course` = 'อบจ' 
			#AND ( 
			AND `branch` != 'เงินสด' 
			#	AND `branch` != 'ประกันสังคม' 
			#) 
		) 
		AND `hn` != '60-1987' 
		AND ( `hn` = '60-3216' OR `hn` = '50-8820' OR `hn` = '48-20145' ) 
	) AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE `thidate` LIKE '2560-05-04%' 
	) AS c ON c.`hn` = a.`HN` 
	WHERE c.`vn` IS NOT NULL 
	ORDER BY c.`ptright` ASC 
	LIMIT 300";
	// dump($sql);

	// exit;

	$db->select($sql);
	$items = $db->get_items();

	$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
	$en_date = date("Y-m-d H:i:s");
	$end_runno = 0;

	// เรียงไปทีละคน 
	foreach ($items as $key => $item) {
		
		$hn = $item['HN'];
		$exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$ptname = $item['name'].' '.$item['surname'];
		$gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
		$dbirth = $item['dbirth'];

		$ptright = $item['ptright'];
		$labnumber = $item['labnumber'];
		
		$code = '41001'; 
		if( $item['branch'] == 'ประกันสังคม' ){ 
			$code = '41001-sso'; 
		} 

		$sql = "SELECT * FROM `labcare` WHERE `code` = '$code'";
		$db->select($sql);
		$all_lists = $db->get_items();

		// หาราคารวมเพื่อใส่ใน depart
		$price = 0;
		$sumyprice = 0;
		$sumnprice = 0;
		$count_item = count($all_lists);
		$vn = $item['vn'];
		// $ptright = 'R07 ประกันสังคม';

		foreach ($all_lists as $key => $list) {
			$price += $list['price'];
			$sumyprice += $list['yprice'];
			$sumnprice += $list['nprice'];
		}
		
		// runno stktranx
		$db->select("SELECT runno, startday FROM runno WHERE title = 'stktranx'");
		$nStktranx = $db->get_item();
		$end_runno = $runno = $nStktranx['runno']+1;

		// depart
		$depart_sql = "INSERT INTO `depart` SET 
		`chktranx` = '$runno',
		`date` = '$thai_date',
		`ptname` = '$ptname',
		`hn` = '$hn',
		`doctor` = 'MD022 (ไม่ทราบแพทย์)',
		`depart` = 'XRAY',
		`item` = '$count_item',
		`detail` = 'ค่าตรวจวิเคราะห์โรค',
		`price` = '$price',
		`sumyprice` = '$sumyprice',
		`sumnprice` = '$sumnprice',
		`paid` = '0',
		`idname` = 'ศรัณย์ มกรพฤติพงศ์',
		`diag` = 'ตรวจสุขภาพ',
		`tvn` = '$vn',
		`ptright` = '$ptright',
		`status` = 'Y';";

		dump($depart_sql);
		$depart = $db->insert($depart_sql);
		$depart_id = $db->get_last_id();
		// $depart_id = rand(10000, 20000);
		// dump($depart_sql);
		dump($depart_id);
		
		

		// เอารายการตรวจมาเพิ่มใน patdata
		foreach ($all_lists as $key => $list) {

			// $lab_item = $lab_lists[$list];
			$code = $list['code'];
			$price = $list['price'];
			$yprice = $list['yprice'];
			$nprice = $list['nprice'];
			$detail = $list['detail'];
			
			$patdata_sql = "INSERT INTO `patdata` SET 
			`date` = '$thai_date',
			`hn` = '$hn',
			`ptname` = '$ptname',
			`doctor` = 'MD022 (ไม่ทราบแพทย์)',
			`item` = '$count_item',
			`code` = '$code',
			`detail` = '$detail',
			`amount` = '1',
			`price` = '$price',
			`yprice` = '$yprice',
			`nprice` = '$nprice',
			`depart` = 'XRAY',
			`part` = 'XRAY',
			`idno` = '$depart_id',
			`ptright` = '$ptright',
			`film_size` = 'DIGITA',
			`status` = 'Y';";
			// dump($patdata_sql);
			$patdata = $db->insert($patdata_sql);
			dump($patdata);
		} // end patdata

		// exit;
		
		// $runno = $runno + 1;
		$run = $db->update("UPDATE runno SET runno = $runno WHERE title='stktranx'");

		echo "<hr>";
		
	} // end insert into depart & patdata

	++$end_runno;
	dump($end_runno);
	$db->update("UPDATE runno SET runno = $end_runno WHERE title='stktranx'");

	exit;

} else if( $action === 'save_depart' ){

	$hn = input_post('hn');
	$vn = input_post('vn');
	
	$sql = "SELECT a.*
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`
	,c.`vn`,c.`ptright`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE `thdatehn` = CONCAT('".date('d-m-').(date('Y')+543)."','$hn') 
	 ) AS c ON c.`hn` = a.`HN` 
	WHERE a.`part` = '$part' 
	AND a.`HN` = '$hn' 
	AND c.`vn` = '$vn' 
	ORDER BY a.`row` ASC";
	// dump($sql);
	$db->select($sql);
	$user = $db->get_item();
	if( empty($user) ){
		echo "ไม่พบ $vn ของHN $hn";
		exit;
	}

	$vn = $user['vn'];
	$ptright = $user['ptright'];
	$ptname = $user['name'].' '.$user['surname'];
	$part = $user['part'];
	
	// เอา labnumber ไปหารายการ lab ที่เคยสั่งเอาไว้ใน orderdetail
	$exam_no = $user['exam_no'];
	$labnumber = $checkup_date_code.$user['exam_no'];

	$sql = "SELECT a.`labcode`,b.`code`,b.`oldcode`,b.`detail`,b.`price`,b.`yprice`,b.`nprice` 
	FROM `orderdetail` AS a 
	LEFT JOIN `labcare` AS b ON b.`code` = a.`labcode`
	WHERE a.`labnumber` = '$labnumber' 
	GROUP BY a.`labcode`";
	$db->select($sql);
	$lab_lists = $db->get_items();

	// หาราคารวมเพื่อใส่ใน depart
	$price = 0;
	$yprice = 0;
	$count_item = count($lab_lists);
	foreach ($lab_lists as $key => $list) {
		$price += $list['price'];
		$yprice += $list['yprice'];
	}
	
	// runno stktranx
	$db->select("SELECT runno, startday FROM runno WHERE title = 'stktranx'");
	$nStktranx = $db->get_item();
	$runno = $nStktranx['runno']+1;

	// depart
	$depart_sql = "INSERT INTO `depart` SET 
	`chktranx` = '$runno',
	`date` = '$thai_date',
	`ptname` = '$ptname',
	`hn` = '$hn',
	`doctor` = 'MD022 (ไม่ทราบแพทย์)',
	`depart` = 'PATHO',
	`item` = '$count_item',
	`detail` = 'ค่าตรวจวิเคราะห์โรค',
	`price` = '$price',
	`sumyprice` = '$yprice',
	`sumnprice` = '0',
	`paid` = '0',
	`idname` = 'พัชรี คำฟู',
	`diag` = 'ตรวจสุขภาพ',
	`tvn` = '$vn',
	`ptright` = '$ptright',
	`lab` = '$exam_no',
	`status` = 'Y';";
	$depart = $db->insert($depart_sql);
	$depart_id = $db->get_last_id();
	dump($depart);
	dump($depart_id);
	
	$depart_log = "INSERT INTO `depart_log`
	(`id`,`idno`,`hn`,`part`)
	VALUES
	(NULL,'$depart_id','$hn','$part');";
	$db->insert($depart_log);

	foreach ($lab_lists as $key => $list) {

		$code = $list['code'];
		$price = $list['price'];
		$yprice = $list['yprice'];
		$detail = $list['detail'];
		
		$patdata_sql = "INSERT INTO `patdata` SET 
		`date` = '$thai_date',
		`hn` = '$hn',
		`ptname` = '$ptname',
		`doctor` = 'MD022 (ไม่ทราบแพทย์)',
		`item` = '$count_item',
		`code` = '$code',
		`detail` = '$detail',
		`amount` = '1',
		`price` = '$price',
		`yprice` = '$yprice',
		`nprice` = '0',
		`depart` = 'PATHO',
		`part` = 'LAB',
		`idno` = '$depart_id',
		`ptright` = '$ptright',
		`status` = 'Y';";
		// dump($patdata_sql);
		$patdata = $db->insert($patdata_sql);
		dump($patdata);
	} // end patdata

	$run = $db->update("UPDATE runno SET runno = $runno WHERE title='stktranx'");
	dump($run);

	echo '<a href="aorborjor_print_lab.php?page=depart_form">ไปหน้าคีย์ Lab</a>';

	exit;
}  else if( $action === 'xray_depart' ){

	$hn = input_post('hn');
	$vn = input_post('vn');
	
	$sql = "SELECT a.*
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`
	,c.`vn`,c.`ptright`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE `thdatehn` = CONCAT('".date('d-m-').(date('Y')+543)."','$hn') 
	 ) AS c ON c.`hn` = a.`HN` 
	WHERE a.`part` = '$part' 
	AND a.`HN` = '$hn' 
	AND c.`vn` = '$vn' 
	ORDER BY a.`row` ASC";
	// dump($sql);
	$db->select($sql);
	$user = $db->get_item();
	if( empty($user) ){
		echo "ไม่พบ $vn ของHN $hn";
		exit;
	}

	$vn = $user['vn'];
	$ptright = $user['ptright'];
	$ptname = $user['name'].' '.$user['surname'];
	$part = $user['part'];
	
	// เอา labnumber ไปหารายการ lab ที่เคยสั่งเอาไว้ใน orderdetail
	$exam_no = $user['exam_no'];
	$labnumber = $checkup_date_code.$user['exam_no'];

	$code = '41001'; 
	if( $user['branch'] == 'ประกันสังคม' ){ 
		$code = '41001-sso'; 
	} 

	// 41001 ใน labcare
	$sql = "SELECT b.`code`,b.`oldcode`,b.`detail`,b.`price`,b.`yprice`,b.`nprice` 
	FROM `labcare` AS b 
	WHERE b.`code` = '$code' ";
	$db->select($sql);
	$lab_lists = $db->get_items();
	
	// หาราคารวมเพื่อใส่ใน depart
	$price = 0;
	$yprice = 0;
	$nprice = 0;
	$count_item = count($lab_lists);
	foreach ($lab_lists as $key => $list) {
		$price += $list['price'];
		$yprice += $list['yprice'];
		$nprice += $list['nprice'];
	}

	// runno stktranx
	$db->select("SELECT runno, startday FROM runno WHERE title = 'stktranx'");
	$nStktranx = $db->get_item();
	$runno = $nStktranx['runno']+1;

	// depart
	$depart_sql = "INSERT INTO `depart` SET 
	`chktranx` = '$runno',
	`date` = '$thai_date',
	`ptname` = '$ptname',
	`hn` = '$hn',
	`doctor` = 'MD022 (ไม่ทราบแพทย์)',
	`depart` = 'XRAY',
	`item` = '$count_item',
	`detail` = 'ค่าตรวจวิเคราะห์โรค',
	`price` = '$price',
	`sumyprice` = '$yprice',
	`sumnprice` = '$nprice',
	`paid` = '0',
	`idname` = 'ศรัณย์ มกรพฤติพงศ์',
	`diag` = 'ตรวจสุขภาพ',
	`tvn` = '$vn',
	`ptright` = '$ptright',
	`status` = 'Y';";
	// dump($depart_sql);
	$depart = $db->insert($depart_sql);
	$depart_id = $db->get_last_id();
	dump($depart);
	dump($depart_id);

	// exit;
	
	$depart_log = "INSERT INTO `depart_log`
	(`id`,`idno`,`hn`,`part`)
	VALUES
	(NULL,'$depart_id','$hn','$part');";
	$db->insert($depart_log);

	foreach ($lab_lists as $key => $list) {

		$code = $list['code'];
		$price = $list['price'];
		$yprice = $list['yprice'];
		$nprice = $list['nprice'];
		$detail = $list['detail'];
		
		$patdata_sql = "INSERT INTO `patdata` SET 
		`date` = '$thai_date',
		`hn` = '$hn',
		`ptname` = '$ptname',
		`doctor` = 'MD022 (ไม่ทราบแพทย์)',
		`item` = '$count_item',
		`code` = '$code',
		`detail` = '$detail',
		`amount` = '1',
		`price` = '$price',
		`yprice` = '$yprice',
		`nprice` = '$nprice',
		`depart` = 'XRAY',
		`part` = 'XRAY',
		`idno` = '$depart_id',
		`ptright` = '$ptright',
		`film_size` = 'DIGITA',
		`status` = 'Y';";
		// dump($patdata_sql);
		$patdata = $db->insert($patdata_sql);
		dump($patdata);
	} // end patdata

	$run = $db->update("UPDATE runno SET runno = $runno WHERE title='stktranx'");
	dump($run);

	echo '<a href="aorborjor_print_lab.php?page=depart_form_xray">ไปหน้าคีย์ X-Ray</a>';

	exit;
}

?>
<style>
@media print{
	.no-print{
		display: none;
	}
}
</style>
<ul class="no-print">
	<li>
		<a href="aorborjor_print_lab.php">นำเข้าข้อมูล</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=agemorethan45">อบจ. อายุเกิน45</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=lab">print sticker lab</a>
	</li>
	<!-- 
	<li>
		<a href="aorborjor_print_lab.php?page=labsso">ดูรายการตรวจของผู้ป่วย ปกส</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=orderlab">สั่ง orderhead</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=fixorderlab">แก้ไขที่ใส่ order ผิด</a>
	</li> 
	
	<li>
		<a href="aorborjor_print_lab.php?page=money">คิดค่าใช้จ่าย Lab</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=money_xray">คิดค่าใช้จ่าย X-Ray</a>
	</li>
	-->
	<li>
		<a href="aorborjor_print_lab.php?page=depart_form">เพิ่มค่าlabทีละคน</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=depart_form_xray">เพิ่มค่าxrayทีละคน</a>
	</li>
	<li>
		<a href="aorborjor_print_lab.php?page=check_vn">ตรวจสอบ VN</a>
	</li>
</ul>
<?php

$page = input('page');
if( empty($page) ){
	?>
	<h3>นำเข้าข้อมูล opcardchk</h3>
	<form action="aorborjor_print_lab.php" method="post" enctype="multipart/form-data">
		<div>
			ไฟล์นำเข้า : <input type="file" name="file">
			<div><span style="color: red; font-size: 14px;">รองรับไฟล์ csv</span></div>
		</div>
		<div>
			<button type="submit">นำเข้า</button>
			<input type="hidden" name="action" value="import">
		</div>
	</form>
	<?php
}else if( $page === 'lab' ){
	
	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`sex` 
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
	WHERE a.`part` = 'อบจ60' 
	AND a.`HN` = '48-8844' 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();
	
	// dump($items);
	// exit;
	$test_user_number = 1;
	?>
	<style>
	font{
		display: block;
		margin: 0;
		padding: 0;
	}
	</style>
	<?php
	foreach ($items as $key => $item) {

		$exam_no = $item['exam_no'];
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$fullname = $item['name'].' '.$item['surname'];

		// ตรวจพวก chem จะตามท้ายด้วย 01
		$lab_number = $checkup_date_code.$exam_no."01";

		// ตรวจพวก chem จะตามท้ายด้วย 02
		$lab_chem = $checkup_date_code.$exam_no."02";

		// เลขรันของสติ๊กเกอร์แต่ละใบ
		$pre_number = 0;
		
		if( $item['branch'] == 'ประกันสังคม' ){
			$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);
			
			if( in_array('CBC-sso', $all_lists) === true ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='6'>
					<center><b><?=$pre_number;?>-<?=$exam_no;?></b> <span style="font-size: 14px;">CBC</span></center>
				</font>
				<center><span class='fc1-0'><img src="barcode/labstk.php?cLabno=<?=$lab_number;?>"></span></center>
				<div style="page-break-before: always;"></div>
				<?php
			}

			if( in_array('UA-sso', $all_lists) === true ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='5'><center><b>UA</b></center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}

			// เหลือของเคม
			$chem_sticker = false;
			$list_chem = array();
			if( in_array('BS-sso', $all_lists) === true 
				OR in_array('CR-sso', $all_lists) === true 
				OR in_array('HDL-sso', $all_lists) === true 
				OR in_array('CHOL-sso', $all_lists) === true 
				OR in_array('HBSAG-sso', $all_lists) === true ){
				++$pre_number;

				if( in_array('BS-sso', $all_lists) === true ){ $list_chem[] = 'BS'; }
				if( in_array('CR-sso', $all_lists) === true ){ $list_chem[] = 'CR'; }
				if( in_array('HDL-sso', $all_lists) === true ){ $list_chem[] = 'HDL'; }
				if( in_array('CHOL-sso', $all_lists) === true ){ $list_chem[] = 'CHOL'; }
				if( in_array('HBSAG-sso', $all_lists) === true ){ $list_chem[] = 'HBSAG'; }
				
				$chem_txt = '';
				if( count($list_chem) > 0 ){
					$chem_txt = implode(',', $list_chem);
				}
				
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b> <span style="font-size: 14px;"><?=$chem_txt;?></span></center></font>
				<center>
					<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_chem;?>"></span>
				</center>
				<div style="page-break-before: always;"></div>
				<?php
			}

			if( in_array('PAP-sso', $all_lists) === true ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='5'><center><b>OUTLAB</b> </center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}

			if( in_array('STOCB-sso', $all_lists) === true ){
				++$pre_number;
				?>
				<font style='line-height:22px;'  face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;'  face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:20px;'  face='Angsana New' size='5'><center><b>STOOL</b></center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}

		}else if( $item['branch'] == 'เบิกจ่ายตรง' ){

			if( $item['agey'] < 35 ){

				// program1 อายุน้อยกว่า 35
				$all_lists = array('CBC','UA');
				$program = 1;
				
			} else if( $item['agey'] >= 35 ){

				// program3 อายุ 45 ขึ้นไป
				// อย่าลืมเพิ่ม hdl ldl
				$all_lists = array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','CHOL','TRI');
				$program = 2;

			}

			++$pre_number;
			?>
			<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
			<font style='line-height:20px;' face='Angsana New' size='6'>
				<center><b><?=$pre_number;?>-<?=$exam_no;?></b> <span style="font-size: 14px;">CBC</span></center>
			</font>
			<center>
				<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_number;?>"></span>
			</center>
			<div style="page-break-before: always;"></div>
			
			<?php
			++$pre_number;
			?>
			<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
			<font style='line-height:20px;' face='Angsana New' size='6'>
				<center><b><?=$pre_number;?>-<?=$exam_no;?></b></center>
			</font>
			<font style='line-height:20px;' face='Angsana New' size='5'><center><b>UA</b></center></font>
			<div style="page-break-before: always;"></div>
			<?php
			if( $program === 2 ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<center>
					<span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_chem;?>"></span>
				</center>
				<div style="page-break-before: always;"></div>
				<?php
			}


		}else if( $item['branch'] == 'เงินสด' ){

			?>
			<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
			<font style='line-height:20px;' face='Angsana New' size='6'>
				<center><b>1-<?=$exam_no;?></b> <span style="font-size: 14px;">CBC</span></center>
			</font>
			<center><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_number;?>"></span></center>
			<div style="page-break-before: always;"></div>
			<?php

		}
		// exit;
		
	} // foreach แต่ละ user

	exit;
		
} else if( $page === 'labsso' ){
	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`sex`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
	WHERE a.`part` = 'อบจ60' 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();

	?>
	<style>
	*{
		font-family: 'TH SarabunPSK';
		font-size: 16px;
	}
	</style>
	<h3>รายการตรวจตามช่วงอายุ สำหรับผู้ประกันตน อบจ.ลำปาง</h3>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<thead>
			<tr>
				<th>#</th>
				<th>HN</th>
				<th>ชื่อ-สกุล</th>
				<th>อายุ</th>
				<th>CBC</th>
				<th>UA</th>
				<th>BS</th>
				<th>CR</th>
				<th>HDL</th>
				<th>CHOL</th>
				<th>HBSAG</th>
				<th>PAP</th>
				<th>STOCB</th>
				<th>X-Ray</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		foreach ($items as $key => $item) {

			if( $item['branch'] !== 'ประกันสังคม' ){
				continue;
			}
			
			$age_year = substr($item['dbirth'], 0, 4) + 543 ;
			$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
			$fullname = $item['name'].' '.$item['surname'];

			$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['HN'];?></td>
				<td><?=$fullname;?></td>
				<td><?=$item['agey'];?></td>
				<td align="center"><?=( in_array('CBC-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('UA-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('BS-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('CR-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('HDL-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('CHOL-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('HBSAG-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('PAP-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('STOCB-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
				<td align="center"><?=( in_array('41001-sso', $all_lists) === true ? "&#10004;" : '' );?></td>
			</tr>
			<?php
			$i++;
		}
		?>
		</tbody>
	</table>
	<?php
} else if( $page == 'money' ){

	?>
	<form action="aorborjor_print_lab.php" method="post">
		<div>
			<p>ยืนยันการดีดข้อมูลของห้อง Lab</p>
		</div>
		<div>
			<button type="submit">เอ้า.....ดีด</button>
			<input type="hidden" name="action" value="money_lab">
		</div>
	</form>
	<?php

} else if( $page == 'money_xray' ){

	?>
	<form action="aorborjor_print_lab.php" method="post">
		<div>
			<p>ยืนยันการดีดข้อมูลของห้อง Xray</p>
		</div>
		<div>
			<button type="submit">เอ้า.....ดีด</button>
			<input type="hidden" name="action" value="money_xray">
		</div>
	</form>
	<?php
	
	
} else if( $page === 'orderlab' ){

	// exit;

	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$en_date = date("Y-m-d H:i:s");

	$sql = "SELECT a.*,
	b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth` 
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
	WHERE a.`part` = 'อบจ60' 
	AND a.`HN` = '48-8844' 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();

	// dump($items);
	// exit;

	foreach ($items as $key => $item) {
		
		if( $item['branch'] == 'เงินสด' ){
			continue;
		}

		$hn = $item['HN'];
		$last_labnumber = $exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$ptname = $item['name'].' '.$item['surname'];
		$gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
		$dbirth = $item['dbirth'];
		
		// dump($item['branch']);
		// dump('age => '.$item['agey']);

		if( $item['branch'] == 'ประกันสังคม' ){
			
			$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

			// ตัดของ xray ออกไปก่อน
			if( ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
				unset($all_lists[$search_key]);
			}

			if( ( $search_key = array_search('PAP-sso',$all_lists) ) !== false ){
				unset($all_lists[$search_key]);
			}

			$clinicalinfo = "ตรวจสุขภาพประกันสังคม60";
			
		}else if( $item['branch'] == 'เบิกจ่ายตรง' ){

			if( $item['agey'] < 35 ){

				// program1 อายุน้อยกว่า 35
				$all_lists = array('CBC','UA');
				
			} 
			
			if( $item['course'] === 'อบจ' ){

				// เฉพาะหน่วยงานของ อบจ. เท่านั้น ที่ให้อายุเกิน 45 มีแถม HDL, LDL
				// เลยใช้เป็น LIPID แทน เพราะราคาจะถูกกว่า เพิ่ม HDL+LDL ตรงๆ
				if( $item['agey'] >= 35 && $item['agey'] <= 44 ){

					$all_lists = array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','CHOL','TRI');
					
				} else if( $item['agey'] >= 45  ){

					$all_lists = array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','LIPID');
				}

			}else{
				$all_lists = array('CBC','UA','BS','BUN','CR','SGOT','SGPT','ALK','URIC','CHOL','TRI');
			}
			
			$clinicalinfo = "ตรวจสุขภาพอบจ60";

		}

		# orderhead
		$orderhead_sql = "INSERT INTO `orderhead` ( 
			`autonumber`, 
			`orderdate`, 
			`labnumber`, 
			`hn`, 
			`patienttype`, 
			`patientname`, 
			`sex`, 
			`dob`, 
			`sourcecode`, 
			`sourcename`, 
			`room`, 
			`cliniciancode`, 
			`clinicianname`, 
			`priority`, 
			`clinicalinfo` 
		) VALUES (
			'', 
			'$en_date', 
			'$labnumber', 
			'$hn', 
			'OPD', 
			'$ptname', 
			'$gender', 
			'$dbirth', 
			'', 
			'', 
			'', 
			'', 
			'MD022 (ไม่ทราบแพทย์)', 
			'R', 
			'$clinicalinfo'
		);";
		// dump('labnumber => '.$labnumber);
		dump($orderhead_sql);
		$orderhead = $db->insert($orderhead_sql);
		dump($orderhead);

		// mysql_query($orderhead_sql, $conn) or die( mysql_error() );
		echo "+++++++++++++++++++++++++++++++++++++++++++++++";
		foreach ($all_lists as $key => $list) {

			$labcare_sql = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice` 
			FROM `labcare` 
			WHERE `code` = '$list'";
			$db->select($labcare_sql);
			$lab_item = $db->get_item();

			$code = $lab_item['code'];
			$oldcode = $lab_item['oldcode'];
			$detail = $lab_item['detail'];

			$orderdetail_sql = "INSERT INTO `orderdetail` ( 
				`labnumber`,`labcode`,`labcode1`,`labname` 
			) VALUES (
				'$labnumber', '$code', '$oldcode', '".$detail."'
			);";
			dump($orderdetail_sql);
			$orderdetail = $db->insert($orderdetail_sql);
			dump($orderdetail);
			// mysql_query($orderdetail_sql, $conn) or die( mysql_error() );
		}

		echo "<hr>";

	} // จบการวน lab แต่ละคน

	/*
	$update_date = date('Y-m-d');
	dump($last_labnumber);

	// กันไว้ไม่ให้มันชนกัน
	++$last_labnumber;

	// update runno
	$sql = "UPDATE `runno` SET  
	`runno` =  '$last_labnumber',
	`startday` =  '$update_date'
	WHERE  `title` = 'lab' 
	AND  `prefix` = '' 
	LIMIT 1 ;";
	// mysql_query($sql, $conn) or die( mysql_error() );
	*/

} else if( $page == 'fixorderlab' ){

	exit;

	$sql = "SELECT a.`HN`,c.* 
	FROM ( 
		SELECT `row`,`HN`,CONCAT('$checkup_date_code',`exam_no`) AS `labnumber`
        FROM `opcardchk` 
        WHERE `part` = 'อบจ60' 
		AND `course` != 'อบจ' 
		AND `branch` = 'เบิกจ่ายตรง' 
    ) AS a 
	LEFT JOIN ( 
		SELECT * FROM `orderdetail` WHERE `labnumber` LIKE '$checkup_date_code%' 
    ) AS c ON c.`labnumber` = a.`labnumber` 
	ORDER BY a.`row` ASC";
	$db->select($sql);

	$items = $db->get_items();
	foreach( $items as $key => $item ){

		$labcode = $item['labcode'];
		$labnumber = $item['labnumber'];

		if( $labcode == 'LIPID' ){

			dump($labnumber);

			$sql = "DELETE FROM `orderdetail`
			WHERE `labcode` = 'LIPID' 
			AND `labnumber` = '$labnumber' ;";
			$delete_detail = $db->delete($sql);
			dump($delete_detail);
			
			$new_lab = array('CHOL','TRI');
			foreach( $new_lab as $lab ){
				
				$labcare_sql = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice` 
				FROM `labcare` 
				WHERE `code` = '$lab'";
				$db->select($labcare_sql);
				$lab_item = $db->get_item();

				$code = $lab_item['code'];
				$oldcode = $lab_item['oldcode'];
				$detail = $lab_item['detail'];

				$orderdetail_sql = "INSERT INTO `orderdetail` ( 
					`labnumber`,`labcode`,`labcode1`,`labname` 
				) VALUES (
					'$labnumber', '$code', '$oldcode', '".$detail."'
				);";
				$orderdetail = $db->insert($orderdetail_sql);

				dump($orderdetail);
			}
			
		}
	}
	
	exit;
} else if( $page == 'agemorethan45' ){

	$sql = "SELECT a.* 
	FROM `opcardchk` AS a 
	WHERE a.`part` = 'อบจ60' 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();

	?>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<thead>
			<tr>
				<th>#</th>
				<th>HN</th>
				<th>เลขบัตรปชช.</th>
				<th>ชื่อ</th>
				<th>สกุล</th>
				<th>อายุ</th>
				<th>หน่วยงาน</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		foreach ($items as $key => $item) {
			if( $item['branch'] == 'เบิกจ่ายตรง' && $item['course'] === 'อบจ' && $item['agey'] >= 45 ){
				?>
				<tr>
					<td><?=$i;?></td>
					<td><?=$item['HN'];?></td>
					<td><?=$item['idcard'];?></td>
					<td><?=$item['name'];?></td>
					<td><?=$item['surname'];?></td>
					<td><?=$item['agey'];?></td>
					<td><?=$item['course'];?></td>
				</tr>
				<?php
				$i++;
			}
		}
		?>
		</tbody>
	</table>
	<?php
	exit;
} else if( $page === 'depart_form' ) {

	?>
	<h3>บันทึกค่าใช้จ่าย lab</h3>
	<form action="aorborjor_print_lab.php" method="post">
		<div>
			<label for="hn">HN: </label>
			<input type="text" id="hn" name="hn">
		</div>
		<div>
			<label for="vn">VN: </label>
			<input type="text" id="vn" name="vn">
		</div>
		<div>
			<div>
				<span style="color: red;"><u>* ก่อนดีดค่าใช้จ่ายตรวจสอบให้แน่ใจก่อนว่าทะเบียนไม่ออก vn ซ้ำซ้อน หรือหลาย vn ในคนเดียวกัน</u></span>
			</div>
			<button type="submit">บันทึก คชจ.</button>
			<input type="hidden" name="action" value="save_depart">
		</div>
	</form>
	<?php

	exit;
	


}  else if( $page === 'depart_form_xray' ) {

	?>
	<h3>บันทึกค่าใช้จ่าย xray</h3>
	<form action="aorborjor_print_lab.php" method="post">
		<div>
			<label for="hn">HN: </label>
			<input type="text" id="hn" name="hn">
		</div>
		<div>
			<label for="vn">VN: </label>
			<input type="text" id="vn" name="vn">
		</div>
		<div>
			<div>
				<span style="color: red;"><u>* ก่อนดีดค่าใช้จ่ายตรวจสอบให้แน่ใจก่อนว่าทะเบียนไม่ออก vn ซ้ำซ้อน หรือหลาย vn ในคนเดียวกัน</u></span>
			</div>
			<button type="submit">บันทึก คชจ.</button>
			<input type="hidden" name="action" value="xray_depart">
		</div>
	</form>
	<?php

	exit;
	
} else if( $page === 'check_vn' ){

	$sql = "SELECT a.`HN`,a.`name`,a.`surname`,a.`exam_no`
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`
	,c.`thidate`,c.`vn`,c.`ptright`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE ( `thidate` LIKE '2560-05-03%' OR `thidate` LIKE '2560-05-04%' OR `thidate` LIKE '2560-05-11%' ) 
	 ) AS c ON c.`hn` = a.`HN` 
	WHERE a.`part` = '$part' 
	AND c.`vn` IS NOT NULL";
	// dump($sql);
	$db->select($sql);
	$items = $db->get_items();
	
	?>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<thead>
			<tr>
				<th>#</th>
				<th>HN</th>
				<th>วันที่</th>
				<th>เลขบัตรปชช.</th>
				<th>ชื่อ-สกุล</th>
				<th>labnumber</th>
				<th>VN</th>
				<th>สิทธิ</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		foreach ($items as $key => $item) {
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['HN'];?></td>
				<td><?=$item['thidate'];?></td>
				<td><?=$item['idcard'];?></td>
				<td><?=$item['name'].' '.$item['surname'];?></td>
				<td><?=$checkup_date_code.$item['exam_no'];?></td>
				<td><?=$item['vn'];?></td>
				<td><?=$item['ptright'];?></td>
			</tr>
			<?php
			$i++;
		}
		?>
		</tbody>
	</table>
	<?php
	exit;
}
	