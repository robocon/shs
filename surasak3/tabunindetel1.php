<?php
include("connect.inc");

$arrptright["R01"]="เงินสด";
$arrptright["R02"]="เบิกคลังจังหวัด";
$arrptright["R03"]="โครงการเบิกจ่ายตรง";
$arrptright["R04"]="รัฐวิสาหกิจ";   
$arrptright["R05"]="บริษัท(มหาชน)";
$arrptright["R06"]="พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ";
$arrptright["R07"]="ประกันสังคม";
$arrptright["R08"]="ก.ท.44(บาดเจ็บในงาน)";
$arrptright["R09"]="ประกันสุขภาพถ้วนหน้า";
$arrptright["R10"]="ประกันสุขภาพถ้วนหน้า(เด็กเกิดใหม่)";
$arrptright["R11"]="ประกันสุขภาพถ้วนหน้า(มาตรา8)";
$arrptright["R12"]="ประกันสุขภาพถ้วนหน้า(ทหารผ่านศึก/ผู้พิการ)";
$arrptright["R13"]="ประกันสุขภาพถ้วนหน้า(ในจังหวัดฉุกเฉิน)";
$arrptright["R14"]="ประกันสุขภาพถ้วนหน้า(นอกจังหวัดฉุกเฉิน)";
$arrptright["R15"]="ประกันสุขภาพนักเรียน(บริษัท)";
$arrptright["R16"]="ศึกษาธิการ(ครูเอกชน)";
$arrptright["R17"]="พลทหาร";
$arrptright["R18"]="โครงการรักษาโรคไต (HD)";
$arrptright["R19"]="โครงการนภา(NAPA)";
$arrptright["R20"]="ประกันสังคมกรณีคลอดบุตร";
$arrptright["R21"]="องค์กรปกครองส่วนท้องถิ่น";
$arrptright["R22"]="ตรวจสุขภาพประจำปีกองทัพบก";
$arrptright["R23"]="นักเรียน/นักศึกษาทหาร";

$query="CREATE TEMPORARY TABLE ipcard1 SELECT * FROM ipcard WHERE date LIKE '$yrmonth%'  AND ( date_format( `date`, '%H:%i:%s' ) between '08:00:00' AND '16:00:00')";
$result = mysql_query($query) or die("Query failed,ipcard");

$query="CREATE TEMPORARY TABLE ipcard2 SELECT * FROM ipcard WHERE date LIKE '$yrmonth%'  AND ( date_format( `date`, '%H:%i:%s' ) not between '08:00:00' AND '16:00:00')";
$result = mysql_query($query) or die("Query failed,ipcard");

$query="SELECT  left(ptright,3) ,COUNT(*) AS duplicate FROM ipcard1 GROUP BY left(ptright,3) HAVING duplicate > 0 ORDER BY ptright";
$result = mysql_query($query);
$n=0;
$sum = 0;
$sum1 = 0;

print "<table><tr><td colspan=\"4\">รายงานประจำ  $yrmonth (ในเวลาราชการ) <a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a></td></tr>";
	while (list ($ptright,$duplicate) = mysql_fetch_row ($result)) {
		if(trim($ptright) !=""){
		$n++;
		
		print (" <tr>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbindetel.php? ptright=$ptright&yrmonth=$yrmonth\">".$arrptright[$ptright]."&nbsp;&nbsp;</a></td>\n".
 
		//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน = $duplicate</td>\n".
		" </tr>\n");
		$sum = $sum + $duplicate;
		}
	}
print "<tr BGCOLOR=66CDAA><td colspan='3' align='center'><font face='Angsana New'>รวม</td><td><font face='Angsana New'>".$sum."</td></tr>";
print "</table>";

$query="SELECT  left(ptright,3) ,COUNT(*) AS duplicate FROM ipcard2 GROUP BY left(ptright,3) HAVING duplicate > 0 ORDER BY ptright";
$result = mysql_query($query);
$n=0;

$sum1 = $sum1 + $sum;
print "<table><tr><td colspan=\"4\">รายงานประจำ  $yrmonth (นอกเวลาราชการ) <a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a></td></tr>";
	while (list ($ptright,$duplicate) = mysql_fetch_row ($result)) {
		if(trim($ptright) !=""){
		$n++;
		print (" <tr>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbindetel.php? ptright=$ptright&yrmonth=$yrmonth\">".$arrptright[$ptright]."&nbsp;&nbsp;</a></td>\n".

		//    "  <td BGCOLOR=66CDAA><font face='Angsana New'></td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
		"  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน = $duplicate</td>\n".
		" </tr>\n");
		$sum2 = $sum2 + $duplicate;
		}
	}
$sum1 = $sum1 + $sum2;
print "<tr BGCOLOR=66CDAA><td colspan='3' align='center'><font face='Angsana New'>รวม</td><td><font face='Angsana New'>".$sum2."</td></tr>";
print "</table>";
print "รวมทั้งหมด : ".$sum1;
include("unconnect.inc");
?>


