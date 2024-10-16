<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ปริ้นสติกเกอร์ติด IPD ย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>

<body>
    <style>
        * {
            font-family: "TH SarabunPSK";
            font-size:20px;
        }
    </style>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.htm">&#127968; หน้าหลัก</a>
        </div>
    </nav>
    <div class="container mt-4">
        <h1>ปริ้นสติกเกอร์ติด IPD ย้อนหลัง</h1>
        <form action="drugIpdReprint.php" method="POST" class="row g-3">
            <div class="col-auto">
                <label for="an" class="visually-hidden">AN</label>
            </div>
            <div class="col-auto">
                <label for="an" class="visually-hidden">AN</label>
                <input type="text" class="form-control" id="an" name="an" placeholder="ตัวอย่าาง 67/999">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
                <input type="hidden" name="action" value="search">
            </div>
        </form>
        <?php 
        dump($_POST);
        $action = sprintf("%s", $_POST['action']);
        if($action==='search'){ 

            // $opts = array(
            //     'http'=>array(
            //       'method'=>"GET",
            //     )
            // );
            // $context = stream_context_create($opts);
            $an = sprintf("%s", $_POST['an']);
            $file = file_get_contents('http://localhost:8080/sm3dev/surasak3/drugstk2.php?an='.$an);
            // var_dump($file);
            echo $file;
        }
        ?>
    </div>
</body>
</html>