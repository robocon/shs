<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$uri = explode('/', substr(dirname($_SERVER['PHP_SELF']),1));
if(isset($_SESSION['sIdname'])){
	header("Location: ".'http://'.$_SERVER['HTTP_HOST'].'/'.$uri['0'].'/nindex.htm');
	exit;
}

// redirect to where are you from
$match = preg_match('/login_page/', $_SERVER['HTTP_REFERER']);
if( isset($_SERVER['HTTP_REFERER']) && $match === 0 ){
	$actual_link = "http://".$_SERVER['HTTP_HOST']."/sm3/surasak3/";
	$_SESSION['refer'] = str_replace($actual_link, '', $_SERVER['HTTP_REFERER']);
}

$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;

if( $action === 'login' ){ 

	$username = sprintf("%s", trim($_POST['username']));
	$password = sprintf("%s", trim($_POST['password']));

	if(in_array($password, array('1234','123456','12345678'))===true){
		$_SESSION['x-msg'] = 'ไม่อนุญาตให้ใช้รหัสผ่าน 1234, 123456 หรือ 12345678 กรุณาติดต่อ Admin ประจำแผนกเพื่อแก้ไขรหัสผ่าน';
		redirect('login_page.php');
		exit;
	}
	
	$sql = sprintf("SELECT * FROM `inputm` WHERE `idname` = '%s' AND `pword` = '%s' AND `status` = 'y' LIMIT 1;", $username, $password);
	$q = $dbi->query($sql);
	if( $q->num_rows > 0 ){
		
		// Set session to one day
		ini_set('session.gc_maxlifetime', 60*60*24);
		$item = $q->fetch_assoc();
		
		$_SESSION['sIdname'] = $sIdname = $item['idname'];
		$_SESSION['sPword'] =$sPword = $item['pword'];
		$_SESSION['smenucode'] = $item['menucode'];
		$_SESSION['sOfficer'] = $item['name'];
		$_SESSION['sRowid'] = $item['row_id'];
		$_SESSION['sLevel'] = $item['level'];
		
		$qUpdate = sprintf("UPDATE `inputm` SET `last_login`=NOW() WHERE (`row_id`='%s');", $item['row_id']);
		$dbi->query($qUpdate);

		$sqlLogInputm = sprintf("INSERT INTO `log_inputm` 
		(`id`, `log_date`, `user_id`, `name`, `menucode`, `login_date`) 
		VALUES 
		(NULL, '%s', '%s', '%s', '%s', '%s');",
		(date("Y")+543).date('-m-d'),
		$item['row_id'],
		$item['name'],
		$item['menucode'],
		(date("Y")+543).date('-m-d H:i:s')
		);
		$dbi->query($sqlLogInputm);
	
		$refer = isset($_SESSION['refer']) ? $_SESSION['refer'] : '../nindex.htm';
	
		header('Location: '.$refer);
		exit;
	}else{
		$r = writeLog("Login Fail user: $username, pass: $password", 'logs/login_page.txt');

		$_SESSION['x-msg'] = 'ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดพลาด กรุณาตรวจสอบอีกครั้ง';
		redirect('login_page.php');
		exit;
	}
	
}

$title = 'เข้าสู่ระบบอินทราเน็ต รพ.ค่ายฯ';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ขอเพิ่มชื่อแพทย์</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body class="d-flex align-items-center py-4">
<style type="text/css">
	*{
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	html, body{
		height: 100%;
	}
	body{
		background: #008080;
	}
	#username{
		margin-bottom: -1px;
		border-bottom-right-radius: 0;
		border-bottom-left-radius: 0;
	}
	#password{
		margin-bottom: 10px;
		border-top-left-radius: 0;
		border-top-right-radius: 0;
	}
	
</style>
<div class="container">
	<div style="background-color:#ffffff; max-width:600px;" class="p-3 w-100 m-auto rounded-4">
		
	<div class="row">
		<div class="col-md-3 text-center">
			<img src="images/LogoFSH.jpg" alt="" width="120">
		</div>
		<div class="col-md">
			<div class="text-center"><h3><?=$title;?></h3></div>
			<?php
			if( isset($_SESSION['x-msg']) ){
				?><div class="alert alert-warning text-center"><?=$_SESSION['x-msg'];?></div><?php
				unset($_SESSION['x-msg']);
			}
			?>
			<form action="login_page.php" method="post">
			<div class="form-floating">
				<input type="text" class="form-control" id="username" name="username" placeholder="Username">
				<label for="username">ชื่อผู้ใช้งาน</label>
			</div>
			<div class="form-floating">
				<input type="password" class="form-control" id="password" name="password" placeholder="Password">
				<label for="password">รหัสผ่าน</label>
			</div>

				
			<div class="mb-2">
				<button type="submit" class="btn btn-primary w-100 py-2">เข้าสู่ระบบ</button>
				<input type="hidden" name="action" value="login">
			</div>
			</form>
		</div>
	</div>
	</div>
</div>

</body>
</html>