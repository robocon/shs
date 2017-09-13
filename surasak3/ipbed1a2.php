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

$exName = '';
$text_size = 14;

// �������Ward������ֻ���
$wardExTest = preg_match('/45.+/', $cbedcode);
if( $wardExTest > 0 ){
	
	// ������繪��3 ���������繪��2
	$wardR3Test = preg_match('/R3\d+|B\d+/', $cBed1);
	$wardBxTest = preg_match('/B[0-9]+/', $cBed1);
	$exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
	
	$text_size = 11;
}

$pdf->SetFont('AngsanaNew','',$text_size);
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();

$full_text = $cbedname.$exName."/".$cBed1." AN :".$can."\n";
$full_text .= "$cptname\n";
$full_text .= "�ä:$cdiagnos\n";
$full_text .= "ᾷ��:$cdoctor\n";

$pdf->SetXY(0, 1);
$pdf->MultiCell(0, 4, $full_text);
$pdf->Output();



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