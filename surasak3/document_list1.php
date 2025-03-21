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
		#myBtn {
			display: none;
			position: fixed;
			bottom: 20px;
			right: 30px;
			z-index: 99;
			font-size: 18px;
			border: none;
			outline: none;
			background-color: #a1a1a1;
			color: white;
			cursor: pointer;
			padding: 8px;
			border-radius: 4px;
		}
		body {
			font-family: "TH SarabunPSK";
			font-size: 20px;
		}
	</style>
	<button onclick="topFunction()" id="myBtn" title="Go to top">🔝</button>
	<div class="container">
		<?php 
		require_once dirname(__FILE__).'/document_title.php';
		?>
		<h2 class="mt-2" align="center"><?=$depart1;?></h2>
		<?php
		if($_SESSION['x-msg']){
			?>
			<div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
			<?php
			unset($_SESSION['x-msg']);
		}

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
					<th colspan="3">ดำเนินการ</th>
				</tr>
				<?php
				$all = 0;
				while ($objResult = mysql_fetch_assoc($objQuery)) {
					$download = '<a href="javascript:void(0);" title="ดาวโหลดไฟล์" onclick="downloadAllFile('.$objResult['doc_id'].')">📥</a>';
					$link = '<a href="document_edit.php?doc_id='.$objResult['doc_id'].'" title="แก้ไข">✏️</a>';
					$linkdel = '<a href="document_delete.php?doc_id='.$objResult['doc_id'].'" onclick="chkdel(event, this.href, '.$objResult['doc_id'].');" title="ลบเอกสาร">🗑️</a>';
					?>
					<tr id="doc-<?=$objResult['doc_id'];?>">
						<td><a href="javascript:MM_openBrWindow('document_download.php?doc_id=<?=$objResult['doc_id'];?>','','width=500,height=500')"><?=$objResult["doc_name"];?></a></td>
						<td align="center"><?=$objResult["count"]; ?></td>
						<td><?=$download;?></td>
						<td><?=$link;?></td>
						<td><?=$linkdel;?></td>
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
		let mybutton = document.getElementById("myBtn");
		window.onscroll = function() {scrollFunction()};

		function scrollFunction() {
			if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
				mybutton.style.display = "block";
			} else {
				mybutton.style.display = "none";
			}
		}

		// When the user clicks on the button, scroll to the top of the document
		function topFunction() {
			document.body.scrollTop = 0;
			document.documentElement.scrollTop = 0;
		}

		function downloadAllFile(id){
			// สร้างไฟล์ zip ขึ้นมาก่อน
			buildZip(id).then((res)=>{

				// ถ้าสร้างไฟล์เสร็จค่อยโหลดไฟล์
				if(res.status==200){
					dowloadWindow = window.open('document_download_zip.php?doc_id='+id,'','width=300,height=200');

					// หลังจากโหลดเสร็จ 2 วินาที ปิดหน้าต่าง
					setTimeout(() => {
						dowloadWindow.close().then(()=>{

							// ปิดหน้าต่างไปแล้วลบไฟล์ zip ทิ้ง
							removeZip(id);
						});
					}, 2000);
				}else{
					Swal.fire({
						icon: 'error',
						title: 'เกิดข้อผิดพลาด',
						text: res.message
					});
				}
			});
		}

		async function buildZip(id) {
			const response = await fetch('document_build_zip.php?doc_id='+id);
			const data = await response.json();
			return data;
		}

		async function removeZip(id) {
			const response = await fetch('document_remove_zip.php?doc_id='+id);
			const data = await response.json();
		}

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