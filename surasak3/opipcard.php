<?php
session_start();
$thidate = (date("Y")+543).date("-m-d H:i:s"); 
global $regisdate,$an,$sex,$married,$idcard,
           $warcard,$camp,$goup,$dbirth,$race,$national,$religion,$career,$ptright,$address,
            $tambol,$ampur,$changwat,$parent,$couple,$guardian;
 include("connect.inc");

if( empty($cHn) ){
    echo 'ไม่พบข้อมูล <a href="../nindex.htm">กลับไปหน้าหลัก รพ.</a>';
    exit;
}

$sql = "Select count(row_id) as rows_id From ipcard where date like '".substr($thidate,0,10)."%' AND hn = '".$cHn."' AND dcdate ='0000-00-00 00:00:00'";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

if($arr["rows_id"] > 0){
echo "<BR><BR><CENTER>ไม่สามารถ admit ได้เนื่องจากมี HN นี้อยู่ในรายการคนไข้ในแล้ว ยังไม่ได้จำหน่ายออกจากระบบ</CENTER>";
exit();
}


$query = "SELECT title,prefix,runno FROM runno WHERE title = 'AN'";
$result = mysql_query($query) or die("Query failed runno ask");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

$vTitle=$row->title;
$vPrefix=$row->prefix;
$aRunno_an=$row->runno;
$aRunno_an++;
$vAN=$vPrefix.$aRunno_an;

$sql = "INSERT INTO ipcard (date,an,hn)
              VALUES('$thidate','$vAN','$cHn');";

$result = mysql_query($sql) or die("หมายเลข AN $vAN ซ้ำ    ไม่สามารถบันทึกได้    โปรดทำรับป่วยใหม่ !");

// update AN to table runno
    $query ="UPDATE runno SET runno = $aRunno_an WHERE title='AN'";
    $result = mysql_query($query);
//        or die("Query failed runno update");

// ใส่ AN ใน opday table 
    $query ="UPDATE opday SET an = '$vAN' WHERE thdatehn = '$thdatehn' AND vn = '".$_SESSION['admit_vn']."' "; 
    $result = mysql_query($query);

//echo mysql_errno() . ": " . mysql_error(). "\n";
//echo "<br>";

print " ลงทะเบียนรับป่วยเรียบร้อย<br>";
print "  HN:  $cHn       AN: $vAN <br> ";
print "  $cPtname<br>"; 
print "สิทธิการรักษา : $cPtright<br>";
print "<a target=_TOP  href=\"dcsum.php?Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARY<br> ";
print "<a target=_TOP  href=\"dcsum.1.php?Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARYแบบใหม่<br> ";
print "<a target=_TOP  href=\"dcsum2.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบยินยอมสำหรับผู้ป่วย<br> ";
print "<a target=_TOP  href=\"dcsum3.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบยินยอมสำหรับญาติ<br> ";
//print "<a target=_TOP  href=\"dcsum4.php? Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำ<br> ";
print "<a target=_TOP  href=\"ancashdetail.php?Can=$vAN&Chn=$cHn\">ใบข้อมูลผู้ป่วยนอนโรงพยาบาล<br><br><br> ";

print "<a target=_TOP  href=\"dcsum5.1.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำเงินสด<br> ";
print "<a target=_TOP  href=\"dcsum5.2.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำกรมบัญชีกลาง<br> ";
print "<a target=_TOP  href=\"dcsum5.3.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำต้นสังกัด/รัฐวิสาหกิจ/องค์กรปกครองส่วนท้องถิ่น<br> ";
print "<a target=_TOP  href=\"dcsum5.4.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำบัตรประกันสังคม<br> ";
print "<a target=_TOP  href=\"dcsum5.5.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำบัตรสุขภาพถ้วนหน้า<br> ";
print "<a target=_TOP  href=\"dcsum5.6.php?Can=$vAN&Chn=$cHn\">พิมพ์ ใบคำแนะคำ พรบ<br> ";
session_unregister("admit_vn");
include("unconnect.inc");
/*
    session_unregister("cHn");  
    session_unregister("cPtname");
    session_unregister("cPtright");
    session_unregister("nVn");  
*/
//session_destroy();
?>


