<?php 
require_once 'bootstrap.php';

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if($smenucode!=='ADM' AND $smenucode!=='ADMCOM'){
    echo "Permission Deny";
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$ids = $_POST['id'];

$doctor = $_POST['doctor'];
$oldDoctor = $_POST['oldDoctor'];

if(count($ids)==0 OR empty($doctor ) OR empty($oldDoctor)){
    echo "กรุณาระบุ ID และ แพทย์";
    exit;
}

$items = array();
foreach ($_POST['id'] as $key => $id) {
    $items[] = "'".sprintf("%s", $dbi->real_escape_string($id))."'";
}

$newItems = implode(',', $items);
$sql = sprintf("SELECT `row_id`,`actual_date` FROM `digital_opcard` WHERE `row_id` IN (%s)", $newItems);
$q = $dbi->query($sql);
if($q->num_rows>0){

    while ($a = $q->fetch_assoc()) {
        
        $row_id = $a['row_id'];
        
        $newDoctor = sprintf("%s", $dbi->real_escape_string($doctor));
        $sqlUpdate = "UPDATE `digital_opcard` SET `doctor` = '$newDoctor' WHERE `row_id` = '$row_id' ";
        $dbi->query($sqlUpdate);
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่ยนชื่อแพทย์</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <nav class="navbar bg-body-tertiary">
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