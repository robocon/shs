<?php
session_start();

$month["01"] ="มกราคม";
$month["02"] ="กุมภาพันธ์";
$month["03"] ="มีนาคม";
$month["04"] ="เมษายน";
$month["05"] ="พฤษภาคม";
$month["06"] ="มิถุนายน";
$month["07"] ="กรกฎาคม";
$month["08"] ="สิงหาคม";
$month["09"] ="กันยายน";
$month["10"] ="ตุลาคม";
$month["11"] ="พฤศจิกายน";
$month["12"] ="ธันวาคม";

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
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$sql = "Select thidate, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";

$result_dt_hn = Mysql_Query($sql);
list($thidate, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age) = Mysql_fetch_row($result_dt_hn);
$thidate = substr($thidate,8,2)."-".substr($thidate,5,2)."-".substr($thidate,0,4)." ".substr($thidate,10);
if($cigarette==0){$cigarette='ไม่สูบ';}
else if($cigarette==1){$cigarette='สูบ';}
else {$cigarette='เคยสูบ';};

if($alcohol==0){$alcohol='ไม่ดื่ม';}
else if($alcohol==1){$alcohol='ดื่ม';}
else {$alcohol='เคยดื่ม';};

if($drugreact == 0){
	$congenital_disease .=" , ผู้ป่วยไม่แพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$hn."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$congenital_disease .= " , แพ้ยา : ".$list_drug;
}


	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	$sql111 = "Select dbirth From opcard where hn='".$hn."' ";
	$result111 = Mysql_Query($sql111);
	list($dbirth) = Mysql_fetch_row($result111);
	
	//$dbirth="$y-$m-$d"; //ส่งผ่านข้อมูลวันเกิดจาก opedit โดยการ submit
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
		<td>HN : <?=$hn;?> <?=$thidate;?> <?=$cAge;?></td>
	</tr>
	<tr>
		<td>T : <?=$temperature;?> C, P : <?=$pause;?> ครั้ง/นาที , R : <?=$rate;?> ครั้ง/นาที </td>
	</tr>
	<tr>
		<td>BP : <?=$bp1;?> / <?=$bp2;?> mmHg, นน : <?=$weight;?> กก., สส : <?=$height;?> ซม.</td>
	</tr>
	<tr>
		<td>บุหรี่ : <?=$cigarette;?>, สุรา : <?=$alcohol;?> , bmi : <?=$bmi;?>, PS : <?=$painscore;?></td>
	</tr>
	<tr>
		<td>ลักษณะ : <?=$type;?>, คลินิก : <?=substr($clinic,3);?></td>
	</tr>
	<tr>
		<td>โรคประจำตัว : <?=trim($congenital_disease);?></td>
	</tr>
	<tr>
		<td>อาการ : <?=trim($organ);?></td>
	</tr>
</table>