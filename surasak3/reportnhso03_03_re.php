<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso03 SELECT hn,doctor,thidate,clinic FROM opday WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่03 OPD ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a> <br> ";
    print "<table>";
    print " <tr>";
   
print " </tr>";

   $query="SELECT reportnhso03.hn,reportnhso03.doctor,date_format(reportnhso03.thidate,'%d/ %m/ %Y'),opcard.idcard,opcard.name,opcard.surname,reportnhso03.clinic FROM reportnhso03 LEFT JOIN opcard ON reportnhso03.hn=opcard.hn";
   $result = mysql_query($query);
    while (list ($hn,$doctor,$date,$idcard,$name,$surname,$clinic) = mysql_fetch_row ($result)) {	
	$num1=11512;
	$num2=543;
$num4=1;
$num3=0;
    $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
    $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
   $clinic1=substr($clinic,0,2);
//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (" <tr>\n".
        " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
         "  <td BGCOLOR=66CDAA><font face='Angsana New'>$name</td>\n".
         "  <td BGCOLOR=66CDAA><font face='Angsana New'>$surname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>