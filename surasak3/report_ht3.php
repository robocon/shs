<?php 
include 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

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
    <div class="container">
        <h3>ตัวชี้วัด Hypertension รายปี</h3>
        <h5>3.&#41; ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR </h5>
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
        <?php
        $yearSelected = $year+543;


        $sqlTemp = "CREATE TEMPORARY TABLE `tempory_opd` 
        SELECT y.*,x.`regis_id`,x.`regis_date` FROM 
        ( 
                SELECT b.`row_id`,b.`thdatehn`,b.`thidate`,b.`hn`,b.`ptname`,b.`bp1`,b.`bp2`,b.`bp3`,b.`bp4`,SUBSTR(b.`age`,1,2) AS `age`,a.`latest_row_id` FROM ( 
                        SELECT MAX(`row_id`) AS `latest_row_id`,`thidate` 
                        FROM `opd` 
                        WHERE `thidate` LIKE '2567%' 
                        AND ( `bp1` <> '' AND `bp2` <> '' AND `bp1` NOT LIKE '...%' ) 
                        GROUP BY `hn` 
                        ORDER BY `row_id` ASC 
                ) AS a 
                LEFT JOIN `opd` AS b ON b.`row_id` = a.`latest_row_id`
        ) AS y 
        LEFT JOIN (
                SELECT `ht_no` AS `regis_id`,`hn`,`thidate` AS `regis_date` FROM `hypertension_clinic` ORDER BY `row_id` ASC 
        ) AS x ON x.`hn` = y.`hn`
        where regis_id is not null 
        order by regis_id asc";
        dump($sqlTemp);
        $dbi->query($sqlTemp);



        $sql = "SELECT a.* 
        FROM ( SELECT * FROM tempory_opd WHERE regis_id IS NOT NULL ) AS a 
        LEFT JOIN ( 
            SELECT `row_id`,`date`,`hn`,`ptname`,`code`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn` 
            FROM `patdata` 
            WHERE `date` LIKE '$yearSelected%' 
            AND `hn` <> '' 
            AND ( `code` LIKE '41001%' OR `code` LIKE '%EKG%') 
            GROUP BY `hn`
        ) AS b ON a.thdatehn = b.thdatehn 
        WHERE b.row_id IS NOT NULL
        ORDER BY b.`date` DESC ;";
        dump($sql);
        $q = $dbi->query($sql);
        $a = $q->fetch_assoc();
        
        ?>
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
                        // dump($a);
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