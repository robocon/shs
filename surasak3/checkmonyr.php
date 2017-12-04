<?php
    session_start();
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
//
    $x            =0;
    $aDate     =array("time");
    
    $chkdate="";   
    $repdate="";

    $aHn        =array("hn");
    $aAn         =array("an");  
    $aIdname  =array("idname");
    $Netprice  ="";   
    $Netpaid   ="";
    $aDepart   =array("depart");
    $aDetail    = array("detail");
    $aPrice   =array("price");
    $aPaid    = array("paid");
    $aPhar      =array("phar");
    $aPharpaid=array("pharpaid"); 
    $aEssd     =array("DDL");
    $aNessdy =array("DDY");
    $aNessdn =array("DDN");
    $aDPY      =array("DPY");
    $aDPN      =array("DPN");   
    $aDSY      =array("DSY");
    $aDSN      =array("DSN");   
    $aLabo        =array("labo");
    $aLabopaid  =array("labopaid");
    $aXray         =array("xray");
    $aXraypaid =array("xraypaid");
    $aSurg        =array("surg");
    $aSurgpaid =array("surgpaid");
    $aEmer        =array("emer");
    $aEmerpaid  =array("emerpaid");
    $aDent          =array("dent");
    $aDentpaid  =array("dentpaid");
    $aPhysi       =array("physi");
    $aPhysipd  =array("physipd");
    $aHemo       =array("hemo");
    $aHemopd  =array("hemopd");
    $aOther      =array("other");
    $aOtherpd  =array("otherpd");
    $aWard      =array("Ward");
    $aWardpd  =array("Wardpd");

    session_register("x");
    session_register("aDate");

    session_register("chkdate");
    session_register("repdate");

    session_register("aHn");
    session_register("aAn");
    session_register("aIdname");
    session_register("aDepart");
    session_register("aDetail");
    session_register("aPrice");
    session_register("aPaid");
    session_register("aPhar");  
    session_register("aPharpaid");    
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
    session_register("aLabo");
    session_register("aLabopaid");
    session_register("aXray");
    session_register("aXraypaid");  
    session_register("aSurg");    
    session_register("aSurgpaid");
    session_register("aEmer");
    session_register("aEmerpaid");
    session_register("aDent");
    session_register("aDentpaid");
    session_register("aPhysi");
    session_register("aPhysipd");
    session_register("aHemo");
    session_register("aHemopd");
    session_register("aOther");
    session_register("aOtherpd");
    session_register("aWard");
    session_register("aWardpd");
//
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='checkmonyr1.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ต้องการดูรายรับผู้ป่วยนอกตามสิทธิการรักษา  ของวันที่ ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>วันที่&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "เดือน&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "พ.ศ. <input type='text' name='yr' size='8' value=$yr></font></p>";
	 
print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;สิทธิการรักษา&nbsp;";
print " <select  name='ptright'>";
print " <OPTION value='$cPtright'>";
print " <option value='$cPtright' selected>$cPtright</option>";
print " <option value='0' ><-เลือกสิทธิการรักษา-></option>";
print " <option value='R01&nbsp;เงินสด' >R01&nbsp;เงินสด</option>";
print " <option value='R02&nbsp;เบิกคลังจังหวัด' >R02&nbsp;เบิกคลังจังหวัด</option>";
print " <option value='R03&nbsp;โครงการโรครักษาต่อเนื่อง' >R03&nbsp;โครงการโรครักษาต่อเนื่อง</option>";
print " <option value='R04&nbsp;รัฐวิสาหกิจ' >R04&nbsp;รัฐวิสาหกิจ</option>";
print " <option value='R05&nbsp;บริษัท(มหาชน)' >R05&nbsp;บริษัท(มหาชน)</option>";
print " <option value='R06&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ' >R06&nbsp;พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ</option>";
print " <option value='R07&nbsp;ประกันสังคม' >R07&nbsp;ประกันสังคม</option>";
print " <option value='R08&nbsp;ก.ท.44(บาดเจ็บในงาน)' >R08&nbsp;ก.ท.44(บาดเจ็บในงาน)</option>";
print " <option value='R09&nbsp;ประกันสุขภาพถ้วนหน้า(30บาท)' >R09&nbsp;ประกันสุขภาพถ้วนหน้า(30บาท)</option>";
print " <option value='R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)' >R10&nbsp;ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)</option>";
print " <option value='R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)' >R11&nbsp;ประกันสุขภาพถ้วนหน้า(มาตรา8)</option>";
print"<optionvalue='R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)' >R12&nbsp;ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)</option>";
print " <option value='R13&nbsp;ประกันสุขภาพถ้วนหน้า(ในจังหวัดฉุกเฉิน)' >R13&nbsp;ประกันสุขภาพถ้วนหน้า(ในจังหวักฉุกเฉิน)</option>";
print " <option value='R14&nbsp;ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)' >R17&nbsp;ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)</option>";

print " <option value='R15&nbsp;ประกันสุขภาพนักเรียน(บริษัท)' >R15&nbsp;ประกันสุขภาพนักเรียน(บริษัท)</option>";
print " <option value='R16&nbsp;ศึกษาธิการ(ครูเอกชน)' >R16&nbsp;ศึกษาธิการ(ครูเอกชน)</option>";
print " <option value='R17&nbsp;พลทหาร' >R17&nbsp;พลทหาร</option>";
print "   </select>";

    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='ตกลง' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<input type='reset' value='ลบทิ้ง' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
   
    print "</form>";
?>


