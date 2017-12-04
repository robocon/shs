<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>บัญชีการซื้อยาและเวชภัณฑ์  ประจำเดือน $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< ไปเมนู</a><br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่ซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>เลขที่ใบสั่งซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>บริษัทหรือห้างหุ้นส่วนจำกัด</th>
  <th bgcolor=6495ED><font face='Angsana New'>จำนวนเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>เลขที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่รับของ</th>
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ร้านค้ารับเช็ค</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");

    $query = "SELECT date,docno,comname,price,billno,getdate,stkbak,packamt FROM combill WHERE date LIKE '$yym%' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;
  

    while (list ($billdate,$docno,$comname,$price,$billno,$getdate,          $stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "รวมมูลค่าซื้อยาและเวชภัณฑ์ทั้งสิ้น  $netprice บาท";
?>
</table>
