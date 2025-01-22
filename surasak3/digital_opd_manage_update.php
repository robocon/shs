<?php 
require_once 'bootstrap.php';

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if($smenucode!=='ADM' AND $smenucode!=='ADMCOM'){
    echo "Permission Deny";
    exit;
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

if(empty($_POST['id']) OR empty($_POST['new_date'])){
    echo "กรุณาระบุรายการที่ต้องการแก้ไข และ วันที่ที่ต้องการอัพเดทใหม่";
    exit;
}

$items = array();
foreach ($_POST['id'] as $key => $id) {
    $items[] = "'".($dbi->real_escape_string($id))."'";
}

$newItems = implode(',', $items);
$newDate = $_POST['new_date'];

$sql = sprintf("SELECT `row_id`,`actual_date` FROM `digital_opcard` WHERE `row_id` IN (%s)", $newItems);
$q = $dbi->query($sql);
if($q->num_rows>0){
    $error = '';
    while ($a = $q->fetch_assoc()) {
        
        $row_id = $a['row_id'];

        list($actualDate, $actualTime) = explode(' ', $a['actual_date']);

        $newActualDate = sprintf("%s $actualTime", $dbi->real_escape_string($newDate));

        $sqlUpdate = "UPDATE `digital_opcard` SET `actual_date` = '$newActualDate' WHERE `row_id` = '$row_id' ";
        $qUpdate = $dbi->query($sqlUpdate);
        if($qUpdate!==true){
            $error = $dbi->error;
        }
    }
    $msg = 'ดำเนินการแก้ไขเรียบร้อย';
    if(!empty($error)){
        $msg = $error;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เปลี่่ยนวันที่เข้ารับการรักษา</title>
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
        <h3><?=$msg;?></h3>
        <div>
            <a href="digital_opd_manage.php" class="btn btn-primary">กลับหน้าหลัก</a>
        </div>
    </div>
</body>
</html>