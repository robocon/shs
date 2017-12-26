<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date');

include 'fpdf_thai/shspdf.php';

function print_dashed($x1, $y1, $x2, $y2){
    global $pdf;

    $pdf->SetLineWidth(0.1);
    $pdf->SetDash(0.3, 0.7);
    $pdf->Line($x1, $y1, $x2, $y2);

    $pdf->SetLineWidth(0.2);
    $pdf->SetDash();
}

$pdf = new SHSPdf();
$pdf->SetThaiFont(); // �絿͹��
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);

$pdf->AddPage('P', 'A4');



$pdf->SetFont('THSarabun','B',13); // ���¡��ҹ�͹������������
$pdf->SetXY(0, 25);
$pdf->Cell(210, 6, '���§ҹ�ŵ�Ǩ�آ�Ҿ', 0, 1, 'C');

$pdf->SetXY(25, 37);
$pdf->Cell(163, 6, '�ç��Һ��  ��������ѡ��������', 0, 1);
// print_dashed(56,43,100,43);


$pdf->SetFont('THSarabun','',9); // ���¡��ҹ�͹������������

# ��Ǣ��
$pdf->Rect(13, 43, 46, 6);
$pdf->SetXY(13, 43);
$pdf->Cell(46, 6, '˹��§ҹ', 1, 1);
// print_dashed(23,52,52,52);

$pdf->Rect(59, 43, 22, 6);
$pdf->SetXY(59, 43);
$pdf->Cell(22, 6, 'HN', 0, 1);

$pdf->Rect(81, 43, 26, 6);
$pdf->SetXY(81, 43);
$pdf->Cell(26, 6, '�Ţ�Ѻ��', 0, 1);

$pdf->Rect(107, 43, 41, 6);
$pdf->SetXY(107, 43);
$pdf->Cell(41, 6, '�Ţ�ѵû�ЪҪ�', 0, 1);

$pdf->Rect(148, 43, 40, 6);
$pdf->SetXY(148, 43);
$pdf->Cell(40, 6, '�ѹ�������Ѻ��ԡ��', 0, 1);

# ��������ǹ���
$pdf->SetXY(13, 49);
$pdf->Cell(27, 6, '����-���ʡ�� / Name', 0, 1);

$pdf->Rect(42, 50, 3, 3); // checkbox
$pdf->SetXY(46, 49);
$pdf->Cell(5, 6, '���', 0, 1);

$pdf->Rect(52, 50, 3, 3);
$pdf->SetXY(56, 49);
$pdf->Cell(5, 6, '�ҧ', 0, 1);

$pdf->Rect(62, 50, 3, 3);
$pdf->SetXY(66, 49);
$pdf->Cell(5, 6, '�.�.', 0, 1);

$pdf->SetXY(73, 49);
$pdf->Cell(5, 6, '����', 0, 1);
print_dashed(77,53,103,53);

$pdf->SetXY(103, 49);
$pdf->Cell(5, 6, '���ʡ��', 0, 1);
print_dashed(112,53,140,53);

$pdf->Rect(148, 49, 40, 14);
$pdf->SetXY(148, 49);
$pdf->Cell(40, 6, '���Ѿ�� / Tel.', 0, 1);

$pdf->SetXY(13, 55);
$pdf->Cell(27, 6, '������� / Address', 0, 1);
print_dashed(28,59,140,59);
print_dashed(13,65,140,65);

$pdf->Line(13, 67, 188, 67);

$pdf->SetFont('THSarabun','B',13); // ���¡��ҹ�͹������������
$pdf->SetXY(0, 67);
$pdf->Cell(210, 7, '�������آ�Ҿ (Health data)', 0, 1, 'C');

$pdf->SetFont('THSarabun','',9); // ���¡��ҹ�͹������������

### ��Ǣ��
$pdf->Rect(13, 73, 46, 12);
$pdf->SetXY(13, 73);
$pdf->Cell(46, 7, '��õ�Ǩ��ҧ��µ���к�', 0, 1, 'L');

