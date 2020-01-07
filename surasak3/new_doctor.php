<?php
include 'bootstrap.php';

if( $_SESSION['smenucode'] !== 'ADM' AND $_SESSION['smenucode'] !== 'ADMCOM' ){ 
    echo "เฉพาะเจ้าหน้าที่ศูนย์คอม";
    exit;
}


// ข้อมูลจาก 43แฟ้ม รหัสแผนกที่รับบริการ 26Sep16.xls
$section = array(
    '01' => 'อายุรกรรม',
    '02' => 'ศัลยกรรม',
    '03' => 'สูติกรรม',
    '04' => 'นรีเวชกรรม',
    '05' => 'กุมารเวชกรรม',
    '06' => 'โสต ศอ นาสิก',
    '07' => 'จักษุวิทยา',
    '08' => 'ศัลยกรรมออร์โธปิดิกส์',
    '09' => 'จิตเวช',
    '10' => 'รังสีวิทยา',
    '11' => 'ทันตกรรม',
    '12' => 'เวชศาสตร์ฉุกเฉินและนิติเวช',
    '13' => 'เวชกรรมฟื้นฟู',
    '14' => 'แพทย์แผนไทย',
    '15' => 'PCU ใน รพ. / แผนกส่งเสริมสุขภาพ',
    '16' => 'เวชกรรมปฎิบัติทั่วไป',
    '17' => 'เวชศาสสตร์ครอบครัวและชุมชน',
    '18' => 'อาชีวคลินิก',
    '19' => 'วิสัญญีวิทยา(คลินิกระงับปวด)',
    '20' => 'ศัลยกรรมประสาท',
    '21' => 'อาชีวเวชรกรรม',
    '22' => 'เวชกรรมสังคม',
    '23' => 'พยาธิวิทยากายวิภาค',
    '24' => 'พยาธิวิทยาคลินิค',
    '26' => 'วิทยาคลินิก (ผิวหนัง)',
    '88' => 'แพทย์แผนจีน',
    '99' => 'อื่นๆ'
);

$room_list = array(
    'ห้องตรวจโรคทั่วไป',
    'ห้องตรวจ 3',
    'ห้องตรวจ 4',
    'ห้องตรวจ 5',
    'ห้องตรวจ 6',
    'ห้องตรวจ 7',
    'ห้องตรวจ 8',
    'ห้องตรวจ 9',
    'ห้องตรวจ 10',
    'ห้องศัลยกรรม',
    'ห้องตรวจ สูติ',
    'ห้องตรวจตา'
);


$jobs = array(
    'ศัลยกรรม',
    'ศัลยกรรมออร์โธปิดิกส์',
    'สูติกรรม',
    'อายุรกรรม',
    'โสต ศอ นาสิก',
    'กุมารเวชกรรม',
    'จักษุวิทยา',
    'ทันตกรรม',
    'รังสีวิทยา',
    'แพทย์แผนไทย',
    'แพทย์แผนจีน',
    'เวชกรรมฟื้นฟู',
    'วิสัญญีวิทยา(คลินิกระงับปวด)',
    'อื่นๆ'
);

