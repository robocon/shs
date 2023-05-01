<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TOP 100 ค่าใช้จ่ายผู้ป่วยใน</title>
</head>
<body>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }
</style>
    <div>
        <h1>TOP 100 ค่าใช้จ่ายผู้ป่วยใน (01 ต.ค. 65 ถึง 30 ก.ย 66)</h1>
    </div>
    <div>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>AN</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>Diag</th>
                <th>ค่าใช้จ่าย</th>
            </tr>
        <?php 
        $sql = "SELECT a.`an`,b.`hn`,b.`ptname`,b.`diag`,a.`sum`
        FROM ( 
          SELECT `date`,`an`,SUM(`price`) AS `sum` FROM `ipacc` WHERE ( `an` IS NOT NULL AND `an` != '' ) 
          AND ( `date` >= '2565-10-01' AND `date` <= '2566-09-30' ) GROUP BY `an` ORDER BY SUM(`price`) DESC LIMIT 100 
        ) AS a LEFT JOIN `ipcard` AS b ON a.`an` = b.`an` ";
        $q = $dbi->query($sql);
        if ($q->num_rows>0) { 
            $i = 1;
            while ($a = $q->fetch_assoc()) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$a['an'];?></td>
                    <td><?=$a['hn'];?></td>
                    <td><?=$a['ptname'];?></td>
                    <td><?=$a['diag'];?></td>
                    <td><?=$a['sum'];?></td>
                </tr>
                <?php
                $i++;
            }
        }
        ?>
        </table>
    </div>
</body>
</html>