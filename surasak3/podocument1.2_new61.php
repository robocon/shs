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
  <th bgcolor=339999><font face='Angsana New'>#</th>
  <th bgcolor=339999><font face='Angsana New'>วันที่สั่ง</th>

    <th bgcolor=339999><font face='Angsana New'>รหัสบริษัท</th>
  <th bgcolor=339999><font face='Angsana New'>บริษัทหรือห้างหุ้นส่วนจำกัด</th>
  <th bgcolor=339999><font face='Angsana New'>รายการ</th>
  <th bgcolor=339999><font face='Angsana New'>ราคาไม่รวมvat</th>
  <th bgcolor=339999><font face='Angsana New'>ที่ กห ใบสั่งซื้อจริง </th>   
   <th bgcolor=339999><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา) ราคารวม VAT</th> 
   <th bgcolor=339999><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(ยา) ไม่หักภาษี ณ ที่จ่าย</th>
<th bgcolor=339999><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์) ราคารวม VAT</th>
<th bgcolor=339999><font face='Angsana New'>วันที่ใบสั่งซื้อจริง(เวชภัณฑ์) ไม่หักภาษี ณ ที่จ่าย</th>

  <th bgcolor=339999><font face='Angsana New'>วันที่กำหนดส่งของ</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
    $nNetprice=0;
    //$query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id ,ponoyear FROM pocompany WHERE date LIKE '$yym%' AND prepono !='ยกเลิก' ORDER BY date ";
    $query = "SELECT date,prepono,prepodate,comcode,comname,items,netprice,pono,podate,bounddate,row_id ,ponoyear FROM pocompany WHERE date LIKE '$yym%' AND prepono !='ยกเลิก' AND ( `potype` is null OR `potype` = '' ) ORDER BY date ";
    $result = mysql_query($query) or die("Query failed");
    $num=0;
    $nNetprice=0;
    while (list ($date,$prepono,$prepodate,$comcode,$comname,$items,$netprice,$pono,$podate,$bounddate,$row_id,$ponoyear) = mysql_fetch_row 	($result)) {
	$num++;
                $nNetprice= $nNetprice+$netprice;
				
	if($yym < "2565-10"){			
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$date</td>\n".
      //    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$prepono</a></td>\n".
        
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td align='right' BGCOLOR=66CDAA><font face='Angsana New'>".number_format($netprice,2)."</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$pono$ponoyear</td>\n".
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.1_new61.php?nRow_id=$row_id\">ยา ราคารวม VAT</a>&nbsp;&nbsp;<a target=_BLANK  href=\"poprn.1_new62_old.php?nRow_id=$row_id\">แบบใหม่</a></td>\n".  //ยาราคารวม vat
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn.2_new61.php?nRow_id=$row_id\">ยา หักภาษี ณ ที่จ่าย</a>&nbsp;&nbsp;<a target=_BLANK  href=\"poprn.2_new62_old.php?nRow_id=$row_id\">แบบใหม่</a></td>\n".  //ยาหักภาษี ณ ที่จ่าย

 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.1_new61.php?nRow_id=$row_id\">เวชภัณฑ์ ราคารวม VAT</a>&nbsp;&nbsp;<a target=_BLANK  href=\"poprn1.1_new62_old.php?nRow_id=$row_id\">แบบใหม่</a></td>\n".  //เวชภัณฑ์ ราคารวม vat
 
 "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"poprn1.2_new61.php?nRow_id=$row_id\">เวชภัณฑ์ หักภาษี ณ ที่จ่าย</a>&nbsp;&nbsp;<a target=_BLANK  href=\"poprn1.2_new62_old.php?nRow_id=$row_id\">แบบใหม่</a></td>\n".  //เวชภัณฑ์ หักภาษี ณ ที่จ่าย
         
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$bounddate</td>\n".
           " </tr>\n");
	}else{  //ตั้งแต่ 2565-10 เป็นต้นไป
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$date</td>\n".
      //    "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$prepono</a></td>\n".
        
  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"podgitem.php? 	nRow_id=$row_id&cComname=$comname&sNetpri=$netprice\">$items</a></td>\n".
           "  <td align='right' BGCOLOR=66CDAA><font face='Angsana New'>".number_format($netprice,2)."</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"prepofill.php? 	nRow_id=$row_id\">$pono$ponoyear</td>\n".
 
// "  <td BGCOLOR=66CDAA align='center' width='13%'><font face='Angsana New'><a target=_BLANK  href=\"poprn.1_new62.php?nRow_id=$row_id\">ยาราคารวม VAT (แบบเดิม)</a> <br> <a target=_BLANK  href=\"poprn.1_new67.php?nRow_id=$row_id\">ยาราคารวม VAT (แบบใหม่)</a></td>\n".  //ยาราคารวม vat

"<td BGCOLOR=66CDAA align='center' width='13%'><font face='Angsana New'>
<a target=_BLANK  href=\"poprn.1_new62.php?nRow_id=$row_id\">ยาราคารวม VAT (แบบเดิม)</a> <br>
<a target=_BLANK  href=\"poprn.1_new68.php?nRow_id=$row_id\">ยาราคารวม VAT (V.2568)</a></td>\n".  //ยาราคารวม vat 

"<td BGCOLOR=66CDAA align='center' width='13%'><font face='Angsana New'>
<a target=_BLANK  href=\"poprn.2_new62.php?nRow_id=$row_id\">ยาหักภาษี ณ ที่จ่าย (แบบเดิม)</a><br>
<a target=_BLANK  href=\"poprn.2_new68.php?nRow_id=$row_id\">ยาหักภาษี ณ ที่จ่าย (V.2568)</a></td>\n".  //ยาหักภาษี ณ ที่จ่าย

"<td BGCOLOR=66CDAA align='center' width='13%'><font face='Angsana New'>
<a target=_BLANK  href=\"poprn1.1_new62.php?nRow_id=$row_id\">เวชภัณฑ์ราคารวม VAT (แบบเดิม)</a><br>
<a target=_BLANK  href=\"poprn1.1_new68.php?nRow_id=$row_id\">เวชภัณฑ์ราคารวม VAT (V.2568)</a></td>\n".  //เวชภัณฑ์ ราคารวม vat
 
"<td BGCOLOR=66CDAA align='center' width='15%'><font face='Angsana New'>
<a target=_BLANK  href=\"poprn1.2_new62.php?nRow_id=$row_id\">เวชภัณฑ์หักภาษี ณ ที่จ่าย (แบบเดิม)</a><br>
<a target=_BLANK  href=\"poprn1.2_new68.php?nRow_id=$row_id\">เวชภัณฑ์หักภาษี ณ ที่จ่าย (V.2568)</a></td>\n".  //เวชภัณฑ์ หักภาษี ณ ที่จ่าย
         
"<td BGCOLOR=66CDAA><font face='Angsana New'>$bounddate</td>\n".
           " </tr>\n");
	}		
          }
   include("unconnect.inc");
          }
  print "<b>รวมมูลค่าสั่งซื้อยาและเวชภัณฑ์ทั้งสิ้น  ".number_format($nNetprice,2)." บาท</b>&nbsp;&nbsp;&nbsp;&nbsp;<a target=_BLANK href='officers.php'>กรรมการตรวจรับพัสดุ</a><br>";

?>
</table>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>


