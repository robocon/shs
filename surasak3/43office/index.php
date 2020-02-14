<?php 
include 'head.php';
include '../bootstrap.php';
if( empty($_SESSION['sIdname']) ){
    redirect('../login_page.php','ชื่อผู้ใช้งานไม่ถูกต้อง');
    exit;
}

?>
<h1>ทดสอบระบบบันทึกข้อมูล43แฟ้ม</h1>
<?php
include 'footer.php';
?>
