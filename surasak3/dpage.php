<?php
    echo "<font face='Angsana New' size='5'>$cTitle (���͡��Һѭ���Ңͧᾷ��)   <input type=button onclick='history.back()'                               value=<<��Ѻ���úѭ></font><br>";
  include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED>#</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>������</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>�ѭ��*</th>";
    print "<th bgcolor=6495ED><font face='Angsana New'>��㹤�ѧ</th>";
    print "</tr>";

    $cPage=rtrim($cPage);
    $query = "SELECT drugcode,tradname,genname,unit,salepri,drugtype,part,totalstk FROM druglst WHERE bcode LIKE '$cPage%' ";
    $result = mysql_query($query)
        or die("Query failed");

If (!empty($cPage)){
    $num=0;
    while (list ($drugcode, $tradname,$genname,$unit,$salepri,$drugtype,$part,$totalstk) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"drdglist.php? Dgcode=$drugcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA>$drugtype</td>\n".
           "  <td BGCOLOR=66CDAA>$part</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           " </tr>\n");
}}
   print "</table>";

    include("unconnect.inc");

    print "<font face='Angsana New'>*DDL   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br>";
    print "<font face='Angsana New'>DDY   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�� <br>";
    print "<font face='Angsana New'>DDN   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ����� <br>";
    print "<font face='Angsana New'>DPY   �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br>";
    print "<font face='Angsana New'>DPN   �ػ�ó� ����ԡ����� <br>";
    print "<font face='Angsana New'>DSY   �Ǫ�ѳ�� ����ԡ��(�ԡ��੾��IPD�������� þ.,OPD �ԡ�����) <br>";
    print "<font face='Angsana New'>DSN   �Ǫ�ѳ�� ����ԡ�����";
?>




