<?php
session_start();
include("connect.inc");

$date_now = date("Y-m-d H:i:s");
$date_hn = date("Y-m-d").$_POST["hn"];
$date_vn = date("Y-m-d").$_POST["vn"];

$yy = explode(" ",$date_now);
$xx = explode("-",$yy[0]);

$thidate_now = ($xx[0]+543)."-".$xx[1]."-".$xx[2]." ".$yy[1];
$date_hn2 = $xx[2]."-".$xx[1]."-".($xx[0]+543).$_POST["hn"];


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
	opener.location.href = 'dx_ofyear_out.php';
	window.print();
	setTimeout("window.close()",3000);
}
</script>
<?php

	$sql = "Select count(row_id) From opd where thdatehn = '".$date_hn."' limit 1";
	$result = Mysql_Query($sql);
	list($rows) = Mysql_fetch_row($result);
	
	////*runno ��Ǩ�آ�Ҿ*/////////
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
	////*runno ��Ǩ�آ�Ҿ*/////////
	
if($rows > 0){

	$sql = "Update `opd` set  `thidate` = '".$thidate_now."', 
	`temperature`  = '".$_POST["temperature"]."', 
	`pause`  = '".$_POST["pause"]."', 
	`rate`  = '".$_POST["rate"]."', 
	`weight`  = '".$_POST["weight"]."', 
	`bp1`  = '".$_POST["bp1"]."', 
	`bp2`  = '".$_POST["bp2"]."', 
	`drugreact`  = '".$_POST["drugreact"]."', 
	`congenital_disease`  = '".$_POST["congenital_disease"]."', 
	`type`  = '".$_POST["type"]."', 
	`organ`  = '".$_POST["organ"]."', 
	`doctor` = '".$_POST["doctor"]."',  
	`officer` = '".$_SESSION["sOfficer"]."' ,  
	`dc_diag` = NULL, 
	`vn`= '".$_POST["vn"]."', 
	`toborow` = '".$_POST["toborow"]."', 
	`height` = '".$_POST["height"]."' , 
	`clinic`  = '".$_POST["clinic"]."' , 
	`cigarette`= '".$_POST["cigarette"]."', 
	`alcohol`= '".$_POST["alcohol"]."', 
	`exercise`= '".$_POST["exercise"]."' 
	where  `thdatehn` = '".$thidatehn."' limit 1 ";
	mysql_query($sql);
}else{

	$sql = "INSERT INTO `opd` (`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,`temperature` ,`pause` ,`rate` ,`weight` ,`bp1`  ,`bp2` ,`drugreact` ,`congenital_disease` ,`type` ,`organ` ,`doctor`, `officer`, `vn` , `toborow`, `height`, `clinic`, `cigarette`, `alcohol`, `exercise`) VALUES (NULL , '".$thidate_now."', '".$date_hn2."', '".$_POST["hn"]."', '".$_POST["ptname"]."', '".$_POST["temperature"]."', '".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', '".$_POST["bp2"]."', '".$_POST["drugreact"]."', '".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".$_POST["organ"]."', '".$_POST["doctor"]."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', '".$_POST["toborow"]."', '".$_POST["height"]."', '".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."', '".$_POST["exercise"]."');";
	mysql_query($sql);
}

$dental_exam = $color_blind = $audiogram = $ekg = '';

if(!empty($_POST['dental_exam']))
{
	$dental_exam = $_POST['dental_exam'];
}
if(!empty($_POST['color_blind']))
{
	$color_blind = $_POST['color_blind'];
}
if(!empty($_POST['audiogram']))
{
	$audiogram = $_POST['audiogram'];
}
if(!empty($_POST['ekg']))
{
	$ekg = $_POST['ekg'];
}

$sql = "Select row_id From `dxofyear_out` where `thdatehn` = '$date_hn' order by row_id ASC limit 1 ";
$dxQuery = mysql_query($sql);
$count = mysql_num_rows($dxQuery);

