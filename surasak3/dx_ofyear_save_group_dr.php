<?php
session_start();
include("connect.inc");

$date_now = date("Y-m-d H:i:s");

$yy = explode(" ",$date_now);
$xx = explode("-",$yy[0]);

$thidate_now = ($xx[0]+543)."-".$xx[1]."-".$xx[2]." ".$yy[1];
$date_hn2 = $xx[2]."-".$xx[1]."-".($xx[0]+543).$_POST["hn"];
$date_hn = date("Y-m-d").$_POST["hn"];
$date_vn = date("Y-m-d").$_POST["vn"];


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
<script language="javascript">
window.onload = function(){
	opener.location.href = 'dx_ofyear_group_dr.php';
	//window.print();
	window.close();
}
</script>
<?php

	$sql2 = "select * from predxofyear where row_id='".$_POST['row_id']."'";
	$row2 = mysql_query($sql2);
	$query2 = mysql_fetch_array($row2);
	if($_POST['check1']=="ปกติ")  $_POST["reasoncxr"]=="";
	
	$ht = $query2["height"]/100;
    $bmi = number_format($query2["weight"]/($ht*$ht),2);
	
	
if(isset($_POST['submit2'])){
	if($_POST["check1"]=="ปกติ") $_POST['wrong']="";
	$sql = "Update `condxofyear` set  `general` ='".$_POST["check1"]."',reason_general='".$_POST['wrong']."', `stat_chest` ='".$_POST["check12"]."', `stat_sgot` ='".$_POST["check2"]."', `stat_sgpt` ='".$_POST["check2"]."', `stat_alk` ='".$_POST["check2"]."', `stat_cr` ='".$_POST["check3"]."', `stat_bun` ='".$_POST["check3"]."', `resultlead` ='".$_POST["check4"]."', `resultcadmium` ='".$_POST["check5"]."', `resultchromium` ='".$_POST["check6"]."', `resultarsenic` ='".$_POST["check7"]."', `resultmercury` ='".$_POST["check8"]."', `resultcopper` ='".$_POST["check9"]."', `resultnickel` ='".$_POST["check10"]."', `resultantimony` ='".$_POST["check11"]."',`dx` ='".$_POST["dx"]."',`summary` ='".$_POST["sumary"]."',`stat_ua` ='".$_POST["ua"]."',`stat_cbc` ='".$_POST["cbc"]."',resultlead ='".$_POST['check4']."',resultcadmium='".$_POST['check5']."',resultchromium='".$_POST['check6']."',resultarsenic='".$_POST['check7']."',resultmercury='".$_POST['check8']."',resultcopper='".$_POST['check9']."',resultnickel='".$_POST['check10']."',resultantimony='".$_POST['check11']."',FVC1='".$_POST['FVC1']."',FVC2='".$_POST['FVC2']."',FVC3='".$_POST['FVC3']."',FEV1='".$_POST['FEV1']."',FEV2='".$_POST['FEV2']."',FEV3='".$_POST['FEV3']."',RO1='".$_POST['RO1']."',RO2='".$_POST['RO2']."',RO3='".$_POST['RO3']."',PEF1='".$_POST['PEF1']."',PEF2='".$_POST['PEF2']."',PEF3='".$_POST['PEF3']."', `status_con` = 'Y' where `row_id` = '".$_POST["row_id"]."'  limit 1";
	
}///////////////////////////////////////////
/*elseif(isset($_POST['submit2'])){
	$sql= "INSERT INTO  `condxofyear` (`thidate` ,  `thdatehn` ,  `thdatevn` ,  `hn` ,  `vn` ,  `ptname` ,  `age` ,  `camp` ,  `camp_until` ,  `height` ,  `weight` ,  `round_` , `temperature` ,  `pause` ,  `rate` ,  `bmi` ,  `bp1` ,  `bp2` ,  `drugreact` ,  `congenital_disease` ,  `type` ,  `organ` ,  `doctor` ,  `ua_color` ,  `ua_appear` ,  `ua_spgr` ,  `ua_phu` , `ua_bloodu` ,  `ua_prou` ,  `ua_gluu` ,  `ua_ketu` ,  `ua_urobil` ,  `ua_bili` ,  `ua_nitrit` ,  `ua_wbcu` ,  `ua_rbcu` ,  `ua_epiu` ,  `ua_bactu` ,  `ua_yeast` ,  `ua_mucosu` ,  `ua_amopu` , `ua_castu` ,  `ua_crystu` ,  `ua_otheru` ,  `stat_ua` ,  `reason_ua` ,  `cbc_wbc` ,  `stat_wbc` ,  `reason_wbc` ,  `cbc_rbc` ,  `cbc_hb` ,  `cbc_hct` ,  `stat_hct` ,  `reason_hct` ,  `cbc_mcv` ,  `cbc_mch` ,  `cbc_mchc` ,  `cbc_pltc` ,  `stat_pltc` ,  `reason_pltc` ,  `cbc_plts` ,  `cbc_neu` ,  `cbc_lymp` ,  `cbc_mono` ,  `cbc_eos` ,  `cbc_baso` ,  `cbc_band` ,  `cbc_atyp` , `cbc_nrbc` ,  `cbc_rbcmor` ,  `cbc_other` ,  `stat_cbc` ,  `reason_cbc` ,  `cxr` ,  `reason_cxr` ,  `bs` ,  `stat_bs` ,  `reason_bs` ,  `bun` ,  `stat_bun` ,  `reason_bun` ,  `cr` ,  `stat_cr` , `reason_cr` ,  `uric` ,  `stat_uric` ,  `reason_uric` ,  `chol` ,  `stat_chol` ,  `reason_chol` ,  `tg` ,  `stat_tg` ,  `reason_tg` ,  `sgot` ,  `stat_sgot` ,  `reason_sgot` ,  `sgpt` ,  `stat_sgpt` , `reason_sgpt` ,  `alk` ,  `stat_alk` ,  `reason_alk` ,  `general` ,  `reason_general` ,  `pap` ,  `reason_pap` ,  `other1` ,  `stat_other1` ,  `reason_other1` ,  `other2` ,  `stat_other2` , `reason_other2` ,  `dx` ,  `clinic` ,  `cigarette` ,  `alcohol` ,  `summary` ,  `company` ,  `type_check` ,  `comment` ,  `hear500R` ,  `hear500L` ,  `hear1000R` ,  `hear1000L` ,  `hear2000R` , `hear2000L` ,  `hear3000R` ,  `hear3000L` ,  `hear4000R` ,  `hear4000L` ,  `hear6000R` ,  `hear6000L` ,  `hear8000R` ,  `hear8000L` ,  `LowRight`,  `LowLeft`,  `HighRight`,  `HighLeft`,  `ptaRight1`,  `ptaRight2`,  `ptaLeft1`,  `ptaLeft2` ,  `FVC1`,  `FVC2`,  `FVC3` ,  `FEV1` , `FEV2` , `FEV3` ,  `RO1` ,  `RO2` ,  `RO3` ,  `PEF1`,  `PEF2`,  `PEF3` ,  `reason_chest`,  `stat_chest`,  `lead` ,  `resultlead` , `cadmium` ,  `resultcadmium` ,  `chromium` ,  `resultchromium` ,  `arsenic` ,  `resultarsenic` ,  `mercury` ,  `resultmercury` ,  `copper` ,  `resultcopper` ,  `nickel` ,  `resultnickel` , `antimony` ,  `resultantimony`,  `status_con` ) values('".$query2["thidate"]."','".$query2["thdatehn"]."','".$query2["thdatevn"]."','".$query2["hn"]."','".$query2["vn"]."','".$query2["ptname"]."','".$query2["age"]."','".$query2["camp"]."','".$query2["camp_until"]."','".$query2["height"]."','".$query2["weight"]."','".$query2["round_"]."','".$query2["temperature"]."','".$query2["pause"]."','".$query2["rate"]."','".$bmi."','".$query2["bp1"]."','".$query2["bp2"]."','".$query2["drugreact"]."','".$query2["congenital_disease"]."','".$query2["type"]."','".$query2["organ"]."','".$query2["doctor"]."','".$query2["ua_color"]."','".$query2["ua_appear"]."','".$query2["ua_spgr"]."','".$query2["ua_phu"]."','".$query2["ua_bloodu"]."','".$query2["ua_prou"]."','".$query2["ua_gluu"]."','".$query2["ua_ketu"]."','".$query2["ua_urobil"]."','".$query2["ua_bili"]."','".$query2["ua_nitrit"]."','".$query2["ua_wbcu"]."','".$query2["ua_rbcu"]."','".$query2["ua_epiu"]."','".$query2["ua_bactu"]."','".$query2["ua_yeast"]."','".$query2["ua_mucosu"]."','".$query2["ua_amopu"]."','".$query2["ua_castu"]."','".$query2["ua_crystu"]."','".$query2["ua_otheru"]."','".$_POST['ua']."','".$query2['reason_ua']."','".$query2["cbc_wbc"]."','".$query2['stat_wbc']."','".$query2['reason_wbc']."','".$query2["cbc_rbc"]."','".$query2["cbc_hb"]."','".$query2["cbc_hct"]."','".$query2['stat_hct']."','".$query2['reason_hct']."','".$query2["cbc_mcv"]."','".$query2["cbc_mch"]."','".$query2["cbc_mchc"]."','".$query2["cbc_pltc"]."','".$query2['stat_pltc']."','".$query2['reason_pltc']."','".$query2["cbc_plts"]."','".$query2["cbc_neu"]."','".$query2["cbc_lymp"]."','".$query2["cbc_mono"]."','".$query2["cbc_eos"]."','".$query2["cbc_baso"]."','".$query2["cbc_band"]."','".$query2["cbc_atyp"]."','".$query2["cbc_nrbc"]."','".$query2["cbc_rbcmor"]."','".$query2["cbc_other"]."','".$_POST['cbc']."','".$query2['reason_cbc']."','".$query2["cxr"]."','".$query2["reason_cxr"]."','".$query2["bs"]."','".$query2['stat_bs']."','".$query2['reason_bs']."','".$query2["bun"]."','".$_POST['check3']."','".$query2['reason_bun']."','".$query2["cr"]."','".$_POST['check3']."','".$query2['reason_cr']."','".$query2["uric"]."','".$query2['stat_uric']."','".$query2['reason_uric']."','".$query2["chol"]."','".$query2['stat_chol']."','".$query2['reason_chol']."','".$query2["tg"]."','".$query2['stat_tg']."','".$query2['reason_tg']."','".$query2["sgot"]."','".$_POST['check2']."','".$query2['reason_sgot']."','".$query2["sgpt"]."','".$_POST['check2']."','".$query2['reason_sgpt']."','".$query2["alk"]."','".$_POST['check2']."','".$query2['reason_alk']."','".$_POST['check1']."','".$query2['reason_general']."','".$query2['pap']."','".$query2['reason_pap']."','".$query2['other1']."','".$query2['stat_other1']."','".$query2['reason_other1']."','".$query2['other2']."','".$query2['stat_other2']."','".$query2['reason_other2']."','".$query2["dx"]."','".$query2['clinic']."','".$query2['cigarette']."','".$query2['alcohol']."','".$query2['summary']."','".$query2['company']."','".$query2['type_check']."','".$query2['comment']."','".$query2['hear500R']."','".$query2['hear500L']."','".$query2['hear1000R']."','".$query2['hear1000L']."','".$query2['hear2000R']."','".$query2['hear2000L']."','".$query2['hear3000R']."','".$query2['hear3000L']."','".$query2['hear4000R']."','".$query2['hear4000L']."','".$query2['hear6000R']."','".$query2['hear6000L']."','".$query2['hear8000R']."','".$query2['hear8000L']."','".$query2['LowRight']."','".$query2['LowLeft']."','".$query2['HighRight']."','".$query2['HighLeft']."','".$query2['ptaRight1']."','".$query2['ptaRight2']."','".$query2['ptaLeft1']."','".$query2['ptaLeft2']."','".$query2['FVC1']."','".$query2['FVC2']."','".$query2['FVC3']."','".$query2['FEV1']."','".$query2['FEV2']."','".$query2['FEV3']."','".$query2['RO1']."','".$query2['RO2']."','".$query2['RO3']."','".$query2['PEF1']."','".$query2['PEF2']."','".$query2['PEF3']."','".$query2['reason_chest']."','".$_POST['check12']."','".$query2['lead']."','".$_POST['check4']."','".$query2['cadmium']."','".$_POST['check5']."','".$query2['chromium']."','".$_POST['check6']."','".$query2['arsenic']."','".$_POST['check7']."','".$query2['mercury']."','".$_POST['check8']."','".$query2['copper']."','".$_POST['check9']."','".$query2['nickel']."','".$_POST['check10']."','".$query2['antimony']."','".$_POST['check11']."','N')";
}*/
//echo $sql;
	//exit();
