<?php 
	
include 'bootstrap.php';

if( isset($_SESSION['sIdname']) ){
    redirect('mb_index.php');
}

// redirect to where are you from
$match = preg_match('/login\_page/', $_SERVER['HTTP_REFERER']);
if( isset($_SERVER['HTTP_REFERER']) && $match === 0 ){
	$actual_link = "http://$_SERVER[HTTP_HOST]/sm3/surasak3/";
	$_SESSION['refer'] = str_replace($actual_link, '', $_SERVER['HTTP_REFERER']);
}

$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;
if( $action === 'login' ){
	
	$db = Mysql::load();
	
	$sql = "SELECT * FROM `inputm` 
	WHERE `idname` = :test_idname 
	AND `pword` = :test_pword 
	AND `status` = 'y'";
	
	$data = array(
		':test_idname' => trim($_POST['username']),
		':test_pword' => trim($_POST['password']),
    );

    $db->select($sql, $data);
    $item = $db->get_item();

	if( $item ){
        
        // กลุ่มที่ให้เข้าช่วงทดสอบได้
        $authenList = array('ADM','ADMDR','ADMDR1','ADMICU','ADMOBG','ADMSUR','ADMVIP','ADMWF');
        if (in_array($item['menucode'],$authenList)===false) {
            $msg = 'ใจเย็นๆ ช่วงนี้ให้ทาง Ward เข้าใช้งานได้ก่อน';
            redirect('login_mobile.php',$msg);
            exit;
        }

		// Set session to one day
		ini_set('session.gc_maxlifetime', 60*60*24);
		
		$_SESSION['sIdname'] = $item['idname'];
		$_SESSION['sPword'] = $item['pword'];
		$_SESSION['smenucode'] = $item['menucode'];
		$_SESSION['sOfficer'] = $item['name'];
		$_SESSION['sRowid'] = $item['row_id'];
		$_SESSION['sLevel'] = $item['level'];
	
		$refer = isset($_SESSION['refer']) ? $_SESSION['refer'] : 'mb_index.php';
	
		header('Location: '.$refer);
		exit;
	}else{
		
		$msg = 'ชื่อผู้ใช้งาน หรือ รหัสผ่านผิดพลาด กรุณาตรวจสอบอีกครั้ง';
		redirect('login_mobile.php',$msg);
		exit;
	}
	
}


$title = 'อินทราเน็ต รพ.ค่ายฯ';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?=$title;?></title>

    <!--[if lt IE 8]><link rel="stylesheet" href="assets/css/cascade/production/icons-ie7.min.css"><![endif]-->
    
    <!--[if lt IE 9]>
        <script src="assets/js/shim/iehtmlshiv.js"></script>
        <script src="templates/classic/respond.js"></script>
    <![endif]-->
    
    <script src="templates/classic/main.js"></script>

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-green.css">

</head>
<body>
<div class="w3-card-4">
    <div class="w3-container w3-theme w3-card">
        <h1><?=$title;?></h1>
    </div>
    <div class="w3-container w3-text-theme">
        <h2>เข้าสู่ระบบ</h2>
    </div>
    <?php
    if( isset($_SESSION['x-msg']) ){
        ?>
        <div class="w3-container">
            <div class="w3-panel w3-pale-yellow w3-border w3-border-yellow"><p><?=$_SESSION['x-msg'];?></p></div>
        </div>
        <?php
        unset($_SESSION['x-msg']);
    }
    ?>
    <form action="login_mobile.php" method="post">
        <div class="w3-container">
            <div class="w3-section">
                <label class="w3-text"><b>Username</b></label>
                <input class="w3-input w3-border" type="text" name="username">
            </div>
            <div class="w3-section">
                <label class="w3-text"><b>Password</b></label>
                <input class="w3-input w3-border" type="password" name="password">
            </div>
            <div class="w3-section">
                <button class="w3-btn w3-blue" style="width:100%">Login</button>
                <input type="hidden" name="action" value="login">
            </div>
        </div>
    </form>
</div>

</body>
</html>
