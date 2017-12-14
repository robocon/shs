<?php 
include 'bootstrap.php';

if( empty($_SESSION['sOfficer']) ){ 
    echo 'เกิดข้อผิดพลาดบางประการ กรุณา<a href="login_page.php">เข้าสู่ระบบ</a>อีกครั้ง';
    exit;
}

$db = Mysql::load();

/**
 * @todo 
 * [] form เพิ่มข้อมูล
 *      [] แจ้งเตือนแพทย์ซ็ำ
 *      [] แนบรูป + ตัดรูป 1 นิ้ว
 * [] หน้าหลัก + ค้นหาตาม HN
 *      [] ส่งออกเป็น pdf + xlsx
 * [] หน้าแก้ไขข้อมูล
 *      [] ฟอร์มเดียวกันกับหน้าเพิ่ม
 */

 /*
CREATE TABLE `rg_soldier` (
  `id` int(11) NOT NULL auto_increment,
  `date` datetime default NULL,
  `hn` varchar(45) default NULL,
  `address` text,
  `regular` text,
  `last_update` datetime default NULL,
  `yot_pt` varchar(50) NOT NULL,
  `ptname` varchar(255) default NULL,
  `yearchk` varchar(45) default NULL,
  `pic` varchar(255) default NULL,
  `book_id` varchar(50) NOT NULL,
  `number_id` varchar(50) NOT NULL,
  `yot1` varchar(50) NOT NULL,
  `doctor1` varchar(255) NOT NULL,
  `code1` varchar(50) NOT NULL,
  `yot2` varchar(50) NOT NULL,
  `doctor2` varchar(255) NOT NULL,
  `code2` varchar(50) NOT NULL,
  `yot3` varchar(50) NOT NULL,
  `doctor3` varchar(255) NOT NULL,
  `code3` varchar(50) NOT NULL,
  `diag` text NOT NULL,
  `province` varchar(255) NOT NULL,
  `editor` varchar(255) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;
 */

