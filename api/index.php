<?php
include_once dirname(__FILE__).'/../surasak3/newBootstrap.php';
define('BASE_API', '1');
$json_input = file_get_contents('php://input');
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$data = $json->decode($json_input);

// 1. กำหนด Whitelist ของตารางที่อนุญาต (เพื่อความปลอดภัย)
$allowed_depts = array('opd', 'hypertension', 'lab', 'doctor');

/**
 * @readme ตัวอย่างการส่งข้อมูล
 * 
 * Header ส่งมาเป็น 'Content-Type': 'application/json'
 * Method เป็น POST อย่างเดียว
 * ดูตัวอย่างได้จาก https://youmightnotneedjquery.com/#post
 * 
 * Parameter ที่จำเป็น
 * @param string typeDepart เป็นตัวบอกว่าจะใช้แผนกไหน
 * @param string action     เป็นตัวบอกว่าจะให้ทำอะไรใน typeDepart นั้นอีกที
 * 
 * การตัด URL ของ PHP ใน surasak38
 * 
 * $parts = parse_url(DOMAIN_PATH);
 * $path_parts = explode('/', trim($parts['path'], '/')); // แยก path เป็น array
 * $first_sub = DOMAIN.$path_parts[0]; // จะได้pathเต็มเป็น 'http://xxxxx/sm3'
 */
$action = !empty($data['action']) ? $data['action'] : '';
$dept = !empty($data['typeDepart']) ? $data['typeDepart'] : '';
// $id_field = !empty($data['id_field']) ? $data['id_field'] : ''; // ชื่อ Primary Key
// $id_value = !empty($data['id_value']) ? $data['id_value'] : '';

if (!in_array($dept, $allowed_depts)) {
    echo $json->encode(array('status' => 'error', 'message' => 'Invalid Department'));
    exit;
}

/**
 * เวลาเอาไปใช้งานไม่ต้อง $_POST ให้ใช้ $data['xxx'] แบบนี้ได้เลย
 */
if($dept==='opd'){
	include_once dirname(__FILE__).'/opd.php';
}elseif($dept==='hypertension'){
	include_once dirname(__FILE__).'/hypertension.php';
}elseif($dept==='lab'){
	include_once dirname(__FILE__).'/lab.php';
}
