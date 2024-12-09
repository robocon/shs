<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');
// header('Access-Control-Allow-Credentials: true');

require_once 'surasak3/includes/JSON.php';

$jsonData = file_get_contents('php://input');
$json = new Services_JSON();
$data = $json->decode($jsonData);

// $data = json_decode($jsonData, true)

// ฝั่งรับข้อมูลเข้ามาบันทึก
// $imgLists = sprintf("%s", $data['data']);
// $idcard = sprintf("%s", $data['idcard']);

$imgLists = sprintf("%s", $data->data);
$idcard = sprintf("%s", $data->idcard);

if(empty($imgLists) OR empty($idcard)){
    $msg = "Invalid data";
    $status = "400";
}else{
    $img = str_replace('data:image/png;base64,', '', $imgLists);
    $img = str_replace(' ', '+', $img);
    $imgBase64Decode = base64_decode($img);
    $file = $idcard.'.jpg';

    $im = imagecreatefromstring($imgBase64Decode);
    if ($im !== false) {
        // header('Content-Type: image/png');
        imagepng($im,dirname(__FILE__).'/image_patient/'.$file);
        imagedestroy($im);
        $msg = "Save Successful";
        $status = "200";
    }
    else {
        $msg = 'An error occurred file upload fail.';
        $status = "400";
    }
    
}
echo "{\"status\":$status, \"message\":\"$msg\"}";

