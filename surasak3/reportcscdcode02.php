<?php

    $yrmonth="$thiyr-$rptmo-$date";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
$numcscd=0;
$cscd='อื่นๆ';
    $query="CREATE TEMPORARY TABLE reportcscd01 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc WHERE date LIKE '$yrmonth%' and credit = '$cscd' and credit_detail = '$code' AND paidcscd > $numcscd " ;
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

$ok=0;
   $query="SELECT * FROM reportcscd01   ";
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
	$paidcscd=number_format( ($paidcscd+$numNcscd), 2, '.', '');
	$numNcscd=number_format( $numNcscd, 2, '.', '');
	$row_id1=sprintf('%04d',$row_id1);
	
	$date4 = "$y-$m-$d";
	$subquery = "select * from ipcard where hn='$hn' and date like '$date4%' ";
	$amtoday = mysql_num_rows(mysql_query($subquery));
	if($amtoday==1){
		$color = "FF0000";
		$ok=1;
	}else{
		$color = "66CDAA";
	}
	print (" <tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>01||$date1$t|11512|$date2$row_id1$vn|$date2$row_id|$hn||$paidcscd|$numNcscd||</td>\n".
           " </tr>\n");
	}
	if($ok==1){
	?>
		<script>
        	alert("มีรายการเบิกซ้ำซ้อนกับผู้ป่วย Admit \nกรุณาตรวจสอบรายการที่แถบสีแดง");
        </script>
	<?
	}
	$sql2="SELECT *, COUNT( * ) AS a FROM opacc WHERE DATE LIKE  '$y-$m-$d%' GROUP BY txdate, hn,detail,price,credit HAVING a >1 ";
    print "<table>";

	print "<table>";
    print " <tr>";
   
echo " &lt;/BILLTRAN&gt;<br>";
//
$count2=0;
$query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
			
		if($depart=='PHAR'){
			$ddl=0;
			$dpy=0;
			$dsy=0;
			$dsn=0;
			$ddn=0;
			$dsna=0;
			$sql1 = "select * from phardep where date = '".$txdate."' and hn ='$hn' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as suma,part,drugcode from drugrx where idno = '".$result1['row_id']."' group by part";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
				$sql4 = "select sum(price) as suma,part,drugcode,amount from drugrx where idno = '".$result1['row_id']."' group by part,drugcode";
				$row4 = mysql_query($sql4);
				while($result4 = mysql_fetch_array($row4)){
					
					$sql3 = "select salepri,medical_sup_free,freepri  from druglst where drugcode = '".$result4['drugcode']."' ";
					$row3 = mysql_query($sql3);
					
					if($result4['part']=="DDL"||$result4['part']=="DDY"){
						$ddl+=$result4['suma'];
					}elseif($result4['part']=="DPY"){
						list($salepri,$supfree,$freepri) = mysql_fetch_array($row3);
						$dpy+=$freepri*$result4['amount'];//$result4['suma'];
						//$dpn+=(($result4['suma']/$result4['amount'])-$freepri)*$result4['amount'];
					}elseif($result4['part']=="DSY"){
						
						list($salepri,$supfree,$freepri) = mysql_fetch_array($row3);
						//if($supfree==1){
							$dsy+=$result4['suma'];
						/*	$dsn+=($salepri-$freepri)*$result4['amount'];
						}else{
							$dsna+=$result4['suma'];
						}*/
					}
					
				}
			}
			if($ddl>0){
				$count2++;
			}
			if($dpy>0){
				$count2++;
			}
			if($dsy>0){
				$count2++;
			}
		
			/*if($dsna>0){
				$count2++;
			}*/
			/*if($ddn>0){
				$count2++;
			}*/
		}else{
			$sql1 = "select * from depart where date = '".$txdate."' and hn ='$hn'";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as sumb,part  from patdata where idno = '".$result1['row_id']."' and part!='MC' group by part";
			$row2 = mysql_query($sql2);
			$result2 = mysql_fetch_array($row2);
			$count2++;
		}
	}
