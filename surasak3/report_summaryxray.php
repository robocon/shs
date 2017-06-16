<?
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>Untitled Document</title>
<style type="text/css">
.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 18pt;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 14pt;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 12pt;
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
.style2 {
	font-family: "TH SarabunPSK";
	font-size: 16px
}
</style>
</head>
<body>
<table>
<tr>
	<td>วันที่</td>
	<td>08.00-16.00 น.</td>
	<td>16.00-08.00 น.</td>
	<td>00.00-08.00 น.</td>
</tr>
<?
$sql="SELECT substring( date, 1, 10 ) as newdate
FROM `xray_doctor`
WHERE date
BETWEEN '2560-05-01 00:00:00' AND '2560-05-31 23:59:59'
GROUP BY substring( date, 1, 10 ) ";
$query=mysql_query($sql);
while($rows=mysql_fetch_array($query)){
$newdate=$rows["newdate"];
?>
<tr>
	<td><?=$newdate;?></td>
	<?
	$sql1="select count(hn) FROM `xray_doctor` where date between '$newdate 08:00:00' and '$newdate 16:00:00'";
	$query1=mysql_query($sql1);
	list($num1)=mysql_fetch_array($query1);
	?>
	<td><?=$num1;?></td>
	<?
	$sql2="select count(hn) FROM `xray_doctor` where date between '$newdate 16:01:00' and '$newdate 23:59:59'";
	$query2=mysql_query($sql2);
	list($num2)=mysql_fetch_array($query2);
	?>
	<td><?=$num2;?></td>
	<?
	$sql3="select count(hn) FROM `xray_doctor` where date between '$newdate 00:00:00' and '$newdate 07:59:59'";
	$query3=mysql_query($sql3);
	list($num3)=mysql_fetch_array($query3);
	?>
	<td><?=$num3;?></td>	
</tr>
<?
}
?>
</table>
</body>
</html>