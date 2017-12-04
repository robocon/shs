<body Onload="window.print();">

<html>
<head>
<title>add_user</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
<link href="css/backoffice.css" rel="stylesheet" type="text/css">

</head>
<?php

    session_start();

  include("connect.inc");

  $sql = " Select a.row_id, a.date, a.officer, a.hn, a.ptname, a.age, a.doctor, a.appdate, a.apptime, a.room, a.detail, a.detail2, a.advice, a.patho, a.xray, a.other, a.depcode, b.idguard, b.ptright From appoint as a INNER JOIN opcard as b ON a.hn=b.hn where a.row_id = '".$_GET["row_id"]."'  limit 1 ";
  list($row_id, $date, $officer, $cHn, $cPtname, $cAge, $cdoctor, $appd, $capptime, $room, $detail, $detail2, $advice, $patho, $xray, $other, $depcode,$cidguard,$cptright) = Mysql_fetch_row(Mysql_Query($sql));

  
  
     $exm=explode(" ",$appd);

$d1=$exm[0]; 
$m1=trim($exm[1]); 
$y1= $exm[2]-543; 

$arr1=array("มกราคม" => "01" ,"กุมภาพันธ์" => "02", "มีนาคม" => "03" , "เมษายน" => "04" ,"พฤษภาคม" => "05" ,"มิถุนายน" => "06" , "กรกฎาคม" => "07" , "สิงหาคม" => "08" , "กันยายน" => "09" , "ตุลาคม"  => "10" , "พฤศจิกายน" => "11" ,  "ธันวาคม" => "12" );

$appday=$y1.'-'.$arr1[$m1].'-'.$d1;



$DayOfWeek = date("w", strtotime($appday));
	

	
switch ($DayOfWeek) {
case "0":
	$day="อาทิตย์";
    break;
case "1":
	$day="จันทร์";
    break;
case "2":
	$day="อังคาร";
    break;
case "3":
	$day="พุธ";
    break;
case "4":
	$day="พฤหัสบดี";
    break;
case "5":
	$day="ศุกร์";
    break;
case "6":
	$day="เสาร์";
    break;
}

   if (isset($cHn )){ 



  
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  





// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;

  
//    echo mysql_errno() . ": " . mysql_error(). "\n";


//    echo "<br>";

  
 

//พิมพ์ใบนัด


 
  $doctor=substr($doctor,5);

   $depcode=substr($depcode,4);

    
  
 print "<center><font face='Angsana New' size='2'>$cPtname </font><br>";
  print "<center><font face='Angsana New' size='2'>HN: $cHn </font><br>";
 print "<font face='Angsana New' size='2'> วัน$day ที่ $appd &nbsp; </b></FONT>";
echo "<br><font face='Angsana New' size='2'>แพทย์ผู้นัด:&nbsp; $cdoctor</center></b>";


   };

      

 include("unconnect.inc");
?>







