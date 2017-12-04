<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
<!--
.font1 {
	font-family: AngsanaUPC;
	font-size: 18px;
}
.font2 {
	font-size: 24px;
}
-->
</style>
</head>

<body class="font1">
<?
include("connect.inc");
?>
<center>รายชื่อตรวจสุขภาพลูกจ้าง</center>
<table width="60%" border="1" cellpadding="0" cellspacing="0">
<tr><td width="7%" align="center">ลำดับ</td><td width="20%" align="center">HN</td><td width="49%" align="center">ชื่อ-สกุล</td></tr>
<?
	$sql = "select * from chk_mouth";
	$row = mysql_query($sql);
	while($result = mysql_fetch_array($row)){
		$k++;
		?>
		<tr><td align="center"><?=$k?></td><td><a href="report_dxofyear_emp.php?hn=<?=$result['hn']?>"><?=$result['hn']?></a></td><td><?=$result['ptname']?></td></tr>
		<?
	}
?>
</table>
</body>
</html>