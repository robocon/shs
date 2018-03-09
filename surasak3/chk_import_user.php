<?php

include 'bootstrap.php';
$action = input('action');
$db = Mysql::load();

if( empty($action) ){
    include_once 'chk_menu.php';

    ?>
    <h3>นำเข้ารายชื่อผู้ตรวจสุขภาพเข้าสู่ระบบโรงพยาบาล</h3>
    <form action="chk_import_user.php" method="post" enctype="multipart/form-data">
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
            </select>
        </div>
        <div>
            ไฟล์นำเข้า : <input type="file" name="file">
            <div>
                <span style="color: red; font-size: 14px;">
                <b><u>คำแนะนำ และข้อควรระวัง</u></b><br>
                - กรุณาตรวจสอบข้อมูลก่อนนำเข้า<br>
                - ระบบรองรับเฉพาะไฟล์ .csv<br>
                - ระบบรองรับแค่การเพิ่มรายชื่อผู้ป่วยใหม่
                </span>
            </div>
        </div>
        <div>
            <button type="submit">นำเข้า</button>
            <input type="hidden" name="action" value="import">
        </div>
        <div>
            <p><b>รูปแบบข้อมูลก่อนนำเข้าสู่ระบบ</b></p>
            <table class="chk_table">
                <tr>
                    <td>ลำดับ</td>
                    <td>HN</td>
                    <td>เลขบัตรประชาชน</td>
                    <td>ชื่อ สกุล</td>
                    <td>อายุ</td>
                    <td>วันเกิด</td>
                    <td>โปรแกรมที่ตรวจ เช่น โปรแกรม1 โปรแกรม2</td>
                    <td>วันที่ตรวจจริง</td>
                </tr>
            </table>
            <p><b>ตัวอย่างเช่น</b></p>
            <table class="chk_table">
                <tr>
                    <td>1</td>
                    <td>99-9990</td>
                    <td>1111111111111</td>
                    <td>นายประกอบ ผลไม้</td>
                    <td>50</td>
                    <td>25/11/2510</td>
                    <td>1</td>
                    <td>10 ตุลาคม 2560</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>99-9991</td>
                    <td>2222222222222</td>
                    <td>นายโชติ ช่วง</td>
                    <td>25</td>
                    <td>01/05/2535</td>
                    <td>1</td>
                    <td>10 ตุลาคม 2560</td>
                </tr>
            </table>
        </div>
    </form>
    <?php
} else if ( $action === 'import' ) {
    $file = $_FILES['file'];
    $content = file_get_contents($file['tmp_name']);
    $part = input_post('part');
    $msg = 'ไม่พบข้อมูลนำเข้า หรือไม่เลือกชื่อบริษัท';

	if( $content !== false && $part !== false ){
	
        $items = explode("\r\n", $content);

        $sql = "SELECT MAX(`row`) AS `lastrow` FROM `opcardchk` LIMIT 1";
		$db->select($sql);
		$chk = $db->get_item();
		$last_id = (int) $chk['lastrow'];

        $i = 0;
        $date_birth = '';
        
        foreach ($items as $key => $item) {
            
            ++$i;
            ++$last_id;

            list($pid, $hn, $idcard, $fullname, $age, $date_birth, $course, $date_chkup ) = explode(',', $item);

            if( !empty($pid) ){

                $fullname = preg_replace('/\s+/', ' ', $fullname);
                list($name, $surname) = explode(' ',$fullname);
                $course = 'โปรแกรม '.$course;
    
                $sql = "INSERT INTO `opcardchk`
                (`HN`,
                `row`,
                `exam_no`,
                `pid`,
                `idcard`,
                `name`,
                `surname`,
                `dbirth`,
                `agey`,
                `part`,
                `branch`,
                `course`,
                `datechkup`,
                `active`)
                VALUES (
                '$hn',
                '$last_id',
                '',
                '$pid',
                '$idcard',
                '$name',
                '$surname',
                '$date_birth',
                '$age',
                '$part',
                '',
                '$course',
                '$date_chkup',
                'y');";

                $insert = $db->insert($sql);

            }
            
        }

        $msg = 'นำเข้าข้อมูลเรียบร้อย';
    }
    redirect('chk_import_user.php', $msg);
    exit;
}
?>
