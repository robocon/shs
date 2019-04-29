<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

/*
DROP TABLE IF EXISTS `chk_lab_items`;
CREATE TABLE `chk_lab_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `labnumber` varchar(255) DEFAULT NULL,
  `item_sso` varchar(255) DEFAULT NULL,
  `item_cash` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

if( $action == false ){
    include 'chk_menu.php';
    ?>

    <h3>นำเข้าข้อมูล Order Lab</h3>
    <form action="chk_lab_order.php" method="post" enctype="multipart/form-data">
        <div>
            ไฟล์นำเข้า : <input type="file" name="file">
        </div>
        <div>
            <?php
            $sql = "SELECT `name`,`code` FROM `chk_company_list` WHERE `status` = '1' ORDER BY `id` DESC";
            $db->select($sql);
            $items = $db->get_items();
            ?>
            เลือกบริษัท : 
            <select name="part" id="">
                <option value="">-- รายชื่อบริษัท --</option>
                <?php
                foreach ($items as $key => $item) {
                    ?><option value="<?=$item['code'];?>"><?=$item['name'].' ('.$item['code'].')';?></option><?php
                }
                ?>
            </select> <span>&lt;&lt;&lt;&nbsp;อย่าลืมเลือกบริษัทก่อนนำเข้าข้อมูล</span>
        </div>
        <div>
            <span style="color: red; font-size: 14px;">
            <b><u>คำแนะนำ และข้อควรระวัง</u></b><br>
            - เป็นการนำเข้าเฉพาะการตรวจสุขภาพประจำปีเท่านั้น<br>
            - กรุณาตรวจสอบข้อมูลก่อนนำเข้า<br>
            - ระบบรองรับเฉพาะไฟล์ .csv<br>
            </span>
        </div>
        <div>
            <button type="submit">นำเข้า</button>
            <input type="hidden" name="action" value="import">
        </div>
        <div>
            <p><b>รูปแบบข้อมูลก่อนนำเข้าสู่ระบบ</b></p>
            <table class="chk_table">
                <tr>
                    <th>Lab Number</th>
                    <th>HN</th>
                    <th>ชื่อ</th>
                    <th>สกุล</th>
                    <th>เพศ</th>
                    <th>วันเกิด</th>
                    <th>รายการตรวจ ประกันสังคม</th>
                </tr>
                <tr>
                    <td>
                        รูปแบบ ปี(สองหลัก)เดือนวัน ตามด้วยรหัส lab เช่น 610524301 โดยที่ <br>
                        61 คือปี <br>
                        05 คือเดือน <br>
                        24 คือวัน <br>
                        301 คือรหัสlabเรียงตามคน
                    </td>
                    <td>รหัสผู้เข้ารับบริการ</td>
                    <td>รูปแบบ คำนำหน้าชื่อชื่อ สกุล เช่น นายคำ บุญมี</td>
                    <td></td>
                    <td>M : ผู้ชาย, F : ผู้หญิง</td>
                    <td>
                    สามารถใช้งานได้ 2รูปแบบ คือ<br> 
                    1. ปี-เดือน-วัน แบบ ค.ศ. เช่น 1985-12-25<br> 
                    2. วัน/เดือน/ปี แบบ พ.ศ. เช่น 25/12/2550<br> 
                    </td>
                    <td>รหัสรายการตรวจคั่นด้วย Comma(,) เช่น CBC,UA,BUN เป็นต้น รองรับการใช้งาน @ เช่น @stool</td>
                </tr>
            </table>
            <br>
            
        </div>
    </form>
    <div>
        <div>
            <p><b>ตัวอย่างการจัดข้อมูล</b></p>
        </div>
        <img src="images/sso-import-lab.PNG" alt="">
    </div>
    <div>
        <div>
            <p><b>ตัวอย่างการตั้งค่าไฟล์ Excel ก่อนที่จะนำเข้าข้อมูล</b></p>
        </div>
        <iframe src="images/excel-pre-import.pdf" frameborder="0" width="800" height="600"></iframe>
    </div>
    <?php

} else if ( $action === 'import' ) {

    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $part = input_post('part');
    
    // @todo
    // - check condition

    if( $content !== false ){

        $items = explode("\r\n", $content);
        
        $i = 0;
        foreach ( $items as $key => $item ) {
            
            $msg = 'บันทึกข้อมูลเสร็จเรียบร้อย';

            if( $i > 0 && !empty($item) ){
                
                list($labnumber, $hn, $name, $surname, $sex, $dob, $lab_sso) = explode(',', $item,7);

                $match = preg_match('/\d+\/\d+\/\d+/', $dob, $matchs);
                if ( $match > 0 ) {
                    list($dd, $mm, $yy) = explode('/', $dob);

                    if($yy > 2100){
                        $yy = $yy - 543;
                    }

                    $dd = sprintf('%02d', $dd);
                    $mm = sprintf('%02d', $mm);
                    
                    $dob = "$yy-$mm-$dd 00:00:00";
                }
                $year = get_year_checkup();
                $ptname = $name.' '.$surname;
                $clinicalinfo = "ตรวจสุขภาพประจำปี$year";

                $orderhead_sql = "INSERT INTO `orderhead` ( 
                    `autonumber`, `orderdate`, `labnumber`, `hn`, `patienttype`, 
                    `patientname`, `sex`, `dob`, `sourcecode`, `sourcename`, 
                    `room`, `cliniciancode`, `clinicianname`, `priority`, `clinicalinfo` 
                ) VALUES ( 
                    '', NOW(), '$labnumber', '$hn', 'OPD', 
                    '$ptname', '$sex', '$dob', '', '', 
                    '','', 'MD022 (ไม่ทราบแพทย์)', 'R', '$clinicalinfo'
                );";
                $insert = $db->insert($orderhead_sql);
                if( $insert !== true ){
                    $msg = errorMsg(NULL, $insert['id']);
                }

                $lab_sso = str_replace('"', '', $lab_sso);
                $lab_sso_items = explode(',', $lab_sso);

                $lab_cash = str_replace('"', '', $lab_cash);
                $lab_cash_items = explode(',', $lab_cash);

                // เพิ่มรายการเข้าไปเก็บเอาไว้ตอนรายงานการเงิน
                $sql_chk_lab_items = "INSERT INTO `chk_lab_items` ( 
                    `id`, `hn`, `ptname`, `labnumber`, `item_sso`, `part`
                ) VALUES (
                    NULL, '$hn', '$ptname', '$labnumber', '$lab_sso', '$part'
                );";
                $db->insert($sql_chk_lab_items);
                if( $insert !== true ){
                    $msg = errorMsg(NULL, $insert['id']);
                }
                
                ////////////////////////
                // รายการตรวจ ปกส
                ////////////////////////
                foreach( $lab_sso_items as $lab_key => $lab_item ){
                    
                    $find_suit = strstr($lab_item,'@');
                    if( $find_suit != false ){

                        // ถ้าในรายการปกติไม่มีให้ไปหาใน labsuit
                        $sql_at = "SELECT `code` FROM `labsuit` WHERE `suitcode` LIKE '$lab_item'";
                        $db->select($sql_at);
                        $suit_list = $db->get_items();

                        if( count($suit_list) > 0 ){

                            foreach ($suit_list as $key => $suit_item) {
                                
                                $suit_code = $suit_item['code'];
                                $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                                FROM `labcare` 
                                WHERE `code` = '$suit_code' 
                                LIMIT 1 ";
                                $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                                $test_row = mysql_num_rows($q);
                                if ( $test_row > 0 ) {
                                    
                                    list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                                
                                    $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                                        `labnumber` , `labcode`, `labcode1` , `labname` 
                                    ) VALUES ( 
                                        '$labnumber', '$code', '$oldcode', '$detail'
                                    );";
                                    $insert_detail = $db->insert($orderdetail_sql);

                                    if( $insert_detail !== true ){
                                        $msg .= errorMsg(NULL, $insert_detail['id']);
                                    }

                                }
                                
                            }

                        }

                    }else{

                        // กรณีรายการ lab ปกติ
                        $sql_detail = "SELECT `code`,`oldcode`,`detail` 
                        FROM `labcare` 
                        WHERE `code` = '$lab_item' 
                        LIMIT 1 ";
                        $q = mysql_query($sql_detail) or die( " select labcare : ".mysql_error() ) ;
                        $num = mysql_num_rows($q);
                        if( $num > 0 ){
                            list($code, $oldcode, $detail) = mysql_fetch_row($q);   
                        
                            $orderdetail_sql = "INSERT INTO `orderdetail` ( 
                                `labnumber` , `labcode`, `labcode1` , `labname` 
                            ) VALUES ( 
                                '$labnumber', '$code', '$oldcode', '$detail'
                            );";
                            $insert = $db->insert($orderdetail_sql);
                            if( $insert !== true ){
                                $msg .= errorMsg(NULL, $insert['id']);
                            }

                        }

                    }
                    
                }

            } 

            $i++;
        }

    }else{
        $msg = 'กรุณาใส่ข้อมูลให้ถูกต้อง';
    }

    redirect('chk_lab_order.php', $msg);
    exit;

}


