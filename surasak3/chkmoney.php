<?php 
include("connect.inc");
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<div align="center">
<p align="center"><strong>รายรับผู้ป่วยนอก ระหว่างห้วงวันที่ 1 ต.ค. 55 - 30 ก.ย. 56</strong></p>
<?
$sql=mysql_query("select sum(price) as sumprice from opacc where date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
$row=mysql_fetch_array($sql);
?>
<table width="50%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><strong>ยอดรายรับทั้งหมด</strong></td>
    <td width="42%" align="right"><strong><?=number_format($row["sumprice"],2);?> บาท</strong></td>
  </tr>
<?
$sql1="select distinct(credit) as credit from opacc where date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'";
$query1=mysql_query($sql1);
while($rows1=mysql_fetch_array($query1)){
	$sql2=mysql_query("select sum(price) as sumprice from opacc where credit='".$rows1["credit"]."' and date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
	$rows2=mysql_fetch_array($sql2);
?>  
  <tr>
    <td width="6%">&nbsp;</td>
    <td width="52%"><?=$rows1["credit"];?></td>
    <td align="right"><?=number_format($rows2["sumprice"],2);?> บาท</td>
  </tr>
<?
}
?>  
</table>
********************************<br>
<?
$sql11=mysql_query("select distinct(hn) as sumhn from opday where thidate between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
$num11=mysql_num_rows($sql11);
?>
<table width="50%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="71%"><strong>จำนวน HN</strong></td>
    <td width="29%" align="right"><?=number_format($num11);?></td>
  </tr>
<?
$sql12=mysql_query("select count(row_id) as num from opday where thidate between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
$rows12=mysql_fetch_array($sql12);
?>  
  <tr>
    <td><strong>จำนวนครั้ง</strong></td>
    <td align="right"><?=number_format($rows12["num"]);?></td>
  </tr>
</table>
<br>
<hr>
<p align="center"><strong>รายรับผู้ป่วยใน ระหว่างห้วงวันที่ 1 ต.ค. 55 - 30 ก.ย. 56</strong></p>
<?
$sql3=mysql_query("select sum(price) as sumprice from ipmonrep where date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
$row3=mysql_fetch_array($sql3);
?>
<table width="50%" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td colspan="2" align="left"><strong>ยอดรายรับทั้งหมด</strong></td>
    <td width="42%" align="right"><strong><?=number_format($row3["sumprice"],2);?> บาท</strong></td>
  </tr>
<?
$sql4="select distinct(credit) as credit from ipmonrep where date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'";
$query4=mysql_query($sql4);
while($rows4=mysql_fetch_array($query4)){
	$sql5=mysql_query("select sum(price) as sumprice from ipmonrep where credit='".$rows4["credit"]."' and date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
	$rows5=mysql_fetch_array($sql5);
?>  
  <tr>
    <td width="6%">&nbsp;</td>
    <td width="52%"><?=$rows4["credit"];?></td>
    <td align="right"><?=number_format($rows5["sumprice"],2);?> บาท</td>
  </tr>
<?
}
?>  
</table>
******************************<br>
<?
$sql41=mysql_query("select distinct(hn) as sumhn from ipcard where date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
$num41=mysql_num_rows($sql41);
?>
<table width="50%" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="71%"><strong>จำนวน HN</strong></td>
    <td width="29%" align="right"><?=number_format($num41);?></td>
  </tr>
<?
$sql42=mysql_query("select count(row_id) as num from ipcard where date between '2555-10-01 00:00:00' and '2556-09-30 23:59:59'");
$rows42=mysql_fetch_array($sql42);
?>  
  <tr>
    <td><strong>จำนวนครั้ง</strong></td>
    <td align="right"><?=number_format($rows42["num"]);?></td>
  </tr>
</table>
</div>

