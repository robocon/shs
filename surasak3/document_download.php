<?php
require_once dirname(__FILE__) . '/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>KM - ดาวน์โหลดเอกสาร</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
	<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="js/sweetalert2.all.min.js"></script>
</head>

<body>
	<style>
		body {
			font-family: "TH SarabunPSK";
			font-size: 18px;
		}
	</style>
	<?php

	$strSQL = "SELECT * FROM document  WHERE doc_id='" . $_GET['doc_id'] . "'";
	$objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
	$objResult = mysql_fetch_array($objQuery);

	$strSQL1 = "SELECT * FROM document_file  WHERE doc_id='" . $_GET['doc_id'] . "' order by file_name asc";
	$objQuery1 = mysql_query($strSQL1) or die("Error Query [" . $strSQL1 . "]");

	$rows = mysql_num_rows($objQuery1);

	if ($rows) {
	?>
		<table class="table">
			<tr>
				<td colspan="2" align="center" bgcolor="#b9c9fe">
					<h3>ดาวน์โหลดเอกสาร</h3>
				</td>
			</tr>
			<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
				<td><strong>ชื่อเอกสาร</strong></td>
				<td><?= $objResult['doc_name'] ?></td>
			</tr>
			<?php
			$i = 1;
			while ($objResult1 = mysql_fetch_array($objQuery1)) {

				$dri1 = substr($objResult['doc_date'], 0, 4) + 543;

				if ($objResult1['name_thai'] == "") {

					$name = $objResult1['file_name'];
				} else {
					$name = $objResult1['name_thai'];
				}
				/////////////
				$structure = 'document_file/';
			?>
				<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
					<td><strong>ไฟล์แนบ <?= $i; ?></strong></td>
					<td><a href="<?= $structure . '/' . $objResult1['file_name']; ?>"><?= $name; ?></a> 💾</td>
				</tr>
			<?
				$i++;
			} ?>
			<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
				<td><strong>แผนก</strong></td>
				<td><?= $objResult['depart'] ?></td>
			</tr>
			<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
				<td><strong>วันที่</strong></td>
				<td><?= $objResult['doc_date'] ?></td>
			</tr>
		</table>
	<?php
	} else {
		echo "ไม่มีไฟล์";
	}
	?>
	<br />
	<div align="center"><input name="btnButton" type="button" class="btn btn-primary" onClick="JavaScript:window.close();" value="ปิดหน้าต่าง"></div>
</body>

</html>