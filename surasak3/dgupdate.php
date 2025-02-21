<?php 
session_start();
include("connect.inc");
require_once dirname(__FILE__).'/bootstrap.php';
?>
<html>
<head>
<title>add_druglst</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=dglst.php">
</head>


<?php
function sendText($text){
	$curl = curl_init(); 
	curl_setopt( $curl, CURLOPT_URL, NOTIFY_HOST."/telegram/index.php?sMessage=".urlencode($text).'&type=phar');
	curl_setopt( $curl, CURLOPT_HEADER, 0);
	curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $curl ); 
	curl_close($curl); 

}
//update data in druglst
/*       $query ="update druglst SET comcode='$comcode', 
  		drugcode = '$drugcode ',
  		tradname= '$tradname',
 		genname= '$genname ',
		minimum= '$minimum',
  		unit= '$unit ',
  		unitpri ='$unitpri ',
  		salepri ='$salepri',
  		part ='$part',
  		freepri= '$freepri ',
		freelimit= '$freelimit',
 		stock= '$stock',
  		mainstk='$mainstk',
  		totalstk=  '$totalstk ',
  		slcode=  '$slcode ',
  		bcode= '$bcode ',
 		edpri = '$edpri ',
 		pack = '$pack',
 		packpri= '$packpri ',
packpri_vat= '$packpri_vat ',
  		contract = '$contract',
		edit_date = '".date("Y-m-d")."',
		edit_user = '".$_SESSION["sIdname"]."'
                       WHERE drugcode='$drugcode' ";
*/

	if($_POST["typedrug"] == "เม็ด")
		{
			$typedrug="T01 เม็ด";
	}else if($_POST["typedrug"] == "น้ำ")
		{
			$typedrug="T02 น้ำ";
	}else if($_POST["typedrug"] == "ฉีด")
		{
			$typedrug="T03 ฉีด";
	}else{
			$typedrug=$_POST["typedrug"];
	}
	
	if(isset($_POST["drugreact_group1"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group1"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 1
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group1"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '1'";
		mysql_query($del);			

	}
	

	if(isset($_POST["drugreact_group2"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group2"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 2
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group2"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '2'";
		mysql_query($del);			

	}	
	

	if(isset($_POST["drugreact_group3"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group3"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 3
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group3"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '3'";
		mysql_query($del);			

	}	
	
	
	if(isset($_POST["drugreact_group4"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group4"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 4
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group4"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '4'";
		mysql_query($del);			

	}	
	
	
	if(isset($_POST["drugreact_group5"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group5"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 5
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group5"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '5'";
		mysql_query($del);			

	}	
	
	
	if(isset($_POST["drugreact_group6"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group6"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 6
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group6"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '6'";
		mysql_query($del);			

	}	


	if(isset($_POST["drugreact_group7"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group7"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 7
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group7"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '7'";
		mysql_query($del);			

	}	
	

	if(isset($_POST["drugreact_group8"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group8"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 8
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group8"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '8'";
		mysql_query($del);			

	}


	if(isset($_POST["drugreact_group9"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group9"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 9
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group9"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '9'";
		mysql_query($del);			

	}	
	
	
	if(isset($_POST["drugreact_group10"])){  //ถ้ามีตัวแปรนี้
		$strsql="select * from drugreact_group_list where drugcode='$drugcode' and drugreact_group='".$_POST["drugreact_group10"]."'";
		$strquery=mysql_query($strsql);
		$strnum=mysql_num_rows($strquery);
		if($strnum < 1){  //ถ้ายาชนิดนี้ไม่มีการลงโอกากาสแพ้ยากลุ่มที่ 10
			$add="insert into drugreact_group_list SET officer='".$_SESSION["sIdname"]."', last_update='".date("Y-m-d H:i:s")."', drugcode='$drugcode', drugreact_group='".$_POST["drugreact_group10"]."'";
			mysql_query($add);
		}
	}else{
		$del="DELETE FROM `drugreact_group_list` WHERE drugcode='$drugcode' and `drugreact_group` = '10'";
		mysql_query($del);			

	}	
	
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
//echo $query;
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

		

If(!$result){
	echo "insert into druglst fail";
}else{
	$date=date("Y-m-d H:i:s");
	$sql = "INSERT INTO `drug_edit_log` (`id` ,`update_code`,`date_edit`,`user_edit`) VALUES (NULL , '".mysql_real_escape_string($query)."', '$date', '".$_SESSION["sIdname"]."');";
	$query = mysql_query($sql);   
	echo "บันทึกแก้ไขข้อมูลเรียบร้อย";

	sendText('✏️ '.$_SESSION['sIdname'].' ได้แก้ไขข้อมูลยา/เวชภัณฑ์ ('.$drugcode.')');

}
include("unconnect.inc");
?>


