<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

$cbedname = $_GET['cbedname'];
if( $cbedname == '���' ){
	$cbedname = '����á���';
}

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);

$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();

// Default ��Ҵ���˹ѧ��ͨ� 14
$text_size = 14;

// ����������ͻ�Ѫ���ͨ������µ�ͧ��Ѻ�������͵��˹ѧ���13
$drCode = substr($cdoctor, 0, 5);
if( $drCode == 'MD089' ){
	$text_size = 13;
}

$exName = '';

// �������Ward������ֻ���
$wardExTest = preg_match('/45.+/', $cbedcode);
if( $wardExTest > 0 ){
	//
	// ������繪��3 ���������繪��2
	$wardR3Test = preg_match('/R3\d+|B\d+/', $cBed1);
	$wardBxTest = preg_match('/B[0-9]+/', $cBed1);
	$exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;

	// ੾�� ward ����ɷ����˹ѧ��� 11
	$text_size = 13;
	
}

$pdf->SetFont('AngsanaNew','',$text_size);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();

$full_text = $cbedname.$exName."/$cBed1 ����:$cage\n";
$full_text .= "AN:$can HN:$chn\n";
$full_text .= "$cptname\n";
$full_text .= "�ä:$cdiagnos\n";
$full_text .= "�Է��:$cptright\n";
$full_text .= "ᾷ��:$cdoctor\n";

$pdf->SetXY(0, 1);
$pdf->MultiCell(0, 4, $full_text);
$pdf->Output();

?>