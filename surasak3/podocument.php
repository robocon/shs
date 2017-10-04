<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>ทำเอกสารการสั่งซื้อยาและเวชภัณฑ์  ประจำเดือน $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< ไปเมนู</a>&nbsp;&nbsp;&nbsp;<a target=_top  href='pomonth.php'><< ไปเลือกเดือน</a><br>";
    print "คลิก--> ที่ กห ใบสั่งซื้อชั่วคราว-->กรอกข้อมูลใบ PO<br>";
    print "คลิก--> วันที่ใบสั่งซื้อชั่วคราว---->พิมพ์ใบ PO ชั่วคราว<br>";
    print "คลิก--> รายการ ------------------->ดูจำนวนรายการที่สั่งซื้อ<br>";
    print "คลิก--> วันที่ใบสั่งซื้อจริง -------->พิมพ์ใบ PO จริง<br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่สั่ง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ที่ กห ใบสั่งซื้อชั่วคราว</th>
    <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อชั่วคราว(ยา)</th>
 <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อชั่วคราว(เวชภัณฑ์ )</th>
    <th bgcolor=6495ED><font face='Angsana New'>รหัสบริษัท</th>
  <th bgcolor=6495ED><font face='Angsana New'>บริษัทหรือห้างหุ้นส่วนจำกัด</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาไม่รวมvat</th>
  <th bgcolor=6495ED><font face='Angsana New'>ที่ กห ใบสั่งซื้อจริง</th>
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา)</th>
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์)</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่กำหนดส่งของ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE date LIKE '$yym%' AND prepono !='ยกเลิก' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id ) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
				
				/*if($items <=11){ 
				$link="";
				}else{
				$link ="<a target=_BLANK  href=\"po2bill_list.php? 	nRow_id=$row_id\">";
				}*/
				
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$date</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$prepono</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepoprn_new.php?nRow_id=$row_id\">$prepodate</td>\n".
		  "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepoprn1_new.php?nRow_id=$row_id\">$prepodate</td>\n".
		  "  <td BGCOLOR=66CDAA><a target=_BLANK  href=\"po2bill_list.php? 	nRow_id=$row_id\"><font face='Angsana New'>$comcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$netprice</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$pono</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.php? 	nRow_id=$row_id\">$podate</a></td>\n".
  "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.php? 	nRow_id=$row_id\">$podate</a></td>\n".
         
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bounddate</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<b>รวมมูลค่าสั่งซื้อยาและเวชภัณฑ์ทั้งสิ้น  $nNetprice บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='officers.php'>กรรมการตรวจรับพัสดุ</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>


