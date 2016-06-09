<?php
include 'bootstrap.php';
include 'fpdf_thai/shspdf.php';

function calcage($birth){

	$today = getdate();
	$nY = $today['year'];
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM<0) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ��";
	}else{
		$pAge = "$ageY �� $ageM ��͹";
	}

	return $pAge;
}

$Can = input_get('Can');
$Chn = input_get('Chn');

$db = Mysql::load();
$sql = "SELECT a.an, a.hn, a.date, a.bedcode, b.yot, b.name, b.surname, b.idcard, b.ptright, b.dbirth, b.sex, b.address, b.tambol, b.ampur, b.changwat, b.phone, b.ptf, b.ptfadd, b.ptffone, b.camp 
FROM `ipcard` AS a
LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
WHERE a.`an` = '$Can'";

$db->select($sql);
$item = $db->get_item();

list($adate, $tdate) = explode(' ', $item['date']);
$age = calcage($item['dbirth']);
$sex = ( $item['sex'] === '�' ) ? '���' : '˭ԧ' ;

$pdf = new SHSPdf('P', 'mm', 'A4');

$pdf->SetThaiFont(); // �絿͹��
$pdf->SetAutoPageBreak(false, 0);
$pdf->SetMargins(3, 3, 3); // left, top, right
$pdf->AddPage();
$pdf->SetFont('THSarabun','',12); // ���¡��ҹ�͹������������
// $pdf->SetFontSize(17);

$pdf->Cell(197, 7, 'DISCHARGE SUMMARY', 1, 1, 'C');
$pdf->Cell(197, 7, 'FORT SURASAKMONTRI HOSPITAL FR-MDO-001/1 , 05, 01 , �.�. 52', 1, 1, 'C');

$x = $pdf->GetX();
$y = $pdf->GetY();
$pdf->Rect($x,$y,197,35); // �ش x,y ���˹�ҡ�д�� ��ǹ�������ҧ�٧�ͧ��ͺ����ͧ���

$pdf->SetXY(3, 17);
$pdf->Cell(80, 7, "ADMIT: $adate ����: $tdate", 1, 1);
$pdf->SetXY(83, 17);
$pdf->SetFont('THSarabun',"B",12);
$pdf->Cell(50, 7, 'AN: '.$item['an'],1 ,1);
$pdf->SetXY(133, 17);
$pdf->Cell(67, 7, 'HN: '.$item['hn'],1 ,1);

$pdf->SetXY(3, 24);
$pdf->SetFont('THSarabun','B',12);
$pdf->Cell(80, 7, '����: '.$item['yot'].' '.$item['name'].' '.$item['surname'].' ����: '.$age, 1, 1);
$pdf->SetXY(83, 24);
$pdf->SetFont('THSarabun','',12);
$pdf->Cell(50, 7, '��: '.$sex,1 ,1);
$pdf->SetXY(133, 24);
$pdf->Cell(67, 7, '�ѧ�Ѵ: '.$sex,1 ,1);

$pdf->SetXY(3, 31);
$pdf->Cell(80, 7, '�Ţ ���: '.$item['idcard'], 1, 1);
$pdf->SetXY(83, 31);
$pdf->Cell(50, 7, '�/�/�.�Դ: '.$item['dbirth'], 1, 1);
$pdf->SetXY(133, 31);
$pdf->Cell(67, 7, '�Է��: '.$item['ptright'], 1, 1);

$pdf->SetXY(3, 38);
$pdf->Cell(80, 7, '��ҹ�Ţ���: '.$item['address'].' �Ӻ� '.$item['tambol'].' ����� '.$item['ampur'], 1, 1);
$pdf->SetXY(83, 38);
$pdf->Cell(50, 7, '�ѧ��Ѵ: '.$item['changwat'], 1, 1);
$pdf->SetXY(133, 38);
$pdf->Cell(67, 7, '��: '.$item['phone'], 1, 1);

$pdf->SetXY(3, 45);
$pdf->Cell(80, 7, '�����Դ�����: '.$item['ptf'].' ����Ǣ�ͧ��: '.$item['ptfadd'], 1, 1);
$pdf->SetXY(83, 45);
$pdf->Cell(50, 7, '���Ѿ��: '.$item['ptffone'], 1, 1);
$pdf->SetXY(133, 45);
$pdf->Cell(67, 7, '���Ѻ:                        �ͨ�˹��� ', 1, 1);


// $pdf->AutoPrint(true);
$pdf->Output();