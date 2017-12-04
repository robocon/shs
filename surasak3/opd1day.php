<?php
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	print "<b>สรุปจำนวนโรค ของวันที่ $appd</b>";
	print "&nbsp;&nbsp;<a target=_self  href='opdperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;<br></a>";
    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
$num= '0';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday9 SELECT * FROM opday WHERE thidate LIKE '$appd%' ";
    $result = mysql_query($query) or die("Query failed,app");
$query="SELECT diag ,COUNT(*) AS duplicate FROM opday9 GROUP BY diag HAVING duplicate > 0 ORDER BY duplicate";
   $result = mysql_query($query);
     $n=0;
 while (list ($toborow,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$toborow&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
**********************************************************<br>
<?php
	$appd=$appdate.'-'.$appmo.'-'.$thiyr;
	print "<b>สรุปจำนวนโรคตาม ICD10 ของวันที่ $appd</b>";
	print "&nbsp;&nbsp;<a target=_self  href='opdperday.php'><<&#3652;&#3611;&#3648;&#3617;&#3609;&#3641;</a>";
    $appd=$thiyr.'-'.$appmo.'-'.$appdate;
$num= '0';
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday9 SELECT * FROM opday WHERE thidate LIKE '$appd%' ";
    $result = mysql_query($query) or die("Query failed,app");
$query="SELECT icd10 ,COUNT(*) AS duplicate FROM opday9 GROUP BY icd10 HAVING duplicate > 0 ORDER BY duplicate";
   $result = mysql_query($query);
     $n=0;
 while (list ($toborow,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA>$toborow&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }
 print "จำนวนผู้ป่วยทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>




