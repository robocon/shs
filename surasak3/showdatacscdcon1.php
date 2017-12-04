<?php
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.btt{
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td height="35" align="center"><strong>รายงานยอดโอนเงินจ่ายตรงที่ค้างรับ</strong></td>
    </tr>
    <tr>
      <td align="center"><a href="../nindex.htm">&lt;&lt; เมนูหลัก</a></td>
    </tr>
  </table>
<?
$newdate=$_GET["newdate"];;

$sql = "SELECT hn, txdate, depart, detail, credit, ptright, paidcscd FROM opacc WHERE txdate like '$newdate%' && credit = 'จ่ายตรง'"; 
$query = mysql_query($sql) or die("Query failed");
$num=mysql_num_rows($query);
?>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>วัน/เดือน/ปี</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>HN</strong></td>
    <td width="26%" align="center" bgcolor="#0099CC"><strong>สิทธิ</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>Depart</strong></td>
    <td width="29%" align="center" bgcolor="#0099CC"><strong>Detail</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>ราคา</strong></td>
  </tr>
<?	
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
		$chkhn=$rows["hn"];
		$chkprice=$rows["paidcscd"];
		$sumprice=$sumprice+$chkprice;
		$ptright=$rows["ptright"];
		$detail=$rows["detail"];
		$depart=$rows["depart"];
		$price=$rows["paidcscd"];
		$txdate=substr($rows["txdate"],0,10);
		list($yy,$mm,$dd)=explode("-",$txdate);
		$yy=substr($yy,2,2);
		$chkdate="$dd/$mm/$yy";
		
		$result="SELECT hn, date, price FROM datacscdcon WHERE hn='$chkhn' && date like '$chkdate%' && price='$chkprice'";
		$tbquery=mysql_query($result);
		$num1=mysql_num_rows($tbquery);		
		$rows1=mysql_fetch_array($tbquery);
		$cscdhn=$rows1["hn"];
		$cscdprice=$rows1["price"];
		$sumcscdprice=$sumcscdprice+$cscdprice;
		
if($chkhn!=$cscdhn){
?>
<tr bgcolor="#DF626B">
    <td align="center"><?=$txdate;?></td>
    <td><?=$chkhn;?></td>
    <td><?=$ptright;?></td>
    <td><?=$depart;?></td>
    <td><?=$detail;?></td>
    <td align="right"><?=number_format($price,2);?></td>
</tr>
<?
	}
}
$total=$sumprice-$sumcscdprice;
?>
<tr bgcolor="#DF626B">
  <td colspan="5" align="right" bgcolor="#FFFFFF"><strong>รวมเป็นเงินทั้งสิ้น</strong></td>
  <td align="right" bgcolor="#0099CC"><?=number_format($total,2);?></td>
</tr>
</table>
<p align="center"><strong><a href="datacscdcon/exportdatacscdcon.php?newdate=<?=$newdate;?>" target="_blank">ส่งออกข้อมูล</a></strong></p>
