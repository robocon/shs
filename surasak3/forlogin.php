<?php
session_start();
include("connect.inc");

// error_reporting(0);
if(!isset($username)){
	$username = $_POST['username'];
}

if(!isset($password)){
	$password = $_POST['password'];
}

$sIdname = $username;
$sPword = $password;

if((date("Y-m-d")>="2024-08-01") && ($sPword=="1234" || $sPword=="123456" || $sPword=="12345678")){
$sPword="xxx";  //แปลงให้เป็นรหัสอื่นๆ	
}	

session_register("sIdname");
session_register("sPword");
session_register("sRowid");

function date_diff_test($str_start, $str_end){
	$str_start = strtotime($str_start);
	$str_end = strtotime($str_end);
	$nseconds = ( $str_end - $str_start );
	$ndays = round( ($nseconds / 86400) );
	return $ndays;
}

print "<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
?>
<style type="text/css" media="screen">
	body{
		font-family: "TH SarabunPSK";
		font-size:20px;
	}
</style>
<?php 
print "<br>";
print "<font face=''><CENTER><br>";


$sql = "SELECT * FROM `inputm` WHERE `idname` = '%s' AND `pword` = '%s' AND `status` = 'y'";
$query = sprintf($sql, $sIdname, $sPword);
$_SESSION['sIdname'] = $sIdname;
$_SESSION['sPword'] = $sPword;

$result = mysql_query($query) or die( mysql_error($Conn) ); 

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

$login_status = $row->login_status;
	
$current_date = (date("Y")+543).date('-m-d H:i:s');
list($ymd) = explode(' ', $current_date);

$sRowid = false;

// มีชื่อและรหัสผ่านอยู่ในฐานข้อมูล
if(mysql_num_rows($result)){
	
	if($login_status == "1"){
		$sRowid = $row->row_id;
		mysql_query("UPDATE `inputm` SET `login_status`=0 WHERE (`row_id`='$sRowid');");
		echo "<div style='color:red;'>'".$sIdname."' Exists login!</div>";
		echo "<div style='color:red;'>ตรวจสอบพบการออกจากระบบไม่ถูกต้อง</div>";
		echo "<div style='color:red;'>หรือมีการเข้าสู่ระบบจากเครื่องอื่น</div>";
		print "<div style='color:blue;'><font face=''><a href='login.php' >กรุณาเข้าสู่ระบบใหม่</a></font></div>";
		exit();
	}else{
		//$sql=mysql_query("UPDATE inputm SET date_pword='".date("Y-m-d H:s:i")."' WHERE row_id='$sRowid'");
		$sRowid = $row->row_id;
		$sDatepass = $row->date_pword;
		$sPass = $row->pword;
		$datepass = substr($sDatepass,0,10);
		$datenow = date("Y-m-d");
		
		$df = date_diff_test($datepass, $datenow);
		
		
		
		// เพิ่ม log กรณีที่ login ผ่านเรียบร้อยแล้ว
		$user = mysql_fetch_assoc(mysql_query($query));
		
		if($user['menucode']!=='ADMDR1'){
	
			$checkDigit = preg_match('/\d+/', $sPword, $digiMatch);
			// $checkEnUpperCase = preg_match('/[a-zA-Z]+/', $sPword);
			// $checkEnLowerCase = preg_match('/[a-z]+/', $sPword);
	
	
			// ถ้า strlen($digiMatch['0']) เท่ากับ strlen($sPword) แสดงว่าใช้รหัสผ่านเป็นตัวเลขอย่างเดียว
			if($checkDigit==0 OR strlen($sPword)<8 OR strlen($digiMatch['0'])===strlen($sPword) ){
				?>
				<script>
					alert("!!! คำเตือน !!! \nรหัสผ่านของท่านไม่ปลอดภัย ไม่ควรใช้รหัสผ่านที่คาดเดาได้ง่าย เช่น\n- รหัสผ่านที่มีตัวเลขอย่างเดียว\n- 12345678 หรือ 123456789\n- วันเดือนปีเกิด หรือเบอร์โทรศัพท์");
				</script>
				<?php
			}
		}
		
		$sql = sprintf("INSERT INTO `log_inputm` (
		`log_date` ,`user_id` ,`name` ,`menucode` ,`login_date` ,`login_fail_date` ,`logout_date`
		) VALUES (
		'%s', '%s', '%s', '%s', '%s', '%s', '%s'
		);", $ymd, $user['row_id'], $user['name'], $user['menucode'], $current_date, null, null);
		$result = mysql_query($sql);
			
			// $set_user = array(
				// 'id' => $user['row_id'],
				// 'name' => $user['name'],
				// 'code' => $user['menucode'],
			// );
			// setcookie("user", serialize($set_user), time()+(3600*365), "/");
		mysql_query("UPDATE `inputm` SET `login_status`=1,`last_login`=NOW() WHERE (`row_id`='$sRowid');");
	}
}else{ //กรณีที่ login ไม่ผ่าน
	
	// ตรวจสอบเฉพาะชื่อก่อน เพราะอาจจะใส่รหัสผิด
	$sql = sprintf("SELECT `row_id`,`name`,`menucode` FROM `inputm` WHERE `idname` = '%s'", $sIdname);
	$item = mysql_fetch_assoc(mysql_query($sql));
	
	// กรณีที่มีข้อมูลจากชื่อล็อกอิน ให้เก็บรายละเอียดเช่น ไอดี, ชื่อ, เมนูโค้ด
	if($item !== false){
		
		$sql = sprintf("INSERT INTO `log_inputm` (
		`log_date` ,`user_id` ,`name` ,`menucode` ,`login_date` ,`login_fail_date` ,`logout_date`
		) VALUES (
		'%s', '%s', '%s', '%s', '%s', '%s', '%s'
		);", $ymd, $item['row_id'], $item['name'], $item['menucode'], null, $current_date, null);
		
	}else{
		
		$sql = sprintf("INSERT INTO `log_inputm` (
		`log_date` ,`user_id` ,`name` ,`menucode` ,`login_date` ,`login_fail_date` ,`logout_date`
		) VALUES (
		'%s', '%s', '%s', '%s', '%s', '%s', '%s'
		);", $ymd, null, $sIdname, null, null, $current_date, null);
		
	}
	
	$result = mysql_query($sql);
}
	
