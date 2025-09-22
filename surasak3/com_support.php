<?php
include 'connect.php';
include 'bootstrap.php';
if(empty($_SESSION['sIdname'])){
    ?>
    <p>Session หมดอายุ กรุณา <a href="../nindex.htm">Login</a> อีกครั้ง</p>
    <?php
    exit;
}
?>
<!-- อัพเดท เวอร์ชั่นใหม่ๆ ได้ที่ https://github.com/sweetalert2/sweetalert2/releases -->
<script src="js/sweetalert2.all.min.js"></script>
<style type="text/css">
    .forntsarabun {font-family: "TH SarabunPSK";font-size: 22px;}
    a:link {text-decoration: none;}
    a:visited {text-decoration: none;}
    a:hover {text-decoration: none;}
    a:active {text-decoration: none;}
    body {background-color: #FFFFFF;}
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
    p{
        margin:0;
        padding:0;
    }
    @media screen and (max-width: 1110px) {
        #title-group{
            width: 100%;
            float: left;
        }
        #icon-telegram{
            float: left;
            position: relative !important;
            width: 100%;
        }
    }
</style>
<?php
if ($_SESSION["smenucode"] == "ADM" || $_SESSION["smenucode"] == "ADMCOM") {
    print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='ot_programmer.php'><font size='4' class='forntsarabun'>OT Programmer</font></a>";
} else {
    print "<a target=_self  href='../nindex.htm' class='forntsarabun'>กลับหน้าเมนูหลัก</a>&nbsp;&nbsp;||&nbsp;&nbsp;<a  href='com_add.php'><font size='4' class='forntsarabun'>แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_self  href='com_month.php'><font size='4' class='forntsarabun'>รายงานประจำเดือน</font></a>&nbsp;&nbsp;||&nbsp;&nbsp;<a target=_blank  href='report_comsupport.php'><font size='4' class='forntsarabun'>รายงานผลการทำงาน</font></a>";
}
?>&nbsp;&nbsp;||&nbsp;&nbsp;<a href="work_order.php" class="forntsarabun" target="_blank">พิมพ์ใบซ่อม</a>
<?php
print "<hr>";

if ($_SESSION['supportMessage']) {
    ?>
    <script>
        
        document.addEventListener('DOMContentLoaded', function() {
            Swal.fire({
                title: '<?=$_SESSION['supportMessage'];?>',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });

            <?php 
            if($_SESSION['telegram_msg']){
                ?>
                async function postMessage(data){
                    const response = await fetch('<?=NOTIFY_HOST;?>/telegram/jobit.php?'+data);
                    const resData = await response.json();
                    return resData;
                }

                const telegram_msg = encodeURIComponent('<?=$_SESSION['telegram_msg'];?>');
                var test_str = [];
                test_str.push(encodeURIComponent('sMessage')+"="+telegram_msg);
                var data = test_str.join("&");
                postMessage(data).then((res)=>{
                    console.log(res);
                });
                <?php
            }
            ?>
        }, false);
    </script>
    <?php
    $_SESSION['supportMessage'] = NULL;
    $_SESSION['notify_message'] = null;
}
?>
<div class="clearfix" style="position:relative;">
    <div id="title-group">
        <div align='center' class='forntsarabun'><strong>ระบบบันทึกการแจ้งซ่อมอุปกรณ์คอมพิวเตอร์ และพัฒนาปรับปรุงโปรแกรมในระบบโรงพยาบาล<BR>ศูนย์บริการคอมพิวเตอร์ โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div><BR>
        <div align='center'><font class='forntsarabun'>ยินดีต้อนรับ คุณ <strong><?=$sOfficer;?></strong> เข้าสู่ระบบ</font></div>
        <div align='center'><font size='1' class='forntsarabun'><b>เจ้าหน้าที่โปรแกรมเมอร์....</b>ส.อ. เทวิน  ศรีแก้ว <a href='https://sneaky-floss-1a7.notion.site/d7e08e2f5b644804859ebeb9b7261d0f?v=c8f3fb912d1b45bbb9b654871fcf78aa' target='_blank'>นายกฤษณะศักดิ์  กันธรส</a> <b>....โทร. 8500</b></font></div>
        <div align='center'><font size='1' class='forntsarabun'><b>เจ้าหน้าที่ช่างคอมพิวเตอร์....</b>นายจักรพันธ์  รุ่งเรืองศรี และนายฐานพัฒน์  นิลคำ<b>....โทร. 6203</b></font></div><br>
        <div align='center' class='forntsarabun'><strong>แจ้งซ่อมในระบบแล้ว กรุณาติดตามสถานะงานด้วยครับ [งานใหม่ : กำลังดำเนินการ : ปิดงาน]</strong></div><BR>
    </div>
    <div align='center' id="icon-telegram" class='forntsarabun' style="position:absolute; top:0; right:1em;">
        <img src='images/it-job.jpg' width='180' height='180'>
        <p><strong>กลุ่มติดตามงาน IT</strong></p>
        <p>(กลุ่มใหม่ Telegram)</p>
    </div>
