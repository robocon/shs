<?php
// -----------------------------------------------
// ตั้งค่าการเชื่อมต่อฐานข้อมูล
// -----------------------------------------------
// Set about php.ini
error_reporting(1);
ini_set('display_errors', 1);
session_start();
require_once '../bootstrap.php';
// -----------------------------------------------
// ดึงข้อมูลรายงานความสัมพันธ์การสั่งซื้อ-จ่ายยา
// -----------------------------------------------
$sql_relationship = "
SELECT
    T_DRUG.drugcode,
    T_DRUG.part, 
    SUM(T_PO.amount) AS total_order_amount, 
    SUM(T_OPD.rxqty) AS total_opd_qty,
    SUM(T_IPD.amount) AS total_ipd_qty
FROM
    druglst AS T_DRUG
LEFT JOIN
    poitems AS T_PO ON T_DRUG.drugcode = T_PO.drugcode 
LEFT JOIN
    pocompany AS T_PO_COMP ON T_PO.idno = T_PO_COMP.row_id 
LEFT JOIN
    ddrugrx AS T_OPD ON T_DRUG.drugcode = T_OPD.drugcode 
LEFT JOIN
    dphardep AS T_DEP ON T_OPD.hcode = T_DEP.hcode
LEFT JOIN
    ipacc AS T_IPD ON T_DRUG.drugcode = T_IPD.code AND T_IPD.depart = 'PHAR'
WHERE
    (
        T_DEP.dr_cancle IS NULL 
        AND T_OPD.an IS NULL 
        AND T_DEP.stkcutdate != ''
    )
    OR 
    (
        T_PO.drugcode IS NOT NULL OR T_IPD.code IS NOT NULL
    )
GROUP BY
    T_DRUG.drugcode,
    T_DRUG.part
ORDER BY
    total_order_amount DESC
";

$result_rel = $mysqli->query($sql_relationship);
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>รายงานสั่งซื้อและจ่ายยา | HIS Report</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    body {
        background: linear-gradient(to bottom right, #e0f7fa, #e8f5e9);
        font-family: "Sarabun", sans-serif;
        color: #004d40;
    }
    .container {
        margin-top: 40px;
        margin-bottom: 60px;
    }
    h1, h2 {
        text-align: center;
        font-weight: 700;
    }
    h1 {
        color: #00796b;
        margin-bottom: 30px;
    }
    h2 {
        color: #0288d1;
        margin-top: 40px;
        margin-bottom: 20px;
    }
    table {
        background: white;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th {
        background: linear-gradient(90deg, #26c6da, #66bb6a);
        color: white;
        text-align: center;
    }
    td {
        text-align: center;
        vertical-align: middle;
    }
    tr:nth-child(even) td {
        background-color: #f9f9f9;
    }
    .diff-negative {
        color: red;
        font-weight: bold;
    }
    .footer {
        margin-top: 50px;
        text-align: center;
        color: #555;
        font-size: 0.9em;
    }
    .loading {
        text-align: center;
        padding: 40px;
        font-size: 1.2em;
        color: #00796b;
    }
</style>
</head>

<body>
<div class="container">
    <h1>รายงานการวิเคราะห์ข้อมูลการสั่งซื้อและจ่ายยา</h1>
    <h2>ข้อมูลล่าสุดจาก ddrugrx / dphardep / ipacc</h2>

    <div class="table-responsive">
    <?php
    if ($result_rel) {
        if ($result_rel->num_rows > 0) {
            echo "<table class='table table-bordered table-hover align-middle'>";
            echo "<thead><tr>
                    <th>รหัสยา</th>
                    <th>ประเภท (ED/NED)</th>
                    <th>ปริมาณสั่งซื้อรวม</th>
                    <th>ปริมาณจ่าย OPD รวม</th>
                    <th>ปริมาณจ่าย IPD รวม</th>
                    <th>ความแตกต่าง (สั่งซื้อ - จ่ายรวม)</th>
                  </tr></thead><tbody>";

            while ($row = $result_rel->fetch_assoc()) {
                $order_qty = (int) $row['total_order_amount'];
                $opd_qty   = (int) $row['total_opd_qty'];
                $ipd_qty   = (int) $row['total_ipd_qty'];
                $diff      = $order_qty - ($opd_qty + $ipd_qty);
                $diff_class = ($diff < 0) ? "diff-negative" : "";

                echo "<tr>
                        <td>{$row['drugcode']}</td>
                        <td>{$row['part']}</td>
                        <td>" . number_format($order_qty) . "</td>
                        <td>" . number_format($opd_qty) . "</td>
                        <td>" . number_format($ipd_qty) . "</td>
                        <td class='$diff_class'>" . number_format($diff) . "</td>
                      </tr>";
            }

            echo "</tbody></table>";
        } else {
            echo "<div class='alert alert-info text-center'>ไม่พบข้อมูลความสัมพันธ์ในระบบ</div>";
        }
        $result_rel->free();
    } else {
        echo "<div class='alert alert-danger text-center'>
                ⚠️ เกิดข้อผิดพลาดในการดึงข้อมูล: {$mysqli->error}
              </div>";
    }

    $mysqli->close();
    ?>
    </div>

    <div class="footer">
        <p>พัฒนาโดย <strong>แผนกเทคโนโลยีสารสนเทศ</strong> | HIS Analysis Report</p>
        <p>© <?php echo date("Y"); ?> โรงพยาบาลของท่าน</p>
    </div>
</div>
</body>
</html>
