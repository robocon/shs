<?php
    $today="$d-$m-$yr";
    print "วันที่ $today  ค่ารักษาพยาบาลผู้ป่วยทั้งหมด";
  //  print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type=button onclick='history.back()' value='<< กลับไป'>";
   // print "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'><<ไปเมนู</a>";
    $today="$yr-$m-$d";
?>
<table>
 <tr>
  <th bgcolor=6495ED><font face='Angsana New'>#</th>
  <th bgcolor=6495ED><font face='Angsana New'>ชื่อผู้ป่วย</th>
  <th bgcolor=6495ED><font face='Angsana New'>HN</th>
<th bgcolor=6495ED><font face='Angsana New'>AN</th>
   <th bgcolor=6495ED><font face='Angsana New'>วินิจฉัยโรค</th>
  <th bgcolor=6495ED><font face='Angsana New'>แล็บ</th>
  <th bgcolor=6495ED><font face='Angsana New'>เอกซเรย์</th>
 <th bgcolor=6495ED><font face='Angsana New'>ฉุกเฉิน</th>
 <th bgcolor=6495ED><font face='Angsana New'>กายภาพ</th>
<th bgcolor=6495ED><font face='Angsana New'>ผ่าตัด</th>
 <th bgcolor=6495ED><font face='Angsana New'>ทันตกรรม</th>

 <th bgcolor=6495ED><font face='Angsana New'>รักษาอื่นๆ</th>

  <th bgcolor=6495ED><font face='Angsana New'>ยารายรับ</th>
<th bgcolor=6495ED><font face='Angsana New'>ค่าบริการ</th>
   <th bgcolor=6495ED><font face='Angsana New'>รวมเงิน</th>
  <th bgcolor=6495ED><font face='Angsana New'>แพทย์</th>

  </tr>

<?php
    include("connect.inc");
  
    $query = "SELECT ptname,hn,an,note,diag,patho,xray,phar,emer,surg,physi,denta,other,doctor,idcard FROM opday WHERE thidate LIKE '$today%'";
    $result = mysql_query($query)
        or die("Query failed");
    $n=0;
 $totalpri=0;
    while (list ($ptname,$hn,$an,$note,$diag,$patho,$xray,$phar,$emer,$surg,$physi,$denta,$other,$doctor,$idcard) = mysql_fetch_row ($result)) {
        $n++;	
//      $time=substr($thidate,11);
$num1=0;
$num2=50;

$free=0;

        $etc=$emer+$surg+$physi+$denta+$other;
        $netprice=$patho+$xray+$phar+$etc;

if($phar>0){$netprice=$netprice+50;};

if($phar>0){$free=$free+50;};

   $totalpri=$totalpri+$netprice;


 $totalemer=$totalemer+$emer;
 $totalsurg=$totalsurg+$surg;
 $totalphysi=$totalphysi+$physi;
 $totaldenta=$totaldenta+$denta;
 $totalpatho=$totalpatho+$patho;
 $totalxray=$totalxray+$xray;
 $totalphar=$totalphar+$phar;
 $totalother=$totalother+$other;
 $totalfree=$totalother+$free;

        print (" <tr>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$ptname</td>\n".
           "  <td BGCOLOR=66CDAA><font face='Angsana New'>$hn</td>\n".
 	"	<td BGCOLOR=66CDAA><font face='Angsana New'>$an</td>\n".
// "  <td BGCOLOR=66CDAA><font face='Angsana New'>$idcard</td>\n".
       
//    "  <td BGCOLOR=66CDAA><font face='Angsana New'>$note</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$diag</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$patho</td>\n".
     "  <td BGCOLOR=66CDAA><font face='Angsana New'>$xray</td>\n".
   "  <td BGCOLOR=66CDAA><font face='Angsana New'>$emer</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$surg</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$physi</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$denta</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$other</td>\n".
 "  <td BGCOLOR=66CD55><font face='Angsana New'>$phar</td>\n".
"  <td BGCOLOR=77CD00><font face='Angsana New'>$free</td>\n".

 "  <td BGCOLOR=77CD00><font face='Angsana New'>$netprice</td>\n".
 "  <td BGCOLOR=66CDAA><font face='Angsana New'>$doctor</td>\n".
           " </tr>\n");
       }
   print "รวมค่ารักษาพยาบาลทั้งสิ้น  $totalpri บาท <br>" ;
 print "รวมค่าบริการห้องฉุกเฉิน $totalemer บาท <br>";
 print "รวมค่าห้องผ่าตัด  $totalsurg บาท <br>";
 print "รวมค่ากายภาพ  $totalphysi บาท <br>";
 print "รวมค่าทันตกรรม  $totaldenta บาท <br>";
 print "รวมค่าพยาธิ $totalpatho บาท <br>";
 print "รวมค่าเอกซเรย์ $totalxray บาท <br>";

 print "รวมค่ายา $totalphar บาท <br>";
 print "รวมค่าบริการ $totalfree บาท <br>";
 print "รวมค่าอื่นๆ $totalother บาท <br>";
    include("unconnect.inc");
?>
</table>



