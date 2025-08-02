<?php
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$sql = "SELECT `prefix`,`runno` FROM `runno` WHERE `title` = 'emp_checkup' ";
$q = $dbi->query($sql);
$runno = $q->fetch_assoc();
$prefix = $runno['prefix'];
$year_th = $runno['runno'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสุขภาพลูกจ้างประจำปี <?=$prefix;?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once 'report_checkup_employee_menu.php';

    $yearCheckup = get_year_checkup(true);
    $sql = "SELECT SUBSTRING(thidate,1,10) thidate, COUNT(row_id) AS emp_count 
    FROM opday 
    WHERE ptright LIKE 'R42%' 
    AND ( thidate >= '2568-07-29' AND thidate <= '2568-08-01' )
    GROUP BY SUBSTRING(thidate,1,10) ";
    $q = $dbi->query($sql);
    ?>
    <div class="container">
        <h1>ยอดการตรวจสุขภาพลูกจ้างประจำปี <?=$year_th;?></h1>
        <h3><small class="text-body-secondary">ระหว่างวันที่ 29 กรกฎาคม <?=$year_th;?> ถึง 2 สิงหาคม <?=$year_th;?></small></h3>
        <div class="row">
            <div class="col-6">
                <table class="table table-sm table-striped table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>วันที่</th>
                            <th>จำนวน</th>
                        </tr>
                    </thead>
                    <?php
                    $opdayRows = 0;
                    if ($q->num_rows > 0) {
                        while ($a = $q->fetch_assoc()) {
                            $thidate = $a['thidate'];
                            list($y, $m, $d) = explode('-', $thidate);
                            $opdayRows += (int) $a['emp_count'];
                            ?>
                            <tr>
                                <td>
                                    <a href="report_checkup_employee_today.php?thidate=<?= $thidate; ?>">
                                        <?= $d . ' ' . $def_fullm_th[$m] . ' ' . $y; ?>
                                    </a>
                                </td>
                                <td>
                                    <?= $a['emp_count']; ?>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>
                </table>
            </div>
        </div>
        <div class="row">
            <h3>สรุปยอดผู้เข้ารับการตรวจ</h3>
            <div class="col-6">
                <?php

                $sql = "SELECT `row_id`,`date`,`hn`,`tvn`,`ptname`,`depart`,`price` 
                FROM `depart` 
                WHERE `ptright` LIKE 'R42%' 
                AND ( `date` >= '2568-07-29' AND `date` <= '2568-08-02' ) 
                AND ( `depart`='PATHO' OR `depart`='XRAY' ) 
                ORDER BY `hn`,`row_id` ASC ";
                $q = $dbi->query($sql);
                if($q->num_rows>0){
                    $allXrayCount = 0;
                    $allLabCount = 0;
                    while ($a = $q->fetch_assoc()) {
                        if($a['depart']=='XRAY'){
                            $allXrayCount++;
                        }elseif ($a['depart']=='PATHO') {
                            $allLabCount++;
                        }
                    }
                }

                $sql = "SELECT COUNT(`hn`) AS `rows` FROM `employee`";
                $q = $dbi->query($sql);
                $a = $q->fetch_assoc();
                ?>
                <table>
                    <tr>
                        <td><b>ยอดลูกจ้างทั้งหมด</b></td>
                        <td><?=$a['rows'];?></td>
                        <td>ราย</td>
                    </tr>
                    <tr>
                        <td>จำนวนผู้ลงทะเบียน</td>
                        <td><?=$opdayRows;?></td>
                        <td>ราย</td>
                    </tr>
                    <tr>
                        <td>ผ่านสถานีเจาะเลือด</td>
                        <td><?=$allLabCount;?></td>
                        <td>ราย</td>
                    </tr>
                    <tr>
                        <td>ผ่านสถานี X-Ray</td>
                        <td><?=$allXrayCount;?></td>
                        <td>ราย</td>
                    </tr>
                    <tr>
                        <td>ลงข้อมูลซักประวัติไปแล้ว</td>
                        <td></td>
                        <td>ราย</td>
                    </tr>
                    <tr>
                        <td>แพทย์ลงผลตรวจแล้ว</td>
                        <td></td>
                        <td>ราย</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>