<?php 
header('Access-Control-Allow-Origin: *');


$data = file_get_contents( "php://input" );
$data = json_decode($data, true);

function sendMsg($sMessage, $sToken){
    $ch = curl_init(); 
    curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
    curl_setopt( $ch, CURLOPT_POST, 1); 
    curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=".$sMessage); 
    $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $ch );
    if($result===false){
        echo curl_error($ch);
    }
    curl_close($ch);

    return $result;
}

function sendImage($sMessage, $sFile, $sToken){
    $ch = curl_init(); 
    curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
    curl_setopt( $ch, CURLOPT_POST, 1); 
    curl_setopt( $ch, CURLOPT_POSTFIELDS, array('message' => $sMessage, 'imageFile' => $sFile)); 
    $headers = array( 'Content-type: multipart/form-data', 'Authorization: Bearer '.$sToken );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $ch );
    if($result===false){
        echo curl_error($ch);
    }
    curl_close($ch);

    return $result;
}

$checkDepart = false;
$sMessage = sprintf("%s", $data['data']['line_msg']);
$depart = sprintf("%s", $data['data']['line_type']);
$images = $data['images'];

foreach ($images as $key => $image) {
    if(preg_match("/image\/.+/", $image) === false){
        echo "Invalid Type";
        exit;
    }
}

if($depart === 'ward'){
    $sToken = 'XhvMYujk7DaMZnNOsCYldMFya0nlv9UeEDfQhnbEgb5';
    $checkDepart = true;
}elseif ($depart === 'test') {
    $sToken = 'LdH3u9gnaKiyCBSTq1EkctYtMbErKG7gjJ1DErd2sfL';
    $checkDepart = true;
}

if($checkDepart===false or empty($sMessage)){
    echo "Invalid Data";
    exit;
}

if(count($images)>0){ 

    // $result = sendMsg($sMessage, $sToken);

    $i=1;
    foreach ($images as $key => $image) {

        
        list($b64Prefix, $b64Data) = explode(',', $image);

        // preg_match("/image\/(png|jpeg)/", $b64Prefix, $match);
        // $file_type = $match[0];

        if($b64Prefix==='data:image/png;base64'){
            $prefix = 'png';
        }else{
            $prefix = 'jpg';
        }

        $rand = rand(10000000, 99999999);
        $new_file = 'tmp_'.$rand.'.'.$prefix;
        $test_upload = file_put_contents($new_file, base64_decode($b64Data));
        // var_dump($test_upload);
        $cfile = new CurlFile($new_file);
        
        if($i==1){
            $sMessage = $sMessage."\nไฟล์แนบที่$i";
        }else{
            $sMessage = "ไฟล์แนบที่$i";
        }

        $result = sendImage($sMessage, $cfile, $sToken);
        
        // ส่งเสร็จแล้วค่อยลบไฟล์
        unlink($new_file);
        $i++;

    }
    
}else{ 

    $result = sendMsg($sMessage, $sToken);
}
header('Content-Type: application/json');
echo $result;