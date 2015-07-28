<?php

include("connect.php");

$thidate_now = (date("Y")+543).date("-m-d").date(" H:i:s");
$thidate = date("d-m-").(date("Y")+543);
$thidatehn = $_REQUEST["dthn"];
	
$sql = "Select date_format(thidate,'%d-%m-%Y %H:%i:%s'), hn, ptname , temperature , pause , rate , weight , height , bp1 , bp2 , drugreact , congenital_disease , type , organ , doctor, clinic   From opd where thdatehn = '".$thidatehn."' limit 1 ";
$result_dt_hn = Mysql_Query($sql);
list($thidate, $hn, $ptname , $temperature , $pause , $rate , $weight , $height , $bp1 , $bp2 , $drugreact , $congenital_disease , $type , $organ , $doctor, $clinic) = Mysql_fetch_row($result_dt_hn);


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
?>
<script language="javascript">
window.onload = function(){
	window.print();
}
</script>
<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN :<?php echo $hn;?>&nbsp;&nbsp;<?php echo $thidate;?></td>
  </tr>
  <tr>
    <td>T : <?php echo $temperature;?> C, P : <?php echo $pause;?> ครั้ง/นาที , R : <?php echo $rate;?> ครั้ง/นาที </td>
  </tr>
  <tr>
    <td>BP : <?php echo $bp1;?> / <?php echo $bp2;?> mmHg, นน : <?php echo $weight;?> กก.,</td>
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