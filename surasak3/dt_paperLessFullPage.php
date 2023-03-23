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

<script language="JavaScript">
var isNS = (navigator.appName == "Netscape") ? 1 : 0;
 
if(navigator.appName == "Netscape") document.captureEvents(Event.MOUSEDOWN||Event.MOUSEUP);
 
function mischandler(){
  return false;
}
 
function mousehandler(e){
	var myevent = (isNS) ? e : event;
	var eventbutton = (isNS) ? myevent.which : myevent.button;
   if((eventbutton==2)||(eventbutton==3)) return false;
}
document.oncontextmenu = mischandler;
document.onmousedown = mousehandler;
document.onmouseup = mousehandler;
 
</script>