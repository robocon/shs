<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// ---------- DB CONFIG ----------
include("connect.inc");
function esc($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// include checkHealthStatus() และ detect_old_or_new() จากโค้ดเดิม (ที่คุณทำไว้ด้านบน)
function in_range($val,$min,$max){
    if($min==='' && $max==='') return false;
    if($min!=='' && $val < $min) return false;
    if($max!=='' && $val > $max) return false;
    return true;
}

// ===== ฟังก์ชันตรวจสุขภาพ =====
function checkHealthStatus($hn, $yearcheck){
    //$res = array('overall'=>'normal','details'=>array());
	$res = array('overall'=>array(),'details'=>array());
	$status_seen = array();
    $hn_e = mysql_real_escape_string($hn);
    $y_e = mysql_real_escape_string($yearcheck);

    $sql = "SELECT row_id, age, bmi, bp1, bp2, bs, chol, tg, sgot, sgpt, bun, cr, uric
            FROM condxofyear_so
            WHERE hn='{$hn_e}' AND yearcheck='{$y_e}'
            ORDER BY row_id DESC LIMIT 1";
    $qry = mysql_query($sql);
    if(!$qry || mysql_num_rows($qry)==0) return $res;
    $row = mysql_fetch_assoc($qry);
    if(!$row || !is_array($row)) return $res;

    $age = intval(isset($row['age']) ? $row['age'] : 0);

    // โหลดเกณฑ์
    $crit = array();
    $q = "SELECT lab_code, name_en, normal_min, normal_max, risk_min, risk_max, disease_min, disease_max, IFNULL(name_th,'') AS disease_name
          FROM health_criteria";
    $rq = mysql_query($q);
    while($r = mysql_fetch_assoc($rq)){
        $key = strtolower(trim($r['lab_code']));
        $crit[$key] = $r;
    }

    // mapping field -> lab_code
    $field_to_labcode = array(
        'bmi'=>'bmi',
		'bp1'=>'sbp',
		'bp2'=>'dbp',
        'bs'=>'fbs',
        'chol'=>'chol',
        'tg'=>'tg',
        'sgot'=>'ast',
        'sgpt'=>'alt',
        'bun'=>'bun',
        'cr'=>'cr',
        'uric'=>'uric'
    );
    $severity_rank = array('normal'=>0,'risk'=>1,'disease'=>2);
    $maxsev = 0;

    foreach($row as $field=>$value){
        $f = strtolower($field);
        if(in_array($f, array('hn','yearcheck','row_id','age'))) continue;
        if($age < 35 && $f != 'bmi') continue;
        if(!isset($value) || trim($value)==='') continue;

        $val = floatval($value);
        $lab_code = isset($field_to_labcode[$f]) ? strtolower($field_to_labcode[$f]) : $f;
	/*echo "<pre>";
	echo $lab_code;
	echo "</pre>";*/
		if(isset($crit[$lab_code])){
            $c = $crit[$lab_code];
            $label = $c['name_en']!='' ? $c['name_en'] : $lab_code;
            $disease_label = $c['disease_name'];

            if(in_range($val,$c['normal_min'],$c['normal_max'])) $status='normal';
            elseif(in_range($val,$c['risk_min'],$c['risk_max'])) $status='risk';
            elseif(in_range($val,$c['disease_min'],$c['disease_max'])) $status='disease';
            else $status='risk';
        } else {
            $status='normal';
            $label=$lab_code;
            $disease_label='';
        }

        if(!in_array($status,$status_seen)){
            $status_seen[] = $status;
        }

        $res['details'][$f] = array(
            'value'=>$val,
            'status'=>$status,
            'lab_code'=>$lab_code,
            'label'=>$label,
            'disease_label'=>$disease_label
        );
    }
    $res['overall'] = $status_seen;
    return $res;
}

// ===== ฟังก์ชันใหม่/เก่า =====
function detect_old_or_new($hn,$disease_label,$yearcheck,$current_group_type){
    $hn_e = mysql_real_escape_string($hn);
    $y_e = mysql_real_escape_string($yearcheck);
    $current_group_type_e = mysql_real_escape_string($current_group_type);
	//echo $current_group_type_e;
    // === Mapping label → keyword ที่ควร match เพิ่มเติม ===
    $map_keywords = array(
        "น้ำตาลในเลือด (FBS)" => array("น้ำตาลในเลือดผิดปกติ","เบาหวาน"),
        "คอเลสเตอรอลรวม" => array("ไขมันในเลือดผิดปกติ","ไขมันในเลือด"),
        "ไตรกลีเซอไรด์" => array("ไขมันในเลือดผิดปกติ","ไขมันในเลือด"),
        "ความดันโลหิตค่าบน" => array("ความดันโลหิตผิดปกติ","ความดันโลหิต"),
        "ความดันโลหิตค่าล่าง" => array("ความดันโลหิตผิดปกติ","ความดันโลหิต"),
        "การทำงานของตับ (AST)" => array("ค่าการทำงานตับผิดปกติ"),
        "การทำงานของตับ (ALT)" => array("ค่าการทำงานตับผิดปกติ"),
        "ไนโตรเจนในเลือด (BUN)" => array("ค่าการทำงานไตผิดปกติ"),        
        "ครีเอตินินในเลือด" => array("ค่าการทำงานไตผิดปกติ"),
        "กรดยูริกในเลือด" => array("กรดยูริกผิดปกติ"),
        "ดัชนีมวลกาย" => array("ภาวะอ้วน (BMI เกิน)"),
    );

    $conditions = array("disease_name='".mysql_real_escape_string($disease_label)."'");

    if(isset($map_keywords[$disease_label])){
        foreach($map_keywords[$disease_label] as $kw){
            $conditions[] = "disease_name='".mysql_real_escape_string($kw)."'";
        }
    }

    $where_disease = "(".implode(" OR ", $conditions).")";

    $q = "SELECT group_type 
          FROM personnel_disease 
          WHERE hn='{$hn_e}' 
            AND {$where_disease}
            AND yearcheck<'{$y_e}'
          ORDER BY yearcheck DESC 
          LIMIT 1";

    // echo "<pre>".$q."</pre>"; // Debug query

    $rq = mysql_query($q);
    if($rq && mysql_num_rows($rq)>0){
        $old = mysql_fetch_assoc($rq);
        if($old['group_type']=='กลุ่มเสี่ยง'){
            return "กลุ่มเสี่ยงเก่า";
        } elseif($old['group_type']=='กลุ่มโรค'){
            return "กลุ่มโรคเก่า";
        }
    }

    // ถ้าไม่เจอข้อมูลเก่า → ให้ return ตาม group_type ปัจจุบัน
    if($current_group_type_e=='กลุ่มเสี่ยง'){
        return "กลุ่มเสี่ยงใหม่";
    } elseif($current_group_type_e=='กลุ่มโรค'){
        return "กลุ่มโรคใหม่";
    }

    return "ปกติ"; // ถ้าเป็น normal
}


// ================== เก็บข้อมูลสถิติ ==================
$yearcheck = isset($_GET['yearcheck']) ? $_GET['yearcheck'] : '2569';

$sql = "SELECT DISTINCT r.hn, CONCAT(r.yot, r.name,' ',r.surname) AS fullname, 
               r.camp, c.age
        FROM condxofyear_so c 
        JOIN register_chkup_soldier r ON c.hn=r.hn 
        WHERE c.yearcheck='".mysql_real_escape_string($yearcheck)."'
		AND r.active='y'
        GROUP BY c.hn";
$qry = mysql_query($sql);

$summary = array('normal'=>0,'risk'=>0,'disease'=>0);
$by_camp = array();
$new_old = array(
    'risk_new'=>0,'risk_old'=>0,
    'disease_new'=>0,'disease_old'=>0
);

if($qry && mysql_num_rows($qry)>0){
    while($row=mysql_fetch_assoc($qry)){
        $hn=$row['hn'];
        $camp=$row['camp'];

        $analysis = checkHealthStatus($hn,$yearcheck);

        // overall status
        $overall = $analysis['overall']; // array
        if(in_array('normal',$overall)) $summary['normal']++;
        if(in_array('risk',$overall))   $summary['risk']++;
        if(in_array('disease',$overall))$summary['disease']++;

        if(!isset($by_camp[$camp])) $by_camp[$camp] = array('normal'=>0,'risk'=>0,'disease'=>0);

        if(in_array('normal',$overall)) $by_camp[$camp]['normal']++;
        if(in_array('risk',$overall))   $by_camp[$camp]['risk']++;
        if(in_array('disease',$overall))$by_camp[$camp]['disease']++;

        // ตรวจแยกใหม่/เก่า จาก details
        foreach($analysis['details'] as $info){
            if($info['status']=='risk' && $info['disease_label']!=''){
                $state = detect_old_or_new($hn,$info['disease_label'],$yearcheck,'กลุ่มเสี่ยง');
                if(strpos($state,'ใหม่')!==false) $new_old['risk_new']++;
                if(strpos($state,'เก่า')!==false) $new_old['risk_old']++;
            }
            if($info['status']=='disease' && $info['disease_label']!=''){
                $state = detect_old_or_new($hn,$info['disease_label'],$yearcheck,'กลุ่มโรค');
                if(strpos($state,'ใหม่')!==false) $new_old['disease_new']++;
                if(strpos($state,'เก่า')!==false) $new_old['disease_old']++;
            }
        }
    }
}
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>Dashboard ผลการตรวจสุขภาพ <?=esc($yearcheck)?></title>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{font-family:sans-serif;background:#f9f9f9;padding:20px}
.card{background:#fff;border-radius:10px;box-shadow:0 4px 10px rgba(0,0,0,.05);margin:15px;padding:20px}
h2{font-size:18px;margin-bottom:10px}
</style>
</head>
<body>

<h1 align="center">Dashboard การวิเคราะห์สุขภาพกำลังทหารที่เข้ารับการตรวจสุขภาพประจำปี <?=esc($yearcheck)?></h1>

<div class="card">
  <h2>ภาพรวมจำนวนกลุ่ม</h2>
	<div style="display:flex; justify-content:center; align-items:center; height:400px;">
	  <canvas id="chart_overall" width="350" height="350"></canvas>
	</div>
</div>

<div class="card">
  <h2>แยกตามสังกัด</h2>
  <canvas id="chart_camp" height="150"></canvas>
</div>

<div class="card">
  <h2>กลุ่มใหม่/เก่า</h2>
  <canvas id="chart_newold" height="120"></canvas>
</div>
<!-- รวม plugin ChartDataLabels -->
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>

<script>
const ctxOverall = document.getElementById('chart_overall').getContext('2d');
new Chart(ctxOverall, {
  type: 'pie',
  data: {
    labels: ['ปกติ', 'เสี่ยง', 'โรค'],
    datasets: [{
      data: [<?=$summary['normal']?>, <?=$summary['risk']?>, <?=$summary['disease']?>],
      backgroundColor: ['#28a745', '#ffc107', '#dc3545'],
      borderColor: '#fff', // เส้นขอบขาวแบ่งส่วน
      borderWidth: 2,
      hoverOffset: 20, // ทำให้เวลาชี้ มีการ pop-up
      shadowOffsetX: 0, // ทำเงา
      shadowOffsetY: 5,
      shadowBlur: 10,
      shadowColor: 'rgba(0,0,0,0.3)'
    }]
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    plugins: {
      legend: {
        position: 'top',      // legend อยู่ด้านบน
        align: 'center',            // จัดกึ่งกลางตามแกน y ของ chart
        labels: {
          font: {
            size: 18,
            weight: 'bold'
          },
          usePointStyle: true,
          padding: 20
        }
      },	  
      tooltip: {
        enabled: true,
        callbacks: {
          label: function(context) {
            let label = context.label || '';
            let value = context.raw || 0;
            return label + ': ' + value + ' ราย';
          }
        }
      },
      datalabels: { // แสดงตัวเลขบน Pie
        color: '#fff',
        font: {
          weight: 'bold',
          size: 12
        },
        formatter: function(value, context) {
          return value;
        }
      }
    }
  },
  plugins: [ChartDataLabels] // ต้องใส่ plugin เพื่อใช้งาน datalabels
});


// ----- by camp -----
var ctxCamp = document.getElementById('chart_camp').getContext('2d');

// สร้าง labels
var labels = [
<?php
foreach(array_keys($by_camp) as $label){
    echo "'".$label."',";
}
?>
];

// สร้าง datasets
var normalData = [
<?php
foreach($by_camp as $row){
    echo $row['normal'].",";
}
?>
];

var riskData = [
<?php
foreach($by_camp as $row){
    echo $row['risk'].",";
}
?>
];

var diseaseData = [
<?php
foreach($by_camp as $row){
    echo $row['disease'].",";
}
?>
];

var chartCamp = new Chart(ctxCamp, {
    type: 'bar',
    data: {
        labels: labels,
        datasets: [
            { label: 'ปกติ', data: normalData, backgroundColor: '#28a745' },
            { label: 'เสี่ยง', data: riskData, backgroundColor: '#ffc107' },
            { label: 'โรค', data: diseaseData, backgroundColor: '#dc3545' }
        ]
    },
    options: {
        responsive: true,
        legend: { position: 'bottom' },
        scales: {
            yAxes: [{ ticks: { beginAtZero: true } }]
        }
    }
});




// ----- new/old -----
const ctxNewOld = document.getElementById('chart_newold');
new Chart(ctxNewOld,{
  type:'bar',
  data:{
    labels:['เสี่ยงใหม่','เสี่ยงเก่า','โรคใหม่','โรคเก่า'],
    datasets:[{
      data:[<?=$new_old['risk_new']?>,<?=$new_old['risk_old']?>,<?=$new_old['disease_new']?>,<?=$new_old['disease_old']?>],
      backgroundColor:['#ffcd56','#f0ad4e','#ff6384','#c82333']
    }]
  }
});
</script>
</body>
</html>
