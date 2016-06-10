<?php
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

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

$Can = input_get('Can');
$Chn = input_get('Chn');

$db = Mysql::load();
$sql = "SELECT a.an, a.hn, a.date, a.bedcode, b.yot, b.name, b.surname, b.idcard, b.ptright, b.dbirth, b.sex, b.address, b.tambol, b.ampur, b.changwat, b.phone, b.ptf, b.ptfadd, b.ptffone, b.camp 
FROM `ipcard` AS a
LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
WHERE a.`an` = '$Can'";

$db->select($sql);
$item = $db->get_item();

list($adate, $tdate) = explode(' ', $item['date']);
$age = calcage($item['dbirth']);
$sex = ( $item['sex'] === 'ช' ) ? 'ชาย' : 'หญิง' ;

$pdf = new SHSPdf('P', 'mm', 'A4');

$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(3, 3, 3); // left, top, right
$pdf->AddPage();
$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$pdf->Cell(197, 7, 'DISCHARGE SUMMARY', 0, 1, 'C');
$pdf->Cell(197, 7, 'FORT SURASAKMONTRI HOSPITAL FR-MDO-001/1 , 05, 01 , ส.ค. 52', 0, 1, 'C');

$x = $pdf->GetX();
$y = $pdf->GetY();
// จุด x,y ตามหน้ากระดาษ ส่วนความกว้างสูงของกรอบตามของเดิม
// ตัวนี้เป็นกรอบใหญ่
$pdf->Rect($x,$y,197,35);

$pdf->SetXY(3, 17);
$pdf->Cell(85, 7, "ADMIT: $adate เวลา: $tdate", 0, 1);
$pdf->SetXY(88, 17);
$pdf->SetFont('THSarabun', 'B');
$pdf->Cell(45, 7, 'AN: '.$item['an'], 0, 1);
$pdf->SetXY(133, 17);
$pdf->Cell(67, 7, 'HN: '.$item['hn'], 0, 1);

$pdf->SetXY(3, 24);
$pdf->SetFont('THSarabun', 'B');
$pdf->Cell(85, 7, 'ชื่อ: '.$item['yot'].' '.$item['name'].' '.$item['surname'].' อายุ: '.$age, 0, 1);
$pdf->SetXY(88, 24);
$pdf->SetFont('THSarabun');
$pdf->Cell(45, 7, 'เพศ: '.$sex, 0, 1);
$pdf->SetXY(133, 24);
$pdf->Cell(67, 7, 'สังกัด: '.$sex, 0, 1);

$pdf->SetXY(3, 31);
$pdf->Cell(85, 7, 'เลข ปชช: '.$item['idcard'], 0, 1);
$pdf->SetXY(88, 31);
$pdf->Cell(45, 7, 'ว/ด/ป.เกิด: '.$item['dbirth'], 0, 1);
$pdf->SetXY(133, 31);
$pdf->Cell(67, 7, 'สิทธิ: '.$item['ptright'], 0, 1);

$pdf->SetXY(3, 38);
$pdf->Cell(85, 7, 'บ้านเลขที่: '.$item['address'].' ตำบล '.$item['tambol'].' อำเภอ '.$item['ampur'], 0, 1);
$pdf->SetXY(88, 38);
$pdf->Cell(45, 7, 'จังหวัด: '.$item['changwat'], 0, 1);
$pdf->SetXY(133, 38);
$pdf->Cell(67, 7, 'โทร: '.$item['phone'], 0, 1);

$pdf->SetXY(3, 45);
$pdf->Cell(85, 7, 'ผู้ที่ติดต่อได้: '.$item['ptf'].' เกี่ยวข้องเป็น: '.$item['ptfadd'], 0, 1);
$pdf->SetXY(88, 45);
$pdf->Cell(45, 7, 'โทรศัพท์: '.$item['ptffone'], 0, 1);
$pdf->SetXY(133, 45);
$pdf->Cell(67, 7, 'หอรับ:                        หอจำหน่าย', 0, 1);

$pdf->SetFontSize(12);
$pdf->Rect(3, 52, 21, 20);
$pdf->SetXY(3, 52);
$pdf->Cell(21, 5, 'Refer from', 0, 0, 'C');

