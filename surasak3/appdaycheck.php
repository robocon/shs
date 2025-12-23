<?php
include_once dirname(__FILE__).'/bootstrap.php';
if(empty($_SESSION['sOfficer'])){
    include 'pageNotFound.php';
    exit;
}
?>
<style>
    body {
        font-family: "TH SarabunPSK";
        font-size: 18px;
    }
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
<div class="clearfix">
    <div>
        <a target=_self href='../nindex.htm'> &lt;&lt;ไปเมนู</a>
    </div>
    <div style="float:left;">
        <form method="post" action="appdaycheck.php">
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ตรวจสอบจำนวนครั้งที่นัดมาโรงพยาบาล</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; HN&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="text" name="hn" size="12" required>
            </p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                <input type="submit" value="      ตกลง      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            </p>
        </form>
    </div>
    <div style="float:left; margin-left:1em;">
        <form action="appdaycheck.php" method="post">
            <p>ค้นหาจากเลขบัตรประชาชน</p>
            <p>เลขบัตร <input type="text" name="idcard" id="idcard" required></p>
            <p><button type="submit">ค้นหา</button></p>
        </form>
    </div>
</div>
<?php
$hn = $_REQUEST['hn'];
if(!empty($hn) OR !empty($_POST['idcard'])){

    $month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฎาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";

    $months_key = array('มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
    $months_val = array('01','02','03','04','05','06','07','08','09','10','11','12');

    $day_now = date("d");
    $month_now = date("m");
    $year_now = (date("Y") + 543);

    $select_day2 = $day_now . " " . $month[$month_now] . " " . $year_now;

    ///บวกวันที่เพิ่มขึ้นอีก 1 วัน
    $timestamp = strtotime("+1 days");
    $newtimestamp = date("Y-m-d", $timestamp);
    list($ty, $tm, $td) = explode("-", $newtimestamp);
    $ty = $ty + 543;
    $select_tomorow = $td . " " . $month[$tm] . " " . $ty;

    if(!empty($_POST['idcard'])){
        $sql = sprintf("SELECT `hn` FROM `opcard` WHERE `idcard` = '%s' ", mysql_real_escape_string($_POST['idcard']));
        $q = mysql_query($sql) or die(mysql_error());

        $opcardRows = mysql_num_rows($q);
        if($opcardRows==0){
            ?>
            <p style="color:red;">ไม่พบข้อมูลจากเลขบัตรประชาชน <?= $_POST['idcard'] ?></p>
            <?php
            exit;
        }
        $opcard = mysql_fetch_assoc($q);
        $hn = $opcard['hn'];
    }
    
    $query = "SELECT a.`row_id`,a.`hn`,a.`ptname`,a.`doctor`,a.`appdate`,a.`apptime`,a.`detail`,a.`patho`,a.`xray`,a.`other`,a.`date`,a.`injno`, 
    CASE WHEN `appdate` = '" . $select_day2 . "'  THEN '#009966' 
        WHEN `appdate` = '" . $select_tomorow . "'  THEN '#FF6699' ELSE '#F5DEB3' 
    END AS `color`  
    FROM `appoint` AS a 

    RIGHT JOIN (
        SELECT MAX(`row_id`) AS `row_id`, SUBSTRING(`doctor`, 1, 5) as `doctor_code`
        FROM `appoint` 
        WHERE `hn` = '$hn' 
        GROUP BY `appdate`,`apptime`,`doctor_code`,`detail`,`room` 
    ) AS b ON b.`row_id` = a.`row_id` 

    ORDER BY a.`date` DESC ";
    $result = mysql_query($query) or die(mysql_error());
    $appRows = mysql_num_rows($result);
    if($appRows===0){
        ?>
        <p style="color:red;"><b>ไม่พบการนัด</b></p>
        <?php
        exit;
    }

?>
<table>
    <tr>
        <th bgcolor=CD853F>HN</th>
        <th bgcolor=CD853F>ชื่อ-สกุล</th>
        <th bgcolor=CD853F>แพทย์</th>
        <th bgcolor=CD853F>วันนัด</th>
        <th bgcolor=CD853F>นัดเพื่อ</th>
        <th bgcolor=CD853F>เวลานัด</th>
        <th bgcolor=CD853F>แลบ</th>
        <th bgcolor=CD853F>เอกซเรย์</th>
        <th bgcolor=CD853F>อื่น</th>
        <th width='10%' bgcolor=CD853F>ดำเนินการ</th>
    </tr>
    <?php

    $items = array();
    $i = 1;
    while ($item = mysql_fetch_assoc($result)) {

        list($testAppDate, $appTime) = explode(' ', $item['date']);

        //
        if (!preg_match('/\d+\-\d+\-\d+/', $item['appdate'])) {
            $appdate = str_replace($months_key, $months_val, trim($item['appdate']));
            list($d, $m, $y) = explode(' ', $appdate);
        } else {
            list($y, $m, $d) = explode('-', $item['appdate']);
        }

        // $appoint_date = strtotime(($y-543)."-$m-$d $appTime");
        $new_date = strtotime(($y - 543) . "-$m-$d $appTime");
        $items[$new_date] = $item; // ตั้งคีย์ใหม่เอาไว้สำหรับ sort ตามวันนัด
        $i++;
    }

    krsort($items); // ให้เรียงตามคีย์ที่ตั้งไว้

    foreach ($items as $key => $item) {

        $doctor = $item['doctor'];
        if (preg_match("/^MD/", $item['doctor']) == true) {
            $doctor = substr($item['doctor'], 6);
        }


        if ($item['apptime'] == "ยกเลิกการนัด") {
            $edit = "";
        } else {
            $edit = "แก้ไขใบนัด";
        }

        print(" <tr>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'><A HREF=\"appinsert2.php?row_id=" . $item['row_id'] . "\" target=\"_blank\">{$item['hn']}</A></td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'><A HREF=\"appdayprint.php?row_id=" . $item['row_id'] . "\" target=\"_blank\">{$item['ptname']}</A></td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'>" . $doctor . "</td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "' title=\"ออกใบนัดเมื่อ {$item['date']}\">{$item['appdate']}</td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'>{$item['detail']}</td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'>{$item['apptime']}</td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'>{$item['patho']}</td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'>{$item['xray']}</td>\n" .
        "  <td BGCOLOR='" . $item['color'] . "'>{$item['other']}{$item['injno']}</td>\n" .
        "  <td align='center' BGCOLOR='" . $item['color'] . "'><a target=_blank  href=\"appoint_update.php?row_id=" . $item['row_id'] . "\">$edit</a></td>\n" .
        " </tr>\n");
    } // end foreach
    
    ?>
</table>
<?php
}