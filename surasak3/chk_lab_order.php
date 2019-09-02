<?php

include 'bootstrap.php';

$action = input('action');
$db = Mysql::load();

$def_month_en = array(
    'January' => '01',
    'February' => '02',
    'March' => '03',
    'April' => '04',
    'May' => '05',
    'June' => '06',
    'July' => '07',
    'August' => '08',
    'September' => '09',
    'October' => '10',
    'November' => '11',
    'December' => '12' 
);

$def_month_th = array(
    'มกราคม' => '01',
    'กุมภาพันธ์' => '02',
    'มีนาคม' => '03',
    'เมษายน' => '04',
    'พฤษภาคม' => '05',
    'มิถุนายน' => '06',
    'กรกฎาคม' => '07',
    'สิงหาคม' => '08',
    'กันยายน' => '09',
    'ตุลาคม' => '10',
    'พฤศจิกายน' => '11',
    'ธันวาคม' => '12' 
);

/**
 * @dob String
 */
function set_date($dob){

    global $def_month_en, $def_month_th;

    $dob = trim($dob);

    // รูปแบบ วัน/เดือน/ปี
    // โดยปี รองรับ พ.ศ. ค.ศ.
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

    // รูปแบบ ปี-เดือน-วัน
    $match_ad = preg_match('/\d{4}\-\d{1,2}\-\d{1,2}/', $dob, $matchs);
    if ( $match_ad > 0 ) {
        list($yy, $mm, $dd) = explode('-', $dob);
        $dd = sprintf('%02d', $dd);
        $mm = sprintf('%02d', $mm);
        
        $dob = "$yy-$mm-$dd 00:00:00";
    }

    // รูปแบบ วัน เดือน(อังกฤษ/ไทย) ปี(พ.ศ.)
    $match_mix = preg_match('/\d{1,2}\s(.+)\s\d{4}/', $dob, $matchs);
    if ( $match_mix > 0 ) {

        list($dd, $mm_txt, $yy) = explode(' ', $dob);
        $dd = sprintf('%02d', $dd);
        $yy = ( $yy - 543 );

        if( !empty($def_month_en[$mm_txt]) ){
            $mm = $def_month_en[$mm_txt];
        }elseif ( !empty($def_month_th[$mm_txt]) ) {
            $mm = $def_month_th[$mm_txt];
        }
        
        $dob = "$yy-$mm-$dd 00:00:00";

    }

    return $dob;
}

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
    
    // เอาไว้ใช้นับเลข bs
    $sql = "SELECT `exam_no` FROM `opcardchk` WHERE `part` = '$part' ORDER BY `row` DESC LIMIT 1";
    $db->select($sql);
    $test_chk = $db->get_item();

    if( empty($test_chk) ){
        echo "ขาดข้อมูลพื้นฐาน กรุณานำเข้าข้อมูลหลักก่อนนำเข้าข้อมูลแลป";
        exit;
    }
    
    // ตัดเลข 6ตัวแรกที่เป็น yymmdd
    $first_lab_number = substr($test_chk['exam_no'],0,6);
    $pre_bs_number = substr($test_chk['exam_no'],6);
    $bs_number = (int) $pre_bs_number;
    
    // นับ digi เพื่อเอาไปใช้ใน sprintf ทีหลัง เพราะบางบริษัทมีหลักร้อยหรือหลักพันไม่เท่ากัน
    $number_digi = strlen($pre_bs_number);
    
    if( $content !== false ){

        $items = explode("\r\n", $content);
        
        $i = 0;
        foreach ( $items as $key => $item ) {
            
            $msg = 'บันทึกข้อมูลเรียบร้อย <a href="chk_lab_sticker.php?part='.$part.'" target="_blank">คลิกที่นี่เพื่อพิมพ์สติกเกอร์แลป</a>';

            if( $i > 0 && !empty($item) ){
                
                list($labnumber, $hn, $name, $surname, $sex, $dob, $lab_sso) = explode(',', $item,7);

                $dob = set_date($dob);
                
                $ptname = $name.' '.$surname;
                $lab_sso = strtolower(str_replace(array('"',' '), '', $lab_sso));
                
                $find_bs = false;

                // ถ้ามี bs มันจะตัดออกจากรายการและเพิ่มเป็นรายการใหม่
                $test_bs = preg_match('/\,bs\,/', $lab_sso);
                if( $test_bs > 0 ){

                    $find_bs = true;
                    $lab_sso = str_replace(',bs,',',', $lab_sso);

                    ++$bs_number;

                    $lab_bs_number = $first_lab_number.sprintf('%0'.$number_digi.'d', $bs_number);
                    
                }
                
                // เพิ่มรายการเข้าไปเก็บเอาไว้ตอนรายงานการเงิน
                $sql_chk_lab_items = "INSERT INTO `chk_lab_items` ( 
                    `id`, `hn`, `ptname`, `labnumber`, `item_sso`, `part`, `dob`, `sex`
                ) VALUES (
                    NULL, '$hn', '$ptname', '$labnumber', '$lab_sso', '$part', '$dob', '$sex'
                );";
                $insert = $db->insert($sql_chk_lab_items);
                if( $insert !== true ){
                    $msg = errorMsg(NULL, $insert['id']);
                }

                if( $find_bs === true ){

                    
                    $sql_chk_lab_items = "INSERT INTO `chk_lab_items` ( 
                        `id`, `hn`, `ptname`, `labnumber`, `item_sso`, `part`, `dob`, `sex`
                    ) VALUES (
                        NULL, '$hn', '$ptname', '$lab_bs_number', 'bs', '$part', '$dob', '$sex'
                    );";
                    $insert = $db->insert($sql_chk_lab_items);
                    if( $insert !== true ){
                        $msg = errorMsg(NULL, $insert['id']);
                    }

                }
                // เพิ่มรายการเข้าไปเก็บเอาไว้ตอนรายงานการเงิน
                
                
            } // End ถ้าในแต่ละแถว not empty 

            $i++;

        } // End excel ในแต่ละแถว

    }else{
        $msg = 'กรุณาใส่ข้อมูลให้ถูกต้อง';
    }

    redirect('chk_lab_order.php', $msg);
    exit;

}