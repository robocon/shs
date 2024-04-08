<?php
include 'bootstrap.php';

$db = Mysql::load();
// $db->select("SET NAMES UTF8");

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date'); // date_chk ในตาราง chk_doctor

function conv($string) {
    return iconv('UTF-8', 'TIS-620', $string);
}

function iconv620ToUTF8($t){
    return iconv('TIS-620', 'UTF-8', $t);
}

# กรณีที่ตรวจเป็นกลุ่มบริษัท

# 2562-06-24 คุยกับแผนกตรวจสุขภาพแล้ว ไม่เอาชื่อ-สกุลจากทะเบียนเพราะทำงานล่าช้า
# ให้ดึงข้อมูลจากของตรวจสุขภาพเลย
$sql_opcard = "SELECT `name`,`surname`  FROM `opcardchk` WHERE `HN` = '$hn' ORDER BY `row` DESC LIMIT 1;";
$db->select($sql_opcard);
$opcardchk_row = $db->get_rows();
$regis_user = $db->get_item();

# ข้อมูลผู้ป่วย
$sql = "SELECT a.*, b.`yot` AS `prefix` ,b.`ptffone`, b.`phone`
FROM `chk_doctor` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`hn` = '$hn' 
AND a.`vn` = '$vn' 
AND a.`date_chk` LIKE '$date%' ";
$db->select($sql);
$user = $db->get_item();

// ตรวจเป็นกลุ่มจะดึงข้อมูลจากที่น้องนัทเอาเข้าระบบ
if( $opcardchk_row > 0 ){ 

    // เอา prefix ใน dbทะเบียนมาแทนที่ออกไป
    $user['name'] = str_replace($user['prefix'],'',$regis_user['name']);
    $user['surname'] = $regis_user['surname'];
}

$dxofyear_out_id = $user['dxofyear_out_id'];

$year_checkup = $user['yearchk'];

$sql = "SELECT `weight`,`height`,`bmi`,`bp1`,`bp2`,`bp21`,`bp22`,`pause`,`camp`,`labin_date` 
FROM `dxofyear_out` WHERE `thdatehn` = '$date$hn' ";
$db->select($sql);

$camp = '';
$nurse = '';

if($db->get_rows() > 0){
    $dxofyear = $db->get_item();
    $camp = $dxofyear['camp'];
    $bp1 = $dxofyear['bp1'];
    $bp2 = $dxofyear['bp2'];

    $weight = $dxofyear['weight'];
    $height = $dxofyear['height'];
    $bmi = $dxofyear['bmi'];
    $pause = $dxofyear['pause'];

    if( !empty($odxofyearpd['bp21']) ){
        $bp1 = $dxofyear['bp21'];
    }

    if( !empty($dxofyear['bp22']) ){
        $bp2 = $dxofyear['bp22'];
    }

    if(empty($bmi)){
        $ht = $height/100;
        $bmi=number_format($weight /($ht*$ht),2);
    }

    $nurse = "สัญญาณชีพ ชีพจร(p):$pause ครั้ง/นาที ความดันโลหิต: $bp1/$bp2 น้ำหนัก: $weight กก. ส่วนสูง: $height ซม. BMI: $bmi";
}else if( !empty($dxofyear_out_id) ){ // ถ้าหาไม่เจอให้เอา dxofyear_out_id มาหาแทน


    $sql = "SELECT `weight`,`height`,`bmi`,`bp1`,`bp2`,`bp21`,`bp22`,`pause`,`camp`,`labin_date` 
    FROM `dxofyear_out` WHERE `row_id` = '$dxofyear_out_id' ";
    $db->select($sql);
    $dxofyear = $db->get_item();

    $camp = $dxofyear['camp'];
    $bp1 = $dxofyear['bp1'];
    $bp2 = $dxofyear['bp2'];

    $weight = $dxofyear['weight'];
    $height = $dxofyear['height'];
    $bmi = $dxofyear['bmi'];
    $pause = $dxofyear['pause'];

    if( !empty($odxofyearpd['bp21']) ){
        $bp1 = $dxofyear['bp21'];
    }

    if( !empty($dxofyear['bp22']) ){
        $bp2 = $dxofyear['bp22'];
    }
    if(empty($bmi)){
        $ht = $height/100;
        $bmi=number_format($weight /($ht*$ht),2);
    }

    $nurse = "สัญญาณชีพ ชีพจร(p):$pause ครั้ง/นาที ความดันโลหิต: $bp1/$bp2 น้ำหนัก: $weight กก. ส่วนสูง: $height ซม. BMI: $bmi";
}

$infoText = "ตรวจสุขภาพประจำปี$year_checkup";
$clinicalinfo = iconv620ToUTF8($infoText);

// ดึงวันที่ที่ตรวจ lab นับเป็นวันที่ได้รับการเข้ารับบริการ
$sql = "SELECT SUBSTRING(`orderdate`,1,10) AS `lab_opd`  
FROM `resulthead` 
WHERE `hn` = '$hn' 
AND `clinicalinfo` = '$clinicalinfo' 
ORDER BY `autonumber` DESC 
LIMIT 1 ";

$db->select($sql);
$res_head = $db->get_item();

$lab_opd = $res_head['lab_opd'];

