<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ยกเลิกบัญชี ผป.ใน</title>
</head>
<body>
<?
 include("connect.inc");
 
 $sql="UPDATE ipacc  SET paid=NULL , billno=NULL  WHERE billno='".$_GET['billno']."' and an='".$_GET['an']."' ";
 $query=mysql_query($sql) or die (mysql_error()) ;
 
 $sql2="UPDATE ipmonrep  SET paid='0.00' , billno=NULL ,credit ='' ,credit_detail ='' WHERE billno='".$_GET['billno']."' and an='".$_GET['an']."' ";
 $query2=mysql_query($sql2) or die (mysql_error()) ;
 
 
 if($query && $query2){
	 
	 echo "<BR>บันทึกข้อมูลเรียบร้อยแล้ว";
	 echo "<BR><A HREF=\"../nindex.htm\">เมนู</A><BR>";
	 echo "<META HTTP-EQUIV='Refresh' CONTENT='3;URL=ipdate.php?'>";
 }
?>
</body>
</html>