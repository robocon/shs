<?php

    $yrmonth="$thiyr-$rptmo-$date";
    include("connect.inc");
//      $query = "SELECT date,ptname,hn,an,code,detail,price,row_id,ptright,depart FROM patdata WHERE date LIKE '$today%' and ptright LIKE 'R07%' and depart='DENTA'  ORDER BY code ASC ";
$yy=543;
$numcscd=0;
$cscd='อื่นๆ';
    $query="CREATE TEMPORARY TABLE reportcscd01 SELECT date,hn,vn,billno,price,credit,depart,paidcscd,detail,row_id,txdate FROM opacc WHERE date LIKE '$yrmonth%' and credit = '$cscd' and credit_detail='$code' AND depart='PHAR' " ;
    $result = mysql_query($query) or die("Query failed,warphar");


     $query="SELECT * FROM reportcscd01   ";
     $result = mysql_query($query) or die("Query xxx failed");
	// $count =mysql_num_rows($result);
	 while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		 $query3 = "select date,item,doctor,row_id from phardep where date = '$txdate' and price>0 and hn='$hn' ";
		 $row3 = mysql_query($query3);
		 list($datepx,$pitem,$doctor,$xrow) = mysql_fetch_array($row3);
		 $ddl=0;
		 $sql2 = "select sum(price) as suma,part,drugcode  from drugrx where idno = '".$xrow."' group by part";
		 $row2 = mysql_query($sql2);
		 while($result2 = mysql_fetch_array($row2)){
			 if($result2['part']=="DDL"||$result2['part']=="DDY"||$result2['part']=="DDN"||$result2['part']=="DSN"){
				 $ddl+=$result2['suma'];
			 }elseif($result2['part']=="DSY"){
				$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";
				$row3 = mysql_query($sql3);
				list($supfree,$freepri) = mysql_fetch_array($row3);
				if($supfree==1){
					if($result2['suma']>$freepri){
						$ddl+=$freepri;
					}else{
						$ddl+=$result2['suma'];
					}
				}else{
					//$ddl+=$result2['suma'];	
				}
			 }/*elseif($result2['part']=="DPY"){
				$ddl+=$result2['suma'];
			 }*/
		 }
		 if($ddl>0){
			$count++;
		 }
	 }


/*$query = "SELECT * FROM runno WHERE title = 'cscdrun2' ";
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

 $query ="UPDATE runno SET runno = $ncscd3  WHERE title='cscdrun2' ";
    $result = mysql_query($query);
*/

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
$ncscd2 = $ncscd2 -1;
$ncscd2=sprintf('%04d',$ncscd2);


//  print "1. ข้อมูลจ่ายตรง ประจำวันที่  $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
    print "<table>";
    print " <tr>";
   
echo "&lt;?xml version=&quot1.0&quot encoding=&quotwindows-874&quot?&gt<br>";
echo "&lt;ClaimRec System=&quotOP&quot; PayPlan=&quot;CS&quot; Version=&quot;0.91&quot;&gt;<br>";
echo "&lt;Header&gt;<br>";
echo "&lt;HCODE&gt;11512&lt;/HCODE&gt;<br>";
echo " &lt;HNAME&gt;ค่ายสุรศักดิ์มนตรี&lt;/HNAME&gt;<br>";
echo " &lt;DATETIME&gt;2010-12-14 08:33:18&lt;/DATETIME&gt;<br>";
echo " &lt;SESSNO&gt;$ncscd2&lt;/SESSNO&gt;<br>";
echo " &lt;RECCOUNT&gt;$count&lt;/RECCOUNT&gt;<br>";
echo "&lt;/Header&gt;<br>";
echo "&lt;Dispensing&gt;<br>";

