<?php
    session_start();
    print  "<font face='Angsana New'><b>[ONE DAY]</b>...��¡������ѹ���  &nbsp;&nbsp;&nbsp;<a  href='statall.php'>(����¡�÷��	���)</a><BR><a target=_blank href='statrxa.php'>�ԡ������Ǫ�ѳ��</a> ";
?>
<table>
 <tr>
  <th bgcolor=CC9966><font face='Angsana New'>#</th>
   <th bgcolor=CC9966><font face='Angsana New'>�ѹ���</th>
   <th bgcolor=CC9966><font face='Angsana New'>��¡��</th>
   <th bgcolor=CC9966><font face='Angsana New'>˹��¹Ѻ</th>
   <th bgcolor=CC9966><font face='Angsana New'>�Ը���</th>
   <th bgcolor=CC9966><font face='Angsana New'>�ӹǹ</th>
   <th bgcolor=CC9966><font face='Angsana New'>ʶҹ�</th>
   <th bgcolor=CC9966><font face='Angsana New'>���?</th>
 </tr>
<?php
    $today = date("d-m-Y");   
    $d=substr($today,0,2);
    $m=substr($today,3,2);
    $yr=substr($today,6,4) +543;  

    $dToday=$yr.'-'.$m.'-'.$d;
    $n=0;
    include("connect.inc");
        //an,part,idno,totalamt,totalpri,statcon,onoff,officer 
        $query = "SELECT   date,tradname,unit,slcode,amount,onoff,row_id 
                         FROM dgprofile  WHERE  date LIKE '$dToday%' and statcon='STAT' and an='$cAn' and onoff='ON'  ORDER BY date  ";  
        $result = mysql_query($query) or die("Query failed");
        while (list ($date,$tradname,$unit,$slcode,$amount,$onoff,$row_id
	) = mysql_fetch_row ($result)) {
            $n++;
            $date=substr($date,0,10);
            print (" <tr>\n".
               "  <td bgcolor=CCCC99>$n</td>\n".
               "  <td bgcolor=CCCC99><font face='Angsana New'>$date</td>\n".
               "  <td BGCOLOR=CCCC99><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=CCCC99><font face='Angsana New'>$unit</td>\n".
               "  <td BGCOLOR=CCCC99><font face='Angsana New'>$slcode</td>\n".
               "  <td BGCOLOR=CCCC99><font face='Angsana New'>$amount</td>\n".
               "  <td BGCOLOR=CCCC99><font face='Angsana New'>$onoff</td>\n".
               "  <td bgcolor=CCCC99><font face='Angsana New'><a target=_BLANK href=\"drugoff.php? 		Delrow=$row_id\">���</td>\n".
               " </tr>\n");
               }
   include("unconnect.inc");
?>
</table>


 