<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";

    $query="CREATE TEMPORARY TABLE reportnhso09 SELECT an,icd10,doctor FROM ipcard WHERE dcdate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
 //   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่09 IDX ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   // print "  <th bgcolor=6495ED>#</th>";
  //  print "  <th bgcolor=6495ED>HN</th>";
// print "  <th bgcolor=6495ED>ชนิดการชำระเงิน</th>";
   
print " </tr>";

   $query="SELECT * FROM reportnhso09";
   $result = mysql_query($query);
     $num=0;
$dxtype=1;
    while (list ($an,$icd10,$doctor) = mysql_fetch_row ($result)) {
	$num++;
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
        print (" <tr>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an|$icd10|$dxtype|$doctor2</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
    //       "  <td BGCOLOR=66CDAA><font face='Angsana New'>$icd10</td>\n".
     //     "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
   //        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$dr</td>\n".
 	//   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
         
         
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>