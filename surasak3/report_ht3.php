<?php 
require_once 'bootstrap.php';
require_once 'class_file/ReportHt.php';

// รูปแบบไทย
$year = sprintf("%s", $_GET['year']);
$ht_all = sprintf("%s", $_GET['ht_all']);
$ecgCxr = sprintf("%s", $_GET['ecgCxr']);
/*
ต้องการสรุปตัวชี้วัดรายปี. 
1ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง 
2ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี ( <140/90 ) **ดึงจากการวัดครั้งที่2 
3ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR 
4ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin 5ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr ให้มีข้อมูลเหมือนคลินิกเบาหวาน
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR </title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <style>
    *{
        font-family: "TH SarabunPSK";
    }
    th,td{
        font-size: 18px;
    }
    table.table th{
		background-color: #13795b; 
		color: #ffffff;
	}
    </style>
</head>
<body>
    <div class="container mt-4">
        <h3>ตัวชี้วัด Hypertension รายปี</h3>
        <h5>3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR </h5>
        <?php
        $ht = new ReportHt();
        $yearSelected = $year+543;

        // สร้าง temporary table ระหว่าง opd กับ diag
        $ht->generateTempOpdXDiag($yearSelected);
        $qAllOpdXDiag = $ht->getAllOpdXDiag();
        $ht_all = $qAllOpdXDiag->num_rows;

        $q = $ht->getXrayXEkg($yearSelected);
        $ecgCxrRows = $q->num_rows;
        ?>
        <div class="row">
            <div class="col-sm-6">
                <table class="table">
                    <tr>
                        <th>จำนวนผู้ป่วย HT</th>
                        <th>จำนวนที่เข้าเกณฑ์</th>
                    </tr>
                    <tr>
                        <td><?=number_format($ht_all);?></td>
                        <td><?=number_format($ecgCxr);?></td>
                    </tr>
                </table>
            </div>
        </div>
        <div>
            <h3>ปี <?=$year;?></h3>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th>ชื่อสกุล</th>
                        <th>วันที่รับบริการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $i = 1;
                    while ($a = $q->fetch_assoc()) { 
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['ptname'];?></td>
                        <td><?=$a['thidate'];?></td>
                    </tr>
                    <?php 
                        $i++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    
    </div>
</body>
</html>