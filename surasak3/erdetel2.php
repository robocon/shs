<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$yrmonth%'and erok = 'Y'  ";
    $result = mysql_query($query) or die("Query failed,opday");


  print "รายงานประจำ เดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT  erdiag ,COUNT(*) AS duplicate FROM opday1 GROUP BY erdiag HAVING duplicate > 0 ORDER BY erdiag";
   $result = mysql_query($query);
     $n=0;
 while (list ($erdiag,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chkerdetel.php? erdiag=$erdiag&yrmonth=$yrmonth\">$erdiag&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>


