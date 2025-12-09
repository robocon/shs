<?php
session_start();
// ==========================================
// ส่วนการเชื่อมต่อฐานข้อมูล (CONFIG)
// ==========================================
include("connect.inc");

// ==========================================
// ส่วนรับค่าและประมวลผล (LOGIC)
// ==========================================

// 1. รับค่าวันที่ (ถ้าไม่มี ให้ Default เป็นวันนี้)
// HTML ส่งมาเป็น ค.ศ. (เช่น 2024-10-01) แต่ DB ใช้ พ.ศ. (2567-10-01) ตามโค้ดตัวอย่าง
$date_start_input = isset($_POST['date_start']) ? $_POST['date_start'] : date("Y-m-d");
$date_end_input   = isset($_POST['date_end']) ? $_POST['date_end'] : date("Y-m-d");
$disease_filter   = isset($_POST['disease']) ? $_POST['disease'] : 'all';

// แปลง ค.ศ. เป็น พ.ศ. เพื่อใช้ Query ใน DB
function toThaiDateDB($date) {
    list($y, $m, $d) = explode("-", $date);
    $y_th = $y + 543;
    return "$y_th-$m-$d";
}

$date_start_th = toThaiDateDB($date_start_input);
$date_end_th   = toThaiDateDB($date_end_input);

// 2. สร้าง SQL Query
// เงื่อนไขพื้นฐาน: ช่วงเวลา + มาหลังนัด (organ like %หลังนัด%) + ตัดห้องตรวจที่ไม่เกี่ยวข้อง
$sql = "SELECT * FROM opd 
        WHERE thidate >= '$date_start_th 00:00:00' 
        AND thidate <= '$date_end_th 23:59:59' 
        AND organ LIKE '%หลังนัด%'
        AND (room NOT LIKE 'ห้องตรวจสูติ' 
             AND room NOT LIKE 'ห้องทันตกรรม' 
             AND room NOT LIKE 'ห้องตรวจตา' 
             AND room NOT LIKE 'ห้องตรวจเวชศาสตร์ฟื้นฟู') ";

// 3. เงื่อนไขโรค (Dynamic Condition)
if ($disease_filter == 'all') {
    // ค้นหาทั้งหมดในกลุ่มโรคเรื้อรัง (ตามตัวอย่างโค้ด)
    $sql .= " AND (congenital_disease LIKE '%TB%' OR congenital_disease LIKE '%DM%' OR congenital_disease LIKE '%HIV%')";
} elseif ($disease_filter == 'DM') {
    $sql .= " AND congenital_disease LIKE '%DM%'";
} elseif ($disease_filter == 'HIV') {
    $sql .= " AND congenital_disease LIKE '%HIV%'";
} elseif ($disease_filter == 'TB') {
    $sql .= " AND congenital_disease LIKE '%TB%'";
}

// เรียงลำดับ
$sql .= " ORDER BY chkup DESC";

$result = mysql_query($sql);
$total_rows = mysql_num_rows($result);

