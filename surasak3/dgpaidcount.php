<?php
	// send d,m,yr 
If (!empty($yr)){
   $yrmn=$yr."-".$m."-".$d;
    include("connect.inc");
    $query="CREATE TEMPORARY TABLE dgpaid SELECT * FROM drugrx WHERE date LIKE '$yrmn%' ORDER BY drugcode";
    $result = mysql_query($query) or die("Query failed,drugrx"); 

   	$x=0;
    $aDgcode = array("รหัสยา");
    $aTrade  = array("      ชื่อการค้า");
    $aPrice  = array("  รวมเงิน  ");
    $aAmount = array("  จำนวน   ");
    $aDuplicate= array("   จำนวนคนไข้");
    $Netprice=0;   

   $query="SELECT  drugcode,tradname,COUNT(*) AS duplicate FROM dgpaid GROUP BY drugcode HAVING duplicate > 0 ORDER BY drugcode";
   $result = mysql_query($query);
    while (list ($drugcode,$tradname,$duplicate) = mysql_fetch_row ($result)) {
            $x++;
    $aDgcode[$x]=$drugcode;
    $aTrade[$x]=$tradname;
    $aDuplicate[$x]=$duplicate;
/*
			print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$x</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$aDgcode[$x]</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$aTrade[$x]</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวนครั้งที่สั่ง(จำนวนคนไข้ที่รับยา)=   $aDuplicate[$x]</td>\n".
               " </tr>\n<br>");
*/
			   }
 //นับเม็ดยาแต่ละ drugcode
 for ($n=1; $n<=$x; $n++){
       $query = "SELECT amount,price FROM dgpaid WHERE drugcode = '$aDgcode[$n]' ";
       $result = mysql_query($query) or die("Query failed");
			    $aAmount[$n]=0;
				$aPrice[$n]=0;
       while (list ($amount,$price) = mysql_fetch_row ($result)) {
			    $aAmount[$n] =  $aAmount[$n]+$amount;
				$aPrice[$n]=$aPrice[$n]+$price;
						                 }
					};
 	   $Netprice=array_sum($aPrice);
    	$Netprice=number_format($Netprice,2,'.',',');
		//////////
    print "<font face='Angsana New'><b>รายงานการจ่ายยาและเวชภัณฑ์ของวันที่ $d-$m-$yr</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></font><br>";
print"<table>";
 print"<tr>";
  print"<th bgcolor=CD853F><font face='Angsana New'>#</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>รหัส</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>ชื่อสามัญ</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>จำนวนจ่าย</th>";
  print"<th bgcolor=CD853F><font face='Angsana New'>รวมเงิน</th>";
 print"<th bgcolor=CD853F><font face='Angsana New'>*จำนวนคนไข้</th>";
 print"</tr>";
 for ($n=1; $n<=$x; $n++){
            print (" <tr>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDgcode[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aTrade[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aAmount[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aPrice[$n]</td>\n".
               "  <td BGCOLOR=F5DEB3><font face='Angsana New'>$aDuplicate[$n]</td>\n".
               " </tr>\n");
  };
    print "</table>";

    print "<table>";
    print " <tr>";
    print "  <th><font face='Angsana New'>รวมเงินทั้งสิ้น  $Netprice บาท</font></th>";
    print "</table>";
	print "<font face='Angsana New'>(หมายเหตุ: *จำนวนคนไข้ : นับรวมการคืนยาจึงมากเกินจริง , ที่ถูกต้องให้ดู #)<br>";
//ดูคนไข้ทุกคน
	print"<br><b>รายงานการจ่ายยาและเวชภัณฑ์ (คนไข้แต่ละคน) ของวันที่ $d-$m-$yr</b></br>";
	print"<table>";
   print"<tr>";
  print"<th bgcolor=6495ED><font face='Angsana New'>#</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>วันที่</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>HN</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>AN</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>รหัส</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>ชื่อสามัญ</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>จำนวน</th>";
  print"<th bgcolor=6495ED><font face='Angsana New'>รวมเงิน</th>";
 print"</tr>";
   $query="SELECT date,hn,an,drugcode,tradname,amount,price FROM dgpaid";
   $result = mysql_query($query);
     $n=0;
 while (list ($date,$hn,$an,$drugcode,$tradname,$amount,$price) = mysql_fetch_row ($result)) {
            $n++;
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$date</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$amount</td>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
               " </tr>\n");
               }
 include("unconnect.inc");
}
    print "<table>";
    print " <tr>";
    print "  <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a></th>";
    print "</table>";
?>

