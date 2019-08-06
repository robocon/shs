<?php

/**
 * @readme
 * ��ͧ��ä�� Array Array �����ٻẺ
 * array(
 *     array(
 *          'tradename' => '������',
 *          'num' => '�ӹǹ����ԡ'
 *     )
 * );
 * 
 */

// include 'fpdf_thai/fpdf_thai.php';
include 'fpdf_thai/shspdf.php';

class MedSHS extends SHSPdf{

    function __construct($orientation='P', $unit='mm', $size='A4')
	{
		parent::__construct($orientation, $unit, $size);
    }
    
    function Header(){

        $date_serve = $GLOBALS['date_serve'];

        $this->SetXY(8, 4);
        $this->SetFont('THSarabun', 'B', 25);
        $this->Cell(170, 15, '�ç��Һ�Ť�������ѡ��������', 0, 1, 'C');

        $this->Rect(8, 19, 170, 11); // ��ͺ
        $this->SetXY(10, 19);
        $this->SetFont('THSarabun', '', 17);
        $this->Cell(50, 11, '�Ţ��� ..............................', 0, 1, 'L');
        $this->SetXY(75, 19);
        $this->SetFont('THSarabun', 'B', 38);
        $this->Cell(30, 11, '��ԡ', 0, 1, 'C');
        
        $this->SetXY(108, 19);
        $this->SetFont('THSarabun', '', 17);
        $this->Cell(70, 11, '�ѹ��� .............................................................', 0, 1, 'R');
        // y -1 ��������ѹ����ѹ��¢���ҹԴ˹��
        $this->SetXY(125, 18);
        $this->Cell(35, 11, $date_serve, 0, 1, 'C');

        $this->Rect(8, 30, 170, 11); // ��ͺ
        $this->SetXY(10, 30);
        $this->Cell(80, 11, '˹��¨��� ....................................................', 0, 1, 'L');
        $this->SetXY(98, 30);
        $this->Cell(80, 11, '˹����ԡ ....................................................', 0, 1, 'R');

        $this->SetFont('THSarabun', '', 17); // ���¡��ҹ�͹������������

        // ��Ǣ����¡�ô�ҹ����
        $this->SetXY(8, 41);
        $this->Cell(25, 18, '������', 1, 1, 'C');

        $this->SetXY(33, 41);
        $this->Cell(85, 18, '��¡��', 1, 1, 'C');

        $this->SetXY(118, 41);
        // $this->Cell(15, 18, '�ӹǹ�ԡ', 1, 1, 'C');
        $this->Multicell(15, 9, '�ӹǹ �ԡ', 1, 'C');

        $this->SetXY(133, 41);
        $this->Cell(15, 18, '���¨�ԧ', 1, 1, 'C');

        $this->SetXY(148, 41);
        $this->Cell(30, 11, '���Թ', 1, 1, 'C');
        $this->SetXY(148, 52);
        $this->Cell(18, 7, '�ҷ', 1, 1, 'C');
        $this->SetXY(166, 52);
        $this->Cell(12, 7, 'ʵ.', 1, 1, 'C');

    }

    
    function Footer(){ 
        
        global $latest_line;

        $latest_line += 6;

        $this->SetXY(8, $latest_line);
        $this->Cell(85, 6, '��Ǩ����������', 0, 1);
        $this->SetXY(93, $latest_line);
        $this->Cell(85, 6, '���ԡ ʻ. �������к����㹪�ͧ "�ӹǹ�ԡ" ��Т��ͺ', 0, 1, 'R');

        $latest_line += 6;

        $this->SetXY(8, $latest_line);
        $this->Cell(85, 6, '��è��� ʻ. ������ӹǹ㹪�ͧ "���¨�ԧ"', 0, 1);
        $this->SetXY(93, $latest_line);
        $this->Cell(85, 6, '���.................................................................�繼���Ѻ᷹', 0, 1, 'R');

        $latest_line += 6;

        $this->SetXY(8, $latest_line);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(58, $latest_line);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');
        $this->SetXY(94, $latest_line);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(144, $latest_line);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');

        $latest_line += 7;

        $this->SetXY(8, $latest_line);
        $this->Cell(45, 7, '����Ǩ����', 0, 1, 'C');
        $this->SetXY(58, $latest_line);
        $this->Cell(32, 7, '�ѹ ��͹ ��', 0, 1, 'C');
        $this->SetXY(94, $latest_line);
        $this->Cell(45, 7, '����ԡ', 0, 1, 'C');
        $this->SetXY(144, $latest_line);
        $this->Cell(32, 7, '�ѹ ��͹ ��', 0, 1, 'C');

        $latest_line += 7;

        $this->Line(8, $latest_line, 178, $latest_line);
        $this->SetXY(8, $latest_line);
        $this->Cell(170, 7, '����� ʻ. �����¡�èӹǹ��������㹪�ͧ���¨�ԧ���� ���Ѻ ʻ. �����¡����Шӹǹ��������㹪�ͧ���¨�ԧ����', 0, 1, 'C');

        $latest_line += 6;

        $this->SetXY(8, $latest_line);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(58, $latest_line);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');
        $this->SetXY(94, $latest_line);
        $this->Cell(45, 11, '...................................................', 0, 1, 'B');
        $this->SetXY(144, $latest_line);
        $this->Cell(32, 11, '.........../.........../...........', 0, 1, 'B');

        $latest_line += 7;

        $this->SetXY(8, $latest_line);
        $this->Cell(45, 7, '�����¢ͧ', 0, 1, 'C');
        $this->SetXY(58, $latest_line);
        $this->Cell(32, 7, '�ѹ ��͹ ��', 0, 1, 'C');
        $this->SetXY(94, $latest_line);
        $this->Cell(45, 7, '����Ѻ�ͧ', 0, 1, 'C');
        $this->SetXY(144, $latest_line);
        $this->Cell(32, 7, '�ѹ ��͹ ��', 0, 1, 'C');
    }
}

