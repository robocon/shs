<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
$na1='';
    $query="CREATE TEMPORARY TABLE reportnhso06 SELECT hn,thidate,doctor,icd9cm,clinic,vn,an FROM opday WHERE thidate LIKE '$yrmonth%' and icd9cm != 'NA' and icd9cm != '' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่06 OOP ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";

print " </tr>";

  // $query="SELECT * FROM reportnhso06";
 $query="SELECT reportnhso06.hn,date_format(reportnhso06.thidate,'%d/ %m/ %Y'),reportnhso06.doctor,reportnhso06.icd9cm,reportnhso06.clinic,opcard.idcard,reportnhso06.vn,reportnhso06.an FROM reportnhso06 LEFT JOIN opcard ON reportnhso06.hn=opcard.hn";

   $result = mysql_query($query);
    while (list ($hn,$date,$doctor,$icd9,$clinic,$id,$vn,$an) = mysql_fetch_row ($result)) {	
$num1=11512;
$num2=543;
$num3=0;
$num4=1;
    $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
 //   $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
 $clinic1=substr($clinic,0,2);
$doctor1=substr($doctor,0,5);
if  ($doctor1=='MD022'){$doctor2="";} else 
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
{$doctor2 ="";};
 $vn=sprintf('%03d',$vn);

   $icd91=substr($icd9,0,4);
   if($icd91!='9007'){$icd92=substr($icd9,0,4);}else{ $icd92=$icd9;};
   
if($clinic1==''){$clinic1="99";} ;

 if($an== '' ){$c1="0";} else {$c1="1";};
$num00='00';
//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (      
           "11512|$hn|$date1$vn|$date1|$icd92|0.00|$date1|$c1$clinic1$num00|<BR>".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
      //     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
       //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd9</td>\n".
        //  "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
    //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$occupa</td>\n".         
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$nation</td>\n".
    //      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$id</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ward</td>\n".
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>