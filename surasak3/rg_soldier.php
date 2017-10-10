<?php 
session_start();

/**
 * dt_soldier -> rg_soldier
 * 
DROP TABLE IF EXISTS `rg_doctor`;
CREATE TABLE `rg_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soldier_id` int(11) DEFAULT NULL,
  `yot` varchar(50) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `code` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `soldier_id` (`soldier_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS `rg_soldier`;
CREATE TABLE `rg_soldier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `hn` varchar(45) DEFAULT NULL,
  `vn` varchar(45) DEFAULT NULL,
  `regular` text,
  `last_update` datetime DEFAULT NULL,
  `yot_pt` varchar(50) NOT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `yearchk` varchar(45) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
 */
include "includes/functions.php";
include 'includes/connect.php';

$action = $_POST['action'];
if( $action === "save" ){

    $test_dr_code = preg_match('/[0-9]+/', $_SESSION['sOfficer'], $match);
    if ( $test_dr_code > 0 ) {
        $dr_code = $match['0'];
    }

    $sql = "SELECT IF(`yot` != '', `yot`, `yot2`) AS `yot`, TRIM(SUBSTRING(`name`,6)) AS `name`, `doctorcode` 
    FROM `doctor` 
    WHERE ( `doctorcode` != '00000' AND `doctorcode` != '0000' AND `menucode` = 'ADM' ) 
    AND `status` = 'y' 
    AND `name` REGEXP '^MD+' ";
    $q = mysql_query($sql) or die( mysql_error() );
    $dr_lists = array();
    while ( $dr = mysql_fetch_assoc($q) ) {
        $key = $dr['doctorcode'];
        $dr_lists[$key] = $dr;
    }

    $db_dr = $dr_lists[$dr_code];
    
    $hn = $_SESSION['hn_now'];
    $vn = $_SESSION['vn_now'];

    $sql = "SELECT `yot`,CONCAT(`name`,' ',`surname`) AS `ptname` 
    FROM `opcard` WHERE `hn` = '$hn'";
    $q = mysql_query($sql) or die( mysql_error() );
    $pt = mysql_fetch_assoc($q);
    
    $regular = $_POST['regular'];
    $yot = $db_dr['yot'];
    $doctor = $db_dr['name'];
    $doctor_code = $dr_code;
    $yot_pt = $pt['yot'];
    $ptname = $pt['ptname'];

    $yearchk = get_year_checkup(true);

    // แพทย์ลงข้อมูลในวันนั้นแล้วรึยัง
    $curr_date = date('Y-m-d');
    $sql = "SELECT `id` 
    FROM `dt_soldier` 
    WHERE `date` LIKE '$curr_date%' 
    AND `doctor_code` = '$doctor_code' 
    AND `hn` = '$hn' 
    AND `vn` = '$vn' LIMIT 1 ";
    $q = mysql_query($sql) or die( mysql_error() );
    $hn_rows = mysql_num_rows($q);
    
    if( $hn_rows > 0 ){

        $user = mysql_fetch_assoc($q);
        $id = $user['id'];
        
        $sql = "UPDATE `dt_soldier` SET 
        `regular` = '$regular',
        `yot` = '$yot',
        `doctor` = '$doctor',
        `doctor_code` = '$doctor_code',
        `last_update` = NOW() 
        WHERE `id`='$id';";
        $save = mysql_query($sql) or die( mysql_error() );
        
    }else{

        $sql = "INSERT INTO `dt_soldier`
        (`id`,
        `date`,
        `hn`,
        `vn`,
        `regular`,
        `yot`,
        `doctor`,
        `doctor_code`,
        `last_update`,
        `yot_pt`,
        `ptname`,
        `yearchk`)
        VALUES
        (NULL,
        NOW(),
        '$hn',
        '$vn',
        '$regular',
        '$yot',
        '$doctor',
        '$doctor_code',
        NOW(),
        '$yot_pt',
        '$ptname',
        '$yearchk');";
        $save = mysql_query($sql) or die( mysql_error() );

    }
    
    if( $save !== false ){
        $_SESSION['x_msg'] = 'บันทึกข้อมูลเรียบร้อย';
        header("Location: dt_soldier.php");
    }

    exit;
}

