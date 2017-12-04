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
<meta http-equiv="Content-Type" content="text/html; charset=windows-874"></HEAD>

<BODY>
<script language="javascript">
window.onload = function(){
	opener.location.href = 'dx_ofyear_group_con.php';
	//window.print();
	window.close();
}
</script>
<?php

/*$sql = "Select count(row_id) From opd where thdatehn = '".$date_hn."' limit 1";
	$result = Mysql_Query($sql);
	list($rows) = Mysql_fetch_row($result);
	
	if($rows > 0){

$sql = "Update `opd` set  `thidate` = '".$thidate_now."', `temperature`  = '".$_POST["temperature"]."', `pause`  = '".$_POST["pause"]."', `rate`  = '".$_POST["rate"]."', `weight`  = '".$_POST["weight"]."', `bp1`  = '".$_POST["bp1"]."', `bp2`  = '".$_POST["bp2"]."', `drugreact`  = '".$_POST["drugreact"]."', `congenital_disease`  = '".$_POST["congenital_disease"]."', `type`  = '".$_POST["type"]."', `organ`  = '".$_POST["organ"]."', `doctor` = '".$_POST["doctor"]."',  `officer` = '".$_SESSION["sOfficer"]."' ,  `dc_diag` = Null, `vn`= '".$_POST["vn"]."', `toborow` = '".$_POST["toborow"]."', `height` = '".$_POST["height"]."' , `clinic`  = '".$_POST["clinic"]."' , `cigarette`= '".$_POST["cigarette"]."', `alcohol`= '".$_POST["alcohol"]."' where  `thdatehn` = '".$thidatehn."' limit 1 ";
mysql_query($sql);


	}else{

$sql = "INSERT INTO `opd` (`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`temperature` ,`pause` ,`rate` ,`weight` ,`bp1`  ,`bp2` ,`drugreact` ,`congenital_disease` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , `toborow`, `height`, `clinic`, `cigarette`, `alcohol`)VALUES (NULL , '".$thidate_now."', '".$date_hn2."', '".$_POST["hn"]."', '".$_POST["ptname"]."', '".$_POST["temperature"]."', '".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', '".$_POST["bp2"]."', '".$_POST["drugreact"]."', '".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".$_POST["organ"]."', '".$_POST["doctor"]."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', '".$_POST["toborow"]."', '".$_POST["height"]."', '".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."' );";
mysql_query($sql);
}

$sql = "Select count(row_id) From  `predxofyear` where `thdatehn` = '{$date_hn}' limit 0,1 ";
list($count) = mysql_fetch_row(mysql_query($sql));
*/
	
	
	$sql2 = "select * from predxofyear where row_id='".$_POST['row_id']."'";
	$row2 = mysql_query($sql2);
	$query2 = mysql_fetch_array($row2);
	if($_POST['check1']=="ปกติ")  $_POST["reasoncxr"]=="";
	
	$ht = $query2["height"]/100;
    $bmi = number_format($query2["weight"]/($ht*$ht),2);
	
