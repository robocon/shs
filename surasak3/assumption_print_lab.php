<?php

include 'bootstrap.php';
$db = Mysql::load();

$checkup_date_code = '170509';
$part = 'อัสสัมชัญ60';
$title_part = 'โรงเรียนอัสสัมชัญลำปาง';
$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
$en_date = date("Y-m-d H:i:s");

$action = input('action');
if( $action === 'import' ){

	$file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	if( $content !== false ){
	
		$items = explode("\r\n", $content);
		
		$sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
		$db->select($sql);
		$chk = $db->get_item();
		$last_id = (int) $chk['lastrow'];

		foreach ($items as $key => $item) {
			
			if( !empty($item) ){
				
				++$last_id;
				list($exam_no, $name, $surname, $age, $hn) = explode(',', $item);

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
				'$part',
				'ประกันสังคม',
				NOW());
				";
				// dump($sql);
				$insert = $db->insert($sql);
				dump($insert);

				echo "<hr>";
			}
		}

	}
	header('Location: assumption_print_lab.php');
	exit;

} else if( $action === 'save_depart' ){

	$hn = input_post('hn');
	$vn = input_post('vn');
	
	$sql = "SELECT a.*
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`,b.`ptright`
	,c.`vn`
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
	WHERE a.`labnumber` = '$labnumber'";
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
	// dump($depart_sql);
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
		<a href="assumption_print_lab.php">นำเข้าข้อมูล</a>
	</li>
	<li>
		<a href="assumption_print_lab.php?page=ptright">ตรวจสอบสิทธิ</a>
	</li>
	<li>
		<a href="assumption_print_lab.php?page=sticker_lab">print sticker lab</a>
	</li>
	<li>
		<a href="assumption_print_lab.php?page=labsso">ดูรายการตรวจ</a>
	</li>
	<li>
		<a href="assumption_print_lab.php?page=order_lab" onclick="return confirm_order_lab()">Order Lab</a>
	</li>
	<!--
	<li>
		<a href="assumption_print_lab.php?page=add_lab_depart" onclick="return confirm_add_lab_depart()">ดีดค่าใช้จ่าย Lab</a>
	</li>
	-->
	<li>
		<a href="assumption_print_lab.php?page=depart_form">เพิ่มค่าlabทีละคน</a>
	</li>
	<li>
		<a href="assumption_print_lab.php?page=check_vn">ตรวจสอบ VN</a>
	</li>
</ul>
<script type="text/javascript">
	function confirm_order_lab(){
		var c = confirm("ยืนยันการ Order Lab?\nกด Cancel เพื่อยกเลิก");
		return c;
	}

	function confirm_add_lab_depart(){
		var c = confirm("ยืนยันการเพิ่มค่าใช้จ่าย Lab?");
		return c;
	}
</script>
<?php

$page = input('page');
if( empty($page) ){
	?>
	<h3>นำเข้าข้อมูล opcardchk</h3>
	<form action="assumption_print_lab.php" method="post" enctype="multipart/form-data">
		<div>
			ไฟล์นำเข้า : <input type="file" name="file">
			<div><span style="color: red; font-size: 14px;">รองรับไฟล์ .csv</span></div>
		</div>
		<div>
			<button type="submit">นำเข้า</button>
			<input type="hidden" name="action" value="import">
		</div>
		<div>
			<p>ตัวอย่างไฟล์</p>
			<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
				<tr>
					<td>#</td>
					<td>name</td>
					<td>surname</td>
					<td>age</td>
					<td>hn</td>
				</tr>
				<tr>
					<td>301</td>
					<td>ทดสอบ</td>
					<td>ทดลอง</td>
					<td>99</td>
					<td>99-9999</td>
				</tr>
			</table>
		</div>
	</form>
	<?php
}else if( $page === 'sticker_lab' ){

	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`sex`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN`
	WHERE a.`part` = '$part' 
	ORDER BY a.`row` ASC";
	
	$db->select($sql);
	$items = $db->get_items();
	
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

		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$fullname = $item['name'].' '.$item['surname'];
		$exam_no = $item['exam_no'];

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

		$list_chem = array();
		$pre_number = 0;

		foreach ($all_lists as $key => $lab) {
			
			// 
			$lab_number = $checkup_date_code.$exam_no."01";

			// ตรวจพวก chem จะตามท้ายด้วย 02
			$lab_chem = $checkup_date_code.$exam_no."02";
			
			if( $lab === 'CBC-sso' ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:20px;' face='Angsana New' size='6'>
					<center><b><?=$pre_number;?>-<?=$exam_no;?></b> <span style="font-size: 14px;">CBC</span></center>
				</font>
				<center><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_number;?>"></span></center>
				<div style="page-break-before: always;"></div>
				<?php
			}

			if( $lab === 'UA-sso' ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='5'><center><b>UA</b></center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}
			
			if( $lab === 'BS-sso' ){ $list_chem[] = 'BS'; }
			if( $lab === 'CR-sso' ){ $list_chem[] = 'CR'; }
			if( $lab === 'HDL-sso' ){ $list_chem[] = 'HDL'; }
			if( $lab === 'CHOL-sso' ){ $list_chem[] = 'CHOL'; }
			if( $lab === 'HBSAG-sso' ){ $list_chem[] = 'HBSAG'; }
			
			/*
			if( $lab === 'HBSAG-sso' ){
				++$pre_number;
				?>
				<font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='5'><center><b>HBSAG</b></center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}
			*/

			/*
			if( $lab === 'PAP-sso' ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='5'><center><b>OUTLAB</b> </center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}
			*/

			if( $lab === 'STOCB-sso' ){
				++$pre_number;
				?>
				<font style='line-height:22px;'  face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:23px;'  face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b><center></font>
				<font style='line-height:23px;'  face='Angsana New' size='5'><center><b>STOOL</b></center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}


		} // end each lab

		
		if( count($list_chem) > 0 ){
			++$pre_number;
			$chem_text = implode(',', $list_chem);
			?>
			<font style='line-height:23px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
			<font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b> <span style="font-size: 14px; line-height:11px;"><?=$chem_text;?></span></center></font>
			<center><span class='fc1-0'><img src = "barcode/labstk.php?cLabno=<?=$lab_chem;?>"></span></center>
			<div style="page-break-before: always;"></div>
			<?php
		}

	} // foreach แต่ละ user
		
} else if( $page === 'labsso' ){
	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`sex`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN`
	WHERE a.`part` = '$part' 
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
	<h3>รายการตรวจตามช่วงอายุ สำหรับผู้ประกันตน <?=$title_part;?></h3>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<thead>
			<tr>
				<th>#</th>
				<th>HN</th>
				<th>ชื่อ-สกุล</th>
				<th>รหัส</th>
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
				<th>xray</th>
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		foreach ($items as $key => $item) {
			
			$age_year = substr($item['dbirth'], 0, 4) + 543 ;
			$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
			$fullname = $item['name'].' '.$item['surname'];
			$exam_no = $item['exam_no'];

			$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['HN'];?></td>
				<td><?=$fullname;?></td>
				<td><?=$exam_no;?></td>
				<td align="center"><?=$item['agey'];?></td>
				<td align="center"><?=( in_array('CBC-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('UA-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('BS-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('CR-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('HDL-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('CHOL-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('HBSAG-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('PAP-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('STOCB-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
				<td align="center"><?=( in_array('41001-sso', $all_lists) === true ? "&#10003;" : '' );?></td>
			</tr>
			<?php
			$i++;
		}
		?>
		</tbody>
	</table>
	<?php
} else if( $page === 'order_lab' ){

	include 'includes/cu_sso.php';
	
	$sso = new CU_SSO();

	$sql = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice` 
	FROM `labcare` 
	WHERE `code` LIKE '%-sso'";
	$db->select($sql);
	$pre_lab = $db->get_items();
	
	$lab_lists = array();
	foreach( $pre_lab AS $key => $lab ){
		$code = $lab['code'];
		$lab_lists[$code] = $lab;
	}
	
	$sql = "SELECT a.*,
	b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth` 
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	WHERE a.`part` = '$part' 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();

	$clinicalinfo = "ตรวจสุขภาพประกันสังคม60";
	$en_date = date("Y-m-d H:i:s");

	foreach ($items as $key => $item) {

		$hn = $item['HN'];
		$last_labnumber = $exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$ptname = $item['name'].' '.$item['surname'];
		$gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
		$dbirth = $item['dbirth'];
		$part = $item['part'];

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

		// ตัดของ xray ออกไปก่อน
		if( ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
			unset($all_lists[$search_key]);
		}

		// ตัด pap เพราะพี่หนาไม่ได้ตรวจ
		if( ( $search_key = array_search('PAP-sso',$all_lists) ) !== false ){
			unset($all_lists[$search_key]);
		}
		// dump($all_lists);

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
		// dump($orderhead_sql);
		$orderhead = $db->insert($orderhead_sql);
		dump($orderhead);

		// กันเหนียว เผื่อลง orderhead ผิด
		$db->insert("INSERT INTO `orderhead_log`(`id`,`orderhead`,`part`)VALUES(NULL,'$labnumber','$part');");
		
		foreach ($all_lists as $key => $list) {

			$lab_item = $lab_lists[$list];

			$code = $lab_item['code'];
			$oldcode = $lab_item['oldcode'];
			$detail = $lab_item['detail'];

			$orderdetail_sql = "INSERT INTO `orderdetail` ( 
				`labnumber`,`labcode`,`labcode1`,`labname` 
			) VALUES (
				'$labnumber', '$code', '$oldcode', '".$detail."'
			);";
			// dump($orderdetail_sql);
			$orderdetail = $db->insert($orderdetail_sql);
			dump($orderdetail);
		}

		echo "<hr>";

	}

	exit;

} else if( $page === 'add_lab_depart' ){

	exit;

	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth` ,c.`vn`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN `opday` AS c ON c.`hn` = a.`HN` 
		AND c.`thidate` LIKE '2560-05-01%' 
	WHERE a.`part` = '$part' 
	AND c.`vn` IS NOT NULL 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();
	// dump($items);
	// exit;

	// ดึงรายการ พวกที่เป็น -sso ออกมาก่อน
	$sql = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice` 
	FROM `labcare` 
	WHERE `code` LIKE '%-sso'";
	$db->select($sql);
	$pre_lab = $db->get_items();
	
	$lab_lists = array();
	foreach( $pre_lab AS $key => $lab ){
		$code = $lab['code'];
		$lab_lists[$code] = $lab;
	}

	$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
	$en_date = date("Y-m-d H:i:s");
	$user_i = 1;
	$test_case = true;
	$clinicalinfo = "ตรวจสุขภาพประกันสังคม60";

	// เรียงไปทีละคน 
	foreach ($items as $key => $item) {

		// test case
		// if( empty($item['vn']) OR $test_case === false ){
		// 	continue;
		// }
		
		$hn = $item['HN'];
		$exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
		$ptname = $item['name'].' '.$item['surname'];
		$gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
		$dbirth = $item['dbirth'];

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

		// ตัดรายการของ xray ออกไป
		if( ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
			unset($all_lists[$search_key]);
		}

		// หาราคารวมเพื่อใส่ใน depart
		$price = 0;
		$yprice = 0;
		$count_item = count($all_lists);
		$vn = $item['vn'];
		$ptright = 'R07 ประกันสังคม';

		foreach ($all_lists as $key => $list) {
			$lab_item = $lab_lists[$list];
			$price += $lab_item['price'];
			$yprice += $lab_item['yprice'];
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
		// dump($depart_sql);
		$depart = $db->insert($depart_sql);
		$depart_id = $db->get_last_id();
		dump($depart_id);

		foreach ($all_lists as $key => $list) {

			$lab_item = $lab_lists[$list];
			$code = $lab_item['code'];
			$price = $lab_item['price'];
			$yprice = $lab_item['yprice'];
			$detail = $lab_item['detail'];
			
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
			$patdata = $db->insert($patdata_sql);

		} // end patdata
		
		// $runno = $runno + 1;
		$run = $db->update("UPDATE runno SET runno = $runno WHERE title='stktranx'");
		dump($run);
		// if( $user_i === 1 ){
		// 	exit;
		// }
		// $user_i++;

		echo "<hr>";
		
	} // end insert into depart & patdata
} else if( $page === 'ptright' ){

	$sql = "SELECT a.*,b.* 
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN`
	WHERE a.`part` = '$part' 
	ORDER BY a.`row` ASC";
	dump($sql);
	$db->select();
	$items = $db->get_items();

	exit;

} else if( $page === 'depart_form' ) {

	?>
	<h3>บันทึกค่าใช้จ่าย lab</h3>
	<form action="assumption_print_lab.php" method="post">
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
} else if( $page === 'check_vn' ){

	$sql = "SELECT a.`HN`,a.`name`,a.`surname` 
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`,b.`ptright`
	,c.`vn`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE `thidate` LIKE '".(date('Y')+543).date('-m-d')."%' 
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
				<th>ชื่อ-สกุล</th>
				<th>VN</th>
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
				<td><?=$item['name'].' '.$item['surname'];?></td>
				<td><?=$item['vn'];?></td>
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