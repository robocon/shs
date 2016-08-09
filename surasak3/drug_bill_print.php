<?php
include 'bootstrap.php';

$id = (int) input_get('id');
$db = Mysql::load();
$sql = "SELECT `thidate`,`tradname`,`dispense`,`amountrx` 
FROM `drugimport` 
WHERE `idno` = '$id' ";
$db->select($sql);
$items = $db->get_items();

$full_items = array();
$rows = count($items);
$set_i = 0;
$thidate = '';
for ($i=0; $i < $rows ; $i++) { 
    $item = $items[$i];
    ++$set_i;
    $full_items[$set_i] = array(
        'tradename' => $item['tradname'],
        'rxdrug' => $item['dispense'],
        'num' => $item['amountrx']
    );
    
    $thidate = substr($item['thidate'], 0, 10);
}

// ตั้งวันที่ในหัวกระดาษ
list($d, $m, $y) = explode('-', $thidate, 3);
$date_serve = $d.' '.$def_fullm_th[$m].' '.$y;

include 'bill_lading_pdf.php';