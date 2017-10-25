<?php
   session_start(); //6-03-04
   error_reporting(0);
    $sDiscdate="$yr-$m-$d";
    session_register("sDiscdate"); //add

    $today="$d-$m-$yr";
    print "<font face='Angsana New'>รายชื่อผู้ป่วยในที่รอหอผู้ป่วยจำหน่าย !! กรุณาติดต่อหอผู้ป่วยเพื่อที่จำหน่ายผู้ป่วย";
 //   print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
	
?>
<table>
 <tr>
  <th bgcolor=#ffffcc><font face='Angsana New'>ชื่อ</th>
  <th bgcolor=#ffffcc><font face='Angsana New'>HN</th>
  <th bgcolor=#ffffcc><font face='Angsana New'>AN</th>
  <th bgcolor=#ffffcc><font face='Angsana New'>ห้อง</th>
  <th bgcolor=#ffffcc><font face='Angsana New'>สิทธิ</th>


 

  </tr>
  </tr>

<?php
    include("connect.inc");
	$today1=(date("Y")+543).date("-m-d");
    $query = "SELECT ptname,hn,an,bedcode,price,paid,accno,date,dcdate,days,ptright,diag,ipmonrep FROM ipcard WHERE dcdate = '0000-00-00 00:00:00' and lock_dc  = '$today1' "; 
    $result = mysql_query($query)
        or die("Query failed ipcard");

    while (list ($ptname,$hn,$an,$bedcode,$price,$paid,$accno,$date,$dcdate,$days,$ptright,$diag,$ipmonrep) = mysql_fetch_row ($result)) {
		
		
		$monrep="";
			
		if($ipmonrep=="Y"){
			$monrep="<a target=_BLANK  href=\"ipaccount.php? an=$an&accno=1\">สรุปค่าใช้จ่าย</a>";
		}else{
			$monrep="สรุปค่าใช้จ่าย";
		}
		
		$dcdate1=$dcdate;
		$dcdate=substr($dcdate,11,8);
		
        print (" <tr>\n".
           "  <td BGCOLOR=#ffffcc><font face='Angsana New'>$ptname</a></td>\n".
           "  <td BGCOLOR=#ffffcc><font face='Angsana New'>$hn</a></td>\n".
           "  <td BGCOLOR=#ffffcc><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=#ffffcc><font face='Angsana New'>$bedcode</td>\n".
		   "  <td BGCOLOR=#ffffcc><font face='Angsana New'>$ptright</td>\n".
	//	   "  <td BGCOLOR=#ffffcc>$monrep</td>\n".
        //   "  <td BGCOLOR=66CDAA>$price</td>\n".
       //    "  <td BGCOLOR=66CDAA>$paid</td>\n".
      //     "  <td BGCOLOR=66CDAA>$accno</td>\n".
			    //   "  <td BGCOLOR=66CDAA>ทั้งหมด</td>\n".
				//	    "  <td BGCOLOR=66CDAA>ค่าห้อง</td>\n".
					//		 "  <td BGCOLOR=66CDAA>ยานอก</td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>

<?php
//    session_start(); //6-03-04
    $sDiscdate="$yr-$m-$d";
    session_register("sDiscdate"); //add

    $today="$d-$m-$yr";
    print "รายชื่อคนไข้ในที่จำหน่ายในวันที่ $today";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
	
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>เก็บเงินทั้งหมด</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>เก็บเงินส่วนเกิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เก็บเงินค่าห้อง</th>
  <th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>
 <th bgcolor=6495ED><font face='Angsana New'>สรุปค่าใช้จ่าย</th>

 
   <th bgcolor=6495ED><font face='Angsana New'>ส่วนเกิน</th>
    <th bgcolor=6495ED><font face='Angsana New'>ส่วนเกิน</th>
	<th bgcolor=6495ED><font face='Angsana New'>ยานอก</th>
	<th bgcolor=6495ED><font face='Angsana New'>สรุปค่าใช้จ่าย</th>
	<th bgcolor=6495ED><font face='Angsana New'>ตามหมวด</th>
  </tr>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,bedcode,price,paid,accno,date,dcdate,days,ptright,diag,ipmonrep FROM ipcard WHERE dcdate LIKE '$today%' ";
    $result = mysql_query($query)
        or die("Query failed ipcard");

    while (list ($ptname,$hn,$an,$bedcode,$price,$paid,$accno,$date,$dcdate,$days,$ptright,$diag,$ipmonrep) = mysql_fetch_row ($result)) {
		
		
		$monrep="";
			
		if($ipmonrep=="Y"){
			$monrep="<a target=_BLANK  href=\"ipaccount.php? an=$an&accno=1\">สรุปค่าใช้จ่าย</a>";
		}else{
			$monrep="สรุปค่าใช้จ่าย";
		}
		
		$dcdate1=$dcdate;
		$dcdate=substr($dcdate,11,8);
		
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipchkbil.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate1&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipchkbillist.php?vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate1&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipchkbil1.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate1&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipchkbil1.1.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate1&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$bedcode</td>\n".
			        "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipaccount1.php? an=$an&accno=1\">$ptright</td>\n".
					 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$monrep</td>\n".
        //   "  <td BGCOLOR=66CDAA>$price</td>\n".
       //    "  <td BGCOLOR=66CDAA>$paid</td>\n".
      //     "  <td BGCOLOR=66CDAA>$accno</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipaccountbillN.php? an=$an&accno=1\">ทั้งหมด</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipaccountbillB.php? an=$an&accno=1\">ค่าห้อง</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"pharxout.php? an=$an&accno=1\">ยานอก</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipaccountdatebetween.php? an=$an&accno=1\">ตามเวลา</td>\n".
			 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"ipchkbil_grouppart.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">เก็บเงิน</a></td>\n".
			 
           " </tr>\n");
       }
    include("unconnect.inc");
?>
</table>


<?php
//    session_start(); //6-03-04
    $sDiscdate="$yr-$m-$d";
    session_register("sDiscdate"); //add

    $today="$d-$m-$yr";

	//print "<BR><BR><BR><BR><BR><BR><FONT SIZE='5' COLOR='#FF0000'>ยังไม่ได้อนุญาติให้ใช้ ทดสอบโปรแกรมอยู่</FONT><BR>";
    print "<font face='Angsana New'>รายชื่อคนไข้ในนอนนานเกิน 60 วัน ในวันที่ $today";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
	
	session_unregister("x");
    session_unregister("aIdname");
    session_unregister("aDep");
    session_unregister("aDtail");
    session_unregister("aAmt");
    session_unregister("aPri");
    session_unregister("aPaid");
    session_unregister("aPart");
    session_unregister("aDay");
    session_unregister("aBFY");
    session_unregister("aBFN");
    session_unregister("aBBFY");
    session_unregister("aBBFN");
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
	session_unregister("aEssd1");
    session_unregister("aNessdy1");
    session_unregister("aNessdn1");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aBlood");
    session_unregister("aLabo");
    session_unregister("aXray");
    session_unregister("aSinv");
    session_unregister("aTool");
    session_unregister("aSurg");    
    session_unregister("aNcare");    
    session_unregister("aDent");
    session_unregister("aPhysi");
    session_unregister("aStx");
    session_unregister("aMc");
	
	session_unregister("aBloody");
    session_unregister("aLaboy");
    session_unregister("aXrayy");
    session_unregister("aSinvy");
    session_unregister("aTooly");
    session_unregister("aSurgy");    
    session_unregister("aNcarey");    
    session_unregister("aDenty");
    session_unregister("aPhysiy");
    session_unregister("aStxy");
    session_unregister("aMcy");
	
	session_unregister("aBloodn");
    session_unregister("aLabon");
    session_unregister("aXrayn");
    session_unregister("aSinvn");
    session_unregister("aTooln");
    session_unregister("aSurgn");    
    session_unregister("aNcaren");    
    session_unregister("aDentn");
    session_unregister("aPhysin");
    session_unregister("aStxn");
    session_unregister("aMcn");

//  session_unregister("sDiscdate");
    session_unregister("aDEssd");
    session_unregister("aDNessdy");
    session_unregister("aDNessdn");

    session_unregister("aBDEssd");
    session_unregister("aBDNessdy");
    session_unregister("aBDNessdn");

    session_unregister("aBEssd");
    session_unregister("aBNessdy");
    session_unregister("aBNessdn");
	  session_unregister("aBEssd1");
    session_unregister("aBNessdy1");
    session_unregister("aBNessdn1");
    session_unregister("aBDDL");
    session_unregister("aBDDY");
    session_unregister("aBDDN");
    session_unregister("aBDPY");
    session_unregister("aBDPN");
    session_unregister("aBDSY");
    session_unregister("aBDSN");
    session_unregister("aBBlood");
    session_unregister("aBLabo");
    session_unregister("aBXray");
    session_unregister("aBSinv");
    session_unregister("aBTool");
    session_unregister("aBSurg");    
    session_unregister("aBNcare");    
    session_unregister("aBDent");
    session_unregister("aBPhysi");
    session_unregister("aBStx");
    session_unregister("aBMc");
	

    session_unregister("aBLaboy");
    session_unregister("aBXrayy");
    session_unregister("aBSinvy");
    session_unregister("aBTooly");
    session_unregister("aBSurgy");    
    session_unregister("aBNcarey");    
    session_unregister("aBDenty");
    session_unregister("aBPhysiy");
    session_unregister("aBStxy");
    session_unregister("aBMcy");
	
    session_unregister("aBLabon");
    session_unregister("aBXrayn");
    session_unregister("aBSinvn");
    session_unregister("aBTooln");
    session_unregister("aBSurgn");    
    session_unregister("aBNcaren");    
    session_unregister("aBDentn");
    session_unregister("aBPhysin");
    session_unregister("aBStxn");
    session_unregister("aBMcn");	
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>เก็บเงินค้างจ่าย</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใบแจ้งชำระเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เตียง</th>
  <th bgcolor=6495ED><font face='Angsana New'>สิทธิ</th>


  <th bgcolor=6495ED><font face='Angsana New'>วันนอน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ส่วนเกิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>แก้ไขค่าห้อง</th>
  <th bgcolor=6495ED><font face='Angsana New'>เก็บเงินตามหมวดรายการ</th>
  </tr>

<?php
    include("connect.inc");
	
    

    $query = "SELECT ptname,hn,an,bedcode,price,paid,accno,date,bed,ptright,diagnos,days FROM bed WHERE  an != '' and days > 60 order by ptright";
    $result = mysql_query($query)
        or die("Query failed bed");

    while (list ($ptname,$hn,$an,$bedcode,$price,$paid,$accno,$date,$bed,$ptright,$diag,$daysall) = mysql_fetch_row ($result)) {
		
	$aIdname  =array("idname");
    $Netpri  ="";   
    $Netpaid   ="";
    $aDep   =array("depart");
    $aDtail    = array("detail");
    $aAmt      =array("amount");
    $aPri      =array("price");
    $aPaid       = array("paid");
    $aPart       = array("part");
    $aDay        =array("date");

    $aBFY       = array("BFY");
    $aBFN       = array("BFN");
    $aBBFY       = array("BFY");
    $aBBFN       = array("BFN");

    $aEssd      =array("DDL");
    $aNessdy  =array("DDY");
    $aNessdn  =array("DDN");
	$aEssd1      =array("DDL");
    $aNessdy1  =array("DDY");
    $aNessdn1  =array("DDN");
    $aDPY       =array("DPY");
    $aDPN       =array("DPN");   
    $aDSY       =array("DSY");
    $aDSN       =array("DSN");   
    $aBlood     = array("BLOOD");
    $aLabo         =array("LABO");
    $aXray         =array("XRAY");
    $aSinv        = array("SINV");
    $aTool        = array("TOOL");
    $aSurg        =array("SURG");
    $aNcare       = array("NCARE");
    $aDent          =array("DENTA");
    $aPhysi       =array("PT");
    $aStx            = array("STX");
    $aMc            = array("MC");
	
	$aBloody     = array("BLOODY");
    $aLaboy         =array("LABOY");
    $aXrayy         =array("XRAYY");
    $aSinvy        = array("SINVY");
    $aTooly        = array("TOOLY");
    $aSurgy        =array("SURGY");
    $aNcarey       = array("NCAREY");
    $aDenty          =array("DENTAY");
    $aPhysiy       =array("PTY");
    $aStxy            = array("STXY");
    $aMcy           = array("MCY");
	
	$aBloodn     = array("BLOODN");
    $aLabon         =array("LABON");
    $aXrayn         =array("XRAYN");
    $aSinvn        = array("SINVN");
    $aTooln        = array("TOOLN");
    $aSurgn        =array("SURGN");
    $aNcaren       = array("NCAREN");
    $aDentn          =array("DENTAN");
    $aPhysin       =array("PTN");
    $aStxn            = array("STXN");
    $aMcn            = array("MCN");
//ยาที่นำกลับบ้าน
    $aDEssd      =array("DDL");
    $aDNessdy  =array("DDY");
    $aDNessdn  =array("DDN");
//    $aDDSY       =array("DSY");
//    $aDDSN       =array("DSN");   
//หักเงินที่จ่ายแล้ว
    $aBEssd      =array("DDL");
    $aBNessdy  =array("DDY");
    $aBNessdn  =array("DDN");
	$aBEssd1      =array("DDL");
    $aBNessdy1  =array("DDY");
    $aBNessdn1  =array("DDN");
    $aBDPY       =array("DPY");
    $aBDPN       =array("DPN");   
    $aBDSY       =array("DSY");
    $aBDSN       =array("DSN");   
    $aBBlood     = array("BLOOD");
    $aBLabo         =array("LABO");
    $aBXray         =array("XRAY");
    $aBSinv        = array("SINV");
    $aBTool        = array("TOOL");
    $aBSurg        =array("SURG");
    $aBNcare       = array("NCARE");
    $aBDent          =array("DENTA");
    $aBPhysi       =array("PT");
    $aBStx            = array("STX");
    $aBMc            = array("MC");
	
	$aBBloody     = array("BLOODY");
    $aBLaboy         =array("LABOY");
    $aBXrayy         =array("XRAYY");
    $aBSinvy        = array("SINVY");
    $aBTooly        = array("TOOLY");
    $aBSurgy        =array("SURGY");
    $aBNcarey       = array("NCAREY");
    $aBDenty          =array("DENTAY");
    $aBPhysiy       =array("PTY");
    $aBStxy           = array("STXY");
    $aBMcy            = array("MCY");
	
	$aBBloodn     = array("BLOODN");
    $aBLabon         =array("LABON");
    $aBXrayn         =array("XRAYN");
    $aBSinvn        = array("SINVN");
    $aBTooln        = array("TOOLN");
    $aBSurgn        =array("SURGN");
    $aBNcaren       = array("NCAREN");
    $aBDentn          =array("DENTAN");
    $aBPhysin       =array("PTN");
    $aBStxn            = array("STXN");
    $aBMcn            = array("MCN");

    $aBDEssd      =array("DDL");
    $aBDNessdy  =array("DDY");
    $aBDNessdn  =array("DDN");
	
	session_register("aDEssd");
    session_register("aDNessdy");
    session_register("aDNessdn");
//    session_register("aDDSY");
//    session_register("aDDSN");

    session_register("aBDEssd");
    session_register("aBDNessdy");
    session_register("aBDNessdn");
//    session_register("aBDDSY");
//    session_register("aBDDSN");

    session_register("cAdmit");
    session_register("cDcdate");
    session_register("cDays");
    session_register("cAn");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
    session_register("cDiag");

    session_register("x");
    session_register("aIdname");
    session_register("aDep");
    session_register("aDtail");
    session_register("aAmt");
    session_register("aPri");
    session_register("aPaid");
    session_register("aPart");
    session_register("aDay");
    session_register("aBFY");
    session_register("aBFN");
    session_register("aBBFY");
    session_register("aBBFN");
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
	session_register("aEssd1");
    session_register("aNessdy1");
    session_register("aNessdn1");

    session_register("aDDL");
    session_register("aDDY");
    session_register("aDDN");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");
    session_register("aBlood");
    session_register("aLabo");
    session_register("aXray");
    session_register("aSinv");
    session_register("aTool");
    session_register("aSurg");    
    session_register("aNcare");    
    session_register("aDent");
    session_register("aPhysi");
    session_register("aStx");
    session_register("aMc");
	
	session_register("aBloody");
    session_register("aLaboy");
    session_register("aXrayy");
    session_register("aSinvy");
    session_register("aTooly");
    session_register("aSurgy");    
    session_register("aNcarey");    
    session_register("aDenty");
    session_register("aPhysiy");
    session_register("aStxy");
    session_register("aMcy");
	
	session_register("aBloodn");
    session_register("aLabon");
    session_register("aXrayn");
    session_register("aSinvn");
    session_register("aTooln");
    session_register("aSurgn");    
    session_register("aNcaren");    
    session_register("aDentn");
    session_register("aPhysin");
    session_register("aStxn");
    session_register("aMcn");
	
	session_register("abillno");


    session_register("aBEssd");
    session_register("aBNessdy");
    session_register("aBNessdn");
	session_register("aBEssd1");
    session_register("aBNessdy1");
    session_register("aBNessdn1");
    session_register("aBDDL");
    session_register("aBDDY");
    session_register("aBDDN");
    session_register("aBDPY");
    session_register("aBDPN");
    session_register("aBDSY");
    session_register("aBDSN");
    session_register("aBBlood");
    session_register("aBLabo");
    session_register("aBXray");
    session_register("aBSinv");
    session_register("aBTool");
    session_register("aBSurg");    
    session_register("aBNcare");    
    session_register("aBDent");
    session_register("aBPhysi");
    session_register("aBStx");
    session_register("aBMc");

	session_register("aBBloody");
    session_register("aBLaboy");
    session_register("aBXrayy");
    session_register("aBSinvy");
    session_register("aBTooly");
    session_register("aBSurgy");    
    session_register("aBNcarey");    
    session_register("aBDenty");
    session_register("aBPhysiy");
    session_register("aBStxy");
    session_register("aBMcy");
	
    session_register("aBBloodn");
    session_register("aBLabon");
    session_register("aBXrayn");
    session_register("aBSinvn");
    session_register("aBTooln");
    session_register("aBSurgn");    
    session_register("aBNcaren");    
    session_register("aBDentn");
    session_register("aBPhysin");
    session_register("aBStxn");
    session_register("aBMcn");
	
	$query1 = "SELECT * FROM ipacc WHERE an = '$an'";
    $result1 = mysql_query($query1)or die("Query failed ipacc");

    for ($i = mysql_num_rows($result1) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result1, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result1)))
            continue;      

    array_push($aDay,$row->date);
    array_push($aDep,$row->depart);
    array_push($aDtail,$row->detail);
    array_push($aAmt,$row->amount);
    array_push($aPri,$row->price);
    array_push($aPaid,$row->paid);
    array_push($aPart,$row->part);
    array_push($aIdname,$row->idname);
	array_push($abillno,$row->billno);
	 
	 
	 
