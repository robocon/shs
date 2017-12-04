<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<body>
<?
include("connect.inc");

if(isset($_POST['okok'])){
	$updcode = "update druglst set code24 ='".$_POST['code24']."' where row_id='".$_POST['row_id']."' ";
	$resultdr = mysql_query($updcode);
	if($resultdr){
		echo "บันทึกข้อมูลเรียบร้อยแล้ว<br />";
		echo "กรุณาปิดหน้าต่าง";
		?>
		<script>
        	window.opener.location.reload();
        </script>
		<?
	}
}else{

	$query = "SELECT row_id,tradname,drugcode,genname FROM druglst where row_id='".$_GET['nrow']."'";
    $result = mysql_query($query) or die("Query failed");
	$count_row = mysql_num_rows($result);
	list($nnrow,$tradname,$drugcode,$genname) = mysql_fetch_row ($result);
?>
<form id="form1" name="form1" method="post" action="">
<table width="293" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: 'Angsana New'; font-size: 18px;">
<tr>
	<td colspan="2" align="center" bgcolor="#00CCFF">เพิ่มบัญชียา 24 หลัก</td>
</tr>
<tr>
	<td width="107" align="right" bgcolor="#FFFFCC">รหัสยา	:</td><td width="238" bgcolor="#FFFFCC"><?=$drugcode?><input name="row_id" type="hidden" value="<?=$nnrow?>"/></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">ชื่อสามัญ :</td><td bgcolor="#FFFFCC"><?=$genname?></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">ชื่อการค้า :</td>
	<td bgcolor="#FFFFCC"><?=$tradname?></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">24 หลัก	:</td>
	<td bgcolor="#FFFFCC"><input name="code24" type="text" id="code24" maxlength="24"/></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFCC"><input name="okok" type="submit" value=" ตกลง " onclick="return confirm('ยืนยันการแก้ไข')"/></td>
</tr>
</table>
<form>
<?
}
?>
</body>
</html>