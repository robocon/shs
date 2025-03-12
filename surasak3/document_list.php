<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>KM - แยกตามแผนก</title>
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
	<h2 class="mt-2" align="center">ระบบจัดเก็บองค์ความรู้</h2>
	<div class="mt-4">
		<a href="../nindex.htm" class="btn btn-primary">กลับเมนูหลัก </a>
		<a href="document_Search2.php" class="btn btn-primary">ค้นหาเอกสารทั้งหมด</a>
		<a href="document_add.php"><span class="btn btn-primary">เพิ่มเอกสารใหม่</span></a>
	</div>
	<?php
	$strSQL = "SELECT count(depart)as count,depart FROM document Group by depart order by count desc";
	$objQuery = mysql_query($strSQL) or die("Error Query [" . $strSQL . "]");
	$rows = mysql_num_rows($objQuery);
	if ($rows>0) {
		?>
		<table class="table table-striped table-hover mt-4">
			<tr>
				<th >แผนก</th>
				<th >จำนวนเอกสาร/เรื่อง</th>
			</tr>
			<?php
			while ($objResult = mysql_fetch_array($objQuery)) {
				?>
				<tr>
					<td><a href="document_list1.php?depart=<?= $objResult["depart"]; ?>"><?= $objResult["depart"]; ?></a></td>
					<td><?= $objResult["count"]; ?></td>
					<!-- <td align="center"><a href="JavaScript:if(confirm('Confirm Delete?')==true){window.location='document_delete.php?doc_id=<?//=$objResult["doc_id"]; ?>';}">Delete</a></td>-->
				</tr>
				<?
				$all += $objResult["count"];
			}

			?>
			<tr id="">
				<td colspan="2" align="center" class=""><strong>ยอดรวม <?= $all; ?> เรื่อง</strong></td>
			</tr>

		</table>
		<?php
	}else{
		?>
		<div class="alert alert-warning mt-4" role="alert">ยังไม่มีเอกสาร</div>
		<?php
	}
	?>
	</div>
</body>

</html>