if( ( isset($_POST["row_id"]) && $_POST["row_id"] != "" ) OR $count > 0 ){ 

	$dxout = mysql_fetch_assoc($dxQuery);
	if(empty($_POST["row_id"])){
		$_POST["row_id"] = $dxout['row_id'];
	}

	$sql = "Update `dxofyear_out` set 
	`thidate` = '".$date_now."' ,
	`thdatehn` = '".$date_hn."' ,
	`thdatevn` = '".$date_vn."' ,
	`vn` = '".$_POST["vn"]."' ,
	`ptname` = '".$_POST["ptname"]."' ,
	`age` = '".$_POST["age"]."' ,
	`camp` = '".$_POST["camp"]."' ,
	`camp_until` = '".$_POST["camp_until"]."' ,
	`height` = '".$_POST["height"]."' ,
	`weight` = '".$_POST["weight"]."' ,
	`round_` = '".$_POST["round_"]."' ,
	`temperature` = '".$_POST["temperature"]."' ,
	`pause` = '".$_POST["pause"]."' ,
	`rate` = '".$_POST["rate"]."' ,
	`bmi` = '".$_POST["bmi"]."' ,
	`bp1` = '".$_POST["bp1"]."' ,
	`bp2` = '".$_POST["bp2"]."' ,
	`bp21` = '".$_POST["bp21"]."' ,
	`bp22` = '".$_POST["bp22"]."',
	`ua_color` = '".$_POST["ua_color"]."' ,
	`ua_appear` = '".$_POST["ua_appear"]."' ,
	`ua_spgr` = '".$_POST["ua_spgr"]."' ,
	`ua_phu` = '".$_POST["ua_phu"]."' ,
	`ua_bloodu` = '".$_POST["ua_bloodu"]."' ,
	`ua_prou` = '".$_POST["ua_prou"]."' ,
	`ua_gluu` = '".$_POST["ua_gluu"]."' ,
	`ua_ketu` = '".$_POST["ua_ketu"]."' ,
	`ua_urobil` = '".$_POST["ua_urobil"]."' ,
	`ua_bili` = '".$_POST["ua_bili"]."' ,
	`ua_nitrit` = '".$_POST["ua_nitrit"]."' ,
	`ua_wbcu` = '".$_POST["ua_wbcu"]."' ,
	`ua_rbcu` = '".$_POST["ua_rbcu"]."' ,
	`ua_epiu` = '".$_POST["ua_epiu"]."' ,
	`ua_bactu` = '".$_POST["ua_bactu"]."' ,
	`ua_yeast` = '".$_POST["ua_yeast"]."' ,
	`ua_mucosu` = '".$_POST["ua_mucosu"]."' ,
	`ua_amopu` = '".$_POST["ua_amopu"]."' ,
	`ua_castu` = '".$_POST["ua_castu"]."' ,
	`ua_crystu` = '".$_POST["ua_crystu"]."' ,
	`ua_otheru` = '".$_POST["ua_otheru"]."' ,
	`cbc_wbc` = '".$_POST["cbc_wbc"]."' ,
	`cbc_rbc` = '".$_POST["cbc_rbc"]."' ,
	`cbc_hb` = '".$_POST["cbc_hb"]."' ,
	`cbc_hct` = '".$_POST["cbc_hct"]."' ,
	`cbc_mcv` = '".$_POST["cbc_mcv"]."' ,
	`cbc_mch` = '".$_POST["cbc_mch"]."' ,
	`cbc_mchc` = '".$_POST["cbc_mchc"]."' ,
	`cbc_pltc` = '".$_POST["cbc_pltc"]."' ,
	`cbc_plts` = '".$_POST["cbc_plts"]."' ,
	`cbc_neu` = '".$_POST["cbc_neu"]."' ,
	`cbc_lymp` = '".$_POST["cbc_lymp"]."' ,
	`cbc_mono` = '".$_POST["cbc_mono"]."' ,
	`cbc_eos` = '".$_POST["cbc_eos"]."' ,
	`cbc_baso` = '".$_POST["cbc_baso"]."' ,
	`cbc_band` = '".$_POST["cbc_band"]."' ,
	`cbc_atyp` = '".$_POST["cbc_atyp"]."' ,
	`cbc_nrbc` = '".$_POST["cbc_nrbc"]."' ,
	`cbc_rbcmor` = '".$_POST["cbc_rbcmor"]."' ,
	`cbc_other` = '".$_POST["cbc_other"]."' ,
	`cxr` = '".$_POST["cxr"]."' ,
	`bs` = '".$_POST["bs"]."' ,
	`bun` = '".$_POST["bun"]."' ,
	`cr` = '".$_POST["cr"]."' ,
	`uric` = '".$_POST["uric"]."' ,
	`chol` = '".$_POST["chol"]."' ,
	`tg` = '".$_POST["tg"]."' ,
	`sgot` = '".$_POST["sgot"]."' ,
	`sgpt` = '".$_POST["sgpt"]."' ,
	`alk` = '".$_POST["alk"]."' ,
	`dx` = '".$_POST["dx"]."',  
	`drugreact` ='".$_POST["drugreact"]."' , 
	`cigarette` ='".$_POST["cigarette"]."'  , 
	`alcohol` ='".$_POST["alcohol"]."', 
	`exercise` ='".$_POST["exercise"]."'  , 
	`congenital_disease` ='".$_POST["congenital_disease"]."'  , 
	`type` ='".$_POST["type"]."'  , 
	`organ` ='".$_POST["organ"]."'  , 
	`clinic` ='".$_POST["clinic"]."'  , 
	`doctor` ='".$_POST["doctor"]."', 
	`hn` ='".$_POST["hn"]."' ,
	`wbcrange` ='".$_POST["WBCrange"]."',
	`wbcflag` ='".$_POST["WBCflag"]."',
	`hctrange` ='".$_POST["HCTrange"]."',
	`hctflag` ='".$_POST["HCTflag"]."',
	`pltcrange` ='".$_POST["PLTCrange"]."',
	`pltcflag` ='".$_POST["PLTCflag"]."',
	`bsrange` ='".$_POST["GLUrange"]."',
	`bsflag` ='".$_POST["GLUflag"]."',
	`bunrange` ='".$_POST["BUNrange"]."',
	`bunflag` ='".$_POST["BUNflag"]."',
	`crrange` ='".$_POST["CREArange"]."',
	`crflag` ='".$_POST["CREAflag"]."',
	`uricrange` ='".$_POST["URICrange"]."',
	`uricflag` ='".$_POST["URICflag"]."'  ,
	`cholrange` ='".$_POST["CHOLrange"]."',
	`cholflag` ='".$_POST["CHOLflag"]."',
	`tgrange` ='".$_POST["TRIGrange"]."',
	`tgflag` ='".$_POST["TRIGflag"]."',
	`sgotrange` ='".$_POST["ASTrange"]."',
	`sgotflag` ='".$_POST["ASTflag"]."',
	`sgptrange` ='".$_POST["ALTrange"]."',
	`sgptflag` ='".$_POST["ALTflag"]."',
	`alkrange` ='".$_POST["ALPrange"]."',
	`alkflag` ='".$_POST["ALPflag"]."' ,
	`yearchk` ='".$nPrefix."',
	`labin_date`='".$_POST['labin_date']."',
	`dental_exam` = '$dental_exam',
	`color_blind` = '$color_blind',
	`audiogram` = '$audiogram',
	`ekg` = '$ekg' 
	where `row_id` = '".$_POST["row_id"]."'  limit 1";

}else{
	$sql = "INSERT INTO `dxofyear_out` ( `thidate`, `thdatehn`, `thdatevn`, `hn`, `vn`, `ptname`, `age`, `camp`, `camp_until`, `height`, `weight`, `round_`, `temperature`, `pause`, `rate`, `bmi`, `bp1`, `bp2`, `bp21`, `bp22`, `drugreact` , `cigarette` , `alcohol` , `exercise` , `congenital_disease` , `type` , `organ` , `clinic` , `doctor` , `ua_color`, `ua_appear`, `ua_spgr`, `ua_phu`, `ua_bloodu`, `ua_prou`, `ua_gluu`, `ua_ketu`, `ua_urobil`, `ua_bili`, `ua_nitrit`, `ua_wbcu`, `ua_rbcu`, `ua_epiu`, `ua_bactu`, `ua_yeast`, `ua_mucosu`, `ua_amopu`, `ua_castu`, `ua_crystu`, `ua_otheru`, `cbc_wbc`, `wbcrange`, `wbcflag`, `cbc_rbc`, `cbc_hb`, `cbc_hct`, `hctrange`, `hctflag`, `cbc_mcv`, `cbc_mch`, `cbc_mchc`, `cbc_pltc`,`pltcrange`, `pltcflag`, `cbc_plts`, `cbc_neu`, `cbc_lymp`, `cbc_mono`, `cbc_eos`, `cbc_baso`, `cbc_band`, `cbc_atyp`, `cbc_nrbc`, `cbc_rbcmor`, `cbc_other`, `cxr`, `bs`,`bsrange`, `bsflag`, `bun`,`bunrange`, `bunflag`, `cr`,`crrange`, `crflag`, `uric`,`uricrange`, `uricflag`, `chol`,`cholrange`, `cholflag`, `tg`,`tgrange`, `tgflag`, `sgot`,`sgotrange`, `sgotflag`, `sgpt`,`sgptrange`, `sgptflag`, `alk`,`alkrange`, `alkflag`, `dx`, `yearchk`,`labin_date`,`dental_exam`,`color_blind`,`audiogram`,`ekg`) VALUES ('".$date_now."','".$date_hn."','".$date_vn."','".$_POST["hn"]."','".$_POST["vn"]."','".$_POST["ptname"]."','".$_POST["age"]."','".$_POST["camp"]."','".$_POST["camp_until"]."','".$_POST["height"]."','".$_POST["weight"]."','".$_POST["round_"]."','".$_POST["temperature"]."','".$_POST["pause"]."','".$_POST["rate"]."','".$_POST["bmi"]."','".$_POST["bp1"]."','".$_POST["bp2"]."','".$_POST["bp21"]."','".$_POST["bp22"]."','".$_POST["drugreact"]."','".$_POST["cigarette"]."','".$_POST["alcohol"]."','".$_POST["exercise"]."','".$_POST["congenital_disease"]."','".$_POST["type"]."','".$_POST["organ"]."','".$_POST["clinic"]."','".$_POST["doctor"]."','".$_POST["ua_color"]."','".$_POST["ua_appear"]."','".$_POST["ua_spgr"]."','".$_POST["ua_phu"]."','".$_POST["ua_bloodu"]."','".$_POST["ua_prou"]."','".$_POST["ua_gluu"]."','".$_POST["ua_ketu"]."','".$_POST["ua_urobil"]."','".$_POST["ua_bili"]."','".$_POST["ua_nitrit"]."','".$_POST["ua_wbcu"]."','".$_POST["ua_rbcu"]."','".$_POST["ua_epiu"]."','".$_POST["ua_bactu"]."','".$_POST["ua_yeast"]."','".$_POST["ua_mucosu"]."','".$_POST["ua_amopu"]."','".$_POST["ua_castu"]."','".$_POST["ua_crystu"]."','".$_POST["ua_otheru"]."','".$_POST["cbc_wbc"]."','".$_POST["WBCrange"]."','".$_POST["WBCflag"]."','".$_POST["cbc_rbc"]."','".$_POST["cbc_hb"]."','".$_POST["cbc_hct"]."','".$_POST["HCTrange"]."','".$_POST["HCTflag"]."','".$_POST["cbc_mcv"]."','".$_POST["cbc_mch"]."','".$_POST["cbc_mchc"]."','".$_POST["cbc_pltc"]."','".$_POST["PLTCrange"]."','".$_POST["PLTCflag"]."','".$_POST["cbc_plts"]."','".$_POST["cbc_neu"]."','".$_POST["cbc_lymp"]."','".$_POST["cbc_mono"]."','".$_POST["cbc_eos"]."','".$_POST["cbc_baso"]."','".$_POST["cbc_band"]."','".$_POST["cbc_atyp"]."','".$_POST["cbc_nrbc"]."','".$_POST["cbc_rbcmor"]."','".$_POST["cbc_other"]."','".$_POST["cxr"]."','".$_POST["bs"]."','".$_POST["GLUrange"]."','".$_POST["GLUflag"]."','".$_POST["bun"]."','".$_POST["BUNrange"]."','".$_POST["BUNflag"]."','".$_POST["cr"]."','".$_POST["CREArange"]."','".$_POST["CREAflag"]."','".$_POST["uric"]."','".$_POST["URICrange"]."','".$_POST["URICflag"]."','".$_POST["chol"]."','".$_POST["CHOLrange"]."','".$_POST["CHOLflag"]."','".$_POST["tg"]."','".$_POST["TRIGrange"]."','".$_POST["TRIGflag"]."','".$_POST["sgot"]."','".$_POST["ASTrange"]."','".$_POST["ASTflag"]."','".$_POST["sgpt"]."','".$_POST["ALTrange"]."','".$_POST["ALTflag"]."','".$_POST["alk"]."','".$_POST["ALPrange"]."','".$_POST["ALPflag"]."','".$_POST["dx"]."','".$nPrefix."','".$_POST['labin_date']."','$dental_exam','$color_blind','$audiogram','$ekg')";
	
}
$result = mysql_query($sql) or die(mysql_error());