$pdf->Rect(24, 52, 41, 20);
$pdf->SetXY(24, 52);
$pdf->Cell(41, 5, 'Discharge Date, Time', 0, 0, 'C');

$pdf->Rect(65, 52, 30, 20);
$pdf->SetXY(65, 52);
$pdf->Cell(30, 5, 'Length OF STAY(DAYS)', 0, 0, 'C');

$pdf->Rect(95, 52, 85, 20);
$pdf->SetXY(95, 52);
$pdf->Cell(85, 5, 'CONDITION FO INFANT AT BIRTH', 0, 0, 'C');

$pdf->Rect(101, 58, 3, 3); // กล่อง checkbox
$pdf->SetXY(105, 57);
$pdf->Cell(30, 5, 'LIVEBIRTH', 0, 1);

$pdf->Rect(136, 58, 3, 3); // กล่อง checkbox
$pdf->SetXY(140, 57);
$pdf->Cell(40, 5, 'CLINICALLY MATURE', 0, 1);

$pdf->Rect(101, 63, 3, 3); // กล่อง checkbox
$pdf->SetXY(105, 62);
$pdf->Cell(30, 5, 'STILLBBRITH', 0, 1);

$pdf->Rect(136, 63, 3, 3); // กล่อง checkbox
$pdf->SetXY(140, 62);
$pdf->Cell(40, 5, 'CLINICALLY PERMATURE', 0, 1);

$pdf->Rect(180, 52, 20, 20);
$pdf->SetXY(180, 52);
$pdf->Cell(20, 5, 'BIRTH WEIGHT', 0, 1, 'C');
$pdf->SetXY(180, 67);
$pdf->Cell(20, 5, 'GRAMS', 0, 1, 'C');

// ไม่ต้องมี Rect
$pdf->SetXY(3, 72);
$pdf->Cell(51, 5, 'Diagnosis', 1, 1);

$pdf->SetXY(54, 72);
$pdf->Cell(20, 5, 'ICD', 1, 1, 'C');

$pdf->SetXY(74, 72);
$pdf->Cell(26, 5, 'Physician', 1, 1, 'C');

$pdf->SetXY(100, 72);
$pdf->Cell(59, 5, 'Rx/Procedure/Operation', 1, 1, 'C');

$pdf->SetXY(159, 72);
$pdf->Cell(24, 5, 'ICD 9 CM', 1, 1, 'C');

$pdf->SetXY(183, 72);
$pdf->Cell(17, 5, 'Date', 1, 1, 'C');

// ต้องมี Rect
$pdf->Rect(3, 77, 51, 14);
$pdf->SetXY(3, 77);
$pdf->Cell(51, 5, 'Principle DX', 0, 1);

$pdf->SetXY(54, 77);
$pdf->Cell(20, 14, '', 1, 1);

$pdf->SetXY(74, 77);
$pdf->Cell(26, 14, '', 1, 1);

$pdf->SetXY(100, 77);
$pdf->Cell(59, 14, '', 1, 1);

$pdf->SetXY(159, 77);
$pdf->Cell(24, 14, '', 1, 1);

$pdf->SetXY(183, 77);
$pdf->Cell(17, 14, '', 1, 1);

$pdf->Rect(3, 91, 51, 52);
$pdf->SetXY(3, 91);
$pdf->Cell(51, 5, 'Comorbidity', 0, 1);

$pdf->SetXY(54, 91);
$pdf->Cell(20, 52, '', 1, 1);

$pdf->SetXY(74, 91);
$pdf->Cell(26, 52, '', 1, 1);

$pdf->SetXY(100, 91);
$pdf->Cell(59, 52, '', 1, 1);

$pdf->SetXY(159, 91);
$pdf->Cell(24, 52, '', 1, 1);

$pdf->SetXY(183, 91);
$pdf->Cell(17, 52, '', 1, 1);

$pdf->Rect(3, 143, 51, 24);
$pdf->SetXY(3, 143);
$pdf->Cell(51, 5, 'Complication', 0, 1);

$pdf->SetXY(54, 143);
$pdf->Cell(20, 24, '', 1, 1);

$pdf->SetXY(74, 143);
$pdf->Cell(26, 24, '', 1, 1);

$pdf->SetXY(100, 143);
$pdf->Cell(59, 24, '', 1, 1);

