<?php
    $yrmonth="$thiyr-$rptmo";
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE dxgroup SELECT * FROM opday WHERE thidate LIKE '$yrmonth%'";
    $result = mysql_query($query) or die("Query failed,opday");
//    echo mysql_errno() . ": " . mysql_error(). "\n";
//    echo "<br>";

    print "1. ��§ҹ�ӹǹ�����¹͡��ṡ��� 21 ������ä <a target=_self  href='../nindex.htm'><<�����</a><br> ";
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>������ä</th>";
    print "  <th bgcolor=6495ED>������ �</th>";
    print "  <th bgcolor=6495ED>������ �</th>";
    print "  <th bgcolor=6495ED>������ �</th>";
    print "  <th bgcolor=6495ED>���(��)</th>";
    print " </tr>";
//
//
//

        print("<tr>\n".
                "<td bgcolor=66CDAA>$n</td>\n".
                "<td bgcolor=66CDAA>$G1</td>\n".
                "<td bgcolor=66CDAA>$G2</td>\n".    
                "<td bgcolor=66CDAA>$G3</td>\n".
                "<td bgcolor=66CDAA>$G123</td>\n".  
                " </tr>\n");
                        } ;


include("unconnect.inc");
?>
