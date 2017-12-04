<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

/*$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);*/

$ptname=$_GET['ptname'];
$bed=$_GET['bed'];
$drugprint=$_POST["drugprint"];
$slcode=$_GET["slcode"];
/*$sql=mysql_query("select * from drugslip where slcode='$slcode'");
$result=mysql_fetch_array($sql);
$detail=$result["detail1"]." ".$result["detail2"]." ".$result["detail3"];*/

$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();

$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(2); // กำหนดค่า กั้นหน้าด้านบน

//for($i=0;$i<count($_POST["drugprint"]);$i++){
	
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',12);


$pdf->Cell(0,5,"".$ptname."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"เตียง :".$bed."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"ชื่อยา :".$dr."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"วิธีใช้ :".$slcode."",0,0);
$pdf->Ln();
/*$pdf->Cell(0,4,"อัตราส่วนผสม :....................................................",0,0);
$pdf->Ln();*/
$pdf->Cell(0,4,"วัน-เวลาที่ผสม :....................................................",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"วัน-เวลาที่หมดอายุ :.............................................",0,0);

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