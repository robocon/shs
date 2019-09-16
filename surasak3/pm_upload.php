<?php 

include 'bootstrap.php';
$db = Mysql::load();

$action = input('action');

if ( $action === 'import' ) {

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

                $dob = trim($date_birth);
                $hn = trim($hn);

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
                    
                    $date_birth = "$yy-$mm-$dd 00:00:00";
                }

                // รูปแบบ ปี-เดือน-วัน
                $match_ad = preg_match('/\d{4}\-\d{1,2}\-\d{1,2}/', $dob, $matchs);
                if ( $match_ad > 0 ) {
                    list($yy, $mm, $dd) = explode('-', $dob);
                    $dd = sprintf('%02d', $dd);
                    $mm = sprintf('%02d', $mm);
                    
                    $date_birth = "$yy-$mm-$dd 00:00:00";
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
                    
                    $date_birth = "$yy-$mm-$dd 00:00:00";

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

    redirect('pm_shs.php', $msg);
    exit;
}



$part = input_get('part');

$db->select("SELECT `name` FROM `chk_company_list` WHERE `code` = '$part' ");
$company = $db->get_item();


?>
<style>
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}
.chk_table th,
.chk_table td{
    padding: 3px;
    border: 1px solid black;
}
</style>
<div>
    <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลักร.พ.</a> | <a href="pm_shs.php">หน้าแรกพิมพ์สติกเกอร์</a>
</div>
<h3>นำเข้ารายชื่อผู้ตรวจสุขภาพเข้าสู่ระบบโรงพยาบาล - <?=$company['name'];?></h3>
<form action="pm_upload.php" method="post" enctype="multipart/form-data">
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
        <input type="hidden" name="part" value="<?=$part;?>">
    </div>
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
    <div>
        <div>
            <div><b>ตัวอย่างการจัดข้อมูล</b></div>
            <img src="images/sso-import-user.png" alt="">
        </div>
    </div>
</form>