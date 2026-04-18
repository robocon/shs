<?php
session_start();
include("connect.inc");
mysql_query("SET NAMES 'utf8'");

/**
 * 1. จัดการเรื่องวันที่และประเภทรายการ
 */
$date_start_raw = isset($_POST['date_start']) ? $_POST['date_start'] : date('Y-m-01');
$date_end_raw   = isset($_POST['date_end']) ? $_POST['date_end'] : date('Y-m-d');
$type_filter    = isset($_POST['type_filter']) ? $_POST['type_filter'] : 'ALL';

function convertToThaiYear($date_string) {
    if (empty($date_string)) return "";
    $parts = explode('-', $date_string);
    if(count($parts) < 3) return $date_string;
    $y_en = $parts[0]; $m = $parts[1]; $d = $parts[2];
    $y_th = ($y_en < 2400) ? $y_en + 543 : $y_en;
    return "$y_th-$m-$d";
}

$date_start = convertToThaiYear($date_start_raw);
$date_end   = convertToThaiYear($date_end_raw);

/**
 * 2. กำหนดเงื่อนไขประเภท (Part Filter)
 */
$part_condition = "";
$type_label = "ทั้งหมด";

if ($type_filter == 'DRUG') {
    $part_condition = "AND d.part IN ('DDL', 'DDY', 'DDN')";
    $type_label = "ยา";
} elseif ($type_filter == 'SUPPLY') {
    $part_condition = "AND d.part IN ('DSY', 'DSN')";
    $type_label = "เวชภัณฑ์";
} elseif ($type_filter == 'DEVICE') {
    $part_condition = "AND d.part IN ('DPY', 'DPN')";
    $type_label = "อุปกรณ์";
}

/**
 * 3. ฟังก์ชันดึงข้อมูลต้นทุน
 */
function get_total_cost_opd($where_clause, $start, $end, $part_sql) {
    $sql = "SELECT SUM(d.amount * l.unitpri) 
            FROM dphardep h
            INNER JOIN ddrugrx d ON h.row_id = d.idno
            INNER JOIN druglst l ON d.drugcode = l.drugcode
            WHERE h.date BETWEEN '$start 00:00:00' AND '$end 23:59:59'
            AND h.dr_cancle IS NULL AND h.stkcutdate IS NOT NULL AND h.an IS NULL 
            AND $where_clause $part_sql";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return ($row[0] > 0) ? $row[0] : 0;
}

function get_total_cost_ipd($where_clause, $start, $end, $part_sql) {
    $sql = "SELECT SUM(d.amount * l.unitpri) 
            FROM ipacc d
            INNER JOIN druglst l ON d.code = l.drugcode
            INNER JOIN ipcard c ON d.an = c.an 
            WHERE d.date BETWEEN '$start 00:00:00' AND '$end 23:59:59'
            AND $where_clause $part_sql";
    $res = mysql_query($sql);
    $row = mysql_fetch_array($res);
    return ($row[0] > 0) ? $row[0] : 0;
}

/**
 * 4. ประมวลผลกลุ่มสิทธิ (เน้นเฉพาะประกันสังคม)
 */
// กำหนดเฉพาะรหัสประกันสังคมที่ต้องการดู
$social_security_codes = array('R07', 'R20', 'R27', 'R28', 'R46', 'R50');
$code_list = "'" . implode("','", $social_security_codes) . "'";

$report_data = array();

