<?php 

/**
 * @todo 
 * [] �Ѿഷ eGFR ������ҧ���������Ṻ�����
 * [] �Ѿഷ Normal range �ͧ eGFR ��������������¹����� 
 * 
 * �Ƿҧ
 * - eGFR ��Ѻ�� CSV ���
 * - Normal range ������͹���� 
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
        AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�61' 
        AND `profilecode` = 'CREAG' ";
        $db->select($sql);

        $resHead = $db->get_item();
        $autonumber = $resHead['autonumber'];

        dump($sql);

        // �֧��� $new_normal_range �ҵ�Ǩ��͹ �Ѿഷ

        $sql = "UPDATE `orderdetail` SET 
        `result` = '$new_egfr', 
        `normalrange` = '' 
        WHERE `autonumber` = '$autonumber' ";

    }
    


}


