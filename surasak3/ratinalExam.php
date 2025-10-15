<?php
require_once 'bootstrap.php';
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
    <title>Ratinal Exam</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<div class="container">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 16pt;
        }
        #opdTb tr th{
            background-color: #13795b;
            color:#ffffff;
        }
        label:hover{
            cursor: pointer;
        }
        fieldset{
            border: 1px solid red;
        }
    </style>
    <nav class="navbar navbar-expand-lg" id="" data-bs-theme="dark">
        <div class="container-fluid">
        <a class="navbar-brand" href="../nindex.htm">🏠</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">รายชื่อ</a>
            </li>
            </ul>
        </div>
        </div>
    </nav>
    <div>
        <h3>ฟอร์มกรอกข้อมูล Ratinal Exam</h3>
        <form class="row g-3" action="ratinalExam.php" method="POST">
            <div class="col-auto">
                <label for="hn" class="col-form-label fw-bold">HN</label>
            </div>
            <div class="col-auto">
                <input type="text" class="form-control" id="hn" name="hn" placeholder="Example 47-xxx">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-secondary mb-3">ค้นหา</button>
                <input type="hidden" name="action" value="search">
            </div>
        </form>
    </div>
    
    <?php
    $action = sprintf("%s", $_POST['action']);
    if($action==="search"){
        ?>
        <div class="mt-4">
        <form class="row g-3 col-lg-12" action="ratinalExam.php" method="post">
            <div class="mb-2 row">
                <label for="date" class="col-sm-4 col-md-3 col-form-label fw-bold">วันที่มารับบริการ</label>
                <div class="col-sm-8 col-md-5">
                    <div class="input-group">
                        <input type="text" class="form-control" id="date" name="date">
                        <button class="btn btn-secondary">เลือกวันที่</button>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label class="col-sm-4 col-md-3 col-form-label fw-bold">Retina Exam</label>
                <div class="col-sm-5 col-md-5">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal1" value="No DR">
                        <label for="retinal1" class="form-check-label">No DR</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal2" value="Mind DR">
                        <label for="retinal2" class="form-check-label">Mind DR</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal3" value="Moderate DR">
                        <label for="retinal3" class="form-check-label">Moderate DR</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="retinal" id="retinal4" value="Severe DR">
                        <label for="retinal4" class="form-check-label">Severe DR</label>
                    </div>
                </div>
            </div>
            <div class="mb-2 row">
                <label for="date" class="col-sm-4 col-md-3 col-form-label fw-bold">การรักษา</label>
                <div class="col-sm-8 col-md-5">
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="follow" id="follow1" value="ติดตามอาการ">
                        <label for="follow1" class="form-check-label">ติดตามอาการ</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="follow" id="follow2" value="Laser">
                        <label for="follow2" class="form-check-label">Laser</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" class="form-check-input" name="follow" id="follow3" value="other">
                        <div class="input-group">
                            <div>
                                <label for="follow3" class="form-check-label">Other</label>
                            </div>
                            &nbsp;<input type="text" class="form-control form-control-sm" name="followText" id="followText">
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto">
                <button class="btn btn-primary" type="submit">บันทึกข้อมูล</button>
            </div>
        </form>
        </div>
        <?php
    }
    ?>
    
</div>
</body>
</html>