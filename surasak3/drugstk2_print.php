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
    <title>พิมพ์สติกเกอร์ติด OPD ย้อนหลัง</title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <div>
        <?php 
        $row_id = sprintf("%s", $_GET['id']);

        $sql = sprintf("SELECT * FROM `phardep` WHERE `row_id` = '%s' ", 
        $dbi->real_escape_string($row_id));
        $q = $dbi->query($sql);
        $phar = $q->fetch_assoc();
        ?>
        <div style="font-family: 'MS Sans Serif';">
            <p class="mb-0" style="font-size:10px;"><?=$phar['date'];?> HN:<?=$phar['hn'];?>, AN:<?=$phar['an'];?></p>
            <p class="mb-1" style="font-size:10px;"><?=$phar['ptname'];?> โรค: <?=$phar['diag'];?></p>
            <table style="font-size: 12px; line-height: 12px;">
            <?php
            $statement = "SELECT a.*,b.`unit`
            FROM `drugrx` AS a 
            LEFT JOIN `druglst` AS b ON a.`drugcode` = b.`drugcode`
            WHERE a.`idno` = '%s' ";
            $sql = sprintf( $statement, $dbi->real_escape_string($row_id));
            $q = $dbi->query($sql);
            if($q->num_rows>0){
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$a['tradname'];?>(<?=$a['unit'];?>)</td>
                        <td><?=$a['slcode'];?></td>
                        <td class="ml-2"><?=$a['amount'];?></td>
                    </tr>
                    </div>
                    <?php
                }
            }
            ?>
            </table>
        </div>
    </div>
    <script>
        window.onload = function(){
            window.print();
        }
    </script>
</body>
</html>