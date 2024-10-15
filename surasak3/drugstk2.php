<?php 
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
$an = sprintf("%s", $_GET['an']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เลือกวันที่ - พิมพ์สติกเกอร์ติด OPD ย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 18px;
        }
        
        table.table th, #table-title{
            background-color: #13795b;
        }
    </style>
    <div>
        <div class="container mt-2" id="info">
            <?php 
            $stm = "SELECT `an`,`ptname` FROM `ipcard` WHERE `an` = '%s'";
            $sql = sprintf($stm, $dbi->real_escape_string($an));
            $q = $dbi->query($sql);
            $ipcard = $q->fetch_assoc();
            ?>
            <table>
                <tr>
                    <td align="right"><strong>AN : </strong></td>
                    <td><?=$ipcard['an'];?></td>
                </tr>
                <tr>
                    <td><strong>ชื่อ-สกุล : </strong></td>
                    <td><?=$ipcard['ptname'];?></td>
                </tr>
            </table>
        </div>

        <table class="table table-striped table-hover mt-2">
            <thead class="table-dark bg-success" id="table-title">
                <tr>
                    <th>#</th>
                    <th>วันที่</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                    <th>จนท.</th>
                    <th>สถานะ</th>
                </tr>
            </thead>
            <?php 
            $statement = "SELECT a.*,b.`status` 
            FROM ( 
                SELECT `row_id`,`date`,`an`,`ptname`,`price`,`idname`,`diag`,`ptright`,`item`
                FROM `phardep` WHERE `an` = '%s' 
                AND (`price` > 0 AND `borrow` IS NULL) 
            ) AS a 
            LEFT JOIN ( 
                SELECT `idno`,`status` 
                FROM `ipacc` 
                WHERE `an` = '%s' 
                GROUP BY `idno` 
            ) AS b ON a.`row_id` = b.`idno` ORDER BY a.`date` DESC";
            $sql = sprintf($statement, $dbi->real_escape_string($an), $dbi->real_escape_string($an));
            
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                $i = 1;
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><a href="javascript:void(0)" onclick="window.open('drugstk2_print.php?id=<?=$a['row_id'];?>','drugstk2_print','width=600,height=400')"><?=$a['date'];?></a></td>
                        <td><?=$a['item'];?></td>
                        <td><?=$a['price'];?></td>
                        <td><?=$a['idname'];?></td>
                        <td><?=$a['status'];?></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
                <?php
            }
            ?>
        </table>
    </div>
</body>
</html>