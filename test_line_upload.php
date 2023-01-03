<?php

$action = $_POST['action'];
if($action == 'send'){

    $msg = sprintf("%s", $_REQUEST['text']);
    $sToken = 'LdH3u9gnaKiyCBSTq1EkctYtMbErKG7gjJ1DErd2sfL';

    $file = $_FILES['file'];
    $cfile = curl_file_create($file['tmp_name'], $file['type'], $file['name']);

    $data = array(
        'message' => $msg,
        'imageFile' => $cfile
    );

    $ch = curl_init(); 
    curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
    curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
    curl_setopt( $ch, CURLOPT_POST, 1); 
    curl_setopt( $ch, CURLOPT_POSTFIELDS, $data); 
    $headers = array( 'Content-type: multipart/form-data', 'Authorization: Bearer '.$sToken );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers); 
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
    $result = curl_exec( $ch );
    if($result===false){
        echo curl_error($ch);
    }
    curl_close($ch);

    var_dump($result);


}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="test_line_upload.php" method="post" enctype="multipart/form-data">
        <div>
            msg: <input type="text" name="text" id="">
        </div>
        <div>
            file: <input type="file" name="file" id="">
        </div>
        <div>
            <button type="submit">Send</button>
            <input type="hidden" name="action" value="send">
        </div>
    </form>
</body>
</html>
<?php 

