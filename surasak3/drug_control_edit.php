<?
include("connect.inc");

if(isset($_POST['okok'])){
	
		$updphar = "update druglst set min='".$_POST['min']."',max='".$_POST['max']."' where row_id='".$_POST['row_id']."'";
		$resultphar = mysql_query($updphar);
		if($resultphar){				 
		echo "บันทึกข้อมูลเรียบร้อยแล้ว<br />";
		echo "กรุณาปิดหน้าต่าง";
		?>
		<script>
        	//window.opener.location.reload();
			window.opener.location.href='drug_control.php';
        </script>
		<?
		}
}else{

	$query = "SELECT * FROM druglst where row_id='".$_GET['rowid']."'";
    $rows = mysql_query($query) or die(mysql_error());
	$result = mysql_fetch_array($rows);
?>
<form id="form1" name="form1" method="post" action="">
<table width="289" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: 'Angsana New'; font-size: 18px;">
<tr>
	<td colspan="2" align="center" bgcolor="#00CCFF">แก้ไขรายการ</td>
</tr>
<tr>
	<td width="127" align="right" bgcolor="#FFFFCC">รหัสยา	:</td><td width="150" bgcolor="#FFFFCC"><?=$result['drugcode']?><input name="row_id" type="hidden" value="<?=$result['row_id']?>"/></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">ชื่อสามัญ :</td><td bgcolor="#FFFFCC"><?=$result['genname']?></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">ชื่อการค้า :</td>
	<td bgcolor="#FFFFCC"><?=$result['tradname']?></td>
</tr>
<tr>
	<td align="right" bgcolor="#FFFFCC">ค่าต่ำสุด	:</td>
	<td bgcolor="#FFFFCC"><input name="min" type="text" id="min" value="<?=$result['min']?>"/></td>
</tr>
<tr>
  <td align="right" bgcolor="#FFFFCC">ค่าสูงสุด	:</td>
  <td bgcolor="#FFFFCC"><input type="text" name="max" id="max" value="<?=$result['max']?>" /></td>
</tr>
<tr>
	<td colspan="2" align="center" bgcolor="#FFFFCC"><input name="okok" type="submit" value=" ตกลง " onclick="return confirm('ยืนยันการแก้ไขจำนวน')"/></td>
</tr>
</table>
<form>
<?
}
?>
</body>
</html>