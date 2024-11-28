<?php 
require_once 'bootstrap.php';

$smenucode = sprintf("%s", $_SESSION['smenucode']);
if($smenucode!=='ADM' AND $smenucode!=='ADMCOM'){
    echo "Permission Deny";
    exit;
}

$ids = $_POST['id'];
$date = $_POST['date'];
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
        <form action="digital_opd_manage_update.php" method="post">
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="new_date" class="form-label"><strong>เลือกวันที่เข้ารับการรักษาใหม่</strong></label>
                    <input type="date" class="form-control" id="new_date" name="new_date" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-primary mb-3">ดำเนินการเปลี่ยนวันที่</button>
                    <input type="hidden" name="date" value="<?=$date;?>">
                    <?php 
                    foreach ($ids as $key => $id) {
                        ?>
                        <input type="hidden" name="id[]" value="<?=$id;?>">
                        <?php
                    }
                    ?>
                </div>
            </div>
        </form>
    </div>
</body>
</html>