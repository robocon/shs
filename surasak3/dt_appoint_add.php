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
	
	case "���Ҥ�":  $month = "01"; break;
	case "����Ҿѹ��":  $month = "02"; break;
	case "�չҤ�":  $month = "03"; break;
	case "����¹":  $month = "04"; break;
	case "����Ҥ�":  $month = "05"; break;
	case "�Զع�¹":  $month = "06"; break;
	case "�á�Ҥ�":  $month = "07"; break;
	case "�ԧ�Ҥ�": $month = "08";  break;
	case "�ѹ��¹":  $month = "09"; break;
	case "���Ҥ�":  $month = "10"; break;
	case "��Ȩԡ�¹":  $month = "11"; break;
	case "�ѹ�Ҥ�":  $month = "12"; break;

}

// �ҤӨҡ Y-m-d
$th_day = array(1 => '�ѹ���', '�ѧ���', '�ظ', '����ʺ��', '�ء��', '�����', '�ҷԵ��');
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
	$other2 .= $comma." ��ҵѴ : ".$_POST["operate"];
}

if($_POST["inj"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." �Ѥ�չ : <u>".$_POST["inj"]."</u>";
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
AND apptime <> '¡��ԡ��ùѴ' ";
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

setcookie($xxx[0].$month.$xxx[2], "<A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".$_POST["date_appoint"]."';\" >".$_POST["date_appoint"]."</A>(".$c_app." ��)&nbsp;".$length_m."&nbsp;<A HREF=\"javascript:void(0);\" Onclick=\"deletecookie('".$xxx[0].$month.$xxx[2]."')\">[X]</A>", time()+(3600*6));

$down_list = "";

	if($_POST["xray"] != ""){
		$down_list .= "X-ray : ".$_POST["xray"];
	}

	if($other2 != ""){
		$down_list .= "&nbsp;&nbsp;&nbsp;&nbsp;���� : ".$other2."";
	}

if($_SESSION["dt_drugstk"] != ""){
		$_SESSION["dt_drugstk"].= "<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >�ѹ��� ".$_POST["date_appoint"]."&nbsp;���� : ".$_POST["capptime"]."</p>
			<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >�Ѵ������ : ".substr($_POST["detail"],5)."</p>";
		
		if(count($_POST["list_lab_appoint"]) > 0){
			$_SESSION["dt_drugstk"].= "<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >�Ѵ��Ǩ�ҧ��Ҹ� : ".$lab_appoint_implode."</p>";
		}
			
		
		
		if(trim($down_list) !=""){
			$_SESSION["dt_drugstk"] .="<p style=\"font-family:'MS Sans Serif'; font-size:12px;margin:0;\" >".$down_list."</p>";
		}
		
		$_SESSION["dt_drugstk"].= "<DIV style=\"page-break-after:always\"></DIV>";
}

if(substr($_POST["detail"],0 ,1) == "F"){
	$_POST["detail"] = substr($_POST["detail"],5);
}

$xxx = explode("(�",$_SESSION["dt_doctor"]);
$doctor = $xxx[0];

$_SESSION["dt_drugstk"] .= "<div class=\"appoint_zone\">";

$_SESSION["dt_drugstk"] .= "<p class=\"size3\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<B>㺹Ѵ������ þ.��������ѡ�������� �ӻҧ</B></p>
<p class=\"size2\" >���� : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</p>
<p class=\"size3\" ><B><U>�ѹ�Ѵ ".$th_day[$test_n]." ��� ".$_POST["date_appoint"]."</U></B></p>
<p class=\"size3\" ><B>���� : ".$_POST["capptime"]."</B></p>
<p class=\"size2\" ><U><B>���㺹Ѵ��� :</B> ".$_POST["room"]."</U> <B>����:</B>".$_POST["detail"]." ".(trim($_POST["detail2"]) !=''?"(".$_POST["detail2"].")":"")."</p>
<p class=\"size2\" style=\"margin-top: 2px;\" ><B>ᾷ�� :</B> ".$doctor."</p>";

if($i){
	$_SESSION["dt_drugstk"] .="<p class='size2' >LAB : ".$lab_appoint_implode."</p>";
}

if(trim($_POST["xray"]) !=""){
	$_SESSION["dt_drugstk"] .="<p class='size2' >".$down_list."</p>";
}

$_SESSION["dt_drugstk"] .="<p class='size2' >�ѹ�����͡㺹Ѵ : ".date("d/m/Y H:i:s")."</p>";
			
if($_POST['room']=="�ͧ�ٵ�-����"){
	$_SESSION["dt_drugstk"] .= "<p class='size2' > �բ��ʧ��µԴ��ͨش��ԡ�ùѴ �� 054-839305 ��� 5111</p>";
}else{

	$default_phone = '1100, 1125';
	if( $_SESSION['sIdname'] == 'md32166' OR $_SESSION['sIdname'] == 'md29268' ){
		$default_phone = '2111, 2112';
	}
	
	$_SESSION["dt_drugstk"] .= "<p class=\"size2\">�բ��ʧ��µԴ��ͨش��ԡ�ùѴ �� 054-839305 ��� $default_phone</p>";
}

if($i){
	$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>
	<p class=\"size3\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>㺹Ѵ��Ǩ�ҧ��Ҹ�</b></p>
	<p class=\"size2\" >���ͼ����� : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</p>
	<p class=\"size3\" ><B><U>�Ѵ�ѹ��� : ".$_POST["date_appoint"]."</U></B></p>
	<p class=\"size2\" >ᾷ�� : ".$doctor."</p>
	<p class=\"size2\" >��ͤ�û�Ժѵ� : <U>".$_POST["advice"]."</U></p>
	<p class=\"size2\" >��¡�� : <B>".$lab_appoint_implode."</B></p>
	<p class=\"size2\" >".$other2."</p>";
}

if(trim($_POST["xray"]) !=""){
	$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>
	<p class=\"size3\" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>㺹Ѵ X-Ray</b></p>
	<p class=\"size2\" >���ͼ����� : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</p>
	<p class=\"size3\" ><B><U>�Ѵ�ѹ��� : ".$_POST["date_appoint"]."</U></B></p>
	<p class=\"size2\" >ᾷ�� : ".$doctor."</p>
	<p class=\"size2\" >X-Ray : <B>".$_POST["xray"]."</B></p>
	<p class=\"size2\" >".$other2."</p>";
}

$_SESSION["dt_drugstk"] .= "</div>"; // End appoint

$_SESSION['dt_drugstk'] .= '<div style="page-break-after:always;"></div><img src="printQrCode.php?hn='.$_SESSION['hn_now'].'">';

header('Location: dt_printstker.php');
exit;
?>