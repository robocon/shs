<style>
.font1{
	font-family:"TH SarabunPSK";
	font-size:18pt;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:16pt;
}
</style>
<?php
    echo "<h1 class='font2'  align='center'>$cTitle (���͡����������´)</h1><br>";
  include("connect.inc");
    print "<table class='font2'>";
    print "<tr>";
    print "<th bgcolor=6495ED>#</th>";
    print "<th bgcolor=6495ED>����</th>";
    print "<th bgcolor=6495ED>���͡�ä��</th>";
    print "<th bgcolor=6495ED>�������ѭ</th>";
    print "<th bgcolor=6495ED>˹���</th>";
    print "<th bgcolor=6495ED>�Ҥ�</th>";
    print "<th bgcolor=6495ED>������</th>";
    print "<th bgcolor=6495ED>�ѭ��*</th>";
    print "<th bgcolor=6495ED>��㹤�ѧ</th>";
    print "</tr>";

  //  $cPage=rtrim($cPage);
    $query = "SELECT drugcode,tradname,genname,unit,salepri,drugtype,part,totalstk FROM druglst WHERE bcode like '$cPage%' ";
    $result = mysql_query($query) or die("Query failed");
//echo $query;
If (!empty($cPage)){
    $num=0;
    while (list ($drugcode, $tradname,$genname,$unit,$salepri,$drugtype,$part,$totalstk) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA>$num</td>\n".
           "  <td BGCOLOR=66CDAA>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"dgitem.php? Dgcode=$drugcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=66CDAA>$genname</td>\n".
           "  <td BGCOLOR=66CDAA>$unit</td>\n".
           "  <td BGCOLOR=66CDAA>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA>$drugtype</td>\n".
           "  <td BGCOLOR=66CDAA>$part</td>\n".
           "  <td BGCOLOR=66CDAA>$totalstk</td>\n".
           " </tr>\n");
}}
   print "</table>";

    include("unconnect.inc");

    print "<BR><font face='TH SarabunPSK'>*DDL   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br>";
    print "<font face='TH SarabunPSK'>DDY   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�� <br>";
    print "<font face='TH SarabunPSK'>DDN   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� <br>";
    print "<font face='TH SarabunPSK'>DPY   �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br>";
    print "<font face='TH SarabunPSK'>DPN   �ػ�ó� ����ԡ����� <br>";
    print "<font face='TH SarabunPSK'>DSY   �Ǫ�ѳ�� ����ԡ��(�ԡ��੾��IPD�������� þ.,OPD �ԡ�����) <br>";
    print "<font face='TH SarabunPSK'>DSN   �Ǫ�ѳ�� ����ԡ�����";
?>




