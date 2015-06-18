<?php
session_start();

error_reporting(1);
ini_set('display_errors', 1);

// phpinfo();

require "includes/functions.php";

// var_dump(PHP_VERSION_ID);
if(PHP_VERSION_ID <= 50217){
	
	$sIdname = $username;
	$sPword = $password;
	
	session_register("sIdname");
	session_register("sPword");
	session_register("sRowid");
	
	include("connect.inc");
	
}else{
	
	require "connect.php";
	
	$_SESSION['sIdname'] = null;
	$_SESSION['sPword'] = null;
	$_SESSION['sRowid'] = null;
	
	$sIdname = $_POST['username'];
	$sPword = $_POST['password'];
	
	// var_dump($_POST);
}
	
	// function date_diff($str_start, $str_end){
		// $str_start = strtotime($str_start);
		// $str_end = strtotime($str_end);
		// $nseconds = $str_end-$str_start;
		// $ndays = round($nseconds/86400);
		
		// return $ndays;
	// }
	
	
	
    print "<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00'>";
    print "<br>";
    print "<font face='THSarabunPSK'><CENTER><br>";
	
	
	// $sql = sprintf(
		// "SELECT * FROM `inputm` WHERE `idname` = '%s' AND `pword` = '%s' AND `status` = 'y' LIMIT 1", 
		// mysql_real_escape_string($sIdname), 
		// mysql_real_escape_string($sPword)
	// );
	// $query = mysql_query($sql);
	
	$sql = clean_sql("SELECT * FROM `inputm` WHERE `idname` = ':user' AND `pword` = ':pass' AND `status` = 'y' LIMIT 1", 
		array(
			':user' => $sIdname,
			':pass' => $sPword,
		)
	);
	
    $result = mysql_query($sql) or die( mysql_error($Conn) ); 
	$count_user = mysql_num_rows($result);
	
	// มีชื่อและรหัสผ่านอยู่ในฐานข้อมูล
    if($count_user > 0){
		
		$current_date = (date("Y")+543).date('-m-d H:i:s');
		list($ymd) = explode(' ', $current_date);
	
		$row = mysql_fetch_object($result);
		
		$sRowid = $row->row_id;
		$sDatepass = $row->date_pword;
		$sPass = $row->pword;
		if($sPass == "1234"){
			?>
			<script type="text/javascript">
			if(confirm('รหัสผ่านของท่านยังเป็นค่าเริ่มต้น (1234) กรุณาเปลี่ยนรหัสผ่านใหม่เพื่อความปลอดภัย')){
				window.open('newpw.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
			}
			</script>		
			<?php
        }
		
		$datepass=substr($sDatepass,0,10);
		$datenow=date("Y-m-d");
		
		$df=date_diff($datepass, $datenow);
		if($df > 30){
			?>
			<script type="text/javascript">
			if(confirm('ขณะนี้ท่านได้ใช้ Password เดิมเกินระยะเวลาที่กำหนดแล้ว ขอให้ท่านทำการเปลี่ยน Password ใหม่ เพื่อความปลอดภัยในการใช้งานระบบด้วยครับ เปลี่ยนรหัสผ่านกด OK หรือ ใช้รหัสผ่านเดิมกด CANCLE')){
				window.open('newpw.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
			}
			</script>			
			<?php
        }
		
		// เพิ่ม log กรณีที่ login ผ่านเรียบร้อยแล้ว
		$user = mysql_fetch_assoc(mysql_query($query));
		$sql = sprintf("INSERT INTO `smdb`.`log_inputm` (
`log_date` ,`user_id` ,`name` ,`menucode` ,`login_date` ,`login_fail_date` ,`logout_date`
)
VALUES (
'%s', '%s', '%s', '%s', '%s', '%s', '%s'
);", $ymd, $user['row_id'], $user['name'], $user['menucode'], $current_date, null, null);
		$result = mysql_query($sql);
		
		// เก็บค่า browser จากผู้ใช้งานเพื่อทำเป็นสถิติ
		$client = $_SERVER['HTTP_USER_AGENT'];
		$browser_sql = sprintf("INSERT INTO `browser_log` (
`client` ,
`login_time`
)
VALUES (
'$client', NOW()
);");
		mysql_query($browser_sql);
		
		// $set_user = array(
			// 'id' => $user['row_id'],
			// 'name' => $user['name'],
			// 'code' => $user['menucode'],
		// );
		// setcookie("user", serialize($set_user), time()+(3600*365), "/");
		
	}else{ //กรณีที่ login ไม่ผ่าน
	
		// ตรวจสอบเฉพาะชื่อก่อน เพราะอาจจะใส่รหัสผิด
		$sql = sprintf("SELECT `row_id`,`name`,`menucode` FROM `inputm` WHERE `idname` = '%s'", $sIdname);
		$item = mysql_fetch_assoc(mysql_query($sql));
		
		// กรณีที่มีข้อมูลจากชื่อล็อกอิน ให้เก็บรายละเอียดเช่น ไอดี, ชื่อ, เมนูโค้ด
		if($item !== false){
			
			$sql = sprintf("INSERT INTO `smdb`.`log_inputm` (
			`log_date` ,`user_id` ,`name` ,`menucode` ,`login_date` ,`login_fail_date` ,`logout_date`
			)
			VALUES (
			'%s', '%s', '%s', '%s', '%s', '%s', '%s'
			);", $ymd, $item['row_id'], $item['name'], $item['menucode'], null, $current_date, null);
			
		}else{
			
			$sql = sprintf("INSERT INTO `smdb`.`log_inputm` (
			`log_date` ,`user_id` ,`name` ,`menucode` ,`login_date` ,`login_fail_date` ,`logout_date`
			)
			VALUES (
			'%s', '%s', '%s', '%s', '%s', '%s', '%s'
			);", $ymd, null, $sIdname, null, null, $current_date, null);
			
		}
		
		$result = mysql_query($sql);
		
		echo 'ชื่อผู้ใช้งาน และรหัสผ่านไม่ถูกต้อง <br><a href="login.php">คลิกที่นี่เพื่อเข้าสู่ระบบใหม่</a>';
		exit;
	}
	
	////runno ตรวจสุขภาพ/////////
	$query = "SELECT `runno`, `prefix`  FROM `runno` WHERE `title` = 'y_chekup'";
	$result = mysql_query($query) or die( mysql_error($Conn) );
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	////runno ตรวจสุขภาพ/////////
	
	$query3 = "SELECT * FROM tb_assess WHERE row_id = '$sRowid' and year = '$nPrefix' ";
	$result3 = mysql_query($query3) or die( mysql_error($Conn) );
	$nrow3 = mysql_num_rows($result3);
	if($nrow3==0){
		?>
		<script>
		alert('ขอความร่วมมือช่วยตอบแบบสอบถามความพึงพอใจ\nระบบโปรแกรมของโรงพยาบาลเพื่อนำไปพัฒนาให้ดียิ่งขึ้นครับ');
        window.open('assess/question_com.php' , '','nenuber=no,toorlbar=no,location=no,scrollbars=yes, status=no,resizable=no,width=800,height=600,top=220,left=650 ' );
        </script>
        
		<?php
		print "<font face='THSarabunPSK'><a href='assess/question_com.php' target='_blank' ><br><B>แบบสอบถามความพึงพอใจ<br>ระบบโปรแกรมโรงพยาบาล</B></a></font><br><br>";
		
	}
	
	print "<font face='THSarabunPSK'><a href='menulst.php' ><B>เข้าสู่<BR>โปรแกรมสุรศักดิ์มนตรี 3</B></a></font>";
	print "<BR>*********";	
    print "</body>";
	if($sIdname==$sPword){echo "<script>alert('คำเตือน! รหัสผ่านของท่านยังไม่ได้เปลี่ยนแปลง กรุณาเปลี่ยนรหัสผ่านที่เมนูเปลี่ยนรหัสเพื่อความปลอดภัยของท่าน') </script>";};

	// echo "<script>alert('ศูนย์คอมพิวเตอร์จะทำการปรับปรุงฐานข้อมูลคอมพิวเตอร์ มีความจำเป็นปิดให้บริการเวลา 00.30 - 02.00 มีปัญหาการใช้งานติดต่อได้ที่ 6206') </script>";
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
	
	// include("unconnect.inc");
	
	
?>