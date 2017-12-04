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
	//opener.location.href = 'dxdr_ofyear.php';
	//window.print();
	//window.close();
}
</script>
<?php

$sql = "Select count(row_id) From opd where thdatehn = '".$date_hn."' limit 1";
	$result = Mysql_Query($sql);
	list($rows) = Mysql_fetch_row($result);
	
	if($rows > 0){

$sql = "Update `opd` set  `thidate` = '".$thidate_now."', `temperature`  = '".$_POST["temperature"]."', `pause`  = '".$_POST["pause"]."', `rate`  = '".$_POST["rate"]."', `weight`  = '".$_POST["weight"]."', `bp1`  = '".$_POST["bp1"]."', `bp2`  = '".$_POST["bp2"]."', `drugreact`  = '".$_POST["drugreact"]."', `congenital_disease`  = '".$_POST["congenital_disease"]."', `type`  = '".$_POST["type"]."', `organ`  = '".$_POST["organ"]."', `doctor` = '".$_POST["doctor"]."',  `officer` = '".$_SESSION["sOfficer"]."' ,  `dc_diag` = Null, `vn`= '".$_POST["vn"]."', `toborow` = '".$_POST["toborow"]."', `height` = '".$_POST["height"]."' , `clinic`  = '".$_POST["clinic"]."' , `cigarette`= '".$_POST["cigarette"]."', `alcohol`= '".$_POST["alcohol"]."' where  `thdatehn` = '".$thidatehn."' limit 1 ";
mysql_query($sql);


	}else{

$sql = "INSERT INTO `opd` (`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`temperature` ,`pause` ,`rate` ,`weight` ,`bp1`  ,`bp2` ,`drugreact` ,`congenital_disease` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , `toborow`, `height`, `clinic`, `cigarette`, `alcohol`)VALUES (NULL , '".$thidate_now."', '".$date_hn2."', '".$_POST["hn"]."', '".$_POST["ptname"]."', '".$_POST["temperature"]."', '".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', '".$_POST["bp2"]."', '".$_POST["drugreact"]."', '".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".$_POST["organ"]."', '".$_POST["doctor"]."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', '".$_POST["toborow"]."', '".$_POST["height"]."', '".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."' );";
//mysql_query($sql);
}

$sql = "Select count(row_id) From  `dxofyear` where `thdatehn` = '{$date_hn}' limit 0,1 ";
list($count) = mysql_fetch_row(mysql_query($sql));

