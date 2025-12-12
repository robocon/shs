<?php 
include '../bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายชื่อผู้มารับบริการอายุ35ปีขึ้นไป ที่ไม่ได้เป็นผู้ป่วยเบาหวาน(นับเป็นคน)</title>
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container">
    <style>
        *{
            font-family: "TH SarabunPSK";
            font-size: 20px;
        }
        #showTable thead tr th{
            background-color: #b8b8b8;
        }
    </style>
    <h3 class="mt-2 mb-2">รายชื่อผู้มารับบริการอายุ35ปีขึ้นไป ที่ไม่ได้เป็นผู้ป่วยเบาหวาน(นับเป็นคน)</h3>
    <form action="new_diabetes2.php" method="post">
        <table>
            <tr>
                <td>วันที่เริ่ม</td>
                <td>
                    <input type="date" name="dateStart" id="dateStart" class="form-control mb-2" required="required">
                </td>
                <td>วันที่สิ้นสุด</td>
                <td>
                    <input type="date" name="dateEnd" id="dateEnd" class="form-control mb-2" required="required">
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <button class="btn btn-primary mb-4" type="submit">แสดงข้อมูล</button>
                    <input type="hidden" name="page" value="show">
                </td>
            </tr>
        </table>
    </form>
<?php
$page = $_POST['page'];
if($page==='show'){
    $dateStart = ad_to_bc($_POST['dateStart']);
    $dateEnd = ad_to_bc($_POST['dateEnd']);
    
    $sql = "SELECT `row_id`,`thidate`,`thdatehn`,`hn`,`vn`,`ptname`,`age`,CAST(SUBSTRING(`age`,1,2) as SIGNED ) AS `short_age`,`toborow`
    FROM `opd` 
    WHERE ( `age` <> '' AND CAST(SUBSTRING(`age`,1,2) as SIGNED ) >= 35 )
    AND ( `thidate` >= '$dateStart' AND `thidate` <= '$dateEnd' )
    AND `hn` NOT IN (
        SELECT `hn` FROM `diabetes_clinic`
    )
    GROUP BY hn 
    ORDER BY CAST(SUBSTRING(`age`,1,2) as SIGNED ) ASC";
    $q = $dbi->query($sql);
    $rows = $q->num_rows;
    if($rows>0){ 
    ?>
    <p>ตั้งแต่วันที่ <strong><?= $dateStart; ?></strong> ถึงวันที่ <strong><?= $dateEnd ?></strong></p>
    <p>จำนวน <strong><?= number_format($rows); ?></strong>ราย</p>
    <table class="table table-striped" id="showTable">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">HN</th>
                <th scope="col">ชื่อ-สกุล</th>
                <th scope="col">อายุ</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
        <?php 
        $i = 1;
        while ($a = $q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=number_format($i);?></td>
                <td><?=$a['hn'];?></td>
                <td><?=$a['ptname'];?></td>
                <td><?=$a['age'];?></td>
            </tr>
            <?php 
            $i++;
        }
        ?>
        </tbody>
    </table>
    <?php
    }else{
        ?>
        ไม่พบข้อมูล
        <?php
    }
}
?>
    </div>
</body>
</html>