// ดึงข้อมูลรายรหัสเพื่อให้เห็น Breakdown ภายในสิทธิประกันสังคม
foreach ($social_security_codes as $code) {
    // ดึงชื่อสิทธิจากตาราง ptright
    $res_name = mysql_query("SELECT name FROM ptright WHERE LEFT(code, 3) = '$code' LIMIT 1");
    $row_name = mysql_fetch_assoc($res_name);
    $label = $code . " : " . ($row_name['name'] ? $row_name['name'] : "ไม่ระบุชื่อ");

    $report_data[$label]['opd'] = get_total_cost_opd("LEFT(h.ptright, 3) = '$code'", $date_start, $date_end, $part_condition);
    $report_data[$label]['ipd'] = get_total_cost_ipd("LEFT(c.ptright, 3) = '$code'", $date_start, $date_end, $part_condition);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานต้นทุนสิทธิประกันสังคม - รพ.ค่ายสุรศักดิ์มนตรี</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f4f7f6; }
        .report-box { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); margin: 30px auto; max-width: 1000px; }
        .header-title { color: #2c3e50; font-weight: 700; border-bottom: 3px solid #e67e22; padding-bottom: 10px; display: inline-block; }
        .money { text-align: right; font-family: 'Consolas', monospace; font-weight: bold; }
        .table thead th { background-color: #e67e22; color: white; text-align: center; border: none; }
        @media print { .no-print { display: none !important; } .report-box { box-shadow: none; border: none; padding: 0; } }
    </style>
</head>
<body>

<div class="container">
    <div class="report-box">
        <div class="text-center mb-4">
            <h2 class="header-title"><i class="fa fa-shield-alt me-2"></i>รายงานต้นทุน<?php echo $type_label; ?> (เฉพาะสิทธิประกันสังคม)</h2>
            <p class="mt-3 text-muted">ห้วงวันที่ <?php echo $date_start; ?> ถึง <?php echo $date_end; ?></p>
        </div>

        <form method="POST" class="no-print row g-3 bg-light p-3 rounded mb-4 border">
            <div class="col-md-3">
                <label class="form-label fw-bold">จากวันที่</label>
                <input type="date" name="date_start" class="form-control" value="<?php echo $date_start_raw; ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">ถึงวันที่</label>
                <input type="date" name="date_end" class="form-control" value="<?php echo $date_end_raw; ?>">
            </div>
            <div class="col-md-3">
                <label class="form-label fw-bold">ประเภทรายการ</label>
                <select name="type_filter" class="form-select">
                    <option value="ALL" <?php if($type_filter=='ALL') echo 'selected'; ?>>1. ทั้งหมด</option>
                    <option value="DRUG" <?php if($type_filter=='DRUG') echo 'selected'; ?>>2. ยา</option>
                    <option value="SUPPLY" <?php if($type_filter=='SUPPLY') echo 'selected'; ?>>3. เวชภัณฑ์</option>
                    <option value="DEVICE" <?php if($type_filter=='DEVICE') echo 'selected'; ?>>4. อุปกรณ์</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-warning w-100 me-2 fw-bold"><i class="fa fa-search"></i> ค้นหา</button>
                <button type="button" onclick="window.print()" class="btn btn-dark"><i class="fa fa-print"></i></button>
            </div>
        </form>

        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>รหัสและชื่อสิทธิประกันสังคม</th>
                    <th width="20%">OPD (บาท)</th>
                    <th width="20%">IPD (บาท)</th>
                    <th width="20%">รวม (บาท)</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $g_opd = 0; $g_ipd = 0;
                foreach ($social_security_codes as $index => $code):
                    // ค้นหาข้อมูลจาก Array ที่เตรียมไว้
                    foreach ($report_data as $label => $val):
                        if (strpos($label, $code) === 0):
                            if ($val['opd'] == 0 && $val['ipd'] == 0) continue;
                            $row_sum = $val['opd'] + $val['ipd'];
                            $g_opd += $val['opd']; $g_ipd += $val['ipd'];
                ?>
                <tr>
                    <td class="ps-3"><?php echo $label; ?></td>
                    <td class="money"><?php echo number_format($val['opd'], 2); ?></td>
                    <td class="money"><?php echo number_format($val['ipd'], 2); ?></td>
                    <td class="money text-danger"><?php echo number_format($row_sum, 2); ?></td>
                </tr>
                <?php 
                        endif;
                    endforeach;
                endforeach; 
                ?>
            </tbody>
            <tfoot class="table-secondary">
                <tr style="font-size: 1.1em;">
                    <th class="text-center">รวมต้นทุนประกันสังคมทั้งสิ้น</th>
                    <th class="money"><?php echo number_format($g_opd, 2); ?></th>
                    <th class="money"><?php echo number_format($g_ipd, 2); ?></th>
                    <th class="money text-primary" style="text-decoration: underline double;"><?php echo number_format($g_opd + $g_ipd, 2); ?></th>
                </tr>
            </tfoot>
        </table>
        
        <div class="mt-3 text-end text-muted small no-print">
            <i class="fa fa-info-circle"></i> รายงานนี้กรองเฉพาะรหัส: <?php echo implode(', ', $social_security_codes); ?>
        </div>
    </div>
</div>

</body>
</html>