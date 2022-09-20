<?php 
session_start();
include("connect.inc");
?>
<div align="center" style="margin-top: 20px;"><strong>รายงานแสดงข้อมูลการใช้บริการผู้ป่วยนอกสิทธิประกันสังคม</strong></div>
<table width="60%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td align="center" bgcolor="#66CC99"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
$sql="CREATE TEMPORARY TABLE reportopday SELECT * 
FROM `opday`
WHERE 1 AND `thidate`
LIKE '2564%' AND `ptright`
LIKE '%ประกันสังคม%'
GROUP BY SUBSTRING( thidate, 1, 7 ),hn";
$query=mysql_query($sql);

$sql1="SELECT SUBSTRING( thidate, 1, 7 ) as servicedate, COUNT( row_id ) as amount FROM `reportopday` GROUP BY SUBSTRING( thidate, 1, 7 )";
$query1=mysql_query($sql1);
$num=mysql_num_rows($query1);
while($rows=mysql_fetch_array($query1)){
$servicedate=$rows["servicedate"];
$amount=$rows["amount"];
?>
  <tr>
    <td align="center" ><strong><?=$servicedate;?></strong></td>
    <td align="center" ><strong><?=$amount;?></strong></td>
  </tr>
<?
}
?>
</table>