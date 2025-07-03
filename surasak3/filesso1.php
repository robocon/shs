<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>โปรแกรมอัพเดทสิทธิประกันสังคม</title>

    <link rel="stylesheet" href="w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><style type="text/css">
<!--
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style></head>
<style>
body {
	background-color: #60c4b8;
    font-family: "TH SarabunPSK";
        font-size: 24px;
    }
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>
<body>
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a><br>
<br>
<!-- <div style="color: red;">
	ปิดปรับปรุงระบบ งดใช้เป็นการชั่วคราว ขออภัยในความไม่สะดวก
</div> -->
<div align='center'><img src='images/sso.png'></div>
<div align='center' style="font-size:30px;"><strong>โปรแกรมอัพโหลด TextFile ประกันสังคม</strong></div>

<form name="form1" method="post" action="filesso2.php" enctype="multipart/form-data">
<div align='center'><strong>เลือกไฟล์ที่ต้องการ : </strong><input type="file" size = '70' name="filUpload" class="w3-btn w3-yellow"> <span style='margin-left:10px;'><button name="btnSubmit" type="submit" class="w3-btn w3-blue" value="Submit"><strong> อัพโหลดข้อมูล </strong></button></span></div>
<p align='center' style="font-size:18px;">*** ข้อมูลผู้ประกันตนที่เลือกใช้สิทธิประกันสังคมกับโรงพยาบาลค่ายสุรศักดิ์มนตรี ***</p>
<p align='center' style="font-size:18px;">*** ประกันสังคมจะจัดส่งข้อมูลมาทาง E-Mail เดือนละ 2 รอบ งวดวันที่ 1 และ 16 โดยนับไปอีก 2 วันทำการ หากตรงกับวันเสาร์-วันอาทิตย์ หรือวันหยุดราชการ จะจัดส่งให้ในวันถัดไป ***</p>
</form>
</body>
</html>