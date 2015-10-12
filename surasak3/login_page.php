<?php 
	
include 'bootstrap.php';

$match = preg_match('/login\_page/', $_SERVER['HTTP_REFERER']);
if( isset($_SERVER['HTTP_REFERER']) && $match === 0 ){
	$actual_link = "http://$_SERVER[HTTP_HOST]/sm3/surasak3/";
	$_SESSION['refer'] = str_replace($actual_link, '', $_SERVER['HTTP_REFERER']);
}

$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;

if( $action === 'login' ){
	
	DB::load();
	
	$sql = "SELECT * FROM `inputm` 
	WHERE `idname` = :test_idname 
	AND `pword` = :test_pword 
	AND `status` = 'y'";
	
	$data = array(
		':test_idname' => trim($_POST['username']),
		':test_pword' => trim($_POST['password']),
		);
	
	$item = DB::select($sql, $data, true);
	if( $item ){
		$_SESSION['sIdname'] = $item['idname'];
		$_SESSION['sPword'] = $item['pword'];
		$_SESSION['smenucode'] = $item['menucode'];
		$_SESSION['sOfficer'] = $item['name'];
		$_SESSION['sRowid'] = $item['row_id'];
		$_SESSION['sLevel'] = $item['level'];
	
		header('Location: '.$_SESSION['refer']);
	}else{
		?>
		<p>ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดพลาด กรุณาตรวจสอบอีกครั้ง</p>
		<p><a href="login_page.php">คลิกที่นี่</a> เพื่อเข้าสู่ระบบ</p>
		<?php
		exit;
	}
	
}

?>
<html>
	<head>
		<title>Login</title>
	</head>
	<body>
		<div>
			<form action="login_page.php" method="post">
				<label for="">ชื่อผู้ใช้งาน</label>
				<input type="text" name="username">
				
				<label for="">รหัสผ่าน</label>
				<input type="password" name="password">
				
				<button type="submit">เข้าสู่ระบบ</button>
				<input type="hidden" name="action" value="login">
			</form>
				
		</div>
	</body>
</html>
		

