<?php
//  ¡��ԡ��¡ ���ź  ���� �觢�������Һѭ�ռ������������Ѻ���� 
//  laberase.php-->labselect.php-->labdetail.php-->labturn.php
//	��2files _erase,select: laberase,labselect,xr,er,or,pt,den
//	��ǹ labdetail.php,labturn.php�����ͧ��

    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='erselect.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	     ��ͧ���¡��ԡ��¡��  ���� �觢�������Һѭ�ռ������������Ѻ����   &nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>�ѹ���&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "��͹&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "�.�. <input type='text' name='yr' size='8' value=$yr></font></p>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ��ŧ               ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<�����</a></font></p>";
    print "</form>";
?>



