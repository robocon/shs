<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ลงทะเบียนผู้ป่วยบำนาญทหาร</title>
</head>

<body>
<?php 
include("connect.inc");
$row_id=$_GET['row_id'];
$status=$_GET['status'];

if($status=='Y'){
	$st="ลงทะเบียนเรียบร้อยแล้ว";
}elseif($status=='N'){
	$st="ยกเลิกการลงทะเบียนเรียบร้อยแล้ว";
}
$update="UPDATE opcard SET pension_status='$status'  WHERE  row_id='".$row_id."' ";
$query=mysql_query($update);

//echo $update;
if($query){
echo "<h1 align=center>$st</h1>";
echo "<meta  http-equiv='refresh' content='3;url=update_pension_form.php' />";
/*//echo "<script>alert('บันทึกข้อมูลใหม่ เรียบร้อยแล้ว');window.history.back();</script>";*/
}else{
echo "<h1 align=center>ไม่สามารถลงทะเบียนได้</h1>";
echo "<meta  http-equiv='refresh' content='3;url=update_pension_form.php' />";
/*//echo "<script>alert('ไม่สามารถเปลี่ยนสถานะได้');window.history.back();</script>";*/
}

include("unconnect.inc");
?>

</body>
</html>