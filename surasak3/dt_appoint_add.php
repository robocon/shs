<?php
session_start();
include("connect.inc");

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

$cPtname = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];
$cAge = $_SESSION["age_now"];

$sql = "Select mdcode From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1";
list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));

$sql = "Select name From doctor where name like '".$mdcode."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));

$xxx = explode(" ",$_POST["date_appoint"]);

switch($xxx[1]){
	
	case "มกราคม":  $month = "01"; break;
	case "กุมภาพันธ์":  $month = "02"; break;
	case "มีนาคม":  $month = "03"; break;
	case "เมษายน":  $month = "04"; break;
	case "พฤษภาคม":  $month = "05"; break;
	case "มิถุนายน":  $month = "06"; break;
	case "กรกฎาคม":  $month = "07"; break;
	case "สิงหาคม": $month = "08";  break;
	case "กันยายน":  $month = "09"; break;
	case "ตุลาคม":  $month = "10"; break;
	case "พฤศจิกายน":  $month = "11"; break;
	case "ธันวาคม":  $month = "12"; break;

}

// หาคำจาก Y-m-d
$th_day = array(1 => 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์', 'อาทิตย์');
$test_n = date('N', strtotime(( $xxx['2'] - 543 ).'-'.$month.'-'.$xxx['0']));

if(count($_POST["list_lab_appoint"]) > 0)
$lab_appoint_implode = @implode(", ",$_POST["list_lab_appoint"]);

$other2 = "";


if($_POST["other"] != ""){
	$other2 .= $_POST["other"];
}

if($_POST["operate"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." ผ่าตัด : ".$_POST["operate"];
}

if($_POST["inj"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." วัคซีน : <u>".$_POST["inj"]."</u>";
}

$en_day = $xxx['0'];
$en_year = $xxx['2'];
$appdate_en = ($en_year-543).'-'.$month.'-'.sprintf('%02d', $en_day);

$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode,`appdate_en`)VALUES('".$Thidate."','".$_SESSION["dt_doctor"]."','".$_SESSION["hn_now"]."','".$cPtname."','".$cAge."','".$appoint_doctor."','".$_POST["date_appoint"]."','".$_POST["capptime"]."','".$_POST["room"]."','".$_POST["detail"]."','".$_POST["detail2"]."','".$_POST["advice"]."','".$lab_appoint_implode."','".$_POST["xray"]."','".$other2."','".$_POST["depcode"]."','$appdate_en');";
Mysql_Query($sql);

$row_id = @mysql_insert_id();
$i=false;
if(count($_POST["list_lab_appoint"]) > 0)
	foreach($_POST["list_lab_appoint"] as $key => $value){
		$sql = "INSERT INTO `appoint_lab` ( `id` , `code` ) VALUES ('".$row_id."', '".$value."'); ";
		Mysql_Query($sql);
		$i = true;
	}

$sql = "Select count(distinct hn) as c_app 
From appoint 
where appdate = '".$_POST["date_appoint"]."' 
AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') 
AND apptime <> 'ยกเลิกการนัด' ";
$result = Mysql_Query($sql) or die(mysql_error());
list($c_app) = Mysql_fetch_row($result);

if(date("m") > $month){
	$month +=12; 
	$length_m = $month - date("m");
	$length_m = "(".$length_m."M)";

}else if(date("m") < $month){
	$length_m = $month - date("m");
	$length_m = "(".$length_m."M)";
}

setcookie($xxx[0].$month.$xxx[2], "<A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".$_POST["date_appoint"]."';\" >".$_POST["date_appoint"]."</A>(".$c_app." คน)&nbsp;".$length_m."&nbsp;<A HREF=\"javascript:void(0);\" Onclick=\"deletecookie('".$xxx[0].$month.$xxx[2]."')\">[X]</A>", time()+(3600*6));

$down_list = "";

	if($_POST["xray"] != ""){
		$down_list .= "X-ray : ".$_POST["xray"];
	}

	if($other2 != ""){
		$down_list .= "&nbsp;&nbsp;&nbsp;&nbsp;อื่นๆ : ".$other2."";
	}

if($_SESSION["dt_drugstk"] != ""){
		$_SESSION["dt_drugstk"].= "<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >วันที่ ".$_POST["date_appoint"]."&nbsp;เวลา : ".$_POST["capptime"]."</p>
			<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >นัดมาเพื่อ : ".substr($_POST["detail"],5)."</p>";
		
		if(count($_POST["list_lab_appoint"]) > 0){
			$_SESSION["dt_drugstk"].= "<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >นัดตรวจทางพยาธิ : ".$lab_appoint_implode."</p>";
		}
			
		
		
		if(trim($down_list) !=""){
			$_SESSION["dt_drugstk"] .="<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >".$down_list."</p>";
		}
		
		$_SESSION["dt_drugstk"].= "<DIV style=\"page-break-after:always\"></DIV>";
}

if(substr($_POST["detail"],0 ,1) == "F"){
	$_POST["detail"] = substr($_POST["detail"],5);
}

$xxx = explode("(ว",$_SESSION["dt_doctor"]);
$doctor = $xxx[0];

$_SESSION["dt_drugstk"] .= "<div class=\"appoint_zone\">";

$_SESSION["dt_drugstk"] .= "<p class=\"size3\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี ลำปาง</B></p>
<p class=\"size2\" >ชื่อ : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</p>
<p class=\"size3\" ><B><U>วันนัด ".$th_day[$test_n]." ที่ ".$_POST["date_appoint"]."</U></B></p>
<p class=\"size3\" ><B>เวลา : ".$_POST["capptime"]."</B></p>
<p class=\"size2\" ><U><B>ยื่นใบนัดที่ :</B> ".$_POST["room"]."</U> <B>เพื่อ:</B>".$_POST["detail"]." ".(trim($_POST["detail2"]) !=''?"(".$_POST["detail2"].")":"")."</p>
<p class=\"size2\" style=\"margin-top: 2px;\" ><B>แพทย์ :</B> ".$doctor."</p>";

if($i){
	$_SESSION["dt_drugstk"] .="<p class='size2' >LAB : ".$lab_appoint_implode."</p>";
}

if(trim($_POST["xray"]) !=""){
	$_SESSION["dt_drugstk"] .="<p class='size2' >".$down_list."</p>";
}

$_SESSION["dt_drugstk"] .="<p class='size2' >วันเวลาออกใบนัด : ".date("d/m/Y H:i:s")."</p>";
			
if($_POST['room']=="กองสูติ-นารี"){
	$_SESSION["dt_drugstk"] .= "<p class='size2' > มีข้อสงสัยติดต่อจุดบริการนัด โทร 054-839305 ต่อ 5111</p>";
}else{

	$default_phone = '1100, 1125';
	if( $_SESSION['sIdname'] == 'md32166' OR $_SESSION['sIdname'] == 'md29268' ){
		$default_phone = '2111, 2112';
	}
	
	$_SESSION["dt_drugstk"] .= "<p class=\"size2\">มีข้อสงสัยติดต่อจุดบริการนัด โทร 054-839305 ต่อ $default_phone</p>";
}

if($i){
	$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>
	<p class=\"size3\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ใบนัดตรวจทางพยาธิ</b></p>
	<p class=\"size2\" >ชื่อผู้ป่วย : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</p>
	<p class=\"size3\" ><B><U>นัดวันที่ : ".$_POST["date_appoint"]."</U></B></p>
	<p class=\"size2\" >แพทย์ : ".$doctor."</p>
	<p class=\"size2\" >ข้อควรปฏิบัติ : <U>".$_POST["advice"]."</U></p>
	<p class=\"size2\" >รายการ : <B>".$lab_appoint_implode."</B></p>
	<p class=\"size2\" >".$other2."</p>";
}

if(trim($_POST["xray"]) !=""){
	$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>
	<p class=\"size3\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>ใบนัด X-Ray</b></p>
	<p class=\"size2\" >ชื่อผู้ป่วย : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</p>
	<p class=\"size3\" ><B><U>นัดวันที่ : ".$_POST["date_appoint"]."</U></B></p>
	<p class=\"size2\" >แพทย์ : ".$doctor."</p>
	<p class=\"size2\" >X-Ray : <B>".$_POST["xray"]."</B></p>
	<p class=\"size2\" >".$other2."</p>";
}

$_SESSION["dt_drugstk"] .= "</div>"; // End appoint

$_SESSION['dt_drugstk'] .= '<div style="page-break-after:always;"></div><img src="printQrCode.php?hn='.$_SESSION['hn_now'].'">';

header('Location: dt_printstker.php');
exit;
?>