$pdf->SetXY(159, 143);
$pdf->Cell(24, 24, '', 1, 1);

$pdf->SetXY(183, 143);
$pdf->Cell(17, 24, '', 1, 1);

$pdf->Rect(3, 167, 51, 24);
$pdf->SetXY(3, 167);
$pdf->Cell(51, 5, 'Other', 0, 1);

$pdf->SetXY(54, 167);
$pdf->Cell(20, 24, '', 1, 1);

$pdf->SetXY(74, 167);
$pdf->Cell(26, 24, '', 1, 1);

$pdf->SetXY(100, 167);
$pdf->Cell(59, 24, '', 1, 1);

$pdf->SetXY(159, 167);
$pdf->Cell(24, 24, '', 1, 1);

$pdf->SetXY(183, 167);
$pdf->Cell(17, 24, '', 1, 1);

$pdf->Rect(3, 191, 51, 24);
$pdf->SetXY(3, 191);
$pdf->Cell(51, 5, 'External Cause of injuries', 0, 1);

$pdf->SetXY(54, 191);
$pdf->Cell(20, 24, '', 1, 1);

$pdf->SetXY(74, 191);
$pdf->Cell(26, 24, '', 1, 1);

$pdf->SetXY(100, 191);
$pdf->Cell(59, 24, '', 1, 1);

$pdf->SetXY(159, 191);
$pdf->Cell(24, 24, '', 1, 1);

$pdf->SetXY(183, 191);
$pdf->Cell(17, 24, '', 1, 1);

$pdf->Rect(3, 215, 197, 10);
$pdf->SetXY(9, 215);
$pdf->Cell(19, 5, 'PROCECURE', 0, 1);

$pdf->SetXY(28, 215);
$pdf->Cell(32, 5, '( ) Tracheostomy', 0, 1);

$pdf->SetXY(60, 215);
$pdf->Cell(39, 5, '( ) Respirator support', 0, 1);

$pdf->SetXY(99, 215);
$pdf->Cell(16, 5, '( ) CPR', 0, 1);

$pdf->SetXY(115, 215);
$pdf->Cell(35, 5, '( ) ICU/CCU.....Days', 0, 1);

$pdf->SetXY(150, 215);
$pdf->Cell(47, 5, '( ) Traction(skin,kull,skeletal)', 0, 1);

$pdf->SetXY(28, 220);
$pdf->Cell(32, 5, '( ) Cut Down', 0, 1);

$pdf->SetXY(60, 220);
$pdf->Cell(39, 5, '( ) Rehabilitation/PT', 0, 1);

$pdf->SetXY(99, 220);
$pdf->Cell(16, 5, '( ) LP', 0, 1);

$pdf->SetXY(115, 220);
$pdf->Cell(35, 5, '( ) Intercostal drainage', 0, 1);

$pdf->SetXY(150, 220);
$pdf->Cell(47, 5, '( ) Other.......................', 0, 1);

$pdf->SetXY(3, 225);
$pdf->Cell(86, 5, 'DISCHARGE STATUS', 1, 1, 'C');

$pdf->SetXY(89, 225);
$pdf->Cell(66, 5, 'TYPE OF DISCHARGE', 1, 1, 'C');

$pdf->Rect(155, 225, 45, 25); // กล่องยาวขวามือสุด
$pdf->SetXY(155, 225);
$pdf->Cell(45, 5, 'GA..................................................Wks', 0, 1);
$pdf->SetXY(155, 230);
$pdf->Cell(45, 5, 'Gravidity...............................................', 0, 1);
$pdf->SetXY(155, 235);
$pdf->Cell(45, 5, 'Parity.....................................................', 0, 1);
$pdf->SetXY(155, 245);
$pdf->Cell(45, 5, 'Living Child..........................................', 0, 1);

$pdf->Rect(3, 230, 86, 20); // บนช่องเซ็นซ้าย
$pdf->Rect(4, 231, 3, 3); // กล่อง checkbox
$pdf->SetXY(8, 230);
$pdf->Cell(17, 5, 'Complete', 0, 1);
$pdf->Rect(26, 231, 3, 3); // กล่อง checkbox
$pdf->SetXY(30, 230);
$pdf->Cell(25, 5, 'Normal delivery', 0, 1);
$pdf->Rect(56, 231, 3, 3); // กล่อง checkbox
$pdf->SetXY(60, 230);
$pdf->Cell(24, 5, 'Normal infant', 0, 1);

