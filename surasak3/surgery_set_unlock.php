<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<?php
session_start();
include("connect.inc");
$row_id=$_GET["id"];
    $strSQL = "UPDATE surgery_set SET active='' WHERE row_id = $row_id";
    $objQuery = mysql_query($strSQL);
    if($objQuery) {
		echo "<script>
			$(document).ready(function() {
			Swal.fire({
				title: 'Success',
				text: 'ปลดล็อคข้อมูลเรียบร้อย !',
				icon: 'success',
				timer: 5000,
				showConfirmButton: false
				});
			})
		</script>";
		header("refresh:1; url=surgery_set_from_orlist.php");
    } else {
		echo "<script>
			$(document).ready(function() {
			Swal.fire({
				title: 'ผิดพลาด',
				text: 'ปลดล็อคข้อมูลไม่สำเร็จ !',
				icon: 'error',
				timer: 5000,
				showConfirmButton: false
				});
			})
		</script>";
		header("refresh:1; url=surgery_set_from_orlist.php");
    }
?>