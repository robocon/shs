<?php
    include("connect.inc");
  
 $query = "SELECT * FROM depart WHERE date = '$pdate' and hn='$phn' ";
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
	
	$rows=$row->row_id;
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sPtright=$row->ptright;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price;

    $sSumYprice=$row->sumyprice;
    $sSumNprice=$row->sumnprice;

    $sDiag=$row->diag;

    $cPaid=$sNetprice;
?>

<table>
 <tr>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>��¡��</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>�ӹǹ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>�Ҥ�</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>�ԡ��</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>�ԡ�����</th>
 </tr>

<?php
    $query = "SELECT detail,amount,price,yprice,nprice FROM patdata WHERE idno = '$rows' ";
    $result = mysql_query($query)
        or die("Query failed");
  print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�����¡�ü�����<br>";
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;$sPtname, HN: $sHn ";
	print "<font face='Angsana New' size='3'>&nbsp;�Է�� :$sPtright<br> ";
    print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;�ä: $sDiag, ᾷ�� :$sDoctor<br>";
//    print "ᾷ�� :$sDoctor<br><br>";

    while (list ($detail,$amount, $price,$yprice,$nprice) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='3'>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='3'>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3><font face='Angsana New' size='3'>$price</td>\n".
           "  <td BGCOLOR=99CCCC><font face='Angsana New' size='3'>$yprice</td>\n".
           "  <td BGCOLOR=99CCCC><font face='Angsana New' size='3'>$nprice</td>\n".
		   " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>

<?php
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;����Թ  $sNetprice �ҷ";

    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;<b>(�ԡ����� $sSumNprice �ҷ</b>, �ԡ��$sSumYprice �ҷ)<br>";

// print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;���˹�ҷ����ѹ�֡...........................................<br>";
?>


