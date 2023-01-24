<?php 
include_once 'bootstrap.php';
include 'fpdf_thai/shspdf.php';


$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$other = sprintf("%d", $_REQUEST['other']);

$drug_ids = $_REQUEST['drug_id'];
foreach ($drug_ids as $key => $d) {
    
    $q = $dbi->query(" SELECT a.*, b.`tradname`
    FROM ( 
        SELECT `row_id` AS `id`,`slcode`,`drugcode`,`amount` FROM `drugrx` WHERE `row_id` = '$d' 
    ) AS a 
    LEFT JOIN `druglst` AS b ON b.`drugcode` = a.`drugcode`");

    // $di = $q->fetch_assoc();
    // dump($di);

}


// A4 ยาวทั้งหมด 210mm สูง 297mm
$pdf = new SHSPdf('P', 'mm', 'A4');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetMargins(0,0); // left, top, right
$pdf->AddPage();
$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$pdf->setY(4);
$t = $pdf->conv('Medication Reconciliation Form [ใบ M.R.]');
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(0, 7.5, $t, 1, 1, 'L',true);
$pdf->SetFillColor(184,184,184);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(0, 7.5, $pdf->conv('โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง'), 1, 1, 'L',true);

$pdf->Output();