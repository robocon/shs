<?php
session_start();
include("connect.inc");
if($_POST["active"]=="add"){
	$date=(date("Y")+543)."-".date("m-d");
	$act=$_POST["act"];
	$an=$_POST["an"];
	$hn=$_POST["hn"];
	$getmonth=$_POST["month"];
	$getyear=$_POST["year"];
	$getdate=$_POST["date"];
	
	$add="insert into dgprofile_approve set date='".$date."',
										an='".$_POST["an"]."',
										period='".$_POST["period"]."',
										type='".$_POST["typemar"]."',
										nurse='".$sOfficer."',
										lastupdate='".date("Y-m-d H:i:s")."'";
	//echo $add;
	if($query=mysql_query($add)){
		echo "<script>alert('บันทึกการตรวจสอบให้ยาผู้ป่วย AN:$an ในระบบเรียบร้อย');window.location='ipd_drugmar.php?an=$an&hn=$hn&month=$getmonth&year=$getyear&date=$getdate';</script>";
	}else{
		echo "<script>alert('ผิดพลาด ไม่สามารถบันทึกการให้ตรวจสอบห้ยาผู้ป่วย AN:$an ในระบบได้');window.location='med_record_print_2023.php?act=$act&an=$an&hn=$hn&month=$getmonth&year=$getyear&date=$getdate';</script>";
	}
}
?>