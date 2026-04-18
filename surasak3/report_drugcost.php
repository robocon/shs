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
    $part_condition = "AND d.part IN ('DDL', 'DDY', 'DDN')"; // สำหรับ OPD d=ddrugrx, สำหรับ IPD d=ipacc
    $type_label = "ยา";
} elseif ($type_filter == 'SUPPLY') {
    $part_condition = "AND d.part IN ('DSY', 'DSN')";
    $type_label = "เวชภัณฑ์";
} elseif ($type_filter == 'DEVICE') {
    $part_condition = "AND d.part IN ('DPY', 'DPN')";
    $type_label = "อุปกรณ์";
}

/**
 * 3. ฟังก์ชันดึงข้อมูลต้นทุน (เพิ่ม $part_sql)
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
    // ในตาราง ipacc ใช้ชื่อ alias 'd' เพื่อให้ใช้ $part_sql ร่วมกันได้
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
 * 4. ประมวลผลกลุ่มสิทธิ
 */
$rights_config = array(
    'เบิกจ่ายตรง' => array('R03'),
    'อปท.' => array('R33'),
    'รัฐวิสาหกิจ' => array('R04'),
    'เงินสด' => array('R01'),
    'ประกันสังคม' => array('R07', 'R20', 'R27', 'R28', 'R46', 'R50'),
    'ประกันสุขภาพถ้วนหน้า' => array('R09', 'R10', 'R11', 'R12', 'R13', 'R14', 'R15', 'R17', 'R35', 'R36')
);

$all_main_codes = array();
foreach ($rights_config as $codes) { $all_main_codes = array_merge($all_main_codes, $codes); }
$exclude_sql = "'" . implode("','", $all_main_codes) . "'";

$report_data = array();

// 4.1 สิทธิหลัก
foreach ($rights_config as $label => $codes) {
    $code_list = "'" . implode("','", $codes) . "'";
    $report_data[$label]['opd'] = get_total_cost_opd("LEFT(h.ptright, 3) IN ($code_list)", $date_start, $date_end, $part_condition);
    $report_data[$label]['ipd'] = get_total_cost_ipd("LEFT(c.ptright, 3) IN ($code_list)", $date_start, $date_end, $part_condition);
}

// 4.2 สิทธิอื่นๆ (คลี่รายสิทธิ)
$other_codes = array();
$sql_f_opd = "SELECT DISTINCT LEFT(ptright, 3) as c FROM dphardep WHERE date BETWEEN '$date_start 00:00:00' AND '$date_end 23:59:59' AND LEFT(ptright, 3) NOT IN ($exclude_sql) AND ptright LIKE 'R%'";
$res_f_opd = mysql_query($sql_f_opd);
while($r = mysql_fetch_assoc($res_f_opd)) { $other_codes[$r['c']] = $r['c']; }

$sql_f_ipd = "SELECT DISTINCT LEFT(c.ptright, 3) as c FROM ipcard c INNER JOIN ipacc i ON c.an = i.an WHERE i.date BETWEEN '$date_start 00:00:00' AND '$date_end 23:59:59' AND LEFT(c.ptright, 3) NOT IN ($exclude_sql) AND c.ptright LIKE 'R%'";
$res_f_ipd = mysql_query($sql_f_ipd);
while($r = mysql_fetch_assoc($res_f_ipd)) { $other_codes[$r['c']] = $r['c']; }

$right_names = array();
if (!empty($other_codes)) {
    $other_list = "'" . implode("','", $other_codes) . "'";
    $res_n = mysql_query("SELECT code, name FROM ptright WHERE LEFT(code, 3) IN ($other_list)");
    while($row_n = mysql_fetch_assoc($res_n)) { $right_names[substr($row_n['code'], 0, 3)] = $row_n['name']; }
}

