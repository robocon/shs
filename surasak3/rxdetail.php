<?php
    session_start();
    session_unregister("sPtname");
    session_unregister("cTrad");
    session_unregister("cAmt");
    session_unregister("cDcode");

    session_unregister("x");
    session_unregister("aDgcode");
    session_unregister("aTrade");
    session_unregister("aAmount");
    session_unregister("aSlipcode");

    $x=0;
    $aDgcode = array("������");
    $aTrade  = array("      ���͡�ä��");
    $aAmount = array("        �ӹǹ   ");
    $aSlipcode = array("        �Ը���   ");
    session_register("x");
    session_register("aDgcode");
    session_register("aTrade");
    session_register("aAmount");
    session_register("aSlipcode");

    $sPtname = '';
    session_register("sPtname");

    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM phardep WHERE row_id = '$nRow_id' "; 
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
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sEssd=$row->essd;
    $sNessdy=$row->nessdy;
    $sNessdn=$row->nessdn;
    $sDPY=$row->dpy;
    $sDPN=$row->dpn;     
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;
?>

<table>
 <tr>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>�ӹǹ</th>
  <th bgcolor=CD853F>�Ҥ�</th>
  <th bgcolor=CD853F>�Ը���</th>
  <th bgcolor=CD853F>���Ը���</th>
 </tr>

<?php
    $query = "SELECT tradname,amount,price,slcode,drugcode FROM drugrx WHERE idno = '$nRow_id' AND date = '".$_GET["sDate"]."' ";

    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "�ѹ��� $d/$m/$y<br>";
    print "$sPtname, HN: $sHn<br> ";
    print "�ä: $sDiag<br>";
//    print "ᾷ�� :$sDoctor<br><br>";

    while (list ($tradname,$amount,$price,$slcode,$drugcode) = mysql_fetch_row ($result)) {
        $x++;
        $aDgcode[$x]=$drugcode;
        $aTrade[$x]=$tradname;
        $aSlipcode[$x]=$slcode;        
        $aAmount[$x]=$amount;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"slipprint.php? cSlcode=$slcode&cDrugcode=$drugcode& cTradname=$tradname&cAmount=$amount\">$slcode</a></td>\n".
           "  <td BGCOLOR=F5DEB3><a target=_blank  href=\"rxslip.php? cDrugcode=$drugcode& cTradname=$tradname&cAmount=$amount\">���Ը���</a></td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>
<?php
    print "����Թ  $sNetprice �ҷ<br>";
    print "ᾷ�� :$sDoctor<br><br>";
?>
    <a target=_BLANK href="slipsprn.php">�������ҡ�ҷ�����</a><br><br><a target=_BLANK href="slipsprn1.php">�������ҡ��������������</a>
	<br><a target=_BLANK href="slipsprn1.1.php">�������ҡ�Ҽ������(��ҡ���)</a>
	<BR><BR><A HREF="drugbill.php?hn=<?php echo $sHn;?>&row_id=<?php echo $_GET["nRow_id"]?>" target="_blank">�����������</A>


