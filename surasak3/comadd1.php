<?php
session_start();
include("connect.inc");
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
//print_r($_POST);
$depart=$_POST["depart"];
$head=htmlspecialchars($_POST["head"], ENT_QUOTES);
$detail=htmlspecialchars($_POST["detail"], ENT_QUOTES);
$datetime=$_POST["datetime"];
$phone=$_POST["phone"];
$user=$_POST["user"];
$jobtype=$_POST["jobtype"];
//print_r($_POST);
if($_POST["act"]=="add"){
	$sql="select * from com_support where depart='$depart' and head='$head' and thidate='$thidate'";
	//echo $sql;
	$query=mysql_query($sql);
	$num=mysql_num_rows($query);
	if($num < 1){
		 $add = "INSERT INTO com_support(depart,head,detail,datetime,user,date,phone,user1,jobtype)
					  VALUES('$depart','$head','$detail','$datetime','$sOfficer','$thidate','$phone','$user','$jobtype');";	
					 // echo $add;  
		 if(mysql_query($add)){
			echo "ทำการเพิ่มข้อมูลเรียบร้อยแล้ว";
			echo "<meta http-equiv=\"refresh\" content=\"1;url=com_support.php\">";
		  }else { 
			echo "ไม่สามารถเพิ่มข้อมูลได้";
			echo "<meta http-equiv=\"refresh\" content=\"1;url=com_add.php\">";
			exit();			
			}
	}
}
        ?>

