<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>�ѭ�ա�ë���������Ǫ�ѳ��  ��Ш���͹ $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a><br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ������</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ţ������觫���</th>
  <th bgcolor=6495ED><font face='Angsana New'>����ѷ������ҧ�����ǹ�ӡѴ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�Թ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ţ�����觢ͧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����Ѻ�ͧ</th>
   <th bgcolor=6495ED><font face='Angsana New'>�ѹ�����ҹ����Ѻ��</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");

    $query = "SELECT date,docno,comname,price,billno,getdate,stkbak,packamt FROM combill WHERE date LIKE '$yym%' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;
  

    while (list ($billdate,$docno,$comname,$price,$billno,$getdate,          $stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "�����Ť�ҫ���������Ǫ�ѳ�������  $netprice �ҷ";
?>
</table>
