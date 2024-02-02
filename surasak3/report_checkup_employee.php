<?php
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตรวจสุขภาพลูกจ้างประจำปี</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <?php
    require_once 'report_checkup_employee_menu.php';

    $yearCheckup = get_year_checkup(true);
    $sql = "SELECT SUBSTRING(thidate,1,10) thidate, COUNT(row_id) AS emp_count 
    FROM opday 
    WHERE ptright LIKE 'R42%' 
    AND ( thidate LIKE '2567-01-29%' 
	OR thidate LIKE '2567-01-30%' 
	OR thidate LIKE '2567-01-31%' 
	OR thidate LIKE '2567-02-01%' 
	OR thidate LIKE '2567-02-02%' )
    GROUP BY SUBSTRING(thidate,1,10) ";
    $q = $dbi->query($sql);
    ?>
    <div class="container">
        <h1>ยอดการตรวจสุขภาพลูกจ้างประจำปี 2567</h1>
        <h3><small class="text-body-secondary">ระหว่างวันที่ 29 มกราคม 2567 ถึง 2 กุมภาพันธ์ 2567</small></h3>
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
                    if ($q->num_rows > 0) {
                        while ($a = $q->fetch_assoc()) {
                            $thidate = $a['thidate'];
                            list($y, $m, $d) = explode('-', $thidate);
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
    </div>
    <script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>