$pdf->Rect(59, 73, 22, 12);
$pdf->SetXY(59, 73);
$pdf->Cell(22, 7, '�Ż���', 0, 1, 'C');
$pdf->SetXY(59, 79);
$pdf->Cell(22, 7, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 73, 26, 12);
$pdf->SetXY(81, 73);
$pdf->Cell(26, 7, '�żԴ����', 0, 1, 'C');
$pdf->SetXY(81, 79);
$pdf->Cell(26, 7, 'ABNORMAL', 0, 1, 'C');

$pdf->Rect(107, 73, 41, 12);
$pdf->SetXY(107, 73);
$pdf->Cell(41, 7, '��õ�Ǩ����������ʹ', 0, 1, 'L');
$pdf->SetXY(107, 79);
$pdf->Cell(41, 7, 'BIOCHEMICAL TESTS', 0, 1, 'L');

$pdf->Rect(148, 73, 15, 12);
$pdf->SetXY(148, 73);
$pdf->Cell(15, 7, '��ҷ���Ǩ��', 0, 1, 'C');
$pdf->SetXY(148, 79);
$pdf->Cell(15, 7, 'RESULT', 0, 1, 'C');

$pdf->Rect(163, 73, 25, 12);
$pdf->SetXY(163, 73);
$pdf->Cell(25, 7, '��һ���', 0, 1, 'C');
$pdf->SetXY(163, 79);
$pdf->Cell(25, 7, 'NORMAL', 0, 1, 'C');

### 1
$pdf->Rect(13, 98, 46, 14);
$pdf->SetXY(13, 98);
$pdf->Cell(46, 7, '1.��äѴ��ͧ������Թ', 0, 1, 'L');
$pdf->SetXY(13, 105);
$pdf->Cell(46, 7, 'Finger Rub Test', 0, 1, 'L');

$pdf->Rect(59, 98, 22, 14);
$pdf->SetXY(59, 98);
$pdf->Cell(22, 7, '', 0, 1, 'C');
$pdf->SetXY(59, 105);
$pdf->Cell(22, 7, '', 0, 1, 'C');

$pdf->Rect(81, 98, 26, 14);
$pdf->SetXY(81, 98);
$pdf->Cell(26, 7, '', 0, 1, 'C');
$pdf->SetXY(81, 105);
$pdf->Cell(26, 7, '', 0, 1, 'C');

$pdf->Rect(107, 98, 41, 14);
$pdf->SetXY(107, 98);
$pdf->Cell(41, 7, '7.��õ�Ǩ�дѺ��ӵ������ʹ FBS', 0, 1, 'L');

$pdf->Rect(148, 98, 15, 14);
$pdf->SetXY(148, 98);
$pdf->Cell(15, 7, '', 0, 1, 'C');
$pdf->SetXY(148, 105);
$pdf->Cell(15, 7, '', 0, 1, 'C');

$pdf->Rect(163, 98, 25, 14);
$pdf->SetXY(163, 98);
$pdf->Cell(25, 7, '', 0, 1, 'C');
$pdf->SetXY(163, 105);
$pdf->Cell(25, 7, '', 0, 1, 'C');

### 2
$pdf->Rect(13, 112, 46, 14);
$pdf->SetXY(13, 112);
$pdf->Cell(46, 7, '2.��õ�Ǩ��ҹ���ᾷ������', 0, 1, 'L');
$pdf->SetXY(13, 119);
$pdf->Cell(46, 7, '�ؤ�ҡ��Ҹ�ó�آ', 0, 1, 'L');

$pdf->Rect(59, 112, 22, 14);
$pdf->SetXY(59, 112);
$pdf->Cell(22, 7, '', 0, 1, 'C');
$pdf->SetXY(59, 119);
$pdf->Cell(22, 7, '', 0, 1, 'C');

$pdf->Rect(81, 112, 26, 14);
$pdf->SetXY(81, 112);
$pdf->Cell(26, 7, '', 0, 1, 'C');
$pdf->SetXY(81, 119);
$pdf->Cell(26, 7, '', 0, 1, 'C');

