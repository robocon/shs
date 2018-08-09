<?php

include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

class MedSHS extends SHSPdf{

    function __construct($orientation='P', $unit='mm', $size='A4')
	{
		parent::__construct($orientation, $unit, $size);
    }
    
    function header(){

        global $user,$get_header_y, $date_set, $def_month_th; 

        $this->SetFont('THSarabun','',20);
        $this->SetXY(20, 12);
        $this->Cell(60, 8, 'โรงพยาบาลค่ายสุรศักดิ์มนตรี', 0, 1, 'C');

        $this->SetFont('THSarabun','',14);
        $this->SetXY(20, 20);
        $this->Cell(60, 8, 'แบบบันทึกการให้ยา', 0, 1, 'C');

        $this->SetFont('THSarabun','UB',18);
        $this->SetXY(20, 28);
        $this->Cell(60, 8, $_POST['type'], 0, 1, 'C');

        // ข้อมูลผู้ป่วย
        // 110
        $this->SetFont('THSarabun','',14);
        $this->SetXY(80, 12);
        $this->Cell(110, 6, 'ชื่อ/สกุล ผู้ป่วย: '.$user['ptname'].' อายุ: '.$user['age'], 0, 1);

        $this->SetXY(80, 18);
        $this->Cell(110, 6, 'HN: '.$user['hn'].' AN: '.$user['an'].' WARD: '.$user['ward_name'], 0, 1);

        $this->SetXY(80, 24);
        $this->Cell(110, 6, 'ROOM/BED: '.$user['bed'].' Dx: '.$user['diagnos'], 0, 1);

        $this->SetXY(80, 30);
        $this->Cell(110, 6, 'สิทธ์: '.$user['ptright'].' แพทย์: '.$user['doctor'], 0, 1);

        $this->SetXY(80, 36);
        $this->MultiCell(130, 6, $user['drug_reaction']);
        
        // ความสูงสุดท้ายของ MultiCel
        $header_y = $this->GetY();

        // เว้นเพิ่มไป 1 ช่อง
        $this->SetXY(80, $header_y);
        $this->Cell(110, 6, '', 0, 1);

        $this->SetFont('THSarabun','B',14);
        $this->SetXY(20, ( $header_y + 6 ));
        $this->Cell(52, 12, 'ชื่อยา ขนาด วิธีใช้', 1, 1, 'C');
        
        $this->SetXY(72, ( $header_y + 6 ));
        $this->Cell(15, 12, 'เวลา', 1, 1, 'C');

        // 
        $current = strtotime($date_set);
        $cell_width = 18;
        $cell_x = 87;
        for ($i=1; $i <= 6; $i++) { 

            $year = date('Y', $current) + 543;
            $short_y = substr($year,2);
            $month = date('m', $current);
            $date = date('d', $current);

            $this->SetXY($cell_x, ( $header_y + 6 ));
            $this->Cell($cell_width, 6, $date.'/'.$month.'/'.$short_y, 1, 1, 'C');

            $this->SetXY($cell_x, ( $header_y + 12 ));
            $this->Cell($cell_width, 6, 'เวลา/ผู้ให้', 1, 1, 'C');

            $cell_x += $cell_width;
            $current = strtotime('+1 day', $current);
        }

        $this->SetFont('THSarabun','',14);
        $get_header_y = $this->GetY();

    }
}


$db = Mysql::load();

$cAn = urldecode(input_post('an'));

$ward_lists = array(
    42 => 'หอผู้ป่วยรวม', 43 => 'หอผู้ป่วยสูติ', 44 => 'หอผู้ป่วยICU', 45 => 'หอผู้ป่วยพิเศษ'
);

$drug_lists = $_POST['drug_lists'];
$drug_height = $_POST['drug_height'];

// ข้อมูลจากเตียงผู้ป่วย
$sql = "SELECT * FROM `bed` WHERE `an` = '$cAn' ";
$db->select($sql);
$user = $db->get_item();
$hn = $user['hn'];

// แพ้ยา
$sql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' ";
$db->select($sql);
$drug_react = $db->get_items();

