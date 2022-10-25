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

			$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS";
			$sMessage = "ใบงานใหม่\nลำดับ: $row_id\nผู้แจ้ง: $user\nแผนก: $depart\nติดต่อ: $phone\nหัวข้อ: $head\nรายละเอียด: $detail";
			$chOne = curl_init(); 
			// notify-api.line.me
			// 203.104.138.174
			// curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
			curl_setopt( $chOne, CURLOPT_URL, "http://192.168.129.143/send_notify.php"); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			// curl_setopt ($chOne, CURLOPT_SSLVERSION, 6);
			curl_setopt( $chOne, CURLOPT_POST, 1); 
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage."&token=".$sToken); 
			// $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
			$headers = array( 'Content-type: application/x-www-form-urlencoded' );
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chOne ); 
			curl_close($chOne);

			// Token ห้อง IT Support
			// uQvPwVidaVmwL7BQkFuVCQVh1q7zhZbYT8lHCnTeSoG
			// ติดตามงาน IT
			// Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ
			$tokenTwo = "Lj4dFQ5pNX3PIwSEBOEG40B9rQNhsKxB3Sb8W1JzSWJ";
			$chTwo = curl_init(); 
			curl_setopt( $chTwo, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
			curl_setopt( $chTwo, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chTwo, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt( $chTwo, CURLOPT_POST, 1); 
			curl_setopt( $chTwo, CURLOPT_POSTFIELDS, "message=".$sMessage); 
			$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$tokenTwo.'', );
			curl_setopt($chTwo, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chTwo, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chTwo ); 
			curl_close($chTwo);

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

