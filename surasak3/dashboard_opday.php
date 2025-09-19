<?php
session_start();
include("connect.inc");
?>
<?php
// --- PHP สำหรับดึงข้อมูลจาก MySQL (รองรับ PHP <5.2) ---
// กำหนดวันที่ (default = วันนี้)
$date = "2568-09-17";

// ฟังก์ชันนับจำนวนผู้ป่วย
function getCount($date, $type="") {
    if($type != "") {
        $sql = "SELECT COUNT(*) as total FROM opday WHERE DATE(thidate)='$date' AND toborow LIKE '$type%'";
    } else {
        $sql = "SELECT COUNT(*) as total FROM opday WHERE DATE(thidate)='$date'";
    }
    $result = mysql_query($sql) or die(mysql_error());
    $row = mysql_fetch_assoc($result);
    return $row['total'];
}

// เรียกใช้งาน
$total = getCount($date);
$appointment = getCount($date,'EX04');
$walkin = getCount($date,'EX01');
$emergency = getCount($date,'EX02');

// ฟังก์ชันดึงข้อมูลกลุ่ม
function getGroupData($date, $field) {
    $data = array();
    $sql = "SELECT $field, COUNT(*) as count FROM opday WHERE DATE(thidate)='$date' GROUP BY $field";
    $result = mysql_query($sql) or die(mysql_error());
    while($row = mysql_fetch_assoc($result)) {
        $key = $row[$field] != "" ? $row[$field] : "ไม่ระบุ";
        $data[$key] = $row['count'];
    }
    return $data;
}

// เรียกใช้งาน
$ptright_data = getGroupData($date,'ptright');
$typeservice_data = getGroupData($date,'typeservice');
$clinic_data = getGroupData($date,'clinic');
?>

<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Hospital Dashboard</title>

<style>
    body {
        font-family: Tahoma, Arial, sans-serif;
        margin:0; padding:20px;
        background: linear-gradient(135deg,#74ebd5,#ACB6E5);
    }
    h1 {
        text-align:center;
        color:#2c3e50;
        margin-bottom:20px;
    }
    .card {
        background:#fff;
        border-radius:15px;
        padding:20px;
        margin-bottom:20px;
        box-shadow:0 4px 15px rgba(0,0,0,0.1);
    }
    .summary-box {
        display:inline-block;
        width:23%;
        margin:1%;
        padding:20px;
        border-radius:12px;
        text-align:center;
        color:white;
        font-weight:bold;
        font-size:16px;
        box-shadow:0 3px 10px rgba(0,0,0,0.15);
    }
    .total {background:#3498db;}
    .done {background:#2ecc71;}
    .pending {background:#e74c3c;}
    .today {background:#f39c12;}
    table {
        width:100%;
        border-collapse:collapse;
        margin-top:15px;
        background:white;
        border-radius:10px;
        overflow:hidden;
    }
    th, td {
        padding:10px;
        border-bottom:1px solid #eee;
        text-align:center;
    }
    th {background:#3498db; color:white;}
    tr:hover {background:#f8f9fa;}
    .chart {
        width: 80%;
        height: 400px;
        margin: auto;
    }   
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>📊 Hospital Dashboard</h1>

<div class="card">
    <div class="summary-box total">รวมทั้งหมด<br><?php echo $total; ?></div>
    <div class="summary-box done">นัดหมาย<br><?php echo $appointment; ?></div>
    <div class="summary-box pending">ทั่วไป<br><?php echo $walkin; ?></div>
    <div class="summary-box today">ฉุกเฉิน<br><?php echo $emergency; ?></div>
    <div class="summary-box total">ผู้ป่วยใหม่<br><?php echo $newpatient; ?></div>
</div>

<div class="card">
    <h2>📌 ผู้รับบริการแบ่งตามสิทธิการรักษา</h2>
    <canvas id="ptrightChart" class="chart"></canvas>
</div>

<div class="card">
    <h2>📌 ผู้รับบริการแบ่งตามประเภทบุคคล</h2>
    <canvas id="typeserviceChart" class="chart"></canvas>
</div>

<div class="card">
    <h2>📌 ผู้รับบริการแบ่งตามคลินิก</h2>
    <canvas id="clinicChart" class="chart"></canvas>
</div>

<script>
// ฟังก์ชันสร้างกราฟ
function renderChart(ctx, labels, data, title, type="bar") {
    new Chart(ctx, {
        type: type,
        data: {
            labels: labels,
            datasets: [{
                label: title,
                data: data,
                backgroundColor: [
                    '#2ecc71','#3498db','#9b59b6','#f39c12','#e74c3c','#16a085','#2980b9','#8e44ad'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive:true,
            maintainAspectRatio:false,
            plugins: {
                legend: { display: true, position:'bottom' }
            }
        }
    });
}

// ข้อมูล PHP → JS
var ptrightLabels = <?php echo json_encode(array_keys($ptright_data)); ?>;
var ptrightValues = <?php echo json_encode(array_values($ptright_data)); ?>;

var typeserviceLabels = <?php echo json_encode(array_keys($typeservice_data)); ?>;
var typeserviceValues = <?php echo json_encode(array_values($typeservice_data)); ?>;

var clinicLabels = <?php echo json_encode(array_keys($clinic_data)); ?>;
var clinicValues = <?php echo json_encode(array_values($clinic_data)); ?>;

// สร้างกราฟ
renderChart(document.getElementById('ptrightChart').getContext('2d'), ptrightLabels, ptrightValues, "สิทธิการรักษา", "pie");
renderChart(document.getElementById('typeserviceChart').getContext('2d'), typeserviceLabels, typeserviceValues, "ประเภทบุคคล", "doughnut");
renderChart(document.getElementById('clinicChart').getContext('2d'), clinicLabels, clinicValues, "คลินิก", "bar");
</script>

</body>
</html>
