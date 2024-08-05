<?php
session_start();
include("connect.php");

$action = sprintf("%s", $_POST['action']);
if ( $action == 'setNewPass' && ( $newpw1 == $newpw2) ){

	$username = sprintf("%s", $_POST['user']);
    $password = sprintf("%s", $_POST['oldpass']);
    $newpw1 = sprintf("%s", $_POST['newpass']);
		$query = "SELECT * FROM inputm WHERE idname = '$username' and pword='$password'";
		$result = mysql_query($query) or die("Query failed");
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}

			if (!($row = mysql_fetch_object($result)))
				continue;
		}

		if (mysql_num_rows($result)) {


			$query = "UPDATE `inputm` SET `pword` = '$newpw1',`date_pword`='" . date("Y-m-d H:s:i") . "' WHERE `idname`= '$username' ";
			$result = mysql_query($query);
			$res = '{"status":200,"message":"เปลี่ยนรหัสผ่านเรียบร้อย"}';
			
		} else {

			$res = '{"status":400,"message":"ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง"}';
		}
		echo $res;
		exit;

}elseif($action == 'checkOldPass'){
	
	$id = sprintf("%s", $_POST['id']);
	$pass = sprintf("%s", $_POST['pass']);
	if(empty($id) OR empty($pass)){
		$res = '{"status":400,"message":"ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง"}';
	}else{
		$sql = "SELECT `row_id` FROM `inputm` WHERE `row_id` = '$id' AND `pword` = '$pass' LIMIT 1; ";
		$q = mysql_query($sql);
		$qRow = mysql_num_rows($q);
		if($qRow==0){
			$res = '{"status":400,"message":"รหัสผ่านไม่ถูกต้อง กรุณาตรวจสอบอีกครั้ง"}';
		}elseif($qRow==1){ // ถ้ามีแสดงว่ารหัสผ่านเก่าตรงกัน
			$res = '{"status":200,"message":"ยืนยันรหัสผ่านเก่าถูกต้อง"}';
		}
	}
	
	echo $res;
	exit;
}else{
    echo "<br><br><br>........รหัสผ่านใหม่ พิมพ์สองครั้งไม่เหมือนกัน ไม่สามารถเปลี่ยนได้ !<br>";
}
include("unconnect.inc");
?>