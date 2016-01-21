<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

$sql = "Select date_format(thidate,'%d-%m-%Y %H:%i:%s'), hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic ,age  From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic,$age) = Mysql_fetch_row($result_dt_hn);


		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 
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

?>