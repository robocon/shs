<?php
    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM depart WHERE date = '$dDate' AND row_id = '".$_GET["nRow_id"]."' ";
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
	$row_id = $row->row_id;
	$date = $row->date;
    $sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
    $sDepart=$row->depart;
    $sDetail=$row->detail;  
    $sNetprice=$row->price;
	$sYprice=$row->sumyprice;
	$sNprice=$row->sumnprice;
    $sDiag=$row->diag;
	$detailbydr=$row->detailbydr;
    $Vn=$row->tvn;
	$sPtright=$row->ptright;
    $cPaid=$sNetprice;
?>

<table>
 <tr>
  <th bgcolor=CD853F>��¡��</th>
  <th bgcolor=CD853F>�ӹǹ</th>
  <th bgcolor=CD853F>�Ҥ�</th>
   <th bgcolor=CD853F>�ԡ�����</th>
 </tr>

<?php
    $query = "SELECT detail,amount,price,nprice FROM patdata WHERE date = '$dDate' AND hn = '".$sHn."' ";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "�ѹ��� $d/$m/$y<br>";
    print "$sPtname, HN: $sHn,VN:$Vn<br> ";
    print "�Է��: $sPtright<br>";
    print "�ä: $sDiag<br>";

    while (list ($detail,$amount,$price,$nprice) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td BGCOLOR=F5DEB3>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
		   "  <td BGCOLOR=F5DEB3>$nprice</td>\n".
           " </tr>\n");
      }
    include("unconnect.inc");
?>
</table>

<?php
    print "����Թ  $sNetprice �ҷ<br>(�ԡ�� &nbsp; $sYprice �ҷ&nbsp;<b>�ԡ�����  &nbsp;$sNprice �ҷ</b>)<br>";
    print "ᾷ�� :$sDoctor<br>";
	if($detailbydr != "")
	print "��������´������� :".nl2br($detailbydr)."<br>";
	print "<A HREF=\"runnolab.php? sDate=$date&gRow_id=$row_id\" target=\"_blank\">����� Stiker</A> ";
    print "<A HREF=\"invdetail1.php? sDate=$date&gRow_id=$row_id\" target=\"_blank\">����� ���˹��</A> ";
?>