$i = 1;
$react_txt = '';
foreach ($drug_react as $key => $dreact) { 

    $advreact = ( !empty($dreact['advreact']) ) ? ' ( อาการ: '.$dreact['advreact'].' )' : '' ;

    $react_txt .= $i.'.)';

    if( !empty($dreact['drugcode']) ){
        $react_txt .= $dreact['drugcode'];
    }

    $react_txt .= $dreact['genname'].' '.$dreact['tradname'].' '.$advreact."\n\r";
    $i++;

}

$ward_code = substr($user['bedcode'], 0, 2);
$ward_name = $ward_lists[$ward_code];

$wardExTest = preg_match('/45.+/', $user['bedcode']);
if( $wardExTest > 0 ){
    
    // เช็กว่าเป็นชั้น3 ถ้าไม่ใช่เป็นชั้น2
    $wardR3Test = preg_match('/R3\d+|B\d+/', $user['bedcode']);
    $wardBxTest = preg_match('/B[0-9]+/', $user['bedcode']);
    $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? 'ชั้น3' : 'ชั้น2' ;
    $ward_name = $ward_name.' '.$exName;
}

// เซ็ตข้อมูลสำหรับ HEADER ของตาราง
$date_set = $_POST['date_set'];
$user['drug_reaction'] = $react_txt;
$user['ward_name'] = $ward_name;
// เซ็ตข้อมูลสำหรับ HEADER ของตาราง


// A4 ยาวทั้งหมด 210mm สูง 297mm
$pdf = new MedSHS('P', 'mm', 'A4');
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetMargins(0,0); // left, top, right
$pdf->AddPage();
$pdf->SetFont('THSarabun','',14); // เรียกใช้งานฟอนต์ที่เตรียมไว้



