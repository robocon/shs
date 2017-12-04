<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

/*$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);*/

$ptname=$_GET['ptname'];
$bed=$_GET['bed'];
$an=$_GET['cAn'];
$bedname=$_GET['bedname'];
$hn=$_GET['hn'];

$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();

$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(2); // กำหนดค่า กั้นหน้าด้านบน

for($i=0;$i<count($_POST["drugprint"]);$i++){
	
$slcode=$_POST['slcode'.$i];
$drugcode=$_POST['drugcode'.$i];
$row_id=$_POST["drugprint"][$i];

//echo $_POST['drugprint'][$i].'<br>';
	
$sql="SELECT  * FROM `dgprofile` INNER JOIN  `drugslip` ON `drugslip`.`slcode` = `dgprofile`.`slcode` WHERE  dgprofile.row_id = '$row_id' ";
$result = mysql_query($sql);
$objarr = mysql_fetch_array($result);

//echo $sql.'</BR>';


$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',12);


$pdf->Cell(0,5,"".$bedname." ".$bed."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"ชื่อผู้ป่วย :".$ptname."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"AN :".$an."  HN :".$hn."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"".$objarr['tradname']."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"".$objarr['detail1']."",0,0);
$pdf->Ln();
$pdf->Cell(0,4,"".$objarr['detail2']."",0,0);
$pdf->Ln();

}

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