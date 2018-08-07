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
        $this->Cell(60, 8, '�ç��Һ�Ť�������ѡ��������', 1, 1, 'C');

        $this->SetFont('THSarabun','',14);
        $this->SetXY(20, 20);
        $this->Cell(60, 8, 'Ẻ�ѹ�֡��������', 1, 1, 'C');

        $this->SetFont('THSarabun','UB',18);
        $this->SetXY(20, 28);
        $this->Cell(60, 8, $_POST['type'], 1, 1, 'C');

        // �����ż�����
        // 110
        $this->SetFont('THSarabun','',14);
        $this->SetXY(80, 12);
        $this->Cell(110, 6, '����/ʡ�� ������: '.$user['ptname'].' ����: '.$user['age'], 1, 1);

        $this->SetXY(80, 18);
        $this->Cell(110, 6, 'HN: '.$user['hn'].' AN: '.$user['an'].' WARD: '.$user['ward_name'], 1, 1);

        $this->SetXY(80, 24);
        $this->Cell(110, 6, 'ROOM/BED: '.$user['bed'].' Dx: '.$user['diagnos'], 1, 1);

        $this->SetXY(80, 30);
        $this->Cell(110, 6, '�Է��: '.$user['ptright'].' ᾷ��: '.$user['doctor'], 1, 1);

        $this->SetXY(80, 36);
        $this->MultiCell(110, 6, $user['drug_reaction']);
        
        // �����٧�ش���¢ͧ MultiCel
        $header_y = $this->GetY();

        // �������� 1 ��ͧ
        $this->SetXY(80, $header_y);
        $this->Cell(110, 6, '', 1, 1);

        $this->SetFont('THSarabun','B',14);
        $this->SetXY(20, ( $header_y + 6 ));
        $this->Cell(52, 12, '������ ��Ҵ �Ը���', 1, 1, 'C');
        

        // 
        $current = strtotime($date_set);
        $cell_width = 24;
        $cell_x = 72;
        for ($i=1; $i <= 5; $i++) { 

            $year = date('Y', $current) + 543;
            $month = date('m', $current);
            $date = date('d', $current);

            $this->SetXY($cell_x, ( $header_y + 6 ));
            $this->Cell($cell_width, 6, $date.' '.$def_month_th[$month].' '.$year, 1, 1, 'C');

            $this->SetXY($cell_x, ( $header_y + 12 ));
            $this->Cell($cell_width, 6, '����/������', 1, 1, 'C');

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
    42 => '�ͼ��������', 43 => '�ͼ������ٵ�', 44 => '�ͼ�����ICU', 45 => '�ͼ����¾����'
);

$drug_lists = $_POST['drug_lists'];
$drug_height = $_POST['drug_height'];

$sql = "SELECT * FROM `bed` WHERE `an` = '$cAn' ";
$db->select($sql);
$user = $db->get_item();
$hn = $user['hn'];

$sql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' ";
$db->select($sql);
$drug_react = $db->get_items();

$i = 1;
$react_txt = '';
foreach ($drug_react as $key => $dreact) { 

    $advreact = ( !empty($dreact['advreact']) ) ? ' ( �ҡ��: '.$dreact['advreact'].' )' : '' ;

    $react_txt = $i.'.)';

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
    
    // ������繪��3 ���������繪��2
    $wardR3Test = preg_match('/R3\d+|B\d+/', $user['bedcode']);
    $wardBxTest = preg_match('/B[0-9]+/', $user['bedcode']);
    $exName = ( $wardR3Test > 0 OR $wardBxTest > 0 ) ? '���3' : '���2' ;
    $ward_name = $ward_name.' '.$exName;
}

// �絢���������Ѻ HEADER �ͧ���ҧ
$date_set = $_POST['date_set'];
$user['drug_reaction'] = $react_txt;
$user['ward_name'] = $ward_name;
// �絢���������Ѻ HEADER �ͧ���ҧ


// A4 ��Ƿ����� 210mm �٧ 297mm
$pdf = new MedSHS('P', 'mm', 'A4');
$pdf->SetThaiFont(); // �絿͹��
$pdf->SetMargins(0,0); // left, top, right
$pdf->AddPage();
$pdf->SetFont('THSarabun','',14); // ���¡��ҹ�͹������������

// ��� y �ҡ�����ش�ͧ header
$start_line = $get_header_y;

$line_height = 6;
$ii = 1;
$test_line = 0;

// �����Ţͧ��
for ($i=1; $i <= 40; $i++) { 

    $test_line = $start_line + ( $line_height * $ii );

    // $pdf->SetX(20);
    // $pdf->Cell(110, 6, "Line: $ii Height: $line_height Start: $start_line Test: $test_line", 1, 1, 'C');

    $ii++;

}



foreach ($drug_lists as $drug_code) {
    
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

    $detail_txt = $dSlip['detail1']."\n";
    $detail_txt .= $dSlip['detail2']."\n";
    $detail_txt .= $dSlip['detail3']."\n";
    $detail_txt .= $dSlip['detail4'];

    // �����ء��÷Ѵ��ҧ�ҡ X 20 ˹���
    $pdf->SetX(20);

    $drug_y = $pdf->GetY();

    // x y w h
    $pdf->Rect(20, $drug_y, 52, ($tr_height * 6));

    $pdf->MultiCell(52, 6, $d['tradname'].'('.$d['slcode'].')'."\n\r".$detail_txt, 1);


    ////// 
    // ������е���٧����÷Ѵ 

    

    $start_tr = 72;
    $test_tr = $drug_y;
    for( $tr = 1; $tr <= $tr_height; $tr++ ){
    // foreach ($tr_height as $key => $tr) {
        # code...
        
        // dump($tr);

        $pdf->Rect($start_tr, $test_tr, 24, 6);
        // 

        $test_tr += 6;

        // ����� repeat �ա 4 �ѹ

    }

    
    $drug_y += ($tr_height * 6);
    $pdf->SetY($drug_y);

    

    
}

// exit;

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

/* ���ҧ */
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
            <p style="font-size: 20pt;"><b>�ç��Һ�Ť�������ѡ��������</b></p>
            <p><b>Ẻ�ѹ�֡��������</b></p>
            <p style="font-size: 18pt;"><b><u><?=$_POST['type'];?></u></b></p>
        </div>
        <div style="width: 65%; float: right;">
            <b>����/ʡ�� ������: </b><?=$user['ptname'];?> <b>����: </b><?=$user['age'];?><br>
            <b>HN: </b><?=$user['hn'];?> <b>AN: </b><?=$user['an'];?> <b>WARD: </b><?=$ward_name;?><br>
            <b>ROOM/BED: </b><?=$user['bed'];?> <b>Dx: </b><?=$user['diagnos'];?><br>
            <b>�Է��: </b><?=$user['ptright'];?> <b>ᾷ��: </b><?=$user['doctor'];?><br>
            <?php
            if( $react_txt !== '' ){
                ?>
                <span style="color: red;">
                    <b><u>����:</u> </b><?=$react_txt;?>
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
                <th rowspan="2" style="font-size: 20px;">������ ��Ҵ �Ը����</th>

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
                <th>����/������</th>
                <th>����/������</th>
                <th>����/������</th>
                <th>����/������</th>
                <th>����/������</th>
                <th>����/������</th>
                <th>����/������</th>
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
                <td colspan="10" align="center"><b>����Ǩ�ͺ</b></td>
            </tr>
            <tr class="td_detail">
                <td  align="center"><b>������</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="td_detail">
                <td  align="center"><b>��ú���</b></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <tr class="td_detail">
                <td  align="center"><b>��ô֡</b></td>
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