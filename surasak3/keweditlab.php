<?php
 
/*
 
*/
  print "<a  href=runnoupdate2.php> เชต 0 </a>".
  
print "number$Thaidate &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><< ไปเมนู</a><br>";
    include("connect.inc");
	echo "<div>Datetime เครื่อง SERVER : ".date("Y-m-d H:i:s")."</div>";
    print "<table>";
    print "<tr>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>รายการ</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>FIX</b></th>";
	print "<th bgcolor=CD853F><font face='Angsana New'><b>STARTDAY</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>RUN</b></th>";
 


print "<th bgcolor=CD853F><font face='Angsana New'><b>........</b></th>";
    print "<th bgcolor=CD853F><font face='Angsana New'><b>แก้ไข</b></th>";
     print "</tr>";

    $query = "SELECT  title,prefix,runno,startday FROM runno where title = 'lab' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($title,$prefix,$runno,$startday) = mysql_fetch_row ($result)) {
        print ("<tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$title</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$prefix</td>\n".
		    "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$startday</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$runno</td>\n".
         

 "  <td BGCOLOR=F5DEB3><font face='Angsana New'></td>\n".
        "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"runnoedit1.php? title=$title\">แก้ไข</td>\n".

 
           " </tr>\n");
        }
    print "</table>";
    include("unconnect.inc");
?>

