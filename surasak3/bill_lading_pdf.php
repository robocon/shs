<?php

/**
 * @readme
 * ต้องการค่า Array Array โดยมีรูปแบบ
 * array(
 *     array(
 *          'tradename' => 'ชื่อยา',
 *          'num' => 'จำนวนที่เบิก'
 *     )
 * );
 * 
 */

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

    function Header(){

        $date_serve = $GLOBALS['date_serve'];

        $this->SetXY(8, 4);
        $this->SetFont('THSarabun', 'B', 25);
        $this->Cell(170, 15, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'C');

        $this->Rect(8, 19, 170, 11); // กรอบ
        $this->SetXY(10, 19);
        $this->SetFont('THSarabun', '', 17);
        $this->Cell(50, 11, 'เลขที่ ..............................', 0, 1, 'L');
        $this->SetXY(75, 19);
        $this->SetFont('THSarabun', 'B', 38);
        $this->Cell(30, 11, 'ใบเบิก', 0, 1, 'C');
        $this->SetXY(108, 19);
        $this->SetFont('THSarabun', '', 17);
        $this->Cell(70, 11, 'วันที่ ...............'.$date_serve.'...............', 0, 1, 'R');

        $this->Rect(8, 30, 170, 11); // กรอบ
        $this->SetXY(10, 30);
        $this->Cell(80, 11, 'หน่วยจ่าย ....................................................', 0, 1, 'L');
        $this->SetXY(98, 30);
        $this->Cell(80, 11, 'หน่วยเบิก ....................................................', 0, 1, 'R');

        $this->SetFont('THSarabun', '', 17); // เรียกใช้งานฟอนต์ที่เตรียมไว้

        // หัวข้อรายการด้านซ้าย
        $this->SetXY(8, 41);
        $this->Cell(50, 18, 'รายการ', 1, 1, 'C');

        $this->Rect(58, 41, 10, 18);
        $this->SetFont('THSarabun', '', 12);
        $this->SetXY(58, 45);
        $this->MultiCell(10, 5, 'จำนวนเบิก', 0, 'C');

        $this->Rect(68, 41, 10, 18);
        $this->SetXY(68, 45);
        $this->MultiCell(10, 5, 'จ่าย จริง', 0, 'C');

        $this->SetXY(78, 41);
        $this->Cell(15, 11, 'เป็นเงิน', 1, 1, 'C');
        $this->SetXY(78, 52);
        $this->Cell(9, 7, 'บาท', 1, 1, 'C');
        $this->SetXY(87, 52);
        $this->Cell(6, 7, 'สต.', 1, 1, 'C');

        // หัวข้อรายการด้านขวา
        $this->SetXY(93, 41);
        $this->SetFont('THSarabun', '', 17);
        $this->Cell(50, 18, 'รายการ', 1, 1, 'C');

        $this->Rect(143, 41, 10, 18);
        $this->SetFont('THSarabun', '', 12);
        $this->SetXY(143, 45);
        $this->MultiCell(10, 5, 'จำนวนเบิก', 0, 'C');

        $this->Rect(153, 41, 10, 18);
        $this->SetXY(153, 45);
        $this->MultiCell(10, 5, 'จ่าย จริง', 0, 'C');

        $this->SetXY(163, 41);
        $this->Cell(15, 11, 'เป็นเงิน', 1, 1, 'C');
        $this->SetXY(163, 52);
        $this->Cell(9, 7, 'บาท', 1, 1, 'C');
        $this->SetXY(172, 52);
        $this->Cell(6, 7, 'สต.', 1, 1, 'C');
    }

    function Footer(){
        $this->SetXY(8, 187);
        $this->Cell(85, 6, 'ตรวจแล้วเห็นว่า', 0, 1);
        $this->SetXY(93, 187);
        $this->Cell(85, 6, 'ขอเบิก สป. ตามที่ระบุไว้ในช่อง "จำนวนเบิก" และขอมอบ', 0, 1, 'R');

        $this->SetXY(8, 193);
        $this->Cell(85, 6, 'ควรจ่าย สป. ให้ตามจำนวนในช่อง "จ่ายจริง"', 0, 1);
        $this->SetXY(93, 193);
        $this->Cell(85, 6, 'ให้.................................................................เป็นผู้รับแทน', 0, 1, 'R');

        $this->SetXY(8, 199);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(58, 199);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');
        $this->SetXY(94, 199);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(144, 199);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');

        $this->SetXY(8, 210);
        $this->Cell(45, 7, 'ผู้ตรวจจ่าย', 0, 1, 'C');
        $this->SetXY(58, 210);
        $this->Cell(32, 7, 'วัน เดือน ปี', 0, 1, 'C');
        $this->SetXY(94, 210);
        $this->Cell(45, 7, 'ผู้เบิก', 0, 1, 'C');
        $this->SetXY(144, 210);
        $this->Cell(32, 7, 'วัน เดือน ปี', 0, 1, 'C');

        $this->Line(8, 219, 178, 219);

        $this->SetXY(8, 219);
        $this->Cell(170, 7, 'ได้จ่าย สป. ตามรายการจำนวนที่แจ้งไว้ในช่องจ่ายจริงแล้ว ได้รับ สป. ตามรายการและจำนวนที่แจ้งไว้ในช่องจ่ายจริงแล้ว', 0, 1, 'C');

        $this->SetXY(8, 224);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(58, 224);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');
        $this->SetXY(94, 224);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(144, 224);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');

        $this->SetXY(8, 235);
        $this->Cell(45, 7, 'ผู้จ่ายของ', 0, 1, 'C');
        $this->SetXY(58, 235);
        $this->Cell(32, 7, 'วัน เดือน ปี', 0, 1, 'C');
        $this->SetXY(94, 235);
        $this->Cell(45, 7, 'ผู้รับของ', 0, 1, 'C');
        $this->SetXY(144, 235);
        $this->Cell(32, 7, 'วัน เดือน ปี', 0, 1, 'C');
    }
}