//1. ค่าห้อง/ค่าอาหาร(เบิกได้)
if ($row->part=="BFY"){
            array_push($aBFY,$row->price);
            array_push($aBBFY,$row->price-$row->paid);
            }
// 1.ค่าห้อง/ค่าอาหาร(ส่วนเกิน)			
if ($row->part=="BFN"){
            array_push($aBFN,$row->price);
            array_push($aBBFN,$row->price-$row->paid);
            } 

//2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา
if ($row->part=="DPY"){
            array_push($aDPY,$row->price);
            array_push($aBDPY,$row->price-$row->paid);
            } 
if ($row->part=="DPN"){
            array_push($aDPN,$row->price); 
            array_push($aBDPN,$row->price-$row->paid); 
            } 

//3. ยาที่ใช้ใน รพ.
if ($row->part=="DDL" and substr($row->date,0,10)!="$sDiscdate1"){
            array_push($aEssd,$row->price);
            array_push($aBEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)!="$sDiscdate1"){
            array_push($aNessdy,$row->price);
            array_push($aBNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)!="$sDiscdate1"){
            array_push($aNessdn,$row->price);
            array_push($aBNessdn,$row->price-$row->paid);
            } 

			//3.1 ยาที่คืนใช้ใน รพ.ในวันจำหน่าย
