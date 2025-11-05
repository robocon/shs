<?php
session_start();
include "connect.php";

if (empty($_SESSION['sIdname'])) {
    echo '<p>SESSION หมดอายุ กรุณา login ใหม่อีกครั้ง <a href="../nindex.htm">คลิกที่นี่เพื่อ Login</a></p>';
    exit;
}

// ------- รับพารามิเตอร์ -------
$range  = isset($_GET['range']) ? $_GET['range'] : '1m';  // 1m,3m,6m,1y,custom
$ised   = isset($_GET['ised']) ? $_GET['ised'] : 'all';   // all,e,n
$start  = isset($_GET['start']) ? $_GET['start'] : '';
$end    = isset($_GET['end']) ? $_GET['end'] : '';
$format = isset($_GET['format']) ? $_GET['format'] : 'html';

// ---------- ฟังก์ชันแปลงวันที่ ----------
function ad_to_thai_format($date_str) {
    if (!$date_str) return '';
    $ts = strtotime($date_str);
    $y = date('Y', $ts) + 543;
    return date('d/m/', $ts) . $y;
}

function ad_to_thai($date_str) {
    if (!$date_str) return '';
    list($y, $m, $d) = explode('-', $date_str);
    if ($y < 2400) $y += 543;
    return "$y-$m-$d";
}

// ---------- ฟังก์ชันช่วงเวลา ----------
function calc_range($range) {
    $now = time();
    switch ($range) {
        case '1m': $from = strtotime('-1 month', $now); break;
        case '3m': $from = strtotime('-3 months', $now); break;
        case '6m': $from = strtotime('-6 months', $now); break;
        case '1y': $from = strtotime('-1 year', $now); break;
        default:   $from = strtotime('-1 month', $now); break;
    }
    return array('from'=>date('Y-m-d', $from), 'to'=>date('Y-m-d', $now));
}

// ---------- คำนวณช่วงวันที่ ----------
if ($range === 'custom' && $start != '' && $end != '') {
    $date_from = $start;
    $date_to   = $end;
} else {
    $r = calc_range($range);
    $date_from = $r['from'];
    $date_to   = $r['to'];
}

$date_from1 = ad_to_thai($date_from);
$date_to1   = ad_to_thai($date_to);

$date_from_chk = mysql_real_escape_string($date_from1);
$date_to_chk   = mysql_real_escape_string($date_to1);
$ised_param = ($ised === 'e' || $ised === 'n') ? $ised : 'all';

// ---------- Query ----------
$where = "p.date BETWEEN '$date_from_chk' AND '$date_to_chk'";
if ($ised === 'e' || $ised === 'n') $where .= " AND d.ised='$ised'";

$sql = "
SELECT
  p.comcode, p.comname, p.date,
  d.drugcode, d.tradname, d.ised,
  SUM(i.amount) AS itemsumamount,
  SUM(i.price) AS itemsumprice
FROM pocompany p
INNER JOIN poitems i ON i.idno = p.row_id
LEFT JOIN druglst d ON d.drugcode = i.drugcode
WHERE $where
  AND (p.potype IS NULL OR p.potype = '')
  AND (d.ised = 'e' OR d.ised='n')
  AND p.prepono NOT LIKE 'อ.%'
  AND p.pono != ''
GROUP BY p.comcode, d.drugcode
ORDER BY p.comcode, d.tradname
";
$res = mysql_query($sql);
if (!$res) die('Query Error: '.mysql_error());
// ---------- รวมกลุ่มบริษัท ----------
$groups = array();

while ($row = mysql_fetch_assoc($res)) {
    $comcode = $row['comcode'];
    $drugcode = $row['drugcode'];

    if (!isset($groups[$comcode])) {
        $groups[$comcode] = array(
            'comcode' => $row['comcode'],
            'comname' => $row['comname'],
            'items' => array()
        );
    }

    $groups[$comcode]['items'][] = array(
        'drugcode' => $drugcode,
        'tradname' => $row['tradname'],
        'itemsumamount' => $row['itemsumamount'],
        'itemsumprice' => $row['itemsumprice']
    );
}

