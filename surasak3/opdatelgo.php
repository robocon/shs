<?php
    session_start();
    session_unregister("x");
    session_unregister("aDate");
 session_unregister("atxDate");
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
    session_unregister("aPtright");
    session_unregister("aCredit");
    session_unregister("aCreditpaid");
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
	 session_unregister("aNid");
    session_unregister("aNidpd");
    session_unregister("aHemo");
    session_unregister("aHemopd");
    session_unregister("aOther");
    session_unregister("aOtherpd");
    session_unregister("aWard");
    session_unregister("aWardpd");
    session_unregister("aCredit");
	session_unregister("aCredit_d");
	session_unregister("aPaidcscd");
	session_unregister("aVn");
		session_unregister("aLastupdate");
//
//
    $x            =0;
    $aDate     =array("time");
     $atxDate     =array("time2");
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
	$aPtright   =array("ptright");  
	$aCredit   =array("credit");  
	$aCreditpaid  =array("creditpaid");  
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
	$aPhysipd       =array("physipd");
	$aNid       =array("nid");
    $aNidpd  =array("nidpd");
    $aHemo       =array("hemo");
    $aHemopd  =array("hemopd");
    $aOther      =array("other");
    $aOtherpd  =array("otherpd");
    $aWard      =array("Ward");
    $aWardpd  =array("Wardpd");
	$aCredit     =array("Credit");
	$aCredit_d     =array("Credit_detail");
	$aPaidcscd     =array("paidcscd");
$aVn     =array("vn");
$aLastupdate     =array("lastupdate");

    session_register("x");
    session_register("aDate");
  session_register("atxDate");
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
    session_register("aPtright");
    session_register("aCredit");
    session_register("aCreditpaid");
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
	  session_register("aNid");
    session_register("aNidpd");
    session_register("aHemo");
    session_register("aHemopd");
    session_register("aOther");
    session_register("aOtherpd");
    session_register("aWard");
    session_register("aWardpd");
    session_register("aCredit");
	   session_register("aCredit_d");
	      session_register("aPaidcscd");
		   session_register("aVn");
		     session_register("aLastupdate");
//
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='opmonreplgo.php' target='_blank'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
             <a href='opdatecscd.php'> �Դ�ѭ�ռ����¹͡ ���µç</a> || �Դ�ѭ�ռ����¹͡ ���µç ͻ�.</font></p>";      
	print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ��ͧ��ô�����Ѻ�����¹͡  �ͧ�ѹ��� ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>�ѹ���&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "��͹&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "�.�. <input type='text' name='yr' size='8' value=$yr></font></p>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='��ŧ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<input type='reset' value='ź���' name='B2'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<�����</a>";
    print "</form>";
?>