########################################################################
# �ŧ���������������ٻẺ�ͧ��Ǩ�آ�Ҿ Walk-in 
########################################################################
if ( $_POST['camp'] == '��Ǩ�آ�Ҿ��Сѹ�ѧ��' ) {
	
	$hn = $_POST["hn"];
	$out_result_officer = $_SESSION['sOfficer'];
	$register = date("Y-m-d H:i:s");
	
	$cigga_list = array(
		'0' => '������ٺ',
		'1' => '���ٺ ����ԡ����',
		'2' => '�ٺ������ �繤��駤���',
		'3' => '�ٺ������ �繻�Ш�'
	);
	$cigarette = $_POST['cigarette'];
	$cigga = $cigga_list[$cigarette];
	
	$alcohol_list = array(
		0 => '����´���',
		1 => '�´��� ����ԡ����',
		2 => '���� �繤��駤���',
		3 => '���� �繻�Ш�'
	);
	$alcohol = $_POST['alcohol'];
	$alcohol_name = $alcohol_list[$alcohol];
	
	$exercise_list = array(
		0 => '������͡���ѧ���',
		1 => '�͡���ѧ��� ��ӡ���ࡳ��',
		2 => '�͡���ѧ��� ���ࡳ��'
	);
	$exercise = $_POST['exercise'];
	$exercise_name = $exercise_list[$exercise];
	
	
	$drugreact_list = array(
		0 => '�����',
		1 => '��'
	);
	$drugreact = $_POST['drugreact'];
	$allergic = $drugreact_list[$drugreact];
	
	// �֧ part �͡��
	$sql = "SELECT `part` FROM `opcardchk` WHERE `HN` = '$hn' ORDER BY row DESC LIMIT 1";
	$q = mysql_query($sql) or die( mysql_query($sql) );
	$item = mysql_fetch_assoc($q);
	$part = $item['part'];

	$sql = "SELECT * FROM `out_result_chkup` WHERE `part` = '$part' AND `hn` = '$hn' ";
	$q = mysql_query($sql) or die( mysql_query($sql) );
	$out_result_row = mysql_num_rows($q);

	// Update
	if( $out_result_row > 0 ){

		$out_result = mysql_fetch_assoc($q);
	
		$out_result_chkup_update = "UPDATE `out_result_chkup` SET 
		`ptname` = '".$_POST['ptname']."',
		`age` = '".$_POST['age']."',
		`weight` = '".$_POST['weight']."',
		`height` = '".$_POST['height']."',
		`bp1` = '".$_POST['bp1']."',
		`bp2` ='".$_POST['bp2']."',
		`bp3` = '".$_POST['bp21']."',
		`bp4` ='".$_POST['bp22']."',
		`p` = '".$_POST['pause']."' ,
		`ekg` = '',
		`va` = '',
		`stool` = '',
		`cxr` = '',
		`year_chk` = '".$nPrefix."',
		`part` = '$part',
		`42702` = '',
		`hpv` = '',
		`altra` = '',
		`psa` = '',
		`mammogram` = '',
		`temp` = '".$_POST['temperature']."',
		`rate` ='".$_POST['rate']."',
		`prawat` = '".$_POST['congenital_disease']."' ,
		`cigga` = '$cigga',
		`alcohol` = '$alcohol_name',
		`exercise` = '$exercise_name',
		`allergic` = '$allergic',
		`comment` = '".$_POST['organ'].", ".$_POST['dx']."'	,
		`eye` ='',
		`eye_detail` ='',
		`pt` ='',
		`pt_detail` ='',
		`last_officer` = '$out_result_officer',
		`last_update` = '$register', 
		`seq` = '', 
		`cs` = '',
		`result_cs` = '',
		`blindness` = '', 
		`hearing` = '', 
		`metal` = '', 
		`metal_result` = ''
		WHERE `row_id` ='".$out_result['row_id']."';";
		$out_result_update = mysql_query($out_result_chkup_update) or die( mysql_error() );
	
	}else{ // Insert
	
		$out_result_chkup_insert = "INSERT INTO `out_result_chkup` SET 
		`hn` = '".$_POST['hn']."',
		`ptname` = '".$_POST['ptname']."',
		`age` = '".$_POST['age']."',
		`weight` = '".$_POST['weight']."',
		`height` = '".$_POST['height']."',
	
		`bp1` = '".$_POST['bp1']."',
		`bp2` = '".$_POST['bp2']."',
		`bp3` = '".$_POST['bp21']."',
		`bp4` = '".$_POST['bp22']."',
		`p` = '".$_POST['pause']."',
		
		`ekg` = '',
		`va` = '',
		`cxr` = '',
		`year_chk` =  '$nPrefix',
		`part` = '$part',
	
		`officer` = '$out_result_officer',
		`register` = '$register',
		`42702` = '',
		`hpv` = '',
		`altra` = '',
	
		`psa` = '',
		`mammogram` = '',
		`temp` = '".$_POST['temperature']."',
		`rate` = '".$_POST['rate']."',
		`prawat` =  '".$_POST['congenital_disease']."',
	
		`cigga` = '$cigga',
		`alcohol` = '$alcohol_name',
		`exercise` = '$exercise_name',
		`allergic` = '$allergic',
		`comment` = '".$_POST['organ'].", ".$_POST['dx']."',
		
		`eye` = '',
		`eye_detail` =  '',
		`pt` = '',
		`pt_detail` = '', 
		`seq` = '', 
	
		`cs` = '', 
		`result_cs` = '', 
		`blindness` = '', 
		`hearing` = '', 
		`metal` = '', 
		`metal_result` = ''";
		$out_result_insert = mysql_query($out_result_chkup_insert) or die( mysql_error() );
	
	}

}

