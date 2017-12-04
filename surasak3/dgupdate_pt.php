<?php 
session_start();
?>
<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<meta http-equiv="refresh" content="1;URL=dglst_pt.php">
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

	if($_POST["typedrug"] == "àÁç´")
		{
			$typedrug="T01 àÁç´";
	}else if($_POST["typedrug"] == "¹éÓ")
		{
			$typedrug="T02 ¹éÓ";
	}else if($_POST["typedrug"] == "©Õ´")
		{
			$typedrug="T03 ©Õ´";
	}else{
			$typedrug=$_POST["typedrug"];
	}
	
 $query ="update druglst_pt SET comcode='$comcode', 

  		tradname= '$tradname',
 		genname= '$genname ',
		drugname= '$drugname ',
		minimum= '$minimum',
  		unit= '$unit ',
  		unitpri ='$unitpri ',
  		salepri ='$salepri',
  		part ='$part',
		stock= '$stock',
  		mainstk='$mainstk',
  		totalstk=  '$totalstk ',
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
		product_category = '".$_POST["pro_cat"]."' 
        WHERE drugcode='$drugcode' limit 1";

        $result = mysql_query($query)
                       or die("Query failed,update druglst_pt");
//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";
   If (!$result){
        echo "insert into druglst_pt fail";
                    }
   else {
        echo "ºÑ¹·Ö¡á¡éä¢¢éÍÁÙÅàÃÕÂºÃéÍÂ";
          }
include("unconnect.inc");
?>


