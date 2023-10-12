<?php
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

$id = input_get('id');

$db = Mysql::load();
$sql = "SELECT a.*,b.`idcard`
FROM `rg_soldier` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`id` = '$id' ";
$db->select($sql);
$user = $db->get_item();


function toUTF($txt){
    return iconv('UTF-8', 'TIS-620', $txt);
}

$en_to_thai_num = array('1' => '๑','2' => '๒','3' => '๓','4' => '๔','5' => '๕','6' => '๖','7' => '๗','8' => '๘','9' => '๙','0' => '๐');

function thaiNum($number){
    
	global $en_to_thai_num;
	$lists = str_split($number);
	$th_str = '';

	foreach( $lists as $key => $item ){

		if( isset($en_to_thai_num[$item]) ){
			$th_str .= $en_to_thai_num[$item];
		}else{
			$th_str .= $item;
		}
		
	}
	return $th_str;
}


$yearchk = $user['yearchk'];
$img_idcard = "images/idcard_exam.jpg";
$pic_patient = "images/p2_exam.jpg";
if( !empty($user['idcard_img']) && is_file("certificate/$yearchk/".$user['idcard_img']) ){
    $img_idcard = "certificate/$yearchk/".$user['idcard_img'];
}
if( !empty($user['pic_patient']) && is_file("certificate/$yearchk/".$user['pic_patient']) ){
	$pic_patient = "certificate/$yearchk/".$user['pic_patient'];
}

// list($date, $time) = explode(' ',$user['date_certificate']);
list($y, $m, $d) = explode('-', $user['date_certificate']);

$doctor1 = $user['yot1'].$user['doctor1'];
$doctor2 = $user['yot2'].$user['doctor2'];
$doctor3 = $user['yot3'].$user['doctor3'];

class MySHSPdf extends SHSPdf { 
	function Footer1()
	{
		$this->SetFont('THSarabun','',14);
		$this->SetXY(30,255);
		$this->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี',0,1,'L');
		$this->SetXY(30,260);
		$this->Cell(0, 5, 'โทร. ๐๕ ๔๘๓ ๐๓๐๕',0,1,'L');

		$this->SetFont('THSarabun','',12);
		$this->SetXY(0, 277);
		$this->Cell(0, 5, 'เอกสารนี้ประกอบการตรวจร่างกายทหารกองเกินเข้ารับราชการทหารกอบประจำการประจำปี ๒๕๖๗',0,1,'C');
		// To be implemented in your own inherited class
	}

