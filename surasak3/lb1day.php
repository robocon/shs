<?php
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	print "<b>สรุปจำนวนการตรวจ LAB ของวันที่ $appd</b>";
	print "&nbsp;&nbsp;<a target=_self  href='lbperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
    include("connect.inc");
	$query="CREATE TEMPORARY TABLE lbperday SELECT  *  FROM patdata WHERE date LIKE '$appd%' and depart='PATHO'  ORDER BY code ASC";
    $result = mysql_query($query) or die("CREATE TEMPORARY TABLE lbperday fail2");

    $query = "SELECT DISTINCT code FROM lbperday";
    $result = mysql_query($query) or die("Query failed4");
		 $aCode=array("aCode"); 
		 $x=0;
	while (list ($code) = mysql_fetch_row ($result)) {
             $x++;
             array_push($aCode,$code); 
               }

/////////นับยาที่ใช้
		 $aDetail=array("adetail"); 
		 $aAmount=array("aAmount"); 
		 $aYprice=array("aYprice"); 
		 $aNprice=array("aNprice"); 
		 $aPrice=array("aPrice"); 
		 $aPart=array("aPart"); 
//	print "<br><br><b>สรุปจำนวน ยา เวชภัณฑ์ที่ใช้ทั้งหมด </b>";
	print "<table>";
	print " <tr>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>#</th>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>รหัส</th>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>รายการ</th>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>จำนวนทั้งหมด</th>";
	print " <th bgcolor=CD853F rowspan='2' ><font face='Angsana New'>รวมเบิกได้</th>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>รวมเบิกไม่ได้</th>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>ราคารวม</th>";
	print " <th bgcolor=CD853F rowspan='2'><font face='Angsana New'>ประเภท</th>";
	print " <th bgcolor=CD853F colspan='2'><font face='Angsana New'>Labใน</th>";
	print " <th bgcolor=CD853F colspan='2'><font face='Angsana New'>รัฐบาล</th>";
	print " <th bgcolor=CD853F colspan='2'><font face='Angsana New'>ธนบุรี-แลป</th>";
	print " <th bgcolor=CD853F colspan='2'><font face='Angsana New'>อินเตอร์-แลป</th>";
	print " <th bgcolor=CD853F colspan='2'><font face='Angsana New'>กรุงเทพ-พยาธิ</th>";
	print " <th bgcolor=CD853F colspan='2'><font face='Angsana New'>เมดสตาร์-แลป</th>";
	print " </tr>";

	print " <tr>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกไม่ได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกไม่ได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกไม่ได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกไม่ได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกไม่ได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกได้</font></th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>เบิกไม่ได้</font></th>";
	print " </tr>";

	$num=0;
	$nTotalpri=0;
	$nYprinet=0;
	$nNprinet=0;
	for ($n=1; $n<=$x; $n++){
			$query = "SELECT detail,amount,yprice,nprice,price,part FROM lbperday WHERE code='$aCode[$n]'  ";
			$result = mysql_query($query) or die("Query failed5");
			 $aAmount[$n]=0;
			 $aPrice[$n]=0;
			 $aYprice[$n]=0;
			 $aNprice[$n]=0;
		   while (list ($detail,$amount,$yprice,$nprice,$price,$part) = mysql_fetch_row ($result)) {
				$aAmount[$n]=$aAmount[$n]+$amount;
				$aYprice[$n]=$aYprice[$n]+$yprice;
				$aNprice[$n]=$aNprice[$n]+$nprice;
				$aPrice[$n]=$aPrice[$n]+$price;
				$aDetail[$n]=$detail;
				$aPart[$n]=$part;
				$nTotalpri=$nTotalpri+$price;
				$nYprinet=$nYprinet+$yprice;
				$nNprinet=$nNprinet+$nprice;
				
				/// IN
				
				$sqlin="SELECT  SUM(a.yprice) as yin ,SUM(a.nprice) as nin
FROM  lbperday as a , labcare as b  WHERE a.code=b.code  and   b.labtype='IN' and a.code='$aCode[$n]'";
				$ref1 = mysql_query($sqlin) ;
				list ($yin,$nin) = mysql_fetch_row ($ref1);
				
				/// 1 //
				
				$sql1="SELECT  SUM(a.yprice) as y1 ,SUM(a.nprice) as n1
FROM  lbperday as a , labcare as b  WHERE a.code=b.code  and   b.outlab_name='รัฐบาล' and a.code='$aCode[$n]'";
				$ref1 = mysql_query($sql1) ;
				list ($y1,$n1) = mysql_fetch_row ($ref1);
				//echo $sqlin;
				
				$sql2="SELECT  SUM(a.yprice) as y2 ,SUM(a.nprice) as n2
FROM  lbperday as a , labcare as b  WHERE a.code=b.code  and   b.outlab_name='ธนบุรี-แลป' and a.code='$aCode[$n]'";
				$ref2 = mysql_query($sql2) ;
				list ($y2,$n2) = mysql_fetch_row ($ref2);
				
				/////////// อินเตอร์ lab ////////
				
				$sql3="SELECT  SUM(a.yprice) as y3 ,SUM(a.nprice) as n3
FROM  lbperday as a , labcare as b  WHERE a.code=b.code  and   b.outlab_name='อินเตอร์-แลป' and a.code='$aCode[$n]'";
				$ref3 = mysql_query($sql3) ;
				list ($y3,$n3) = mysql_fetch_row ($ref3);
				
					/////////// กรุงเทพ พยาธิ ////////
				
				$sql4="SELECT  SUM(a.yprice) as y4 ,SUM(a.nprice) as n4
FROM  lbperday as a , labcare as b  WHERE a.code=b.code  and   b.outlab_name='กรุงเทพ-พยาธิ' and a.code='$aCode[$n]'";
				$ref4 = mysql_query($sql4) ;
				list ($y4,$n4) = mysql_fetch_row ($ref4);
				
				/////////// เมดสตาร์- แลป ////////
				
				$sql5="SELECT  SUM(a.yprice) as y5 ,SUM(a.nprice) as n5
FROM  lbperday as a , labcare as b  WHERE a.code=b.code  and   b.outlab_name='เมดสตาร์-แลป' and a.code='$aCode[$n]'";
				$ref5 = mysql_query($sql5) ;
				list ($y5,$n5) = mysql_fetch_row ($ref5);
				
		   }
		   $num++;
		   print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aCode[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDetail[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aYprice[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aNprice[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$yin</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$nin</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$y1</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n1</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$y2</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n2</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$y3</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n3</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$y4</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n4</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$y5</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n5</td>\n".
           " </tr>\n");
	
	
		
	$sumyin+=$yin;
	$sumnin+=$nin;	   
	$sumy1+=$y1;
	$sumn1+=$n1;
	$sumy2+=$y2;
	$sumn2+=$n2;
	$sumy3+=$y3;
	$sumn3+=$n3;
	$sumy4+=$y4;
	$sumn4+=$n4;
	$sumy5+=$y5;
	$sumn5+=$n5;
	}
	
	$sumyin=number_format($sumyin,2,'.',',');
	$sumnin=number_format($sumnin,2,'.',',');
	$sumy1=number_format($sumy1,2,'.',',');
	$sumn1=number_format($sumn1,2,'.',',');
	$sumy2=number_format($sumy2,2,'.',',');
	$sumn2=number_format($sumn2,2,'.',',');
	$sumy3=number_format($sumy3,2,'.',',');
	$sumn3=number_format($sumn3,2,'.',',');
	$sumy4=number_format($sumy4,2,'.',',');
	$sumn4=number_format($sumn4,2,'.',',');
	$sumy5=number_format($sumy5,2,'.',',');
	$sumn5=number_format($sumn5,2,'.',',');
	
	
	
	$nYprinet=number_format($nYprinet,2,'.',',');
	$nNprinet=number_format($nNprinet,2,'.',',');
	$nTotalpri=number_format($nTotalpri,2,'.',',');
	
	
	
	
		   print (" <tr>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'> </td>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'> </td>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'><b><center>รวมเงินทั้งสิ้น </center></b></td>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'> </td>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'><b>$nYprinet</b></td>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'><b>$nNprinet</b></td>\n".
           "  <td BGCOLOR=FFD700><font face='Angsana New'><b>$nTotalpri</b></td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> </td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumyin</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumnin</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumy1</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumn1</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumy2</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumn2</td>\n".
		    "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumy3</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumn3</td>\n".
		    "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumy4</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumn4</td>\n".
		    "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumy5</td>\n".
		   "  <td BGCOLOR=FFD700><font face='Angsana New'> $sumn5</td>\n".
           " </tr>\n");

	print "</table>";
    print "&nbsp;&nbsp;<a target=_self  href='lbperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

   include("unconnect.inc");
?>
