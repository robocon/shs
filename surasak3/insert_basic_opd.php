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

$sql = "Select thidate, vn, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age,bp3,bp4,waist,`mens`,`mens_date`,`vaccine`,`parent_smoke`,`parent_smoke_amount`,`parent_drink`,`parent_drink_amount`,`smoke_amount`,`drink_amount`,`ht_amount`,`dm_amount`,`hpi` From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";

$result_dt_hn = Mysql_Query($sql);
list($thidate, $vn, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age,$bp3,$bp4,$waist,$mens,$mens_date,$vaccine,$parent_smoke,$parent_smoke_amount,$parent_drink,$parent_drink_amount,$smoke_amount,$drink_amount,$ht_amount,$dm_amount,$hpi) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){$cigarette='����ٺ';}
else if($cigarette==1){$cigarette='�ٺ '.$smoke_amount.' �ǹ/�ѻ����';}
else {$cigarette='���ٺ';};

if($alcohol==0){$alcohol='������';}
else if($alcohol==1){$alcohol='���� '.$drink_amount.' ���/�ѹ';}
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
	<?php 
	if ( !empty($mens) ) { 

		$mens_lists = array(1=>'�ѧ����ջ�Ш���͹','�����Ш���͹','�ѧ�ջ�Ш���͹');

		$mens_txt = '';
		if ( $mens == 3 ) {

			$mens_y = substr($mens_date,0,4);
			$mens_date_txt = ($mens_y+543).substr($mens_date,4,10);
			$mens_txt = ' ����ش�ѹ���: '.$mens_date_txt;
		}
		?>
		<tr>
			<td>���: <?=$mens_lists[$mens].$mens_txt;?> </td>
		</tr>
		<?php
	}

	if ( !empty($vaccine) ) {

		$vacc_lists = array(1=>'���ࡳ��', '�����ࡳ��');
		$psmoke_lists = array(1=>'�ٺ������','����ٺ������');
		$pdrink_lists = array(1=>'��������','����������');

		?>
		<tr>
			<td>
				�Ѥ�չ: <?=$vacc_lists[$vaccine];?>&nbsp;
				���: <?php 
				echo $psmoke_lists[$parent_smoke];
				if( $parent_smoke == 1 ){
					echo '&nbsp;'.$parent_smoke_amount.' �ǹ/�ѹ';
				}
				echo '&nbsp;';
				echo $pdrink_lists[$parent_drink];
				if( $parent_drink == 1 ){
					echo '&nbsp;'.$parent_drink_amount.' ���/�ѻ����';
				}
				?>
			</td>
		</tr>
		<?php
	}

	?>
	<tr>
		<td>�ѡɳ� : <?=$type;?>, ��Թԡ : <?=substr($clinic,3);?></td>
	</tr>
	<tr>
		<td>�ä��Шӵ�� : <?=trim($congenital_disease);?></td>
	</tr>
	<?php 
	if ( !empty($ht_amount) OR !empty($dm_amount) ) {

		$htdm = '';
		if ( !empty($ht_amount) ) {
			$htdm .= 'HT: �������� '.$ht_amount.'��';
		}

		if ( !empty($dm_amount) ) {
			$htdm .= ' DM: �������� '.$dm_amount.'��';
		}

		?>
		<tr>
			<td>
				<?=$htdm;?> 
			</td>
		</tr>
		<?php
	}
	?>
	<tr>
		<td>�ҡ�� : <?=trim($organ);?></td>
	</tr>
	<?php 
	if ( !empty($hpi) ) {
		?>
		<tr>
			<td>HPI: <?=$hpi;?></td>
		</tr>
		<?php
	}
	?>
</table>