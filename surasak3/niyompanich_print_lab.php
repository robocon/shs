<?php

include 'bootstrap.php';
$db = Mysql::load();

// $exam_no = 301;
$checkup_date_code = '170501';
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
			'�����ҹԪ60',
			'��Сѹ�ѧ��',
			NOW());
			";
			$insert = $db->insert($sql);
			// dump($insert);

			// $exam_no++;
			
		}
	}

	header('Location: niyompanich_print_lab.php');
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
	WHERE a.`part` = '�����ҹԪ60' 
	AND a.`HN` = '$hn' 
	AND c.`vn` = '$vn' 
	ORDER BY a.`row` ASC";
	// dump($sql);
	$db->select($sql);
	$user = $db->get_item();
	if( empty($user) ){
		echo "��辺 $vn �ͧHN $hn";
		exit;
	}

	$vn = $user['vn'];
	$ptright = $user['ptright'];
	$ptname = $user['name'].' '.$user['surname'];
	$part = $user['part'];
	
	// ��� labnumber �����¡�� lab ��������������� orderdetail
	$exam_no = $user['exam_no'];
	$labnumber = $checkup_date_code.$user['exam_no'];

	$sql = "SELECT a.`labcode`,b.`code`,b.`oldcode`,b.`detail`,b.`price`,b.`yprice`,b.`nprice` 
	FROM `orderdetail` AS a 
	LEFT JOIN `labcare` AS b ON b.`code` = a.`labcode`
	WHERE a.`labnumber` = '$labnumber'";
	$db->select($sql);
	$lab_lists = $db->get_items();

	// ���Ҥ������������ depart
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
	`doctor` = 'MD022 (����Һᾷ��)',
	`depart` = 'PATHO',
	`item` = '$count_item',
	`detail` = '��ҵ�Ǩ���������ä',
	`price` = '$price',
	`sumyprice` = '$yprice',
	`sumnprice` = '0',
	`paid` = '0',
	`idname` = '�Ѫ�� �ӿ�',
	`diag` = '��Ǩ�آ�Ҿ',
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
		`doctor` = 'MD022 (����Һᾷ��)',
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
		<a href="niyompanich_print_lab.php">����Ң�����</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=lab">print sticker lab</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=labsso">����¡�õ�Ǩ</a>
	</li>
	<!-- 
	<li>
		<a href="niyompanich_print_lab.php?page=money">�մ�������� Lab</a>
	</li>
	-->
	<li>
		<a href="niyompanich_print_lab.php?page=update_status">�ѾഷʶҹФ���赡��ҧ</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=depart_form">�������lab���Ф�</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=check_vn">��Ǩ�ͺ VN</a>
	</li>
	<!-- 
	<li>
		<a href="niyompanich_print_lab.php?page=cut_pap">�Ѵ PAP</a>
	</li>
	-->
	<li>
		<a href="niyompanich_print_lab.php?page=update_outresult">Update Out Result</a>
	</li>
</ul>
<?php