#########################################################################



// �Է�� ��� + ex46 ��Ǩ�آ�Ҿ
$toborow = strtolower(substr($_POST['toborow'],0,4));
$ptright = strtolower(substr($_POST['ptright'],0,3));
$checkdx = 'P';
if( $toborow == 'ex46' && $ptright == 'r07' ){
	$checkdx = "sso";
}

$upopday = "update opday set checkdx='$checkdx' where thdatehn = '".$date_hn2."'";
$result3 = mysql_query($upopday) or die(mysql_error());

$query ="UPDATE chkup_solider SET opd = '$date_now' WHERE hn='".$_POST["hn"]."'";
$result = mysql_query($query) or die("Query failed");
//echo $upopday;
if($result && isset($_POST["submit"])){
	echo "<CENTER>�ѹ�֡���������º��������</CENTER>";
}elseif($result && isset($_POST["submit2"])){
	
	

if($_POST["drugreact"] == 0){
	$_POST["congenital_disease"] .=" , �������������";
}else{
	$i=0;
	$list = array();
	$sql = "Select  tradname From drugreact  where hn = '".$_POST["hn"]."' ";
	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){
		array_push($list ,$arr["tradname"]);
	}
	$list_drug = implode(", ",$list);
	$_POST["congenital_disease"] .= " , ���� : ".$list_drug;
}

