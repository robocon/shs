<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พิมพ์ทะเบียนแรกรับย้อนหลัง</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        #ptReh{
            background-color: #13795b;
            color:#ffffff;
        }
    </style>
    <nav class="navbar navbar-expand-lg" id="ptReh" data-bs-theme="dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm">Home</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="$">รายชื่อ</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <div class="container">
        <table class="table">
            <tr>
                <th>asdf</th>
            </tr>
            <tr>
                <td>asdf</td>
            </tr>
        </table>
    </div>
</body>
</html>