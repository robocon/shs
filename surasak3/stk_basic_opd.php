<?php
// README! 
// พิมพ์สติกเกอร์แบบ PDF สำหรับหน้าซักประวัติที่เป็นฟอร์มกรอกข้อมูล และหน้าของ OPD แบบพิมพ์ย้อนหลัง
// require("fpdf_thai/fpdf_thai.php");
include 'fpdf_thai/shspdf.php';
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
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age 
From opd 
where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age) = Mysql_fetch_row($result_dt_hn);


$ht = $height/100;
$bmi=number_format($weight /($ht*$ht),2);

if( empty($painscore) ){
	$painscore = '-';
}

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


$pdf = new SHSPdf('L', 'mm', array( 80, 50));
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);
$pdf->AddPage();

$full_text = "HN: $hn, $thidate, $cAge\n";
$full_text .= "VN: $vn, T: $temperature C, P: $pause ครั้ง/นาที, R: $rate ครั้ง/นาที\n";
$full_text .= "BP: $bp1 / $bp2 mmHg, นน: $weight กก., สส: $height ซม.\n";
$full_text .= "บุหรี่: $cigarette, สุรา: $alcohol, bmi: $bmi, PS: $painscore\n";
$full_text .= "ลักษณะ: $type, คลินิก: ".(substr($clinic,3))."\n";
$full_text .= "โรคประจำตัว: ".trim($congenital_disease)."\n";
$full_text .= "อาการ: ".trim($organ);

$pdf->MultiCell(0, 6, $full_text);

$pdf->AutoPrint(true);
$pdf->Output();
?>