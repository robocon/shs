<?php
session_start();
include("connect.inc");

// ป้องกัน Error กรณีตัวแปรไม่มีค่า
$thiyr = isset($_POST['thiyr']) ? $_POST['thiyr'] : date('Y')+543;
$rptmo = isset($_POST['rptmo']) ? $_POST['rptmo'] : date('m');
$date = isset($_POST['date']) ? $_POST['date'] : date('d');

$date1 = "$thiyr-$rptmo-$date";
$date2 = "$date-$rptmo-$thiyr";

// แก้ไข SQL: เพิ่ม sum(a.price) เข้ามาใน Query
$sql = "Select a.date, a.txdate, a.hn, CONCAT(b.yot,' ',b.name,' ',b.surname) as full_name, a.depart, sum(a.paidcscd), sum(a.price) 
        From opacc as a, opcard as b 
        Where a.hn=b.hn AND a.txdate like '".$date1."%' AND a.credit ='รฟท' 
        Group by a.hn, a.depart ORDER by a.date";

$result = mysql_query($sql) or die(mysql_error());
$list = array();
$list2 = array();

while($row = mysql_fetch_row($result)){
    $d_raw = $row[0]; 
    $tx_raw = $row[1]; 
    $hn = $row[2];
    $full_name = $row[3];
    $depart = $row[4];
    $paidcscd = $row[5];
    $price = $row[6]; // ยอดจากฟิลด์ price ที่ดึงเพิ่มมา

    $date_sub = substr($tx_raw, 0, 10);
    $d = substr($date_sub, 8, 2);
    $m = substr($date_sub, 5, 2);
    $y = substr($date_sub, 0, 4);

    $list2[$hn] = $d."/".$m."/".$y."/".$full_name;
    
    // เงื่อนไขใหม่: ถ้าเป็น PHAR ให้ใช้ price ถ้าเป็นแผนกอื่นให้ใช้ paidcscd
    if($depart == 'PHAR') {
        $amount = $price;
    } else {
        $amount = $paidcscd;
    }

    // กันค่าว่างและกรองเอาเฉพาะยอดที่มากกว่า 0 (ตามเงื่อนไขเดิมของคุณ)
    if($amount > 0) {
        if(!isset($list[$hn][$depart])) $list[$hn][$depart] = 0;
        $list[$hn][$depart] += $amount;
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานลูกหนี้การรถไฟแห่งประเทศไทย - <?php echo $date2; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap');

        body {
            font-family: 'TH SarabunPSK', sans-serif;
            font-size: 16px;
            background-color: #f8f9fa;
        }

        /* ตั้งค่าสำหรับการพิมพ์ */
        @media print {
            @page { size: landscape; margin: 0.5cm; }
            .no-print { display: none !important; }
            body { background-color: #fff; font-family: "TH SarabunPSK", serif !important; }
            .report-table { width: 100% !important; border: 1px solid #000 !important; font-size: 16px !important; }
            .report-table th, .report-table td { border: 1px solid #000 !important; padding: 2px 4px !important; }
            .page-break { page-break-before: always; }
        }

        .report-table th {
            background-color: #1a4d8a !important;
            color: white !important;
            text-align: center;
            vertical-align: middle;
            font-weight: normal;
            font-size: 0.8rem;
        }

        .report-table td {
            vertical-align: middle;
        }

        .text-end-money { text-align: right; font-family: 'TH SarabunPSK', monospace; }
        .bg-total { background-color: #e9ecef !important; font-weight: bold; }
    </style>
</head>
<body>

<div class="container-fluid py-3">
    <div class="no-print d-flex justify-content-between align-items-center mb-3 p-3 bg-white rounded shadow-sm">
        <div>
            <h4 class="mb-0 text-primary"><i class="fa-solid fa-file-invoice-dollar me-2"></i>ลูกหนี้การรถไฟแห่งประเทศไทย</h4>
            <span class="text-muted">ประจำวันที่ <?php echo $date2; ?></span>
        </div>
        <div>
            <button onclick="window.print()" class="btn btn-dark"><i class="fa-solid fa-print me-2"></i>พิมพ์รายงาน</button>
            <a href="index.php" class="btn btn-outline-secondary"><i class="fa-solid fa-house me-2"></i>กลับหน้าหลัก</a>
        </div>
    </div>

    <div class="text-center mb-3">
        <h5 class="mb-1">ลูกหนี้การรถไฟแห่งประเทศไทยประจำวันที่ <?php echo $date2; ?></h5>
        <h6>โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</h6>
    </div>

    <table class="table table-bordered table-sm report-table shadow-sm">
        <thead>
            <tr>
                <th>#</th>
                <th>วันที่</th>
                <th>ชื่อ - สกุล</th>
                <th>HN</th>
                <th>ยา</th>
                <th>พยาธิ</th>
                <th>เอกซเรย์</th>
                <th>ทันตกรรม</th>
                <th>กายภาพ</th>
                <th>บริการ</th>
                <th>ผ่าตัด</th>
                <th>ฝังเข็ม</th>
                <th>ไตเทียม</th>
                <th>อื่นๆ</th>
                <th>ตา</th>
                <th>อื่นๆ 2</th>
                <th>รวม</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $num = 0; $i = 0; $p = 1;
        // ตัวแปรสะสมยอดรวมทั้งหมด
        $g_phar=0; $g_patho=0; $g_xray=0; $g_denta=0; $g_physi=0; $g_emer=0; 
        $g_surg=0; $g_nid=0; $g_hemo=0; $g_other=0; $g_eye=0; $g_other2=0; $g_sum=0;

        foreach ($list2 as $key => $value) {
            $num++; $i++;
            $xx = explode("/", $value);
            
            // ดึงค่าและเตรียมตัวแปรสำหรับการแสดงผล (ถ้าเป็น 0 ให้ว่างไว้)
            $v = array();
            $codes = array("PHAR", "PATHO", "XRAY", "DENTA", "PHYSI", "EMER", "SURG", "NID", "HEMO", "OTHER", "EYE", "OTHER2");
            $row_total = 0;

            foreach($codes as $c) {
                $val = isset($list[$key][$c]) ? $list[$key][$c] : 0;
                $v[$c] = ($val > 0) ? number_format($val, 2) : "-";
                $row_total += $val;
                
                // สะสมยอดรวมท้ายรายงาน
                ${"g_".strtolower($c)} += $val;
            }
            $g_sum += $row_total;

            echo "<tr>";
            echo "<td class='text-center'>$num</td>";
            echo "<td class='text-center'>$xx[0]/$xx[1]/$xx[2]</td>";
            echo "<td><strong>$xx[3]</strong></td>";
            echo "<td class='text-center'>$key</td>";
            foreach($codes as $c) {
                echo "<td class='text-end-money'>".$v[$c]."</td>";
            }
            echo "<td class='text-end-money fw-bold text-primary'>".number_format($row_total, 2)."</td>";
            echo "</tr>";

            // การตัดหน้าสำหรับการพิมพ์
            if($i == 25) { 
                $i = 0; $p++;
                echo "</tbody></table><div class='page-break'></div>";
                echo "<div class='text-center mb-3 mt-4 print-only'><h5>ลูกหนี้การรถไฟแห่งประเทศไทย ประจำวันที่ $date2 (แผ่นที่ $p)</h5></div>";
                echo "<table class='table table-bordered table-sm report-table'><thead>...หัวตารางเดิม...</thead><tbody>";
            }
        }
        ?>
        </tbody>
        <tfoot>
            <tr class="bg-total border-dark">
                <td colspan="4" class="text-center">รวมยอดทั้งหมด</td>
                <td class="text-end-money"><?php echo number_format($g_phar, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_patho, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_xray, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_denta, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_physi, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_emer, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_surg, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_nid, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_hemo, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_other, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_eye, 2); ?></td>
                <td class="text-end-money"><?php echo number_format($g_other2, 2); ?></td>
                <td class="text-end-money text-danger h6 mb-0"><?php echo number_format($g_sum, 2); ?></td>
            </tr>
        </tfoot>
    </table>
    
    <!--div class="mt-2 no-print">
        <p class="text-muted small">* รายงานนี้สร้างขึ้นจากฐานข้อมูล OPACC และ OPCARD สำหรับสิทธิเบิกจ่ายตรง</p>
    </div-->
</div>

</body>
</html>