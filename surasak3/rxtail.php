<?php
    session_start();
    session_unregister("sPtname");
    session_unregister("cTrad");
    session_unregister("cAmt");

    $sPtname = '';
    session_register("sPtname");

    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM phardep WHERE date = '$dDate'";
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
 </tr>

<?php
    $query = "SELECT tradname,amount,price,slcode FROM drugrx WHERE date = '$dDate' ";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "�ѹ��� $d/$m/$y<br>";
    print "$sPtname, HN: $sHn<br> ";
    print "�ä: $sDiag<br>";
//    print "ᾷ�� :$sDoctor<br><br>";

    while (list ($tradname,$amount,$price,$slcode) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3>$tradname</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3>$slcode</td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>
<?php
    print "����Թ  $sNetprice �ҷ<br>";
    print "ᾷ�� :$sDoctor<br><br>";
?>


