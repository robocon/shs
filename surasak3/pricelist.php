<?php
    $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
    include("connect.inc");

    print "�ѭ���ҤҤ�Һ�ԡ�� $Thaidate <a target=_self  href='../nindex.htm'><<�����</a><br> ";
    print "1.��¡�õ�Ǩ��ͧ��Ҹ�<br>";
    print "2.��Һ�ԡ�÷ҧ��þ�Һ��<br>";
    print "3.��¡�õ�Ǩ��ͧ��硫����<br>";
    print "4.��Һ�ԡ����ͧ��ҵѴ<br>";
    print "5.��Һ�ԡ����ͧ�ء�Թ<br>";
    print "6.��Һ�ԡ�÷ҧ�ѹ�����<br>";
    print "7.��Һ�ԡ�á���Ҿ�ӺѴ<br>";
    print "8.��Һ�ԡ��������͡���Ե<br>";
    print "9.��Һ�ԡ������<br>";
    print "*****************<br>";

//1.��¡�õ�Ǩ��ͧ��Ҹ�
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>1. ��¡�õ�Ǩ��ͧ��Ҹ�</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
	 print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part,oldcode FROM labcare WHERE depart = 'PATHO' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part,$oldcode) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
			   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$oldcode</td>\n".
           " </tr>\n");
         }
//2.��Һ�ԡ�÷ҧ��þ�Һ��
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>2. ��Һ�ԡ�÷ҧ��þ�Һ��</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
      print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'WARD' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//3.��¡�õ�Ǩ��ͧ��硫����
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>3. ��¡�õ�Ǩ��ͧ��硫����</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
     print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
   print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'XRAY' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//4.��Һ�ԡ����ͧ��ҵѴ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>4. ��Һ�ԡ����ͧ��ҵѴ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
   print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'SURG' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//5.��Һ�ԡ����ͧ�ء�Թ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>5. ��Һ�ԡ����ͧ�ء�Թ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'EMER' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//6.��Һ�ԡ�÷ҧ�ѹ�����
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>6. ��Һ�ԡ�÷ҧ�ѹ�����</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'DENTA' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//7.��Һ�ԡ�á���Ҿ�ӺѴ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>7. ��Һ�ԡ�á���Ҿ�ӺѴ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'PHYSI' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//8.��Һ�ԡ��������͡���Ե
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>8. ��Һ�ԡ��������͡���Ե</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'HEMO' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
//9.��Һ�ԡ������
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>9. ��Һ�ԡ������</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>#</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>����</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>�ԡ��</th>";
    print "  <th bgcolor=6495ED><font face='Angsana New'>Ἱ�</th>";
   print "  <th bgcolor=6495ED><font face='Angsana New'>�����</th>";
    print "  </tr>";

    $num=0;
    $query = "SELECT code,detail,price,yprice,depart,part FROM labcare WHERE depart = 'OTHER' ORDER BY code ASC ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($code, $detail, $price,$yprice,$depart,$part) = mysql_fetch_row ($result)) {
        $num++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$code</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$yprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$depart</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }

    print "</table>";
    include("unconnect.inc");
    print " <a target=_self  href='../nindex.htm'><<�����</a><br> ";
?>