if ($row->part=="DDL" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aEssd1,$row->price);
            array_push($aBEssd1,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aNessdy1,$row->price);
            array_push($aBNessdy1,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aNessdn1,$row->price);
            array_push($aBNessdn1,$row->price-$row->paid);
            } 

//4. ยาที่นำไปใช้ต่อที่บ้าน   (วันที่จำหน่าย)
if ($row->part=="DDL" and substr($row->date,0,10)=="$sDiscdate1"){
            array_push($aDEssd,$row->price);
            array_push($aBDEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aDNessdy,$row->price);
            array_push($aBDNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aDNessdn,$row->price);
            array_push($aBDNessdn,$row->price-$row->paid);
            } 
//
//5. เวชภัณฑ์ที่ไม่ใช่ยา
 if ($row->part=="DSY"){
            array_push($aDSY,$row->price);  
            array_push($aBDSY,$row->price-$row->paid);  
            } 
if ($row->part=="DSN"){
            array_push($aDSN,$row->price);
            array_push($aBDSN,$row->price-$row->paid);
            } 

//6. ค่าบริการโลหิตและส่วนประกอบของโลหิต
if ($row->part=="BLOOD"){
            array_push($aBlood,$row->price);
            array_push($aBBlood,$row->price-$row->paid);
            }  
if ($row->part=="BLOODY"){
            array_push($aBloody,$row->price);
            array_push($aBBloody,$row->price-$row->paid);
            }  
if ($row->part=="BLOODN"){
            array_push($aBloodn,$row->price);
            array_push($aBBloodn,$row->price-$row->paid);
            }  
//7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา			
if ($row->part=="LAB"){
            array_push($aLabo,$row->price);  
            array_push($aBLabo,$row->price-$row->paid);  
            } 
if ($row->part=="LABY"){
            array_push($aLaboy,$row->price);  
            array_push($aBLaboy,$row->price-$row->paid);  
            }
if ($row->part=="LABN"){
            array_push($aLabon,$row->price);  
            array_push($aBLabon,$row->price-$row->paid);  
            }
//8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา
if ($row->part=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aBXray,$row->price-$row->paid);
            }
if ($row->part=="XRAYY"){
            array_push($aXrayy,$row->price);  
            array_push($aBXrayy,$row->price-$row->paid);
            }
if ($row->part=="XRAYN"){
            array_push($aXrayn,$row->price);  
            array_push($aBXrayn,$row->price-$row->paid);
            }
