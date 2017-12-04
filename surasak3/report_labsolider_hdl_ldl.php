<?php
session_start();
include("connect.inc"); 
?><style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center">
<strong>รายชื่อทหารที่ตรวจ LAB เพิ่มเติม (HDL, LDL) จากส่วนที่เบิกไม่ได้<strong></strong>
<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center" bgcolor="#FFCCCC"><strong>ลำดับ</strong></td>
    <td width="20%" align="center" bgcolor="#FFCCCC"><strong>วัน/เดือน/ปี</strong></td>
    <td width="10%" align="center" bgcolor="#FFCCCC"><strong>HN</strong></td>
    <td width="28%" align="center" bgcolor="#FFCCCC"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="26%" align="center" bgcolor="#FFCCCC"><strong>สังกัด</strong></td>
    <td width="10%" align="center" bgcolor="#FFCCCC"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
$sql="select * from opacc where credit='HDLCHKUP59'";
$query=mysql_query($sql); 
$num=mysql_num_rows($query); 
if(empty($num)){
echo "
	<tr>
		<td colspan='6' align='center' bgcolor='#FFCC99'>---------------------- ไม่มีข้อมูล ----------------</td>
	</tr>
";
}   
$tables=0;	
while($rows=mysql_fetch_array($query)){
$tables++;
$total=$total+$rows["price"];
$sql1="select yot,ptname,camp from chkup_solider where hn='$rows[hn]' and yearchkup='59'";
$query1=mysql_query($sql1); 
list($yot,$ptname,$camp)=mysql_fetch_array($query1);
?>  
  <tr>
    <td height="30" align="center"><?=$tables;?></td>
    <td align="center"><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$yot." ".$ptname ;?></td>
    <td><?=$camp;?></td>
    <td align="right"><?=$rows["price"];?></td>
  </tr>
<?
}
?>  
<tr>
	<td align="right" colspan="5"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><strong><?=number_format($total,2);?></strong></td>
</tr>
</table>