$types = array(
    1 => array(
        'title' => 'โรคหรือความผิดปกติของตา',
        'items' => array(
            'ก' => 'ตาข้างใดข้างหนึ่งบิด คือเมื่อรักษาและแก้สายตาด้วยแว่นตาแล้วการมองเห็นยังอยู่ในระดับต่ำกว่า 3/60 หรือลานสายตาโดยเฉลี่ยแคบกว่า 10 องศา',
            'ข' => 'สายตาไม่ปกติ คือเมื่อรักษาและแก้สายตาด้วยแว่นแล้ว การมองเห็นยังอยู่ในระดับ 6/24 หรือต่ำกว่าทั้งสองข้าง',
            'ค' => 'สายตาสั้นมากกว่า 8 ไดออปเตอร์ หรือสายตายาวมากกว่า 5 ไดออปเตอร์ ทั้งสองข้าง',
            'ง' => 'ต้อแก้วตาทั้งสองข้าง (Bilateral Cataract)',
            'จ' => 'ต้อหิน (Glaucoma)',
            'ฉ' => 'โรคขั้วประสาทตาเสื่อมทั้ง 2 ข้าง (Optic Atrophy)',
            'ช' => 'ขั้วประสาทตาอักเสบเรื้อรังหรือขุ่นทั้งสองข้าง',
            'ซ' => 'ประสาทการเคลื่อนไหวลูกตาไม่ทำงานสูญเสียอย่างถาวร (Cranial never 3 , 4 , 6)'
        )
    ),2 => array(
        'title' => 'โรคหรือความผิดปกติของหู',
        'items' => array(
            'ก' => 'หูหนวกทั้งสองข้าง คือต้องใช้เสียงในช่วงคลื่นความถี่ 500-2,000 รอบต่อวินาทีหรือเกินกว่า 55 เดซิเบล จึงจะได้ยินทั้งสองข้าง',
            'ข' => 'หูชั้นกลางอักเสบเรื้อรังทั้งสองข้าง',
            'ค' => 'เยื่อแก้วหูทะลุทั้งสองข้าง'
        )
    ),3 => array(
        'title' => 'โรคของหัวใจและหลอดเลือด',
        'items' => array(
            'ก' => 'หัวใจหรือหลอดเลือดพิการอย่างถาวร จนอาจเกิดอันตรายร้ายแรง',
            'ข' => 'ลิ้นหัวใจพิการ',
            'ค' => 'การเต้นของหัวใจผิดปกติอย่างถาวร จนอาจเกิดอันตรายร้ายแรง',
            'ง' => 'โรคของแล้ามเนื้อหัวใจนิดที่ไม่สามารถรักษาให้หายขาดได้และอาจเป็นอันตราย',
            'จ' => 'หลอดเลือดแดงใหญ่โป่งพอง',
            'ฉ' => 'หลอดเลือดภายในกระโหลกศรีษะโป่งพองหรือผิดปกติชนิดที่อาจเป็นอันตราย'
        )
    ),4 => array(
        'title' => 'โรคเลือดและอวัยวะสร้างเลือด',
        'items' => array(
            'ก' => 'โรคเลือดหรืออวัยวะสร้างเลือดผิดปกติอย่างรุนแรงและอาจเป็นอันตรายถึงชีวิต',
            'ข' => 'ภาวะม้ามโต (Hypersplenism) ที่รักษาไม่หายและอาจเป็นอันตราย'
        )
    ),5 => array(
        'title' => 'โรคของระบบหายใจ',
        'items' => array(
            'ก' => 'โรคหืด (Asthma) ที่ได้รับการวินิจฉัยตามเกณฑ์การวินิจฉัย',
            'ข' => 'โรคทางปอดที่มีอาการไอ หอบเหนื่อย และมีการสูญเสียการทำงานของระบบทางเดินหายใจ โดยตรวจสมรรถภาพปอดได้ค่า forced Expiratoy Volume in One Second และ,หรือ Forced Vital Capacity ต่ำกว่าร้อยละ 60 ของค่ามาตรฐานตามเกณฑ์',
            'ค' => 'โรคความดันเลือดในปอดสูง (Pulmonary Hypertension) ซึ่งวินิจฉัยโดยการตรวจหัวใจด้วยคลื่นเสียงความถี่สูง (Echocardiogram) หรือโดยการใส่สายวัยความดันเลือดในปอด',
            'ง' => 'โรคถุงน้ำในปอด (Lung Cyst) ที่ตรวจวินิจฉัยได้โดยการถ่ายรังสีทรวงอก หรือ เอ็กซ์เรย์คอมพิวเตอร์ปอด',
            'จ' => 'โรคหยุดการหายใจขณะนอนหลับ (Obstructive Sleep Apnea) ซึ่งวินิจฉัยด้วยการตรวจการนอนหลับ (Polysomnography)'
        )
    ),6 => array(
        'title' => 'โรคของระบบปัสสาวะ',
        'items' => array(
            'ก' => 'ไตอักเสบเรื้อรัง',
            'ข' => 'กลุ่มอาการไตพิการ (Nephrotic Syndrome)',
            'ค' => 'ไตวายเรื้อรัง',
            'ง' => 'ไตพองเป็นถุงน้ำแต่กำเนิด (Polycystic Kidney)'
        )
    ),7 => array(
        'title' => 'โรคหรือความผิดปกติของกระดูก ข้อ และกล้ามเนื้อ',
        'items' => array(
            'ก' => array(
                'name' => 'โรคข้อหรือความผิดปกติของข้อ ดังต่อไปนี้',
                'attributes' => array(
                    1 => 'ข้ออักเสบเรื้อรัง (Chronic Arthritis)',
                    2 => 'ข้อเสื่อมเรื้อรัง (Chronic Osteoarthritis)',
                    3 => 'โรคข้อและกระดูกสันหลังอักเสบเรื้อรัง (Spondyloarthropathy)'
                )
            ),
            'ข' => array(
                'name' => 'แขน ขา มือ เท้า นิ้ว อย่างใดอย่างหนึ่งผิดปกติ ดังต่อไปนี้',
                'attributes' => array(
                    1 => 'แขน ขา มือ หรือเท้า ด้วนหรือพิการ ถึงแม้ว่าจะรักษาด้วยวิธีใหม่ที่สุดแล้วก็ยังใช้การไม่ได้',
                    2 => 'นิ้วหัวแม่มือด้วนจนถึงข้อปลายนิ้วหรือพิการถึงขั้นใช้การไม่ได้',
                    3 => 'นิ้วชี้ของมือด้วนตั้งแต่ข้อปลายนิ้ว',
                    4 => 'นิ้วมือในมือข้างเดียวกันตั้งแต่สองนิ้วขึ้นไปด้วนจนถึงข้อปลายนิ้วหรือพิการถึงขั้นใช้การไม่ได้',
                    5 => 'นิ้วหัวแม่เท้าด้วนจนถึงข้อปลายนิ้วหรือพิการถึงขั้นใช้การไม่ได้',
                    6 => 'นิ้วเท้าข้างเดียวกันตั้งแต่สองนิ้วขึ้นไปด้วนจนถึงข้อปลายนิ้วหรือพิการถึงขั้นใช้การไม่ได้',
                    7 => 'นิ้วเท้าในเท้าแต่ละข้างตั้งแต่หนึ่งนิ้วขึ้นไปด้วนจนถึงข้อปลายนิ้วหรือพิการถึงขั้นใช้การไม่ได้',
                    8 => 'นิ้วเท้าในเท้าข้างใดข้างหนึ่งตั้งแต่หนึ่งนิ้วขึ้นไปด้วนจนถึงข้อโคนนิ้วหรือพิการถึงขั้นใช้การไม่ได้'
                )
            ),
            'ค' => 'คอเอียงหรือแข็งทื่อชนิดถาวร',
            'ง' => 'กระดูกสันหนังโก่งหรือคดหรือแอ่นจนเห็นได้ชัด หรือแข็งทื่อชนิดถาวร',
            'จ' => 'กล้ามเนื้อเหี่ยวลีบหรือหดสั้น (Atrophy or Contracture) จนเป็นผลให้อวัยวะส่วนหนึ่งส่วใดใช้การไม่ได้'
        )
    ),8 => array(
        'title' => 'โรคของต่อมไร้ท่อและภาวะผิดปกติของเมตะบอลิสัม',
        'items' => array(
            'ก' => 'ภาวะต่อมธัยรอยด์ทำงานน้อยไปอย่างถาวร',
            'ข' => 'ภาวะต่อมพอราธัยรอยด์ทำงานน้อยไปอย่างถาวร',
            'ค' => 'ภาวะต่อมใต้สมองผิดปกติอย่างถาวร',
            'ง' => 'เบาหวาน',
            'จ' => 'ภาวะอ้วน (Obesity) ซึ่งมีดัชนีความหมายของร่างกาย (BodyMass Index) ตั้งแต่ 35 กิโลกรัมแต่รารางเมตรขึ้นไป',
            'ฉ' => 'โรคหรือความผิดปกติเกี่ยวกับเมตะบอลิสัมของแร่ธาตุ สาอาหารดุลสารน้ำอีเล็กโทรลัยท์ และกรดด่าง ตลอดจนเมตะบอลิสัมอื่นๆ ชนิดถาวร และอาจเป็นอันตราย',
            'ช' => 'ภาวะต่อมธัยรอยด์ทำงานมากผิดปกติ (Hyperthyroidism)'
        )
    ),9 => array(
        'title' => 'โรคติดเชื้อ',
        'items' => array(
            'ก' => 'โรคเรื้อน',
            'ข' => 'โรคเท้าช้าง',
            'ค' => 'โรคติดเชื้อเรื้อรังระยะแสดงอาการรุนแรง ซึ่งไม่สามารถรักษาให้หายขาดได้'
        )
    ),10 => array(
        'title' => 'โรคทางประสาทวิทยา',
        'items' => array(
            'ก' => 'จิตเจริญล่าช้า (Mental retardation) ที่มีระดับเชาว์ปัญญา 69 หรือ ต่ำกว่านั้น',
            'ข' => 'ใบ้ (Mutism) หรือพูดไม่เป็นภาษาหรือฟังภาษาไม่รู้เรื่อง (Aphasia) ชนิดถาวร',
            'ค' => 'ลมชัก (Epilepsy) หรือโรคที่ทำให้มีอาการชัก (Seizures) อย่างถาวร',
            'ง' => 'อัมพาต (Paralysis) ของแขน ขา มือ หรือ เท้าชนิดถาวร',
            'จ' => 'สมองเสื่อม (Dementia)',
            'ฉ' => 'โรคหรือความผิดปกติของสมองหรือไขสันหลังที่ทำให้เกิดความผิดปกติอย่างมากในการเคลื่อนไหวของแขนหรือขาอย่างถาวร',
            'ช' => 'กล้ามเนื้อหมดกำลังอย่างหนัก (Myasthenia Gravis)'
        )
    ),11 => array(
        'title' => 'โรคทางจิตเวช',
        'items' => array(
            'ก' => array(
                'name' => 'โรคจิตที่มีอาการรุนแรง หรือเรื้อรัง',
                'attributes' => array(
                    1 => 'โรคจิตเภท (Schizophrenia)',
                    2 => 'โรคจิตกลุ่มหลงผิด (Resistant delusional disorder, Induced delusional disorder)',
                    3 => 'โรคสคิซโซแอฟแฟ็คทีป (Schizoaffective disorder)',
                    4 => 'โรคจิตที่เกิดจากโรคทางกาย (Other Mental disorder due to brain Damage and Dysfunction)',
                    5 => 'โรคจิตอื่นๆ (Unspecified nonorganic psychosis)'
                )
            ),
            'ข' => array(
                'name' => 'โรคอารมณ์แปรปรวนที่มีอาการรุนแรง หรือเรื้อรัง',
                'attributes' => array(
                    1 => 'โรคอารมณ์แปรปรวน (Manic Episode, Bipolar Affective Disorder)',
                    2 => 'โรคอารมณ์แปรปรวนที่เกิดจากโรคทางกาย (Other Mental Disorder due to brain Damage and Dysfunction to Physical disorder)',
                    3 => 'โรคอารมณ์แปรปรวนอื่นๆ (Other Mood (Affective)Disorder, Unspecified Mood Disorder)',
                    4 => 'โรคซึมเศร้า (Depressive Depressive Disorder, Recurent Depressive Disorder)'
                )
            ),
            'ค' => array(
                'name' => 'โรคพัฒนาการทางจิตเวช',
                'attributes' => array(
                    1 => 'จิตเจริญล่าช้าที่มีระดับเชาว์ปัญญา 70 หรือต่ำกว่านั้น (Mental Retardation)',
                    2 => 'โรคหรือความผิดปกติในการพัฒนาการของทักษะทางสังคมและภาษา (Pervasive Development)'
                )
            )
        )
    ),12 => array(
        'title' => 'โรคอื่นๆ',
        'items' => array(
            'ก' => 'กระเทย (Hermaphrodism)',
            'ข' => 'มะเร็ง (Malignant Neoplasm)',
            'ค' => 'ตับอักเสบเรื้อรัง (Chronic Hepatitis)',
            'ง' => 'ตับแข็ง (Chrrhosis of Liver)',
            'จ' => 'คนเผือก (Albion)',
            'ฉ' => 'โรคลูปัสอิริธิมาโตซัสทั่วร่างกาย (Systemic Lupus Eyethematosus)',
            'ช' => 'กายแข็งทั่วร่างกาย (Systemic Sclerosis)',
            'ซ' => array(
                'name' => 'รูปวิปริตต่างๆ ได้แก่',
                'attributes' => array(
                    1 => 'จมูกโหว่',
                    2 => 'เพดานโหว่หรือสูงหรือลิ้นไก่สั้นพูดไม่ชัด'
                )
            ),
            'ฌ' => 'โรคผิวหนังลอกหลุดตัวผิดปกติแต่กำเนิดชนิดเด็กดักแด้ (Lamella Ichthyosis & Congenital Ichthyosiform Erytkroderma)'
        )
    )
);

