<?php
// README! 
// พิมพ์สติกเกอร์แบบ PDF สำหรับหน้าซักประวัติที่เป็นฟอร์มกรอกข้อมูล และหน้าของ OPD แบบพิมพ์ย้อนหลัง
// require("fpdf_thai/fpdf_thai.php");
session_start();
require_once 'fpdf_thai/shspdf.php';
include("connect.php");

class PDF_JavaScript2 extends FPDF_Thai {

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

class PDF_AutoPrint2 extends PDF_JavaScript2{
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

function calcage($birth){

	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM <0 ) {
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

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist, 
`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`,
`grade`,`mind`,`the_pill`
From opd 
where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$grade,$mind,$the_pill) = Mysql_fetch_row($result_dt_hn);

$ht = $height/100;
$bmi=number_format($weight /($ht*$ht),2);

if( empty($painscore) ){
	$painscore = '-';
}

$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){
	$cigarette='ไม่สูบ';
}else if($cigarette==1){
	$cigarette='สูบ '.$smoke_amount.' มวน/สัปดาห์';
}else{
	$cigarette='เคยสูบ';
}

if($alcohol==0){
	$alcohol='ไม่ดื่ม';
}else if($alcohol==1){
	$alcohol='ดื่ม '.$drink_amount.' แก้ว/สัปดาห์';
}else{
	$alcohol='เคยดื่ม';
}

if($drugreact == 0){
	$congenital_disease .=" , ผู้ป่วยไม่แพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$congenital_disease .= " , แพ้ยา : ".$list_drug;
}

if( empty($weight) ){
	$weight = 0;
}
if( empty($height) ){
	$height = 0;
	$ht = 0;
}else{
	$ht = $height/100;
}

$bmi = number_format(($weight / ( $ht * $ht)), 2);

$sql111 = "Select dbirth From opcard where hn='$hn' ";
$result111 = Mysql_Query($sql111);
list($dbirth) = Mysql_fetch_row($result111);
$cAge = calcage($dbirth);


$pdf = new PDF_AutoPrint2('L', 'mm', array( 85, 53));
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);
$pdf->AddPage();

$full_text = "HN: $hn, $thidate, $cAge\n";
$full_text .= "VN: $vn, T: $temperature C, P: $pause ครั้ง/นาที, R: $rate ครั้ง/นาที\n";
$full_text .= "BP: $bp1 / $bp2 mmHg, นน: $weight กก., สส: $height ซม.\n";

if( !empty( $waist ) ){
	$full_text .= "รอบเอว: $waist ซม., ";
}

if( !empty($bp3) && !empty($bp4) ){
	$full_text .= "Repeat BP: $bp3 / $bp4 mmHg\n";
}

$full_text .= "บุหรี่: $cigarette, สุรา: $alcohol, bmi: $bmi, PS: $painscore\n";

if ( !empty($mens) ) { 

	$mens_lists = array(1=>'ยังไม่มีประจำเดือน','หมดประจำเดือน','ยังมีประจำเดือน');

	$mens_txt = '';
	if ( $mens == 3 ) {
		
		if( !empty($the_pill) ){
			$mens_txt .= ' คุมกำเนิด';
		}else{
			$mens_y = substr($mens_date,0,4);
			$mens_date_txt = ($mens_y+543).substr($mens_date,4,10);
			$mens_txt .= ' ล่าสุดวันที่: '.$mens_date_txt;
		}
	}

	$full_text .= "ปจด: ".$mens_lists[$mens].$mens_txt."\n";
}

if ( !empty($vaccine) ) {

	$vacc_lists = array(1=>'ตามเกณฑ์', 'ไม่ตามเกณฑ์');
	$psmoke_lists = array(1=>'สูบบุหรี่','ไม่สูบบุหรี่');
	$pdrink_lists = array(1=>'ดื่มสุรา','ไม่ดื่มสุรา');

	$parent_txt = $psmoke_lists[$parent_smoke];
	
	if( $parent_smoke == 1 ){
		$parent_txt .= ' '.$parent_smoke_amount.' มวน/วัน';
	}
	$parent_txt .= ' ';
	$parent_txt .= $pdrink_lists[$parent_drink];
	if( $parent_drink == 1 ){
		$parent_txt .= ' '.$parent_drink_amount.' แก้ว/สัปดาห์';
	}
	
	$full_text .= "วัคซีน: ".$vacc_lists[$vaccine].' ผปค: '.$parent_txt." \n";
}

$full_text .="Triage Gr. : ".$grade." สภาวะจิตใจ : ".$mind."\n";

$full_text .= "ลักษณะ: $type, คลินิก: ".$clinic."\n";
$full_text .= "โรคประจำตัว: ".trim($congenital_disease)."\n";

if ( !empty($ht_amount) OR !empty($dm_amount) ) {

	$htdm = '';
	if ( !empty($ht_amount) ) {
		$htdm .= 'HT: เป็นมาแล้ว '.$ht_amount.'ปี';
	}

	if ( !empty($dm_amount) ) {
		if(!empty($ht_amount))
		{
			$htdm .= ' ';
		}
		$htdm .= 'DM: เป็นมาแล้ว '.$dm_amount.'ปี';
	}

	$full_text .= $htdm." \n";
}

if(!empty($organ))
{
	$full_text .= "อาการ: ".trim(htmlspecialchars_decode($organ, ENT_QUOTES))." \n";
}


if ( !empty($hpi) ) { 
	$full_text .= "HPI: ".$hpi." \n";
}

$pdf->SetXY(2, 2);
$pdf->MultiCell(0, 5, $full_text);

if($_SESSION['smenucode'] == 'ADM' OR $_SESSION['smenucode'] == 'ADMEYE')
{
	$dthn = $_GET['dthn'];
	$sql = "SELECT * FROM `pt_opd_eye` WHERE `thdatehn` = '$dthn' ";
	$q = mysql_query($sql);
	$item = mysql_fetch_assoc($q);

	$pdf->AddPage();
	$pdf->SetXY(2, 2);
	$esr_not = empty($item['esr_not']) ? '            ' : ' '.$item['esr_not'].' ' ;
	$esl_not = empty($item['esl_not']) ? '            ' : ' '.$item['esl_not'].' ' ;
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, "NOT RE ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esr_not);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, " LE ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esl_not);
	
	$esr = empty($item['esr']) ? '            ' : ' '.$item['esr'].' ' ;
	$esr_ph = empty($item['esr_ph']) ? '            ' : ' '.$item['esr_ph'].' ' ;
	$esr_glass = empty($item['esr_glass']) ? '            ' : ' '.$item['esr_glass'].' ' ;
	$pdf->SetXY(9, 7);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, "VA RE ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esr);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, " PH ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esr_ph);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, " with glass ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esr_glass);

	$esl = empty($item['esl']) ? '            ' : ' '.$item['esl'].' ' ;
	$esl_ph = empty($item['esl_ph']) ? '            ' : ' '.$item['esl_ph'].' ' ;
	$esl_glass = empty($item['esl_glass']) ? '            ' : ' '.$item['esl_glass'].' ' ;
	$pdf->SetXY(14, 12);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, "LE ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esl);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, " PH ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esl_ph);
	$pdf->SetFont('THSarabun','',14);
	$pdf->Write(5, " with glass ");
	$pdf->SetFont('THSarabun','U',14);
	$pdf->Write(5, $esl_glass);

}

$pdf->AutoPrint(true);
$pdf->Output();
?>