<?php
    print  "<font face='Angsana New'><b>����¹���������Ǫ�ѳ��(�.�.5)  ��§ҹ���������</b><br> ";
	print  "<font face='Angsana New'>(�٤�������͹��Ǣͧ�����е�����ͧ������)";

	$today="$d-$m-$yr";
    $thday="$yr-$m-$d";
    print "............<input type=button onclick='history.back()' value='<< ��Ѻ�'>";
	$yr=$yr-543;
    $today="$yr-$m-$d";
	$drugcode="$cDrugcode";
?>
<table>
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>#</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ѹ����Ѻ-����</th>
  <th bgcolor=CC9900><font face='Angsana New'>����͡���</th>
  <th bgcolor=CC9900><font face='Angsana New'>�������</th>
  <th bgcolor=CC9900><font face='Angsana New'>�Ҥҷع/˹���</th>
  <th bgcolor=CC9900><font face='Angsana New'>�ӹǹ�ԡ�ҡ��ѧ</th>
  <th bgcolor=CC9900><font face='Angsana New'>�Դ���Թ</th>
 </tr>

<?php
/*
if (isset($Dgcode)){
         $drugcode=$Dgcode;
          }
 else {
//         die;
         }
*/
If (!empty($drugcode)){
    include("connect.inc");
         $query = "SELECT drugcode,tradname,genname,unit,salepri,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$drugcode' ";
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
	$nsalepri=$row->salepri;
	$nstock=$row->stock;
	$nmainstk=$row->mainstk;
	$ntotalstk=$row->totalstk;	
	$cUnit  = $row->unit;
	$nStockpri=$nsalepri*$ntotalstk;
                    }
         else {
                die("��辺���� $drugcode <a target=_self  href='../nindex.htm'><�����</a>");
                 }

   //      print "$today<br>";
         print "<font face='Angsana New'>����:$drugcode <br>";
         print "<font face='Angsana New'> ���͡�ä��:$tname <br>";
         print "<font face='Angsana New'>�������ѭ:$tname <br>";
   $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
   print "<b>�����ŻѨ�غѹ ($Thaidate)</b><br>"; 
         print "<font face='Angsana New'>㹤�ѧ.......... $nmainstk  $cUnit<br>";
         print "���ͧ����..... $nstock<br>";
         print "�շ�����....... $ntotalstk<br>";
		 print "�Դ���Թ����ҤҢ�� = $nStockpri �ҷ";

         print "<br><b>��§ҹ����ԡ�ҡ��ѧ�Ңͧ�ѹ��� $d-$m-$yr</b> ";

///////////
    $query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk                      FROM stktranx  WHERE drugcode = '$drugcode' and getdate='$today' and department='��ͧ������' ORDER BY getdate ";
     $result = mysql_query($query)
        or die("Query failed");
    $num=0;
    while (list($getdate,$billno,$drugcode,$lotno,$department,$unitpri,
              $amount,$stkcut,$netlotno,$mainstk,$stock,$totalstk) = mysql_fetch_row ($result)) {
	$num++;
	$netprice  =$unitpri*$amount;
	$stkcutpri =$unitpri*$stkcut;
	$netlotpri =$unitpri*$netlotno;
	$mainstkpri =$unitpri*$mainstk;

        print (" <tr>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$billno</td>\n".
          "  <td BGCOLOR=FFCC99><font face='Angsana New'>$department</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$unitpri</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$stkcut</td>\n".
           "  <td BGCOLOR=FFCC99><font face='Angsana New'>$stkcutpri</td>\n".
           " </tr>\n");
          }
//
        print "<table>";
         print "<br><b>��§ҹ��è��¨ҡ��ѧ�Ңͧ�ѹ��� $d-$m-$yr</b> ";
   	print "<table>";
 	print "<tr>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>#</th>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>*������� </th>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>�ӹǹ����</th>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>�Ҥ����</th>";
	print " </tr>";
  //  print "$thday<br>";
 //  print "$dcode<br>";
    $query = "SELECT hn,amount,price,idno FROM drugrx  WHERE drugcode = '$dcode' and date LIKE '$thday%'  ORDER BY date ";
     $result = mysql_query($query)
        or die("Query failed");
//	echo mysql_errno() . ": " . mysql_error(). "\n";
//   echo "<br>";

    $no=0;
  $nTotal=0;
    $nTotalpri=0;
    while (list($hn,$amount,$price,$idno ) = mysql_fetch_row ($result)) {
	$no++;
	$nTotal =$nTotal+$amount;
        $nTotalpri=  $nTotalpri + $price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$no</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"seerx.php? nRow_id=$idno\">$hn</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
      "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           " </tr>\n");
          }
//


        print "<table>";
         print "������·����� = $nTotal  $cUnit  <br>";
    print "�Դ���Թ����ҤҢ�� = $nTotalpri  �ҷ<br>";
    print "<b>�����˵�  *�������</b>  ��ԡ HN ���ʹ�������";
    print ".................<input type=button onclick='history.back()' value='<< ��Ѻ�'>";

   include("unconnect.inc");
          }
?>
</table>

 