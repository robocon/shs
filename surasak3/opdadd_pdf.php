<?php
// session_start();
// include("connect.inc");
include_once 'bootstrap.php';
include 'fpdf_thai/fpdf_thai.php';
define('DS', DIRECTORY_SEPARATOR);

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

if( !function_exists('calcage2') ){
    function calcage2($birth){
        $today = getdate();   
        $nY = $today['year']; 
        $nM = $today['mon'] ;
        $bY = substr($birth,0,4)-543;
        $bM = substr($birth,5,2);

        $ageY = $nY-$bY;
        $ageM = $nM-$bM;
        if ($ageM < 0) {
            $ageY = $ageY-1;
            $ageM = 12+$ageM;
        }
        if ($ageM == 0){
            $pAge = "$ageY ปี";
        }else{
            $pAge = "$ageY ปี $ageM เดือน";
        }
        return $pAge;
    }
}

global $sIdname,$regisdate,$idcard,$mid,$hn,$yot,$name,$surname,$education,$goup,$married,$Y,$y,$m,$d, 
$dbirth,$guardian,$idguard,$nation,$religion,$career,$ptright,$ptrightdetail,$address, 
$tambol,$ampur,$changwat,$hphone,$phone,$father,$mother,$couple,$note, 
$sex,$camp,$race,$ptf,$ptfadd,$ptffone,$ptfmon,$blood,$drugreact,$phone2,$hospcode,$ptrcode,$typeservice,
$birthdate,$cAge;

$hospcode = $_POST['hospcode'];
$ptrcode = $_POST['rdo1'];
$name = trim($_POST['name']);
$surname = trim($_POST['surname']);
$Thaidate = date("d-m-").(date("Y")+543);

$dbirth = "$y-$m-$d";
$birthdate = "$d-$m-$y";
$cAge = calcage2($dbirth);
$ptname = $yot.' '.$name.' '.$surname;

$pdf = new PDF_AutoPrint("P",'mm', "A4");
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(17, 9);
$pdf->AddPage();
$pdf->SetFont('THSarabun', '', 15);

$pdf->SetXY(17, 9);
$pdf->Image('../images/logo.jpg',17,9,24,23,'JPG');

$pdf->SetXY(52, 9);
$pdf->SetFont('THSarabun', 'B', 25);
$pdf->Cell(70, 6, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'C');

$pdf->SetXY(52, 18);
$pdf->SetFont('THSarabun', 'B', 18);
$pdf->Cell(70, 6, 'มทบ. 32 จ.ลำปาง โทร.(054)839305', 0, 1, 'C');

$pdf->SetXY(52, 24);
$pdf->Cell(70, 6, 'เวชระเบียน/MEDICAL RECORD', 0, 1, 'C');

$pdf->SetXY(17, 34);
$pdf->SetFont('THSarabun', 'B', 15);
$pdf->Cell(70, 4, 'เลขที่บัตรประชาชน', 0, 1);

$pdf->SetXY(17, 38);
$pdf->SetFont('THSarabun', '', 15);
$pdf->Cell(70, 4, $idcard, 0, 1);

$pdf->SetXY(87, 34);
$pdf->SetFont('THSarabun', 'B', 15);
$pdf->Cell(70, 4, 'วันที่ลงทะเบียน', 0, 1);

$pdf->SetXY(87, 38);
$pdf->SetFont('THSarabun', '', 15);
$pdf->Multicell(70, 4, $Thaidate."\n".$sOfficer.' จนท.ทำประวัติ', 0, 1);

#$pdf->Rect(17, 46, 140, 12);

$pdf->SetXY(17, 46);
$pdf->SetFont('THSarabun', 'B', 15);
$pdf->Cell(140, 4, 'ชื่อ', 0, 1);
$pdf->SetXY(17, 50);
$pdf->SetFont('THSarabun', '', 15);
$pdf->Cell(140, 4, $ptname, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 56);
$pdf->Cell(50, 4, 'วัน เดือน ปีเกิด', 0, 1);
$pdf->SetXY(67, 56);
$pdf->Cell(40, 4, 'เพศ', 0, 1);
$pdf->SetXY(107, 56);
$pdf->Cell(50, 4, 'อายุ', 0, 1);

