<?php
// require 'bootstrap.php';
require 'fpdf_thai/SHSPdf.php';

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}
$dbi = new mysqli('192.168.131.250','remoteuser','','smdb');
$company = $_REQUEST['company'];

$pdf = new SHSPdf('L', 'mm', 'A5');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
// $pdf->SetFont('THSarabun','',18); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(9, 11, 9);
$pdf->AddPage();

$pdf->SetXY(9, 1);
$pdf->Cell(0, 7, 'test', 1, 1, 'C');

$pdf->SetXY(9, 11);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(60, 7, 'Fort Surasakmontri Hospital', 1, 1, 'L');
$pdf->SetFont('THSarabun','',18);
$pdf->Cell(60, 7, 'แผนกรังสีวิทยา', 1, 1, 'L');
$pdf->Cell(60, 7, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 1, 1, 'L');
$pdf->Cell(60, 7, 'โทร.053-839305', 1, 1, 'L');




$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(89, 11);
$pdf->Cell(30, 7, 'วันที่:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(119, 11);
$pdf->Cell(50, 7, ' 23 มี.ค. 65', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(89, 18);
$pdf->Cell(30, 7, 'ชื่อ-สกุล:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(119, 18);
$pdf->Cell(50, 7, ' พลฯ วัฒนพงษ์ จินะกาศ', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(89, 25);
$pdf->Cell(30, 7, 'อายุ:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(119, 25);
$pdf->Cell(50, 7, ' .....................ปี', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(89, 32);
$pdf->Cell(30, 7, 'เลขประจำตัว:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(119, 32);
$pdf->Cell(50, 7, ' 65-999999', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(70, 45);
$pdf->Cell(35, 7, 'เลขบัตรประชาชน', 1, 1, 'R');

$pdf->Code39(110,45,'1509999999999',1,10);


$pdf->SetXY(9, 70);
$pdf->SetFont('THSarabun','',18);
$pdf->Cell(60, 7, 'รายการ X-Ray', 1, 1, 'L');

$pdf->SetXY(9, 77);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(60, 7, 'การตรวจเอกซเรย์ปอด', 1, 1, 'L');
$pdf->Cell(60, 7, '(Chest X-ray : CXR)', 1, 1, 'L');

$pdf->SetXY(9, 105);
$pdf->Cell(60, 7, 'ผู้ตรวจ.................................', 1, 1, 'L');



$pdf->Output();
exit;

$sql = "SELECT * FROM opcardchk WHERE part = '$company' ";
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {
    // dump($a);
    # code...
}