<?php
session_start();
include("connect.inc");

$date_now = date("Y-m-d H:i:s");

$yy = explode(" ",$date_now);
$xx = explode("-",$yy[0]);

$thidate_now = ($xx[0]+543)."-".$xx[1]."-".$xx[2]." ".$yy[1];

$_SESSION['other2_1'] = isset($_POST['other2_1']) ? $_POST['other2_1'] : false ;
$_SESSION['other2_1_1'] = isset($_POST['other2_1_1']) ? $_POST['other2_1_1'] : false ;

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
////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	$nPrefix ="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////

$sql1 = "Select * from  `dxofyear_out` where `row_id` ='".$_POST['row_id']."'";
$dxdr_ofyear = mysql_fetch_array(mysql_query($sql1));
$date_hn = $dxdr_ofyear["thdatehn"];
$date_hn2 = $dxdr_ofyear["thdatehn"];
$date_vn = $dxdr_ofyear["thdatevn"];

$sql = "Select count(row_id) From  `dxofyear_out` where `thdatehn` = '{$date_hn}' limit 0,1 ";
list($count) = mysql_fetch_row(mysql_query($sql));

if(isset($_POST["row_id"]) && $_POST["row_id"] != ""){
	if($_POST['normal20']=="ปกติ"|$_POST['normal20']=="") $_POST['ch20']="";
	if($_POST['normal21']=="ปกติ"|$_POST['normal21']=="") $_POST['ch21']="";
	if($_POST['normal22']=="ปกติ"|$_POST['normal22']=="") $_POST['ch22']="";
	if($_POST['normal23']=="ปกติ"|$_POST['normal23']=="") $_POST['ch23']="";
	if($_POST['normal24']=="ปกติ"|$_POST['normal24']=="") $_POST['ch24']="";
	if($_POST['normal25']=="ปกติ"|$_POST['normal25']=="") $_POST['ch25']="";
	if($_POST['normal26']=="ปกติ"|$_POST['normal26']=="") $_POST['ch26']="";
	if($_POST['normal27']=="ปกติ"|$_POST['normal27']=="") $_POST['ch27']="";
	if($_POST['normal28']=="ปกติ"|$_POST['normal28']=="") $_POST['ch28']="";
	if($_POST['normal29']=="ปกติ"|$_POST['normal29']=="") $_POST['ch29']="";
	if($_POST['normal30']=="ปกติ"|$_POST['normal30']=="") $_POST['ch30']="";
	if($_POST['normal']=="ปกติ"|$_POST['normal']=="") $_POST['ch']="";
	if($_POST['normal31']=="ปกติ"|$_POST['normal31']=="") $_POST['ch31']="";
	if($_POST['normal32']=="ปกติ"|$_POST['normal32']=="") $_POST['ch32']="";
	if($_POST['normal33']=="ปกติ"|$_POST['normal33']=="") $_POST['ch33']="";
	if($_POST['normal81']=="ปกติ"|$_POST['normal81']=="") $_POST['ch81']="";
	if($_POST['normal41']=="ปกติ"|$_POST['normal41']=="") $_POST['ch41']="";
	if($_POST['normal42']=="ปกติ"|$_POST['normal42']=="") $_POST['ch42']="";
	if($_POST['normal43']=="ปกติ"|$_POST['normal43']=="") $_POST['ch43']="";
	if($_POST['normal44']=="ปกติ"|$_POST['normal44']=="") $_POST['ch44']="";
	if($_POST['normal45']=="ปกติ"|$_POST['normal45']=="") $_POST['ch45']="";
	if($_POST['normal46']=="ปกติ"|$_POST['normal46']=="") $_POST['ch46']="";
	if($_POST['normal47']=="ปกติ"|$_POST['normal47']=="") $_POST['ch47']="";
	if($_POST['normal48']=="ปกติ"|$_POST['normal48']=="") $_POST['ch48']="";
	if($_POST['normal49']=="ปกติ"|$_POST['normal49']=="") $_POST['ch49']="";
	if($_POST['normal51']=="ปกติ"|$_POST['normal51']=="") $_POST['ch51']="";
	if($_POST['normal52']=="ปกติ"|$_POST['normal52']=="") $_POST['ch52']="";
	
	if($_POST['other1']==""){ $_POST['normal53']=""; $_POST['ch53']="";};
	if($_POST['other2']==""){ $_POST['normal54']=""; $_POST['ch54']="";};
	if($_POST['normal53']=="ปกติ"|$_POST['normal53']=="") $_POST['ch53']="";
	if($_POST['normal54']=="ปกติ"|$_POST['normal54']=="") $_POST['ch54']="";
	if($_POST['normal55']=="ปกติ"|$_POST['normal55']=="") $_POST['ch55']="";
	if($_POST['normal56']=="ปกติ"|$_POST['normal56']=="") $_POST['ch56']="";		
	
	
	$txtsm="";
	for($k=1;$k<=8;$k++){
		if($_POST['chk'.$k]!=""){
			if($k==8){
				$txtsm .= $_POST['text71'];
			}else{
				$txtsm .= $_POST['chk'.$k].",";
			}
		}
	}
	if($_POST['normal71']=="ปกติ"){
		$txtsm="";
		$_POST['text72']="";
	}elseif($_POST['normal71']=="มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)"){
		//$txtsm=$txtsm;
		$_POST['text72']="";
	}elseif($_POST['normal71']=="เป็นโรค"){
		$txtsm=$_POST['text72'];
	}
	/////เก่า
	/*if($_POST['normal61']=="ไม่พบความเสี่ยง"){ 
		$smdm ="" ;
		$smht="";
		$smstr="";
		$smobe="";
	}elseif($_POST['normal61']=="พบความเสี่ยงเบื้องต้นต่อโรค"){ 
		$smdm=$_POST['normal621'];
		$smht=$_POST['normal622'];
		$smstr=$_POST['normal623'];
		$smobe=$_POST['normal624'];
	}elseif($_POST['normal61']=="ป่วยด้วยโรคเรื้อรัง"){ 
		$smdm=$_POST['normal631'];
		$smht=$_POST['normal632'];
		$smstr=$_POST['normal633'];
		$smobe=$_POST['normal634'];
	}*/
	
	//ใหม่
	if($_POST['normal62']=="พบความเสี่ยงเบื้องต้นต่อโรค"){ 
		$rs_sum21 = $_POST['normal621'];
		$rs_sum22 = $_POST['normal622'];
		$rs_sum23 = $_POST['normal623'];
		$rs_sum24 = $_POST['normal624'];
		$rs_sum25 = $_POST['normal625'];
	}
	if($_POST['normal65']=="ป่วยด้วยโรคเรื้อรัง"){ 
		$rs_sum51 = $_POST['normal651'];
		$rs_sum52 = $_POST['normal652'];
		$rs_sum53 = $_POST['normal653'];
	}
	if($_POST['normal66']=="ผลเอ็กซเรย์"){ 
		$rs_sum61 = $_POST['normal661'];
	}
	
	

if($_POST["status"]=="1"){
	$statusdata="";
}else{
	$statusdata="n";
}	
	$sql ="INSERT INTO  `condxofyear_out` ( `thidate` ,  `thdatehn` ,  `thdatevn` ,  `hn` ,  `vn` , `ptname`  , `age` ,  `camp` ,  `camp_until` ,  `height` ,  `weight` ,  `round_` , `temperature` ,  `pause` ,  `rate` ,  `bmi` ,  `bp1` ,  `bp2` ,  `drugreact` ,`prawat` ,  `congenital_disease` ,  `type` ,  `organ` ,  `doctor` ,  `ua_color` ,  `ua_appear` ,  `ua_spgr` ,  `ua_phu` , `ua_bloodu` ,  `ua_prou` ,  `ua_gluu` ,  `ua_ketu` ,  `ua_urobil` ,  `ua_bili` ,  `ua_nitrit` ,  `ua_wbcu` ,  `ua_rbcu` ,  `ua_epiu` ,  `ua_bactu` ,  `ua_yeast` ,  `ua_mucosu` ,  `ua_amopu` , `ua_castu` ,  `ua_crystu` ,  `ua_otheru` ,  `stat_ua` ,  `reason_ua` ,  `cbc_wbc` ,  `stat_wbc` ,  `reason_wbc` ,  `wbcrange` ,  `wbcflag` ,  `cbc_rbc` ,  `cbc_hb` ,  `cbc_hct` ,  `stat_hct` , `reason_hct` ,  `hctrange` ,  `hctflag` ,  `cbc_mcv` ,  `cbc_mch` ,  `cbc_mchc` ,  `cbc_pltc` ,  `stat_pltc` ,  `reason_pltc` ,  `pltcrange` ,  `pltcflag` ,  `cbc_plts` ,  `cbc_neu` ,  `cbc_lymp` , `cbc_mono` ,  `cbc_eos` ,  `cbc_baso` ,  `cbc_band` ,  `cbc_atyp` ,  `cbc_nrbc` ,  `cbc_rbcmor` ,  `cbc_other` ,  `stat_cbc` ,  `reason_cbc` ,  `cxr` ,  `reason_cxr` ,  `bs` ,  `stat_bs` , `reason_bs` ,  `bsrange` ,  `bsflag` ,  `bun` ,  `stat_bun` ,  `reason_bun` ,  `bunrange` ,  `bunflag` ,  `cr` ,  `stat_cr` ,  `reason_cr` ,  `crrange` ,  `crflag` ,  `uric` ,  `stat_uric` , `reason_uric` ,  `uricrange` ,  `uricflag` ,  `chol` ,  `stat_chol` ,  `reason_chol` ,  `cholrange` ,  `cholflag` ,  `tg` ,  `stat_tg` ,  `reason_tg` ,  `tgrange` ,  `tgflag` ,  `sgot` ,  `stat_sgot` , `reason_sgot` ,  `sgotrange` ,  `sgotflag` ,  `sgpt` ,  `stat_sgpt` ,  `reason_sgpt` ,  `sgptrange` ,  `sgptflag` ,  `alk` ,  `stat_alk` ,  `reason_alk` ,  `alkrange` ,  `alkflag` ,  `general` , `reason_general` ,  `pap` ,  `reason_pap` ,  `other1` ,  `stat_other1` ,  `reason_other1` ,  `other2` ,  `stat_other2` ,  `reason_other2` ,  `dx` ,  `clinic` ,  `cigarette` ,  `alcohol` ,  `summary` ,  `diag` ,  `soldier1` ,  `reason_sol1` ,  `soldier2` ,  `reason_sol2` ,  `soldier3`,  `reason_sol3` ,  `soldier4`,  `reason_sol4`  ,  `soldier5`,  `reason_sol5` ,  `soldier6`,  `reason_sol6` ,  `soldier7` ,  `reason_sol7` ,  `soldier8`  ,  `reason_sol8`,  `soldier9`,  `reason_sol9` ,  `soldier10` ,  `reason_sol10` ,  `status_dr` , `yearcheck`, `sol1`, `sol2`, `sol3`, `sol4`, `sol41`, `sol5`, `sol51`, `sum1`, `sum2`, `rs_sum21`, `rs_sum22`, `rs_sum23`, `rs_sum24`, `rs_sum25`, `sum3`, `sum4`, `sum5`, `rs_sum51`, `rs_sum52`, `rs_sum53`, `sum6`, `rs_sum61`,`anemia`,`cirrhosis`,`hepatitis`,`cardiomegaly`,`allergy`,`gout`,`waistline`,`asthma`,`muscle`,`ihd`,`thyroid`,`heart`,`emphysema`,`herniated`,`conjunctivitis`,`cystitis`,`epilepsy`,`fracture`,`cardiac`,`spine`,`dermatitis`,`degeneration`,`alcoholic`,`copd`,`bph`,`kidney`,`pterygium`,`tonsil`,`paralysis`,`blood`, `conanemia`,`ht`, `stat_pressure` ,  `reason_pressure`, `stat_bmi` ,  `reason_bmi` ,  `statusdata`) 
VALUES (
'".$date_now."',  '".$date_hn."',  '".$date_vn."',  '".$dxdr_ofyear['hn']."',  '".$dxdr_ofyear['vn']."',  '".$dxdr_ofyear['ptname']."',  '".$dxdr_ofyear['age']."',  '".$dxdr_ofyear['camp']."',  '".$dxdr_ofyear['camp_until']."',  '".$dxdr_ofyear['height']."',  '".$dxdr_ofyear['weight']."',  '".$dxdr_ofyear['round_']."',  '".$dxdr_ofyear['temperature']."',  '".$dxdr_ofyear['pause']."',  '".$dxdr_ofyear['rate']."',  '".$_POST['bmi']."',  '".$dxdr_ofyear['bp1']."',  '".$dxdr_ofyear['bp2']."',  '".$dxdr_ofyear['drugreact']."',  '".$dxdr_ofyear['prawat']."',  '".$dxdr_ofyear['congenital_disease']."',  '".$dxdr_ofyear['type']."',  '".$dxdr_ofyear['organ']."',  '".$_POST['doctorn']."',  '".$dxdr_ofyear['ua_color']."',  '".$dxdr_ofyear['ua_appear']."',  '".$dxdr_ofyear['ua_spgr']."',  '".$dxdr_ofyear['ua_phu']."',  '".$dxdr_ofyear['ua_bloodu']."',  '".$dxdr_ofyear['ua_prou']."',  '".$dxdr_ofyear['ua_gluu']."',  '".$dxdr_ofyear['ua_ketu']."',  '".$dxdr_ofyear['ua_urobil']."',  '".$dxdr_ofyear['ua_bili']."',  '".$dxdr_ofyear['ua_nitrit']."',  '".$dxdr_ofyear['ua_wbcu']."',  '".$dxdr_ofyear['ua_rbcu']."',  '".$dxdr_ofyear['ua_epiu']."',  '".$dxdr_ofyear['ua_bactu']."',  '".$dxdr_ofyear['ua_yeast']."',  '".$dxdr_ofyear['ua_mucosu']."',  '".$dxdr_ofyear['ua_amopu']."',  '".$dxdr_ofyear['ua_castu']."',  '".$dxdr_ofyear['ua_crystu']."',  '".$dxdr_ofyear['ua_otheru']."',  '".$_POST['normal']."',  '".$_POST['ch']."',  '".$dxdr_ofyear['cbc_wbc']."',  '".$_POST['normal32']."',  '".$_POST['ch32']."',  '".$dxdr_ofyear['wbcrange']."',  '".$dxdr_ofyear['wbcflag']."', '".$dxdr_ofyear['cbc_rbc']."',  '".$dxdr_ofyear['cbc_hb']."',  '".$dxdr_ofyear['cbc_hct']."',  '".$_POST['normal31']."',  '".$_POST['ch31']."',  '".$dxdr_ofyear['hctrange']."',  '".$dxdr_ofyear['hctflag']."',  '".$dxdr_ofyear['cbc_mcv']."',  '".$dxdr_ofyear['cbc_mch']."',  '".$dxdr_ofyear['cbc_mchc']."',  '".$dxdr_ofyear['cbc_pltc']."',  '".$_POST['normal33']."',  '".$_POST['ch33']."',  '".$dxdr_ofyear['pltcrange']."',  '".$dxdr_ofyear['pltcflag']."',  '".$dxdr_ofyear['cbc_plts']."',  '".$dxdr_ofyear['cbc_neu']."',  '".$dxdr_ofyear['cbc_lymp']."',  '".$dxdr_ofyear['cbc_mono']."',  '".$dxdr_ofyear['cbc_eos']."',  '".$dxdr_ofyear['cbc_baso']."',  '".$dxdr_ofyear['cbc_band']."',  '".$dxdr_ofyear['cbc_atyp']."',  '".$dxdr_ofyear['cbc_nrbc']."',  '".$dxdr_ofyear['cbc_rbcmor']."',  '".$dxdr_ofyear['cbc_other']."',  '".$_POST['normal81']."',  '".$_POST['ch81']."',  '".$_POST['normal51']."',  '".$_POST['ch51']."',  '".$dxdr_ofyear['bs']."',  '".$_POST['normal47']."',  '".$_POST['ch47']."',  '".$dxdr_ofyear['bsrange']."',  '".$dxdr_ofyear['bsflag']."',  '".$dxdr_ofyear['bun']."',  '".$_POST['normal44']."',  '".$_POST['ch44']."',  '".$dxdr_ofyear['bunrange']."',  '".$dxdr_ofyear['bunflag']."',  '".$dxdr_ofyear['cr']."',  '".$_POST['normal45']."',  '".$_POST['ch45']."',  '".$dxdr_ofyear['crrange']."',  '".$dxdr_ofyear['crflag']."',  '".$dxdr_ofyear['uric']."',  '".$_POST['normal49']."',  '".$_POST['ch49']."',  '".$dxdr_ofyear['uricrange']."',  '".$dxdr_ofyear['uricflag']."',  '".$dxdr_ofyear['chol']."',  '".$_POST['normal46']."', '".$_POST['ch46']."',  '".$dxdr_ofyear['cholrange']."',  '".$dxdr_ofyear['cholflag']."',  '".$dxdr_ofyear['tg']."',  '".$_POST['normal48']."',  '".$_POST['ch48']."',  '".$dxdr_ofyear['tgrange']."',  '".$dxdr_ofyear['tgflag']."',  '".$dxdr_ofyear['sgot']."',  '".$_POST['normal41']."',  '".$_POST['ch41']."',  '".$dxdr_ofyear['sgotrange']."',  '".$dxdr_ofyear['sgotflag']."',  '".$dxdr_ofyear['sgpt']."',  '".$_POST['normal42']."',  '".$_POST['ch42']."',  '".$dxdr_ofyear['sgptrange']."',  '".$dxdr_ofyear['sgptflag']."',  '".$dxdr_ofyear['alk']."',  '".$_POST['normal43']."',  '".$_POST['ch43']."',  '".$dxdr_ofyear['alkrange']."',  '".$dxdr_ofyear['alkflag']."',  '".$_POST['normal20']."',  '".$_POST['ch20']."',  '".$_POST['normal52']."',  '".$_POST['ch52']."',  '".$_POST['other1']."',  '".$_POST['normal53']."',  '".$_POST['ch53']."',  '".$_POST['other2']."',  '".$_POST['normal54']."',  '".$_POST['ch54']."',  '".$_POST['dx']."',  '".$dxdr_ofyear['clinic']."',  '".$dxdr_ofyear['cigarette']."',  '".$dxdr_ofyear['alcohol']."',  '".$_POST['normal71']."',  '".$txtsm."',  '".$_POST['normal21']."',  '".$_POST['text21']."',  '".$_POST['normal22']."',  '".$_POST['text22']."',  '".$_POST['normal23']."',  '".$_POST['text23']."',  '".$_POST['normal24']."',  '".$_POST['text24']."',  '".$_POST['normal25']."',  '".$_POST['text25']."',  '".$_POST['normal26']."',  '".$_POST['text26']."',  '".$_POST['normal27']."',  '".$_POST['text27']."',  '".$_POST['normal28']."',  '".$_POST['text28']."',  '".$_POST['normal29']."',  '".$_POST['text29']."',  '".$_POST['normal30']."',  '".$_POST['text30']."',  'Y', '".$nPrefix."',  '".$_POST['normal91']."', '".$_POST['normal92']."',  '".$_POST['normal93']."',  '".$_POST['normal94']."', '".$_POST['normal941']."',  '".$_POST['normal95']."',  '".$_POST['normal951']."',  '".$_POST['normal61']."',  '".$_POST['normal62']."', '".$rs_sum21."','".$rs_sum22."', '".$rs_sum23."', '".$rs_sum24."','".$rs_sum25."',  '".$_POST['normal63']."',  '".$_POST['normal64']."', '".$_POST['normal65']."', '".$rs_sum51."','".$rs_sum52."','".$rs_sum53."',  '".$_POST['normal66']."', '".$rs_sum61."','".$_POST['anemia']."','".$_POST['cirrhosis']."','".$_POST['hepatitis']."','".$_POST['cardiomegaly']."','".$_POST['allergy']."','".$_POST['gout']."','".$_POST['waistline']."','".$_POST['asthma']."','".$_POST['muscle']."','".$_POST['ihd']."','".$_POST['thyroid']."','".$_POST['heart']."','".$_POST['emphysema']."','".$_POST['herniated']."','".$_POST['conjunctivitis']."','".$_POST['cystitis']."','".$_POST['epilepsy']."','".$_POST['fracture']."','".$_POST['cardiac']."','".$_POST['spine']."','".$_POST['dermatitis']."','".$_POST['degeneration']."','".$_POST['alcoholic']."','".$_POST['copd']."','".$_POST['bph']."','".$_POST['kidney']."','".$_POST['pterygium']."','".$_POST['tonsil']."','".$_POST['paralysis']."','".$_POST['blood']."','".$_POST['conanemia']."','".$_POST['ht']."', '".$_POST['normal55']."',  '".$_POST['ch55']."', '".$_POST['normal56']."',  '".$_POST['ch56']."',  '".$statusdata."')";
}
//echo $sql;
$result = mysql_query($sql) or die(mysql_error());
$id=mysql_insert_id();
$upopday = "update opday set checkdx='' where thdatehn = '".$date_hn2."'";
$result3 = mysql_query($upopday) or die(mysql_error());

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
	$detail = "select * from condxofyear_out where thdatevn = '".$date_vn."' order by row_id desc ";
	$result = Mysql_Query($detail);
	$arrs = Mysql_fetch_assoc($result);
	?> 
<script language="javascript">
		//window.opener.location.href='dt_manual_index.php';
		window.location.href='report_dxofyear_out_manual.php?id=<?=$id;?>';
		//setTimeout("window.close();",3000);
	</script>
   <meta http-equiv="refresh" content="3;url=dt_manual_index.php">
	<?
		}else{
		echo "<CENTER><FONT COLOR=\"red\">ไม่สามารถบันทึกข้อมูลได้</FONT></CENTER>";
	}

include("unconnect.inc");

?>
</BODY>
</HTML>