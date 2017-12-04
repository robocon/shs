<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");
$datey=date("Y")+543;
$datem=date("-m-d H:i:s");
$date1=$datey.$datem;

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$an' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);

$ll = "P";


$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',10);
$header=array('','','','','','','');

/*$pdf->Cell(0,8,"".$cbedname."  ".$bad."  AN :".$can." HN :".$chn." ".$cptname." ".$date." ",0,0);
$pdf->Ln();*/
$pdf->Cell(1,8,"หอผู้ป่วยรวม ".$bad."  HN :".$can." ".$date1." ",0,0);
$pdf->Ln();
$pdf->SetFont('AngsanaNew','',14);
$pdf->Cell(1,8,"AN :".$can." ".$cptname." ",0,0);
$pdf->Ln();

/*$pdf->Cell(0,6,"LAB : ",0,0);
$pdf->Ln();*/

$strSQL = "SELECT DISTINCT no,code  FROM  `lab_ward` inner join `bed` WHERE  lab_ward.an = '$an' and lab_ward.no='$no' ";
$objQuery = mysql_query($strSQL);
$list_lab = array();
while($arr = mysql_fetch_assoc($objQuery)){
	array_push($list_lab,$arr["code"]);
}
$c1=count($list_lab);
$txt_list_lab = implode(", ",$list_lab);

for($i=0;$i<$c1;$i++){
		$a=1;
	if($i==5){
		$a++;
	}else{
		$st1= $st1.$list_lab[$i].",";
	}
	
}

$pdf->SetFont('AngsanaNew','',10);
$pdf->Cell(1,8,"Lab: ".$st1,0);
$pdf->Ln();

$pdf->Output();
?>
