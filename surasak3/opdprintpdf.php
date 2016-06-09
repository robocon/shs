<?php
include 'bootstrap.php';

$page = input_post('page');
// var_dump($page);
// $cHn = input_post('cHn');

// exit;

if( $page === false ){
	$cHn = input_get('cHn');
	$db = Mysql::load();

	$sql = "SELECT `no_card`,`name`,`surname` FROM `opcard` WHERE `hn` = :cHn ";
	$data = array(':cHn' => $cHn);
	$db->select($sql, $data);
	$row = $db->get_item();
	

	// exit;
	// $result = mysql_query($query) or die("Query failed");
	// $row = mysql_fetch_array($result);

	
	?>
	<script>
	function chkfrm(){
		if(document.getElementById('no_card').value==""){
			alert("กรุณาใส่เลขหน้าสุดท้ายด้วยค่ะ");
			return false;
		}else{
			return true;
		}
	}
	</script>
	<form action="opdprintpdf.php?cHn=<?=$cHn;?>" method="post" name="form2" onSubmit="return chkfrm();">
		<?=$cHn ?>&nbsp;&nbsp;<?=$row['name']?>&nbsp;&nbsp;  <?=$row['surname']?>
		<br>กรุณาใส่เลขหน้าสุดท้าย <input type="text" name="no_card" value="<?=$row['no_card']?>" id="page" size="10">
		<input type="submit" value="   ตกลง   " name="send">
		<input type="hidden" name="page" value="print">
		<input type="hidden" name="hn" value="<?=$cHn;?>">
	</form>
	<?php
	
}elseif( $page === 'print' ){

	$cHn = input_post('hn');
	$no_card = input_post('no_card');
	if( $cHn === false ){
		echo 'ไม่พบข้อมูล hn กรุณาเลือกข้อมูลใหม่อีกครั้ง';
		exit;
	}
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

	$db = Mysql::load();

	$sql = "UPDATE `opcard` 
	SET `no_card` = :no_card 
	WHERE `hn` = :hn LIMIT 1 ;";
	$data = array(
		':no_card' => $no_card,
		':hn' => $cHn
	);	
	$db->update($sql, $data);


	$sql = "SELECT `hn`,`idcard`,`yot`,`name`,`surname`,`ptright`,`dbirth`,`no_card`
	FROM  `opcard` 
	WHERE  `hn` LIKE  :hn_patient ";
	$data = array(':hn_patient' => $cHn);
	$db->select($sql, $data);
	$item = $db->get_item();

	// var_dump($cHn);
	// var_dump($item);
	// exit;

	$pdf = new PDF_AutoPrint("P",'mm', "A4");
	$pdf->SetThaiFont(); // เซ็ตฟอนต์
	$pdf->SetAutoPageBreak(false, 0);
	$pdf->SetMargins(0, 0);
	$pdf->SetTopMargin(2);
	$pdf->AddPage();
	$pdf->SetFont('THSarabun'); // เรียกใช้งานฟอนต์ที่เตรียมไว้

	$pdf->SetFontSize(17);

	$pdf->SetXY(185, 12);
	$pdf->Cell(10, 6, $item['no_card'],0,1);

	$pdf->SetXY(45, 24);
	$pdf->Cell(40, 6, $item['hn'],0,1);

	$pdf->SetXY(110, 24);
	$pdf->Cell(100, 6, $item['yot'].' '.$item['name'].' '.$item['surname'],0,1);

	$pdf->SetXY(45, 32);
	$pdf->Cell(0, 6, "ว/ด/ป เกิด: ".$item['dbirth']." ID: ".$item['idcard']." สิทธิ: ".$item['ptright'],0,1);

	// $pdf->AutoPrint(true);
	$pdf->Output();
	exit;

}