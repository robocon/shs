<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$an = sprintf("%s", $_GET['an']);
if(empty($an)){
    echo "Invalid AN";
    exit;
}

$q = $dbi->query("SELECT * FROM ipcard WHERE an = '$an' ");
if($q->num_rows===0){
    echo "AN Not Found";
    exit;
}
$ipcard = $q->fetch_assoc();

$build = array("42"=>"หอผู้ป่วยหญิง","44"=>"หอผู้ป่วย ICU","43"=>"หอผู้ป่วยสูติ","45"=>"หอผู้ป่วยพิเศษ");
$bedcode = substr($ipcard['bedcode'],0,2);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>พิมพ์ใบสั่งยาย้อนหลัง</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <style>
        body{
            font-family: "TH SarabunPSK";
        }
        a,p,td,th{
            font-size: 18px;
        }
        .custom-color th,
        .custom-color > td{
            background-color: #13795b;
            color: white;
        }
    </style>
    <div class="container">
        <div>
            <h1 class="h1 mt-4">พิมพ์ใบสั่งยาย้อนหลัง</h1>
        </div>
        <table class="table table-bordered table-striped-columns">
            <tr class="custom-color">
                <td colspan="6" class="text-center fw-bold">รายละเอียดผู้ป่วย</td>
            </tr>
            <tr>
                <td class="fw-bold text-end">AN : </td>
                <td><?=$ipcard['an'];?></td>
                <td class="fw-bold text-end">HN : </td>
                <td><?=$ipcard['hn'];?></td>
                <td class="fw-bold text-end">ชื่อ-สกุล : </td>
                <td><?=$ipcard['ptname'];?></td>
            </tr>
            <tr>
                <td class="fw-bold text-end">หอผู้ป่วย : </td>
                <td><?=$build[$bedcode];?></td>
                <td class="fw-bold text-end">สิทธิ : </td>
                <td><?=$ipcard['ptright'];?></td>
                <td class="fw-bold text-end">แพทย์ : </td>
                <td><?=$ipcard['doctor'];?></td>
            </tr>
        </table>
        <?php 
        $sql = "SELECT * FROM phardep WHERE an = '$an' AND price > 0 ORDER BY row_id DESC";
        $q = $dbi->query($sql);
        if($q->num_rows > 0){
            ?>
            <table class="table table-sm table-light" >
                <tr class="custom-color">
                    <th>วันที่ เวลา</th>
                    <th>ชื่อเจ้าหน้าที่</th>
                    <th>จำนวน</th>
                    <th>ราคา</th>
                </tr>
            <?php
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><a href="phardividedrug_reprint2.php?id=<?=$a['row_id'];?>&an=<?=$an;?>" target="_blank"><?=$a['date'];?></a></td>
                    <td><?=$a['idname'];?></td>
                    <td><?=$a['item'];?></td>
                    <td><?=$a['price'];?></td>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }else{
            ?>
            <p class="fw-bold">ไม่พบข้อมูล</p>
            <?php
        }
        ?>
        <div>

        </div>
    </div>
</body>
</html>