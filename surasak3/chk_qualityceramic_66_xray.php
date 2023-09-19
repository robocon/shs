<?php
require 'bootstrap.php';
require_once 'fpdf_thai/shspdf.php';

function toUTF($txt){
    return iconv('UTF8', 'TIS620', $txt);
}

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");
// $id = $_REQUEST['id'];

$q = $dbi->query("SELECT `name`,`code`,`date_checkup` FROM `chk_company_list` WHERE `id` = '379' AND id='380' ");
$item = $q->fetch_assoc();
$company = $item['code'];
// $companyName = $item['name'];
$companyName = 'บริษัท ควอลิตี้เซรามิก จำกัด';
$date_checkup = $item['date_checkup'];

$pdf = new SHSPdf('L', 'mm', 'A5');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
// $pdf->SetFont('THSarabun','',18); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(9, 11, 9);

$sql = "SELECT * FROM opcardchk WHERE part='บริษัท ควอลิตี้เซรามิก จำกัด 66 Day 1' AND part='บริษัท ควอลิตี้เซรามิก จำกัด 66 Day 2' ORDER BY `row` ASC ";
$q = $dbi->query($sql);

$number = 1;
while ($a = $q->fetch_assoc()) {

$pdf->AddPage();

// $pdf->SetXY(9, 1);
// $pdf->Cell(0, 7, 'test', 1, 1, 'C');

$pdf->SetXY(30, 11);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(60, 7, 'Fort Surasakmontri Hospital', 0, 1, 'L');
$pdf->SetXY(30, 18);
$pdf->SetFont('THSarabun','',18);
$pdf->Cell(60, 7, 'แผนกรังสีวิทยา', 0, 1, 'L');
$pdf->SetXY(30, 25);
$pdf->Cell(60, 7, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'L');
$pdf->SetXY(30, 32);
$pdf->Cell(60, 7, 'โทร.053-839305', 0, 1, 'L');


// $datechkup = $a['datechkup'];
// if(empty($date_checkup)){
//     $datechkup = '.................................';
// }
// if(strstr('วันที่', $date_checkup)){
//     $datechkup = trim(str_replace('วันที่', '', $date_checkup));
// }

$hn_match = preg_match('/-/', $a['HN'], $matchs);

$txtNumber = sprintf('%03d', $number);
if($company==='ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 (1)66' OR $company==='ศูนย์ฝึกอบรมตำรวจภูธร ภาค 5 (2)66'){
    $txtNumber = (int) substr($a['HN'], 2);
}

$pdf->SetFont('THSarabun','B',32);
// $number = substr($a['HN'], -3);
$pdf->SetXY(160, 4);
$pdf->Cell(30, 7, $txtNumber, 0, 1, 'R');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 11);
$pdf->Cell(30, 7, 'วันที่:', 0, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 11);
$pdf->Cell(50, 7, ' '.toUTF($date_checkup), 0, 1, 'L');

$fullName = $a['name'].' '.$a['surname'];
$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 18);
$pdf->Cell(30, 7, 'ชื่อ-สกุล:', 0, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 18);
$pdf->Cell(50, 7, ' '.toUTF($fullName), 0, 1, 'L');

$agey = ' .....................ปี';
if(!empty($a['agey'])){
    $agey = ' '.$a['agey'].'ปี';
}
$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 25);
$pdf->Cell(30, 7, 'อายุ:', 0, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 25);
$pdf->Cell(50, 7, $agey, 0, 1, 'L');

$pdf->SetFont('THSarabun','',18);
$pdf->SetXY(90, 32);
$pdf->Cell(30, 7, 'เลขประจำตัว:', 0, 1, 'R');
$pdf->SetFont('THSarabun','B',18);
$pdf->SetXY(120, 32);
$pdf->Cell(50, 7, ' '.$a['HN'], 0, 1, 'L');

$pdf->SetXY(9, 42);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(0, 7, ' '.toUTF($companyName), 0, 1, 'L');



$pdf->SetFont('THSarabun','',18);
// $pdf->SetXY(70, 53);
// $pdf->Cell(35, 7, 'เลขบัตรประชาชน', 0, 1, 'R');

$pdf->Code128(110,53, $a['HN'],80,15);
$pdf->SetXY(110, 67);
$pdf->Write(7, $a['HN']);

$pdf->Image('images/LogoFSH.jpg', 9, 11, 20);

$pdf->SetXY(9, 70);
$pdf->SetFont('THSarabun','',18);
$pdf->Cell(60, 7, 'รายการ X-Ray', 0, 1, 'L');

$pdf->SetXY(9, 77);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(60, 7, 'การตรวจเอกซเรย์ปอด', 0, 1, 'L');
$pdf->Cell(60, 7, '(Chest X-Ray : CXR)', 0, 1, 'L');

$pdf->SetXY(9, 105);
$pdf->Cell(0, 7, 'ผู้ตรวจ................................. วันที่................................. เวลา.................................', 0, 1, 'C');


$pdf->SetXY(89, 77);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(40, 7, 'เวลา X-Ray', 0, 1, 'R');
$pdf->SetXY(129, 77);
$pdf->Cell(40, 7, '.................................น.', 0, 1, 'L');


$pdf->SetXY(89, 84);
$pdf->SetFont('THSarabun','B',18);
$pdf->Cell(40, 7, 'เจ้าหน้าที่ X-Ray', 0, 1, 'R');
$pdf->SetXY(129, 84);
$pdf->Cell(0, 7, '.................................', 0, 1, 'L');

$number++;
}

$pdf->Output();
exit;