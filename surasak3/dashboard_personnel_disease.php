<?php
// dashboard_charts.php
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


function formatDiseaseName($name, $type, $group_type) {
    // ตรวจว่ามีคำว่า "ใหม่" หรือไม่
    if (strpos($type, 'ใหม่') !== false) {
        $caseType = ($group_type == 'กลุ่มโรค') ? 'รายใหม่' : 'กลุ่มเสี่ยงใหม่';
        $class = 'newcase';
    } else {
        $caseType = ($group_type == 'กลุ่มโรค') ? 'รายเก่า' : 'กลุ่มเสี่ยงเก่า';
        $class = 'oldcase';
    }

    return "<span class='group-{$group_type} {$class}'>{$name} ({$caseType})</span>";
}


// 1. สรุปจำนวนผู้ป่วยตาม group_type + newcase
// กลุ่มโรค
$sql_pie_disease = "SELECT newcase, COUNT(*) as total
                    FROM personnel_disease
                    WHERE yearcheck='$yearcheck' AND group_type='กลุ่มโรค'
                    GROUP BY newcase";
$res_pie_disease = mysql_query($sql_pie_disease);
$pie_disease = array();
while($r = mysql_fetch_assoc($res_pie_disease)){
    $pie_disease[] = $r;
}

// กลุ่มเสี่ยง
$sql_pie_risk = "SELECT newcase, COUNT(*) as total
                 FROM personnel_disease
                 WHERE yearcheck='$yearcheck' AND group_type='กลุ่มเสี่ยง'
                 GROUP BY newcase";
$res_pie_risk = mysql_query($sql_pie_risk);
$pie_risk = array();
while($r = mysql_fetch_assoc($res_pie_risk)){
    $pie_risk[] = $r;
}

// 2. จำนวนโรคแต่ละโรค
// แยกข้อมูลเป็น 2 กลุ่ม
$sql_disease_group = "SELECT disease_name, COUNT(*) as total
                      FROM personnel_disease
                      WHERE yearcheck='$yearcheck' AND group_type='กลุ่มโรค'
                      GROUP BY disease_name ORDER BY total DESC";
$res_disease_group = mysql_query($sql_disease_group);
$disease_group = array();
while($row = mysql_fetch_assoc($res_disease_group)){
    $disease_group[] = $row;
}

$sql_disease_risk = "SELECT disease_name, COUNT(*) as total
                     FROM personnel_disease
                     WHERE yearcheck='$yearcheck' AND group_type='กลุ่มเสี่ยง'
                     GROUP BY disease_name ORDER BY total DESC";
$res_disease_risk = mysql_query($sql_disease_risk);
$disease_risk = array();
while($row = mysql_fetch_assoc($res_disease_risk)){
    $disease_risk[] = $row;
}



// 3. สรุปแต่ละกำลังพล
// ดึงข้อมูลแต่ละกำลังพล แยกกลุ่มป่วยและกลุ่มเสี่ยง
$sql_each = "
SELECT 
    r.camp,
    p.hn,
    p.fullname,
    p.age,
    p.group_type,
    p.disease_name,
    p.newcase
FROM personnel_disease p
JOIN register_chkup_soldier r ON r.hn = p.hn
WHERE r.yearcheck = '$yearcheck'
ORDER BY r.camp, p.fullname, p.group_type, p.disease_name
";
$res_each = mysql_query($sql_each);

