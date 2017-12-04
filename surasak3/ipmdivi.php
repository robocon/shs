<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security

    session_start();
    session_unregister("cAdmit");
    session_unregister("cDcdate");
    session_unregister("cDays");
    session_unregister("cAn");
    session_unregister("cHn");
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");

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

    $cAdmit="";
    $cDcdate="";
    $cDays="";
    $cAn="";
    $cHn="";
    $cPtname="";
    $cPtright="";
    $cDiag="";

    $item            =0;
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

    $aBDEssd      =array("DDL");
    $aBDNessdy  =array("DDY");
    $aBDNessdn  =array("DDN");
//    $aBDDSY       =array("DSY");
//    $aBDDSN       =array("DSN");   
//
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

    session_register("aBEssd");
    session_register("aBNessdy");
    session_register("aBNessdn");
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


    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    $Thidate = (date("Y")+543).date("-m-d H:i:s"); 
    $Thdate=date("d-m-").(date("Y")+543);

  	$cAdmit = $vDate;
	$cDcdate= $Thidate;
	//$cDays=$vDays;
	$cAn = $vAn;
	$cHn = $vHn;
	$cPtname = $vPtname;
	$cPtright =$vPtright;
	$cDiag=$vDiag;
/*
ipmonrep table:
  date
  admit
  dcdate
  days
  an
  hn 
  ptname
  ptright 
*/

   include("connect.inc");
    $query = "SELECT * FROM ipacc WHERE an = '$vAn' and accno='$vAccno' ";
    $result = mysql_query($query)
        or die("Query failed ipacc");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;      
//date_format(date,'%d- %m- %Y')
    array_push($aDay,$row->date);
    array_push($aDep,$row->depart);
    array_push($aDtail,$row->detail);
    array_push($aAmt,$row->amount);
    array_push($aPri,$row->price);
    array_push($aPaid,$row->paid);
    array_push($aPart,$row->part);
    array_push($aIdname,$row->idname);

if ($row->part=="BFY"){
            array_push($aBFY,$row->price);
            array_push($aBBFY,$row->price-$row->paid);
            } 
if ($row->part=="BFN"){
            array_push($aBFN,$row->price);
            array_push($aBBFN,$row->price-$row->paid);
            } 

//ยาที่ใช้ใน รพ.
if ($row->part=="DDL"){
            array_push($aEssd,$row->price);
            array_push($aBEssd,$row->price-$row->paid);
            } 
if ($row->part=="DDY"){
            array_push($aNessdy,$row->price);
            array_push($aBNessdy,$row->price-$row->paid);
            } 
if ($row->part=="DDN"){
            array_push($aNessdn,$row->price);
            array_push($aBNessdn,$row->price-$row->paid);
            } 
//ยาที่ใช้ใน รพ.

 if ($row->part=="DSY"){
            array_push($aDSY,$row->price);  
            array_push($aBDSY,$row->price-$row->paid);  
            } 
if ($row->part=="DSN"){
            array_push($aDSN,$row->price);
            array_push($aBDSN,$row->price-$row->paid);
            } 
if ($row->part=="DPY"){
            array_push($aDPY,$row->price);
            array_push($aBDPY,$row->price-$row->paid);
            } 
if ($row->part=="DPN"){
            array_push($aDPN,$row->price); 
            array_push($aBDPN,$row->price-$row->paid); 
            } 
if ($row->part=="BLOOD"){
            array_push($aBlood,$row->price);
            array_push($aBBlood,$row->price-$row->paid);
            }   
if ($row->part=="LAB"){
            array_push($aLabo,$row->price);  
            array_push($aBLabo,$row->price-$row->paid);  
            } 
if ($row->part=="XRAY"){
            array_push($aXray,$row->price);  
            array_push($aBXray,$row->price-$row->paid);
            } 
if ($row->part=="SINV"){
            array_push($aSinv,$row->price);
            array_push($aBSinv,$row->price-$row->paid);
            }   
if ($row->part=="TOOL"){
            array_push($aTool,$row->price);
            array_push($aBTool,$row->price-$row->paid);
            }   
if ($row->part=="SURG"){
            array_push($aSurg,$row->price);  
            array_push($aBSurg,$row->price-$row->paid);  
            } 
