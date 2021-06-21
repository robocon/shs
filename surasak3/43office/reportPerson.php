<?php 
session_start();

if($_SESSION['smenucode'] !== 'ADM' && $_SESSION['smenucode'] !== 'ADM43FILE' && $_SESSION['smenucode'] !== 'ADMOPD')
{
    echo 'อนุญาตเฉพาะเจ้าหน้าที่ห้องทะเบียนเท่านั้น';
    exit;
}
include_once '../includes/config.php';
include_once 'head.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}
?>
<div class="clearfix">
    <h1 style="margin:0;">รายงานแฟ้ม PERSON</h1> <span>ข้อมูลทั่วไปของประชาชนในเขตรับผิดชอบ และผู้ที่มาใช้บริการ</span>
</div>
<fieldset>
    <legend>ค้นหา</legend>
    <form action="reportPerson.php" method="post">
        <!--
        <div>
            HN <input type="text" name="hn" id="hn">
        </div>
        -->
        <?php 
        $default_year = (empty($_POST['year_selected'])) ? date('Y') : $_POST['year_selected'] ;
        $year_range = range(2014, date('Y'));
        ?>
        <div>
            เลือกปี <select name="year_selected" id="year_selected">
            <?php 
            foreach ($year_range as $key => $year_item) { 
                $selected = ($year_item == $default_year) ? 'selected="selected"' : '' ;
                ?><option value="<?=$year_item;?>" <?=$selected;?>><?=$year_item+543;?></option><?php
            } 
            ?>
            </select>
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<?php 
$view = $_POST['view'];
if ( $view === 'search' ) { 
    ?>
    <table class="chk_table">
        <tr>
            <th>รหัสหน่วยบริการ</th>
            <th>เลขที่บัตรประชาชน</th>
            <th>ทะเบียนบุคคล</th>
            <th>รหัสบ้าน</th>
            <th>คํานําหน้า</th>
            <th>ชื่อ</th>
            <th>นามสกุล</th>
            <th>เลขที่ผู้ป่วยนอก (HN)</th>
            <th>เพศ</th>
            <th>วันเกิด</th>
            <th>รหัสสถานะสมรส</th>
            <th>รหัสอาชีพ(เก่า)</th>
            <th>รหัสอาชีพ(ใหม่)</th>
            <th>รหัสเชื้อชาติ</th>
            <th>รหัสสัญชาติ</th>
            <th>รหัสศาสนา</th>
            <th>รหัสระดับการศึกษา</th>
            <th>รหัสสถานะในครอบครัว</th>
            <th>รหัส CID มารดา</th>
            <th>รหัส CID มารดา</th>
            <th>รหัส CID คู่สมรส</th>
            <th>รหัสสถานะในชุมชน</th>
            <th>วันที่ย้ายเข้ามาเขตพื้นที</th>
            <th>รหัสสถานะ/สาเหตุการจําหน่าย</th>
            <th>วันที่จําหน่าย</th>
            <th>รหัสหมู่เลือด</th>
            <th>รหัสหมู่เลือด RH</th>
            <th>รหัสความเป็นคนต่างด้าว</th>
            <th>เลขที่ passport</th>
            <th>รหัสสถานะบุคคล</th>
            <th>วันเดือนปีที่ปรับปรุงข้อมูล</th>
            <th>เบอร์โทรศัพท์</th>
            <th>เบอร์โทรศัพท์มือถือ</th>
        </tr>
        <tr>
            <th>HOSPCODE</th>
            <th>CID</th>
            <th>PID</th>
            <th>HID</th>
            <th>PRENAME</th>
            <th>NAME</th>
            <th>LNAME</th>
            <th>HN</th>
            <th>SEX</th>
            <th>BIRTH</th>
            <th>MSTATUS</th>
            <th>OCCUPATION_OLD</th>
            <th>OCCUPATION_NEW</th>
            <th>RACE</th>
            <th>NATION</th>
            <th>RELIGION</th>
            <th>EDUCATION</th>
            <th>FSTATUS</th>
            <th>FATHER</th>
            <th>MOTHER</th>
            <th>COUPLE</th>
            <th>VSTATUS</th>
            <th>MOVEIN</th>
            <th>DISCHARGE</th>
            <th>DDISCHARGE</th>
            <th>ABOGROUP</th>
            <th>RHGROUP</th>
            <th>LABOR</th>
            <th>PASSPORT</th>
            <th>TYPEAREA</th>
            <th>D_UPDATE</th>
            <th>TELEPHONE</th>
            <th>MOBILE</th>
        </tr>
    <?php

    $year_selected = $_POST['year_selected'];

    $q_person = $dbi->query("SELECT `abbreviations` FROM `f43_person_1` ");
    $abbreviations_items = array();
    while ($per = $q_person->fetch_assoc()) {
        $abbreviations_items[] = $per['abbreviations'];
    }

    $sql = "SELECT a.*,b.*
    FROM ( 
        SELECT `row_id` AS `opcard_id`, `hn` AS `opcard_hn`, `idcard` AS `opcard_idcard`, `name` AS `opcard_name`, `surname` FROM `opcard` WHERE `regisdate` LIKE '$year_selected%' 
     ) AS a 
    LEFT JOIN `PERSON` AS b ON b.`PID` = a.`opcard_hn` 
    ORDER BY a.`opcard_id` ASC ";
    $q = $dbi->query($sql);
    while ($item = $q->fetch_assoc()) { 

        $color_noti = '';
        if(in_array($item['PRENAME'], $abbreviations_items) === false)
        {
            $color_noti = 'style="background-color: #ecff4f;" title="คำนำหน้าชื่อไม่ตรงกับข้อมูลของกระทรวงมหาดไทย"';
        }

        $color_row = empty($item['id']) ? 'style="background-color: #ff8383;"' : '' ;
        ?>
        <tr <?=$color_row;?> >
            <td><?=$item['HOSTPCODE'];?></td>
            <td>
                <?php 
                if(empty($item['CID']))
                {
                    echo $item['opcard_idcard'];
                }
                else
                {
                    echo $item['CID'];
                }
                ?>
            </td>
            <td>
                <?php 
                $show_pid = $item['PID'];
                if(empty($item['PID']))
                {
                    $show_pid =  $item['opcard_hn'];
                }
                ?>
                <a href="../opdedit.php?cHn=<?=$show_pid;?>" target="_blank" title="แก้ไขข้อมูล"><?=$show_pid;?></a>
            </td>
            <td><?=$item['HID'];?></td>
            <td <?=$color_noti;?> ><?=$item['PRENAME'];?></td>
            <td>
                <?php 
                if (empty($item['NAME'])) 
                {
                    echo $item['opcard_name'];
                }
                else
                {
                    echo $item['NAME'];
                }
                ?>
            </td>
            <td>
                <?php 
                if (empty($item['LNAME'])) 
                {
                    echo $item['surname'];
                }
                else
                {
                    echo $item['LNAME'];
                }
                ?>
            </td>
            <td><?=$item['HN'];?></td>
            <td><?=$item['SEX'];?></td>
            <td><?=$item['BIRTH'];?></td>
            <td><?=$item['MSTATUS'];?></td>
            <td><?=$item['OCCUPATION_OLD'];?></td>
            <td><?=$item['OCCUPATION_NEW'];?></td>
            <td><?=$item['RACE'];?></td>
            <td><?=$item['NATION'];?></td>
            <td><?=$item['RELIGION'];?></td>
            <td><?=$item['EDUCATION'];?></td>
            <td><?=$item['FSTATUS'];?></td>
            <td><?=$item['FATHER'];?></td>
            <td><?=$item['MOTHER'];?></td>
            <td><?=$item['COUPLE'];?></td>
            <td><?=$item['VSTATUS'];?></td>
            <td><?=$item['MOVEIN'];?></td>
            <td><?=$item['DISCHARGE'];?></td>
            <td><?=$item['DDISCHARGE'];?></td>
            <td><?=$item['ABOGROUP'];?></td>
            <td><?=$item['RHGROUP'];?></td>
            <td><?=$item['LABOR'];?></td>
            <td><?=$item['PASSPORT'];?></td>
            <td><?=$item['TYPEAREA'];?></td>
            <td><?=$item['D_UPDATE'];?></td>
            <td><?=$item['TELEPHONE'];?></td>
            <td><?=$item['MOBILE'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php

}