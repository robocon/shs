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

$sql1 = "Select * from  `dxofyear` where `row_id` ='".$_POST['row_id']."'";
$dxdr_ofyear = mysql_fetch_array(mysql_query($sql1));

$sql = "Select count(row_id) From  `dxofyear` where `thdatehn` = '{$date_hn}' limit 0,1 ";
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
	if($_POST['normal53']=="ปกติ"|$_POST['normal53']=="") $_POST['ch53']="";
	if($_POST['normal54']=="ปกติ"|$_POST['normal54']=="") $_POST['ch54']="";
	
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
	
	if($_POST['normal61']=="ไม่พบความเสี่ยง"){ 
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
	}
	
	if($_POST['normal62']=="ไม่ตรวจ"){ 
		$_POST['normal641']="";
		$_POST['cholsult']="";
	}
	
	
	$sql ="INSERT INTO `condxofyear_emp` ( `thidate` , `thdatehn` , `thdatevn` , `hn` , `vn` , `ptname` , `age` , `camp` , `camp_until` , `height` , `weight` , `round_` , `temperature` , `pause` , `rate` , `bmi` , `bp1` , `bp2` , `drugreact` , `congenital_disease` , `type` , `organ` , `doctor` , `ua_color` , `ua_appear` , `ua_spgr` , `ua_phu` , `ua_bloodu` , `ua_prou` , `ua_gluu` , `ua_ketu` , `ua_urobil` , `ua_bili` , `ua_nitrit` , `ua_wbcu` , `ua_rbcu` , `ua_epiu` , `ua_bactu` , `ua_yeast` , `ua_mucosu` , `ua_amopu` , `ua_castu` , `ua_crystu` , `ua_otheru` , `stat_ua` , `reason_ua` , `cbc_wbc` , `stat_wbc` , `reason_wbc` , `wbcrange` , `wbcflag` , `cbc_rbc` , `cbc_hb` , `cbc_hct` , `stat_hct` , `reason_hct` , `hctrange` , `hctflag` , `cbc_mcv` , `cbc_mch` , `cbc_mchc` , `cbc_pltc` , `stat_pltc` , `reason_pltc` , `pltcrange` , `pltcflag` , `cbc_plts` , `cbc_neu` , `cbc_lymp` , `cbc_mono` , `cbc_eos` , `cbc_baso` , `cbc_band` , `cbc_atyp` , `cbc_nrbc` , `cbc_rbcmor` , `cbc_other` , `stat_cbc` , `reason_cbc` , `cxr` , `reason_cxr` , `bs` , `stat_bs` , `reason_bs` , `bsrange` , `bsflag` , `bun` , `stat_bun` , `reason_bun` , `bunrange` , `bunflag` , `cr` , `stat_cr` , `reason_cr` , `crrange` , `crflag` , `uric` , `stat_uric` , `reason_uric` , `uricrange` , `uricflag` , `chol` , `stat_chol` , `reason_chol` , `cholrange` , `cholflag` , `tg` , `stat_tg` , `reason_tg` , `tgrange` , `tgflag` , `sgot` , `stat_sgot` , `reason_sgot` , `sgotrange` , `sgotflag` , `sgpt` , `stat_sgpt` , `reason_sgpt` , `sgptrange` , `sgptflag` , `alk` , `stat_alk` , `reason_alk` , `alkrange` , `alkflag` , `general` , `reason_general` , `reason_pap`, `pap`, `dx` , `clinic` , `cigarette` , `alcohol` , `summary` , `diag`, `stat_mouth1` , `stat_mouth2` , `stat_mouth3` , `stat_mouth4`, `reason_mouth` , `stat_hbsag` , `stat_hbsab` , `stat_hbcab` , `stat_lead` , `stat_stool` , `stat_hear1` , `stat_hear2` , `stat_hear3` , `stat_hear4` , `reason_hear`, `stat_eye`, `reason_eye`, `stat_chest`, `reason_chest` ,`status_dr`,`yearcheck`	 )