////*runno ตรวจสุขภาพ*/////////
$query = "SELECT `runno`, `prefix`  FROM `runno` WHERE `title` = 'y_chekup'";
$result = mysql_query($query) or die( mysql_error($Conn) );
// var_dump($result);
for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
	if(!($row = mysql_fetch_object($result)))
	continue;
}

$nPrefix = $row->prefix;
////*runno ตรวจสุขภาพ*/////////
	
	// tb_access น่าจะเป็นตารางแบบสอบถาม
	$query3 = "SELECT * FROM tb_assess WHERE row_id = '$sRowid' and year = '$nPrefix' ";
	$result3 = mysql_query($query3) or die( mysql_error($Conn) );
	$nrow3 = mysql_num_rows($result3);
	
	print "<font face=''><a href='menulst.php' style='font-size: 26px;'><B>เข้าสู่<BR>โปรแกรมสุรศักดิ์มนตรี 3</B></a></font>";
	print "<BR>*********";	
    print "</body>";
	if( !empty($sRowid) && ($sIdname == $sPword) ){
		echo "<script>alert('คำเตือน! รหัสผ่านของท่านยังไม่ได้เปลี่ยนแปลง กรุณาเปลี่ยนรหัสผ่านที่เมนูเปลี่ยนรหัสเพื่อความปลอดภัยของท่าน') </script>";
	}

	if($sPword=="1234" || $sPword=="123456" || $sPword=="12345678"){
		echo "<script>alert('คำเตือน! รหัสผ่านของท่านไม่ตรงตามข้อกำหนดความปลอดภัย กรุณาเปลี่ยนรหัสผ่านเพื่อความปลอดภัยของท่านก่อนวันที่ 31 ก.ค. 67 นี้เท่านั้น') </script>";
	}	


	/*echo "<script>alert('ศูนย์คอมพิวเตอร์จะทำการปรับปรุงฐานข้อมูลคอมพิวเตอร์ มีความจำเป็นปิดให้บริการเวลา 00.30 - 02.00 มีปัญหาการใช้งานติดต่อได้ที่ 6206') </script>"; */
	// include("connect.inc");  

	$sql = "Select left(prefix,2) From runno where title = 'HN' ";
	list($title_hn) = Mysql_fetch_row(Mysql_Query($sql));
	$year_now = substr(date("Y")+543,2);
	if($title_hn != $year_now){

		$sql1= "Update runno set prefix = '56-', runno = 0 where  title = 'HN' limit 1;";
		$result1 = mysql_Query($sql1);
		$sql2 = "Update runno set prefix = '56/', runno = 0 where  title = 'AN' limit 1;";
		$result2 = mysql_Query($sql2);
		$sql3 = "Update runno set prefix = '56/', runno = 0 where  title = 'nid_c' limit 1;";
		$result3 = mysql_Query($sql3);
	}
	
	include("unconnect.inc");
?>	