<?php

include 'bootstrap.php';
$db = Mysql::load();

$exam_no = 301;

$action = input('action');
if( $action === 'import' ){

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

			list($name, $surname, $age, $hn) = explode(',', $item);

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
			'นิยมพานิช60',
			'ประกันสังคม',
			NOW());
			";
			$insert = $db->insert($sql);
			// dump($insert);

			$exam_no++;
			
		}
	}

	header('Location: niyompanich_print_lab.php');
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
		<a href="niyompanich_print_lab.php">นำเข้าข้อมูล</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=lab">print sticker lab</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=labsso">ดูรายการตรวจ</a>
	</li>
</ul>
<?php

$page = input('page');
if( empty($page) ){
	?>
	<h3>นำเข้าข้อมูล opcardchk</h3>
	<form action="niyompanich_print_lab.php" method="post" enctype="multipart/form-data">
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
	WHERE a.`part` = 'นิยมพานิช60' 
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
		// dump($item['age']);
		// dump($age_year);
		// dump($item);

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);
		// dump($all_lists);

		/**
		 * @todo 
		 * [/] เอาอายุไปหารายการ ปกส.
		 * [] เอารายการที่ได้ไปหาใน labcare กรณี labใน/นอก
		 * [] พิมพ์สติ๊กเกอร์
		 */

		$list_chem = array();
		$pre_number = 0;

		foreach ($all_lists as $key => $lab) {
			# code...
			// $labno1="170110".$i."01";

			$lab_number = "170501".$exam_no."01";
			$lab_chem = "170501".$exam_no."02";
			
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

			$str_chem = '';
			$str_chem .= ( $lab === 'BS-sso' ) ? '' : 'BS' ;

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
	} // foreach แต่ละ user
		
} else if( $page === 'labsso' ){
	include 'includes/cu_sso.php';
	$sso = new CU_SSO();

	$sql = "SELECT a.*,b.`sex`
	FROM `opcardchk` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
	WHERE a.`part` = 'นิยมพานิช60' 
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
	<h3>รายการตรวจตามช่วงอายุ สำหรับผู้ประกันตน บริษัทนิยมพานิช ลำปาง</h3>
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
			</tr>
		</thead>
		<tbody>
		<?php
		$i = 1;
		foreach ($items as $key => $item) {
			
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
			</tr>
			<?php
			$i++;
		}
		?>
		</tbody>
	</table>
	<?php
}
	