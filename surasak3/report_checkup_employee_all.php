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
    <title>รายชื่อลูกจ้างตรวจสุขภาพปี67</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php 
    $yearCheckup = get_year_checkup(true);
    $sql = "SELECT *,SUBSTRING(thidate,1,10) AS thidate 
    FROM opday 
    WHERE ptright LIKE 'R42%' 
    AND (thidate >= '2567-01-29' AND thidate <= '2567-02-02' ) 
    ORDER BY thidate ASC";
    $q = $dbi->query($sql);
    ?>
    <div class="container">
        <h1>รายชื่อลูกจ้างตรวจสุขภาพปี67</h1>
        <h3><small class="text-body-secondary">ระหว่างวันที่ 29 ม.ค. 67 ถึง 2 ก.พ. 67</small></h3>
        
        <table class="table table-sm table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th>แผนก</th>
                    <th>วันที่</th>
                    <th>HN</th>
                    <th>ชื่อสกุล</th>
                    <th>อายุ</th>
                    <th>สิทธิ</th>
                </tr>
            </thead>
        <?php
        if($q->num_rows>0){
            while ($a = $q->fetch_assoc()) {
                $thidate = $a['thidate'];

                $hn = $a['hn'];

                $sqlLab67 = "SELECT depart,lab FROM lab67 WHERE hn = '$hn'";
                $qLab67 = $dbi->query($sqlLab67);
                $lab67 = $qLab67->fetch_assoc();
                
                ?>
                <tr>
                    <td><?=$lab67['depart'];?></td>
                    <td><?=$a['thidate'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['age'];?></td>
                    <td><?=$a['ptright'];?></td>
                </tr>
                <?php
            }
        }
        ?>
        </table>
            
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>