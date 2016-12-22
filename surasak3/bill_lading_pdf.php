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
        $this->Cell(70, 11, 'วันที่ .............................................................', 0, 1, 'R');
        // y -1 เพื่อให้วันที่มันลอยขึ้นมานิดหนึ่ง
        $this->SetXY(125, 18);
        $this->Cell(35, 11, $date_serve, 0, 1, 'C');

        $this->Rect(8, 30, 170, 11); // กรอบ
        $this->SetXY(10, 30);
        $this->Cell(80, 11, 'หน่วยจ่าย ....................................................', 0, 1, 'L');
        $this->SetXY(98, 30);
        $this->Cell(80, 11, 'หน่วยเบิก ....................................................', 0, 1, 'R');

        $this->SetFont('THSarabun', '', 17); // เรียกใช้งานฟอนต์ที่เตรียมไว้

        // หัวข้อรายการด้านซ้าย
        $this->SetXY(8, 41);
        $this->Cell(25, 18, 'รหัสยา', 1, 1, 'C');

        $this->SetXY(33, 41);
        $this->Cell(85, 18, 'รายการ', 1, 1, 'C');

        $this->SetXY(118, 41);
        // $this->Cell(15, 18, 'จำนวนเบิก', 1, 1, 'C');
        $this->Multicell(15, 9, 'จำนวน เบิก', 1, 'C');

        $this->SetXY(133, 41);
        $this->Cell(15, 18, 'จ่ายจริง', 1, 1, 'C');

        $this->SetXY(148, 41);
        $this->Cell(30, 11, 'เป็นเงิน', 1, 1, 'C');
        $this->SetXY(148, 52);
        $this->Cell(18, 7, 'บาท', 1, 1, 'C');
        $this->SetXY(166, 52);
        $this->Cell(12, 7, 'สต.', 1, 1, 'C');

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

// ค่าแกน y ที่เป็นบรรทัดเริ่มต้น
$y_start = 59;

// ค่าแกน X
$x_drugcode = 8; 
$x_tradename = 33;
$x_drugbring = 118;
$x_pay = 133;
$x_baht = 148;
$x_smallbaht = 166;

$max_row = 17; // จำนวนแถวต่อหนึ่งหน้ากระดาษที่ความสูง 7.5
$default_line_height = 7.5; // ความสูงมาตรฐาน
$line_total = 0; // จำนวนบรรทัดทั้งหมด

$line_max_height = $y_start + ($default_line_height * $max_row) ; // ความสูงต่อหนึ่งหน้ากระดาษ

// จำนวนยา
$item_rows = count($full_items);

// จำนวนที่แท้จริงของตาราง
// ต.ย. เช่น จำนวนยามี25 จำนวนช่องก็จะตัดเป็น 34 (2หน้ากระดาษ)
$full_rows = (int) ( ceil(( $item_rows / $max_row )) ) * $max_row ;

$line_number = 0;
$over_line_limit = 0;

for ($i=1; $i <= $full_rows; $i++) { 
    
    $line_height = $default_line_height;
    $item = $full_items[$i];
    
    if( !empty($item) ){

        // รองรับแค่ที่2บรรทัด
        $tradename = trim($item['tradename']);
        $test_count_tradename = strlen($item['tradename']);
        if( !empty($item) && $test_count_tradename >= 48 ){

            $line_height += $default_line_height; // เบิ้ลความสูง
            ++$line_number; // เบิ้ลจำนวนบรรทัด

            ++$over_line_limit; // นับจำนวนที่มันเกินว่ามีกี่บรรทัด
        }

        // รหัสยา
        $pdf->SetXY($x_drugcode, $y_start);
        $pdf->Cell(25, $line_height, $item['drugcode'], 0, 0, 'L');

        // รายการยา
        $pdf->SetXY($x_tradename, $y_start);
        $pdf->Multicell(85, $default_line_height, $tradename, 0, 'L');

        // จำนวนเบิก
        $pdf->SetXY($x_drugbring, $y_start);
        $drug_num = ( empty($item['num']) ) ? 0 : $item['num'] ; 
        $pdf->Cell(15, $line_height, $drug_num, 0, 0, 'R');

    }else{
        // ถ้ามีบรรทัดที่เกิน(ไอ่ที่มันเบิ้ล2บรรทัด) ข้ามไปเล๊ยยยยย
        if( $over_line_limit > 0 ){
            --$over_line_limit;
            continue;
        }
    }

    // บรรทัดจะว่างหรือไม่ว่างก็นับแม่งเลยสัส
    ++$line_number;

    $pdf->Rect($x_drugcode, $y_start, 25, $line_height); //รหัสยา
    $pdf->Rect($x_tradename, $y_start, 85, $line_height); //รายการยา
    $pdf->Rect($x_drugbring, $y_start, 15, $line_height); //จำนวนเบิก

    // สามช่องด้านขวาของแต่ละ column เป็นค่าว่าง
    $pdf->Rect($x_pay, $y_start, 15, $line_height); //จ่ายจริง
    $pdf->Rect($x_baht, $y_start, 18, $line_height); //เป็นเงิน(บาท)

    
    $pdf->Rect($x_smallbaht, $y_start, 12, $line_height); //เป็นเงิน(สต.)

    $y_start += $line_height; // ขึ้นบรรทัดใหม่ไปเรื่อยๆ

    if( $line_number == $max_row && !empty($item) ){
        $y_start = 59;
        $line_number = 0;
        $pdf->AddPage();
    }

}

$pdf->AutoPrint(true);
$pdf->Output();
exit;