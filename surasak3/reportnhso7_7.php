<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso1 SELECT hn,an,date_format(date,'%d/ %m/ %Y'),date_format(date,'%H%i'),date_format(dcdate,'%d/ %m/ %Y'),date_format(dcdate,'%H%i'),result,dctype,bedcode,adm_w,ptright FROM ipcard WHERE dcdate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่07 IPD ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a>.......<a  href=\"reportnhsofile07.php? yrmonth=$yrmonth\" >นำออกข้อมูล</a><br> ";
    print "<table>";
    print " <tr>";
   // print "  <th bgcolor=6495ED>#</th>";
 
print " </tr>";

   $query="SELECT * FROM reportnhso1";
   $result = mysql_query($query);
     $num=0;
    while (list ($hn,$an,$datem,$timem,$datedc,$timedc,$dischs,$discht,$ward,$weight,$ptright) = mysql_fetch_row ($result)) {	
$num++;
$num2=543;
    $dm=substr($datem,0,2);
    $mm=substr($datem,4,2); 
   $ym=substr($datem,8,4); 
   $ym1=$ym-$num2;
 //  $ym2=substr($ym1,2,2);
 //   $datem="$dm/$mm/$ym2"; 
    $datem="$ym1$mm$dm"; 

$num2=543;
    $dd=substr($datedc,0,2);
    $md=substr($datedc,4,2); 
   $yd=substr($datedc,8,4); 
   $yd1=$yd-$num2;
//   $yd2=substr($yd1,2,2);
//      $datedc="$dd/$md/$yd2"; 
    $datedc="$yd1$md$dd"; 
 $ward1=substr($ward,0,2);
 $dischs1=substr($dischs,0,1);
 $discht1=substr($discht,0,1);
$ptright=substr($ptright,0,3);
if($ptright=='R09'){$ptright1="1";} 
else if($ptright=='R10่'){$ptright1="1";}
else if($ptright=='R11'){$ptright1="1";}
else if($ptright=='R13'){$ptright1="1";}
else if($ptright=='R17'){$ptright1="1";}
else {$ptright1="2";};
  //  $query = "INSERT INTO nhso07(hn,an,dateadm,timeadm,datedsc,timedsc,dischs,discht,warddsc,dept)VALUES('$hn','$an','$datem','$timem',
//	                    '$datedc','$timedc','$dischs','$discht','$ward','$ward');";
//	    $result = mysql_query($query) or die("Query failed,cannot insert into nhso07");

//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (" <tr>\n".
          // " <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$an|$datem|$timem|$datedc|$timedc|$dischs1|$discht1|$ward|$ward1|$weight|$ptright1</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$datem</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$timem</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$datedc</td>\n".
     //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$timedc</td>\n".
     //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dischs</td>\n".         
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$discht</td>\n".
     //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ward</td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ward</td>\n".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>