<?php

include '../bootstrap.php';

$db = Mysql::load();

/**
 * @todo
 * [] ขาดตัวกำหนด house type
 */
$sql = "SELECT `row_id`,TRIM(`address`) AS `address`,`tambol`,`ampur`,`changwat`,thDateTimeToEn(`lastupdate`) AS `lastupdate` 
FROM `opcard` 
WHERE `idguard` NOT LIKE 'mx07%' 
AND `tambol` LIKE '%พิชัย%' 
AND ( 
	`address` regexp 'ม\.1\s?$' 
) 
GROUP BY `address` 
ORDER BY row_id;";

$db->select($sql);
$items = $db->get_items();

$home_list = array();
foreach ($items as $key => $item) {
    $home_key = $item['row_id'];

    // คัดเอาเฉพาะ หมู่1 ที่อยู่ในค่าย เช่น
    // 1
    // 1/1xx ถึง 9xx
    // และไม่มี / คือไม่เกิน 287 
    $home_item = array();
    if( preg_match('/\d+\/?\d+/', $item['address'], $match) > 0 ){

        // ถ้าบ้านเลขที่มี / จะแยกเอาเลขหน้ามาเช็กก่อนว่าเกิน 287 รึป่าว
        if ( strpos($match['0'], '/') > 0 ) {
            
            list($main_num, $sub_num) = explode('/', $match['0']);

            if ( $main_num <= 287 ) {
                $home_item['number'] = $match['0'];
            }

        }else{
            if ( $match['0'] < 287 ) {
                $home_item['number'] = $match['0'];
            }
        }

        
    }

    if( preg_match('/ม\.\d/', $item['address'], $match) > 0 ){
        $home_item['moo'] = $match['0'];
    }

    if ( isset($home_item['number']) ) {
        $home_item['lastupdate'] = $item['lastupdate'];
        $home_list[$home_key] = $home_item;
    }
    
}


$sql = "TRUNCATE TABLE `pre_home`";
$db->select($sql);

foreach ($home_list as $key => $value) {
    $sql = "INSERT INTO `pre_home` 
    (`opcard_id`, `home_number`, `road`, `moo`, `tambon`, `amphoe`, `province`, `etc`, `update`) 
    VALUES 
    ('$key','".$value['number']."',NULL,'01','11','01','52',NULL,'".$value['lastupdate']."') ";
    $insert = $db->insert($sql);
}

echo "ปรับปรุงแฟ้ม home เรียบร้อย";