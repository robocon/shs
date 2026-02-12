<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
	include 'pageNotFound.php';
	exit;
}
include_once dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$input = file_get_contents('php://input');
$data = $json->decode($input);
if($data['action']==='search'){
	$sql = sprintf("SELECT `row_id` FROM `drugslip` WHERE `slcode` = '%s'",$dbi->real_escape_string($data['slcode']));
	$q = $dbi->query($sql);
	if($q->num_rows > 0){
		$res = array('status'=>400);
	}else{
		$res = array('status'=>200);
	}
	echo $json->encode($res);
	exit;
}


$datekey = date("Y-m-d H:i:s");
$sql = sprintf("INSERT INTO drugslip(slcode,detail1,detail2,detail3,detail4,amount)VALUES('%s','%s','%s','%s','%s','%s');",
	$dbi->real_escape_string($_POST['slipcode']),
	$dbi->real_escape_string($_POST['detail1']),
	$dbi->real_escape_string($_POST['detail2']),
	$dbi->real_escape_string($_POST['detail3']),
	$dbi->real_escape_string($_POST['detail4']),
	$dbi->real_escape_string($_POST['amount'])
);
$q = $dbi->query($sql);
if ($q!==false) {
	$slipcode = $_POST['slipcode'];
	$detail1 = $_POST['detail1'];
	$detail2 = $_POST['detail2'];
	$detail3 = $_POST['detail3'];
	$detail4 = $_POST['detail4'];
	$amount = $_POST['amount'];
	$add = sprintf("insert into log_drugslip set 
	slcode='%s', 
	action='add', 
	username='%s', 
	menucode='%s', 
	datekey='%s'",
		$dbi->real_escape_string($slipcode),
		$dbi->real_escape_string($_SESSION["sOfficer"]),
		$dbi->real_escape_string($_SESSION["smenucode"]),
		$datekey
	);
	$dbi->query($add);
	?>
	<p>รหัส: <?= $slipcode;?> </p>
	<p>วิธีใช้ที่1: <?= $detail1;?> </p>
	<p>วิธีใช้ที่2: <?= $detail2;?> </p>
	<p>วิธีใช้ที่3: <?= $detail3;?> </p>
	<p>วิธีใช้ที่4: <?= $detail4;?> </p>
	<p>จำนวนที่ต้องใช้ต่อวัน: <?= $amount;?> </p>
	<p>บันทึกข้อมูลเรียบร้อย</p>
	<p>🔙 <a href="slipadd.php">คลิกที่นี่</a> เพื่อกลับไปหน้าฟอร์ม</p>
	<?php
} else {
	echo "<br><br><br>รหัส  :$slipcode  ซ้ำของเดิม โปรดแก้ไข<br>";
}