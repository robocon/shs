<?php
session_start();
include("connect.inc");
include("function.php");

////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$yearcheck="25".$nPrefix;
	//$yearcheck="2568";
////*runno ตรวจสุขภาพ*/////////

// ==== QUERY DATA ====
$sql_total = "SELECT COUNT(*) AS total FROM register_chkup_soldier WHERE yearcheck='$yearcheck'";
$res_total = mysql_query($sql_total);
$row_total = mysql_fetch_assoc($res_total);
$total_all = $row_total['total'];

// ตรวจแล้ว
$sql_done = "SELECT COUNT(*) AS done FROM register_chkup_soldier WHERE yearcheck='$yearcheck' AND active='y'";
$res_done = mysql_query($sql_done);
$row_done = mysql_fetch_assoc($res_done);
$done_all = $row_done['done'];

// ยังไม่ได้ตรวจ
$pending_all = $total_all - $done_all;

// ==== แยกตาม camp ====
$sql_camp = "SELECT camp,
                COUNT(*) AS total,
                SUM(CASE WHEN active='y' THEN 1 ELSE 0 END) AS done,
                SUM(CASE WHEN active='' THEN 1 ELSE 0 END) AS pending
             FROM register_chkup_soldier WHERE yearcheck='$yearcheck'
             GROUP BY camp";
$res_camp = mysql_query($sql_camp);


// ==== สรุปตรวจวันนี้ ====
$today = date("Y-m-d");

$y = date("Y") + 543; // ปี พ.ศ.
$m = date("m");       // เดือน
$d = date("d");       // วัน

$thai_date = $y . "-" . $m . "-" . $d;


$sql_today = "SELECT camp,
                COUNT(*) AS today_total			
              FROM register_chkup_soldier
              WHERE yearcheck='$yearcheck' AND register_date LIKE '$today%'
              GROUP BY camp";
			  //echo $sql_today;
$res_today = mysql_query($sql_today);

// ==== ข้อมูลตรวจวันนี้ ====
$sql_today1 = "SELECT camp,
                SUM(CASE WHEN active='y' THEN 1 ELSE 0 END) AS done,
                SUM(CASE WHEN active='' THEN 1 ELSE 0 END) AS pending				
              FROM register_chkup_soldier
              WHERE yearcheck='$yearcheck' AND register_date LIKE '$today%'
              GROUP BY camp";
			  //echo $sql_today;
$res_today1 = mysql_query($sql_today1);

// ==== เพศ ====
$sql_sex = "SELECT sex, COUNT(*) AS cnt FROM register_chkup_soldier WHERE yearcheck='$yearcheck' GROUP BY sex";
$res_sex = mysql_query($sql_sex);

// ==== อายุ ====
$yearNow = date("Y");
$sql_age = "SELECT
            SUM(CASE WHEN (YEAR(CURDATE()) - YEAR(birthdate)) < 35 THEN 1 ELSE 0 END) AS under35,
            SUM(CASE WHEN (YEAR(CURDATE()) - YEAR(birthdate)) >= 35 THEN 1 ELSE 0 END) AS over35
            FROM register_chkup_soldier WHERE yearcheck='$yearcheck'";
$res_age = mysql_query($sql_age);
$row_age = mysql_fetch_assoc($res_age);
?>
<!DOCTYPE html>
<html lang="th">
<head>
<meta charset="UTF-8">
<title>Dashboard ตรวจสุขภาพประจำปี 2569</title>
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
        ['ตรวจแล้ว', <?php echo $done_all; ?>],
        ['ยังไม่ได้ตรวจ', <?php echo $pending_all; ?>]
    ]);
    var chartStatus = new google.visualization.PieChart(document.getElementById('chart_active'));
    chartStatus.draw(dataStatus, {title:'อัตราการเข้ารับบริการของกำลังพล'});

}
</script>
</head>
<body>

<h1>📊 Dashboard ตรวจสุขภาพประจำปี 2569</h1>

