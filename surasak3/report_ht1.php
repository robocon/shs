<?php 
require_once 'bootstrap.php';
require_once 'class_file/ReportHt.php';

// รูปแบบไทย
$year = sprintf("%s", $_GET['year']);
$all = sprintf("%s", $_GET['all']);
$ht = sprintf("%s", $_GET['ht']);
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
    <title>1.&#41; ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    h3{
        font-weight: bold;
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
    <div class="container">
        <h3 class="mt-4">ตัวชี้วัด Hypertension รายปี</h3>
        <h5>1.&#41; ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง</h5>
        <div class="row">
            <div class="col-sm-6">
                <table class="table">
                    <tr>
                        <th>จำนวนผู้ป่วย HT</th>
                        <th>จำนวนที่ผ่านเกณฑ์</th>
                    </tr>
                    <tr>
                        <td><?=number_format($all);?></td>
                        <td><?=number_format($ht);?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
        $ht = new ReportHt();

        $yearSelected = $year+543;

        // สร้าง temporary table ระหว่าง opd กับ diag
        $q = $ht->generateTempOpdXDiag($yearSelected);
        
        ?>
        <div>
            <h3>ปี <?=$year;?></h3>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>HN</th>
                        <th>ชื่อสกุล</th>
                        <th>อายุ(ปี)</th>
                        <th>วันที่มารับบริการ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $qAgeMore35 = $ht->getAgeMoreThan35();
                    $i = 1;
                    while ($a = $qAgeMore35->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['ptname'];?></td>
                        <td><?=$a['age'];?></td>
                        <td><?=$a['thidate'];?></td>
                    </tr>
                    <?php 
                        $i++;
                    }
                    ?>
                    <tr>
                        <td colspan="5">
                            <h3 class="text-danger">อายุน้อยกว่า หรือเท่ากับ 35ปี</h3>
                        </td>
                    </tr>
                    <?php 
                    $qAgeLessThan35 = $ht->getAgeLessThan35();
                    $i = 1;
                    while ($a = $qAgeLessThan35->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?=$i;?></td>
                            <td><?=$a['hn'];?></td>
                            <td><?=$a['ptname'];?></td>
                            <td><?=$a['age'];?></td>
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