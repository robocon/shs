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

$arr1=array("���Ҥ�" => "01" ,"����Ҿѹ��" => "02", "�չҤ�" => "03" , "����¹" => "04" ,"����Ҥ�" => "05" ,"�Զع�¹" => "06" , "�á�Ҥ�" => "07" , "�ԧ�Ҥ�" => "08" , "�ѹ��¹" => "09" , "���Ҥ�"  => "10" , "��Ȩԡ�¹" => "11" ,  "�ѹ�Ҥ�" => "12" );

$appday=$y1.'-'.$arr1[$m1].'-'.$d1;



$DayOfWeek = date("w", strtotime($appday));
	

	
switch ($DayOfWeek) {
case "0":
	$day="�ҷԵ��";
    break;
case "1":
	$day="�ѹ���";
    break;
case "2":
	$day="�ѧ���";
    break;
case "3":
	$day="�ظ";
    break;
case "4":
	$day="����ʺ��";
    break;
case "5":
	$day="�ء��";
    break;
case "6":
	$day="�����";
    break;
}

   if (isset($cHn )){ 



  
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
$Thidate = (date("Y")+543).date("-m-d H:i:s"); 
  





// $appd=$cappdate.'-'.$cappmo.'-'.$cthiyr;

  
//    echo mysql_errno() . ": " . mysql_error(). "\n";


//    echo "<br>";

  
 

//�����㺹Ѵ


 
  $doctor=substr($doctor,5);

   $depcode=substr($depcode,4);

    
  
 print "<center><font face='Angsana New' size='2'>$cPtname </font><br>";
  print "<center><font face='Angsana New' size='2'>HN: $cHn </font><br>";
 print "<font face='Angsana New' size='2'> �ѹ$day ��� $appd &nbsp; </b></FONT>";
echo "<br><font face='Angsana New' size='2'>ᾷ����Ѵ:&nbsp; $cdoctor</center></b>";


   };

      

 include("unconnect.inc");
?>







