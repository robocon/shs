<?php
include dirname(__FILE__).'/bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <title>ข้อมูลซักประวัติย้อนหลัง</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
        #tableData tr th{
            background-color: #13795b;
            color: #ffffff;
        }
    </style>
<div class="container">
    <h3 class="mt-2">ตรวจสุขภาพประจำปี Walk-in</h3>
    <div class="row">
        <div class="col col-md-4">
            <form action="dx_ofyear_out_search.php" method="post">
                <div class="input-group mb-3">
                    <input type="date" name="dateSelect" class="form-control" required>
                    <button class="btn btn-outline-primary" type="submit" id="button-addon2">ค้นหาข้อมูล</button>
                </div>
                <div>
                    <span class="badge text-bg-warning">* หากต้องการคีย์เองกรุณาใช้รูปแบบการเลือกวันที่แบบ เดือน/วัน/ปี</span>
                </div>
            </form>
        </div>
    </div>
    <?php
    if(empty($_POST['dateSelect'])){
        $today = date('Y-m-d');
    }else{
        $today = $_POST['dateSelect'];
    }
    
    $sql = "SELECT * FROM `dxofyear_out` WHERE `thdatehn` LIKE '$today%' ORDER BY `row_id` ASC";
    $q = $dbi->query($sql);
    if($q->num_rows>0){

        list($y, $m, $d)=explode('-',$today);
    ?>
    <h3 class="mt-2">วันที่ <?=$d.' '.$def_month_th[$m].' '.($y+543);?></h3>
    <table class="table table-hover table-sm" id="tableData">
        <tr>
            <th>เวลา</th>
            <th>HN</th>
            <th>VN</th>
            <th>ชื่อสกุล</th>
            <th>หน่วยงาน</th>
            <th>ส่วนสูง</th>
            <th>น้ำหนัก</th>
            <th>รอบเอว</th>
            <th>Temp</th>
            <th>Pulse</th>
            <th>Rate</th>
            <th>BMI</th>
            <th>SBP/DBP</th>
        </tr>
        <?php
        while ($a = $q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=substr($a['thidate'],10);?></td>
                <td><?=$a['hn'];?></td>
                <td><?=$a['vn'];?></td>
                <td><?=$a['ptname'];?></td>
                <td><?=$a['camp'];?></td>
                <td><?=$a['height'];?></td>
                <td><?=$a['weight'];?></td>
                <td><?=$a['round_'];?></td>
                <td><?=$a['temperature'];?></td>
                <td><?=$a['pause'];?></td>
                <td><?=$a['rate'];?></td>
                <td><?=$a['bmi'];?></td>
                <td>
                    <?php
                    $bp = $a['bp1'].'/'.$a['bp2'];
                    $bpTitle = '';
                    if($a['bp21'] OR $a['bp22']){
                        $bpTitle = ' ('.$bp.')';
                        $bp = $a['bp21'].'/'.$a['bp22'];
                    }
                    ?>
                    <span><?=$bp.$bpTitle;?></span>
                </td>
            </tr>
            <?php
        }
        ?>
    </table>
    <?php
    }else{
        ?>
        <h1>ไม่พบข้อมูล</h1>
        <?php
    }
    ?>
    
</div>
</body>
</html>