<?php
$yy=543;
$thiyr1=$thiyr-$yy;
$thiyr2=$thiyr;
    $yrmonth="$thiyr1-$rptmo";
	$yrmonth1="$thiyr2-$rptmo";
    include("connect.inc");

    $query="CREATE TEMPORARY TABLE reportnhso04 SELECT hn,date_in,refer_hospital,cure,an  FROM trauma WHERE date_in  LIKE '$yrmonth1%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
	 $query="CREATE TEMPORARY TABLE reportnhso041 SELECT clinic,vn,thdatehn FROM opday WHERE  thidate  LIKE '$yrmonth1%'  ";
    $result = mysql_query($query) or die("Query failed,warphar1");
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่04 ORF ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
print " </tr>";

 $query=" SELECT reportnhso04.hn,reportnhso04.date_in,reportnhso04.refer_hospital,reportnhso04.cure,reportnhso04.an FROM reportnhso04  WHERE reportnhso04.cure = 'refer' ";
   $result = mysql_query($query);
    while (list ($hn,$date_in,$refer_hospital,$cure,$an) = mysql_fetch_row ($result)) {	
		$num1=1;
$num3=0;
$num9=0;
$num8=1;
  $d=substr($date_in,8,2);
    $m=substr($date_in,5,2); 
   $y=substr($date_in,0,4); 
   $y2=substr($y,2,2);
 $y1=$y-$yy;

$thidatehn1="$d-$m-$y$hn";

if($an==''){$seq=$date1.''.$vn;}else {$seq=$date1.''.$an;};

   $sql = "Select clinic,vn From reportnhso041 where thdatehn='$thidatehn1'  limit 1";
$result3 = Mysql_Query($sql);
list($clinic,$vn) = Mysql_fetch_row($result3);
   
 //   $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
   $clinic1=substr($clinic,0,2);
    $vn=sprintf('%03d',$vn);

$referh1=substr($referh,0,2);
$refertype1=substr($refertype,0,1);

if($refer_hospital=='โรงพยาบาลลำปาง'){$refer_hospital1="10672";}
else {$refer_hospital1=$refer_hospital;};



        print (" <tr>\n".
             "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$date1|$num1$clinic1$num3|$refer_hospital1|2|$date1$vn</td>\n".
             " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>