<?php 
include("connect.inc");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <title>รายละเอียดงาน</title>
</head>
<body>
<style type="text/css">
    body,td,th {
        font-family: "TH SarabunPSK";
        font-size: 20px;
    }
</style>
<a target="_self"  href="com_support.php" class="forntsarabun" style="text-decoration:none;">&lt;&lt;&nbsp;กลับหน้าเมนูแจ้งซ่อม</a>
<hr>
<?php
$Thaidate = date("d-m-") . (date("Y") + 543);
print "<FONT SIZE='3'><CENTER>แบบรายงายการขอแก้ไข/เพิ่มเติมโปรแกรมในระบบคอมพิวเตอร์เครือข่าย<BR>";
print "ศูนย์คอมพิวเตอร์ โรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง โทร 8500 หรือ 6203<BR></CENTER></FONT>";
$num = 'Y';
$query = "SELECT `row`,`depart`,`head`,`datetime`,`programmer`,`date`,`detail`,`user1`,`phone` FROM com_support WHERE `row`=$row  ";
$result = mysql_query($query) or die("Query failed111");
if (mysql_num_rows($result)) {
    print "<BR><BR><CENTER><table width='100%' style=\"table-layout: fixed;\">";
    print " <tr align='center'>";
    print "  <th bgcolor=CD853F width=\"50\">ลำดับ</th>";
    print "  <th bgcolor=CD853F width=\"100\">แผนก</th>";
    print "  <th bgcolor=CD853F width=\"250\">หัวข้อ</th>";
    print "  <th bgcolor=CD853F>รายละเอียด</th>";
    print "  <th bgcolor=CD853F width=\"160\">วันเวลาที่ร้องขอ</th>";
    print "  <th bgcolor=CD853F width=\"100\">ผู้ร้องขอ</th>";
    print "  <th bgcolor=CD853F width=\"80\">เบอร์ติดต่อ</th>";
    print " </tr>";
    while (list($row, $depart, $head, $datetime, $programmer, $date, $detail, $user1, $tel) = mysql_fetch_row($result)) {
        print(" <tr valign=\"top\">\n" .
            "  <td BGCOLOR=F5DEB3>$row</td>\n" .
            "  <td BGCOLOR=F5DEB3>$depart</td>\n" .
            "  <td BGCOLOR=F5DEB3>$head</a></td>\n" .
            "  <td BGCOLOR=F5DEB3 style=\"overflow: auto;\">" . html_entity_decode($detail) . "</td>\n" .
            "  <td BGCOLOR=F5DEB3>$date</td>\n" .
            "  <td BGCOLOR=F5DEB3>$user1</td>\n" .
            "  <td BGCOLOR=F5DEB3>$tel</td>\n" .
            " </tr>\n");
    }
    print "</table></CENTER>";
}

$row = sprintf("%s", $_GET['row']);
$sql = "SELECT * FROM `com_support_details` WHERE `com_id` = '$row' ";
$q = mysql_query($sql);
if (mysql_num_rows($q) > 0) {
    ?>
    <br>
    <h3>รายละเอียดที่ดำเนินการ</h3>
    <table width="100%">
        <tr valign="top" bgcolor="#FFCC00">
            <th width="20%">วันที่อัพเดทข้อมูล</th>
            <th>รายละเอียด</th>
        </tr>
    <?php
    while ($a = mysql_fetch_assoc($q)) {
    ?>
    <tr bgcolor="#FFFF99">
        <td><?=$a['date'];?></td>
        <td>
            <?= nl2br($a['detail']); ?>
            <?php
            $detail_id = $a['id'];
            $sql_img = "SELECT `path` FROM `com_support_imgs` WHERE `detail_id` = '$detail_id' ";
            $q_img = mysql_query($sql_img);
            if (mysql_num_rows($q_img) > 0) {
                ?>
                <div class="clearfix">
                    <?php
                    while ($b = mysql_fetch_assoc($q_img)) {
                    ?>
                        <a href="<?= $b['path']; ?>" target="_blank"><img style="height:150px;" src="<?= $b['path']; ?>" alt=""></a>
                    <?php
                    }
                    ?>
                </div>
                <?php
            }
            ?>
        </td>
    </tr>
    <?php
    }
}
include("unconnect.inc");
?>
</body>
</html>