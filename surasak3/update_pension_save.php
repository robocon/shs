<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ŧ����¹�����ºӹҭ����</title>
</head>

<body>
<?php 
include("connect.inc");
$row_id=$_GET['row_id'];
$status=$_GET['status'];

if($status=='Y'){
	$st="ŧ����¹���º��������";
}elseif($status=='N'){
	$st="¡��ԡ���ŧ����¹���º��������";
}
$update="UPDATE opcard SET pension_status='$status'  WHERE  row_id='".$row_id."' ";
$query=mysql_query($update);

//echo $update;
if($query){
echo "<h1 align=center>$st</h1>";
echo "<meta  http-equiv='refresh' content='3;url=update_pension_form.php' />";
/*//echo "<script>alert('�ѹ�֡���������� ���º��������');window.history.back();</script>";*/
}else{
echo "<h1 align=center>�������öŧ����¹��</h1>";
echo "<meta  http-equiv='refresh' content='3;url=update_pension_form.php' />";
/*//echo "<script>alert('�������ö����¹ʶҹ���');window.history.back();</script>";*/
}

include("unconnect.inc");
?>

</body>
</html>