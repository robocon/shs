<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.style1 {color: #FF0000}
.style2 {color: #0000FF}
.help{ cursor: pointer; }
</style>
</head>
<body>
<?
if($_GET["act"]=="print"){
include("connect.inc");	
$showpart=$_GET["part"];
$sql1="SELECT * FROM  out_result_chkup where hn='$_GET[hn]' and part='$showpart'";
//echo $sql1;
$query1=mysql_query($sql1)or die (mysql_error());
$arr1=mysql_fetch_array($query1);
$d=date("d");
$m=date("m");
$y=date("Y")+543;
$time=date("H:i:s");

$thidate="$d/$m/$y $time";
?>
<script type="text/javascript">
window.print();
</script>
<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN : <?=$arr1['hn'];?>&nbsp;&nbsp;(<?php echo $thidate;?>)</td>
  </tr>
<tr>
    <td>ชื่อ-นามสกุล : <?=$arr1['ptname'];?></td>
  </tr>
<tr>
  <td>ตรวจสุขภาพประจำปี (<?=$arr1['part'];?>)</td>
</tr>
  <tr>
    <td>โรคประจำตัว : <?=$arr1["prawat"];?>, แพ้ยา : <?=$arr1["allergic"];?>, นน : <?php echo $arr1["weight"];?> กก., สส : <?php echo $arr1["height"];?> ซม.</td>
  </tr>  
  <tr>
    <td>BP : <? echo $arr1["bp1"]."/".$arr1["bp2"];?> mmHg, <? if(!empty($arr1["bp3"]) || !empty($arr1["bp4"])){ ?>RE-BP : <? echo $arr1["bp3"]."/".$arr1["bp4"];?> mmHg, <? } ?> T : <?php echo $arr1["temp"];?> C, P : <?php echo $arr1["p"];?> ครั้ง/นาที</td>
  </tr>
  <tr>
    <td>R : <?php echo $arr1["rate"];?> ครั้ง/นาที, บุหรี่ : <?php echo $arr1["cigga"];?>, สุรา : <?php echo $arr1["alcohol"];?>, ออกกำลังกาย : <?php echo $arr1["exercise"];?></td>
  </tr>
<? if(!empty($arr1["comment"])){  ?>
  <tr>
    <td>หมายเหตุ : <?php echo $arr1["comment"];?></td>
  </tr>  
<? } ?>  
</table>
<? } ?>
</body>
</html>
