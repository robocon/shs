<?php
   session_start();
    include("connect.inc");
    $query = "SELECT history FROM opcard WHERE hn = '$cHn'";
    $result = mysql_query($query)
        or die("Query failed,opcard");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

   $cPastHx=$row->history;
   include("unconnect.inc");

   $cDiag="";
   print"<font face='Angsana New'><b>��Ǩ�ѡ�Ҽ����¹͡ &nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a></b><br>";
   print "<font face='Angsana New'>VN:$tvn HN :$cHn  $cPtname |<br> �Է��: $cPtright";
  // print "<textarea rows='8' name='report' cols='55'>$cPastHx</textarea>";

   print"<form method='POST' action='doprx.php'>";
        print"<textarea rows='10' name='history' cols='55'>$cNewHx</textarea>";
print"<br><a target=_BLANK href='dopok1.php'>�ٻ���ѵԡ���ѡ��</a> &nbsp;&nbsp;&nbsp; ";

        print"<br><a target= bottom href='investigate.php'>INVESTIGATION</a>";
        print"<br><a target=_BLANK href='diaghlp.htm'>DIAGNOSIS</a> :&nbsp;&nbsp;&nbsp; ";

        print"<input type='text' name='diag' size='20' value='$cDiag'>";
        print"<br><input type='submit' value='   ��! ������ԹԨ���   ' name='B1'></font></p>";
   print"</form>";
?>





