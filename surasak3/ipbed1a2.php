<?php
ob_start();
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);

$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(2); // ��˹���� ���˹�Ҵ�ҹ��
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',14);


$exName = '';

// �������Ward������ֻ���
$wardExTest = preg_match('/45.+/', $cbedcode);
if( $wardExTest > 0 ){
	
	// ������繪��3 ���������繪��2
	$wardEx2Test = preg_match('/R3\d+/', $cbedcode);
	$exName = ( $wardEx2Test > 0 ) ? '���3' : '���2' ;
	
}

$pdf->Cell(0,6,$cbedname.$exName."/".$cBed1." AN :".$can,0,0);
$pdf->Ln();
$pdf->Cell(0,5,$cptname,0,0);
$pdf->Ln();
$pdf->Cell(0,5,"�ä : ".$cdiagnos,0,0);
$pdf->Ln();
$pdf->Cell(0,5,"ᾷ�� : ".$cdoctor,0,0);
//$pdf->MultiCell(0,6,"S : ".$organ,0,"L");


/*if($drugreact == 0){
	$congenital_disease .=" , �������������";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$congenital_disease .= " , ���� : ".$list_drug;
}*/


//$pdf->Cell(0,5,"B : ".$congenital_disease,0,0);

$pdf->Output();

?>