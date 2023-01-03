<?php
session_start();
include("connect.inc");
$thidate = (date("Y")+543).date("-m-d H:i:s"); 

$depart=$_POST["depart"];
$head=htmlspecialchars($_POST["head"], ENT_QUOTES);
$detail=htmlspecialchars($_POST["detail"], ENT_QUOTES);
$datetime=$_POST["datetime"];
$phone=$_POST["phone"];
$user=$_POST["user"];
$jobtype=$_POST["jobtype"];

function send_line_noti($sMessage, $sToken){
	$curl = curl_init(); 
	curl_setopt( $curl, CURLOPT_URL, "http://192.168.129.143/send_notify_v2.php"); 
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
	$sql="select * from com_support where depart='$depart' and head='$head' and thidate='$thidate'";
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	if($num < 1)
	{
		$add = "INSERT INTO com_support(depart,head,detail,datetime,user,date,phone,user1,jobtype)
		VALUES('$depart','$head','$detail','$datetime','$sOfficer','$thidate','$phone','$user','$jobtype');";	
		if(mysql_query($add))
		{ 
			$row_id = mysql_insert_id();

			// Lineกลุ่มห้องคอมฯ
			$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS";
			$sMessage = "ใบงานใหม่\nลำดับ: $row_id\nผู้แจ้ง: $user\nแผนก: $depart\nติดต่อ: $phone\nหัวข้อ: $head\nรายละเอียด: $detail";
			send_line_noti($sMessage, $sToken);

			// ติดตามงาน IT
			// Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ
			$tokenTwo = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
			send_line_noti($sMessage, $tokenTwo);

			$_SESSION['supportMessage'] = "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";

			echo "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";
			echo "<meta http-equiv=\"refresh\" content=\"1;url=com_support.php\">";
		}
		else
		{ 
			echo "ไม่สามารถเพิ่มข้อมูลได้";
			echo "<meta http-equiv=\"refresh\" content=\"2;url=com_add.php\">";
			exit();			
		}
	}
}
?>

