<?php
$yym = $_POST['thiyr'].'-'.$_POST['rptmo'];
$yym_end = $_POST['thiyr_end'].'-'.$_POST['rptmo_end'];

$txt_more = '';
if( $yym_end != $yym ){
    $txt_more = 'ถึงเดือน '.$yym_end;
}

    // $yym=$thiyr.'-'.$rptmo;
    // $yym1=$thiyr.'/'.$rptmo;
    
    ?>
    <div>
        <a target=_top  href='../nindex.htm'>&lt;&lt; ไปเมนู</a> | <a target=_top  href='hos2m.php'>&lt;&lt; กลับไปเลือกเดือน</a> | <a href="rphos2m_2.php">รายงานยอดรวมตามช่วงเวลา</a>
    </div>
    <?php

    print "<font face='Angsana New'><b>สมุดรายวันซื้อยาและเวชภัณฑ์(ร.พ.2)  เดือน $yym $txt_more (เรียงตามวันที่รับของ)</b><br>";
	print "<a href='rphos2m_print.php?yym=$yym'>พิมพ์สมุดรายวันซื้อ</a>";
	
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>ลำดับคลัง</th>
  <th bgcolor=6495ED><font face='Angsana New'>ใบสั่งซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่รับของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>วันที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>เลขที่ใบส่งของ</th>
  <th bgcolor=6495ED><font face='Angsana New'>บริษัท</th>
  <th bgcolor=6495ED><font face='Angsana New'>รหัส</th>
  <th bgcolor=6495ED><font face='Angsana New'>รายการซื้อ</th>
  <th bgcolor=6495ED><font face='Angsana New'>LotNo</th>
  <th bgcolor=6495ED><font face='Angsana New'>จำนวน</th>
  <th bgcolor=6495ED><font face='Angsana New'>หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>ราคา/หน่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>รวมเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>ร.พ.5</th>
 </tr>

<?php
If (!empty($yym)){
    include("connect.inc");
//or billdate LIKE '$yym1%'

    $date_more = "date LIKE '$yym%'";
    if( $yym_end != $yym ){
        $date_more = " ( date >= '$yym-01' AND date <= '$yym_end-31') ";
    }

    $query = "SELECT stkno,docno,getdate,date,billno,comname,drugcode,tradname,lotno,packamt,packing,packpri,price,stkbak,packamt 
    FROM combill 
    WHERE $date_more 
    AND drugcode like '".$_POST["drugcode"]."%' ORDER BY getdate";

    $result = mysql_query($query) or die("Query failed");
    $num=0;
   $netprice=0;
   
  // echo $query;

    while (list ($stkno,$docno,$getdate,$billdate,$billno,$comname,$drugcode,$tradname,$lotno,$packamt,$packing,$packpri,$price,$stkbak,$packamt) = mysql_fetch_row ($result)) {
	$num++;
        $netprice = $netprice+$price;

/*
          if ($packamt > 0){
 	$npack  =$stkbak/$packamt;
	  	     }
          else {
	$npack  ='';
	  }
*/
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$stkno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$docno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$getdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billdate</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$billno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$comname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$drugcode</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$tradname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$lotno</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packamt</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packing</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$packpri</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rphos5dg.php? Dgcode=$drugcode\">ร.พ.5</a></td>\n".
           " </tr>\n");
          }
   include("unconnect.inc");
          }
  print "<br>รวมมูลค่าซื้อยาและเวชภัณฑ์ทั้งสิ้น  $netprice บาท";
?>

</table>
