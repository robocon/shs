<?
session_start();
include("connect.inc");

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);
$datenum=ceil(($end-$start)/86400)+1;

//echo $datenum;

$sql="select * from ipacc where depart='PHAR' and (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') order by date";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);

?>
<strong><div align="center" style="margin-top: 20px;">รายงานค่ายาผู้ป่วยใน</div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>วันที่รับบริการ</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>AN</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>		
	<td width="15%" align="center" bgcolor="#66CC99"><strong>ชื่อ - สกุล</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>รหัส</strong></td>
	<td width="15%" align="center" bgcolor="#66CC99"><strong>รายการ</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>จำนวน</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>ราคา/หน่วย</strong></td>
	<td width="8%" align="center" bgcolor="#66CC99"><strong>ราคารวม</strong></td>
	<td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
  </tr>
  <?
$i=0;
$sum=0;
while($rows=mysql_fetch_array($query)){
$i++;
$sum=$sum+$rows["price"];

$date = substr($rows["date"],0,10);
$d=substr($date,8,2);
$m=substr($date,5,2);
$y=substr($date,0,4);
$visitdate="$d/$m/$y";
$unit=$rows["price"]/$rows["amount"];
$credit=$rows["credit"];
	

$sql1="select * from ipcard where an='".$rows["an"]."'";
$query1=mysql_query($sql1);
$result1=mysql_fetch_array($query1);
$hn=$result1["hn"];
$ptname=$result1["ptname"];
$ptright=$result1["ptright"];

?>
  <tr>
    <td><?=$visitdate;?></td>
	<td align="center"><?=$rows["an"];?></td>
	<td><?=$hn;?></td>	
	<td><?=$ptname;?></td>
    <td><?=$rows["code"];?></td>
	<td><?=$rows["detail"];?></td>
    <td align="center"><?=$rows["amount"];?></td>
	<td align="right"><?=number_format($unit,2);?></td>
	<td align="right"><?=number_format($rows["price"],2);?></td>
	<td><?=$ptright;?></td>
  </tr>
  <?
}
?>
</table>
