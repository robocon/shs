<script src="sweetalert/jquery-3.6.0.js"></script>
<script src="sweetalert/sweetalert2@11.js"></script>
<?php
session_start();
include("connect.inc");
include("function.php");
$data = $_POST;

$date=date("Y-m-d H:i:s");
$hn=$data["hn"];
$an=$data["an"];
$ptname=$data["ptname"];
$age=$data["age"];
$sex=$data["sex"];
$ptright=$data["ptright"];
$weight=$data["weight"];
$height=$data["height"];
$bmi=$data["bmi"];
$diag=$data["diag"];
$operation=$data["operation"];
$inhalation_ga=$data["inhalation_ga"];
$inhalation_sa=$data["inhalation_sa"];
$inhalation_bb=$data["inhalation_bb"];
$inhalation_iva=$data["inhalation_iva"];
$inhalation_la=$data["inhalation_la"];
$inhalation_ta=$data["inhalation_ta"];
$inhalation_other=$data["inhalation_other"];
$inhalation_detail=$data["inhalation_detail"];
$doctor=$data["doctor"];
$ward=$data["ward"];

list($surg_y,$surg_m,$surg_d)=explode("-",$data["date_surg"]);
$surg_y=$surg_y-543;
$date_surg="$surg_y-$surg_m-$surg_d";

list($npo_y,$npo_m,$npo_d)=explode("-",$data["date_npotime"]);
$npo_y=$npo_y-543;
$date_npotime="$npo_y-$npo_m-$npo_d";

if($data["time1"] !="" && $data["time2"] !=""){
	$surgery_time=$data["time1"].":".$data["time2"];
}else{
	$surgery_time="";
}

if($data["npo_time1"] !="" && $data["npo_time2"] !=""){
	$npo_time=$data["npo_time1"].":".$data["npo_time2"];
}else{
	$npo_time="";
}

$surgery_type=$data["surgery_type"];
$consent=$data["consent"];
$glascow_coma_scal_e=$data["glascow_coma_scal_e"];
$glascow_coma_scal_v=$data["glascow_coma_scal_v"];
$glascow_coma_scal_m=$data["glascow_coma_scal_m"];
$respire=$data["respire"];
$disease=$data["disease"];
$disease_ht=$data["disease_ht"];
$disease_dm=$data["disease_dm"];
$disease_dlp=$data["disease_dlp"];
$disease_asthma=$data["disease_asthma"];
$disease_copd=$data["disease_copd"];
$disease_kidney=$data["disease_kidney"];
$disease_cad=$data["disease_cad"];
$disease_cad_echo=$data["disease_cad_echo"];
$disease_cad_detail=$data["disease_cad_detail"];
$disease_thyroid=$data["disease_thyroid"];
$disease_thyroid_ft3=$data["disease_thyroid_ft3"];
$disease_thyroid_ft4=$data["disease_thyroid_ft4"];
$disease_thyroid_tsh=$data["disease_thyroid_tsh"];
$ft3_detail=$data["ft3_detail"];
$ft4_detail=$data["ft4_detail"];
$tsh_detail=$data["tsh_detail"];
$disease_other=$data["disease_other"];
$disease_other_detail=$data["disease_other_detail"];
$xray_cxr=$data["xray_cxr"];
$xray_kub=$data["xray_kub"];
$xray_mri=$data["xray_mri"];
$xray_ct=$data["xray_ct"];
$xray_film_ortho=$data["xray_film_ortho"];
$ct_detail=$data["ct_detail"];
$film_ortho_detail=$data["film_ortho_detail"];
$booking_blood=$data["booking_blood"];
$blood_group=$data["blood_group"];
$blood_type=$data["blood_type"];
$prc_unit=$data["prc_unit"];
$ffp_unit=$data["ffp_unit"];
$wb_unit=$data["wb_unit"];
$other_detail=$data["other_detail"];
$blood=$data["blood"];
$drugreact=$data["drugreact"];
$drugreact_opcard=$data["drugreact_opcard"];
$consultmed=$data["consultmed"];
$premed=$data["premed"];
$premed_name=$data["premed_name"];
$antiplatelet=$data["antiplatelet"];
$antiplatelet_drug=$data["antiplatelet_drug"];
$withhold=$data["withhold"];

list($holdtime_y,$holdtime_m,$holdtime_d)=explode("-",$data["holdtime"]);
$holdtime_y=$holdtime_y-543;
$holdtime="$holdtime_y-$holdtime_m-$holdtime_d";

$booking_icu=$data["booking_icu"];
$untrasound=$data["untrasound"];
$xray_c_arm=$data["xray_c_arm"];
$detail=$data["detail"];
$officer=$_SESSION["sOfficer"];
$status="Y";

