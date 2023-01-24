<?php 
include_once 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

class MedSHS extends SHSPdf
{
    function __construct($orientation='P', $unit='mm', $size='A4')
	{
		parent::__construct($orientation, $unit, $size);
    }
    function header()
    {
        $this->SetXY(0, 3);
        $this->SetFont('THSarabun','',14);
        $this->Cell(0, 6,  $this->conv('ใบที่ '.$this->PageNo()), 0, 1, 'R');
    }
}

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
$pdf = new MedSHS('P', 'mm', 'A4');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetMargins(5);
$pdf->SetAutoPageBreak(true, 0);
$pdf->AddPage();

$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$pdf->SetY(12);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(198, 7, $pdf->conv('Medication Reconciliation Form [ใบ M.R.]'), 1, 1, 'L',true);

$pdf->SetFillColor(184,184,184);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(198, 6.5, $pdf->conv('โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง'), 1, 1, 'L',true);

// กล่องที่1
$pdf->SetTextColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('THSarabun','',12);

$pdf->Rect($pdf->GetX(), $pdf->GetY(), 65, 32);
$pdf->SetY(25.5);
$pdf->Write(5, $pdf->conv('[ ] ผู้ป่วยมีประวัติยาเดิมใน ร.พ. (ส่วนที่1)'));
$pdf->SetXY(10, 30.5);
$pdf->Write(5, $pdf->conv('( ) นำยาเดิมมา วันที่_____________'));
$pdf->SetXY(10, 35.5);
$pdf->Write(5, $pdf->conv('( ) ไม่ได้นำยาเดิมมา'));


$pdf->Rect(70, 25.5, 65, 32);
$pdf->SetXY(70, 25.5);
$pdf->Write(5, $pdf->conv('[ ] ไม่มีประวัติยาเดิมใน ร.พ. (ส่วนที่ 2)'));

$pdf->Rect(135, 25.5, 68, 32);
$pdf->SetXY(135, 25.5);
$pdf->Write(5, $pdf->conv('ชื่อ:_________________อายุ:__________'));

$pdf->Output();