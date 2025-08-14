<?php
session_start();
include("connect.php");

$cAn = $_GET['Can'];
$sql = "Select  *  From ipcard where an= '$cAn' ";
$result = mysql_query($sql);
$arr = mysql_fetch_assoc($result);
$cHn = $arr['hn'];
$vAN = $arr['an'];
$cPtname = $arr['ptname'];
$cPtright = $arr['ptright'];

if(empty($cPtname)){
    $sql = "SELECT `ptname`,`ptright` FROM `opday` WHERE `hn` = '$cHn' AND `an` IS NOT NULL ORDER BY `row_id` DESC LIMIT 1 ";
    $q = mysql_query($sql);
    $r = mysql_fetch_assoc($q);
    $cPtname = $r['ptname'];
    $cPtright = $r['ptright'];
}
?>
<fieldset>
    <legend>ข้อมูลผู้ป่วย</legend>
    <table>
        <tr>
            <td align="right">HN : </td>
            <td><?= $cHn; ?></td>
        </tr>
        <tr>
            <td align="right">AN : </td>
            <td><?= $vAN; ?></td>
        </tr>
        <tr>
            <td align="right">ชื่อ-สกุล : </td>
            <td><?= $cPtname; ?></td>
        </tr>
        <tr>
            <td align="right">สิทธิการรักษา : </td>
            <td><?= $cPtright; ?></td>
        </tr>
    </table>
</fieldset>
<?php
// print "<a target=_TOP  href=\"dcsum.php? Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARY แบบเก่า<br> ";
// print "<a target=_TOP  href=\"dcsum.1.php? Can=$vAN&Chn=$cHn\">พิมพ์ DISCHARGE SUMMARY  แบบใหม่ <br><br> ";
print "<hr>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank'  href=\"ipadmitdate.php?Can=$vAN\">แก้ไขเวลาที่ Admit";
print "<hr>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank' href=\"discharge_summary_2019.php?Can=$vAN\">พิมพ์ DISCHARGE SUMMARY <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank' href=\"clinical_summary_2019.php?an=$vAN\">พิมพ์ Clinical Summary <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br><br> ";

print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank' href=\"discharge_summary_2019_eye.php?Can=$vAN\">พิมพ์ DISCHARGE SUMMARY ต้อกระจก <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br>";
print "<span style='color: red;'>(ใหม่)</span>&nbsp;<a target='_blank' href=\"clinical_summary_2019_eye.php?an=$vAN\">พิมพ์ Clinical Summary ต้อกระจก <span style='color: red; font-weight:bold;'>(เริ่มใช้ 1 เม.ย. 66)</span><br><br> ";

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