/*echo "<pre>";
print_r($_SESSION);
echo "<pre>";
exit();*/

	
/*echo "<pre>";
print $date_surg;
echo "<pre>";
exit();*/

	$strSQL = "INSERT INTO 
	surgery_set(
		`date`,
		`hn`,
		`an`,
		`ptname`, 
		`age`, 
		`sex`, 
		`ptright`, 
		`weight`, 
		`height`, 
		`bmi`, 
		`diag`, 
		`operation`,
		`inhalation_ga`,
		`inhalation_sa`,
		`inhalation_bb`,
		`inhalation_iva`,
		`inhalation_la`,
		`inhalation_ta`,
		`inhalation_other`,
		`inhalation_detail`,		
		`doctor`, 
		`ward`, 
		`date_surg`, 
		`surgery_time`,
		`date_npotime`,	
		`npo_time`, 
		`surgery_type`, 
		`consent`, 		
		`glascow_coma_scal_e`, 
		`glascow_coma_scal_v`, 
		`glascow_coma_scal_m`, 
		`respire`, 
		`disease`,
		`disease_ht`,
		`disease_dm`,
		`disease_dlp`,
		`disease_asthma`,
		`disease_copd`,
		`disease_kidney`,
		`disease_cad`,
		`disease_cad_echo`,
		`disease_cad_detail`, 		
		`disease_thyroid`,
		`disease_thyroid_ft3`,		
		`disease_thyroid_ft4`,	
		`disease_thyroid_tsh`,			
		`ft3_detail`, 	
		`ft4_detail`, 
		`tsh_detail`,		
		`disease_other`,		
		`disease_other_detail`,
		`xray_cxr`,
		`xray_kub`,
		`xray_mri`,
		`xray_ct`,
		`xray_film_ortho`,		
		`ct_detail`, 
		`film_ortho_detail`, 
		`booking_blood`, 
		`blood_group`, 
		`blood_type`, 
		`prc_unit`, 
		`ffp_unit`, 
		`wb_unit`, 
		`other_detail`, 
		`blood`, 
		`drugreact`,
		`drugreact_opcard`,		
		`consultmed`, 
		`premed`, 
		`premed_name`, 
		`antiplatelet`, 
		`antiplatelet_drug`, 
		`withhold`, 
		`holdtime`, 
		`booking_icu`, 	
		`untrasound`, 	
		`xray_c_arm`, 		
		`detail`,
		`status`,
		`officer`
	) VALUES (
		'$date',
		'$hn',
		'$an',
		'$ptname', 
		'$age', 
		'$sex', 
		'$ptright', 
		'$weight', 
		'$height', 
		'$bmi', 
		'$diag', 
		'$operation',
		'$inhalation_ga',
		'$inhalation_sa',
		'$inhalation_bb',
		'$inhalation_iva',
		'$inhalation_la',
		'$inhalation_ta',
		'$inhalation_other',
		'$inhalation_detail',		
		'$doctor', 
		'$ward', 
		'$date_surg', 
		'$surgery_time', 
		'$date_npotime', 
		'$npo_time', 
		'$surgery_type', 
		'$consent', 		
		'$glascow_coma_scal_e', 
		'$glascow_coma_scal_v', 
		'$glascow_coma_scal_m', 
		'$respire', 
		'$disease', 
		'$disease_ht',
		'$disease_dm',
		'$disease_dlp',
		'$disease_asthma',
		'$disease_copd',
		'$disease_kidney',
		'$disease_cad',
		'$disease_cad_echo',
		'$disease_cad_detail', 		
		'$disease_thyroid',
		'$disease_thyroid_ft3',
		'$disease_thyroid_ft4',
		'$disease_thyroid_tsh',		
		'$ft3_detail', 	
		'$ft4_detail', 
		'$tsh_detail',		
		'$disease_other',		
		'$disease_other_detail',
		'$xray_cxr',
		'$xray_kub',
		'$xray_mri',
		'$xray_ct',
		'$xray_film_ortho',
		'$ct_detail', 
		'$film_ortho_detail', 
		'$booking_blood', 
		'$blood_group', 
		'$blood_type', 
		'$prc_unit', 
		'$ffp_unit', 
		'$wb_unit', 
		'$other_detail', 
		'$blood', 
		'$drugreact', 
		'$drugreact_opcard', 
		'$consultmed', 
		'$premed', 
		'$premed_name', 
		'$antiplatelet', 
		'$antiplatelet_drug', 
		'$withhold', 
		'$holdtime', 
		'$booking_icu', 	
		'$untrasound', 	
		'$xray_c_arm', 		
		'$detail',
		'$status',
		'$officer'
	);";
	//echo $strSQL;

	$objQuery = mysql_query($strSQL);
if($objQuery){
	echo "<script>
		$(document).ready(function() {
		Swal.fire({
			title: 'Success',
			text: 'บันทึกข้อมูลสำเร็จ !',
			icon: 'success',
			timer: 5000,
			showConfirmButton: false
			});
		})
	</script>";
	header("refresh:2; url=surgery_set.php");
}else{
	echo "<script>
		$(document).ready(function() {
		Swal.fire({
			title: 'ผิดพลาด',
			text: 'บันทึกข้อมูลไม่สำเร็จ !',
			icon: 'error',
			timer: 5000,
			showConfirmButton: false
			});
		})
	</script>";
	header("refresh:2; url=surgery_set.php");
}

?>