<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print "�ӹǹ������ᾷ�� ���͡��ҹ���ҧ  �� $today ������ <br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>

<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-01";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-02";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-03";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-04";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-05";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-06";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-07";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-08";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-09";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-10";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-11";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
    $today="2548-12";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$today%' and doctor like '%��ҹ���ҧ%' and an is null ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>�� 2548  ��͹  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM opday1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
   $result = mysql_query($query);
     $n=0;
 while (list ($doctor,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$doctor&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>�ӹǹ������&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;��</td>\n".
               " </tr>\n<br>");
               }
 print "<b>�ӹǹ�����·�����.... $num..��</b></a><br> ";
   include("unconnect.inc");
?>