# CBC 
$sql = "SELECT b.`labcode`,b.`labname`,b.`result`,b.`normalrange`,b.`flag`  
FROM ( 

    SELECT MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND `profilecode` = 'CBC'
    AND `clinicalinfo` = '$clinicalinfo' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( b.`labcode` = 'HB' OR b.`labcode` = 'HCT' OR b.`labcode` = 'WBC' 
OR b.`labcode` = 'NEU' OR b.`labcode` = 'LYMP' OR b.`labcode` = 'MONO' 
OR b.`labcode` = 'EOS' OR b.`labcode` = 'BASO' OR b.`labcode` = 'PLTC' 
OR b.`labcode` = 'RBC' OR b.`labcode` = 'RBCMOR' OR b.`labcode` = 'MCV') 
ORDER BY b.seq ASC";
// dump($sql);
$db->select($sql);
$cbc_items = $db->get_items();

$cbc_lists = array();
foreach ($cbc_items as $key => $item) {
    $labcode = strtolower($item['labcode']);
    $cbc_lists[$labcode] = array(
        'result' => $item['result'], 
        'normalrange' => $item['normalrange'],
        'flag' => $item['flag']
    );
}


# UA 
$sql = "SELECT b.* 
FROM ( 

    SELECT MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND `profilecode` = 'UA'
    AND `clinicalinfo` = '$clinicalinfo' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( b.`labcode` = 'SPGR' OR b.`labcode` = 'PHU' OR b.`labcode` = 'GLUU' 
OR b.`labcode` = 'PROU' OR b.`labcode` = 'COLOR' OR b.`labcode` = 'APPEAR' 
OR b.`labcode` = 'RBCU' OR b.`labcode` = 'WBCU' OR b.`labcode` = 'EPIU' 
OR b.`labcode` = 'BLOODU' OR b.`labcode` = 'KETU' ) 
ORDER BY b.seq ASC";
$db->select($sql);
$ua_items = $db->get_items();

$ua_lists = array();
foreach ($ua_items as $key => $item) {
    $labcode = strtolower($item['labcode']);
    $ua_lists[$labcode] = array(
        'result' => $item['result'], 
        'normalrange' => $item['normalrange'],
        'flag' => $item['flag']
    );
}

$sql = "SELECT b.* 
FROM ( 

    SELECT MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' )
    AND `clinicalinfo` = '$clinicalinfo' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( 
    b.`labcode` = 'GLU' 
    OR b.`labcode` = 'CREA' 
    OR b.`labcode` = 'GFR' 
    OR b.`labcode` = 'CHOL' 
    OR b.`labcode` = 'HDL' 
    OR b.`labcode` = 'HBSAG' 
    OR b.`labcode` = 'OCCULT' 
    OR b.`labcode` = '38302' 
    OR b.`labcode` = 'STOCC' 
) 
ORDER BY b.seq ASC ";

$db->select($sql);
$etc_items = $db->get_items();

$etc_lists = array();
foreach ($etc_items as $key => $item) {
    $labcode = strtolower($item['labcode']);
    $etc_lists[$labcode] = array(
        'result' => $item['result'], 
        'normalrange' => $item['normalrange'],
        'flag' => $item['flag']
    );
}

include 'fpdf_thai/shspdf.php';

/**
 * x1,y1           x2,y2
 *   |               |
 *   |               |
 *   x...............x
 */
function print_dashed($x1, $y1, $x2, $y2){
    global $pdf;

    $pdf->SetLineWidth(0.1);
    $pdf->SetDash(0.3, 0.7);
    $pdf->Line($x1, $y1, $x2, $y2);

    $pdf->SetLineWidth(0.2);
    $pdf->SetDash();
}

function call_alert_result($x, $y, $w, $h){
    global $pdf;
    $pdf->SetFont('AngsanaNew','B',15);
    $pdf->SetFillColor(174,174,174); // เซ็ตค่าสีก่อน
    $pdf->Rect($x, $y, $w, $h, 'F'); //สร้างกรอบขึ้นมาแบบ fill สีลงไป
}

$pdf = new SHSPdf();
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);

$pdf->AddPage('P', 'A4');



$pdf->SetFont('AngsanaNew','',16); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetXY(0, 25);
$pdf->Cell(210, 6, 'ใบรายงานผลตรวจสุขภาพ', 0, 1, 'C');

$pdf->SetXY(5, 37);
$pdf->Cell(200, 6, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1);


$pdf->SetFont('AngsanaNew','',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้

# หัวข้อ
$pdf->Rect(5, 43, 54, 6);
$pdf->SetXY(5, 43);
$pdf->Cell(51, 6, 'หน่วยงาน', 0, 1);

$pdf->SetXY(20, 43);
$pdf->Cell(20, 6, conv($camp), 0, 1);

$pdf->Rect(59, 43, 22, 6);
$pdf->SetXY(59, 43);
$pdf->Cell(22, 6, 'HN '.$user['hn'], 0, 1);

$pdf->Rect(81, 43, 34, 6);
$pdf->SetXY(81, 43);
$pdf->Cell(34, 6, 'เลขรับแจ้ง', 0, 1);

$pdf->Rect(115, 43, 50, 6);
$pdf->SetXY(115, 43);
$pdf->Cell(50, 6, 'เลขบัตรประชาชน '.$user['idcard'], 0, 1);

$pdf->Rect(165, 43, 40, 6);
$pdf->SetXY(165, 43);
$pdf->Cell(40, 6, 'วันที่เข้ารับบริการ '.$lab_opd, 0, 1);

# ข้อมูลส่วนตัว
$pdf->SetXY(5, 49);
$pdf->Cell(37, 6, 'ชื่อ-นามสกุล / Name', 0, 1);

$pdf->Rect(42, 51, 3, 3); // checkbox
if( conv($user['prefix']) == 'นาย' ){
    $pdf->Line(42,54,45,51);
}
$pdf->SetXY(45, 49);
$pdf->Cell(5, 6, 'นาย', 0, 1);

$pdf->Rect(52, 51, 3, 3);
if( conv($user['prefix']) == 'นาง' ){
    $pdf->Line(52,54,55,51);
}
$pdf->SetXY(55, 49);
$pdf->Cell(5, 6, 'นาง', 0, 1);

$pdf->Rect(62, 51, 3, 3);
if( conv($user['prefix']) == 'น.ส.' OR conv($user['prefix']) == 'นางสาว' ){
    $pdf->Line(62,54,65,51);
}
$pdf->SetXY(65, 49);
$pdf->Cell(5, 6, 'น.ส.', 0, 1);

$pdf->SetXY(73, 49);
$pdf->Cell(5, 6, 'ชื่อ', 0, 1);
print_dashed(78,54,103,54);

$pdf->SetXY(78, 49);
$pdf->Cell(5, 6, conv($user['name']), 0, 1);

$pdf->SetXY(103, 49);
$pdf->Cell(5, 6, 'นามสกุล', 0, 1);
print_dashed(116,54,140,54);

$pdf->SetXY(115, 49);
$pdf->Cell(5, 6, conv($user['surname']), 0, 1);

$pdf->Rect(148, 49, 57, 12);
$pdf->SetXY(148, 49);
$pdf->Cell(57, 6, 'โทรศัพท์ / Tel.', 1, 1);

// เบอร์ติดต่อผู้ป่วย
$pdf->SetXY(170, 49);
$pdf->Cell(26, 6, $user['phone'], 0, 1);
// เบอร์โทรญาติ
if ( !empty($user['ptffone']) ) {
    $pdf->SetXY(170, 55);
    $pdf->Cell(26, 6, $user['ptffone'], 0, 1);
}

$pdf->SetXY(5, 55);
$pdf->Cell(27, 6, 'ที่อยู่ / Address', 0, 1);
print_dashed(25,60,140,60);
$pdf->SetXY(31, 55);
$pdf->Cell(40, 6, conv($user['address']), 0, 1);

// รายระเอียดสัญญาณชีพ
$pdf->SetXY(5, 61);
$pdf->Cell(200, 6, $nurse, 0, 1);
// print_dashed(25,65.50,140,65.50);


$pdf->Line(5, 67, 205, 67);
$pdf->SetFont('AngsanaNew','',16); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetXY(5, 67);
$pdf->Cell(200, 6, 'ข้อมูลสุขภาพ (Health data)', 0, 1, 'C');


$pdf->SetFont('AngsanaNew','',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้

### หัวข้อ
$pdf->Rect(5, 73, 54, 12);
$pdf->SetXY(5, 73);
$pdf->Cell(46, 6, 'ความสมบูรณ์ของเม็ดเลือด CBC', 0, 1);
$pdf->SetXY(5, 79);
$pdf->Cell(46, 6, 'COMPLETE BLOOD COUNT', 0, 1);

$pdf->Rect(59, 73, 22, 12);
$pdf->SetXY(59, 73);
$pdf->Cell(22, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
$pdf->SetXY(59, 79);
$pdf->Cell(22, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(81, 73, 26, 12);
$pdf->SetXY(81, 73);
$pdf->Cell(26, 6, 'ค่าปกติ', 0, 1, 'C');
$pdf->SetXY(81, 79);
$pdf->Cell(26, 6, 'NORMAL', 0, 1, 'C');

// // Header ช่องขวา
// $pdf->Rect(107, 73, 51, 12);
// $pdf->SetXY(107, 73);
// $pdf->Cell(51, 6, 'การตรวจสารเคมีในเลือด', 0, 1);
// $pdf->SetXY(107, 79);
// $pdf->Cell(51, 6, 'BIOCHEMICAL TESTS', 0, 1);

// $pdf->Rect(158, 73, 22, 12);
// $pdf->SetXY(158, 73);
// $pdf->Cell(22, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
// $pdf->SetXY(158, 79);
// $pdf->Cell(22, 6, 'RESULT', 0, 1, 'C');

// $pdf->Rect(180, 73, 25, 12);
// $pdf->SetXY(180, 73);
// $pdf->Cell(25, 6, 'ค่าปกติ', 0, 1, 'C');
// $pdf->SetXY(180, 79);
// $pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');

### 1

// >>> ภาวะโลหิตจาง
// $cbc_lists['hb']['flag'] = 'H';
// $cbc_lists['hb']['result'] = '999';
// $cbc_lists['hb']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 85);
$pdf->Cell(34, 6, 'ภาวะโลหิตจาง', 0, 1);

$pdf->SetXY(39, 85);
$pdf->Cell(20, 6, 'Hb', 0, 1);
$pdf->Line(39, 91, 59, 91);

$pdf->SetXY(59, 85);
if( !empty($cbc_lists['hb']['flag']) && $cbc_lists['hb']['flag'] != 'N' ){
    call_alert_result(59, 85, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['hb']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 85);
$pdf->Cell(26, 6, $cbc_lists['hb']['normalrange'], 1, 1, 'C');
// <<< ภาวะโลหิตจาง

// >>> Hct
// $cbc_lists['hct']['flag'] = 'H';
// $cbc_lists['hct']['result'] = '999';
// $cbc_lists['hct']['normalrange'] = '99 - 99';

$pdf->SetXY(39, 91);
$pdf->Cell(20, 6, 'Hct', 0, 1);
$pdf->Line(39, 97, 59, 97); // underline
$pdf->SetXY(59, 91);

if( !empty($cbc_lists['hct']['flag']) && $cbc_lists['hct']['flag'] != 'N' ){
    call_alert_result(59, 91, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['hct']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 91);
$pdf->Cell(26, 6, $cbc_lists['hct']['normalrange'], 1, 1, 'C');
// <<< Hct

// >>> จำนวนเม็ดเลือดขาวรวม 
// $cbc_lists['wbc']['flag'] = 'H';
// $cbc_lists['wbc']['result'] = '999';
// $cbc_lists['wbc']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 97);
$pdf->Cell(46, 6, 'จำนวนเม็ดเลือดขาวรวม', 0, 1);
$pdf->SetXY(39, 97);
$pdf->Cell(20, 6, 'WBC', 0, 1);
$pdf->Line(39, 103, 59, 103); // underline
$pdf->SetXY(59, 97);

if( !empty($cbc_lists['wbc']['flag']) && $cbc_lists['wbc']['flag'] != 'N' ){
    call_alert_result(59, 97, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['wbc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 97);
$pdf->Cell(26, 6, $cbc_lists['wbc']['normalrange'], 1, 1, 'C');
// <<< จำนวนเม็ดเลือดขาวรวม

// >>> จำนวนเม็ดเลือดแดง 
// $cbc_lists['mcv']['flag'] = 'H';
// $cbc_lists['mcv']['result'] = '999';
// $cbc_lists['mcv']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 103);
$pdf->Cell(46, 6, 'จำนวนเม็ดเลือดแดง', 0, 1);
$pdf->SetXY(39, 103);
$pdf->Cell(20, 6, 'MCV', 0, 1);
$pdf->Line(39, 109, 59, 109); // underline
$pdf->SetXY(59, 103);

if( !empty($cbc_lists['mcv']['flag']) && $cbc_lists['mcv']['flag'] != 'N' ){
    call_alert_result(59, 103, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['mcv']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 103);
$pdf->Cell(26, 6, $cbc_lists['mcv']['normalrange'], 1, 1, 'C');
// <<< จำนวนเม็ดเลือดแดง

// >>> จำนวนเกล็ดเลือด
// $cbc_lists['pltc']['flag'] = 'H';
// $cbc_lists['pltc']['result'] = '999';
// $cbc_lists['pltc']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 109);
$pdf->Cell(46, 6, 'จำนวนเกล็ดเลือด', 0, 1);
$pdf->SetXY(39, 109);
$pdf->Cell(20, 6, 'Platelets count', 0, 1);
// $pdf->Line(39, 115, 59, 115);
$pdf->SetXY(59, 109);

if( !empty($cbc_lists['pltc']['flag']) && $cbc_lists['pltc']['flag'] != 'N' ){
    call_alert_result(59, 109, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['pltc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 109);
$pdf->Cell(26, 6, $cbc_lists['pltc']['normalrange'], 1, 1, 'C');
// <<< จำนวนเกล็ดเลือด

// >>> สรุปผลตรวจ CBC
$pdf->Rect(5, 115, 54, 18);
$pdf->SetXY(5, 115);
$pdf->Cell(46, 18, 'สรุปผลตรวจ CBC', 0, 1);

$pdf->Rect(59, 115, 22, 12);
$pdf->SetXY(59, 115);
$pdf->Cell(22, 6, 'ผลปกติ', 0, 1, 'C');
$pdf->SetXY(59, 121);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 115, 26, 12);
$pdf->SetXY(81, 115);
$pdf->Cell(26, 6, 'ผลผิดปกติ', 0, 1, 'C');
$pdf->SetXY(81, 121);
$pdf->Cell(26, 6, 'ABNORMAL', 0, 1, 'C');

// $user['res_cbc'] = 1;
$pdf->Rect(59, 127, 22, 6);
if( $user['res_cbc'] == 1 ){
    $pdf->Line(65, 132, 75, 128);
}

// $user['res_cbc'] = 2;
$pdf->Rect(81, 127, 26, 6);
if( $user['res_cbc'] == 2 ){
    $pdf->Line(89, 132, 99, 128);
}
// <<< สรุปผลตรวจ CBC




$pdf->Rect(5, 133, 54, 12);
$pdf->SetXY(5, 133);
$pdf->Cell(46, 6, 'การตรวจปัสสาวะ UA', 0, 1);

$pdf->Rect(59, 133, 22, 12);
$pdf->SetXY(59, 133);
$pdf->Cell(22, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
$pdf->SetXY(59, 139);
$pdf->Cell(22, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(81, 133, 26, 12);
$pdf->SetXY(81, 133);
$pdf->Cell(26, 6, 'ค่าปกติ', 0, 1, 'C');
$pdf->SetXY(81, 139);
$pdf->Cell(26, 6, 'NORMAL', 0, 1, 'C');


// >>> UA Color
// $ua_lists['color']['flag'] = 'H';
// $ua_lists['color']['result'] = '999';
// $ua_lists['color']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 145);
$pdf->Cell(34, 6, 'Color', 0, 1);
$pdf->Line(39, 151, 59, 151);

$pdf->SetXY(59, 145);
if( !empty($ua_lists['color']['flag']) && $ua_lists['color']['flag'] != 'N' ){
    call_alert_result(59, 145, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['color']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 145);
$pdf->Cell(26, 6, $ua_lists['color']['normalrange'], 1, 1, 'C');
// <<< UA Color

// >>> UA Appearance
// $ua_lists['appear']['flag'] = 'H';
// $ua_lists['appear']['result'] = '999';
// $ua_lists['appear']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 151);
$pdf->Cell(34, 6, 'Appearance', 0, 1);
$pdf->Line(39, 157, 59, 157);

$pdf->SetXY(59, 151);
if( !empty($ua_lists['appear']['flag']) && $ua_lists['appear']['flag'] != 'N' ){
    call_alert_result(59, 151, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['appear']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 151);
$pdf->Cell(26, 6, $ua_lists['appear']['normalrange'], 1, 1, 'C');
// <<< UA Appearance

// >>> UA Protein
// $ua_lists['prou']['flag'] = 'H';
// $ua_lists['prou']['result'] = '999';
// $ua_lists['prou']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 157);
$pdf->Cell(34, 6, 'Protein', 0, 1);
$pdf->Line(39, 163, 59, 163);

$pdf->SetXY(59, 157);
if( !empty($ua_lists['prou']['flag']) && $ua_lists['prou']['flag'] != 'N' ){
    call_alert_result(59, 157, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['prou']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 157);
$pdf->Cell(26, 6, $ua_lists['prou']['normalrange'], 1, 1, 'C');
// <<< UA Protein

// >>> UA Glucose
// $ua_lists['gluu']['flag'] = 'H';
// $ua_lists['gluu']['result'] = '999';
// $ua_lists['gluu']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 163);
$pdf->Cell(34, 6, 'Glucose', 0, 1);
$pdf->Line(39, 169, 59, 169);

$pdf->SetXY(59, 163);
if( !empty($ua_lists['gluu']['flag']) && $ua_lists['gluu']['flag'] != 'N' ){
    call_alert_result(59, 163, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['gluu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 163);
$pdf->Cell(26, 6, $ua_lists['gluu']['normalrange'], 1, 1, 'C');
// <<< UA Glucose

// >>> UA RBC
// $ua_lists['rbcu']['flag'] = 'H';
// $ua_lists['rbcu']['result'] = '999';
// $ua_lists['rbcu']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 169);
$pdf->Cell(34, 6, 'RBC', 0, 1);
$pdf->Line(39, 175, 59, 175);

$pdf->SetXY(59, 169);
if( !empty($ua_lists['rbcu']['flag']) && $ua_lists['rbcu']['flag'] != 'N' ){
    call_alert_result(59, 169, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['rbcu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 169);
$pdf->Cell(26, 6, $ua_lists['rbcu']['normalrange'], 1, 1, 'C');
// <<< UA RBC

// >>> UA WBC
// $ua_lists['wbcu']['flag'] = 'H';
// $ua_lists['wbcu']['result'] = '999';
// $ua_lists['wbcu']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 175);
$pdf->Cell(34, 6, 'WBC', 0, 1);
$pdf->Line(39, 181, 59, 181);

$pdf->SetXY(59, 175);
if( !empty($ua_lists['wbcu']['flag']) && $ua_lists['wbcu']['flag'] != 'N' ){
    call_alert_result(59, 175, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['wbcu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 175);
$pdf->Cell(26, 6, $ua_lists['wbcu']['normalrange'], 1, 1, 'C');
// <<< UA WBC

// >>> UA Ketone
// $ua_lists['ketu']['flag'] = 'H';
// $ua_lists['ketu']['result'] = '999';
// $ua_lists['ketu']['normalrange'] = '99 - 99';

$pdf->SetXY(5, 181);
$pdf->Cell(34, 6, 'Ketone', 0, 1);
// $pdf->Line(39, 187, 59, 187);

$pdf->SetXY(59, 181);
if( !empty($ua_lists['ketu']['flag']) && $ua_lists['ketu']['flag'] != 'N' ){
    call_alert_result(59, 181, 22, 6);
}
$pdf->Cell(22, 6, $ua_lists['ketu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 181);
$pdf->Cell(26, 6, $ua_lists['ketu']['normalrange'], 1, 1, 'C');
// <<< UA Ketone

// >>> สรุปผลตรวจ UA
$pdf->Rect(5, 187, 54, 18);
$pdf->SetXY(5, 187);
$pdf->Cell(46, 18, 'สรุปผลตรวจ UA', 0, 1);

$pdf->Rect(59, 187, 22, 12);
$pdf->SetXY(59, 187);
$pdf->Cell(22, 6, 'ผลปกติ', 0, 1, 'C');
$pdf->SetXY(59, 193);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 187, 26, 12);
$pdf->SetXY(81, 187);
$pdf->Cell(26, 6, 'ผลผิดปกติ', 0, 1, 'C');
$pdf->SetXY(81, 193);
$pdf->Cell(26, 6, 'ABNORMAL', 0, 1, 'C');

// $user['res_ua'] = 1;
$pdf->Rect(59, 199, 22, 6);
if( $user['res_ua'] == 1 ){
    $pdf->Line(65, 204, 75, 200);
}

// $user['res_ua'] = 2;
$pdf->Rect(81, 199, 26, 6);
if( $user['res_ua'] == 2 ){
    $pdf->Line(89, 204, 99, 200);
}

// <<< สรุปผลตรวจ UA

// ก่อนถึงช่อง xray
$pdf->Rect(107, 163, 51, 18);
$pdf->SetXY(107, 163);
$pdf->Cell(51, 18, 'Chest X-ray', 0, 1);

$pdf->Rect(158, 163, 22, 12);
$pdf->SetXY(158, 163);
$pdf->Cell(22, 6, 'ผลปกติ', 0, 1, 'C');
$pdf->SetXY(158, 169);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(180, 163, 25, 12);
$pdf->SetXY(180, 163);
$pdf->Cell(25, 6, 'ผลผิดปกติ', 0, 1, 'C');
$pdf->SetXY(180, 169);
$pdf->Cell(25, 6, 'ABNORMAL', 0, 1, 'C');

// $user['cxr'] = 1;
$pdf->Rect(158, 175, 22, 6);
if( $user['cxr'] == 1 ){
    $pdf->Line(164, 180, 174, 176);
}

// $user['cxr'] = 2;
$pdf->Rect(180, 175, 25, 6);
if( $user['cxr'] == 2 ){
    $pdf->Line(186, 180, 196, 176);
}


// Header ช่องขวา
$pdf->Rect(107, 73, 51, 12);
$pdf->SetXY(107, 73);
$pdf->Cell(51, 6, 'การตรวจสารเคมีในเลือด', 0, 1);
$pdf->SetXY(107, 79);
$pdf->Cell(51, 6, 'BIOCHEMICAL TESTS', 0, 1);

$pdf->Rect(158, 73, 22, 12);
$pdf->SetXY(158, 73);
$pdf->Cell(22, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
$pdf->SetXY(158, 79);
$pdf->Cell(22, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(180, 73, 25, 12);
$pdf->SetXY(180, 73);
$pdf->Cell(25, 6, 'ค่าปกติ', 0, 1, 'C');
$pdf->SetXY(180, 79);
$pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');


// $etc_lists['glu']['flag'] = 'H';
// $etc_lists['glu']['result'] = '999';
// $etc_lists['glu']['normalrange'] = '99 - 99';

$pdf->Rect(107, 85, 51, 12);
$pdf->SetXY(107, 85);
$pdf->Cell(41, 6, 'การตรวจระดับน้ำตาลในเลือด FBS', 0, 1);


$pdf->SetXY(158, 85);
if( !empty($etc_lists['glu']['flag']) && $etc_lists['glu']['flag'] != 'N' ){
    call_alert_result(158, 85, 22, 12);
}
$pdf->Rect(158, 85, 22, 12);
$pdf->Cell(22, 6, $etc_lists['glu']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 85, 25, 12);
$pdf->SetXY(180, 85);
$pdf->Cell(25, 6, $etc_lists['glu']['normalrange'], 0, 1, 'C');


# 2
// $etc_lists['crea']['flag'] = 'H';
// $etc_lists['crea']['result'] = '999';
// $etc_lists['crea']['normalrange'] = '99 - 99';

$pdf->Rect(107, 97, 51, 12);
$pdf->SetXY(107, 97);
$pdf->Cell(26, 6, 'การทำงานของไต', 0, 1);
$pdf->SetXY(133, 97);
$pdf->Cell(25, 6, 'Serum Creatinine', 0, 1);
$pdf->Line(133, 103, 158, 103);

$pdf->SetXY(158, 97);
if( !empty($etc_lists['crea']['flag']) && $etc_lists['crea']['flag'] != 'N' ){
    call_alert_result(158, 97, 22, 6);
}
$pdf->Rect(158, 97, 22, 6);
$pdf->Cell(22, 6, $etc_lists['crea']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 97, 25, 6);
$pdf->SetXY(180, 97);
$pdf->Cell(25, 6, $etc_lists['crea']['normalrange'], 0, 1, 'C');


// $etc_lists['gfr']['flag'] = 'H';
// $etc_lists['gfr']['result'] = '36.76';
// $etc_lists['gfr']['normalrange'] = 'Average = 75';

$pdf->SetXY(133, 103);
$pdf->Cell(25, 6, 'eGFR', 0, 1);

$pdf->SetXY(158, 103);
if( !empty($etc_lists['gfr']['flag']) && $etc_lists['gfr']['flag'] != 'N' ){
    call_alert_result(158, 103, 22, 6);
}
$pdf->Rect(158, 103, 22, 6);
$pdf->Cell(22, 6, $etc_lists['gfr']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 103, 25, 6);
$pdf->SetXY(180, 103);
$pdf->Cell(25, 6, $etc_lists['gfr']['normalrange'], 0, 1, 'C');

# 3
// $etc_lists['chol']['flag'] = 'H';
// $etc_lists['chol']['result'] = '999';
// $etc_lists['chol']['normalrange'] = '99 - 99';

$pdf->SetXY(107, 109);
$pdf->Cell(51, 6, 'การตรวจไขมันในเลือด', 0, 1);
$pdf->SetXY(107, 115);
$pdf->Cell(51, 6, 'Total Cholesterol', 0, 1, 'R');
$pdf->Line(128, 121, 158, 121);


$pdf->SetXY(158, 115);
if( !empty($etc_lists['chol']['flag']) && $etc_lists['chol']['flag'] != 'N' ){
    call_alert_result(158, 109, 22, 12);
}
$pdf->Rect(158, 109, 22, 12);
$pdf->Cell(22, 6, $etc_lists['chol']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 109, 25, 12);
$pdf->SetXY(180, 115);
$pdf->Cell(25, 6, $etc_lists['chol']['normalrange'], 0, 1, 'C');

# 4
// $etc_lists['hdl']['flag'] = 'H';
// $etc_lists['hdl']['result'] = '999';
// $etc_lists['hdl']['normalrange'] = '99 - 99';

$pdf->SetXY(107, 121);
$pdf->Cell(51, 6, 'HDL Cholesterol', 0, 1, 'R');

$pdf->SetXY(158, 121);
if( !empty($etc_lists['hdl']['flag']) && $etc_lists['hdl']['flag'] != 'N' ){
    call_alert_result(158, 121, 22, 6);
}
$pdf->Rect(158, 121, 22, 12);
$pdf->Cell(22, 6, $etc_lists['hdl']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 121, 25, 12);
$pdf->SetXY(180, 121);
$pdf->Cell(25, 6, $etc_lists['hdl']['normalrange'], 0, 1, 'C');


// $etc_lists['hbsag']['result'] = 'Positive';
// $etc_lists['hbsag']['normalrange'] = 'negative';
$pdf->Rect(107, 127, 51, 6);
$pdf->SetXY(107, 127);
$pdf->Cell(51, 6, 'ตรวจเชื้อไวรัสตับอักเสบ HBsAg', 0, 1);
$pdf->SetXY(158, 127);

if( !empty($etc_lists['hbsag']['result']) && trim($etc_lists['hbsag']['result']) == 'Positive' ){
    call_alert_result(158, 127, 22, 6);
}
$pdf->Cell(22, 6, $etc_lists['hbsag']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(180, 127);
$pdf->Cell(25, 6, $etc_lists['hbsag']['normalrange'], 1, 1, 'C');

# 5
$pdf->Rect(107, 133, 51, 18);
$pdf->SetXY(107, 133);
$pdf->Cell(41, 6, 'การตรวจเนื้อเยื่อจากปากมดลูก', 0, 1);
$pdf->SetXY(107, 139);
$pdf->Cell(41, 6, 'ด้วยวิธี PAP Smear', 0, 1);

$pdf->Line(128, 145, 158, 145);

$pdf->Rect(158, 133, 22, 12);
$pdf->SetXY(158, 133);
// ทดสอบ fill ค่า pap smear ผลปกติ
// $pdf->Cell(22, 6, '1234', 1, 1);

$pdf->Rect(180, 133, 25, 12);
$pdf->SetXY(180, 133);
// ทดสอบ fill ค่า pap smear ผลผิดปกติ
// $pdf->Cell(25, 6, '1234', 1, 1);

# โลหิตจาง
// $pdf->Rect(5, 145, 54, 66); // กรอบช่องซ้ายเม็ดเลือดขาว

# ช่องขวา
$pdf->SetXY(107, 145);
$pdf->Cell(51, 6, 'ด้วยวิธี Via', 0, 1);
$pdf->Rect(158, 145, 22, 6);
$pdf->Rect(180, 145, 25, 6);
// $pdf->SetXY(158, 145);
// $pdf->Cell(22, 6, '', 0, 1, 'C');
// $pdf->SetXY(180, 145);
// $pdf->Cell(25, 6, '', 0, 1, 'C');



$pdf->Rect(107, 151, 51, 12);
$pdf->SetXY(107, 151);
$pdf->Cell(51, 6, 'การตรวจหาเลือดในอุจจาระ', 0, 1);
$pdf->SetXY(107, 157);
$pdf->Cell(51, 6, 'FIT Test', 0, 1);


$pdf->SetXY(158, 151);
// $etc_lists['occult']['result'] = 'positive';
// $etc_lists['occult']['normalrange'] = 'negative';

$occult_result = ( !empty($etc_lists['occult']['result']) ) ? $etc_lists['occult']['result'] : $etc_lists['stocc']['result'] ;
$occult_result = strtolower($occult_result);

if( !empty($occult_result) && $occult_result == 'positive' ){ 
    call_alert_result(158, 151, 22, 12);
}
$pdf->Rect(158, 151, 22, 12);


$occult_normalrange = ( !empty($etc_lists['occult']['normalrange']) ) ? $etc_lists['occult']['normalrange'] : $etc_lists['stocc']['normalrange'] ;

$pdf->Cell(22, 6, $occult_result, 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->Rect(180, 151, 25, 12);
$pdf->SetXY(180, 151);
$pdf->Cell(25, 6, $occult_normalrange, 0, 1, 'C');

$pdf->SetXY(5, 211);
$pdf->Cell(41, 6, 'สรุปผลตรวจ', 0, 1);

// $user['conclution'] = 1;
$pdf->Rect(54, 212, 3, 3);
$pdf->SetXY(58, 211);
$pdf->Cell(10, 6, 'ปกติ', 0, 1);
if( $user['conclution'] == "1" ){
    $pdf->Line(54,215,57,212);
}

// $user['conclution'] = 2;
$pdf->Rect(70, 212, 3, 3);
$pdf->SetXY(74, 211);
$pdf->Cell(10, 6, 'ผิดปกติ', 0, 1);
if( $user['conclution'] == "2" ){
    $pdf->Line(70,215,73,212);
}

$pdf->SetXY(5, 217);
$pdf->Cell(38, 6, 'คำแนะนำเพิ่มเติมในการดูแลรักษาสุขภาพ', 0, 1);


$conclution = $user['conclution'];
if( $conclution == 1 ){
    $suggest_list = array(
        1 => 'ไม่ได้ให้คำแนะนำ', 
        'แนะนำให้รับการตรวจต่อเนื่อง ครั้งต่อไปในวันที่'
    );

    $suggest = $user['normal_suggest'];
    $suggest_date = ( $user['normal_suggest_date'] != '0000-00-00' ) ? 'ในวันที่ '.$user['normal_suggest_date'] : '' ;
    
}else{
    $suggest_list = array(
        1 => 'ไม่ได้ให้คำแนะนำ', 
        'ให้คำแนะนำในการตรวจติดตาม/ตรวจซ้ำ ครั้งต่อไป', 
        'ให้คำแนะนำเข้ารับการรักษากรณีเจ็บป่วยโดยนัดเข้ารับบริการ', 
        'ให้คำแนะนำเข้ารักการรักษากรณีภาวะแทรกซ้อนจากโรคเรื้อรัง'
    );

    $suggest = $user['abnormal_suggest'];
    $suggest_date = ( $user['abnormal_suggest_date'] != '0000-00-00' ) ? 'ในวันที่ '.$user['abnormal_suggest_date'] : '' ;
    
}

$suggest_detail = $suggest_list[$suggest];
$conclution_detail = $suggest_detail.$suggest_date;

$pdf->SetXY(60, 217);
$pdf->Cell(38, 6, $conclution_detail, 0, 1);

print_dashed(58,223,205,223);

$pdf->SetXY(5, 223);
$diag_txt = '';
$test_diag = false;
if( !empty($user['diag']) ){
    $pre_diag_txt = 'Diag แพทย์: '.htmlspecialchars_decode(conv($user['diag']));
    $diag_txt .= preg_replace('/\s+/',' ',$pre_diag_txt );
    $test_diag = true;
}

if( !empty($user['cxr_detail']) ){
    $pre_diag_txt = 'เอ็กซเรย์ทรวงอก: '.htmlspecialchars_decode(conv($user['cxr_detail']));
    $newline = '';
    if($test_diag === true){
        $newline = "\n";
    }
    $diag_txt .= $newline.preg_replace('/\s+/',' ',$pre_diag_txt );

}

// หาความสูงของแถวเอามานับเป็นจำนวนที่ต้องขีดเส้นประ
$muticell_h = $pdf->GetMultiCellHeight(200, 6, $diag_txt);
$dash_loop = $muticell_h/6;
$y_dash = 229;
for ($i=0; $i < $dash_loop; $i++) { 
    print_dashed(5,$y_dash,205,$y_dash);
    $y_dash+=6;
}
// ข้อความ diag + xray
$pdf->multiCell(200,6,$diag_txt,0,'L');

$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(5, 241);
$pdf->Cell(25, 6, 'ผู้ประกันตนลงนาม', 0, 1);
$pdf->Line(40,247,86,247);
$pdf->SetXY(40, 250);
$pdf->Cell(46, 6, '( '.conv($user['prefix'].$user['name'].' '.$user['surname']).' )', 0, 1, 'C');

// dump($user['doctor']);
// $def_doctor = iconv620ToUTF8($user['doctor']);
// dump($def_doctor);
// $match = preg_match('/\d+/',$def_doctor, $matchs);
// dump($match);
// dump($matchs);
// if( $match > 0 ){

// $code_doctor = $matchs['0'];
// dump($code_doctor);

$def_doctor = $user['doctor'];

$sql = "SELECT CONCAT(b.`yot`,b.`yot2`,a.`name`) AS `doctor_full`
FROM `inputm` AS a 
LEFT JOIN `doctor` AS b ON b.`doctorcode` = a.`codedoctor` 
WHERE a.`name` = '".$user['doctor']."' 
AND b.`name` NOT LIKE 'CHK%'";
$db->select($sql);
if($db->get_rows() > 0){
    $dt = $db->get_item();
    $def_doctor = $dt['doctor_full'];
}

// }

$pdf->SetXY(107, 241);
$pdf->Cell(25, 6, 'ลงชื่อแพทย์ผู้ตรวจ', 0, 1);
$pdf->Line(133,247,179,247);
$pdf->SetXY(133, 250);
$pdf->Cell(46, 6, '( '.conv($def_doctor).' )', 0, 1, 'C');

$pdf->AutoPrint(true);
$pdf->Output();