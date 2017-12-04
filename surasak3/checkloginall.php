<?php
	session_start();
	if(empty($sOfficer) || $_SESSION["sOfficer"] == ""){
		?>
		<script>
        	alert("Login ของท่านหมดอายุ กรุณา Login ใหม่คะ/nถ้ามีปัญหาการใช้งาน ติดต่อ 6206 คะ");
        </script>
		<?
		//echo "ขออภัยครับการ Login ของท่านหมดอายุ1<BR> <A HREF=\"..\\sm3.php\">&lt;&lt; กลับหน้าหลัก</A>";
		echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=\"1;URL=..\sm3.php\"  target='_parent'>";

	
	}else{
		$ServerName = "localhost";
		$DatabaseName = "smdb";
		$User = "root"; 
		$Password = "1234";
		
		//ติดต่อกับฐานข้อมูลผ่านฟังก์ชัน MySQL
		$Conn = mysql_connect($ServerName,$User,$Password) or die ("ไม่สามารถติดต่อกับเซิร์ฟเวอร์ได้ ");
		
		//เลือกชื่อฐานข้อมูล คือ smdb
		mysql_select_db($DatabaseName,$Conn) or die ("ไม่สามารถติดต่อกับฐานข้อมูลได้");
	}

?>