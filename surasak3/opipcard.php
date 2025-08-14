<?php
session_start();
include("connect.php");
global $regisdate, $an, $sex, $married, $idcard,
$warcard, $camp, $goup, $dbirth, $race, $national, $religion, $career, $ptright, $address,
$tambol, $ampur, $changwat, $parent, $couple, $guardian;

$thidate = (date("Y") + 543) . date("-m-d");
$cHn = sprintf('%s', mysql_real_escape_string($_GET['cHn']));
$thdatehn = date('d-m-').(date("Y") + 543).$cHn;

if (empty($cHn)) {
    echo 'ไม่พบข้อมูล <a href="../nindex.htm">กลับไปหน้าหลัก รพ.</a>';
    exit;
}

$sql = "Select count(row_id) as rows_id,an From ipcard where date like '$thidate%' AND hn = '$cHn' AND dcdate ='0000-00-00 00:00:00'";
$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);
if ($arr["rows_id"] > 0) {
    ?>
    <div style="text-align:center;">
        <p>ไม่สามารถ admit ได้เนื่องจากมี HN นี้อยู่ในรายการคนไข้ในแล้ว ยังไม่ได้จำหน่ายออกจากระบบ</p>
        <p><a href="opipcard2.php?Can=<?=$arr['an'];?>">คลิกที่นี่</a> เพื่อไปยังหน้าพิมพ์เอกสารย้อนหลัง</p>
    </div>
    <?php
    exit();
}


$query = "SELECT title,prefix,runno FROM runno WHERE title = 'AN'";
$result = mysql_query($query) or die("Query failed runno ask");

for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
    if (!mysql_data_seek($result, $i)) {
        echo "Cannot seek to row $i\n";
        continue;
    }

    if (!($row = mysql_fetch_object($result)))
        continue;
}

$vTitle = $row->title;
$vPrefix = $row->prefix;
$aRunno_an = $row->runno;
$aRunno_an++;
$vAN = $vPrefix . $aRunno_an;


$sql112 = "Select ptname,thidate,ptright From opday where thdatehn = '$thdatehn' order by row_id desc limit 1 ";
$result112 = Mysql_Query($sql112);
list($ptname, $admit_date, $ptright) = Mysql_fetch_row($result112);

$sql = "INSERT INTO `ipcard` (`date`,`an`,`hn`) VALUES('$admit_date','$vAN','$cHn');";
$result = mysql_query($sql) or die("หมายเลข AN $vAN ซ้ำ    ไม่สามารถบันทึกได้    โปรดทำรับป่วยใหม่ !");

// update AN to table runno
$query = "UPDATE runno SET runno = $aRunno_an WHERE title='AN'";
$result = mysql_query($query);

// ใส่ AN ใน opday table 
$query = "UPDATE opday SET an = '$vAN' WHERE thdatehn = '$thdatehn' AND vn = '" . $_SESSION['admit_vn'] . "' ";
$result = mysql_query($query);

?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
</style>
<h3>ลงทะเบียนรับป่วยเรียบร้อย</h3>
<fieldset>
    <legend>ข้อมูลผู้ป่วย</legend>
    <table>
        <tr>
            <td align="right">HN : </td>
            <td><?=$cHn;?></td>
        </tr>
        <tr>
            <td align="right">AN : </td>
            <td><?=$vAN;?></td>
        </tr>
        <tr>
            <td align="right">ชื่อ-สกุล : </td>
            <td><?=$ptname;?></td>
        </tr>
        <tr>
            <td align="right">สิทธิการรักษา : </td>
            <td><?=$ptright;?></td>
        </tr>
    </table>
</fieldset>
<?php
// print "<a target=_TOP  href=\"dcsum.php?Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARY<br> ";
// print "<a target=_TOP  href=\"dcsum.1.php?Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARYแบบใหม่<br><br>";
print "<hr>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank'  href=\"ipadmitdate.php?Can=$vAN\">แก้ไขเวลาที่ Admit";
print "<hr>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank'  href=\"discharge_summary_2019.php?Can=$vAN\">พิมพ์ DISCHARGE SUMMARY <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank'  href=\"clinical_summary_2019.php?an=$vAN\">พิมพ์ Clinical Summary <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br><br>";

print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank'  href=\"discharge_summary_2019_eye.php?Can=$vAN\">พิมพ์ DISCHARGE SUMMARY ต้อกระจก <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank'  href=\"clinical_summary_2019_eye.php?an=$vAN\">พิมพ์ Clinical Summary ต้อกระจก <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br><br> ";

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
