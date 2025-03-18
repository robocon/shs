<?php 
include "connect.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ค้นหาเอกสาร</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
</head>
<body>

<div class="container">
<?php 
require_once dirname(__FILE__).'/document_title.php';

if ($_GET["txtKeyword"] != "") {
	$strSearch = $_GET["txtKeyword"];
	$strSQL = "SELECT * FROM document WHERE doc_name LIKE '%" . $strSearch . "%' ORDER BY doc_id desc ";
} else {
	$strSQL = "SELECT * FROM document  ORDER BY doc_id desc ";
}
$objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
$rows = mysql_num_rows($objQuery);
if ($rows) {
	?>
	<table class="table table-striped table-hover mt-4">
		<tr>
			<th>
				<div align="center">ชื่อเอกสาร</div>
			</th>
			<th>
				<div align="center">แผนก</div>
			</th>
			<th>
				<div align="center">ผู้อัพโหลด</div>
			</th>
			<th>
				<div align="center">วันที่อัพโหลด</div>
			</th>
			<th>ไฟล์แนบ</th>
			<!--<th>ลบ</th>-->
		</tr>
		<?
		while ($objResult = mysql_fetch_array($objQuery)) {
			?>
			<tr>
				<td><?= $objResult["doc_name"]; ?></td>
				<td><?= $objResult["depart"]; ?></td>
				<td><?= $objResult["post_name"]; ?></div>
				</td>
				<td align="center"><?= $objResult["doc_date"]; ?></td>
				<td align="center"><a href="javascript:MM_openBrWindow('document_download.php?doc_id=<?= $objResult['doc_id']; ?>','','width=500,height=500')" class="btn btn-primary btn-sm">เปิดไฟล์ <i class="bi bi-paperclip"></i></a>
				</td>
				<!-- <td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='document_delete.php?doc_id=<?//=$objResult["doc_id"]; ?>';}">Delete</a></td>-->
			</tr>
		<?
		}
		?>
	</table>
<? } else {
	echo "ไม่พบรายการที่ค้นหา";
}
?>
<script>
	function MM_openBrWindow(theURL, winName, features) { //v2.0
		window.open(theURL, winName, features);
	}
</script>
</div>
</body>
</html>