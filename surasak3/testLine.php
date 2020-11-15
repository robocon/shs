<?php 
include 'bootstrap.php';
include 'api/smLineNotify.php';

$line = new smLineNotify("LdH3u9gnaKiyCBSTq1EkctYtMbErKG7gjJ1DErd2sfL");

$msg = iconv('TIS-620','UTF-8', "ÊÇÑÊ´ÕªÒÇâÅ¡");
$data = array(
    'message' => $msg,
    'stickerPackageId' => '1',
    'stickerId' => '114',
    'imageThumbnail' => 'https://miro.medium.com/max/700/1*xljOVkFW93WgTNdTmB5IfA.png',
    'imageFullsize' => 'https://miro.medium.com/max/700/1*xljOVkFW93WgTNdTmB5IfA.png'
);
$msgQuery = http_build_query($data, '', '&');
$res = $line->send($msgQuery);

dump($res);