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
<body Onload="window.print();">
<?php
echo "<div><strong>ชื่อ-นามสกุล :</strong>".$_GET['prName']."</div>";
echo "<div><strong>ชื่อผู้ใช้งาน :</strong>".$_GET['prUser']."</div>";
echo "<div><strong>รหัสผ่าน :</strong>".$_GET['prPass']."</div><br>";
echo "<div class='style1'><strong>หมายเหตุ :</strong> ผู้ใช้งานระบบ ต้องทำการเปลี่ยนรหัสผ่านใหม่ภายในระยะเวลา 7 วันหลังจากที่ได้รับ Username แล้ว และเพื่อความปลอดภัยควรเปลี่ยนรหัสผ่านทุกๆ 3 เดือน</div>";
?>