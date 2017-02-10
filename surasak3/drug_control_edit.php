<?php 
include("connect.inc");

if(isset($_POST['okok'])){
	
	$updphar = "UPDATE `drug_control_user` SET 
	`min` = '".$_POST['min']."', 
	`max` = '".$_POST['max']."' 
	WHERE `id` = '".$_POST['row_id']."'";
	$resultphar = mysql_query($updphar) or die( mysql_error() );
	if($resultphar){				 
		echo "บันทึกข้อมูลเรียบร้อยแล้ว<br>กรุณาปิดหน้าต่าง";
	}
	?>
	<script type="text/javascript">
		window.onunload = refreshParent;
		function refreshParent(){
			window.opener.location.reload();
		}
	</script>
	<?php
	exit;
}else{

	$id = trim($_GET['rowid']);

	$query = "SELECT a.*, b.`id`, b.`min` AS `new_min`, b.`max` AS `new_max` 
	FROM `druglst` AS a 
	RIGHT JOIN `drug_control_user` AS b ON b.`druglst_id` = a.`row_id` 
	WHERE b.`id` = '".$id."'";
    $rows = mysql_query($query) or die(mysql_error());
	$result = mysql_fetch_array($rows);
?>
<form id="form1" name="form1" method="post" action="drug_control_edit.php">
<table width="289" border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse; font-family: 'Angsana New'; font-size: 18px;">
<tr>
	<td colspan="2" align="center" bgcolor="#00CCFF">แก้ไขรายการ</td>
</tr>
<tr>
	<td width="127" align="right" bgcolor="#FFFFCC">รหัสยา	:</td>
	<td width="150" bgcolor="#FFFFCC">
		<?=$result['drugcode']?>
		<input name="row_id" type="hidden" value="<?=$result['id']?>"/>
	</td>
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
	<td bgcolor="#FFFFCC"><input name="min" type="text" id="min" value="<?=$result['new_min']?>"/></td>
</tr>
<tr>
  <td align="right" bgcolor="#FFFFCC">ค่าสูงสุด	:</td>
  <td bgcolor="#FFFFCC"><input type="text" name="max" id="max" value="<?=$result['new_max']?>" /></td>
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