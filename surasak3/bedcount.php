<?php
    
   $bed2 = '41';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE bed1 SELECT * FROM bed WHERE bedcode LIKE '$bed2%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "��§ҹ�ʹ��§�ͼ����ª��<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  bedname,ptname,COUNT(*) AS duplicate FROM bed1 GROUP BY bedname HAVING duplicate > 0 ORDER BY bedname";
   $result = mysql_query($query);
     $n=0;
 while (list ($bedname,$ptname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��ͧ</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>


<?php
    
   $bed2 = '42';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE bed1 SELECT * FROM bed WHERE bedcode LIKE '$bed2%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "��§ҹ�ʹ��§�ͼ�����˭ԧ<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  bedname,ptname,COUNT(*) AS duplicate FROM bed1 GROUP BY bedname HAVING duplicate > 0 ORDER BY bedname";
   $result = mysql_query($query);
     $n=0;
 while (list ($bedname,$ptname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��ͧ</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>


<?php
    
   $bed2 = '43';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE bed1 SELECT * FROM bed WHERE bedcode LIKE '$bed2%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "��§ҹ�ʹ��§�ͼ������ص�<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  bedname,ptname,COUNT(*) AS duplicate FROM bed1 GROUP BY bedname HAVING duplicate > 0 ORDER BY bedname";
   $result = mysql_query($query);
     $n=0;
 while (list ($bedname,$ptname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��ͧ</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>


<?php
    
   $bed2 = '44';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE bed1 SELECT * FROM bed WHERE bedcode LIKE '$bed2%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "��§ҹ�ʹ��§�ͼ�����˹ѡ<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  bedname,ptname,COUNT(*) AS duplicate FROM bed1 GROUP BY bedname HAVING duplicate > 0 ORDER BY bedname";
   $result = mysql_query($query);
     $n=0;
 while (list ($bedname,$ptname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��ͧ</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>

<?php
    
   $bed2 = '45';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE bed1 SELECT * FROM bed WHERE bedcode LIKE '$bed2%' ";
    $result = mysql_query($query) or die("Query failed,app");


  print "��§ҹ�ʹ��§�ͼ����¾����<a target=_self  href='../nindex.htm'><<�����</a><br> ";
   $query="SELECT  bedname,ptname,COUNT(*) AS duplicate FROM bed1 GROUP BY bedname HAVING duplicate > 0 ORDER BY bedname";
   $result = mysql_query($query);
     $n=0;
 while (list ($bedname,$ptname,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bedname&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��ͧ</td>\n".
               " </tr>\n<br>");
               }
 print "�ӹǹ�����·�����.... $num..��</a><br> ";
   include("unconnect.inc");
?>















