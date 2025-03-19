<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_runno.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = $_POST['action'];
if ($action=='submit') {

	$id = $_POST['doc_id'];

	$depart = $dbi->real_escape_string($_POST['depart']);

	$sql = sprintf("INSERT INTO  `document` (  `row_id` ,  `doc_id` ,  `depart` ,  `doc_name` ,  `post_name` ,  `doc_date` ) 
	VALUES (NULL,  '%s',  '%s',  '%s',  '%s', NOW() )",
	$dbi->real_escape_string($_POST['doc_id']),
	$depart,
	$dbi->real_escape_string($_POST['doc_name']),
	$dbi->real_escape_string($_POST['post_name'])
	);
	$sql_query = $dbi->query($sql);
	
	/////////////
	$structure = 'document_file/';
	$attach = $_FILES['attach'];
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
			list($fileName, $ext) = explode('.', $document_name);
			$ext = strtolower($ext);
			$files_allow = array('rar','zip','doc','xls','xlsx','pdf','ppt','pptx','docx','jpg','jpg');
			if (in_array($ext, $files_allow)) {

				$newFileName = $id . '_' . $n . "." . $ext;

				copy($document, "$structure/$newFileName");

				$sql = sprintf("INSERT INTO `document_file` (`doc_id`,`file_name`,`name_thai`,`file_type`) VALUES 
				('%s','%s','%s','%s')",
				$dbi->real_escape_string($_POST['doc_id']),
				$dbi->real_escape_string($newFileName),
				$dbi->real_escape_string($thai[0]),
				$dbi->real_escape_string($ext)
				);
				$sql_query1 = $dbi->query($sql);
			} else {
				echo "<FONT SIZE=\"\" COLOR=\"#CC0000\"><B><CENTER>ไฟล์ที่คุณเลือก ไม่สามารถ Upload ได้ กรุณาเลือกไฟล์ที่มีนามสกุลดังนี้  .rar, .zip, .doc, .xls, .xlsx, .pdf, .ppt, .pptx, .docx, .jpg, .jpg  </CENTER></B></FONT> ";
			}
		}//ปิดไฟล์แนบ
		$n++;
	} //for

	if ($sql_query && $sql_query1) {
		$_SESSION['x-msg'] = 'อัพโหลดเอกสารเรียบร้อย';
		header('Location: document_list1.php?depart='.urlencode($depart));
	}
	exit;
} //if 

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>KM เพิ่มเอกสาร</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
	<style>
		input[readonly]{
			background-color: #d7d7d7;
		}
		button{
			font-size:20px;
		}
	</style>
<div class="container">
<?php
require_once dirname(__FILE__).'/document_title.php';

$r = new Runno();
$id_max = $r->getRunno('document');

?>
<form action="document_add.php" method="post" enctype="multipart/form-data" name="f1" id="f1" onSubmit="fncSubmit(event)">
	<table width="" border="0" align="center" class="">
		<tr class="mb-2">
			<td class="mb-2" align="right">แผนก :</td>
			<td>
				<select name="depart" size="1" class="">
					<option value="0">- - เลือก - - </option>
					<option value="คลังยา-กองเภสัชกรรม">คลังยา-กองเภสัชกรรม</option>
					<option value="เวชระเบียนอิเล็กทรอนิกส์">เวชระเบียนอิเล็กทรอนิกส์</option>
					<?php
					$sql = "SELECT * FROM `departments` WHERE `status`='y' ORDER BY `id` ASC";
					$result = mysql_query($sql);
					while ($row = mysql_fetch_array($result)) {
						$name = $row["name"];
						?><option value="<?=$name;?>"><?=$name;?></option><?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr class="">
			<td align="right">เลขที่เอกสาร :</td>
			<td><input name="doc_id" type="text" id="doc_id" size="30" maxlength="100" readonly="readonly" value="<?= $id_max; ?>" /></td>
		</tr>
		<tr class="">
			<td align="right">ชื่อเอกสาร :</td>
			<td><input name="doc_name" type="text" id="doc_name" size="70" maxlength="100" /></td>
		</tr>
		<tr class="">
			<td align="right" valign="top" >ไฟล์เอกสาร :</td>
			<td>
				<div>
					<input type="file" name="attach[]" id="attach_0" size="50" />
					<button type="button" class="btn btn-secondary" onclick="addRow()">➕เพิ่มรายการ</button>
				</div>
				<div>
					อนุญาตให้อัพโหลดไฟล์ .rar, .zip, .doc, .xls, .xlsx, .pdf, .ppt, .pptx, .docx, .jpg, .jpg เท่านั้น
				</div>
				<div id="moreFile"></div>
			</td>
		</tr>
		<tr class="">
			<td align="right">ผู้จัดเก็บเอกสาร :</td>
			<td><input name="post_name" type="text" class="" id="post_name" size="30" maxlength="100" value="<?=$_SESSION['sOfficer'];?>" readonly/></td>
		</tr>
		<tr>
			<td align="right">&nbsp;</td>
			<td>
				<input name="Submit" type="submit" class="btn btn-primary" value="บันทึกข้อมูล" />
				<input type="hidden" name="action" value="submit">
			</td>
		</tr>
	</table>
</form>
</div>
<script>
	var cnt = 1;

	window.onload = function(){
		
	}

	function addRow() {
		let itemId = cnt++;

		let f = document.getElementById('moreFile');
		
		let div = document.createElement("div");
		div.id = 'row'+itemId;

		let input = document.createElement("input");
		input.type = 'file';
		input.name = 'attach[]';

		let a = document.createElement("a");
		a.href = 'javascript:void(0);';
		a.innerText = '➖ ลบ';
		a.setAttribute('style', 'text-decoration: none;');
		a.setAttribute('onclick', 'this.parentElement.remove()');

		div.append(input);
		div.append(a);

		f.append(div);
	}

	////// เช็คค่าว่าง
	function fncSubmit(e) {
		e.preventDefault();
		var fn = document.f1;
		let form = true;
		if (fn.depart.selectedIndex == 0) {
			Swal.fire('กรุณาระบุแผนกด้วยครับ');
			form = false;
		}else if (fn.doc_name.value == "") {
			Swal.fire('กรุณาระบุชื่อเอกสารด้วยครับ');
			form = false;
		}else if (fn.attach_0.value == "") {
			Swal.fire('กรุณาแนบเอกสารอย่างน้อย 1ฉบับ');
			form = false;
		}else if (fn.post_name.value == "") {
			Swal.fire('กรุณาระบุชื่อผู้อัพโหลดด้วยครับ');
			form = false;
		}

		if(form===true){
			fn.submit();
		}
	}
</script>

</body>
</html>