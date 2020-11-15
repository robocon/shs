<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

if( $action == 'save' ) {
    
    $company = input_post('company');
    $id = input_post('id');
    $company_code = input_post('company_code');
    $date_checkup = input_post('date_checkup');

    $typeReport = $_REQUEST['typeReport'];

    $msg = 'บันทึกข้อมูลเรียบร้อย';

    if( empty($company) OR empty($company_code) ){
        $msg = 'กรุณาใส่ข้อมูล ชื่อบริษัท และ รหัสบริษัทให้ถูกต้อง';
    }else{

        if( $id > 0 ){
            $sql = "UPDATE `chk_company_list`
            SET
            `name` = '$company',
            `code` = '$company_code',
            `date_checkup` = '$date_checkup'
            WHERE `id` = '$id';";
            $save = $db->update($sql);

            if( $save !== true ){
                $msg = errorMsg('save', $save['id']);
            }

        }else{

            $sql = "SELECT `id` FROM `chk_company_list` WHERE `code` = '$company_code'";
            $db->select($sql);
            $chk_row = $db->get_rows();

            // $msg = "รหัสบริษัทซ้ำซ้อนไม่สามารถบันทึกข้อมูลได้";
            $msg = "บันทึกข้อมูลเรียบร้อย";

            $year = get_year_checkup(true);

            if( $chk_row == 0 ){
                $sql = "INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status`,`report` ) 
                VALUES (
                    NULL,'$company','$company_code','$date_checkup','$year','1','$typeReport'
                );";
                $save = $db->insert($sql);

                if( $save !== true ){
                    $msg = errorMsg('save', $save['id']);
                }
            }
            
        }

    }

    redirect('chk_company.php', $msg);
    exit;
}elseif ($action == 'del') {
    
    if(!authen()) die('กรุณา Loing เพื่อเข้าสู่ระบบอีกครั้ง');

    $id = input_get('id');
    $del = $db->exec("DELETE FROM `chk_company_list` WHERE `id` = '$id' ");
    $msg = 'ดำเนินการเรียบร้อย';
    if( $del !== true ){
        $msg = errorMsg('delete', $del['id']);
    }
    redirect('chk_company.php', $msg);
    exit;
}

?>
<!DOCTYPE html>
<html>
<head></head>
<body>
<?php

include 'chk_menu.php';

$id = input_get('id', 0);
$company = $company_code = $date_checkup = '';
$read_only = false;
if( $id > 0 ){
    $sql = "SELECT * FROM `chk_company_list` WHERE `id` = '$id' ";
    $db->select($sql);
    $item = $db->get_item();

    $name = $item['name'];
    $code = $item['code'];
    $date_checkup = $item['date_checkup'];
    
    $read_only = 'readonly="readonly"';

    $db->select("SELECT `row` FROM `opcardchk` WHERE `part` = '$code' ");
    $user_rows = $db->get_rows();
    $del_txt = 'chk_company.php?action=del&id='.$id;
    if( $user_rows > 0 ){
        // ถ้ายังมี user จะลบไม่ได้
        $del_txt = 'javascript: void(0); alert(\'กรุณาลบรายชื่อผู้ตรวจสุขภาพก่อนลบบริษัท\');';
    }
    
}
?>
<fieldset>
    <legend>เพิ่มบริษัทใหม่</legend>
    <form action="chk_company.php" method="post">
        <div>
            ชื่อบริษัท : <input type="text" name="company" value="<?=$name;?>" style="width: 40%; ">
        </div>
        <div>
            รหัสบริษัท : <input type="text" name="company_code" value="<?=$code;?>" <?=$read_only;?>>
        </div>
        <div>
            วันที่ตรวจ : <input type="text" name="date_checkup" value="<?=$date_checkup;?>"> 
            <span style="color: red;"><u>* ใช้ในการแสดงผลในใบพิมพ์ผลตรวจสุขภาพประจำปี</u> ตัวอย่างเช่น 5-20 ตุลาคม 2560</span>
        </div>
        <div>
            เลือกรายงาน : <select name="typeReport" id="">
                <option value="chk_report04.php">ผู้ป่วย walk-in เอง</option>
                <option value="chk_report03.php">มีการกำหนด Lab Number เอง</option>
            </select>
        </div>
        <?php 
        if( $id > 0 ){
            ?>
            <div>
                <a href="<?=$del_txt;?>">ลบข้อมูลบริษัท</a>
            </div>
            <?php 
        }
        ?>
        
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="action" value="save">
            <input type="hidden" name="id" value="<?=$id;?>">
        </div>
    </form>
