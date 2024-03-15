<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", (!empty($_POST['action']) ? $_POST['action'] : '' ));
if($action==='save'){
    $reh_number = sprintf("%d", $_POST['reh_number']);
    $reh_year = sprintf("%d", $_POST['reh_year']);
    $runnoUpdate = $dbi->query("UPDATE `runno` SET `runno` = '$reh_number', `prefix` = '$reh_year' WHERE `title` = 'ptReh' ");
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if($runnoUpdate===false){
        $msg = 'ไม่สามารถบันทึกข้อมูลได้';
    }
    redirect('pt_reh_setup.php', $msg);
    exit;
}

$query = $dbi->query("SELECT `runno`,`prefix` FROM `runno` WHERE `title`='ptReh' ");
$runno = $query->fetch_assoc();
$ptReh = $runno['runno'];
$ptPrefixReh = $runno['prefix'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่า พิมพ์ทะเบียนแรกรับย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
require_once 'pt_reh_menu.php';
?>
<div class="container mt-4">
    <h3 class="h3">ตั้งค่าเลข REH</h3>
    <div class="row">
        <div class="col-sm-6">
            <form action="pt_reh_setup.php" method="post">
                <div class="mb-3">
                    <label for="reh_number" class="form-label">เลขที่ REH เลขถัดไป</label>
                    <input type="text" class="form-control" id="reh_number" name="reh_number" value="<?=$ptReh;?>">
                </div>
                <div class="mb-3">
                    <label for="reh_year" class="form-label">ปีงบประมาณ</label>
                    <input type="text" class="form-control" id="reh_year" name="reh_year" value="<?=$ptPrefixReh;?>">
                </div>
                <div class="mb-3">
                    <button type="submit" class="btn btn-primary">บันทึก</button>
                    <input type="hidden" name="action" value="save">
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>