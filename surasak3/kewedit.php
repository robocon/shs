��Ƿ���� number&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>
<a  href='runnoupdate1.php' onclick='return confirm("�к��зӡ�� Reset ��Ƿ�����\n��ͧ��÷ӧҹ������������?");'>��䢤�Ƿ�����</a>
<?php    
	include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��¡��</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>FIX</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>RUN</b></th>";
 


	print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���</b></th>";
    print "</tr>";

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
   


    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew1' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew2' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
   

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew3' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
   

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew5' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew6' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
   

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kew7' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
   

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewolder' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php?title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>

<BR>
��Ǥ�չԡ�����
<BR>
<?php
 
    print "number$Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< �����</a><br>";
    include("connect.inc");
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>��¡��</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>FIX</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>RUN</b></th>";
 


print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>���</b></th>";
     print "</tr>";

    $query = "SELECT  title,prefix,runno FROM runno where title = 'keweye' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewmed' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }


    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewsurg' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewogb' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewent' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewchild' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'kewortho' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    

    $query = "SELECT  title,prefix,runno FROM runno where title = 'chekup' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">���</td>\n".

 
           " </tr>\n");
        }
    print "</table>";

    include("unconnect.inc");
?>