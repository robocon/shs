<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE drugrx1 SELECT * FROM drugrx WHERE date LIKE '$yrmonth%' ";
    $result = mysql_query($query) or die("Query failed,opday");


  print "รายงานประจำ เดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT  drugcode,tradname,amount ,COUNT(*) AS duplicate FROM drugrx1 GROUP BY drugcode HAVING duplicate > 0 ORDER BY drugcode";
   $result = mysql_query($query);
     $n=0;
 while (list ($drugcode,$detail,$amount,$duplicate) = mysql_fetch_row ($result)) {
            $n++;

            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chkphadetel.php? drugcode=$drugcode&yrmonth=$yrmonth\">$drugcode&nbsp;&nbsp;</a></td>\n".
 
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน$duplicate คน</td>\n".


               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>