</div>

<?php
$Thaidate = date("d-m-") . (date("Y") + 543);
$n = 0;
$num = "Y";
$datechk = (date("Y") + 543) . date("-m-d");
$query = "SELECT `row`,`jobtype`,`depart`,`head`,`datetime`,`programmer`,`date`,`user1`,`phone`
FROM `com_support` 
WHERE `status` ='$num' AND `date` >= '2565-01-01 00:00:00'
ORDER BY `row` DESC";


$result = mysql_query($query) or die("Query failed111" . mysql_error());
if ($num1 = mysql_num_rows($result)) {
    ?>
    <div align="center" class="forntsarabun"><strong>งานที่แจ้งเข้ามาใหม่ในระบบ จำนวน <?=$num1;?> รายการ</strong></div>
    <table class="forntsarabun"  align="center" width="98%">
    <tr bgcolor="#EC7063">
        <th width="5%">ใบงาน</th>
        <th width="15%">แผนก</th>
        <th>หัวข้อ</th>
        <th width="12%">ผู้ที่ร้องขอ</th>
        <th width="12%">วันที่ร้องขอ</th>
        <th width="8%">ผู้รับผิดชอบ</th>
        <th width="3%">พิมพ์</th>
    </tr>
    <?php
    while (list($row, $jobtype, $depart, $head, $datetime, $programmer, $date, $user1, $phone) = mysql_fetch_row($result)) {
        $n++;
        $date_key = substr($date, 0, 10);
        //echo $date_key;
        if ($datechk == $date_key) {
            $new = "<img src='images/new-40.png' width='32' height='32'>";
        } else {
            $new = "";
        }
        $programmer = (!empty($programmer)) ? $programmer : 'รอการตอบรับ';

        if ($_SESSION['smenucode'] == 'ADM' || $_SESSION['smenucode'] == 'ADMCOM') {
            $where = "<a target=_TOP href=\"com_edit.php?row=$row\">$programmer</a>";
        } else {
            $where = "$programmer";
        }

        $color = "#F5B7B1";
        list($dateTh, $time) = explode(' ', $date);
        list($hour,$min,$sec) = explode(':', $time);
        list($y, $m, $d) = explode('-', $dateTh);
        $shortYear = substr($y, 2);
        $thSortDate = $d.' '.$def_month_th[$m].' '.$shortYear.' '.$hour.':'.$min;

        print (" <tr>\n" .
        "<td BGCOLOR=$color align='center'>$row</td>\n" .
        "<td BGCOLOR=$color>$depart ( $phone )</td>\n" .
        "<td BGCOLOR=$color><a target=_TOP href=\"comdetail.php? row=$row\">$head</a> <span style='margin-left:5px;'>$new</span></td>\n" .
        "<td BGCOLOR=$color>$user1</td>\n" .
        "<td BGCOLOR=$color>$thSortDate น.</td>\n" .
        "<td BGCOLOR=$color>$where</td>\n" .
        "<td BGCOLOR=$color align='center'><a target='_blank' href=\"com_form.php?row=$row\"><img src='images/printer.png' width='16'></a></td>\n" .
        "</tr>\n");
    }
    print "</table>";
}

/*print"<br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='com_add.php'><font size='4'>บันทึกงานใหม่</a></font>";*/
echo "<hr />";
?>

