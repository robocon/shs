<?php
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	print "<b>สรุปจำนวนทำกายภาพบำบัด เดือน $appd</b>";
	

    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
    include("connect.inc");
	
	$query="CREATE TEMPORARY TABLE lbperday1 SELECT  *  FROM patdata WHERE date LIKE '$appd%' and depart='PHYSI'  and part='pt' ORDER BY code ASC";
    $result = mysql_query($query) or die("CREATE TEMPORARY TABLE lbperday fail2");

	
	
	//echo $query;
	
	$sql = "Select date_format(date, '%Y-%m-%d' ) AS date2,an, sum(amount), sum(price) From lbperday1   group by date2   ORDER by date";
$result = Mysql_Query($sql) or die(Mysql_Error());
//echo $sql;

           $aDate=array("aDate"); 
		 $x=0;
while(list($date, $depart, $paidcscd,$price) = Mysql_fetch_row($result)){
	
	
		
             $x++;
             array_push($aDate,$date); 
               }
/////////นับยาที่ใช้
		 $aDetail=array("adetail"); 
		 $aAmount=array("aAmount"); 
		 $aYprice=array("aYprice"); 
		 $aNprice=array("aNprice"); 
		 $aPrice=array("aPrice"); 
		 $aPart=array("aPart"); 
	print "<table>";
	print " <tr>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>#</th>";
