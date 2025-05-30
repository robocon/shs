<?php
session_start();
include("connect.inc");
include("function.php");

$getid=$_GET["id"];
$strSQL = "SELECT * FROM surgery_set WHERE row_id='$getid'";
//echo $strSQL;
$objQuery = mysql_query($strSQL);
$total_record = mysql_num_rows($objQuery);
$objResult = mysql_fetch_array($objQuery);
$hn=$objResult["hn"];
$ward=$objResult["ward"];

if($objResult["officer_surgery"]==""){
	$showuser=$objResult["officer"];
	$showdate=date_th(substr($objResult["date"],0,10))." ".substr($objResult["date"],11);
	$showdataofficer="<div align='center'><span>ผู้บันทึก : $showuser</span><span style='margin-left:5px;'>($ward)</span><span style='margin-left:120px;'>วัน/เดือน/ปี : $showdate</span></div>";
}else{
	$showuser=$objResult["officer"];
	$showdate=date_th(substr($objResult["date"],0,10))." ".substr($objResult["date"],11);
	$showuseror=$objResult["officer_surgery"];
	$showdateor=date_th(substr($objResult["approve_date"],0,10))." ".substr($objResult["approve_date"],11);
	$showdataofficer="<div align='center'><span>ผู้บันทึก : $showuser</span><span style='margin-left:5px;'>($ward)</span><span style='margin-left:10px;'>วัน/เดือน/ปี : $showdate</span><span style='margin-left:30px;'>ผู้รับทราบ : $showuseror</span><span style='margin-left:10px;'>วัน/เดือน/ปี : $showdateor</span></div>";
}

if($objResult["inhalation_ga"]=="y"){
	$inhalation_ga_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_ga_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["inhalation_sa"]=="y"){
	$inhalation_sa_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_sa_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["inhalation_bb"]=="y"){
	$inhalation_bb_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_bb_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["inhalation_iva"]=="y"){
	$inhalation_iva_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_iva_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["inhalation_la"]=="y"){
	$inhalation_la_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_la_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["inhalation_ta"]=="y"){
	$inhalation_ta_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_ta_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["inhalation_other"]=="y"){
	$inhalation_other_checkbox="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$inhalation_other_checkbox="<img src='images/uncheck-box.png' width='16' height='16'>";
}
	
if($objResult["surgery_type"]=="Elective"){
	$surgery_type_checkbox1="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$surgery_type_checkbox1="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["surgery_type"]=="Emergency"){
	$surgery_type_checkbox2="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$surgery_type_checkbox2="<img src='images/uncheck-box.png' width='16' height='16'>";
}	

if($objResult["surgery_type"]=="On Call"){
	$surgery_type_checkbox3="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$surgery_type_checkbox3="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["consent"]=="พร้อม"){
	$consent_checkbox1="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$consent_checkbox1="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["consent"]=="ไม่พร้อม"){
	$consent_checkbox2="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$consent_checkbox2="<img src='images/uncheck-box.png' width='16' height='16'>";
}


if($objResult["respire"]=="Room Air"){
	$respire_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$respire_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["respire"]=="Canular"){
	$respire_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$respire_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}	

if($objResult["respire"]=="Face Mask"){
	$respire_radio3="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$respire_radio3="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["respire"]=="ET-Tube"){
	$respire_radio4="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$respire_radio4="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["respire"]=="TT-Tube"){
	$respire_radio5="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$respire_radio5="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["disease"]=="มี"){
	$disease_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$disease_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["disease"]=="ไม่มี"){
	$disease_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$disease_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["disease_ht"]=="y"){
	$disease_ht="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_ht="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["disease_dm"]=="y"){
	$disease_dm="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_dm="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["disease_dlp"]=="y"){
	$disease_dlp="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_dlp="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["disease_asthma"]=="y"){
	$disease_asthma="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_asthma="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["disease_copd"]=="y"){
	$disease_copd="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_copd="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["disease_kidney"]=="y"){
	$disease_kidney="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_kidney="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["disease_cad"]=="y"){
	$disease_cad="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_cad="<img src='images/uncheck-box.png' width='16' height='16'>";
}


if($objResult["disease_cad_echo"]=="มี"){
	$disease_cad_echo_radio1="<img src='images/check-radio.png' width='18' height='18'>";
	$disease_cad_detail=$objResult["disease_cad_detail"]." %";
}else{
	$disease_cad_echo_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
	$disease_cad_detail=".............%";
}

