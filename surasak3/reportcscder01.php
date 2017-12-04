<?php

    $yrmonth="$thiyr-$rptmo-$date";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
$numcscd=0;
$cscd='อื่นๆ';
    $query="CREATE TEMPORARY TABLE reportcscd01 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc WHERE date LIKE '$yrmonth%' and credit = '$cscd'  AND paidcscd > $numcscd and credit_detail = 'จ่ายตรงฉุกเฉิน' " ;
    $result = mysql_query($query) or die("Query failed,warphar");


     $query="SELECT * FROM reportcscd01   ";
     $result = mysql_query($query) or die("Query xxx failed");
	 $count =mysql_num_rows($result);


$query = "SELECT * FROM runno WHERE title = 'cscdrun' ";
$result = mysql_query($query) or die("Query failed");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}
		if(!($row = mysql_fetch_object($result)))
		continue;
}

//  	    $cTitle=$row->title;  //=VN
$ncscd2=$row->runno;

$ncscd2=sprintf('%04d',$ncscd2);
$ncscd3 = $ncscd2 +1;

 $query ="UPDATE runno SET runno = $ncscd3  WHERE title='cscdrun ' ";
    $result = mysql_query($query);


//  print "1. ข้อมูลจ่ายตรง ประจำวันที่  $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   

echo "&lt;ClaimRec System=&quotOP&quot; PayPlan=&quot;CS&quot; Version=&quot;0.9&quot;&gt;&lt;/ClaimRec&gt; <br>";
echo "&lt;HCODE&gt;11512&lt;/HCODE&gt;<br>";
echo " &lt;HNAME&gt;ค่ายสุรศักดิ์มนตรี&lt;/HNAME&gt;<br>";
echo " &lt;DATETIME&gt;2010-12-14 08:33:18&lt;/DATETIME&gt;<br>";
echo " &lt;SESSNO&gt;$ncscd2&lt;/SESSNO&gt;<br>";
echo " &lt;RECCOUNT&gt;$count&lt;/RECCOUNT&gt;<br>";
echo " &lt;BILLTRAN&gt;";


   $query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		$numcscd++;
	$num1=11512;
	$num2=543;
$num4=1;
$num5=2;
$num3=0;
    $d=substr($txdate,8,2);
    $m=substr($txdate,5,2); 
   $y=substr($txdate,0,4); 
    //  $t=substr($date,10,9); 
 $t1=substr($txdate,10,4); 
  $t2=substr($txdate,14,2); 
   $t3=substr($txdate,16,3); 
if($t2<'3'){$t2='03';};
   $t4=$t2-$num4;
   $t5=$t2-$num5;

   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
 $date11="$d/$m/$y2"; 
$date1="$y1-$m-$d";
$date2="$y1$m$d";
   $clinic1=substr($clinic,0,2);
   $row_id1=substr($row_id,-4);
   
$t4=sprintf('%02d',$t4);
$t5=sprintf('%02d',$t5);

$ti1="$t1$t4$t3";
$ti2="$t1$t5$t3";
$ti3="$t1$t2$t3";
IF($detail=="ค่ายา"){$t=$ti1;} else
IF($detail=="(55020/55021)ค่าบริการผู้ป่วยนอก"){$t=$ti2;}
  else{$t=$ti3;};

$numNcscd=$price-$paidcscd;
$vn=sprintf('%04d',$vn);
$billno=sprintf('%03d',$billno);
$numcscd=sprintf('%04d',$numcscd);
$paidcscd=number_format( $paidcscd, 2, '.', '');
$numNcscd=number_format( $numNcscd, 2, '.', '');
$row_id1=sprintf('%04d',$row_id1);
// $paidcscd=number_format($paidcscd,2);

//$datem1=date_format(datem,'%d/ %m/ %Y');

        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>01||$date1$t|11512|$date2$row_id1$vn|$date2$row_id|$hn||$paidcscd|0.00||</td>\n".
   
           " </tr>\n");
          }
    print "<table>";

print "<table>";
    print " <tr>";
   
echo " &lt;/BILLTRAN&gt;<br>";
echo " &lt;OPBills invcount=&quot;$count&quot; lines=&quot;$count&quot;&gt;";
$numcscd=0;
//print "<ClaimRec System="OP" PayPlin="CS" Version="0.9"></ClaimRec> <br>";
//echo "<HCODE>11512</HCODE><br>";
//echo " <HNAME>ค่ายสุรศักดิ์มนตรี</HNAME><br>";
//echo " <SESSON>00001</SESSON><br>";
//echo " <RECCOUNT>162</RECCOUNT><br>";
//echo " <BILLTRAN><br>";


   $query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		$numcscd++;
	$num1=11512;
	$num2=543;
$num4=1;
$num3=0;
    $d=substr($txdate,8,2);
    $m=substr($txdate,5,2); 
   $y=substr($txdate,0,4); 
  //    $t=substr($date,10,9); 
   $y1=$y-$num2;
   $y2=substr($y1,2,2);
   
    $date11="$d/$m/$y2"; 
$date1="$y1-$m-$d";
$date2="$y1$m$d";

IF($depart=='PHAR'){$depart1="4";}else 
IF($depart=='PATHO'){$depart1="7";}else 
IF($depart=='XRAY'){$depart1="8";}else 
IF($depart=='SURG'){$depart1="B";}else 
IF($depart=='EMER'){$depart1="C";}else 
IF($depart=='DENTA'){$depart1="D";}else 
IF($depart=='PHYSI'){$depart1="E";}else 
	IF($depart=='NID'){$depart1="F";}else 
IF($price =='650.00' AND $depart=='OTHER'){$depart1="9";}else
	IF($depart=='OTHER'){$depart1="C";}else 
		{$depart1="C";};

   $clinic1=substr($clinic,0,2);
     $row_id1=substr($row_id,-4);
  //  $paidcscd=number_format($paidcscd,2);
  $paidcscd=number_format( $paidcscd, 2, '.', '');
	$vn=sprintf('%04d',$vn);
	$billno=sprintf('%03d',$billno);
$numcscd=sprintf('%04d',$numcscd);
$row_id1=sprintf('%04d',$row_id1);
$numNcscd=$price-$paidcscd;
$numNcscd=number_format( $numNcscd, 2, '.', '');

//$datem1=date_format(datem,'%d/ %m/ %Y');

        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date2$row_id1$vn|$depart1|$paidcscd|0.00</td>\n".
   
           " </tr>\n");
          }
    print "<table>";
echo " &lt;/OPBills&gt;<br>";
echo " ";
 
    include("unconnect.inc");
?>
