<?php
    print"��¡�����Ǫ�ѳ��㹤�ѧ�ͧ�ç��Һ�ŷ����� ���§������ʺ���ѷ<br> ";
	print"ź���? ���ź�͡�ҡ�ѭ�����Ǫ�ѳ��ͧ�ç��Һ��<br>";
?>
&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New'>ź���?</th>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
    <th bgcolor=6495ED><font face='Angsana New'>���ʺ���ѷ</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>���͡�ä��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ� ED</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ҤҢ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>����(%)</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ҧ�дѺ</th>
  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>��ͧ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>packing</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�/pack</th>
   <th bgcolor=6495ED><font face='Angsana New'>�Ҥ�+vat/pack</th>
 </tr>

<?php
    include("connect.inc");
        
	$query = "SELECT row_id, comcode,drugcode,tradname,unitpri,edpri,salepri,minimum,totalstk,mainstk,stock,rxrate,stkpmon,
		pack,packpri,packpri_vat,comname FROM druglst ORDER BY comcode ASC";  
        $result = mysql_query($query) or die("Query failed");
	$n=0;
	$profit=0;
while(list($row_id,$comcode,$drugcode,$tradname,$unitpri,$edpri,$salepri,$minimum,$totalstk,$mainstk,$stock,
	$rxrate,$stkpmon,$pack,$packpri,$packpri_vat,$comname) = mysql_fetch_row ($result)) { $n++;

	if ($salepri>0 and $unitpri>0){
 
		$profit=($salepri-$unitpri)/$unitpri*100;
		$profit=number_format($profit,1);
					}
	print (" <tr>\n".
		       "  <td bgcolor=F5DEB3><font face='Angsana New'><a target=_BLANK href=\"dgdele.php? Delrow=$row_id&Dgcode=$drugcode&Dgtrad=$tradname\">ź</td>\n".
               "  <td bgcolor=6495ED>$n</td>\n".
				   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$edpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$salepri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$profit</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$minimum</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pack</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri_vat</td>\n".
               " </tr>\n");
               }
   include("unconnect.inc");
?>

</table>