VALUES (
'".$date_now."',  '".$date_hn."',  '".$date_vn."',  '".$dxdr_ofyear['hn']."',  '".$dxdr_ofyear['vn']."',  '".$dxdr_ofyear['ptname']."',  '".$dxdr_ofyear['age']."',  '".$dxdr_ofyear['camp']."',  '".$dxdr_ofyear['camp_until']."',  '".$dxdr_ofyear['height']."',  '".$dxdr_ofyear['weight']."',  '".$dxdr_ofyear['round_']."',  '".$dxdr_ofyear['temperature']."',  '".$dxdr_ofyear['pause']."',  '".$dxdr_ofyear['rate']."',  '".$_POST['bmi']."',  '".$dxdr_ofyear['bp1']."',  '".$dxdr_ofyear['bp2']."',  '".$dxdr_ofyear['drugreact']."',  '".$dxdr_ofyear['congenital_disease']."',  '".$dxdr_ofyear['type']."',  '".$dxdr_ofyear['organ']."',  '".$_POST['doctorn']."',  '".$dxdr_ofyear['ua_color']."',  '".$dxdr_ofyear['ua_appear']."',  '".$dxdr_ofyear['ua_spgr']."',  '".$dxdr_ofyear['ua_phu']."',  '".$dxdr_ofyear['ua_bloodu']."',  '".$dxdr_ofyear['ua_prou']."',  '".$dxdr_ofyear['ua_gluu']."',  '".$dxdr_ofyear['ua_ketu']."',  '".$dxdr_ofyear['ua_urobil']."',  '".$dxdr_ofyear['ua_bili']."',  '".$dxdr_ofyear['ua_nitrit']."',  '".$dxdr_ofyear['ua_wbcu']."',  '".$dxdr_ofyear['ua_rbcu']."',  '".$dxdr_ofyear['ua_epiu']."',  '".$dxdr_ofyear['ua_bactu']."',  '".$dxdr_ofyear['ua_yeast']."',  '".$dxdr_ofyear['ua_mucosu']."',  '".$dxdr_ofyear['ua_amopu']."',  '".$dxdr_ofyear['ua_castu']."',  '".$dxdr_ofyear['ua_crystu']."',  '".$dxdr_ofyear['ua_otheru']."',  '".$_POST['normal']."',  '".$_POST['ch']."', '".$dxdr_ofyear['cbc_wbc']."',  '".$_POST['normal32']."',  '".$_POST['ch32']."',  '".$dxdr_ofyear['wbcrange']."',  '".$dxdr_ofyear['wbcflag']."', '".$dxdr_ofyear['cbc_rbc']."',  '".$dxdr_ofyear['cbc_hb']."',  '".$dxdr_ofyear['cbc_hct']."',  '".$_POST['normal31']."',  '".$_POST['ch31']."',  '".$dxdr_ofyear['hctrange']."',  '".$dxdr_ofyear['hctflag']."',  '".$dxdr_ofyear['cbc_mcv']."',  '".$dxdr_ofyear['cbc_mch']."',  '".$dxdr_ofyear['cbc_mchc']."',  '".$dxdr_ofyear['cbc_pltc']."',  '".$_POST['normal33']."',  '".$_POST['ch33']."',  '".$dxdr_ofyear['pltcrange']."',  '".$dxdr_ofyear['pltcflag']."',  '".$dxdr_ofyear['cbc_plts']."',  '".$dxdr_ofyear['cbc_neu']."',  '".$dxdr_ofyear['cbc_lymp']."',  '".$dxdr_ofyear['cbc_mono']."',  '".$dxdr_ofyear['cbc_eos']."',  '".$dxdr_ofyear['cbc_baso']."',  '".$dxdr_ofyear['cbc_band']."',  '".$dxdr_ofyear['cbc_atyp']."',  '".$dxdr_ofyear['cbc_nrbc']."',  '".$dxdr_ofyear['cbc_rbcmor']."',  '".$dxdr_ofyear['cbc_other']."',  '".$_POST['normal81']."',  '".$_POST['ch81']."',  '".$_POST['normal51']."',  '".$_POST['ch51']."',  '".$dxdr_ofyear['bs']."',  '".$_POST['normal47']."',  '".$_POST['ch47']."',  '".$dxdr_ofyear['bsrange']."',  '".$dxdr_ofyear['bsflag']."',  '".$dxdr_ofyear['bun']."',  '".$_POST['normal45']."',  '".$_POST['ch45']."',  '".$dxdr_ofyear['bunrange']."',  '".$dxdr_ofyear['bunflag']."',  '".$dxdr_ofyear['cr']."',  '".$_POST['normal45']."',  '".$_POST['ch45']."',  '".$dxdr_ofyear['crrange']."',  '".$dxdr_ofyear['crflag']."',  '".$dxdr_ofyear['uric']."',  '".$_POST['normal49']."',  '".$_POST['ch49']."',  '".$dxdr_ofyear['uricrange']."',  '".$dxdr_ofyear['uricflag']."',  '".$dxdr_ofyear['chol']."',  '".$_POST['normal48']."', '".$_POST['ch48']."',  '".$dxdr_ofyear['cholrange']."',  '".$dxdr_ofyear['cholflag']."',  '".$dxdr_ofyear['tg']."',  '".$_POST['normal48']."',  '".$_POST['ch48']."',  '".$dxdr_ofyear['tgrange']."',  '".$dxdr_ofyear['tgflag']."',  '".$dxdr_ofyear['sgot']."',  '".$_POST['normal43']."',  '".$_POST['ch43']."',  '".$dxdr_ofyear['sgotrange']."',  '".$dxdr_ofyear['sgotflag']."',  '".$dxdr_ofyear['sgpt']."',  '".$_POST['normal43']."',  '".$_POST['ch43']."',  '".$dxdr_ofyear['sgptrange']."',  '".$dxdr_ofyear['sgptflag']."',  '".$dxdr_ofyear['alk']."',  '".$_POST['normal43']."',  '".$_POST['ch43']."',  '".$dxdr_ofyear['alkrange']."',  '".$dxdr_ofyear['alkflag']."',  '".$_POST['normal20']."',  '".$_POST['ch20']."','".$_POST['statpap']."','".$_POST['choice2']."',  '".$_POST['dx']."',  '".$dxdr_ofyear['clinic']."',  '".$dxdr_ofyear['cigarette']."',  '".$dxdr_ofyear['alcohol']."',  '".$_POST['normal71']."',  '".$txtsm."', '".$_POST['statmouth1']."' , '".$_POST['statmouth2']."' ,  '".$_POST['statmouth3']."' , '".$_POST['statmouth4']."'  , '".$_POST['choice4']."' , '".$_POST['normal61']."' , '".$_POST['normal62']."' , '".$_POST['normal63']."' , '".$_POST['normal64']."' ,'".$_POST['normal65']."' , '".$_POST['stathear1']."' , '".$_POST['stathear2']."' , '".$_POST['stathear3']."' , '".$_POST['stathear4']."' , '".$_POST['choice3']."' , '".$_POST['stateye']."', '".$_POST['choice1']."' ,  '".$_POST['statchest']."',  '".$_POST['choice5']."','Y','".$nPrefix."')";

}
//echo $sql;
$result = mysql_query($sql) or die(mysql_error());
/*$upopday = "update opday set checkdx='' where thdatehn = '".$date_hn2."'";
$result3 = mysql_query($upopday) or die(mysql_error());

$query ="UPDATE chkup_solider SET dr = '$date_now' WHERE hn='".$dxdr_ofyear['hn']."'";
$result5 = mysql_query($query) or die("Query failed");
*/
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
	$detail = "select * from condxofyear_emp where thdatevn = '".$date_vn."' order by row_id desc";
	$result = Mysql_Query($detail);
	$arrs = Mysql_fetch_assoc($result);
	?>
	
	<table cellpadding="0" cellspacing="0" border="0" style="font-family:'MS Sans Serif'; font-size:12px">
	<tr>
	  <td>ผลการตรวจสุขภาพประจำปี</td>
	  </tr>
	<tr>
		<td>ชื่อ : <?php echo $arrs["ptname"];?> HN :<?php echo $arrs["hn"];?></td>
	  </tr>
	<tr>
	  <td>วันที่ตรวจ : <?php echo $thidate_now;?></td>
	  </tr>
	  <tr>
		<td>ผลการตรวจ : <?php echo $arrs["summary"]." ".$arrs["diag"];?></td>
	  </tr>
      <?
      	if($_POST['normal41']=="ผิดปกติ"|$_POST['normal42']=="ผิดปกติ"|$_POST['normal43']=="ผิดปกติ") $text41="ตับ";
		if($_POST['normal44']=="ผิดปกติ"|$_POST['normal45']=="ผิดปกติ") $text44="ไต";
		if($_POST['normal46']=="ผิดปกติ"|$_POST['normal48']=="ผิดปกติ") $text46="ไขมัน";
		if($_POST['normal47']=="ผิดปกติ") $text47="เบาหวาน";
		if($_POST['normal49']=="ผิดปกติ") $text49="URIC";
		if($_POST['normal81']=="ผิดปกติ") $text81="CBC";
		if($_POST['normal']=="ผิดปกติ") $text="UA";
	  ?>
      <tr>
	    <td>บันทึกจากแพทย์: <?=$arrs["dx"]?></td>
      </tr>
	  <? if($arrs["summary"]=="ผิดปกติ"){?>
	  <tr>
	    <td>Diag: <?=$arrs["diag"]?></td>
      </tr>
      <tr>
	    <td>ความผิดปกติ: <?=$text41?> <?=$text44?> <?=$text46?> <?=$text47?> <?=$text49?> <?=$text81?> <?=$text?></td>
      </tr>
      <? }?>
	  <tr>
		<td>แพทย์ : <?php echo $arrs["doctor"];?></td>
	  </tr>
	</table>
<script language="javascript">
		window.print();
		//window.opener.location.href='dxdr_ofyear_emp.php';
		//setTimeout("window.close();",3000);
	</script>
   <meta http-equiv="refresh" content="3;url=dt_index.php">
	<?
		}else{
		echo "<CENTER><FONT COLOR=\"red\">ไม่สามารถบันทึกข้อมูลได้</FONT></CENTER>";
	}

include("unconnect.inc");

?>
</BODY>
</HTML>