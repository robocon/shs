<?php

require("fpdf_thai/fpdf_thai.php");
include("connect.php");

class PDF extends FPDF_Thai{}

function calcage($birth){

	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM <0 ) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ��";
	}else{
		$pAge = "$ageY �� $ageM ��͹";
	}

	return $pAge;
}

$sql = "Select thidate, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age) = Mysql_fetch_row($result_dt_hn);


$ht = $height/100;
$bmi=number_format($weight /($ht*$ht),2);

if( empty($painscore) ){
	$painscore = '-';
}

$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){
	$cigarette='����ٺ';
}else if($cigarette==1){
	$cigarette='�ٺ';
}else{
	$cigarette='���ٺ';
}

if($alcohol==0){
	$alcohol='������';
}else if($alcohol==1){
	$alcohol='����';
}else{
	$alcohol='�´���';
}

if($drugreact == 0){
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
}

if( empty($weight) ){
	$weight = 0;
}
if( empty($height) ){
	$height = 0;
	$ht = 0;
}else{
	$ht = $height/100;
}

$bmi = number_format(($weight / ( $ht * $ht)), 2);

$sql111 = "Select dbirth From opcard where hn='$hn' ";
$result111 = Mysql_Query($sql111);
list($dbirth) = Mysql_fetch_row($result111);
$cAge = calcage($dbirth);


$pdf = new PDF("L", 'mm', array( 50, 80));

// $pdf->AddFont('THSarabunPSK', '', 'THSarabun.php');
// $pdf->SetFont('THSarabunPSK', '', 14);
$pdf->AddFont('AngsanaNew', '', 'angsa.php');
$pdf->SetFont('AngsanaNew', '', 14);


$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);
// $pdf->SetLineWidth(80);
$pdf->AddPage();

$pdf->Cell(0, 6, "HN: $hn, $thidate, $cAge");
$pdf->Ln();
$pdf->Cell(0, 6, "T: $temperature C, P: $pause ����/�ҷ�, R: $rate ����/�ҷ�");
$pdf->Ln();
$pdf->Cell(0, 6, "BP: $bp1 / $bp2 mmHg, ��: $weight ��., ��: $height ��.");
$pdf->Ln();
$pdf->Cell(0, 6, "������: $cigarette, ����: $alcohol, bmi: $bmi, PS: $painscore");
$pdf->Ln();
$pdf->Cell(0, 6, "�ѡɳ�: $type, ��Թԡ: ".(substr($clinic,3)));
$pdf->Ln();
$pdf->Cell(0, 6, "�ä��Шӵ��: ".trim($congenital_disease));
$pdf->Ln();
$pdf->MultiCell(0, 6, "�ҡ��: ".trim($organ));
$pdf->Ln();

$pdf->Output();

/*
$ll = "P";
$pdf = new PDF($ll,'mm',array( 80,50 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',14);

$pdf->Cell(0,6,"HN : ".$hn."  ".$thidate,0,0);
$pdf->Ln();
$pdf->Cell(0,6,"T : ".$temperature." C, P : ".$pause." ����/�ҷ� , R : ".$rate." ����/�ҷ�",0,0);
$pdf->Ln();
$pdf->Cell(0,6,"BP : ".$bp1." / ".$bp2." mmHg, �� : ".$weight." ��., ��ǹ�٧ : ".$height." ��.",0,0);
$pdf->Ln();
$pdf->Cell(0,6,"�ѡɳ� : ".$type." , ��Թԡ : ".substr($clinic,3).", ".$age.", BMI :".$bmi,0,0);
$pdf->Ln();
$pdf->MultiCell(0,6,"S : ".$organ,0,"L");


if($drugreact == 0){
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
}


$pdf->Cell(0,5,"B : ".$congenital_disease,0,0);


$pdf->Output();
*/
?>