<?php 
include("connect.php");

$hn=$_POST["hn"];
if (empty($hn)) {
	echo "กรุณาใส่ HN";
	exit;
}

require("fpdf/fpdf.php");
require("fpdf/pdf.php");

Function calcage($birth){

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
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$sql = "SELECT hn,concat(yot,name,' ',surname) as ptname,ptright,dbirth  FROM opcard  WHERE hn = '$hn' ";
$result_dt_hn =mysql_query($sql);
$arr = mysql_fetch_array($result_dt_hn);
$age=calcage($arr['dbirth']);

list($width,$height) = explode('x', $_POST['paper_size']);

if(!empty($_POST['paper_width']))
{
	$width = $_POST['paper_width'];
}

if(!empty($_POST['paper_height']))
{
	$height = $_POST['paper_height'];
}

// 55,30
$pdf = new PDF("P",'mm',array( $width,$height ));
$pdf->SetThaiFont();

$pdf->SetAutoPageBreak(true,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(0); // กำหนดค่า กั้นหน้าด้านบน

//for($i=0;$i<count($_POST["drugprint"]);$i++){
	
$pdf->AddPage();


// $pdf->SetFont('AngsanaNew','',16);
$pdf->SetFont('THSarabun','',14);

$copy = $_POST['copy'];
for ($i=0; $i < $copy; $i++) { 
		
	$pdf->Cell(0,8,"ชื่อ-สกุล : ".$arr['ptname']."",0,0);
	$pdf->Ln();
	$pdf->Cell(0,8,"อายุ : ".$age."",0,0);
	$pdf->Ln();
	$pdf->Cell(0,8,"สิทธิ : ".$arr['ptright']."",0,0);
	$pdf->Ln();
	
}


//}
//$pdf->MultiCell(0,6,"S : ".$organ,0,"L");


/*if($drugreact == 0){
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
}*/


//$pdf->Cell(0,5,"B : ".$congenital_disease,0,0);

$pdf->Output();

?>