//	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>รหัส</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>วันที่</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>ผู้ป่วยนอก</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>รวมเป็นเงิน</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>ผู้ป่วยใน</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>รวมเป็นเงิน</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>จำนวนทั้งหมด</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>รวมเบิกได้</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>รวมเบิกไม่ได้</th>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>ราคารวม</th>";
//	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>ประเภท</th>";
	print " </tr>";
	$num=0;
	$nTotalpri=0;
	$nYprinet=0;
	$nNprinet=0;
	 $aAmount1t=0;
			 $aAmount2t=0;
			 $aPrice1t=0;
			 $aPrice2t=0;
	for ($n=1; $n<=$x; $n++){
			$query = "SELECT detail,amount,yprice,nprice,price,part,an FROM lbperday1 WHERE date like '$aDate[$n]%'  ";
			//echo $query;
			$result = mysql_query($query) or die("Query failed5");
			 $aAmount[$n]=0;
			 $aPrice[$n]=0;
			 $aYprice[$n]=0;
			 $aNprice[$n]=0;
			
			 
		   while (list ($detail,$amount,$yprice,$nprice,$price,$part,$an) = mysql_fetch_row ($result)) {
			   
			   if($an==''){
				$aAmount1[$n]=$aAmount1[$n]+$amount; 
			    $aPrice1[$n]=$aPrice1[$n]+$price; 
			    $aAmount1t=$aAmount1t+$amount;  
				$aPrice1t=$aPrice1t+$price; };
				
				
			    if($an!=''){
				$aAmount2[$n]=$aAmount2[$n]+$amount; 
				$aPrice2[$n]=$aPrice2[$n]+$price; 
				$aAmount2t=$aAmount2t+$amount; 
				$aPrice2t=$aPrice2t+$price;  };
			   
			   
			   
			   
			   
			 
			   
				$aAmount[$n]=$aAmount[$n]+$amount;
				$aYprice[$n]=$aYprice[$n]+$yprice;
				$aNprice[$n]=$aNprice[$n]+$nprice;
				$aPrice[$n]=$aPrice[$n]+$price;
				$aDetail[$n]=$detail;
				$aPart[$n]=$part;
				$aAmounttt=$aAmounttt+$amount;
				$nTotalpri=$nTotalpri+$price;
				$nYprinet=$nYprinet+$yprice;
				$nNprinet=$nNprinet+$nprice;
				
				
				
				

  $sql111 = "Select price From labcare where code='$aCode[$n]' ";
	$result111 = Mysql_Query($sql111);
	list($pricefull) = Mysql_fetch_row($result111);
			   
		   }
		   $num++;
		   
		   $thiyr=substr($aDate[$n],0,4);
		   $appmo=substr($aDate[$n],5,2);
		   $appdate=substr($aDate[$n],8,2);
		 
		   print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3 align=center><font face='Angsana New' size='2'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3 align=center><font face='Angsana New' size='2'><a target='_BLANK' href='reportpt1day_tnb.php? thiyr=$thiyr&appmo=$appmo&appdate=$appdate'>$aDate[$n]</a></td>\n".
        //   "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='2'>$aDetail[$n]($pricefull)</td>\n".
		     "  <td  bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$aAmount1[$n]</td>\n".
			   "  <td bgcolor=CCFF99 align=right><font face='Angsana New' size='2'>$aPrice1[$n]</td>\n".
			     "  <td bgcolor=CCFF99 align=center><font face='Angsana New' size='2'>$aAmount2[$n]</td>\n".
				   "  <td bgcolor=CCFF99 align=right><font face='Angsana New' size='2'>$aPrice2[$n]</td>\n".
		   
		   
		   
		   
           "  <td bgcolor=FF66CC align=center><font face='Angsana New' size='2'>$aAmount[$n]</td>\n".
           "  <td  bgcolor=FF66CC align=right><font face='Angsana New' size='2'>$aYprice[$n]</td>\n".
           "  <td bgcolor=FF66CC align=right><font face='Angsana New' size='2'>$aNprice[$n]</td>\n".
           "  <td  bgcolor=33FFCC align=right><font face='Angsana New' size='2'><b>$aPrice[$n]</b></td>\n".
		 //  "  <td bgcolor=FF66CC><font face='Angsana New' size='2'>$aPart[$n]</td>\n".
           " </tr>\n");
	}
	$nYprinet=number_format($nYprinet,2,'.',',');
	$nNprinet=number_format($nNprinet,2,'.',',');
	$nTotalpri=number_format($nTotalpri,2,'.',',');
	$aPrice1t =number_format($aPrice1t ,2,'.',',');
	$aPrice2t =number_format($aPrice2t ,2,'.',',');
		   print (" <tr>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New' size='2'> </td>\n".
        //   "  <td BGCOLOR=FFD700><font face='Angsana New' size='2'> </td>\n".
		    "  <td BGCOLOR=FFD700><font face='Angsana New' size='2'> <center>รวมเงินทั้งสิ้น </center></td>\n".
			 "  <td BGCOLOR=FFD700 align=center><font face='Angsana New' size='2'> <b>$aAmount1t</td>\n".
			  "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$aPrice1t </td>\n".
			   "  <td BGCOLOR=FFD700 align=center><font face='Angsana New' size='2'><b>$aAmount2t </td>\n".
           "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$aPrice2t</b></td>\n".
           "  <td BGCOLOR=FFD700 align=center><font face='Angsana New' size='2'><b> $aAmounttt</b></td>\n".
           "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$nYprinet</b></td>\n".
           "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$nNprinet</b></td>\n".
           "  <td BGCOLOR=FFD700 align=right><font face='Angsana New' size='2'><b>$nTotalpri</b></td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New' size='2'> </td>\n".
           " </tr>\n");

	print "</table>";
	
	
	 $query1 = "SELECT DISTINCT hn FROM lbperday1 where an = '' ";
    $result1 = mysql_query($query1) or die("Query failed8");
		$num1=mysql_num_rows($result1);
		
			 $query2 = "SELECT DISTINCT an FROM lbperday1 where an != ''  ";
    $result2 = mysql_query($query2) or die("Query failed8");
		$num2=mysql_num_rows($result2);
	
	print "<table>";
	print "<tr>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>จำนวนผู้ป่วยนอก/HN</th>";
	print " <th  bgcolor=CCFF00><font face='Angsana New' size='2'>จำนวนผู้ป่วยใน/AN</th>";
	print "<tr>"; 
	print "<tr>";
	print " <th bgcolor=CD853F><font face='Angsana New' size='2'>$num1</th>";
	print " <th bgcolor=CCFF00><font face='Angsana New' size='2'>$num2</th>";
	print "<tr>"; 
	print "</table>";
	
 //   print "&nbsp;&nbsp;<a target=_self  href='ptperday_tnb.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

   include("unconnect.inc");
?>