//
echo " &lt;OPBills invcount=&quot;$count&quot; lines=&quot;$count2&quot;&gt;";
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
		$y1=$y-$num2;
		$y2=substr($y1,2,2);
	   
		$date11="$d/$m/$y2"; 
		$date1="$y1-$m-$d";
		$date2="$y1$m$d";

   		$clinic1=substr($clinic,0,2);
     	$row_id1=substr($row_id,-4);
 		$paidcscd=number_format( $paidcscd, 2, '.', '');
		$vn=sprintf('%04d',$vn);
		$billno=sprintf('%03d',$billno);
		$numcscd=sprintf('%04d',$numcscd);
		$row_id1=sprintf('%04d',$row_id1);
		$numNcscd=$price-$paidcscd;
		

		/*IF($depart=='PHAR'){$depart1="4";}else 
		IF($depart=='PATHO'){$depart1="7";}else 
		IF($depart=='XRAY'){$depart1="8";}else 
		IF($depart=='SURG'){$depart1="B";}else 
		IF($depart=='EMER'){$depart1="C";}else 
		IF($depart=='DENTA'){$depart1="D";}else 
		IF($depart=='PHYSI'){$depart1="E";}else 
		IF($depart=='NID'){$depart1="F";}else 
		IF($price =='650.00' AND $depart=='OTHER'){$depart1="9";}else
		IF($depart=='OTHER'){$depart1="C";}else 
		{$depart1="C";};*/
		
		if($depart=='PHAR'){
			$ddl=0;
			$ddn=0;
			$dpy=0;
			$dpn=0;
			$dsy=0;
			$dsn=0;
			$sql1 = "select * from phardep where date = '".$txdate."' and hn ='$hn' ";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select price,part,drugcode,amount  from drugrx where idno = '".$result1['row_id']."' ";
			$row2 = mysql_query($sql2);
			while($result2 = mysql_fetch_array($row2)){
				
				$sql3 = "select salepri,medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";
				$row3 = mysql_query($sql3);
				list($salepri,$supfree,$freepri) = mysql_fetch_array($row3);
					
				if($result2['part']=="DDL"||$result2['part']=="DDY"){
					$ddl+=$result2['price'];
				}elseif($result2['part']=="DDN"){
					$ddn+=$result2['price'];
				}elseif($result2['part']=="DPY"){
					$dpy+=$result2['price'];
					$dpn+=(($result2['price']/$result2['amount'])-$freepri)*$result2['amount'];
				}elseif($result2['part']=="DPN"){
					$dpn+=$result2['price'];
				}elseif($result2['part']=="DSY"){
					$dsy+=$result2['price'];
					if($supfree==1){
						$dsn+=(($result2['price']/$result2['amount'])-$freepri)*$result2['amount'];
					}else{
						$dsn+=$result2['price'];
					}
				}
				/*elseif($result2['part']=="DSN"){
					$dsn+=$result2['price'];
				}*/
			}
			if($ddl>0||$ddn>0){
				$ddl = number_format(($ddl+$ddn),2,'.','');
				$ddn = number_format($ddn,2,'.','');
				 print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date2$row_id1$vn|4|$ddl|$ddn</td>\n".
           " </tr>\n");
			}
			if($dpy>0||$dpn>0){
				$dpy = number_format(($dpy),2,'.','');
				$dpn = number_format(($dpn),2,'.','');
				 print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date2$row_id1$vn|2|$dpy|$dpn</td>\n".
           " </tr>\n");
			}
			if($dsy>0||$dsn>0){
				$dsy = number_format(($dsy),2,'.','');
				$dsn = number_format(($dsn),2,'.','');
				 print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date2$row_id1$vn|5|$dsy|$dsn</td>\n".
           " </tr>\n");
			}
			
		}else{
			$sql1 = "select * from depart where date = '".$txdate."' and hn ='$hn'";
			$row1 = mysql_query($sql1);
			$result1 = mysql_fetch_array($row1);
			$sql2 = "select sum(price) as sumb,part  from patdata where idno = '".$result1['row_id']."' and part!='MC' group by part";
			$row2 = mysql_query($sql2);
			$result2 = mysql_fetch_array($row2);
				if($result2['part']=="LAB"){
					$depart1="7";
				}elseif($result2['part']=="BLOOD"){
					$depart1="6";
				}elseif($result2['part']=="XRAY"){
					$depart1="8";
				}elseif($result2['part']=="SINV"){
					$depart1="9";
				}elseif($result2['part']=="TOOL"){
					$depart1="A";
				}elseif($result2['part']=="SURG"){
					$depart1="B";
				}elseif($result2['part']=="NCARE"||$result2['part']=="OTHER"||$result2['part']=="EMER"){
					$depart1="C";
				}elseif($result2['part']=="DENTA"){
					$depart1="D";
				}elseif($result2['part']=="PT"){
					$depart1="E";
				}elseif($result2['part']=="STX"||$result2['part']=="NID"){
					$depart1="F";
				}elseif($result2['part']=="MC"){
					$depart1="G";
				}else{
					$depart1="C";
				}
				$paidcscd = number_format(($paidcscd+ $numNcscd),2,'.','');
				$numNcscd=number_format( $numNcscd, 2, '.', '');
				if($paidcscd<=0){
					$color='FF0000';
				}else{
					$color='66CDAA';
				}
			print (" <tr>\n".
           			"  <td BGCOLOR=$color><font face='Angsana New'>$date2$row_id1$vn|$depart1|$paidcscd|$numNcscd</td>\n".
         			 " </tr>\n");
		}
		
     //  print (" <tr>\n".
        //   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date2$row_id1$vn|$depart1|$paidcscd|0.00</td>\n".
         //  " </tr>\n");
	}
    print "<table>";
	echo " &lt;/OPBills&gt;<br>";
	echo " ";
 
    include("unconnect.inc");
?>
