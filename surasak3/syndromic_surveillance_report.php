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
    <title>Syndromic Surveillance Report</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div class="container">
        <div>
            <h3>Syndromic Surveillance Report</h3>
        </div>
        <div>
            <form class="row g-3" action="syndromic_surveillance_report.php" method="post">
                <div class="col-auto">
                    <label for="staticEmail2" class="visually-hidden">ค้นหาจากวันที่</label>
                    <!-- <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="email@example.com"> -->
                </div>
                <div class="col-auto">
                    <label for="date" class="visually-hidden">วันที่</label>
                    <input type="text" class="form-control" id="date" placeholder="">
                </div>
                <div class="col-auto">
                    <button type="submit" class="btn btn-primary mb-3">ค้นหา</button>
                </div>
            </form>
        </div>
    <table class="table table-striped table-hover">
        <tr>
            <th></th>
            <th>วัน-เวลา</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>อายุ</th>
            <th>สิทธิ์</th>
            <th>โรค</th>
            <th>ICD10</th>
            <th>ปัตร ปชช</th>
            <th>ที่อยุ่</th>
            <th>ตำบล</th>
            <th>อำเภอ</th>
            <th>จังหวัด</th>
            <th>โทรศัพท์</th>
        </tr>
        <?php 
        $sql = "SELECT a.`svdate`,a.`hn`,a.`diag`,a.`icd10`,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname`,b.`dbirth`,b.`ptright`,b.`idcard`,b.`address`
        FROM `diag` AS a 
        LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
        WHERE a.`icd10` REGEXP '(A04[0-9])$' 
        OR a.`icd10` REGEXP '(A08[0-5])$' 
        OR a.`icd10` = 'A090' 
        OR a.`icd10` = 'A099' 
        ORDER BY a.`svdate` DESC;";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td></td>
                    <td><?=$a['svdate'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td>อายุ</td>
                    <td><?=$a['ptright'];?></td>
                    <td><?=$a['diag'];?></td>
                    <td><?=$a['icd10'];?></td>
                    <td><?=$a['idcard'];?></td>
                    <td>ที่อยุ่</td>
                    <td>ตำบล</td>
                    <td>อำเภอ</td>
                    <td>จังหวัด</td>
                    <td>โทรศัพท์</td>
                </tr>
                <?php
            }
        }
        ?>
    </table>
    </div>
</body>
</html>