//9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ			
if ($row->part=="SINV"){
            array_push($aSinv,$row->price);
            array_push($aBSinv,$row->price-$row->paid);
            }  
if ($row->part=="SINVY"){
            array_push($aSinvy,$row->price);
            array_push($aBSinvy,$row->price-$row->paid);
            }  
if ($row->part=="SINVN"){
            array_push($aSinvn,$row->price);
            array_push($aBSinvn,$row->price-$row->paid);
            }  
//10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์			
if ($row->part=="TOOL"){
            array_push($aTool,$row->price);
            array_push($aBTool,$row->price-$row->paid);
            }
if ($row->part=="TOOLY"){
            array_push($aTooly,$row->price);
            array_push($aBTooly,$row->price-$row->paid);
            }
if ($row->part=="TOOLN"){
            array_push($aTooln,$row->price);
            array_push($aBTooln,$row->price-$row->paid);
            }
//11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี			
if ($row->part=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aBSurg,$row->price-$row->paid);  
            }
if ($row->part=="SURGY"){
            array_push($aSurgy,$row->price);  
            array_push($aBSurgy,$row->price-$row->paid);  
            }
if ($row->part=="SURGN"){
            array_push($aSurgn,$row->price);  
            array_push($aBSurgn,$row->price-$row->paid);  
            }
//12. ค่าบริการทางการพยาบาลทั่วไป			
if ($row->part=="NCARE"){
            array_push($aNcare,$row->price);
            array_push($aBNcare,$row->price-$row->paid);
            } 
if ($row->part=="NCAREY"){
            array_push($aNcarey,$row->price);
            array_push($aBNcarey,$row->price-$row->paid);
            } 
if ($row->part=="NCAREN"){
            array_push($aNcaren,$row->price);
            array_push($aBNcaren,$row->price-$row->paid);
            } 
//13. ค่าบริการทางทันตกรรม			
if ($row->part=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aBDent,$row->price-$row->paid);  
            }
if ($row->part=="DENTAY"){
            array_push($aDenty,$row->price);  
            array_push($aBDenty,$row->price-$row->paid);  
            }
if ($row->part=="DENTAN"){
            array_push($aDentn,$row->price);  
            array_push($aBDentn,$row->price-$row->paid);  
            }
//14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู			
if ($row->part=="PT"){
            array_push($aPhysi,$row->price);  
            array_push($aBPhysi,$row->price-$row->paid);  
            }
if ($row->part=="PTY"){
            array_push($aPhysiy,$row->price);  
            array_push($aBPhysiy,$row->price-$row->paid);  
            }
if ($row->part=="PTN"){
            array_push($aPhysin,$row->price);  
            array_push($aBPhysin,$row->price-$row->paid);  
            }
//15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ			
if ($row->part=="STX"){
            array_push($aStx,$row->price);
            array_push($aBStx,$row->price-$row->paid);
            }
if ($row->part=="STXY"){
            array_push($aStxy,$row->price);
            array_push($aBStxy,$row->price-$row->paid);
            }
if ($row->part=="STXN"){
            array_push($aStxn,$row->price);
            array_push($aBStxn,$row->price-$row->paid);
            }
//16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา			
if ($row->part=="MC"){
            array_push($aMc,$row->price);
            array_push($aBMc,$row->price-$row->paid);
            } 
if ($row->part=="MCY"){
            array_push($aMcy,$row->price);
            array_push($aBMcy,$row->price-$row->paid);
            }  
if ($row->part=="MCN"){
            array_push($aMcn,$row->price);
            array_push($aBMcn,$row->price-$row->paid);
            }  

       }
// include("unconnect.inc");

//ค่ารักษาพยาบาล หักที่จ่ายแล้ว  เพื่อออกใบเสร็จส่วนที่ค้างจ่าย
    $BFY       = array_sum($aBBFY);
    $BFN       = array_sum($aBBFN);
