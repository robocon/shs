<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.f1{
	font-family:"Angsana New";
	font-size:18px;
	font-weight:bold;
}
.f2{
	font-family:"Angsana New";
	font-size:18px;
}
</style>
<body>
<a href="com_error.php">บันทึก</a>
<?php 
include("connect.inc");

$sql="SELECT * from com_error order by regisdate desc";
$result=mysql_query($sql) or die (mysql_error());
?>
<table  border="1" style="border-collapse:collapse" bordercolor="#000000" cellpadding="0" cellspacing="0" >
  <tr class="f1">
  <td align="center" bgcolor="#CCCCCC">#	</td>
    <td align="center" bgcolor="#CCCCCC">วันเวลา</td>
    <td align="center" bgcolor="#CCCCCC">อาการ</td>
    <td align="center" bgcolor="#CCCCCC">สาเหตุ</td>
    <td align="center" bgcolor="#CCCCCC">การแก้ไข</td>
    <td align="center" bgcolor="#CCCCCC">ผู้รับผิดชอบ</td>
    <td align="center" bgcolor="#CCCCCC">ระดับความรุนแรง</td>
    <td align="center" bgcolor="#CCCCCC">พิมพ์</td>
  </tr>
  
  <? 
  $x=1;
  while($arr=mysql_fetch_array($result)){
  ?>
  <tr class="f2">
    <td><?=$x;?></td>
    <td><?=$arr['com_date'];?></td>
    <td><?=$arr['symptoms'];?></td>
    <td><?=$arr['cause'];?></td>
    <td><?=$arr['correction'];?></td>
    <td><?=$arr['staff'];?></td>
    <td><?=$arr['level'];?></td>
    <td><a href="com_form_report.php?row=<?=$arr['row_id'];?>" target="_blank">พิมพ์</a></td>
  </tr>
  <? 
  $x++;
  } 
  ?>
</table>
</body>
</html>