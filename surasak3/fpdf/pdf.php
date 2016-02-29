<?php

class PDF extends FPDF {

	function _getfontpath()
	{
		if(!defined('FPDF_FONTPATH') && is_dir(dirname(__FILE__).'/font'))
			define('FPDF_FONTPATH',dirname(__FILE__).'/font/');
		return defined('FPDF_FONTPATH') ? FPDF_FONTPATH : '';
	}

	function SetThaiFont() {
		$this->AddFont('AngsanaNew','','angsa.php');
		$this->AddFont('THSarabun','','THSarabun.php');
	}
	/*function SetThaiFont2() {
		
		$this->AddFont('THSarabun','','THSarabun.php');//¸ÃÃÁ´Ò
	}*/
	
	function conv($string) {
		return iconv('UTF-8', 'TIS-620', $string);
	}
	function LoadData($file)
{
	//Read file lines
	$lines=file($file);
	$data=array();
	foreach($lines as $line)
		$data[]=explode(';',chop($line));
	return $data;
}

}


?>