$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 60);
$pdf->Cell(50, 4, $birthdate, 0, 1);
$pdf->SetXY(67, 60);
$pdf->Cell(40, 4, $sex, 0, 1);
$pdf->SetXY(107, 60);
$pdf->Cell(50, 4, $cAge, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 66);
$pdf->Cell(50, 4, 'ศาสนา', 0, 1);
$pdf->SetXY(67, 66);
$pdf->Cell(40, 4, 'เชื้อชาติ', 0, 1);
$pdf->SetXY(107, 66);
$pdf->Cell(50, 4, 'สัญชาติ', 0, 1);

$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 70);
$pdf->Cell(50, 4, $religion, 0, 1);
$pdf->SetXY(67, 70);
$pdf->Cell(40, 4, $race, 0, 1);
$pdf->SetXY(107, 70);
$pdf->Cell(50, 4, $nation, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 76);
$pdf->Cell(50, 4, 'บิดา', 0, 1);
$pdf->SetXY(67, 76);
$pdf->Cell(40, 4, 'มารดา', 0, 1);
$pdf->SetXY(107, 76);
$pdf->Cell(50, 4, 'คู่สมรส', 0, 1);

$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 80);
$pdf->Cell(50, 4, $father, 0, 1);
$pdf->SetXY(67, 80);
$pdf->Cell(40, 4, $mother, 0, 1);
$pdf->SetXY(107, 80);
$pdf->Cell(50, 4, $couple, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 86);
$pdf->Cell(50, 4, 'สถานะภาพ', 0, 1);
$pdf->SetXY(67, 86);
$pdf->Cell(40, 4, 'อาชีพ', 0, 1);

$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 90);
$pdf->Cell(50, 4, $married, 0, 1);
$pdf->SetXY(67, 90);
$pdf->Cell(40, 4, $career, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 96);
$pdf->Cell(50, 4, 'ที่อยู่ปัจจุบัน', 0, 1);
$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 100);
$patient_address = "$address ตำบล$tambol อำเภอ$ampur จังหวัด$changwat โทร.$phone $hphone";
$pdf->Multicell(140, 4, $patient_address, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 106);
$pdf->Cell(50, 4, 'ชื่อผู้ติดต่อ', 0, 1);
$pdf->SetXY(67, 106);
$pdf->Cell(40, 4, 'เกี่ยวข้อง', 0, 1);
$pdf->SetXY(107, 106);
$pdf->Cell(50, 4, 'โทรศัพท์', 0, 1);

$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 110);
$pdf->Cell(50, 4, $ptf, 0, 1);
$pdf->SetXY(67, 110);
$pdf->Cell(40, 4, $ptfadd, 0, 1);
$pdf->SetXY(107, 110);
$pdf->Cell(50, 4, $ptffone, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 116);
$pdf->Cell(140, 4, 'สิทธิการรักษา', 0, 1);
$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 120);
$pdf->Cell(140, 4, $ptright, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 126);
$pdf->Cell(140, 4, 'สังกัด/ที่ทำงาน', 0, 1);
$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 130);
$pdf->Cell(140, 4, $camp, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 136);
$pdf->Cell(140, 4, 'หมายเหตุ', 0, 1);
$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 140);
$pdf->Cell(140, 4, $note, 0, 1);

$pdf->SetFont('THSarabun', 'B', 15);
$pdf->SetXY(17, 146);
$pdf->Cell(50, 4, 'กรุ๊ปเลือด', 0, 1);
$pdf->SetXY(67, 146);
$pdf->Cell(40, 4, 'แพ้ยา', 0, 1);

$pdf->SetFont('THSarabun', '', 15);
$pdf->SetXY(17, 150);
$pdf->Cell(50, 4, $blood, 0, 1);
$pdf->SetXY(67, 150);
$pdf->Cell(40, 4, $drugreact, 0, 1);

// dump($blood);
// dump($drugreact);
// // dump($ptffone);
// exit;

$dir = dirname(__FILE__);

$file = $dir.DS.'syncfile'.DS.$vHN.'.pdf';

$pdf->Output($file,'F');

