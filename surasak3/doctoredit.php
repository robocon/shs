<?php
 
/*
 
*/
    print "��ª���ᾷ�� &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>����ᾷ��</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>ʶҹ�</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>codeἹ�</b></th>";
 print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���</b></th>";
//  print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
  //  print " <th bgcolor=CD853F><font face='Angsana New'><b>ź��¡��</b></th>";
    print "</tr>";

    $query = "SELECT name,status,menucode FROM doctor order by name ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($name,$status,$menucode) = mysql_fetch_row ($result)) {

if($status=='n'){$color='#FF6666';}else{$color='F5DEB3';};

        print ("<tr>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$name</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$status</td>\n".
           "  <td BGCOLOR=$color><font face='Angsana New'>$menucode</td>\n".
        "  <td BGCOLOR=$color><font face='Angsana New'></td>\n".
        "  <td bgcolor=$color><font face='Angsana New'><a target=_BLANK href=\"doctoredit1.php? idname=$idname\" >���</td>\n".
 //       "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
    // "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"inputmdele.php? idname=$idname\" >ź</td>\n".
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

