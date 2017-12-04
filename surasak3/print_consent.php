<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี";
	}

return $pAge;
}

$d = date("d");
$m = date("m");
$y = date("Y")+543;

if($_GET["hn"] != ""){
$sql = "Select concat(yot,' ',name,' ',surname) fullname, dbirth From opcard where hn = '".$_GET["hn"]."' limit 1";
list($fullname, $dbirth) = Mysql_fetch_row(Mysql_Query($sql));

$age = calcage($dbirth);
}else{

$fullname = "                                ";
$age = "                         ";
$_GET["hn"] = "                  ";
}
include("unconnect.php");

if(isset($_GET["land"])){
	$ll = "L";
}else{
	$ll = "P";
}

$pdf = new PDF($ll,'mm',array( 80,50 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);


$pdf->AddPage();

$pdf->SetFont('AngsanaNew', '', 12);

if($_GET["pt"] =="ผู้ป่วย"){
	$pdf->Cell(0,5,$fullname." ,HN ".$_GET["hn"]." ,อายุ ".$age,0,0);
}else{
	$pdf->Cell(0,5,"ข้าพเจ้า( ".$_GET["pt_val"]." ) ".$fullname." ,HN ".$_GET["hn"]." ,อายุ ".$age,0,0);
}
$pdf->Ln();
if($_GET["permit"] == "ยินยอม"){
$pdf->Cell(13,5,"ยินยอมทำ",0,0);
$pdf->Cell(0,5," ".$_GET["list_lab"][0]." ",B,0);
$pdf->Ln();

if(isset($_GET["list_lab"][2])){
	$_GET["list_lab"][1] .= ", ".$_GET["list_lab"][2];
}

if(isset($_GET["list_lab"][3])){
	$_GET["list_lab"][1] .= ", ".$_GET["list_lab"][3];
}

if(isset($_GET["list_lab"][4])){
	$_GET["list_lab"][1] .= ", ".$_GET["list_lab"][4];
}

	$pdf->Cell(0,5," ".$_GET["list_lab"][1]." ",B,0);
}else if($_GET["permit"] == "ไม่ยินยอม"){
	$pdf->Cell(0,5,"ไม่ยินยอมรับการรักษา",0,0);
}else{
	$pdf->Cell(0,5,"ผู้ป่วยไม่รู้สึกตัวและมีความจำเป็นต้องรักษาในขั้นด่วน",0,0);
}


$pdf->Ln();
$pdf->SetFont('AngsanaNew', '', 11);
if($_GET["pt"] !="ผู้ป่วย"){
	$pdf->Cell(0,6," ข้าพเจ้าได้รับคำอธิบายจนเข้าใจตลอดแล้ว จึงลงลายมือชื่อไว้เป็นหลักฐาน",0,0);
}else{
	$pdf->Cell(0,6," ",0,0);
}
$pdf->SetFont('AngsanaNew', '', 12);
$pdf->Ln();

$pdf->Cell(5,5,"",0,0);

if($_GET["witness_pt"] == "ผู้ป่วยมาคนเดียว" && $_GET["permit"] =="ผู้ป่วยไม่รู้สึกตัวและมีความจำเป็นต้องรักษาในขั้นด่วน"){
	$pdf->Cell(24,5,"",0,0);
}else{
	$pdf->Cell(8,5,$_GET["pt"],0,0);

	if($_GET["pt"] == "ผู้แทน"){
	$pdf->Cell(14,5,"",B,0);
	$pdf->Cell(6,5,"( ".$_GET["pt_val"]." )",0,0);
	$pdf->Cell(11,5,"" ,0,0);
	}else{
	$pdf->Cell(16,5,"",B,0);
	$pdf->Cell(15,5,"                          " ,0,0);
	}

	if($_GET["pt"] == "ผู้ป่วย" && $_GET["hn"] != ""){
		$xxx = $fullname;
	}else if($_GET["pt"] == "ผู้แทน" && $_GET["witness_pt"] != ""){
		$xxx = $_GET["witness_pt"];
	}else{
		$xxx ="                         ";
	}
}

$pdf->Cell(9,5,"แพทย์",0,0);
$pdf->Cell(15,5,"                           ",B,0);
$pdf->Ln();

$pdf->Cell(8,5,"",0,0);
if($_GET["witness_pt"] != "ผู้ป่วยมาคนเดียว" && $_GET["permit"] =="ผู้ป่วยไม่รู้สึกตัวและมีความจำเป็นต้องรักษาในขั้นด่วน"){
	$pdf->Cell(15,5,"fes",0,0);
}else{
	$pdf->Cell(15,5,"($xxx)",0,0);
}	
$pdf->Cell(22,5,"                          ",0,0);
$pdf->Cell(8,5,"(".$_GET["doctor"].")",0,0);

$pdf->Ln();

$pdf->Cell(5,5,"",0,0);
if($_GET["witness_pt"] == "ผู้ป่วยมาคนเดียว"){
	$pdf->Cell(7,5,"",0,0);
	$pdf->Cell(14,5,"ผู้ป่วยมาคนเดียว",0,0);
	$pdf->Cell(7,5,"",0,0);
}else if($_GET["pt"] == "ผู้แทน" ){
	$pdf->Cell(6,5,"",0,0);
	$pdf->Cell(14,5,date("d/m/").(date("Y")+543),0,0);
	$pdf->Cell(10,5,"",0,0);
	
}else{
	$pdf->Cell(14,5,"พยานผู้ป่วย",0,0);
	$pdf->Cell(15,5,"",B,0);
}
$pdf->Cell(8,5,"                          ",0,0);
$pdf->Cell(15,5,"พยานแพทย์",0,0);
$pdf->Cell(15,5,"                           ",B,0);
$pdf->Ln();

$pdf->Cell(11,5,"",0,0);
if($_GET["witness_pt"] == "ผู้ป่วยมาคนเดียว" || $_GET["pt"] == "ผู้แทน"){
$pdf->Cell(15,5,"",0,0);
}else{
	$pdf->Cell(15,5,"(".$_GET["witness_pt"].")",0,0);
}
$pdf->Cell(22,5,"                          ",0,0);
$pdf->Cell(8,5,"(".$_GET["witness_dc"].")",0,0);

$pdf->Ln();

$pdf->Cell(14,5,"",0,0);
if($_GET["pt"] == "ผู้แทน" ){
	$pdf->Cell(15,5,"",0,0);
}else{
	$pdf->Cell(15,5,date("d/m/").(date("Y")+543),0,0);
}
$pdf->Cell(22,5,"                          ",0,0);
$pdf->Cell(8,5,date("d/m/").(date("Y")+543),0,0);

$pdf->Ln();

$pdf->Output();