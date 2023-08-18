<?php 
include_once 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

function toUTF($txt) {
    return iconv('UTF-8', 'WINDOWS-874', $txt);
}

function getWardName($bedCode){
    if($bedCode=='42'){
        $name="หอผู้ป่วยรวม";	
    }elseif($bedCode=='43'){
        $name="หอผู้ป่วยสูติ";	

    }elseif($bedCode=='44'){
        $name="หอผู้ป่วยICU";	

    }elseif($bedCode=='45'){
        $name="หอผู้ป่วยพิเศษ";	

    }elseif($bedCode=='46'){
        $name="หอผู้ป่วย Cohort Ward";	

    }elseif($bedCode=='47'){
        $name="หอผู้ป่วย Home Isolation";	

    }elseif($bedCode=='48'){
        $name="หอผู้ป่วย รพ.สนาม";	

    }
    return $name;
}

class MedSHS extends SHSPdf
{
    function __construct($orientation='P', $unit='mm', $size='A4')
	{
		parent::__construct($orientation, $unit, $size);
    }
    function header()
    {
        $this->SetXY(0, 3);
        $this->SetFont('THSarabun','',14);
        $this->Cell(0, 6,  'ใบที่ '.$this->PageNo(), 0, 1, 'R');
    }
}

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$other = sprintf("%d", $_REQUEST['other']);

$drug_ids = $_REQUEST['drug_id'];
$drug_items = array();
if(count($drug_ids)>0){
    $lastdate = '';
    foreach ($drug_ids as $key => $d) {
        $sqlDrugItem = " SELECT a.*, b.`genname`,b.`tradname`, c.`detail` 
        FROM ( 
            SELECT `row_id` AS `id`,`slcode`,`drugcode`,`amount`,SUBSTRING(`date`,1,10) AS `date` FROM `drugrx` WHERE `row_id` = '$d' 
        ) AS a 
        LEFT JOIN `druglst` AS b ON b.`drugcode` = a.`drugcode` 
        LEFT JOIN ( 
            SELECT `slcode`,CONCAT(TRIM(`detail1`),TRIM(`detail2`),TRIM(`detail3`)) AS `detail` FROM `drugslip` 
        ) AS c ON a.`slcode` = c.`slcode` ";
        $qDurgItem = $dbi->query($sqlDrugItem);
        $set_drug_item = $qDurgItem->fetch_assoc();
        $lastdate = $set_drug_item['date'];
        $drug_items[] = $set_drug_item;
        
    }
}

$hn = sprintf("%s", $_REQUEST['hn']);
$ptname = sprintf("%s", $_REQUEST['ptname']);

$qOp = $dbi->query("SELECT `idcard`,TIMESTAMPDIFF(YEAR, thDateToEn(`dbirth`), SUBSTRING(NOW(), 1, 10)) AS `age` FROM `opcard` WHERE `hn` = '$hn' ");
$op = $qOp->fetch_assoc();
$idcard = $op['idcard'];
$age = $op['age'];

$sqlIpcard ="SELECT `an`,`date`,SUBSTRING(`bedcode`,1,2) AS `bedcode`,`diagnos` FROM `bed` WHERE `hn` = '$hn' ";
$ipQ = $dbi->query($sqlIpcard);
$ip = array();
if($ipQ->num_rows>0){
    $ip = $ipQ->fetch_assoc();
}

$sqlReact="SELECT GROUP_CONCAT(`tradname`) AS `react_name` FROM `drugreact` WHERE `hn`='$hn' LIMIT 3";
$reactQ = $dbi->query($sqlReact);
$re = array();
if($reactQ->num_rows>0){
    $re = $reactQ->fetch_assoc();
}

// A4 ยาวทั้งหมด 210mm สูง 297mm
$pdf = new MedSHS('P', 'mm', 'A4');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetMargins(5, 12);
$pdf->SetAutoPageBreak(true, 0);
$pdf->AddPage();

$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$pdf->SetY(12);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(198, 7, 'Medication Reconciliation Form [ใบ M.R.]', 1, 1, 'L',true);

