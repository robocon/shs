<?php
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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}

  

$sql = "Select thidate, hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic, cigarette,alcohol,painscore,age From opd where thdatehn = '".$_GET["dthn"]."' limit 1 ";
//date_format(thidate,'%d-%m-%Y %H:%i:%s')
$result_dt_hn = Mysql_Query($sql);
list($thidate, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic, $cigarette, $alcohol,$painscore,$age) = Mysql_fetch_row($result_dt_hn);
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
<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN :<?php echo $hn;?>&nbsp;&nbsp;<?php echo $thidate;?>age:<?php echo $cAge;?></td>
  </tr>
  <tr>
    <td>T : <?php echo $temperature;?> C, P : <?php echo $pause;?> ����/�ҷ� , R : <?php echo $rate;?> ����/�ҷ� </td>
  </tr>
  <tr>
    <td>BP : <?php echo $bp1;?> / <?php echo $bp2;?> mmHg, �� : <?php echo $weight;?> ��., �� : <?php echo $height;?> ��.</td>
  </tr>
  <tr>
    <td>������ : <?php echo $cigarette;?>, ���� : <?php echo $alcohol;?> , bmi : <?php echo $bmi;?>, PS : <?php echo $painscore;?></td>
  </tr>
  <tr>
    <td>�ѡɳ� : <?php echo $type;?>, ��Թԡ : <?php echo substr($clinic,3);?></td>
  </tr>
  <tr>
    <td>�ä��Шӵ�� : <?php echo $congenital_disease;?></td>
  </tr>
  <tr>
    <td>�ҡ�� : <?php echo $organ;?></td>
  </tr>
</table>
</BODY>
</HTML>
