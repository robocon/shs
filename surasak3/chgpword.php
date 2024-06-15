<?php
session_start();
include("connect.inc");


if ($newpw1 == $newpw2) {

    $password = sprintf("%s", $_POST['password']);
    $newpw1 = sprintf("%s", $_POST['newpw1']);
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

			$sPword = $newpw1;

			$query = "UPDATE inputm SET pword = '$newpw1',date_pword='" . date("Y-m-d H:s:i") . "' WHERE idname= '$username' ";
			$result = mysql_query($query) or die("รหัสผ่านซ้ำที่มีอยู่เดิม ไม่สามารถเปลี่ยนรหัสผ่านได้");

			echo "<script>alert('เปลี่ยนรหัสผ่านเรียบร้อย');window.location='../display.php';</script>";
		} else {
			echo "<br><br><br>........ชื่อผู้ใช้หรือรหัสผ่านเดิมไม่ถูกต้อง  ไม่สามารถเปลี่ยนรหัสผ่านได้ !<br>";
		}

}else{
    echo "<br><br><br>........รหัสผ่านใหม่ พิมพ์สองครั้งไม่เหมือนกัน ไม่สามารถเปลี่ยนได้ !<br>";
}
include("unconnect.inc");
?>