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
$sql = "SELECT a.`row_id`,a.`thidate`,a.`hn`,a.`vn`,a.`ptname`,a.`camp`,
a.`goup`,
SUBSTRING(a.`goup`, 1, 3) AS `goup_code`,
a.`ptright`,
SUBSTRING(a.`ptright`, 1, 3) AS `ptcode`,
b.`career`,
SUBSTRING(b.`career`, 1, 2) AS `career_code`,
b.`idguard`,
IF(SUBSTRING(b.`idguard`, 1, 4) = '', 'MX00', (IF(CHAR_LENGTH(SUBSTRING(b.`idguard`, 1, 4))=4,SUBSTRING(b.`idguard`, 1, 4),'MX00')) ) as `idguard_code`
FROM `opday` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thidate` LIKE '2559%' 
AND a.`goup` LIKE  'G33%' 
AND ( 
    b.`idguard` NOT LIKE 'MX07%' 
    AND b.`idguard` NOT LIKE 'MX04%' 
    AND b.`idguard` NOT LIKE 'MX05%' 
) 
ORDER BY `ptcode` ASC ;";

$db->select($sql);
$items = $db->get_items();
dump($items);
// exit;
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
        // dump($sql);
        $update = $db->update($sql);
        dump($update);
    }
}
?>