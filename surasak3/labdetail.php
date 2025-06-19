<?php
    session_start();
	session_unregister("sVn");
    session_unregister("sPtname");
    session_unregister("cTrad");
    session_unregister("cAmt");
    session_unregister("sPharow");
    session_register("dDate");

    $sPtname = '';
    $sPharow = $nRow_id;
    $dDate=$sDate;
    session_register("sPtname");
    session_register("sPharow");
    session_register("dDate");
	session_register("sVn");

    $dDate=$sDate;
    include("connect.inc");
  
    $query = "SELECT * FROM depart WHERE row_id = '$nRow_id' "; 
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
    $sDate=$row->date;
	$sTime=substr($sDate,11);
	$sHn=$row->hn;
    $sAn=$row->an;
    $sPtname=$row->ptname;
    $sDoctor=$row->doctor;
	$_SESSION["sVn"] = $row->tvn;
/*
  `price` double(11,2) default NULL,
  `sumyprice` double(11,2) default NULL,
  `sumnprice` double(11,2) default NULL,
  `paid` double(11,2) default NULL,
*/
    $sPrice=$row->price;
    $sSumyprice=$row->sumyprice;
    $sSumnprice=$row->sumnprice;
    $sPaid=$row->paid;
    $sNetprice=$row->price;
    $sDiag=$row->diag;
    $cPaid=$sNetprice;
?>
<style>
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
table {
  border-collapse: collapse;
  width: 60%;
}

th, td {
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #FDEDEC;
}  
</style>
<table>
 <tr>
  <th bgcolor=#EC7063>รายการ</th>
  <th bgcolor=#EC7063>จำนวน</th>
  <th bgcolor=#EC7063>ราคา</th>
  <th bgcolor=#EC7063>เบิกได้</th>
  <th bgcolor=#EC7063>เบิกไม่ได้</th>
 </tr>

<?php
    $query = "SELECT detail,amount,price,yprice,nprice,row_id FROM patdata WHERE idno = '$nRow_id' ";
    $result = mysql_query($query)
        or die("Query failed");

    $d=substr($dDate,8,2);
    $m=substr($dDate,5,2);
    $y=substr($dDate,0,4);
    print "<strong style='font-size:28px;'>วันที่ $d/$m/$y</strong><strong style='margin-left:20px;color:red;font-size:28px;'>เวลา  &nbsp;$sTime</strong><strong style='margin-left:20px;'><a target=_BLANK href='labturn.php' onclick=\"return confirm('คุณต้องการยกเลิกทุกรายการใช่หรือไม่?')\">ยกเลิกทุกรายการ</a></strong><br>";
    print "<div style='margin-left:5px;color:red;font-size:16px;'>*** กรณียกเลิกข้ามวัน ให้ทำในช่วงเวลาหลังจากที่บันทึกข้อมูลของวันนั้นๆ เช่นวันที่ต้องการยกเลิกคีย์มาเวลา 08.00 น. ควรยกเลิกหลังเวลา 08.00 น. เป็นต้น ***</div>";
	print "$sPtname, HN: $sHn<br> ";
    print "โรค: $sDiag<br>";
//    print "แพทย์ :$sDoctor<br><br>";

    while (list ($detail,$amount,$price,$yprice,$nprice,$row_id) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
           "  <td BGCOLOR=F5DEB3>$detail</td>\n".
           "  <td BGCOLOR=F5DEB3>$amount</td>\n".
           "  <td BGCOLOR=F5DEB3>$price</td>\n".
           "  <td BGCOLOR=F5DEB3>$yprice</td>\n".
           "  <td BGCOLOR=F5DEB3>$nprice</td>\n".
           " </tr>\n");
      }

$Thidate = (date("Y")+543).date("-m-d"); 
/*$sql = "Select an From ipcard where hn = '$sHn' and date like '$Thidate%' ";

$result2 = Mysql_Query($sql) or die(mysql_error());
list($cAn) = Mysql_fetch_row($result2);*/

$sql = "Select an,date From ipcard where hn = '$sHn' order by date desc limit 1 ";


$result2 = Mysql_Query($sql) or die(mysql_error());
list($cAn,$date) = Mysql_fetch_row($result2);
include("unconnect.inc");
?>
</table>
<?php
    print "รวมงิน  $sNetprice บาท<br>";
    print "แพทย์ :$sDoctor<br><BR>";

/*if ($cAn!='' && $cAn != $sAn){
	
	print "<fieldset style=\"width:50%;\"><legend>ส่งข้อมูลเข้าบัญชีผู้ป่วยในกรณีรับป่วย โอนทุกรายการ</legend><br>";
	print "<form name=\"f1\" method=\"post\" action=\"labop2ip.php\">";
	
  	print "ผู้ป่วยได้นอนโรงพยาบาล AN &nbsp;<input type=\"text\" name=\"cAn\" value=\"$cAn\"> วันที่ admit : $date <br><br>";
	
	print "<input type=\"submit\" name=\"submit\" value=\"ส่งข้อมูล\">";
 
   // print "&nbsp;&nbsp;&nbsp;<a target=_BLANK href='labop2ip.php'>ส่งข้อมูลเข้าบัญชีผู้ป่วยในกรณีรับป่วย โอนทุกรายการ</a>";
	
	print "</form>";
	print "</fieldset>";
}*/

?>


