

<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 


 include("connect.inc");
 
 $cAn=$_GET['Can'];

$sql = "Select  *  From ipcard where an= '".$cAn."' ";
$result = mysql_query($sql);
$arr = mysql_fetch_assoc($result);

$cHn=$arr['hn'];
$vAN=$arr['an'];
$cPtname=$arr['ptname'];
$cPtright=$arr['ptright'];

print "<fieldset><legend>ข้อมูลผู้ป่วย</legend>";

print "  HN:  $cHn       AN: $vAN <br> ";
print "  $cPtname<br>"; 
print "สิทธิการรักษา : $cPtright<br>";

print "</fieldset>";

print "<br><hr><br>";

print "<a target=_TOP  href=\"dcsum.php? Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARY แบบเก่า<br> ";

print "<a target=_TOP  href=\"dcsum.1.php? Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARY  แบบใหม่ <br> ";

print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target=_TOP  href=\"discharge_summary_2019.php?Can=$vAN\">พิมพ์ DISCHARGE SUMMARY (เริ่มใช้ 4 มี.ค. 62)<br> ";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target=_TOP  href=\"clinical_summary_2019.php?an=$vAN\">พิมพ์ Clinical Summary (เริ่มใช้ 4 มี.ค. 62 ใช้กระดาษ A5)<br> ";

print "<a target=_TOP  href=\"dcsum2.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบยินยอมสำหรับผู้ป่วย<br> ";
print "<a target=_TOP  href=\"dcsum3.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบยินยอมสำหรับญาติ<br> ";
print "<a target=_TOP  href=\"dcsum4.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำ<br> ";
print "<a target=_TOP  href=\"ancashdetail.php? Can=$vAN&Chn=$cHn\">ใบข้อมูลผู้ป่วยนอนโรงพยาบาล<br><br><br> ";

print "<a target=_TOP  href=\"dcsum5.1.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะนำ เงินสด<br> ";
print "<a target=_TOP  href=\"dcsum5.2.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะนำ กรมบัญชีกลาง<br> ";
print "<a target=_TOP  href=\"dcsum5.3.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะนำ ต้นสังกัด/รัฐวิสาหกิจ/องค์กรปกครองส่วนท้องถิ่น<br> ";
print "<a target=_TOP  href=\"dcsum5.4.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะนำ บัตรประกันสังคม<br> ";
print "<a target=_TOP  href=\"dcsum5.5.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะนำ บัตรสุขภาพถ้วนหน้า<br> ";
print "<a target=_TOP  href=\"dcsum5.6.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะนำ พรบ<br> ";

include("unconnect.inc");
/*
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
*/
//session_destroy();
?>


