<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT `code`, `name` 
FROM `grouptype` 
WHERE `status` = 'y'
ORDER BY `row_id` ASC";
$db->select($sql);
$items = $db->get_items();
$group = array();
foreach( $items as $key => $item ){
    $key = $item['code'];
    $group[$key] = $item['name'];
}

// ค้นหา G33
$sql = "SELECT `row_id`,`idcard`,`hn`,CONCAT(`yot`,' ',`name`,' ',`surname`) AS `ptname`,
`goup`,`idguard`,
IF(SUBSTRING(`idguard`, 1, 4) = '', 'MX00', (IF(CHAR_LENGTH(SUBSTRING(`idguard`, 1, 4))=4,SUBSTRING(`idguard`, 1, 4),'MX00')) ) as `idguard_code`,
`career`,SUBSTRING(`career`, 1, 2) AS `career_code`,`ptright1`,SUBSTRING(`ptright1`, 1, 3) AS `ptcode`,
`ptrightdetail`,`camp`,`yot`,`name`,`surname`,
SUBSTRING(`goup`, 1, 3) AS `goup_code`
FROM  `opcard` 
WHERE `goup` LIKE  'G33%' 

AND ( 
    `idguard` NOT LIKE 'MX07%' 
    AND `idguard` NOT LIKE 'MX04%' 
    AND `idguard` NOT LIKE 'MX05%' 
) 
/*
AND ( 
    `idguard2` NOT LIKE 'MX07%' 
    AND `idguard2` NOT LIKE 'MX04%' 
    AND `idguard2` NOT LIKE 'MX05%' 
) 
*/
AND `name` != '' 
ORDER BY `ptcode` ASC";

$db->select($sql);
$items = $db->get_items();
foreach( $items as $key => $item ){
    
    $key = $item['ptcode'];
    $id = $item['row_id'];

    $update_stat = false;

    // G35 ค.5 บัตรประกันสังคม
    if( $key === 'R06' OR $key === 'R07' OR $key === 'R08' ){
        $txt = $group['G35'];
        $update_stat = true;
    }

    // G36 ค.6 บัตรทอง30บาท
    if( $key === 'R01' OR $key === 'R09' OR $key === 'R11' OR $key === 'R12' OR $key === 'R13' OR $key === 'R36' ){
        $txt = $group['G36'];
        $update_stat = true;
    }

    // G37 ค.7 ข้าราชการพลเรือน(เบิกต้นสังกัด)
    if( $key === 'R02' OR $key === 'R04' OR $key === 'R21' ){
        $txt = $group['G37'];
        $update_stat = true;
    }

    if( $key === 'R16' OR $key === 'R33'){
        if( trim($item['idguard_code']) === 'MX01' ){ // ทหาร/ครอบครัว
            $txt = $group['G37'];
        }else{
            $txt = $group['G38'];
        }
        $update_stat = true;
    }

    if( $key === 'R03' ){
        if( trim($item['idguard_code']) === 'MX01' ){ // ทหาร/ครอบครัว
            $txt = $group['G31'];
        }else{
            if( trim($item['career_code']) === '09' ){
                $txt = $group['G37'];
            }else{
                $txt = $group['G38'];
            }
        }
        $update_stat = true;
    }

    if( $key === 'R05' ){
        $txt = $group['G38'];
        $update_stat = true;
    }

    if( $update_stat === true ){
        $sql = "UPDATE `smdb`.`opcard`
        SET `goup` = '$txt'
        WHERE `row_id` = '$id';";
            
        $update = $db->update($sql);
        dump($update);
    }
}
?>