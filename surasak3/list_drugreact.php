<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Untitled Document</title>

<style>
	.font_title{font-family:"Angsana New"; font-size:16px}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 { font-weight: bold; }

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
table tr:hover{
	background-color: #b8b8b8;
}
</style>
</head>

<body>

  <h1 align="center" class="font_title">รายชื่อผู้ป่วยแพ้ยา</h1>
<table align="center" width="100%" border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;"  bordercolor="#000000" class="font_title">

<tr>
	<td align="center">NO.</td>
	<td align="center">HN</td>
	<td align="center">ชื่อ - สกุล</td>
	<td align="center">รหัสยา</td>
	<td align="center">ชื่อยา</td>
	<td align="center" width="23%">ชื่อกลุ่ม</td>
	<td align="center" width="15%">อาการ</td>
</tr>
<?php
$n='1';
$sqls = "SELECT a.hn, a.ptname,a.idguard,b.* FROM 
( 
SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS ptname FROM opcard WHERE idcard != '' AND idguard NOT LIKE 'mx07%'
) AS a 
LEFT JOIN drugreact AS b ON a.hn = b.hn 
WHERE b.row_id IS NOT NULL 
ORDER BY b.hn ASC";
$row =mysql_query($sqls);
while($result = mysql_fetch_array($row)){

	$id = $result['row_id'];
	$hn = $result['hn'];

	$url = "drugreact_new_add.php?page=showedit&row_id=$id&hn=$hn";

	$idguard_code = substr($result['idguard'],0,4);
	$user_alert = '';
	if($idguard_code=='MX04'){
		$user_alert = ' <b style="color:red;">(เสียชีวิต)</b>';
	}
	?>
    <tr> 
    <td><?=$n?></td>
    <td>
		<a href="<?=$url;?>" title="ึคลิกเพื่อแก้ไขข้อมูล" target="_blank"><?=$result['hn']?></a>
	</td>
    <td ><?=$result['ptname'].$user_alert;?></td>
    <td>
		<a href="<?=$url;?>" title="ึคลิกเพื่อแก้ไขข้อมูล" target="_blank"><?=$result['drugcode']?></a>
	</td>
    <td ><?=$result['tradname']?></td>
    <td ><?=$result['groupname']?></td>
    <td ><?=$result['advreact']?></td></tr>
	<?php
	$n++;
}
?>
 </table>
</body>
</html>