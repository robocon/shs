<?php
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON();
$action = isset($_POST['action']) ? $_POST['action'] : '';

if($action==='save'){
    $error = array();
    $sql = sprintf("INSERT INTO `doctor_medical` (`id`, `date`, `hn`, `datehn`, `drugcode`, `criteria`, `doctor`) 
    VALUES 
    (NULL, '%s', '%s', '%s', '%s', '%s', '%s');",
        $dbi->real_escape_string(date('Y-m-d')),
        $dbi->real_escape_string($_POST['hn']),
        $dbi->real_escape_string(date('Y-m-d').$_POST['hn']),
        $dbi->real_escape_string($_POST['drugcode']),
        $dbi->real_escape_string($_POST['criteria']),
        $dbi->real_escape_string($_POST['doctor'])
    );
    $q = $dbi->query($sql);
    if($q === false) {
        $error[] = 'Error `doctor_medical` : ' . $dbi->error;
    }else{
        $doctor_medical_id = $dbi->insert_id;

        $items = $_POST['detail'];
        $sub_detail = $json->encode($_POST['sub_detail']);
        $sqlList = array();
        
        foreach ($items as $item) {
            $sqlList[] = sprintf("INSERT INTO `doctor_medical_detail` (`id`, `date`, `doctor_medical_id`, `detail`, `sub_detail`) 
            VALUES 
            (NULL, '%s', '%s', '%s', '%s');",
                $dbi->real_escape_string(date('Y-m-d')),
                $dbi->real_escape_string($doctor_medical_id),
                $dbi->real_escape_string($item),
                $dbi->real_escape_string($sub_detail)
            );
            
        }
        $sqlItem = implode("\n", $sqlList);
        $q = $dbi->multi_query($sqlItem);
        if($q === false) {
            $error[] = 'Error `doctor_medical` : ' . $dbi->error;
        }
    }

    if(count($error) > 0){
        $res = array(
            'status' => 400,
            'message' => 'ไม่สามารถบันทึกข้อมูลได้',
            'error' => implode("\n", $error)
        );
    }else{
        $res = array(
            'status' => 200,
            'message' => 'บันทึกข้อมูลเรียบร้อย',
            'id' => $doctor_medical_id
        );
    }
    header('Content-Type: application/json');
    echo $json->encode($res);
    exit;
}
