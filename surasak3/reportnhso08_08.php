<?php
$yy=543;
$thiyr1=$thiyr-$yy;
    $yrmonth="$thiyr1-$rptmo";
    include("connect.inc");

    $query="CREATE TEMPORARY TABLE reportnhso08 SELECT an,referh,refertype FROM refer WHERE dateopd  LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่08 IRF ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
print " </tr>";
//  $query="SELECT * FROM reportnhso04 ";

 $query=" SELECT reportnhso08.an,reportnhso08.referh,reportnhso08.refertype  FROM reportnhso08  WHERE reportnhso08.an <> '' ";
   $result = mysql_query($query);
    while (list ($an,$referh,$refertype) = mysql_fetch_row ($result)) {	
$num9=0;
$num8=1;
  $d=substr($dateopd,8,2);
    $m=substr($dateopd,5,2); 
   $y=substr($dateopd,0,4); 
   $y2=substr($y,2,2);
   
 //   $date1="$d/$m/$y2"; 
$date1="$y$m$d";
   $clinic1=substr($clinic,0,2);
$referh1=substr($referh,0,2);
$refertype1=substr($refertype,0,1);

        print (" <tr>\n".
             "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an|$referh1|$refertype1</td>\n".
             " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>