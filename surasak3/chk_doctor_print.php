<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date');

include 'fpdf_thai/shspdf.php';

function print_dashed($x1, $y1, $x2, $y2){
    global $pdf;

    $pdf->SetLineWidth(0.1);
    $pdf->SetDash(0.3, 0.7);
    $pdf->Line($x1, $y1, $x2, $y2);

    $pdf->SetLineWidth(0.2);
    $pdf->SetDash();
}

$pdf = new SHSPdf();
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);

$pdf->AddPage('P', 'A4');



$pdf->SetFont('THSarabun','B',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetXY(0, 25);
$pdf->Cell(210, 6, 'ใบรายงานผลตรวจสุขภาพ', 0, 1, 'C');

$pdf->SetXY(25, 37);
$pdf->Cell(163, 6, 'โรงพยาบาล  ค่ายสุรศักดิ์มนตรี', 0, 1);
// print_dashed(56,43,100,43);


$pdf->SetFont('THSarabun','',9); // เรียกใช้งานฟอนต์ที่เตรียมไว้

# หัวข้อ
$pdf->Rect(13, 43, 46, 6);
$pdf->SetXY(13, 43);
$pdf->Cell(46, 6, 'หน่วยงาน', 1, 1);
// print_dashed(23,52,52,52);

$pdf->Rect(59, 43, 22, 6);
$pdf->SetXY(59, 43);
$pdf->Cell(22, 6, 'HN', 0, 1);

$pdf->Rect(81, 43, 26, 6);
$pdf->SetXY(81, 43);
$pdf->Cell(26, 6, 'เลขรับแจ้ง', 0, 1);

$pdf->Rect(107, 43, 41, 6);
$pdf->SetXY(107, 43);
$pdf->Cell(41, 6, 'เลขบัตรประชาชน', 0, 1);

$pdf->Rect(148, 43, 40, 6);
$pdf->SetXY(148, 43);
$pdf->Cell(40, 6, 'วันที่เข้ารับบริการ', 0, 1);

# ข้อมูลส่วนตัว
$pdf->SetXY(13, 49);
$pdf->Cell(27, 6, 'ชื่อ-นามสกุล / Name', 0, 1);

$pdf->Rect(42, 50, 3, 3); // checkbox
$pdf->SetXY(46, 49);
$pdf->Cell(5, 6, 'นาย', 0, 1);

$pdf->Rect(52, 50, 3, 3);
$pdf->SetXY(56, 49);
$pdf->Cell(5, 6, 'นาง', 0, 1);

$pdf->Rect(62, 50, 3, 3);
$pdf->SetXY(66, 49);
$pdf->Cell(5, 6, 'น.ส.', 0, 1);

$pdf->SetXY(73, 49);
$pdf->Cell(5, 6, 'ชื่อ', 0, 1);
print_dashed(77,53,103,53);

$pdf->SetXY(103, 49);
$pdf->Cell(5, 6, 'นามสกุล', 0, 1);
print_dashed(112,53,140,53);

$pdf->Rect(148, 49, 40, 12);
$pdf->SetXY(148, 49);
$pdf->Cell(40, 6, 'โทรศัพท์ / Tel.', 0, 1);

$pdf->SetXY(13, 55);
$pdf->Cell(27, 6, 'ที่อยู่ / Address', 0, 1);
print_dashed(28,59,140,59);
print_dashed(13,65,140,65);

$pdf->Line(13, 67, 188, 67);

$pdf->SetFont('THSarabun','B',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetXY(0, 67);
$pdf->Cell(210, 6, 'ข้อมูลสุขภาพ (Health data)', 0, 1, 'C');

$pdf->SetFont('THSarabun','',9); // เรียกใช้งานฟอนต์ที่เตรียมไว้

### หัวข้อ
$pdf->Rect(13, 73, 46, 12);
$pdf->SetXY(13, 73);
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

$pdf->Rect(107, 73, 41, 12);
$pdf->SetXY(107, 73);
$pdf->Cell(41, 6, 'การตรวจสารเคมีในเลือด', 0, 1);
$pdf->SetXY(107, 79);
$pdf->Cell(41, 6, 'BIOCHEMICAL TESTS', 0, 1);

$pdf->Rect(148, 73, 15, 12);
$pdf->SetXY(148, 73);
$pdf->Cell(15, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
$pdf->SetXY(148, 79);
$pdf->Cell(15, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(163, 73, 25, 12);
$pdf->SetXY(163, 73);
$pdf->Cell(25, 6, 'ค่าปกติ', 0, 1, 'C');
$pdf->SetXY(163, 79);
$pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');

### 1
$pdf->Rect(13, 85, 46, 12);
$pdf->SetXY(13, 85);
$pdf->Cell(46, 6, '1.การคัดกรองการได้ยิน', 0, 1);
$pdf->SetXY(13, 91);
$pdf->Cell(46, 6, 'Finger Rub Test', 0, 1);

$pdf->Rect(59, 85, 22, 12);
$pdf->SetXY(59, 85);
$pdf->Cell(22, 6, '', 0, 1, 'C');
$pdf->SetXY(59, 91);
$pdf->Cell(22, 6, '', 0, 1, 'C');

$pdf->Rect(81, 85, 26, 12);
$pdf->SetXY(81, 85);
$pdf->Cell(26, 6, '', 0, 1, 'C');
$pdf->SetXY(81, 91);
$pdf->Cell(26, 6, '', 0, 1, 'C');

$pdf->Rect(107, 85, 41, 12);
$pdf->SetXY(107, 85);
$pdf->Cell(41, 6, '7.การตรวจระดับน้ำตาลในเลือด FBS', 0, 1);

$pdf->Rect(148, 85, 15, 12);
$pdf->SetXY(148, 85);
$pdf->Cell(15, 6, '', 0, 1, 'C');
$pdf->SetXY(148, 91);
$pdf->Cell(15, 6, '', 0, 1, 'C');

$pdf->Rect(163, 85, 25, 12);
$pdf->SetXY(163, 85);
$pdf->Cell(25, 6, '', 0, 1, 'C');
$pdf->SetXY(163, 91);
$pdf->Cell(25, 6, '', 0, 1, 'C');

### 2
$pdf->Rect(13, 97, 46, 12);
$pdf->SetXY(13, 97);
$pdf->Cell(46, 6, '2.การตรวจเต้านมโดยแพทย์หรือ', 0, 1);
$pdf->SetXY(13, 103);
$pdf->Cell(46, 6, 'บุคลากรสาธารณสุข', 0, 1);

$pdf->Rect(59, 97, 22, 12);
$pdf->SetXY(59, 97);
$pdf->Cell(22, 6, '', 0, 1, 'C');
$pdf->SetXY(59, 103);
$pdf->Cell(22, 6, '', 0, 1, 'C');

$pdf->Rect(81, 97, 26, 12);
$pdf->SetXY(81, 97);
$pdf->Cell(26, 6, '', 0, 1, 'C');
$pdf->SetXY(81, 103);
$pdf->Cell(26, 6, '', 0, 1, 'C');

$pdf->Rect(107, 97, 41, 12);
$pdf->SetXY(107, 97);
$pdf->Cell(41, 6, '8.การทำงานของไต', 0, 1);
$pdf->SetXY(107, 103);
$pdf->Cell(41, 6, 'Serum Creatinine', 0, 1);

$pdf->Rect(148, 97, 15, 12);
$pdf->SetXY(148, 97);
$pdf->Cell(15, 6, '', 0, 1, 'C');
$pdf->SetXY(148, 103);
$pdf->Cell(15, 6, '', 0, 1, 'C');

$pdf->Rect(163, 97, 25, 12);
$pdf->SetXY(163, 97);
$pdf->Cell(25, 6, '', 0, 1, 'C');
$pdf->SetXY(163, 103);
$pdf->Cell(25, 6, '', 0, 1, 'C');

# 3
$pdf->Rect(13, 109, 46, 12);
$pdf->SetXY(13, 109);
$pdf->Cell(46, 6, '3.การตรวจตาโดยความดูแล', 0, 1);
$pdf->SetXY(13, 115);
$pdf->Cell(46, 6, 'ของจักษุแพทย์', 0, 1);

$pdf->Rect(59, 109, 22, 12);
$pdf->SetXY(59, 109);
$pdf->Cell(22, 6, '', 0, 1, 'C');
$pdf->SetXY(59, 115);
$pdf->Cell(22, 6, '', 0, 1, 'C');

$pdf->Rect(81, 109, 26, 12);
$pdf->SetXY(81, 109);
$pdf->Cell(26, 6, '', 0, 1, 'C');
$pdf->SetXY(81, 115);
$pdf->Cell(26, 6, '', 0, 1, 'C');

$pdf->Rect(107, 109, 41, 12);
$pdf->SetXY(107, 109);
$pdf->Cell(41, 6, '9.การตรวจไขมันในเลือด', 0, 1);
$pdf->SetXY(107, 115);
$pdf->Cell(41, 6, 'Total Cholesterol', 0, 1, 'R');

$pdf->Rect(148, 109, 15, 12);
$pdf->SetXY(148, 109);
$pdf->Cell(15, 6, '', 0, 1, 'C');
$pdf->SetXY(148, 115);
$pdf->Cell(15, 6, '', 0, 1, 'C');

$pdf->Rect(163, 109, 25, 12);
$pdf->SetXY(163, 109);
$pdf->Cell(25, 6, '', 0, 1, 'C');
$pdf->SetXY(163, 115);
$pdf->Cell(25, 6, '', 0, 1, 'C');

# 4
$pdf->Rect(13, 121, 46, 12);
$pdf->SetXY(13, 121);
$pdf->Cell(46, 6, '4.การตรวจตาด้วย Snellen eye Chart', 0, 1);

$pdf->Rect(59, 121, 22, 12);
$pdf->SetXY(59, 121);
$pdf->Cell(22, 6, '', 0, 1, 'C');
$pdf->SetXY(59, 127);
$pdf->Cell(22, 6, '', 0, 1, 'C');

$pdf->Rect(81, 121, 26, 12);
$pdf->SetXY(81, 121);
$pdf->Cell(26, 6, '', 0, 1, 'C');
$pdf->SetXY(81, 127);
$pdf->Cell(26, 6, '', 0, 1, 'C');

$pdf->Rect(107, 121, 41, 12);
$pdf->SetXY(107, 121);
$pdf->Cell(41, 6, 'HDL Cholesterol', 1, 1, 'R');
$pdf->SetXY(107, 127);
$pdf->Cell(41, 6, '10.ตรวจเชื้อไวรัสตับอักเสบ HBsAg', 0, 1);

$pdf->Rect(148, 121, 15, 12);
$pdf->SetXY(148, 121);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(148, 127);
$pdf->Cell(15, 6, '', 0, 1, 'C');

$pdf->Rect(163, 121, 25, 12);
$pdf->SetXY(163, 121);
$pdf->Cell(25, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 127);
$pdf->Cell(25, 6, '', 0, 1, 'C');

# 5
$pdf->Rect(13, 133, 46, 12);
$pdf->SetXY(13, 133);
$pdf->Cell(46, 6, '5.ความสมบูรณ์ของเม็ดเลือด CBC', 0, 1);
$pdf->SetXY(13, 139);
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

$pdf->Rect(107, 133, 41, 12);
$pdf->SetXY(107, 133);
$pdf->Cell(41, 6, '11.การตรวจเนื้อเยื่อจากปากมดลูก', 0, 1);
$pdf->SetXY(107, 139);
$pdf->Cell(41, 6, 'ด้วยวิธี PAP Smear', 0, 1);

$pdf->Rect(148, 133, 15, 12);
$pdf->SetXY(148, 133);
$pdf->Cell(15, 6, '', 0, 1, 'C');
$pdf->SetXY(148, 139);
$pdf->Cell(15, 6, '', 0, 1, 'C');

$pdf->Rect(163, 133, 25, 12);
$pdf->SetXY(163, 133);
$pdf->Cell(25, 6, '', 0, 1, 'C');
$pdf->SetXY(163, 139);
$pdf->Cell(25, 6, '', 0, 1, 'C');


# โลหิตจาง
$pdf->Rect(13, 145, 46, 66); // กรอบช่องซ้ายเม็ดเลือดขาว
$pdf->SetXY(13, 145);
$pdf->Cell(46, 6, 'ภาวะโลหิตจาง', 0, 1);

$pdf->SetXY(39, 145);
$pdf->Cell(20, 6, 'Hb', 0, 1);
$pdf->Line(39, 151, 59, 151);

// $pdf->Rect(59, 145, 22, 18);
$pdf->SetXY(59, 145);
$pdf->Cell(22, 6, '', 1, 1, 'C');

// $pdf->Rect(81, 145, 26, 18);
$pdf->SetXY(81, 145);
$pdf->Cell(26, 6, '', 1, 1, 'C');


$pdf->SetXY(39, 151);
$pdf->Cell(20, 6, 'Hct', 0, 1);
$pdf->Line(39, 157, 59, 157); // underline
$pdf->SetXY(59, 151);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 151);
$pdf->Cell(26, 6, '', 1, 1, 'C');


$pdf->SetXY(13, 157);
$pdf->Cell(46, 6, 'จำนวนเม็ดเลือดขาวรวม', 0, 1);
$pdf->SetXY(39, 157);
$pdf->Cell(20, 6, 'WBC', 0, 1);
$pdf->Line(39, 163, 59, 163); // underline
$pdf->SetXY(59, 157);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 157);
$pdf->Cell(26, 6, '', 1, 1, 'C');

$pdf->SetXY(13, 163);
$pdf->Cell(46, 6, 'จำนวนเม็ดเลือดขาวแยกตามชนิด', 0, 1);

$pdf->SetXY(13, 169);
$pdf->Cell(46, 6, 'Neutrophil', 0, 1);
$pdf->Line(39, 175, 59, 175); // underline
$pdf->Rect(59, 163, 22, 12); // rectangle
$pdf->SetXY(59, 169);
$pdf->Cell(22, 6, '', 0, 1, 'C');
$pdf->Rect(81, 163, 26, 12); //
$pdf->SetXY(81, 169);
$pdf->Cell(26, 6, '', 0, 1, 'C');

$pdf->SetXY(13, 175);
$pdf->Cell(46, 6, 'Lymphocyte', 0, 1);
$pdf->Line(39, 181, 59, 181);
$pdf->SetXY(59, 175);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 175);
$pdf->Cell(26, 6, '', 1, 1, 'C');

$pdf->SetXY(13, 181);
$pdf->Cell(46, 6, 'Monocyte', 0, 1);
$pdf->Line(39, 187, 59, 187);
$pdf->SetXY(59, 181);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 181);
$pdf->Cell(26, 6, '', 1, 1, 'C');

