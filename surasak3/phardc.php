<?php
session_start();
include_once dirname(__FILE__) . '/connect.php';
include_once dirname(__FILE__) . '/includes/functions.php';
if (!isset($_SESSION['sIdname'])) {
	endSession();
	exit;
}

$date2 = (date("Y") + 543) . date("-m-d");
$sql = sprintf("SELECT `lock_dc` FROM `ipcard` WHERE `an` = '%s';", $dbi->real_escape_string($_GET['an']));

$q = $dbi->query($sql);
$a = $q->fetch_array(MYSQLI_ASSOC);

/**
 * ถ้า lock_dc เป็นค่าว่าง แสดงว่าตอนนี้กำลัง lock
 */
if ($a['lock_dc'] == '' || $a['lock_dc'] == NULL) {
	$sql = sprintf("UPDATE `ipcard` SET `lock_dc` = '%s' WHERE `an` = '%s' ", 
		$dbi->real_escape_string($date2), 
		$dbi->real_escape_string($_GET['an'])
	);
	$lockMsg = "ทำการปลดล็อคเรียบร้อยแล้ว กรุณารอสักครู่....";

} else {
	$sql = sprintf("UPDATE `ipcard` SET `lock_dc` = '' WHERE `an` = '%s' ", 
		$dbi->real_escape_string($_GET['an'])
	);
	$lockMsg = "ทำการล็อคเรียบร้อย กรุณารอสักครู่....";

}

$result = $dbi->query($sql);
if ($result) {
	?>
	<h1 style="text-align:center; font-family:'TH SarabunPSK';"><?= $lockMsg; ?></h1>
	<?php
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=enddrugprofile.php\">";
}