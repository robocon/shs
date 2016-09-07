<?php
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	print "<b>สรุปจำนวนหัตถการของกองทันตกรรม วันที่ $appd</b>";
	print "&nbsp;&nbsp;<a target=_self  href='denperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
    include("connect.inc");
	$query="CREATE TEMPORARY TABLE lbperday 
	SELECT  *  FROM patdata 
	WHERE date LIKE '$appd%' 
	and depart='DENTA'  
	ORDER BY code ASC";
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
	print "<table>";
	print " <tr>";
	print " <th bgcolor=CD853F><font face='Angsana New'>#</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>จำนวนทั้งหมด</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รวมเบิกได้</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รวมเบิกไม่ได้</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ราคารวม</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ประเภท</th>";
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

		   }
		   $num++;
		   print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aCode[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"chkdendetel.php? code=$aCode[$n]&yrmonth=$appd\">$aDetail[$n]</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aYprice[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aNprice[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".
           " </tr>\n");
	}
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
           " </tr>\n");

	print "</table>";
    print "&nbsp;&nbsp;<a target=_self  href='denperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

   include("unconnect.inc");
?>
