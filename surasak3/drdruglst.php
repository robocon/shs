<?php
    session_start();
    $cDrname=substr($sOfficer,6);
    print"�ѭ������ǹ��Ǣͧ ��.$cDrname<br>";
    print "<font face='Angsana New' size='3'>���,�������  �Ը����� �ӹǹ��紷�����&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�������ѭ</th>
  <th bgcolor=6495ED><font face='Angsana New'>˹���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѭ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=CD853F><font face='Angsana New'>�����Ը���</th>
  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ���</th>
  <th bgcolor=6495ED><font face='Angsana New'>���</th>
  <th bgcolor=6495ED><font face='Angsana New'>ź���</th>
 </tr>

<?php
    include("connect.inc");
    $n=0;
    $cDoctor=substr($sOfficer,0,5);
    $query = "SELECT drugcode,tradname,genname,unit,salepri,part,drugtype,slcode,amount,doctor,row_id FROM drdglst
                    WHERE doctor ='$cDoctor' ";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$genname,$unit,$salepri,$part,$drugtype,$slcode,$amount,$doctor,$row_id) =     mysql_fetch_row ($result)) {
        $n++;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$genname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unit</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$part</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugtype</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$slcode</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"drdgedit.php? Dgcode=$drugcode\">���</a></td>\n".
           "  <td BGCOLOR=66CDAA><a href=\"drdgdele.php? Delrow=$row_id\">ź���</a></td>\n". 	
           " </tr>\n");
          }
   include("unconnect.inc");
?>
</table>



