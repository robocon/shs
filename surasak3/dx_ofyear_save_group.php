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
	opener.location.href = 'dx_ofyear_group.php';
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
	
	
	$sql2 = "select * from dxofyear where hn='".$_POST['hn']."' order by row_id desc limit 1";
	$row2 = mysql_query($sql2);
	$query2 = mysql_fetch_array($row2);
	if($_POST['check1']=="ปกติ")  $_POST["reasoncxr"]=="";
	
	$ht = $query2["height"]/100;
    $bmi = number_format($query2["weight"]/($ht*$ht),2);
	
if(isset($_POST['submit'])){
	$sql = "Update `predxofyear` set `hear500L` = '".$_POST["left1"]."' ,`hear500R` = '".$_POST["right1"]."' ,`hear1000L` = '".$_POST["left2"]."' ,`hear1000R` = '".$_POST["right2"]."' ,`hear2000L` = '".$_POST["left3"]."' ,`hear2000R` = '".$_POST["right3"]."' ,`hear3000L` = '".$_POST["left4"]."' ,`hear3000R` = '".$_POST["right4"]."' ,`hear4000L` = '".$_POST["left5"]."' ,`hear4000R` = '".$_POST["right5"]."' ,`hear6000L` ='".$_POST["left6"]."' , `hear6000R` ='".$_POST["right6"]."', `hear8000L` ='".$_POST["left7"]."', `hear8000R` ='".$_POST["right7"]."', `LowRight` ='".$_POST["tone1"]."', `LowLeft` ='".$_POST["tone2"]."', `HighRight` ='".$_POST["tone3"]."', `HighLeft` ='".$_POST["tone4"]."', `ptaRight1` ='".$_POST["pta1"]."', `ptaRight2` ='".$_POST["pta3"]."', `ptaLeft1` ='".$_POST["pta2"]."', `ptaLeft2` ='".$_POST["pta4"]."',`age` ='".$query2["age"]."', `camp` ='".$query2["camp"]."', `height` ='".$query2["height"]."', `weight` ='".$query2["weight"]."', `temperature` ='".$query2["temperature"]."', `pause` ='".$query2["pause"]."', `rate` ='".$query2["rate"]."', `bmi` ='".$bmi."', `bp1` ='".$query2["bp1"]."', `bp2` ='".$query2["bp2"]."', `congenital_disease` ='".$query2["congenital_disease"]."', `sgot` ='".$query2["sgot"]."', `sgpt` ='".$query2["sgpt"]."', `alk` ='".$query2["alk"]."', `cigarette` ='".$query2["cigarette"]."', `alcohol` ='".$query2["alcohol"]."', `thidate` ='".$query2["thidate"]."', `thdatehn` ='".$query2["thdatehn"]."', `thdatevn` ='".$query2["thdatevn"]."', `reason_cxr` ='".$_POST["reasoncxr"]."', `ua_color` ='".$_POST["ua_color"]."', `ua_appear` ='".$_POST["ua_appear"]."', `ua_spgr` ='".$_POST["ua_spgr"]."', `ua_phu` ='".$_POST["ua_phu"]."', `ua_bloodu` ='".$_POST["ua_bloodu"]."', `ua_prou` ='".$_POST["ua_prou"]."', `ua_gluu` ='".$_POST["ua_gluu"]."', `ua_ketu` ='".$_POST["ua_ketu"]."', `ua_urobil` ='".$_POST["ua_urobil"]."', `ua_bili` ='".$_POST["ua_bili"]."', `ua_nitrit` ='".$_POST["ua_nitrit"]."', `ua_wbcu` ='".$_POST["ua_wbcu"]."', `ua_rbcu` ='".$_POST["ua_rbcu"]."', `ua_epiu` ='".$_POST["ua_epiu"]."', `ua_bactu` ='".$_POST["ua_bactu"]."', `ua_yeast` ='".$_POST["ua_yeast"]."', `ua_mucosu` ='".$_POST["ua_mucosu"]."', `ua_amopu` ='".$_POST["ua_amopu"]."', `ua_castu` ='".$_POST["ua_castu"]."', `ua_crystu` ='".$_POST["ua_crystu"]."', `ua_otheru` ='".$_POST["ua_otheru"]."', `cbc_wbc` ='".$_POST["cbc_wbc"]."', `cbc_rbc` ='".$_POST["cbc_rbc"]."', `cbc_hb` ='".$_POST["cbc_hb"]."', `cbc_hct` ='".$_POST["cbc_hct"]."', `cbc_mcv` ='".$_POST["cbc_mcv"]."', `cbc_mch` ='".$_POST["cbc_mch"]."', `cbc_mchc` ='".$_POST["cbc_mchc"]."', `cbc_pltc` ='".$_POST["cbc_pltc"]."', `cbc_plts` ='".$_POST["cbc_plts"]."', `cbc_neu` ='".$_POST["cbc_neu"]."', `cbc_lymp` ='".$_POST["cbc_lymp"]."', `cbc_mono` ='".$_POST["cbc_mono"]."', `cbc_eos` ='".$_POST["cbc_eos"]."', `cbc_baso` ='".$_POST["cbc_baso"]."', `cbc_band` ='".$_POST["cbc_band"]."', `cbc_atyp` ='".$_POST["cbc_atyp"]."', `cbc_nrbc` ='".$_POST["cbc_nrbc"]."', `cbc_rbcmor` ='".$_POST["cbc_rbcmor"]."', `cbc_other` ='".$_POST["cbc_other"]."', `bs` ='".$_POST["bs"]."', `bun` ='".$_POST["bun"]."', `cr` ='".$_POST["cr"]."', `uric` ='".$_POST["uric"]."', `chol` ='".$_POST["chol"]."', `tg` ='".$_POST["tg"]."', `FVC1` ='".$_POST["FVC1"]."', `FVC2` ='".$_POST["FVC2"]."', `FVC3` ='".$_POST["FVC3"]."', `FEV1` ='".$_POST["FEV1"]."', `FEV2` ='".$_POST["FEV2"]."', `FEV3` ='".$_POST["FEV3"]."', `RO1` ='".$_POST["RO1"]."', `RO2` ='".$_POST["RO2"]."', `RO3` ='".$_POST["RO3"]."', `PEF1` ='".$_POST["PEF1"]."', `PEF2` ='".$_POST["PEF2"]."', `PEF3` ='".$_POST["PEF3"]."', `reason_chest` ='".$_POST["reason"]."',lead='".$_POST['lead']."',cadmium='".$_POST['cadmium']."',chromium='".$_POST['chromium']."',arsenic='".$_POST['arsenic']."',mercury='".$_POST['mercury']."',copper='".$_POST['copper']."',nickel='".$_POST['nickel']."',antimony='".$_POST['antimony']."' where `row_id` = '".$_POST["row_id"]."'  limit 1";
	/*$sql = "Update `predxofyear` set `hear500L` = '".$_POST["left1"]."' ,`hear500R` = '".$_POST["right1"]."' ,`hear1000L` = '".$_POST["left2"]."' ,`hear1000R` = '".$_POST["right2"]."' ,`hear2000L` = '".$_POST["left3"]."' ,`hear2000R` = '".$_POST["right3"]."' ,`hear3000L` = '".$_POST["left4"]."' ,`hear3000R` = '".$_POST["right4"]."' ,`hear4000L` = '".$_POST["left5"]."' ,`hear4000R` = '".$_POST["right5"]."' ,`hear6000L` ='".$_POST["left6"]."' , `hear6000R` ='".$_POST["right6"]."', `hear8000L` ='".$_POST["left7"]."', `hear8000R` ='".$_POST["right7"]."', `LowRight` ='".$_POST["tone1"]."', `LowLeft` ='".$_POST["tone2"]."', `HighRight` ='".$_POST["tone3"]."', `HighLeft` ='".$_POST["tone4"]."', `ptaRight1` ='".$_POST["pta1"]."', `ptaRight2` ='".$_POST["pta3"]."', `ptaLeft1` ='".$_POST["pta2"]."', `ptaLeft2` ='".$_POST["pta4"]."', `FVC` ='".$_POST["FVC"]."', `FEV1` ='".$_POST["FEV1"]."', `RO` ='".$_POST["RO"]."', `PEF` ='".$_POST["PEF"]."', `age` ='".$query2["age"]."', `camp` ='".$query2["camp"]."', `height` ='".$query2["height"]."', `weight` ='".$query2["weight"]."', `temperature` ='".$query2["temperature"]."', `pause` ='".$query2["pause"]."', `rate` ='".$query2["rate"]."', `bmi` ='".$bmi."', `bp1` ='".$query2["bp1"]."', `bp2` ='".$query2["bp2"]."', `congenital_disease` ='".$query2["congenital_disease"]."', `sgot` ='".$query2["sgot"]."', `sgpt` ='".$query2["sgpt"]."', `alk` ='".$query2["alk"]."', `cigarette` ='".$query2["cigarette"]."', `alcohol` ='".$query2["alcohol"]."', `thidate` ='".$query2["thidate"]."', `thdatehn` ='".$query2["thdatehn"]."', `thdatevn` ='".$query2["thdatevn"]."', `cxr` ='".$_POST["check1"]."' where `row_id` = '".$_POST["row_id"]."'  limit 1"; , `type_check`='".$_POST['typenew']."'*/
}///////////////////////////////////////////
elseif(isset($_POST['submit1'])){
	$sql= "INSERT INTO  `condxofyear` (`thidate` ,  `thdatehn` ,  `thdatevn` ,  `hn` ,  `vn` ,  `ptname` ,  `age` ,  `camp` ,  `camp_until` ,  `height` ,  `weight` ,  `round_` , `temperature` ,  `pause` ,  `rate` ,  `bmi` ,  `bp1` ,  `bp2` ,  `drugreact` ,  `congenital_disease` ,  `type` ,  `organ` ,  `doctor` ,  `ua_color` ,  `ua_appear` ,  `ua_spgr` ,  `ua_phu` , `ua_bloodu` ,  `ua_prou` ,  `ua_gluu` ,  `ua_ketu` ,  `ua_urobil` ,  `ua_bili` ,  `ua_nitrit` ,  `ua_wbcu` ,  `ua_rbcu` ,  `ua_epiu` ,  `ua_bactu` ,  `ua_yeast` ,  `ua_mucosu` ,  `ua_amopu` , `ua_castu` ,  `ua_crystu` ,  `ua_otheru` ,  `stat_ua` ,  `reason_ua` ,  `cbc_wbc` ,  `stat_wbc` ,  `reason_wbc` ,  `cbc_rbc` ,  `cbc_hb` ,  `cbc_hct` ,  `stat_hct` ,  `reason_hct` ,  `cbc_mcv` ,  `cbc_mch` ,  `cbc_mchc` ,  `cbc_pltc` ,  `stat_pltc` ,  `reason_pltc` ,  `cbc_plts` ,  `cbc_neu` ,  `cbc_lymp` ,  `cbc_mono` ,  `cbc_eos` ,  `cbc_baso` ,  `cbc_band` ,  `cbc_atyp` , `cbc_nrbc` ,  `cbc_rbcmor` ,  `cbc_other` ,  `stat_cbc` ,  `reason_cbc` ,  `cxr` ,  `reason_cxr` ,  `bs` ,  `stat_bs` ,  `reason_bs` ,  `bun` ,  `stat_bun` ,  `reason_bun` ,  `cr` ,  `stat_cr` , `reason_cr` ,  `uric` ,  `stat_uric` ,  `reason_uric` ,  `chol` ,  `stat_chol` ,  `reason_chol` ,  `tg` ,  `stat_tg` ,  `reason_tg` ,  `sgot` ,  `stat_sgot` ,  `reason_sgot` ,  `sgpt` ,  `stat_sgpt` , `reason_sgpt` ,  `alk` ,  `stat_alk` ,  `reason_alk` ,  `general` ,  `reason_general` ,  `pap` ,  `reason_pap` ,  `other1` ,  `stat_other1` ,  `reason_other1` ,  `other2` ,  `stat_other2` , `reason_other2` ,  `dx` ,  `clinic` ,  `cigarette` ,  `alcohol` ,  `summary` ,  `company` ,  `type_check` ,  `comment` ,  `hear500L` ,  `hear500R` ,  `hear1000L` ,  `hear1000R` ,  `hear2000L` , `hear2000R` ,  `hear3000L` ,  `hear3000R` ,  `hear4000L` ,  `hear4000R` ,  `hear6000L` ,  `hear6000R` ,  `hear8000L` ,  `hear8000R` ,  `LowRight`,  `LowLeft`,  `HighRight`,  `HighLeft`,  `ptaRight1`,  `ptaRight2`,  `ptaLeft1`,  `ptaLeft2` ,  `FVC` ,  `FEV1` ,  `RO` ,  `PEF` ,  `lead` ,  `resultlead` , `cadmium` ,  `resultcadmium` ,  `chromium` ,  `resultchromium` ,  `arsenic` ,  `resultarsenic` ,  `mercury` ,  `resultmercury` ,  `copper` ,  `resultcopper` ,  `nickel` ,  `resultnickel` , `antimony` ,  `resultantimony` ) values('".$query2["thidate"]."','".$query2["thdatehn"]."','".$query2["thdatevn"]."','".$query2["hn"]."','".$query2["vn"]."','".$query2["ptname"]."','".$query2["age"]."','".$query2["camp"]."','".$query2["camp_until"]."','".$query2["height"]."','".$query2["weight"]."','".$query2["round_"]."','".$query2["temperature"]."','".$query2["pause"]."','".$query2["rate"]."','".$bmi."','".$query2["bp1"]."','".$query2["bp2"]."','".$query2["drugreact"]."','".$query2["congenital_disease"]."','".$query2["type"]."','".$query2["organ"]."','".$query2["doctor"]."','".$_POST["ua_color"]."','".$_POST["ua_appear"]."','".$_POST["ua_spgr"]."','".$_POST["ua_phu"]."','".$_POST["ua_bloodu"]."','".$_POST["ua_prou"]."','".$_POST["ua_gluu"]."','".$_POST["ua_ketu"]."','".$_POST["ua_urobil"]."','".$_POST["ua_bili"]."','".$_POST["ua_nitrit"]."','".$_POST["ua_wbcu"]."','".$_POST["ua_rbcu"]."','".$_POST["ua_epiu"]."','".$_POST["ua_bactu"]."','".$_POST["ua_yeast"]."','".$_POST["ua_mucosu"]."','".$_POST["ua_amopu"]."','".$_POST["ua_castu"]."','".$_POST["ua_crystu"]."','".$_POST["ua_otheru"]."','".$_POST['stat_ua']."','".$_POST['reason_ua']."','".$_POST["cbc_wbc"]."','".$_POST['stat_wbc']."','".$_POST['reason_wbc']."','".$_POST["cbc_rbc"]."','".$_POST["cbc_hb"]."','".$_POST["cbc_hct"]."','".$_POST['stat_hct']."','".$_POST['reason_hct']."','".$_POST["cbc_mcv"]."','".$_POST["cbc_mch"]."','".$_POST["cbc_mchc"]."','".$_POST["cbc_pltc"]."','".$_POST['stat_pltc']."','".$_POST['reason_pltc']."','".$_POST["cbc_plts"]."','".$_POST["cbc_neu"]."','".$_POST["cbc_lymp"]."','".$_POST["cbc_mono"]."','".$_POST["cbc_eos"]."','".$_POST["cbc_baso"]."','".$_POST["cbc_band"]."','".$_POST["cbc_atyp"]."','".$_POST["cbc_nrbc"]."','".$_POST["cbc_rbcmor"]."','".$_POST["cbc_other"]."','".$_POST['stat_cbc']."','".$_POST['reason_cbc']."','".$_POST["cxr"]."','".$_POST["reason_cxr"]."','".$_POST["bs"]."','".$_POST['stat_bs']."','".$_POST['reason_bs']."','".$_POST["bun"]."','".$_POST['stat_bun']."','".$_POST['reason_bun']."','".$_POST["cr"]."','".$_POST['stat_cr']."','".$_POST['reason_cr']."','".$_POST["uric"]."','".$_POST['stat_uric']."','".$_POST['reason_uric']."','".$_POST["chol"]."','".$_POST['stat_chol']."','".$_POST['reason_chol']."','".$_POST["tg"]."','".$_POST['stat_tg']."','".$_POST['reason_tg']."','".$_POST["sgot"]."','".$_POST['stat_sgot']."','".$_POST['reason_sgot']."','".$_POST["sgpt"]."','".$_POST['stat_sgpt']."','".$_POST['reason_sgpt']."','".$_POST["alk"]."','".$_POST['stat_alk']."','".$_POST['reason_alk']."','".$_POST['general']."','".$_POST['reason_general']."','".$_POST['pap']."','".$_POST['reason_pap']."','".$_POST['other1']."','".$_POST['stat_other1']."','".$_POST['reason_other1']."','".$_POST['other2']."','".$_POST['stat_other2']."','".$_POST['reason_other2']."','".$_POST["dx"]."','".$_POST['clinic']."','".$_POST['cigarette']."','".$_POST['alcohol']."','".$_POST['summary']."','".$_POST['company']."','".$_POST['type_check']."','".$_POST['comment']."','".$_POST['left1']."','".$_POST['right1']."','".$_POST['left2']."','".$_POST['right2']."','".$_POST['left3']."','".$_POST['right3']."','".$_POST['left4']."','".$_POST['right4']."','".$_POST['left5']."','".$_POST['right5']."','".$_POST['left6']."','".$_POST['right6']."','".$_POST['left7']."','".$_POST['right7']."','".$_POST['tone1']."','".$_POST['tone2']."','".$_POST['tone3']."','".$_POST['tone4']."','".$_POST['pta1']."','".$_POST['pta3']."','".$_POST['pta2']."','".$_POST['pta4']."','".$_POST['FVC']."','".$_POST['FEV1']."','".$_POST['RO']."','".$_POST['PEF']."','".$_POST['lead']."','".$_POST['resultlead']."','".$_POST['cadmium']."','".$_POST['resultcadmium']."','".$_POST['chromium']."','".$_POST['resultchromium']."','".$_POST['arsenic']."','".$_POST['resultarsenic']."','".$_POST['mercury']."','".$_POST['resultmercury']."','".$_POST['copper']."','".$_POST['resultcopper']."','".$_POST['nickel']."','".$_POST['resultnickel']."','".$_POST['antimony']."','".$_POST['resultantimony']."')";
}
//echo $sql;
	//exit();
$result = mysql_query($sql) or die(mysql_error());


if($result){
	echo "<CENTER>บันทึกข้อมูลเรียบร้อยแล้ว</CENTER>";
}elseif($result && isset($_POST["submit1"])){
	
	

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