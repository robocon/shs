<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = sprintf("%s", $_GET['id']);
if(empty($id)){
    echo "Invalid value";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reprint สติกเกอร์ยาผู้ป่วยในย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <table>
            <tr>
                <th>วันที่</th>
                <th></th>
            </tr>
            <?php 
            $sql = "SELECT * FROM `drugrx` WHERE `idno` = '$id' ";
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                while($a = $q->fetch_assoc()){
                    dump($a['drugcode']);
                }
            }
            ?>
        </table>
    </div>
</body>
</html>