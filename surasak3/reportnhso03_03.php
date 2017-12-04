<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso03 SELECT hn,doctor,thidate,clinic,ptname,thdatehn,vn,ptright,an FROM opday WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่03 OPD ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a> <br> ";
    print "<table>";
    print " <tr>";
   
print " </tr>";

if($_POST["noid"] == "1"){
	$where =" AND (opcard.idcard = '' OR opcard.idcard = '-' )";
}

   $query="SELECT 
   reportnhso03.hn,
   reportnhso03.doctor,
   date_format(reportnhso03.thidate,'%d/ %m/ %Y'),
   reportnhso03.thidate,
   opcard.idcard,
   reportnhso03.clinic, 
   reportnhso03.ptname,reportnhso03.thdatehn,reportnhso03.vn,reportnhso03.ptright,reportnhso03.an FROM reportnhso03 INNER JOIN opcard ON reportnhso03.hn=opcard.hn ".$where;

   $result = mysql_query($query);
    while (list ($hn,$doctor,$date,$date2,$idcard,$clinic,$full_name,$thdatehn,$vn,$ptright,$an) = mysql_fetch_row ($result)) {	
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
   $time1=substr($date2,11,2);
   $time2=substr($date2,14,2);
   $thdatehn1= substr($thdatehn,0,9);
   $vn=sprintf('%03d',$vn);
$ptright=substr($ptright,0,3);

if($ptright=='R09'){$ptright1="1";} 
else if($ptright=='R10'){$ptright1="1";}
else if($ptright=='R11'){$ptright1="1";}
else if($ptright=='R13'){$ptright1="1";}
else if($ptright=='R17'){$ptright1="1";}
else {$ptright1="2";};

if($clinic1==''){$clinic1="00";} ;

//if($an==''){$seq=$date1.''.$vn;}else {$seq=$date1.''.$an;};


//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn|$num3$clinic1$num4|$date1|$time1$time2|$date1$vn|$ptright1");
   

		 if($_POST["noid"] == "1"){
			print ("|<A HREF=\"opdedit.php?cHn=".$hn."\" target=\"_blank\">".$full_name."</A>");
			}

           print (" </td>\n</tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>