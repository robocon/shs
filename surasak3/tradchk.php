<?php
    print  "��Ǩ�ͺ���Ǫ�ѳ��㹤�ѧ�ҵ�� ���͡�ä��<br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="dgtrad.php">���͡�ä�� ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="tradname" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>����</th>
  <th bgcolor=6495ED><font face='Angsana New'>��¡��</th>

  <th bgcolor=CC9900><font face='Angsana New'>�ع</th>
  <th bgcolor=CC9900><font face='Angsana New'>���</th>
  <th bgcolor=CC9900><font face='Angsana New'>����(%)</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ԡ��?</th>

  <th bgcolor=6495ED><font face='Angsana New'>��������</th>
  <th bgcolor=6495ED><font face='Angsana New'>������ط��</th>
  <th bgcolor=6495ED><font face='Angsana New'>㹤�ѧ</th>
  <th bgcolor=6495ED><font face='Angsana New'>���ͧ��</th>
  <th bgcolor=6495ED><font face='Angsana New'>��/��͹</th>
  <th bgcolor=6495ED><font face='Angsana New'>�����?��͹</th>
 </tr>

<?php
If (!empty($tradname)){
    include("connect.inc");
    //runno  to find date established
    $query = "SELECT title,startday FROM runno WHERE title = 'RX1D'";
    $result = mysql_query($query)
        or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
         }

    $dStartday=$row->startday;

    $query = "SELECT drugcode,tradname,unitpri,salepri,part,rx1day,totalstk,mainstk,stock,rxrate,stkpmon FROM druglst  WHERE tradname LIKE '$tradname%' ";
     $result = mysql_query($query)
        or die("Query failed");
    print "<font face='Angsana New'>��������������Ѻ����� $dStartday (��ҵ�ͧ��õ�駤�� 0 价������ set 0 ��è�����)<br>";
    print "��/��͹ ����ѵ�ҡ�è��µ����͹ <br>";
    print "����� ? ��͹ ����ѧ���������������͹ (������ط��/�ѵ�ҡ�è��µ����͹)";
    while (list ($drugcode, $tradname,$unitpri,$salepri,$part,$rx1day,$totalstk,$mainstk,$stock,$rxrate,$stkpmon) = mysql_fetch_row ($result)) {
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
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".

           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$unitpri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$salepri</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$profit</td>\n".
           "  <td BGCOLOR=99CCFF><font face='Angsana New'>$part</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rx1day</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$mainstk</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stock</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$rxrate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkpmon</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
?>

</table>


 