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
	<form action="opdprint2.php?cHn=<?=$cHn;?>" method="post" name="form2" onSubmit="return chkfrm();">
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

// print "<DIV style='left:150PX;top:50PX;width:200PX;height:30PX;'><span class='fc1-0'>$vHN</span></DIV>";
// print "<DIV style='left:370PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$ptname</span></DIV>";
// print "<DIV style='left:660PX;top:5PX;width:700PX;height:30PX;'><span class='fc1-0'>$page</span></DIV>";
// print "<DIV style='left:150PX;top:80PX;width:700PX;height:30PX;'><span class='fc1-1'>ว/ด/ป เกิด&nbsp;$dbirth&nbsp;&nbsp;ID:$idcard&nbsp;&nbsp;$ptright</span></DIV>";


	$pdf->SetXY(0, 0);
	$pdf->Cell(30, 6, $item['no_card'],0,1);
	$pdf->SetXY(0, 6);
	$pdf->Cell(60, 6, $item['hn'],0,1);
	$pdf->SetXY(0, 12);
	$pdf->Cell(40, 6, $item['yot'].' '.$item['name'].' '.$item['surname'],0,1);
	$pdf->SetXY(0, 18);
	$pdf->Cell(80, 6, "ว/ด/ป เกิด: ".$item['dbirth']." ID: ".$item['idcard']." สิทธิ: ".$item['ptright'],0,1);

	// $pdf->AutoPrint(true);
	$pdf->Output();
	exit;

}


exit;


/*
if($_POST['page']!=""){

session_start();
$Thaidate=date("d-m-").(date("Y")+543);
$page = $_POST['page']+1;
Function calcage($birth){
$today = getdate();   
$nY  = $today['year']; 
$nM = $today['mon'] ;
$bY=substr($birth,0,4)-543;
$bM=substr($birth,5,2);
$ageY=$nY-$bY;
$ageM=$nM-$bM;
if ($ageM<0) {
$ageY=$ageY-1;
$ageM=12+$ageM;
}
if ($ageM==0){
$pAge="$ageY ปี";
}
else{
$pAge="$ageY ปี $ageM เดือน";
}
return $pAge;
}
//


$query = "SELECT * FROM opcard WHERE hn = '$cHn'";
$result = mysql_query($query)
or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
if (!mysql_data_seek($result, $i)) {
echo "Cannot seek to row $i\n";
continue;
}

if(!($row = mysql_fetch_object($result)))
continue;
}
If ($result){
$regisdate=$row->regisdate;
$idcard =$row->idcard;
$vHN =$row->hn;
$yot=$row->yot;
$name=$row->name;
$surname =$row->surname;
$ptname=$yot.' '.$name.'  '.$surname;
$goup =$row->goup;
$married =$row->married;
//	$cbirth (วันเกิดข้อความเก็บไว้ดู)
$cbirth =$row->cbirth; // (วันเกิดข้อความเก็บไว้ดู)
$dbirth =$row->dbirth;
$guardian=$row->guardian;
$idguard=$row->idguard;
$nation =$row->nation;
$religion =$row->religion;
$career =$row->career;
$ptright =$row->ptright;
$address =$row->address;
$tambol =$row->tambol;
$ampur =$row->ampur;
$changwat =$row->changwat;
$phone =$row->phone;
$father =$row->father;
$mother =$row->mother;
$couple =$row->couple;
$note=$row->note;
$sex =$row->sex;
$camp =$row->camp;
$race=$row->race;
//  2494-05-28
$d=substr($dbirth,8,2);
$m=substr($dbirth,5,2); 
$y=substr($dbirth,0,4); 
$birthdate="$d-$m-$y"; //print into opdcard
$cAge=calcage($dbirth);
$cPtname=$yot.' '.$name.'   &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; '.$surname;

$update = "update opcard set no_card='$page' where hn='$vHN'  ";
mysql_query($update);
}  
else {
echo "ไม่พบ HN : $cHn ";
}    
include("unconnect.inc");
print "<HTML>";

print "<script>";

print "ie4up=nav4up=false;";

print "var agt = navigator.userAgent.toLowerCase();";

print "var major = parseInt(navigator.appVersion);";

print "if ((agt.indexOf('msie') != -1) && (major >= 4))";

print "ie4up = true;";

print "if ((agt.indexOf('mozilla') != -1)  && (agt.indexOf('spoofer') == -1) && (agt.indexOf('compatible') == -1) && ( major>= 4))";

print "nav4up = true;";

print "</script>";



print "<head>";

print "<STYLE>";

print "A {text-decoration:none}";

print "A IMG {border-style:none; border-width:0;}";

print "DIV {position:absolute; z-index:25;}";

print ".fc1-0 { COLOR:000000;FONT-SIZE:20PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";

print ".fc1-1 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".fc1-2 { COLOR:000000;FONT-SIZE:17PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:BOLD;}";
print ".fc1-3 { COLOR:000000;FONT-SIZE:15PT;FONT-FAMILY:Cordia New;FONT-WEIGHT:NORMAL;}";

print ".ad1-0 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print ".ad1-1 {border-color:000000;border-style:none;border-bottom-width:0PX;border-left-width:0PX;border-top-width:0PX;border-right-width:0PX;}";

print "</STYLE>";



print "<TITLE>Crystal Report Viewer</TITLE>";

print "</head>";

print "<BODY BGCOLOR='FFFFFF' TOPMARGIN=0 BOTTOMMARGIN=0 RIGHTMARGIN=0 LEFTMARGIN='0'>";

print "<DIV style='z-index:0'> &nbsp; </div>";

print "<DIV style='left:150PX;top:50PX;width:200PX;height:30PX;'><span class='fc1-0'>$vHN</span></DIV>";
print "<DIV style='left:370PX;top:50PX;width:500PX;height:30PX;'><span class='fc1-0'>$ptname</span></DIV>";
print "<DIV style='left:660PX;top:5PX;width:700PX;height:30PX;'><span class='fc1-0'>$page</span></DIV>";
print "<DIV style='left:150PX;top:80PX;width:700PX;height:30PX;'><span class='fc1-1'>ว/ด/ป เกิด&nbsp;$dbirth&nbsp;&nbsp;ID:$idcard&nbsp;&nbsp;$ptright</span></DIV>";

print "</HTML>";
}else{
	
}
?>

*/