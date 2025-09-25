<?php
session_start();
include("connect.inc");

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
	//$yearcheck="25".$nPrefix;
	$yearcheck="2568";
// ดึงข้อมูลกลุ่มโรค
$sql1 = "
SELECT 
    r.camp,
    p.disease_code,
    p.disease_name,
    COUNT(*) AS total
FROM personnel_disease p
JOIN register_chkup_soldier r ON r.hn = p.hn
WHERE p.group_type='กลุ่มโรค'
  AND r.yearcheck = '$yearcheck'
GROUP BY r.camp, p.disease_code, p.disease_name
ORDER BY p.disease_code, r.camp
";
//echo $sql1;
$res1 = mysql_query($sql1);

$chartDisease = array();
$camps = array();
$diseases = array();

while($row = mysql_fetch_assoc($res1)){
    $camp = $row['camp'];
    $code = $row['disease_code'];
    $name = $row['disease_name'];
    $total = $row['total'];

    if(!isset($chartDisease[$code])) $chartDisease[$code] = array();
    $chartDisease[$code][$camp] = $total;

    if(!in_array($camp, $camps)) $camps[] = $camp;
    $diseases[$code] = $name;
}

// ดึงข้อมูลกลุ่มเสี่ยง
$sql2 = "
SELECT 
    r.camp,
    p.disease_code,
    p.disease_name,
    COUNT(*) AS total
FROM personnel_disease p
JOIN register_chkup_soldier r ON r.hn = p.hn
WHERE p.group_type='กลุ่มเสี่ยง'
  AND r.yearcheck = '$yearcheck'
GROUP BY r.camp, p.disease_code, p.disease_name
ORDER BY p.disease_code, r.camp
";
$res2 = mysql_query($sql2);

$chartRisk = array();
$risks = array();

while($row = mysql_fetch_assoc($res2)){
    $camp = $row['camp'];
    $code = $row['disease_code'];
    $name = $row['disease_name'];
    $total = $row['total'];

    if(!isset($chartRisk[$code])) $chartRisk[$code] = array();
    $chartRisk[$code][$camp] = $total;

    if(!in_array($camp, $camps)) $camps[] = $camp;
    $risks[$code] = $name;
}

// จัดเรียง
ksort($diseases);
ksort($risks);
sort($camps);
?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="utf-8">
  <title>Dashboard กลุ่มโรค & กลุ่มเสี่ยง</title>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <style>
    body{font-family:Arial,Helvetica,sans-serif;background:#f5f7fb;padding:20px}
    .card{background:#fff;border-radius:12px;box-shadow:0 6px 16px rgba(0,0,0,0.08);padding:20px;margin-bottom:20px}
    h1,h2{margin-top:0;color:#17324b;text-align:center}
  </style>
    <meta charset="UTF-8">
    <title>สรุปข้อมูลกลุ่มโรคและกลุ่มเสี่ยง</title>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {packages:['corechart']});
    google.charts.setOnLoadCallback(drawCharts);

    function drawCharts(){
        drawDiseaseChart();
        drawRiskChart();
    }

    function drawDiseaseChart(){
        var data = google.visualization.arrayToDataTable([
            ['โรค'<?php foreach($camps as $camp){ echo ",'".$camp."'"; } ?>],
            <?php foreach($diseases as $code=>$name){
                echo "['".$name."'";
                foreach($camps as $c){
                    $cnt = isset($chartDisease[$code][$c]) ? $chartDisease[$code][$c] : 0;
                    echo ", ".$cnt;
                }
                echo "],\n";
            } ?>
        ]);

        var options = {
            title: 'จำนวนผู้ป่วยแต่ละโรค (เรียงตามรหัส)',
            chartArea: {width: '70%', height: '80%'},
            height: 500,
            legend: { position: 'top', maxLines: 3 },
            bar: { groupWidth: '75%' }
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_disease'));
        chart.draw(data, options);
    }

    function drawRiskChart(){
        var data = google.visualization.arrayToDataTable([
            ['กลุ่มเสี่ยง'<?php foreach($camps as $camp){ echo ",'".$camp."'"; } ?>],
            <?php foreach($risks as $code=>$name){
                echo "['".$name."'";
                foreach($camps as $c){
                    $cnt = isset($chartRisk[$code][$c]) ? $chartRisk[$code][$c] : 0;
                    echo ", ".$cnt;
                }
                echo "],\n";
            } ?>
        ]);

        var options = {
            title: 'จำนวนกลุ่มเสี่ยงแต่ละประเภท (เรียงตามรหัส)',
            chartArea: {width: '70%', height: '80%'},
            height: 500,
            legend: { position: 'top', maxLines: 3 },
            bar: { groupWidth: '75%' },
            colors: ['#ff9800', '#f44336', '#2196f3', '#4caf50', '#9c27b0']
        };

        var chart = new google.visualization.ColumnChart(document.getElementById('chart_risk'));
        chart.draw(data, options);
    }
    </script>
</head>
<body>
  <div class="card">
    <h1>📊 Dashboard การวิเคราะห์สุขภาพ</h1>
  </div>
  <div class="card">
    <h2>กลุ่มโรค (สีแดง)</h2>
    <div id="chart_disease"></div>
  </div>

  <div class="card">
    <h2>กลุ่มเสี่ยง (สีเหลือง)</h2>
    <div id="chart_risk"></div>
  </div>
</body>
</html>
