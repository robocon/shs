<?php
         include("connect.inc");

         $query = "SELECT drugcode,tradname,genname,stock,mainstk,totalstk FROM druglst WHERE drugcode = '$Dgcode' ";
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
	$nstock=$row->stock;
	$nmainstk=$row->mainstk;
	$ntotalstk=$row->totalstk;	
                    }

        $query = "SELECT drugcode,tradname,expdate,lotno,amount,unit,dgexplot,row_id FROM combill  WHERE dgexplot LIKE '$Dgcode%' and amount >0 ORDER BY dgexplot DESC";//DESC
        $result = mysql_query($query)
              or die("Query failed");

        print "$Dgcode,$tname <br>";
        print "<font face='Angsana New'>ในคลัง.......... $nmainstk <br>";
        print "ในห้องจ่าย..... $nstock<br>";
        print "มีทั้งหมด....... $ntotalstk <br>";

    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>จำนวนเหลือในคลังตาม Lot.No และวันหมดอายุ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=#669999><font face='Angsana New'>รหัส</th>";
    print "  <th bgcolor=#669999><font face='Angsana New'>รายการ</th>";
    print "  <th bgcolor=#669999><font face='Angsana New'>Exp.Date</th>";
    print "  <th bgcolor=#669999><font face='Angsana New'>Lot.No</th>";
    print "  <th bgcolor=#669999><font face='Angsana New'>ในคลัง</th>";
    print "  <th bgcolor=#669999><font face='Angsana New'>หน่วย</th>";
    print " </tr>";

        while (list ($drugcode, $tradname,$expdate,$lotno,$amount,$unit,$dgexplot,$row_id) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                       "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$drugcode</td>\n".
                       "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$tradname</td>\n".
                       "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$expdate</td>\n".
                       "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$lotno</td>\n".
                       "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$amount</td>\n".
                       "  <td BGCOLOR=#C0C0C0><font face='Angsana New'>$unit</td>\n".
                       " </tr>\n");
                      }

//รายการซื้อยาเข้าคลัง  ตามใบส่งของทุกใบ
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>รายการซื้อยาเข้าคลัง  ตามใบส่งของทุกใบ</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>วันที่</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>LotNo.</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>Exp.Date</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>จำนวน</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>ราคา</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>เหลือ</th>";
    print "  <th bgcolor=CD853F><font face='Angsana New'>หน่วย</th>";
    print " </tr>";

        $query = "SELECT getdate,lotno,expdate,stkbak,price,amount,unit FROM combill  WHERE drugcode = '$Dgcode' ";
        $result = mysql_query($query)
              or die("Query failed");

        while (list ($getdate,$lotno,$expdate,$stkbak,$price,$amount,$unit) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$getdate</td>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$lotno</td>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$expdate</td>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$stkbak</td>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$price</td>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$amount</td>\n".
                       "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$unit</td>\n".
                       " </tr>\n");
                      }

//รายการเบิกจากคลังใหญ่ไปห้องจ่ายยา
    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>รายการเบิกจากคลังใหญ่ไปห้องจ่ายยา</th>";
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th bgcolor=6699FF><font face='Angsana New'>วันที่</th>";
    print "  <th bgcolor=6699FF><font face='Angsana New'>LotNo.</th>";
    print "  <th bgcolor=6699FF><font face='Angsana New'>Exp.Date</th>";
    print "  <th bgcolor=6699FF><font face='Angsana New'>จำนวน</th>";
    print "  <th bgcolor=6699FF><font face='Angsana New'>หน่วย</th>";
    print " </tr>";

        $query = "SELECT date,lotno,expdate,stkcut,unit FROM stktranx  WHERE drugcode = '$Dgcode' ";
        $result = mysql_query($query)
              or die("Query failed");

        while (list ($date,$lotno,$expdate,$stkcut,$unit) = mysql_fetch_row ($result)) {
              print (" <tr>\n".
                       "  <td BGCOLOR=66FFCC><font face='Angsana New'>$date</td>\n".
                       "  <td BGCOLOR=66FFCC><font face='Angsana New'>$lotno</td>\n".
                       "  <td BGCOLOR=66FFCC><font face='Angsana New'>$expdate</td>\n".
                       "  <td BGCOLOR=66FFCC><font face='Angsana New'>$stkcut</td>\n".
                       "  <td BGCOLOR=66FFCC><font face='Angsana New'>$unit</td>\n".
                       " </tr>\n");
                      }

        include("unconnect.inc");
?>



