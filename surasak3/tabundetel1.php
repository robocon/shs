<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$yrmonth%'  ";
    $result = mysql_query($query) or die("Query failed,opday");


  print "รายงานประจำ  $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT  toborow ,COUNT(*) AS duplicate FROM opday1 GROUP BY toborow HAVING duplicate > 0 ORDER BY toborow";
   $result = mysql_query($query);
     $n=0;
	 $sum=0;
 while (list ($toborow,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbdetel.php?toborow=".urlencode($toborow)."&today=$yrmonth\">$toborow&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน = $duplicate</td>\n".
               " </tr>\n<br>");
			   $sum = $sum + $duplicate;
               }

print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>รวมทั้งหมด</td>\n".
               "  <td BGCOLOR=66CDAA colspan=\"2\">$sum</td>\n".
               " </tr>\n<br>");

   include("unconnect.inc");
?>


