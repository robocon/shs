<?php 
/**
 * BASIC EXAMPLE
 * $token = "xxxx";
 * $line = new smLineNotify($token);
 * $message = "Hello world";
 * $line->send($message);
 * 
 * 
 * ภาษาไทย
 * $thaiMsg = iconv('TIS-620','UTF-8', "ภาษาไทยแบบ TIS-620");
 * $line->send($message);
 * 
 * 
 * STICKER 
 * https://devdocs.line.me/files/sticker_list.pdf
 * 
 * 
 * FULL EXAMPLE ALL ABOUT STICKER AND IMAGE
$msg = iconv('TIS-620','UTF-8', "สวัสดีชาวโลก");
$data = array(
    'message' => $msg,
    'stickerPackageId' => '1',
    'stickerId' => '114',
    'imageThumbnail' => 'https://miro.medium.com/max/700/1*xljOVkFW93WgTNdTmB5IfA.png',
    'imageFullsize' => 'https://miro.medium.com/max/700/1*xljOVkFW93WgTNdTmB5IfA.png'
);
$msgQuery = http_build_query($data, '', '&');
$res = $line->send($msgQuery);
 * 
 */
class smLineNotify 
{

    private $token = '';

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function send($message = '')
    {
        $chOne = curl_init(); 
        curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
        curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
        curl_setopt( $chOne, CURLOPT_POST, 1); 
        curl_setopt( $chOne, CURLOPT_POSTFIELDS, $message); 
        $headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$this->token.'', );
        curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
        curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec( $chOne ); 
        curl_close($chOne);
        return $result;
    }
}
