<?php
    session_start();
//    session_unregister("xNetpri");
//    $xNetpri=$sNetpri;
//    $Pocomrow=$nRow_id;
//    session_register("Pocomrow");
//    session_register("xNetpri");
    if (isset($sIdname)){} else {die;} //for security 

  include("connect.inc");
  $query = "delete from poitems where row_id ='$Delrow'";
  $result = mysql_query($query) or die("�������öź�ҡ poitems ��");

/// netprice=$xNetpri-$sPrice,
        $query ="UPDATE pocompany SET 
	    netprice=netprice-$sPrice,
                    items=items-1   
              WHERE  row_id='$Pocomrow' ";
        $result = mysql_query($query)
              or die("Query failed,update pocompany");
//        echo mysql_errno() . ": " . mysql_error(). "\n";
//        echo "<br>";
        print "ź�����¡�� ($sDrugcode) $sTradname";
///////


print"<table>";
print" <tr>";
print"  <th bgcolor=CD853F><font face='Angsana New'>#</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>����</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>��¡��</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>˹��¹Ѻ</th>";
print"   <th bgcolor=CD853F><font face='Angsana New'>��Ҵ��è�</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ�ҧ�дѺ</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ����ѧ</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ����VAT</th>";
print"   <th bgcolor=CD853F><font face='Angsana New'>�ӹǹ���</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>�Ҥ����</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>��</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>spec</th>";
print"  <th bgcolor=CD853F><font face='Angsana New'>ź</th>";
print" </tr>";

    $x=0;
    $sNetprice=0;


    $query = "SELECT drugcode,tradname,packing,pack,minimum,totalstk,packpri,amount,price,free,specno,row_id FROM poitems WHERE idno = '$Pocomrow' ";
    $result = mysql_query($query) or die("Query failed");
    while (list ($drugcode,$tradname,$packing,$pack,$minimum,$totalstk,$packpri,$amount,$price,$free,$specno,$row_id) = mysql_fetch_row ($result)) {
	$x++;
	$sNetprice=$sNetprice+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$x</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"packedit.php?  sRow_id=$row_id&sDrugcode=$drugcode\">$tradname</a></td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$pack</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$minimum</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$totalstk</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$free</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$specno</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New'><a target=_BLANK  href=\"poitemdel.php?  Delrow=$row_id&sDrugcode=$drugcode&sTradname=$tradname&sPrice=$price\">ź</a></td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
    print "<font face='Angsana New'>����ͨӹǹ $x ��¡��;����Թ  $sNetprice �ҷ .....<b>(��ԡ��¡��������䢢�����)</b><br>";
?>
</table>


