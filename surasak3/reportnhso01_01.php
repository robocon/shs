<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso01 SELECT hn,doctor,thidate,clinic,ptright FROM opday WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่01 INS ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   
print " </tr>";

   $query="SELECT reportnhso01.hn,reportnhso01.doctor,date_format(reportnhso01.thidate,'%d/ %m/ %Y'),opcard.idcard,reportnhso01.clinic,reportnhso01.ptright FROM reportnhso01 LEFT JOIN opcard ON reportnhso01.hn=opcard.hn";
   $result = mysql_query($query);
    while (list ($hn,$doctor,$date,$idcard,$clinic,$ptright) = mysql_fetch_row ($result)) {	
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
   $ptright=substr($ptright,0,3);

if($ptright=='R01'){$ptright1="A1";} 
else if($ptright=='R02'){$ptright1="A2";}
else if($ptright=='R03'){$ptright1="A2";}
else if($ptright=='R04'){$ptright1="A2";}
else if($ptright=='R05'){$ptright1="A2";}
else if($ptright=='R06'){$ptright1="A9";}
else if($ptright=='R07'){$ptright1="A7";}
else if($ptright=='R08'){$ptright1="A8";}
else if($ptright=='R09'){$ptright1="UC";}
else if($ptright=='R10'){$ptright1="UC";}
else if($ptright=='R11'){$ptright1="AA";}
else if($ptright=='R12'){$ptright1="AD";}
else if($ptright=='R13'){$ptright1="UC";}
else if($ptright=='R14'){$ptright1="UC";}
else if($ptright=='R15'){$ptright1="A1";}
else if($ptright=='R16'){$ptright1="A2";}
else if($ptright=='R17'){$ptright1="UC";}
else if($ptright=='R18'){$ptright1="A2";}
else if($ptright=='R19'){$ptright1="A7";}
else if($ptright=='R20'){$ptright1="A1";}
else if($ptright=='R21'){$ptright1="A1";}
else if($ptright=='R22'){$ptright1="A1";}
else if($ptright=='R23'){$ptright1="UC";}
else {$ptright1="A1";};

if($ptright1=='UC'){$codeptright="11512";} 
else if($ptright1=='A7'){$codeptright="11512";}
else {$codeptright="";};


//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$ptright1||$idcard|||$codeptright|$codeptright</td>\n".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
     //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$sex</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$marringe</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$occupa</td>\n".         
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nation</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$id</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ward</td>\n".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>