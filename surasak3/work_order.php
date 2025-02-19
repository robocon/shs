<?php
require_once dirname(__FILE__).'/fpdf_thai/shspdf.php';

$pdf = new SHSPdf('P', 'mm', 'A4');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(0,0,0);
$pdf->AddPage();

// ตั้งความสูงที่ 299 เพื่อให้มันล้นจากขอบที่แสกนมานิดหน่อย ถ้าตั้งตามปกติ 297 จะมีขอบขาวๆด้านล่าง
$pdf->Image('images/work_order/work_order1.jpg',0,0,210,299,'JPG');
$pdf->AddPage();
$pdf->Image('images/work_order/work_order2.jpg',0,0,210,299,'JPG');
$pdf->AddPage();
$pdf->Image('images/work_order/work_order3.jpg',0,0,210,299,'JPG');

$pdf->AutoPrint(true);
$pdf->Output();