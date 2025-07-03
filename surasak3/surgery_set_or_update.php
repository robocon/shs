<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<?php
session_start();
include("connect.inc");
include("function.php");
$data = $_POST;

$lastupdate=date("Y-m-d H:i:s");
$row_id=$data["row_id"];
$inhalation_ga=$data["inhalation_ga"];
$inhalation_sa=$data["inhalation_sa"];
$inhalation_bb=$data["inhalation_bb"];
$inhalation_iva=$data["inhalation_iva"];
$inhalation_la=$data["inhalation_la"];
$inhalation_ta=$data["inhalation_ta"];
$inhalation_other=$data["inhalation_other"];
$inhalation_detail=$data["inhalation_detail"];
$officer=$_SESSION["sOfficer"];

/*echo "<pre>";
print_r($_SESSION);
echo "<pre>";
exit();*/

	
/*echo "<pre>";
print_r($_POST);
echo "<pre>";
exit();*/

	$strSQL = "UPDATE surgery_set SET `inhalation_ga` = '$inhalation_ga',
									`inhalation_sa` = '$inhalation_sa',
									`inhalation_bb` = '$inhalation_bb',
									`inhalation_iva` = '$inhalation_iva',
									`inhalation_la` = '$inhalation_la',
									`inhalation_ta` = '$inhalation_ta',
									`inhalation_other` = '$inhalation_other',
									`inhalation_detail` = '$inhalation_detail',									
									`officer_update` = '$officer',
									`lastupdate` = '$lastupdate' WHERE row_id='$row_id';";
	/*echo $strSQL;
	exit(); */
	$objQuery = mysql_query($strSQL);
if($objQuery){
	echo "<script>
		$(document).ready(function() {
		Swal.fire({
			title: 'Success',
			text: 'แก้ไขข้อมูลสำเร็จ !',
			icon: 'success',
			timer: 5000,
			showConfirmButton: false
			});
		})
	</script>";
	header("refresh:2; url=surgery_set_from_orlist.php");
}else{
	echo "<script>
		$(document).ready(function() {
		Swal.fire({
			title: 'ผิดพลาด',
			text: 'แก้ไขข้อมูลไม่สำเร็จ !',
			icon: 'error',
			timer: 5000,
			showConfirmButton: false
			});
		})
	</script>";
	header("refresh:2; url=surgery_set_from_or_edit.php?row_id=$row_id");
}

?>