	function Footer2()
	{
		$this->SetFont('THSarabun','',14);
		$this->SetXY(30,250);
		$this->Cell(0, 5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี',0,1,'L');
		$this->SetXY(30,255);
		$this->Cell(0, 5, 'โทร. ๐๕ ๔๘๓ ๐๓๐๕',0,1,'L');

		$this->SetFont('THSarabun','',12);
		$this->SetXY(0, 272);
		$this->Cell(0, 5, 'เอกสารนี้ประกอบการตรวจร่างกายทหารกองเกินเข้ารับราชการทหารกอบประจำการประจำปี ๒๕๖๗',0,1,'C');
		$this->SetXY(0, 277);
		$this->Cell(0, 5, '(ภาวะเพศสภาพไม่ตรงกับเพศกำเนิด)',0,1,'C');

		// To be implemented in your own inherited class
	}
}



$pdf = new MySHSPdf('P', 'mm', 'A4');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(0,0,0); // left, top, right





$pdf->AddPage();

// ตั้งค่าเส้นประ
$pdf->SetLineWidth(0.1);
$pdf->SetDash(0.3, 0.6);

// ทดสอบความกว้าง
// $pdf->SetFont('THSarabun','',20);
// $pdf->SetXY(0, 0);
// $pdf->Cell(0, 5, $pdf->GetPageWidth().' '.$pdf->GetPageHeight(), 1, 1, 'C');

$pdf->Image("images/bg-a4.jpg", 10, 0, 210, 297);

// ตราครุฑ
$pdf->Image("images/krut-3-cm.jpg", 97, 15, 27, 30);

$pdf->SetFont('THSarabun','B',20);
$pdf->SetXY(30, 26);
$pdf->Cell(160, 8, 'เล่มที่ '.thaiNum($user['book_id']).'   เลขที่ '.thaiNum($user['number_id']), 0, 1);
$pdf->SetX(30);
$pdf->Cell(160, 8, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'R');

$pdf->SetXY(30, 45);
$pdf->SetFont('THSarabun','B',25);
$pdf->Cell(160, 8, 'ใบความเห็นแพทย์', 0, 1, 'C');
$pdf->Ln(2.11);
$pdf->SetX(30);
$pdf->SetFont('THSarabun','',20);
$pdf->Cell(160, 8, 'ตรวจร่างกายทหารกองเกินเข้ารับราชการทหารกองประจำการประจำปี ๒๕๖๗', 0, 1, 'C');

$pdf->Ln(2.11); // +6 Before
$pdf->SetX(110);
$pdf->Cell(80, 8, thaiNum($d).' '.toUTF($def_fullm_th[$m]).' '.thaiNum($y+543), 0, 1, 'L');
$pdf->Ln(2.11); // +6 Before
$pdf->SetX(42.5);
$pdf->Cell(18, 8, 'ข้าพเจ้า', 0, 1, 'L');


$pdf->SetY(75.33);
$pdf->SetX(60.5);
$pdf->Cell(129.5, 8, '(๑) '.toUTF($doctor1), 0, 1, 'L');
// $pdf->SetXY(60.5, 77);
$pdf->SetX(60.5);
$pdf->Cell(129.5, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code1']), 0, 1, 'L');

$pdf->SetX(60.5);
$pdf->Cell(129.5, 8, '(๒) '.toUTF($doctor2), 0, 1, 'L');

$pdf->SetX(60.5);
$pdf->Cell(129.5, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code2']), 0, 1, 'L');

$pdf->SetX(60.5);
$pdf->Cell(129.5, 8, '(๓) '.toUTF($doctor3), 0, 1, 'L');

$pdf->SetX(60.5);
$pdf->Cell(129.5, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code3']), 0, 1, 'L');

$pdf->Ln(4.23); // +12 Before
$pdf->SetX(30);
$pdf->Write(8, 'ได้ตรวจร่างกาย ');
$pdf->SetFont('THSarabun','B',20);
$pdf->Write(8, toUTF($user['yot_pt'].' '.$user['ptname']));
$pdf->Ln();

$pdf->SetFont('THSarabun','',20);
$pdf->SetX(30);
$pdf->Write(8, 'เลขที่บัตรประจำตัวประชาชน ');
$pdf->SetFont('THSarabun','B',20);

// รูปแบบบัตรประชาชน
// 5-5-2
$idcard1 = substr($user['idcard'],0,5);
$idcard2 = substr($user['idcard'],5,5);
$idcard3 = substr($user['idcard'],10,3);

$pdf->Write(8, thaiNum($idcard1).' '.thaiNum($idcard2).' '.thaiNum($idcard3));
$pdf->Ln();

$pdf->SetFont('THSarabun','',20);
$pdf->SetX(30);
$pdf->Write(8, 'เมื่อ');
$pdf->SetFont('THSarabun','B',20);
$pdf->Write(8, 'วันที่ '.thaiNum($d).' '.toUTF($def_fullm_th[$m]).' '.thaiNum($y+543));

$pdf->Image($img_idcard, 134, 124, 58, 34);

$pdf->Ln();
$pdf->Ln(4.23); // +12 Before
$pdf->SetX(30);
$pdf->SetFont('THSarabun','',20);
$pdf->Write(8, 'สรุปความเห็น ');
$pdf->SetFont('THSarabun','B',20);
$pdf->Write(8, thaiNum(toUTF($user['diag'])));

$pdf->SetXY(30, $pdf->getY()+8);
$regular_number = toUTF($user['regular_number']);
$pdf->MultiCell(160, 8, 'ตามกฏกระทรวง ฉบับที่ ๗๔ (พ.ศ.๒๕๔๐) ข้อ '.thaiNum($regular_number));

$pdf->Image($pic_patient, 30, $pdf->getY()+8, 40, 60);

$pdf->SetFont('THSarabun','',20);
$pdf->SetXY(115, $pdf->getY()+8);
$pdf->Cell(75, 8, '(๑) '.toUTF($user['yot1']),0,1);
$pdf->SetX(115);
$pdf->Cell(75, 8, '('.toUTF($user['doctor1']).')',0,1,'C');

$pdf->Ln(4.23); // +6 Before
$pdf->SetX(115);
$pdf->Cell(75, 8, '(๒) '.toUTF($user['yot2']),0,1);
$pdf->SetX(115);
$pdf->Cell(75, 8, '('.toUTF($user['doctor2']).')', 0, 1,'C');

$pdf->Ln(4.23); // +6 Before
$pdf->SetX(115);
$pdf->Cell(75, 8, '(๓) '.toUTF($user['yot3']),0,1);
$pdf->SetX(115);
$pdf->Cell(75, 8, '('.toUTF($user['doctor3']).')',0,1,'C');

$pdf->SetX(115);
$pdf->Cell(75, 8, 'กรมการแพทย์ผู้ตรวจร่างกาย',0,1,'C');

$pdf->Footer1();





$pdf->AddPage();

// ตั้งค่าเส้นประ
$pdf->SetLineWidth(0.1);
$pdf->SetDash(0.3, 0.6);

// ทดสอบความกว้าง
// $pdf->SetFont('THSarabun','',20);
// $pdf->SetXY(0, 0);
// $pdf->Cell(0, 5, $pdf->GetPageWidth().' '.$pdf->GetPageHeight(), 1, 1, 'C');

$pdf->Image("images/bg-a4.jpg", 10, 0, 210, 297);

// ตราครุฑ
$pdf->Image("images/krut-3-cm.jpg", 97, 15, 27, 30);

$pdf->SetFont('THSarabun','B',20);
$pdf->SetXY(30, 26);
$pdf->Cell(160, 8, 'เล่มที่ '.thaiNum($user['book_id']).'   เลขที่ '.thaiNum($user['number_id']), 0, 1);
$pdf->SetX(30);
$pdf->Cell(160, 8, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'R');

$pdf->SetXY(30, 45);
$pdf->SetFont('THSarabun','B',25);
$pdf->Cell(160, 8, 'ใบความเห็นแพทย์', 0, 1, 'C');
$pdf->Ln(2.11);
$pdf->SetX(30);
$pdf->SetFont('THSarabun','',20);
$pdf->Cell(160, 8, 'ตรวจร่างกายทหารกองเกินเข้ารับราชการทหารกองประจำการประจำปี ๒๕๖๗', 0, 1, 'C');
$pdf->SetX(30);
$pdf->Cell(160, 8, '(ภาวะเพศสภาพไม่ตรงกับเพศกำเนิด)', 0, 1, 'C');

$pdf->Ln(2.11); // +6 Before
$pdf->SetX(110);
$pdf->Cell(80, 8, thaiNum($d).' '.toUTF($def_fullm_th[$m]).' '.thaiNum($y+543), 0, 1, 'L');
$pdf->Ln(2.11); // +6 Before
$pdf->SetX(42.5);
$pdf->Cell(160, 8, 'ข้าพเจ้า '.toUTF($doctor1).' จิตแพทย์ประจำโรงพยาบาลค่ายสุรศักดิ์มนตรี',0,1);
$pdf->SetX(30);
$pdf->Cell(160, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code1']),0,1);
// $pdf->Ln();
// $pdf->SetY(75.33);
// $pdf->SetX(60.5);
// $pdf->Cell(129.5, 8, '(๑) '.toUTF($doctor1), 0, 1, 'L');
// // $pdf->SetXY(60.5, 77);
// $pdf->SetX(60.5);
// $pdf->Cell(129.5, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code1']), 0, 1, 'L');

// $pdf->SetX(60.5);
// $pdf->Cell(129.5, 8, '(๒) '.toUTF($doctor2), 0, 1, 'L');

// $pdf->SetX(60.5);
// $pdf->Cell(129.5, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code2']), 0, 1, 'L');

// $pdf->SetX(60.5);
// $pdf->Cell(129.5, 8, '(๓) '.toUTF($doctor3), 0, 1, 'L');

// $pdf->SetX(60.5);
// $pdf->Cell(129.5, 8, 'ใบอนุญาตประกอบวิชาชีพเวชกรรมเลขที่ '.thaiNum($user['code3']), 0, 1, 'L');

$pdf->Ln(4.23); // +12 Before
$pdf->SetX(30);
$pdf->Write(8, 'ได้ตรวจร่างกาย ');
$pdf->SetFont('THSarabun','B',20);
$pdf->Write(8, toUTF($user['yot_pt'].' '.$user['ptname']));
$pdf->Ln();

$pdf->SetFont('THSarabun','',20);
$pdf->SetX(30);
$pdf->Write(8, 'เลขที่บัตรประจำตัวประชาชน ');
$pdf->SetFont('THSarabun','B',20);

// รูปแบบบัตรประชาชน
// 5-5-2
$idcard1 = substr($user['idcard'],0,5);
$idcard2 = substr($user['idcard'],5,5);
$idcard3 = substr($user['idcard'],10,3);

$pdf->Write(8, thaiNum($idcard1).' '.thaiNum($idcard2).' '.thaiNum($idcard3));
$pdf->Ln();

$pdf->SetFont('THSarabun','',20);
$pdf->SetX(30);
$pdf->Write(8, 'เมื่อ');
$pdf->SetFont('THSarabun','B',20);
$pdf->Write(8, 'วันที่ '.thaiNum($d).' '.toUTF($def_fullm_th[$m]).' '.thaiNum($y+543));

$pdf->Image($img_idcard, 134, 98, 58, 34);

$pdf->Ln();
$pdf->Ln(4.23); // +12 Before
$pdf->SetFont('THSarabun','',20);
$pdf->SetX(30);
$pdf->Cell(160, 8, 'สรุปความเห็น ',0,1);
$pdf->SetX(30);
$pdf->MultiCell(160, 8, 'มีภาวะเพศสภาพไม่ตรงกับเพศกำเนิด (Gender Identity Disorder) ตามกฎกระทรวงฉบับที่ ๓๗ (พ.ศ.๒๕๖๑) ฉบับที่ ๔๗ (พ.ศ. ๒๕๑๘) และ ฉบับที่ ๗๕ (พ.ศ.๒๕๕๕) ข้อ ๓ (๑๒)');

$pdf->Image($pic_patient, 30, $pdf->getY()+8, 40, 60);

$pdf->SetFont('THSarabun','',20);
$pdf->SetXY(115, $pdf->getY()+8);
$pdf->Cell(75, 8, toUTF($user['yot1']),0,1);
$pdf->SetX(115);
$pdf->Cell(75, 8, '('.toUTF($user['doctor1']).')',0,1,'C');

// $pdf->Ln(4.23); // +6 Before
// $pdf->SetX(115);
// $pdf->Cell(75, 8, '(๒) '.toUTF($user['yot2']),0,1);
// $pdf->SetX(115);
// $pdf->Cell(75, 8, '('.toUTF($user['doctor2']).')', 0, 1,'C');

// $pdf->Ln(4.23); // +6 Before
// $pdf->SetX(115);
// $pdf->Cell(75, 8, '(๓) '.toUTF($user['yot3']),0,1);
// $pdf->SetX(115);
// $pdf->Cell(75, 8, '('.toUTF($user['doctor3']).')',0,1,'C');

$pdf->SetX(115);
$pdf->Cell(75, 8, 'กรมการแพทย์ผู้ตรวจร่างกาย',0,1,'C');
$pdf->Footer2();

$pdf->AutoPrint(true);
$pdf->Output();