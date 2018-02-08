<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<b>ทำเอกสารการสั่งซื้อ สป.สายแพทย์  ประจำเดือน $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< ไปเมนู</a>&nbsp;&nbsp;&nbsp;<a target=_top  href='purchase_pomonth1.php'><< ไปเลือกเดือน</a><br>";
    print "คลิก--> ที่ กห ใบสั่งซื้อชั่วคราว-->กรอกข้อมูลใบ PO<br>";
    print "คลิก--> วันที่ใบสั่งซื้อชั่วคราว---->พิมพ์ใบ PO ชั่วคราว<br>";
    print "คลิก--> รายการ ------------------->ดูจำนวนรายการที่สั่งซื้อ<br>";
    print "คลิก--> วันที่ใบสั่งซื้อจริง -------->พิมพ์ใบ PO จริง<br>";
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 19px;
}
-->
</style>
<table>
 <tr>
  <th bgcolor=FF9999>#</th>
  <th bgcolor=FF9999>วันที่สั่ง</th>
  <th bgcolor=FF9999>ที่ กห ใบสั่งซื้อชั่วคราว</th>

    <th bgcolor=FF9999>วันที่ใบสั่งซื้อชั่วคราว(สป.)<br />
รวมVATหลัง</th>

 <th bgcolor=FF9999>วันที่ใบสั่งซื้อชั่วคราว(สป.)<br />
รวมVATก่อน</th> 
    <th bgcolor=FF9999>รหัสบริษัท</th>
  <th bgcolor=FF9999>บริษัทหรือห้างหุ้นส่วนจำกัด</th>
  <th bgcolor=FF9999>รายการ</th>
  <th bgcolor=FF9999>ราคาไม่รวมvat</th>
  <th bgcolor=FF9999>วันที่กำหนดส่งของ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
	//$query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE date LIKE '$yym%' AND prepono !='ยกเลิก' ORDER BY date ";
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id FROM pocompany WHERE date LIKE '$yym%' AND prepono !='ยกเลิก' AND potype='pc' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id ) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
        print (" <tr>\n".
           "  <td BGCOLOR=FFCCCC>$num</td>\n".
           "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_prepofill.php?nRow_id=$row_id\">$date</a></td>\n".
           "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_prepofill.php?nRow_id=$row_id\">$prepono</a></td>\n".

          "  <td BGCOLOR=FFCCCC><a href='purchase_prepoprn_new.php?nRow_id=$row_id' target='_blank'>$prepodate</a></td>\n".
          "  <td BGCOLOR=FFCCCC><a href='purchase_prepoprn.1_new.php?nRow_id=$row_id' target='_blank'>$prepodate</a></td>\n".
		  "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_podocumentselect.php? 	nRow_id=$row_id\">$comcode</a></td>\n".
           "  <td BGCOLOR=FFCCCC>$comname</td>\n".
           "  <td BGCOLOR=FFCCCC><a target=_BLANK  href=\"purchase_podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td BGCOLOR=FFCCCC>$netprice</td>\n".
           "  <td BGCOLOR=FFCCCC>$pono</td>\n".
    
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<b>รวมมูลค่าสั่งซื้อ สป.สายแพทย์ ทั้งสิ้น  $nNetprice บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='purchase_officers.php'>ตั้งค่าข้อมูลกรรมการตรวจรับพัสดุ</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>


