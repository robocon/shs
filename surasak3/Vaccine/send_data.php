<?
include "Connections/dbconfig.php";
conndb();

$vaccine = $_POST['vaccine'];
$vaccine_detail = $_POST['vaccine_detail'];


$strSQL1 = "SELECT * FROM vaccine WHERE id_vac = '$vaccine'";
$result1 = mysql_query($strSQL1);
$row1 = mysql_fetch_array($result1);
$vac_name = $row1['vac_name'];


$strSQL2 = "SELECT * FROM vaccine_detail WHERE id_vac = '$vaccine_detail'";
$result2 = mysql_query($strSQL2);
$row2 = mysql_fetch_array($result2);
$detail = $row2['detail'];


?>


<html>
<head>
<title>:: ตัวอย่าง ทำ AJAX ของ Drop Down Menu ที่ไว้เลือกจังหวัด อำเภอ ตำบล ของไทย ::</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">

</head>


<body>

จังหวัด : <? echo $vac_name." (".$vaccine.")"; ?><br>
อำเภอ : <? echo $detail." (".$vaccine_detail.")"; ?><br>


<br><br>
* จะได้รหัสของ จังหวัด เมือง ตำบล ออกมา (ตามหลักการออกแบบฐานข้อมูล ที่ควรจะเก็บแค่ ID น่ะ) ซึ่งสามารถนำไปเก็บลงตารางฐานข้อมูลได้เลย *
<br>* กรณีต้องการให้แสดงชื่อออกมาก็ให้ไป SELECT ชื่อมาจากตาราง amphur , district , province  อีกทีครับ *


<br><br><br>พัฒนาโดย : <a href="http://php-ajax-code.blogspot.com" target="_blank">http://php-ajax-code.blogspot.com</a>
<br>แก้ไขพัฒนาเพิ่มเติมให้สมบูรณ์แบบโดย : <a href="http://www.codetukyang.com" target="_blank">http://www.codetukyang.com</a>
<br>สร้าง & พัฒนาฐานข้อมูล จังหวัด อำเภอ ตำบล โดย : <a href="http://www.thaicreate.com" target="_blank">http://www.thaicreate.com</a>


</body>

</html>