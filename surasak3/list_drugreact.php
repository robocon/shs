<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
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
</style>
</head>

<body>

  <h1 align="center" class="font_title">รายชื่อผู้ป่วยแพ้ยา</h1>
<table border="1" cellspacing="0" cellpadding="0" style="border-collapse:collapse;"  bordercolor="#000000" class="font_title">

<tr>
<td align="center">NO.</td>
<td align="center">HN</td>
<td  align="center">ชื่อ - สกุล</td>
<td  align="center">รหัสยา</td>
<td align="center">ชื่อยา</td>
<td  align="center">อาการ</td>
</tr>
<?
$n='1';
$sqls = "select distinct(hn) from drugreact";
$row =mysql_query($sqls);
while($result = mysql_fetch_array($row)){
	$sql2 = "select *,concat(yot,' ',name,' ',surname) as ptname from opcard where hn= '".$result['hn']."'";
	$row2 =mysql_query($sql2);
	$result2 = mysql_fetch_array($row2);
	
	$sql3 = "select * from drugreact where hn= '".$result['hn']."'";
	$row3 =mysql_query($sql3);
	while($result3 = mysql_fetch_array($row3)){
		
	?>
    
    
    <tr> 
    <td><?=$n?></td>
    <td><?=$result2['hn']?></td>
    <td ><?=$result2['ptname']?></td>
    <td ><?=$result3['drugcode']?></td>
    <td ><?=$result3['tradname']?></td>
    <td ><?=$result3['advreact']?></td></tr>
   
	<?
	 $n++;
	}
}
?>
 </table>
</body>
</html>