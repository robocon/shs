<?php
    session_start();
    if (isset($sIdname)){} else {die;} //for security

    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("cDiag");
    session_unregister("cAn"); 
    session_unregister("cDoctor"); 
    session_unregister("cAccno"); 
    session_unregister("cBedcode"); 

    $cHn="";
    $cPtname="";
    $cPtright="";    
    $cDiag="";
    $cDoctor="";
    $cAn="";
    $cAccno="";
    $cBedcode="";
    session_register("cHn");  
    session_register("cPtname");
    session_register("cPtright");
    session_register("cDiag");
    session_register("cAn"); 
    session_register("cDoctor"); 
    session_register("cAccno"); 
    session_register("cBedcode"); 
?>
<form method="POST" action="pttopay.php">
  <p><font face="Angsana New"></font><font size="2">ŧ��¡�ä����ʴ�/�ػ�ó��ҹ�Ǫ��ʵ���鹿� �������<b>&nbsp;&nbsp;</b></font></p>
  <p>&nbsp;&nbsp;&nbsp;AN&nbsp;&nbsp;&nbsp;<input type="text" name="an" size="8"></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;
  <input type="submit" value="   &#3605;&#3585;&#3621;&#3591;   " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a></p>
</form>
