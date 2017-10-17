<?php
include 'bootstrap.php';

$id = input_get('id');

$db = Mysql::load();
$sql = "SELECT * FROM `rg_soldier` WHERE `id` = '$id' ";
$db->select($sql);
$item = $db->get_item();

$yearchk = $item['yearchk'];
$img = false;
if( $item['pic'] != "NULL" ){
    $img = "certificate/$yearchk/".$item['pic'];
}

?>
<style type="text/css">
*{
    font-family: 'TH SarabunPSK';
    font-size: 16px;
}
</style>
<div style="position: relative;">
    <p>- ตัวอย่าง - </p>

    <p>ทบ.466-620</p>
    <p>ใบสำคัญความเห็นของแพทย์</p>

    <?php
    if( $img !== false ){
        ?>
        <div style="position: absolute; top: 0; right: 50px;"><img src="<?=$img;?>" width="120px;"></div>
        <?php
    }
    ?>
    
    <p>เล่มที่</p>
    <p>เลขที่</p>
    <p>วันที่ xxx เดือน xxx พ.ศ. xxx</p>
    <p>ข้าพเจ้า.....</p>

    <p>xxx</p>
</div>