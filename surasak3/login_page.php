<?php 
	
include 'bootstrap.php';

if( isset($_SESSION['sIdname']) ){
	redirect('../nindex.htm');
}

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
	
		$refer = isset($_SESSION['refer']) ? $_SESSION['refer'] : '../nindex.htm';
	
		header('Location: '.$refer);
	}else{
		?>
		<p>ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดพลาด กรุณาตรวจสอบอีกครั้ง</p>
		<p><a href="login_page.php">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง</p>
		<?php
		exit;
	}
	
}

$title = 'เข้าสู่ระบบ Intranet รพ.ค่ายฯ';
include 'templates/classic/header.php';
?>

<style type="text/css">
	body{
		background: #008080;
		color: #ffffff;
	}
	.form-contain{
		width: 350px;
		margin: 0 auto;
		margin-top: 1em;
		background: rgba(255, 255, 255, 0.3);
		padding: 1em;
	}
</style>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
				
				<div class="col">
					<div class="cell">
						
						<div class="form-contain">
							
						
						<h3>เข้าสู่ระบบ Intranet รพ.ค่ายฯ</h3>
						<form action="login_page.php" method="post">
							<div class="col">
								<div class="cell">
									<label for="">ชื่อผู้ใช้งาน</label>
									<input type="text" name="username">
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<label for="">รหัสผ่าน</label>
									<input type="password" name="password">
								</div>
							</div>
							<button type="submit">เข้าสู่ระบบ</button>
							<input type="hidden" name="action" value="login">
						</form>
						
						</div>
						
					</div>
				</div>

			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';