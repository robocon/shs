<title>รายงานกำลังพลทหารที่เข้ารับการตรวจสุขภาพประจำปี</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
-->
</style>
<?
include("connect.inc");

$sql1="SELECT * FROM condxofyear_so WHERE camp1 ='$_GET[camp]' AND yearcheck = '$_GET[year]' group by hn order by row_id desc";
//echo $sql1;
$result=mysql_query($sql1) or die("Query condxofyear_so line 15 Error");
$num=mysql_num_rows($result);
?>
<p align="center" style="font-weight:bold;">รายงานกำลังพลทหารที่เข้ารับการตรวจสุขภาพประจำปี
<?=$showyear;?></p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">#</td>
    <td width="16%" align="center" bgcolor="#66CC99">วันที่ตรวจ</td>
    <td width="10%" align="center" bgcolor="#66CC99">HN</td>
    <td width="24%" align="center" bgcolor="#66CC99">ชื่อ-นามสกุล</td>
    <td width="17%" align="center" bgcolor="#66CC99">สังกัด</td>
    <td width="10%" align="center" bgcolor="#66CC99">อายุ</td>
  </tr>
  <?
  $i=0;
  while($rows=mysql_fetch_array($result)){
  $i++;
  ?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$rows["thidate"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["ptname"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["camp1"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["age"];?></td>
  </tr>
  <?
  }
  ?>
</table>

