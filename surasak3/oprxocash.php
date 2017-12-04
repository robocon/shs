<?php
    session_start();//for security
    if (isset($sIdname)){} else {die;} //for security

    $today="$d-$m-$yr";
    print "วันที่ $today  รายชื่อคนไข้ที่ซื้อยา เวชภัณฑ์(ยังไม่ได้จ่ายเงิน) ";
    print "&nbsp;&nbsp;&nbsp<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED>#</th>
  <th bgcolor=6495ED>เวลา</th>
  <th bgcolor=6495ED>ชื่อ</th>
  <th bgcolor=6495ED>สิทธิ</th>
  <th bgcolor=6495ED>HN</th>
  <th bgcolor=6495ED>AN</th>
  <th bgcolor=6495ED>ค่ายา</th>
  <th bgcolor=F08080>เบิกไม่ได้</th>
  <th bgcolor=6495ED>จ่ายเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>รับรองยานอกบัญชียาหลักแห่งชาติ</th>
  </tr>

<?php
    $detail="ค่ายา";
    $num=0;
    include("connect.inc");
  
    $query = "SELECT date,ptname,ptright,hn,an,price,paid,essd,nessdy,nessdn,dsy,dpy,dsn,dpn,row_id,accno,tvn FROM phardep WHERE date LIKE '$today%' and paid=0 ORDER BY ptname";

    $result = mysql_query($query)
        or die("Query failed");

    while (list ($date, $ptname,$ptright,$hn,$an,$price,$paid,$essd,$nessdy,$nessdn,$dsy,$dpy,$dsn,$dpn,$row_id,$accno,$tvn) = mysql_fetch_row ($result)) {
		$num++;
		$time=substr($date,11);
			/*ใช้ทดสอบ  ให้ลบทิ้ง 
			$total=$essd+$nessdy+$nessdn+$dsy+$dpy+$dsn+$dpn;
			$oppay=$Nessdn+$DSY+ $DSN+$DPN;   //ผป.นอกเบิกไม่ได้
			$ippay=$Nessdn+ $DSN+$DPN; //ผป.ในเบิกไม่ได้
			*/
		$topay=0;
		if (empty($an)){    
			$topay=$nessdn+$dsy+ $dsn+$dpn;   //ผป.นอกเบิกไม่ได้
				}
		if (!empty($an)){    
			$topay=$nessdn+ $dsn+$dpn; //ผป.ในเบิกไม่ได้
				}
//	$nNetprice=number_format($nNetprice,2,'.',',');
			$topay=number_format($topay,2,'.',',');
//        if (empty($paid)){
        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$num</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$time</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"oprxitem.php? sDate=$date&nRow_id=$row_id&nAccno=$accno\">$ptname</a></td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptright</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$price</td>\n".
           "  <td BGCOLOR=FFE4C4><font face='Angsana New'>$topay</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$paid</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK  href=\"rxcertify.php? Fulname=$ptname&Nessdy=$nessdy\">พิมพ์ใบรับรองยา</td>\n".
           " </tr>\n");
//       }
}
    include("unconnect.inc");
?>
</table>




