<?php
    $today="$d-$m-$yr";
    print "�ѹ��� $today  ����ѡ�Ҿ�Һ�ż����·�����";
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
   <th bgcolor=6495ED><font face='Angsana New'>�ԹԨ����ä</th>
  <th bgcolor=6495ED><font face='Angsana New'>���</th>
  <th bgcolor=6495ED><font face='Angsana New'>�͡�����</th>
 <th bgcolor=6495ED><font face='Angsana New'>�ء�Թ</th>
 <th bgcolor=6495ED><font face='Angsana New'>����Ҿ</th>
<th bgcolor=6495ED><font face='Angsana New'>��ҵѴ</th>
 <th bgcolor=6495ED><font face='Angsana New'>�ѹ�����</th>

 <th bgcolor=6495ED><font face='Angsana New'>�ѡ������</th>

  <th bgcolor=6495ED><font face='Angsana New'>������Ѻ</th>
<th bgcolor=6495ED><font face='Angsana New'>��Һ�ԡ��</th>
   <th bgcolor=6495ED><font face='Angsana New'>����Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ᾷ��</th>

  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,note,diag,patho,xray,phar,emer,surg,physi,denta,other,doctor,idcard FROM opday WHERE thidate LIKE '$today%'";
    $result = mysql_query($query)
        or die("Query failed");
    $n=0;
 $totalpri=0;
    while (list ($ptname,$hn,$an,$note,$diag,$patho,$xray,$phar,$emer,$surg,$physi,$denta,$other,$doctor,$idcard) = mysql_fetch_row ($result)) {
        $n++;	
//      $time=substr($thidate,11);
$num1=0;
$num2=50;

$free=0;

        $etc=$emer+$surg+$physi+$denta+$other;
        $netprice=$patho+$xray+$phar+$etc;

if($phar>0){$netprice=$netprice+50;};

if($phar>0){$free=$free+50;};

   $totalpri=$totalpri+$netprice;


 $totalemer=$totalemer+$emer;
 $totalsurg=$totalsurg+$surg;
 $totalphysi=$totalphysi+$physi;
 $totaldenta=$totaldenta+$denta;
 $totalpatho=$totalpatho+$patho;
 $totalxray=$totalxray+$xray;
 $totalphar=$totalphar+$phar;
 $totalother=$totalother+$other;
 $totalfree=$totalother+$free;

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
 	"	<td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
// "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
       
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$note</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$patho</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xray</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$emer</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$surg</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$physi</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$denta</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$other</td>\n".
 "  <td BGCOLOR=66CD55><font face='Angsana New'>$phar</td>\n".
"  <td BGCOLOR=77CD00><font face='Angsana New'>$free</td>\n".

 "  <td BGCOLOR=77CD00><font face='Angsana New'>$netprice</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
           " </tr>\n");
       }
   print "�������ѡ�Ҿ�Һ�ŷ�����  $totalpri �ҷ <br>" ;
 print "�����Һ�ԡ����ͧ�ء�Թ $totalemer �ҷ <br>";
 print "��������ͧ��ҵѴ  $totalsurg �ҷ <br>";
 print "�����ҡ���Ҿ  $totalphysi �ҷ <br>";
 print "�����ҷѹ�����  $totaldenta �ҷ <br>";
 print "�����Ҿ�Ҹ� $totalpatho �ҷ <br>";
 print "�������͡����� $totalxray �ҷ <br>";

 print "�������� $totalphar �ҷ <br>";
 print "�����Һ�ԡ�� $totalfree �ҷ <br>";
 print "���������� $totalother �ҷ <br>";
    include("unconnect.inc");
?>
</table>



