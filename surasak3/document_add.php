<?php
session_start();
require "connect.php";

if (isset($_POST['Submit'])) {

	$id = $_POST['doc_id'];

	$sql = "INSERT INTO  `document` (  `row_id` ,  `doc_id` ,  `depart` ,  `doc_name` ,  `post_name` ,  `doc_date` ) 
VALUES ('',  '" . $_POST['doc_id'] . "',  '" . $_POST['depart'] . "',  '" . $_POST['doc_name'] . "',  '" . $_POST['post_name'] . "',  '" . date("Y-m-d H:i:s") . "')";
	$sql_query = mysql_query($sql) or die(mysql_error());

	//echo $sql;
/////////////
	$structure = 'document_file/';

	$attach = $_FILES['attach'];

	/*if (!mkdir($structure, 0777, true)) {
			die('Failed to create folders...');
	}*/
	////////////
	$n = 1;
	for ($i = 0; $i < count($attach['name']); $i++) {

		$document = $attach['tmp_name'][$i];
		$document_name = $attach['name'][$i];
		$document_size = $attach['size'][$i]['size'];
		$document_type = $attach['type'][$i];


		if (empty($document)) //ตรวจสอบว่ามีค่าหรือไม่
		{
			echo "<CENTER>คุณไม่ได้เลือกไฟล์เอกสารแนบ  หรือ <BR> ขนาดไฟล์ที่คุณทำการ Upload นั้นอาจมีขนาดใหญ่เกินไป . กรุณาเลือกไฟล์ใหม่  </CENTER>";
		} else {
			$thai = explode('.', $document_name);

			$ext = strtolower(end(explode('.', $document_name)));
			if ($ext == "rar" or $ext == "zip" or $ext == "doc" or $ext == "xls" or $ext == "xlsx" or $ext == "pdf" or $ext == "ppt" or $ext == "pptx" or $ext == "docx" or $ext == "JPG" or $ext == "jpg") {

				$filename = $id . '_' . $n . "." . $ext;

				copy($document, "$structure/$filename");


				$sql = "INSERT  INTO  document_file";
				$sql .= "(doc_id ,file_name,name_thai,file_type) ";
				$sql .= "VALUES";
				$sql .= "('" . $_POST['doc_id'] . "','" . $filename . "','" . $thai[0] . "','" . $ext . "')";
				$sql_query1 = mysql_query($sql) or die("Error Query [" . $sql . "]");


				//echo $sql;
			} else {
				echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>ไฟล์ที่คุณเลือก ไม่สามารถ Upload ได้ กรุณาเลือกไฟล์ที่มีนามสกุลดังนี้  .doc .docx .xls .ppt .pdf .rar .zip  </CENTER></B></FONT> ";
			}
		}			//ปิดไฟล์แนบ


		$n++;
	} //for

	if ($sql_query && $sql_query1) {
		echo "<meta http-equiv=refresh content=5;URL=document_Search2.php>";
		echo "<br><CENTER><B><FONT SIZE=\"+1\" COLOR=\"#CC0000\">อัพโหลดเอกสารเรียบร้อยแล้ว<BR> กรุณารอสักครู่เพื่อไปยังหน้าดาวน์โหลดไฟล์.......</FONT></B></CENTER><br>";
	}
	exit;
}//if 


?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>เพิ่มเอกสาร</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
	
<style>
*{
	font-family: "TH SarabunPSK";
}
body {
	font-size: 18px;
}
</style>
<?php
$sql = "select row_id from document order by row_id desc limit 1";
$result = mysql_query($sql);
$dbarr = mysql_fetch_assoc($result);
$id_max = $dbarr['row_id'] + 1; // นำค่า id มาเพิ่มให้กับค่ารหัสครั้งละ1
?>
<div class="container">

<h2 class="mt-2" align="center">ระบบจัดเก็บองค์ความรู้</h2>	
<div class="mt-4">
	<a href="../nindex.htm" class="btn btn-primary">กลับเมนูหลัก </a>
	<a href="document_Search2.php" class="btn btn-primary">ค้นหาเอกสารทั้งหมด</a>
	<a href="document_list.php"><span class="btn btn-primary">เอกสารตามแผนก</span></a>
</div>

