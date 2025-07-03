<?php
session_start();
require_once dirname(__FILE__).'/connect.php';
require_once dirname(__FILE__).'/bootstrap.php';
?>
<html>
<head>
<title>add_druglst</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
</head>
<?php
	//update data in druglst
	if($_POST["typedrug"] == "เม็ด"){
		$typedrug="T01 เม็ด";

	}else if($_POST["typedrug"] == "น้ำ"){
		$typedrug="T02 น้ำ";

	}else if($_POST["typedrug"] == "ฉีด"){
		$typedrug="T03 ฉีด";

	}else{
		$typedrug=$_POST["typedrug"];

	}

	/**
	 * อัพเดทกลุ่มยาที่มีโอกาศแพ้
	 */
	$sOfficer = $_SESSION["sIdname"];
	$drugreactGroup = $_POST['drugreact_group'];
	$sql = sprintf("SELECT * FROM `drugreact_group_list` WHERE `drugcode`='%s' LIMIT 1;", mysql_real_escape_string($drugcode));
	$query = mysql_query($sql);
	$numReactGroup = mysql_num_rows($query);
	if($numReactGroup === 0 && !empty($drugreactGroup)){

		$sqlInsert = sprintf("INSERT INTO `drugreact_group_list` (`drugcode`, `drugreact_group`, `officer`, `last_update`) VALUES ('%s', '%s', '%s', NOW());",
			mysql_real_escape_string($drugcode),
			mysql_real_escape_string($drugreactGroup),
			mysql_real_escape_string($sOfficer)
		);
		$qInsert = mysql_query($sqlInsert);

	}elseif ($numReactGroup > 0 && !empty($drugreactGroup)) {
		$sqlUpdate = sprintf("UPDATE `drugreact_group_list` SET `drugreact_group`='%s', `officer`='%s', `last_update`=NOW() WHERE `drugcode`='%s'",
			mysql_real_escape_string($drugreactGroup),
			mysql_real_escape_string($sOfficer),
			mysql_real_escape_string($drugcode)
		);
		$qUpdate = mysql_query($sqlUpdate);

	}

	if(empty($drugreactGroup)){
		$sqlDel = sprintf("DELETE FROM `drugreact_group_list` WHERE `drugcode`='%s'", mysql_real_escape_string($drugcode));
		$qDelete =mysql_query($sqlDel);
	}
	// อัพเดทกลุ่มยาที่มีโอกาศแพ้
	
	
	//ไม่ได้แก้ไขรหัสยา
	$query ="update druglst SET comcode='$comcode', 
	tradname= '$tradname',
	genname= '$genname ',
	drugname= '$drugname ',
	minimum= '$minimum',
	unit= '$unit ',
	unitpri ='$unitpri ',
	salepri ='$salepri',
	part ='$part',
	freepri= '$freepri ',
	freelimit= '$freelimit',
	slcode=  '$slcode ',
	bcode= '$bcode ',
	edpri = '$edpri ',
	tmt = '$tmt ',
	pack = '$pack',
	packing = '$pack2',
	packpri= '$packpri ',
	packpri_vat= '$packpri_vat ',
	contract = '$contract',	
	edit_date = '".date("Y-m-d")."',
	edit_user = '".$_SESSION["sIdname"]."',
	spec = '".$_POST["spec"]."',
	snspec = '".$_POST["snspec"]."',
	code24 = '".$_POST["code24"]."',
	default_order = '".$_POST["default_order"]."',
	drugtype = '".$_POST["drugtype"]."',
	dpy_code = '".$_POST["dpy_code"]."',
	medical_sup_free = '".$_POST["medical_sup_free"]."',
	status = '".$_POST["status_chdrug"]."',
	typedrug = '".$typedrug."',
	dosecode = '".$_POST["dosecode"]."',
	strength = '".$_POST["strength"]."',
	content = '".$_POST["content"]."',
	product_category = '".$_POST["pro_cat"]."', 
	edpri_from = '".$_POST['edpri_from']."',
	product_drugtype =  '".$_POST['product_drugtype']."',
	grouptype = '".$_POST["grouptype"]."',
	drug_nature = '".$_POST["drug_nature"]."',
	drug_properties = '".$_POST["drug_properties"]."',
	drugnote = '".$_POST["drugnote"]."',  		
	drug_active = '".$_POST["active"]."',
	ised = '".$_POST["ised"]."',
	had = '".$_POST["had"]."',
	drug_innovation =  '".$_POST['drug_innovation']."',
	quantity_box =  '".$_POST['quantity_box']."'		
	WHERE drugcode='$drugcode' limit 1";
	$result = mysql_query($query) or die("Query failed,update druglst");

If(!$result){
	echo "insert into druglst fail";
}else{
	$date=date("Y-m-d H:i:s");
	$sql = "INSERT INTO `drug_edit_log` (`id` ,`update_code`,`date_edit`,`user_edit`) VALUES (NULL , '".mysql_real_escape_string($query)."', '$date', '".$_SESSION["sIdname"]."');";
	$query = mysql_query($sql);   
	echo "บันทึกแก้ไขข้อมูลเรียบร้อย";

	if(DEV === false){
		sendTelgramMsg('✏️ '.$_SESSION['sIdname'].' ได้แก้ไขข้อมูลยา/เวชภัณฑ์ ('.$drugcode.')');
	}
	?>
	<script>
		setTimeout(function() {
			window.location.href = "dglst.php";
		}, 2000);
	</script>
	<?php

}
?>