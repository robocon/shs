<?php
session_start();
include("connect.inc");
require_once 'includes/config.php';
?>
<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>

<?php
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
$chkdate = (date("Y")+543).date("-m-d H:i"); 

$depart=$_POST["depart"];
$head=htmlspecialchars($_POST["head"], ENT_QUOTES);

// remove all html tags
$detail_for_line = strip_tags(html_entity_decode($_POST["detail"]),'');

$detail=htmlspecialchars($_POST["detail"], ENT_QUOTES);
$datetime=$_POST["datetime"];
$phone=$_POST["phone"];
$user=$_POST["user"];
$jobtype=$_POST["jobtype"];

function send_line_noti($sMessage, $sToken){
	$curl = curl_init(); 
	curl_setopt( $curl, CURLOPT_URL, NOTIFY_HOST."/send_notify_v2.php"); 
	curl_setopt( $curl, CURLOPT_POST, 1); 
	curl_setopt( $curl, CURLOPT_POSTFIELDS, "message=".$sMessage."&token=".$sToken); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded' ); 
	curl_setopt( $curl, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $curl ); 
	curl_close($curl); 
}

if($_POST["act"]=="add")
{
	$sql="select * from com_support where depart='$depart' and head='$head' and date LIKE '$chkdate%'";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	if($num < 1)
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
			// Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ
			$tokenTwo = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
			send_line_noti($sMessage, $tokenTwo);

			$_SESSION['supportMessage'] = "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";
			
			echo "<script>
				$(document).ready(function() {
				Swal.fire({
					title: 'บันทึกข้อมูล',
					text: 'ระบบบันทึกข้อมูลเรียบร้อย !',
					icon: 'success',
					timer: 5000,
					showConfirmButton: false
					});
				})
			</script>";
			header("refresh:2; url=com_support.php");
		}
		else
		{ 
			echo "<script>
				$(document).ready(function() {
				Swal.fire({
					title: 'ผิดพลาด',
					text: 'ระบบบันทึกข้อมูลไม่สำเร็จ !',
					icon: 'error',
					timer: 5000,
					showConfirmButton: false
					});
				})
			</script>";
			header("refresh:2; url=com_add.php");		
		}
	}
}
?>

