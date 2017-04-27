<?php

include 'bootstrap.php';
$db = Mysql::load();

$action = input('action');
if( $action === 'import' ){

	$file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);

	$sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
	$db->select($sql);
	$chk = $db->get_item();
	$last_id = (int) $chk['lastrow'];

	$exam_no = 301;
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
			'นิยมพาณิช60',
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
<ul>
	<li>
		<a href="niyompanich_print_lab.php">นำเข้าข้อมูล</a>
	</li>
	<li>
		<a href="niyompanich_print_lab.php?page=lab">print sticker lab</a>
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
	WHERE a.`part` = 'นิยมพาณิช60' 
	ORDER BY a.`row` ASC";
	$db->select($sql);
	$items = $db->get_items();
	
	foreach ($items as $key => $item) {
		
		$age_year = substr($item['dbirth'], 0, 4) + 543 ;
		$sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;

		// dump($item['age']);
		// dump($age_year);
		// dump($sex);

		$all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);
		dump($all_lists);

		/**
		 * @todo 
		 * - เอาอายุไปหารายการ ปกส.
		 * - เอารายการที่ได้ไปหาใน labcare กรณี labใน/นอก
		 * - พิมพ์สติ๊กเกอร์
		 */
		?>
		
		<?php
	}
		
}
	