<!-- SUMMARY BOX -->
<div class="card">
    <div class="summary-box total">กำลังพลทั้งหมด<br><?php echo $total_all; ?> นาย</div>
    <div class="summary-box done">ตรวจแล้ว<br><?php echo $done_all; ?> นาย</div>
    <div class="summary-box pending">ยังไม่ได้ตรวจ<br><?php echo $pending_all; ?> นาย</div>
    <div class="summary-box today">ตรวจวันนี้<br>
        <?php
        $sum_today = 0;
        while($row_today = mysql_fetch_assoc($res_today)) { $sum_today += $row_today['today_total']; }
        echo $sum_today;
        ?> นาย
    </div>
</div>

<div class="card">
    <h2>ภาพรวมการตรวจสุขภาพประจำปี <?=$yearcheck?></h2>
    <div id="chart_active" class="chart"></div>
</div>

<!-- DATA BY CAMP -->
<div class="card">
    <h2>📅 ข้อมูลเข้ารับการตรวจประจำวันที่ <?php echo displaydate_th($thai_date);?></h2>
    <table>
        <tr>
            <th>ชื่อหน่วยงาน</th>
            <th>จำนวนทั้งหมด</th>
            <th>ตรวจวันนี้</th>
            <th>ยังไม่ได้ตรวจ</th>
        </tr>
        <?php while($rowd = mysql_fetch_array($res_today1)) {
		
		// ==== แยกตาม camp ====
		$sql_camp1 = "SELECT camp,
						COUNT(*) AS total
					 FROM register_chkup_soldier WHERE yearcheck='$yearcheck' AND camp='".$rowd['camp']."'
					 GROUP BY camp";
					 //echo $sql_camp1;
		$chk_camp = mysql_query($sql_camp1);	
		list($camp,$totalcamp)=mysql_fetch_array($chk_camp);		
?>		
		
		
        <tr>
            <td><?php echo htmlspecialchars($rowd['camp']); ?></td>
            <td><?php echo $totalcamp; ?></td>
            <td style="color:green;"><?php echo $rowd['done']; ?></td>
            <td style="color:red;"><?php echo $rowd['pending']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- DATA BY CAMP -->
<div class="card">
    <h2>📌 ข้อมูลแยกตามสังกัด/หน่วยงาน <span style="margin-left:20px;font-size:16px;"><a href="dashboard_chkup_soldier_camp.php" target="_blank" style="text-decoration:none; color:#0d6efd;">แสดงกราฟเปรียบเทียบ</a></span></h2>
    <table>
        <tr>
            <th>ชื่อหน่วยงาน</th>
            <th>จำนวนทั้งหมด</th>
            <th>ตรวจแล้ว</th>
            <th>ยังไม่ได้ตรวจ</th>
        </tr>
        <?php while($row = mysql_fetch_assoc($res_camp)) { ?>
        <tr>
            <td><?php echo htmlspecialchars($row['camp']); ?></td>
            <td><?php echo $row['total']; ?></td>
            <td style="color:green;"><?php echo $row['done']; ?></td>
            <td style="color:red;"><?php echo $row['pending']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- GENDER -->
<div class="card">
    <h2>👥 เพศ</h2>
    <table>
        <tr><th>เพศ</th><th>จำนวน</th></tr>
        <?php while($row_g = mysql_fetch_assoc($res_sex)) { ?>
        <tr>
            <td><?php echo ($row_g['sex']=='1') ? 'ชาย' : 'หญิง'; ?></td>
            <td><?php echo $row_g['cnt']; ?></td>
        </tr>
        <?php } ?>
    </table>
</div>

<!-- AGE -->
<div class="card">
    <h2>📅 ช่วงอายุ</h2>
    <table>
        <tr><th>ต่ำกว่า 35 ปี</th><th>ตั้งแต่ 35 ปีขึ้นไป</th></tr>
        <tr>
            <td><?php echo $row_age['under35']; ?> นาย</td>
            <td><?php echo $row_age['over35']; ?> นาย</td>
        </tr>
    </table>
</div>

</body>
</html>
