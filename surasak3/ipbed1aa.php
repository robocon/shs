<?php
require("fpdf/fpdf.php");
require("fpdf/pdf.php");
include("connect.php");

function toUTF($txt){ 
	return iconv("UTF-8", "WINDOWS-874", $txt);
}
//Example URL
//ipbed1aa.php?an=69/767&bad=ICU1&bedcode=44ICU1&cbedname=ËÍ¼Ùé»èÇÂICU&no=9

$datey=date("Y")+543;
$datem=date("-m-d H:i:s");
$date1=$datey.$datem;

$an = $_GET['an'];
$bed = $_GET['bed'];

$sql = "SELECT hn,an,ptname,age,ptright,bedcode,doctor,bed,diagnos FROM bed WHERE an = '$an' ";
$result_dt_hn =mysql_query($sql);
mysql_query("SET NAMES UTF8");
list($chn, $can, $cptname , $cage , $cptright , $cbedcode , $cdoctor , $cBed1 ,$cdiagnos ) = Mysql_fetch_row($result_dt_hn);

$pdf = new PDF("P",'mm',array( 55,30 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',10);
$header=array('','','','','','','');

$pdf->Cell(55,5,"ËÍ¼Ùé»èÇÂÃÇÁ ".$bed."  HN :".$can." ".$date1." ",0,0);
$pdf->Ln();
$pdf->SetFont('AngsanaNew','',14);
$pdf->Cell(55,6,"AN :".$can." ".toUTF($cptname)." ",0,0);
$pdf->Ln();

$strSQL = "SELECT `no`,`code`,GROUP_CONCAT(`code`) AS `group_codes` FROM `lab_ward` WHERE `an` = '$an' AND `no`='$no' GROUP BY `no` ";
$objQuery = mysql_query($strSQL);
$item = mysql_fetch_assoc($objQuery);
$pdf->SetFont('AngsanaNew','',10);
$pdf->MultiCell(55,3,"Lab: ".$item['group_codes'],0);

$items = explode(',', $item['group_codes']);
$tubes = array();
foreach($items AS $item){
	$sql = "SELECT `tube` FROM `labcare` WHERE `code`='$item'";
	$q = mysql_query($sql);
	$r = mysql_fetch_assoc($q);
	if(!in_array($r['tube'], $tubes)){
		$tubes[] = $r['tube'];
	}
}
$pdf->Cell(55,5,"Tube:".implode(',',$tubes),0,0);
$pdf->Output();
?>
