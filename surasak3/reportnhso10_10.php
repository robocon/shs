<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso10 SELECT an,comorbid,doctor,date_format(date,'%d/ %m/ %Y'),date_format(date,'%H%i') FROM ipcard WHERE dcdate LIKE '$yrmonth%'and comorbid != ''";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่10 IOP ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
  //  print "  <th bgcolor=6495ED>#</th>";
//   print "  <th bgcolor=6495ED>รหัส</th>";

print " </tr>";

   $query="SELECT * FROM reportnhso10";
   $result = mysql_query($query);
    while (list ($an,$comorbid,$doctor,$date,$time) = mysql_fetch_row ($result)) {	
$num1=1;
$num2=543;
  $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
  //  $date1="$d/$m/$y2"; 
    $date1="$y1$m$d"; 

$doctor1=substr($doctor,0,5);
if  ($doctor1=='MD022'){$doctor2="00000";} else 
if  ($doctor1=='MD006'){$doctor2="12891";} else 
if  ($doctor1=='MD007'){$doctor2="12456";} else 
if  ($doctor1=='MD008'){$doctor2="16633";} else 
if  ($doctor1=='MD009'){$doctor2="19364";} else 
if  ($doctor1=='MD011'){$doctor2="20186";} else 
if  ($doctor1=='MD013'){$doctor2="19921";} else 
if  ($doctor1=='MD014'){$doctor2="20182";} else 
if  ($doctor1=='MD015'){$doctor2="21504";} else 
if  ($doctor1=='MD016'){$doctor2="21329";} else 
if  ($doctor1=='MD020'){$doctor2="3448";} else 
if  ($doctor1=='MD030'){$doctor2="5947";} else 
if  ($doctor1=='MD036'){$doctor2="20278";} else 
if  ($doctor1=='MD037'){$doctor2="10212";} else 
if  ($doctor1=='MD041'){$doctor2="27035";} else 
if  ($doctor1=='MD043'){$doctor2="1850";} else 
if  ($doctor1=='MD047'){$doctor2="24535";} else 
if  ($doctor1=='MD048'){$doctor2="29290";} else 
if  ($doctor1=='MD049'){$doctor2="37555";} else 
if  ($doctor1=='MD050'){$doctor2="37525";} else 
if  ($doctor1=='MD051'){$doctor2="24512";} else 
if  ($doctor1=='MD052'){$doctor2="19286";} else 
	if  ($doctor1=='MD059'){$doctor2="28422";} else 
	if  ($doctor1=='<เลือ'){$doctor2="00000";} else 
{$doctor2 ="$doctor1";};







//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an|$comorbid|$num1|$doctor2|$date1|$time|$date1|$time</td>\n".
      //     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comorbid</td>\n".
      //     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
      //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
      //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
      //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
//  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
  //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
     
        //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$occupa</td>\n".         
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nation</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$id</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ward</td>\n".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>