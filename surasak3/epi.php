<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso03 SELECT hn,thidate,vn FROM opday WHERE thidate LIKE '$yrmonth%'   ";
    $result = mysql_query($query) or die("Query failed,warphar");


	 $query="CREATE TEMPORARY TABLE reportnhso0318 SELECT thidate,hn,drugcode,number FROM trauma_inject WHERE thidate LIKE '$yrmonth%' AND drugcode = ('0tt' OR '0vero')";
    $result = mysql_query($query) or die("Query failed,trauma_inject");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. รายงามาตรฐานแฟ้มข้อมูลแฟ้มที่13 EPI ประจำเดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a> <br> ";
    print "<table>";
    print " <tr>";
   
print " </tr>";


   $query="SELECT reportnhso0318.hn,reportnhso0318.thidate,reportnhso0318.drugcode,reportnhso0318.number FROM reportnhso0318 ";

   $result = mysql_query($query);
    while (list ($hn,$thidate1,$drugcode,$number) = mysql_fetch_row ($result)) {	

$thidate2=substr($thidate1,0,10);
		$sql = "Select date_format(reportnhso03.thidate,'%d/ %m/ %Y'),reportnhso03.thidate,reportnhso03.vn From reportnhso03 where hn = '$hn' and thidate like '$thidate2%'  ";
	list($date,$date2,$vn)  = mysql_fetch_row(Mysql_Query($sql));
	$num1=11512;
	$num2=543;
$num4=1;
$num3=0;
    $d=substr($date,0,2);
    $m=substr($date,4,2); 
   $y=substr($date,8,4); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
     $time1=substr($date2,11,2); 
	 $time2=substr($date2,14,2); 
	 $time3=substr($date2,17,2); 

    $date1="$d/$m/$y2"; 
$date1="$y1$m$d";
$date2="$y-$m-$d";
   $vn=sprintf('%03d',$vn);
if($clinic1==''){$clinic1="99";} ;
$num00='00';

if ($drugcode=='0TT'){$drugcode1='101';}else{$drugcode1='111';};

$sql = "Select idcard From opcard where hn = '$hn' limit 1";
$result2 = Mysql_Query($sql);
list($idcard) = Mysql_fetch_row($result2);

        print (
   "11512|$hn|$date1$vn|$date1|$drugcode1|11512|$date1$time1$time2$time3|$idcard<BR>");
   

      
          }
          
    print "<table>";

    include("unconnect.inc");
?>