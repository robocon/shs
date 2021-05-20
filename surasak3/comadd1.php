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
			$sToken = "bXrbN0yds9GRmkTEX6ZLsWZh57aqmRlPbT8oBGo6MpS";
			$sMessage = iconv('TIS-620','UTF-8',"แจ้งซ่อมระบบคอมพิวเตอร์: \nผู้แจ้ง: $user\nแผนก: $depart\nหัวข้อ: $head\nรายละเอียด: $detail\n");
			$chOne = curl_init(); 
			// notify-api.line.me
			// 203.104.138.174
			curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
			curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
			curl_setopt( $chOne, CURLOPT_POST, 1); 
			curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
			$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
			curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
			curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
			$result = curl_exec( $chOne ); 
			curl_close($chOne);

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