//&lt;/ClaimRec&gt;

   $query="SELECT * FROM reportcscd01  ";
   $result = mysql_query($query);
    while (list ($date,$hn,$vn,$billno,$price,$cerdit,$depart,$paidcscd,$detail,$row_id,$txdate) = mysql_fetch_row ($result)) {	
		$numcscd++;
		$pitem=0; 
	$num1=11512;
	$num2=543;
	$num3=0;
    $num4=1;
    $num5=2;
	$dr1="";
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
	$query2 = "select idcard from opcard where hn= '$hn' ";
	$row2 = mysql_query($query2);
	list($cid) = mysql_fetch_array($row2);
	$dphardate = $y."-".$m."-".$d;
	
	$query3 = "select date from dphardep where date like '".substr($txdate,0,10)."%' and dr_cancle is null and stkcutdate is not null and hn='$hn' ";
	$row3 = mysql_query($query3);
	list($datepx) = mysql_fetch_array($row3);
	
	$query4 = "select date,doctor,row_id from phardep where date = '$txdate' and hn='$hn' and price>0";
	$row4 = mysql_query($query4);
	list($dateop,$doctor,$xrow) = mysql_fetch_array($row4);
	
	$ddl=0;
	$ddn=0;
	
	$sql2 = "select sum(price) as price,count(row_id) as counter,part,drugcode  from drugrx where idno = '".$xrow."' and (part='DDL' or part='DDY' or part='DDN' or part='DSY' or part='DSN' ) group by part,drugcode";
//or part='DPY'
	$row2 = mysql_query($sql2);
	while($result2 = mysql_fetch_array($row2)){
		if($result2['part']=="DDL"||$result2['part']=="DDY"){
			$pitem+=$result2['counter'];
			$ddl+=$result2['price'];
		}elseif($result2['part']=="DSY"){
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($supfree==1){
				if($result2['price']>$freepri){
					$ddl+=$freepri;
					$ddn+=($result2['price']-$freepri);
					$pitem+=$result2['counter'];
				}else{
					$ddl+=$result2['price'];
					$pitem+=$result2['counter'];
				}
				//$ddl+=$result2['price'];
				//$pitem+=$result2['counter'];
			}else{//เบิกไม่ได้
				$ddn+=$result2['price'];
				$pitem+=$result2['counter'];
			}
		}elseif($result2['part']=="DDN"||$result2['part']=="DSN"){
			$ddn+=$result2['price'];
			$pitem+=$result2['counter'];
		}/*elseif($result2['part']=="DPY"){
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$result2['drugcode']."' ";
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($result2['price']>$freepri){
				$ddl+=$freepri;
				$ddn+=($result2['price']-$freepri);
				$pitem+=$result2['counter'];
			}else{
				$ddl+=$result2['price'];
				$pitem+=$result2['counter'];
			}
		}*/
	}
	if($ddl>0){
	$posdr = strpos($doctor,"ว.");
	$posdrd = strpos($doctor,"ท.");
	if($posdr==false){
		if($posdrd==false){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว";
			$dr1="$dc$dr";
		}
		else{
			$dr = substr($doctor,($posdrd+2),4);
			$dc="ท";
			$dr1="$dc$dr";
		}
	}
	else{
		$dr = substr($doctor,($posdr+2),5);
		$dc="ว";
		$dr1="$dc$dr";
		if(strlen($dr)<4){
			$seldr = "select doctorcode from doctor where name like '%".substr($doctor,0,9)."%' ";
			$rowdr = mysql_query($seldr);
			list($dr) = mysql_fetch_array($rowdr);
			$dc="ว";
			$dr1="$dc$dr";
		}
	}
	$px1=substr($datepx,8,2); 
    $px2=substr($datepx,5,2); 
    $px3=substr($datepx,0,4)-543; 
	$px4=substr($datepx,11,2); 
	$px5=substr($datepx,14,2); 
	$px6=substr($datepx,17,2); 
	$datepx = "$px3-$px2-$px1 $px4:$px5:$px6";
	
	$op1=substr($dateop,8,2); 
    $op2=substr($dateop,5,2); 
    $op3=substr($dateop,0,4)-543; 
	$op4=substr($dateop,11,2); 
	$op5=substr($dateop,14,2); 
	$op6=substr($dateop,17,2); 
	$dateop = "$op3-$op2-$op1 $op4:$op5:$op6";
	if($datepx=="-543-- ::"){ $datepx=$dateop;}
	$all=$ddl+$ddn;
	$ddl=number_format($ddl,2, '.', '');
	$ddn=number_format($ddn,2, '.', '');
	$all=number_format($all,2, '.', '');
		if($dr==""){
			print (" <tr>\n".
			//   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
			   "  <td BGCOLOR=FF0000><font face='Angsana New'>11512|$date2$xrow$vn|$date2$row_id1$vn|$hn|$cid|$datepx|$dateop|$dr1|$pitem|$all|$ddl|$ddn|0.00|||</td>\n".
	   
			   " </tr>\n");
		}
		else{
			print (" <tr>\n".
			//   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'>11512|$date2$xrow$vn|$date2$row_id1$vn|$hn|$cid|$datepx|$dateop|$dr1|$pitem|$all|$ddl|$ddn|0.00|||</td>\n".
	   
			   " </tr>\n");
		}

	}
          }
    print "<table>";

