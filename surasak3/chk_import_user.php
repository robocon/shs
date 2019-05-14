<?php

include 'bootstrap.php';
$action = input('action');
$db = Mysql::load();

if( empty($action) ){
    include_once 'chk_menu.php';

    ?>
    <h3>นำเข้ารายชื่อผู้ตรวจสุขภาพเข้าสู่ระบบโรงพยาบาล</h3>
    <div>
        
        <div class="clearfix" style="height: 105px;">
            <div class="chk_menu clearfix">
                <ul>
                    <li>
                        <a href="chk_test_hn.php" target="_blank">ตรวจสอบรายชื่อจาก HN</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
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
    </form>
    <div>
        <p><b>รูปแบบข้อมูลก่อนนำเข้าสู่ระบบ</b></p>
        <table class="chk_table">
            <tr>
                <td>ลำดับ</td>
                <td>Lab Number</td>
                <td>HN</td>
                <td>เลขบัตรประชาชน</td>
                <td>ชื่อ</td>
                <td>สกุล</td>
                <td>อายุ</td>
                <td>วันเกิด</td>
                <td>โปรแกรมที่ตรวจ เช่น โปรแกรม1 โปรแกรม2</td>
                <td>วันที่ตรวจจริง</td>
                <td>แผนก</td>
            </tr>
        </table>
    </div>
    <br>
    <div>
        <b><u>วันเกิด</u></b> รองรับการทำงานแค่ 2รูปแบบ คือ<br>
        1.) รูปแบบอังกฤษ(DD/MM/YYYY) โดยที่ DD คือวันที่ MM คือเดือน YYYY คือปีค.ศ. ตัวอย่างเช่น <u>01/02/1985</u><br>
        2.) รูปแบบไทย(วันที่ เดือน ปี) ตัวอย่างเช่น <u>18 มกราคม 2561</u><br>
    </div>
    <br>
    <div>
        <div>
            <div><b>ตัวอย่างการจัดข้อมูล</b></div>
            <img src="images/sso-import-user.png" alt="">
        </div>
    </div>
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
        $idcard = $exam_no = $date_birth = '';
        
        foreach ($items as $key => $item) {
            
            ++$i;
            ++$last_id;

            list($pid, $exam_no, $hn, $idcard, $fname, $lname, $age, $date_birth, $course, $date_chkup, $branch ) = explode(',', $item);


            if( !empty($pid) ){ 

                $date_birth = trim($date_birth);

                // รูปแบบ dd/mm/yyyy 
                $match = preg_match('/\d+\/\d+\/\d+/', $date_birth, $matchs);
                if ( $match > 0 ) {
                    list($dd, $mm, $yy) = explode('/', $date_birth);

                    if($yy > 2100){
                        $yy = $yy - 543;
                    }

                    $dd = sprintf('%02d', $dd);
                    $mm = sprintf('%02d', $mm);
                    
                    $date_birth = "$yy-$mm-$dd 00:00:00";
                }
                
                // เปลี่ยนรูปแบบ พ.ศ. เป็น ค.ศ. เช่น 18 มกราคม 2561 เป็น 2018-01-11 
                $match_thdate = preg_match('/(\d+)\s([ก-๙].+)\s(\d+)/', $date_birth, $matchs);
                if ( $match_thdate > 0 ) {

                    $dd = $matchs['1'];
                    $mm = $matchs['2'];
                    $yy = $matchs['3'];

                    if($yy > 2100){
                        $yy = $yy - 543;
                    }

                    $month_number = array_keys($def_fullm_th, $mm);
                    $date_birth = $yy."-".$month_number['0']."-$dd 00:00:00";
                    
                }

                if( !empty($idcard) ){
                    $idcard = str_replace(array('-', ' '), '', $idcard);
                }

                if( empty($idcard) ){
                    $sql = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ";
                    $db->select($sql);
                    $item = $db->get_item();
                    $idcard = $item['idcard'];
                }


                // $fullname = preg_replace('/\s+/', ' ', $fullname);
                // list($name, $surname) = explode(' ',$fullname);
                $name = trim($fname);
                $surname = trim($lname);
    
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
                '$exam_no',
                '$pid',
                '$idcard',
                '$name',
                '$surname',
                '$date_birth',
                '$age',
                '$part',
                '$branch',
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
