<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='rphos5dgmon.php'>";
    print  "<font face='Angsana New'><b>����¹���������Ǫ�ѳ��(�.�.5)  ��§ҹ���������</b><br> ";
    print  "<font face='Angsana New'>(�٤�������͹��Ǣͧ��������͹���ͧ������)<br> ";
 
  print "<p><font face='Angsana New'>������&nbsp;&nbsp; ";
    print "<input type='text' name='cDrugcode' size='15'>&nbsp;&nbsp;";
    print "��͹(01-12)&nbsp; <input type='text' name='m' size='2' value=$m>&nbsp;&nbsp;&nbsp;";
    print "�.�. <input type='text' name='yr' size='8' value=$yr></font></p>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ��ŧ     ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print " <a target=_self  href='../nindex.htm'><<�����</a></font></p>";
    print "</form>";
?>


