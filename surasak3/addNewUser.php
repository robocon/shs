<?php 
include 'bootstrap.php';
$dbi = new mysqli('192.168.131.250','remoteuser','',DB);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>เพิ่มผู้ใช้งานมาใหม่</title>
</head>
<body>
    <div class="w3-container">
        <form action="addNewUser.php" method="post" class="w3-col m6 l4">
            <p>
                <label for="name">ชื่อสกุล</label>
                <input class="w3-input w3-border w3-round-large" type="text" id="name" name="name" value="">
            </p>
            <p>
                <label for="name">ชื่อผู้ใช้งาน</label>
                <input class="w3-input w3-border w3-round-large" type="text" id="idname" name="idname" value="">
                <button type="button" onclick="alert('ตรวจสอบชื่อผู้ใช้งาน ว่าซ้ำรึป่าว')"><i class="fa fa-search"></i> ตรวจสอบ</button>
            </p>
            <p>
                <label for="name">รหัสผ่าน</label>
                <input class="w3-input w3-border w3-round-large" type="text" id="pword" name="pword" value="">
            </p>
            <p>
                <label for="">แผนก</label>
                <select name="" id="" class="w3-select w3-border w3-round-large">
                    <option value="xxx">xxx</option>
                </select>
            </p>
            <p>
                <label for="">ระดับ</label>
                <select name="" id="" class="w3-select w3-border w3-round-large">
                    <option value="xxx">xxx</option>
                </select>
            </p>
            <p>
                <button class="w3-button w3-round-large w3-teal" type="submit">Rounder</button>
            </p>
        </form>
    </div>
</body>
</html>