<?php

    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
    $query="CREATE TEMPORARY TABLE reportnhso03 SELECT hn,doctor,thidate,clinic,ptname,thdatehn,vn,ptright,an FROM opday WHERE thidate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");


	 $query="CREATE TEMPORARY TABLE reportnhso0318 SELECT paid,hn,credit,txdate FROM opacc WHERE txdate LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,warphar");
    
//   echo mysql_errno() . ": " . mysql_error(). "\n";
 //   echo "<br>";
  print "1. ��§��ҵðҹ���������������05 SERVICE ��Ш���͹ $yrmonth <a target=_self  href='../nindex.htm'><<�����</a> <br> ";
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
$date2="$y-$m-$d";
   $clinic1=substr($clinic,0,2);
   $time1=substr($date2,11,2);
   $time2=substr($date2,14,2);
   $thdatehn1= substr($thdatehn,0,9);
   $vn=sprintf('%03d',$vn);
$ptright=substr($ptright,0,3);

$sql = "Select sum(paid) From reportnhso0318 where hn = '$hn' and txdate like '$date2%'  ";
	list($paid)  = mysql_fetch_row(Mysql_Query($sql));

	$sql = "Select sum(paid) From reportnhso0318 where hn = '$hn' and txdate like '$date2%' and credit = '�Թʴ' ";
	list($paid2)  = mysql_fetch_row(Mysql_Query($sql));

if($ptright=='R09'){$ptright1="1";} 
else if($ptright=='R10'){$ptright1="1";}
else if($ptright=='R11'){$ptright1="1";}
else if($ptright=='R13'){$ptright1="1";}
else if($ptright=='R17'){$ptright1="1";}
else {$ptright1="2";};

if($clinic1==''){$clinic1="99";} ;
if($paid==''){$paid="0.00";} ;
if($paid2==''){$paid2="0.00";} ;
if($an== '' ){$c1="0";} else {$c1="1";};

$num00='00';


//if($an==''){$seq=$date1.''.$vn;}else {$seq=$date1.''.$an;};


//$datem1=date_format(datem,'%d/ %m/ %Y');
        print (
   "11512|$hn|$date1$vn|$date1|2|0||$paid||||$paid2|0|11512|0|11512||$c1$clinic1$num00|1|$paid<BR>");
   

		 if($_POST["noid"] == "1"){
			print ("|<A HREF=\"opdedit.php?cHn=".$hn."\" target=\"_blank\">".$full_name."</A>");
			}

           print (" </td>\n</tr>\n");
          }
    print "<table>";

    include("unconnect.inc");
?>