$pdf->Rect(107, 112, 41, 14);
$pdf->SetXY(107, 112);
$pdf->Cell(41, 7, '8.��÷ӧҹ�ͧ�', 0, 1, 'L');
$pdf->SetXY(107, 119);
$pdf->Cell(41, 7, 'Serum Creatinine', 0, 1, 'L');

$pdf->Rect(148, 112, 15, 14);
$pdf->SetXY(148, 112);
$pdf->Cell(15, 7, '', 0, 1, 'C');
$pdf->SetXY(148, 119);
$pdf->Cell(15, 7, '', 0, 1, 'C');

$pdf->Rect(163, 112, 25, 14);
$pdf->SetXY(163, 112);
$pdf->Cell(25, 7, '', 0, 1, 'C');
$pdf->SetXY(163, 119);
$pdf->Cell(25, 7, '', 0, 1, 'C');

# 3
$pdf->Rect(13, 126, 46, 14);
$pdf->SetXY(13, 126);
$pdf->Cell(46, 7, '3.��õ�Ǩ���¤�������', 0, 1, 'L');
$pdf->SetXY(13, 133);
$pdf->Cell(46, 7, '�ͧ�ѡ��ᾷ��', 0, 1, 'L');

$pdf->Rect(59, 126, 22, 14);
$pdf->SetXY(59, 126);
$pdf->Cell(22, 7, '', 0, 1, 'C');
$pdf->SetXY(59, 133);
$pdf->Cell(22, 7, '', 0, 1, 'C');

$pdf->Rect(81, 126, 26, 14);
$pdf->SetXY(81, 126);
$pdf->Cell(26, 7, '', 0, 1, 'C');
$pdf->SetXY(81, 133);
$pdf->Cell(26, 7, '', 0, 1, 'C');

$pdf->Rect(107, 126, 41, 14);
$pdf->SetXY(107, 126);
$pdf->Cell(41, 7, '9.��õ�Ǩ��ѹ����ʹ', 0, 1, 'L');
$pdf->SetXY(107, 133);
$pdf->Cell(41, 7, 'Total Cholesterol', 0, 1, 'R');

$pdf->Rect(148, 126, 15, 14);
$pdf->SetXY(148, 126);
$pdf->Cell(15, 7, '', 0, 1, 'C');
$pdf->SetXY(148, 133);
$pdf->Cell(15, 7, '', 0, 1, 'C');

$pdf->Rect(163, 126, 25, 14);
$pdf->SetXY(163, 126);
$pdf->Cell(25, 7, '', 0, 1, 'C');
$pdf->SetXY(163, 133);
$pdf->Cell(25, 7, '', 0, 1, 'C');

# 4
$pdf->Rect(13, 140, 46, 14);
$pdf->SetXY(13, 140);
$pdf->Cell(46, 7, '4.��õ�Ǩ�Ҵ��� Snellen eye Chart', 0, 1, 'L');

$pdf->Rect(59, 140, 22, 14);
$pdf->SetXY(59, 140);
$pdf->Cell(22, 7, '', 0, 1, 'C');
$pdf->SetXY(59, 147);
$pdf->Cell(22, 7, '', 0, 1, 'C');

$pdf->Rect(81, 140, 26, 14);
$pdf->SetXY(81, 140);
$pdf->Cell(26, 7, '', 0, 1, 'C');
$pdf->SetXY(81, 147);
$pdf->Cell(26, 7, '', 0, 1, 'C');

$pdf->Rect(107, 140, 41, 14);
$pdf->SetXY(107, 140);
$pdf->Cell(41, 7, 'HDL Cholesterol', 1, 1, 'R');
$pdf->SetXY(107, 147);
$pdf->Cell(41, 7, '10.��Ǩ��������ʵѺ�ѡ�ʺ HBsAg', 0, 1, 'L');

$pdf->Rect(148, 140, 15, 14);
$pdf->SetXY(148, 140);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(148, 147);
$pdf->Cell(15, 7, '', 0, 1, 'C');

$pdf->Rect(163, 140, 25, 14);
$pdf->SetXY(163, 140);
$pdf->Cell(25, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 147);
$pdf->Cell(25, 7, '', 0, 1, 'C');