if($objResult["disease_cad_echo"]=="ไม่มี"){
	$disease_cad_echo_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$disease_cad_echo_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["disease_thyroid"]=="y"){
	$disease_thyroid="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$disease_thyroid="<img src='images/uncheck-box.png' width='16' height='16'>";
}


if($objResult["disease_thyroid_ft3"]=="y"){
	$disease_thyroid_lab_ft3="<img src='images/check-box.png' width='18' height='16'>";
	$ft3_detail=$objResult["ft3_detail"];
}else{
	$disease_thyroid_lab_ft3="<img src='images/uncheck-box.png' width='18' height='16'>";
	$ft3_detail=".............";
}

if($objResult["disease_thyroid_ft4"]=="y"){
	$disease_thyroid_lab_ft4="<img src='images/check-box.png' width='18' height='16'>";
	$ft4_detail=$objResult["ft4_detail"];
}else{
	$disease_thyroid_lab_ft4="<img src='images/uncheck-box.png' width='18' height='16'>";
	$ft4_detail=".............";
}

if($objResult["disease_thyroid_tsh"]=="y"){
	$disease_thyroid_lab_tsh="<img src='images/check-box.png' width='18' height='16'>";
	$tsh_detail=$objResult["tsh_detail"];
}else{
	$disease_thyroid_lab_tsh="<img src='images/uncheck-box.png' width='18' height='16'>";
	$tsh_detail=".............";
}

if($objResult["disease_other"]=="y"){
	$disease_other="<img src='images/check-box.png' width='16' height='16'>";
	$disease_other_detail=$objResult["disease_other_detail"];
}else{
	$disease_other="<img src='images/uncheck-box.png' width='16' height='16'>";
	$disease_other_detail=".................................";
}


if($objResult["xray_cxr"]=="y"){
	$xray_checkbox1="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$xray_checkbox1="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["xray_kub"]=="y"){
	$xray_checkbox2="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$xray_checkbox2="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["xray_mri"]=="y"){
	$xray_checkbox3="<img src='images/check-box.png' width='16' height='16'>";
}else{
	$xray_checkbox3="<img src='images/uncheck-box.png' width='16' height='16'>";
}

if($objResult["xray_ct"]=="y"){
	$xray_checkbox4="<img src='images/check-box.png' width='16' height='16'>";
	$ct_datail=$objResult["ct_detail"];
}else{
	$xray_checkbox4="<img src='images/uncheck-box.png' width='16' height='16'>";
	$ct_datail=".............";
}

if($objResult["xray_film_ortho"]=="y"){
	$xray_checkbox5="<img src='images/check-box.png' width='16' height='16'>";
	$film_ortho_datail=$objResult["film_ortho_datail"];
}else{
	$xray_checkbox5="<img src='images/uncheck-box.png' width='16' height='16'>";
	$film_ortho_datail=".............";
}

if($objResult["glascow_coma_scal_e"]!=""){
	$glascow_coma_scal_e=$objResult["glascow_coma_scal_e"];
}else{
	$glascow_coma_scal_e=".............";
}

if($objResult["glascow_coma_scal_v"]!=""){
	$glascow_coma_scal_v=$objResult["glascow_coma_scal_v"];
}else{
	$glascow_coma_scal_v=".............";
}

if($objResult["glascow_coma_scal_m"]!=""){
	$glascow_coma_scal_m=$objResult["glascow_coma_scal_m"];
}else{
	$glascow_coma_scal_m=".............";
}	


if($objResult["booking_blood"]=="จอง"){
	$booking_blood_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$booking_blood_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["booking_blood"]=="ไม่มี"){
	$booking_blood_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$booking_blood_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}


if($objResult["blood_group"]=="A"){
	$blood_group_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$blood_group_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["blood_group"]=="B"){
	$blood_group_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$blood_group_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}	

if($objResult["blood_group"]=="O"){
	$blood_group_radio3="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$blood_group_radio3="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["blood_group"]=="AB"){
	$blood_group_radio4="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$blood_group_radio4="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["blood_type"]=="PRC"){
	$blood_type_radio1="<img src='images/check-radio.png' width='18' height='18'>";
	$prc_unit=$objResult["prc_unit"]." Unit";
}else{
	$blood_type_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
	$prc_unit=".............Unit";
}