$action = input('action');
if( $action === "save" ){

    $id = input_post('id', false);

    // $dr1 = input_post('dr1');
    // $dr2 = input_post('dr2');
    // $dr3 = input_post('dr3');
    $hn = input_post('hn');
    $book_id = input_post('book_id');
    $number_id = input_post('number_id');
    $diag = input_post('diag');
    $regular = input_post('regular');
    $yearchk = get_year_checkup(true);
    $file_name = 'NULL';
    
    $sql = "SELECT `yot`,CONCAT(`name`,' ',`surname`) AS `ptname`, CONCAT(`address`,' ',`tambol`,' ',`ampur`) AS `address`, `changwat` AS `province`
    FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
    $db->select($sql);
    $pt = $db->get_item();
    $yot_pt = $pt['yot'];
    $ptname = $pt['ptname'];
    $address = $pt['address'];
    $province = $pt['province'];
    $editor = $_SESSION['sOfficer'];
    
    $dr_lists = array();
    for ($i=1; $i <= 3; $i++) { 

        $dr_code = input_post('dr'.$i);

        $sql = "SELECT IF(`yot` != '', `yot`, `yot2`) AS `yot`, TRIM(SUBSTRING(`name`,6)) AS `name`, `doctorcode` 
        FROM `doctor` 
        WHERE `doctorcode` = '$dr_code'  
        AND `status` = 'y' 
        AND `name` REGEXP '^MD+' ";
        $db->select($sql);
        $dr = $db->get_item();
        
        // $i = 0;
        // foreach ( $items as $key => $dr ) {
            // ++$i;
            $dr_lists['yot'.$i] = $dr['yot'];
            $dr_lists['doctor'.$i] = $dr['name'];
            $dr_lists['code'.$i] = $dr['doctorcode'];
        // }

    }
    

    if( empty($id) ){
        $sql = "INSERT INTO `rg_soldier`
        (`id`,`date`,`hn`,`address`,`regular`,
        `last_update`,`yot_pt`,`ptname`,`yearchk`,`book_id`,
        `number_id`,`yot1`,`doctor1`,`code1`,`yot2`,
        `doctor2`,`code2`,`yot3`,`doctor3`,`code3`,
        `diag`,`province`,`editor`) 
        VALUES 
        (NULL,NOW(),'$hn','$address','$regular',
        NOW(),'$yot_pt','$ptname','$yearchk','$book_id',
        '$number_id','".$dr_lists['yot1']."','".$dr_lists['doctor1']."','".$dr_lists['code1']."','".$dr_lists['yot2']."',
        '".$dr_lists['doctor2']."','".$dr_lists['code2']."','".$dr_lists['yot3']."','".$dr_lists['doctor3']."','".$dr_lists['code3']."',
        '$diag','$province','$editor');
        ";
        $save = $db->insert($sql);
        $last_id = $db->get_last_id();
    }else{
        $sql = "UPDATE `rg_soldier`
        SET
        `regular` = '$regular',
        `last_update` = NOW(),
        `book_id` = '$book_id',
        `number_id` = '$number_id',
        `yot1` = '".$dr_lists['yot1']."',
        `doctor1` = '".$dr_lists['doctor1']."',
        `code1` = '".$dr_lists['code1']."',
        `yot2` = '".$dr_lists['yot2']."',
        `doctor2` = '".$dr_lists['doctor2']."',
        `code2` = '".$dr_lists['code2']."',
        `yot3` = '".$dr_lists['yot3']."',
        `doctor3` = '".$dr_lists['doctor3']."',
        `code3` = '".$dr_lists['code3']."',
        `diag` = '$diag',
        `editor` = '$editor'
        WHERE `id` = '$id';";
        $save = $db->update($sql);
        $last_id = $id;
    }

    $files = $_FILES['pic_patient'];
    $ext = strrchr(strtolower($files['name']), ".");
    if( $files['error'] === 0 && ( $ext == '.png' OR $ext == '.jpg' OR $ext == '.jpeg' ) ){
        $file_name = md5($files['tmp_name']).$ext;
        $folder = 'certificate';
        if( !file_exists($folder) ){ mkdir($folder); }
        if( !file_exists($folder.'/'.$yearchk) ){ mkdir($folder.'/'.$yearchk); }
        move_uploaded_file($files['tmp_name'], $folder.'/'.$yearchk.'/'.$file_name);

        $sql = "UPDATE `rg_soldier` SET `pic` = '$file_name' WHERE `id` = '$last_id';";
        $save = $db->update($sql);

    }
    $msg = 'บันทึกข้อมูลเรียบร้อย';
    if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
    }

    redirect('rg_soldier.php', $msg);
    exit;

} else if( $action === 'delete' ){
    $id = input_get('id');

    if( $id === false ){
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "DELETE FROM `rg_soldier` WHERE `id` = '$id' ";
    $delete = $db->delete($sql);

    if( $delete !== false ){
        $_SESSION['x-msg'] = 'ลบข้อมูลเรียบร้อย';
        header("Location: rg_soldier.php");
    }

}

$types = array(
    1 => array(
        'title' => 'โรคหรือความผิดปกติของตา',
        'items' => array(
            'ก' => 'ตาข้างใดข้างหนึ่งบอด คือเมื่อรักษาและแก้สายตาด้วยแว่นตาแล้วการมองเห็นยังอยู่ในระดับต่ำกว่า 3/60 หรือลานสายตาโดยเฉลี่ยแคบกว่า 10 องศา',
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


include 'rg_menu.php';
$page = input('page');
if( empty($page) ){

    ?>
    <div class="claearfix">
    <h3>รายงานการตรวจโรคชายไทยก่อนเกณฑ์ทหาร(ที่พบความผิดปกติ)</h3>

    <div>
        <form action="rg_soldier.php" method="post">
            <div>
                <div>
                    เลือกปี: 
                    <?php 
                    $curr_year = date('Y');
                    $range_y = range(2017, $curr_year);
                    $selected_y = input_post('year_selected', $curr_year);
                    echo getYearList('year_selected', false, $selected_y, $range_y);

                    $selected_m = input_post('selected_month', date('m'));
                    ?>
                    เลือกเดือน: <?=getMonthList('selected_month', $selected_m);?>

                    <button type="submit">แสดงผล</button>
                </div>
            </div>
        </form>
    </div>

    <?php

    $sql = "SELECT a.*, b.`idcard`, b.`changwat` 
    FROM `rg_soldier` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    WHERE `last_update` LIKE '$selected_y-$selected_m%' 
    ORDER BY number_id ASC";
    $db->select($sql);
    $items = $db->get_items();

    $rows = $db->get_rows();
    if( $rows > 0 ){
        ?>
        <table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
            <thead>
                <tr>
                    <th>ลำดับ</th>
                    <th>เล่มที่</th>
                    <th>เลขที่</th>
                    <th>คำนำหน้า</th>
                    <th>ชื่อ</th>
                    <th>นามสกุล</th>
                    <th width="8%">รหัสบัตรประจำตัวประชาชน</th>
                    <th>โรคที่ตรวจพบ</th>
                    <th width="30%">กฎกระทรวงที่ขัด</th>
                    <th width="12%">ภูมิลำเนาทหาร</th>
                    <th>จังหวัด</th>
                    <th>วันที่ออกใบรับรอง</th>
                    <th width="12%">คณะกรรมการแพทย์ที่ตรวจ</th>
                    <th>พิมพ์</th>
                    <th>แก้ไข</th>
                    <th>ลบ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                foreach ($items as $key => $item) {
                    list($firstname, $lastname) = explode(' ', $item['ptname']);

                    $board = $item['yot1'].$item['doctor1'].'<br>';
                    $board .= $item['yot2'].$item['doctor2'].'<br>';
                    $board .= $item['yot3'].$item['doctor3'];

                    list($date, $time) = explode(' ',$item['last_update']);
                    list($y, $m, $d) = explode('-', $date);

                    $lastupdate = $d.' '.$def_fullm_th[$m].' '.( $y + 543 );
                    ?>
                    <tr>
                        <td><?=$i;?></td>
                        <td><?=$item['book_id'];?></td>
                        <td><?=$item['number_id'];?></td>
                        <td><?=$item['yot_pt'];?></td>
                        <td><?=$firstname;?></td>
                        <td><?=$lastname;?></td>
                        <td><?=$item['idcard'];?></td>
                        <td><?=$item['diag'];?></td>
                        <td><?=$item['regular'];?></td>
                        <td><?=$item['address'];?></td>
                        <td><?=$item['changwat'];?></td>
                        <td><?=$lastupdate;?></td>
                        <td><?=$board;?></td>
                        <td><a href="rg_soldier_print.php?id=<?=$item['id'];?>" target="_blank">พิมพ์</a></td>
                        <td><a href="rg_soldier.php?page=form&id=<?=$item['id'];?>">แก้ไข</a></td>
                        <td><a href="rg_soldier.php?action=delete&id=<?=$item['id'];?>" onclick="return del_confirm();">ลบ</a></td>
                    </tr>
                    <?php
                    $i++;
                }
                ?>
            </tbody>
        </table>
        </div>
        <script type="text/javascript">
            function del_confirm(){
                var c = confirm('ยืนยันการลบข้อมูล');
                if( c === false ){
                    return false;
                }
            }
        </script>
        <?php
    }else{
        ?>
        <p>ยังไม่มีข้อมูล</p>
        <?php
    }

} else if( $page === 'form' ){
    
    $id = input_get('id');
    
    if( empty($id) ){
        $hn = input_post('hn', false);
        ?>
        <h3>ฟอร์มบันทึกข้อมูล ตรช.</h3>
        <form action="rg_soldier.php?page=form" method="post">
            <fieldset>
                <legend>ระบุ HN</legend>
                <div>
                    HN: <input type="text" name="hn" value="<?=$hn;?>">
                </div>
                <div>
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="search_hn" value="1">
                </div>
            </fieldset>
        </form>
        <?php
        $search_hn = input('search_hn', false);
        $yearchk = $pic = $diag = $code3 = $code2 = $code1 = $regular = $number_id = $book_id = false;
        
    }else{
        $search_hn = 1;
        $sql = "SELECT * FROM `rg_soldier` WHERE `id` = '$id' ";
        $db->select($sql);
        $user = $db->get_item();

        $hn = $user['hn'];
        $book_id = $user['book_id'];
        $number_id = $user['number_id'];
        $regular = $user['regular'];
        $diag = $user['diag'];
        $code1 = $user['code1'];
        $code2 = $user['code2'];
        $code3 = $user['code3'];
        $pic = $user['pic'];
        $yearchk = $user['yearchk'];
        ?>
        <h3>ฟอร์มแก้ไขข้อมูล ตรช.</h3>
        <?php
    }

    
    if( $search_hn !== false ){

        $sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn'";
        $db->select($sql);
        $user = $db->get_item();

        $sql = "SELECT IF(`yot` != '', `yot`, `yot2`) AS `yot`, TRIM(SUBSTRING(`name`,6)) AS `name`, `doctorcode` 
        FROM `doctor` 
        WHERE  `rg_status` != '' 
        AND `name` REGEXP '^MD+' order by rg_status";
        $q = mysql_query($sql) or die( mysql_error() );
        $dr_items = array();
        while ( $dr = mysql_fetch_assoc($q) ) {
            $dr_items[] = $dr;
        }
    
        ?>
        <div>
            <form action="rg_soldier.php" method="post" id="inputForm" enctype="multipart/form-data">
                <div>ชื่อ-สกุล: <?=$user['ptname'];?></div>

                <div>
                    เล่มที่ <input type="text" name="book_id" value="<?=$book_id;?>"> เลขที่ <input type="text" name="number_id" value="<?=$number_id;?>">
                </div>

                <div>
                    <span>ค้นหากฏกระทรวงที่ขัด: </span><input type="text" id="regular_search" >
                    <div id="regular_result" style="color: blue; text-decoration: underline;"><?=$regular;?></div>
                    <input type="hidden" id="regular" name="regular" value="<?=$regular;?>">
                </div>
    
                <div>
                    คณะกรรมการแพทย์คนที่1: 
                    <select name="dr1" id="dr1">
                        <?php
                        foreach ($dr_items as $key => $item) {
                            $selected = ( $item['doctorcode'] == $code1 ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$item['doctorcode'];?>" <?=$selected;?> ><?=$item['yot'].$item['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>   
                </div>
                <div>
                    คณะกรรมการแพทย์คนที่2: 
                    <select name="dr2" id="dr2">
                        <?php
                        foreach ($dr_items as $key => $item) {
                            $selected = ( $item['doctorcode'] == $code2 ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$item['doctorcode'];?>" <?=$selected;?> ><?=$item['yot'].$item['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>   
                </div>
                <div>
                    คณะกรรมการแพทย์คนที่3: 
                    <select name="dr3" id="dr3">
                        <?php
                        foreach ($dr_items as $key => $item) {
                            $selected = ( $item['doctorcode'] == $code3 ) ? 'selected="selected"' : '' ;
                            ?>
                            <option value="<?=$item['doctorcode'];?>" <?=$selected;?> ><?=$item['yot'].$item['name'];?></option>
                            <?php
                        }
                        ?>
                    </select>   
                </div>
                <div>
                    โรคที่ตรวจพบ <input type="text" name="diag" value="<?=$diag;?>">
                </div>
                <div>
                    แนบรูปถ่าย : <input type="file" name="pic_patient" id="" style="font-size: 12px;">
                    <?php
                    if ( $pic != 'NULL' && $pic != false ) {
                        ?>
                        <p><u>(กรณีที่ต้องการเปลี่ยนรูปสามารถอัพโหลดรูปใหม่ทับได้ทันที)</u></p>
                        <img src="certificate/<?=$yearchk;?>/<?=$pic;?>" style="width: 120px;">
                        <?php
                    }
                    ?>
                    
                </div>
                <div>
                    <button type="submit">บันทึกข้อมูล</button>
                    <input type="hidden" name="action" value="save">
                    <input type="hidden" name="hn" value="<?=$hn;?>">
                    <input type="hidden" name="id" value="<?=$id;?>">
                </div>
            </form>
        </div>
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
                        url: "rg_soldier.php",
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

                var dr1 = $("#dr1").val();
                var dr2 = $("#dr2").val();
                var dr3 = $("#dr3").val();

                if( dr1 == dr2 || dr1 == dr3 || dr2 == dr3 ){
                    alert('ชื่อแพทย์ซ้ำ กรุณาเลือกแพทย์ใหม่อีกครั้ง');
                    return false;
                }

            });
    
        });
        })(jQuery);
    
        </script>
    
        <?php
    }

}