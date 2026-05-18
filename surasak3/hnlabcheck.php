<?php
include("connect.php");
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสอบ LAB</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { 
            font-family: 'TH SarabunPSK', sans-serif;
            font-size: 16pt;
        }
    </style>
</head>
<body class="bg-light text-dark">

<div class="container py-5">
    <!-- Header Section -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">ตรวจสอบ LAB</h2>
        <p class="text-secondary">ค้นหาข้อมูลผลการทดสอบทางห้องปฏิบัติการ</p>
    </div>

    <!-- Search Card -->
    <div class="row justify-content-center mb-5">
        <div class="col-md-8 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <form method="post" action="hnlabcheck.php">
                        <div class="mb-4">
                            <label for="hn" class="form-label fw-bold small text-muted text-uppercase" style="letter-spacing: 1px;">เลขทะเบียนผู้ป่วย (HN)</label>
                            <input type="text" name="hn" id="hn" class="form-control form-control-lg bg-light border-0 rounded-3" placeholder="ระบุ HN" required>
                        </div>
                        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
                            <button type="submit" name="B1" class="btn btn-primary btn-lg px-5 rounded-3 shadow-sm">ตกลง</button>
                            <a href="../nindex.htm" class="btn btn-outline-secondary btn-lg px-5 rounded-3">&lt;&lt;&nbsp;ไปเมนู</a>
                            <a href="doctor_lab.php" class="btn btn-info btn-lg px-5 rounded-3" target="_blank">ติดตามผลแลปผู้ป่วยนอก</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Results Table -->
    <?php
    $hn = $_POST['hn'];
    if (!empty($hn)) {
        $query = "SELECT hn,an,ptname,detail,date FROM patdata WHERE hn = '$hn'and depart='patho' order by date desc";
        $result = mysql_query($query) or die("Query failed");
        
        if (mysql_num_rows($result) > 0) {
    ?>
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-4 py-3 border-0 text-muted small text-uppercase" style="letter-spacing: 0.5px;">HN</th>
                        <th class="py-3 border-0 text-muted small text-uppercase" style="letter-spacing: 0.5px;">AN</th>
                        <th class="py-3 border-0 text-muted small text-uppercase" style="letter-spacing: 0.5px;">ชื่อ-สกุล</th>
                        <th class="py-3 border-0 text-muted small text-uppercase" style="letter-spacing: 0.5px;">รายการ</th>
                        <th class="pe-4 py-3 border-0 text-muted small text-uppercase text-end" style="letter-spacing: 0.5px;">วันและเวลา</th>
                    </tr>
                </thead>
                <tbody class="border-top-0">
                    <?php
                    while (list($hn, $an, $ptname, $detail, $date) = mysql_fetch_row($result)) {
                        echo "<tr>
                            <td class='ps-4 py-3 fw-medium text-primary'>$hn</td>
                            <td class='py-3'>$an</td>
                            <td class='py-3'>$ptname</td>
                            <td class='py-3'>$detail</td>
                            <td class='pe-4 py-3 text-muted small text-end'>$date</td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <?php 
        } else {
            echo '<div class="text-center p-5 text-muted">ไม่พบข้อมูลสำหรับ HN นี้</div>';
        }
    } 
    ?>
</div>

<!-- Bootstrap 5.3.3 JS Bundle -->
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>