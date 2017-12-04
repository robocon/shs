<?php
    session_start();

  include("connect.inc");

	$query = "Select count(row_id) as count_row From combill where row_id ='$Delrow' ";

	$result  = Mysql_Query($query);

	list($count_row) = Mysql_fetch_row($result);

	if($count_row <= 0){
		
		echo "รายการนี้เคยยกเลิกไปแล้วครับ";
		exit();

	}

  $query = "delete from combill where row_id ='$Delrow'";
  $result = mysql_query($query) or die("ไม่สามารถลบยาตาม LotNo นี้ได้");

  $query ="UPDATE druglst SET  mainstk= $nmainstk-$nAmt,
                                                     totalstk = $ntotalstk-$nAmt
                                     WHERE drugcode= '$Dgcode' ";
  $result = mysql_query($query)
                       or die("Query failed,update druglst");

///////
 
    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6495ED>รหัส</th>";
    print "  <th bgcolor=6495ED>รายการ</th>";
    print "  <th bgcolor=6495ED>Exp.Date</th>";
    print "  <th bgcolor=6495ED>Lot.No</th>";
    print "  <th bgcolor=6495ED>ในคลัง</th>";
    print "  <th bgcolor=6495ED>หน่วย</th>";
    print "  <th bgcolor=CD853F>ลบทิ้ง</th>";
    print " </tr>";


         $query = "SELECT drugcode,tradname,genname,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$dcode' ";
         $result = mysql_query($query) or die("Query failed");

	 for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	        if (!mysql_data_seek($result, $i)) {
	            echo "Cannot seek to row $i\n";
	            continue;
	       }

	        if(!($row = mysql_fetch_object($result)))
	            continue;
 	        }


//                $dcode=$row->drugcode;
	$tname=$row->tradname;
	$nstock=$row->stock;
	$nmainstk=$row->mainstk;
	$ntotalstk=$row->totalstk;	

         $query = "SELECT drugcode,tradname,expdate,lotno,amount,unit,dgexplot,row_id FROM combill  WHERE dgexplot LIKE '$dcode%' and amount >0 ORDER BY dgexplot DESC";//DESC
         $result = mysql_query($query)
                or die("Query failed");

         print "รายการยาเวชภัณฑ์เรียงตาม Lot.No ที่ใกล้หมดอายุก่อน<br>";
         print "$dcode,$tname <br>";

         $x++;
         $aLot[$x]="ลบยา $cTrad  เฉพาะLotNo. $cLot จำนวน $nAmt หน่วย เรียบร้อย";
         for ($n=1; $n<=$x; $n++){
                print "<font face='Angsana New'>$n. $aLot[$n]<br>";
	                                 }
         print "<br>เหลือจำนวนดังนี้<br>";
         print "ในคลัง.......... $nmainstk <br>";
         print "ในห้องจ่าย..... $nstock<br>";
         print "มีทั้งหมด....... $ntotalstk <br>";
         print "เหลือจำนวนในคลังตาม Lot.No และวันหมดอายุดังนี้<br> ";

         while (list ($drugcode, $tradname,$expdate,$lotno,$amount,$unit,$dgexplot,$row_id) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                       "  <td BGCOLOR=66CDAA>$dcode</td>\n".
                       "  <td BGCOLOR=66CDAA>$tradname</td>\n".
                       "  <td BGCOLOR=66CDAA>$expdate</td>\n".
                       "  <td BGCOLOR=66CDAA>$lotno</td>\n".
                       "  <td BGCOLOR=66CDAA>$amount</td>\n".
                       "  <td BGCOLOR=66CDAA>$unit</td>\n".
                       "  <td bgcolor=F5DEB3><a target=_self href=\"lotdele.php? Delrow=$row_id&Dgcode=$drugcode&cTrad=$tradname&cLot=$lotno&nAmt=$amount\">ลบทิ้ง</td>\n".
                       " </tr>\n");
                        }
          include("unconnect.inc");
    print "<table>";
?>
<a target=_top  href="../nindex.htm"><< ไปเมนู</a>


