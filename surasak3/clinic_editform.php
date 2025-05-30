<?php 
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$sql = sprintf("SELECT * FROM `clinic_vip` WHERE `row_id` = '%s' ", $dbi->real_escape_string($_GET["row_id"]));
$q = $dbi->query($sql);
if ($q->num_rows === 0) {
	echo "Not found row_id=" . $_GET["row_id"];
	exit;
}
$a = $q->fetch_assoc();
?>
<form action="javascript:void(0);" name="frmEdit" id="frmEdit" method="post" onsubmit="saveFormEdit()">
	<table>
		<tr>
			<td align="right">HN : </td>	
			<td>
				<input name="hn" type="text" id="hn" value="<?=$a['hn'];?>" size="20" ><button type="button" onclick="checkPtright()">ตรวจสอบ</button>
			</td>
		</tr>
		<tr>
			<td align="right">ชื่อ-สกุล : </td>
			<td>
				<input name="ptname" type="text" id="ptname" value="<?=$a['ptname']; ?>" size="20">
			</td>
		</tr>
		<tr>
			<td align="right">AN : </td>
			<td>
				<input name="an" type="text" id="an" value="<?=$a['an']; ?>" />
			</td>
		</tr>
		<tr>
			<td align="right">สิทธิ์ : </td>
			<td id="resPtright"></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<button type="submit">บันทึก</button>
				<input type="hidden" name="row_id" id="row_id" value="<?=$a['row_id']; ?>">
			</td>
		</tr>
	</table>
</form>