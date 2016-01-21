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
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> Print OPD </TITLE>
<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
</HEAD>

<BODY>
<?php
include("connect.inc"); 


Function calcage($birth){

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
//date_format(thidate,'%d-%m-%Y %H:%i:%s')
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
<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN :<?php echo $hn;?>&nbsp;&nbsp;<?php echo $thidate;?>age:<?php echo $cAge;?></td>
  </tr>
  <tr>
    <td>T : <?php echo $temperature;?> C, P : <?php echo $pause;?> ครั้ง/นาที , R : <?php echo $rate;?> ครั้ง/นาที </td>
  </tr>
  <tr>
    <td>BP : <?php echo $bp1;?> / <?php echo $bp2;?> mmHg, นน : <?php echo $weight;?> กก., สส : <?php echo $height;?> ซม.</td>
  </tr>
  <tr>
    <td>บุหรี่ : <?php echo $cigarette;?>, สุรา : <?php echo $alcohol;?> , bmi : <?php echo $bmi;?>, PS : <?php echo $painscore;?></td>
  </tr>
  <tr>
    <td>ลักษณะ : <?php echo $type;?>, คลินิก : <?php echo substr($clinic,3);?></td>
  </tr>
  <tr>
    <td>โรคประจำตัว : <?php echo $congenital_disease;?></td>
  </tr>
  <tr>
    <td>อาการ : <?php echo $organ;?></td>
  </tr>
</table>
</BODY>
</HTML>
