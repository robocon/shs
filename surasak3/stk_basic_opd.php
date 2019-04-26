<?php
// README! 
// �����ʵԡ����Ẻ PDF ����Ѻ˹�ҫѡ����ѵԷ���繿������͡������ ���˹�Ңͧ OPD Ẻ�������͹��ѧ
// require("fpdf_thai/fpdf_thai.php");
include 'fpdf_thai/shspdf.php';
include("connect.php");

class PDF extends FPDF_Thai{}

function calcage($birth){

	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM <0 ) {
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

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist, 
`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi`
From opd 
where thdatehn = '".$_GET["dthn"]."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi) = Mysql_fetch_row($result_dt_hn);


$ht = $height/100;
$bmi=number_format($weight /($ht*$ht),2);

if( empty($painscore) ){
	$painscore = '-';
}

$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){
	$cigarette='����ٺ';
}else if($cigarette==1){
	$cigarette='�ٺ '.$smoke_amount.' �ǹ/�ѻ����';
}else{
	$cigarette='���ٺ';
}

if($alcohol==0){
	$alcohol='������';
}else if($alcohol==1){
	$alcohol='���� '.$drink_amount.' ���/�ѹ';
}else{
	$alcohol='�´���';
}

if($drugreact == 0){
	$congenital_disease .=" , �������������";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$congenital_disease .= " , ���� : ".$list_drug;
}

if( empty($weight) ){
	$weight = 0;
}
if( empty($height) ){
	$height = 0;
	$ht = 0;
}else{
	$ht = $height/100;
}

$bmi = number_format(($weight / ( $ht * $ht)), 2);

$sql111 = "Select dbirth From opcard where hn='$hn' ";
$result111 = Mysql_Query($sql111);
list($dbirth) = Mysql_fetch_row($result111);
$cAge = calcage($dbirth);


$pdf = new SHSPdf('L', 'mm', array( 85, 53));
$pdf->SetThaiFont(); // �絿͹��
$pdf->SetFont('THSarabun','',14); // ���¡��ҹ�͹������������
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(2, 2);
$pdf->AddPage();

$full_text = "HN: $hn, $thidate, $cAge\n";
$full_text .= "VN: $vn, T: $temperature C, P: $pause ����/�ҷ�, R: $rate ����/�ҷ�\n";
$full_text .= "BP: $bp1 / $bp2 mmHg, ��: $weight ��., ��: $height ��.\n";

if( !empty( $waist ) ){
	$full_text .= "�ͺ���: $waist ��., ";
}

if( !empty($bp3) && !empty($bp4) ){
	$full_text .= "Repeat BP: $bp3 / $bp4 mmHg\n";
}

$full_text .= "������: $cigarette, ����: $alcohol, bmi: $bmi, PS: $painscore\n";

if ( !empty($mens) ) { 

	$mens_lists = array(1=>'�ѧ����ջ�Ш���͹','�����Ш���͹','�ѧ�ջ�Ш���͹');

	$mens_txt = '';
	if ( $mens == 3 ) {

		$mens_y = substr($mens_date,0,4);
		$mens_date_txt = ($mens_y+543).substr($mens_date,4,10);
		$mens_txt = ' ����ش�ѹ���: '.$mens_date_txt;
	}

	$full_text .= "���: ".$mens_lists[$mens].$mens_txt."\n";
}

if ( !empty($vaccine) ) {

	$vacc_lists = array(1=>'���ࡳ��', '�����ࡳ��');
	$psmoke_lists = array(1=>'�ٺ������','����ٺ������');
	$pdrink_lists = array(1=>'��������','����������');

	$parent_txt = $psmoke_lists[$parent_smoke];
	
	if( $parent_smoke == 1 ){
		$parent_txt .= ' '.$parent_smoke_amount.' �ǹ/�ѹ';
	}
	$parent_txt .= ' ';
	$parent_txt .= $pdrink_lists[$parent_drink];
	if( $parent_drink == 1 ){
		$parent_txt .= ' '.$parent_drink_amount.' ���/�ѻ����';
	}
	
	$full_text .= "�Ѥ�չ: ".$vacc_lists[$vaccine].' ���: '.$parent_txt." \n";
}


$full_text .= "�ѡɳ�: $type, ��Թԡ: ".$clinic."\n";
$full_text .= "�ä��Шӵ��: ".trim($congenital_disease)."\n";

if ( !empty($ht_amount) OR !empty($dm_amount) ) {

	$htdm = '';
	if ( !empty($ht_amount) ) {
		$htdm .= 'HT: �������� '.$ht_amount.'��';
	}

	if ( !empty($dm_amount) ) {
		$htdm .= ' DM: �������� '.$dm_amount.'��';
	}

	$full_text .= $htdm." \n";
}

$full_text .= "�ҡ��: ".trim($organ)." \n";

if ( !empty($hpi) ) { 
	$full_text .= "HPI: ".$hpi." \n";
}


$pdf->SetXY(2, 2);
$pdf->MultiCell(0, 5, $full_text);

$pdf->AutoPrint(true);
$pdf->Output();
?>