<?php
session_start();
include 'config.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", ( !empty($_POST['action']) ? $_POST['action'] : '' ));
if($action==='login'){

    $username = sprintf("%s", ( !empty($_POST['username']) ? $_POST['username'] : '' ));
    $password = sprintf("%s", ( !empty($_POST['password']) ? $_POST['password'] : '' ));
    
    $sql = "SELECT `row_id`,`name`,`idname`,`menucode`,`last_login` FROM `inputm` WHERE `idname`='$username' AND `pword`='$password' LIMIT 1";
    $q = $dbi->query($sql);
    if($q->num_rows > 0){
        $inputm = $q->fetch_assoc();

        $id = $inputm['row_id'];
        $dbi->query("UPDATE `inputm` SET `last_login`=NOW() WHERE (`row_id`='$id');");

        $_SESSION['sRowid'] = $inputm['row_id'];
        $_SESSION['sOfficer'] = $inputm['name'];
        $_SESSION['sIdname'] = $inputm['idname'];
        $_SESSION['smenucode'] = $inputm['menucode'];
    
        header('Location: show_dataipd.php?sRowid='.$id);
    }else{
        $_SESSION['msg'] = 'Login ไม่สำเร็จ กรุณาตรวจสอบข้อมูลให้ถูกต้อง';
        header('Location: login.php');
    }
    exit;
}

$sRowid = sprintf("%s", $_GET['sRowid']);
$sql = "SELECT `idname` FROM inputm WHERE `row_id`='$sRowid' ";
$q = $dbi->query($sql);
$username = '';
if($q->num_rows>0){
    $inputm = $q->fetch_assoc();
    $username = $inputm['idname'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>
</head>

<body class="d-flex align-items-center py-4 bg-body-tertiary">
    <div class="form-signin w-100 m-auto" style="max-width:330px;">
        <form action="login.php" method="POST">
            <div class="text-center">
                <img class="mb-4" src="images/LogoFSH.jpg" alt="" height="120">
                <h1 class="h3 mb-3 fw-normal">เข้าสู่ระบบ</h1>
            </div>
            <div class="form-floating">
                <input type="text" name="username" class="form-control" id="floatingInput" placeholder="ชื่อผู้ใช้งาน" value="<?=$username;?>">
                <label for="floatingInput">ชื่อผู้ใช้งาน</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="รหัสผ่าน">
                <label for="floatingPassword">รหัสผ่าน</label>
            </div>
            <button class="btn btn-primary w-100 py-2 mt-4" type="submit">Sign in</button>
            <input type="hidden" name="action" value="login">
        </form>
    </div>
</body>

</html>