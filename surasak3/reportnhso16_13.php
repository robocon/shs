<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
$yy=543;
$inj="opd";
    //$query="CREATE TEMPORARY TABLE reportnhso13 SELECT date,vn,hn,an,trauma,cure,refer_hospital,time_in,date_in  FROM trauma WHERE date LIKE '$yrmonth%' and trauma<>'$inj' ";
//    $result = mysql_query($query) or die("Query failed,warphar0");
    
	 $query="CREATE TEMPORARY TABLE opday13 SELECT ptright,vn,thdatehn FROM opday WHERE  thidate  LIKE '$yrmonth%'  ";

   $result = mysql_query($query) or die("Query failed,warphar1");
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่13 AER ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>"; 
print " </tr>";
 $query="SELECT date,hn,an,vn,trauma,cure,refer_hospital,time_in,date_in  FROM trauma WHERE date LIKE '$yrmonth%' and trauma<>'$inj' ";
   $result = mysql_query($query);
    while (list ($date,$hn,$an,$vn,$trauma,$cure,$refer_hospital,$time_in,$date_in ) = mysql_fetch_row ($result)) {	


$num2=543;
    $d=substr($date,8,2);
    $m=substr($date,5,2); 
   $y=substr($date,0,4); 
 $y1=$y-$num2;


     $d9=substr($date_in,8,2);
    $m9=substr($date_in,5,2); 
   $y9=substr($date_in,0,4); 


   $y99=$y9-$num2;
   $y2=substr($y1,2,2);

   $vn=sprintf('%03d',$vn);

$thidatehn1="$d-$m-$y$hn";
//	print "$thidatehn1";
		
$sql = "Select ptright,vn From opday13 where thdatehn='$thidatehn1'  limit 1";
$result3 = Mysql_Query($sql);
list($ptright,$vn1) = Mysql_fetch_row($result3);

// $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
$date2="$y99$m9$d9";
//$datem1=date_format(datem,'%d/ %m/ %Y');

if($trauma=='trauma'){$trauma1="A";}
else if ($trauma=='nontrauma'){$trauma1="E";}
else {$trauma1="";};

if($refer_hospital=='โรงพยาบาลลำปาง'){$refer_hospital="11111";};

if($refer_hospital=='โรงพยาบาลลำปาง'){$oreftypt="1100";};

if($ptright=='R06 พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ'){$ptright1="V";}
else if($ptright=='R08 ก.ท.44(บาดเจ็บในงาน)'){$ptright1="O";}
else{$ptright1="";};
 $vn1=sprintf('%03d',$vn1);

        print (" <tr>\n".
   "<td><font face='Angsana New'>$hn|$an|$date1||$date2|$time_in|$ptright1|||$refer_hospital|$oreftypt|$trauma1|1|$date1$vn1</td>\n");
       
           echo (" </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>