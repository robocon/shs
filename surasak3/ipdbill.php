<?php
/*
    $mward  = '41';
    $fward    = '42';
    $gward   = '43';
    $icuward = '44';
    $vipward =  '45';
*/
    print "����ѡ�Ҿ�Һ�ż������&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    print "<font face='Angsana New'>(��ԡ AN = �������Թ����͡�����  ���ѧ����˹��¼�����)<br>";  
    include("connect.inc");

    $ward='41'; //mward
    print "�ͼ����ª��<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���ͼ�����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�ä</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ�</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>��ҧ����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�ѹ�ӹǹ</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_blank  href=\"ipmdivi.php? vAn=$an&vAccno=$accno&vPtname=$ptname&vHn=$hn&vBed=$bed&vPtright=$ptright&vDiag=$diagnos&vDate=$date\">$an</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
// $fward    = '42';
    $ward='42'; //mward
    print "�ͼ�����˭ԧ<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>���ͼ�����</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>�ä</b></th>";
    print "<th bgcolor=#808000><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>�Ҥ�</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>����</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>��ҧ����</b></th>";
    print " <th bgcolor=#808000><font face='Angsana New'><b>�ѹ�ӹǹ</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_blank  href=\"ipmdivi.php? vAn=$an&vAccno=$accno&vPtname=$ptname&vHn=$hn&vBed=$bed&vPtright=$ptright&vDiag=$diagnos&vDate=$date\">$an</a></td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=#CCCC00><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";

// $gward   = '43';
    $ward='43'; //mward
    print "�ͼ������ٵ�-���<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>���ͼ�����</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>�ä</b></th>";
    print "<th bgcolor=#669999><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>�Ҥ�</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>����</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>��ҧ����</b></th>";
    print " <th bgcolor=#669999><font face='Angsana New'><b>�ѹ�ӹǹ</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_blank  href=\"ipmdivi.php? vAn=$an&vAccno=$accno&vPtname=$ptname&vHn=$hn&vBed=$bed&vPtright=$ptright&vDiag=$diagnos&vDate=$date\">$an</a></td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=#00FF99><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $icuward = '44';
    $ward='44'; //mward
    print "�ͼ������ԡĵ(ICU)<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���ͼ�����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�ä</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�Ҥ�</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>��ҧ����</b></th>";
    print " <th bgcolor=CD853F><font face='Angsana New'><b>�ѹ�ӹǹ</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_blank  href=\"ipmdivi.php? vAn=$an&vAccno=$accno&vPtname=$ptname&vHn=$hn&vBed=$bed&vPtright=$ptright&vDiag=$diagnos&vDate=$date\">$an</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
// $vipward =  '45';
    $ward='45'; //mward
    print "�ͼ����¾����<br>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>��§</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>�ѹ�Ѻ����</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>AN</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>���ͼ�����</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>�ä</b></th>";
    print "<th bgcolor=6495ED><font face='Angsana New'><b>�Է�ԡ���ѡ��</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>�Ҥ�</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>����</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>��ҧ����</b></th>";
    print " <th bgcolor=6495ED><font face='Angsana New'><b>�ѹ�ӹǹ</b></th>";
    print "</tr>";

    $query = "SELECT  bed,date_format(date,'%d-%m-%Y'),an,ptname,diagnos,
                    ptright,price,paid,debt,date_format(caldate,'%d-%m-%Y %H:%i:%s'),accno,hn FROM bed WHERE bedcode LIKE '$ward%' ORDER BY bed ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($bed,$date,$an,$ptname,$diagnos,$ptright,$price,$paid,$debt,$caldate,$accno,$hn) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bed</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_blank  href=\"ipmdivi.php? vAn=$an&vAccno=$accno&vPtname=$ptname&vHn=$hn&vBed=$bed&vPtright=$ptright&vDiag=$diagnos&vDate=$date\">$an</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diagnos</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$debt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$caldate</td>\n".
           " </tr>\n");
        }
    print "</table>";
//
    include("unconnect.inc");
?>
