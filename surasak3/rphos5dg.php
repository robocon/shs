<?php
    print  "<font face='Angsana New'><b>����¹���������Ǫ�ѳ��(�.�.5)  ��§ҹ���������</b><br> ";
?>
  <form method="post" action="<?php echo $PHP_SELF ?>">
<font face="Angsana New"><a target=_BLANK href="drugcode.php">������ ?</a>
&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" name="drugcode" size="10"></font>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     ��ŧ     " name="B1">
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< �����</a></font></p>
</form>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>�ѹ����Ѻ-����</th>
  <th bgcolor=6495ED><font face='Angsana New'>����͡���</th>

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
$drugcode = $_POST['drugcode'];
$Dgcode = $_GET['Dgcode'];
if (isset($Dgcode)){
    $drugcode = $Dgcode;
}

If (!empty($drugcode)){
    include("connect.inc");
    $query = "SELECT drugcode,tradname,genname,unit,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$drugcode' ";
    $result = mysql_query($query) or die("Query failed");

    for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
        if (!mysql_data_seek($result, $i)) {
            echo "Cannot seek to row $i\n";
            continue;
        }

        if(!($row = mysql_fetch_object($result)))
            continue;
    }

    if(mysql_num_rows($result)){
        $dcode=$row->drugcode;
        $tname=$row->tradname;
        $nstock=$row->stock;
        $nmainstk=$row->mainstk;
        $ntotalstk=$row->totalstk;	
        $cUnit  = $row->unit;
    } else {
        die("��辺���� $drugcode <a target=_self  href='../nindex.htm'><�����</a>");
    }

    print "<font face='Angsana New'>����:$drugcode, ���͡�ä��:$tname, �������ѭ:$tname <br>";
    print "<font face='Angsana New'>㹤�ѧ.......... $nmainstk  $cUnit<br>";
    print "���ͧ����..... $nstock<br>";
    print "�շ�����....... $ntotalstk<br>";
    print "<a href='rphos5dg_print.php?dg=$drugcode' target='_blank'>��������¹���������Ǫ�ѳ��</a>";
    ///////////
    $query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk 
    FROM stktranx  
    WHERE drugcode = '$drugcode' 
    and status ='y' 
    ORDER BY getdate ";
    $result = mysql_query($query) or die("Query failed");
    $num = 0;
    while (list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,
              $amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result)) {
        
        $num++;
        $netprice  =$unitpri*$amount;
        $stkcutpri =$unitpri*$stkcut;
        $netlotpri =$unitpri*$netlotno;
        $mainstkpri =$unitpri*$mainstk;

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".


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

 