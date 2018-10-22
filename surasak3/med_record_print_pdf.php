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
        $this->Cell(60, 8, '�ç��Һ�Ť�������ѡ��������', 0, 1, 'C');

        $this->SetFont('THSarabun','',14);
        $this->SetXY(20, 20);
        $this->Cell(60, 8, 'Ẻ�ѹ�֡��������', 0, 1, 'C');

        $this->SetFont('THSarabun','UB',18);
        $this->SetXY(20, 28);
        $this->Cell(60, 8, $_POST['type'], 0, 1, 'C');

        // �����ż�����
        // 110
        $this->SetFont('THSarabun','',14);
        $this->SetXY(80, 12);
        $this->Cell(110, 6, '����/ʡ�� ������: '.$user['ptname'].' ����: '.$user['age'], 0, 1);

        $this->SetXY(80, 18);
        $this->Cell(110, 6, 'HN: '.$user['hn'].' AN: '.$user['an'].' WARD: '.$user['ward_name'], 0, 1);

        $this->SetXY(80, 24);
        $this->Cell(110, 6, 'ROOM/BED: '.$user['bed'].' Dx: '.$user['diagnos'], 0, 1);

        $this->SetXY(80, 30);
        $this->Cell(110, 6, '�Է��: '.$user['ptright'].' ᾷ��: '.$user['doctor'], 0, 1);

        if( $user['drug_reaction'] ){
            $this->SetXY(80, 36);
            $this->MultiCell(130, 6, '���� : '.$user['drug_reaction']);
        }
        
        
        // �����٧�ش���¢ͧ MultiCel
        $header_y = $this->GetY();

        // �������� 1 ��ͧ
        $this->SetXY(80, $header_y);
        $this->Cell(110, 6, '', 0, 1);

        $this->SetFont('THSarabun','B',14);
        $this->SetXY(10, ( $header_y + 6 ));
        $this->Cell(52, 12, '������ ��Ҵ �Ը���', 1, 1, 'C');
        
        // ���ҧ 15
        $this->SetXY(62, ( $header_y + 6 ));
        $this->Cell(15, 12, '����', 1, 1, 'C');

        // 
        $current = strtotime($date_set);
        $cell_width = 18; // ���ҧ 18
        $cell_x = 77;

        // 7 �ѹ
        for ($i=1; $i <= 7; $i++) { 

            $year = date('Y', $current) + 543;
            $short_y = substr($year,2);
            $month = date('m', $current);
            $date = date('d', $current);

            $this->SetXY($cell_x, ( $header_y + 6 ));
            $this->Cell($cell_width, 6, $date.'/'.$month.'/'.$short_y, 1, 1, 'C');

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

// �����Ũҡ��§������
$sql = "SELECT * FROM `bed` WHERE `an` = '$cAn' ";
$db->select($sql);
$user = $db->get_item();
$hn = $user['hn'];

// ����
$sql = "SELECT * FROM `drugreact` WHERE `hn` = '$hn' ";
$db->select($sql);
$drug_react = $db->get_items();

$i = 1;
$react_txt = '';
foreach ($drug_react as $key => $dreact) { 

    $advreact = ( !empty($dreact['advreact']) ) ? ' ( �ҡ��: '.$dreact['advreact'].' )' : '' ;

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

// for ($i=1; $i <= 45; $i++) { 

//     $test_y = $i * 6;
//     $pdf->SetXY(1, $test_y);
//     $pdf->Cell(6, 6, $i, 1, 1, 'C');

// }

foreach ($drug_lists as $drug_id) {


    // list($drug_code, $drug_slcode) = explode('|', $drug_mix);
    
    $sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id` 
    FROM `dgprofile` 
    WHERE `an` = '$cAn' 
    AND `row_id` = '$drug_id' ";
    $db->select($sql);
    $d = $db->get_item();

    // �����٧���ͤ��� ����/������ 
    $def_drug_h = $drug_height[$drug_id]['0'];
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

    
    $drug_y = $pdf->GetY();

    if( $drug_y > 240 ){
        $pdf->AddPage();
        $drug_y = $get_header_y;
    }

    // �����ء��÷Ѵ��ҧ�ҡ X 10 ˹���
    $pdf->SetX(10);
    
    // �Ҥ����٧�ͧ��� Multicel ����繢�ͤ���
    $message = $d['tradname'].'('.$slcode.')'."\n\r".$detail_txt."$drug_y   $tr_height";
    $muticell_h = $pdf->GetMultiCellHeight(52, 6, $message);

    // ��� 6 ����1��÷Ѵ�٧6˹���
    $muticell_hCal = $muticell_h / 6; 
    // ��Ң�ͤ����٧���Ҥ�ҷ�� user input �����
    if( $muticell_hCal > $tr_height ){
        $tr_height = $muticell_hCal + 1;
    }

    // x y w h
    // �繡�ͺ��ͤ�����
    $pdf->Rect(10, $drug_y, 52, ($tr_height * 6));
    $pdf->MultiCell(52, 6, $d['tradname'].'('.$slcode.')'."\n\r".$detail_txt, 0);

    ////// 
    // ������е���٧����÷Ѵ 
    $td_h = 62; // X ��ͧŧ����
    $tr_h = $drug_y;

    // ǹ��������٧��� user ���������
    for( $tr_count = 1; $tr_count <= $tr_height; $tr_count++ ){
        
        // ��ͧŧ����
        $pdf->Rect($td_h, $tr_h, 15, 6);

        $td2_h = 77; // ᡹ X
        // ����� repeat �ա 5 �ѹ
        for ($td_count=0; $td_count <= 6; $td_count++) { 
            $pdf->Rect($td2_h, $tr_h, 18, 6);
            $td2_h += 18;
        }

        $tr_h += 6;
    }

    $pdf->SetY(($drug_y + ($tr_height * 6)));

} // ������ʴ�����¡����


// ��ҷ��µ��ҧ�Թ�ͺ��ҹ��ҧ
$footer_h = $pdf->GetY();
if( $footer_h > 240 ){
    $pdf->AddPage();
    $footer_h = $get_header_y;
}

// �����٧�ش���¡�͹��鹷��µ��ҧ
$test_before_footer = ( 240 - $footer_h );
// ��ͧ��ҧ��͹�Т�� footer
if( $test_before_footer > 0 ){

    $test_line_footer = ( $test_before_footer / 6 );

    for ($i=0; $i < $test_line_footer; $i++) { 
        

        $test_y = ( $i * 6 ) + $footer_h;

        // ��ͧ������
        $pdf->SetXY(10, $test_y);
        $pdf->Cell(52, 6, '', 1, 1, 'C');

        // ��ͧ����
        $pdf->Rect(62, $test_y, 15, 6);

        $pdf->Rect(77, $test_y, 18, 6);
        $pdf->Rect(95, $test_y, 18, 6);
        $pdf->Rect(113, $test_y, 18, 6);
        $pdf->Rect(131, $test_y, 18, 6);
        $pdf->Rect(149, $test_y, 18, 6);
        $pdf->Rect(167, $test_y, 18, 6);
        $pdf->Rect(185, $test_y, 18, 6);

    }

    $footer_h = $test_y + 6;
}

// Footer
$pdf->SetXY(10, $footer_h);
$pdf->Cell(52, 12, 'Recheck order', 1, 1, 'C');
$pdf->SetXY(62, $footer_h);
$pdf->Cell(141, 12, '����Ǩ�ͺ', 1, 1, 'C');

$line_bottom_1 = $footer_h + 12;
$pdf->SetXY(10, $line_bottom_1);
$pdf->Cell(52, 6, '������', 1, 1, 'C');
$pdf->Rect(62, $line_bottom_1, 15, 6); // ��ͧ����

$pdf->Rect(77, $line_bottom_1, 18, 6);
$pdf->Rect(95, $line_bottom_1, 18, 6);
$pdf->Rect(113, $line_bottom_1, 18, 6);
$pdf->Rect(131, $line_bottom_1, 18, 6);
$pdf->Rect(149, $line_bottom_1, 18, 6);
$pdf->Rect(167, $line_bottom_1, 18, 6);
$pdf->Rect(185, $line_bottom_1, 18, 6);

$pdf->SetXY(10, ($footer_h + 18));
$pdf->Cell(52, 6, '��ú���', 1, 1, 'C');
$pdf->Rect(62, ($footer_h + 18), 15, 6);

$pdf->Rect(77, ($footer_h + 18), 18, 6);
$pdf->Rect(95, ($footer_h + 18), 18, 6);
$pdf->Rect(113, ($footer_h + 18), 18, 6);
$pdf->Rect(131, ($footer_h + 18), 18, 6);
$pdf->Rect(149, ($footer_h + 18), 18, 6);
$pdf->Rect(167, ($footer_h + 18), 18, 6);
$pdf->Rect(185, ($footer_h + 18), 18, 6);

$pdf->SetXY(10, ($footer_h + 24));
$pdf->Cell(52, 6, '��ô֡', 1, 1, 'C');
$pdf->Rect(62, ($footer_h + 24), 15, 6);

$pdf->Rect(77, ($footer_h + 24), 18, 6);
$pdf->Rect(95, ($footer_h + 24), 18, 6);
$pdf->Rect(113, ($footer_h + 24), 18, 6);
$pdf->Rect(131, ($footer_h + 24), 18, 6);
$pdf->Rect(149, ($footer_h + 24), 18, 6);
$pdf->Rect(167, ($footer_h + 24), 18, 6);
$pdf->Rect(185, ($footer_h + 24), 18, 6);

// $pdf->AutoPrint(true);
$pdf->Output();
