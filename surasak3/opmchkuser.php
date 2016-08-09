<?php
    session_start();
    
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);

    $Netprice=array_sum($aPrice);
    $Netpaid=array_sum($aPaid);

    $Phar      =array_sum($aPhar);
    $Pharpaid=array_sum($aPharpaid); 
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

    $Labo         =array_sum($aLabo);
    $Labopaid  =array_sum($aLabopaid);
    $Xray         =array_sum($aXray);
    $Xraypaid  =array_sum($aXraypaid);
    $Surg         =array_sum($aSurg);
    $Surgpaid  =array_sum($aSurgpaid);
    $Emer         =array_sum($aEmer);
    $Emerpaid  =array_sum($aEmerpaid);
    $Dent          =array_sum($aDent);
    $Dentpaid   =array_sum($aDentpaid);
    $Physi        =array_sum($aPhysi);
    $Physipd   =array_sum($aPhysipd);
    $Hemo       =array_sum($aHemo);
    $Hemopd    =array_sum($aHemopd);
    $Other        =array_sum($aOther);
    $Otherpd   =array_sum($aOtherpd);
    $Ward        =array_sum($aWard);
    $Wardpd   =array_sum($aWardpd);
	$Nid        =array_sum($aNid);
    $Nidpd   =array_sum($aNidpd);
	$Eye        =array_sum($aEye);
    $Eyepd   =array_sum($aEyepd);
	$Creditpaid      =array_sum($aCreditpaid);
	$aPaidcscd      =array_sum($aPaidcscd);
	$credit1   =array_sum($aCredit_1pd);
	$credit2   =array_sum($aCredit_2pd);
	$credit3   =array_sum($aCredit_3pd);
	$credit4   =array_sum($aCredit_4pd);
	$credit5   =array_sum($aCredit_5pd);
	$credit6   =array_sum($aCredit_6pd);
	$credit7   =array_sum($aCredit_7pd);
	$credit8   =array_sum($aCredit_8pd);
    
    $sum_med_service = array_sum($_SESSION['medical_service']);
/* 
เภสัชกรรม
ค่ายาในบัญชียาหลักแห่งชาติ
ค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
ค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
ค่าเวชภัณฑ์ ส่วนที่เบิกได้
ค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  
ค่าอุปกรณ์ ส่วนที่เบิกได้
ค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  

พยาธิ
เอกซเรย์
ห้องผ่าตัด
ห้องฉุกเฉิน
ทันตกรรม
กายภาพบำบัด
ไตเทียม
หอผู้ป่วย
อื่นๆ

รวมทั้งสิ้น
ลงชื่อ
จนท.        วันที่
*/
print "ส่วนเก็บเงินผู้ป่วยนอก:<br>";
print "รายงานเงินรายรับของวันที่ $repdate";
print "&nbsp;&nbsp;&nbsp;รับชำระโดย $doctor<br><br>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr valign=\"top\">";
print "    <td width='5%'>&nbsp;</td>";
print "    <td width='50%'><font face='Angsana New'>1. เภสัชกรรม<br>";
print "      .......1.1 ค่ายาในบัญชียาหลักแห่งชาติ<br>";
print "      .......1.2 ค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้<br>";
print "      .......1.3 ค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br>";
print "      .......1.4 ค่าเวชภัณฑ์ ส่วนที่เบิกได้<br>";
print "      .......1.5 ค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้&nbsp;<br>";
print "      .......1.6 ค่าอุปกรณ์ ส่วนที่เบิกได้<br>";
print "      .......1.7 ค่าอุปกรณ์ ส่วนที่เบิกไม่ได้&nbsp;<br>";
print "      <br>";
print "      2. พยาธิ<br>";
print "      3. เอกซเรย์<br>";
print "      4. ห้องผ่าตัด<br>";
print "      5. ห้องฉุกเฉิน<br>";
print "      6. ทันตกรรม<br>";
print "      7. กายภาพบำบัด<br>";
print "      8. ไตเทียม<br>";
print "      9. หอผู้ป่วย<br>";
print "    10. อื่นๆ<br>";
print "    11. ฝังเข็ม<br>";
print "    12. คลีนิกตา<br>";
print "    13. ค่าบริการทางการแพทย์<br>";
print "      <br>";
print "      <b>รวมทั้งสิ้น</b></font></td>";
print "    <td width='15%'><font face='Angsana New'>$Pharpaid<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      .......<br>";
print "      <br>";
print "      $Labopaid<br>";
print "      $Xraypaid<br>";
print "      $Surgpaid<br>";
print "      $Emerpaid<br>";
print "      $Dentpaid<br>";
print "      $Physipd<br>";
print "      $Hemopd<br>";
print "      $Wardpd<br>";
print "      $Otherpd<br>";
print "      $Nidpd<br>";
print "      $Eyepd<br>";
print "      $sum_med_service<br>";
print "      <br>";
print "      $Netpaid</font></td>";
print "    <td width='30%'><font face='Angsana New'>....<br>";
print "      $Essd<br>";
print "      $Nessdy<br>";
print "      $Nessdn<br>";
print "      $DSY<br>";
print "      $DSN<br>";
print "      $DPY<br>";
print "      $DPN<br>";
print "      <br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      ....<br>";
print "      <br>";
print "      ....</font></td>";
print "  </tr>";
print "</table>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='100%'><font face='Angsana New'>";
//print "<CENTER>เบิกได้&nbsp;&nbsp; $aPaidcscd &nbsp;บาท </CENTER>  ";
print "    </td>";
print "  </tr>";
print "</table>";
//if (!empty($Creditpaid)){
//	print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font face='Angsana New'>(หมายเหตุ: จ่ายด้วยบัตรเครดิตธนาคาร  จำนวน $Creditpaid บาท)<br>";
//								}

