<?php
    $dDate=$sDate;
    include("connect.inc");
	
	$Thidate2 = date("Y").date("-m-d H:i:s"); 
	$patienttype = "OPD";
	$sourcecode = "";//����ward
	$build = array("�ͼ�����˭ԧ"=>"42","�ͼ����� ICU"=>"44","�ͼ������ٵ�"=>"43","�ͼ����¾����"=>"45");

    $query = "SELECT * FROM depart WHERE date = '$sDate' AND row_id = '".$_GET["gRow_id"]."' limit 1 ";
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
	$clab=$row->lab;
?>

<table style="font-family: 'Angsana New';">
 <tr>
  <th>��¡��</th>
  <th>�ӹǹ</th>
  <th>�Ҥ�</th>
  <th>�ԡ�����</th>
 </tr>

<?php
    $query = "SELECT code, detail,amount,price,nprice FROM patdata WHERE date = '$dDate' AND hn = '".$sHn."' ";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
	 print "���˹��<br>";
    print "<font face='Angsana New'>�ѹ��� $d/$m/$y<br>";
    print "$sPtname, HN: $sHn,VN:$Vn<br> ";
 print "�Է��: $sPtright<br>";
    print "�ä: $sDiag<br>";

    while (list ($code, $detail,$amount, $price,$nprice) = mysql_fetch_row ($result)) {
        print (" <tr>\n".

           "  <td >$detail</td>\n".
           "  <td >$amount</td>\n".
           "  <td >$price</td>\n".
			    "  <td >$nprice</td>\n".
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
print "***��仪����Թ��ͧ�����Ţ 4*** <br>";
?>