$pdf->SetFillColor(184,184,184);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(198, 6.5, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง', 1, 1, 'L',true);

// รีเซ็ตให้พื้นหลังเป็นสีขาวและตัวหนังสือสีดำ
$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('THSarabun','',12);

// รายละเอียดผู้ป่วย
$pdf->Rect($pdf->GetX(), $pdf->GetY(), 65, 32);
$pdf->SetY(25.5);
$pdf->Write(5, '[  ] ผู้ป่วยมีประวัติยาเดิมใน ร.พ. (ส่วนที่1)');
$pdf->SetXY(10, 30.5);
$pdf->Write(5, '(  ) นำยาเดิมมา วันที่_____________');
$pdf->SetXY(10, 35.5);
$pdf->Write(5, '(  ) ไม่ได้นำยาเดิมมา');


$pdf->Rect(70, 25.5, 65, 32);
$pdf->SetXY(70, 25.5);
$pdf->Write(5, '[  ] มีประวัติยาเดิมจากสถานพยาบาลอื่น (ส่วนที่ 2)');
$pdf->SetXY(75, 30.5);
$pdf->Write(5, 'รับยาจาก (  ) ร.พ._______________________');
$pdf->SetXY(87, 35.5);
$pdf->Write(5, '(  ) คลินิก_____________________');
$pdf->SetXY(87, 40.5);
$pdf->Write(5, '(  ) ร้านยา____________________');
$pdf->SetXY(87, 45.5);
$pdf->Write(5, '(  ) อื่นๆ______________________');


$pdf->Rect(135, 25.5, 68, 32);
$pdf->SetXY(135, 25.5);
$pdf->Write(5, 'ชื่อ:___________________________อายุ:__________ปี');

$pdf->SetFont('THSarabun','B',10);
$pdf->SetXY(139, 25.5);
$pdf->Cell(40, 5, toUTF($ptname),0,1);
$pdf->SetXY(185, 25.5);
$pdf->Cell(10, 5, $pdf->conv($age),0,1);

$pdf->SetFont('THSarabun','',12);
$pdf->SetXY(135, 30.5);
$pdf->Cell(68, 5, 'เลขบัตรปชช:_____________HN:________AN:________',0,1);

$pdf->SetFont('THSarabun','B',10);
$pdf->SetXY(150, 30.5);
$pdf->Cell(20, 5, $idcard,0,1);
$pdf->SetXY(174, 30.5);
$pdf->Cell(13, 5, $hn,0,1);
$pdf->SetXY(190, 30.5);
$pdf->Cell(13, 5, $ip['an'],0,1);

$pdf->SetFont('THSarabun','',12);
$pdf->SetXY(135, 35.5);
$pdf->Cell(68, 5, 'วันที่ Admit_____________________เวลา:_________น.',0,1);
$pdf->SetXY(135, 40.5);
$pdf->Cell(68, 5, 'Ward:_______________________________________',0,1);
$pdf->SetXY(135, 45.5);
$pdf->Cell(68, 5, 'การวินิจฉัย:___________________________________',0,1);
$pdf->SetXY(135, 50.5);
$pdf->Cell(68, 5, 'แพ้ยา:_______________________________________',0,1);

$pdf->SetFont('THSarabun','B',10);
$pdf->SetXY(150, 35.5);
list($dateAdmit, $timeAdmit) = explode(' ', $ip['date']);
$pdf->Cell(29, 5, $dateAdmit,0,1);
$pdf->SetXY(186, 35.5);
$pdf->Cell(15, 5, $timeAdmit,0,1);

$pdf->SetXY(145, 40.5);
$name = getWardName($ip['bedcode']);
$pdf->Cell(55, 5, $name,0,1);

$pdf->SetXY(149, 45.5);
$pdf->Cell(55, 5, $ip['diagnos'],0,1);

$pdf->SetXY(145, 50.5);
$pdf->Cell(55, 5, $re['react_name'],0,1);


if(!empty($drug_items)){

    // title ส่วนที่2
    $pdf->SetFillColor(0,0,0);
    $pdf->SetTextColor(255,255,255);
    $pdf->SetXY(5, 55.5);
    $pdf->Cell(198, 6.5, 'ส่วนที่ 1 ยาเดิมรับจากโรงพยาบาลค่ายสุรศักดิ์มนตรี', 1, 1, 'L',true);

    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('THSarabun','B',12);

    $pdf->Rect(5, 62, 29.5, 28);
    $pdf->SetXY(5, 74);
    $pdf->Cell(29.5, 5, 'ชื่อและขนาดยา',0,1,'C');

    $pdf->Rect(34.5, 62, 22.5, 28);
    $pdf->SetXY(34.5, 74);
    $pdf->Cell(22.5, 5, 'วิธีใช้',0,1,'C');

    $pdf->Rect(57, 62, 12.5, 28);
    $pdf->SetXY(57, 74);
    $pdf->Cell(12.5, 5, 'จำนวน',0,1,'C');

    $pdf->Rect(69.5, 62, 20, 28);
    $pdf->SetXY(69.5, 74);
    $pdf->Cell(20, 5, 'LAST DOSE',0,1,'C');
    $pdf->SetXY(69.5, 79);
    $pdf->Cell(20, 5, '(วัน/เวลา)',0,1,'C');

    ## รับเข้า ##
    $pdf->Rect(89.5, 62, 37.5, 18.5);
    $pdf->SetXY(89.5, 69);
    $pdf->Cell(37.5, 5, 'รับเข้า',0,1,'C');

    $pdf->SetFont('THSarabun','B',10);
    $pdf->SetXY(89.5, 80.5);
    $pdf->Cell(6.5, 9.5, 'ใช้ต่อ',1,1,'C');
    $pdf->SetXY(96, 80.5);
    $pdf->Cell(6.5, 9.5, 'หยุด',1,1,'C');

    $pdf->SetFont('THSarabun','B',8);
    $pdf->Rect(102.5, 80.5, 6.5, 9.5);
    $pdf->SetXY(102.5, 80.5);
    $pdf->Cell(6.5, 5, "เปลี่ยน",0,1,'C');
    $pdf->SetXY(102.5, 85.5);
    $pdf->Cell(6.5, 4.5, "แปลง",0,1,'C');

    $pdf->Rect(109, 80.5, 18, 9.5);
    $pdf->SetXY(109, 80.5);
    $pdf->Cell(18, 5, 'เหตุผลที่',0,1,'C');
    $pdf->SetXY(109, 85.5);
    $pdf->Cell(18, 4.5, "เปลี่ยนแปลง/หยุดยา",0,1,'C');
    ## รับเข้า ##

    ## ย้ายวอร์ด ##
    $pdf->SetFont('THSarabun','B',12);
    $pdf->Rect(127, 62, 37.5, 18.5);
    $pdf->SetXY(127, 62);
    $pdf->Cell(37.5, 5, 'ย้ายวอร์ด',0,1,'C');

    $pdf->SetFont('THSarabun','',10);
    $pdf->SetXY(127, 67);
    $pdf->Cell(37.5, 4, 'จากวอร์ด_____________________',0,1,'L');
    $pdf->SetXY(127, 71);
    $pdf->Cell(37.5, 4, 'ไปวอร์ด______________________',0,1,'L');
    $pdf->SetXY(127, 75);
    $pdf->Cell(37.5, 4, 'วันที่_____________เวลา_______น.',0,1,'L');

    $pdf->SetFont('THSarabun','B',10);
    $pdf->SetXY(127, 80.5);
    $pdf->Cell(6.5, 9.5, 'ใช้ต่อ',1,1,'C');
    $pdf->SetXY(133.5, 80.5);
    $pdf->Cell(6.5, 9.5, 'หยุด',1,1,'C');

    $pdf->SetFont('THSarabun','B',8);
    $pdf->Rect(140, 80.5, 6.5, 9.5);
    $pdf->SetXY(140, 80.5);
    $pdf->Cell(6.5, 5, "เปลี่ยน",0,1,'C');
    $pdf->SetXY(140, 85.5);
    $pdf->Cell(6.5, 4.5, "แปลง",0,1,'C');

    $pdf->Rect(146.5, 80.5, 18, 9.5);
    $pdf->SetXY(146.5, 80.5);
    $pdf->Cell(18, 5, 'เหตุผลที่',0,1,'C');
    $pdf->SetXY(146.5, 85.5);
    $pdf->Cell(18, 4.5, "เปลี่ยนแปลง/หยุดยา",0,1,'C');
    ## ย้ายวอร์ด ##

    ## จำหน่าย ##
    $pdf->SetFont('THSarabun','B',12);
    $pdf->Rect(164.5, 62, 38.5, 18.5);
    $pdf->SetXY(164.5, 69);
    $pdf->Cell(38.5, 5, 'จำหน่าย',0,1,'C');

    $pdf->SetFont('THSarabun','B',10);
    $pdf->SetXY(164.5, 80.5);
    $pdf->Cell(6.5, 9.5, 'ใช้ต่อ',1,1,'C');
    $pdf->SetXY(171, 80.5);
    $pdf->Cell(6.5, 9.5, 'หยุด',1,1,'C');

    $pdf->SetFont('THSarabun','B',8);
    $pdf->Rect(177.5, 80.5, 6.5, 9.5);
    $pdf->SetXY(177.5, 80.5);
    $pdf->Cell(6.5, 5, "เปลี่ยน",0,1,'C');
    $pdf->SetXY(177.5, 85.5);
    $pdf->Cell(6.5, 4.5, "แปลง",0,1,'C');

    $pdf->Rect(184, 80.5, 19, 9.5);
    $pdf->SetXY(184, 80.5);
    $pdf->Cell(18, 5, 'เหตุผลที่',0,1,'C');
    $pdf->SetXY(184, 85.5);
    $pdf->Cell(18, 4.5, "เปลี่ยนแปลง/หยุดยา",0,1,'C');
    ## จำหน่าย ##


    $pdf->SetFont('THSarabun','',12);
    $pdf->SetFillColor(184,184,184);
    $pdf->SetTextColor(0,0,0);
    $pdf->Cell(198, 6.5, 'วันที่รับยาครั้งล่าสุด: '.$lastdate, 1, 1, 'L',true);

    // รีเซ็ตให้พื้นหลังเป็นสีขาวและตัวหนังสือสีดำ
    $pdf->SetFillColor(255,255,255);
    $pdf->SetTextColor(0,0,0);
    $pdf->SetFont('THSarabun','',12);

    $i = 1;
    // $lastY = 0;
    foreach ($drug_items as $key => $di) {

        $drug_y = $pdf->GetY();

        if( $pdf->GetY() > 240 ){
            $pdf->AddPage();
            $pdf->setXY(5,12);
            $drug_y = $pdf->GetY();
        }

        $pdf->SetFont('THSarabun','',10);
        $muticell_h = $detailHeight = $pdf->GetMultiCellHeight(22.5, 5, toUTF($di['detail']));

        // หาความสูง tradname ที่เป็น bold 
        $pdf->SetFont('THSarabun','B',9);
        $tradHeight = $pdf->GetMultiCellHeight(29.5, 5, toUTF("\n".$di['tradname']));
        // หาความสูง genname ที่เป็น normal
        $pdf->SetFont('THSarabun','',9);
        $genHeight = $pdf->GetMultiCellHeight(29.5, 5, toUTF("\n".$di['genname']));

        // เทียบกับ detail แล้วเลือกตัวที่สูงที่สุด เอามาเป็น Rect
        if( ($tradHeight+$genHeight) > $detailHeight){
            $muticell_h = $tradHeight+$genHeight;
        }
        
        // ชื่อยา
        $pdf->Rect(5, $drug_y, 29.5, $muticell_h);
        $pdf->Cell(5, 5, $pdf->conv($i),1,0,'C');
        $pdf->SetXY(5, $drug_y);
        $pdf->SetFont('THSarabun','B',12);
        $pdf->MultiCell(29.5, 5, "\n".toUTF($di['tradname']),0);

        $pdf->SetXY(5, $pdf->GetY());
        $pdf->SetFont('THSarabun','',9.5);
        $pdf->MultiCell(29.5, 5, toUTF($di['genname']),0);

        // วิธีใช้ 
        $pdf->SetXY(34.5, $drug_y);
        $pdf->SetFont('THSarabun','',10);
        $pdf->Rect(34.5, $drug_y, 22.5, $muticell_h);
        $pdf->MultiCell(22.5, 5, toUTF($di['detail']), 0);

        // จำนวน
        $pdf->SetXY(57, $drug_y);
        $pdf->SetFont('THSarabun','',12);
        $pdf->Cell(12.5, $muticell_h, $pdf->conv($di['amount']),1,0,'C');

        // Last dose
        $pdf->Rect(69.5, $drug_y, 20, $muticell_h);

        // รับเข้า
        $pdf->Rect(89.5, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(96, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(102.5, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(109, $drug_y, 18, $muticell_h);

        // ย้ายวอร์ด
        $pdf->Rect(127, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(133.5, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(140, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(146.5, $drug_y, 18, $muticell_h);

        // // จำหน่าย
        $pdf->Rect(164.5, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(171, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(177.5, $drug_y, 6.5, $muticell_h);
        $pdf->Rect(184, $drug_y, 19, $muticell_h);

        $lastY = $drug_y + $muticell_h;
        $pdf->SetY($lastY);
        $i++;
    }

}

if( $pdf->GetY() > 240 ){
    $pdf->AddPage();
    $pdf->setXY(5,12);
}

/** 
 * หัวข้อส่วนที่2 
 */
$lastY = $pdf->GetY();
$pdf->SetFont('THSarabun','',12);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(5, $lastY);
$pdf->Cell(198, 6.5, 'ส่วนที่ 2 ยาเดิมจากสถานพยาบาลอื่น', 1, 1, 'L',true);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('THSarabun','B',12);

$lastY = $pdf->GetY(); // <<=== รับค่าใหม่
$pdf->Rect(5, $lastY, 29.5, 28);
$pdf->SetXY(5, $lastY+12);
$pdf->Cell(29.5, 5, 'ชื่อและขนาดยา',0,1,'C');

$pdf->Rect(34.5, $lastY, 22.5, 28);
$pdf->SetXY(34.5, $lastY+12);
$pdf->Cell(22.5, 5, 'วิธีใช้',0,1,'C');

$pdf->Rect(57, $lastY, 12.5, 28);
$pdf->SetXY(57, $lastY+12);
$pdf->Cell(12.5, 5, 'จำนวน',0,1,'C');

$pdf->Rect(69.5, $lastY, 20, 28);
$pdf->SetXY(69.5, $lastY+12);
$pdf->Cell(20, 5, 'LAST DOSE',0,1,'C');
$pdf->SetXY(69.5, $lastY+17);
$pdf->Cell(20, 5, '(วัน/เวลา)',0,1,'C');


## รับเข้า ##
$pdf->Rect(89.5, $lastY, 37.5, 18.5);
$pdf->SetXY(89.5, $lastY+7);
$pdf->Cell(37.5, 5, 'รับเข้า',0,1,'C');

$pdf->SetFont('THSarabun','B',10);
$pdf->SetXY(89.5, $lastY+18.5);
$pdf->Cell(6.5, 9.5, 'ใช้ต่อ',1,1,'C');
$pdf->SetXY(96, $lastY+18.5);
$pdf->Cell(6.5, 9.5, 'หยุด',1,1,'C');

$pdf->SetFont('THSarabun','B',8);
$pdf->Rect(102.5, $lastY+18.5, 6.5, 9.5);
$pdf->SetXY(102.5, $lastY+18.5);
$pdf->Cell(6.5, 5, "เปลี่ยน",0,1,'C');
$pdf->SetXY(102.5, $lastY+23.5);
$pdf->Cell(6.5, 4.5, "แปลง",0,1,'C');

$pdf->Rect(109, $lastY+18.5, 18, 9.5);
$pdf->SetXY(109, $lastY+18.5);
$pdf->Cell(18, 5, 'เหตุผลที่',0,1,'C');
$pdf->SetXY(109, $lastY+23.5);
$pdf->Cell(18, 4.5, "เปลี่ยนแปลง/หยุดยา",0,1,'C');
## รับเข้า ##


## ย้ายวอร์ด ##
$pdf->SetFont('THSarabun','B',12);
$pdf->Rect(127, $lastY, 37.5, 18.5);
$pdf->SetXY(127, $lastY);
$pdf->Cell(37.5, 5, 'ย้ายวอร์ด',0,1,'C');

$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(127, $lastY+5);
$pdf->Cell(37.5, 4, 'จากวอร์ด_____________________',0,1,'L');
$pdf->SetXY(127, $lastY+9);
$pdf->Cell(37.5, 4, 'ไปวอร์ด______________________',0,1,'L');
$pdf->SetXY(127, $lastY+13);
$pdf->Cell(37.5, 4, 'วันที่_____________เวลา_______น.',0,1,'L');

$pdf->SetFont('THSarabun','B',10);
$pdf->SetXY(127, $lastY+18.5);
$pdf->Cell(6.5, 9.5, 'ใช้ต่อ',1,1,'C');
$pdf->SetXY(133.5, $lastY+18.5);
$pdf->Cell(6.5, 9.5, 'หยุด',1,1,'C');

$pdf->SetFont('THSarabun','B',8);
$pdf->Rect(140, $lastY+18.5, 6.5, 9.5);
$pdf->SetXY(140, $lastY+18.5);
$pdf->Cell(6.5, 5, "เปลี่ยน",0,1,'C');
$pdf->SetXY(140, $lastY+23.5);
$pdf->Cell(6.5, 4.5, "แปลง",0,1,'C');

$pdf->Rect(146.5, $lastY+18.5, 18, 9.5);
$pdf->SetXY(146.5, $lastY+18.5);
$pdf->Cell(18, 5, 'เหตุผลที่',0,1,'C');
$pdf->SetXY(146.5, $lastY+23.5);
$pdf->Cell(18, 4.5, "เปลี่ยนแปลง/หยุดยา",0,1,'C');


## จำหน่าย ##
$pdf->SetFont('THSarabun','B',12);
$pdf->Rect(164.5, $lastY, 38.5, 18.5);
$pdf->SetXY(164.5, $lastY+7);
$pdf->Cell(38.5, 5, 'จำหน่าย',0,1,'C');

$pdf->SetFont('THSarabun','B',10);
$pdf->SetXY(164.5, $lastY+18.5);
$pdf->Cell(6.5, 9.5, 'ใช้ต่อ',1,1,'C');
$pdf->SetXY(171, $lastY+18.5);
$pdf->Cell(6.5, 9.5, 'หยุด',1,1,'C');

$pdf->SetFont('THSarabun','B',8);
$pdf->Rect(177.5, $lastY+18.5, 6.5, 9.5);
$pdf->SetXY(177.5, $lastY+18.5);
$pdf->Cell(6.5, 5, "เปลี่ยน",0,1,'C');
$pdf->SetXY(177.5, $lastY+23.5);
$pdf->Cell(6.5, 4.5, "แปลง",0,1,'C');

$pdf->Rect(184, $lastY+18.5, 19, 9.5);
$pdf->SetXY(184, $lastY+18.5);
$pdf->Cell(18, 5, 'เหตุผลที่',0,1,'C');
$pdf->SetXY(184, $lastY+23.5);
$pdf->Cell(18, 4.5, "เปลี่ยนแปลง/หยุดยา",0,1,'C');


// ถ้าไม่ได้กรอก ยานอก ให้ default เป็น 2บรรทัด
if (empty($other)) {
    $other = 2;
}

for ($i=0; $i < $other; $i++) { 

    $drug_y = $pdf->GetY();

    // ชื่อยา
    $pdf->Rect(5, $drug_y, 29.5, 10);
    $pdf->Rect(5, $drug_y, 5, 5);

    // วิธีใช้ 
    $pdf->Rect(34.5, $drug_y, 22.5, 10);

    // จำนวน
    $pdf->Rect(57, $drug_y, 12.5, 10);

    // Last dose
    $pdf->Rect(69.5, $drug_y, 20, 10);

    // รับเข้า
    $pdf->Rect(89.5, $drug_y, 6.5, 10);
    $pdf->Rect(96, $drug_y, 6.5, 10);
    $pdf->Rect(102.5, $drug_y, 6.5, 10);
    $pdf->Rect(109, $drug_y, 18, 10);

    // ย้ายวอร์ด
    $pdf->Rect(127, $drug_y, 6.5, 10);
    $pdf->Rect(133.5, $drug_y, 6.5, 10);
    $pdf->Rect(140, $drug_y, 6.5, 10);
    $pdf->Rect(146.5, $drug_y, 18, 10);

    // // จำหน่าย
    $pdf->Rect(164.5, $drug_y, 6.5, 10);
    $pdf->Rect(171, $drug_y, 6.5, 10);
    $pdf->Rect(177.5, $drug_y, 6.5, 10);
    $pdf->Rect(184, $drug_y, 19, 10);

    $pdf->SetY($drug_y+10);
}


// ขึ้นหน้ากระดาษใหม่ ก่อนขึ้นขณะแรกรับ
if( $pdf->GetY() > 240 ){
    $pdf->AddPage();
    $pdf->setXY(5,12);
}

$lastY = $pdf->GetY();
$pdf->SetFont('THSarabun','',12);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5.5, 'ขณะแรกรับ', 1, 1, 'L',true);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('THSarabun','B',12);

$lastY = $pdf->GetY();
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของแพทย์', 1, 1, 'C',true);
$pdf->SetXY(71, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของเภสัช', 1, 1, 'C',true);
$pdf->SetXY(137, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของพยาบาล', 1, 1, 'C',true);

// ส่วนของแพทย์
$lastY = $pdf->GetY();
$pdf->Rect(5, $lastY, 66, 32.5);
$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5, '[  ] ยืนยันคำสั่ง',0,1,'L');
$pdf->SetXY(5, $lastY+5);
$pdf->Cell(66, 5, '[  ] เปลี่ยนแปลง (ระบุ)__________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+10);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+14);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+18);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+22);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+27);
$pdf->Cell(66, 5, 'แพทย์__________________________วันที่_________________',0,1,'L');

// ส่วนของเภสัช
$pdf->SetFont('THSarabun','',9);
$pdf->Rect(71, $lastY, 66, 32.5); // กล่องใหญ่
$pdf->Rect(71, $lastY, 33, 14); // กล่องย่อย1
$pdf->SetXY(71, $lastY);
$pdf->Cell(33, 4, '[  ] Untreated indications',0,1,'L');
$pdf->SetXY(71, $lastY+4);
$pdf->Cell(33, 4, '[  ] Dosage too height/',0,1,'L');
$pdf->SetXY(71, $lastY+8);
$pdf->Cell(33, 4, 'too low/ wrong frequency',0,1,'L');

$pdf->Rect(104, $lastY, 33, 14); // กล่องย่อย2
$pdf->SetXY(104, $lastY);
$pdf->Cell(33, 4, '[  ] Duplication of drug therapy',0,1,'L');
$pdf->SetXY(104, $lastY+4);
$pdf->Cell(33, 4, '[  ] Drug interraction',0,1,'L');
$pdf->SetXY(104, $lastY+8);
$pdf->Cell(33, 4, '[  ] Administration error',0,1,'L');

$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(71, $lastY+14);
$pdf->Cell(66, 5, 'เรียนแพทย์/พยาบาล____________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+19);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+23);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+27);
$pdf->Cell(66, 5, 'เภสัชกร__________________________วันที่________________',0,1,'L');

// ส่วนของพยาบาล
$pdf->SetFont('THSarabun','',10);
$pdf->Rect(137, $lastY, 66, 32.5);
$pdf->SetXY(137, $lastY);
$pdf->Cell(66, 5, 'เรียนแพทย์/เภสัชกร____________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+4);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+8);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+12);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+17);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+22);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+27);
$pdf->Cell(66, 5, 'พยาบาล__________________________วันที่________________',0,1,'L');


// ขึ้นหน้ากระดาษใหม่ ก่อนขึ้นขณะแรกรับ
if( $pdf->GetY() > 240 ){
    $pdf->AddPage();
    $pdf->setXY(5,12);
}

$lastY = $pdf->GetY();
$pdf->SetFont('THSarabun','',12);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5.5, 'ขณะย้ายวอร์ด', 1, 1, 'L',true);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('THSarabun','B',12);


$lastY = $pdf->GetY();
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของแพทย์', 1, 1, 'C',true);
$pdf->SetXY(71, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของเภสัช', 1, 1, 'C',true);
$pdf->SetXY(137, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของพยาบาล', 1, 1, 'C',true);

// ส่วนของแพทย์
$lastY = $pdf->GetY();
$pdf->Rect(5, $lastY, 66, 32.5);
$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5, '[  ] ยืนยันคำสั่ง',0,1,'L');
$pdf->SetXY(5, $lastY+5);
$pdf->Cell(66, 5, '[  ] เปลี่ยนแปลง (ระบุ)__________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+10);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+14);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+18);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+22);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+27);
$pdf->Cell(66, 5, 'แพทย์__________________________วันที่_________________',0,1,'L');

// ส่วนของเภสัช
$pdf->SetFont('THSarabun','',9);
$pdf->Rect(71, $lastY, 66, 32.5); // กล่องใหญ่
$pdf->Rect(71, $lastY, 33, 14); // กล่องย่อย1
$pdf->SetXY(71, $lastY);
$pdf->Cell(33, 4, '[  ] Untreated indications',0,1,'L');
$pdf->SetXY(71, $lastY+4);
$pdf->Cell(33, 4, '[  ] Dosage too height/',0,1,'L');
$pdf->SetXY(71, $lastY+8);
$pdf->Cell(33, 4, 'too low/ wrong frequency',0,1,'L');

$pdf->Rect(104, $lastY, 33, 14); // กล่องย่อย2
$pdf->SetXY(104, $lastY);
$pdf->Cell(33, 4, '[  ] Duplication of drug therapy',0,1,'L');
$pdf->SetXY(104, $lastY+4);
$pdf->Cell(33, 4, '[  ] Drug interraction',0,1,'L');
$pdf->SetXY(104, $lastY+8);
$pdf->Cell(33, 4, '[  ] Administration error',0,1,'L');

$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(71, $lastY+14);
$pdf->Cell(66, 5, 'เรียนแพทย์/พยาบาล____________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+19);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+23);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+27);
$pdf->Cell(66, 5, 'เภสัชกร__________________________วันที่________________',0,1,'L');

// ส่วนของพยาบาล
$pdf->SetFont('THSarabun','',10);
$pdf->Rect(137, $lastY, 66, 32.5);
$pdf->SetXY(137, $lastY);
$pdf->Cell(66, 5, 'เรียนแพทย์/เภสัชกร____________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+4);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+8);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+12);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+17);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+22);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+27);
$pdf->Cell(66, 5, 'พยาบาล__________________________วันที่________________',0,1,'L');


$pdf->setY($lastY+32.5);/* !!!! !!!! */

// ขึ้นหน้ากระดาษใหม่ ก่อนขึ้นขณะแรกรับ
if( $pdf->GetY() > 240 ){
    $pdf->AddPage();
    $pdf->setXY(5,12);
}

$lastY = $pdf->GetY();
$pdf->SetFont('THSarabun','',12);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5.5, 'ขณะจำหน่าย', 1, 1, 'L',true);

$pdf->SetFillColor(255,255,255);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('THSarabun','B',12);

$lastY = $pdf->GetY();
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของแพทย์', 1, 1, 'C',true);
$pdf->SetXY(71, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของเภสัช', 1, 1, 'C',true);
$pdf->SetXY(137, $lastY);
$pdf->Cell(66, 5.5, 'ส่วนของพยาบาล', 1, 1, 'C',true);

// ส่วนของแพทย์
$lastY = $pdf->GetY();
$pdf->Rect(5, $lastY, 66, 32.5);
$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(5, $lastY);
$pdf->Cell(66, 5, '[  ] ยืนยันคำสั่ง',0,1,'L');
$pdf->SetXY(5, $lastY+5);
$pdf->Cell(66, 5, '[  ] เปลี่ยนแปลง (ระบุ)__________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+10);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+14);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+18);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+22);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(5, $lastY+27);
$pdf->Cell(66, 5, 'แพทย์__________________________วันที่_________________',0,1,'L');

// ส่วนของเภสัช
$pdf->SetFont('THSarabun','',9);
$pdf->Rect(71, $lastY, 66, 32.5); // กล่องใหญ่
$pdf->Rect(71, $lastY, 33, 14); // กล่องย่อย1
$pdf->SetXY(71, $lastY);
$pdf->Cell(33, 4, '[  ] Untreated indications',0,1,'L');
$pdf->SetXY(71, $lastY+4);
$pdf->Cell(33, 4, '[  ] Dosage too height/',0,1,'L');
$pdf->SetXY(71, $lastY+8);
$pdf->Cell(33, 4, 'too low/ wrong frequency',0,1,'L');

$pdf->Rect(104, $lastY, 33, 14); // กล่องย่อย2
$pdf->SetXY(104, $lastY);
$pdf->Cell(33, 4, '[  ] Duplication of drug therapy',0,1,'L');
$pdf->SetXY(104, $lastY+4);
$pdf->Cell(33, 4, '[  ] Drug interraction',0,1,'L');
$pdf->SetXY(104, $lastY+8);
$pdf->Cell(33, 4, '[  ] Administration error',0,1,'L');

$pdf->SetFont('THSarabun','',10);
$pdf->SetXY(71, $lastY+14);
$pdf->Cell(66, 5, 'เรียนแพทย์/พยาบาล____________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+19);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+23);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(71, $lastY+27);
$pdf->Cell(66, 5, 'เภสัชกร__________________________วันที่________________',0,1,'L');

// ส่วนของพยาบาล
$pdf->SetFont('THSarabun','',10);
$pdf->Rect(137, $lastY, 66, 32.5);
$pdf->SetXY(137, $lastY);
$pdf->Cell(66, 5, 'เรียนแพทย์/เภสัชกร____________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+4);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+8);
$pdf->Cell(66, 4, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+12);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+17);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+22);
$pdf->Cell(66, 5, '___________________________________________________',0,1,'L');
$pdf->SetXY(137, $lastY+27);
$pdf->Cell(66, 5, 'พยาบาล__________________________วันที่________________',0,1,'L');


$pdf->Output();