<?php

/*
mx01 ----> ทหารและครอบครัว

age >= 75 ผู้สูงอายุ

ตรวจโรคทั่วไป

Q_ คิวปกติ
ท ทหาร
DEN_ ทันตกรรม
สูติ_ สูติ

EYE_ ตา

Old ผู้สูงอายุ

กทพ ตรวจสุขภาพทหารพราน

*/

include 'bootstrap.php';

$id = input_get('id');

$db = Mysql::load();

$sql = "SELECT a.*, b.`idguard` 
FROM `opday` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`row_id` = '$id' ";
$db->select($sql);
$item = $db->get_item();

$type_queue = 'ตรวจโรคทั่วไป';
$wait_queue = 'รอรับบริการที่จุดคัดแยก';
$age = substr($item['age'], 0, 2);
$mx = substr($item['idguard'], 0, 2);

if( preg_match('/(Q_|ท|DEN_|สูติ_|EYE_|Old)/', $item['kew'], $match) > 0 ){
    $prefix = $match['0'];

    if( $prefix == 'ท' OR $mx == 'MX01' ){
        $type_queue = 'ทหารและครอบครัว';

    }elseif ( $prefix == 'DEN_' ) {
        $type_queue = 'ทันตกรรม';
        $wait_queue = 'ได้รับบัตรแล้วยื่นที่แผนกทันตกรรม';

    }elseif ( $prefix == 'สูติ_' ) {
        $type_queue = 'สูติ';
        $wait_queue = 'ได้รับบัตรแล้วยื่นแผนกสูติ';

    }elseif ( $prefix == 'EYE_' ) {
        $type_queue = 'ตา';

    }elseif ( $prefix == 'Old' OR ( $prefix == 'Q_' && $age >= 75 ) ) {
        $type_queue = 'ผู้สูงอายุ';

    }elseif ( $prefix == 'กทพ' ) {
        $type_queue = 'ตรวจสุขภาพทหารพราน';

    }
}

?>
<center><font size=5><b>ลำดับที่: <?=$item['kew'];?></b><br>
<center><font size=4><b><?=$type_queue;?></b><br>
<center><font size=2><b>วันที่ <?=$item['thidate'];?></b><br>
<center><?=$item['ptname'];?><br>
<center>HN:<?=$item['hn'];?>.....VN:<?=$item['vn'];?><br>
<center><b><?=$wait_queue;?></b><br>
<script type="text/javascript">

function CloseWindowsInTime(t){
	window.print();
    t = t*1000;
    setTimeout("window.close()",t);
}
CloseWindowsInTime(2); 

</script>