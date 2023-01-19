<?php
// README! 
// พิมพ์สติกเกอร์แบบ PDF สำหรับหน้าซักประวัติที่เป็นฟอร์มกรอกข้อมูล และหน้าของ OPD แบบพิมพ์ย้อนหลัง
// require("fpdf_thai/fpdf_thai.php");
session_start();
include 'fpdf_thai/shspdf.php';
include("connect.php");
mysql_query("SET CHARACTER SET windows-874");

function to874($txt){
	return iconv("UTF-8", "WINDOWS-874", $txt);
}
class PDF extends FPDF_Thai{}

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
`grade`,`mind`,`the_pill`,`cvriskscore`,`cvriskscore_lab` 
From opd 
where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi,$grade,$mind,$the_pill,$cvriskscore,$cvriskscore_lab) = Mysql_fetch_row($result_dt_hn);

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

$drugreact_text = '';
if($drugreact == 0){
	$drugreact_text = " , ผู้ป่วยไม่แพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$drugreact_text = ' , แพ้ยา : '.iconv("UTF-8","WINDOWS-874",implode(", ",$list));
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


$pdf = new SHSPdf('L', 'mm', array( 85, 53));
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

$full_text .="Triage Gr. : ".$grade." สภาวะจิตใจ : ".iconv("UTF-8","WINDOWS-874",$mind)."\n";
$type = iconv("UTF-8","WINDOWS-874",$type);
$clinic = iconv("UTF-8","WINDOWS-874",$clinic);
$full_text .= "ลักษณะ: $type, คลินิก: ".$clinic."\n";
$full_text .= "โรคประจำตัว: ".iconv("UTF-8","WINDOWS-874",$congenital_disease)."$drugreact_text\n";

if ( !empty($ht_amount) OR !empty($dm_amount) ) {

	$htdm = '';
	if ( !empty($ht_amount) ) {
		$htdm .= 'HT: เป็นมาแล้ว '.$ht_amount.'ปี';
	}
	
	if ( !empty($dm_amount) ) {
		$htdm .= ' DM: เป็นมาแล้ว '.$dm_amount.'ปี';
	}

	$full_text .= $htdm." \n";
}

$full_text .= "อาการ: ".iconv("UTF-8","WINDOWS-874",trim(htmlspecialchars_decode($organ, ENT_QUOTES)))." \n";

if ( !empty($hpi) ) { 
	$full_text .= "HPI: ".iconv("UTF-8","WINDOWS-874",trim(htmlspecialchars_decode($hpi, ENT_QUOTES)))." \n";
}

if ( !empty($cvriskscore) ) { 
	$full_text .= "CV Risk Score: ".$cvriskscore." \n";
}

if ( !empty($cvriskscore_lab) ) { 
	$full_text .= "CV Risk Score(LAB): ".$cvriskscore_lab." \n";
}

$pdf->SetXY(2, 2);
$pdf->MultiCell(0, 5, $full_text);

if($_SESSION['smenucode'] == 'ADMEYE')
{
	$dthn = $_GET['dthn'];
	$sql = "SELECT * FROM `pt_opd_eye` WHERE `thdatehn` = '$dthn' ";
	$q = mysql_query($sql);

	if(mysql_num_rows($q) > 0)
	{
		$item = mysql_fetch_assoc($q);

		$pdf->AddPage();

		$getY = $pdf->getY();
		$pdf->SetXY(2, $getY+5);
		$pdf->SetFont('THSarabun','B',14);
		$pdf->Write(5, "EYE Screening");

		$getY = $pdf->getY();
		$pdf->SetXY(2, $getY+5);
		$esr_not = empty($item['esr_not']) ? '            ' : ' '.to874($item['esr_not']).' ' ;
		$esl_not = empty($item['esl_not']) ? '            ' : ' '.to874($item['esl_not']).' ' ;
		$pdf->SetFont('THSarabun','',14);
		$pdf->Write(5, "NOT RE ");
		$pdf->SetFont('THSarabun','U',14);
		$pdf->Write(5, $esr_not);
		$pdf->SetFont('THSarabun','',14);
		$pdf->Write(5, " LE ");
		$pdf->SetFont('THSarabun','U',14);
		$pdf->Write(5, $esl_not);
		
		$getY = $pdf->getY();
		$esr = empty($item['esr']) ? '            ' : ' '.to874($item['esr']).' ' ;
		$esr_ph = empty($item['esr_ph']) ? '            ' : ' '.to874($item['esr_ph']).' ' ;
		$esr_glass = empty($item['esr_glass']) ? '            ' : ' '.to874($item['esr_glass']).' ' ;
		$pdf->SetXY(4, $getY+5);
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

		$getY = $pdf->getY();
		$esl = empty($item['esl']) ? '            ' : ' '.to874($item['esl']).' ' ;
		$esl_ph = empty($item['esl_ph']) ? '            ' : ' '.to874($item['esl_ph']).' ' ;
		$esl_glass = empty($item['esl_glass']) ? '            ' : ' '.to874($item['esl_glass']).' ' ;
		$pdf->SetXY(9, $getY+5);
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
		
		if(!empty($item['nurse_dx1']) OR !empty($item['nurse_dx2']) OR !empty($item['nurse_dx3']) OR !empty($item['nurse_dx4']) OR !empty($item['nurse_dx5']))
		{
			$getY = $pdf->getY();
			$pdf->SetXY(2, $getY+10);
			$pdf->SetFont('THSarabun','B',14);
			$pdf->Write(5, "Nursing DX");
			
			if(!empty($item['nurse_dx1'])){ 
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['nurse_dx1']));
				$pdf->SetFont('THSarabun','U',14);
				$pdf->Write(5, ' '.to874($item['nurse_dx1_txt']));
			}

			if(!empty($item['nurse_dx2'])){ 
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['nurse_dx2']));
				$pdf->SetFont('THSarabun','U',14);
				$pdf->Write(5, ' '.to874($item['nurse_dx2_txt']));
			}

			if(!empty($item['nurse_dx3'])){ 
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['nurse_dx3']));
				$pdf->SetFont('THSarabun','U',14);
				$pdf->Write(5, ' '.to874($item['nurse_dx3_txt']));
			}

			if(!empty($item['nurse_dx4'])){ 
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['nurse_dx4']));
			}

			if(!empty($item['nurse_dx5'])){ 
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['nurse_dx5']));
			}
			
		}
		
		if(!empty($item['imp1']) OR !empty($item['imp2']) OR !empty($item['imp3']) OR !empty($item['imp4']) OR !empty($item['imp5']) OR !empty($item['imp6']))
		{
			$getY = $pdf->getY();
			$pdf->SetXY(2, $getY+10);
			$pdf->SetFont('THSarabun','B',14);
			$pdf->Write(5, "Implementation");

			if(!empty($item['imp1'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['imp1']));

			}
			if(!empty($item['imp2'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['imp2']));
				$pdf->SetFont('THSarabun','U',14);
				$pdf->Write(5, ' '.to874($item['imp2_txt']));
			}
			if(!empty($item['imp3'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['imp3']));
			}
			if(!empty($item['imp5'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['imp5']));
			}
			if(!empty($item['imp6'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['imp6']));
				$pdf->SetFont('THSarabun','U',14);
				$pdf->Write(5, ' '.to874($item['imp6_txt']));
			}
			
		}

		if(!empty($item['imp1']) OR !empty($item['imp2']) OR !empty($item['imp3']) OR !empty($item['imp4']) OR !empty($item['imp5']) OR !empty($item['imp6']))
		{ 
			$getY = $pdf->getY();
			$pdf->SetXY(2, $getY+10);
			$pdf->SetFont('THSarabun','B',14);
			$pdf->Write(5, "Evaluation");

			if(!empty($item['eva1'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva1']));
			}
			if(!empty($item['eva2'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva2']));
			}
			if(!empty($item['eva3'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva3']));
			}
			if(!empty($item['eva4'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva4']));
			}
			if(!empty($item['eva5'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva5']));
			}
			if(!empty($item['eva6'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva6']));
			}
			if(!empty($item['eva7'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva7']));
			}
			if(!empty($item['eva8'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva8']));
			}
			if(!empty($item['eva9'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva9']));
			}
			if(!empty($item['eva10'])){
				$getY = $pdf->getY();
				$pdf->SetXY(2, $getY+5);
				$pdf->SetFont('THSarabun','',14);
				$pdf->Write(5, '- '.to874($item['eva10']));
				$pdf->SetFont('THSarabun','U',14);
				$pdf->Write(5, ' '.to874($item['eva10_txt']));
			}
		}

		$getY = $pdf->getY();
		$pdf->SetXY(2, $getY+5);
		$pdf->SetFont('THSarabun','',14);
		$pdf->Write(5, 'ผู้ป่วยรับทราบ ');
		$pdf->SetFont('THSarabun','U',14);
		$pdf->Write(5, $_SESSION['sOfficer']);
		$pdf->SetFont('THSarabun','',14);
		$pdf->Write(5, ' /RN,PN ');
	}
}

$pdf->AutoPrint(true);
$pdf->Output();
?>