<?php 

/**
 * @todo 
 * [] อัพเดท eGFR ตามตารางที่พี่สมยศแนบมาให้
 * [] อัพเดท Normal range ของ eGFR ตามที่พี่สมยศเขียนมาให้ 
 * 
 * แนวทาง
 * - eGFR ปรับเป็น CSV ไฟล์
 * - Normal range ใส่เงื่อนไขในโค้ด 
 * 
 * labcode: GFR
 * labname: eGFR
 * parentcode: CREAG 
 * 
 */
include 'bootstrap.php';

$db = Mysql::load();


?>

<form action="update_lab_quarlity_61.php" method="post" enctype="multipart/form-data">

    <div>
        <input type="file" name="fix_egfr" id="">
    </div>
    <div>
        <button type="submit">upload</button>
        <input type="hidden" name="action" value="edit">
    </div>

</form>

<?php

$action = input_post('action');
if ( $action === 'edit' ) {
    
    $file = $_FILES['fix_egfr'];
    dump();
    if($file['error'] > 0){
        echo "Something is missing";
        exit;
    }

    // 
    $new_normal_range = array(

    );
    //

    $content = file_get_contents($file['tmp_name']);
    $items = explode("\r\n", $content);

    foreach ($items as $key => $item) {
        
        // dump($item);

        list($hn, $age, $new_egfr) = explode(',', $item);

        $sql = "SELECT `autonumber` 
        FROM `resulthead` 
        WHERE `hn` = '$hn' 
        AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี61' 
        AND `profilecode` = 'CREAG' ";
        $db->select($sql);

        $resHead = $db->get_item();
        $autonumber = $resHead['autonumber'];

        dump($sql);

        // ดึงค่า $new_normal_range มาตรวจก่อน อัพเดท

        $sql = "UPDATE `orderdetail` SET 
        `result` = '$new_egfr', 
        `normalrange` = '' 
        WHERE `autonumber` = '$autonumber' ";

    }
    


}