$set_types = array();
foreach ($types as $main_number => $item_type) {

    if( count($item_type['items']) > 0 ){
        foreach( $item_type['items'] AS $item_number => $item ){

            $item_name = $item;
            $sub_item = false;
            if( is_array($item) === true ){
                $item_name = $item['name'];
                $sub_item = $item['attributes'];
            }
            
            if( $sub_item === false ){
                $sub_item_key = "$main_number.$item_number";
                $set_types[$sub_item_key] = $item_name;
            }

            $json_sub_item = array();
            if( $sub_item !== false ){
                foreach ($sub_item as $last_key => $value) {
                    $last_item_key = "$main_number.$item_number.$last_key";
                    $set_types[$last_item_key] = $value;
                }
            }

        }
    }
}

// ค้นหา
if( $action === "search_val" ){

    $regular = trim($_POST['content_txt']);
    $regular = iconv('UTF-8', 'TIS-620', $regular);

    foreach ($set_types as $key => $value) {

        $test_match_val = preg_match('/'.addslashes($regular).'/', strtolower($value));
        $test_match_key = preg_match('/'.str_replace('.','\.',$regular).'/', $key);
        
        if ( $test_match_val > 0 OR $test_match_key > 0 ) {

            $segment_list = explode('.',$key);
            $segment_txt = array();
            foreach($segment_list as $segment){
                $segment_txt[] = "($segment)";
            }
            ?>
            <a href="javascript: void(0);"><p class="search_detail"><?php echo implode(' ', $segment_txt);?> <?=$value;?></p></a>
            <?php
        }

    }

    exit;
}




