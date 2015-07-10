<body >

<html>
<head>
<title>ออกใบนัด</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">
<!-- <meta http-equiv="refresh" content="3;URL=hnappoi1.php"> -->

</head>
<?php

    session_start();

 
   if (isset($cHn )){ 



  
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

   
 include("connect.inc");

if($detail=="FU13 ตรวจระบบทางเดินอาหาร"){
	$detail2=$detail_list;
}



// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;

  
// $appd=$cappdate.' '.$cappmo.' '.$cthiyr;
   $appd = $appd;
	
	$patho = "NA";

  
$xray=$xray.' '.$xray2;
	 $xrayall=$xray.' '.$xray2;


	 $count = count($_SESSION["list_code"]);

if($count > 0){

	$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
              
		 }
        }
		
		$sql .= implode(", ",$list);

		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
}

$pathoall=$patho.' '.$patho2;

$sqltel = "update opcard SET phone='".$_POST['telp']."' where hn='".$cHn."'";
$result = mysql_query($sqltel);
	
	
  $sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
detail,detail2,advice,patho,xray,other,depcode,labextra)

	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',

	'$room','$detail','$detail2','$advice','$pathoall','$xrayall','$other','$depcode','$labm');";

    
$result = mysql_query($sql);
 $idno=mysql_insert_id();

$count = count($_SESSION["list_code"]);

if($count > 0){

	$sql = "INSERT INTO `appoint_lab` ( `id` , `code` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$idno."', '".$_SESSION["list_code"][$n]."')  ";
				array_push($list,$q);
              
		 }
        }
		
		$sql .= implode(", ",$list);

		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
}

$pathoall=$patho.' '.$patho2;


//    echo mysql_errno() . ": " . mysql_error(). "\n";


//    echo "<br>";

  
 

//พิมพ์ใบนัด
$doctor=substr($doctor,5);
$depcode=substr($depcode,4);

if($result){
	


//echo "<meta http-equiv=refresh content=1;URL=dt_printstikerappoint.php?hn=$cHn>";
$_GET['hn']=$cHn;	
include("dt_printstikerappoint.php");
?>
<SCRIPT LANGUAGE="JavaScript">

window.onload = function(){
	window.print();
	opener.location.href='hnappoi1.php';
	
	window.open('','_self');
	self.close(); 
	
}
</SCRIPT>
<?
}
    
   }

?>







