<?php
session_start();
$file = $_GET['path'];
$hn = sprintf("%s", $_GET['hn']);
$sOfficer = sprintf("%s", $_SESSION["sOfficer"]);

$ch = curl_init(); 
curl_setopt( $ch, CURLOPT_URL, "http://192.168.129.143/shslog/index.php"); 
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
curl_setopt( $ch, CURLOPT_POST, 1); 
curl_setopt( $ch, CURLOPT_POSTFIELDS, array('file'=>$file, 'sOfficer'=>$sOfficer, 'hn'=>$hn, 'date'=>date('c'), 'action' => 'view')); 
curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-type: multipart/form-data' )); 
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $ch );
curl_close($ch);
?>
<img src="<?=$file;?>" width="100%">