<?php 
require 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$group = sprintf("%s", $_GET['group']);
$where = '';
if(!empty($group)){
    $where = "AND `menucode` = '$group'";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อ Admin ประจำแผนก</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <h3>รายชื่อ Admin ประจำแผนก</h3>
        <div class="alert alert-warning" role="alert">หากรายชื่อไม่ถูกต้อง กรุณาประสานศูนย์คอมพิวเตอร์เพื่อทำการอัพเดทข้อมูลด้วยครับ ขอบคุณครับ</div>
        <table class="table">
            <tr>
                <th>ชื่อ-สกุล</th>
                <th></th>
            </tr>
            <?php 
            $sql = "SELECT * FROM `inputm` WHERE `status` = 'y' $where AND `level` = 'admin' AND `menucode` != 'ADM' ORDER BY `menucode` ASC";
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$a['name'];?></td>
                        <td><?=$a['menucode'];?></td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
    
</body>
</html>