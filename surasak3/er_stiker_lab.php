<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

$d = date("d");
$m = date("m");
$y = date("Y")+543;


$sql = "Select yot, name, surname, ptright From opcard where hn = '".$_GET["hn"]."' limit 1 ";
$result = Mysql_Query($sql);
list($yot, $name, $surname, $ptright) = Mysql_fetch_row($result);
$ptname = $yot." ".$name." ".$surname;
$hn = $_GET["hn"];

$sql = "Select row_id, doctor, price , sumnprice  From depart  where hn ='".$_GET["hn"]."' AND date like '".$y."-".$m."-".$d."%' AND price > 0 Order by row_id DESC limit 1 ";

$result = Mysql_Query($sql);
$rows = Mysql_num_rows($result);

if($rows <=0 ){
	echo "<CENTER>ขออภัยผู้ป่วยไม่มีรายการตรวจ Lab วันนี้</CENTER>";
	exit();
}
list($rowid, $doctor, $price , $sumnprice) = Mysql_fetch_row($result);


$sql = "Select code From patdata  where idno = '".$rowid."' ";
$result = Mysql_Query($sql);
$list_lab = array();
while($arr = mysql_fetch_assoc($result)){
	array_push($list_lab,$arr["code"]);
}

$txt_list_lab = implode(", ",$list_lab);

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

if(isset($_GET["p1"])){
$pdf->AddPage();

$pdf->SetFont('AngsanaNew', '', 12);

$pdf->Cell(0,3,"",0);
$pdf->Ln();
$pdf->Cell(0,5,"Lab ผู้ป่วยใน ".$d."-".$m."-".$y." ".date("H:i:s")." ",0,0,'C');
$pdf->Ln();
$pdf->SetFont('AngsanaNew', '', 14);
$pdf->Cell(0,5,$ptname." Hn ".$hn,0,0,'C');
$pdf->Ln();
$pdf->SetFont('AngsanaNew', '', 13);
$pdf->Cell(0,5,"แพทย์ ".$doctor,0,0,'C');
$pdf->Ln();

$pdf->Cell(0,5,"สิทธิ์ ".$ptright,0,0,'C');
$pdf->Ln();
$pdf->SetFont('AngsanaNew', '', 12);
$pdf->Cell(0,5,"ยื่นที่ห้อง Lab",0,0,'C');
$pdf->Ln();

$pdf->Cell(0,5,"ราคา ".$price." บาท เบิกไม่ได้ ".$sumnprice." บาท",0,0,'C');
$pdf->Ln();

$pdf->Cell(0,5,"Lab : ".$txt_list_lab,0,0,'C');
$pdf->Ln();

}

if(isset($_GET["p2"])){

$pdf->AddPage();
$pdf->SetFont('AngsanaNew', '', 12);


$pdf->Cell(25,5,"วันที่ ".$d."-".$m."-".$y."",0);
$pdf->Ln();
$pdf->Cell(20,5,"Hn: ".$hn,0); $pdf->Cell(50,5,"ชื่อ - สกุล: ".$ptname,0);
$pdf->Ln();
$pdf->Cell(0,5,"Lab: ".$txt_list_lab,0);
$pdf->Ln();

$pdf->Cell(0,1,"",0);
$pdf->Ln();
$pdf->Cell(0,0,"",1);
$pdf->Ln();
$pdf->Cell(0,1,"",0);
$pdf->Ln();

$pdf->Cell(25,5,"วันที่ ".$d."-".$m."-".$y."",0);
$pdf->Ln();
$pdf->Cell(20,5,"Hn: ".$hn,0); $pdf->Cell(50,5,"ชื่อ - สกุล: ".$ptname,0);
$pdf->Ln();
$pdf->Cell(0,5,"Lab: ".$txt_list_lab,0);

$pdf->Ln();
$pdf->Cell(0,1,"",0);
$pdf->Ln();
$pdf->Cell(0,0,"",1);
$pdf->Ln();
$pdf->Cell(0,1,"",0);
$pdf->Ln();

$pdf->Cell(25,5,"วันที่ ".$d."-".$m."-".$y."",0);
$pdf->Ln();
$pdf->Cell(20,5,"Hn: ".$hn,0); $pdf->Cell(50,5,"ชื่อ - สกุล: ".$ptname,0);
$pdf->Ln();
$pdf->Cell(0,5,"Lab: ".$txt_list_lab,0);

}

$pdf->Output();