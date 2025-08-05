<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txt{
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
<?php
if($_GET["depart"]=="PHAR"){
	$showtext="ข้อมูลใบสั่งยา";
	$showtextdetail="ข้อมูลรายการยาที่สั่งจ่าย";
}else{
	$showtext="ข้อมูลค่าบริการทางการแพทย์";
	$showtextdetail="ข้อมูลรายการค่าบริการทางการแพทย์";
	
}
?>	
<p><strong>ค่าชดเชยทางการแพทย์ผู้ป่วยนอก สิทธิเบิกจ่ายตรง <br /></p>
<div align="center"><strong><?=$showtext;?></strong></div>
<table width="96%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#20B2AA"><strong>ลำดับ</strong></td>
    <td width="11%" align="center" bgcolor="#20B2AA"><strong>วัน/เดือน/ปี</strong></td>
    <td width="7%" align="center" bgcolor="#20B2AA"><strong>HN</strong></td>
    <td width="3%" align="center" bgcolor="#20B2AA"><strong>VN</strong></td>
    <td width="15%" align="center" bgcolor="#20B2AA"><strong>ชื่อ - นามสกุล</strong></td>
	<td width="8%" align="center" bgcolor="#20B2AA"><strong>หมวดหมู่</strong></td>
    <td width="7%" align="center" bgcolor="#20B2AA"><strong>รวมทั้งสิ้น</strong></td>
  </tr>
<?
if($_GET["depart"]=="PHAR"){
	$sql="select * from phardep where date = '".$_GET["txdate"]."' and hn = '".$_GET["hn"]."'";
}else{
	$sql="select * from depart where date = '".$_GET["txdate"]."' and hn = '".$_GET["hn"]."'";
}	
//echo $sql;
$query=mysql_query($sql);
$i=0;
$totalprice=0;
$totalpaidcscd=0;



while($rows=mysql_fetch_array($query)){
$i++;
$totalprice=$totalprice+$rows["price"];
$totalpaidcscd=$totalpaidcscd+$rows["paidcscd"];
?>  
  <tr style="background-color:<?=$bgcolor;?>">
    <td align="center"><?=$i;?></td>
	<td><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$rows["tvn"];?></td>
    <td><?=$rows["ptname"];?></td>   
	<td align="center"><?=$rows["depart"];?></td>
	<td align="right" bgcolor="#fadbd8"><strong><?=number_format($rows["price"],2);?></strong></td>
  </tr>
<?
}
?>  
</table>
<hr>
<div align="center"><strong><?=$showtextdetail;?></strong></div>
<?
if($_GET["depart"]=="PHAR"){
?>
<table width="96%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#3498DB"><strong>ลำดับ</strong></td>
	<td width="11%" align="center" bgcolor="#3498DB"><strong>วัน/เดือน/ปี</strong></td>
    <td width="8%" align="center" bgcolor="#3498DB"><strong>รหัส</strong></td>
    <td width="8%" align="center" bgcolor="#3498DB"><strong>Part</strong></td>
	<td width="15%" align="center" bgcolor="#3498DB"><strong>รายการ</strong></td>
    <td width="3%" align="center" bgcolor="#3498DB"><strong>จำนวน</strong></td>
	<td width="4%" align="center" bgcolor="#3498DB"><strong>หน่วยละ</strong></td>
    <td width="10%" align="center" bgcolor="#3498DB"><strong>รวมทั้งสิ้น</strong></td>
  </tr>
<?
$sql1="select * from drugrx where date = '".$_GET["txdate"]."' and hn = '".$_GET["hn"]."'";
//echo $sql;
$query1=mysql_query($sql1);
$i=0;
$totalprice=0;
while($rows1=mysql_fetch_array($query1)){
$i++;
$totalprice=$totalprice+$rows1["price"];
$unit=$rows1["price"]/$rows1["amount"];

							if($rows1["part"] == "DDY"){
								$style = "style='color:#008000; background-color:$bgcolor;' ";
							}elseif($rows1["part"] == "DDN" || $rows1["part"] == "DSN" || $rows1["part"] == "DPN"){
								$style = "style='color:#FF0000; background-color:$bgcolor;' ";
							}else{
								$style = "";
							}
?>
  <tr <?=$style;?>>
    <td align="center"><?=$i;?></td>
	<td><?=$rows1["date"];?></td>
	<td><a href="cscd_drug_edit.php?row_id=<?=$rows1["row_id"];?>&idno=<?=$rows1["idno"];?>"><?=$rows1["drugcode"];?></td>
	<td><?=$rows1["part"];?></td>
    <td><?=$rows1["tradname"];?></td>
    <td align="center"><?=$rows1["amount"];?></td>
	<td align="right"><?=number_format($unit,2);?></td>
	<td align="right"><?=number_format($rows1["price"],2);?></td>
  </tr>
<?
}
?>
  <tr>
    <td colspan="6" align="right"><strong>รวมเป็นเงิน</strong></td>
	<td align="right" bgcolor="#fadbd8"><strong><?=number_format($totalprice,2);?></strong></td>
  </tr>
</table>  
<?
}else{  //ค่าบริการ
?>
<table width="96%" border="1" align="center" cellpadding="5" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#3498DB"><strong>ลำดับ</strong></td>
	<td width="11%" align="center" bgcolor="#3498DB"><strong>วัน/เดือน/ปี</strong></td>
    <td width="8%" align="center" bgcolor="#3498DB"><strong>รหัส</strong></td>
    <td width="15%" align="center" bgcolor="#3498DB"><strong>รายการ</strong></td>
    <td width="3%" align="center" bgcolor="#3498DB"><strong>จำนวน</strong></td>
    <td width="10%" align="center" bgcolor="#3498DB"><strong>ราคา</strong></td>
	<td width="10%" align="center" bgcolor="#3498DB"><strong>เบิกได้</strong></td>
	<td width="10%" align="center" bgcolor="#3498DB"><strong>เบิกไม่ได้</strong></td>
  </tr>
<?	
$sql1="select * from patdata where date = '".$_GET["txdate"]."' and hn = '".$_GET["hn"]."'";	
//echo $sql;
$query1=mysql_query($sql1);
$i=0;
$totalprice=0;
$totalyprice=0;
$totalnprice=0;
while($rows1=mysql_fetch_array($query1)){
$i++;
$totalprice=$totalprice+$rows1["price"];
$totalyprice=$totalyprice+$rows1["yprice"];
$totalnprice=$totalnprice+$rows1["nprice"];
?>  
  <tr style="background-color:<?=$bgcolor;?>">
    <td align="center"><?=$i;?></td>
	<td><?=$rows1["date"];?></td>
	<td><?=$rows1["code"];?></td>
    <td><?=$rows1["detail"];?></td>
    <td align="center"><?=$rows1["amount"];?></td>
	<td align="right"><?=number_format($rows1["price"],2);?></td>
	<td align="right"><?=number_format($rows1["yprice"],2);?></td>
	<td align="right"><?=number_format($rows1["nprice"],2);?></td>
  </tr>
<?
}
?>
  <tr>
    <td colspan="5" align="right"><strong>รวมเป็นเงิน</strong></td>
	<td align="right" bgcolor="#3498DB"><?=number_format($totalprice,2);?></td>
	<td align="right" bgcolor="#3498DB"><?=number_format($totalyprice,2);?></td>
	<td align="right" bgcolor="#3498DB"><?=number_format($totalnprice,2);?></td>
  </tr>
</table>  
<?
}
?>