# 5
$pdf->Rect(13, 154, 46, 14);
$pdf->SetXY(13, 154);
$pdf->Cell(46, 7, '5.��������ó�ͧ������ʹ CBC', 0, 1, 'L');
$pdf->SetXY(13, 161);
$pdf->Cell(46, 7, 'COMPLETE BLOOD COUNT', 0, 1, 'L');

$pdf->Rect(59, 154, 22, 14);
$pdf->SetXY(59, 154);
$pdf->Cell(22, 7, '��ҷ���Ǩ��', 0, 1, 'C');
$pdf->SetXY(59, 161);
$pdf->Cell(22, 7, 'RESULT', 0, 1, 'C');

$pdf->Rect(81, 154, 26, 14);
$pdf->SetXY(81, 154);
$pdf->Cell(26, 7, '��һ���', 0, 1, 'C');
$pdf->SetXY(81, 161);
$pdf->Cell(26, 7, 'NORMAL', 0, 1, 'C');

$pdf->Rect(107, 154, 41, 14);
$pdf->SetXY(107, 154);
$pdf->Cell(41, 7, '11.��õ�Ǩ��������ͨҡ�ҡ���١', 0, 1, 'L');
$pdf->SetXY(107, 161);
$pdf->Cell(41, 7, '�����Ը� PAP Smear', 0, 1, 'L');

$pdf->Rect(148, 154, 15, 14);
$pdf->SetXY(148, 154);
$pdf->Cell(15, 7, '', 0, 1, 'C');
$pdf->SetXY(148, 161);
$pdf->Cell(15, 7, '', 0, 1, 'C');

$pdf->Rect(163, 154, 25, 14);
$pdf->SetXY(163, 154);
$pdf->Cell(25, 7, '', 0, 1, 'C');
$pdf->SetXY(163, 161);
$pdf->Cell(25, 7, '', 0, 1, 'C');


# ���Ե�ҧ
$pdf->Rect(13, 168, 46, 77); // ��ͺ��ͧ����������ʹ���
$pdf->SetXY(13, 168);
$pdf->Cell(46, 7, '�������Ե�ҧ', 0, 1, 'L');

$pdf->SetXY(39, 168);
$pdf->Cell(20, 7, 'Hb', 0, 1, 'L');
$pdf->Line(39, 175, 59, 175);

$pdf->Rect(59, 168, 22, 21);
$pdf->SetXY(59, 168);
$pdf->Cell(22, 7, '', 1, 1, 'C');

$pdf->Rect(81, 168, 26, 21);
$pdf->SetXY(81, 168);
$pdf->Cell(26, 7, '', 1, 1, 'C');


$pdf->SetXY(39, 175);
$pdf->Cell(20, 7, 'Hct', 0, 1, 'L');
$pdf->Line(39, 182, 59, 182);
$pdf->SetXY(59, 175);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 175);
$pdf->Cell(26, 7, '', 1, 1, 'C');


$pdf->SetXY(13, 182);
$pdf->Cell(46, 7, '�ӹǹ������ʹ������', 0, 1, 'L');
$pdf->SetXY(39, 182);
$pdf->Cell(20, 7, 'WBC', 0, 1, 'L');
$pdf->SetXY(59, 182);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 182);
$pdf->Cell(26, 7, '', 1, 1, 'C');

$pdf->SetXY(13, 189);
$pdf->Cell(46, 7, '�ӹǹ������ʹ����¡�����Դ', 0, 1, 'L');

$pdf->SetXY(13, 196);
$pdf->Cell(46, 7, 'Neutrophil', 0, 1, 'L');
$pdf->Line(39, 203, 59, 203);
$pdf->Rect(59, 189, 22, 14);
$pdf->SetXY(59, 196);
$pdf->Cell(22, 7, '', 0, 1, 'C');
$pdf->Rect(81, 189, 26, 14);
$pdf->SetXY(81, 196);
$pdf->Cell(26, 7, '', 0, 1, 'C');