if(isset($_POST["row_id"]) && $_POST["row_id"] != ""){
	if($_POST['normal']=="ผิดปกติ") $_POST['ch']=$_POST['ch']; else $_POST['ch']="";
	if($_POST['normal11']=="ผิดปกติ") $_POST['ch11']=$_POST['ch11']; else $_POST['ch11']="";
	if($_POST['normal1']=="ผิดปกติ") $_POST['ch1']=$_POST['ch1']; else $_POST['ch1']="";
	if($_POST['normal2']=="ผิดปกติ") $_POST['ch2']=$_POST['ch2']; else $_POST['ch2']="";
	if($_POST['normal3']=="ผิดปกติ") $_POST['ch3']=$_POST['ch3']; else $_POST['ch3']="";
	if($_POST['normal4']=="ผิดปกติ") $_POST['ch4']=$_POST['ch4']; else $_POST['ch4']="";
	if($_POST['normal5']=="ผิดปกติ") $_POST['ch5']=$_POST['ch5']; else $_POST['ch5']="";
	if($_POST['normal6']=="ผิดปกติ") $_POST['ch6']=$_POST['ch6']; else $_POST['ch6']="";
	if($_POST['normal7']=="ผิดปกติ") $_POST['ch7']=$_POST['ch7']; else $_POST['ch7']="";
	if($_POST['normal8']=="ผิดปกติ") $_POST['ch8']=$_POST['ch8']; else $_POST['ch8']="";
	if($_POST['normal9']=="ผิดปกติ") $_POST['ch9']=$_POST['ch9']; else $_POST['ch9']="";
	if($_POST['normal21']=="ผิดปกติ") $_POST['ch21']=$_POST['ch21']; else $_POST['ch21']="";
	if($_POST['normal22']=="ผิดปกติ") $_POST['ch22']=$_POST['ch22']; else $_POST['ch22']="";
	if($_POST['normal23']=="ผิดปกติ") $_POST['ch23']=$_POST['ch23']; else $_POST['ch23']="";
	if($_POST['normal24']=="ผิดปกติ") $_POST['ch24']=$_POST['ch24']; else $_POST['ch24']="";
	if($_POST['normal25']=="ผิดปกติ") $_POST['ch25']=$_POST['ch25']; else $_POST['ch25']="";
	if($_POST['normal26']=="ผิดปกติ") $_POST['ch26']=$_POST['ch26']; else $_POST['ch26']="";
	
	$sql = "Update `dxofyear` set `thidate` = '".$date_now."' ,`thdatehn` = '".$date_hn."' ,`thdatevn` = '".$date_vn."' ,`vn` = '".$_POST["vn"]."' ,`ptname` = '".$_POST["ptname"]."' ,`age` = '".$_POST["age"]."' ,`camp` = '".$_POST["camp"]."' ,`camp_until` = '".$_POST["camp_until"]."' ,`height` = '".$_POST["height"]."' ,`weight` = '".$_POST["weight"]."' ,`round_` = '".$_POST["round_"]."' ,`temperature` = '".$_POST["temperature"]."' ,`pause` = '".$_POST["pause"]."' ,`rate` = '".$_POST["rate"]."' ,`bmi` = '".$_POST["bmi"]."' ,`bp1` = '".$_POST["bp1"]."' ,`bp2` = '".$_POST["bp2"]."' ,`ua_color` = '".$_POST["ua_color"]."' ,`ua_appear` = '".$_POST["ua_appear"]."' ,`ua_spgr` = '".$_POST["ua_spgr"]."' ,`ua_phu` = '".$_POST["ua_phu"]."' ,`ua_bloodu` = '".$_POST["ua_bloodu"]."' ,`ua_prou` = '".$_POST["ua_prou"]."' ,`ua_gluu` = '".$_POST["ua_gluu"]."' ,`ua_ketu` = '".$_POST["ua_ketu"]."' ,`ua_urobil` = '".$_POST["ua_urobil"]."' ,`ua_bili` = '".$_POST["ua_bili"]."' ,`ua_nitrit` = '".$_POST["ua_nitrit"]."' ,`ua_wbcu` = '".$_POST["ua_wbcu"]."' ,`ua_rbcu` = '".$_POST["ua_rbcu"]."' ,`ua_epiu` = '".$_POST["ua_epiu"]."' ,`ua_bactu` = '".$_POST["ua_bactu"]."' ,`ua_yeast` = '".$_POST["ua_yeast"]."' ,`ua_mucosu` = '".$_POST["ua_mucosu"]."' ,`ua_amopu` = '".$_POST["ua_amopu"]."' ,`ua_castu` = '".$_POST["ua_castu"]."' ,`ua_crystu` = '".$_POST["ua_crystu"]."' ,`ua_otheru` = '".$_POST["ua_otheru"]."' ,`cbc_wbc` = '".$_POST["cbc_wbc"]."' ,`cbc_rbc` = '".$_POST["cbc_rbc"]."' ,`cbc_hb` = '".$_POST["cbc_hb"]."' ,`cbc_hct` = '".$_POST["cbc_hct"]."' ,`cbc_mcv` = '".$_POST["cbc_mcv"]."' ,`cbc_mch` = '".$_POST["cbc_mch"]."' ,`cbc_mchc` = '".$_POST["cbc_mchc"]."' ,`cbc_pltc` = '".$_POST["cbc_pltc"]."' ,`cbc_plts` = '".$_POST["cbc_plts"]."' ,`cbc_neu` = '".$_POST["cbc_neu"]."' ,`cbc_lymp` = '".$_POST["cbc_lymp"]."' ,`cbc_mono` = '".$_POST["cbc_mono"]."' ,`cbc_eos` = '".$_POST["cbc_eos"]."' ,`cbc_baso` = '".$_POST["cbc_baso"]."' ,`cbc_band` = '".$_POST["cbc_band"]."' ,`cbc_atyp` = '".$_POST["cbc_atyp"]."' ,`cbc_nrbc` = '".$_POST["cbc_nrbc"]."' ,`cbc_rbcmor` = '".$_POST["cbc_rbcmor"]."' ,`cbc_other` = '".$_POST["cbc_other"]."' ,`cxr` = '".$_POST["cxr"]."' ,`bs` = '".$_POST["bs"]."' ,`bun` = '".$_POST["bun"]."' ,`cr` = '".$_POST["cr"]."' ,`uric` = '".$_POST["uric"]."' ,`chol` = '".$_POST["chol"]."' ,`tg` = '".$_POST["tg"]."' ,`sgot` = '".$_POST["sgot"]."' ,`sgpt` = '".$_POST["sgpt"]."' ,`alk` = '".$_POST["alk"]."' ,`dx` = '".$_POST["dx"]."',  `drugreact` ='".$_POST["drugreact"]."' , `cigarette` ='".$_POST["cigarette"]."'  , `alcohol` ='".$_POST["alcohol"]."'  , `congenital_disease` ='".$_POST["congenital_disease"]."'  , `type` ='".$_POST["type"]."'  , `organ` ='".$_POST["organ"]."'  , `clinic` ='".$_POST["clinic"]."'  , `doctor` ='".$_POST["doctor"]."', `hn` ='".$_POST["hn"]."'   where `row_id` = '".$_POST["row_id"]."' , `stat_ua` ='".$_POST["normal"]."' , `stat_cbc` ='".$_POST["normal11"]."' , `stat_alk` ='".$_POST["normal1"]."' , `stat_sgpt` ='".$_POST["normal2"]."' , `stat_sgot` ='".$_POST["normal3"]."' , `stat_bun` ='".$_POST["normal4"]."' , `stat_chol` ='".$_POST["normal5"]."' , `stat_cr` ='".$_POST["normal6"]."' , `stat_bs` ='".$_POST["normal7"]."' , `stat_tg` ='".$_POST["normal8"]."' , `stat_uric` ='".$_POST["normal9"]."' , `reason_ua` ='".$_POST["ch"]."' , `reason_cbc` ='".$_POST["ch11"]."' , `reason_bs` ='".$_POST["ch1"]."' , `reason_bun` ='".$_POST["ch2"]."' , `reason_cr` ='".$_POST["ch3"]."' , `reason_uric` ='".$_POST["ch4"]."' , `reason_chol` ='".$_POST["ch5"]."' , `reason_tg` ='".$_POST["ch6"]."' , `reason_sgot` ='".$_POST["ch7"]."' , `reason_sgpt` ='".$_POST["ch8"]."' , `reason_alk` ='".$_POST["ch9"]."' , `general` ='".$_POST["normal21"]."' , `cxr` ='".$_POST["normal22"]."' , `pap` ='".$_POST["normal23"]."' , `stat_other1` ='".$_POST["normal24"]."' , `stat_other2` ='".$_POST["normal25"]."' , `reason_general` ='".$_POST["ch21"]."' , `reason_cxr` ='".$_POST["ch22"]."' , `reason_pap` ='".$_POST["ch23"]."' , `reason_other1` ='".$_POST["ch24"]."' , `reason_other2` ='".$_POST["ch25"]."' , `other1` ='".$_POST["other1"]."' , `other2` ='".$_POST["other2"]."' , `summary` ='".$_POST["normal26"]."' limit 1";
	echo $sql;
	//exit();
}else{
	$sql = "INSERT INTO `dxofyear` ( `thidate`, `thdatehn`, `thdatevn`, `hn`, `vn`, `ptname`, `age`, `camp`, `camp_until`, `height`, `weight`, `round_`, `temperature`, `pause`, `rate`, `bmi`, `bp1`, `bp2`, `drugreact` , `cigarette` , `alcohol` , `congenital_disease` , `type` , `organ` , `clinic` , `doctor` , `ua_color`, `ua_appear`, `ua_spgr`, `ua_phu`, `ua_bloodu`, `ua_prou`, `ua_gluu`, `ua_ketu`, `ua_urobil`, `ua_bili`, `ua_nitrit`, `ua_wbcu`, `ua_rbcu`, `ua_epiu`, `ua_bactu`, `ua_yeast`, `ua_mucosu`, `ua_amopu`, `ua_castu`, `ua_crystu`, `ua_otheru`, `cbc_wbc`, `cbc_rbc`, `cbc_hb`, `cbc_hct`, `cbc_mcv`, `cbc_mch`, `cbc_mchc`, `cbc_pltc`, `cbc_plts`, `cbc_neu`, `cbc_lymp`, `cbc_mono`, `cbc_eos`, `cbc_baso`, `cbc_band`, `cbc_atyp`, `cbc_nrbc`, `cbc_rbcmor`, `cbc_other`, `cxr`, `bs`, `bun`, `cr`, `uric`, `chol`, `tg`, `sgot`, `sgpt`, `alk`, `dx`) VALUES ('".$date_now."','".$date_hn."','".$date_vn."','".$_POST["hn"]."','".$_POST["vn"]."','".$_POST["ptname"]."','".$_POST["age"]."','".$_POST["camp"]."','".$_POST["camp_until"]."','".$_POST["height"]."','".$_POST["weight"]."','".$_POST["round_"]."','".$_POST["temperature"]."','".$_POST["pause"]."','".$_POST["rate"]."','".$_POST["bmi"]."','".$_POST["bp1"]."','".$_POST["bp2"]."','".$_POST["drugreact"]."','".$_POST["cigarette"]."','".$_POST["alcohol"]."','".$_POST["congenital_disease"]."','".$_POST["type"]."','".$_POST["organ"]."','".$_POST["clinic"]."','".$_POST["doctor"]."','".$_POST["ua_color"]."','".$_POST["ua_appear"]."','".$_POST["ua_spgr"]."','".$_POST["ua_phu"]."','".$_POST["ua_bloodu"]."','".$_POST["ua_prou"]."','".$_POST["ua_gluu"]."','".$_POST["ua_ketu"]."','".$_POST["ua_urobil"]."','".$_POST["ua_bili"]."','".$_POST["ua_nitrit"]."','".$_POST["ua_wbcu"]."','".$_POST["ua_rbcu"]."','".$_POST["ua_epiu"]."','".$_POST["ua_bactu"]."','".$_POST["ua_yeast"]."','".$_POST["ua_mucosu"]."','".$_POST["ua_amopu"]."','".$_POST["ua_castu"]."','".$_POST["ua_crystu"]."','".$_POST["ua_otheru"]."','".$_POST["cbc_wbc"]."','".$_POST["cbc_rbc"]."','".$_POST["cbc_hb"]."','".$_POST["cbc_hct"]."','".$_POST["cbc_mcv"]."','".$_POST["cbc_mch"]."','".$_POST["cbc_mchc"]."','".$_POST["cbc_pltc"]."','".$_POST["cbc_plts"]."','".$_POST["cbc_neu"]."','".$_POST["cbc_lymp"]."','".$_POST["cbc_mono"]."','".$_POST["cbc_eos"]."','".$_POST["cbc_baso"]."','".$_POST["cbc_band"]."','".$_POST["cbc_atyp"]."','".$_POST["cbc_nrbc"]."','".$_POST["cbc_rbcmor"]."','".$_POST["cbc_other"]."','".$_POST["cxr"]."','".$_POST["bs"]."','".$_POST["bun"]."','".$_POST["cr"]."','".$_POST["uric"]."','".$_POST["chol"]."','".$_POST["tg"]."','".$_POST["sgot"]."','".$_POST["sgpt"]."','".$_POST["alk"]."','".$_POST["dx"]."')";
}

//$result = mysql_query($sql) or die(mysql_error());


if($result && isset($_POST["submit"])){
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