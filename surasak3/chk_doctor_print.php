<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date'); // date_chk 㹵��ҧ chk_doctor

# �����ż�����
$sql = "SELECT a.*, b.`ptffone`, b.`phone`
FROM `chk_doctor` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`hn` = '$hn' 
AND a.`vn` = '$vn' 
AND a.`date_chk` LIKE '$date%' ";
$db->select($sql);
$user = $db->get_item();

$year_checkup = $user['yearchk'];

$sql = "SELECT `camp`,`labin_date` 
FROM `dxofyear_out` WHERE `thdatehn` = '$date$hn' ";
$db->select($sql);
$dxofyear = $db->get_item();

// �֧�ѹ������Ǩ lab �Ѻ���ѹ������Ѻ�������Ѻ��ԡ��
$sql = "SELECT SUBSTRING(`orderdate`,1,10) AS `lab_opd`  
FROM `resulthead` 
WHERE `hn` = '$hn' 
AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
ORDER BY `autonumber` DESC 
LIMIT 1 ";
$db->select($sql);
$res_head = $db->get_item();

$lab_opd = $res_head['lab_opd'];

# CBC 
$sql = "SELECT b.`labcode`,b.`labname`,b.`result`,b.`normalrange`,b.`flag`  
FROM ( 

    SELECT MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND `profilecode` = 'CBC'
    AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( b.`labcode` = 'HB' OR b.`labcode` = 'HCT' OR b.`labcode` = 'WBC' 
OR b.`labcode` = 'NEU' OR b.`labcode` = 'LYMP' OR b.`labcode` = 'MONO' 
OR b.`labcode` = 'EOS' OR b.`labcode` = 'BASO' OR b.`labcode` = 'PLTC' 
OR b.`labcode` = 'RBC' ) 
ORDER BY b.seq ASC";
$db->select($sql);
$cbc_items = $db->get_items();

$cbc_lists = array();
foreach ($cbc_items as $key => $item) {
    $labcode = strtolower($item['labcode']);
    $cbc_lists[$labcode] = array(
        'result' => $item['result'], 
        'normalrange' => $item['normalrange'],
        'flag' => $item['flag']
    );
}


# UA 
$sql = "SELECT b.* 
FROM ( 

    SELECT MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND `profilecode` = 'UA'
    AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( b.`labcode` = 'SPGR' OR b.`labcode` = 'PHU' OR b.`labcode` = 'GLUU' 
OR b.`labcode` = 'PROU' 
OR b.`labcode` = 'RBCU' OR b.`labcode` = 'WBCU' OR b.`labcode` = 'EPIU' 
OR b.`labcode` = 'BLOODU' OR b.`labcode` = 'KETU' ) 
ORDER BY b.seq ASC";
$db->select($sql);
$ua_items = $db->get_items();

$ua_lists = array();
foreach ($ua_items as $key => $item) {
    $labcode = strtolower($item['labcode']);
    $ua_lists[$labcode] = array(
        'result' => $item['result'], 
        'normalrange' => $item['normalrange'],
        'flag' => $item['flag']
    );
}

$sql = "SELECT b.* 
FROM ( 

    SELECT MAX(`autonumber`) AS `latest_number` 
    FROM `resulthead` 
    WHERE `hn` = '$hn' 
    AND ( `profilecode` != 'CBC' AND `profilecode` != 'UA' )
    AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$year_checkup' 
    GROUP BY `profilecode` 
    ORDER BY `autonumber` ASC 

 ) AS a 
    RIGHT JOIN `resultdetail` AS b ON b.`autonumber` = a.`latest_number` 
WHERE b.`autonumber` = a.`latest_number` 
AND ( 
    b.`labcode` = 'GLU' 
    OR b.`labcode` = 'CREA' 
    OR b.`labcode` = 'CHOL' 
    OR b.`labcode` = 'HDL' 
    OR b.`labcode` = 'HBSAG' 
    OR b.`labcode` = 'OCCULT' 
    OR b.`labcode` = '38302' 
) 
ORDER BY b.seq ASC ";

$db->select($sql);
$etc_items = $db->get_items();

$etc_lists = array();
foreach ($etc_items as $key => $item) {
    $labcode = strtolower($item['labcode']);
    $etc_lists[$labcode] = array(
        'result' => $item['result'], 
        'normalrange' => $item['normalrange'],
        'flag' => $item['flag']
    );
}

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



$pdf->SetFont('AngsanaNew','',13); // ���¡��ҹ�͹������������
$pdf->SetXY(0, 25);
$pdf->Cell(210, 6, '���§ҹ�ŵ�Ǩ�آ�Ҿ', 0, 1, 'C');

$pdf->SetXY(25, 37);
$pdf->Cell(163, 6, '�ç��Һ��  ��������ѡ��������', 0, 1);
print_dashed(42,42,100,42);


$pdf->SetFont('AngsanaNew','',10); // ���¡��ҹ�͹������������

# ��Ǣ��
$pdf->Rect(13, 43, 46, 6);
$pdf->SetXY(13, 43);
$pdf->Cell(46, 6, '˹��§ҹ', 1, 1);

$pdf->SetXY(26, 43);
$pdf->Cell(26, 6, $dxofyear['camp'], 0, 1);

// print_dashed(23,52,52,52);

$pdf->Rect(59, 43, 22, 6);
$pdf->SetXY(59, 43);
$pdf->Cell(22, 6, 'HN '.$user['hn'], 0, 1);

$pdf->Rect(81, 43, 26, 6);
$pdf->SetXY(81, 43);
$pdf->Cell(26, 6, '�Ţ�Ѻ��', 0, 1);

$pdf->Rect(107, 43, 41, 6);
$pdf->SetXY(107, 43);
$pdf->Cell(41, 6, '�Ţ�ѵû�ЪҪ� '.$user['idcard'], 0, 1);

$pdf->Rect(148, 43, 40, 6);
$pdf->SetXY(148, 43);
$pdf->Cell(40, 6, '�ѹ�������Ѻ��ԡ�� '.$lab_opd, 0, 1);

# ��������ǹ���
$pdf->SetXY(13, 49);
$pdf->Cell(27, 6, '����-���ʡ�� / Name', 0, 1);

$pdf->Rect(42, 50, 3, 3); // checkbox
if( $user['prefix'] == '���' ){
    $pdf->Line(42,53,45,50);
}
$pdf->SetXY(46, 49);
$pdf->Cell(5, 6, '���', 0, 1);

$pdf->Rect(52, 50, 3, 3);
if( $user['prefix'] == '�ҧ' ){
    $pdf->Line(52,53,55,50);
}
$pdf->SetXY(56, 49);
$pdf->Cell(5, 6, '�ҧ', 0, 1);

$pdf->Rect(62, 50, 3, 3);
if( $user['prefix'] == '�.�.' ){
    $pdf->Line(62,53,65,50);
}
$pdf->SetXY(66, 49);
$pdf->Cell(5, 6, '�.�.', 0, 1);

$pdf->SetXY(73, 49);
$pdf->Cell(5, 6, '����', 0, 1);
print_dashed(77,53.50,103,53.50);

$pdf->SetXY(78, 49);
$pdf->Cell(5, 6, $user['name'], 0, 1);

$pdf->SetXY(103, 49);
$pdf->Cell(5, 6, '���ʡ��', 0, 1);
print_dashed(112,53.50,140,53.50);

$pdf->SetXY(113, 49);
$pdf->Cell(5, 6, $user['surname'], 0, 1);

$pdf->Rect(148, 49, 40, 12);
$pdf->SetXY(148, 49);
$pdf->Cell(40, 6, '���Ѿ�� / Tel.', 0, 1);
$pdf->SetXY(164, 49);
$pdf->Cell(26, 6, $user['phone'], 0, 1);
if ( !empty($user['ptffone']) ) {
    $pdf->SetXY(164, 55);
    $pdf->Cell(26, 6, $user['ptffone'], 0, 1);
}

$pdf->SetXY(13, 55);
$pdf->Cell(27, 6, '������� / Address', 0, 1);
print_dashed(30,59.50,140,59.50);
print_dashed(13,65.50,140,65.50);

$pdf->SetXY(31, 55);
$pdf->Cell(40, 6, $user['address'], 0, 1);

$pdf->Line(13, 67, 188, 67);

$pdf->SetFont('AngsanaNew','',13); // ���¡��ҹ�͹������������
$pdf->SetXY(0, 67);
$pdf->Cell(210, 6, '�������آ�Ҿ (Health data)', 0, 1, 'C');

$pdf->SetFont('AngsanaNew','',10); // ���¡��ҹ�͹������������

### ��Ǣ��
$pdf->Rect(13, 73, 46, 12);
$pdf->SetXY(13, 73);
$pdf->Cell(46, 6, '��õ�Ǩ��ҧ��µ���к�', 0, 1);

$pdf->Rect(59, 73, 22, 12);
$pdf->SetXY(59, 73);
$pdf->Cell(22, 6, '�Ż���', 0, 1, 'C');
$pdf->SetXY(59, 79);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 73, 26, 12);
$pdf->SetXY(81, 73);
$pdf->Cell(26, 6, '�żԴ����', 0, 1, 'C');
$pdf->SetXY(81, 79);
$pdf->Cell(26, 6, 'ABNORMAL', 0, 1, 'C');

$pdf->Rect(107, 73, 41, 12);
$pdf->SetXY(107, 73);
$pdf->Cell(41, 6, '��õ�Ǩ����������ʹ', 0, 1);
$pdf->SetXY(107, 79);
$pdf->Cell(41, 6, 'BIOCHEMICAL TESTS', 0, 1);

$pdf->Rect(148, 73, 15, 12);
$pdf->SetXY(148, 73);
$pdf->Cell(15, 6, '��ҷ���Ǩ��', 0, 1, 'C');
$pdf->SetXY(148, 79);
$pdf->Cell(15, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(163, 73, 25, 12);
$pdf->SetXY(163, 73);
$pdf->Cell(25, 6, '��һ���', 0, 1, 'C');
$pdf->SetXY(163, 79);
$pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');

### 1
$pdf->Rect(13, 85, 46, 12);
$pdf->SetXY(13, 85);
$pdf->Cell(46, 6, '1.��äѴ��ͧ������Թ', 0, 1);
$pdf->SetXY(13, 91);
$pdf->Cell(46, 6, 'Finger Rub Test', 0, 1);

$pdf->Rect(59, 85, 22, 12);
if( $user['ear'] == 1 ){
    $pdf->Line(65, 94, 75, 88);
}

$pdf->Rect(81, 85, 26, 12);
if( $user['ear'] == 2 ){
    $pdf->Line(89, 94, 99, 88);
}


$pdf->Rect(107, 85, 41, 12);
$pdf->SetXY(107, 85);
$pdf->Cell(41, 6, '7.��õ�Ǩ�дѺ��ӵ������ʹ FBS', 0, 1);

$pdf->Rect(148, 85, 15, 12);
$pdf->SetXY(148, 85);
if( $etc_lists['glu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $etc_lists['glu']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->Rect(163, 85, 25, 12);
$pdf->SetXY(163, 85);
$pdf->Cell(25, 6, $etc_lists['glu']['normalrange'], 0, 1, 'C');


### 2
$pdf->Rect(13, 97, 46, 12);
$pdf->SetXY(13, 97);
$pdf->Cell(46, 6, '2.��õ�Ǩ��ҹ���ᾷ������', 0, 1);
$pdf->SetXY(13, 103);
$pdf->Cell(46, 6, '�ؤ�ҡ��Ҹ�ó�آ', 0, 1);

$pdf->Rect(59, 97, 22, 12);
if( !empty($user['breast']) && $user['breast'] == 1 ){
    $pdf->Line(65, 106, 75, 100);
}

$pdf->Rect(81, 97, 26, 12);
if( !empty($user['breast']) && $user['breast'] == 2 ){
    $pdf->Line(89, 106, 99, 100);
}

$pdf->Rect(107, 97, 41, 12);
$pdf->SetXY(107, 97);
$pdf->Cell(41, 6, '8.��÷ӧҹ�ͧ�', 0, 1);
$pdf->SetXY(107, 103);
$pdf->Cell(41, 6, 'Serum Creatinine', 0, 1);

$pdf->Rect(148, 97, 15, 12);
$pdf->SetXY(148, 97);
if( $etc_lists['crea']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $etc_lists['crea']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->Rect(163, 97, 25, 12);
$pdf->SetXY(163, 97);
$pdf->Cell(25, 6, $etc_lists['crea']['normalrange'], 0, 1, 'C');


# 3
$pdf->Rect(13, 109, 46, 12);
$pdf->SetXY(13, 109);
$pdf->Cell(46, 6, '3.��õ�Ǩ���¤�������', 0, 1);
$pdf->SetXY(13, 115);
$pdf->Cell(46, 6, '�ͧ�ѡ��ᾷ��', 0, 1);

$pdf->Rect(59, 109, 22, 12);
if( $user['eye'] == 1 ){
    $pdf->Line(65, 118, 75, 112);
}

$pdf->Rect(81, 109, 26, 12);
if( $user['eye'] == 2 ){
    $pdf->Line(89, 118, 99, 112);
}

$pdf->Rect(107, 109, 41, 12);
$pdf->SetXY(107, 109);
$pdf->Cell(41, 6, '9.��õ�Ǩ��ѹ����ʹ', 0, 1);
$pdf->SetXY(107, 115);
$pdf->Cell(41, 6, 'Total Cholesterol', 0, 1, 'R');

$pdf->Rect(148, 109, 15, 12);
$pdf->SetXY(148, 115);

if( $etc_lists['chol']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $etc_lists['chol']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->Rect(163, 109, 25, 12);
$pdf->SetXY(163, 115);
$pdf->Cell(25, 6, $etc_lists['chol']['normalrange'], 0, 1, 'C');

# 4
$pdf->Rect(13, 121, 46, 12);
$pdf->SetXY(13, 121);
$pdf->Cell(46, 6, '4.��õ�Ǩ�Ҵ��� Snellen eye Chart', 0, 1);

$pdf->Rect(59, 121, 22, 12);
if( $user['snell_eye'] == 1 ){
    $pdf->Line(65, 130, 75, 124);
}

$pdf->Rect(81, 121, 26, 12);
if( $user['snell_eye'] == 2 ){
    $pdf->Line(89, 130, 99, 124);
}

$pdf->Rect(107, 121, 41, 12);
$pdf->SetXY(107, 121);
$pdf->Cell(41, 6, 'HDL Cholesterol', 1, 1, 'R');

$pdf->Rect(148, 121, 15, 12);
$pdf->SetXY(148, 121);

if( $etc_lists['hdl']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $etc_lists['hdl']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->Rect(163, 121, 25, 12);
$pdf->SetXY(163, 121);
$pdf->Cell(25, 6, $etc_lists['hdl']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 127);
$pdf->Cell(41, 6, '10.��Ǩ��������ʵѺ�ѡ�ʺ HBsAg', 0, 1);
$pdf->SetXY(148, 127);

if( $etc_lists['hbsag']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $etc_lists['hbsag']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(163, 127);
$pdf->Cell(25, 6, $etc_lists['hbsag']['normalrange'], 1, 1, 'C');

# 5
$pdf->Rect(13, 133, 46, 12);
$pdf->SetXY(13, 133);
$pdf->Cell(46, 6, '5.��������ó�ͧ������ʹ CBC', 0, 1);
$pdf->SetXY(13, 139);
$pdf->Cell(46, 6, 'COMPLETE BLOOD COUNT', 0, 1);

$pdf->Rect(59, 133, 22, 12);
$pdf->SetXY(59, 133);
$pdf->Cell(22, 6, '��ҷ���Ǩ��', 0, 1, 'C');
$pdf->SetXY(59, 139);
$pdf->Cell(22, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(81, 133, 26, 12);
$pdf->SetXY(81, 133);
$pdf->Cell(26, 6, '��һ���', 0, 1, 'C');
$pdf->SetXY(81, 139);
$pdf->Cell(26, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(107, 133, 41, 12);
$pdf->SetXY(107, 133);
$pdf->Cell(41, 6, '11.��õ�Ǩ��������ͨҡ�ҡ���١', 0, 1);
$pdf->SetXY(107, 139);
$pdf->Cell(41, 6, '�����Ը� PAP Smear', 0, 1);

/* group ����ѹ */
$pdf->Rect(148, 133, 15, 12);
$pdf->SetXY(148, 139);
$pdf->Rect(163, 133, 25, 12);
$pdf->SetXY(163, 139);
/* group ����ѹ */

# ���Ե�ҧ
$pdf->Rect(13, 145, 46, 66); // ��ͺ��ͧ����������ʹ���
$pdf->SetXY(13, 145);
$pdf->Cell(46, 6, '�������Ե�ҧ', 0, 1);

$pdf->SetXY(39, 145);
$pdf->Cell(20, 6, 'Hb', 0, 1);
$pdf->Line(39, 151, 59, 151);


$pdf->SetXY(59, 145);
if( $cbc_lists['hb']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['hb']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 145);
$pdf->Cell(26, 6, $cbc_lists['hb']['normalrange'], 1, 1, 'C');


$pdf->SetXY(39, 151);
$pdf->Cell(20, 6, 'Hct', 0, 1);
$pdf->Line(39, 157, 59, 157); // underline
$pdf->SetXY(59, 151);

if( $cbc_lists['hct']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['hct']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 151);
$pdf->Cell(26, 6, $cbc_lists['hct']['normalrange'], 1, 1, 'C');


$pdf->SetXY(13, 157);
$pdf->Cell(46, 6, '�ӹǹ������ʹ������', 0, 1);
$pdf->SetXY(39, 157);
$pdf->Cell(20, 6, 'WBC', 0, 1);
$pdf->Line(39, 163, 59, 163); // underline
$pdf->SetXY(59, 157);

if( $cbc_lists['wbc']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['wbc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 157);
$pdf->Cell(26, 6, $cbc_lists['wbc']['normalrange'], 1, 1, 'C');

$pdf->SetXY(13, 163);
$pdf->Cell(46, 6, '�ӹǹ������ʹ����¡�����Դ', 0, 1);

$pdf->SetXY(13, 169);
$pdf->Cell(46, 6, 'Neutrophil', 0, 1);
$pdf->Line(39, 175, 59, 175); // underline
$pdf->Rect(59, 163, 22, 12); // rectangle
$pdf->SetXY(59, 169);

if( $cbc_lists['neu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['neu']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->Rect(81, 163, 26, 12); //
$pdf->SetXY(81, 169);
$pdf->Cell(26, 6, $cbc_lists['neu']['normalrange'], 0, 1, 'C');

$pdf->SetXY(13, 175);
$pdf->Cell(46, 6, 'Lymphocyte', 0, 1);
$pdf->Line(39, 181, 59, 181);
$pdf->SetXY(59, 175);

if( $cbc_lists['lymp']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['lymp']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 175);
$pdf->Cell(26, 6, $cbc_lists['lymp']['normalrange'], 1, 1, 'C');

$pdf->SetXY(13, 181);
$pdf->Cell(46, 6, 'Monocyte', 0, 1);
$pdf->Line(39, 187, 59, 187);
$pdf->SetXY(59, 181);

if( $cbc_lists['mono']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['mono']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 181);
$pdf->Cell(26, 6, $cbc_lists['mono']['normalrange'], 1, 1, 'C');

$pdf->SetXY(13, 187);
$pdf->Cell(46, 6, 'Eosinophil', 0, 1);
$pdf->Line(39, 193, 59, 193);
$pdf->SetXY(59, 187);

if( $cbc_lists['eos']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['eos']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 187);
$pdf->Cell(26, 6, $cbc_lists['eos']['normalrange'], 1, 1, 'C');

$pdf->SetXY(13, 193);
$pdf->Cell(46, 6, 'Basophil', 0, 1);
$pdf->Line(39, 199, 59, 199);
$pdf->SetXY(59, 193);

if( $cbc_lists['baso']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['baso']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 193);
$pdf->Cell(26, 6, $cbc_lists['baso']['normalrange'], 1, 1, 'C');

$pdf->SetXY(13, 199);
$pdf->Cell(46, 6, '�ӹǹ������ʹ', 0, 1);
$pdf->SetXY(39, 199);
$pdf->Cell(20, 6, 'Platelets count', 0, 1);
$pdf->Line(39, 205, 59, 205);
$pdf->SetXY(59, 199);

if( $cbc_lists['pltc']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(22, 6, $cbc_lists['pltc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

$pdf->SetXY(81, 199);
$pdf->Cell(26, 6, $cbc_lists['pltc']['normalrange'], 1, 1, 'C');

$pdf->SetXY(13, 205);
$pdf->Cell(46, 6, '�ٻ��ҧ������ʹᴧ', 0, 1);
$pdf->SetXY(39, 205);
$pdf->Cell(46, 6, 'RBC', 0, 1);
$pdf->SetXY(59, 205);
if( $cbc_lists['rbc']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(48, 6, $cbc_lists['rbc']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);

// ��͹�֧��ͧ xray
$pdf->SetXY(13, 211);
$pdf->Cell(46, 18, '6.Chest X-ray', 1, 1);

$pdf->Rect(59, 211, 22, 12);
$pdf->SetXY(59, 211);
$pdf->Cell(22, 6, '�Ż���', 0, 1, 'C');
$pdf->SetXY(59, 217);
$pdf->Cell(22, 6, 'NORMAL', 0, 1, 'C');

$pdf->Rect(81, 211, 26, 12);
$pdf->SetXY(81, 211);
$pdf->Cell(26, 6, '�żԴ����', 0, 1, 'C');
$pdf->SetXY(81, 217);
$pdf->Cell(26, 6, 'ABNORMAL', 0, 1, 'C');


$pdf->Rect(59, 223, 22, 6);
if( $user['cxr'] == 1 ){
    $pdf->Line(65, 228, 75, 224);
}

$pdf->Rect(81, 223, 26, 6);
if( $user['cxr'] == 0 ){
    $pdf->Line(89, 228, 99, 224);
}


# ��ͧ���
$pdf->SetXY(107, 145);
$pdf->Cell(41, 6, '�����Ը� Via', 1, 1);
$pdf->SetXY(148, 145);
$pdf->Cell(15, 6, '', 1, 1, 'C');
$pdf->SetXY(163, 145);
$pdf->Cell(25, 6, '', 1, 1, 'C');

$pdf->Rect(107, 151, 41, 12);
$pdf->SetXY(107, 151);
$pdf->Cell(41, 6, '12.��õ�Ǩ�������', 0, 1);

$pdf->SetXY(128, 151);
$pdf->Cell(20, 6, 'UA', 0, 1);

$pdf->Rect(148, 151, 15, 12);
$pdf->SetXY(148, 151);
$pdf->Cell(15, 6, '��ҷ���Ǩ��', 0, 1, 'C');
$pdf->SetXY(148, 157);
$pdf->Cell(15, 6, 'RESULT', 0, 1, 'C');

$pdf->Rect(163, 151, 25, 12);
$pdf->SetXY(163, 151);
$pdf->Cell(25, 6, '��һ���', 0, 1, 'C');
$pdf->SetXY(163, 157);
$pdf->Cell(25, 6, 'NORMAL', 0, 1, 'C');

// ��ͺ�˭�ҧ���
$pdf->Rect(107, 163, 41, 54);

$pdf->SetXY(107, 163);
$pdf->Cell(41, 6, 'sp.gr', 0, 1);
$pdf->Line(128, 169, 148, 169);
$pdf->SetXY(148, 163);
if( $ua_lists['spgr']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['spgr']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 163);
$pdf->Cell(25, 6, $ua_lists['spgr']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 169);
$pdf->Cell(41, 6, 'Ph', 0, 1);
$pdf->Line(128, 175, 148, 175);
$pdf->SetXY(148, 169);
if( $ua_lists['phu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['phu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 169);
$pdf->Cell(25, 6, $ua_lists['phu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 175);
$pdf->Cell(41, 6, 'Glucose', 0, 1);
$pdf->Line(128, 181, 148, 181);
$pdf->SetXY(148, 175);
if( $ua_lists['gluu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['gluu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 175);
$pdf->Cell(25, 6, $ua_lists['gluu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 181);
$pdf->Cell(41, 6, 'Albumin', 0, 1);
$pdf->Line(128, 187, 148, 187);
$pdf->SetXY(148, 181);
if( $ua_lists['prou']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['prou']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 181);
$pdf->Cell(25, 6, $ua_lists['prou']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 187);
$pdf->Cell(41, 6, 'RBC', 0, 1);
$pdf->Line(128, 193, 148, 193);
$pdf->SetXY(148, 187);
if( $ua_lists['rbcu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['rbcu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 187);
$pdf->Cell(25, 6, $ua_lists['rbcu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 193);
$pdf->Cell(41, 6, 'WBC', 0, 1);
$pdf->Line(128, 199, 148, 199);
$pdf->SetXY(148, 193);
if( $ua_lists['wbcu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['wbcu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 193);
$pdf->Cell(25, 6, $ua_lists['wbcu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 199);
$pdf->Cell(41, 6, 'Epith cell', 0, 1);
$pdf->Line(128, 205, 148, 205);
$pdf->SetXY(148, 199);
if( $ua_lists['epiu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['epiu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 199);
$pdf->Cell(25, 6, $ua_lists['epiu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 205);
$pdf->Cell(41, 6, 'Blood', 0, 1);
$pdf->Line(128, 211, 148, 211);
$pdf->SetXY(148, 205);
if( $ua_lists['bloodu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['bloodu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 205);
$pdf->Cell(25, 6, $ua_lists['bloodu']['normalrange'], 1, 1, 'C');

$pdf->SetXY(107, 211);
$pdf->Cell(41, 6, 'Ketone', 0, 1);
$pdf->Line(128, 217, 148, 217);
$pdf->SetXY(148, 211);
if( $ua_lists['ketu']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $ua_lists['ketu']['result'], 1, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->SetXY(163, 211);
$pdf->Cell(25, 6, $ua_lists['ketu']['normalrange'], 1, 1, 'C');



$pdf->Rect(107, 217, 41, 12);
$pdf->SetXY(107, 217);
$pdf->Cell(41, 6, '13.��õ�Ǩ�����ʹ��ب����', 0, 1);
$pdf->SetXY(107, 223);
$pdf->Cell(41, 6, 'Fecal occult blood test(FOBT)', 0, 1);

$pdf->Rect(148, 217, 15, 12);
$pdf->SetXY(148, 217);
if( $etc_lists['occult']['flag'] != 'N' ){
    $pdf->SetFont('AngsanaNew','B',12);
}
$pdf->Cell(15, 6, $etc_lists['occult']['result'], 0, 1, 'C');
$pdf->SetFont('AngsanaNew','',10);
$pdf->Rect(163, 217, 25, 12);
$pdf->SetXY(163, 217);
$pdf->Cell(25, 6, $etc_lists['occult']['normalrange'], 0, 1, 'C');

$pdf->SetXY(13, 229);
$pdf->Cell(41, 6, '��ػ�ŵ�Ǩ', 0, 1);

$pdf->Rect(54, 230, 3, 3);
$pdf->SetXY(58, 229);
$pdf->Cell(10, 6, '����', 0, 1);
if( $user['conclution'] == "1" ){
    $pdf->Line(54,233,57,230);
}

$pdf->Rect(70, 230, 3, 3);
$pdf->SetXY(74, 229);
$pdf->Cell(10, 6, '�Դ����', 0, 1);
if( $user['conclution'] == "2" ){
    $pdf->Line(70,233,73,230);
}

$pdf->SetXY(13, 235);
$pdf->Cell(38, 6, '���й��������㹡�ô����ѡ���آ�Ҿ', 0, 1);


$conclution = $user['conclution'];
if( $conclution == 1 ){
    $suggest_list = array(
        1 => '����������й�', 
        '�й�����Ѻ��õ�Ǩ������ͧ ���駵�����ѹ���'
    );

    $suggest = $user['normal_suggest'];
    $suggest_date = ( $user['normal_suggest_date'] != '0000-00-00' ) ? '��ѹ��� '.$user['normal_suggest_date'] : '' ;
    
}else{
    $suggest_list = array(
        1 => '����������й�', 
        '�����й�㹡�õ�Ǩ�Դ���/��Ǩ��� ���駵���', 
        '�����й�����Ѻ����ѡ�ҡó��纻����¹Ѵ����Ѻ��ԡ��', 
        '�����й�����ѡ����ѡ�ҡó������á��͹�ҡ�ä������ѧ'
    );

    $suggest = $user['abnormal_suggest'];
    $suggest_date = ( $user['abnormal_suggest_date'] != '0000-00-00' ) ? '��ѹ��� '.$user['abnormal_suggest_date'] : '' ;
    
}

$suggest_detail = $suggest_list[$suggest];
$conclution_detail = $suggest_detail.$suggest_date;

$pdf->SetXY(53, 235);
$pdf->Cell(38, 6, $conclution_detail, 0, 1);

print_dashed(53,239.50,188,239.50);

if( !empty($user['diag']) ){
    $pdf->SetXY(13, 240);
    $pdf->Cell(38, 6, 'Diag ᾷ��: '.htmlspecialchars_decode($user['diag']), 0, 1);
}

print_dashed(13,245,188,245);

$pdf->SetFont('AngsanaNew','',12);

$pdf->SetXY(13, 247);
$pdf->Cell(25, 6, '����Сѹ��ŧ���', 0, 1);
$pdf->Line(40,253,86,253);
$pdf->SetXY(40, 254);
$pdf->Cell(46, 6, '( '.$user['prefix'].$user['name'].' '.$user['surname'].' )', 0, 1, 'C');

$pdf->SetXY(107, 247);
$pdf->Cell(25, 6, 'ŧ����ᾷ�����Ǩ', 0, 1);
$pdf->Line(133,253,179,253);
$pdf->SetXY(133, 254);
$pdf->Cell(46, 6, '( ᾷ�� '.$user['doctor'].' )', 0, 1, 'C');

// $pdf->AutoPrint(true);
$pdf->Output();