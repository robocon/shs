<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

if( $action == false ){
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
                <span style="color: red;"><u>* ใช้ในการแสดงผลในใบพิมพ์ผลตรวจสุขภาพประจำปี</u></span>
                <div>
                    <span style="color: red;">ตัวอย่างเช่น 5-20 ตุลาคม 2560</span>
                </div>
            </div>
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
                $year_range = range('2018',get_year_checkup(true, true));
                getYearList('year_selected', true, 'selected', $year_range);
                ?>
            </div>

            <div>
                <button type="submit">แสดงผล</button>
                <input type="hidden" name="views" value="search">
            </div>
        </form>
    </fieldset>

    <?php 
    $action = input_post('views');
    if ( $action == 'search' ) {
    ?>
    <div>
        <?php 
        $year_selected = input_post('year_selected');
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
                <th></th>
                <th></th>
            </tr>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {

                $report = ( !empty($item['report']) ) ? $item['report'].'?camp='.$item['code'] : 'javascript:void(0);' ;
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><a href="chk_show_user.php?part=<?=$item['code'];?>"><?=$item['name'];?></a></td>
                    <td><?=$item['code'];?></td>
                    <td><?=$item['date_checkup'];?></td>
                    <td align="center"><?=$item['yearchk'];?></td>
                    <td>
                        <ol>
                            <li><a href="out_result.php?part=<?=$item['code'];?>" target="_blank">ลงข้อมูลซักประวัติ</a></li>
                            <li><a href="<?=$report;?>" target="_blank">ผลตรวจรายบุคคล</a></li>
                            <li><a href="chk_report_all.php?camp=<?=$item['code'];?>" target="_blank">สรุปผลตรวจ</a></li>
                            <li><a href="dx_ofyear_out.php" target="_blank">ซักประวัติ(สิทธิ ปกส.)</a></li>
                            <li><a href="chk_cross_sso.php?camp=<?=$item['code'];?>" target="_blank">สรุปผล(สิทธิ ปกส.)</a></li>
                        </ol>
                    </td>
                    <td><a href="chk_all_lab.php?part=<?=$item['code'];?>">ผล Lab ทั้งหมด</a></td>
                    <td><a href="chk_company.php?id=<?=$item['id'];?>">แก้ไข</a></td>
                </tr>
                <?php
                $i++;
            }
            ?>
            <tr>
                <td></td>
                <td>ตรวจสุขภาพ สอบตำรวจ 61</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <ol>
                        <li>
                            <a href="out_result.php?part=สอบตำรวจ60" target="_blank">ลงข้อมูลซักประวัติ</a>
                        </li>
                        <li>
                        <a href="chk_report_police60.php" target="_blank">พิมพ์ผลตรวจ</a>
                        </li>
                    </ol>
                </td>
                <td></td>
            </tr>
        </table>
        <?php
        ?>
    </div>
    <?php
    }

} else if( $action == 'save' ) {
    
    $company = input_post('company');
    $id = input_post('id');
    $company_code = input_post('company_code');
    $date_checkup = input_post('date_checkup');
    $year = get_year_checkup(true);

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

            if( $chk_row == 0 ){
                $sql = "INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status` ) 
                VALUES (
                NULL,'$company','$company_code','$date_checkup','$year','1'
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
}
?>
