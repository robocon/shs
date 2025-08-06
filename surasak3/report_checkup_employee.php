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
    $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `emp_opday`
    SELECT `row_id`,SUBSTRING(`thidate`,1,10) `thidate`,`thdatehn` 
    FROM `opday` 
    WHERE `ptright` LIKE 'R42%' 
    AND ( `thidate` >= '2568-07-29 00:00:00' AND `thidate` <= '2568-08-04 23:59:59' );";
    $dbi->query($sql);

    $opdaySql = "SELECT *,COUNT(`row_id`) AS `emp_count` FROM `emp_opday` GROUP BY `thidate`";
    $q = $dbi->query($opdaySql);

    $tmpDxofyear = "CREATE TEMPORARY TABLE IF NOT EXISTS `emp_dxofyear` 
    SELECT a.*,b.`dxofyear_out_id` FROM `emp_opday` AS a LEFT JOIN ( 
        SELECT `row_id` AS `dxofyear_out_id`,`hn`,`ptname`,`camp`,
        CONCAT(SUBSTRING(`thidate`,9,2),'-',SUBSTRING(`thidate`,6,2),'-',(SUBSTRING(`thidate`,1,4)+543),`hn`) AS `thdatehn`
        FROM `dxofyear_out` 
        WHERE `yearchk` = '68'
    ) AS b ON a.`thdatehn` = b.`thdatehn`;";
    $dbi->query($tmpDxofyear);

    
    $opdSql = "SELECT * FROM `emp_dxofyear`";
    $qOpd = $dbi->query($opdSql);
    $opdRows = $qOpd->num_rows;

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
                AND ( `date` >= '2568-07-29 00:00:00' AND `date` <= '2568-08-04 23:59:59' ) 
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
                        <td><?=$opdRows;?></td>
                        <td>ราย</td>
                    </tr>
                    <?php
                    $dtSQL = "SELECT b.`hn` AS rows FROM (
                        SELECT `hn` FROM `employee` 
                    ) AS a LEFT JOIN `chk_doctor` AS b ON b.`hn` = a.`hn`
                    WHERE b.`yearchk` = '68'";
                    $q = $dbi->query($dtSQL);
                    $chkRows = $q->num_rows;
                    ?>
                    <tr>
                        <td>แพทย์ลงผลตรวจแล้ว</td>
                        <td><?=$chkRows;?></td>
                        <td>ราย</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>