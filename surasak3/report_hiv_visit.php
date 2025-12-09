<?php
session_start();

// ==========================================
// ส่วนการเชื่อมต่อฐานข้อมูล (CONFIG)
// ==========================================
include("connect.inc");
//print_r($_SESSION);
if ($_SESSION["sIdname"] == "จีราภรณ์2" || $_SESSION["smenucode"] == "ADM") {
	
// ==========================================
// 2. ส่วนรับค่าและเตรียมตัวแปร (LOGIC)
// ==========================================

// รับค่าวันที่จากฟอร์ม (ถ้าไม่มีให้ใช้ค่าปัจจุบัน)
// HTML ส่งมาเป็น ค.ศ. (2024-10-01)
$date_start_input = isset($_POST['date_start']) ? $_POST['date_start'] : date("Y-m-d");
$date_end_input   = isset($_POST['date_end']) ? $_POST['date_end'] : date("Y-m-d");

// ฟังก์ชันแปลง ค.ศ. เป็น พ.ศ. สำหรับ Query (เช่น 2024 -> 2567)
function toThaiDateDB($date) {
    list($y, $m, $d) = explode("-", $date);
    $y_th = $y + 543;
    return "$y_th-$m-$d";
}

$d_start_th = toThaiDateDB($date_start_input);
$d_end_th   = toThaiDateDB($date_end_input);

// สร้าง SQL ตามตัวอย่างที่คุณให้มา
// ใช้ a.thidate ในการกรองช่วงเวลา
$sql = "SELECT a.hn, a.ptname, a.napnumber, b.thidate, b.idcard, b.ptright, b.icd10 
        FROM hiv AS a 
        INNER JOIN opday AS b ON a.hn = b.hn 
        WHERE b.thidate BETWEEN '$d_start_th 00:00:00' AND '$d_end_th 23:59:59'
        ORDER BY b.thidate ASC"; 
//echo $sql;
$result = mysql_query($sql);
$total_rows = mysql_num_rows($result);
}else{
	echo $_SESSION["smenucode"];
    echo "
    <div style='
        text-align:center;
        margin-top:100px;
        font-size:22px;
        font-weight:bold;
        color:#d9534f;
        font-family:Tahoma;
    '>
        ❌ ไม่สามารถใช้งานเมนูนี้ได้ ❌
        <br><br>
        <button onclick='window.close();' 
            style='
                padding:10px 20px;
                background:#d9534f;
                border:none;
                color:#fff;
                font-size:18px;
                border-radius:6px;
                cursor:pointer;
            '>
            ปิดหน้าต่าง
        </button>
    </div>
    ";

    exit();	
}	
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>สถิติการมารับบริการผู้ป่วยติดเชื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Sarabun:wght@300;400;600&display=swap" rel="stylesheet">
    
    <style>
        body {
            font-family: 'Sarabun', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }
        .header-section {
            background: linear-gradient(120deg, #2b5876 0%, #4e4376 100%); /* โทนน้ำเงิน-ม่วง ดูสงบและทันสมัย */
            color: white;
            padding: 30px 0;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .card-search {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            background: white;
            padding: 25px;
            margin-bottom: 25px;
        }
        .btn-custom {
            background-color: #4e4376;
            color: white;
            border-radius: 30px;
            padding: 8px 25px;
            transition: all 0.3s;
        }
        .btn-custom:hover {
            background-color: #2b5876;
            color: white;
            transform: translateY(-2px);
        }
        .table-container {
            background: white;
            border-radius: 12px;
            padding: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }
        .table thead {
            background-color: #e9ecef;
            color: #495057;
        }
        .table th {
            font-weight: 600;
            border-top: none;
        }
        .badge-nap {
            background-color: #e3f2fd;
            color: #0d47a1;
            border: 1px solid #bbdefb;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        .badge-right {
            background-color: #f3e5f5;
            color: #7b1fa2;
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

    <div class="header-section">
        <div class="container">
            <h2 class="mb-1"><i class="bi bi-file-medical"></i> รายงานสถิติผู้ป่วยติดเชื้อ (HIV Service Report)</h2>
            <p class="mb-0 text-white-50">ระบบรายงานห้องตรวจโรคผู้ป่วยนอก</p>
        </div>
    </div>

    <div class="container">
        <div class="card-search">
            <form method="post" action="">
                <div class="row align-items-end">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">📅 วันที่เริ่มต้น</label>
                        <input type="date" name="date_start" class="form-control" value="<?php echo $date_start_input; ?>">
                    </div>
                    <div class="col-md-4">
                        <label class="form-label fw-bold">📅 วันที่สิ้นสุด</label>
                        <input type="date" name="date_end" class="form-control" value="<?php echo $date_end_input; ?>">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-custom w-100 fw-bold">
                            🔍 ค้นหาข้อมูล
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <?php if($total_rows > 0): ?>
            <div class="alert alert-success d-flex justify-content-between align-items-center">
                <span>พบข้อมูลจำนวน <strong><?php echo number_format($total_rows); ?></strong> รายการ</span>
                <small>ช่วงวันที่: <?php echo $d_start_th; ?> ถึง <?php echo $d_end_th; ?></small>
            </div>

            <div class="table-container table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="text-center" width="5%">ลำดับ</th>
                            <th width="12%">วันที่รับบริการ</th>
                            <th width="15%">เลขบัตรประชาชน</th>
                            <th width="12%">NAP No.</th>
                            <th width="10%">HN</th>
                            <th width="20%">ชื่อ-สกุล</th>
                            <th width="15%">สิทธิการรักษา</th>
                            <th width="11%">รหัสโรค</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $i = 1;
                        while($row = mysql_fetch_array($result)) { 
                        ?>
                        <tr>
                            <td class="text-center text-muted"><?php echo $i++; ?></td>
                            <td><?php echo $row['thidate']; ?></td>
                            <td class="text-secondary"><?php echo $row['idcard']; ?></td>
                            <td>
                                <?php if($row['napnumber']): ?>
                                    <span class="badge-nap"><?php echo $row['napnumber']; ?></span>
                                <?php else: ?>
                                    -
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold text-primary"><?php echo $row['hn']; ?></td>
                            <td><?php echo $row['ptname']; ?></td>
                            <td><span class="badge-right"><?php echo $row['ptright']; ?></span></td>
                            <td class="text-danger fw-bold"><?php echo $row['icd10']; ?></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

        <?php else: ?>
            <div class="alert alert-warning text-center mt-4">
                <h4>ไม่พบข้อมูลในช่วงวันที่เลือก</h4>
                <p class="mb-0">กรุณาตรวจสอบช่วงวันที่อีกครั้ง</p>
            </div>
        <?php endif; ?>
    </div>

    <br><br>
</body>
</html>

<?php
mysql_close($conn);
?>