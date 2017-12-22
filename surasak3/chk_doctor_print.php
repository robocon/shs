<?php
include 'bootstrap.php';

$db = Mysql::load();

include 'fpdf_thai/shspdf.php';

$pdf = new SHSPdf();
$pdf->SetThaiFont(); // à«çµ¿Í¹µì
$pdf->SetFont('THSarabun','',14); // àÃÕÂ¡ãªé§Ò¹¿Í¹µì·ÕèàµÃÕÂÁäÇé
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);
$pdf->AddPage('L', array( 80, 35));



$pdf->Cell(23, 5, 'test sticker', 0, 1);


$pdf->AddPage('P', 'A4');
$pdf->Cell(23, 5, 'test a4', 0, 1);

$pdf->AutoPrint(true);
$pdf->Output();