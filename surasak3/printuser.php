<?
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.style1 {color: #FF0000}
-->
</style>
<body Onload="window.print();">
<?
	echo "<div><strong>ชื่อ-นามสกุล :</strong> $_SESSION[prName]</div>";
	echo "<div><strong>ชื่อผู้ใช้งาน :</strong> $_SESSION[prUser]</div>";
	echo "<div><strong>รหัสผ่าน :</strong> $_SESSION[prPass]</div><br>";
	echo "<div class='style1'><strong>หมายเหตุ :</strong> ผู้ใช้งานระบบ ต้องทำการเปลี่ยนรหัสผ่านใหม่ภายในระยะเวลา 7 วันหลังจากที่ได้รับ Username แล้ว และเพื่อความปลอดภัยควรเปลี่ยนรหัสผ่านทุกๆ 3 เดือน</div>";
session_unregister("prName");
session_unregister("prUser");
session_unregister("prPass");
?>