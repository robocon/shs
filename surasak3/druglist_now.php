<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>บัญชีรายการยาที่ใช้งานปัจจุบัน</title>
</head>
<style>
.font1{
	font-family:"Angsana New";
	font-size:16px;
}
</style>
<body>

<?
 include("connect.inc");
$sql ="SELECT drugcode, tradname, genname, part  FROM `druglst` WHERE usercontrol != '' ORDER BY part ASC";

$query=mysql_query($sql);
?>
<table width="100%" border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="font1">
  <tr bgcolor="#CCCCCC">
    <td width="5%" align="center">ลำดับ</td>
    <td width="10%" align="center">รหัสยา</td>
    <td width="20%" align="center">ชื่อการค้า</td>
    <td width="20%" align="center">ชื่อสามัญ</td>
    <td width="5%" align="center">part</td>
    <td width="10%" align="center">&nbsp;</td>
    <td width="10%" align="center">&nbsp;</td>
    <td width="10%" align="center">&nbsp;</td>
    <td width="10%" align="center">&nbsp;</td>
  </tr>
  <? 
  $i=1;
  while($arr=mysql_fetch_array($query)){?>
  <tr>
    <td><?=$i;?></td>
    <td><?=$arr['drugcode']?></td>
    <td><?=$arr['tradname']?></td>
    <td><?=$arr['genname']?></td>
    <td><?=$arr['part']?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  
  <?
  $i++;
  } ?>
</table>

</body>
</html>