&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>

<?php
    $Thaidate=date("d/m/").(date("Y")+543);
    print  "�Ҥ��� �Ǫ�ѳ�� ����ػ�ó���ᾷ�� $Thaidate<br> ";

    print "<br>[���ʡ���觡�������Ǫ�ѳ������ػ�ó�������ԡ<br> ";
    print "<font face='Angsana New'>DDL =   ��㹺ѭ������ѡ��觪ҵ� �ԡ��<br> ";
    print "<font face='Angsana New'>DDY =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ��(�������ᾷ��͹��ѵ�)<br> ";
    print "<font face='Angsana New'>DDN =   �ҹ͡�ѭ������ѡ��觪ҵ� �ԡ�����<br> ";
    print "<font face='Angsana New'>DSY =   �Ǫ�ѳ�� ����ԡ��(�����¹͡�ԡ�����,��������ԡ��)<br> ";
    print "<font face='Angsana New'>DSN =   �Ǫ�ѳ�� ����ԡ�����<br> ";
    print "<font face='Angsana New'>DPY =   �ػ�ó� ����ԡ��(�ԡ����������ͺҧ��ǹ)<br> ";
    print "<font face='Angsana New'>DPN =   �ػ�ó� ����ԡ����� ";

    include("connect.inc");
 /*runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $dStartday=$row->startday;
*/
//1. ��㹺ѭ������ѡ��觪ҵ� �ԡ��ء��¡�� (DDL)
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>1. ��㹺ѭ���Ҽ������ä�</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>������</th>";
    print " </tr>";

    $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode= '2HEMA*$' ";
     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }

  $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode= '2veno' ";

     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
  $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode= '2CLE0.4*$' ";

     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
  $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode= '3zelb' ";

     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
  $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode= '2kidm*' ";

     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }
  $query = "SELECT drugcode,tradname,genname,salepri,unit,totalstk,rxrate,part FROM druglst  WHERE drugcode= '11neph' ";

     $result = mysql_query($query)
        or die("Query failed");

    $num=0;
    while (list ($drugcode,$tradname,$genname,$salepri,$unit,$totalstk,$rxrate,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
          }

   include("unconnect.inc");
?>

</table>

 