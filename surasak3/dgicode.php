<?php
    echo "�������Ǫ�ѳ��";
?>
<table>
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>����</th>
  <th bgcolor=CC9900><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ع</th>
  <th bgcolor=CC9900><font face='Angsana New'>���</th>
  <th bgcolor=CC9900><font face='Angsana New'>����(%)</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ԡ��?</th>
 </tr>
<?php
    include("connect.inc");
    $query = "SELECT drugcode,tradname,unitpri,salepri,part FROM druglst ORDER BY drugcode ASC";
    $result = mysql_query($query)
        or die("Query failed");

    while (list ($drugcode, $tradname,$unitpri,$salepri,$part) = mysql_fetch_row ($result)) {
        if ($unitpri <>0 and $salepri <> 0 ){
            $profit=($salepri - $unitpri)*100/$unitpri;
            $profit=number_format($profit,1);
		}
        else {
	$xUnitpri =0;
	$xSalepri=0;
	$profit=0;
	}
        print (" <tr>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'><a target='left'  href=\"dgipaste.php? dcode=$drugcode\">$drugcode</a></td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unitpri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$profit</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n".
           " </tr>\n");
         }
    include("unconnect.inc");
?>
</table>

