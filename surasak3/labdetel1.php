<?php
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE patdata1 SELECT * FROM patdata WHERE date LIKE '$yrmonth%' and depart = 'patho' ";
    $result = mysql_query($query) or die("Query failed,opday");


  print "รายงานประจำ เดือน $yrmonth <a target=_self  href='../nindex.htm'><<ไปเมนู</a><br> ";
   $query="SELECT  code,detail ,COUNT(*) AS duplicate FROM patdata1 GROUP BY code HAVING duplicate > 0 ORDER BY code";
   $result = mysql_query($query);
     $n=0;
 while (list ($code,$detail,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chklabdetel.php? code=$code&yrmonth=$yrmonth\">$code&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนครั้ง = $duplicate</td>\n".
               " </tr>\n<br>");
               }

   include("unconnect.inc");
?>


