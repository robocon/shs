<?php

require("fpdf/fpdf.php");

require("fpdf/pdf.php");



$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));

$pdf->SetThaiFont2();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(2); // ��˹���� ���˹�Ҵ�ҹ��
$pdf->AddPage();
$pdf->SetFont('THSarabun','',14);


$pdf->Cell(0,6,"˹��§ҹ ".$_POST['ward']."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"�����ػ�ó�  ".$_POST['detail']."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"�ѹ����Ե ".$_POST['date1']."  �ѹ�������  ".$_POST['date2']."",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"����ͧ��������ͷ��  : ".$_POST['num1']." �ͺ��� ".$_POST['num2']."",0,0);
$pdf->Ln();



$pdf->Output();

?>