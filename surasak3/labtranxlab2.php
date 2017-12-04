<?php
session_start();

if($_SESSION["list_bill"] != ""){
	require('thaipdfclass.php');
	
	$pdf=new ThaiPDF();
	$pdf->SetThaiFont();
	$pdf->AddPage();
	$pdf->SetFont('CordiaNew','',16); 
	$list = explode("<br>",$_SESSION["list_bill"]);
	$count = count($list);

	for($i=0;$i<$count;$i++){
		$pdf->Cell(40,10,$list[$i],0,1);
	}

	$pdf->Output();
}
?> 