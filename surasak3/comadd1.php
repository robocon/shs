<?php
include 'connect.php';
include 'bootstrap.php';
?>
<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>

<?php
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$chkdate = (date("Y")+543).date("-m-d H:i"); 

$depart=sprintf("%s", $_POST["depart"]);
$head=htmlspecialchars($_POST["head"], ENT_QUOTES);

// remove all html tags
$detail_for_line = strip_tags(htmlspecialchars_decode($_POST["detail"]),'');

// ลบ tag ทั้งหมดออกเหลือแค่ img กับ <br>
$detail = strip_tags(htmlspecialchars_decode($_POST["detail"]),'<img><br>');
$detail = htmlspecialchars($detail, ENT_QUOTES);

$datetime = sprintf("%s", $_POST["datetime"]);
$phone = sprintf("%s", $_POST["phone"]);
$user = sprintf("%s", $_POST["user"]);
$jobtype = sprintf("%s", $_POST["jobtype"]);

if($_POST["act"]=="add")
{
	$add = "INSERT INTO `com_support`(`depart`,`head`,`detail`,`datetime`,`user`,`date`,`phone`,`user1`,`jobtype`)
	VALUES('$depart','$head','$detail','$datetime','$sOfficer','$thidate','$phone','$user','$jobtype');";	
	if(mysql_query($add))
	{ 
		$row_id = mysql_insert_id();

		// Lineกลุ่มห้องคอมฯ
		$sToken = "VNOr3viB2SShjl9UTqHy9H6Rksclxyhq1dAQXbAB3FZ";
		$sMessage = "ใบงานใหม่\nลำดับ: $row_id\nผู้แจ้ง: $user\nแผนก: $depart\nติดต่อ: $phone\nหัวข้อ: $head\nรายละเอียด: $detail_for_line";
		send_line_noti($sMessage, $sToken);

		// ติดตามงาน IT
		$tokenTwo = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
		send_line_noti($sMessage, $tokenTwo);

		$_SESSION['supportMessage'] = "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";
	}
	else
	{ 
		$_SESSION['supportMessage'] = "ไม่สามารถเพิ่มข้อมูลได้ ".mysql_error();
	}
	header("Location: com_support.php");
}
?>

