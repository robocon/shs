<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานค่ายาตามสิทธิ</title>
<style type="text/css">
<!--
body {
	font-family: TH SarabunPSK;
	font-size: 18px;
}

.frmthai {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
</head>
<?php
    include("connect.inc");
?>
<body>

<div align="center">แบบฟอร์มข้อมูลกำลังพลที่เข้าร่วมโครงการทหารไทยหัวใจแข็งแรง</div>
<table width="80%" border="1" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="8%" align="center" bgcolor="#66CC99"><strong>#</strong></td>
    <td width="37%" align="center" bgcolor="#66CC99"><strong>ชื่อ-สกุล</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>สังกัด</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>เพศ</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>โรคประจำตัว</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>อายุ</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>รอบเอว(นิ้ว)</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>ส่วนสูง(ซม.)</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>BP</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>FBS</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>ประวัติสูบบุหรี่</strong></td>
    <td width="55%" align="center" bgcolor="#66CC99"><strong>CHOL</strong></td>
  </tr>
<?
$sql="SELECT * 
FROM `armychkup`
WHERE `age` >=50 AND (
glu_result >=200 || chol_result >=100
) and (camp !='' and camp!='D34 กทพ.33')";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
if($rows["gender"]=="1"){
	$gender="ชาย";
}else{
	$gender="หญิง";
}

if($rows["cigarette"]=="0"){
	$cigarette="ไม่เคยสูบ";
}else if($rows["cigarette"]=="1"){
	$cigarette="เคยสูบ แต่เลิกแล้ว";
}else if($rows["cigarette"]=="2"){
	$cigarette="สูบบุหรี่ เป็นครั้งคราว";
}else if($rows["cigarette"]=="3"){
	$cigarette="สูบบุหรี่ เป็นประจำ";
}

if($rows["prawat"]=="0"){
	$prawat="ไม่มีโรคประจำตัว";
}else if($rows["prawat"]=="1"){
	$prawat="ความดันโลหิตสูง";
}else if($rows["prawat"]=="2"){
	$prawat="เบาหวาน";
}else if($rows["prawat"]=="3"){
	$prawat="โรคหัวใจและหลอดเลือด";
}else if($rows["prawat"]=="4"){
	$prawat="ไขมันในเลือดสูง";
}else if($rows["prawat"]=="5"){
	if(!empty($rows["prawat_ht"])){
		$prawat="ความดันโลหิตสูง ";
	}else if(!empty($rows["prawat_dm"])){
		$prawat="เบาหวาน ";
	}else if(!empty($rows["prawat_cad"])){
		$prawat="โรคหัวใจและหลอดเลือด ";
	}else if(!empty($rows["prawat_dlp"])){
		$prawat="ไขมันในเลือดสูง";
	}
}else if($rows["prawat"]=="6"){
	$prawat=$rows["congenital_disease"];
}else{
	$prawat="ไม่มีโรคประจำตัว";
}
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["yot"]."".$rows["ptname"];?></td>
    <td><?=$rows["camp"];?></td>
    <td><?=$gender;?></td>
    <td><?=$prawat;?></td>
    <td><?=$rows["age"];?></td>
    <td><?=$rows["waist"];?></td>
    <td><?=$rows["height"];?></td>
    <td><?=$rows["bp1"];?></td>
    <td><?=$rows["glu_result"];?></td>
    <td><?=$cigarette;?></td>
    <td><?=$rows["chol_result"];?></td>
  </tr>
  <?
  }
  ?>
</table>

</body>
</html>