$pdf->SetXY(13, 203);
$pdf->Cell(46, 7, 'Lymphocyte', 0, 1, 'L');
$pdf->Line(39, 210, 59, 210);
$pdf->SetXY(59, 203);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 203);
$pdf->Cell(26, 7, '', 1, 1, 'C');

$pdf->SetXY(13, 210);
$pdf->Cell(46, 7, 'Monocyte', 0, 1, 'L');
$pdf->Line(39, 217, 59, 217);
$pdf->SetXY(59, 210);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 210);
$pdf->Cell(26, 7, '', 1, 1, 'C');

$pdf->SetXY(13, 217);
$pdf->Cell(46, 7, 'Eosinophil', 0, 1, 'L');
$pdf->Line(39, 224, 59, 224);
$pdf->SetXY(59, 217);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 217);
$pdf->Cell(26, 7, '', 1, 1, 'C');

$pdf->SetXY(13, 224);
$pdf->Cell(46, 7, 'Basophil', 0, 1, 'L');
$pdf->Line(39, 231, 59, 231);
$pdf->SetXY(59, 224);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 224);
$pdf->Cell(26, 7, '', 1, 1, 'C');

$pdf->SetXY(13, 231);
$pdf->Cell(46, 7, '�ӹǹ������ʹ', 0, 1, 'L');
$pdf->SetXY(39, 231);
$pdf->Cell(20, 7, 'Plateiets count', 0, 1, 'L');
$pdf->Line(39, 238, 59, 238);
$pdf->SetXY(59, 231);
$pdf->Cell(22, 7, '', 1, 1, 'C');
$pdf->SetXY(81, 231);
$pdf->Cell(26, 7, '', 1, 1, 'C');

$pdf->SetXY(13, 238);
$pdf->Cell(46, 7, '�ٻ��ҧ������ʹᴧ', 0, 1, 'L');
$pdf->SetXY(39, 238);
$pdf->Cell(46, 7, 'RBC', 0, 1, 'L');
$pdf->SetXY(59, 238);
$pdf->Cell(48, 7, '', 1, 1, 'L');



$pdf->Rect(13, 245, 46, 14);

$pdf->Rect(59, 245, 22, 14);
$pdf->SetXY(59, 245);
$pdf->Cell(22, 7, '�Ż���', 0, 1, 'C');
$pdf->SetXY(59, 252);
$pdf->Cell(22, 7, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 245, 26, 14);
$pdf->SetXY(81, 245);
$pdf->Cell(26, 7, '�żԴ����', 0, 1, 'C');
$pdf->SetXY(81, 252);
$pdf->Cell(26, 7, 'ABNORMAL', 0, 1, 'C');


$pdf->SetXY(13, 259);
$pdf->Cell(46, 7, '6.Chest X-ray', 1, 1, 'L');

$pdf->SetXY(59, 259);
$pdf->Cell(22, 7, '', 1, 1, 'L');

$pdf->SetXY(81, 259);
$pdf->Cell(26, 7, '', 1, 1, 'L');


# ��ͧ���
$pdf->SetXY(107, 168);
$pdf->Cell(41, 7, '�����Ը� Via', 1, 1, 'L');
$pdf->SetXY(148, 168);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 168);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->Rect(107, 175, 41, 14);
$pdf->SetXY(107, 175);
$pdf->Cell(41, 7, '12.��õ�Ǩ�������', 0, 1, 'L');

$pdf->SetXY(128, 175);
$pdf->Cell(20, 7, 'UA', 0, 1, 'L');

$pdf->Rect(148, 175, 15, 14);
$pdf->SetXY(148, 175);
$pdf->Cell(15, 7, '��ҷ���Ǩ��', 0, 1, 'C');
$pdf->SetXY(148, 182);
$pdf->Cell(15, 7, 'RESULT', 0, 1, 'C');

$pdf->Rect(163, 175, 25, 14);
$pdf->SetXY(163, 175);
$pdf->Cell(25, 7, '��һ���', 0, 1, 'C');
$pdf->SetXY(163, 182);
$pdf->Cell(25, 7, 'NORMAL', 0, 1, 'C');



$pdf->Rect(107, 189, 41, 63);

