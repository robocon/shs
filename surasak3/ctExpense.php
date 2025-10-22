<?php
require_once 'bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
$defaultDate = (date('Y')+543).date('-m-d');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 16pt;
        }
        #tableShow tr th{
            background-color: #198754;
            color: #ffffff;
        }
    </style>
<div class="container">
    <div class="mt-2">
        <h3 class="">CT Scan</h3>
    </div>
    <form action="ctExpense.php" method="post" class="mb-2">
        <div class="mb-2">
            <label for="dateSelect">เลือกเดือน</label>
            <input type="text" class="form-contro" name="dateSelect" id="dateSelect" value="<?=$defaultDate;?>">
        </div>
        <div class="mb-2">
            <input type="submit" class="btn btn-primary" value="ค้นหา">
            <input type="hidden" name="action" value="search">
        </div>
    </form>
    <?php
    $action = sprintf("%s", $_POST['action']);
    if($action==='search' && !empty($_POST['dateSelect'])){
        $sql = sprintf("SELECT * FROM `depart` WHERE `date` LIKE '%s%%' AND `idname` = 'เจ้าหน้าที่ x-ray คอมพิวเตอร์' AND `an` = '' AND ( `price` > 0 AND `status` = 'Y' ) ORDER BY `row_id` DESC", $dbi->real_escape_string($_POST['dateSelect']));
        $q = $dbi->query($sql);
        if($q->num_rows>0){
            ?>
            <table class="table table-sm table-striped table-hover" id="tableShow">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>วัน-เวลา</th>
                        <th>HN</th>
                        <th>ชื่อ-สกุล</th>
                        <th>depart</th>
                        <th>detail</th>
                        <th>price</th>
                        <th>ptright</th>
                        <th>cashok</th>
                    </tr>
                </thead>
                <tbody>
            <?php 
            $i = 1;
            $sum = 0;
            $cashList = array();
            $emptyCash = 0;
            while ($a = $q->fetch_assoc()) {
                $sum += $a['price'];
                $cashKey = $a['cashok'];
                if(!empty($a['cashok']) && empty($cashList[$cashKey])){
                    $cashList[$cashKey] += $a['price'];
                }
                
                if (is_null($a['cashok'])) {
                    $emptyCash += $a['price'];
                }
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['date'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['depart'];?></td>
                    <td><?=$a['detail'];?></td>
                    <td><?=number_format($a['price'],2);?></td>
                    <td><?=$a['ptright'];?></td>
                    <td><?=$a['cashok'];?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
                </tbody>
            </table>
            <?php
            if($sum>0){
                ?>
                <div class="row">
                <table class="col-md-3">
                    <thead>
                        <tr>
                            <th>แยกยอดตามประเภท</th>
                            <th>หน่วย(บาท)</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($cashList as $cashName => $money) {
                        ?>
                        <tr>
                            <td><?=$cashName;?></td>
                            <td align="right"><?=number_format($money,2);?></td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td>ยังไม่ได้บันทึก</td>
                        <td align="right"><?=number_format($emptyCash,2);?></td>
                    </tr>
                    <tr>
                        <td><strong>รวมยอด</strong></td>
                        <td align="right"><?=number_format($sum,2);?></td>
                    </tr>
                    </tbody>
                </table>
                </div>
                <?php
            }
        }else{
            ?>
            <div class="alert alert-warning" role="alert">ไม่พบข้อมูล</div>
            <?php
        }
        ?>
        <?php
    }else{
        ?>
        <div class="alert alert-warning" role="alert">กรุณาเลือกวันที่</div>
        <?php
    }
    ?>
</div>
</body>
</html>