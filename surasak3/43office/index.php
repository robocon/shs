<?php 
include 'head.php';
include '../bootstrap.php';
if( empty($_SESSION['sIdname']) ){
    redirect('../login_page.php','ชื่อผู้ใช้งานไม่ถูกต้อง');
    exit;
}
?>
<h1>ทดสอบระบบบันทึกข้อมูล43แฟ้ม</h1>
<div>
<!--[if lt IE 9]>
เบราเซอร์ของท่านไม่รองรับการทำงาน กรุณาเปิดใช้งานด้วย <a href="https://www.google.com/chrome/" target="_blank">Google Chrome</a>, <a href="https://www.mozilla.org/en-US/firefox/new/" target="_blank">Firefox</a> หรือ <a href="https://www.microsoft.com/en-us/edge" target="_blank">Microsoft Edge</a>
<![endif]-->
</div>
<?php
include 'footer.php';
?>
