<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ����ѡ�Ҿ�Һ�ż�����CSCD";
  //  print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
   // print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<�����</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>���ͼ�����</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
<th bgcolor=6495ED><font face='Angsana New'>AN</th>
<th bgcolor=6495ED><font face='Angsana New'>VN</th>
    <th bgcolor=6495ED><font face='Angsana New'>�Ţ�ѵü�����</th>
 
 <th bgcolor=6495ED><font face='Angsana New'>����Ѻ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ԹԨ����ä</th>
  <th bgcolor=6495ED><font face='Angsana New'>������</th>
  <th bgcolor=6495ED><font face='Angsana New'>����͡�����</th>
  <th bgcolor=6495ED><font face='Angsana New'>���������Ѻ</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѡ������</th>
<th bgcolor=6495ED><font face='Angsana New'>��Һ�ԡ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>

  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,vn,note,diag,patho,xray,phar,emer,surg,physi,denta,other,doctor,idcard FROM opday WHERE thidate LIKE '$today%' and ptright LIKE 'R03%'  ORDER by an ";
    $result = mysql_query($query)
        or die("Query failed");
    $n=0;
 $totalpri=0;
    while (list ($ptname,$hn,$an,$vn,$note,$diag,$patho,$xray,$phar,$emer,$surg,$physi,$denta,$other,$doctor,$idcard) = mysql_fetch_row ($result)) {
        $n++;	

$free=0;
//      $time=substr($thidate,11);
        $etc=$emer+$surg+$physi+$denta+$other;
        $netprice=$patho+$xray+$phar+$etc;

if($phar>0){$netprice=$netprice+50;};

if($phar>0){$free=$free+50;};

   $totalpri=$totalpri+$netprice;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
 "	<td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
 "	<td BGCOLOR=66CDAA><font face='Angsana New'>$vn</td>\n".
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
          
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$note</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$patho</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xray</td>\n".
           "  <td BGCOLOR=77CD00><font face='Angsana New'>$phar</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$etc</td>\n".
"  <td BGCOLOR=66CDAA><font face='Angsana New'>$free</td>\n".
           "  <td BGCOLOR=00CDAA><font face='Angsana New'>$netprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
           " </tr>\n");
       }
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ";
    include("unconnect.inc");
?>
</table>



