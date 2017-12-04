<?php
set_time_limit(30);
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	if($_POST["drugtype"] == "")
		print "<font face='Angsana New' size='3'><b>สรุปจำนวนยา เวชภัณฑ์ อุปกรณ์การแพทย์ ที่จ่ายทั้งหมดของวันที่ $appd</b>";
	else
		print "<font face='Angsana New' size='3'><b>ปริมาณการใช้ยาและมูลค่ายาบัญชี ".$_POST["drugtype"]." ประจำเดือน ".$appmo." ปี ".$thiyr."</b>";
//	print "&nbsp;&nbsp;<a target=_self  href='dgperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
    include("connect.inc");

	if($_POST["only_drug"] == "1"){
		
		$where = " AND (left( a.drugcode, 1 ) in ('0','1','2','3','4','5','6','7','8','9') AND right(left( a.drugcode, 2 ),1) not in ('0','1','2','3','4','5','6','7','8','9')  ) ";

	}else{
		$where = "";
	}


	$query="CREATE TEMPORARY TABLE dgperday SELECT  a.drugcode,a.tradname,a.amount,a.price,b.part,b.unitpri  FROM drugrx as a INNER JOIN druglst as b ON a.drugcode = b.drugcode WHERE a.date LIKE '$appd%' AND b.drugtype like '%".$_POST["drugtype"]."%' ".$where." ORDER BY a.part,a.drugcode ASC";

    $result = mysql_query($query) or die(Mysql_error());

    $query = "SELECT DISTINCT drugcode FROM dgperday";
    $result = mysql_query($query) or die("Query failed4");
		 $aDrugcode=array("aDrugcode"); 
		 $x=0;
	while (list ($drugcode) = mysql_fetch_row ($result)) {
             $x++;
             array_push($aDrugcode,$drugcode); 
               }

/////////นับยาที่ใช้
		 $aTradname=array("aTradname"); 
		 $aAmount=array("aAmount"); 
		 $aPrice=array("aPrice"); 
		 $aPart=array("aPart"); 
		 $aUnitpri=array("aUnitpri"); 
//	print "<br><br><b>สรุปจำนวน ยา เวชภัณฑ์ที่ใช้ทั้งหมด </b>";
	print "<table>";
	print " <tr>";
	print " <th bgcolor=CD853F><font face='Angsana New'>#</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รหัส</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>รายการ</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ราคาทุนต่อหน่วย</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ราคาทุน</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>จำนวนทั้งหมด</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ราคารวม</th>";
	print " <th bgcolor=CD853F><font face='Angsana New'>ประเภท</th>";
	print " </tr>";
	$num=0;
	$nTotalpri=0;
	$nTotalpri2 = 0;
	for ($n=1; $n<=$x; $n++){
			$query = "SELECT tradname,amount,price,part,unitpri FROM dgperday WHERE drugcode='$aDrugcode[$n]'  ";
			$result = mysql_query($query) or die("Query failed5");
			 $aAmount[$n]=0;
			 $aPrice[$n]=0;
		   while (list ($tradname,$amount,$price,$part,$unitpri) = mysql_fetch_row ($result)) {
				$aAmount[$n]=$aAmount[$n]+$amount;
				$aPrice[$n]=$aPrice[$n]+$price;
				$aTradname[$n]=$tradname;
				$aPart[$n]=$part;
				$nTotalpri=$nTotalpri+$price;
				$aUnitpri[$n] = $unitpri;
				

		   }

		   $nTotalpri2=$nTotalpri2+($aUnitpri[$n]*$aAmount[$n]);
		   $num++;
		   print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDrugcode[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aTradname[$n]</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>".($aUnitpri[$n])."</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>".($aUnitpri[$n]*$aAmount[$n])."</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
		   "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".
           " </tr>\n");
	}
	print "</table>";

	$nTotalpri=number_format($nTotalpri,2,'.',',');
	$nTotalpri2=number_format($nTotalpri2,2,'.',',');
	
	print"รวมราคาทั้งสิ้น(ราคาขาย) = $nTotalpri บาท<BR>";
	print"รวมราคาทั้งสิ้น(ราคาทุน) = $nTotalpri2 บาท";

    print "<br><font face='Angsana New' size='2'><b>หมายเหตุ</b><br>";
	print "DDL =  ยาในบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "DDY =  ยานอกบัญชียาหลักแห่งชาติ เบิกได้<br>";
    print "DDN =  ยานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br>";
    print "DPY =  อุปกรณ์ ที่เบิกได้(เบิกได้ทั้งหมดหรือบางส่วน)<br>";
    print "DPN =  อุปกรณ์ ที่เบิกไม่ได้ <br>";
    print "DSY =  เวชภัณฑ์ เบิกไม่ได้<br>";
    print "DSN =  เวชภัณฑ์ เบิกไม่ได้";

//    print "&nbsp;&nbsp;<a target=_self  href='dgperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";

   include("unconnect.inc");
?>
