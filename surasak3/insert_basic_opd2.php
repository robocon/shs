<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
session_start();


$month["01"] ="มกราคม";
$month["02"] ="กุมภาพันธ์";
$month["03"] ="มีนาคม";
$month["04"] ="เมษายน";
$month["05"] ="พฤษภาคม";
$month["06"] ="มิถุนายน";
$month["07"] ="กรกฎาคม";
$month["08"] ="สิงหาคม";
$month["09"] ="กันยายน";
$month["10"] ="ตุลาคม";
$month["11"] ="พฤศจิกายน";
$month["12"] ="ธันวาคม";

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
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

include 'connect.inc'; 

$sql = "Select thidate, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){
	$cigarette='ไม่สูบ';
}else if($cigarette==1){
	$cigarette='สูบ';
}else{
	$cigarette='เคยสูบ';
}

if($alcohol==0){
	$alcohol='ไม่ดื่ม';
}else if($alcohol==1){
	$alcohol='ดื่ม';
}else{
	$alcohol='เคยดื่ม';
}

if($drugreact == 0){
	$congenital_disease .=" , ผู้ป่วยไม่แพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$congenital_disease .= " , แพ้ยา : ".$list_drug;
}

$ht = $height/100;
$bmi = number_format($weight /($ht*$ht),2);
$sql111 = "Select dbirth From opcard where hn='".$hn."' ";
$result111 = Mysql_Query($sql111);
list($dbirth) = Mysql_fetch_row($result111);

$cAge = calcage($dbirth);

require('fpdf_thai/fpdf_thai.php');

$pdf=new FPDF('L','mm',array( 80,50 ));
$pdf->AddFont('AngsanaNew','','angsa.php');
$pdf->AddFont('AngsanaNew','B','angsab.php');
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',14);
$pdf->Cell(0,5,"HN : $hn $thidate $cAge",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"T : $temperature C, P : $pause ครั้ง/นาที , R : $rate ครั้ง/นาที",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"BP : $bp1 / $bp2 mmHg, นน : $weight กก., สส : $height ซม.",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"บุหรี่ : $cigarette, สุรา : $alcohol, bmi : $bmi, PS : $painscore",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"ลักษณะ : $type, คลินิก : ".substr($clinic,3),0,0);
$pdf->Ln();
$pdf->Cell(0,5,"โรคประจำตัว : $congenital_disease",0,0);
$pdf->Ln();
$pdf->Cell(0,5,"อาการ : $organ",0,"L");

$pdf->Output();