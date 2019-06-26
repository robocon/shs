<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date'); // date_chk ในตาราง chk_doctor

# กรณีที่ตรวจเป็นกลุ่มบริษัท
# 2562-06-24 คุยกับแผนกตรวจสุขภาพแล้ว ไม่เอาชื่อ-สกุลจากทะเบียนเพราะทำงานล่าช้า
# ให้ดึงข้อมูลจากของตรวจสุขภาพเลย
$sql_opcard = "SELECT `name`,`surname`  
FROM `opcardchk` 
WHERE `HN` = '$hn' 
ORDER BY `row` DESC LIMIT 1;";
$db->select($sql_opcard);
$regis_user = $db->get_item();

# ข้อมูลผู้ป่วย
$sql = "SELECT a.*, b.`ptffone`, b.`phone`
FROM `chk_doctor` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`hn` = '$hn' 
AND a.`vn` = '$vn' 
AND a.`date_chk` LIKE '$date%' ";
$db->select($sql);
$user = $db->get_item();

// ตรวจเป็นกลุ่มจะดึงข้อมูลจากที่น้องนัทเอาเข้าระบบ
if( $regis_user !== false ){
    $user['name'] = str_replace($user['prefix'],'',$regis_user['name']);
    $user['surname'] = $regis_user['surname'];
}

$year_checkup = $user['yearchk'];

$sql = "SELECT `camp`,`labin_date` 
FROM `dxofyear_out` WHERE `thdatehn` = '$date$hn' ";
$db->select($sql);
$dxofyear = $db->get_item();

