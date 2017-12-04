<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
	font-size:22px;
}
-->
</style>
</head>

<body>

<? 
include("Connections/connect.inc.php"); 


$slcode=$_GET['slcode'];
$sql="select * from drugslip where slcode='$slcode' ";

$result = mysql_query($sql);
$rows=mysql_num_rows($result);
$dbarr=mysql_fetch_array($result);
?>
<h1 class="h">วิธีการใช้ยา</h1>
<table width="50%"   border="1" cellpadding="0" cellspacing="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr class="h">
    <td bgcolor="#00FFFF">รหัสการใช้ยา</td>
    <td bgcolor="#00FFFF">วิธีรับประทาน</td>
    <td bgcolor="#00FFFF">จำนวนที่ใช้</td>
    <td bgcolor="#00FFFF">ช่วงเวลา</td>
  </tr>
  <tr class="h">
    <td><?=$dbarr['slcode'];?></td>
    <td><?=$dbarr['detail1'];?></td>
    <td><?=$dbarr['detail2'];?></td>
    <td><?=$dbarr['detail3'];?></td>
  </tr>
</table>
</body>
</html>