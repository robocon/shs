<?php
session_start();
include_once 'connect.php';
?>
<style type="text/css">
body,td,th {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.style1 {color: #FF0000}
</style>
<body>
<?php
echo "<div><strong>ชื่อ-นามสกุล :</strong>".sprintf("%s", $_GET['prName'])."</div>";
echo "<div><strong>ชื่อผู้ใช้งาน :</strong>".sprintf("%s", $_GET['prUser'])."</div>";
echo "<div><strong>รหัสผ่าน :</strong>".sprintf("%s", $_GET['prPass'])."</div><br>";
echo "<div class='style1'><strong>คำแนะนำ :</strong> ผู้ใช้งานระบบ ต้องทำการเปลี่ยนรหัสผ่านใหม่ภายในระยะเวลา 7 วันหลังจากที่ได้รับ Username แล้ว และเพื่อความปลอดภัยควรเปลี่ยนรหัสผ่านทุกๆ 3 เดือน</div>";
?>