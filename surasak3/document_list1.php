<?php
session_start();
include "connect.php";

$depart1 = sprintf("%s", $_GET['depart']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>เอกสาร <?= $depart1; ?></title>
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
	<div class="container">
		<h2 class="mt-2" align="center">ระบบจัดเก็บเอกสาร (<?= $depart1; ?>)</h2>
		<div class="mt-4">
			<a href="../nindex.htm" class="btn btn-primary">กลับเมนูหลัก </a>
			<a href="document_list.php" class="btn btn-primary">เอกสารตามแผนก</a>
			<a href="document_add.php"><span class="btn btn-primary">เพิ่มเอกสารใหม่</span></a>
		</div>
		<script language="JavaScript">
			function chkdel() {
				if (confirm('  กรุณายืนยันการลบอีกครั้ง !!! ')) {
					return true;
				} else {
					return false;
				}
			}
		</script>
		<?php
		
		$strSQL = "SELECT count(b.doc_id) as count ,a.doc_name,a.doc_id,a.row_id,a. post_name 
		FROM document as a ,document_file as b  
		where a.doc_id=b.doc_id 
		AND depart='" . $depart1 . "' 
		Group by b.doc_id
		ORDER BY `doc_date` DESC";
		$objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
		$rows = mysql_num_rows($objQuery);

		if ($rows) {
			?>
			<table id="" class="table table-striped table-hover mt-4">
				<tr>
					<th>ชื่อเรื่อง</th>
					<th>จำนวนไฟล์แนบ</th>
					<th>ดำเนินการ</th>
					<!--<th>ลบ</th>-->
				</tr>
				<?
				while ($objResult = mysql_fetch_assoc($objQuery)) {
					
					/*if($_SESSION['sOfficer']==$objResult['post_name'] || $_SESSION['sOfficer']=="เพลิงพายุ อุปนันท์"){ */

					$link = "<a href='document_edit.php?doc_id=".$objResult['doc_id']."'>แก้ไข</a>";
					$linkdel = "<a href='document_delete.php?doc_id=".$objResult['doc_id']."' OnClick='return chkdel();' title='ลบข้อมูล ชื่อเรื่องและเอกสารทั้งหมด ของเรื่องนี้'>ลบ</a>";

					/*	 }else{
							 
						$link="แก้ไข";
						$linkdel="ลบ";
					}*/
					?>
					<tr>
						<td><a href="javascript:MM_openBrWindow('document_download.php?doc_id=<?= $objResult['doc_id']; ?>','','width=500,height=500')"><?= $objResult["doc_name"]; ?></a></td>
						<td><?= $objResult["count"]; ?></td>
						<td><?= $link; ?>&nbsp;&nbsp; <?= $linkdel; ?></td>
						<!-- <td><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='document_delete.php?doc_id=<?//=$objResult["doc_id"]; ?>';}">Delete</a></td>-->
					</tr>
					<?php
					$all += $objResult["count"];
				}
				?>
				<tr id="box-table-a">
					<td colspan="3" align="center" class="forntsarabun">รวม <?= $all; ?> ไฟล์</td>
				</tr>
			</table>
		<?
		}
		?>
	</div>

	<script>
		function MM_openBrWindow(theURL, winName, features) { //v2.0
			window.open(theURL, winName, features);
		}
	</script>

</body>

</html>