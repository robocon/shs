<?php
# รายการยาที่เคยเบิกไปแล้ว
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = (int) input_get('id');
$q = sprintf("SELECT `thidate`,`drugcode`,`tradname`,`dispense`,`amountrx` 
FROM `drugimport` 
WHERE `idno` = '%s' ", $dbi->real_escape_string($id));
$q = $dbi->query($q);
$full_items = array();
$rows = $q->num_rows;
$set_i = 0;
$thidate = '';
$i = 1;
while($item = $q->fetch_assoc()) {
    $full_items[$i] = array(
        'drugcode' => $item['drugcode'],
        'tradename' => $item['tradname'],
        'rxdrug' => $item['dispense'],
        'num' => $item['amountrx']
    );
    
    $thidate = substr($item['thidate'], 0, 10);
    $i++;
}

// ตั้งวันที่ในหัวกระดาษ
list($d, $m, $y) = explode('-', $thidate, 3);
$date_serve = $d.' '.$def_fullm_th[$m].' '.$y;

include 'bill_lading_pdf.php';