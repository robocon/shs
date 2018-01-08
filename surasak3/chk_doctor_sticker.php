<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date');

# �����ż�����
$sql = "SELECT a.*, b.`ptffone`, b.`phone`
FROM `chk_doctor` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`hn` = '$hn' 
AND a.`vn` = '$vn' 
AND a.`date_chk` LIKE '$date%' ";
$db->select($sql);
$user = $db->get_item();

include 'fpdf_thai/shspdf.php';

$pdf = new SHSPdf('L','mm',array( 80,35 ));
$pdf->SetThaiFont(); // �絿͹��
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(0, 0);

$pdf->AddPage();

$pdf->SetFont('AngsanaNew','',13); // ���¡��ҹ�͹������������

$test_txt = "�š�õ�Ǩ�آ�Ҿ��Шӻ� ".$user['yearchk']."\n";
$test_txt .= "���� : ".$user["prefix"].$user["name"].' '.$user["surname"]." HN : ".$user["hn"]."\n";
$test_txt .= "�ѹ����Ǩ : ".$user['date_chk']."\n";
$test_txt .= "��ػ�š�õ�Ǩ : ".( $user['conclution'] == 1 ? '����' : '�Դ����' )."\n";
$test_txt .= "���й�������� : ".$user['suggestion']."\n";
$test_txt .= "ᾷ�� : ".$user['doctor']."\n";
$pdf->MultiCell(0, 4, $test_txt, 0);

$pdf->AutoPrint(true);
$pdf->Output();
exit;
?>