foreach ($drug_lists as $drug_code) {
    
    $sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id` 
    FROM `dgprofile` 
    WHERE `an` = '$cAn' 
    AND `drugcode` = '$drug_code' ";
    $db->select($sql);
    $d = $db->get_item();

    // ความสูงเพื่อคีย์ เวลา/ผู้ให้ 
    $def_drug_h = $drug_height[$drug_code]['0'];
    $tr_height = $def_drug_h + 1;

    $slcode = $d['slcode'];

    $sql = "SELECT * 
    FROM `drugslip` 
    WHERE `slcode` = '$slcode' ";
    $db->select($sql);
    $dSlip = $db->get_item();

    $detail_txt = $dSlip['detail1']." ";
    $detail_txt .= $dSlip['detail2']." ";
    $detail_txt .= $dSlip['detail3']." ";
    $detail_txt .= $dSlip['detail4'];

    // เซ็ตให้ทุกบรรทัดห่างจาก X 20 หน่วย
    $drug_y = $pdf->GetY();

    if( $drug_y > 240 ){
        $pdf->AddPage();
        $drug_y = $get_header_y;
    }

    $pdf->SetX(20);
    
    // หาความสูงของตัว Multicel ที่เป็นข้อความ
    $message = $d['tradname'].'('.$d['slcode'].')'."\n\r".$detail_txt."$drug_y   $tr_height";
    $muticell_h = $pdf->GetMultiCellHeight(52, 6, $message);

    // หาร 6 เพราะ1บรรทัดสูง6หน่วย
    $muticell_hCal = $muticell_h / 6; 
    // ถ้าข้อความสูงกว่าค่าที่ user input เข้ามา
    if( $muticell_hCal > $tr_height ){
        $tr_height = $muticell_hCal + 1;
    }

    // x y w h
    // เป็นกรอบข้อความยา
    $pdf->Rect(20, $drug_y, 52, ($tr_height * 6));
    $pdf->MultiCell(52, 6, $d['tradname'].'('.$d['slcode'].')'."\n\r".$detail_txt, 0);

    ////// 
    // ในยาแต่ละตัวสูงกี่บรรทัด 
    $td_h = 72;
    $tr_h = $drug_y;

    // วนตามความสูงที่ user คีย์เข้ามา
    for( $tr_count = 1; $tr_count <= $tr_height; $tr_count++ ){
        
        // ช่องลงเวลา
        $pdf->Rect($td_h, $tr_h, 15, 6);

        $td2_h = 87;
        // เหลือ repeat อีก 5 วัน
        for ($td_count=0; $td_count <= 5; $td_count++) { 
            $pdf->Rect($td2_h, $tr_h, 18, 6);
            $td2_h += 18;
        }

        $tr_h += 6;
    }

    $pdf->SetY(($drug_y + ($tr_height * 6)));

}


// ถ้าท้ายตารางเกินขอบด้านล่าง
$footer_h = $pdf->GetY();
if( $footer_h > 240 ){
    $pdf->AddPage();
    $footer_h = $get_header_y;
}

$pdf->SetXY(20, $footer_h);
$pdf->Cell(52, 12, 'Recheck order', 1, 1, 'C');
$pdf->SetXY(72, $footer_h);
$pdf->Cell(123, 12, 'ผู้ตรวจสอบ', 1, 1, 'C');

$pdf->SetXY(20, ($footer_h + 12));
$pdf->Cell(52, 6, 'เวรเช้า', 1, 1, 'C');
$pdf->Rect(72, ($footer_h + 12), 15, 6);
$pdf->Rect(87, ($footer_h + 12), 18, 6);
$pdf->Rect(105, ($footer_h + 12), 18, 6);
$pdf->Rect(123, ($footer_h + 12), 18, 6);
$pdf->Rect(141, ($footer_h + 12), 18, 6);
$pdf->Rect(159, ($footer_h + 12), 18, 6);
$pdf->Rect(177, ($footer_h + 12), 18, 6);

$pdf->SetXY(20, ($footer_h + 18));
$pdf->Cell(52, 6, 'เวรบ่าย', 1, 1, 'C');
$pdf->Rect(72, ($footer_h + 18), 15, 6);
$pdf->Rect(87, ($footer_h + 18), 18, 6);
$pdf->Rect(105, ($footer_h + 18), 18, 6);
$pdf->Rect(123, ($footer_h + 18), 18, 6);
$pdf->Rect(141, ($footer_h + 18), 18, 6);
$pdf->Rect(159, ($footer_h + 18), 18, 6);
$pdf->Rect(177, ($footer_h + 18), 18, 6);

$pdf->SetXY(20, ($footer_h + 24));
$pdf->Cell(52, 6, 'เวรดึก', 1, 1, 'C');
$pdf->Rect(72, ($footer_h + 24), 15, 6);
$pdf->Rect(87, ($footer_h + 24), 18, 6);
$pdf->Rect(105, ($footer_h + 24), 18, 6);
$pdf->Rect(123, ($footer_h + 24), 18, 6);
$pdf->Rect(141, ($footer_h + 24), 18, 6);
$pdf->Rect(159, ($footer_h + 24), 18, 6);
$pdf->Rect(177, ($footer_h + 24), 18, 6);

// $pdf->AutoPrint(true);
$pdf->Output();

exit;



?>
<style>
*{
    margin: 0;
}
.clearfix::after{
    content: "";
    clear: both;
    display: table;
}

/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}
.chk_table th{
    /* font-size: 16pt; */
}
.chk_table th,
.chk_table td{
    padding: 3px;
}

#main_page{
    font-family: TH Sarabun New, TH SarabunPSK;
    font-size: 16pt;
    /* padding: 15mm; */
}
.time-get th{
    width: 10mm;
    height: 7mm;
}
.td_detail{
    height: 7mm;
    font-size: 16pt;
}

@media print{
    .page_header{
        height: auto; 
        /* position: fixed;  */
        width: 100%;
    }
    .page_body,
    .new_table_page{
        
    }
}

</style>
<!-- width: 8.3in; height: 11.7in; -->
<div id="main_page" style="">

    <div class="page_header" style="" class="clearfix">
        <div style="width: 35%; height: 45mm; float: left; text-align: center;">
            <p style="font-size: 20pt;"><b>โรงพยาบาลค่ายสุรศักดิ์มนตรี</b></p>
            <p><b>แบบบันทึกการให้ยา</b></p>
            <p style="font-size: 18pt;"><b><u><?=$_POST['type'];?></u></b></p>
        </div>
        <div style="width: 65%; float: right;">
            <b>ชื่อ/สกุล ผู้ป่วย: </b><?=$user['ptname'];?> <b>อายุ: </b><?=$user['age'];?><br>
            <b>HN: </b><?=$user['hn'];?> <b>AN: </b><?=$user['an'];?> <b>WARD: </b><?=$ward_name;?><br>
            <b>ROOM/BED: </b><?=$user['bed'];?> <b>Dx: </b><?=$user['diagnos'];?><br>
            <b>สิทธ์: </b><?=$user['ptright'];?> <b>แพทย์: </b><?=$user['doctor'];?><br>
            <?php
            if( $react_txt !== '' ){
                ?>
                <span style="color: red;">
                    <b><u>แพ้ยา:</u> </b><?=$react_txt;?>
                </span>
                <?php
            }
            ?>
        </div>


    </div>

    <!-- clear fix for IE 8 -->
    <div style="clear: both;"></div>

    <div class="page_body" style="">
        <table class="chk_table" width="100%">
            <tr>
                <th rowspan="2" style="font-size: 20px;">ชื่อยา ขนาด วิธีให้</th>

                <?php
                $current = strtotime($_POST['date_set']);

                for ($i=1; $i <= 7; $i++) { 

                    $year = date('Y', $current) + 543;
                    $month = date('m', $current);
                    $date = date('d', $current);
                    ?>
                    <th width="10%"><?=$date;?> <?=$def_month_th[$month];?> <?=$year;?></th>
                    <?php
                    $current = strtotime('+1 day', $current);
                }
                ?>
                
            </tr>
            <tr class="time-get">
                <th>เวลา/ผู้ให้</th>
                <th>เวลา/ผู้ให้</th>
                <th>เวลา/ผู้ให้</th>
                <th>เวลา/ผู้ให้</th>
                <th>เวลา/ผู้ให้</th>
                <th>เวลา/ผู้ให้</th>
                <th>เวลา/ผู้ให้</th>
            </tr>

            <?php
            $ii = 1;
            foreach ($drug_lists as $drug_code) {

                if ( $ii == 6 ) {
                    
                    ?>
                    </table>
                    </div>

                    <div style="page-break-before: always;"></div>

                    <div class="page_body">
                    <table class="chk_table" width="100%" style="padding-top: 45mm;">
                    <?php
                    
                }
                
                $ii++;

                $sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id` 
                FROM `dgprofile` 
                WHERE `an` = '$cAn' 
                AND `drugcode` = '$drug_code' ";
                $db->select($sql);
                $d = $db->get_item();

                $def_drug_h = $drug_height[$drug_code]['0'];
                $tr_height = $def_drug_h + 1;

                $slcode = $d['slcode'];

                $sql = "SELECT * 
                FROM `drugslip` 
                WHERE `slcode` = '$slcode' ";
                $db->select($sql);
                $dSlip = $db->get_item();

                $detail_txt = $dSlip['detail1'].'<br>';
                $detail_txt .= $dSlip['detail2'].'<br>';
                $detail_txt .= $dSlip['detail3'].'<br>';
                $detail_txt .= $dSlip['detail4'];

                ?>
                <tr class="td_detail">
                    <td rowspan="<?=$tr_height;?>" style="vertical-align: top; font-size: 16pt;">
                        <?=$d['tradname'];?>&nbsp;&nbsp;( <?=$d['slcode'];?> )<br>
                        <?=$detail_txt;?>
                    </td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                    <td width="10%"></td>
                </tr>
                <?php
                for ($i=0; $i < $def_drug_h; $i++) { 
                    ?>
                    <tr class="td_detail">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <?php
                }
            }
            ?>
            <tr class="td_detail">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="td_detail">
                <td align="center"><b>Recheck order</b></td>
                <td colspan="10" align="center"><b>ผู้ตรวจสอบ</b></td>
            </tr>
            <tr class="td_detail">
                <td  align="center"><b>เวรเช้า</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="td_detail">
                <td  align="center"><b>เวรบ่าย</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="td_detail">
                <td  align="center"><b>เวรดึก</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
</div>
<script>
window.onload = function(){
    // window.print();
};
</script>