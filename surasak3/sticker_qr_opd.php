<?php
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

function to874($txt){
    return iconv("UTF-8", "WINDOWS-874", $txt);
}

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
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$hn = sprintf("%s", $_GET['hn']);

$sql111 = "Select dbirth,sex,goup From opcard where hn='".$hn."' ";
$q = $dbi->query($sql111);
$opcard = $q->fetch_assoc();
$dbirth = $opcard['dbirth'];
$sex = $opcard['sex'];
$goup = $opcard['goup'];
// $result111 = Mysql_Query($sql111);
// list($dbirth,$sex,$goup) = Mysql_fetch_row($result111);

$cAge=calcage($dbirth);	

$dthn=date("d-m-").(date("Y")+543).$hn;
$sql112 = "Select thidate,vn,ptname,ptright,toborow From opday where thdatehn = '".$dthn."' order by row_id desc limit 1 ";
$q = $dbi->query($sql112);
$opday = $q->fetch_assoc();

// exit;
// $result112 = Mysql_Query($sql112);
// list($thidate,$vn,$ptname,$ptright,$toborow) = Mysql_fetch_row($result112);	

$thidate = $opday['thidate'];
$vn = $opday['vn'];
$ptname = $opday['ptname'];
$ptright = $opday['ptright'];
$toborow = $opday['toborow'];

$toborow=substr($toborow,5);

$ptright=trim(substr($ptright,3));
// $ptright=trim($ptright); 

list($y,$m,$d)=explode("-",substr($thidate,0,10));
$svdate="$d/$m/$y";

if($sex=="ช"){
    $sex="เพศ ชาย";
}else if($sex=="ญ"){
    $sex="เพศ หญิง";
}else{
    $sex="ไม่ระบุเพศ";
}	

$pdf = new SHSPdf('L', 'mm', array(55, 30));

$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(1, 1); // left, top, right
$pdf->AddPage(); 
$fontSize = 12;
$pdf->SetFont('THSarabun','',$fontSize); // เรียกใช้งานฟอนต์ที่เตรียมไว้

// $pdf->Cell(0, 4.5, 'แพทย์: '.to874($item['doctor']), 0, 1);
$pdf->Image("http://192.168.131.250/sm3/surasak3/printQrCode.php?hn=$hn&level=2&size=4&margin=1",1, 1, 22, 22, 'PNG');
$pdf->SetFont('THSarabun','B',20);
$pdf->setY(23);
$pdf->Cell(22, 5, 'VN: '.to874($vn));

$pdf->SetFont('THSarabun','',$fontSize);
$pdf->setXY(22,1);
$pdf->Write(4.5, "ว/ด/ป: $svdate\n");

$pdf->SetFont('THSarabun','',18);
$pdf->setXY(22, 5);
$pdf->Write(4.5, "HN: $hn\n");

$pdf->SetFont('THSarabun','',$fontSize);
$pdf->setXY(22, 9);
$pdf->MultiCell(32, 4.5, to874($ptname)."\n",0,1);

$y = $pdf->getY();
$pdf->setXY(22, $y);
$pdf->Write(4.5, "อายุ: ".$cAge."\n");

$y = $pdf->getY();
$pdf->setXY(22, $y);
$pdf->Write(4.5, to874(trim($ptright))."\n");

$y = $pdf->getY();
$pdf->setXY(22, $y);
$pdf->Write(4.5, to874($toborow)."\n");

$pdf->AutoPrint(true);
$pdf->Output();