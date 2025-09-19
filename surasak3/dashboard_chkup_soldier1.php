<?php
session_start();
include("connect.inc");

// ========================
// ดึงข้อมูลจากตาราง register_chkup_soldier
// ========================

// กำลังพลทั้งหมด
$sql_total = "SELECT COUNT(*) as total FROM register_chkup_soldier";
$res_total = mysql_query($sql_total);
$row_total = mysql_fetch_assoc($res_total);
$total_all = $row_total['total'];

// แยกตามหน่วย (camp)
$sql_camp = "SELECT camp, COUNT(*) as total FROM register_chkup_soldier GROUP BY camp";
$res_camp = mysql_query($sql_camp);
$camps = array();
while($row = mysql_fetch_assoc($res_camp)){
    $camps[] = $row;
}

// ตรวจเรียบร้อยแล้ว
$sql_checked = "SELECT COUNT(*) as checked FROM register_chkup_soldier WHERE active='y'";
$res_checked = mysql_query($sql_checked);
$row_checked = mysql_fetch_assoc($res_checked);
$total_checked = $row_checked['checked'];

// ยังไม่ได้ตรวจ
$total_unchecked = $total_all - $total_checked;

// แยกตามหน่วย (ตรวจแล้ว/ยังไม่ได้ตรวจ)
$sql_active_camp = "
    SELECT camp,
        SUM(CASE WHEN active='y' THEN 1 ELSE 0 END) as checked,
        SUM(CASE WHEN active!='y' THEN 1 ELSE 0 END) as unchecked
    FROM register_chkup_soldier
    GROUP BY camp";
$res_active_camp = mysql_query($sql_active_camp);
$active_camps = array();
while($row = mysql_fetch_assoc($res_active_camp)){
    $active_camps[] = $row;
}

// ประจำวัน (เช็ควันที่ปัจจุบัน)
$today = date("Y-m-d");
$sql_today = "SELECT COUNT(*) as total FROM register_chkup_soldier WHERE DATE(register_date)='$today'";
$res_today = mysql_query($sql_today);
$row_today = mysql_fetch_assoc($res_today);
$total_today = $row_today['total'];

// ประจำวัน แยกตามหน่วย
$sql_today_camp = "
    SELECT camp, COUNT(*) as total 
    FROM register_chkup_soldier 
    WHERE DATE(register_date)='$today'
    GROUP BY camp";
$res_today_camp = mysql_query($sql_today_camp);
$today_camps = array();
while($row = mysql_fetch_assoc($res_today_camp)){
    $today_camps[] = $row;
}

// เพศ + อายุ
$sql_sex = "
    SELECT 
        SUM(CASE WHEN sex='1' THEN 1 ELSE 0 END) as male,
        SUM(CASE WHEN sex='2' THEN 1 ELSE 0 END) as female,
        SUM(CASE WHEN TIMESTAMPDIFF(YEAR,birthdate,CURDATE()) < 35 THEN 1 ELSE 0 END) as under35,
        SUM(CASE WHEN TIMESTAMPDIFF(YEAR,birthdate,CURDATE()) >= 35 THEN 1 ELSE 0 END) as over35
    FROM register_chkup_soldier";
$res_sex = mysql_query($sql_sex);
$row_sex = mysql_fetch_assoc($res_sex);

?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Dashboard - การตรวจสุขภาพประจำปี 2569</title>
<style>
body {
    font-family: Tahoma, sans-serif;
    background: #f4f7f9;
    margin: 0;
    padding: 0;
}
.container {
    width: 95%;
    margin: 20px auto;
}
.card {
    background: #fff;
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 20px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}
.card h2 {
    margin-top: 0;
    color: #2c3e50;
}
.grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
}
.stat {
    background: linear-gradient(135deg, #6a11cb, #2575fc);
    color: white;
    padding: 15px;
    border-radius: 10px;
    text-align: center;
    font-size: 20px;
}
.chart {
    width: 100%;
    height: 400px;
}
</style>
<!-- เรียกใช้งาน Google Charts -->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
google.charts.load('current', {'packages':['corechart','bar']});
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    // ตรวจแล้ว/ยังไม่ได้ตรวจ (Pie)
    var dataStatus = google.visualization.arrayToDataTable([
        ['สถานะ', 'จำนวน'],
        ['ตรวจแล้ว', <?php echo $total_checked; ?>],
        ['ยังไม่ได้ตรวจ', <?php echo $total_unchecked; ?>]
    ]);
    var chartStatus = new google.visualization.PieChart(document.getElementById('chart_active'));
    chartStatus.draw(dataStatus, {title:'สถานะการตรวจ (ภาพรวม)'});

    // แยกเพศ (Pie)
    var dataGender = google.visualization.arrayToDataTable([
        ['เพศ', 'จำนวน'],
        ['ชาย', <?php echo $row_sex['male']; ?>],
        ['หญิง', <?php echo $row_sex['female']; ?>]
    ]);
    var chartGender = new google.visualization.PieChart(document.getElementById('chart_sex'));
    chartGender.draw(dataGender, {title:'เพศ'});

    // อายุ (Bar)
    var dataAge = google.visualization.arrayToDataTable([
        ['ช่วงอายุ', 'จำนวน'],
        ['< 35 ปี', <?php echo $row_sex['under35']; ?>],
        ['>= 35 ปี', <?php echo $row_sex['over35']; ?>]
    ]);
    var chartAge = new google.visualization.ColumnChart(document.getElementById('chart_age'));
    chartAge.draw(dataAge, {title:'ช่วงอายุ'});

    // ประจำวัน แยกตามหน่วย (Bar)
    var dataToday = google.visualization.arrayToDataTable([
        ['หน่วย', 'จำนวน'],
        <?php foreach($today_camps as $c){ echo "['".$c['camp']."', ".$c['total']."],"; } ?>
    ]);
    var chartToday = new google.visualization.BarChart(document.getElementById('chart_today'));
    chartToday.draw(dataToday, {title:'เข้ารับการตรวจสุขภาพวันนี้ (แยกตามหน่วย)'});
}
</script>
</head>
<body>
<div class="container">

    <h1 style="text-align:center;color:#34495e;">📊 Dashboard - การตรวจสุขภาพประจำปี 2569</h1>

    <div class="grid">
        <div class="stat">กำลังพลทั้งหมด <br><?php echo $total_all; ?> คน</div>
        <div class="stat">ตรวจแล้ว <br><?php echo $total_checked; ?> คน</div>
        <div class="stat">ยังไม่ได้ตรวจ <br><?php echo $total_unchecked; ?> คน</div>
    </div>

    <div class="card">
        <h2>ภาพรวมสถานะ</h2>
        <div id="chart_active" class="chart"></div>
    </div>

    <div class="card">
        <h2>ข้อมูลเพศ</h2>
        <div id="chart_sex" class="chart"></div>
    </div>

    <div class="card">
        <h2>ข้อมูลอายุ</h2>
        <div id="chart_age" class="chart"></div>
    </div>

    <div class="card">
        <h2>จำนวนเข้ารับการตรวจสุขภาพวันนี้ (<?php echo $today; ?>)</h2>
        <p>รวมทั้งหมด: <?php echo $total_today; ?> คน</p>
        <div id="chart_today" class="chart"></div>
    </div>

</div>
</body>
</html>