?>

<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
<tr>
    <td>HN :<?php echo $_POST["hn"];?>&nbsp;&nbsp;<?php echo $thidate;?></td>
  </tr>
  <tr>
    <td>T : <?php echo $_POST["temperature"];?> C, P : <?php echo $_POST["pause"];?> ����/�ҷ� , R : <?php echo $_POST["rate"];?> ����/�ҷ� </td>
  </tr>
  <tr>
    <td>BP : <?php echo $_POST["bp1"];?> / <?php echo $_POST["bp2"];?> mmHg, �� : <?php echo $_POST["weight"];?> ��., �� : <?php echo $_POST["height"];?> ��. �ͺ���  : <?php echo $_POST["round_"];?> ��.</td>
  </tr>
  <tr>
    <td>������ : <?php echo $_POST["cigarette"];?>, ���� : <?php echo $_POST["alcohol"]?>, �͡���ѧ��� : <?php echo $_POST["exercise"];?></td>
  </tr>
  <tr>
    <td>�ѡɳ� : <?php echo $_POST["type"];?>, ��Թԡ : <?php echo substr($_POST["clinic"],3);?></td>
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
	echo "<CENTER><FONT COLOR=\"red\">�������ö�ѹ�֡��������</FONT></CENTER>";
}

include("unconnect.inc");

?>
</BODY>
</HTML>