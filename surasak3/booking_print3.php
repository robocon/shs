<?php

include '../bootstrap.php';
include '../fpdf_thai/fpdf_thai.php';

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
		$lines=file($file);
		$data=array();
		foreach($lines as $line)
			$data[]=explode(';',chop($line));
		return $data;
	}
}






function calcage($birth){

	$today = getdate();
	$nY = $today['year'];
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
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


$row_id = trim($_GET['row_id']);
$sql = "SELECT * FROM  `booking`  WHERE  `row_id` ='".$row_id."' ";
$query = mysql_query($sql); 
$dbarr = mysql_fetch_array($query);
$age = calcage($dbarr['bdate']);


$pdf = new PDF_AutoPrint("P",'mm', "A4");
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(0, 0);
$pdf->SetTopMargin(2);
$pdf->AddPage();
$pdf->SetFont('THSarabun'); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$pdf->SetFontSize(17);
$pdf->Cell(0, 4, "กอง/แผนก/ส่วน ศูนย์ผู้ป่วยใน  เอกสารหมายเลข FR-IPC-001/3  แก้ไขครั้งที่ 00  วันที่มีผลบังคับใช้ 28 ก.พ.44",0,1,"C");

$pdf->SetFontSize(30);
$pdf->Cell(0, 10, "ใบจองเตียง",0,1,"C");

$pdf->SetFontSize(23);
$pdf->Cell(0, 8, "โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง",0,1,"C");

$pdf->SetXY(0, 26);
$pdf->Cell(30, 6, "ชื่อ-สกุล",0,1);
$pdf->SetXY(30, 26);
$pdf->Cell(60, 6, $dbarr['ptname'],0,1);
$pdf->SetXY(90, 26);
$pdf->Cell(40, 6, "อายุ",0,1);
$pdf->SetXY(130, 26);
$pdf->Cell(80, 6, $age,0,1);

$pdf->SetXY(0, 34);
$pdf->Cell(30, 6, "HN",0,1);
$pdf->SetXY(30, 34);
$pdf->Cell(60, 6, $dbarr['hn'],0,1);
$pdf->SetXY(90, 34);
$pdf->Cell(40, 6, "รับป่วยเมื่อ",0,1);
$pdf->SetXY(130, 34);
$pdf->Cell(80, 6, $dbarr['date_in'],0,1);

$pdf->SetXY(0, 42);
$pdf->Cell(30, 6, "DX",0,1);
$pdf->SetXY(30, 42);
$pdf->Cell(60, 6, $dbarr['diag'],0,1);
$pdf->SetXY(90, 42);
$pdf->Cell(40, 6, "แพทย์",0,1);
$pdf->SetXY(130, 42);
$pdf->Cell(80, 6, $dbarr['doctor'],0,1);

$pdf->SetXY(0, 50);
$pdf->Cell(30, 6, "หอผู้ป่วย",0,1);
$pdf->SetXY(30, 50);
$pdf->Cell(60, 6, $dbarr['ward'],0,1);
$pdf->SetXY(90, 50);
$pdf->Cell(40, 6, "เตียง/ห้อง",0,1);
$pdf->SetXY(130, 50);
$pdf->Cell(80, 6, $dbarr['bed'],0,1);

$pdf->SetXY(0, 58);
$pdf->Cell(0, 6, "สิทธิการรักษา".$dbarr['ptright'],0,1);

$pdf->SetXY(0, 66);
$pdf->Cell(65, 6, "ผู้จอง.........................",0,1);
$pdf->SetXY(65, 66);
$pdf->Cell(65, 6, "ผู้รับจอง.....................",0,1);
$pdf->SetXY(130, 66);
$pdf->Cell(80, 6, "วันที่จอง ".$dbarr['date_regis'],0,1);
$pdf->Ln();

$pdf->SetFont('THSarabun',"B",17);
$pdf->Cell(0, 6, "คำแนะนำเมื่อมีการจองเตียงเพื่อรับนอนโรงพยาบาล",0,1);

$pdf->SetFont('THSarabun',"",17);
$pdf->Cell(0, 6, "1.ให้มาติดต่อแผนกทะเบียนตามวัน-เวลาที่ระบุในใบนัดเพื่อทำเอกสารการรับป่วย",0,1);
$pdf->Cell(0, 6, "2.ให้นำบัตรประจำตัวประชาชนของผู้ป่วยมาด้วยในวันที่จะเข้านอนโรงพยาบาล",0,1);

$pdf->SetFont('THSarabun',"B",17);
$pdf->Cell(0, 6, "3.กรณีจองห้องพิเศษไว้ โรงพยาบาลจะสำรวจเตียงก่อนวันนอน 1 วัน  หากห้องพิเศษไม่ว่างจะต้องนอนห้องรวมก่อน",0,1);
$pdf->Cell(0, 6, "จนกว่าห้องพิเศษจะว่างจึงจะย้ายเข้าแทนได้ และต้องมีคนนอนเฝ้าตลอด 24 ชม.",0,1);

$pdf->SetFont('THSarabun',"",17);
$pdf->Cell(0, 6, "4.สอบถามข้อมูลการจองเตียงล่วงหน้าได้ 1 วัน ก่อนการมานอนโรงพยาบาล",0,1);

$pdf->SetFont('THSarabun',"BU",17);
$pdf->Cell(0, 6, "ที่เบอร์โทร 054-839305 ต่อ 1120-1121",0,1);

$pdf->SetFont('THSarabun',"",17);
$pdf->Cell(0, 6, "5.หากท่านไม่มาตามนัด เกินเวลา 14.00 น. ทางโรงพยาบาลขอสงวนสิทธิ์ยกเลิกการจองเตียง/ห้อง",0,1);
$pdf->Cell(0, 6, "เพื่อบริหารเตียงสำหรับผู้ป่วยรายอื่นต่อไป",0,1);
$pdf->Cell(0, 6, ".................................. ผู้ทบทวน .................................. ผู้ป่วย/ญาติ ......../........../.........",0,1);


// $pdf->AutoPrint(true);
$pdf->Output();
