<?php
 session_start();
    
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

include("connect.php");
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

$query = "SELECT * FROM runno WHERE title = 'lab'";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

$query2 = "SELECT * FROM depart WHERE hn = '$cHn' order by row_id desc limit 1";
$result2 = mysql_query($query2);
$row2 = mysql_fetch_array($result2);
$nLab2 = $row2['lab'];

//echo $query2;
include("unconnect.php");
$ll = "P";

$pdf = new PDF($ll,'mm',array( 55,30 ));
$pdf->SetThaiFont();
$pdf->SetAutoPageBreak(false,0);
$pdf->SetMargins(0, 0);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew','',12);
$pdf->Cell(0,1,'',0,0);
$pdf->Ln();
$pdf->Cell(0,4,'âÃ§¾ÂÒºÒÅ¤èÒÂÊØÃÈÑ¡´ÔìÁ¹µÃÕ',0,0,'C');
$pdf->Ln();

$pdf->Cell(0,4," HN ".$cHn." (".$tvn.")  ".$Thaidate,0,0);
$pdf->Ln();
$pdf->Cell(0,4,$cPtname,0,0);
$pdf->Ln();

$i=0;
$indexx = 0;
$dglist=array();
for ($n=1; $n<=$x; $n++){
	If (!empty($aDgcode[$n])){
		$dglist[$indexx][$i] = $aDgcode[$n];
		$i++;
		if($i==8)
			$indexx=1;
	}
} ;

$strdclist1 = implode(",",$dglist[0]);

if(isset($dglist[1]) && count($dglist[1])>0)
	$strdclist2 = implode(" ",$dglist[1]);
else
	$strdclist2 = "";

$pdf->Cell(0,4,"".$strdclist1." ",0,0);
$pdf->Ln();

if(trim($strdclist2) !=""){
	$strdclist2 = implode(",",$dglist[1]);

$pdf->Cell(0,4,"".$strdclist2." ",0,0);
$pdf->Ln();
}

$pdf->Cell(0,4,"Lab  No. ".$nLab2,0,0,'C');
$pdf->Ln();



$pdf->Output();
?>