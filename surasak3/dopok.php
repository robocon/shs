<?php
   session_start();
   print"<font face='Angsana New'><b>��Ǩ�ѡ�Ҽ����¹͡ &nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a></b><br>";
   print "<font face='Angsana New'>HN :$cHn ���� $cPtname  �Է��: $cPtright";
//   print"$cPastHx<br>";
   $cNewHx=$history;
//   print"$cNewHx<br>";
   $cDiag=$diag;
   $completeHx=$cPastHx.'<br>'.$cNewHx.'<br>Dx:'.$cDiag.'  <br>��.'.$sOfficer;
   print"$completeHx<br>";
   print "<textarea rows='8' name='report' cols='55'>$completeHx</textarea>";

    include("connect.inc");
        $query ="UPDATE opcard SET  history = '$completeHx'
	       WHERE hn= '$cHn' ";
        $result = mysql_query($query) or die("Query failed,update opcard");
   include("unconnect.inc");
?>

