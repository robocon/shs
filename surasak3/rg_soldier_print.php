<?php
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

$id = input_get('id');

$db = Mysql::load();
$sql = "SELECT a.* 
FROM `rg_soldier` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`id` = '$id' ";
$db->select($sql);
$user = $db->get_item();

$yearchk = $user['yearchk'];
$img = false;
if( $user['pic'] != NULL ){
    $img = "certificate/$yearchk/".$user['pic'];
}

// list($date, $time) = explode(' ',$user['date_certificate']);
list($y, $m, $d) = explode('-', $user['date_certificate']);

$doctor1 = $user['yot1'].$user['doctor1'];
$doctor2 = $user['yot2'].$user['doctor2'];
$doctor3 = $user['yot3'].$user['doctor3'];

$pdf = new SHSPdf('P', 'mm', 'A4');
$pdf->SetThaiFont(); // �絿͹��
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(3, 3, 3); // left, top, right
$pdf->AddPage();
// $pdf->SetFont('THSarabun','',16); // ���¡��ҹ�͹������������

// ��鹻��
$pdf->SetLineWidth(0.1);
$pdf->SetDash(0.3, 0.6);

$pdf->SetFont('THSarabun','',12);
$pdf->SetXY(150, 9);
$pdf->Cell(18, 5, '��.466-620', 0, 1, 'R');

$pdf->SetFont('THSarabun','UB',18);
$pdf->SetXY(0, 45);
$pdf->Cell(210, 5, '��Ӥѭ������繢ͧᾷ��', 0, 1, 'C');

if( $img != false ){
    $pdf->Image($img, 170, 10, 25, 30);
}

$pdf->SetFont('THSarabun','B',16);
$pdf->SetXY(105, 55);
$pdf->Cell(10, 5, '�������', 0, 1);
$pdf->SetXY(145, 55);
$pdf->Cell(10, 5, '�Ţ���', 0, 1);

$pdf->SetFont('THSarabun','',16);
$pdf->SetXY(115, 55);
$pdf->Cell(20, 5, $user['book_id'], 0, 1);
$pdf->SetXY(155, 55);
$pdf->Cell(20, 5, $user['number_id'], 0, 1);

$pdf->SetXY(55, 65);
$pdf->Cell(10, 5, '�ѹ���', 0, 1);
$pdf->SetXY(65, 65);
$pdf->Cell(20, 5, $d, 0, 1, 'C');
$pdf->Line(65, 70, 85, 70);

$pdf->SetXY(85, 65);
$pdf->Cell(10, 5, '��͹', 0, 1);
$pdf->SetXY(95, 65);
$pdf->Cell(35, 5, $def_fullm_th[$m], 0, 1, 'C');
$pdf->Line(95, 70, 130, 70);

$pdf->SetXY(130, 65);
$pdf->Cell(10, 5, '�.�.', 0, 1);
$pdf->SetXY(140, 65);
$pdf->Cell(25, 5, ( $y + 543 ), 0, 1, 'C');
$pdf->Line(140, 70, 165, 70);

// Reset Dash line
// $pdf->SetDash();

$pdf->SetXY(30, 72);
$pdf->Cell(15, 5, '��Ҿ���', 0, 1);
$pdf->SetXY(55, 72);
$pdf->Cell(110, 5, $doctor1, 0, 1);
$pdf->Line(45, 77, 165, 77);

$pdf->SetXY(55, 79);
$pdf->Cell(110, 5, $doctor2, 0, 1);
$pdf->Line(45, 84, 165, 84);

$pdf->SetXY(55, 86);
$pdf->Cell(110, 5, $doctor3, 0, 1);
$pdf->Line(45, 91, 165, 91);

$pdf->SetXY(30, 93);
$pdf->Cell(15, 5, '���˹�', 0, 1);

$pdf->SetXY(50, 93);
$pdf->Cell(110, 5, '��С�����õ�Ǩ�ä ���áͧ�Թ��Ш��ç��Һ�Ť�������ѡ��������', 0, 1);
$pdf->Line(45, 98, 165, 98);

$pdf->SetXY(30, 107);
$pdf->Cell(135, 5, '�繼�騴����¹��Сͺ�ä��Ż�Ἱ�Ѩ�غѹ��� ˹�� �Ң�', 0, 1);

$pdf->SetXY(128, 107);
$pdf->Cell(20, 5, '�Ǫ����', 0, 1);
$pdf->Line(125, 112, 165, 112);

