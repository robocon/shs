<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";

    $query="CREATE TEMPORARY TABLE reportnhso12 SELECT hn,an,date,depart,price FROM patdata WHERE date LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
 //   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่12 CHA ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   // print "  <th bgcolor=6495ED>#</th>";
  
print " </tr>";

//   $query="SELECT * FROM reportnhso12";
 $query="SELECT reportnhso12.hn,reportnhso12.an,date_format(reportnhso12.date,'%d/ %m/ %Y'),reportnhso12.depart,reportnhso12.price,opcard.idcard FROM reportnhso12 LEFT JOIN opcard ON reportnhso12.hn=opcard.hn";


   $result = mysql_query($query);
     $num=0;
    while (list ($hn,$an,$date,$code,$price,$idcard) = mysql_fetch_row ($result)) {
	
  $num2=543;
  $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
     //  $date1="$d/$m/$y2"; 
    $date1="$y1$m$d"; 
 if($code=='PATHO'){$code1="00";} else
 if($code=='XRAY'){$code1="01";} else
 if($code=='WARD'){$code1="09";} else
 if($code=='EMER'){$code1="04";} else
 if($code=='DENTA'){$code1="04";} else
 if($code=='OTHER'){$code1="04";} else
 if($code=='HEMO'){$code1="04";} else
 if($code=='PHYSI'){$code1="04";} else
 {$code1=$code;} ;

$num++;
        print (" <tr>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$an|$date1|$code1|$price|$idcard|$date1</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
        
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>