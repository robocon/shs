<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายงาน Retinal Exam</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-lg" id="navMenu" data-bs-theme="dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="../nindex.htm">🏠</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-3 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="retinalExam.php">Retinal Exam</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="retinalExamReport.php">Report</a>
            </li>
        </ul>
    </div>
    </div>
</nav>
<div class="container">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 16pt;
        }
        #navMenu, #opdTb tr th, .swal2-html-container table tr th{
            background-color: #13795b;
            color:#ffffff;
        }
        label:hover{
            cursor: pointer;
        }
    </style>
    <h3 class="mt-3">รายงาน Retinal Exam</h3>
    <form class="row mt-3 mb-3" action="retinalExamReport.php" method="POST">
        <div class="col-sm-8 col-md-6 col-lg-4">
            <label for="hn" class="form-label fw-bold">ค้นหาจาก วันที่</label>
            <div class="input-group">
                <input type="date" class="form-control" id="date" name="date" value="2025-11-20">
                <button class="btn btn-secondary" type="submit">ค้นหา</button>
            </div>
            <input type="hidden" name="page" value="search">
        </div>
    </form>
    <?php
    if($_POST['page']=='search'){
        dump($_POST);
        $sql = "SELECT * FROM `retinal_exam` WHERE `";
    }
    ?>
</div>
</body>
</html>