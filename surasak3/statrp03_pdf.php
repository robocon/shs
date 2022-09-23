<?php 
require("fpdf/fpdf.php");
require("fpdf/pdf.php");

require("connect.php");

function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

function toTIS620($txt){
    return iconv("UTF-8", "TIS-620", $txt);
}

$month_["01"] = "มกราคม";
$month_["02"] = "กุมภาพันธ์";
$month_["03"] = "มีนาคม";
$month_["04"] = "เมษายน";
$month_["05"] = "พฤษภาคม";
$month_["06"] = "มิถุนายน";
$month_["07"] = "กรกฏาคม";
$month_["08"] = "สิงหาคม";
$month_["09"] = "กันยายน";
$month_["10"] = "ตุลาคม";
$month_["11"] = "พฤศจิกายน";
$month_["12"] = "ธันวาคม";

$pdf = new PDF('L' ,'mm','A4');
$pdf->SetThaiFont();
$pdf->SetMargins(10, 10);
$pdf->AddPage();
$pdf->SetFont('AngsanaNew', '', 14);

$time = rawurldecode($_GET["time"]);
$time_zone = explode("-", $time);

$between_date = $_GET["year"]."-".$_GET["month"]."-".$_GET["day"];

$sql = "SELECT date,hn, ptname,ptright  FROM patdata WHERE hn != '' AND ( date between '$between_date ".$time_zone[0]."' AND '$between_date ".$time_zone[1]."')   ".$where." Group by hn Having sum(amount)  > 0 Order by date ASC limit 80 "; 
$res_patdata  = Mysql_Query($sql) or die(mysql_error());

/////////////////////////
$tempsql1="CREATE TEMPORARY TABLE  depart1  SELECT  *  FROM  depart  WHERE (date between '$between_date ".$time_zone[0]."' AND '$between_date ".$time_zone[1]."') ";
$temquery1 = mysql_query($tempsql1) or die(mysql_error());

$tempsql="CREATE TEMPORARY TABLE  appoint1  SELECT  *  FROM  appoint  WHERE (date between '$between_date ".$time_zone[0]."' AND '$between_date ".$time_zone[1]."') ";
$temquery = mysql_query($tempsql) or die(mysql_error());
        ///////////////////////////

$txt = "งานแพทย์แผนไทย ";
switch($time){
    case "07:30:00-12:30:00" : $txt .= "08.00 - 12.00"; break;
    case "15:00:00-21:00:00" : $txt .= "16.30 - 20.30"; break;

    case "07:30:00-16:00:00" : $txt .= "08.00 - 16.00"; break;
    case "16:00:01-21:00:00" : $txt .= "16.00 - 20.00"; break;

}

$pdf->Cell(0,7,$txt,0,0,'C');
$pdf->Ln();

$pdf->Cell(0,7,"วันที่ ".$_GET["day"]." ".$month_[$_GET["month"]]." ".$_GET["year"],0,0,'C');
$pdf->Ln();
$pdf->Ln();
$pdf->Ln();

$pdf->Cell(10,7,"ลำดับ",1,0,'C');
$pdf->Cell(50,7,"ชื่อ - สกุล ผู้รับบริการ",1,0,'C');
$pdf->Cell(15,7,"HN",1,0,'C');
$pdf->Cell(35,7,"ชื่อ-สกุล พนักงาน",1,0,'C');
$pdf->Cell(60,7,"การวินิจฉัยโรค",1,0,'C');
$pdf->Cell(50,7,"สิทธิการรักษา",1,0,'C');
$pdf->Cell(30,7,"นัดครั้งต่อไป",1,0,'C');
$pdf->Cell(20,7,"หมายเหตุ",1,0,'C');
$pdf->Ln();

$i=1;
while(list($date,$hn,$ptname,$ptright) = Mysql_fetch_row($res_patdata)){ 
    $subdate=explode(" ",$date);
    
    $strsql1="SELECT  diag ,staf_massage FROM  depart1   WHERE  hn='$hn'  and date='$date' ";
    $objquery1 = mysql_query($strsql1);
    list($diag,$staf_massage) = mysql_fetch_row($objquery1);
    
    $strsql2="SELECT  officer,appdate  FROM appoint1    WHERE  hn='$hn'  and date like'$subdate[0]%' ";
    $objquery2  = mysql_query($strsql2);
    list($officer,$appdate) = mysql_fetch_row($objquery2);

    $pdf->Cell(10,7,$i,1,0,'C');
    $pdf->Cell(50,7,toTIS620($ptname),1,0);
    $pdf->Cell(15,7,$hn,1,0,'L');
    $pdf->Cell(35,7,toTIS620($staf_massage),1,0,'C');
    $pdf->Cell(60,7,toTIS620($diag),1,0,'L');
    $pdf->Cell(50,7,toTIS620($ptright),1,0,'L');
    $pdf->Cell(30,7,toTIS620($appdate),1,0,'L');
    $pdf->Cell(20,7,"",1,0,'C');
    $pdf->Ln();
    $i++;
}

$pdf->Ln();

$pdf->Cell(20,7,"ผู้บันทึก",0,0,'C');
$pdf->Cell(100,7,"          ",0,0,'R');
$pdf->Ln();

$pdf->Cell(70,7,"(                                         )",0,0,'C');
$pdf->Cell(88,7,"(                                         )",0,0,'R');
$pdf->Ln();

$pdf->Cell(66,7,"แพทย์แผนไทย",0,0,'C');
$pdf->Cell(140,7,"หน. แผนกแพทย์ทางเลือก",0,0,'C');
$pdf->Ln();

$pdf->Cell(65,7,"........../........../..........",0,0,'C');
$pdf->Cell(140,7,"........../........../..........",0,0,'C');
$pdf->Ln();
$pdf->Output();