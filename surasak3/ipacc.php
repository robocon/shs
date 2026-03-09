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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายการค่ารักษาพยาบาล HN: <?= $ip['hn']; ?></title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<style>
*{
    font-family: "TH SarabunPSK";
    font-size: 16pt;
}
</style>
<div class="p-2">

<h3 class="">รายการค่ารักษาพยาบาล ของ <?= $ip['ptname']; ?> AN: <?= $ip['an']; ?> HN: <?= $ip['hn']; ?></h3>
<table class="mt-2">
    <tr style="background-color:#006666; color:#ffffff;">
        <th>วันที่</th>
        <th>แผนก</th>
        <th>รายการ</th>
        <th>จำนวน</th>
        <th>ราคา</th>
        <th>จ่าย</th>
        <th>ประเภท</th>
        <th>จนท.</th>
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
        "<td>$date</td>\n" .
        "<td>$depart</td>\n" .
        "<td>$detail</td>\n" .
        "<td>$amount</td>\n" .
        "<td>$price</td>\n" .
        "<td>$paid</td>\n" .
        "<td>$part</td>\n" .
        "<td>$idname</td>\n" .
        " </tr>\n");
    }
    ?>
</table>
</div>
</body>
</html>