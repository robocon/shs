<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    print "<form method='POST' action='wardlst.php'>";
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              ��¡����ԡ�Ҩҡ�ͼ����¢ͧ�ѹ��� ?&nbsp;&nbsp;</font></p>";
    print "<p><font face='Angsana New'>�ѹ���&nbsp;&nbsp; ";
    print "<input type='text' name='d' size='4' value=$d>&nbsp;&nbsp;";
    print "��͹&nbsp; <input type='text' name='m' size='4' value=$m>&nbsp;&nbsp;&nbsp;";
    print "�.�. <input type='text' name='yr' size='8' value=$yr></font></p>";

	$mward="41�ͼ����ª��";
	$fward="42�ͼ�����˭ԧ";
	$gward="43�ͼ������ٵԹ��";
	$icuward="44�ͼ����� ICU";
	$vipward="45�ͼ����¾����";

$all="";
print "  &nbsp;&nbsp;&nbsp;&nbsp;���͡�ͼ�����&nbsp;";
print " <select  name='ward'>";
//print " <option selected>**�ô���͡�ͼ�����**</option>";
print " <option value='$mward'>�ͼ����ª��</option>";
print " <option value='$fward'>�ͼ�����˭ԧ</option>";
print " <option value='$gward'>�ͼ������ٵԹ��</option>";
print " <option value='$icuward'>�ͼ����� ICU</option>";
print " <option value='$vipward'>�ͼ����¾����</option>";
print " <option value='$all'>OR ER</option>";
print "   </select>";
////
    print "<p><font face='Angsana New'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
    print "<input type='submit' value='     ��ŧ     ' name='B1'>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;";
    print "<a target=_self  href='../nindex.htm'><<�����</a></font></p>";
    print "</form>";
?>



