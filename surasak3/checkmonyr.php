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
              ��ͧ��ô�����Ѻ�����¹͡����Է�ԡ���ѡ��  �ͧ�ѹ��� ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>�ѹ���&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "��͹&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "�.�. <input type='text' name='yr' size='8' value=$yr></font></p>";
	 
print "  <p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;�Է�ԡ���ѡ��&nbsp;";
print " <select  name='ptright'>";
print " <OPTION value='$cPtright'>";
print " <option value='$cPtright' selected>$cPtright</option>";
print " <option value='0' ><-���͡�Է�ԡ���ѡ��-></option>";
print " <option value='R01&nbsp;�Թʴ' >R01&nbsp;�Թʴ</option>";
print " <option value='R02&nbsp;�ԡ��ѧ�ѧ��Ѵ' >R02&nbsp;�ԡ��ѧ�ѧ��Ѵ</option>";
print " <option value='R03&nbsp;�ç����ä�ѡ�ҵ�����ͧ' >R03&nbsp;�ç����ä�ѡ�ҵ�����ͧ</option>";
print " <option value='R04&nbsp;�Ѱ����ˡԨ' >R04&nbsp;�Ѱ����ˡԨ</option>";
print " <option value='R05&nbsp;����ѷ(��Ҫ�)' >R05&nbsp;����ѷ(��Ҫ�)</option>";
print " <option value='R06&nbsp;�.�.�.������ͧ�����ʺ��¨ҡö' >R06&nbsp;�.�.�.������ͧ�����ʺ��¨ҡö</option>";
print " <option value='R07&nbsp;��Сѹ�ѧ��' >R07&nbsp;��Сѹ�ѧ��</option>";
print " <option value='R08&nbsp;�.�.44(�Ҵ��㹧ҹ)' >R08&nbsp;�.�.44(�Ҵ��㹧ҹ)</option>";
print " <option value='R09&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(30�ҷ)' >R09&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(30�ҷ)</option>";
print " <option value='R10&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���Դ����)' >R10&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���Դ����)</option>";
print " <option value='R11&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�ҵ��8)' >R11&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�ҵ��8)</option>";
print"<optionvalue='R12&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���ü�ҹ�֡/���ԡ��)' >R12&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(���ü�ҹ�֡/���ԡ��)</option>";
print " <option value='R13&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(㹨ѧ��Ѵ�ء�Թ)' >R13&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(㹨ѧ��ѡ�ء�Թ)</option>";
print " <option value='R14&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�͡�ѧ��Ѵ�ء�Թ)' >R17&nbsp;��Сѹ�آ�Ҿ��ǹ˹��(�͡�ѧ��Ѵ�ء�Թ)</option>";

print " <option value='R15&nbsp;��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)' >R15&nbsp;��Сѹ�آ�Ҿ�ѡ���¹(����ѷ)</option>";
print " <option value='R16&nbsp;�֡�Ҹԡ��(����͡��)' >R16&nbsp;�֡�Ҹԡ��(����͡��)</option>";
print " <option value='R17&nbsp;�ŷ���' >R17&nbsp;�ŷ���</option>";
print "   </select>";

    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='��ŧ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<input type='reset' value='ź���' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
   
    print "</form>";
?>