$m = date('m');
if( !isset($date_serve) ){
    $date_serve = date('d').' '.$def_fullm_th[$m].' '.( date('Y') + 543 );
}

$pdf = new PDF_AutoPrint("P",'mm', "A4");
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(8, 4);
$pdf->AddPage();

$pdf->SetFont('THSarabun', '', 15);

$max_row = 34; // จำนวนแถวต่อหนึ่งหน้ากระดาษ

$y_start = 59;
$line_height = 7.5;

// หาจำนวนเต็มของตาราง
$item_rows = count($full_items);
$full_rows = ( ceil(( $item_rows / $max_row )) ) * $max_row ;

$row_i = 0;
$line_num = 0; // นับจำนวนแถวของ column ซ้ายและขวา
$item_i = 0;

for( $i=1; $i<=$full_rows; $i++){
    ++$line_num;
    ++$row_i;

    // ถ้าเป็น column ซ้ายมือจะใช้ค่า X ตามนี้
    if( $row_i <= 17 ){
        $x1 = 8;
        $x2 = 58;
        $x3 = 68;
        $x4 = 78;
        $x5 = 87;
    }elseif( $row_i >= 18 && $row_i <= 34 ){ // ถ้าเป็น column ขวามือจะใช้ค่า X ตามนี้
        $x1 = 93;
        $x2 = 143;
        $x3 = 153;
        $x4 = 163;
        $x5 = 172;
    }

    if( isset($full_items[$i]) ){

        ++$item_i;

        $item = $full_items[$i];
        $pdf->SetXY($x1, $y_start);
        $pdf->Cell(50, $line_height, $item['tradename'], 1, 1, 'L');
        $pdf->SetXY($x2, $y_start);
        $pdf->Cell(10, $line_height, $item['num'], 1, 1, 'R');

    }else{
        $pdf->Rect($x1, $y_start, 50, $line_height); //รายการ
        $pdf->Rect($x2, $y_start, 10, $line_height); //จำนวนเบิก

    }

    // สามช่องด้านขวาของแต่ละ column เป็นค่าว่าง
    $pdf->Rect($x3, $y_start, 10, $line_height); //จ่ายจริง
    $pdf->Rect($x4, $y_start, 9, $line_height); //เป็นเงิน(บาท)
    $pdf->Rect($x5, $y_start, 6, $line_height); //เป็นเงิน(สต.)

    $y_start += 7.5;
    
    // เมื่อครบ 34 แถว(ซ้าย+ขวา) ให้รีเซ็ตใหม่
    if( $row_i === 34 ){
        $row_i = 0;
    }

    // นับจำนวนที่แท้จริงของแถวต่อหนึ่งหน้ากระดาษเพื่อไม่ให้มันเด้งแสดงหน้าใหม่
    // เช่นแถวทั้งหมดมี 34 แต่มีข้อมูลจริงๆ 25 เป็นต้น
    if( $item_i === 34 ){
        $item_i = 0;
        $pdf->AddPage();
    }

    // แถวซ้ายหรือขวาเมื่อครบ 17 แถวให้รีเซ็ตจุดที่จะเริ่มนับใหม่
    if( $line_num === 17 ){
        $y_start = 59;
        $line_num = 0;
    }
}

$pdf->AutoPrint(true);
$pdf->Output();
exit;