$pdf->SetXY(13, 187);
$pdf->Cell(46, 6, 'Eosinophil', 0, 1);
$pdf->Line(39, 193, 59, 193);
$pdf->SetXY(59, 187);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 187);
$pdf->Cell(26, 6, '', 1, 1, 'C');

$pdf->SetXY(13, 193);
$pdf->Cell(46, 6, 'Basophil', 0, 1);
$pdf->Line(39, 199, 59, 199);
$pdf->SetXY(59, 193);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 193);
$pdf->Cell(26, 6, '', 1, 1, 'C');

$pdf->SetXY(13, 199);
$pdf->Cell(46, 6, 'จำนวนเกล็ดเลือด', 0, 1);
$pdf->SetXY(39, 199);
$pdf->Cell(20, 6, 'Plateiets count', 0, 1);
$pdf->Line(39, 205, 59, 205);
$pdf->SetXY(59, 199);
$pdf->Cell(22, 6, '', 1, 1, 'C');
$pdf->SetXY(81, 199);
$pdf->Cell(26, 6, '', 1, 1, 'C');

$pdf->SetXY(13, 205);
$pdf->Cell(46, 6, 'รูปร่างเม็ดเลือดแดง', 0, 1);
$pdf->SetXY(39, 205);
$pdf->Cell(46, 6, 'RBC', 0, 1);
$pdf->SetXY(59, 205);
$pdf->Cell(48, 6, '', 1, 1);