?>
<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}
.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.font3 {
	font-size: 18px;
}
p{
    margin: 0;
    padding: 0;
}
.dt_patients td,
.dt_patients th{
    font-size: 20px;
    margin: 0;
    padding: 0;
}
</style>

<?php

/*
$yearchk = get_year_checkup(true);
$hn = $_SESSION['hn_now'];
$sql = "SELECT * FROM `rg_soldier` WHERE `yearchk` = '$yearchk' AND `hn` = '$hn' ";
$q = mysql_query($sql) or die( mysql_error() );
$hn_rows = mysql_num_rows($q);
if ( $hn_rows > 0 ) {
    
    ?>
    <table align="center" width="70%" border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse" class="dt_patients">
        <thead>
            <tr align="center">
                <th width="70%">กฎกระทรวง</th>
                <th width="15%">แพทย์ผู้บันทึก</th>
                <th width="15%">วันที่บันทึกข้อมูล</th>
            </tr>
        </thead>
        <tbody>
            
            <?php
            while ( $user = mysql_fetch_assoc($q) ) {
                list($date, $time) = explode(' ', $user['last_update']);
                list($year,$month,$day) = explode('-', $date);
                ?>
                <tr>
                    <td><?=$user['regular'];?></td>
                    <td><?=$user['yot'].$user['doctor'];?></td>
                    <td align="center"><?=( $day.' '.$def_fullm_th[$month].' '.( $year + 543 ) );?></td>
                </tr>
                <?php
            }
            ?>
            
        </tbody>
    </table>
    <?php
}
*/