$each_summary = array();
while($r = mysql_fetch_assoc($res_each)){
    $hn = $r['hn'];
    $each_summary[$hn]['fullname'] = $r['fullname'];
    $each_summary[$hn]['age'] = $r['age'];
	$each_summary[$hn]['camp'] = $r['camp'];
	if($r['group_type']=='กลุ่มโรค'){
		if($r['newcase']=='new'){
			$caseType = "รายใหม่";
		} else {
			$caseType = "รายเก่า";
		}
		$each_summary[$hn]['disease'][] = array(
			'name' => $r['disease_name'],
			'type' => $caseType
		);
	} elseif($r['group_type']=='กลุ่มเสี่ยง'){
		if($r['newcase']=='risk-new'){
			$caseType = "กลุ่มเสี่ยงใหม่";
		} else {
			$caseType = "กลุ่มเสี่ยงเก่า";
		}
		$each_summary[$hn]['risk'][] = array(
			'name' => $r['disease_name'],
			'type' => $caseType
		);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Dashboard สุขภาพกำลังพล <?=$yearcheck?></title>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<style>
body{font-family:Tahoma,Arial,sans-serif;background:#f5f7fb;margin:0;padding:20px;color:#222}
h1{color:#17324b;text-align:center;margin-bottom:20px}
.dashboard{display:flex;flex-wrap:wrap;gap:20px;justify-content:center}
.card{background:#fff;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,0.06);padding:20px;flex:1;min-width:300px;max-width:600px}
.card h2{margin-top:0;color:#1767b3;font-size:18px;text-align:center}
table{border-collapse:collapse;width:100%;margin-top:10px}
th,td{border:1px solid #ddd;padding:6px;text-align:left;font-size:13px}
th {
    cursor: pointer;
    background: #f5f5f5;
    padding: 8px;
}
.arrow {
    font-size: 12px;
    margin-left: 5px;
    color: #666;
}
</style>

<script type="text/javascript">
// โหลด Google Charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawCharts);

function drawCharts() {
    // Pie Chart - กลุ่ม/ประเภท
    // Pie - กลุ่มโรค
    var dataDisease = google.visualization.arrayToDataTable([
        ['ประเภท','จำนวน'],
        <?php
        foreach($pie_disease as $r){
            echo "['".$r['newcase']."',".$r['total']."],";
        }
        ?>
    ]);
    var optionsDisease = {
        title:'สัดส่วนผู้ป่วย (กลุ่มโรค)',
        pieHole:0.4,
        colors:['#1767b3','#f39c12']
    };
    var chartDisease = new google.visualization.PieChart(document.getElementById('pie_disease'));
    chartDisease.draw(dataDisease, optionsDisease);

    // Pie - กลุ่มเสี่ยง
    var dataRisk = google.visualization.arrayToDataTable([
        ['ประเภท','จำนวน'],
        <?php
        foreach($pie_risk as $r){
            echo "['".$r['newcase']."',".$r['total']."],";
        }
        ?>
    ]);
    var optionsRisk = {
        title:'สัดส่วนผู้ป่วย (กลุ่มเสี่ยง)',
        pieHole:0.4,
        colors:['#27ae60','#c0392b']
    };
    var chartRisk = new google.visualization.PieChart(document.getElementById('pie_risk'));
    chartRisk.draw(dataRisk, optionsRisk);

 // Bar Chart - กลุ่มโรค
    var dataBarGroup = google.visualization.arrayToDataTable([
        ['โรค','จำนวน'],
        <?php
        foreach($disease_group as $r){
            echo "['".$r['disease_name']."',".$r['total']."],";
        }
        ?>
    ]);
    var optionsGroup = {
        title:'จำนวนกำลังพลแต่ละโรค (กลุ่มโรค)',
        legend:{position:'none'},
        colors:['#1767b3'],
        hAxis:{title:'จำนวน (ราย)'},
        vAxis:{title:'โรค'}
    };
    var chartGroup = new google.visualization.BarChart(document.getElementById('barchart_group'));
    chartGroup.draw(dataBarGroup, optionsGroup);

    // Bar Chart - กลุ่มเสี่ยง
    var dataBarRisk = google.visualization.arrayToDataTable([
        ['กลุ่มเสี่ยง','จำนวน'],
        <?php
        foreach($disease_risk as $r){
            echo "['".$r['disease_name']."',".$r['total']."],";
        }
        ?>
    ]);
    var optionsRisk = {
        title:'จำนวนกำลังพลแต่ละโรค/กลุ่มเสี่ยง (กลุ่มเสี่ยง)',
        legend:{position:'none'},
        colors:['#27ae60'],
        hAxis:{title:'จำนวน (ราย)'},
        vAxis:{title:'กลุ่มเสี่ยง'}
    };
    var chartRisk = new google.visualization.BarChart(document.getElementById('barchart_risk'));
    chartRisk.draw(dataBarRisk, optionsRisk);
}

</script>

</head>
<body>
<h1>Dashboard:สรุปข้อมูลสุขภาพกำลังพล ปีงบประมาณ <?=$yearcheck?></h1>

<div class="dashboard">
    <div class="card">
        <h2>กลุ่มโรค</h2>
        <div id="pie_disease" style="width:100%;height:300px;"></div>
    </div>
    <div class="card">
        <h2>กลุ่มเสี่ยง</h2>
        <div id="pie_risk" style="width:100%;height:300px;"></div>
    </div>
</div>

<div class="dashboard" style="margin:20px auto;">
    <div class="card">
        <h2>จำนวนกำลังพลแต่ละโรค (กลุ่มโรค)</h2>
        <div id="barchart_group" style="width:100%; height:300px;"></div>
    </div>
    <div class="card">
        <h2>จำนวนกำลังพลแต่ละกลุ่มเสี่ยง</h2>
        <div id="barchart_risk" style="width:100%; height:300px;"></div>
    </div>
</div>


<h1>สรุปข้อมูลกำลังพลกลุ่มเสี่ยง/กลุ่มโรค ปีงบประมาณ <?=$yearcheck?></h1>
<div class="card" style="max-width:1250px;margin:20px auto;">

<!-- ✅ ใส่ DataTables CSS/JS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css"/>
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> <!-- ใช้ jQuery เก่าเพื่อรองรับ PHP <5.4 -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<table id="summaryTable" class="display" style="width:100%">
<thead>
<tr>
    <th width="5%">#</th>
    <th width="10%">HN</th>
    <th width="18%">ชื่อ-สกุล</th>
    <!--<th>อายุ</th>-->
    <th width="18%">สังกัด/หน่วย</th>
    <th>กลุ่มเสี่ยง (สีเหลือง)</th>
    <th>กลุ่มโรค (สีแดง)</th>
</tr>
</thead>
<tbody>
<?php
$no=0;
foreach($each_summary as $hn=>$data){
    $no++;	
    echo "<tr>";
    echo "<td>$no</td>";
	echo "<td>$hn</td>";
    echo "<td>{$data['fullname']}</td>";
	echo "<td>{$data['camp']}</td>";
    
    // กลุ่มเสี่ยง
    echo "<td>";
	if(isset($data['risk'])){
		foreach($data['risk'] as $r){
			echo formatDiseaseName($r['name'], $r['type'], 'กลุ่มเสี่ยง');
		}
	}
    echo "</td>";    
	
	// กลุ่มโรค
    echo "<td>";
	if(isset($data['disease'])){
		foreach($data['disease'] as $d){
			echo formatDiseaseName($d['name'], $d['type'], 'กลุ่มโรค');
		}
	}
    echo "</td>";
    echo "</tr>";
}
?>
</tbody>
</table>
</div>

<script>
$(document).ready(function() {
    $('#summaryTable').DataTable({
        "pageLength": 100,         // แสดง 10 แถวต่อหน้า
        "lengthMenu": [5, 10, 25, 50, 100], // ตัวเลือกจำนวนแถว
        "ordering": true,         // เปิด sorting
        "searching": true,        // เปิดช่องค้นหา
        "language": {
            "lengthMenu": "แสดง _MENU_ รายการต่อหน้า",
            "zeroRecords": "ไม่พบข้อมูล",
            "info": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
            "infoEmpty": "ไม่มีข้อมูล",
            "infoFiltered": "(ค้นหาจากทั้งหมด _MAX_ รายการ)",
            "search": "ค้นหา:",
            "paginate": {
                "first": "หน้าแรก",
                "last": "หน้าสุดท้าย",
                "next": "ถัดไป",
                "previous": "ก่อนหน้า"
            }
        }
    });
});
</script>

</body>
</html>