// ก่อนถึงช่อง xray
$pdf->Rect(13, 211, 46, 12);

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

$pdf->SetXY(13, 223);
$pdf->Cell(46, 6, '6.Chest X-ray', 1, 1);
$pdf->SetXY(59, 223);
$pdf->Cell(22, 6, '', 1, 1);
$pdf->SetXY(81, 223);
$pdf->Cell(26, 6, '', 1, 1);


# ช่องขวา
$pdf->SetXY(107, 145);
$pdf->Cell(41, 6, 'ด้วยวิธี Via', 1, 1);
$pdf->SetXY(148, 145);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 145);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->Rect(107, 151, 41, 12);
$pdf->SetXY(107, 151);
$pdf->Cell(41, 6, '12.การตรวจปัสสาวะ', 0, 1);

$pdf->SetXY(128, 151);
$pdf->Cell(20, 6, 'UA', 0, 1);

$pdf->Rect(148, 151, 15, 12);
$pdf->SetXY(148, 151);
$pdf->Cell(15, 6, 'ค่าที่ตรวจได้', 0, 1, 'C');
$pdf->SetXY(148, 157);
$pdf->Cell(15, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(163, 151, 25, 12);
$pdf->SetXY(163, 151);
$pdf->Cell(25, 6, 'ค่าปกติ', 0, 1, 'C');
$pdf->SetXY(163, 157);
$pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');

// กรอบใหญ่ทางขวา
$pdf->Rect(107, 163, 41, 54);

$pdf->SetXY(107, 163);
$pdf->Cell(41, 6, 'sp.gr', 0, 1);
$pdf->Line(128, 169, 148, 169);
$pdf->SetXY(148, 163);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 163);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 169);
$pdf->Cell(41, 6, 'Ph', 0, 1);
$pdf->Line(128, 175, 148, 175);
$pdf->SetXY(148, 169);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 169);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 175);
$pdf->Cell(41, 6, 'Glucose', 0, 1);
$pdf->Line(128, 181, 148, 181);
$pdf->SetXY(148, 175);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 175);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 181);
$pdf->Cell(41, 6, 'Albumin', 0, 1);
$pdf->Line(128, 187, 148, 187);
$pdf->SetXY(148, 181);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 181);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 187);
$pdf->Cell(41, 6, 'RBC', 0, 1);
$pdf->Line(128, 193, 148, 193);
$pdf->SetXY(148, 187);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 187);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 193);
$pdf->Cell(41, 6, 'WBC', 0, 1);
$pdf->Line(128, 199, 148, 199);
$pdf->SetXY(148, 193);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 193);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 199);
$pdf->Cell(41, 6, 'Epith cell', 0, 1);
$pdf->Line(128, 205, 148, 205);
$pdf->SetXY(148, 199);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 199);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 205);
$pdf->Cell(41, 6, 'Blood', 0, 1);
$pdf->Line(128, 211, 148, 211);
$pdf->SetXY(148, 205);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 205);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->SetXY(107, 211);
$pdf->Cell(41, 6, 'Ketone', 0, 1);
$pdf->Line(128, 217, 148, 217);
$pdf->SetXY(148, 211);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 211);
$pdf->Cell(25, 6, '', 1, 1, 'C');



