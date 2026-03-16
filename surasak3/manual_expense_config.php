<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
if($action == 'save'){

    $part = sprintf("%s", $_POST['part']);
    $userRegis = sprintf("%s", $_POST['user']['regis']);
    $userLab = sprintf("%s", $_POST['user']['lab']);
    $userMoney = sprintf("%s", $_POST['user']['money']);
    $userXray = sprintf("%s", $_POST['user']['xray']);

    $dbi->query("UPDATE `expense_config` SET `name`='$userRegis' WHERE (`type`='regis');");
    $dbi->query("UPDATE `expense_config` SET `name`='$userLab' WHERE (`type`='lab');");
    $dbi->query("UPDATE `expense_config` SET `name`='$userMoney' WHERE (`type`='money');");
    $dbi->query("UPDATE `expense_config` SET `name`='$userXray' WHERE (`type`='xray');");

    redirect('manual_expense_config.php?part='.$part, "บันทึกข้อมูลเรียบร้อย");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าผู้ใช้งาน</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
require_once 'manual_expense_menu.php';

$part = sprintf($_GET['part']);
?>
<div class="container">
    <div>
        <h3>ตั้งค่าผู้ใช้งาน</h3>
    </div>
    <?php 
    if ($_SESSION['x-msg']) {
        ?>
        <div class="alert alert-warning" role="alert"><?=$_SESSION['x-msg'];?></div>
        <?php
        $_SESSION['x-msg'] = null;
    }
    ?>
    <div>
        <form action="manual_expense_config.php" method="post">
            <?php 
            $q = $dbi->query("SELECT * FROM `expense_config`");
            $config = array();
            while ($a = $q->fetch_assoc()) {
                $type = $a['type'];
                $config[$type] = $a['name'];
            }
            
            ?>
            <div class="row mb-3">
                <div class="col-8">
                    <div class="row">
                        <label for="userRegis" class="col-sm-3 col-form-label">จนท.ทะเบียน</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="userRegis" name="user[regis]" value="<?=$config['regis'];?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-8">
                    <div class="row">
                        <label for="userLab" class="col-sm-3 col-form-label">จนท.ห้องพยาธิ</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="userLab" name="user[lab]" value="<?=$config['lab'];?>">
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-8">
                    <div class="row">
                        <label for="userMoney" class="col-sm-3 col-form-label">จนท.ห้องส่วนเก็บเงิน</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="userMoney" name="user[money]" value="<?=$config['money'];?>">
                            <span class="text-danger">จนท.ส่วนเก็บเงินจำเป็นต้องใช้ <strong>คำนำหน้า</strong></span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-8">
                    <div class="row">
                        <label for="userXray" class="col-sm-3 col-form-label">จนท.ห้อง X-Ray</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="userXray" name="user[xray]" value="<?=$config['xray'];?>">
                        </div>
                    </div>
                </div>
            </div>
            
            <div>
                <button type="submit" class="btn btn-primary">บันทึกข้อมูล</button>
                <input type="hidden" name="part" value="<?=$part;?>">
                <input type="hidden" name="action" value="save">
            </div>
        </form>
    </div>
</div>
    
</body>
</html>