?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>รายงานการสั่งซื้อยา</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
<style>
body { background-color:#f8fafc; font-family:"Sarabun", sans-serif; }
.card { border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.08); }
thead th { background:#e9f2ff; }
.table td, .table th { vertical-align:middle; }
.company-header { background:#f1f6fb; font-weight:600; }
.filter-box { background:#fff; padding:15px; border-radius:8px; margin-bottom:20px; box-shadow:0 2px 8px rgba(0,0,0,0.05); }
</style>
</head>
<body>
<div class="container my-4">
    <h3 class="mb-3 text-primary"><i class="bi bi-capsule"></i> รายงานสรุปการสั่งซื้อยา</h3>

    <!-- Filter -->
    <form method="get" class="filter-box row g-3">
        <div class="col-md-2">
            <label class="form-label fw-bold">ช่วงเวลา</label>
            <select name="range" class="form-select">
                <option value="1m" <?php if($range=='1m')echo'selected';?>>1 เดือน</option>
                <option value="3m" <?php if($range=='3m')echo'selected';?>>3 เดือน</option>
                <option value="6m" <?php if($range=='6m')echo'selected';?>>6 เดือน</option>
                <option value="1y" <?php if($range=='1y')echo'selected';?>>1 ปี</option>
                <option value="custom" <?php if($range=='custom')echo'selected';?>>กำหนดเอง</option>
            </select>
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">จากวันที่</label>
            <input type="date" name="start" value="<?php echo htmlspecialchars($start); ?>" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">ถึงวันที่</label>
            <input type="date" name="end" value="<?php echo htmlspecialchars($end); ?>" class="form-control">
        </div>
        <div class="col-md-2">
            <label class="form-label fw-bold">ประเภทยา</label>
            <select name="ised" class="form-select">
                <option value="all" <?php if($ised=='all')echo'selected';?>>ทั้งหมด</option>
                <option value="e" <?php if($ised=='e')echo'selected';?>>ED</option>
                <option value="n" <?php if($ised=='n')echo'selected';?>>NED</option>
            </select>
        </div>
        <div class="col-md-2 align-self-end">
            <button type="submit" class="btn btn-primary w-100"><i class="bi bi-search"></i> ค้นหา</button>
        </div>
    </form>

    <div class="card p-3">
        <h5 class="text-secondary mb-3">
            ช่วงวันที่: <?php echo ad_to_thai_format($date_from).' ถึง '.ad_to_thai_format($date_to); ?>
            | ประเภทยา: <?php echo ($ised=='all'?'ทั้งหมด':($ised=='e'?'ED':'NED')); ?>
        </h5>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>รหัสบริษัท</th>
                    <th>ชื่อบริษัท</th>
                    <th>รหัสยา</th>
                    <th>ชื่อยา</th>
                    <th class="text-end">จำนวน</th>
                    <th class="text-end">ราคารวม</th>
                </tr>
            </thead>
            <tbody>
            <?php
            $idx = 1;
            if (count($groups) == 0) {
                echo '<tr><td colspan="7" class="text-center py-3 text-muted">ไม่พบข้อมูล</td></tr>';
            } else {
                foreach ($groups as $g) {
                    echo '<tr class="company-header">';
                    echo '<td>'.$idx.'</td>';
                    echo '<td>'.htmlspecialchars($g['comcode']).'</td>';
                    echo '<td colspan="5">'.htmlspecialchars($g['comname']).'</td>';
                    echo '</tr>';
                    foreach ($g['items'] as $it) {
                        echo '<tr>';
                        echo '<td></td><td></td><td></td>';
                        echo '<td>'.htmlspecialchars($it['drugcode']).'</td>';
                        echo '<td>'.htmlspecialchars($it['tradname']).'</td>';
                        echo '<td class="text-end">'.number_format($it['itemsumamount']).'</td>';
                        echo '<td class="text-end">'.number_format($it['itemsumprice'],2).'</td>';
                        echo '</tr>';
                    }
                    $idx++;
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
<?php
mysql_free_result($res);
mysql_close($link);
?>
