<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);

$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();
$pdf->SetFont('AngsanaNew','',13);
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();

$exName = '';

// �������Ward������ֻ���
$wardExTest = preg_match('/45.+/', $cbedcode);
if( $wardExTest > 0 ){
	//
	// ������繪��3 ���������繪��2
	$wardR3Test = preg_match('/R3\d+|B\d+/', $cBed1);
	$wardBxTest = preg_match('/B[0-9]+/', $cBed1);
	$exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
	
}

$full_text = $cbedname.$exName."/$cBed1 AN: $can HN: $chn\n";
$full_text .= "$cptname ����: $cage";
$full_text .= "����: $cage\n";
$full_text .= "�ä: $cdiagnos\n";
$full_text .= "�Է��: $cptright\n";
$full_text .= "ᾷ��: $cdoctor\n";

$pdf->SetXY(0, 1);
$pdf->MultiCell(0, 4, $full_text);
$pdf->Output();

?>