$action = input('action');
if( $action === false ){
    ?>
    <style>
        label{
            cursor: pointer;
        }
    </style>
    <div><a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก ร.พ.</a> | <a href="doctoredit1.php">หน้ารายชื่อแพทย์</a></div>
    <?php 
    if( !empty($_SESSION['x-msg']) ){
        ?>
        <div style="padding: 10px;border: 1px solid #000000;background-color: #fffdbc;margin: 10px;"><?=$_SESSION['x-msg'];?></div>
        <?php
        unset($_SESSION['x-msg']);
    }
    ?>
    <div>
        <h3>เพิ่มแพทย์ใหม่</h3>
    </div>
    <form action="new_doctor.php" method="post">
        <div>
            <span>ยศ</span> : <input type="text" name="pre_name" > <span>ร.อ., น.พ., พ.ญ. ฯลฯ</span>
        </div>
        <div>
            <span>ชื่อ</span> : <input type="text" name="name" ><span style="color:red;">*</span> <span>สกุล</span> : <input type="text" name="surname" ><span style="color:red;">*</span> 
        </div>
        <div>
            <span>เลขที่ ว.</span> : <input type="text" name="doctor_num"><span style="color:red;">*</span>
        </div>
        <div>
            <span>แผนกที่ทำงาน : </span> 
            <select name="doctor_type" id="">
                <?php foreach( $section AS $key => $item ){ ?>
                <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <span>ประเภทแพทย์</span>
            <select name="่jobs" id="">
                <?php foreach( $jobs AS $key => $item ){ ?>
                <option value="<?=$key;?> <?=$item;?>"><?=$item;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <span>ห้องตรวจ : </span> 
            <select name="room" id="">
                <?php foreach( $room_list AS $key => $item ){ ?>
                <option value="<?=$item;?>"><?=$item;?></option>
                <?php } ?>
            </select>
        </div>
        <div>
            <div>กลุ่มแพทย์ : <span style="color:red;">*</span></div>
            <input type="radio" name="drType" id="drType1" value="dr"><label for="drType1">แพทย์ประจำ</label>
            <input type="radio" name="drType" id="drType2" value="intern"><label for="drType2">Intern</label>
        </div>
        <div>&nbsp;</div>
        <div>
            <button type="submit">เพิ่มข้อมูล</button>
            <div>
               <u>ระบบยังไม่รองรับแพทย์เฉพาะห้องไต กรุณาติดต่อโปรแกรมเมอร์</u>
            </div>
            <input type="hidden" name="action" value="save">
        </div>
        <div>** ชื่อผู้ใช้งานและรหัสผ่านคือ md__เลขว.__ เช่น md99999 </div>
    </form>
    <?php


} else if ( $action === 'save' ){
    
    $pre_name = input_post('pre_name');
    $name = input_post('name');
    $surname = input_post('surname');
    $doctor_num = input_post('doctor_num');
    $doctor_type = input_post('doctor_type');
    $room = input_post('room');
    $drType = input_post('drType');
    $jobs = input_post('jobs');

    $fullname = $name.' '.$surname;

    if( empty($name) OR empty($surname) OR empty($doctor_num) OR empty($drType) ){
        echo 'กรุณากรอกข้อมูลให้ครบถ้วน<br><a href="javascript: window.history.back(-1);">กลับไปหน้าฟอร์ม</a>';
        exit;
    }

    if ( strlen($doctor_num) > 5 ) {
        echo 'รหัสแพทย์ไม่ถูกต้อง<br><a href="javascript: window.history.back(-1);">กลับไปหน้าฟอร์ม</a>';
        exit;
    }

    $db = Mysql::load();

    $sql = "SELECT * FROM `doctor` WHERE `doctorcode` = '$doctor_num' ";
    $db->select($sql);
    if( $db->get_rows() > 0 ){
        echo 'เลข ว. ซ้ำซ้อน กรุณาตรวจสอบข้อมูลอีกครั้ง<br><a href="javascript: window.history.back(-1);">กลับไปหน้าฟอร์ม</a>';
        exit;
    }
    
    $sql = "SELECT `prefix`,`runno` FROM `runno` WHERE `title` = 'doctor' LIMIT 1";
    $db->select($sql);
    $item = $db->get_item();
    $drRunno = intval($item['runno']) + 1;
    $new_md = $item['prefix'].$drRunno;

    $sql = "INSERT INTO `doctor` VALUES (NULL, '$pre_name', '', '$new_md $fullname', '$doctor_num', '$doctor_type', 'y', 'ADM', '$doctor_type', '1', '1', '1', '1', '1', '$room', '99', '', 'y', 'y','','$jobs');";
    $save = $db->insert($sql);
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    $prefixDr = 'ว.';
    // 11 ทันตกรรม
    if( $doctor_type == 11 ){
        $prefixDr = 'ท.';

    }elseif ($doctor_type == 14) { // แผนไทย
        $prefixDr = 'พท.ป';

    }elseif ($doctor_type == 88) { // แผนจีน
        $prefixDr = 'พจ.';
        
    }

    $sql = "INSERT INTO `inputm` VALUES (NULL, '$fullname ($prefixDr.$doctor_num)', 'md$doctor_num', 'md$doctor_num', 'ADMDR1', 'Y', '$doctor_num', '$new_md', '', '', NOW(), '$drType', '');";
    $save = $db->insert($sql);
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }

    $now = date('Y-m-d H:i:s');
    $sql = "UPDATE `runno` SET 
    `runno` = '$drRunno',
    `startday` = '$now' 
    WHERE `title` = 'doctor' ";
    $save = $db->update($sql);

    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
		$msg = errorMsg('save', $save['id']);
    }
    
    redirect('new_doctor.php', $msg);
    exit;
}


