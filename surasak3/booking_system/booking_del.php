<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ź�����š�èͧ</title>
</head>

<body>
<?
include("../Connections/connect.inc.php"); 

$id_del=$_GET['id_del'];
$sql="delete from booking where row_id='$id_del' ";
$result=mysql_query($sql);


if ($result) {
	echo "ź������㺨ͧ��§���º��������";	
	echo "<meta http-equiv='refresh' content='2; url=booking_chk.php'>" ;
} else {
	echo "<script>alert ('�������öź��������');window.history.back();</script>";
}
mysql_close();
?>
</body>
</html>