print "<table>";
    print " <tr>";
	
echo " &lt;/Dispensing&gt;<br>";
echo " &lt;DispensedItems&gt;<br>";
//echo " &lt;/BILLTRAN&gt;<br>";
//echo " &lt;OPBills invcount=&quot;$count&quot; lines=&quot;$count&quot;&gt;";
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
	$dphardate = $y."-".$m."-".$d;
	$query3 = "select date,item,doctor,row_id from phardep where hn= '$hn' and date like '$txdate%' ";
	$row3 = mysql_query($query3);
	list($datepx,$pitem,$doctor,$xrow) = mysql_fetch_array($row3);
	
	$query6 = "SELECT b.drugcode, b.genname, a.slcode, a.amount, a.price, a.part , c.detail1, c.detail2, c.detail3 ,b.unit ,a.reason,b.tmt FROM drugrx as a , druglst as b , drugslip as c WHERE a.hn = '$hn' AND a.drugcode = b.drugcode AND c.slcode = a.slcode AND a.idno = '$xrow' and (a.part='DDL' or a.part='DDY' or a.part='DDN' or a.part='DSY' or a.part='DSN' )";// or a.part='DPY'
	$row6 = mysql_query($query6);
	while(list($drugcode,$genname,$slcode,$amount,$price,$part,$detail1,$detail2,$detail3,$unit,$reason,$tmt) = mysql_fetch_array($row6)){
		$perunit = number_format($price/$amount,2, '.', '');
		if($part=='DDY'||$part=='DDL'){
			$xpart="1";
			$reimb = $perunit;
		}
		elseif($part=='DDN'){
			$xpart="1";
			$reimb = 0.00;
		}
		/*elseif($part=='DPY'){
			$xpart="6";
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$drugcode."' ";
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($price>$freepri){
				$reimb = $freepri;
			}else{
				$reimb = $perunit;
			}
		}*/
		elseif($part=='DSY'){
			$xpart="6";
			$sql3 = "select medical_sup_free,freepri from druglst where drugcode = '".$drugcode."' ";
			$row3 = mysql_query($sql3);
			list($supfree,$freepri) = mysql_fetch_array($row3);
			if($supfree==1){
				if($price>$freepri){
					$reimb = $freepri;
				}else{
					$reimb = $perunit;
				}
				//$reimb = $perunit;
			}else{
				$reimb = 0.00;
			}
		}
		else{$xpart="7";
		$reimb = $perunit;}
		
		$first = substr($drugcode,0,1);
		$sec = substr($drugcode,1,1);
		
		if(ord($sec)<48||ord($sec)>57){
			$dose = $first;
		}else{
			$dose = $first.$sec;
		}
		$priceall=$amount*$perunit;
		$reimball=$amount*$reimb;
		$priceall = number_format($priceall,2, '.', '');
		$reimball = number_format($reimball,2, '.', '');
		$reimb = number_format($reimb,2, '.', '');
		if($part=="DDY"||$part=="DDN"){
			if($reason==""){
				$reason="B";
			}
			$claimcontrol="E".substr($reason,0,1);
			if($reason=="") $color="FF0000";
			else{ $color="66CDAA";}
		}else{
			$claimcontrol="";
			$color="66CDAA";
		}
		if($part=="DDL"){
			$tmt="";
		}
		$tmt=trim($tmt);
		$drugcode=trim($drugcode);
        print (" <tr>\n".
        //   " <td BGCOLOR=66CDAA><font face='Angsana New'>$num1</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$date2$xrow$vn|$xpart|$drugcode|$tmt|$dose|$genname|$unit|$slcode|$detail1 $detail2 $detail3|$amount|$perunit|$priceall|$reimb|$reimball|||$claimcontrol|</td>\n".
   
           " </tr>\n");
          }
	}
    print "<table>";
//echo " &lt;/OPBills&gt;<br>";
echo " &lt;/DispensedItems&gt;<br>";
echo " ";
 echo "&lt;/ClaimRec&gt;";
    include("unconnect.inc");
?>
