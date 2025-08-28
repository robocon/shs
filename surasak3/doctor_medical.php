<?php
date_default_timezone_set("Asia/Bangkok");
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$action = isset($_POST['action']) ? $_POST['action'] : '';

if($action==='save'){

    $criteria = $_POST['criteriaCode'];
    $cookieName = date('Y-m-d').sprintf("%s", $_POST['hn']);

    $error = array();
    /**
     * @todo เตรียมเอา criteria ออก
     */
    // $sql = sprintf("INSERT INTO `doctor_medical` (`id`, `date`, `hn`, `datehn`, `drugcode`, `criteria`, `doctor`) 
    // VALUES 
    // (NULL, '%s', '%s', '%s', '%s', NULL, '%s');",
    //     $dbi->real_escape_string(date('Y-m-d')),
    //     $dbi->real_escape_string($_POST['hn']),
    //     $dbi->real_escape_string(date('Y-m-d').$_POST['hn']),
    //     $dbi->real_escape_string($_POST['drugcode']),
    //     $dbi->real_escape_string($_POST['doctor'])
    // );
    // $q = $dbi->query($sql);
    // if($q === false) {
    //     $error[] = 'Error `doctor_medical` : ' . $dbi->error;
    // }else{
    //     $doctor_medical_id = $dbi->insert_id;

        $items = $_POST['title'];
        $detail = array();
        // $sqlList = array();
        // $q = false;
        $drugcode = trim($_POST['drugcode']);
        foreach ($items as $title) { 

            $detail[$title] = $_POST[$title];

            // $detail = $json->encode($_POST[$title]);
            // $sqlList = sprintf("INSERT INTO `doctor_medical_detail` (`id`, `date`, `doctor_medical_id`, `detail`, `sub_detail`) 
            // VALUES 
            // (NULL, '%s', '%s', '%s', '%s');",
            //     $dbi->real_escape_string(date('Y-m-d')),
            //     $dbi->real_escape_string($doctor_medical_id),
            //     $dbi->real_escape_string($title),
            //     $dbi->real_escape_string($detail)
            // );
            // $q = $dbi->query($sqlList);

        }

        
        // dump($cookieName);
        // dump($criteria);
        // dump($drugcode);
        // dump($_COOKIE[$cookieName][$criteria]);
        // echo "<hr>";
        $res = array();
        if(empty($_COOKIE[$cookieName][$criteria])){
            // dump("สร้าง COOKIE ใหม่");
            $res[$criteria] = array(
                'hn' => trim($_POST['hn']),
                'criteria' => $criteria,
                'drugcode' => $drugcode,
                'doctor' => $_POST['doctor'],
                'title' => $_POST['title'],
                'detail' => $detail
            );
            // dump($res);

        }else{
            // dump("COOKIE เก่า");
            $res = $json->decode($_COOKIE[$cookieName]);
            // dump($res);
            $res[$criteria] = array(
                'hn' => trim($_POST['hn']),
                'criteria' => $criteria,
                'drugcode' => $drugcode,
                'doctor' => $_POST['doctor'],
                'title' => $_POST['title'],
                'detail' => $detail
            );
            // dump("จากนั้นสร้างใหม่");
            // dump($res);
        }


        setcookie($cookieName, $json->encode($res), strtotime(date('Y-m-d 23:59:59')), '/');

        // dump($_COOKIE[$cookieName]);
        // exit;

        // dump($res);
        // if($q!==false){
        //     setcookie($cookieName, $json->encode(array($key=>array('hn'=>$_POST['hn'],'drugcode'=>$_POST['drugcode']))), strtotime(date('Y-m-d 23:59:59')), '/');
        // }else {
        //     $error[] = 'Error `doctor_medical` : ' . $dbi->error;
        // }
        
    // }

    // if(count($error) > 0){
    //     $jsonResponse = array(
    //         'status' => 400,
    //         'message' => 'ไม่สามารถบันทึกข้อมูลได้',
    //         'error' => implode("\n", $error)
    //     );
    // }else{
        $jsonResponse = array(
            'status' => 200,
            'message' => 'บันทึกสถานะเรียบร้อย',
            'cookieName'=>$cookieName,
            'cookieData'=>$json->encode($res)
        );
    // }

    header('Content-Type: application/json');
    echo $json->encode($jsonResponse);
    exit;
}
