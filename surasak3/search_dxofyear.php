<?
session_start();
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
<style type="text/css">
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
<form action="search_dxofyear.php" method="post">
<table class="pdxhead" border="1" bordercolor="#FFFF00">
  <tr>
    <td width="412" align="center" bgcolor="#FFFF99"><strong>ค้นหาจากชื่อและสกุล</strong></td></tr>
  <tr>
  <td>HN : 
    <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/></td>
  </tr>
  <tr>
  <td>ชื่อ - สกุล : 
    <input name="pt" type="text" size="20" class="pdxhead"  /> 
  <input type="submit"  value="   ตกลง   " name="okpt" class="pdxhead"/></td>
  </tr>
</table>
</form>
<?
if(isset($_POST['okpt'])){
	$sql = "select * from predxofyear where ptname like '%".$_POST['pt']."%'";
	$result = mysql_query($sql);
	$sum = mysql_num_rows($result);
	if($sum=="0"){
		echo "<br><span class='pdxhead'>ไม่พบ</span>";
	}else{
		?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr><td width="14%" align="center" class="pdxhead"><strong>ชื่อ-สกุล</strong></td>
	  <td width="21%" align="center" class="pdxhead"><strong>บริษัท</strong></td>
	  <td width="56%" align="center" class="pdxhead"><strong>กลุ่ม</strong></td>
	  <td width="5%" align="center" class="pdxhead"><strong>หน้าที่</strong></td>
    <td width="4%" align="center">&nbsp;</td>
    <td width="4%" align="center">&nbsp;</td>
	</tr>
    <?
		$result = mysql_query($sql);
		while($arr = mysql_fetch_array($result)){
		?>
<tr class="pdxpro"><td><?=$arr['ptname']?></td><td><?=$arr['company']?></td><td><?=$arr['type_check']?></td>
<td align="center"> <?=$arr['comment']?></td><td><a href="pdx_ofyear.php?view=<?=$arr['row_id']?>" target="_blank" >พิมพ์</a></td>
<td align="center"><a href="pdx_ofyear2.php?stricker=<?=$arr['row_id']?>" target="_blank" >STRICKER</a></td>
</tr>
	<?
		}
		?>
</table>
        <?
	}
}elseif(isset($_POST['okhn'])){
	$sql = "select * from predxofyear where hn = '".$_POST['hn']."' order by row_id desc";
	$result = mysql_query($sql);
	$sum = mysql_num_rows($result);
	if($sum=="0"){
		echo "<br><span class='pdxhead'>ไม่พบ</span>";
	}
	elseif($sum=="1"){
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		?>
        <script>
		window.open("pdx_ofyear.php?stricker=<?=$arr['row_id']?>");
		</script>
		<?
	}else{
		?>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
	<tr><td width="14%" align="center" class="pdxhead"><strong>ชื่อ-สกุล</strong></td>
	  <td width="21%" align="center" class="pdxhead"><strong>บริษัท</strong></td>
	  <td width="56%" align="center" class="pdxhead"><strong>กลุ่ม</strong></td>
	  <td width="5%" align="center" class="pdxhead"><strong>หน้าที่</strong></td>
    <td width="4%" align="center">&nbsp;</td>
	</tr>
    <?
		$result = mysql_query($sql);
		while($arr = mysql_fetch_array($result)){
		?>
<tr class="pdxpro"><td><?=$arr['ptname']?></td><td><?=$arr['company']?></td><td><?=$arr['type_check']?></td>
<td align="center"> <?=$arr['comment']?></td>
<td align="center"><a href="pdx_ofyear2.php?stricker=<?=$arr['row_id']?>" target="_blank" >STRICKER</a></td>
</tr>
	<?
		}
		?>
</table>
<?
	}
}
?>
</body>
</html>