if ($row->part=="NCARE"){
            array_push($aNcare,$row->price);
            array_push($aBNcare,$row->price-$row->paid);
            }   
if ($row->part=="DENTA"){
            array_push($aDent,$row->price);  
            array_push($aBDent,$row->price-$row->paid);  
            } 
if ($row->part=="PT"){
            array_push($aPhysi,$row->price);  
            array_push($aBPhysi,$row->price-$row->paid);  
            } 
if ($row->part=="STX"){
            array_push($aStx,$row->price);
            array_push($aBStx,$row->price-$row->paid);
            }   
if ($row->part=="MC"){
            array_push($aMc,$row->price);
            array_push($aBMc,$row->price-$row->paid);
            }   

$item++;
       }
 include("unconnect.inc");

    $Netpri=array_sum($aPri);
    $Netpaid=array_sum($aPaid);
    $BFY       = array_sum($aBFY);
    $BFN       = array_sum($aBFN);
//    $Phar      =array_sum($aPhar);
//    $Pharpaid=array_sum($aPharpaid); 
//ยาที่ใช้ใน รพ.
    $Essd    =array_sum($aEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้
//ยาที่ใช้ใน รพ.

    $DSY     =array_sum($aDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aDPY);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aDPN);   //รวมเงินค่าอุปกรณ์ ส่วนที่เบิกไม่ได้  
 
    $Blood     = array_sum($aBlood);
    $Labo         =array_sum($aLabo);
    $Xray         =array_sum($aXray);
    $Sinv        = array_sum($aSinv);
    $Tool        = array_sum($aTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
    $Surg         =array_sum($aSurg);
    $Ncare       = array_sum($aNcare);
    $Dent          =array_sum($aDent);
    $Physi        =array_sum($aPhysi);
    $Stx            = array_sum($aStx);
    $Mc            = array_sum($aMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
//
   print "<font face='Angsana New'>ผู้ป่วย $cPtname<br>";
   print "HN: $cHn  AN: $cAn<br>";
   print "สิทธิการรักษา :$cPtright<br>";
   print "โรค: $cDiag<br>";
//   print "แพทย์: $cDoctor<br>";
   print "สรุปค่ารักษาพยาบาลรวมทั้งหมดในการเจ็บป่วยครั้งนี้ ณ วันที่ $Thidate<br>";
   print "<font face='Angsana New'>จำนวนทั้งสิ้น $item รายการ ดังนี้<br>";
//
print "<table>";
print " <tr>";
print "  <th bgcolor=6495ED>#</th>";
print "  <th bgcolor=6495ED>วันที่</th>";
print "  <th bgcolor=6495ED>แผนก</th>";
print "  <th bgcolor=6495ED>รายการ</th>";
print "  <th bgcolor=6495ED>จำนวน</th>";
print "  <th bgcolor=6495ED>ราคา</th>";
print "  <th bgcolor=6495ED>จ่ายเงิน</th>";
print "  <th bgcolor=6495ED>ประเภท</th>";
print "  <th bgcolor=6495ED>จนท.</th>";
print " </tr>";

//
   $num=1;
   for ($n=$item; $n>=1; $n--){
//        $time=substr($aDay[$n],0,8);
        print("<tr>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$num</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDay[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDep[$n]</td>\n".
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aDtail[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aAmt[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPri[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPaid[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aPart[$n]</td>\n".  
                "<td bgcolor=F5DEB3><font face='Angsana New'>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

print "</table>";
//
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'>สรุปค่ารักษาพยาบาล:<br>";
print "รายการ<br>";
print "1. ค่าห้อง/ค่าอาหาร<br>";	
print "   .......ค่าห้อง/ค่าอาหาร(ส่วนเกิน)<br>";	
print "2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา<br>";	
print "3. ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล<br>";
print "4. ยาที่นำไปใช้ต่อที่บ้าน<br>	";
print "5. เวชภัณฑ์ที่ไม่ใช่ยา<br>";
print "6. ค่าบริการโลหิตและส่วนประกอบของโลหิต<br>";
print "7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา<br>";
print "8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา<br>";
print "9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ<br>";
print "10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์<br>"; 
print "11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี<br>";	
print "12. ค่าบริการทางการพยาบาลทั่วไป<br>";
print "13. ค่าบริการทางทันตกรรม<br>";
print "14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู<br>";
print "15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ<br>";
print "16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</font></td>";
////////////////
print "      <td width='16%' valign='middle'><font face='Angsana New'>รายการ<br>";
print "        เบิกได้<br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        ...<br>";//4. ยาที่นำไปใช้ต่อที่บ้านเบิกได้
print "        $DSY<br>";
print "        $Blood<br>";
print "        $Labo<br>";
print "        $Xray<br>";
print "        $Sinv<br>"; // 9.ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ
print "        $Tool<br>"; //10.ค่าใช้เครื่องมือทางการแพทย์
print "        $Surg<br>";
print "        $Ncare<br>";
print "        $Dent<br>";
print "        $Physi<br>";
print "        $Stx<br>";
print "        ...</font></td>";
/////////////////
print "      <td width='24%'><font face='Angsana New'>รายการ<br>";
print "        เบิกไม่ได้<br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        ...<br>"; //4. ยาที่นำไปใช้ต่อที่บ้าน เบิกไม่ได้
print "        $DSN<br>";
print "       ...<br>";
print "        ....<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $Mc</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";

print "รวมเงินทั้งสิ้น $Netpri บาท<br>";
print "จ่ายแล้ว $Netpaid บาท<br>";

$debt=$Netpri-$Netpaid;
$debt=number_format($debt,2,'.',''); //เพิ่มจุดทศนิยม
print "ค้างจ่าย $debt บาท<br>";
//print "จนท. $sOfficer วันที่ $Thaidate<br>";
/*
    print "<form method='POST' action='ipbill.php'>";
    print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' value=$debt>&nbsp;&nbsp;บาท<br>";
    print "<input type='submit' value='เก็บเงิน  ออกใบเสร็จ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ลบทิ้ง' name='B2'>";
    print "</form>";
*/

////////////////////
//ยาที่ใช้ใน รพ.   รายการในใบเสร็จ หักเงินที่จ่ายแล้วออก
    $BFY       = array_sum($aBBFY);
    $BFN       = array_sum($aBBFN);

    $Essd    =array_sum($aBEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $Nessdy=array_sum($aBNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDLDDY =$Essd+$Nessdy; //3.ยาและสารอาหารทางเส้นเลือด(เบิกได้)
    $Nessdn=array_sum($aBNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้

//ยาเวชภัณฑ์ที่นำไปใช้ต่อที่บ้าน
    $DEssd    =array_sum($aBDEssd);   //รวมเงินค่ายาในบัญชียาหลักแห่งชาติ
    $DNessdy=array_sum($aBDNessdy);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้
    $DDgy= $DEssd+$DNessdy; //ยาที่นำไปใช้ต่อที่บ้านและเบิกได้
    $DNessdn=array_sum($aBDNessdn);     //รวมเงินค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้

    $DSY     =array_sum($aBDSY);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกได้
    $DSN     =array_sum($aBDSN);   //รวมเงินค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้  

    $DPY     =array_sum($aBDPY);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกได้
    $DPN     =array_sum($aBDPN);   //รวมเงินค่าซื้ออุปกรณ์ ส่วนที่เบิกไม่ได้  

    $Blood     = array_sum($aBBlood);
    $Labo         =array_sum($aBLabo);
    $Xray         =array_sum($aBXray);
    $Sinv        = array_sum($aBSinv);
    $Tool        = array_sum($aBTool);  //ค่าใช้เครื่องมือทางการแพทย์ เช่น respirator
    $Surg         =array_sum($aBSurg);
    $Ncare       = array_sum($aBNcare);
    $Dent          =array_sum($aBDent);
    $Physi        =array_sum($aBPhysi);
    $Stx            = array_sum($aBStx);
    $Mc            = array_sum($aBMc); //ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา
//
   print "======================<br>";
   print "สรุปค่ารักษาพยาบาล(ค้างจ่าย) ณ วันที่ $Thidate<br>";
   print "ผู้ป่วย $cPtname<br>";
   print "HN: $cHn  AN: $cAn<br>";
   print "สิทธิการรักษา :$cPtright<br>";
   print "โรค: $cDiag<br>";
//
print "<div align='left'>";
print "  <table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "    <tr>";
print "      <td width='5%'></td>";
print "      <td width='55%'><font face='Angsana New'>สรุปค่ารักษาพยาบาล:<br>";
print "รายการ<br>";
print "1. ค่าห้อง/ค่าอาหาร<br>";	
print "   .......ค่าห้อง/ค่าอาหาร(ส่วนเกิน)<br>";	
print "2. อวัยวะเทียม/อุปกรณ์ในการบำบัดรักษา<br>";	
print "3. ยาและสารอาหารทางเส้นเลือดที่ใช้ในโรงพยาบาล<br>";
print "4. ยาที่นำไปใช้ต่อที่บ้าน<br>	";
print "5. เวชภัณฑ์ที่ไม่ใช่ยา<br>";
print "6. ค่าบริการโลหิตและส่วนประกอบของโลหิต<br>";
print "7. ค่าตรวจวินิจฉัยทางเทคนิคการแพทย์และพยาธิวิทยา<br>";
print "8. ค่าตรวจวินิจฉัยและรักษาทางรังสีวิทยา<br>";
print "9.  ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ<br>";
print "10. ค่าอุปกรณ์ของใช้และเครื่องมือทางการแพทย์<br>"; 
print "11. ค่าผ่าตัด  ทำคลอด  ทำหัตถการและบริการวิสัญญี<br>";	
print "12. ค่าบริการทางการพยาบาลทั่วไป<br>";
print "13. ค่าบริการทางทันตกรรม<br>";
print "14. ค่าบริการทางกายภาพบำบัดและเวชกรรมฟื้นฟู<br>";
print "15. ค่าบริการฝังเข็ม/การบำบัดของผู้ประกอบโรคศิลปะอื่นๆ<br>";
print "16. ค่าบริการอื่นที่ไม่เกี่ยวข้องกับการรักษา</font></td>";
print "      <td width='16%' valign='middle'><font face='Angsana New'>รายการ<br>";
print "        เบิกได้<br>";
print "        $BFY<br>";
print "        ...<br>";
print "        $DPY<br>";
print "        $DDLDDY<br>";
print "        ...<br>";//4. ยาที่นำไปใช้ต่อที่บ้านเบิกได้
print "        $DSY<br>";
print "        $Blood<br>";
print "        $Labo<br>";
print "        $Xray<br>";
print "        $Sinv<br>"; // 9.ค่าตรวจวินิจฉัยโดยวิธีพิเศษอื่นๆ
print "        $Tool<br>"; //10.ค่าใช้เครื่องมือทางการแพทย์
print "        $Surg<br>";
print "        $Ncare<br>";
print "        $Dent<br>";
print "        $Physi<br>";
print "        $Stx<br>";
print "        ...</font></td>";
print "      <td width='24%'><font face='Angsana New'>รายการ<br>";
print "        เบิกไม่ได้<br>";
print "        ...<br>";
print "        $BFN<br>";
print "        $DPN<br>";
print "        $Nessdn<br>";
print "        $DNessdn<br>"; //4. ยาที่นำไปใช้ต่อที่บ้าน เบิกไม่ได้
print "        $DSN<br>";
print "       ...<br>";
print "        ....<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        ...<br>";
print "        $Mc</font></td>";
print "    </tr>";
print "  </table>";
print "</div>";
print "</table>";

//print "รวมเงินทั้งสิ้น $Netpri บาท<br>";
//print "จ่ายแล้ว $Netpaid บาท<br>";
$debt=$Netpri-$Netpaid;
$debt=number_format($debt,2,'.',''); //เพิ่มจุดทศนิยม
print "ค้างจ่าย $debt บาท<br>";
//print "จนท. $sOfficer วันที่ $Thaidate<br>";

    print "<form method='POST' action='ipdibill.php'>";
    print "เก็บเงิน&nbsp;&nbsp;&nbsp; <input type='text' name='paid' size='10' value=$debt>&nbsp;&nbsp;บาท<br>";
    print "<input type='submit' value='เก็บเงิน  ออกใบเสร็จ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
//    print "<input type='reset' value='ลบทิ้ง' name='B2'>";
    print "</form>";
?>