<?php
$Thaidate = date("d-m-") . (date("Y") + 543);
$n = 0;
$num = 'A';

$query = "SELECT  `row`,`depart`,`head`,`datetime`,`programmer`,`date`,`user`,`phone`,`user1`
FROM `com_support` 
WHERE `status` ='$num' 
ORDER BY `row` DESC";
$result = mysql_query($query) or die("Query failed111");

if ($num2 = mysql_num_rows($result)) {
    ?>
    <div align="center" class="forntsarabun"><strong>งานที่กำลังดำเนินการ จำนวน <?=$num2;?> รายการ</strong></div>
    <table class="forntsarabun"  align="center" width="98%">
        <tr bgcolor="#FAD7A">
            <th width="5%">ใบงาน</th>
            <th width="15%">แผนก</th>
            <th>หัวข้อ</th>
            <th width="12%">วันที่ร้องขอ</th>
            <th width="12%">ผู้รับผิดชอบ</th>
            <th width="3%">พิมพ์</th>
            <?php 
            if ($_SESSION['smenucode'] == 'ADM' or $_SESSION['smenucode'] == 'ADMCOM') {
                ?><th width="5%">เพิ่มรายละเอียด</th><?php
            }
            ?>
            
        </tr>
    
    <?php
    while (list($row, $depart, $head, $datetime, $programmer, $date, $user, $phone, $user1) = mysql_fetch_row($result)) {
        $n++;
        $sql_detail = "SELECT * FROM `com_support_details` WHERE `com_id` = '$row' ORDER BY `id` DESC";
        
        $q = mysql_query($sql_detail);
        if (mysql_num_rows($q) > 0) {
            $comment = "<img src='images/comment-64.png' width='32' height='32'>";
        } else {
            $comment = "";
        }
        if ($_SESSION['smenucode'] == 'ADM' || $_SESSION['smenucode'] == 'ADMCOM') {
            $where = "<a target=_TOP href=\"comsucces.php?row=$row\">$programmer</a>";
        } else {
            $where = "$programmer";
        }
        ;
        if ($_SESSION['smenucode'] == 'ADM') {
            $add = "<a target='_blank' href=\"comservice.php?row=$row&act=win\">บันทึก</a>";
        } else {
            $add = "บันทึก";
        }
        ;

        print (" <tr>\n" .
            "  <td BGCOLOR=#FCF3CF align='center'>$row</td>\n" .
            "  <td BGCOLOR=#FCF3CF>$depart ( $phone )</td>\n" .
            "  <td BGCOLOR=#FCF3CF><a target=_TOP href=\"comdetail.php? row=$row\">$head</a><span style='margin-left:5px;'>$comment</span></td>\n" .
            "  <td BGCOLOR=#FCF3CF title=\"$user1\">$date</td>\n" .
            "  <td BGCOLOR=#FCF3CF>$where</td>\n" .
            "  <td BGCOLOR=#FCF3CF align='center'><a target='_blank' href=\"com_form.php?row=$row\"><img src='images/printer.png' width='16'></a></td>\n");
        // "  <td BGCOLOR=#FCF3CF align='center'>$add</td>\n".

        if ($_SESSION['smenucode'] == 'ADM' or $_SESSION['smenucode'] == 'ADMCOM') {
            print "<td bgcolor=#FCF3CF align=\"center\"><a href=\"com_support_detail.php?id=$row\" target=\"_blank\"><img src='images/plus.png'></a></td>";
        }

        print " </tr>\n";
    }
    print "</table>";
}

echo "<hr />";
?>
<?php

$thYear = date('Y')+543;

$Thaidate = date("d-m-") . $thYear;

$last6Months = strtotime("-3 months");
$dateEnd6Months = (date('Y', $last6Months)+543).date('-m-d', $last6Months);

$sql = "SELECT COUNT(`row`) AS `count` FROM `com_support` WHERE `status` ='n' AND `dateend` LIKE '$thYear%' ";
$q = mysql_query($sql);
$a = mysql_fetch_assoc($q);
$countAllItem = $a['count'];

