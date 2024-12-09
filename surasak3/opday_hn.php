<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/class_file/class_opcard.php';
require_once dirname(__FILE__).'/class_file/class_depart.php';
require_once dirname(__FILE__).'/class_file/class_drug.php';
$depart = new ClassDepart();
$opcard = new Opcard();
$drug = new Drug();

$hn = $_GET['hn'];

$dItems = $drug->getTodayDPhardepFromHn($hn);

$user = $opcard->getByHn($hn,array('hn'));
$todayTh = (date('Y')+543).date('-m-d');

$items = $depart->getDepart($todayTh, $hn);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ค่าใช้จ่าย <?=sprintf("%s", $hn);?> วันที่ <?=$todayTh;?></title>
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
    <style>
        table.table th{
            background-color: #13795b;
            color: #ffffff;
        }
    </style>
</head>
<body>
    <div class="container mt-2">
        <h1>ค่าใช้จ่าย HN: <?=$hn;?> วันที่ <?=$todayTh;?></h1>
        <div class="row mt-4">
            <h3>รายการตรวจวิเคราะห์โรค/หัตถการ</h3>
            <?php 
            if(!empty($items)){
            ?>
            <table class="table" id="table1">
                <tr>
                    <th>เวลา</th>
                    <th>รายละเอียด</th>
                    <th>ราคา</th>
                </tr>
                <?php 
                foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=substr($item['date'],10);?> น.</td>
                    <td><?=$item['detail'];?></td>
                    <td><?=$item['price'];?></td>
                </tr>
                <?php
                }
                ?>
                
            </table>
            <?php
            }else{
                ?><p><strong>ไม่พบค่าใช้จ่าย</strong></p><?php
            }
            ?>
        </div>
        <div class="row mt-4">
            <h3>รายการยา/เวชภัณฑ์ </h3>
            <?php 
            if(!empty($dItems)){
                ?>
                <table class="table" id="table2">
                    <tr>
                        <th>เวลา</th>
                        <th>แพทย์ผู้สั่ง</th>
                        <th>ราคา</th>
                    </tr>
                    <?php 
                    foreach ($dItems as $key => $d) {
                    ?>
                    <tr>
                        <td><?=substr($item['date'],10);?> น.</td>
                        <td><?=$d['doctor'];?></td>
                        <td><?=$d['price'];?></td>
                    </tr>
                    <?php 
                    }
                    ?>
                </table>
                <?php
            }else{
                ?><p><strong>ไม่พบการสั่งใช้ยาจากแพทย์</strong></p><?php
            }
            ?>
            
        </div>
    </div>
</body>
</html>