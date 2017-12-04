<?php

require("fpdf/fpdf.php");

require("fpdf/pdf.php");



$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));

$pdf->SetThaiFont2();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(2); // กำหนดค่า กั้นหน้าด้านบน
$pdf->AddPage();
$pdf->SetFont('THSarabun','',14);


$pdf->Cell(0,6,"หน่วยงาน ".$_POST['ward']."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"ชื่ออุปกรณ์  ".$_POST['detail']."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"วันที่ผลิต ".$_POST['date1']."  วันหมดอายุ  ".$_POST['date2']."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"เครื่องทำลายเชื้อที่  : ".$_POST['num1']." รอบที่ ".$_POST['num2']."",0,0);
$pdf->Ln();



$pdf->Output();

?>