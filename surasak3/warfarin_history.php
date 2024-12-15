<?php 
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$opcard = new Opcard();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติการรับยา Warfarin และยากลุ่ม NOACs</title>
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
            font-size:18px;
        }
        table.table th{
            background-color: #13795b; 
            color: #ffffff;
        }
    </style>
    <div class="container">
        <h3>ประวัติการรับยา Warfarin และยากลุ่ม NOACs ในช่วง 6เดือนย้อนหลัง</h3>
    <?php 
    $hn = $_REQUEST['hn'];
    if(!empty($hn)){
        $sixMonthsLater = strtotime("-6 Months");
        $sixMonthsTH = (date('Y',$sixMonthsLater)+543).date('-m-d',$sixMonthsLater);

        $op = $opcard->getByHn($hn);

        $sql = sprintf("SELECT a.*,b.`doctor`,c.`genname` FROM (
            SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,`amount`,`idno` 
            FROM `drugrx` 
            WHERE `hn` = '%s' 
            AND `date` >= '$sixMonthsTH'
            AND `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2','1LIX','1ELI5','1PRADA','1PRAD150') 
            AND (`status` = 'Y' AND `amount` > 0)
            ORDER BY `row_id` DESC
        ) AS a LEFT JOIN `phardep` AS b ON a.`idno` = b.`row_id` 
        LEFT JOIN `druglst` AS c ON c.`drugcode` = a.`drugcode`",
            $dbi->real_escape_string($hn)
        );
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <div>
                <p><strong>HN:</strong> <?=$op['hn'];?></p>
                <p><strong>ชื่อสกุล:</strong> <?=$op['ptname'];?></p>
            </div>
            <table class="table table-hover">
                <tr>
                    <th>วันที่จ่ายยา</th>
                    <th>แพทย์ผู้สั่ง</th>
                    <th>ยา</th>
                    <th>จำนวน</th>
                </tr>
                <?php 
                while ($a = $q->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?=$a['date'];?></td>
                        <td><?=$a['doctor'];?></td>
                        <td><?=$a['tradname'];?> [<?=$a['drugcode'];?>]<br><?=$a['genname'];?></td>
                        <td><?=$a['amount'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>
            <?php
        }else{
            ?>
            <p><strong>ไม่พบข้อมูล</strong></p>
            <?php
        }
    }else{
        ?>
        <p><strong>กรุณาระบุ HN ด้วยครับ</strong></p>
        <?php
    }
    ?>
    </div>
</body>
</html>