if(isset($_POST['submit'])){
	$sql = "Update `predxofyear` set `hear500L` = '".$_POST["left1"]."' ,`hear500R` = '".$_POST["right1"]."' ,`hear1000L` = '".$_POST["left2"]."' ,`hear1000R` = '".$_POST["right2"]."' ,`hear2000L` = '".$_POST["left3"]."' ,`hear2000R` = '".$_POST["right3"]."' ,`hear3000L` = '".$_POST["left4"]."' ,`hear3000R` = '".$_POST["right4"]."' ,`hear4000L` = '".$_POST["left5"]."' ,`hear4000R` = '".$_POST["right5"]."' ,`hear6000L` ='".$_POST["left6"]."' , `hear6000R` ='".$_POST["right6"]."', `hear8000L` ='".$_POST["left7"]."', `hear8000R` ='".$_POST["right7"]."', `LowRight` ='".$_POST["tone1"]."', `LowLeft` ='".$_POST["tone2"]."', `HighRight` ='".$_POST["tone3"]."', `HighLeft` ='".$_POST["tone4"]."', `ptaRight1` ='".$_POST["pta1"]."', `ptaRight2` ='".$_POST["pta3"]."', `ptaLeft1` ='".$_POST["pta2"]."', `ptaLeft2` ='".$_POST["pta4"]."', `FVC` ='".$_POST["FVC"]."', `FEV1` ='".$_POST["FEV1"]."', `RO` ='".$_POST["RO"]."', `PEF` ='".$_POST["PEF"]."', `age` ='".$query2["age"]."', `camp` ='".$query2["camp"]."', `height` ='".$query2["height"]."', `weight` ='".$query2["weight"]."', `temperature` ='".$query2["temperature"]."', `pause` ='".$query2["pause"]."', `rate` ='".$query2["rate"]."', `bmi` ='".$bmi."', `bp1` ='".$query2["bp1"]."', `bp2` ='".$query2["bp2"]."', `congenital_disease` ='".$query2["congenital_disease"]."', `sgot` ='".$query2["sgot"]."', `sgpt` ='".$query2["sgpt"]."', `alk` ='".$query2["alk"]."', `cigarette` ='".$query2["cigarette"]."', `alcohol` ='".$query2["alcohol"]."', `thidate` ='".$query2["thidate"]."', `thdatehn` ='".$query2["thdatehn"]."', `thdatevn` ='".$query2["thdatevn"]."', `reason_cxr` ='".$_POST["reasoncxr"]."', `ua_color` ='".$_POST["ua_color"]."', `ua_appear` ='".$_POST["ua_appear"]."', `ua_spgr` ='".$_POST["ua_spgr"]."', `ua_phu` ='".$_POST["ua_phu"]."', `ua_bloodu` ='".$_POST["ua_bloodu"]."', `ua_prou` ='".$_POST["ua_prou"]."', `ua_gluu` ='".$_POST["ua_gluu"]."', `ua_ketu` ='".$_POST["ua_ketu"]."', `ua_urobil` ='".$_POST["ua_urobil"]."', `ua_bili` ='".$_POST["ua_bili"]."', `ua_nitrit` ='".$_POST["ua_nitrit"]."', `ua_wbcu` ='".$_POST["ua_wbcu"]."', `ua_rbcu` ='".$_POST["ua_rbcu"]."', `ua_epiu` ='".$_POST["ua_epiu"]."', `ua_bactu` ='".$_POST["ua_bactu"]."', `ua_yeast` ='".$_POST["ua_yeast"]."', `ua_mucosu` ='".$_POST["ua_mucosu"]."', `ua_amopu` ='".$_POST["ua_amopu"]."', `ua_castu` ='".$_POST["ua_castu"]."', `ua_crystu` ='".$_POST["ua_crystu"]."', `ua_otheru` ='".$_POST["ua_otheru"]."', `cbc_wbc` ='".$_POST["cbc_wbc"]."', `cbc_rbc` ='".$_POST["cbc_rbc"]."', `cbc_hb` ='".$_POST["cbc_hb"]."', `cbc_hct` ='".$_POST["cbc_hct"]."', `cbc_mcv` ='".$_POST["cbc_mcv"]."', `cbc_mch` ='".$_POST["cbc_mch"]."', `cbc_mchc` ='".$_POST["cbc_mchc"]."', `cbc_pltc` ='".$_POST["cbc_pltc"]."', `cbc_plts` ='".$_POST["cbc_plts"]."', `cbc_neu` ='".$_POST["cbc_neu"]."', `cbc_lymp` ='".$_POST["cbc_lymp"]."', `cbc_mono` ='".$_POST["cbc_mono"]."', `cbc_eos` ='".$_POST["cbc_eos"]."', `cbc_baso` ='".$_POST["cbc_baso"]."', `cbc_band` ='".$_POST["cbc_band"]."', `cbc_atyp` ='".$_POST["cbc_atyp"]."', `cbc_nrbc` ='".$_POST["cbc_nrbc"]."', `cbc_rbcmor` ='".$_POST["cbc_rbcmor"]."', `cbc_other` ='".$_POST["cbc_other"]."', `bs` ='".$_POST["bs"]."', `bun` ='".$_POST["bun"]."', `cr` ='".$_POST["cr"]."', `uric` ='".$_POST["uric"]."', `chol` ='".$_POST["chol"]."', `tg` ='".$_POST["tg"]."' where `row_id` = '".$_POST["row_id"]."'  limit 1";
	/*$sql = "Update `predxofyear` set `hear500L` = '".$_POST["left1"]."' ,`hear500R` = '".$_POST["right1"]."' ,`hear1000L` = '".$_POST["left2"]."' ,`hear1000R` = '".$_POST["right2"]."' ,`hear2000L` = '".$_POST["left3"]."' ,`hear2000R` = '".$_POST["right3"]."' ,`hear3000L` = '".$_POST["left4"]."' ,`hear3000R` = '".$_POST["right4"]."' ,`hear4000L` = '".$_POST["left5"]."' ,`hear4000R` = '".$_POST["right5"]."' ,`hear6000L` ='".$_POST["left6"]."' , `hear6000R` ='".$_POST["right6"]."', `hear8000L` ='".$_POST["left7"]."', `hear8000R` ='".$_POST["right7"]."', `LowRight` ='".$_POST["tone1"]."', `LowLeft` ='".$_POST["tone2"]."', `HighRight` ='".$_POST["tone3"]."', `HighLeft` ='".$_POST["tone4"]."', `ptaRight1` ='".$_POST["pta1"]."', `ptaRight2` ='".$_POST["pta3"]."', `ptaLeft1` ='".$_POST["pta2"]."', `ptaLeft2` ='".$_POST["pta4"]."', `FVC` ='".$_POST["FVC"]."', `FEV1` ='".$_POST["FEV1"]."', `RO` ='".$_POST["RO"]."', `PEF` ='".$_POST["PEF"]."', `age` ='".$query2["age"]."', `camp` ='".$query2["camp"]."', `height` ='".$query2["height"]."', `weight` ='".$query2["weight"]."', `temperature` ='".$query2["temperature"]."', `pause` ='".$query2["pause"]."', `rate` ='".$query2["rate"]."', `bmi` ='".$bmi."', `bp1` ='".$query2["bp1"]."', `bp2` ='".$query2["bp2"]."', `congenital_disease` ='".$query2["congenital_disease"]."', `sgot` ='".$query2["sgot"]."', `sgpt` ='".$query2["sgpt"]."', `alk` ='".$query2["alk"]."', `cigarette` ='".$query2["cigarette"]."', `alcohol` ='".$query2["alcohol"]."', `thidate` ='".$query2["thidate"]."', `thdatehn` ='".$query2["thdatehn"]."', `thdatevn` ='".$query2["thdatevn"]."', `cxr` ='".$_POST["check1"]."' where `row_id` = '".$_POST["row_id"]."'  limit 1";*/
}///////////////////////////////////////////
elseif(isset($_POST['submit2'])){
	$sql= "INSERT INTO  `condxofyear` (`thidate` ,  `thdatehn` ,  `thdatevn` ,  `hn` ,  `vn` ,  `ptname` ,  `age` ,  `camp` ,  `camp_until` ,  `height` ,  `weight` ,  `round_` , `temperature` ,  `pause` ,  `rate` ,  `bmi` ,  `bp1` ,  `bp2` ,  `drugreact` ,  `congenital_disease` ,  `type` ,  `organ` ,  `doctor` ,  `ua_color` ,  `ua_appear` ,  `ua_spgr` ,  `ua_phu` , `ua_bloodu` ,  `ua_prou` ,  `ua_gluu` ,  `ua_ketu` ,  `ua_urobil` ,  `ua_bili` ,  `ua_nitrit` ,  `ua_wbcu` ,  `ua_rbcu` ,  `ua_epiu` ,  `ua_bactu` ,  `ua_yeast` ,  `ua_mucosu` ,  `ua_amopu` , `ua_castu` ,  `ua_crystu` ,  `ua_otheru` ,  `stat_ua` ,  `reason_ua` ,  `cbc_wbc` ,  `stat_wbc` ,  `reason_wbc` ,  `cbc_rbc` ,  `cbc_hb` ,  `cbc_hct` ,  `stat_hct` ,  `reason_hct` ,  `cbc_mcv` ,  `cbc_mch` ,  `cbc_mchc` ,  `cbc_pltc` ,  `stat_pltc` ,  `reason_pltc` ,  `cbc_plts` ,  `cbc_neu` ,  `cbc_lymp` ,  `cbc_mono` ,  `cbc_eos` ,  `cbc_baso` ,  `cbc_band` ,  `cbc_atyp` , `cbc_nrbc` ,  `cbc_rbcmor` ,  `cbc_other` ,  `stat_cbc` ,  `reason_cbc` ,  `cxr` ,  `reason_cxr` ,  `bs` ,  `stat_bs` ,  `reason_bs` ,  `bun` ,  `stat_bun` ,  `reason_bun` ,  `cr` ,  `stat_cr` , `reason_cr` ,  `uric` ,  `stat_uric` ,  `reason_uric` ,  `chol` ,  `stat_chol` ,  `reason_chol` ,  `tg` ,  `stat_tg` ,  `reason_tg` ,  `sgot` ,  `stat_sgot` ,  `reason_sgot` ,  `sgpt` ,  `stat_sgpt` , `reason_sgpt` ,  `alk` ,  `stat_alk` ,  `reason_alk` ,  `general` ,  `reason_general` ,  `pap` ,  `reason_pap` ,  `other1` ,  `stat_other1` ,  `reason_other1` ,  `other2` ,  `stat_other2` , `reason_other2` ,  `dx` ,  `clinic` ,  `cigarette` ,  `alcohol` ,  `summary` ,  `company` ,  `type_check` ,  `comment` ,  `hear500R` ,  `hear500L` ,  `hear1000R` ,  `hear1000L` ,  `hear2000R` , `hear2000L` ,  `hear3000R` ,  `hear3000L` ,  `hear4000R` ,  `hear4000L` ,  `hear6000R` ,  `hear6000L` ,  `hear8000R` ,  `hear8000L` ,  `LowRight`,  `LowLeft`,  `HighRight`,  `HighLeft`,  `ptaRight1`,  `ptaRight2`,  `ptaLeft1`,  `ptaLeft2` ,  `FVC1`,  `FVC2`,  `FVC3` ,  `FEV1` , `FEV2` , `FEV3` ,  `RO1` ,  `RO2` ,  `RO3` ,  `PEF1`,  `PEF2`,  `PEF3` ,  `reason_chest`,  `stat_chest`,  `lead` ,  `resultlead` , `cadmium` ,  `resultcadmium` ,  `chromium` ,  `resultchromium` ,  `arsenic` ,  `resultarsenic` ,  `mercury` ,  `resultmercury` ,  `copper` ,  `resultcopper` ,  `nickel` ,  `resultnickel` , `antimony` ,  `resultantimony`,  `status_con` ) values('".$query2["thidate"]."','".$query2["thdatehn"]."','".$query2["thdatevn"]."','".$query2["hn"]."','".$query2["vn"]."','".$query2["ptname"]."','".$query2["age"]."','".$query2["camp"]."','".$query2["camp_until"]."','".$query2["height"]."','".$query2["weight"]."','".$query2["round_"]."','".$query2["temperature"]."','".$query2["pause"]."','".$query2["rate"]."','".$bmi."','".$query2["bp1"]."','".$query2["bp2"]."','".$query2["drugreact"]."','".$query2["congenital_disease"]."','".$query2["type"]."','".$query2["organ"]."','".$query2["doctor"]."','".$query2["ua_color"]."','".$query2["ua_appear"]."','".$query2["ua_spgr"]."','".$query2["ua_phu"]."','".$query2["ua_bloodu"]."','".$query2["ua_prou"]."','".$query2["ua_gluu"]."','".$query2["ua_ketu"]."','".$query2["ua_urobil"]."','".$query2["ua_bili"]."','".$query2["ua_nitrit"]."','".$query2["ua_wbcu"]."','".$query2["ua_rbcu"]."','".$query2["ua_epiu"]."','".$query2["ua_bactu"]."','".$query2["ua_yeast"]."','".$query2["ua_mucosu"]."','".$query2["ua_amopu"]."','".$query2["ua_castu"]."','".$query2["ua_crystu"]."','".$query2["ua_otheru"]."','".$_POST['ua']."','".$query2['reason_ua']."','".$query2["cbc_wbc"]."','".$query2['stat_wbc']."','".$query2['reason_wbc']."','".$query2["cbc_rbc"]."','".$query2["cbc_hb"]."','".$query2["cbc_hct"]."','".$query2['stat_hct']."','".$query2['reason_hct']."','".$query2["cbc_mcv"]."','".$query2["cbc_mch"]."','".$query2["cbc_mchc"]."','".$query2["cbc_pltc"]."','".$query2['stat_pltc']."','".$query2['reason_pltc']."','".$query2["cbc_plts"]."','".$query2["cbc_neu"]."','".$query2["cbc_lymp"]."','".$query2["cbc_mono"]."','".$query2["cbc_eos"]."','".$query2["cbc_baso"]."','".$query2["cbc_band"]."','".$query2["cbc_atyp"]."','".$query2["cbc_nrbc"]."','".$query2["cbc_rbcmor"]."','".$query2["cbc_other"]."','".$_POST['cbc']."','".$query2['reason_cbc']."','".$query2["cxr"]."','".$query2["reason_cxr"]."','".$query2["bs"]."','".$query2['stat_bs']."','".$query2['reason_bs']."','".$query2["bun"]."','".$_POST['check3']."','".$query2['reason_bun']."','".$query2["cr"]."','".$_POST['check3']."','".$query2['reason_cr']."','".$query2["uric"]."','".$query2['stat_uric']."','".$query2['reason_uric']."','".$query2["chol"]."','".$query2['stat_chol']."','".$query2['reason_chol']."','".$query2["tg"]."','".$query2['stat_tg']."','".$query2['reason_tg']."','".$query2["sgot"]."','".$_POST['check2']."','".$query2['reason_sgot']."','".$query2["sgpt"]."','".$_POST['check2']."','".$query2['reason_sgpt']."','".$query2["alk"]."','".$_POST['check2']."','".$query2['reason_alk']."','".$_POST['check1']."','".$query2['reason_general']."','".$query2['pap']."','".$query2['reason_pap']."','".$query2['other1']."','".$query2['stat_other1']."','".$query2['reason_other1']."','".$query2['other2']."','".$query2['stat_other2']."','".$query2['reason_other2']."','".$query2["dx"]."','".$query2['clinic']."','".$query2['cigarette']."','".$query2['alcohol']."','".$query2['summary']."','".$query2['company']."','".$query2['type_check']."','".$query2['comment']."','".$query2['hear500R']."','".$query2['hear500L']."','".$query2['hear1000R']."','".$query2['hear1000L']."','".$query2['hear2000R']."','".$query2['hear2000L']."','".$query2['hear3000R']."','".$query2['hear3000L']."','".$query2['hear4000R']."','".$query2['hear4000L']."','".$query2['hear6000R']."','".$query2['hear6000L']."','".$query2['hear8000R']."','".$query2['hear8000L']."','".$query2['LowRight']."','".$query2['LowLeft']."','".$query2['HighRight']."','".$query2['HighLeft']."','".$query2['ptaRight1']."','".$query2['ptaRight2']."','".$query2['ptaLeft1']."','".$query2['ptaLeft2']."','".$query2['FVC1']."','".$query2['FVC2']."','".$query2['FVC3']."','".$query2['FEV1']."','".$query2['FEV2']."','".$query2['FEV3']."','".$query2['RO1']."','".$query2['RO2']."','".$query2['RO3']."','".$query2['PEF1']."','".$query2['PEF2']."','".$query2['PEF3']."','".$query2['reason_chest']."','".$_POST['check12']."','".$query2['lead']."','".$_POST['check4']."','".$query2['cadmium']."','".$_POST['check5']."','".$query2['chromium']."','".$_POST['check6']."','".$query2['arsenic']."','".$_POST['check7']."','".$query2['mercury']."','".$_POST['check8']."','".$query2['copper']."','".$_POST['check9']."','".$query2['nickel']."','".$_POST['check10']."','".$query2['antimony']."','".$_POST['check11']."','N')";
}
//echo $sql;
	//exit();
$result = mysql_query($sql) or die(mysql_error());


if($result){
	echo "<CENTER>บันทึกข้อมูลเรียบร้อยแล้ว</CENTER>";
}elseif($result && isset($_POST["submit2"])){
	
	

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