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
	$yearcheck="25".$nPrefix;
	//$yearcheck="2568";
////*runno ตรวจสุขภาพ*/////////

// ดึงข้อมูลจำนวนเข้าตรวจสุขภาพตามหน่วย
$sqlc = "SELECT camp, COUNT(row_id) as amount 
        FROM register_chkup_soldier 
        WHERE yearcheck='$yearcheck' AND active='y'
        GROUP BY camp
        ORDER BY camp ASC";
//echo $sqlc;
$resultc = mysql_query($sqlc);

$camps = array();
$amounts = array();

while ($rowc = mysql_fetch_array($resultc)) {
    $camps[] = $rowc['camp'];
    $amounts[] = (int)$rowc['amount'];  // แปลงเป็นตัวเลขจริง
	
}

// แปลงเป็น string สำหรับ JS
$camps_js   = "['" . implode("','", $camps) . "']";
$amounts_js = "[" . implode(",", $amounts) . "]";

/*echo "<pre>";
print_r($camps);
print_r($amounts);
echo $camps_js;
echo $amounts_js;
echo "</pre>";*/


// สร้างสีแบบสุ่มหรือกำหนดเอง (เวอร์ชั่นเก่า)
$colors = array();
for ($i = 0; $i < count($camps); $i++) {
    // สร้างสีพาสเทล (ค่า R,G,B สูงๆ + alpha 0.9)
    $r = rand(150, 255);
    $g = rand(150, 255);
    $b = rand(150, 255);
    $colors[] = "'rgba(" . $r . "," . $g . "," . $b . ",0.9)'";
}

// แปลงเป็น JS array
$colors_js = "[" . implode(",", $colors) . "]";

?>
<!DOCTYPE html>
<html lang="th">
<head>
  <meta charset="UTF-8">
  <title>Dashboard ตรวจสุขภาพประจำปี</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body class="bg-light">
<div class="container mt-5">
  <div class="card shadow p-4">
    <h3 class="text-center text-primary">📊 เปรียบเทียบการเข้ารับบริการตรวจสุขภาพแต่ละหน่วย</h3>
    <canvas id="barChart" height="560"></canvas>
  </div>
</div>

<!-- เรียกใช้งาน bar Charts -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('barChart').getContext('2d');
const barChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: <?=$camps_js; ?>,
        datasets: [{
            label: 'จำนวนผู้เข้ารับบริการ (นาย)',
            data: <?=$amounts_js; ?>,
            backgroundColor: <?=$colors_js; ?>, // <-- ใส่สีแยกแท่ง
            borderColor: 'rgba(0,0,0,0.9)',
            borderWidth: 1,
            borderRadius: 6
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: { display: false },
            title: {
                display: true,
                text: 'จำนวนผู้เข้ารับบริการตรวจสุขภาพตามหน่วย',
                font: { size: 18 }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: { stepSize: 5 }
            }
        }
    }
});

</script>
</body>
</html>
