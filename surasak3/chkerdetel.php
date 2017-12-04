<table>
 <tr>
  <th bgcolor=6495ED>ÅÓ´Ñº</th>
  <th bgcolor=6495ED>hn</th>
  <th bgcolor=6495ED>vn</th>
  <th bgcolor=6495ED>ª×èÍ-Ê¡ØÅ</th>
  <th bgcolor=6495ED>âÃ¤OPD</th>
  <th bgcolor=6495ED>âÃ¤ER</th>
 </tr>

<?php
If (!empty($erdiag)){
    include("connect.inc");
  $query="CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$yrmonth%' and erok = 'Y' ";
    $result = mysql_query($query) or die("Query failed,opday");

    $query = "SELECT hn,vn,ptname,diag,erdiag,thdatehn FROM opday1 WHERE erdiag = '$erdiag'";
    $result = mysql_query($query)
        or die("query failed,opcard");
 $n=0;
    while (list ($hn,$vn,$ptname,$diag,$erdiag,$thdatehn) = mysql_fetch_row ($result)) {
  $n++;
        print (" <tr>\n".

   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"erdiagedit.php? cHn=$hn&cthdatehn=$thdatehn&cVn=$vn\">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA>$vn</td>\n".
           "  <td BGCOLOR=66CDAA>$ptname</td>\n".
       "  <td BGCOLOR=66CDAA>$diag</td>\n".
           "  <td BGCOLOR=66CDAA>$erdiag</td>\n".
                   " </tr>\n");
       }
include("unconnect.inc");
       }
?>
</table>
