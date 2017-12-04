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

 include("connect.inc");

//insert data into opmonrep
/*
CREATE TABLE opmonrep (
  row_id int(11) NOT NULL auto_increment,
  date datetime default NULL,
  price double(12,2) default NULL,
  paid double(12,2) default NULL,
  idname char(32) default NULL,
  phar double(12,2) default NULL,
  pharpaid double(12,2) default NULL,
  essd double(12,2) default NULL,
  nessdy double(12,2) default NULL,
  nessdn double(12,2) default NULL,
  dsy double(12,2) default NULL,
  dsn double(12,2) default NULL,
  dpy double(12,2) default NULL,
  dpn double(12,2) default NULL,
  labo double(12,2) default NULL,
  labopaid double(12,2) default NULL,
  xray double(12,2) default NULL,
  xraypaid double(12,2) default NULL,
  surg double(12,2) default NULL,
  surgpaid double(12,2) default NULL,
  emer double(12,2) default NULL,
  emerpaid double(12,2) default NULL,
  dent double(12,2) default NULL,
  dentpaid double(12,2) default NULL,
  physi double(12,2) default NULL,
  physipd double(12,2) default NULL,
  hemo double(12,2) default NULL,
  hemopd double(12,2) default NULL,
  other double(12,2) default NULL,
  otherpd double(12,2) default NULL,
  ward double(12,2) default NULL,
  wardpd double(12,2) default NULL,
  PRIMARY KEY  (row_id),
  KEY date (date)
) TYPE=MyISAM;
  date,price,paid,idname,phar,pharpaid,essd,nessdy,nessdn,dsy,dsn, 
  dpy,dpn,labo,labopaid,xray,xraypaid,surg,surgpaid,emer,emerpaid,
  dent,dentpaid,physi,physipd,hemo,hemopd,other,otherpd,ward,wardpd
*/
    
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

จนท.        วันที่
*/
print "ส่วนเก็บเงินผู้ป่วยนอก:<br>";
print "รายงานเงินรายรับของวันที่ $repdate<br><br>";
print "<table border='0' cellpadding='0' cellspacing='0' width='100%'>";
print "  <tr>";
print "    <td width='5%'></td>";
print "    <td width='50%'><font face='Angsana New'>เภสัชกรรม<br>";
print "      .......ค่ายาในบัญชียาหลักแห่งชาติ<br>";
print "      .......ค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้<br>";
print "      .......ค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้<br>";
print "      .......ค่าเวชภัณฑ์ ส่วนที่เบิกได้<br>";
print "      .......ค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้&nbsp;<br>";
print "      .......ค่าอุปกรณ์ ส่วนที่เบิกได้<br>";
print "      .......ค่าอุปกรณ์ ส่วนที่เบิกไม่ได้&nbsp;<br>";
print "      <br>";
print "      พยาธิ<br>";
print "      เอกซเรย์<br>";
print "      ห้องผ่าตัด<br>";
print "      ห้องฉุกเฉิน<br>";
print "      ทันตกรรม<br>";
print "      กายภาพบำบัด<br>";
print "      ไตเทียม<br>";
print "      หอผู้ป่วย<br>";
print "      อื่นๆ<br>";
print "      <br>";
print "      รวมทั้งสิ้น</font></td>";
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

print "<font face='Angsana New'><br>จำนวนทั้งสิ้น $x รายการ ดังนี้<br>";
print "<table>";
print " <tr>";
print "  <th>#</th>";
print "  <th>เวลา</th>";
print "  <th>HN</th>";
print "  <th>AN</th>";
print "  <th>แผนก</th>";
print "  <th>รายการ</th>";
print "  <th>ราคา</th>";
print "  <th>จ่ายเงิน</th>";
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
                "<td>$aPrice[$n]</td>\n".  
                "<td>$aPaid[$n]</td>\n".  
                "<td>$aIdname[$n]</td>\n".  
                " </tr>\n");
       $num++;
        }

print "</table>";
print "<br>ลงชื่อ<br>";
print "<br>( $sOfficer )<br>";
print "$Thaidate"; 
// session_destroy();
    session_unregister("x");
    session_unregister("aDate");
    session_unregister("chkdate");
    session_unregister("repdate");
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
?>
 
