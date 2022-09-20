<?php 
session_start();
include("connect.inc");
?>
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลการใช้บริการผู้ป่วยนอกสิทธิประกันสังคม</strong></div>
<table width="60%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>จำนวนครั้ง</strong></td>
  </tr>
<?
$sql="CREATE TEMPORARY TABLE reportopday1 SELECT * 
FROM `opday`
WHERE (`thidate` >= '2562-01-01 00:00:00' and `thidate` <= '2564-12-31 23:59:59') AND `ptright` LIKE '%ประกันสังคม%'";
$query=mysql_query($sql);

$sql1="SELECT SUBSTRING( thidate, 1, 4 ) as servicedate, COUNT( row_id ) as amount FROM `reportopday1` GROUP BY SUBSTRING( thidate, 1, 4 )";
$query1=mysql_query($sql1);
$num=mysql_num_rows($query1);
//echo $num;
while($rows=mysql_fetch_array($query1)){
$servicedate=$rows["servicedate"];
$amount=number_format($rows["amount"]);
?>
  <tr>
    <td align="center" ><strong><?=$servicedate;?></strong></td>
    <td align="center" ><strong><?=$amount;?></strong></td>
  </tr>
<?
}
?>
</table>