if($objResult["blood_type"]=="FFP"){
	$blood_type_radio2="<img src='images/check-radio.png' width='18' height='18'>";
	$ffp_unit=$objResult["ffp_unit"]." Unit";
}else{
	$blood_type_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
	$ffp_unit=".............Unit";
}	

if($objResult["blood_type"]=="WB"){
	$blood_type_radio3="<img src='images/check-radio.png' width='18' height='18'>";
	$wb_unit=$objResult["wb_unit"]." Unit";
}else{
	$blood_type_radio3="<img src='images/uncheck-radio.png' width='18' height='18'>";
	$wb_unit=".............Unit";
}

if($objResult["blood_type"]=="AB"){
	$blood_type_radio4="<img src='images/check-radio.png' width='18' height='18'>";
	$other_detail=$objResult["other_detail"]." Unit";
}else{
	$blood_type_radio4="<img src='images/uncheck-radio.png' width='18' height='18'>";
	$other_detail=".............";
}

if($objResult["blood"]=="มี"){
	$blood_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$blood_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["blood"]=="ไม่มี"){
	$blood_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$blood_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["drugreact"]=="แพ้ยา"){
	$drugreact_radio1="<img src='images/check-radio.png' width='18' height='18'>";
	$drugreact_opcard="ยาที่แพ้ : ".$objResult["drugreact_opcard"];
}else{
	$drugreact_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["drugreact"]=="ไม่แพ้ยา"){
	$drugreact_radio2="<img src='images/check-radio.png' width='18' height='18'>";
	
}else{
	$drugreact_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}
	

if($objResult["consultmed"]=="มี"){
	$consultmed_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$consultmed_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["consultmed"]=="ไม่มี"){
	$consultmed_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$consultmed_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["premed"]=="มี"){
	$premed_radio1="<img src='images/check-radio.png' width='18' height='18'>";
	$premed_name="ชื่อยา : ".$objResult["premed_name"];
}else{
	$premed_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["premed"]=="ไม่มี"){
	$premed_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$premed_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}


if($objResult["antiplatelet"]=="มี"){
	$antiplatelet_radio1="<img src='images/check-radio.png' width='18' height='18'>";
	$antiplatelet_drug=" ชื่อยา ".$objResult["antiplatelet_drug"];
}else{
	$antiplatelet_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["antiplatelet"]=="ไม่มี"){
	$antiplatelet_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$antiplatelet_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["withhold"]=="งด"){
	$withhold_radio1="<img src='images/check-radio.png' width='18' height='18'>";
	$holdtime=" งดเมื่อ ".date_th($objResult["holdtime"]);
}else{
	$withhold_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["withhold"]=="ไม่งด"){
	$withhold_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$withhold_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["booking_icu"]=="มี"){
	$booking_icu_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$booking_icu_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["booking_icu"]=="ไม่มี"){
	$booking_icu_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$booking_icu_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["untrasound"]=="ใช้"){
	$untrasound_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$untrasound_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["untrasound"]=="ไม่ใช้"){
	$untrasound_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$untrasound_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["xray_c_arm"]=="ใช้"){
	$xray_c_arm_radio1="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$xray_c_arm_radio1="<img src='images/uncheck-radio.png' width='18' height='18'>";
}

if($objResult["xray_c_arm"]=="ไม่ใช้"){
	$xray_c_arm_radio2="<img src='images/check-radio.png' width='18' height='18'>";
}else{
	$xray_c_arm_radio2="<img src='images/uncheck-radio.png' width='18' height='18'>";
}	
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <title>พิมพ์ใบ SET ผ่าตัด</title>
    <style type="text/css">
		body,td,th {
			font-family: TH SarabunPSK;
			font-size: 18px;
		}
		.font1{
			font-family: "TH SarabunPSK";
			font-size:18px;
		}
		.fontsarabun {
			font-family: "TH SarabunPSK";
			font-size: 18px;
		}

        @media print {
            .no-print,
            .no-print * {
                display: none !important;
            }
        }
		div.iBannerFix{
			font-size:16px;
			height:50px;
			position:fixed;
			left:0px;
			bottom:0px;
			width:100%;
			z-index: 99;
		}		
		
    </style>
