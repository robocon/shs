<?php
    session_start();
//    session_unregister("cDocno"); 
//    session_unregister("cBillno");
//    session_unregister("cBilldate"); 
//    session_unregister("cGetdate");
//    session_unregister("cComcode"); 
//    session_unregister("cComname"); 
    session_unregister("cMainstk"); 
    session_unregister("cTotalstk");

//    $cDocno="";
//    $cBillno="";
//    $cBilldate="";
//    $cGetdate="";
//    $cComcode="";
//    $cComname="";

    $cMainstk="";
    $cTotalstk="";

//    session_register("cDocno"); 
//    session_register("cBillno");
//    session_register("cBilldate"); 
//    session_register("cGetdate");
//    session_register("cComcode"); 
//    session_register("cComname"); 
    session_register("cMainstk"); 
    session_register("cTotalstk");
    print "<font face='Angsana New'>�Ţ����Ѻ $cStkno,�Ţ����͡��ë��� $cDocno, �Ţ�����觢ͧ $cBillno <br>";  
    print "<font face='Angsana New'> �ѹ�����觢ͧ $cBilldate,�ѹ����Ѻ�Թ��� $cGetdate, ���ʺ���ѷ $cComcode<br>";
?>
<form method="POST" action="dgprocure_pt.php">
  <p><font face="Angsana New"><b>�����Թ�����Ҥ�ѧ���Ǫ�ѳ��</b></font></p>
  <p><font face="Angsana New"><b>&nbsp;&nbsp;&nbsp;&nbsp;- ��¡�õ��� (����Թ�������)</b></font></p>
  <p><font face="Angsana New"><b>&#3619;&#3627;&#3633;&#3626;&nbsp;&nbsp;<input type="text" name="dgcode" size="15">&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='drugcode.php'>(������)</a>&nbsp;&nbsp; </b></font></p>
  <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="Submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1"></p>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>
</form>