$query = "SELECT `row`,`depart`,`head`,`datetime`,`programmer`,`date`,`p_edit`,`dateend`,`phone`
FROM `com_support` 
WHERE `status` ='n' 
ORDER BY `dateend` DESC ";
$result_all = mysql_query($query) or die("Query failed111");
$all_rows = mysql_num_rows($result_all);

$limit = '250';

$page = (empty($_GET['page'])) ? '0' : $_GET['page'] - 1;

$page_start = $page * $limit;

$total_pages = $countAllItem / $limit;
$total_pages = (int) ceil($total_pages);

$query .= " LIMIT $page_start, $limit";

$result = mysql_query($query) or die("Query failed111");
$numResult = mysql_num_rows($result);
if ($countAllItem>0) { 

    $items = array();
    $maxdate = $mindate = '';
    $ii = 1;
    while ($a = mysql_fetch_assoc($result)) {
        
        if($ii==1){
            $maxdate = substr($a['dateend'], 0, 7);
        }
        $items[] = $a;

        if($ii==$numResult){
            $mindate = substr($a['dateend'], 0, 7);
        }
        $ii++;
    }

    list($maxDateYear, $maxDateMonth) = explode('-', $maxdate);
    list($minDateYear, $minDateMonth) = explode('-', $mindate);

    $maxDateTxt = $def_fullm_th[$maxDateMonth].' '.$maxDateYear;
    $minDateTxt = $def_fullm_th[$minDateMonth].' '.$minDateYear;

    ?>
    <div align="center" class="forntsarabun" id="work_done">
        <strong>งานที่ดำเนินการเสร็จแล้ว ปี<?=$thYear;?> จำนวน <?=$countAllItem;?> รายการ (<?=$minDateTxt;?> ถึง <?=$maxDateTxt;?>) </strong>
        <div>
            เลือกหน้า : 
            <select name="page" id="page" onchange="changePage(this.value)">
                <?php 
                for ($i=1; $i <= $total_pages; $i++) { 
                    $select = $_GET['page']==$i ? 'selected="selected"' : '' ;
                    ?>
                    <option value="<?=$i;?>" <?=$select;?> ><?=$i;?></option>
                    <?php
                }
                ?>
            </select>
        </div>
    </div>
    <table class="forntsarabun" align="center" width="98%">
        <tr bgcolor="#73C6B6">
            <th width="5%">ใบงาน</th>
            <th width="15%">แผนก</th>
            <th width="">หัวข้อ</th>
            <th width="8%">การดำเนิการ</th>
            <th width="10%">ผู้รับผิดชอบ</th>
            <th width="12%">วันเวลาที่ดำเนินการ</th>
            <th width="3%">พิมพ์</th>
        </tr>
    <?php
    foreach ($items as $k => $v) {

        $row = $v['row'];
        $phone = $v['phone'];

        $sqlDetail = sprintf("SELECT `id` FROM `com_support_details` WHERE `com_id` = '%s' ", $row);
        $qDetail = $dbi->query($sqlDetail);
        $icon = '';
        if($qDetail->num_rows>0){
            $icon = '<img src="images/comment-64.png" width="32" height="32">';
        }

        $depart = $v['depart'];
        $head = $v['head'];
        $p_edit = $v['p_edit'];
        $programmer = $v['programmer'];
        $dateend = $v['dateend'];

        print (" <tr>\n" .
            "  <td BGCOLOR=#D5F5E3  align='center'>$row</td>\n" .
            "  <td BGCOLOR=#D5F5E3>$depart ( $phone )</td>\n" .
            "  <td BGCOLOR=#D5F5E3><a target=_TOP href=\"comdetail.php?row=$row\">$head</a>$icon</td>\n" .
            "  <td BGCOLOR=#D5F5E3>$p_edit</td>\n" .
            "  <td BGCOLOR=#D5F5E3>$programmer</td>\n" .
            "  <td BGCOLOR=#D5F5E3 align='center'>$dateend</td>\n" .
            "  <td BGCOLOR=#D5F5E3 align='center'><a target='_blank' href=\"com_form.php?row=$row\"><img src='images/printer.png' width='16'></a></td>\n" .
            " </tr>\n");
    }

    print "</table>";
    ?>
    <script>
        function changePage(v){
            window.location = 'com_support.php?page='+v+'#work_done';
        }
    </script>
    <?php
}

?>