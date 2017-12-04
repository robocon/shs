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
  <th bgcolor=CD853F><font face='Angsana New' size='3'>รายการ</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>จำนวน</th>
  <th bgcolor=CD853F><font face='Angsana New' size='3'>ราคา</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>เบิกได้</th>
  <th bgcolor=9999CC><font face='Angsana New' size='3'>เบิกไม่ได้</th>
 </tr>

<?php
    $query = "SELECT detail,amount,price,yprice,nprice FROM patdata WHERE idno = '$rows' ";
    $result = mysql_query($query)
        or die("Query failed");
  print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ใบแจ้งรายการผู้ป่วย<br>";
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;$sPtname, HN: $sHn ";
	print "<font face='Angsana New' size='3'>&nbsp;สิทธิ :$sPtright<br> ";
    print "<font face='Angsana New' size='2'>&nbsp;&nbsp;&nbsp;โรค: $sDiag, แพทย์ :$sDoctor<br>";
//    print "แพทย์ :$sDoctor<br><br>";

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
    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;รวมงิน  $sNetprice บาท";

    print "<font face='Angsana New' size='3'>&nbsp;&nbsp;<b>(เบิกไม่ได้ $sSumNprice บาท</b>, เบิกได้$sSumYprice บาท)<br>";

// print "<font face='Angsana New' size='3'>&nbsp;&nbsp;&nbsp;เจ้าหน้าที่ผู้บันทึก...........................................<br>";
?>


