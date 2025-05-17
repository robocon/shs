<?php
include 'fpdf_thai/fpdf_thai.php';
include 'includes/connect.php';
// For testing direct to this file 
// http://192.168.131.250/sm3/surasak3/hd_stiker_lab.php?hn=59-5796&p1=y&p2=y
// replace hn from table: labdepart

$d = date("d");
$m = date("m");
$y = date("Y")+543;

function toTIS620($t){
	return iconv('UTF-8','TIS-620',$t);
}

$sql = "Select yot, name, surname, ptright From opcard where hn = '".$_GET["hn"]."'";
$result = Mysql_Query($sql);
list($yot, $name, $surname, $ptright) = Mysql_fetch_row($result);
$ptname = $yot." ".$name." ".$surname;
$hn = $_GET["hn"];

$sql = "Select row_id, doctor, price , sumnprice  From labdepart  where hn ='".$_GET["hn"]."' AND date like '".$y."-".$m."-".$d."%' AND depart = 'PATHO' AND price > 0 Order by row_id DESC limit 1 ";
$result = Mysql_Query($sql);
$rows = Mysql_num_rows($result);
if($rows <=0 ){
	echo "<CENTER>ขออภัยผู้ป่วยไม่มีรายการตรวจ Lab วันนี้</CENTER>";
	exit();
}
list($rowid, $doctor, $price , $sumnprice) = Mysql_fetch_row($result);

$sql = "Select code From labpatdata  where idno = '".$rowid."' ";
$result = Mysql_Query($sql);
$list_lab = array();
while($arr = mysql_fetch_assoc($result)){
		array_push($list_lab,$arr["code"]);
}
$count2 = count($list_lab);
$txt_list_lab = implode(", ",$list_lab);
$text1 = array();
$text2 = array();
$text3 = array();
if($count2>18){
	for($k=0;$k<9;$k++){
		array_push($text1,$list_lab[$k]);
	}
	for($k=10;$k<18;$k++){
		array_push($text2,$list_lab[$k]);
	}
	for($k=19;$k< $count2;$k++){
		array_push($text3,$list_lab[$k]);
	}
	$txt_text1 = implode(", ",$text1);
	$txt_text2 = implode(", ",$text2);
	$txt_text3 = implode(", ",$text3);
}elseif($count2>9){
	for($k=0;$k<9;$k++){
		array_push($text1,$list_lab[$k]);
	}
	for($k=10;$k< $count2;$k++){
		array_push($text2,$list_lab[$k]);
	}
	$txt_text1 = implode(", ",$text1);
	$txt_text2 = implode(", ",$text2);
}else{
	for($k=0;$k< $count2;$k++){
		array_push($text1,$list_lab[$k]);
	}
	$txt_text1 = implode(", ",$text1);
}

if(isset($_GET["land"])){
	$ll = "L";
}else{
	$ll = "P";
}

$pdf = new FPDF("L",'mm',array( 80,50 ));
$pdf->AddFont('AngsanaNew','','angsa.php');
$pdf->AddFont('AngsanaNew','B','angsab.php');
$pdf->SetAutoPageBreak(true,0);
$pdf->SetMargins(0, 0);
$pdf->SetFont('AngsanaNew', '', 12);
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);

if(isset($_GET["p1"])){
	$pdf->AddPage();

	$pdf->SetFont('AngsanaNew', '', 12);

	$pdf->Cell(0,3,"",0);
	$pdf->Ln();
	$pdf->Cell(0,5,toTIS620("Lab ผู้ป่วยใน ").$d."-".$m."-".$y." ".date("H:i:s")." ",0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('AngsanaNew', '', 14);
	$pdf->Cell(0,5, toTIS620($ptname)." Hn ".$hn,0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('AngsanaNew', '', 13);
	$pdf->Cell(0,5,toTIS620("แพทย์ ".$doctor),0,0,'C');
	$pdf->Ln();

	$pdf->Cell(0,5,toTIS620("สิทธิ์ ".$ptright),0,0,'C');
	$pdf->Ln();
	$pdf->SetFont('AngsanaNew', '', 12);
	$pdf->Cell(0,5,toTIS620("ยื่นที่ห้อง Lab"),0,0,'C');
	$pdf->Ln();

	$pdf->Cell(0,5,toTIS620("ราคา ".$price." บาท เบิกไม่ได้ ".$sumnprice." บาท"),0,0,'C');
	$pdf->Ln();

	$pdf->Cell(0,5,"Lab : ".$txt_list_lab,0,0,'C');
	$pdf->Ln();

}

if(isset($_GET["p2"])){

$pdf->AddPage();
$pdf->SetFont('AngsanaNew', '', 12);


$pdf->Cell(25,5,toTIS620("วันที่ ".$d."-".$m."-".$y."  Hn: ".$hn),0);
$pdf->Ln();
$pdf->Cell(20,5,toTIS620("ชื่อ: ".$ptname),0); 
$pdf->Ln();
$pdf->Cell(0,4,"Lab:".$txt_text1,0); 
$pdf->Ln();
if(isset($txt_text2)){
	$pdf->Cell(0,4,$txt_text2,0); 
	$pdf->Ln();
}
if(isset($txt_text3)){
	$pdf->Cell(0,4,$txt_text3,0); 
	$pdf->Ln();
}

$pdf->Cell(0,1,"",0);
$pdf->Ln();
$pdf->Cell(0,0,"",1);
$pdf->Ln();
$pdf->Cell(0,1,"",0);
$pdf->Ln();

$pdf->Cell(25,5,toTIS620("วันที่ ".$d."-".$m."-".$y."  Hn: ".$hn),0);
$pdf->Ln();
$pdf->Cell(20,5,toTIS620("ชื่อ: ".$ptname),0); 
$pdf->Ln();
$pdf->Cell(0,4,"Lab:".$txt_text1,0); 
$pdf->Ln();
if(isset($txt_text2)){
	$pdf->Cell(0,4,$txt_text2,0); 
	$pdf->Ln();
}
if(isset($txt_text3)){
	$pdf->Cell(0,4,$txt_text3,0); 
	$pdf->Ln();
}

}

$pdf->Output();