?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ระบบรายงานผู้ป่วยมาหลังนัด</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f0f4f8; /* สีพื้นหลังเทาอมฟ้าอ่อน */
            color: #333;
        }
        .header-bar {
            background: linear-gradient(135deg, #005f6b 0%, #008c9e 100%); /* โทนเขียว-ฟ้า โรงพยาบาล */
            color: white;
            padding: 20px 0;
            margin-bottom: 25px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-search {
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
            background: white;
            margin-bottom: 20px;
        }
        .btn-search {
            background-color: #008c9e;
            color: white;
            border-radius: 50px;
            padding-left: 30px;
            padding-right: 30px;
        }
        .btn-search:hover {
            background-color: #007685;
            color: white;
        }
        .table-container {
            background: white;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.05);
        }
        .table thead {
            background-color: #e3f2fd; /* ฟ้าอ่อนมาก */
            color: #005f6b;
        }
        .badge-disease {
            font-size: 0.9em;
            padding: 5px 10px;
            border-radius: 20px;
        }
        .bg-dm { background-color: #ffe0b2; color: #e65100; }
        .bg-hiv { background-color: #ffcdd2; color: #c62828; }
        .bg-tb { background-color: #e1bee7; color: #6a1b9a; }
        .bg-other { background-color: #cfd8dc; color: #455a64; }
    </style>
</head>
<body>

    <div class="header-bar">
        <div class="container">
            <h3 class="m-0"><i class="bi bi-hospital"></i> สถิติผู้ป่วยมาหลังนัด (Late Appointment Report)</h3>
            <small>ระบบรายงานห้องตรวจโรคผู้ป่วยนอก</small>
        </div>
    </div>

    <div class="container">
        
        <div class="card card-search p-4">
            <form method="post" action="">
                <div class="row align-items-end">
                    <div class="col-md-3">
                        <label class="form-label fw-bold">วันที่เริ่มต้น</label>
                        <input type="date" name="date_start" class="form-control" value="<?php echo $date_start_input; ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">วันที่สิ้นสุด</label>
                        <input type="date" name="date_end" class="form-control" value="<?php echo $date_end_input; ?>">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label fw-bold">กลุ่มโรค (Disease)</label>
                        <select name="disease" class="form-select">
                            <option value="all" <?php if($disease_filter=='all') echo 'selected'; ?>>ทั้งหมด (DM, HIV, TB)</option>
                            <option value="DM" <?php if($disease_filter=='DM') echo 'selected'; ?>>เบาหวาน (DM)</option>
                            <option value="HIV" <?php if($disease_filter=='HIV') echo 'selected'; ?>>ผู้ติดเชื้อ (HIV)</option>
                            <option value="TB" <?php if($disease_filter=='TB') echo 'selected'; ?>>วัณโรค (TB)</option>
                        </select>
                    </div>
                    <div class="col-md-3 text-end">
                        <button type="submit" class="btn btn-search fw-bold">
                            🔍 ค้นหาข้อมูล
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php if($total_rows > 0): ?>
            <div class="alert alert-success d-flex justify-content-between align-items-center">
                <span><strong>ผลการค้นหา:</strong> พบข้อมูลจำนวน <strong><?php echo number_format($total_rows); ?></strong> รายการ</span>
                <span class="badge bg-secondary">ช่วงวันที่: <?php echo $date_start_th; ?> ถึง <?php echo $date_end_th; ?></span>
            </div>

            <div class="table-container table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">ลำดับ</th>
                            <th width="10%">วันที่รับบริการ</th>
                            <th width="10%">HN</th>
                            <th width="20%">ชื่อ-สกุล</th>
                            <th width="15%">โรคประจำตัว</th>
                            <th width="20%">อาการ (Organ)</th>
                            <th width="20%">HPI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        while($row = mysql_fetch_array($result)) { 
                            // จัดการสีของ Badge โรค
                            $d_class = 'bg-other';
                            $dx = strtoupper($row['congenital_disease']);
                            if(strpos($dx, 'DM') !== false) $d_class = 'bg-dm';
                            elseif(strpos($dx, 'HIV') !== false) $d_class = 'bg-hiv';
                            elseif(strpos($dx, 'TB') !== false) $d_class = 'bg-tb';
                        ?>
                        <tr>
                            <td class="text-center fw-bold text-muted"><?php echo $i++; ?></td>
                            <td><?php echo $row['thidate']; ?></td>
                            <td class="fw-bold text-primary"><?php echo $row['hn']; ?></td>
                            <td><?php echo $row['ptname']; ?></td>
                            <td>
                                <span class="badge badge-disease <?php echo $d_class; ?>">
                                    <?php echo $row['congenital_disease']; ?>
                                </span>
                            </td>
                            <td class="text-danger small"><?php echo $row['organ']; ?></td>
                            <td class="small text-muted"><?php echo $row['hpi']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-4">
                <h4>ไม่พบข้อมูลตามเงื่อนไขที่ค้นหา</h4>
                <p>ลองปรับเปลี่ยนช่วงวันที่หรือประเภทโรค</p>
            </div>
        <?php endif; ?>

    </div>

    <footer class="text-center mt-5 mb-3 text-muted small">
        &copy; <?php echo date("Y"); ?> Hospital Information System. All rights reserved.
    </footer>

</body>
</html>

<?php
// ปิดการเชื่อมต่อ
mysql_close($conn);
?>