<?php
    $today="$d-$m-$yr";
    
  //  print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
   // print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>


<table>
<tr>
	<th align="center" colspan="12"><font face='Angsana New'>�ѹ�֡�����»�Сѹ�آ�Ҿ��ǹ˹�� ��Ш���͹ <?php echo $m." - ".$yr;?></th>
</tr>
 <tr>
<th bgcolor=6495ED><font face='Angsana New'>�ӴѺ</th>
<th bgcolor=6495ED><font face='Angsana New'>�ѹ�ѡ��</th>
<th bgcolor=6495ED><font face='Angsana New'>�Ţ�ѵ÷ͧ</th>
<th bgcolor=6495ED><font face='Angsana New'>��-����-ʡ��</th>
<th bgcolor=6495ED><font face='Angsana New'>�Ţ�ѵû�ЪҪ�</th>
<th bgcolor=6495ED><font face='Angsana New'>���Ǫ�ѳ��</th>
<th bgcolor=6495ED><font face='Angsana New'>��Ҹ�</th>
<th bgcolor=6495ED><font face='Angsana New'>�͡�����</th>
<th bgcolor=6495ED><font face='Angsana New'>�ء�Թ/���</th>
<th bgcolor=6495ED><font face='Angsana New'>�ѹ�����</th>
<th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
<th bgcolor=6495ED><font face='Angsana New'>�ԹԨ����ä</th>
<th bgcolor=6495ED><font face='Angsana New'>�����˵�</th>
  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT date_format(a.thidate,'%d/%m/%y'), a.ptname,a.hn,a.an,a.note,a.diag,a.patho,a.xray,a.phar,a.emer,a.surg,a.physi,a.denta,a.other,a.doctor,idcard FROM (Select  * From opday WHERE thidate LIKE '$today%' AND left(ptright,3) IN ('R09','R10','R11','R13','R17') ) as a  Order by thidate ASC ";

    $result = mysql_query($query)
        or die("Query failed");
    $n=0;
 $totalpri=0;
    while (list ($thidate,$ptname,$hn,$an,$note,$diag,$patho,$xray,$phar,$emer,$surg,$physi,$denta,$other,$doctor,$idcard) = mysql_fetch_row ($result)) {
        $n++;	

//$free=0;
        
$totalpri=$phar+$patho+$xray+$emer+$other+$denta;

//if($phar>0){$netprice=$netprice+50;};

//if($phar>0){$free=$free+50;};

//   $totalpri=$totalpri+$netprice;
        print (" <tr>\n".
					"  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
					"  <td BGCOLOR=66CDAA><font face='Angsana New'>$thidate</td>\n".
					"  <td BGCOLOR=66CDAA><font face='Angsana New'>&nbsp;</td>\n".
					"	<td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
					"	<td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
					"  <td BGCOLOR=66CDAA align='right' ><font face='Angsana New'>$phar</td>\n".
					"  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>$patho</td>\n".
					"  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>$xray</td>\n".
					"  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>".($emer+$other)."</td>\n".
					"  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>$denta</td>\n".
					"  <td BGCOLOR=66CDAA align='right'><font face='Angsana New'>$totalpri</td>\n".
					"  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
					"  <td BGCOLOR=66CDAA><font face='Angsana New'>$note</td>\n".
					
           " </tr>\n");
       }
	 print "</table>";
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>



