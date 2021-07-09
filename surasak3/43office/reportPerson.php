<?php 
session_start();

if($_SESSION['smenucode'] !== 'ADM' && $_SESSION['smenucode'] !== 'ADM43FILE' && $_SESSION['smenucode'] !== 'ADMOPD')
{
    echo 'อนุญาตเฉพาะเจ้าหน้าที่ห้องทะเบียนเท่านั้น ถ้ายังไม่ได้ Login สามารถ<a href="../login_page.php">คลิกได้ที่นี่</a>';
    exit;
}
include_once '../includes/config.php';
include_once 'head.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
if ($dbi->connect_error) {
    die("Connection failed: " . $dbi->connect_error);
}

// $dbi->query("SET NAMES TIS620");
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
        $year_range = range(2004, date('Y'));
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
            <input type="checkbox" name="show_error" id="show_error" value="show"><label for="show_error">แสดงเฉพาะ Error</label>
        </div>
        <div>
            <button type="submit">ค้นหา</button>
            <input type="hidden" name="view" value="search">
        </div>
    </form>
</fieldset>
<div>&nbsp;</div>
<?php 
$view = $_POST['view'];
if ( $view === 'search' ) { 
    ?>
    <table class="chk_table">
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
    <?php

    $year_selected = $_POST['year_selected'];

    $q_person = $dbi->query("SELECT `abbreviations` FROM `f43_person_1` ");
    $abbreviations_items = array();
    while ($per = $q_person->fetch_assoc()) {
        $abbreviations_items[] = $per['abbreviations'];
    }

    $year_selected = substr(($year_selected+543),2,2);

    $sql = "SELECT `row_id`,`hn`,`idcard`,`name`,`surname`, `dbirth` FROM `opcard` WHERE `hn` LIKE '$year_selected%' ORDER BY `row_id` ASC ";
    $q = $dbi->query($sql);
    while ($opcard = $q->fetch_assoc()) { 

        $id = $opcard['row_id'];
        $opcard_hn = $opcard['hn'];

        $item = array();
        $sql = "SELECT * FROM `PERSON` WHERE `HN` = '$opcard_hn' ";
        $q_person = $dbi->query($sql);
        if ($q_person->num_rows > 0) {
            $item = $q_person->fetch_assoc();
        }
        
        $error = false;
        if(empty($item['id']))
        {
            $error = true;
        }
        if(empty($item['CID']) OR strlen($item['CID']) < 13)
        {
            $error = true;
        }
        if(in_array($item['PRENAME'], $abbreviations_items) === false)
        {
            $error = true;
        }
        if($item['BIRTH'] === '-----' OR $item['BIRTH'] === '------' OR $item['BIRTH'] === 'พ.ศ.-ดด-วว')
        {
            $error = true;
        }

        $item['CID'] = (empty($item['CID'])) ? $item['opcard_idcard'] : $item['CID'] ;
        $item['PID'] = empty($item['PID']) ? $item['opcard_hn'] : $item['PID'] ;
        $item['NAME'] = (empty($item['NAME'])) ? $item['opcard_name'] : $item['NAME'] ;
        $item['LNAME'] = (empty($item['LNAME'])) ? $item['surname'] : $item['LNAME'] ;

        if($error === false && $_POST['show_error'] === 'show')
        {
            continue;
        }

        $color_prename = '';
        if(in_array($item['PRENAME'], $abbreviations_items) === false)
        {
            $color_prename = 'style="background-color: #ecff4f;"';
        }

        // cid เป็นค่าว่าง
        $cid_color = ( empty($item['CID']) OR strlen($item['CID']) < 13 ) ? 'style="background-color: #ecff4f;"' : '';

        // ถ้ามีใน opcard แต่ยังไม่มีใน person ให้แสดงเป็นพื้นหลังสีแดง
        $color_row = empty($item['id']) ? 'style="background-color: #ff8383;"' : '' ;

        ?>
        <tr <?=$color_row;?> >
            <td>
            <?php 
            echo $item['HOSTPCODE'];
            if(empty($item['HOSTPCODE']))
            {
                echo "ยังไม่มีข้อมูลในแฟ้ม PERSON";
            }
            ?>
            </td>
            <td <?=$cid_color;?> >
                <?=$item['CID'];?>
            </td>
            <td>
                <?php 
                if(empty($item['PID']))
                {
                    $item['PID'] = $opcard_hn;
                }
                ?>
                <a href="../opdedit.php?cHn=<?=$item['PID'];?>" target="_blank" title="แก้ไขข้อมูล"><?=$item['PID'];?></a>
            </td>
            <td><?=$item['HID'];?></td>
            <td <?=$color_prename;?> ><?=$item['PRENAME'];?></td>
            <td>
                <?=$item['NAME'];?>
            </td>
            <td>
                <?=$item['LNAME'];?>
            </td>
            <td><?=$item['HN'];?></td>
            <td><?=$item['SEX'];?></td>
            
            <?php 
            $birth = $item['BIRTH'];
            $color_birth = '';
            if($birth === '-----' OR $birth === '------' OR $birth === 'พ.ศ.-ดด-วว')
            {
                $color_birth = 'style="background-color: #ecff4f;"';
            }
            ?>
            <td <?=$color_birth;?>>
                <?=$birth;?>
            </td>
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

    } // ena while
    ?>
    </table>
    <?php

}