$m = date('m');
if( !isset($date_serve) ){
    $date_serve = date('d').' '.$def_fullm_th[$m].' '.( date('Y') + 543 );
}

$pdf = new MedSHS("P",'mm', "A4");
$pdf->SetThaiFont(); // �絿͹��
$pdf->SetAutoPageBreak(true, 0);
$pdf->SetMargins(8, 4);
$pdf->AddPage();

$pdf->SetFont('THSarabun', '', 15);

// ���᡹ y ����繺�÷Ѵ�������
$y_start = 59;

// ���᡹ X
$x_drugcode = 8; 
$x_tradename = 33;
$x_drugbring = 118;
$x_pay = 133;
$x_baht = 148;
$x_smallbaht = 166;

$max_row = 17; // �ӹǹ�ǵ��˹��˹�ҡ�д�ɷ������٧ 7.5
$default_line_height = 7.5; // �����٧�ҵðҹ
$line_total = 0; // �ӹǹ��÷Ѵ������

$line_max_height = $y_start + ($default_line_height * $max_row) ; // �����٧���˹��˹�ҡ�д��

// �ӹǹ��
$item_rows = count($full_items);

// �ӹǹ������ԧ�ͧ���ҧ
// �.�. �� �ӹǹ����25 �ӹǹ��ͧ��еѴ�� 34 (2˹�ҡ�д��)
$full_rows = (int) ( ceil(( $item_rows / $max_row )) ) * $max_row ;

$line_number = 0;
$over_line_limit = 0;

for ($i=1; $i <= $full_rows; $i++) { 
    
    $line_height = $default_line_height;
    $item = $full_items[$i];
    
    if( !empty($item) ){

        // �ͧ�Ѻ����2��÷Ѵ
        $tradename = trim($item['tradename']);
        $tradename = preg_replace('/[[:space:]]+/',' ',$tradename);

        // �Ѻ��Ҥ����٧�ͧ tradename
        $line_height = $pdf->GetMultiCellHeight(85, 7.5, $tradename,1);

        // ������
        $pdf->SetXY($x_drugcode, $y_start);
        $pdf->Cell(25, $line_height, $item['drugcode'], 1, 1, 'L');

        // ��¡����
        $pdf->SetXY($x_tradename, $y_start);
        $pdf->MultiCell(85, 7.5, $tradename, 1, L);

        // �ӹǹ�ԡ
        $pdf->SetXY($x_drugbring, $y_start);
        $drug_num = ( empty($item['num']) ) ? 0 : $item['num'] ; 
        $pdf->Cell(15, $line_height, $drug_num, 0, 0, 'R');

    }else{
        // ����պ�÷Ѵ����Թ(������ѹ����2��÷Ѵ) �������������
        if( $over_line_limit > 0 ){
            --$over_line_limit;
            continue;
        }
    }

    // ��÷Ѵ����ҧ���������ҧ��Ѻ���������
    ++$line_number;

    $pdf->Rect($x_drugcode, $y_start, 25, $line_height); //������
    $pdf->Rect($x_tradename, $y_start, 85, $line_height); //��¡����
    $pdf->Rect($x_drugbring, $y_start, 15, $line_height); //�ӹǹ�ԡ

    // �����ͧ��ҹ��Ңͧ���� column �繤����ҧ
    $pdf->Rect($x_pay, $y_start, 15, $line_height); //���¨�ԧ
    $pdf->Rect($x_baht, $y_start, 18, $line_height); //���Թ(�ҷ)

    
    $pdf->Rect($x_smallbaht, $y_start, 12, $line_height); //���Թ(ʵ.)

    $y_start += $line_height; // ��鹺�÷Ѵ������������

    // ��� latest_line ���� footer
    $latest_line = $y_start;

    if( $line_number == $max_row && !empty($item) ){
        $y_start = 59;
        $line_number = 0;
        $pdf->AddPage();
    }

}

$pdf->AutoPrint(true);
$pdf->Output();
exit;