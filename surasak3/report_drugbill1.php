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
	font-size: 24px;
}
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>รายงานใบสั่งยาตามห้วงเวลา</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<?
$chkdate1=$_POST["year1"]."-".$_POST["month1"]."-".$_POST["date1"]." 00:00:00";
$chkdate2=$_POST["year2"]."-".$_POST["month2"]."-".$_POST["date2"]." 23:59:59";
$sql="select * from phardep where date >= '$chkdate1' and date <= '$chkdate2' and (an ='' OR an is null)";  //ผู้ป่วยนอก
//echo $sql;
$query=mysql_query($sql);
$opd=mysql_num_rows($query);

$sql1="select * from phardep where date >= '$chkdate1' and date <= '$chkdate2' and (an !='' OR an is not null) ";  //ผู้ป่วยนอก
//echo $sql1;
$query1=mysql_query($sql1);
$ipd=mysql_num_rows($query1);
$sum=$opd+$ipd;
?>  
<table width="80%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="77%">จำนวนใบสั่งยาผู้ป่วยนอก</td>
    <td width="23%" align="right"><?=$opd;?>&nbsp;&nbsp;ใบ</td>
  </tr>
  <tr>
    <td>จำนวนใบสั่งยาผู้ป่วยใน</td>
    <td align="right"><?=$ipd;?>&nbsp;&nbsp;ใบ</td>
  </tr>
  <tr>
    <td align="right"><strong>รวม</strong></td>
    <td align="right"><strong>
      <?=$sum;?>
&nbsp;&nbsp;ใบ</strong></td>
  </tr>
</table>

