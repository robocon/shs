<?php
    $yym=$thiyr.'-'.$rptmo;
    print "<font face='Angsana New'><b>ทำเอกสารการสั่งซื้อยาและเวชภัณฑ์  ประจำเดือน $yym  </b>&nbsp;&nbsp;&nbsp;<a target=_top  href='../nindex.htm'><< ไปเมนู</a>&nbsp;&nbsp;&nbsp;<a target=_top  href='pomonth2_new61.php'><< ไปเลือกเดือน</a><br>";
    print "คลิก--> ที่ กห ใบสั่งซื้อชั่วคราว-->กรอกข้อมูลใบ PO<br>";
    print "คลิก--> วันที่ใบสั่งซื้อชั่วคราว---->พิมพ์ใบ PO ชั่วคราว<br>";
    print "คลิก--> รายการ ------------------->ดูจำนวนรายการที่สั่งซื้อ<br>";
    print "คลิก--> วันที่ใบสั่งซื้อจริง -------->พิมพ์ใบ PO จริง<br>";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่สั่ง</th>

    <th bgcolor=6495ED><font face='Angsana New'>รหัสบริษัท</th>
  <th bgcolor=6495ED><font face='Angsana New'>บริษัทหรือห้างหุ้นส่วนจำกัด</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการ</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคาไม่รวมvat</th>
  <th bgcolor=6495ED><font face='Angsana New'>ที่ กห ใบสั่งซื้อจริง </th>
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา) รวมVATหลัง</th>
   
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา) รวมVATก่อน </th>
   
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา) ไม่มีภาษี</th>
   
   <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา)ไม่คิดภาษี</th>
   

<th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์) รวมหลัง</th>
<th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์) รวมก่อน</th>
<th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์)ไม่มีภาษี</th>
<th bgcolor=6495ED><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์)ไม่คิดภาษี</th>

  <th bgcolor=6495ED><font face='Angsana New'>วันที่กำหนดส่งของ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id ,ponoyear FROM pocompany WHERE date LIKE '$yym%' AND prepono !='ยกเลิก' ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id,$ponoyear) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$date</td>\n".
      //    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$prepono</a></td>\n".
        
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td align='right' BGCOLOR=66CDAA><font face='Angsana New'>".number_format($netprice,2)."</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$pono$ponoyear</td>\n".

           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn_new61.php?nRow_id=$row_id\">หลัง</a></td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.1_new61.php?nRow_id=$row_id\">ก่อน</a></td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.2_new61.php?nRow_id=$row_id\">ไม่มีภาษี</a></td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.3_new61.php?nRow_id=$row_id\">ไม่คิดภาษี</a></td>\n".
 

 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1_new61.php?nRow_id=$row_id\">หลัง</a></td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.1_new61.php?nRow_id=$row_id\">ก่อน</a></td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.2_new61.php?nRow_id=$row_id\">ไม่มีภาษี</a></td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.3_new61.php?nRow_id=$row_id\">ไม่คิดภาษี</a></td>\n".
         
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bounddate</td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<b>รวมมูลค่าสั่งซื้อยาและเวชภัณฑ์ทั้งสิ้น  ".number_format($nNetprice,2)." บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='officers.php'>กรรมการตรวจรับพัสดุ</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>


