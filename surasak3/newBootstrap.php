<?php 
// Set about php.ini
error_reporting(1);
ini_set('display_errors', 1);
session_start();

include_once dirname(__FILE__).'/includes/config.php';
include_once dirname(__FILE__).'/includes/functions.php';

// Define the __autoload function
spl_autoload_register(function ($className) {
    // Construct the file path based on the class name
    $file =  dirname(__FILE__).'/newClasses/' . $className . '.php';

    // Check if the file exists and include it
    if (file_exists($file)) {
        require_once $file;
    }
});

if(PHP_VERSION_ID<50329 && empty($Conn)){
	$Conn = mysql_connect(HOST, USER, PASS) or die( 'Error Connection: '.mysql_error().' HOST:'.HOST );
	mysql_select_db(DB, $Conn) or die( 'MySQL Selected DB Error: '.mysql_error() );
	mysql_query("SET NAMES UTF8", $Conn);
}

if(empty($dbi)){
	$dbi = new mysqli(HOST,USER,PASS,DB,PORT);
	if ($dbi->error) {
		dump('MySQLi Error Connection: '. $dbi->error);
		exit;
	}
	$dbi->query("SET NAMES UTF8");
	$dbi->set_charset('utf8');
}

// E.g. http://localhost/
define('DOMAIN', ( strtolower(getenv('HTTPS')) == 'on' ? 'https' : 'http' ).'://'.getenv('HTTP_HOST').'/');
define('WEB_REQUEST', substr(getenv('REQUEST_URI'), 1));

// E.g. http://localhost/sub_folder
define('DOMAIN_PATH', DOMAIN.dirname(WEB_REQUEST));

// E.g. http://localhost/sub_folder/file.php
define('DOMAIN_REQUEST', DOMAIN.WEB_REQUEST);

// ถ้าใน Cookie มีการติ๊กให้จำรหัสผ่าน จะดึงค่าใน cookie กลับมา Login ใหม่อีกครั้ง
if($_COOKIE['shsLogin']==='1'){
	list($userTxt, $idTxt) = explode(',', $_COOKIE['shsLoginUser']);
	list($xx, $user) = explode('=', $userTxt);
	$sql = sprintf("SELECT * FROM `inputm` WHERE `idname` = '%s' AND `status` = 'y' LIMIT 1;", $dbi->real_escape_string($user));
	$q = $dbi->query($sql);
	if($q->num_rows>0){
		$a = $q->fetch_assoc();

		ini_set('session.gc_maxlifetime', 60*60*24);
		
		$sIdname = $_SESSION['sIdname'] = $a['idname'];
		$_SESSION['sPword'] = $a['pword'];
		$_SESSION['smenucode'] = $a['menucode'];
		$_SESSION['sOfficer'] = $a['name'];
		$_SESSION['sRowid'] = $a['row_id'];
		$_SESSION['sLevel'] = $a['level'];

		setcookie('shsLogin','1',strtotime("+1 day"),'/');
		setcookie('shsLoginUser','name='.$sIdname.',id='.$a['row_id'],strtotime("+1 day"),'/');

	}
}
