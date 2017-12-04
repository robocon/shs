<body >
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

<?php

    session_start();

 
   if (isset($hn )){ 

$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");

    
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

   
 include("connect.inc");




// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;

  
// $appd=$cappdate.' '.$cappmo.' '.$cthiyr;
   $appd = $appd;
	
	$patho = "NA";

  
$xray=$xray.' '.$xray2;
	 $xrayall=$xray.' '.$xray2;
 /*$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,
detail,detail2,advice,patho,xray,other,depcode)

	VALUES('$Thidate','$sOfficer','$cHn','$cPtname','$cAge','$cdoctor','$appd','$capptime',

	'$room','$detail','$detail2','$advice','$pathoall','$xrayall','$other','$depcode');";

    
$result = mysql_query($sql);*/
$can=$_POST['an'];
 $idno=mysql_insert_id();

$count = count($_SESSION["list_code"]);

if($count > 0){

	$sql = "INSERT INTO `lab_ward` ( `an` , `code` , `date` )  VALUES ";
		
		$list = array();
		for ($n=0; $n<$count; $n++){
         If (!empty($_SESSION["list_code"][$n])){
                $q = "('".$can."', '".$_SESSION["list_code"][$n]."', '".$Thidate ."')  ";
				array_push($list,$q);
              
		 }
        }
		
		$sql .= implode(", ",$list);

		$result = Mysql_Query($sql) or die("Error appoint_lab ".Mysql_Error());
		$patho = implode(", ",$_SESSION["list_code"]);
}


echo $sql;

echo $count;
echo $can;
$pathoall=$patho.' '.$patho2;


//    echo mysql_errno() . ": " . mysql_error(). "\n";


//    echo "<br>";

   }
?>







