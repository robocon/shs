<?php

// include ตัวหลัก
include 'fpdf_thai.php';

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
}


/**
 * @todo ยังมีปัญหาเรื่องการ extends หลายๆ class จากข้อจำกัดด้าน Version ของ PHP 
 */
class SHSPdf extends PDF_AutoPrint
{

	// private $c;

	function __construct($orientation='P', $unit='mm', $size='A4')
	{
		parent::__construct($orientation, $unit, $size);
		// $this->init();
	}

	// public function init(){
	// 	$this->c = new PDF_AutoPrint();
	// }

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

	// public function __call($method, $args){
	// 	// var_dump($args);
	// 	$this->c->$method($args['0']);
	// }

}
