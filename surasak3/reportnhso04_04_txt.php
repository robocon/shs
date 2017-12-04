<?php
 yrmonth= $yrmonth1;
 include("connect.inc");

    include("connect.inc");

    $query="CREATE TEMPORARY TABLE reportnhso04 SELECT hn,an,dateopd,clinic,referh,refertype,idcard FROM refer WHERE dateopd  LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่04 ORF ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
  print "<a target=_self  href=\"reportnhso04_04_txt.php?  yrmonth1= $yrmonth\" >ส่งออกข้อมูล</a><br> ";
    print "<table>";
    print " <tr>";
print " </tr>";
//  $query="SELECT * FROM reportnhso04 ";

 $query=" SELECT reportnhso04.hn,reportnhso04.an,reportnhso04.dateopd,reportnhso04.clinic,reportnhso04.referh,reportnhso04.refertype,reportnhso04.idcard   FROM reportnhso04  WHERE reportnhso04.an = ' ' ";
   $result = mysql_query($query);
    while (list ($hn,$an,$dateopd,$clinic,$referh,$refertype,$idcard) = mysql_fetch_row ($result)) {	
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
             "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$date1|$num9$clinic1$num8|$referh1|$refertype1|$idcard</td>\n".
             " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>