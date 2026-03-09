<?php
session_start();
include_once dirname(__FILE__) . '/connect.php';

// ถ้าแพทย์เข้าใช้หน้านัดพยาบาลให้เด้งกลับไปหน้าแพทย์เหมือนเดิม
if ($_SESSION['smenucode'] === 'ADMDR1') {
    header("Location: dt_index.php");
    exit;
}

if ($_SESSION["sOfficer"] == "") {
    echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
    echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
    exit();
}
session_unregister("cHn");
session_unregister("cPtname");
session_unregister("cAge");
session_unregister("cptright");
session_unregister("capptime");
session_unregister("cnote");
session_unregister("cidguard");
?>
<style>
    body,td,th {
        font-family: "TH SarabunPSK";
        font-size: 20px;
        th,td {
            padding: 8px;
            /* text-align: left; */
            /* border-bottom: 2px solid #d2b4de; */
        }
    }
    table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
    }
    a:hover{
        text-shadow: 3px 3px 3px #979797;
    }
</style>

<a target=_top href="../nindex.htm">&lt;&lt; เมนู</a>&nbsp;|&nbsp;
<a target=_self href='appoilst.php'>ดูรายชื่อผู้ป่วยนัด</a>&nbsp;|&nbsp;
<a href="appoint_edit.php" target="_blank">แก้ไข LAB,X-Ray ใบนัด</a>&nbsp;|&nbsp;
<a href="reprint_wound.php" target="_blank">ใบนัดทำแผลย้อนหลัง</a>&nbsp;|&nbsp;
<a href="reprint_inj_appoint.php" target="_blank">ใบนัดฉีดยาย้อนหลัง</a>

<form method="post" action="hnappoi1.php" style="padding-left:8px;">
    <h1>ออกใบนัดผู้ป่วย</h1>
    <p>HN : <input type="text" name="apphn" id="apphn" size="12" id="aLink"></p>
    <p><input type="submit" value="  ตกลง  " name="B1"></p>
    <script type="text/javascript">
        document.getElementById('aLink').focus();
    </script>
</form>
<?php
$chkhn = trim($_POST['apphn']);
if (!empty($chkhn)) {
?>
<p><strong style="color:red; padding-left:8px;">คำเตือน</strong> ..... การออกใบนัด กรุณาอย่าใช้อักษรที่พิเศษเช่น ( , " ' เป็นต้น) อาจทำให้ข้อมูลไม่สามารถบันทึกลงในคอมพิวเตอร์</p>
<p style="padding-left:8px; font-size:24pt;"><strong>กรุณาตรวจสอบข้อมูลของผู้ป่วยให้ถูกต้อง เพื่อดำเนินการต่อไป...</strong></p>
<table width="80%" border="1">
    <tr style="background-color: #006666; color: #ffffff;">
        <th>ออกใบนัด</th>
        <th>เลขบัตรประชาชน</th>
        <th>ยศ</th>
        <th>ตรวจนัด</th>
        <th>สกุล</th>
        <th>สิทธิ</th>
        <th>หมายเหตุ</th>
    </tr>
    <?php
    $query = "SELECT hn,yot,name,surname,dbirth,ptright,note,idguard,idcard FROM opcard WHERE hn = '$chkhn'";
    $result = mysql_query($query)or die("Query failed");
    while (list($hn, $yot, $name, $surname, $dbirth, $ptright, $note, $idguard, $idcard) = mysql_fetch_row($result)) {
        print("<tr>\n" .
        "  <td style='font-size:28px;font-weight:bold;'><a href=\"preappoi1.php?cHn=$hn&chkhn=$hn&chkidcard=$idcard&cYot=".rawurlencode($yot)."&cName=".rawurlencode($name)."&cSurname=".rawurlencode($surname)."&Age=$dbirth&ptright=".rawurlencode($ptright)."&note=".rawurlencode($note)."&idguard=".rawurlencode($idguard) . "\">$hn</a></td>\n" .
        "  <td>$idcard</td>\n" .
        "  <td>$yot</td>\n" .
        "  <td><a target= _BLANK href=\"appdaycheck.php?hn=$hn\">$name</a></td>\n" .
        "  <td>$surname</td>\n" .
        "  <td>$ptright</td>\n" .
        "  <td>$idguard</td>\n" .
        " </tr>\n");
    }
    ?>
</table>
<?php
$sql = "SELECT `row_id`,`appdate`,`detail`,`room`,`apptime`,`doctor` FROM `appoint` WHERE `appdate_en` > CURDATE() AND `hn` = '$chkhn' AND `apptime` != 'ยกเลิกการนัด' ORDER BY `appdate_en` ASC";
$q = mysql_query($sql);
$rows = mysql_num_rows($q);
if($rows>0){
    ?>
    <table style="margin-top:1em;">
        <tr style="background-color: #006666; color: #ffffff;">
            <th>นัดครั้งต่อไป วันที่</th>
            <th>นัดเพื่อ</th>
            <th>จุดนัด</th>
            <th>เวลา</th>
            <th>พบแพทย์</th>
        </tr>
    
    <?php
    while ($a = mysql_fetch_assoc($q)) {
        ?>
        <tr>
            <td><a href="appinsert2.php?row_id=<?= $a['row_id'] ?>" target="_blank"><?= $a['appdate']; ?></a></td>
            <td><?= $a['detail']; ?></td>
            <td><?= $a['room']; ?></td>
            <td><?= $a['apptime']; ?></td>
            <td><?= $a['doctor']; ?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
}

}else{
    ?>
    <p><strong>กรุณากรอก HN</strong></p>
    <?php
}
?>