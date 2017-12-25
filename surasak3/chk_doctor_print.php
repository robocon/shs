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
$pdf->Cell(210, 7, 'ใบรายงานผลตรวจสุขภาพ', 0, 1, 'C');

$pdf->SetXY(40, 40);
$pdf->Cell(17, 7, 'โรงพยาบาล  ค่ายสุรศักดิ์มนตรี', 0, 1, 'L');
print_dashed(56,45,100,45);


$pdf->SetFont('THSarabun','',9); // เรียกใช้งานฟอนต์ที่เตรียมไว้


$pdf->Rect(13, 47, 41, 7);
$pdf->SetXY(13, 47);
$pdf->Cell(41, 7, 'หน่วยงาน', 0, 1, 'L');
print_dashed(23,52,52,52);

$pdf->Rect(54, 47, 22, 7);
$pdf->SetXY(54, 47);
$pdf->Cell(22, 7, 'HN', 0, 1, 'L');

$pdf->Rect(76, 47, 26, 7);
$pdf->SetXY(76, 47);
$pdf->Cell(26, 7, 'เลขรับแจ้ง', 0, 1, 'L');

$pdf->Rect(102, 47, 41, 7);
$pdf->SetXY(102, 47);
$pdf->Cell(41, 7, 'เลขบัตรประชาชน', 0, 1, 'L');

$pdf->Rect(143, 47, 40, 7);
$pdf->SetXY(143, 47);
$pdf->Cell(40, 7, 'วันที่เข้ารับบริการ', 0, 1, 'L');

$pdf->SetXY(13, 54);
$pdf->Cell(27, 7, 'ชื่อ-นามสกุล / Name', 0, 1, 'L');


$pdf->Rect(42, 56, 3, 3);
$pdf->SetXY(46, 54);
$pdf->Cell(5, 7, 'นาย', 0, 1, 'L');

$pdf->Rect(52, 56, 3, 3);
$pdf->SetXY(56, 54);
$pdf->Cell(5, 7, 'นาง', 0, 1, 'L');

$pdf->Rect(62, 56, 3, 3);
$pdf->SetXY(66, 54);
$pdf->Cell(5, 7, 'น.ส.', 0, 1, 'L');

$pdf->SetXY(73, 54);
$pdf->Cell(5, 7, 'ชื่อ', 0, 1, 'L');
print_dashed(77,59,103,59);

$pdf->SetXY(103, 54);
$pdf->Cell(5, 7, 'นามสกุล', 0, 1, 'L');
print_dashed(112,59,140,59);

$pdf->Rect(143, 54, 40, 14);
$pdf->SetXY(143, 54);
$pdf->Cell(40, 7, 'โทรศัพท์ / Tel.', 0, 1, 'L');

$pdf->SetXY(13, 61);
$pdf->Cell(27, 7, 'ที่อยู่ / Address', 0, 1, 'L');
print_dashed(28,66,140,66);
print_dashed(13,73,140,73);


// $pdf->AutoPrint(true);
$pdf->Output();