$sql = "SELECT IF(`yot` != '', `yot`, `yot2`) AS `yot`, TRIM(SUBSTRING(`name`,6)) AS `name`, `doctorcode` 
FROM `doctor` 
WHERE ( `doctorcode` != '00' AND `doctorcode` != '00000' AND `doctorcode` != '0000' AND `menucode` = 'ADM' ) 
AND `status` = 'y' 
AND `name` REGEXP '^MD+' ";
$q = mysql_query($sql) or die( mysql_error() );
$dr_items = array();
while ( $dr = mysql_fetch_assoc($q) ) {
    $dr_items[] = $dr;
}

?>
<div>
</div>

<div>
    <form action="dt_soldier.php" method="post" id="inputForm" enctype="multipart/form-data">

        <div>
            <span>ค้นหากฏกระทรวง: </span><input type="text" id="regular_search">
            <div id="regular_result" style="color: blue; text-decoration: underline;"></div>
            <input type="hidden" id="regular" name="regular" value="">
        </div>

        <div>
            แพทย์คนที่1: 
            <select name="dr1" id="">
                <?php
                foreach ($dr_items as $key => $item) {
                    ?>
                    <option value="<?=$item['doctorcode'];?>"><?=$item['yot'].$item['name'];?></option>
                    <?php
                }
                ?>
            </select>   
        </div>
        <div>
            แพทย์คนที่2: 
            <select name="dr2" id="">
                <?php
                foreach ($dr_items as $key => $item) {
                    ?>
                    <option value="<?=$item['doctorcode'];?>"><?=$item['yot'].$item['name'];?></option>
                    <?php
                }
                ?>
            </select>   
        </div>
        <div>
            แพทย์คนที่3: 
            <select name="dr3" id="">
                <?php
                foreach ($dr_items as $key => $item) {
                    ?>
                    <option value="<?=$item['doctorcode'];?>"><?=$item['yot'].$item['name'];?></option>
                    <?php
                }
                ?>
            </select>   
        </div>
        <div>
            แนบรูปถ่าย : <input type="file" name="" id="">
        </div>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
            <input type="hidden" name="action" value="save">
        </div>
    </form>
