<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
  ระบบวิเคราะห์ข้อมูลผลการตรวจสุขภาพประจำปี 2569
  ปรับปรุง: 
   - แก้ปัญหาทุกคนเป็นกลุ่มเสี่ยง
   - แยกการประมวลผล condxofyear_so ก่อน แล้วค่อยตรวจ personnel_disease
   - รองรับอายุ < 35 ตรวจเฉพาะ BMI
*/

// ---------- DB CONFIG ----------
include("connect.inc");
function esc($s){ return htmlspecialchars($s, ENT_QUOTES, 'UTF-8'); }

// ---------- Helper ----------
function in_range($v, $a, $b){
    if(is_null($a) || is_null($b) || trim($a)==='' || trim($b)==='') return false;
    $a = floatval($a); $b = floatval($b);
    if($a <= $b) return ($v >= $a && $v <= $b);
    else return ($v >= $b && $v <= $a);
}

// ---------- Core Function ----------
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

// ---------- Check old/new ----------
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



// ---------- UI ----------
$yearcheck = isset($_GET['yearcheck']) ? $_GET['yearcheck'] : '2569';
$search = isset($_GET['search']) ? $_GET['search'] : '';

$where = "c.yearcheck='".mysql_real_escape_string($yearcheck)."'";
if($search!=''){
    $s = mysql_real_escape_string($search);
    $where .= " AND (r.hn LIKE '%".$s."%' OR r.name LIKE '%".$s."%' OR r.camp LIKE '%".$s."%')";
}

$sql = "SELECT DISTINCT r.hn, CONCAT(r.yot, r.name,' ',r.surname) AS fullname, r.camp,c.congenital_disease,c.age
        FROM condxofyear_so c 
        JOIN register_chkup_soldier r ON c.hn=r.hn 
        WHERE $where 
        GROUP BY c.hn 
        ORDER BY c.age DESC, r.camp ASC 
        LIMIT 500";
$qry=mysql_query($sql);
?>
<!doctype html>
<html lang="th">
<head>
<meta charset="utf-8">
<title>ระบบวิเคราะห์ข้อมูลผลการตรวจสุขภาพประจำปี <?=esc($yearcheck)?></title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@3.4.1/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:linear-gradient(120deg,#f0f7ff,#f7fff0);font-family:'Segoe UI',Tahoma,Arial;padding:20px}
.header-card{background:#fff;padding:20px;border-radius:12px;box-shadow:0 6px 18px rgba(0,0,0,.08);margin-bottom:18px}
.title{font-size:20px;font-weight:700;color:#223}
.subtitle{color:#556}
.table-fixed {
  table-layout: fixed;
  width: 100%;
  word-wrap: break-word;
  white-space: normal;
}
.table-fixed th, .table-fixed td {
  overflow-wrap: break-word;
  word-break: break-word;
  white-space: normal;
  vertical-align: top;
}
.badge-green{background:#28a745}
.badge-yellow{background:#ffd43b;color:#222}
.badge-red{background:#dc3545}
.card-row{background:#fff;padding:14px;border-radius:10px;box-shadow:0 4px 12px rgba(0,0,0,.04);margin-bottom:12px}
</style>
</head>
<body>
<div class="container">
  <div class="header-card">
    <div class="row">
      <div class="col-sm-8">
        <div class="title">ระบบวิเคราะห์ข้อมูลผลการตรวจสุขภาพประจำปี <?=esc($yearcheck)?></div>
        <div class="subtitle">เปรียบเทียบผลตรวจสุขภาพกับประวัติเดิมที่ผ่านมา (personnel_disease)</div>
      </div>
      <div class="col-sm-4 text-right">
        <form class="form-inline" method="get">
          <input type="text" name="yearcheck" value="<?=esc($yearcheck)?>" class="form-control input-sm" placeholder="ปีตรวจ">
          <input type="text" name="search" value="<?=esc($search)?>" class="form-control input-sm" placeholder="ค้นหา HN/ชื่อ/สังกัด">
          <button class="btn btn-primary btn-sm">ค้นหา</button>
        </form>
      </div>
    </div>
  </div>

<div class="card-row">
  <div class="table-responsive">
    <table class="table table-striped table-hover table-fixed">
      <thead>
        <tr>
          <th>HN</th>
          <th>ชื่อ - สกุล</th>
          <th>อายุ</th>
          <th>สังกัด</th>
          <th>โรคประจำตัว</th>
          <th>กลุ่มปกติ</th>
          <th>กลุ่มเสี่ยง</th>
          <th>กลุ่มโรค</th>
        </tr>
      </thead>
          <tbody>
<?php
if($qry && mysql_num_rows($qry)>0){
  while($row=mysql_fetch_assoc($qry)){
    $hn=$row['hn'];
    $fullname=$row['fullname'];
    $age=$row['age'];
    $camp=$row['camp'];
    $disease_history=$row['congenital_disease'];

    $analysis=checkHealthStatus($hn,$yearcheck);
    $normal_list=array(); $risk_display=array(); $disease_display=array();

    foreach($analysis['details'] as $info){
        $txt=esc($info['label'])." (".esc($info['value']).")";
        if($info['status']=='normal'){
            $normal_list[]=$txt;
			//$normal_list[]='';
        } elseif($info['status']=='risk'){
            if($info['disease_label']!=''){
                $state=detect_old_or_new($hn,$info['disease_label'],$yearcheck,'กลุ่มเสี่ยง');
                //$risk_display[]=esc($info['disease_label'])." <small>($state)</small> — ".$txt;
				$risk_display[]=$txt." <small>($state)</small>";
				
            } else $risk_display[]=$txt;
        } elseif($info['status']=='disease'){
            if($info['disease_label']!=''){
                $state=detect_old_or_new($hn,$info['disease_label'],$yearcheck,'กลุ่มโรค');
                $disease_display[]=esc($info['disease_label'])." <small>($state)</small> — ".$txt;
            } else $disease_display[]=$txt;
        }
    }
	
$overall = $analysis['overall']; // ตอนนี้เป็น array แล้ว
	/*echo "<pre>";
	echo $overall;
	echo "</pre>";*/
$badge = '';

if(in_array('normal',$overall) && count($overall)==1){
    $badge .= '<span class="badge badge-green">ปกติ</span>';
}
if(in_array('risk',$overall)){
    $badge .= ' <span class="badge badge-yellow">เสี่ยง</span>';
}
if(in_array('disease',$overall)){
    $badge .= ' <span class="badge badge-red">โรค</span>';
}	

    echo "<tr>";
    echo "<td>".esc($hn)."</td>";
    echo "<td>".esc($fullname)."<br><small>$badge</small></td>";
    echo "<td>".esc($age)."</td>";
    echo "<td>".esc($camp)."</td>";
    echo "<td>".esc($disease_history)."</td>";
    echo "<td>".(count($normal_list)?implode('<br>',$normal_list):'-')."</td>";
    echo "<td>".(count($risk_display)?implode('<br>',$risk_display):'-')."</td>";
    echo "<td>".(count($disease_display)?implode('<br>',$disease_display):'-')."</td>";
    echo "</tr>";
  }
} else {
  echo "<tr><td colspan='8' class='text-center'>ไม่พบข้อมูลสำหรับปี ".esc($yearcheck)."</td></tr>";
}
?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</body>
</html>
