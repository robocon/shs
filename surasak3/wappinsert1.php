<?php
ob_start();
session_start();
 
 
//$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

   
 include("connect.inc");
 

$count = count($_SESSION["list_code"]);


if($count > 0){
	$an=$_GET['an'];
	$bed=$_GET['cBed'];
	$bedcode=$_GET['cBedcode'];
	$cbedname=$_GET['cbedname'];
	
	$sql1="select max(no)as tno from lab_ward where an='".$_GET['an']."' ";
	$q1=mysql_query($sql1);
	$ar=mysql_fetch_array($q1);
	$num=$ar['tno']+1;
	
	

	$sql = "INSERT INTO `lab_ward` ( `no` ,`an` , `code`, `date` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
        if(!empty($_SESSION["list_code"][$n])){
                $q = "('".$num."','".$_GET['an']."', '".$_SESSION["list_code"][$n]."', '".$Thidate."')  ";
				array_push($list,$q);
		 }
        }
		
		$sql .= implode(", ",$list);

		$result = mysql_query($sql) or die("Error appoint_lab ".mysql_error());
}
       if($result){
		 echo "สั่ง LAB เรียบร้อยแล้ว";
		 echo "<META HTTP-EQUIV='Refresh' CONTENT='0;URL=ipbed1aa.php?an=$an&bad=$bed& bedcode=$bedcode&cbedname=$cbedname&no=$num'>";
		//include("ipprintlab.php");
		   
	   }else{
		   echo "เกิดข้อผิดพลาด";
		   echo "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=wpreappoi.php?an=$an'>";
	   }

?>