$page = input('page');
if( empty($page) ){
	?>
	<h3>����Ң����� opcardchk</h3>
	<form action="niyompanich_print_lab.php" method="post" enctype="multipart/form-data">
		<div>
			������� : <input type="file" name="file">
			<div><span style="color: red; font-size: 14px;">�ͧ�Ѻ��� csv</span></div>
		</div>
		<div>
			<button type="submit">�����</button>
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
	WHERE a.`part` = '�����ҹԪ60' 
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
		
		// $hn = $item['HN'];
		// if( $hn !== '47-21983' ){
		// 	continue;
		// }else{
		// 	$exam_no = 363;
		// }

		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === '�' ) ? 1 : 2 ;
		$fullname = $item['name'].' '.$item['surname'];
		// dump($item['age']);
		// dump($age_year);
		// dump($item);

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);
		// dump($all_lists);

		/**
		 * @todo 
		 * [/] ������������¡�� ���.
		 * [] �����¡�÷�������� labcare �ó� lab�/�͡
		 * [] �����ʵ������
		 */

		$list_chem = array();
		$pre_number = 0;

		foreach ($all_lists as $key => $lab) {
			
			// 
			$lab_number = $checkup_date_code.$exam_no."01";

			// ��Ǩ�ǡ chem �е�����´��� 02
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

			
			if( $lab === 'BS-sso' ){
				$list_chem[] = 'BS';
			}

			if( $lab === 'CR-sso' ){
				$list_chem[] = 'CR';
			}

			if( $lab === 'HDL-sso' ){
				$list_chem[] = 'HDL';
			}

			if( $lab === 'CHOL-sso' ){
				$list_chem[] = 'CHOL';
			}
			
			if( $lab === 'HBSAG-sso' ){
				$list_chem[] = 'HBSAG';
			}
	
			
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

			if( $lab === 'PAP-sso' ){
				++$pre_number;
				?>
				<font style='line-height:22px;' face='Angsana New' size='5'><center><b><?=$fullname;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='6'><center><b><?=$pre_number;?>-<?=$exam_no;?></b></center></font>
				<font style='line-height:23px;' face='Angsana New' size='5'><center><b>OUTLAB</b> </center></font>
				<div style="page-break-before: always;"></div>
				<?php
			}

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

		
		// exit;

		// if( $test_user_number == 10 ){
		// 	exit;
		// }

		$test_user_number++;

		$exam_no++;
	} // foreach ���� user
		
} else if( $page === 'labsso' ){
	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`sex`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
	WHERE a.`part` = '�����ҹԪ60' 
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
	<h3>��¡�õ�Ǩ�����ǧ���� ����Ѻ����Сѹ�� ����ѷ�����ҹԪ �ӻҧ</h3>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<thead>
			<tr>
				<th>#</th>
				<th>HN</th>
				<th>����-ʡ��</th>
				<th>����</th>
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
			$sex = ( $item['sex'] === '�' ) ? 1 : 2 ;
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

	exit;

	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth` ,c.`vn`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
	LEFT JOIN `opday` AS c ON c.`hn` = a.`hn` 
		AND c.`thidate` LIKE '2560-05-01%' 
	WHERE a.`part` = '�����ҹԪ60' 
	AND c.`vn` IS NOT NULL 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();
	// dump($items);
	// exit;

	// �֧��¡�� �ǡ����� -sso �͡�ҡ�͹
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
	$clinicalinfo = "��Ǩ�آ�Ҿ��Сѹ�ѧ��60";

	// ���§价��Ф� 
	foreach ($items as $key => $item) {

		// test case
		// if( empty($item['vn']) OR $test_case === false ){
		// 	continue;
		// }
		
		$hn = $item['HN'];
		$exam_no = $item['exam_no'];
		$labnumber = $checkup_date_code.$exam_no;
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === '�' ) ? 1 : 2 ;
		$ptname = $item['name'].' '.$item['surname'];
		$gender = ( $item['sex'] === '�' ) ? 'M' : 'F' ;
		$dbirth = $item['dbirth'];

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

		// �Ѵ��¡�âͧ xray �͡�
		if( ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
			unset($all_lists[$search_key]);
		}
		
		/*
		// orderhead
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
			'MD022 (����Һᾷ��)', 
			'R', 
			'".$clinicalinfo."'
		);";
		dump($orderhead_sql);
		$depart = $db->insert($orderhead_sql);
		// $orderhead_id = $db->get_last_id();
		
		// orderdetail
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
			$db->insert($orderdetail_sql);
		}
		*/

		// ���Ҥ������������ depart
		$price = 0;
		$yprice = 0;
		$count_item = count($all_lists);
		$vn = $item['vn'];
		$ptright = 'R07 ��Сѹ�ѧ��';

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
		`doctor` = 'MD022 (����Һᾷ��)',
		`depart` = 'PATHO',
		`item` = '$count_item',
		`detail` = '��ҵ�Ǩ���������ä',
		`price` = '$price',
		`sumyprice` = '$yprice',
		`sumnprice` = '0',
		`paid` = '0',
		`idname` = '�Ѫ�� �ӿ�',
		`diag` = '��Ǩ�آ�Ҿ',
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
			`doctor` = 'MD022 (����Һᾷ��)',
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
} else  if( $page === 'update_status' ){

	$sql = "SELECT a.* 
	FROM `opcardchk` AS a 
	WHERE a.`part` = '�����ҹԪ60' 
	AND a.`HN` NOT IN (
		'55-4126',
		'47-16316',
		'52-1508',
		'50-18441',
		'60-2882',
		'51-9550',
		'51-12418',
		'47-16929',
		'60-2634',
		'52-7009',
		'47-13232',
		'48-8964',
		'48-20239',
		'48-22174',
		'51-751'
	) 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();
	foreach ($items as $key => $item) {
		$row = $item['HN'];
		$update_sql = "UPDATE `opcardchk` SET `active` = 'y' WHERE `HN` = '$row' AND `part` = '�����ҹԪ60' ;";
		dump($update_sql);
		$update = $db->update($update_sql);
		dump($update);
	}
	exit;
	
} else if( $page === 'check_vn' ){

	$sql = "SELECT a.`HN`,a.`name`,a.`surname` 
	,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`,b.`ptright`
	,c.`vn`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
	LEFT JOIN ( 
		SELECT * FROM `opday` WHERE `thidate` LIKE '2560-05-01%' 
	 ) AS c ON c.`hn` = a.`HN` 
	WHERE a.`part` = '�����ҹԪ60' 
	#AND a.`active` != 'y' 
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
				<th>����-ʡ��</th>
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
} else if( $page === 'depart_form' ) {

	?>
	<h3>�ѹ�֡�������� lab</h3>
	<form action="niyompanich_print_lab.php" method="post">
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
				<span style="color: red;"><u>* ��͹�մ�������µ�Ǩ�ͺ�����㨡�͹��ҷ���¹����͡ vn ��ӫ�͹ �������� vn 㹤����ǡѹ</u></span>
			</div>
			<button type="submit">�ѹ�֡ ���.</button>
			<input type="hidden" name="action" value="save_depart">
		</div>
	</form>
	<?php

	exit;
} else if( $page === 'cut_pap' ) {
	
	$sql = "SELECT b.* 
	FROM ( 
		SELECT CONCAT('170501',`exam_no`) AS labnumber FROM `opcardchk` 
		WHERE `part` = '�����ҹԪ60' 
		AND `HN` IN (
			'55-4126',
			'47-16316',
			'52-1508',
			'50-18441',
			'60-2882',
			'51-9550',
			'51-12418',
			'47-16929',
			'60-2634',
			'52-7009',
			'47-13232',
			'48-8964',
			'48-20239',
			'48-22174',
			'51-751'
		) 
	 ) AS a 
	LEFT JOIN ( 
		SELECT * FROM `orderdetail` WHERE `labnumber` LIKE '170501%' 
	 ) AS b ON b.`labnumber` = a.`labnumber` 
	WHERE b.`labcode` = 'PAP-sso'";
	$db->select($sql);
	$items = $db->get_items();
	foreach ($items as $key => $item) {
		
		$del_labnumber = $item['labnumber'];
		$del_labcode = $item['labcode'];

		$sql_del = "DELETE FROM `orderdetail`
		WHERE `labnumber` = '$del_labnumber' AND `labcode` = '$del_labcode' ;";
		$delete = $db->delete($sql_del);
		dump($delete);
	}
	

}else if( $page === 'update_outresult' ){

	$sql = "SELECT b.* 
	FROM `opcardchk` AS a 
	LEFT JOIN `dxofyear_out` AS b ON b.`hn` = a.`hn` 
	WHERE a.`part` = '�����ҹԪ60' 
	AND a.`active` = 'y' ";
	$db->select($sql);
	$items = $db->get_items();
	
	

	foreach( $items AS $key => $item ){
		$hn = $item['hn'];
		$ptname = $item['ptname'];
		$age = $item['age'];
		$weight = $item['weight'];
		$height = $item['height'];
		$bp1 = $item['bp1'];
		$bp2 = $item['bp2'];
		$p = $item['pause'];
		$year_chk = '60';
		$part = '�����ҹԪ60';
		
		$sql = "INSERT INTO `out_result_chkup`
		(`row_id`,
		`hn`,
		`ptname`,
		`age`,
		`weight`,
		`height`,
		`bp1`,
		`bp2`,
		`p`,
		`year_chk`,
		`part`)
		VALUES
		(NULL,
		'$hn',
		'$ptname',
		'$age',
		'$weight',
		'$height',
		'$bp1',
		'$bp2',
		'$p',
		'$year_chk',
		'$part');
		";
		// dump($sql);
		// $insert = $db->insert($sql);
		// dump($insert);

	}

	exit;

}

// �ͧ���Է�Ԥ���赡��ҧ
/*
$sql = "SELECT a.*,b.* 
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
	WHERE a.`part` = '�����ҹԪ60' 
	AND a.`HN` IN (
		'55-4126',
		'47-16316',
		'52-1508',
		'50-18441',
		'60-2882',
		'51-9550',
		'51-12418',
		'47-16929',
		'60-2634',
		'52-7009',
		'47-13232',
		'48-8964',
		'48-20239',
		'48-22174',
		'51-751'
	) 
	ORDER BY a.`row` ASC";
*/