$pdf->Rect(107, 217, 41, 12);
$pdf->SetXY(107, 217);
$pdf->Cell(41, 6, '13.การตรวจหาเลือดในอุจจาระ', 0, 1);
$pdf->SetXY(107, 223);
$pdf->Cell(41, 6, 'Fecal occult blood test(FOBT)', 0, 1);

$pdf->Rect(148, 217, 15, 12);
$pdf->SetXY(148, 217);
$pdf->Cell(15, 6, '', 0, 1, 'C');
$pdf->Rect(163, 217, 25, 12);
$pdf->SetXY(163, 217);
$pdf->Cell(25, 6, '', 0, 1, 'C');

$pdf->SetXY(13, 229);
$pdf->Cell(41, 6, 'สรุปผลตรวจ', 0, 1);

$pdf->Rect(54, 230, 3, 3);
$pdf->SetXY(58, 229);
$pdf->Cell(10, 6, 'ปกติ', 0, 1);

$pdf->Rect(70, 230, 3, 3);
$pdf->SetXY(74, 229);
$pdf->Cell(10, 6, 'ผิดปกติ', 0, 1);

$pdf->SetXY(13, 235);
$pdf->Cell(38, 6, 'คำแนะนำเพิ่มเติมในการดูแลรักษาสุขภาพ', 0, 1);

print_dashed(49,239,188,239);
print_dashed(13,245,188,245);

$pdf->SetFont('THSarabun','B',9);

$pdf->SetXY(13, 247);
$pdf->Cell(20, 6, 'ผู้ประกันตนลงนาม', 0, 1);
$pdf->Line(35,252,78,252);
$pdf->SetXY(33, 253);
$pdf->Cell(13, 6, '(                                                             )', 0, 1);

$pdf->SetXY(107, 247);
$pdf->Cell(20, 6, 'ลงชื่อแพทย์ผู้ตรวจ', 0, 1);
$pdf->Line(129,252,172,252);
$pdf->SetXY(127, 253);
$pdf->Cell(13, 6, '(                                                             )', 0, 1);



// $pdf->AutoPrint(true);
$pdf->Output();