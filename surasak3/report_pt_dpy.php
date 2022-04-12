<?php 
require_once 'bootstrap.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>รายงานอุปกรณ์ และเวชภัณฑ์ ผู้ป่วยนอก</title>
</head>
<body>
<style>
    @media print{
        .userForm{
            display: none;
        }
        .w3-container{
            font-size: 12px;
        }
    }
</style>
<div class="w3-container">
    <form action="report_pt_dpy.php" method="post" class="userForm">
        <h3>รายงานอุปกรณ์ และเวชภัณฑ์ ผู้ป่วยนอก</h3>
        <div class="w3-row">
            <div class="w3-col m4 l3">
                <span>เลือกเดือน</span>
                <?php 
                $getMonth = (empty($_POST['months'])) ? date('m') : $_POST['months'] ;
                getMonthList('months', $getMonth, 'w3-select')
                ?>
            </div>
            <div class="w3-col m4 l3">
                <span>เลือกปี</span>
                <?php 
                $getYear = (empty($_POST['years'])) ? date('Y') : $_POST['years'] ;
                $year_range = range(2020, date('Y'));
                getYearList('years', true, $getYear, $year_range, 'w3-select');
                ?>
            </div>
        </div>
        <p>
            <button type="submit" class="w3-button w3-border w3-round-large w3-teal">ค้นหา</button>
            <input type="hidden" name="action" value="search">
            <br>
            <span>* การค้นหานี้เป็นการค้นหารายการยา จะส่งผลกระทบต่อการใช้งานของเจ้าหน้าที่ห้องยาและแพทย์</span>
            <br>
            <span>* หลีกเลี่ยงการใช้งานในช่วงเวลา 08.00น.-12.00น. </span>
        </p>
    </form>


<?php
$action = $_POST['action'];
if($action==='search'){

    $month = $_POST['months'];
    $year = ( $_POST['years']+543 );

    $dbi = new mysqli(HOST,USER,PASS,DB);
    // $dbi = new mysqli(REMOTE_HOST,REMOTE_USER,'',DB);
    $sql = "SELECT x.*, y.`doctor`,y.`ptname` 
    FROM ( 
        SELECT `row_id`,`date`,`hn`,`drugcode`,`tradname`,`part`,`idno`,`amount`,SUBSTRING(`date`,1,10) AS `sDate` 
        FROM `drugrx` 
        WHERE `date` LIKE '$year-$month%' 
        AND `an` IS NULL 
        AND ( `part` = 'DPY' OR `part` = 'DPN' OR `part` = 'DSY' OR `part` = 'DSN' ) 
        AND `status` = 'Y' 
        AND `amount` > 0 
    ) as x 
    LEFT JOIN `phardep` AS y ON y.`row_id` = x.`idno` 
    ORDER BY y.`row_id` ASC";
    $q = $dbi->query($sql);
    ?>
    <h3>รายงานอุปกรณ์ และเวชภัณฑ์ ผู้ป่วยนอก ประจำเดือน <?=$def_fullm_th[$month];?> ปี <?=$year;?></h3>
    <table class="w3-table-all w3-hoverable">
        <tr>
            <th>วันที่</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>ชื่อทางการค้า</th>
            <th>ประเภท</th>
            <th>จำนวน</th>
            <th>แพทย์</th>
        </tr>
    
    <?php
    if($q->num_rows>0){
        while ($a = $q->fetch_assoc()) {
            ?>
            <tr>
                <td><?=$a['sDate'];?></td>
                <td><?=$a['hn'];?></td>
                <td><?=$a['ptname'];?></td>
                <td><?=$a['tradname'];?></td>
                <td>
                    <?php 
                    if($a['part']=='DPY' || $a['part']=='DPN'){
                        echo "อุปกรณ์";
                    }else{
                        echo "เวชภัณฑ์";
                    }
                    ?>
                </td>
                <td><?=$a['amount'];?></td>
                <td><?=$a['doctor'];?></td>
            </tr>
            <?php
        }
    }
    ?>
    </table>
    <?php

}

?>
</div>
</body>
</html>