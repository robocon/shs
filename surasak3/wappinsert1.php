<?php
include_once dirname(__FILE__).'/newBootstrap.php';
include_once dirname(__FILE__).'/connect.php';
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$count = count($_SESSION["list_code"]);
if ($count > 0) {

	$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
	$an = $_GET['an'];
	$bed = $_GET['cBed'];
	$bedcode = $_GET['cBedcode'];
	$cbedname = $_GET['cbedname'];
	$hn = $_GET['hn'];

	if($_POST['date_sent']){
		$Thidate = dateChristToThai($_POST['date_sent']);
	}

	// max(no)as tno 
	// ถูกเก็บเป็น Varchar ทำให้ไม่สามารถใช้ MAX() ได้
	// ต้องเปลี่ยนให้เป็นตัวเลขด้วย UNSIGNED ก่อน
	$sql1 = "select MAX(CAST(no AS UNSIGNED)) AS tno from lab_ward where an='$an' ";
	$q1 = mysql_query($sql1);
	$ar = mysql_fetch_array($q1);
	$num = $ar['tno'] + 1;

	$sql = "INSERT INTO `lab_ward` ( `no` ,`an` , `code`, `date` )  VALUES ";
	$list = array();
	for ($n = 0; $n < $count; $n++) {
		if (!empty($_SESSION["list_code"][$n])) {
			$q = "('$num','$an', '" . $_SESSION["list_code"][$n] . "', '$Thidate')  ";
			array_push($list, $q);
		}
	}

	$sql .= implode(", ", $list);
	$result = mysql_query($sql);
	$res = array('status'=>200,'id'=>$num);
}else{
	$res = array('status'=>400,'msg'=>mysql_error());
}
echo $json->encode($res);
exit;