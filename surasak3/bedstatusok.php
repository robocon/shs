<?php
session_start();
 include("connect.inc"); //�ѹ�����  UPDATE bed SET status='$status',food='$status_detail'

  $query ="UPDATE bed SET status='$status',status_detail='$status_detail' WHERE bedcode='$cBedcode' ";
  $result = mysql_query($query)
        or die("Query failed bed");

If (!$result){ //�ѹ�����  new food fail
         echo "new status fail <br>";
         echo mysql_errno() . ": " . mysql_error(). "\n";
         }
else {
         print " ���ʶҹ������� : $status<br>";
         print "  �Դ˹�ҵ�ҧ���   ���� Refresh ˹�ҵ�ҧ�ͼ��������ͷӢ���������繻Ѩ�غѹ";
         }
 include("unconnect.inc");
/*
//session_destroy();
    //ipdata.php
    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aPrice");
    session_unregister("aPart");
    session_unregister("aAmount");
    session_unregister("aMoney");
    session_unregister("Netprice");
    session_unregister('cDate');
    session_unregister('cBedcode');
    session_unregister('cBed');
    session_unregister('cPtname');
    session_unregister('cAge');
    session_unregister('cPtright');
    session_unregister('cDoctor');
    session_unregister('cHn');
    session_unregister('cAn');
    session_unregister('cDiag');
    session_unregister('cBedpri');
    session_unregister('cChgdate');
    session_unregister('cBedname');
    session_unregister('cAccno');
*/
    session_unregister('cBedcode');
    session_register("Bedcode");
////
?>
 