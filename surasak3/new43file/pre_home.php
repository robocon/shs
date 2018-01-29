<?php

include '../bootstrap.php';

$db = Mysql::load();

/**
 * @todo
 * [] �Ҵ��ǡ�˹� house type
 */
$sql = "SELECT `row_id`,TRIM(`address`) AS `address`,`tambol`,`ampur`,`changwat`,thDateTimeToEn(`lastupdate`) AS `lastupdate` 
FROM `opcard` 
WHERE `idguard` NOT LIKE 'mx07%' 
AND `tambol` LIKE '%�Ԫ��%' 
AND ( 
	`address` regexp '�\.1\s?$' 
) 
GROUP BY `address` 
ORDER BY row_id;";

$db->select($sql);
$items = $db->get_items();

$home_list = array();
foreach ($items as $key => $item) {
    $home_key = $item['row_id'];

    // �Ѵ���੾�� ����1 �������㹤��� ��
    // 1
    // 1/1xx �֧ 9xx
    // �������� / �������Թ 287 
    $home_item = array();
    if( preg_match('/\d+\/?\d+/', $item['address'], $match) > 0 ){

        // ��Һ�ҹ�Ţ����� / ���¡����Ţ˹�����硡�͹����Թ 287 �ֻ���
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

    if( preg_match('/�\.\d/', $item['address'], $match) > 0 ){
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

echo "��Ѻ��ا��� home ���º����";