$pdf->SetXY(8, 235);
$pdf->Cell(17, 5, 'Recovery', 0, 1);
$pdf->Rect(26, 236, 3, 3); // กล่อง checkbox
$pdf->SetXY(30, 235);
$pdf->Cell(25, 5, 'Undelivery', 0, 1);
$pdf->SetXY(60, 235);
$pdf->Cell(24, 5, 'D/C separately', 0, 1);

$pdf->Rect(4, 241, 3, 3); // กล่อง checkbox
$pdf->SetXY(8, 240);
$pdf->Cell(17, 5, 'Improve', 0, 1);
$pdf->Rect(26, 241, 3, 3); // กล่อง checkbox
$pdf->SetXY(30, 240);
$pdf->Cell(25, 5, 'Normal infant', 0, 1);
$pdf->Rect(56, 241, 3, 3); // กล่อง checkbox
$pdf->SetXY(60, 240);
$pdf->Cell(24, 5, 'Stillbirth', 0, 1);

$pdf->Rect(4, 246, 3, 3); // กล่อง checkbox
$pdf->SetXY(8, 245);
$pdf->Cell(47, 5, 'Not improved D/C with mother', 0, 1);
$pdf->Rect(56, 246, 3, 3); // กล่อง checkbox
$pdf->SetXY(60, 245);
$pdf->Cell(24, 5, 'Dead', 0, 1);


$pdf->Rect(89, 230, 66, 20); // บนช่องเซ็นขวา
$pdf->Rect(90, 231, 3, 3); // กล่อง checkbox
$pdf->SetXY(94, 230);
$pdf->Cell(23, 5, 'With Approval', 0, 1);
$pdf->Rect(118, 231, 3, 3); // กล่อง checkbox
$pdf->SetXY(122, 230);
$pdf->Cell(25, 5, 'Other', 0, 1);
$pdf->Rect(90, 236, 3, 3); // กล่อง checkbox
$pdf->SetXY(94, 235);
$pdf->Cell(23, 5, 'Against Advice', 0, 1);
$pdf->Rect(118, 236, 3, 3); // กล่อง checkbox
$pdf->SetXY(122, 235);
$pdf->Cell(25, 5, 'Dead Autopsy', 0, 1);
$pdf->Rect(90, 241, 3, 3); // กล่อง checkbox
$pdf->SetXY(94, 240);
$pdf->Cell(23, 5, 'By Escape', 0, 1);
$pdf->Rect(118, 241, 3, 3); // กล่อง checkbox
$pdf->SetXY(122, 240);
$pdf->Cell(25, 5, 'Dead No autopsy', 0, 1);
$pdf->Rect(90, 246, 3, 3); // กล่อง checkbox
$pdf->SetXY(94, 245);
$pdf->Cell(48, 5, 'By transfer to...........................................', 0, 1);

$pdf->Rect(3, 250, 86, 20); // ช่องเซ็นซ้าย
$pdf->SetXY(3, 250);
$pdf->Cell(86, 5, 'Attending Physician', 0, 1, 'C');
$pdf->SetXY(3, 255);
$pdf->Cell(86, 5, '.............................................', 0, 1, 'C');
$pdf->SetXY(3, 260);
$pdf->Cell(86, 5, '(                                                            )', 0, 1, 'C');
$pdf->SetXY(3, 265);
$pdf->Cell(86, 5, 'Signature', 0, 1, 'C');

$pdf->Rect(89, 250, 111, 20); // ช่องเซ็นขวา
$pdf->SetXY(89, 250);
$pdf->Cell(111, 5, 'Approved By', 0, 1, 'C');
$pdf->SetXY(89, 255);
$pdf->Cell(111, 5, '.............................................', 0, 1, 'C');
$pdf->SetXY(89, 260);
$pdf->Cell(111, 5, '(                                                            )', 0, 1, 'C');
$pdf->SetXY(89, 265);
$pdf->Cell(111, 5, 'Signature', 0, 1, 'C');

// $pdf->AutoPrint(true);
$pdf->Output();