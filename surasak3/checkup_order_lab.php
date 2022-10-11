<?php
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สั่งแลปผู้ป่วยนอก-ตรวจสุขภาพ</title>
</head>
<body>
    <style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    </style>
    <h3 style="font-size: 24px;">สั่งแลป ผู้ป่วยนอก</h3>
    <form action="trauma_lab.php" method="get" target="_blank">
        <div>
            <label for="vn">VN : </label> <input type="text" name="vn" id="vn">
        </div>
        <div>&nbsp;</div>
        <div>
            <button type="submit">สั่งแลป</button>
        </div>
    </form>
</body>
</html>