</head>

<body>
    <div align="center"></div>
	<div align="center"></div>
	
<table border="0" align="center" width="100%" cellpadding="0">
  <tr>
    <th width="10%" valign="top" align="center"><div style="margin-top:5px;margin-left:20px;"><img src="images/LogoFSH.jpg" width="76px" height="100px"></div></th>
    <th width="70%" valign="top">
	<div style="font-size:28px; font-weight:bold;" align="center">โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</div>
	<div style="margin-top:5px; line-height:25px; font-size:28px; font-weight:bold;" align="center">ใบ SET ผ่าตัด</div>
	<div style="font-size:24px; line-height:30px; font-weight:bold;" align="center">FR-NUR-002/1</div></th>
	<th width="20%" valign="top">
	<img src="printQrCode.php?hn=<?php echo $hn;?>&size=4&level=2&margin=1">
	<div style="line-height:5px;font-size:14px;" align="center"><?php echo $objResult["hn"];?></div>	
	</th>
  </tr>
  <tr >
    <td colspan="3" align="center"><div>
	<span><strong>ชื่อ- นามสกุล : </strong><?php echo $objResult["ptname"];?></span>
	<span style="margin-left:20px;"><strong>เพศ : </strong><?php echo $objResult["sex"];?></span>
	<span style="margin-left:20px;"><strong>อายุ : </strong><?php echo $objResult["age"];?></span>
	<span style="margin-left:20px;"><strong>HN : </strong><?php echo $objResult["hn"];?></span>
	<?php if(!empty($objResult["an"])){ ?>
	<span style="margin-left:20px;"><strong>AN : </strong><?php echo $objResult["an"];?></span>
	<?php }else{ ?>
	<div id="show_an" style="display: none;"><span style="margin-left:20px;"><strong>AN : </strong><?php echo $objResult["an"];?></span></div>	
	<?php } ?>	
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" align="center"><div>
	<span><strong>สิทธิการรักษา : </strong><?php echo $objResult["ptright"];?></span>
	<span style="margin-left:20px;"><strong>น้ำหนัก : </strong><?php echo $objResult["weight"];?> กิโลกรัม</span>
	<span style="margin-left:20px;"><strong>ส่วนสูง : </strong><?php echo $objResult["height"];?> เซนติเมตร</span>
	<span style="margin-left:20px;"><strong>BMI : </strong><?php echo $objResult["bmi"];?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" align="center"><div><hr style="border: 1px solid black;"><div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:100px; font-size:28px;">
	<span><strong>วันที่ผ่าตัด : </strong><?php echo date_th($objResult["date_surg"]);?></span>
	<span style="margin-left:20px;"><strong>เวลาที่ผ่าตัด : </strong><?php echo $objResult["surgery_time"];?></span>
	</div>
	</td>
  </tr>	
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>วันที่ NPO : </strong><?php echo date_th($objResult["date_npotime"]);?></span>
	<span style="margin-left:20px;"><strong>NPO Time : </strong><?php echo $objResult["npo_time"];?></span>
	</div>
	</td>
  </tr>	  
  <tr >
	<td colspan="3" ><div style="margin-left:100px;">
	<span><strong>การวินิจฉัย : </strong><?php echo $objResult["diag"];?></span>
	</div>
	</td>
  </tr>	
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>Operation : </strong><?php echo $objResult["operation"];?></span>
	<span style="margin-left:20px;"><strong>ศัลยแพทย์ : </strong><?php echo $objResult["doctor"];?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>โรคประจำตัว : </strong></span>
	<span style="margin-left:20px;"><?php echo $disease_radio2;?></span><span style="margin-left:10px;">ไม่มี</span>
	<span style="margin-left:50px;"><?php echo $disease_radio1;?></span><span style="margin-left:10px;">มี</span>
	</div>
	</td>
  </tr>
	<!-- ใส่เงื่อนไขแสดงผล -->
	<?php if($objResult["disease"]=="มี"){ ?>
  <tr >
    <td colspan="3" ><div style="margin-left:177px;">
	<span style="margin-left:20px;"><?php echo $disease_ht;?></span><span style="margin-left:10px;">HT</span>
	<span style="margin-left:20px;"><?php echo $disease_dm;?></span><span style="margin-left:10px;">DM</span>
	<span style="margin-left:20px;"><?php echo $disease_dlp;?></span><span style="margin-left:10px;">DLP</span>
	<span style="margin-left:20px;"><?php echo $disease_asthma;?></span><span style="margin-left:10px;">Asthma</span>
	<span style="margin-left:20px;"><?php echo $disease_copd;?></span><span style="margin-left:10px;">COPD</span>
	<span style="margin-left:20px;"><?php echo $disease_kidney;?></span><span style="margin-left:10px;">Kidney Disease</span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:177px;">
	<span style="margin-left:20px;"><?php echo $disease_cad;?></span><span style="margin-left:10px;">โรคระบบหัวใจและหลอดเลือด</span>
	<span style="margin-left:20px;"><?php echo $disease_cad_echo_radio1;?></span><span style="margin-left:10px;">Echo EF</span>
	<span style="margin-left:5px;"><?php echo $disease_cad_detail;?></span>
	<span style="margin-left:20px;"><?php echo $disease_cad_echo_radio2;?></span><span style="margin-left:10px;">ไม่มี Echo</span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:177px;">
	<span style="margin-left:20px;"><?php echo $disease_thyroid;?></span><span style="margin-left:10px;">โรคต่อมไทรอยด์</span>
	<span style="margin-left:20px;"><?php echo $disease_thyroid_lab_ft3;?></span><span style="margin-left:10px;">FT3</span>
	<span style="margin-left:5px;"><?php echo $ft3_detail;?></span>
	<span style="margin-left:20px;"><?php echo $disease_thyroid_lab_ft4;?></span><span style="margin-left:10px;">FT4</span>
	<span style="margin-left:5px;"><?php echo $ft4_detail;?></span>
	<span style="margin-left:20px;"><?php echo $disease_thyroid_lab_tsh;?></span><span style="margin-left:10px;">TSH</span>
	<span style="margin-left:5px;"><?php echo $tsh_detail;?></span>	
	</div>
	</td>
  </tr> 
  <tr >
    <td colspan="3" ><div style="margin-left:177px;">
	<span style="margin-left:20px;"><?php echo $disease_other;?></span><span style="margin-left:10px;">โรคอื่นๆ</span>
	<span style="margin-left:5px;"><?php echo $disease_other_detail;?></span>	
	</div>
	</td>
  </tr>   
	<?php } ?>
	<!-- จบใส่เงื่อนไขแสดงผล -->
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>ประวัติการแพ้ยา : </strong></span>
	<span style="margin-left:13px;"><?php echo $drugreact_radio2;?></span><span style="margin-left:10px;">ไม่แพ้ยา</span>
	<?php
	if($objResult["drugreact"]=="แพ้ยา"){
	?>
	<span style="margin-left:30px; color:red;"><?php echo $drugreact_radio1;?></span><strong style="margin-left:10px; color:red;">แพ้ยา</strong>
	<?php }else{ ?>
	<span style="margin-left:30px;"><?php echo $drugreact_radio1;?></span><span style="margin-left:10px;">แพ้ยา</span>
	<?php
	}
	?>
	<span style="margin-left:15px; color:red;"><?php echo $drugreact_opcard;?></span>
	</div>
	</td>
  </tr>	  
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>ชนิดการระงับความรู้สึก : </strong></span>
	<span style="margin-left:10px;"><?php echo $inhalation_ga_checkbox;?></span><span style="margin-left:10px;">GA</span>
	<span style="margin-left:15px;"><?php echo $inhalation_sa_checkbox;?></span><span style="margin-left:10px;">SA</span>
	<span style="margin-left:15px;"><?php echo $inhalation_bb_checkbox;?></span><span style="margin-left:10px;">BB</span>
	<span style="margin-left:15px;"><?php echo $inhalation_iva_checkbox;?></span><span style="margin-left:10px;">IVA</span>
	<span style="margin-left:15px;"><?php echo $inhalation_la_checkbox;?></span><span style="margin-left:10px;">LA</span>
	<span style="margin-left:15px;"><?php echo $inhalation_ta_checkbox;?></span><span style="margin-left:10px;">TA</span>
	<span style="margin-left:15px;"><?php echo $inhalation_other_checkbox;?></span><span style="margin-left:10px;">อื่นๆ</span>
	<span style="margin-left:10px;"><?php echo $objResult["inhalation_detail"];?></span>
	</div>
	</td>
  </tr>  
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>ประเภท : </strong></span>
	<span style="margin-left:20px;"><?php echo $surgery_type_checkbox1;?></span><span style="margin-left:10px;">Elective</span>
	<span style="margin-left:50px;"><?php echo $surgery_type_checkbox2;?></span><span style="margin-left:10px;">Emergency</span>
	<span style="margin-left:50px;"><?php echo $surgery_type_checkbox3;?></span><span style="margin-left:10px;">On Call</span>
	</div>
	</td>
  </tr>	
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>เอกสารลงนามยินยอมการผ่าตัด : </strong></span>
	<span style="margin-left:20px;"><?php echo $consent_checkbox1;?></span><span style="margin-left:10px;">พร้อม</span>
	<span style="margin-left:50px;"><?php echo $consent_checkbox2;?></span><span style="margin-left:10px;">ไม่พร้อม</span>
	</div>
	</td>
  </tr>	  
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>Glascow Coma Scal</strong></span>
	<span style="margin-left:20px;"><strong>E : </strong><?php echo $glascow_coma_scal_e;?></span>
	<span style="margin-left:50px;"><strong>V : </strong><?php echo $glascow_coma_scal_v;?></span>
	<span style="margin-left:50px;"><strong>M : </strong><?php echo $glascow_coma_scal_m;?></span>
	</div>
	</td>
  </tr>	
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>การหายใจ : </strong></span>
	<span style="margin-left:20px;"><?php echo $respire_radio1;?></span><span style="margin-left:10px;">Room Air</span>
	<span style="margin-left:20px;"><?php echo $respire_radio2;?></span><span style="margin-left:10px;">Canular</span>
	<span style="margin-left:20px;"><?php echo $respire_radio3;?></span><span style="margin-left:10px;">Face Mask</span>
	<span style="margin-left:20px;"><?php echo $respire_radio4;?></span><span style="margin-left:10px;">ET-Tube</span>
	<span style="margin-left:20px;"><?php echo $respire_radio5;?></span><span style="margin-left:10px;">TT-Tube</span>
	</div>
	</td>
  </tr>		
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>XRAY : </strong></span>
	<span style="margin-left:20px;"><?php echo $xray_checkbox1;?></span><span style="margin-left:10px;">CXR</span>
	<span style="margin-left:20px;"><?php echo $xray_checkbox2;?></span><span style="margin-left:10px;">KUB</span>
	<span style="margin-left:20px;"><?php echo $xray_checkbox3;?></span><span style="margin-left:10px;">MRI</span>
	<span style="margin-left:20px;"><?php echo $xray_checkbox4;?></span><span style="margin-left:10px;">CT</span>
	<span style="margin-left:5px;"><?php echo $ct_datail;?></span>
	<span style="margin-left:20px;"><?php echo $xray_checkbox5;?></span><span style="margin-left:10px;">Film Ortho</span>
	<span style="margin-left:5px;"><?php echo $film_ortho_datail;?></span>
	</div>
	</td>
  </tr>	
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>จองเลือด : </strong></span>
	<span style="margin-left:20px;"><?php echo $booking_blood_radio2;?></span><span style="margin-left:10px;">ไม่มี</span>
	<span style="margin-left:20px;"><?php echo $booking_blood_radio1;?></span><span style="margin-left:10px;">จอง</span>
	<span style="margin-left:50px;"><strong>Group เลือด : </strong></span>
	<span style="margin-left:20px;"><?php echo $blood_group_radio1;?></span><span style="margin-left:10px;">A</span>
	<span style="margin-left:20px;"><?php echo $blood_group_radio2;?></span><span style="margin-left:10px;">B</span>
	<span style="margin-left:20px;"><?php echo $blood_group_radio3;?></span><span style="margin-left:10px;">O</span>
	<span style="margin-left:20px;"><?php echo $blood_group_radio4;?></span><span style="margin-left:10px;">AB</span>
	</div>
	</td>
  </tr> 
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>ชนิด : </strong></span>
	<span style="margin-left:20px;"><?php echo $blood_type_radio1;?></span><span style="margin-left:10px;">PRC </span>
	<span style="margin-left:5px;"><?php echo $prc_unit;?></span>
	<span style="margin-left:20px;"><?php echo $blood_type_radio2;?></span><span style="margin-left:10px;">FFP</span>
	<span style="margin-left:5px;"><?php echo $ffp_unit;?></span>
	<span style="margin-left:20px;"><?php echo $blood_type_radio3;?></span><span style="margin-left:10px;">WB</span>
	<span style="margin-left:5px;"><?php echo $wb_unit;?></span>
	<span style="margin-left:20px;"><?php echo $blood_type_radio4;?></span><span style="margin-left:10px;">อื่นๆ</span>
	<span style="margin-left:5px;"><?php echo $other_detail;?></span>
	</div>
	</td>
  </tr>	
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>Confirm เลือด : </strong></span>
	<span style="margin-left:20px;"><?php echo $blood_radio2;?></span><span style="margin-left:10px;">ไม่มี</span>
	<span style="margin-left:50px;"><?php echo $blood_radio1;?></span><span style="margin-left:10px;">มี</span>
	</div>
	</td>
  </tr>	  
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>Consult MED : </strong></span>
	<span style="margin-left:24px;"><?php echo $consultmed_radio2;?></span><span style="margin-left:10px;">ไม่มี</span>
	<span style="margin-left:48px;"><?php echo $consultmed_radio1;?></span><span style="margin-left:10px;">มี</span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>Pre MED : </strong></span>
	<span style="margin-left:20px;"><?php echo $premed_radio2;?></span><span style="margin-left:10px;">ไม่มี</span>
	<span style="margin-left:50px;"><?php echo $premed_radio1;?></span><span style="margin-left:10px;">มี</span>
	<span style="margin-left:10px;"><?php echo $premed_name;?></span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>ยาต้านเกล็ดเลือด/ยาละลายลิ่มเลือด : </strong></span>
	<span style="margin-left:20px;"><?php echo $antiplatelet_radio2;?></span><span style="margin-left:10px;">ไม่มี</span>
	<span style="margin-left:50px;"><?php echo $antiplatelet_radio1;?></span><span style="margin-left:10px;">มี</span><span style="margin-left:10px;"><?php echo $antiplatelet_drug;?></span>
	<!-- ใส่เงื่อนไขแสดงผล -->
	<?php if($objResult["antiplatelet"]=="มี"){ ?>
		<div style="margin-left:198px;">
		<span style="margin-left:10px;"><?php echo $withhold_radio2;?></span><span style="margin-left:10px;">ไม่งด</span>
		<span style="margin-left:45px;"><?php echo $withhold_radio1;?></span><span style="margin-left:10px;">งด</span>
		<span style="margin-left:10px;"><?php echo $holdtime;?></span>
		</div>
	<?php } ?>	
	<!-- จบใส่เงื่อนไขแสดงผล -->		
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>เครื่อง Untrasound : </strong></span>
	<span style="margin-left:20px;"><?php echo $untrasound_radio1;?></span><span style="margin-left:10px;">ใช้</span>
	<span style="margin-left:50px;"><?php echo $untrasound_radio2;?></span><span style="margin-left:10px;">ไม่ใช้</span>
	</div>
	</td>
  </tr>  
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>เครื่อง XRAY C-Arm : </strong></span>
	<span style="margin-left:19px;"><?php echo $xray_c_arm_radio1;?></span><span style="margin-left:10px;">ใช้</span>
	<span style="margin-left:50px;"><?php echo $xray_c_arm_radio2;?></span><span style="margin-left:10px;">ไม่ใช้</span>
	</div>
	</td>
  </tr>
  <tr >
    <td colspan="3" ><div style="margin-left:100px;">
	<span><strong>หมายเหตุ/อื่นๆ </strong></span>
	</div>
	<div style="margin-left:100px;">
	<span style="margin-left:50px;"><?php $comment = wordwrap($objResult["detail"], 255, "<br />\n"); echo $comment;?></span>
	</div>
	</td>
  </tr>   
</table>
<div style="margin-top:50px;"><br></div>
    <!-- ปุ่มพิมพ์ -->
    <div style="margin-top:10px;" align="center" class="no-print">
        <button type="button" class="fontsarabun" onclick="return print();">พิมพ์เอกสาร</button>
    </div>		
<div style="margin-top:30px;"><br></div>
<div class="iBannerFix">
<p align="center" ><?php echo $showdataofficer;?></p>
</div>
</body>

</html>