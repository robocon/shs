<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = new Services_JSON();

$sIdname = sprintf("%s", $_SESSION['sIdname']);
$sOfficer = sprintf("%s", $_SESSION['sOfficer']);
if(empty($sIdname)){
    echo "Invalid";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อแพทย์ร้องขอ</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <?php 
    require_once 'com_user_menu.php';
    ?>
    <div class="container mt-4">
        <h3>รายชื่อแพทย์ขอใช้งานระบบ</h3>
        <table class="table">
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </table>
    </div>
</body>
</html>