foreach ($other_codes as $c) {
    $name = isset($right_names[$c]) ? $right_names[$c] : "ไม่ระบุชื่อสิทธิ";
    $label = "$c : $name";
    $report_data[$label]['opd'] = get_total_cost_opd("LEFT(h.ptright, 3) = '$c'", $date_start, $date_end, $part_condition);
    $report_data[$label]['ipd'] = get_total_cost_ipd("LEFT(c.ptright, 3) = '$c'", $date_start, $date_end, $part_condition);
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>รายงานต้นทุนแยกประเภท - รพ.ค่ายสุรศักดิ์มนตรี</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;700&display=swap');
        body { font-family: 'Sarabun', sans-serif; background-color: #f8fafb; }
        .report-box { background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); margin: 30px auto; max-width: 1100px; }
        .header-title { color: #1a4d8a; font-weight: 700; border-bottom: 2px solid #1a4d8a; padding-bottom: 10px; }
        .money { text-align: right; font-family: 'Consolas', monospace; font-weight: bold; }
        .table thead th { background-color: #1a4d8a; color: white; text-align: center; }
        .row-other { background-color: #fffdec; font-style: italic; }
        @media print { .no-print { display: none !important; } .report-box { box-shadow: none; border: none; padding: 0; } }
    </style>
</head>
<body>

<div class="container">
    <div class="report-box">
        <div class="text-center mb-4">
            <h2 class="header-title">รายงานต้นทุนค่า<?php echo $type_label; ?> แยกตามสิทธิ</h2>
            <p class="mt-2 text-muted">ข้อมูลระหว่างวันที่ <?php echo $date_start; ?> ถึง <?php echo $date_end; ?></p>
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
                    <option value="DRUG" <?php if($type_filter=='DRUG') echo 'selected'; ?>>2. ยา (DDL, DDY, DDN)</option>
                    <option value="SUPPLY" <?php if($type_filter=='SUPPLY') echo 'selected'; ?>>3. เวชภัณฑ์ (DSY, DSN)</option>
                    <option value="DEVICE" <?php if($type_filter=='DEVICE') echo 'selected'; ?>>4. อุปกรณ์ (DPY, DPN)</option>
                </select>
            </div>
            <div class="col-md-3 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100 me-2"><i class="fa fa-sync-alt"></i> ค้นหา</button>
                <button type="button" onclick="window.print()" class="btn btn-dark w-100"><i class="fa fa-print"></i></button>
            </div>
        </form>

        <table class="table table-bordered align-middle">
            <thead>
                <tr>
                    <th rowspan="2">สิทธิการรักษา</th>
                    <th colspan="2">มูลค่าต้นทุน (บาท)</th>
                    <th rowspan="2" width="20%">รวม</th>
                </tr>
                <tr>
                    <th width="20%">OPD</th>
                    <th width="20%">IPD</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $g_opd = 0; $g_ipd = 0;
                foreach ($report_data as $name => $val): 
                    if ($val['opd'] == 0 && $val['ipd'] == 0) continue;
                    $row_sum = $val['opd'] + $val['ipd'];
                    $g_opd += $val['opd']; $g_ipd += $val['ipd'];
                    $class = (strpos($name, ':') !== false) ? 'row-other' : '';
                ?>
                <tr class="<?php echo $class; ?>">
                    <td class="ps-3"><?php echo $name; ?></td>
                    <td class="money"><?php echo number_format($val['opd'], 2); ?></td>
                    <td class="money"><?php echo number_format($val['ipd'], 2); ?></td>
                    <td class="money text-primary"><?php echo number_format($row_sum, 2); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <tfoot class="table-dark">
                <tr>
                    <th class="text-center">รวมทั้งสิ้น (<?php echo $type_label; ?>)</th>
                    <th class="money"><?php echo number_format($g_opd, 2); ?></th>
                    <th class="money"><?php echo number_format($g_ipd, 2); ?></th>
                    <th class="money" style="color:#ffc107;"><?php echo number_format($g_opd + $g_ipd, 2); ?></th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

</body>
</html>