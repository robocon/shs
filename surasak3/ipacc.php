<?php
session_start();
include_once dirname(__FILE__).'/connect.php';

$cAn = $_POST['cAn'];
if(empty($cAn)){
    $cAn = $_GET['cAn'];
}

$cAccno = $_POST['cAccno'];
if(empty($cAccno)){
    $cAccno = $_GET['cAccno'];
}

if(empty($cAn) && empty($cAccno)){
    ?>
    <p>กรุณาตรวจสอบ AN ให้ถูกต้อง</p>
    <?php
    exit;
}

$sqlIpcard = "SELECT `an`,`hn`,`ptname` FROM `ipcard` WHERE `an` = '$cAn'";
$qIpcard = mysql_query($sqlIpcard);
$ip = mysql_fetch_assoc($qIpcard);
?>
<h3>รายการค่ารักษาพยาบาล ของ <?= $ip['ptname']; ?> AN: <?= $ip['an']; ?></h3>
<table>
    <tr>
        <th bgcolor=#669999>
            <font face='Angsana New'>วันที่
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>แผนก
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>รายการ
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>จำนวน
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>ราคา
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>จ่าย
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>ประเภท
        </th>
        <th bgcolor=#669999>
            <font face='Angsana New'>จนท.
        </th>
    </tr>
    <?php
    $query = "SELECT `date`,`depart`,`detail`,`amount`,`price`,`paid`,`part`,`idname`,`nprice` FROM `ipacc` WHERE `an` = '$cAn' AND `accno`='$cAccno' ORDER BY `date` DESC";
    $result = mysql_query($query) or die("Query failed : " . mysql_error());
    while (list($date, $depart, $detail, $amount, $price, $paid, $part, $idname, $nprice) = mysql_fetch_row($result)) {
        $bgColor = '#C0C0C0';
        if ($nprice > 0) {
            $bgColor = '#ff9292';
        }
        print(" <tr style='background-color:$bgColor;'>\n" .
        "  <td><font face='Angsana New'>$date</td>\n" .
        "  <td><font face='Angsana New'>$depart</td>\n" .
        "  <td><font face='Angsana New'>$detail</td>\n" .
        "  <td><font face='Angsana New'>$amount</td>\n" .
        "  <td><font face='Angsana New'>$price</td>\n" .
        "  <td><font face='Angsana New'>$paid</td>\n" .
        "  <td><font face='Angsana New'>$part</td>\n" .
        "  <td><font face='Angsana New'>$idname</td>\n" .
        " </tr>\n");
    }
    ?>
</table>