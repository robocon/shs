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
    <title>ผู้ป่วยนัดแผนกกายภาพ</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        table.table th{
            background-color: #13795b; 
            color: #ffffff;
        }
    </style>
    <nav class="navbar navbar-expand-md mb-4 d-print-none" data-bs-theme="dark" style="background-color: #13795b;">
		<div class="container-fluid">
			<a class="navbar-brand" href="../nindex.htm">หน้าหลัก</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
	</nav>
    <div class="container">
        <h3 class="mt-4">ผู้ป่วยนัดแผนกกายภาพ</h3>
        <?php 
        $today = date('Y-m-d');
        $tomorrow = date('Y-m-').sprintf("%02d", (date('d')+1));
        $sql = "SELECT *,SUBSTRING(`date`,1,10) AS `shortDate`,SUBSTRING(depcode,1,3) AS `depcodeCode` 
        FROM `appoint` 
        WHERE `appdate_en` IN ('$today','$tomorrow') 
        AND `apptime` != 'ยกเลิกการนัด' 
        AND `detail` LIKE 'FU10%' 
        GROUP BY `doctor`,`hn` 
        ORDER BY `appdate_en`,`row_id` ASC ";
        
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table class="table table-hover mt-4">
                <tr>
                    <th>#</th>
                    <th>วันที่ลงนัด</th>
                    <th>นัดมาวันที่</th>
                    <th>เวลา</th>
                    <th>ผู้บันทึก</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>แผนกที่นัด</th>
                    <th></th>
                </tr>
            <?php
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                $classColor = '';
                if($a['depcodeCode']!='U20'){
                    $classColor = 'table-danger';
                }
                ?>
                <tr class="<?=$classColor;?>">
                    <td><?=$i;?></td>
                    <td><?=$a['shortDate'];?></td>
                    <td><?=$a['appdate'];?></td>
                    
                    <td><?=$a['apptime'];?></td>
                    <td><?=$a['officer'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['depcode'];?></td>
                    <td></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            </table>
            <?php
        }else{
            ?>
            <p><strong>ไม่พบข้อมูล</strong></p>
            <?php
        }
        
        ?>
    </div>
</body>
</html>