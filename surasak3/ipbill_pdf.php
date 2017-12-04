<?php
@session_start();
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);
	$time=date("H:i:s");



$ll = "P";


$pdf = new PDF($ll,'mm',array( 210,330 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',10);
$header=array('','','','','','','');


$pdf->Cell(0,8,"หอผู้ป่วยรวม ",0,0,'C');
$pdf->Ln();
$pdf->Cell(0,8,"".$Thaidate."",0,0);
$pdf->Ln();

$pdf->SetFont('AngsanaNew','',10);
$pdf->Cell(0,8,"Lab: ",0);
$pdf->Ln();

$pdf->Output();


//	}
?>
