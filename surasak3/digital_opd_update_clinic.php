<?php
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$ids = $_POST['id'];
$clinic = $_POST['clinic'];
$sub_clinic = $_POST['sub_clinic'];

$itemsId = array();
foreach ($_POST['id'] as $key => $id) {
    $itemsId[] = sprintf("%s", $dbi->real_escape_string($id));
}

foreach ($itemsId as $key => $id) {
    $sqlUpdate = sprintf("UPDATE `digital_opcard` SET `clinic` = '%s', `sub_clinic` = '%s' WHERE `row_id` = '%s' ",
        $dbi->real_escape_string($clinic),
        $dbi->real_escape_string($sub_clinic),
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sqlUpdate);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนคลินิก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <nav class="navbar" data-bs-theme="dark" style="background-color: #198754;">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0);" onclick="history.back();">ย้อนกลับ</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h3>ดำเนินการแก้ไขเรียบร้อย</h3>
        <div>
            <a href="digital_opd_manage.php" class="btn btn-primary">กลับหน้าหลัก</a>
        </div>
    </div>
</body>
</html>