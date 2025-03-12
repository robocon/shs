<?php
require_once dirname(__FILE__) . '/bootstrap.php';
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
			font-size: 20px;
		}
	</style>
	<div class="container">
		<h2 class="mt-2" align="center">ระบบจัดเก็บเอกสาร (<?= $depart1; ?>)</h2>
		<div class="mt-4">
			<a href="../nindex.htm" class="btn btn-primary">กลับเมนูหลัก </a>
			<a href="document_list.php" class="btn btn-primary">เอกสารตามแผนก</a>
			<a href="document_add.php"><span class="btn btn-primary">เพิ่มเอกสารใหม่</span></a>
		</div>
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
				</tr>
				<?php
				$all = 0;
				while ($objResult = mysql_fetch_assoc($objQuery)) {
					$link = '<a href="document_edit.php?doc_id='.$objResult['doc_id'].'" title="แก้ไข">✏️</a>';
					$linkdel = '<a href="document_delete.php?doc_id='.$objResult['doc_id'].'" onclick="chkdel(event, this.href, '.$objResult['doc_id'].');" title="ลบเอกสาร">🗑️</a>';
					?>
					<tr id="doc-<?=$objResult['doc_id'];?>">
						<td><a href="javascript:MM_openBrWindow('document_download.php?doc_id=<?=$objResult['doc_id'];?>','','width=500,height=500')"><?=$objResult["doc_name"];?></a></td>
						<td><?= $objResult["count"]; ?></td>
						<td><?= $link; ?>&nbsp;&nbsp; <?= $linkdel; ?></td>
					</tr>
					<?php
					$all += $objResult["count"];
				}
				?>
				<tr id="box-table-a">
					<td colspan="3" align="center" class="forntsarabun">รวม <?= $all; ?> ไฟล์</td>
				</tr>
			</table>
		<?php
		}
		?>
	</div>

	<script>
		function chkdel(e, link, id) {
			e.preventDefault();
			
			Swal.fire({
				title: "ยืนยันที่จะลบข้อมูล",
				icon: "warning",
				showCancelButton: true,
				cancelButtonText: "ยกเลิก",
				cancelButtonColor: "#d33",
				confirmButtonText: "ยืนยันการลบ",
				confirmButtonColor: "#3085d6",
			}).then((result)=>{
				if(result.isConfirmed){
					window.open(link,"MsgWindow","width=250,height=100");
					document.getElementById('doc-'+id).remove();
				}else{
					return false;
				}
			});
			
		}
		function MM_openBrWindow(theURL, winName, features) { //v2.0
			window.open(theURL, winName, features);
		}
	</script>

</body>

</html>