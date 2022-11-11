<?php 
include_once 'bootstrap.php';
if($_SESSION['sIdname']!=='krit')
{
    ?><a href="login_page.php">Session หมดอายุ</a><?php
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>ซะป๊ะเมนูไม่ไหวจะเคลียร์</title>
</head>
<body>
    <div class="w3-sidebar w3-bar-block w3-light-grey w3-card" style="width:25%">
        <a href="krit.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>

        <button class="w3-button w3-block w3-left-align" onclick="myAccFunc('demoAcc')">แก้ค่าใช้จ่าย <i class="fa fa-caret-down"></i></button>
        <div id="demoAcc" class="w3-hide w3-white w3-card">
            <a href="edit_ipacc.php" class="w3-bar-item w3-button" target="_blank">ผู้ป่วยใน <span class="w3-tag w3-yellow">ยังไม่เสร็จ</span></a>
            <a href="edit_opacc.php" class="w3-bar-item w3-button" target="_blank">ผู้ป่วยนอก</a>
        </div>

        <button class="w3-button w3-block w3-left-align" onclick="myAccFunc('demoAcc2')">แก้ยา <i class="fa fa-caret-down"></i></button>
        <div id="demoAcc2" class="w3-hide w3-white w3-card">
            <a href="javascript:void(0)" class="w3-bar-item w3-button" target="_blank">ผู้ป่วยใน <span class="w3-tag w3-yellow">ยังไม่เสร็จ</span></a>
            <a href="editPharOpacc.php" class="w3-bar-item w3-button" target="_blank">ผู้ป่วยนอก</a>
        </div>

        <a href="find_part.php" class="w3-bar-item w3-button" target="_blank">หา part ที่หายไป</a>
        <a href="com_support_v2.php" class="w3-bar-item w3-button" target="_blank">คีย์งานแบบบันทึกเอง</a>
        
        <button class="w3-button w3-block w3-left-align" onclick="myAccFunc('demoAcc3')">เพิ่มผู้ใช้งาน <i class="fa fa-caret-down"></i></button>
        <div id="demoAcc3" class="w3-hide w3-white w3-card">
            <a href="addNewUser.php" class="w3-bar-item w3-button" target="_blank">เพิ่มผู้ใช้งานในระบบ</a>
            <a href="new_doctor.php" class="w3-bar-item w3-button" target="_blank">เพิ่มแพทย์ใหม่ <span class="w3-tag w3-yellow">ยังไม่เสร็จ</span></a>
        </div>

        <a href="dt_appoint_diagnose.php" class="w3-bar-item w3-button" target="_blank">Lock นัดแพทย์</a>
        
    </div>
    <div class="w3-container" style="margin-left:25%">
        <h3>ซะป๊ะเมนูไม่ไหวจะเคลียร์</h3>
        <p>เอาไว้แก้นั่นๆ นี่ๆ ไม่ต้องผ่าน phpmyadmin</p>
    </div>
    <script>
        function myAccFunc(divId) {
        var x = document.getElementById(divId);
            if (x.className.indexOf("w3-show") == -1) {
                x.className += " w3-show";
                x.previousElementSibling.className += " w3-green";
            } else { 
                x.className = x.className.replace(" w3-show", "");
                x.previousElementSibling.className = 
                x.previousElementSibling.className.replace(" w3-green", "");
            }
        }
    </script>
</body>
</html>