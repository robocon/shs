<?php 
session_start();
require_once 'includes/config.php';

$file = $_GET['path'];
$hn = sprintf("%s", $_GET['hn']);
$sOfficer = sprintf("%s", $_SESSION["sOfficer"]);

$ch = curl_init(); 
curl_setopt( $ch, CURLOPT_URL, NOTIFY_HOST."/shslog/index.php"); 
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
curl_setopt( $ch, CURLOPT_POST, 1); 
curl_setopt( $ch, CURLOPT_POSTFIELDS, array('file'=>$file, 'sOfficer'=>$sOfficer, 'hn'=>$hn, 'date'=>date('c'), 'action' => 'view')); 
curl_setopt( $ch, CURLOPT_HTTPHEADER, array( 'Content-type: multipart/form-data' )); 
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt( $ch, CURLOPT_TIMEOUT_MS, 2000);
$result = curl_exec( $ch );
curl_close($ch);
?>
<link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
<style>
	#rotateImageBtn{
		position: absolute;
		top: 0;
		left: 0;
	}
	#rotateImageBtn:hover{
		cursor: pointer;
	}
	.button {
		padding: 8px 8px;
		font-size: 24px;
		text-align: center;
		cursor: pointer;
		outline: none;
		color: #fff;
		background-color: #04AA6D;
		border: none;
		border-radius: 8px;
		box-shadow: 0 9px #999;
	}

	.button:hover {background-color: #3e8e41}

	.button:active {
		background-color: #3e8e41;
		box-shadow: 0 5px #666;
		transform: translateY(4px);
	}
</style>

<div style="position:relative;">
	<img src="<?=$file;?>" id="showImage" width="100%">
	<div id="rotateImageBtn" class="button">Rotate <i class="fa fa-rotate-right" style="font-size:24px"></i></div>
</div>

<script type="text/javascript">
	let rotation = 0;
	const angle = 90;
	document.getElementById('rotateImageBtn').onclick = function(){
		var img = document.getElementById('showImage');
		rotation = (rotation + angle) % 360;
		img.style.transform = 'rotate('+rotation+'deg)';
	}
  

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