

<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 


 include("connect.inc");
 
 $cAn=$_GET['Can'];

$sql = "Select  *  From ipcard where an= '".$cAn."' ";
$result = mysql_query($sql);
$arr = mysql_fetch_assoc($result);

$cHn=$arr['hn'];
$vAN=$arr['an'];
$cPtname=$arr['ptname'];
$cPtright=$arr['ptright'];

print "<fieldset><legend>�����ż�����</legend>";

print "  HN:  $cHn       AN: $vAN <br> ";
print "  $cPtname<br>"; 
print "�Է�ԡ���ѡ�� : $cPtright<br>";

print "</fieldset>";

print "<br><hr><br>";

print "<a target=_TOP  href=\"dcsum.php? Can=$vAN&Chn=$cHn\">����� DISCHARGE SUMMARY Ẻ���<br> ";

print "<a target=_TOP  href=\"dcsum.1.php? Can=$vAN&Chn=$cHn\">����� DISCHARGE SUMMARY  Ẻ���� <br> ";

print "<span style='color: red;'>(����)</span>&nbsp;<a target=_TOP  href=\"discharge_summary_2019.php?Can=$vAN\">����� DISCHARGE SUMMARY (������� 4 ��.�. 62)<br> ";
print "<span style='color: red;'>(����)</span>&nbsp;<a target=_TOP  href=\"clinical_summary_2019.php?an=$vAN\">����� Clinical Summary (������� 4 ��.�. 62 ���д�� A5)<br> ";

print "<a target=_TOP  href=\"dcsum2.php? Can=$vAN&Chn=$cHn\">����� ��Թ�������Ѻ������<br> ";
print "<a target=_TOP  href=\"dcsum3.php? Can=$vAN&Chn=$cHn\">����� ��Թ�������Ѻ�ҵ�<br> ";
print "<a target=_TOP  href=\"dcsum4.php? Can=$vAN&Chn=$cHn\">����� 㺤��Ф�<br> ";
print "<a target=_TOP  href=\"ancashdetail.php? Can=$vAN&Chn=$cHn\">㺢����ż����¹͹�ç��Һ��<br><br><br> ";

print "<a target=_TOP  href=\"dcsum5.1.php? Can=$vAN&Chn=$cHn\">����� 㺤��й� �Թʴ<br> ";
print "<a target=_TOP  href=\"dcsum5.2.php? Can=$vAN&Chn=$cHn\">����� 㺤��й� ����ѭ�ա�ҧ<br> ";
print "<a target=_TOP  href=\"dcsum5.3.php? Can=$vAN&Chn=$cHn\">����� 㺤��й� ���ѧ�Ѵ/�Ѱ����ˡԨ/ͧ��û���ͧ��ǹ��ͧ���<br> ";
print "<a target=_TOP  href=\"dcsum5.4.php? Can=$vAN&Chn=$cHn\">����� 㺤��й� �ѵû�Сѹ�ѧ��<br> ";
print "<a target=_TOP  href=\"dcsum5.5.php? Can=$vAN&Chn=$cHn\">����� 㺤��й� �ѵ��آ�Ҿ��ǹ˹��<br> ";
print "<a target=_TOP  href=\"dcsum5.6.php? Can=$vAN&Chn=$cHn\">����� 㺤��й� �ú<br> ";

include("unconnect.inc");
/*
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
*/
//session_destroy();
?>