</fieldset>
<br>
<fieldset>
    <legend>ค้นหาตามปีงบประมาณ</legend>
    <form action="chk_company.php" method="post">
        <div> เลือกปี : 
            <?php 
            $year_selected = input_post('year_selected', date('Y') );
            $year_range = range('2018',get_year_checkup(true, true));
            getYearList('year_selected', true, $year_selected, $year_range);
            ?>
        </div>

        <div>
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="views" value="search">
        </div>
    </form>
</fieldset>

<?php 
$views = input_post('views');
if ( $views == 'search' ) {
?>
<div>
    <?php 
    
    $year_selected += 543;

    $sql = "SELECT * FROM `chk_company_list` 
    WHERE `yearchk` = '$year_selected' AND `status` = '1' 
    ORDER BY `id` ASC";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <h3>รายชื่อบริษัท</h3>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>ชื่อบริษัท</th>
            <th>รหัสเชื่อมข้อมูล</th>
            <th>ช่วงเวลาที่ตรวจ</th>
            <th>รอบปีงบประมาณ</th>
            <th>ลงผล/พิมพ์ผล</th>
            <th>พิมพ์ผล ปกส.</th>
            <th></th>
        </tr>
        <?php
        $i = 1;
        foreach ($items as $key => $item) {

            $companyCode = $item['code']; 
            $db->select("SELECT COUNT(`HN`) AS `rows` FROM `opcardchk` WHERE `part` = '$companyCode' ");
            $op = $db->get_item();
            $userRows = $op['rows'];

            $report = ( !empty($item['report']) ) ? $item['report'].'?camp='.$item['code'] : 'javascript:void(0);' ;

            $reportAllFile = (!empty($item['report_all'])) ? $item['report_all'] : 'chk_report_all.php' ;

            $reportAll = $reportAllFile.'?camp='.$item['code'];
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><a href="chk_show_user.php?part=<?=$item['code'];?>"><?=$item['name'];?></a></td>
                <td><?=$item['code'];?> (<?=$userRows;?>ราย)</td>
                <td><?=$item['date_checkup'];?></td>
                <td align="center"><?=$item['yearchk'];?></td>
                <td style="vertical-align: top;">
                    <ol>
                        <li><a href="out_result.php?part=<?=$item['code'];?>" target="_blank">ลงข้อมูลซักประวัติ</a></li>
                        <li><a href="<?=$report;?>" target="_blank">ผลตรวจรายบุคคล</a></li>
                        <li><a href="<?=$reportAll;?>" target="_blank">สรุปผลตรวจ</a></li>
                        <li><a href="chk_all_lab.php?part=<?=$item['code'];?>" target="_blank">ผล Lab ทั้งหมด</a></li>
                        <li><a href="chk_lab_sticker.php?part=<?=$item['code'];?>" target="_blank">พิมพ์สติกเกอร์ LAB</a></li>
                        <li><a href="chk_report_all_money.php?camp=<?=$item['code'];?>" target="_blank">ทดสอบ ค่าใช้จ่ายจากรายการแลป (ตรวจนอกรพ.)</a></li>
                    </ol>
                </td>
                <td style="vertical-align: top;">
                    <ol>
                        <li><a href="chk_cross_sso.php?camp=<?=$item['code'];?>" target="_blank">สรุปผลรวม</a></li>
                        <li><a href="chk_print_all_sso.php?part=<?=$item['code'];?>" target="_blank">พิมพ์ผลตามแบบฟอร์มประกันสังคม</a></li>
                        <li><a href="chk_money_sso.php?part=<?=$item['code'];?>" target="_blank">พิมพ์ค่าใช้จ่าย</a></li>
                    </ol>
                </td>
                <td><a href="chk_company.php?id=<?=$item['id'];?>">แก้ไขชื่อบริษัท</a></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
    ?>
</div>
<?php
}
?>
</body>
</html>