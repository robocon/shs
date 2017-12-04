<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$win='';
    $query="CREATE TEMPORARY TABLE reportnhso11 SELECT hn,an,thidate,PHAR,xray,patho,emer,surg,physi,denta,other,ptright,vn FROM opday WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
 //   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่11 CHT ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   // print "  <th bgcolor=6495ED>#</th>";     
print " </tr>";

 //  $query="SELECT * FROM reportnhso11";
 $query="SELECT reportnhso11.hn,reportnhso11.an,date_format(reportnhso11.thidate,'%d/ %m/ %Y'),reportnhso11.PHAR,reportnhso11.xray,reportnhso11.patho,reportnhso11.emer,reportnhso11.surg,reportnhso11.physi,reportnhso11.denta,reportnhso11.other,reportnhso11.ptright,opcard.idcard,reportnhso11.vn FROM reportnhso11 LEFT JOIN opcard ON reportnhso11.hn=opcard.hn";
  $result = mysql_query($query);
     $num=0;
    while (list ($hn,$an,$date,$phar,$xray,$patho,$emer,$surg,$physi,$denta,$other,$ptright,$idcard,$vn) = mysql_fetch_row ($result)) {
	$num++;
$price=$phar+$xray+$patho+$emer+$surg+$physi+$denta+$other;
//$date1=date_format($date,'%d/ %m/ %Y');
//$date=mktime($date);
//$date1=date("d / m / Y",$date);
     $num2=543;
  $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   // $date1="$d/$m/$y2"; 
    $date1="$y1$m$d"; 
$ptright1=substr($ptright,1,2);

 $vn=sprintf('%03d',$vn);
if($ptright1=='01'){$paid2=$price;} else
if($ptright1=='02'){$paid2=$price;} else
if($ptright1=='03'){$paid2=0;} else
if($ptright1=='04'){$paid2=$price;} else
if($ptright1=='05'){$paid2=$price;} else
if($ptright1=='06'){$paid2=$price;} else
if($ptright1=='07'){$paid2=0;} else
if($ptright1=='98'){$paid2=0;} else
if($ptright1=='10'){$paid2=0;} else
if($ptright1=='11'){$paid2=0;} else
if($ptright1=='12'){$paid2=0;} else
if($ptright1=='13'){$paid2=0;} else
if($ptright1=='14'){$paid2=$price;} else
if($ptright1=='15'){$paid2=$price;} else
if($ptright1=='16'){$paid2=$price;} else
if($ptright1=='17'){$paid2=0;} else
if($ptright1=='18'){$paid2=0;} else
if($ptright1=='19'){$paid2=0;} else
if($ptright1=='20'){$paid2=$price;} else
if($ptright1=='21'){$paid2=$price;} else
if($ptright1=='22'){$paid2=0;} else
if($ptright1=='23'){$paid2=0;} else
{$paid2=$price;};



if (empty($an)) 

   print (" <tr>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$an|$date1|$price|$paid2|$ptright1|$idcard|$date1$vn</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
       //    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid2</td>\n".
 	//   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
         // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
         
         
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>

<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";

    $query="CREATE TEMPORARY TABLE reportnhso111 SELECT hn,an,date,price,paid,ptright FROM ipcard WHERE date LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
 //   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
// print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่11 CHA ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   // print "  <th bgcolor=6495ED>#</th>";
 
print " </tr>";

//   $query="SELECT * FROM reportnhso12";
 $query="SELECT reportnhso111.hn,reportnhso111.an,date_format(reportnhso111.date,'%d/ %m/ %Y'),reportnhso111.price,reportnhso111.paid,reportnhso111.ptright,opcard.idcard FROM reportnhso111 LEFT JOIN opcard ON reportnhso111.hn=opcard.hn";


   $result = mysql_query($query);
     $num=0;
    while (list ($hn,$an,$date,$price,$paid,$ptright,$idcard) = mysql_fetch_row ($result)) {

 $num2=543;
  $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
    
   $y2=substr($y1,2,2);
    $date11="$d-$m-$y"; 
    // $date11="$y-$m-$d"; 
    $date1="$y1$m$d"; 
$ptright1=substr($ptright,1,2);

$sql = "Select vn,an From opday where an = '$an' limit 1 ";
$result3 = Mysql_Query($sql);
list($vn) = Mysql_fetch_row($result3);
 $vn=sprintf('%03d',$vn);
$num++;
if($price==''){$paid='0';$price='0';};
        print (" <tr>\n".
          // "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$an|$date1|$price|$paid|$ptright1|$idcard|$date1$vn</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date1</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
         //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
 //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
  //         "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
      
         
           " </tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
	
?>