<form action="document_add.php" method="post" enctype="multipart/form-data" name="f1" id="f1" onSubmit="JavaScript:return fncSubmit()">
	<table>
		<tr>
			<td class="style51" align="right"><strong>แผนก :</strong></td>
			<td>
				<div class="col-md-6 mt-2">
					<select name="depart" size="1" class="form-select mt-4">
						<option value="0">- - เลือก - - </option>
						<option value="คลังยา-กองเภสัชกรรม">คลังยา-กองเภสัชกรรม</option>
						<option value="เวชระเบียนอิเล็กทรอนิกส์">เวชระเบียนอิเล็กทรอนิกส์</option>
						<?php
						$sql = "select * From departments  where status='y' order by id  asc";
						$result = mysql_query($sql);
						while ($row = mysql_fetch_array($result)) { 
							$selected = ($row['menucode'] == $_SESSION['smenucode']) ? 'selected="selected"' : '' ;
							$name = $row["name"];
							echo "<option value='$name' $selected >$name</option>";
						}
						?>
					</select>
				</div>
			</td>
		</tr>
		<tr class="style51">
			<td align="right"><strong>เลขที่เอกสาร :</strong></td>
			<td>
				<div class="col-md-4 mt-2">
					<input name="doc_id" type="text" id="doc_id" class="form-control bg-body-secondary" readonly="readonly" value="<?=$id_max;?>" />
				</div>
			</td>
		</tr>
		<tr class="style51">
			<td align="right"><strong>ชื่อเอกสาร : * </strong></td>
			<td>
				<div class="col-md-8 mt-2">
					<input name="doc_name" type="text" id="doc_name" class="form-control" />
				</div>
			</td>
		</tr>

		<tr class="style51">
			<td>&nbsp;</td>
			<td>
				<table width="100%" id="tbl" onclick="init()" valign="top" class="mt-4">
					<tr>
						<td class="style51" width="100%">
							ไฟล์เอกสาร : <input type="file" name="attach[]" id="attach_0" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.rar,.zip" onchange="checkValidFile(this,event)" />
							<a href="javascript:void(0);" onclick="return addRow()">+ เพิ่มรายการอัพโหลด</a><span class="menu"><strong>&#128072;&nbsp;เลือกไฟล์ช่องนี้ก่อน</strong></span>
						</td>
					</tr>
					<tr>
						<td width="100%" class="style51"><a href="javascript:void(0);" onclick="return addRow()"></a></td>
					</tr>
				</table>
				<span class="badge text-bg-warning">- อนุญาตให้ใช้ไฟล์ .doc .docx .xls .xlsx .ppt .pptx .pdf <br>- ประเภทไฟล์อื่นๆ กรุณาปรับให้เป็นไฟล์ .rar หรือ .zip ด้วยครับ เพื่อป้องกันความเสียหายกับไฟล์</span>
			</td>
		</tr>

		<tr class="style51">
			<td align="right"><strong>ผู้จัดเก็บเอกสาร :</strong></td>
			<td>
				<div class="col-md-6 mt-2">
					<input name="post_name" type="text" class="form-control mt-4 bg-body-secondary" id="post_name" value="<?=$_SESSION['sOfficer'];?>" readonly />
				</div>
			</td>
		</tr>
		<tr class="style5">
			<td align="right">&nbsp;</td>
			<td></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>
				<input name="Submit" type="submit" class="btn btn-primary" value="บันทึกข้อมูล" />
				<input name="Reset" type="reset" class="btn btn-secondary" value="ล้างแบบฟอร์ม" />
			</td>
		</tr>
	</table>
</form>
<script>
	function checkValidFile(f,e){
		e.preventDefault();
		let allowExt = /(\.doc|\.docx|\.xls|\.xlsx|\.ppt|\.pptx|\.pdf|\.rar|\.zip)/i;
		if(!allowExt.exec(f.value)){
			alert('กรุณาอัพโหลดตามไฟล์ที่กำหนดไว้ด้วยครับ');
			f.value='';
			return false;
		}
	}

	var cnt = 0;
	var tbl = null;
	function init() {
		tbl = document.getElementById('tbl');
	}
	function addRow() {
		cnt++;
		var tr = tbl.insertRow(tbl.rows.length - 2);
		tr.id = 'tr_' + cnt;
		var td = tr.insertCell(0);
		var s = '<div class="style51"> ไฟล์เอกสาร : <input name="attach[]" type="file" id="attach_' + cnt + '" accept=".doc,.docx,.xls,.xlsx,.ppt,.pptx,.pdf,.rar,.zip" onchange="checkValidFile(this,event)"/> ';
		s += ' <a href="javascript:void(0);" onclick="return removeRow(' + cnt + ')">ลบออก</a></div>';
		td.innerHTML = s;

		return false;
	}
	function removeRow(id) {
		var o = document.getElementById('tr_' + id);
		tbl.deleteRow(o.rowIndex);
		return false;
	}

	////// เช็คค่าว่าง
	function fncSubmit() {

		var fn = document.f1;

		if (fn.depart.selectedIndex == 0) {
			alert('กรุณาระบุแผนกด้วยครับ');
			fn.depart.focus();
			return false;

		}
		if (fn.doc_name.value == "") {
			alert('กรุณาระบุชื่อเอกสารด้วยครับ');
			fn.doc_name.focus();
			return false;
		}

		if (fn.attach_0.value == "") {
			alert('อัพโหลดเอกสารด้วยครับ');
			fn.attach_0.focus();
			return false;
		}
		if (fn.post_name.value == "") {
			alert('กรุณาระบุชื่อผู้อัพโหลดด้วยครับ');
			fn.post_name.focus();
			return false;
		}
		fn.submit();
	}

</script>
</div>
</body>
</html>