$pdf->SetXY(107, 189);
$pdf->Cell(41, 7, 'sp.gr', 0, 1, 'L');
$pdf->Line(128, 196, 148, 196);
$pdf->SetXY(148, 189);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 189);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 196);
$pdf->Cell(41, 7, 'Ph', 0, 1, 'L');
$pdf->Line(128, 203, 148, 203);
$pdf->SetXY(148, 196);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 196);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 203);
$pdf->Cell(41, 7, 'Glucose', 0, 1, 'L');
$pdf->Line(128, 210, 148, 210);
$pdf->SetXY(148, 203);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 203);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 210);
$pdf->Cell(41, 7, 'Albumin', 0, 1, 'L');
$pdf->Line(128, 217, 148, 217);
$pdf->SetXY(148, 210);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 210);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 217);
$pdf->Cell(41, 7, 'RBC', 0, 1, 'L');
$pdf->Line(128, 224, 148, 224);
$pdf->SetXY(148, 217);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 217);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 224);
$pdf->Cell(41, 7, 'WBC', 0, 1, 'L');
$pdf->Line(128, 231, 148, 231);
$pdf->SetXY(148, 224);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 224);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 231);
$pdf->Cell(41, 7, 'Epith cell', 0, 1, 'L');
$pdf->Line(128, 238, 148, 238);
$pdf->SetXY(148, 231);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 231);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 238);
$pdf->Cell(41, 7, 'Blood', 0, 1, 'L');
$pdf->Line(128, 245, 148, 245);
$pdf->SetXY(148, 238);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 238);
$pdf->Cell(25, 7, '', 1, 1, 'C');

$pdf->SetXY(107, 245);
$pdf->Cell(41, 7, 'Ketone', 0, 1, 'L');
$pdf->Line(128, 252, 148, 252);
$pdf->SetXY(148, 245);
$pdf->Cell(15, 7, '', 1, 1, 'C');
$pdf->SetXY(163, 245);
$pdf->Cell(25, 7, '', 1, 1, 'C');



$pdf->Rect(107, 252, 41, 14);
$pdf->SetXY(107, 252);
$pdf->Cell(41, 7, '13.��õ�Ǩ�����ʹ��ب����', 0, 1, 'L');
$pdf->SetXY(107, 259);
$pdf->Cell(41, 7, 'Fecal occult blood test(FOBT)', 0, 1, 'L');

$pdf->Rect(148, 252, 15, 14);
$pdf->SetXY(148, 252);
$pdf->Cell(15, 7, '', 0, 1, 'C');


$pdf->Rect(163, 252, 25, 14);
$pdf->SetXY(163, 252);
$pdf->Cell(25, 7, '', 0, 1, 'C');

$pdf->SetXY(13, 266);
$pdf->Cell(41, 7, '��ػ�ŵ�Ǩ', 0, 1, 'L');

$pdf->Rect(54, 268, 3, 3);
$pdf->SetXY(58, 266);
$pdf->Cell(10, 7, '����', 0, 1, 'L');

$pdf->Rect(70, 268, 3, 3);
$pdf->SetXY(74, 266);
$pdf->Cell(10, 7, '�Դ����', 0, 1, 'L');

$pdf->SetXY(13, 273);
$pdf->Cell(38, 7, '���й��������㹡�ô����ѡ���آ�Ҿ', 0, 1, 'L');

print_dashed(49,278,188,278);
print_dashed(13,285,188,285);

$pdf->SetXY(13, 287);
$pdf->Cell(20, 7, '����Сѹ��ŧ���', 0, 1, 'L');
$pdf->Line(35,292,73,292);
$pdf->SetXY(33, 294);
$pdf->Cell(13, 7, '(                                                             )', 0, 1, 'L');


$pdf->SetXY(107, 287);
$pdf->Cell(20, 7, 'ŧ����ᾷ�����Ǩ', 0, 1, 'L');
// $pdf->Line(127,292,167,292);
// $pdf->SetXY(127, 294);
// $pdf->Cell(13, 7, '(                                                             )', 0, 1, 'L');



// $pdf->AutoPrint(true);
$pdf->Output();