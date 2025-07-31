<?php
include dirname(__FILE__).'/bootstrap.php';
include dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

if ($_POST["action"]=='save') {
	
	$sOfficer = $_SESSION['sOfficer'];
	$membercode = $_SESSION['sRowid'];
	$menucode = $_SESSION['smenucode'];
	$msg = "บันทึกข้อมูลเรียบร้อย";
	$statusCode = 200;
	$error = '';

	$sql = sprintf("SELECT * FROM `menu_user` WHERE `member_code` = '%s' ", $dbi->real_escape_string($_SESSION['sRowid']));
	$q = $dbi->query($sql);
	$menuRows = $q->num_rows;
	if($menuRows==0){

		// insert
		$row_ids = $_POST['row_id'];
		$i = 0;
		$saveStatus = true;
		
		foreach ($row_ids as $id) {

			$sort = $_POST['sort'][$i];
			$script = $_POST['script'][$i];
			$menu = $_POST['menu'][$i];
			$target = $_POST['target'][$i];

			$sqlInsert = "INSERT INTO `menu_user` 
			( `menu` , `link` , `user` , `menucode` , `sort` , `member_code`,`target`)
			VALUES (
			'$menu', '$script', '$sOfficer', '$menucode', '$sort', '$membercode', '$target');";
			$q = $dbi->query($sqlInsert);
			if($q==false){
				$saveStatus = false;
			}
			$i++;
		}
		
	}else{

		// update only sort
		$row_ids = $_POST['row_id'];
		$i = 0;
		$saveStatus = true;
		foreach ($row_ids as $id) {

			$sort = $_POST['sort'][$i];
			$sqlUpdate = sprintf("UPDATE `menu_user` SET `sort` = '%s' WHERE `row_id` = '%s' ", 
				$dbi->real_escape_string($sort),
				$dbi->real_escape_string($id)
			);
			$q = $dbi->query($sqlUpdate);
			if($q==false){
				$saveStatus = false;
			}
			$i++;
		}
	}

	if($saveStatus == false){
		$msg = "บันทึกข้อมูลไม่สำเร็จ";
		$error = $dbi->error;
		$statusCode = 400;
	}

	echo $json->encode(array(
		'msg'=>$msg,
		'error'=>$error,
		'status'=>$statusCode
	));
	exit;

}elseif ($_POST['action']=='del') {
	
	// delete item
	// ถ้าลบรายการไปแล้วจะต้องคืนค่าไปทางเมนุด้านขวา
	$id = $_POST['id'];
	$sql = sprintf("DELETE FROM `menu_user` WHERE `row_id` = '%s'", $dbi->real_escape_string($id));
	$q = $dbi->query($sql);
	$error = '';
	$msg = 'บันทึกข้อมูลสำเร็จ';
	$statusCode = 200;
	if($q===false){
		$error = $dbi->error();
		$msg = 'บันทึกข้อมูลไม่สำเร็จ';
		$statusCode = 400;
	}

	echo $json->encode(array(
		'msg'=>$msg,
		'error'=>$error,
		'status'=>$statusCode
	));
	exit;
}elseif ($_POST['action']=='insert_one'){
	
	$menu = $dbi->real_escape_string($_POST['menu']);
	$script = $dbi->real_escape_string($_POST['script']);
	$sOfficer = $dbi->real_escape_string($_SESSION['sOfficer']);
	$smenucode = $dbi->real_escape_string($_SESSION['smenucode']);
	$sort = $dbi->real_escape_string($_POST['sort']);
	$sRowid = $dbi->real_escape_string($_SESSION['sRowid']);
	$target = $dbi->real_escape_string($_POST['target']);

	$sql = sprintf("INSERT INTO `menu_user` ( `menu`, `link`, `user`, `menucode`, `sort`, `member_code`, `target`) 
	VALUE 
	('%s', '%s', '%s', '%s', '%s', '%s', '%s')", 
	$menu, $script, $sOfficer, $smenucode, $sort, $sRowid, $target);
	$q = $dbi->query($sql);

	$error = '';
	$msg = 'บันทึกข้อมูลสำเร็จ';
	$statusCode = 200;
	
	if($q==false){
		$error = $dbi->error();
		$msg = 'บันทึกข้อมูลไม่สำเร็จ';
		$statusCode = 400;
	}
	echo $json->encode(array(
		'msg'=>$msg,
		'error'=>$error,
		'status'=>$statusCode
	));
	
	exit;
}