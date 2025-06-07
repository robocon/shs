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
		
		// ใส่ \\ เพื่อ escape เวลาเอาไปแสดงใน js แต่ถ้าโดยปกติไม่ต้องทำแบบนี้
		$_SESSION['telegram_msg']  = "🔔 ใบงานใหม่ *ลำดับ*: $row_id \\n*ผู้แจ้ง*: $user \\n*แผนก*: $depart \\n*ติดต่อ*: $phone \\n*หัวข้อ*: $head \\n*รายละเอียด*: $detail_for_line";
		$_SESSION['supportMessage'] = "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";
	}
	else
	{ 
		$_SESSION['supportMessage'] = "ไม่สามารถเพิ่มข้อมูลได้ ".mysql_error();
	}
	header("Location: com_support.php");
}
?>