// ดึงวันที่ที่ตรวจ lab นับเป็นวันที่ได้รับการเข้ารับบริการ
$sql = "SELECT SUBSTRING(`orderdate`,1,10) AS `lab_opd`  
FROM `resulthead` 
WHERE `hn` = '$hn' 
AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' 
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
    AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( b.`labcode` = 'HB' OR b.`labcode` = 'HCT' OR b.`labcode` = 'WBC' 
OR b.`labcode` = 'NEU' OR b.`labcode` = 'LYMP' OR b.`labcode` = 'MONO' 
OR b.`labcode` = 'EOS' OR b.`labcode` = 'BASO' OR b.`labcode` = 'PLTC' 
OR b.`labcode` = 'RBC' OR b.`labcode` = 'RBCMOR' ) 
ORDER BY b.seq ASC";
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
    AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( b.`labcode` = 'SPGR' OR b.`labcode` = 'PHU' OR b.`labcode` = 'GLUU' 
OR b.`labcode` = 'PROU' 
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
    AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$year_checkup' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( 
    b.`labcode` = 'GLU' 
    OR b.`labcode` = 'CREA' 
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
$pdf->Cell(20, 6, $dxofyear['camp'], 0, 1);

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
if( $user['prefix'] == 'นาย' ){
    $pdf->Line(42,54,45,51);
}
$pdf->SetXY(45, 49);
$pdf->Cell(5, 6, 'นาย', 0, 1);

$pdf->Rect(52, 51, 3, 3);
if( $user['prefix'] == 'นาง' ){
    $pdf->Line(52,54,55,51);
}
$pdf->SetXY(55, 49);
$pdf->Cell(5, 6, 'นาง', 0, 1);

$pdf->Rect(62, 51, 3, 3);
if( $user['prefix'] == 'น.ส.' OR $user['prefix'] == 'นางสาว' ){
    $pdf->Line(62,54,65,51);
}
$pdf->SetXY(65, 49);
$pdf->Cell(5, 6, 'น.ส.', 0, 1);

$pdf->SetXY(73, 49);
$pdf->Cell(5, 6, 'ชื่อ', 0, 1);
print_dashed(78,54,103,54);

$pdf->SetXY(78, 49);
$pdf->Cell(5, 6, $user['name'], 0, 1);

$pdf->SetXY(103, 49);
$pdf->Cell(5, 6, 'นามสกุล', 0, 1);
print_dashed(116,54,140,54);

$pdf->SetXY(115, 49);
$pdf->Cell(5, 6, $user['surname'], 0, 1);

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
print_dashed(25,65.50,140,65.50);

$pdf->SetXY(31, 55);
$pdf->Cell(40, 6, $user['address'], 0, 1);


$pdf->Line(5, 67, 205, 67);
$pdf->SetFont('AngsanaNew','',16); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetXY(5, 67);
$pdf->Cell(200, 6, 'ข้อมูลสุขภาพ (Health data)', 0, 1, 'C');


$pdf->SetFont('AngsanaNew','',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้

### หัวข้อ
$pdf->Rect(5, 73, 54, 12);
$pdf->SetXY(5, 73);
$pdf->Cell(46, 6, 'การตรวจร่างกายตามระบบ', 0, 1);

$pdf->Rect(59, 73, 22, 12);
$pdf->SetXY(59, 73);
$pdf->Cell(22, 6, 'ผลปกติ', 0, 1, 'C');
$pdf->SetXY(59, 79);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 73, 26, 12);
$pdf->SetXY(81, 73);
$pdf->Cell(26, 6, 'ผลผิดปกติ', 0, 1, 'C');
$pdf->SetXY(81, 79);
$pdf->Cell(26, 6, 'ABNORMAL', 0, 1, 'C');

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

### 1
$pdf->Rect(5, 85, 54, 12);
$pdf->SetXY(5, 85);
$pdf->Cell(46, 6, '1.การคัดกรองการได้ยิน', 0, 1);
$pdf->SetXY(5, 91);
$pdf->Cell(46, 6, 'Finger Rub Test', 0, 1);

$pdf->Rect(59, 85, 22, 12);
if( $user['ear'] == 1 ){
    $pdf->Line(65, 94, 75, 88);
}

$pdf->Rect(81, 85, 26, 12);
if( $user['ear'] == 2 ){
    $pdf->Line(89, 94, 99, 88);
}


$pdf->Rect(107, 85, 51, 12);
$pdf->SetXY(107, 85);
$pdf->Cell(41, 6, '7.การตรวจระดับน้ำตาลในเลือด FBS', 0, 1);

$pdf->Rect(158, 85, 22, 12);
$pdf->SetXY(158, 85);
if( $etc_lists['glu']['flag'] != 'N' ){
    call_alert_result(158, 85, 22, 12);
}
$pdf->Cell(22, 6, $etc_lists['glu']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 85, 25, 12);
$pdf->SetXY(180, 85);
$pdf->Cell(25, 6, $etc_lists['glu']['normalrange'], 0, 1, 'C');


### 2
$pdf->Rect(5, 97, 54, 12);
$pdf->SetXY(5, 97);
$pdf->Cell(46, 6, '2.การตรวจเต้านมโดยแพทย์หรือ', 0, 1);
$pdf->SetXY(5, 103);
$pdf->Cell(46, 6, 'บุคลากรสาธารณสุข', 0, 1);

$pdf->Rect(59, 97, 22, 12);
if( !empty($user['breast']) && $user['breast'] == 1 ){
    $pdf->Line(65, 106, 75, 100);
}

$pdf->Rect(81, 97, 26, 12);
if( !empty($user['breast']) && $user['breast'] == 2 ){
    $pdf->Line(89, 106, 99, 100);
}

$pdf->Rect(107, 97, 51, 12);
$pdf->SetXY(107, 97);
$pdf->Cell(41, 6, '8.การทำงานของไต', 0, 1);
$pdf->SetXY(107, 103);
$pdf->Cell(41, 6, 'Serum Creatinine', 0, 1);

$pdf->Rect(158, 97, 22, 12);
$pdf->SetXY(158, 97);

if( !empty($etc_lists['crea']['flag']) && $etc_lists['crea']['flag'] != 'N' ){
    call_alert_result(158, 97, 22, 12);
}
$pdf->Cell(22, 6, $etc_lists['crea']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 97, 25, 12);
$pdf->SetXY(180, 97);
$pdf->Cell(25, 6, $etc_lists['crea']['normalrange'], 0, 1, 'C');


# 3
$pdf->Rect(5, 109, 54, 12);
$pdf->SetXY(5, 109);
$pdf->Cell(46, 6, '3.การตรวจตาโดยความดูแล', 0, 1);
$pdf->SetXY(5, 115);
$pdf->Cell(46, 6, 'ของจักษุแพทย์', 0, 1);

$pdf->Rect(59, 109, 22, 12);
if( $user['eye'] == 1 ){
    $pdf->Line(65, 118, 75, 112);
}

$pdf->Rect(81, 109, 26, 12);
if( $user['eye'] == 2 ){
    $pdf->Line(89, 118, 99, 112);
}

$pdf->Rect(107, 109, 51, 12);
$pdf->SetXY(107, 109);
$pdf->Cell(51, 6, '9.การตรวจไขมันในเลือด', 0, 1);
$pdf->SetXY(107, 115);
$pdf->Cell(51, 6, 'Total Cholesterol', 0, 1, 'R');

$pdf->Rect(158, 109, 22, 12);
$pdf->SetXY(158, 115);
if( !empty($etc_lists['chol']['flag']) && $etc_lists['chol']['flag'] != 'N' ){
    call_alert_result(158, 109, 22, 12);
}
$pdf->Cell(22, 6, $etc_lists['chol']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 109, 25, 12);
$pdf->SetXY(180, 115);
$pdf->Cell(25, 6, $etc_lists['chol']['normalrange'], 0, 1, 'C');

# 4
$pdf->Rect(5, 121, 54, 12);
$pdf->SetXY(5, 121);
$pdf->Cell(46, 6, '4.การตรวจตาด้วย Snellen eye Chart', 0, 1);

$pdf->Rect(59, 121, 22, 12);
if( $user['snell_eye'] == 1 ){
    $pdf->Line(65, 130, 75, 124);
}

$pdf->Rect(81, 121, 26, 12);
if( $user['snell_eye'] == 2 ){
    $pdf->Line(89, 130, 99, 124);
}

$pdf->Rect(107, 121, 51, 12);
$pdf->SetXY(107, 121);
$pdf->Cell(51, 6, 'HDL Cholesterol', 1, 1, 'R');

$pdf->Rect(158, 121, 22, 12);
$pdf->SetXY(158, 121);
if( !empty($etc_lists['hdl']['flag']) && $etc_lists['hdl']['flag'] != 'N' ){
    call_alert_result(158, 121, 22, 6);
}
$pdf->Cell(22, 6, $etc_lists['hdl']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(180, 121, 25, 12);
$pdf->SetXY(180, 121);
$pdf->Cell(25, 6, $etc_lists['hdl']['normalrange'], 1, 1, 'C');


$pdf->Rect(107, 127, 51, 6);
$pdf->SetXY(107, 127);
$pdf->Cell(51, 6, '10.ตรวจเชื้อไวรัสตับอักเสบ HBsAg', 0, 1);
$pdf->SetXY(158, 127);

if( !empty($etc_lists['hbsag']['result']) && trim($etc_lists['hbsag']['result']) == 'Positive' ){
    call_alert_result(158, 127, 22, 6);
}
$pdf->Cell(22, 6, $etc_lists['hbsag']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(180, 127);
$pdf->Cell(25, 6, $etc_lists['hbsag']['normalrange'], 1, 1, 'C');

# 5
$pdf->Rect(5, 133, 54, 12);
$pdf->SetXY(5, 133);
$pdf->Cell(46, 6, '5.ความสมบูรณ์ของเม็ดเลือด CBC', 0, 1);
$pdf->SetXY(5, 139);
$pdf->Cell(46, 6, 'COMPLETE BLOOD COUNT', 0, 1);

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

$pdf->Rect(107, 133, 51, 12);
$pdf->SetXY(107, 133);
$pdf->Cell(41, 6, '11.การตรวจเนื้อเยื่อจากปากมดลูก', 0, 1);
$pdf->SetXY(107, 139);
$pdf->Cell(41, 6, 'ด้วยวิธี PAP Smear', 0, 1);

/* group รวมกัน */
$pdf->Rect(158, 133, 22, 12);
$pdf->SetXY(158, 133);
// ทดสอบ fill ค่า pap smear ผลปกติ
// $pdf->Cell(22, 6, '1234', 1, 1);

$pdf->Rect(180, 133, 25, 12);
$pdf->SetXY(180, 133);
// ทดสอบ fill ค่า pap smear ผลผิดปกติ
// $pdf->Cell(25, 6, '1234', 1, 1);
/* group รวมกัน */

# โลหิตจาง
$pdf->Rect(5, 145, 54, 66); // กรอบช่องซ้ายเม็ดเลือดขาว
$pdf->SetXY(5, 145);
$pdf->Cell(46, 6, 'ภาวะโลหิตจาง', 0, 1);

$pdf->SetXY(39, 145);
$pdf->Cell(20, 6, 'Hb', 0, 1);
$pdf->Line(39, 151, 59, 151);


$pdf->SetXY(59, 145);
if( !empty($cbc_lists['hb']['flag']) && $cbc_lists['hb']['flag'] != 'N' ){
    call_alert_result(59, 145, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['hb']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 145);
$pdf->Cell(26, 6, $cbc_lists['hb']['normalrange'], 1, 1, 'C');


$pdf->SetXY(39, 151);
$pdf->Cell(20, 6, 'Hct', 0, 1);
$pdf->Line(39, 157, 59, 157); // underline
$pdf->SetXY(59, 151);

if( !empty($cbc_lists['hct']['flag']) && $cbc_lists['hct']['flag'] != 'N' ){
    call_alert_result(59, 151, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['hct']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 151);
$pdf->Cell(26, 6, $cbc_lists['hct']['normalrange'], 1, 1, 'C');


$pdf->SetXY(5, 157);
$pdf->Cell(46, 6, 'จำนวนเม็ดเลือดขาวรวม', 0, 1);
$pdf->SetXY(39, 157);
$pdf->Cell(20, 6, 'WBC', 0, 1);
$pdf->Line(39, 163, 59, 163); // underline
$pdf->SetXY(59, 157);

if( !empty($cbc_lists['wbc']['flag']) && $cbc_lists['wbc']['flag'] != 'N' ){
    call_alert_result(59, 157, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['wbc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 157);
$pdf->Cell(26, 6, $cbc_lists['wbc']['normalrange'], 1, 1, 'C');

$pdf->SetXY(5, 163);
$pdf->Cell(46, 6, 'จำนวนเม็ดเลือดขาวแยกตามชนิด', 0, 1);

$pdf->SetXY(5, 169);
$pdf->Cell(46, 6, 'Neutrophil', 0, 1);
$pdf->Line(39, 175, 59, 175); // underline
$pdf->Rect(59, 163, 22, 12); // rectangle
$pdf->SetXY(59, 169);

if( !empty($cbc_lists['neu']['flag']) && $cbc_lists['neu']['flag'] != 'N' ){
    call_alert_result(59, 163, 22, 12);
}
$pdf->Cell(22, 6, $cbc_lists['neu']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->Rect(81, 163, 26, 12); //
$pdf->SetXY(81, 169);
$pdf->Cell(26, 6, $cbc_lists['neu']['normalrange'], 0, 1, 'C');

$pdf->SetXY(5, 175);
$pdf->Cell(46, 6, 'Lymphocyte', 0, 1);
$pdf->Line(39, 181, 59, 181);
$pdf->SetXY(59, 175);

if( !empty($cbc_lists['lymp']['flag']) && $cbc_lists['lymp']['flag'] != 'N' ){
    call_alert_result(59, 175, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['lymp']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 175);
$pdf->Cell(26, 6, $cbc_lists['lymp']['normalrange'], 1, 1, 'C');

$pdf->SetXY(5, 181);
$pdf->Cell(46, 6, 'Monocyte', 0, 1);
$pdf->Line(39, 187, 59, 187);
$pdf->SetXY(59, 181);

if( !empty($cbc_lists['mono']['flag']) && $cbc_lists['mono']['flag'] != 'N' ){
    call_alert_result(59, 181, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['mono']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 181);
$pdf->Cell(26, 6, $cbc_lists['mono']['normalrange'], 1, 1, 'C');

$pdf->SetXY(5, 187);
$pdf->Cell(46, 6, 'Eosinophil', 0, 1);
$pdf->Line(39, 193, 59, 193);
$pdf->SetXY(59, 187);

if( !empty($cbc_lists['eos']['flag']) && $cbc_lists['eos']['flag'] != 'N' ){
    call_alert_result(59, 187, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['eos']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 187);
$pdf->Cell(26, 6, $cbc_lists['eos']['normalrange'], 1, 1, 'C');

$pdf->SetXY(5, 193);
$pdf->Cell(46, 6, 'Basophil', 0, 1);
$pdf->Line(39, 199, 59, 199);
$pdf->SetXY(59, 193);

if( !empty($cbc_lists['baso']['flag']) && $cbc_lists['baso']['flag'] != 'N' ){
    call_alert_result(59, 193, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['baso']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 193);
$pdf->Cell(26, 6, $cbc_lists['baso']['normalrange'], 1, 1, 'C');

$pdf->SetXY(5, 199);
$pdf->Cell(46, 6, 'จำนวนเกล็ดเลือด', 0, 1);
$pdf->SetXY(39, 199);
$pdf->Cell(20, 6, 'Platelets count', 0, 1);
$pdf->Line(39, 205, 59, 205);
$pdf->SetXY(59, 199);

if( !empty($cbc_lists['pltc']['flag']) && $cbc_lists['pltc']['flag'] != 'N' ){
    call_alert_result(59, 199, 22, 6);
}
$pdf->Cell(22, 6, $cbc_lists['pltc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 199);
$pdf->Cell(26, 6, $cbc_lists['pltc']['normalrange'], 1, 1, 'C');

$pdf->SetXY(5, 205);
$pdf->Cell(46, 6, 'รูปร่างเม็ดเลือดแดง', 0, 1);
$pdf->SetXY(39, 205);
$pdf->Cell(46, 6, 'RBC', 0, 1);

$pdf->SetXY(59, 205);
if( !empty($cbc_lists['rbc']['flag']) && $cbc_lists['rbc']['flag'] != 'N' ){
    call_alert_result(59, 205, 22, 6);
}

$pdf->Cell(22, 6, $cbc_lists['rbcmor']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(81, 205);
$pdf->Cell(26, 6, $cbc_lists['rbcmor']['normalrange'], 1, 1, 'C');


// ก่อนถึงช่อง xray
$pdf->Rect(5, 211, 54, 18);
$pdf->SetXY(5, 211);
$pdf->Cell(46, 18, '6.Chest X-ray', 0, 1);

$pdf->Rect(59, 211, 22, 12);
$pdf->SetXY(59, 211);
$pdf->Cell(22, 6, 'ผลปกติ', 0, 1, 'C');
$pdf->SetXY(59, 217);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 211, 26, 12);
$pdf->SetXY(81, 211);
$pdf->Cell(26, 6, 'ผลผิดปกติ', 0, 1, 'C');
$pdf->SetXY(81, 217);
$pdf->Cell(26, 6, 'ABNORMAL', 0, 1, 'C');


$pdf->Rect(59, 223, 22, 6);
if( $user['cxr'] == 1 ){
    $pdf->Line(65, 228, 75, 224);
}

$pdf->Rect(81, 223, 26, 6);
if( $user['cxr'] == 2 ){
    $pdf->Line(89, 228, 99, 224);
}


# ช่องขวา
$pdf->SetXY(107, 145);
$pdf->Cell(51, 6, 'ด้วยวิธี Via', 1, 1);
$pdf->SetXY(158, 145);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(180, 145);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->Rect(107, 151, 51, 12);
$pdf->SetXY(107, 151);
$pdf->Cell(51, 6, '12.การตรวจปัสสาวะ UA', 0, 1);

//กว้าง37
$pdf->Rect(158, 151, 22, 12);
$pdf->SetXY(158, 151);
$pdf->Cell(22, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
$pdf->SetXY(158, 157);
$pdf->Cell(22, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(180, 151, 25, 12);
$pdf->SetXY(180, 151);
$pdf->Cell(25, 6, 'ค่าปกติ', 0, 1, 'C');
$pdf->SetXY(180, 157);
$pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');

// กรอบใหญ่ทางขวา
$pdf->Rect(107, 163, 51, 54);

$pdf->SetXY(107, 163);
$pdf->Cell(51, 6, 'sp.gr', 0, 1);
$pdf->Line(128, 169, 158, 169); //เส้นใต้บรรทัด
$pdf->SetXY(158, 163);
// if( !empty($ua_lists['spgr']['flag']) && $ua_lists['spgr']['flag'] != 'N' ){
    call_alert_result(158, 163, 22, 6);
// }

/**
 * @testing
 */
$ua_lists['spgr']['result'] = '11.11';


$pdf->Cell(22, 6, $ua_lists['spgr']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 163);
$pdf->Cell(25, 6, $ua_lists['spgr']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 169);
$pdf->Cell(51, 6, 'Ph', 0, 1);
$pdf->Line(128, 175, 158, 175);
$pdf->SetXY(158, 169);
if( $ua_lists['phu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['phu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 169);
$pdf->Cell(25, 6, $ua_lists['phu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 175);
$pdf->Cell(51, 6, 'Glucose', 0, 1);
$pdf->Line(128, 181, 158, 181);
$pdf->SetXY(158, 175);
if( $ua_lists['gluu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['gluu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 175);
$pdf->Cell(25, 6, $ua_lists['gluu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 181);
$pdf->Cell(51, 6, 'Albumin', 0, 1);
$pdf->Line(128, 187, 158, 187);
$pdf->SetXY(158, 181);
if( $ua_lists['prou']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['prou']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 181);
$pdf->Cell(25, 6, $ua_lists['prou']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 187);
$pdf->Cell(51, 6, 'RBC', 0, 1);
$pdf->Line(128, 193, 158, 193);
$pdf->SetXY(158, 187);
if( $ua_lists['rbcu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['rbcu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 187);
$pdf->Cell(25, 6, $ua_lists['rbcu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 193);
$pdf->Cell(51, 6, 'WBC', 0, 1);
$pdf->Line(128, 199, 158, 199);
$pdf->SetXY(158, 193);
if( $ua_lists['wbcu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['wbcu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 193);
$pdf->Cell(25, 6, $ua_lists['wbcu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 199);
$pdf->Cell(51, 6, 'Epith cell', 0, 1);
$pdf->Line(128, 205, 158, 205);
$pdf->SetXY(158, 199);
if( $ua_lists['epiu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['epiu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 199);
$pdf->Cell(25, 6, $ua_lists['epiu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 205);
$pdf->Cell(51, 6, 'Blood', 0, 1);
$pdf->Line(128, 211, 158, 211);
$pdf->SetXY(158, 205);
if( $ua_lists['bloodu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['bloodu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 205);
$pdf->Cell(25, 6, $ua_lists['bloodu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 211);
$pdf->Cell(51, 6, 'Ketone', 0, 1);
$pdf->Line(128, 217, 158, 217);
$pdf->SetXY(158, 211);
if( $ua_lists['ketu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}
$pdf->Cell(22, 6, $ua_lists['ketu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetXY(180, 211);
$pdf->Cell(25, 6, $ua_lists['ketu']['normalrange'], 1, 1, 'C');



$pdf->Rect(107, 217, 51, 12);
$pdf->SetXY(107, 217);
$pdf->Cell(51, 6, '13.การตรวจหาเลือดในอุจจาระ', 0, 1);
$pdf->SetXY(107, 223);
$pdf->Cell(51, 6, 'Fecal occult blood test(FOBT)', 0, 1);

$pdf->Rect(158, 217, 22, 12);
$pdf->SetXY(158, 217);
if( $etc_lists['occult']['flag'] != 'N' OR $etc_lists['stocc']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',13);
}

$occult_result = ( !empty($etc_lists['occult']['result']) ) ? $etc_lists['occult']['result'] : $etc_lists['stocc']['result'] ;
$occult_normalrange = ( !empty($etc_lists['occult']['normalrange']) ) ? $etc_lists['occult']['normalrange'] : $etc_lists['stocc']['normalrange'] ;

$pdf->Cell(22, 6, $occult_result, 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',13);
$pdf->Rect(180, 217, 25, 12);
$pdf->SetXY(180, 217);
$pdf->Cell(25, 6, $occult_normalrange, 0, 1, 'C');

$pdf->SetXY(5, 229);
$pdf->Cell(41, 6, 'สรุปผลตรวจ', 0, 1);

$pdf->Rect(54, 230, 3, 3);
$pdf->SetXY(58, 229);
$pdf->Cell(10, 6, 'ปกติ', 0, 1);
if( $user['conclution'] == "1" ){
    $pdf->Line(54,233,57,230);
}

$pdf->Rect(70, 230, 3, 3);
$pdf->SetXY(74, 229);
$pdf->Cell(10, 6, 'ผิดปกติ', 0, 1);
if( $user['conclution'] == "2" ){
    $pdf->Line(70,233,73,230);
}

$pdf->SetXY(5, 235);
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

$pdf->SetXY(60, 235);
$pdf->Cell(38, 6, $conclution_detail, 0, 1);

print_dashed(58,240,188,240);

if( !empty($user['diag']) ){
    $pdf->SetXY(5, 240);
    $pdf->Cell(38, 6, 'Diag แพทย์: '.htmlspecialchars_decode($user['diag']), 0, 1);
}
print_dashed(5,245,188,245);



if( !empty($user['cxr_detail']) ){
    
    $pdf->SetXY(5, 246);
    $pdf->Cell(38, 6, 'Chest X-ray: '.htmlspecialchars_decode($user['cxr_detail']), 0, 1);
}

print_dashed(5,251,188,251);

$pdf->SetFont('AngsanaNew','',13);

$pdf->SetXY(5, 259);
$pdf->Cell(25, 6, 'ผู้ประกันตนลงนาม', 0, 1);
$pdf->Line(40,265,86,265);
$pdf->SetXY(40, 266);
$pdf->Cell(46, 6, '( '.$user['prefix'].$user['name'].' '.$user['surname'].' )', 0, 1, 'C');

$def_doctor = $user['doctor'];
$match = preg_match('/\d+/',$user['doctor'], $matchs);
// dump($matchs);
if( $match > 0 ){

    $code_doctor = $matchs['0'];

    $sql = "SELECT CONCAT(b.`yot`,b.`yot2`,a.`name`) AS `doctor_full`
    FROM `inputm` AS a 
    LEFT JOIN `doctor` AS b ON b.`doctorcode` = a.`codedoctor` 
    WHERE a.`codedoctor` = '$code_doctor' 
    AND b.`name` NOT LIKE 'CHK%'";
    $db->select($sql);
    $dt = $db->get_item();
    $def_doctor = $dt['doctor_full'];
}

$pdf->SetXY(107, 259);
$pdf->Cell(25, 6, 'ลงชื่อแพทย์ผู้ตรวจ', 0, 1);
$pdf->Line(133,265,179,265);
$pdf->SetXY(133, 266);
$pdf->Cell(46, 6, '( '.$def_doctor.' )', 0, 1, 'C');

// $pdf->AutoPrint(true);
$pdf->Output();