</div>
<?php
if( !empty($_SESSION['x_msg']) ){
    ?><p style="background-color: #ffffc1; border: 1px solid #f0f000; padding: 5px;"><?=$_SESSION['x_msg'];?></p><?php
    $_SESSION['x_msg'] = false;
}
?>
<div id="show_content" style="display: none;">
<fieldset><legend>ผลการค้นหา</legend><div class="show_list"></div></fieldset>
</div>
<br>
<div id="full_detail_container">
    <button class="show_detail">แสดงข้อกฎกระทรวงทั้งหมด</button>
    <div class="full_detail" style="display: none;">
        <?php

        foreach ($types as $main_number => $item_type) {

            $header =  '<p>('.$main_number.') '.$item_type['title'].'</p>';
            echo $header;

            if( count($item_type['items']) > 0 ){
                foreach( $item_type['items'] AS $item_number => $item ){

                    $item_name = $item;
                    $sub_item = false;
                    if( is_array($item) === true ){
                        $item_name = $item['name'];
                        $sub_item = $item['attributes'];
                    }
                    

                    $txt = '<p class="from_full_detail">('.$main_number.') ('.$item_number.') '.$item_name.'</p>';
                    if( $sub_item === false ){
                        echo '<a href="javascript:void(0)">'.$txt.'</a>';
                    }else if( $sub_item !== false ){
                        echo $txt;
                    }

                    $json_sub_item = array();
                    if( $sub_item !== false ){
                        foreach ($sub_item as $last_key => $value) {
                            echo '<a href="javascript:void(0)"><p class="from_full_detail">('.$main_number.') ('.$item_number.') ('.$last_key.') '.$value.'</p></a>';
                        }
                    }

                }
            }
            ?>
            <br>
            <?php
        }
        ?>
    </div>
</div>


<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
  $(function() {
    $(document).on("click", ".show_detail", function(){
        $(".full_detail").slideToggle("fast");
    });

    $(document).on("keyup", "#regular_search", function(){

        var txt = $(this).val();
        if( txt.length >= 2 ){
            $.ajax({
                data: {"content_txt": txt,"action":"search_val"},
                // datatype: "json",
                method : "post",
                url: "dt_soldier.php",
                success: function(msg){
                    // console.log(msg);

                    if ( msg !== '' ) {
                        $("#show_content").show();
                        $(".show_list").html(msg);
                    }
                    
                }
            });
        }
        
    });

    $(document).on("click", ".from_full_detail", function(){
        var full_detail = $(this).html();
        $("#regular").val(full_detail);
        $("#regular_result").html(full_detail);
        $(".full_detail").slideUp(100);
    });

    // คลิกรายการที่ค้นหา
    $(document).on("click", ".search_detail", function(){
        var full_detail = $(this).html();
        $("#regular").val(full_detail);
        $("#regular_result").html(full_detail);
        $("#show_content").hide();
    });

    $(document).on("submit", "#inputForm", function(){
        var regular = $("#regular").val();
        if (regular == '') {
            alert('กรุณาเลือกกฎกระทรวง');
            return false;
        }
    });

  });
})(jQuery);

</script>