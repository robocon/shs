<?php

require("fpdf.php");

//require("../fpdf/pdf.php");

function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];//+543
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}

$date1=displaydate($_POST['date1']);
$date2=displaydate($_POST['date2']);


$ll = "P";

$pdf = new FPDF('L','mm',array(55,30));
//$pdf = new FPDF('P','mm',array(55,30 ));

//$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(0); // ��˹���� ���˹�Ҵ�ҹ��
$pdf->AddPage();
//$pdf->SetFont('AngsanaNew','',14);

$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,6,"˹��§ҹ :".$_POST['ward']."",0,0);
$pdf->Ln();

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);

$pdf->Cell(0,6,"".$_POST['detail']."",0,0,'C');
$pdf->Ln();

$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,5,"��Ե :".$_POST['date1']."",0,0);
$pdf->Ln();

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',20);
$pdf->Cell(0,6,"������� :".$_POST['date2']."",0,0);//displaydate($_POST['date2'])
$pdf->Ln();

$pdf->AddFont('THSarabun','','THSarabun.php');//������
$pdf->SetFont('THSarabun','',16);
$pdf->Cell(0,6,"����ͧ��������ͷ�� : ".$_POST['num1']." �ͺ��� :".$_POST['num2']."",0,0);
$pdf->Ln();

/*
$pdf->Cell(0,5," ".$_POST['note']."",0,0);
$pdf->Ln();
*/

$pdf->Output();

?>