//ยาที่ใช้ใน รพ.   รายการในใบเสร็จ หักเงินที่จ่ายแล้วออก
	//ยาที่ใช้ใน รพ.คืนวันกลับบ้าน
    $Essd1    =array_sum($aBEssd1);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy1=array_sum($aBNessdy1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY1 =$Essd1+$Nessdy1; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn1=array_sum($aBNessdn1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได

    $Essd    =array_sum($aBEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aBNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy+$DDLDDY1; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aBNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
	
//ยาเวชภัณฑ์ที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aBDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aBDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aBDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
//
    $DSY     =array_sum($aBDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aBDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aBDPY);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aBDPN);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกไม่ได้  

    $Blood     = array_sum($aBBlood);
	$Bloody     = array_sum($aBBloody);
	$Bloodn     = array_sum($aBBloodn);
    $Labo         =array_sum($aBLabo);
	$Laboy         =array_sum($aBLaboy);
	$Labon       =array_sum($aBLabon);
    $Xray         =array_sum($aBXray);
	$Xrayy         =array_sum($aBXrayy);
	$Xrayn         =array_sum($aBXrayn);
    $Sinv        = array_sum($aBSinv);
	$Sinvy        = array_sum($aBSinvy);
	$Sinvn        = array_sum($aBSinvn);
    $Tool        = array_sum($aBTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
	$Tooly        = array_sum($aBTooly); 
	$Tooln        = array_sum($aBTooln); 
    $Surg         =array_sum($aBSurg);
	$Surgy         =array_sum($aBSurgy);
	$Surgn         =array_sum($aBSurgn);
    $Ncare       = array_sum($aBNcare);
	$Ncarey       = array_sum($aBNcarey);
	$Ncaren       = array_sum($aBNcaren);
    $Dent          =array_sum($aBDent);
	$Denty          =array_sum($aBDenty);
	$Dentn          =array_sum($aBDentn);
    $Physi        =array_sum($aBPhysi);
	$Physiy        =array_sum($aBPhysiy);
	$Physin        =array_sum($aBPhysin);
    $Stx            = array_sum($aBStx);
	$Stxy            = array_sum($aBStxy);
	$Stxn            = array_sum($aBStxn);
    $Mc            = array_sum($aBMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
	$Mcy            = array_sum($aBMcy);
	$Mcn            = array_sum($aBMcn);
	
	$nYpricepaid=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx+$Bloody+$Laboy+$Xrayy+$Sinvy+$Tooly+$Surgy+$Ncarey+$Denty+$Physiy+$Stxy;
 
 $nNpricepaid=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc+$Bloodn+$Labon+$Xrayn+$Sinvn+$Tooln+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Mcn+$Mcy;	
 ////////////////////////////////////////////////////////////////////////////////////

    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//    $Phar      =array_sum($aPhar);
//    $Pharpaid=array_sum($aPharpaid); 

	//ยาที่ใช้ใน รพ.คืนวันกลับบ้าน
  //  $Essd1    =array_sum($aEssd1);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
 //   $Nessdy1=array_sum($aNessdy1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
//    $DDLDDY1 =$Essd1+$Nessdy1; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
 //   $Nessdn1=array_sum($aNessdn1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได
//ยาที่ใช้ใน รพ.

    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้





//ยาที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้




    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  
 
    $Blood     = array_sum($aBlood);
	$Bloody     = array_sum($aBloody);
	$Bloodn     = array_sum($aBloodn);
    $Labo         =array_sum($aLabo);
	$Laboy         =array_sum($aLaboy);
	$Labon         =array_sum($aLabon);
    $Xray         =array_sum($aXray);
	$Xrayy         =array_sum($aXrayy);
	$Xrayn         =array_sum($aXrayn);
    $Sinv        = array_sum($aSinv);
	$Sinvy        = array_sum($aSinvy);
	$Sinvn        = array_sum($aSinvn);
    $Tool        = array_sum($aTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
	$Tooly        = array_sum($aTooly);
	$Tooln        = array_sum($aTooln);
    $Surg         =array_sum($aSurg);
	$Surgy         =array_sum($aSurgy);
	$Surgn         =array_sum($aSurgn);
    $Ncare       = array_sum($aNcare);
	$Ncarey       = array_sum($aNcarey);
	$Ncaren       = array_sum($aNcaren);
    $Dent          =array_sum($aDent);
	$Denty          =array_sum($aDenty);
	$Dentn          =array_sum($aDentn);
    $Physi        =array_sum($aPhysi);
	$Physiy       =array_sum($aPhysiy);
	$Physin        =array_sum($aPhysin);
    $Stx            = array_sum($aStx);
	$Stxy            = array_sum($aStxy);
	$Stxn           = array_sum($aStxn);
    $Mc            = array_sum($aMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
	$Mcy            = array_sum($aMcy);
	$Mcn            = array_sum($aMcn);
	

 
  $nYprice=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx+$Bloody+$Laboy+$Xrayy+$Sinvy+$Tooly+$Surgy+$Ncarey+$Denty+$Physiy+$Stxy;
  
 
 $nNprice=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc+$Bloodn+$Labon+$Xrayn+$Sinvn+$Tooln+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Mcn+$Mcy;	
 

        print (" <tr>\n".
           "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$ptname</a></td>\n".
           "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbillist.php?vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$hn</a></td>\n".
           "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil2.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag&vbedcode=$bedcode\">$an</td>\n".
           "  <td BGCOLOR=#FFCCCC>$bedcode</td>\n".
		  "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil2np.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag&vbedcode=$bedcode\">$ptright</a></td>\n".
       //    "  <td BGCOLOR=#FFCCCC>$price</td>\n".
       //    "  <td BGCOLOR=#FFCCCC>$paid</td>\n".
           "  <td BGCOLOR=#FFCCCC>$daysall</td>\n".
		   "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbilnp.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$nNpricepaid</a></td>\n".
		    "  <td BGCOLOR=#FFCCCC align='center'><a target=_BLANK  href=\"ipaccount_hn.php?an=$an&accno=1\">แก้ไข</td>\n".
			
			  "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil_grouppart.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">เก็บเงิน</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
	
?>
</table>

<?php
//    session_start(); //6-03-04
    $sDiscdate="$yr-$m-$d";
    session_register("sDiscdate"); //add

    $today="$d-$m-$yr";

	//print "<BR><BR><BR><BR><BR><BR><FONT SIZE='5' COLOR='#FF0000'>ยังไม่ได้อนุญาติให้ใช้ ทดสอบโปรแกรมอยู่</FONT><BR>";
    print "รายชื่อคนไข้ในนอนในวันที่ $today";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
	
	session_unregister("x");
    session_unregister("aIdname");
    session_unregister("aDep");
    session_unregister("aDtail");
    session_unregister("aAmt");
    session_unregister("aPri");
    session_unregister("aPaid");
    session_unregister("aPart");
    session_unregister("aDay");
    session_unregister("aBFY");
    session_unregister("aBFN");
    session_unregister("aBBFY");
    session_unregister("aBBFN");
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
	session_unregister("aEssd1");
    session_unregister("aNessdy1");
    session_unregister("aNessdn1");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aBlood");
    session_unregister("aLabo");
    session_unregister("aXray");
    session_unregister("aSinv");
    session_unregister("aTool");
    session_unregister("aSurg");    
    session_unregister("aNcare");    
    session_unregister("aDent");
    session_unregister("aPhysi");
    session_unregister("aStx");
    session_unregister("aMc");
	
	session_unregister("aBloody");
    session_unregister("aLaboy");
    session_unregister("aXrayy");
    session_unregister("aSinvy");
    session_unregister("aTooly");
    session_unregister("aSurgy");    
    session_unregister("aNcarey");    
    session_unregister("aDenty");
    session_unregister("aPhysiy");
    session_unregister("aStxy");
    session_unregister("aMcy");
	
	session_unregister("aBloodn");
    session_unregister("aLabon");
    session_unregister("aXrayn");
    session_unregister("aSinvn");
    session_unregister("aTooln");
    session_unregister("aSurgn");    
    session_unregister("aNcaren");    
    session_unregister("aDentn");
    session_unregister("aPhysin");
    session_unregister("aStxn");
    session_unregister("aMcn");

//  session_unregister("sDiscdate");
    session_unregister("aDEssd");
    session_unregister("aDNessdy");
    session_unregister("aDNessdn");

    session_unregister("aBDEssd");
    session_unregister("aBDNessdy");
    session_unregister("aBDNessdn");

    session_unregister("aBEssd");
    session_unregister("aBNessdy");
    session_unregister("aBNessdn");
	  session_unregister("aBEssd1");
    session_unregister("aBNessdy1");
    session_unregister("aBNessdn1");
    session_unregister("aBDDL");
    session_unregister("aBDDY");
    session_unregister("aBDDN");
    session_unregister("aBDPY");
    session_unregister("aBDPN");
    session_unregister("aBDSY");
    session_unregister("aBDSN");
    session_unregister("aBBlood");
    session_unregister("aBLabo");
    session_unregister("aBXray");
    session_unregister("aBSinv");
    session_unregister("aBTool");
    session_unregister("aBSurg");    
    session_unregister("aBNcare");    
    session_unregister("aBDent");
    session_unregister("aBPhysi");
    session_unregister("aBStx");
    session_unregister("aBMc");
	

    session_unregister("aBLaboy");
    session_unregister("aBXrayy");
    session_unregister("aBSinvy");
    session_unregister("aBTooly");
    session_unregister("aBSurgy");    
    session_unregister("aBNcarey");    
    session_unregister("aBDenty");
    session_unregister("aBPhysiy");
    session_unregister("aBStxy");
    session_unregister("aBMcy");
	
    session_unregister("aBLabon");
    session_unregister("aBXrayn");
    session_unregister("aBSinvn");
    session_unregister("aBTooln");
    session_unregister("aBSurgn");    
    session_unregister("aBNcaren");    
    session_unregister("aBDentn");
    session_unregister("aBPhysin");
    session_unregister("aBStxn");
    session_unregister("aBMcn");	
?>
<table>
 <tr>
  <th bgcolor=6495ED>เก็บเงินค้างจ่าย</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>ใบแจ้งชำระเงิน</th>
  <th bgcolor=6495ED>เตียง</th>
  <th bgcolor=6495ED>สิทธิ</th>


  <th bgcolor=6495ED>วันนอน</th>
  <th bgcolor=6495ED>ส่วนเกิน</th>
  <th bgcolor=6495ED>แก้ไขค่าห้อง</th>
  <th bgcolor=6495ED>เก็บเงินตามหมวดรายการ</th>
  </tr>

<?php
    include("connect.inc");
	
    

    $query = "SELECT ptname,hn,an,bedcode,price,paid,accno,date,bed,ptright,diagnos,days FROM bed WHERE  an != '' order by ptright";
    $result = mysql_query($query)
        or die("Query failed bed");

    while (list ($ptname,$hn,$an,$bedcode,$price,$paid,$accno,$date,$bed,$ptright,$diag,$daysall) = mysql_fetch_row ($result)) {
		
	$aIdname  =array("idname");
    $Netpri  ="";   
    $Netpaid   ="";
    $aDep   =array("depart");
    $aDtail    = array("detail");
    $aAmt      =array("amount");
    $aPri      =array("price");
    $aPaid       = array("paid");
    $aPart       = array("part");
    $aDay        =array("date");

    $aBFY       = array("BFY");
    $aBFN       = array("BFN");
    $aBBFY       = array("BFY");
    $aBBFN       = array("BFN");

    $aEssd      =array("DDL");
    $aNessdy  =array("DDY");
    $aNessdn  =array("DDN");
	$aEssd1      =array("DDL");
    $aNessdy1  =array("DDY");
    $aNessdn1  =array("DDN");
    $aDPY       =array("DPY");
    $aDPN       =array("DPN");   
    $aDSY       =array("DSY");
    $aDSN       =array("DSN");   
    $aBlood     = array("BLOOD");
    $aLabo         =array("LABO");
    $aXray         =array("XRAY");
    $aSinv        = array("SINV");
    $aTool        = array("TOOL");
    $aSurg        =array("SURG");
    $aNcare       = array("NCARE");
    $aDent          =array("DENTA");
    $aPhysi       =array("PT");
    $aStx            = array("STX");
    $aMc            = array("MC");
	
	$aBloody     = array("BLOODY");
    $aLaboy         =array("LABOY");
    $aXrayy         =array("XRAYY");
    $aSinvy        = array("SINVY");
    $aTooly        = array("TOOLY");
    $aSurgy        =array("SURGY");
    $aNcarey       = array("NCAREY");
    $aDenty          =array("DENTAY");
    $aPhysiy       =array("PTY");
    $aStxy            = array("STXY");
    $aMcy           = array("MCY");
	
	$aBloodn     = array("BLOODN");
    $aLabon         =array("LABON");
    $aXrayn         =array("XRAYN");
    $aSinvn        = array("SINVN");
    $aTooln        = array("TOOLN");
    $aSurgn        =array("SURGN");
    $aNcaren       = array("NCAREN");
    $aDentn          =array("DENTAN");
    $aPhysin       =array("PTN");
    $aStxn            = array("STXN");
    $aMcn            = array("MCN");
//ยาที่นำกลับบ้าน
    $aDEssd      =array("DDL");
    $aDNessdy  =array("DDY");
    $aDNessdn  =array("DDN");
//    $aDDSY       =array("DSY");
//    $aDDSN       =array("DSN");   
//หักเงินที่จ่ายแล้ว
    $aBEssd      =array("DDL");
    $aBNessdy  =array("DDY");
    $aBNessdn  =array("DDN");
	$aBEssd1      =array("DDL");
    $aBNessdy1  =array("DDY");
    $aBNessdn1  =array("DDN");
    $aBDPY       =array("DPY");
    $aBDPN       =array("DPN");   
    $aBDSY       =array("DSY");
    $aBDSN       =array("DSN");   
    $aBBlood     = array("BLOOD");
    $aBLabo         =array("LABO");
    $aBXray         =array("XRAY");
    $aBSinv        = array("SINV");
    $aBTool        = array("TOOL");
    $aBSurg        =array("SURG");
    $aBNcare       = array("NCARE");
    $aBDent          =array("DENTA");
    $aBPhysi       =array("PT");
    $aBStx            = array("STX");
    $aBMc            = array("MC");
	
	$aBBloody     = array("BLOODY");
    $aBLaboy         =array("LABOY");
    $aBXrayy         =array("XRAYY");
    $aBSinvy        = array("SINVY");
    $aBTooly        = array("TOOLY");
    $aBSurgy        =array("SURGY");
    $aBNcarey       = array("NCAREY");
    $aBDenty          =array("DENTAY");
    $aBPhysiy       =array("PTY");
    $aBStxy           = array("STXY");
    $aBMcy            = array("MCY");
	
	$aBBloodn     = array("BLOODN");
    $aBLabon         =array("LABON");
    $aBXrayn         =array("XRAYN");
    $aBSinvn        = array("SINVN");
    $aBTooln        = array("TOOLN");
    $aBSurgn        =array("SURGN");
    $aBNcaren       = array("NCAREN");
    $aBDentn          =array("DENTAN");
    $aBPhysin       =array("PTN");
    $aBStxn            = array("STXN");
    $aBMcn            = array("MCN");

    $aBDEssd      =array("DDL");
    $aBDNessdy  =array("DDY");
    $aBDNessdn  =array("DDN");
	
	session_register("aDEssd");
    session_register("aDNessdy");
    session_register("aDNessdn");
//    session_register("aDDSY");
//    session_register("aDDSN");

    session_register("aBDEssd");
    session_register("aBDNessdy");
    session_register("aBDNessdn");
//    session_register("aBDDSY");
//    session_register("aBDDSN");

    session_register("cAdmit");
    session_register("cDcdate");
    session_register("cDays");
    session_register("cAn");
    session_register("cHn");
    session_register("cPtname");
    session_register("cPtright");
    session_register("cDiag");

    session_register("x");
    session_register("aIdname");
    session_register("aDep");
    session_register("aDtail");
    session_register("aAmt");
    session_register("aPri");
    session_register("aPaid");
    session_register("aPart");
    session_register("aDay");
    session_register("aBFY");
    session_register("aBFN");
    session_register("aBBFY");
    session_register("aBBFN");
    session_register("aEssd");
    session_register("aNessdy");
    session_register("aNessdn");
	session_register("aEssd1");
    session_register("aNessdy1");
    session_register("aNessdn1");

    session_register("aDDL");
    session_register("aDDY");
    session_register("aDDN");
    session_register("aDPY");
    session_register("aDPN");
    session_register("aDSY");
    session_register("aDSN");
    session_register("aBlood");
    session_register("aLabo");
    session_register("aXray");
    session_register("aSinv");
    session_register("aTool");
    session_register("aSurg");    
    session_register("aNcare");    
    session_register("aDent");
    session_register("aPhysi");
    session_register("aStx");
    session_register("aMc");
	
	session_register("aBloody");
    session_register("aLaboy");
    session_register("aXrayy");
    session_register("aSinvy");
    session_register("aTooly");
    session_register("aSurgy");    
    session_register("aNcarey");    
    session_register("aDenty");
    session_register("aPhysiy");
    session_register("aStxy");
    session_register("aMcy");
	
	session_register("aBloodn");
    session_register("aLabon");
    session_register("aXrayn");
    session_register("aSinvn");
    session_register("aTooln");
    session_register("aSurgn");    
    session_register("aNcaren");    
    session_register("aDentn");
    session_register("aPhysin");
    session_register("aStxn");
    session_register("aMcn");
	
	session_register("abillno");


    session_register("aBEssd");
    session_register("aBNessdy");
    session_register("aBNessdn");
	session_register("aBEssd1");
    session_register("aBNessdy1");
    session_register("aBNessdn1");
    session_register("aBDDL");
    session_register("aBDDY");
    session_register("aBDDN");
    session_register("aBDPY");
    session_register("aBDPN");
    session_register("aBDSY");
    session_register("aBDSN");
    session_register("aBBlood");
    session_register("aBLabo");
    session_register("aBXray");
    session_register("aBSinv");
    session_register("aBTool");
    session_register("aBSurg");    
    session_register("aBNcare");    
    session_register("aBDent");
    session_register("aBPhysi");
    session_register("aBStx");
    session_register("aBMc");

	session_register("aBBloody");
    session_register("aBLaboy");
    session_register("aBXrayy");
    session_register("aBSinvy");
    session_register("aBTooly");
    session_register("aBSurgy");    
    session_register("aBNcarey");    
    session_register("aBDenty");
    session_register("aBPhysiy");
    session_register("aBStxy");
    session_register("aBMcy");
	
    session_register("aBBloodn");
    session_register("aBLabon");
    session_register("aBXrayn");
    session_register("aBSinvn");
    session_register("aBTooln");
    session_register("aBSurgn");    
    session_register("aBNcaren");    
    session_register("aBDentn");
    session_register("aBPhysin");
    session_register("aBStxn");
    session_register("aBMcn");
	
	$query1 = "SELECT * FROM ipacc WHERE an = '$an'";
    $result1 = mysql_query($query1)or die("Query failed ipacc");

    for ($i = mysql_num_rows($result1) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result1, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result1)))
            continue;      

    array_push($aDay,$row->date);
    array_push($aDep,$row->depart);
    array_push($aDtail,$row->detail);
    array_push($aAmt,$row->amount);
    array_push($aPri,$row->price);
    array_push($aPaid,$row->paid);
    array_push($aPart,$row->part);
    array_push($aIdname,$row->idname);
	array_push($abillno,$row->billno);
	 
	 
	 
//1. ค่าห้อง/ค่าอาหาร(เบิกได้)
if ($row->part=="BFY"){
            array_push($aBFY,$row->price);
            array_push($aBBFY,$row->price-$row->paid);
            }
// 1.ค่าห้อง/ค่าอาหาร(ส่วนเกิน)			
if ($row->part=="BFN"){
            array_push($aBFN,$row->price);
            array_push($aBBFN,$row->price-$row->paid);
            } 

//2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา
if ($row->part=="DPY"){
            array_push($aDPY,$row->price);
            array_push($aBDPY,$row->price-$row->paid);
            } 
if ($row->part=="DPN"){
            array_push($aDPN,$row->price); 
            array_push($aBDPN,$row->price-$row->paid); 
            } 

//3. ยาที่ใช้ใน รพ.
if ($row->part=="DDL" and substr($row->date,0,10)!="$sDiscdate1"){
            array_push($aEssd,$row->price);
            array_push($aBEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)!="$sDiscdate1"){
            array_push($aNessdy,$row->price);
            array_push($aBNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)!="$sDiscdate1"){
            array_push($aNessdn,$row->price);
            array_push($aBNessdn,$row->price-$row->paid);
            } 

			//3.1 ยาที่คืนใช้ใน รพ.ในวันจำหน่าย
if ($row->part=="DDL" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aEssd1,$row->price);
            array_push($aBEssd1,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aNessdy1,$row->price);
            array_push($aBNessdy1,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aNessdn1,$row->price);
            array_push($aBNessdn1,$row->price-$row->paid);
            } 

//4. ยาที่นำไปใช้ต่อที่บ้าน   (วันที่จำหน่าย)
if ($row->part=="DDL" and substr($row->date,0,10)=="$sDiscdate1"){
            array_push($aDEssd,$row->price);
            array_push($aBDEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aDNessdy,$row->price);
            array_push($aBDNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN" and substr($row->date,0,10)=="$sDiscdate1" ){
            array_push($aDNessdn,$row->price);
            array_push($aBDNessdn,$row->price-$row->paid);
            } 
//
//5. เวชภัณฑ์ที่ไม่ใช่ยา
 if ($row->part=="DSY"){
            array_push($aDSY,$row->price);  
            array_push($aBDSY,$row->price-$row->paid);  
            } 
if ($row->part=="DSN"){
            array_push($aDSN,$row->price);
            array_push($aBDSN,$row->price-$row->paid);
            } 

//6. ค่าบริการโลหิตและส่วนประกอบของโลหิต
if ($row->part=="BLOOD"){
            array_push($aBlood,$row->price);
            array_push($aBBlood,$row->price-$row->paid);
            }  
if ($row->part=="BLOODY"){
            array_push($aBloody,$row->price);
            array_push($aBBloody,$row->price-$row->paid);
            }  
if ($row->part=="BLOODN"){
            array_push($aBloodn,$row->price);
            array_push($aBBloodn,$row->price-$row->paid);
            }  
//7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา			
if ($row->part=="LAB"){
            array_push($aLabo,$row->price);  
            array_push($aBLabo,$row->price-$row->paid);  
            } 
if ($row->part=="LABY"){
            array_push($aLaboy,$row->price);  
            array_push($aBLaboy,$row->price-$row->paid);  
            }
if ($row->part=="LABN"){
            array_push($aLabon,$row->price);  
            array_push($aBLabon,$row->price-$row->paid);  
            }
//8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา
if ($row->part=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aBXray,$row->price-$row->paid);
            }
if ($row->part=="XRAYY"){
            array_push($aXrayy,$row->price);  
            array_push($aBXrayy,$row->price-$row->paid);
            }
if ($row->part=="XRAYN"){
            array_push($aXrayn,$row->price);  
            array_push($aBXrayn,$row->price-$row->paid);
            }
//9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ			
if ($row->part=="SINV"){
            array_push($aSinv,$row->price);
            array_push($aBSinv,$row->price-$row->paid);
            }  
if ($row->part=="SINVY"){
            array_push($aSinvy,$row->price);
            array_push($aBSinvy,$row->price-$row->paid);
            }  
if ($row->part=="SINVN"){
            array_push($aSinvn,$row->price);
            array_push($aBSinvn,$row->price-$row->paid);
            }  
//10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์			
if ($row->part=="TOOL"){
            array_push($aTool,$row->price);
            array_push($aBTool,$row->price-$row->paid);
            }
if ($row->part=="TOOLY"){
            array_push($aTooly,$row->price);
            array_push($aBTooly,$row->price-$row->paid);
            }
if ($row->part=="TOOLN"){
            array_push($aTooln,$row->price);
            array_push($aBTooln,$row->price-$row->paid);
            }
//11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี			
if ($row->part=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aBSurg,$row->price-$row->paid);  
            }
if ($row->part=="SURGY"){
            array_push($aSurgy,$row->price);  
            array_push($aBSurgy,$row->price-$row->paid);  
            }
if ($row->part=="SURGN"){
            array_push($aSurgn,$row->price);  
            array_push($aBSurgn,$row->price-$row->paid);  
            }
//12. ค่าบริการทางการพยาบาลทั่วไป			
if ($row->part=="NCARE"){
            array_push($aNcare,$row->price);
            array_push($aBNcare,$row->price-$row->paid);
            } 
if ($row->part=="NCAREY"){
            array_push($aNcarey,$row->price);
            array_push($aBNcarey,$row->price-$row->paid);
            } 
if ($row->part=="NCAREN"){
            array_push($aNcaren,$row->price);
            array_push($aBNcaren,$row->price-$row->paid);
            } 
//13. ค่าบริการทางทันตกรรม			
if ($row->part=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aBDent,$row->price-$row->paid);  
            }
if ($row->part=="DENTAY"){
            array_push($aDenty,$row->price);  
            array_push($aBDenty,$row->price-$row->paid);  
            }
if ($row->part=="DENTAN"){
            array_push($aDentn,$row->price);  
            array_push($aBDentn,$row->price-$row->paid);  
            }
//14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู			
if ($row->part=="PT"){
            array_push($aPhysi,$row->price);  
            array_push($aBPhysi,$row->price-$row->paid);  
            }
if ($row->part=="PTY"){
            array_push($aPhysiy,$row->price);  
            array_push($aBPhysiy,$row->price-$row->paid);  
            }
if ($row->part=="PTN"){
            array_push($aPhysin,$row->price);  
            array_push($aBPhysin,$row->price-$row->paid);  
            }
//15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ			
if ($row->part=="STX"){
            array_push($aStx,$row->price);
            array_push($aBStx,$row->price-$row->paid);
            }
if ($row->part=="STXY"){
            array_push($aStxy,$row->price);
            array_push($aBStxy,$row->price-$row->paid);
            }
if ($row->part=="STXN"){
            array_push($aStxn,$row->price);
            array_push($aBStxn,$row->price-$row->paid);
            }
//16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา			
if ($row->part=="MC"){
            array_push($aMc,$row->price);
            array_push($aBMc,$row->price-$row->paid);
            } 
if ($row->part=="MCY"){
            array_push($aMcy,$row->price);
            array_push($aBMcy,$row->price-$row->paid);
            }  
if ($row->part=="MCN"){
            array_push($aMcn,$row->price);
            array_push($aBMcn,$row->price-$row->paid);
            }  

       }
// include("unconnect.inc");

//ค่ารักษาพยาบาล หักที่จ่ายแล้ว  เพื่อออกใบเสร็จส่วนที่ค้างจ่าย
    $BFY       = array_sum($aBBFY);
    $BFN       = array_sum($aBBFN);
//ยาที่ใช้ใน รพ.   รายการในใบเสร็จ หักเงินที่จ่ายแล้วออก
	//ยาที่ใช้ใน รพ.คืนวันกลับบ้าน
    $Essd1    =array_sum($aBEssd1);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy1=array_sum($aBNessdy1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY1 =$Essd1+$Nessdy1; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn1=array_sum($aBNessdn1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได

    $Essd    =array_sum($aBEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aBNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy+$DDLDDY1; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aBNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
	
//ยาเวชภัณฑ์ที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aBDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aBDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aBDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
//
    $DSY     =array_sum($aBDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aBDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aBDPY);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aBDPN);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกไม่ได้  

    $Blood     = array_sum($aBBlood);
	$Bloody     = array_sum($aBBloody);
	$Bloodn     = array_sum($aBBloodn);
    $Labo         =array_sum($aBLabo);
	$Laboy         =array_sum($aBLaboy);
	$Labon       =array_sum($aBLabon);
    $Xray         =array_sum($aBXray);
	$Xrayy         =array_sum($aBXrayy);
	$Xrayn         =array_sum($aBXrayn);
    $Sinv        = array_sum($aBSinv);
	$Sinvy        = array_sum($aBSinvy);
	$Sinvn        = array_sum($aBSinvn);
    $Tool        = array_sum($aBTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
	$Tooly        = array_sum($aBTooly); 
	$Tooln        = array_sum($aBTooln); 
    $Surg         =array_sum($aBSurg);
	$Surgy         =array_sum($aBSurgy);
	$Surgn         =array_sum($aBSurgn);
    $Ncare       = array_sum($aBNcare);
	$Ncarey       = array_sum($aBNcarey);
	$Ncaren       = array_sum($aBNcaren);
    $Dent          =array_sum($aBDent);
	$Denty          =array_sum($aBDenty);
	$Dentn          =array_sum($aBDentn);
    $Physi        =array_sum($aBPhysi);
	$Physiy        =array_sum($aBPhysiy);
	$Physin        =array_sum($aBPhysin);
    $Stx            = array_sum($aBStx);
	$Stxy            = array_sum($aBStxy);
	$Stxn            = array_sum($aBStxn);
    $Mc            = array_sum($aBMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
	$Mcy            = array_sum($aBMcy);
	$Mcn            = array_sum($aBMcn);
	
	$nYpricepaid=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx+$Bloody+$Laboy+$Xrayy+$Sinvy+$Tooly+$Surgy+$Ncarey+$Denty+$Physiy+$Stxy;
 
 $nNpricepaid=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc+$Bloodn+$Labon+$Xrayn+$Sinvn+$Tooln+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Mcn+$Mcy;	
 ////////////////////////////////////////////////////////////////////////////////////

    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//    $Phar      =array_sum($aPhar);
//    $Pharpaid=array_sum($aPharpaid); 

	//ยาที่ใช้ใน รพ.คืนวันกลับบ้าน
  //  $Essd1    =array_sum($aEssd1);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
 //   $Nessdy1=array_sum($aNessdy1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
//    $DDLDDY1 =$Essd1+$Nessdy1; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
 //   $Nessdn1=array_sum($aNessdn1);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได
//ยาที่ใช้ใน รพ.

    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้





//ยาที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้




    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  
 
    $Blood     = array_sum($aBlood);
	$Bloody     = array_sum($aBloody);
	$Bloodn     = array_sum($aBloodn);
    $Labo         =array_sum($aLabo);
	$Laboy         =array_sum($aLaboy);
	$Labon         =array_sum($aLabon);
    $Xray         =array_sum($aXray);
	$Xrayy         =array_sum($aXrayy);
	$Xrayn         =array_sum($aXrayn);
    $Sinv        = array_sum($aSinv);
	$Sinvy        = array_sum($aSinvy);
	$Sinvn        = array_sum($aSinvn);
    $Tool        = array_sum($aTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
	$Tooly        = array_sum($aTooly);
	$Tooln        = array_sum($aTooln);
    $Surg         =array_sum($aSurg);
	$Surgy         =array_sum($aSurgy);
	$Surgn         =array_sum($aSurgn);
    $Ncare       = array_sum($aNcare);
	$Ncarey       = array_sum($aNcarey);
	$Ncaren       = array_sum($aNcaren);
    $Dent          =array_sum($aDent);
	$Denty          =array_sum($aDenty);
	$Dentn          =array_sum($aDentn);
    $Physi        =array_sum($aPhysi);
	$Physiy       =array_sum($aPhysiy);
	$Physin        =array_sum($aPhysin);
    $Stx            = array_sum($aStx);
	$Stxy            = array_sum($aStxy);
	$Stxn           = array_sum($aStxn);
    $Mc            = array_sum($aMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
	$Mcy            = array_sum($aMcy);
	$Mcn            = array_sum($aMcn);
	

 
  $nYprice=$BFY+$DPY+ $DDLDDY+$DDgy+$DSY+$Blood+$Labo+$Xray+$Sinv+$Tool+$Surg+$Ncare+$Dent+$Physi+$Stx+$Bloody+$Laboy+$Xrayy+$Sinvy+$Tooly+$Surgy+$Ncarey+$Denty+$Physiy+$Stxy;
  
 
 $nNprice=$BFN+$DPN+$Nessdn+$DNessdn+$DSN+$Mc+$Bloodn+$Labon+$Xrayn+$Sinvn+$Tooln+$Surgn+$Ncaren+$Dentn+$Physin+$Stxn+$Mcn+$Mcy;	
 

        print (" <tr>\n".
           "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$ptname</a></td>\n".
           "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbillist.php?vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$hn</a></td>\n".
           "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil2.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag&vbedcode=$bedcode\">$an</td>\n".
           "  <td BGCOLOR=#FFCCCC>$bedcode</td>\n".
		  "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil2np.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag&vbedcode=$bedcode\">$ptright</a></td>\n".
       //    "  <td BGCOLOR=#FFCCCC>$price</td>\n".
       //    "  <td BGCOLOR=#FFCCCC>$paid</td>\n".
           "  <td BGCOLOR=#FFCCCC>$daysall</td>\n".
		   "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbilnp.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">$nNpricepaid</a></td>\n".
		    "  <td BGCOLOR=#FFCCCC align='center'><a target=_BLANK  href=\"ipaccount_hn.php?an=$an&accno=1\">แก้ไข</td>\n".
			
			  "  <td BGCOLOR=#FFCCCC><a target=_BLANK  href=\"ipchkbil_grouppart.php? vAn=$an&vHn=$hn&vAccno=$accno&vDate=$date&vDcdate=$dcdate&vDays=$days&vPtright=$ptright&vPtname=$ptname&vDiag=$diag\">เก็บเงิน</a></td>\n".
           " </tr>\n");
       }
    include("unconnect.inc");
	
?>
</table>
