<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");




$ll = "P";

$pdf = new PDF($ll,'mm',array( 80,50 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);


$pdf->AddPage();

$pdf->SetFont('AngsanaNew', '', 12);

$pdf->Cell(0,3,"  ",0,0);
$pdf->Ln();

$line1 = "  ������____________________________________________________________________";
$line2 = "  �ѹ-���ҷ���Դ�Ǵ__________________________________________________________";
$line3 = "  �ѹ-���ҷ���������__________________________________________________________";

$pdf->Cell(8,6,$line1,0,0);

$pdf->Ln();

$pdf->Cell(18,6,$line2,0,0);

$pdf->Ln();

$pdf->Cell(18,6,$line3,0,0);

$pdf->Ln();

$pdf->Cell(0,3,"  ",B,0);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(8,6,$line1,0,0);

$pdf->Ln();

$pdf->Cell(18,6,$line2,0,0);

$pdf->Ln();

$pdf->Cell(18,6,$line3,0,0);


$pdf->Output();
?>