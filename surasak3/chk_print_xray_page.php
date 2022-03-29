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

$pdf->SetXY(30, 11);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(60, 7, 'Fort Surasakmontri Hospital', 1, 1, 'L');
$pdf->SetXY(30, 18);
$pdf->SetFont('THSarabun','',18);
$pdf->Cell(60, 7, 'แผนกรังสีวิทยา', 1, 1, 'L');
$pdf->SetXY(30, 25);
$pdf->Cell(60, 7, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 1, 1, 'L');
$pdf->SetXY(30, 32);
$pdf->Cell(60, 7, 'โทร.053-839305', 1, 1, 'L');


$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 11);
$pdf->Cell(30, 7, 'วันที่:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 11);
$pdf->Cell(50, 7, ' 23 มี.ค. 65', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 18);
$pdf->Cell(30, 7, 'ชื่อ-สกุล:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 18);
$pdf->Cell(50, 7, ' พลฯ วัฒนพงษ์ จินะกาศ', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 25);
$pdf->Cell(30, 7, 'อายุ:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 25);
$pdf->Cell(50, 7, ' .....................ปี', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 32);
$pdf->Cell(30, 7, 'เลขประจำตัว:', 1, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 32);
$pdf->Cell(50, 7, ' 65-999999', 1, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(70, 45);
$pdf->Cell(35, 7, 'เลขบัตรประชาชน', 1, 1, 'R');

// $pdf->Code39(110,45,'1509999999999',1,10);
$pdf->Code128(110,45,'1509999999999',80,15);
$pdf->SetXY(110, 60);
$pdf->Write(7,'1509999999999');

$pdf->Image('images/LogoFSH.jpg',9,11,20);
// $pdf->Image('barcode/html/image.php?filetype=PNG&dpi=72&scale=1&rotation=0&font_family=Arial.ttf&font_size=8&text=1509900000999&thickness=30&start=NULL&code=BCGcode128',10,6,30);
// $pdf->Image('http://chart.googleapis.com/chart?cht=p3&chd=t:60,40&chs=250x100&chl=Hello|World',60,30,90,0,'PNG');


$pdf->SetXY(9, 70);
$pdf->SetFont('THSarabun','',18);
$pdf->Cell(60, 7, 'รายการ X-Ray', 1, 1, 'L');

$pdf->SetXY(9, 77);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(60, 7, 'การตรวจเอกซเรย์ปอด', 1, 1, 'L');
$pdf->Cell(60, 7, '(Chest X-Ray : CXR)', 1, 1, 'L');

$pdf->SetXY(9, 105);
$pdf->Cell(0, 7, 'ผู้ตรวจ................................. วันที่.......................... เวลา.........................', 1, 1, 'C');


$pdf->SetXY(89, 70);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(40, 7, 'เวลา X-Ray', 1, 1, 'R');
$pdf->SetXY(129, 70);
$pdf->Cell(40, 7, '................น.', 1, 1, 'L');


$pdf->SetXY(89, 84);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(40, 7, 'เจ้าหน้าที่ X-Ray', 1, 1, 'R');
$pdf->SetXY(129, 84);
$pdf->Cell(0, 7, '.................................', 1, 1, 'L');

$pdf->Output();
exit;

$sql = "SELECT * FROM opcardchk WHERE part = '$company' ";
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) {
    // dump($a);
    # code...
}