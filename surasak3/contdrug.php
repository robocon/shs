<?php
    session_start();
  //  print  "<font face='Angsana New'><b>[CONTINUE]</b>...੾����¡�÷���� (ON)  &nbsp;&nbsp;&nbsp;<a  href='contall.php'>(����¡�÷��	���)</a>&nbsp;&nbsp;&nbsp;<a target=_blank href='contrxa.php'>�������ԡ��</a> ";
	print  "<font face='Angsana New'><b>[CONTINUE]</b>...੾����¡�÷���� (ON)  &nbsp;&nbsp;&nbsp;<a  href='contall.php'>(����¡�÷��	���)</a>&nbsp;&nbsp;&nbsp; ";
?>
<table>
 <tr>
  <th bgcolor=9999CC><font face='Angsana New'>#</th>
   <th bgcolor=9999CC><font face='Angsana New'>�ѹ���</th>
   <th bgcolor=9999CC><font face='Angsana New'>��¡��</th>
   <th bgcolor=9999CC><font face='Angsana New'>˹��¹Ѻ</th>
   <th bgcolor=9999CC><font face='Angsana New'>�Ը���</th>
   <th bgcolor=9999CC><font face='Angsana New'>�ӹǹ</th>
   <th bgcolor=9999CC><font face='Angsana New'>ʶҹ�</th>
   <th bgcolor=9999CC><font face='Angsana New'>�ѹ��� OFF</th>
   <th bgcolor=9999CC><font face='Angsana New'>���?</th>
 </tr>
<?php
    $n=0;
    include("connect.inc");
        //an,part,idno,totalamt,totalpri,statcon,onoff,officer
        $query = "SELECT   date,tradname,unit,slcode,amount,onoff,dateoff ,row_id
                         FROM dgprofile  WHERE an = '$cAn' and statcon='CONT' and onoff='ON' ORDER BY date ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($date,$tradname,$unit,$slcode,$amount,$onoff,$dateoff,$row_id
	) = mysql_fetch_row ($result)) {
            $n++;
            $date=substr($date,0,10);
            $dateoff=substr($dateoff,0,10);
            print (" <tr>\n".
               "  <td bgcolor=99CCCC>$n</td>\n".
               "  <td bgcolor=99CCCC><font face='Angsana New'>$date</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$unit</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$slcode</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$amount</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$onoff</td>\n".
               "  <td BGCOLOR=99CCCC><font face='Angsana New'>$dateoff</td>\n".
           //    "  <td bgcolor=99CCCC><font face='Angsana New'><a target=_BLANK href=\"drugoff.php? Delrow=$row_id\">���</td>\n".
               " </tr>\n");
               }
   include("unconnect.inc");
?>
</table>


 