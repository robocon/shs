<?php
include_once dirname(__FILE__).'/../surasak3/newBootstrap.php';

$json_input = file_get_contents('php://input');
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$data = $json->decode($json_input);

// 1. กำหนด Whitelist ของตารางที่อนุญาต (เพื่อความปลอดภัย)
$allowed_depts = array('opd', 'dental', 'doctor');

$action = !empty($data['action']) ? $data['action'] : '';
$dept = !empty($data['typeDepart']) ? $data['typeDepart'] : '';
$id_field = !empty($data['id_field']) ? $data['id_field'] : ''; // ชื่อ Primary Key
$id_value = !empty($data['id_value']) ? $data['id_value'] : '';

if (!in_array($dept, $allowed_depts)) {
    echo $json->encode(array('status' => 'error', 'message' => 'Invalid Department'));
    exit;
}

if($dept==='opd'){
	if($action==='save'){
		dump($data);

        // DB = ตัวเก่า = ตัวใหม่
    การวินิจฉัย    diagnosis = dia1 = dia1
        diagdetail = nosis_d = dm_date
    โรคร่วม HT    ht = ht = ht
    โรคร่วม อื่นๆ    ht_etc = ht_etc = como_etc
        ht ht_d = como_etc_date
        smork = cigarette = dm_cigarette

        exit;
	}
}