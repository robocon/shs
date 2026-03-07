<?php
include_once dirname(__FILE__).'/bootstrap.php';

$yrmonth = $_POST['yrmonth'];
if(empty($yrmonth)){
    ?>
    <p>กรุณาเลือกวันที่</p>
    <p><a href="javascript:history.back();">ย้อนกลับ</a></p>
    <?php
    exit;
}

$query = "CREATE TEMPORARY TABLE opday1 SELECT * FROM opday WHERE thidate LIKE '$yrmonth%'  ";
$result = mysql_query($query) or die("Query failed,opday");
?>
<p><a target=_self  href='../nindex.htm'>&lt;&lt;ไปเมนู</a> | <a href="tabundetel.php">เลือกวันที่</a> | <a href="javascript:location.reload();">Refresh ข้อมูลใหม่</a></p>
<p>&nbsp;</p>
<p>รายงานประจำ <?= $yrmonth ?></p>
<?php
$query = "SELECT  toborow ,COUNT(*) AS duplicate FROM opday1 GROUP BY toborow HAVING duplicate > 0 ORDER BY toborow";
$result = mysql_query($query);

$numRowsOpday = mysql_num_rows($result);
if($numRowsOpday==0){
    ?>
    <p><strong>ไม่พบข้อมูล กรุณาเลือกวันที่ใหม่อีกครั้ง</strong></p>
    <?php
    exit;
}

$n = 0;
$sum = 0;
while (list($toborow, $duplicate) = mysql_fetch_row($result)) {
    $n++;
    print(" <tr>\n" .
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n" .
        "  <td BGCOLOR=66CDAA><font face='Angsana New'><a target=_BLANK href=\"chktbdetel.php?toborow=" . urlencode($toborow) . "&today=$yrmonth\">$toborow&nbsp;&nbsp;</a></td>\n" .
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n" .
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน = $duplicate</td>\n" .
        " </tr>\n<br>");
    $sum = $sum + $duplicate;
}

print(" <tr>\n" .
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>&nbsp;</td>\n" .
    "  <td BGCOLOR=66CDAA><font face='Angsana New'>รวมทั้งหมด</td>\n" .
    "  <td BGCOLOR=66CDAA colspan=\"2\">$sum</td>\n" .
    " </tr>\n<br>");
?>
<style>
    p{
        margin:0;
        padding:0;
    }
</style>
<h3>แยกตามสิทธิ์</h3>
<table border="1">
    <tr>
        <th>#</th>
        <th>สิทธิ</th>
        <th>จำนวน</th>
    </tr>
    <?php
    $i = 1;
    $sql = "SELECT COUNT(a.`row_id`) AS `rows`, a.`ptCode`, b.`name` 
    FROM ( 
    SELECT `row_id`,`ptname`, SUBSTRING(`ptright`,1,3) AS `ptCode`
    FROM `opday` 
    WHERE `thidate` LIKE '$yrmonth%' 
    ) AS a 
    LEFT JOIN `ptright` AS b ON b.`code` = a.`ptCode` 
    GROUP BY a.`ptCode` 
    ORDER BY a.`ptCode` ";
    $q = $dbi->query($sql);
    while ($item = $q->fetch_assoc()) {
    ?>
        <tr>
            <td><?= $i; ?></td>
            <td><?= $item['ptCode'] . ' ' . $item['name']; ?></td>
            <td><?= $item['rows']; ?></td>
        </tr>
    <?php
        $i++;
    }
    ?>
</table>
<p>&nbsp;</p>
<div>
    <?php
    $sql = "SELECT `row_id`,`hn`,`thidate`,`ptname`, SUBSTRING(`ptright`,1,3) AS `ptCode`
    FROM `opday` 
    WHERE `thidate` LIKE '$yrmonth%' AND `ptright` LIKE 'R07%'";
    $qSSO = $dbi->query($sql);
    $inTime = array();
    $outTime = array();
    if($qSSO->num_rows>0){
        while ($a = $qSSO->fetch_assoc()) {
            list($date, $time) = explode(' ', $a['thidate']);
            if($time >= "08:30:00" && $time <= "16:00:00"){
                $inTime[] = array('thidate'=>$a['thidate'], 'hn'=>$a['hn'], 'ptname'=>$a['ptname']);
            }else{
                $outTime[] = array('thidate'=>$a['thidate'], 'hn'=>$a['hn'], 'ptname'=>$a['ptname']);;
            }
        }
    }
    ?>
    <table>
        <tr>
            <td colspan="2" style="text-align:center;"><p><strong>ยอดผู้ใช้บริการ ประกันสังคม (R07)</strong></p></td>
        </tr>
        <tr>
            <td style="text-align:center;"><strong>ในเวลา <?=COUNT($inTime); ?> ราย</strong></td>
            <td style="text-align:center;"><strong>นอกเวลา <?=COUNT($outTime); ?> ราย</strong></td>
        </tr>
        <tr valign="top">
            <td>
                <table>
                    <tr>
                        <td>วันที่</td>
                        <td>HN</td>
                        <td>ชื่อ-สกุล</td>
                    </tr>
                    <?php
                    foreach ($inTime as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['thidate'] ?></td>
                            <td><?= $value['hn'] ?></td>
                            <td><?= $value['ptname'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </td>
            <td>
                <table>
                    <tr>
                        <td>วันที่</td>
                        <td>HN</td>
                        <td>ชื่อ-สกุล</td>
                    </tr>
                    <?php
                    foreach ($outTime as $key => $value) {
                        ?>
                        <tr>
                            <td><?= $value['thidate'] ?></td>
                            <td><?= $value['hn'] ?></td>
                            <td><?= $value['ptname'] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </td>
        </tr>
    </table>
</div>