<?php

require("fpdf.php");
//require("fpdf/pdf.php");
 
$pdf=new FPDF( 'P' , 'cm' , 'A4' );
$pdf->SetMargins(3,1.5,2);
$pdf->AddPage();


$pdf->Image('original_Tra-Khrut.gif',3,1.5,1.5,1.5,'','');
$pdf->AddFont('THSarabun','b','THSarabun Bold.php');


$pdf->SetFont('THSarabun','b',29);
$pdf->Cell(0 ,2 , '�ѹ�֡��ͤ���'  , 0 , 1 , 'C' );

$pdf->Ln(0.1);
$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0.1,0,'��ǹ�Ҫ���');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(11,0,'�ͧ���Ѫ����    þ.��������ѡ��������',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0,0,'��� ��.0483.63.4');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0.1,0,'����ͧ');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(5,0,'��͹��ѵԨѴ������',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0.1,0,'���¹');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(6,0,'��.þ.��������ѡ��������',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'��ҧ�֧');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,0,'1. ����º�ӹѡ��¡�Ѱ����� ��Ҵ��� ��þ�ʴ� �.�.2535, ŧ 20 �.�. 2535, ��з������������',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,0,'2. ����� �� (੾��) ��� 50/50 16 ��.�. 2550 ����ͧ ��þ�ʴ�',0,0,'');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,0,'3. ����� �� (੾��) ��� 476/44 ����ͧ �ͺ�ӹҨ͹��ѵԡ���ԡ�����Թ����Ѻʶҹ��Һ��',0,0,'');
$pdf->Ln(1);


$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(1.5,0,'��觷�����Ҵ���');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(15,0,'1. ˹ѧ��ͧ͡���Ѫ���� þ.����� ���00525/55ŧ�ѹ���4 ���Ҥ� 2555',0,0,'C');
$pdf->Ln(1);

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(3.6,0,'');
$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(3,0,'2. �ѭ����������´㹡�� �Ѵ���� �ӹǹ 1 �ش',0,0,'');
$pdf->Ln(1);

$pdf->MultiCell(1,1, '1. ���ͧ���¡ͧ���Ѫ���� þ.����� �դ������繷��е�ͧ�Ѵ��������������Ҫ��� þ.�����5555555555555555555555555555555555555555',0,0,'');
$pdf->Ln(1);



/*$pdf->AddFont('THSarabun','b','THSarabun Bold.php');//˹�
$pdf->SetFont('THSarabun','b',30);
$pdf->Cell(3,1.5,'��ͤ������ͺ');
$pdf->Ln(15);*/

$pdf->Output();
?>
