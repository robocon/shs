<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$cAn' ";
$result_dt_hn =mysql_query($sql);
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);

$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();

// ward อื่นๆ ขนาดตัวหนังสือจะ 14
$text_size = 14;
$exName = '';

// เช็กว่าเป็นWardพิเศษรึป่าว
$wardExTest = preg_match('/45.+/', $cbedcode);
if( $wardExTest > 0 ){
	//
	// เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
	$wardR3Test = preg_match('/R3\d+|B\d+/', $cBed1);
	$wardBxTest = preg_match('/B[0-9]+/', $cBed1);
	$exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? 'ชั้น3' : 'ชั้น2' ;

	// เฉพาะ ward พิเศษที่ตัวหนังสือ 11
	// $text_size = 14;
	
}

$pdf->SetFont('AngsanaNew','',$text_size);
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();

$full_text = $cbedname.$exName."/$cBed1 อายุ:$cage\n";
$full_text .= "AN:$can HN:$chn\n";
$full_text .= "$cptname\n";
$full_text .= "โรค:$cdiagnos\n";
$full_text .= "สิทธิ:$cptright\n";
$full_text .= "แพทย์:$cdoctor\n";

$pdf->SetXY(0, 1);
$pdf->MultiCell(0, 4, $full_text);
$pdf->Output();

?>