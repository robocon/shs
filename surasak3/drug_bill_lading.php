<?php

include 'bootstrap.php';

include 'fpdf_thai/fpdf_thai.php';

class PDF_JavaScript extends FPDF_Thai {

    var $javascript;
    var $n_js;

    function IncludeJS($script) {
        $this->javascript=$script;
    }

    function _putjavascript() {
        $this->_newobj();
        $this->n_js=$this->n;
        $this->_out('<<');
        $this->_out('/Names [(EmbeddedJS) '.($this->n+1).' 0 R]');
        $this->_out('>>');
        $this->_out('endobj');
        $this->_newobj();
        $this->_out('<<');
        $this->_out('/S /JavaScript');
        $this->_out('/JS '.$this->_textstring($this->javascript));
        $this->_out('>>');
        $this->_out('endobj');
    }

    function _putresources() {
        parent::_putresources();
        if (!empty($this->javascript)) {
            $this->_putjavascript();
        }
    }

    function _putcatalog() {
        parent::_putcatalog();
        if (!empty($this->javascript)) {
            $this->_out('/Names <</JavaScript '.($this->n_js).' 0 R>>');
        }
    }
}

class PDF_AutoPrint extends PDF_JavaScript{
    function AutoPrint($dialog=false){
        //Open the print dialog or start printing immediately on the standard printer
        $param=($dialog ? 'true' : 'false');
        $script="print($param);";
        $this->IncludeJS($script);
    }

    function AutoPrintToPrinter($server, $printer, $dialog=false){
        //Print on a shared printer (requires at least Acrobat 6)
        $script = "var pp = getPrintParams();";
        if($dialog){
            $script .= "pp.interactive = pp.constants.interactionLevel.full;";
        }else{
            $script .= "pp.interactive = pp.constants.interactionLevel.automatic;";
        }
        $script .= "pp.printerName = '\\\\\\\\".$server."\\\\".$printer."';";
        $script .= "print(pp);";
        $this->IncludeJS($script);
    }

    function _getfontpath(){
        if(!defined('FPDF_FONTPATH')){
            define('FPDF_FONTPATH',dirname(__FILE__).'/font/');
        }
        return defined('FPDF_FONTPATH') ? FPDF_FONTPATH : '';
    }

    function SetThaiFont() {
        $this->_getfontpath();
        $this->AddFont('AngsanaNew','','angsa.php');
        $this->AddFont('THSarabun','','THSarabun.php');
        $this->AddFont('THSarabun','B','THSarabun Bold.php');
    }
    
    function conv($string) {
        return iconv('UTF-8', 'TIS-620', $string);
    }

    function LoadData($file){
        //Read file lines
        $lines = file($file);
        $data = array();
        foreach($lines as $line)
            $data[] = explode(';',chop($line));
        return $data;
    }
}

$db = Mysql::load();

$pdf = new PDF_AutoPrint("P",'mm', "A4");
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(8, 4);
// $pdf->SetTopMargin(2);
$pdf->AddPage();
$pdf->SetFont('THSarabun', '', 17); // เรียกใช้งานฟอนต์ที่เตรียมไว้

// $pdf->SetFontSize(17);

$pdf->SetXY(8, 4);
$pdf->SetFont('THSarabun', 'B', 25);
$pdf->Cell(170, 15, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'C');

$pdf->Rect(8, 19, 170, 11); // กรอบ
$pdf->SetXY(10, 19);
$pdf->SetFont('THSarabun', '', 17);
$pdf->Cell(50, 11, 'เลขที่ ..............................', 0, 1, 'L');
$pdf->SetXY(75, 19);
$pdf->SetFont('THSarabun', 'B', 38);
$pdf->Cell(30, 11, 'ใบเบิก', 0, 1, 'C');
$pdf->SetXY(108, 19);
$pdf->SetFont('THSarabun', '', 17);
$pdf->Cell(70, 11, 'วันที่ ....................................................', 0, 1, 'R');

$pdf->Rect(8, 30, 170, 11); // กรอบ
$pdf->SetXY(10, 30);
$pdf->Cell(80, 11, 'หน่วยจ่าย ....................................................', 0, 1, 'L');
$pdf->SetXY(98, 30);
$pdf->Cell(80, 11, 'หน่วยเบิก ....................................................', 0, 1, 'R');

// รายการด้านซ้าย
$pdf->SetXY(8, 41);
$pdf->Cell(50, 18, 'รายการ', 1, 1, 'C');

$pdf->Rect(58, 41, 10, 18);
$pdf->SetFont('THSarabun', '', 12);
$pdf->SetXY(58, 45);
$pdf->MultiCell(10, 5, 'จำนวนเบิก', 0, 'C');

$pdf->Rect(68, 41, 10, 18);
$pdf->SetXY(68, 45);
$pdf->MultiCell(10, 5, 'จ่าย จริง', 0, 'C');

$pdf->SetXY(78, 41);
$pdf->Cell(15, 11, 'เป็นเงิน', 1, 1, 'C');
$pdf->SetXY(78, 52);
$pdf->Cell(9, 7, 'บาท', 1, 1, 'C');
$pdf->SetXY(87, 52);
$pdf->Cell(6, 7, 'สต.', 1, 1, 'C');

// รายการด้านขวา
$pdf->SetXY(93, 41);
$pdf->SetFont('THSarabun', '', 17);
$pdf->Cell(50, 18, 'รายการ', 1, 1, 'C');

$pdf->Rect(143, 41, 10, 18);
$pdf->SetFont('THSarabun', '', 12);
$pdf->SetXY(143, 45);
$pdf->MultiCell(10, 5, 'จำนวนเบิก', 0, 'C');

$pdf->Rect(153, 41, 10, 18);
$pdf->SetXY(153, 45);
$pdf->MultiCell(10, 5, 'จ่าย จริง', 0, 'C');

$pdf->SetXY(163, 41);
$pdf->Cell(15, 11, 'เป็นเงิน', 1, 1, 'C');
$pdf->SetXY(163, 52);
$pdf->Cell(9, 7, 'บาท', 1, 1, 'C');
$pdf->SetXY(172, 52);
$pdf->Cell(6, 7, 'สต.', 1, 1, 'C');

// ทดสอบสร้างตาราง
$line_start = 59;
$line_height = 7;
for( $i=1; $i<=17; $i++){

    $pdf->Rect(8, $line_start, 50, $line_height);
    $pdf->Rect(58, $line_start, 10, $line_height);
    $pdf->Rect(68, $line_start, 10, $line_height);
    $pdf->Rect(78, $line_start, 9, $line_height);
    $pdf->Rect(87, $line_start, 6, $line_height);

    $line_start += 7;
}


// $pdf->AutoPrint(true);
$pdf->Output();
exit;