<?php 
session_start();
?>
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=dglst.php">
</head>


<?php
    include("connect.inc");

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

	if($_POST["typedrug"] == "���")
		{
			$typedrug="T01 ���";
	}else if($_POST["typedrug"] == "���")
		{
			$typedrug="T02 ���";
	}else if($_POST["typedrug"] == "�մ")
		{
			$typedrug="T03 �մ";
	}else{
			$typedrug=$_POST["typedrug"];
	}
	//��������������
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
		product_category = '".$_POST["pro_cat"]."', 
		edpri_from = '".$_POST['edpri_from']."',
		product_drugtype =  '".$_POST['product_drugtype']."',
		grouptype = '".$_POST["grouptype"]."',
		drug_nature = '".$_POST["drug_nature"]."',
		drug_properties = '".$_POST["drug_properties"]."',
		drugnote = '".$_POST["drugnote"]."'  		
        WHERE drugcode='$drugcode' limit 1";
//echo $query;
        $result = mysql_query($query)
                       or die("Query failed,update druglst");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

		

   If (!$result){
        echo "insert into druglst fail";
                    }
   else {
	   
	   $sql = "INSERT INTO `drug_edit_log` (`id` ,`update_code`) VALUES (NULL , '".mysql_real_escape_string($query)."');";
	   $query = mysql_query($sql);
	   
        echo "�ѹ�֡��䢢��������º����";
          }
include("unconnect.inc");
?>