$result = mysql_query($sql) or die(mysql_error());


if($result){
	echo "<CENTER>บันทึกข้อมูลเรียบร้อยแล้ว</CENTER>";
}elseif($result && isset($_POST["submit3"])){
	
	

if($_POST["drugreact"] == 0){
	$_POST["congenital_disease"] .=" , ผู้ป่วยไม่แพ้ยา";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$_POST["hn"]."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$_POST["congenital_disease"] .= " , แพ้ยา : ".$list_drug;
}

?>

<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN :<?php echo $_POST["hn"];?>&nbsp;&nbsp;<?php echo $thidate;?></td>
  </tr>
  <tr>
    <td>T : <?php echo $_POST["temperature"];?> C, P : <?php echo $_POST["pause"];?> ครั้ง/นาที , R : <?php echo $_POST["rate"];?> ครั้ง/นาที </td>
  </tr>
  <tr>
    <td>BP : <?php echo $_POST["bp1"];?> / <?php echo $_POST["bp2"];?> mmHg, นน : <?php echo $_POST["weight"];?> กก., สส : <?php echo $_POST["height"];?> ซม.</td>
  </tr>
  <tr>
    <td>บุหรี่ : <?php echo $_POST["cigarette"];?>, สุรา : <?php echo $_POST["alcohol"];?></td>
  </tr>
  <tr>
    <td>ลักษณะ : <?php echo $_POST["type"];?>, คลินิก : <?php echo substr($_POST["clinic"],3);?></td>
  </tr>
  <tr>
    <td>B : <?php echo $_POST["congenital_disease"];?></td>
  </tr>
  <tr>
    <td>S : <?php echo $_POST["organ"];?></td>
  </tr>
</table>
<?php
	}else{
	echo "<CENTER><FONT COLOR=\"red\">ไม่สามารถบันทึกข้อมูลได้</FONT></CENTER>";
}

include("unconnect.inc");

?>
</BODY>
</HTML>