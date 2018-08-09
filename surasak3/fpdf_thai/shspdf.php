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
		$this->AddFont('AngsanaNew','B','angsab.php');
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

	function SetDash($b = null, $w = null){
		if( $b !== null ){
			$s = sprintf('[%.3f %.3f] 0 d', $b * $this->k, $w * $this->k);
		}else{
			$s = '[] 0 d';
		}
		$this->_out($s);
	}

	// public function __call($method, $args){
	// 	// var_dump($args);
	// 	$this->c->$method($args['0']);
	// }

	function GetMultiCellHeight($w, $h, $txt, $border=null, $align='J') {
		// Calculate MultiCell with automatic or explicit line breaks height
		// $border is un-used, but I kept it in the parameters to keep the call
		//   to this function consistent with MultiCell()
		$cw = &$this->CurrentFont['cw'];
		if($w==0)
			$w = $this->w-$this->rMargin-$this->x;
		$wmax = ($w-2*$this->cMargin)*1000/$this->FontSize;
		$s = str_replace("\r",'',$txt);
		$nb = strlen($s);
		if($nb>0 && $s[$nb-1]=="\n")
			$nb--;
		$sep = -1;
		$i = 0;
		$j = 0;
		$l = 0;
		$ns = 0;
		$height = 0;
		while($i<$nb)
		{
			// Get next character
			$c = $s[$i];
			if($c=="\n")
			{
				// Explicit line break
				if($this->ws>0)
				{
					$this->ws = 0;
					$this->_out('0 Tw');
				}
				//Increase Height
				$height += $h;
				$i++;
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
				continue;
			}
			if($c==' ')
			{
				$sep = $i;
				$ls = $l;
				$ns++;
			}
			$l += $cw[$c];
			if($l>$wmax)
			{
				// Automatic line break
				if($sep==-1)
				{
					if($i==$j)
						$i++;
					if($this->ws>0)
					{
						$this->ws = 0;
						$this->_out('0 Tw');
					}
					//Increase Height
					$height += $h;
				}
				else
				{
					if($align=='J')
					{
						$this->ws = ($ns>1) ? ($wmax-$ls)/1000*$this->FontSize/($ns-1) : 0;
						$this->_out(sprintf('%.3F Tw',$this->ws*$this->k));
					}
					//Increase Height
					$height += $h;
					$i = $sep+1;
				}
				$sep = -1;
				$j = $i;
				$l = 0;
				$ns = 0;
			}
			else
				$i++;
		}
		// Last chunk
		if($this->ws>0)
		{
			$this->ws = 0;
			$this->_out('0 Tw');
		}
		//Increase Height
		$height += $h;
	
		return $height;
	}

}
