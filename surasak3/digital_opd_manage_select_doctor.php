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
$oldDoctor = $_POST['doctor'];
$q = $dbi->query(sprintf("SELECT `row_id`,`name` FROM `doctor` WHERE `row_id` = '%s' LIMIT 1 ", $oldDoctor));
$d = $q->fetch_assoc();

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
        <?php 
        if(!empty($ids)){
        ?>
        <form action="digital_opd_manage_update_doctor.php" method="post">

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">ชื่อแพทย์เดิม</label>
                <div class="col-sm-4"><?=$d['name'];?><input type="hidden" name="oldDoctor" value="<?=$d['row_id'];?>"></div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-2 col-form-label">เลือกแพทย์ใหม่</label>
                <div class="col-sm-4">
                    <?php 
                    $sql = "SELECT `row_id`,`name` FROM `doctor` WHERE `status` = 'y' AND `doctorcode` <> '' ";
                    $q = $dbi->query($sql);
                    ?>
                    <select name="doctor" id="doctor" class="form-select">
                        <option value="">แสดงทุกแพทย์</option>
                        <?php 
                        while ($a = $q->fetch_assoc()) { 
                            ?>
                            <option value="<?=$a['row_id'];?>"><?=$a['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <button type="submit" class="btn btn-primary mb-3">ดำเนินการเปลี่ยนชื่อแพทย์</button>
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
        <?php
        }else{
        ?><p><strong>กรุณาเลือกรายการอย่างน้อย 1รายการ</strong></p><?php
        }
        ?>
    </div>
</body>
</html>