<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>����¹���������Ǫ�ѳ�� (�.�.5) ��§ҹ��͹ $yym  (���§�������)</b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< �����</a><br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����Ѻ-����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����͡���</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>LotNo</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ѻ�ҡ-�������</th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ҥҷع/˹���</th>

  <th bgcolor=6495ED><font face='Angsana New'>�Ѻ�ӹǹ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�Թ</th>

  <th bgcolor=CC9900><font face='Angsana New'>���¨ӹǹ</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ӹǹ�Թ</th>

  <th bgcolor=6495ED><font face='Angsana New'>����ͨӹǹ</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ӹǹ�Թ</th>

  <th bgcolor=CC9900><font face='Angsana New'>�����㹤�ѧ</th>
  <th bgcolor=CC9900><font face='Angsana New'>���Թ(㹤�ѧ)</th>
  <th bgcolor=CC9900><font face='Angsana New'>���ͧ������</th>
  <th bgcolor=CC9900><font face='Angsana New'>������ط��</th>
 </tr>

<?php
If (!empty($yym)){
    $num=0;
    include("connect.inc");

    $query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk FROM stktranx  WHERE getdate LIKE '$yym%' ORDER BY drugcode ";
     $result = mysql_query($query)
        or die("Query failed");

    while (list($getdate,$billno,$drugcode,$lotno,$department,
              $unitpri,$amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result)) {
	$num++;
	$netprice  =$unitpri*$amount;
	$stkcutpri =$unitpri*$stkcut;
	$netlotpri =$unitpri*$netlotno;
	$mainstkpri =$unitpri*$mainstk;

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$department</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$unitpri</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$netprice</td>\n".

           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$stkcut</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$stkcutpri</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$netlotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$netlotpri</td>\n".

           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$mainstk</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$mainstkpri</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$stock</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$totalstk</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>
</table>