//print "<BR><table style='font-family: Angsana New;' border='0' cellpadding='0' cellspacing='0' width='60%'>";
//print "<tr><td colspan='2' align='center' font size='4'><b>สรุปข้อมูลการรับชำระเงิน</b></font></td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>เงินสด</td><td width='5%'>$credit1</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>กรุงเทพ</td><td width='5%'>$credit2</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>ทหารไทย</td><td width='5%'>$credit3</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>จ่ายตรง</td><td width='5%'>$credit4</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>ประกันสังคม</td><td width='5%'>$credit5</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>30บาท</td><td width='5%'>$credit6</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>เงินเชื่อ</td><td width='5%'>$credit7</td></tr>";
//print "<tr><td width='5%'>&nbsp;</td><td width='50%'>อื่นๆ</td><td width='5%'>$credit8</td></tr>";
//print "</table>";



/*
//////แสดงตาราง
print "<font face='Angsana New'><br>จำนวนทั้งสิ้น $x รายการ ดังนี้<br>";
print "<table>";
print " <tr>";
print "  <th>#</th>";
print "  <th>เวลา</th>";
print "  <th>HN</th>";
print "  <th>AN</th>";
print "  <th>แผนก</th>";
print "  <th>รายการ</th>";
print "  <th>จ่ายเงิน</th>";
print "  <th>บัตรเครดิต</th>";
print "  <th>สิทธิ</th>";
print "  <th>จนท.เก็บเงิน</th>";
print "  </tr>";

   $num=1;
   for ($n=$x; $n>=1; $n--){
        $time=substr($aDate[$n],11,5);
        print("<tr>\n".
                "<td>$num</td>\n".
                "<td>$time</td>\n".
                "<td>$aHn[$n]</td>\n".
                "<td>$aAn[$n]</td>\n".    
                "<td>$aDepart[$n]</td>\n".
                "<td>$aDetail[$n]</td>\n".  
                "<td>$aPaid[$n]</td>\n".  
                "<td>$aCredit[$n]</td>\n".  
                "<td>$aPtright[$n]</td>\n".  
                "<td>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

print "</table>";
////end table
print "<br>ลงชื่อ<br>";
print "<br>( $sOfficer )<br>";
print "$Thaidate"; 

// session_destroy();
    session_unregister("x");
    session_unregister("aDate");
    session_unregister("aHn");
    session_unregister("aAn");
    session_unregister("aIdname");
    session_unregister("aDepart");
    session_unregister("aDetail");
    session_unregister("aPrice");
    session_unregister("aPaid");
    session_unregister("aPhar");  
    session_unregister("aPharpaid");    
    session_unregister("aEssd");
    session_unregister("aNessdy");
    session_unregister("aNessdn");
    session_unregister("aDDL");
    session_unregister("aDDY");
    session_unregister("aDDN");
    session_unregister("aDPY");
    session_unregister("aDPN");
    session_unregister("aDSY");
    session_unregister("aDSN");
    session_unregister("aPtright");
    session_unregister("aCredit");
    session_unregister("aLabo");
    session_unregister("aLabopaid");
    session_unregister("aXray");
    session_unregister("aXraypaid");  
    session_unregister("aSurg");    
    session_unregister("aSurgpaid");
    session_unregister("aEmer");
    session_unregister("aEmerpaid");
    session_unregister("aDent");
    session_unregister("aDentpaid");
    session_unregister("aPhysi");
    session_unregister("aPhysipd");
    session_unregister("aHemo");
    session_unregister("aHemopd");
    session_unregister("aOther");
    session_unregister("aOtherpd");
    session_unregister("aWard");
    session_unregister("aWardpd");
	*/
?>
 
