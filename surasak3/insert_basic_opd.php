<?php
// README! 
// �����ʵԡ����Ẻ HTML ����Ѻ˹�ҫѡ����ѵԷ���繿������͡������
session_start();

$month["01"] ="���Ҥ�";
$month["02"] ="����Ҿѹ��";
$month["03"] ="�չҤ�";
$month["04"] ="����¹";
$month["05"] ="����Ҥ�";
$month["06"] ="�Զع�¹";
$month["07"] ="�á�Ҥ�";
$month["08"] ="�ԧ�Ҥ�";
$month["09"] ="�ѹ��¹";
$month["10"] ="���Ҥ�";
$month["11"] ="��Ȩԡ�¹";
$month["12"] ="�ѹ�Ҥ�";

include("connect.inc"); 

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

	return $pAge;
}

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";

$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){$cigarette='����ٺ';}
else if($cigarette==1){$cigarette='�ٺ';}
else {$cigarette='���ٺ';};

if($alcohol==0){$alcohol='������';}
else if($alcohol==1){$alcohol='����';}
else {$alcohol='�´���';};

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


	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	$sql111 = "Select dbirth From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth) = Mysql_fetch_row($result111);
	
	//$dbirth="$y-$m-$d"; //�觼�ҹ�������ѹ�Դ�ҡ opedit �¡�� submit
    $cAge=calcage($dbirth);
	

?>

<script language="javascript">
window.onload = function(){
	window.print();
	window.close();
}
</script>
<table cellpadding="0" cellspacing="0" border="0" style="font-size:9pt;">
	<tr>
		<td>HN : <?=$hn;?>, VN:<?=$vn;?>, <?=$thidate;?> <?=$cAge;?></td>
	</tr>
	<tr>
		<td>T : <?=$temperature;?> C, P : <?=$pause;?> ����/�ҷ� , R : <?=$rate;?> ����/�ҷ� </td>
	</tr>
	<tr>
		<td>BP : <?=$bp1;?> / <?=$bp2;?> mmHg, �� : <?=$weight;?> ��., �� : <?=$height;?> ��.</td>
	</tr>
	
	<tr>
		<td>
		�ͺ��� : <?=$waist;?> ��., 
		<?php 
		if( !empty($bp3) && !empty($bp4) ){
			?>
			Repeat BP : <?=$bp3;?> / <?=$bp4;?> mmHg
			<?php
		}
		?>
		</td>
	</tr>
		
	<tr>
		<td>������ : <?=$cigarette;?>, ���� : <?=$alcohol;?> , bmi : <?=$bmi;?>, PS : <?=$painscore;?></td>
	</tr>
	<tr>
		<td>�ѡɳ� : <?=$type;?>, ��Թԡ : <?=substr($clinic,3);?></td>
	</tr>
	<tr>
		<td>�ä��Шӵ�� : <?=trim($congenital_disease);?></td>
	</tr>
	<tr>
		<td>�ҡ�� : <?=trim($organ);?></td>
	</tr>
</table>