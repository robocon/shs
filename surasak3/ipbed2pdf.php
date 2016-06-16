<?php
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';
$an = input_get('cAn');
$cbedname = input_get('cbedname');


$db = Mysql::load();
$sql = "SELECT `hn`,`an`,`ptname`,`age`,`ptright`,`bedcode`,`doctor`,`bed`,`diagnos` 
FROM `bed` 
WHERE `an` = :an ";
$data = array(
    ':an' => $an
);
$db->select($sql, $data);
$item = $db->get_item();

$pdf = new SHSPdf('L', 'mm', array(82, 35));

$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(2, 2); // left, top, right
$pdf->AddPage();
$pdf->SetFont('THSarabun','',16); // เรียกใช้งานฟอนต์ที่เตรียมไว้

// $pdf->Rect(0, 0, 84, 37);
$pdf->Cell(0, 5, $cbedname.'  '.$item['bed'], 0, 1);
$pdf->Cell(0, 5, 'AN: '.$item['an'].' HN: '.$item['hn'], 0, 1);
$pdf->Cell(0, 5, $item['ptname'].' อายุ '.$item['age'], 0, 1);
$pdf->Cell(0, 5, 'โรค: '.$item['diagnos'], 0, 1);
$pdf->Cell(0, 5, 'สิทธิ: '.$item['ptright'], 0, 1);
$pdf->Cell(0, 5, 'แพทย์: '.$item['doctor'], 0, 1);

$pdf->AutoPrint(true);
$pdf->Output();