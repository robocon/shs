<?php 
include 'bootstrap.php';
DB::load();

include 'templates/classic/header.php';

// include class เข้ามาจัดการ route เท่าจะดี
include 'templates/ward/nav.php';

class WardController{
	
}
?>

เมนู
หน้าหลัก รพ.
หน้ารายงาน
	+ เลือก เดือน, ปี, หน่วยได้
	+ แก้ไข, ลบ, ดูรายงานเต็ม
ฟอร์ม
	- หอผู้ป่วย
	- สูติ
<?php
include 'templates/classic/footer.php';