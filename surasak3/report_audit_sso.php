<?php
session_start();
include("connect.php");

//$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
//$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];

$showdate1="1 มกราคม 2563";
$showdate2="26 สิงหาคม 2564";

?>
<style type="text/css">
<!--
body,td,th {
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
<p align="center" style="margin-top: 20px;"><strong>รายงานใบสั่งยาและใบรายงานผลทางห้องปฏิบัติการ</strong></p>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?>
</div>
<table width="98%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>ลำดับแฟ้ม</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="24%" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="13%" align="center" bgcolor="#66CC99"><strong>เลขที่บัตรประชาชน</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>ไฟล์ยา</strong></td>
    <td width="19%" align="center" bgcolor="#66CC99"><strong>ไฟล์ LAB</strong></td>
  </tr>
<?
$sql="SELECT * FROM `audit-sso`";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$med="11512_".$rows["idcard"]."_MED";
$lab="11512_".$rows["idcard"]."_LAB";
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["no"]?></td>
    <td><?=$rows["hn"]?></td>
    <td><?=$rows["ptname"]?></td>
    <td><?=$rows["idcard"]?></td>
    <td align="center"><a href="drxprint_emr_sso.php?hn=<?=$rows["hn"];?>" target="_blank"><?=$med;?></a></td>
    <td align="center"><a href="lab_lst_print_opd1_emr_sso.php?hn=<?=$rows["hn"];?>" target="_blank"><?=$lab;?></a></td>
  </tr>
<?
}
?>  
</table>
