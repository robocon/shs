<?php 
require_once 'bootstrap.php';
require_once 'class_file/OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = $_REQUEST['hn'];
$vn = $_REQUEST['vn'];
$type = $_REQUEST['type'];

$chk_year = get_year_checkup();

$a = new OpdReceive();
$a->hn = $hn;
$a->vn = $vn; 
$a->clinicalinfo = 'ตรวจสุขภาพประจำปี'.$chk_year;
$a->sOfficer = $_SESSION['sOfficer'];
if($type == 'lab')
{	
	// เอา hn กับ vn ไปหา ว่าวันนี้ใน depart มี PATHO ที่สิทธิ์ออกเป็น R42 ตรวจสุขภาพลูกจ้างประจำปี แล้วรึยัง
	if($a->findOrderLab()===false)
	{
		$a->orderLab($_REQUEST['labSelect']);
	}
}
elseif($type == 'xray')
{
	if($a->findXray() === false)
	{
		$a->orderXray($_REQUEST['labSelect']);
	}
}
?>
<p>บันทึกข้อมูลเรียบร้อย</p>
<p>ปิดหน้าจอได้</p>
<script>
	setTimeout("window.close()",3000);
</script>