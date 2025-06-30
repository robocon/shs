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
	body{
		margin:0;
		padding:0;
	}
	#rotateImageBtn:hover{
		cursor: pointer;
	}
	.button {
		padding: 4px 8px;
		font-size: 16px;
		text-align: center;
		cursor: pointer;
		outline: none;
		color: #fff;
		background-color: #04AA6D;
		border: none;
		border-radius: 4px;
		box-shadow: 0 4px #999;
	}
	.button:hover {background-color: #3e8e41}
	.button:active {
		background-color: #3e8e41;
		box-shadow: 0 5px #666;
		transform: translateY(4px);
	}
</style>

<div style="position:relative; text-align:center;">
	<img src="<?=$file;?>" id="showImage">
</div>

<div style="position:fixed; top:0; left:0;">
	<button style="float:left;" id="rotateImageBtn" class="button" type="button">Rotate <i class="fa fa-rotate-right"></i></button>
	<button style="float:left; margin-left:8px;" class="button" onclick="zoomIn()" type="button">Zoom in</button>
	<button style="float:left; margin-left:8px;" class="button" onclick="zoomOut()" type="button">Zoom out</button>
	<button style="float:left; margin-left:8px;" class="button" onclick="reset()" type="button">Reset</button>
</div>

<script type="text/javascript">

	var rotation = 0;
	var angle = 90;
	var scale = 1;
	var img = document.getElementById('showImage');
	var imgHeight = 100;

	var defImgHeight = 100;
	var defRotation = 0;
	
	window.onload = function(){

		let test = Math.floor((100 * img.height) / window.innerHeight );
		if(test > 150){
			imgHeight = 150;
			var defImgHeight = 150;
		}
		
		img.style.transform = 'rotate('+rotation+'deg)';
		img.style.height = imgHeight+'%';
	}

	document.getElementById('rotateImageBtn').onclick = function(){
		rotation = (rotation + angle) % 360;
		img.style.transform = 'rotate('+rotation+'deg)';
		img.style.height = imgHeight+'%';
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

	function zoomIn(){
		scale += 0.1;
		imgHeight += 10;
		img.style.height=imgHeight+'%';
	}

	function zoomOut(){
		scale -= 0.1;
		imgHeight -= 10;
		img.style.height=imgHeight+'%';
	}

	function reset(){
		img.style.transform = 'rotate(0deg)';
		img.style.height = defImgHeight+'%';

		imgHeight = defImgHeight;
		rotation = defRotation;
	}
 
</script>