$pdf->SetXY(30, 114);
$pdf->Cell(30, 5, '㺷���¹�Ţ���', 0, 1);
$pdf->SetXY(65, 114);
$pdf->Cell(60, 5, '�.'.$user['code1'].' �.'.$user['code2'].' �.'.$user['code3'].'', 0, 1);
$pdf->Line(58, 119, 130, 119);
$pdf->SetXY(130, 114);
$pdf->Cell(35, 5, '��ӡ�õ�Ǩ��ҧ���', 0, 1);

$pdf->SetXY(30, 121);
$pdf->Cell(10, 5, '���', 0, 1);
$pdf->SetXY(40, 121);
$pdf->Cell(50, 5, $user['yot_pt'].' '.$user['ptname'], 0, 1);
$pdf->Line(40, 126, 110, 126);
$pdf->SetXY(110, 121);
$pdf->Cell(10, 5, '�ѧ�Ѵ', 0, 1);
$pdf->SetXY(120, 121);
$pdf->Cell(50, 5, '�����͹ HN '.$user['hn'], 0, 1);
$pdf->Line(120, 126, 165, 126);

$pdf->SetXY(30, 128);
$pdf->Cell(15, 5, '������', 0, 1);
$pdf->SetXY(45, 127);
// $long_txt = '(5) (�) �ä�ҧ�ʹ������ҡ���� �ͺ�˹���� ����ա���٭���¡�÷ӧҹ�ͧ�к��ҧ�Թ���� �µ�Ǩ���ö�Ҿ�ʹ���� forced Expiratoy Volume in One Second ���,���� Forced Vital Capacity ��ӡ��������� 60 �ͧ����ҵðҹ���ࡳ��';
// $long_txt = '(1) (�) �Ң�ҧ㴢�ҧ˹�觺Դ ���������ѡ���������µҴ�����蹵����ǡ���ͧ����ѧ������дѺ��ӡ��� 3/60 �����ҹ��µ��������᤺���� 10 ͧ��';
$pdf->MultiCell(120, 7, $user['regular'], 0);

$pdf->Line(43, 133, 165, 133);
$pdf->Line(43, 140, 165, 140);
$pdf->Line(43, 147, 165, 147);
$pdf->Line(43, 154, 165, 154);
$pdf->Line(43, 161, 165, 161);

$pdf->SetXY(30, 168);
$pdf->Cell(25, 5, '���͹حҵ���', 0, 1);
$pdf->SetXY(55, 168);
$pdf->Cell(110, 5, '-', 0, 1, 'C');
$pdf->Line(55, 173, 165, 173);

$pdf->SetXY(30, 175);
$pdf->Cell(20, 5, '�ա�˹�', 0, 1);
$pdf->SetXY(45, 175);
$pdf->Cell(35, 5, '-', 0, 1, 'C');
$pdf->Line(45, 180, 80, 180);
$pdf->SetXY(80, 175);
$pdf->Cell(20, 5, '�ѹ  �����', 0, 1);
$pdf->SetXY(98, 175);
$pdf->Cell(27, 5, '-', 0, 1, 'C');
$pdf->Line(98, 180, 125, 180);
$pdf->SetXY(125, 175);
$pdf->Cell(10, 5, '�֧', 0, 1);
$pdf->SetXY(130, 175);
$pdf->Cell(35, 5, '-', 0, 1, 'C');
$pdf->Line(130, 180, 165, 180);

$pdf->SetXY(30, 182);
$pdf->Cell(20, 5, '�Ѻ��', 0, 1);
$pdf->SetXY(40, 182);
$pdf->Cell(125, 5, '-', 0, 1, 'C');
$pdf->Line(40, 187, 165, 187);

$pdf->SetXY(82, 203);
$pdf->Cell(15, 5, 'ŧ���', 0, 1);
$pdf->SetXY(97, 203);
$pdf->Cell(58, 5, $doctor1, 0, 1);
$pdf->Line(97, 208, 155, 208);
$pdf->SetXY(97, 210);
$pdf->Cell(58, 5, $doctor2, 0, 1);
$pdf->Line(97, 215, 155, 215);
$pdf->SetXY(97, 217);
$pdf->Cell(58, 5, $doctor3, 0, 1);
$pdf->Line(97, 222, 155, 222);

// $pdf->AutoPrint(true);
$pdf->Output();