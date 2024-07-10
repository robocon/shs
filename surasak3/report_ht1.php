<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

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
        <h3>ตัวชี้วัด Hypertension รายปี</h3>
        <h5>1.&#41; ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง</h5>
        <div class="row">
            <div class="col-sm-6">
                <table class="table">
                    <tr>
                        <th>ยอด OPD</th>
                        <th>จำนวน HT</th>
                    </tr>
                    <tr>
                        <td><?=number_format($all);?></td>
                        <td><?=number_format($ht);?></td>
                    </tr>
                </table>
            </div>
        </div>
        <?php
        $year = $year+543;
        $sql = "SELECT y.*,x.`regis_id`,x.`regis_date` FROM 
        ( 

            SELECT b.`row_id`,b.`thidate`,b.`hn`,b.`ptname`,b.`bp1`,b.`bp2`,b.`bp3`,b.`bp4`,SUBSTR(b.`age`,1,2) AS age,a.`latest_row_id` FROM ( 
                SELECT MAX(`row_id`) AS `latest_row_id`,`thidate` 
                FROM `opd` 
                WHERE `thidate` LIKE '$year%' 
                AND ( `bp1` <> '' AND `bp2` <> '' AND `bp1` NOT LIKE '...%' ) 
                AND SUBSTR(`age`,1,2) > 35 
                GROUP BY `hn` 
                ORDER BY `row_id` ASC 
            ) AS a 
            LEFT JOIN `opd` AS b ON b.`row_id` = a.`latest_row_id`

        ) AS y 
        LEFT JOIN (
            SELECT `row_id` AS `regis_id`,`hn`,`ptname`,`thidate` AS `regis_date` FROM `diabetes_clinic` 
        ) AS x ON x.`hn` = y.`hn` 
        ORDER BY y.`row_id` ASC ";
        $q = $dbi->query($sql);
        ?>
        <div>
            <h3>ปี <?=$year;?></h3>
            <table class="table table-hover">
                <thead class="table-dark">
                    <tr>
                        <th>HN</th>
                        <th>ชื่อสกุล</th>
                        <th>วันที่มารับบริการ</th>
                        <th>เลขที่ HT</th>
                        <th>วันที่ลงทะเบียน HT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$a['hn'];?></td>
                        <td><?=$a['ptname'];?></td>
                        <td><?=$a['thidate'];?></td>
                        <td><?=$a['regis_id'];?></td>
                        <td><?=$a['regis_date'];?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </tbody>
            </table>
        </div>
    
    </div>
</body>
</html>