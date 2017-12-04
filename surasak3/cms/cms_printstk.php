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

if(substr($_POST['date1'],0,5)!='.....'){

$date1=displaydate($_POST['date1']);
}else{
$date1=$_POST['date1'];	
}
if(substr($_POST['date2'],0,5)!='.....'){
$date2=displaydate($_POST['date2']);
}else{
$date2=$_POST['date2'];	
}

$ll = "L";

$pdf = new FPDF($ll,'mm',array(55,30));

//$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
//$pdf->SetTopMargin(2); // กำหนดค่า กั้นหน้าด้านบน
$pdf->AddPage();
//$pdf->SetFont('AngsanaNew','',14);

$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,6,"หน่วยงาน :".$_POST['ward']."",0,0);
$pdf->Ln();

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',18);

$pdf->Cell(0,5,"".$_POST['detail']."",0,0,'C');
$pdf->Ln();

$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,5,"ผลิต :".$date1."",0,0);
$pdf->Ln();

$pdf->AddFont('THSarabun','b','THSarabun Bold.php');
$pdf->SetFont('THSarabun','b',18);
$pdf->Cell(0,5,"หมดอายุ :".$date2."",0,0);//displaydate($_POST['date2'])
$pdf->Ln();

$pdf->AddFont('THSarabun','','THSarabun.php');//ธรรมดา
$pdf->SetFont('THSarabun','',14);
$pdf->Cell(0,5,"เครื่องทำลายเชื้อที่ :".$_POST['num1']." รอบที่ :".$_POST['num2']."",0,0);
$pdf->Ln();

/*
$pdf->Cell(0,5," ".$_POST['note']."",0,0);
$pdf->Ln();
*/

$pdf->Output();

?>