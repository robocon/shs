<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print "จำนวนผู้ป่วยแพทย์ เลือกด่านสว่าง  ปี $today ทั้งหมด <br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>

<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-01";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-02";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-03";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-04";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-05";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-06";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-07";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-08";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-09";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-10";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-11";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
<?php
  $today="$d-$m-$yr";
$num= '0';
  //  print "<input type=button onclick='history.back()' value='<< กลับไป'>";
    $today="2547-12";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$today%' and doctor like '%ด่านสว่าง%'  ";
    $result = mysql_query($query) or die("Query failed,app");


  print " <B>ปี 2547  เดือน  $today </B><br> ";
   $query="SELECT doctor ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY doctor HAVING duplicate > 0 ORDER BY doctor";
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
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนผู้ป่วย&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "<b>จำนวนผู้ป่วยทั้งหมด.... $num..คน</b></a><br> ";
   include("unconnect.inc");
?>
