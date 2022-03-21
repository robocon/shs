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
        <form action="addNewUser.php" method="post">
            
        </form>
    </div>
</body>
</html>