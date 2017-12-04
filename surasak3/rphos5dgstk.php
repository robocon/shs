<?php
    print  "<font face='Angsana New'><b>ทะเบียนคุมยาและเวชภัณฑ์(ร.พ.5)  รายงานตามรหัสยา</b><br> ";
	print  "<font face='Angsana New'>(ดูความเคลื่อนไหวของยาแต่ละตัวในห้องจ่ายยา)";

	$today="$d-$m-$yr";
    $thday="$yr-$m-$d";
    print "............<input type=button onclick='history.back()' value='<< กลับไป'>";
	$yr=$yr-543;
    $today="$yr-$m-$d";
	$drugcode="$cDrugcode";
?>
<table>
 <tr>
  <th bgcolor=CC9900><font face='Angsana New'>#</th>
  <th bgcolor=CC9900><font face='Angsana New'>วันที่รับ-จ่าย</th>
  <th bgcolor=CC9900><font face='Angsana New'>ที่เอกสาร</th>
  <th bgcolor=CC9900><font face='Angsana New'>จ่ายให้</th>
  <th bgcolor=CC9900><font face='Angsana New'>ราคาทุน/หน่วย</th>
  <th bgcolor=CC9900><font face='Angsana New'>จำนวนเบิกจากคลัง</th>
  <th bgcolor=CC9900><font face='Angsana New'>คิดเป็นเงิน</th>
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
                die("ไม่พบรหัส $drugcode <a target=_self  href='../nindex.htm'><ไปเมนู</a>");
                 }

   //      print "$today<br>";
         print "<font face='Angsana New'>รหัส:$drugcode <br>";
         print "<font face='Angsana New'> ชื่อการค้า:$tname <br>";
         print "<font face='Angsana New'>ชื่อสามัญ:$tname <br>";
   $Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
   print "<b>ข้อมูลปัจจุบัน ($Thaidate)</b><br>"; 
         print "<font face='Angsana New'>ในคลัง.......... $nmainstk  $cUnit<br>";
         print "ในห้องจ่าย..... $nstock<br>";
         print "มีทั้งหมด....... $ntotalstk<br>";
		 print "คิดเป็นเงินตามราคาขาย = $nStockpri บาท";

         print "<br><b>รายงานการเบิกจากคลังยาของวันที่ $d-$m-$yr</b> ";

///////////
    $query = "SELECT getdate,billno,drugcode,lotno,department,unitpri,amount,stkcut,netlotno,mainstk,stock,totalstk                      FROM stktranx  WHERE drugcode = '$drugcode' and getdate='$today' and department='ห้องจ่ายยา' ORDER BY getdate ";
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
         print "<br><b>รายงานการจ่ายจากคลังยาของวันที่ $d-$m-$yr</b> ";
   	print "<table>";
 	print "<tr>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>#</th>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>*จ่ายให้ </th>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>จำนวนจ่าย</th>";
  	print "<th bgcolor=6495ED><font face='Angsana New'>ราคารวม</th>";
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
         print "รวมจ่ายทั้งสิ้น = $nTotal  $cUnit  <br>";
    print "คิดเป็นเงินตามราคาขาย = $nTotalpri  บาท<br>";
    print "<b>หมายเหตุ  *จ่ายให้</b>  คลิก HN เพื่อดูใบสั่งยา";
    print ".................<input type=button onclick='history.back()' value='<< กลับไป'>";

   include("unconnect.inc");
          }
?>
</table>

 