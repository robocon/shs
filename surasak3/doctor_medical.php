<?php
/**
 * @todo เก็บค่า cookie เอาไว้แล้วค่อยเอาไปใช้งานในหน้ dt_drug_add.php
 */
date_default_timezone_set("Asia/Bangkok");
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$action = isset($_POST['action']) ? $_POST['action'] : '';

// สร้าง Cookie ไว้เก็บข้อมูลเฉยๆ
if($action==='save'){

    $title = $criteria = $_POST['criteriaCode'];
    $cookieName = date('Y-m-d').sprintf("%s", $_POST['hn']);

    $dataDetail = array();
    $drugcode = trim($_POST['drugcode']);
    foreach ($_POST['title'] as $k) {
        $dataDetail[$k] = $_POST[$k];
    }
    
    if(!empty($_COOKIE[$cookieName][$criteria])){
        $res = $json->decode($_COOKIE[$cookieName]);
    }

    $res[$criteria] = array(
        'hn' => trim($_POST['hn']),
        'criteria' => $criteria,
        'drugcode' => $drugcode,
        'doctor' => $_POST['doctor'],
        'title' => $title,
        'detail' => $dataDetail
    );

    setcookie($cookieName, $json->encode($res), strtotime(date('Y-m-d 23:59:59')), '/');

    $jsonResponse = array(
        'status' => 200,
        'message' => 'บันทึกสถานะเรียบร้อย',
        'cookieName'=>$cookieName,
        'cookieData'=>$json->encode($res)
    ); 

    header('Content-Type: application/json');
    echo $json->encode($jsonResponse);
    exit;
}
