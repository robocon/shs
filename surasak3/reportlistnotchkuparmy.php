<title>รายงานกำลังพลทหารที่ยังไม่ได้เข้ารับการตรวจสุขภาพประจำปี</title>
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
$nPrefix="25".$_GET["year"];
$sql1="SELECT * FROM dxofyear WHERE camp ='$_GET[camp]' AND yearchk = '$_GET[year]'";
//echo $sql1;
$result=mysql_query($sql1) or die("Query condxofyear_so line 15 Error");
$num=mysql_num_rows($result);
?>
<p align="center" style="font-weight:bold;">รายงานกำลังพลทหารที่ยังไม่ได้เข้ารับการตรวจสุขภาพประจำปี<?=$showyear;?></p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99">#</td>
    <td width="16%" align="center" bgcolor="#66CC99">วันที่ลงทะเบียน</td>
    <td width="10%" align="center" bgcolor="#66CC99">HN</td>
    <td width="24%" align="center" bgcolor="#66CC99">ชื่อ-นามสกุล</td>
    <td width="17%" align="center" bgcolor="#66CC99">สังกัด</td>
    <td width="10%" align="center" bgcolor="#66CC99">อายุ</td>
    <td width="19%" align="center" bgcolor="#66CC99">ตำแหน่ง</td>
  </tr>
  <?
  $i=0;
  while($rows=mysql_fetch_array($result)){
		  $i++;
		  
		$sql12="SELECT * FROM condxofyear_so WHERE hn ='$rows[hn]' AND yearcheck='$nPrefix' group by hn";
		//echo $sql12;
		$result12=mysql_query($sql12) or die("Query condxofyear_so line 15 Error");
		$num12=mysql_num_rows($result12);
		if($num12 < 1){
  ?>
  <tr>
    <td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
    <td align="center" bgcolor="#CCFFCC"><?=$rows["thidate"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["hn"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["yot"]." ".$rows["ptname"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["camp"];?></td>
    <td bgcolor="#CCFFCC"><?=$rows["age"];?></td>
    <td align="left" bgcolor="#CCFFCC"><?=$rows["position"];?></td>
  </tr>
  <?
		}
  	  }
  ?>
</table>

