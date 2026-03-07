<?php
session_start();
include_once dirname(__FILE__) . '/connect.php';
include_once dirname(__FILE__) . '/includes/functions.php';
if (!isset($_SESSION['sIdname'])) {
	endSession();
	exit;
}

$date2 = (date("Y") + 543) . date("-m-d");
$str = "select lock_dc from ipcard WHERE an = '" . $_GET['an'] . "' ";
$sql = sprintf()
$strresult = mysql_query($str);
$arr = mysql_fetch_array($strresult);

/**
 * ถ้า lock_dc เป็นค่าว่าง แสดงว่าตอนนี้กำลัง lock
 */
if ($arr['lock_dc'] == '' || $arr['lock_dc'] == NULL) {

	$sql = "update ipcard set lock_dc = '$date2' where an = '" . $_GET['an'] . "' ";
	$lockStatus = "ทำการปลดล็อคเรียบร้อยแล้ว กรุณารอสักครู่....";

} else {

	$sql = "update ipcard set lock_dc = '' where an = '" . $_GET['an'] . "' ";
	$lockStatus = "ทำการล็อคเรียบร้อย กรุณารอสักครู่....";

}

$result = mysql_query($sql);
if ($result) {
	echo $lockStatus;
	echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"2;URL=enddrugprofile.php\">";
}
