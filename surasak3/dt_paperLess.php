<?php
$hn = sprintf("%s", $_GET['hn']);

/*
?>
<frameset cols="25%,75%">
<frame name="left" src="dt_paperLessName.php?hn=<?=$hn;?>" scrolling="auto" />
<frame name="right" src="" scrolling="auto" />
</frameset>
<?php 
*/
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>ดูประวัติออนไลน์(e-OPD)</title>
</head>
<body>
	<style>
		.thumbImg{
			max-height: 200px;
		}
		.thumbImg:hover{
			cursor: pointer;
			box-shadow: 5px 5px 5px #b8b8b8;
		}
		#thumbList > .column{
			margin-bottom: 8px;
		}
		.clearfix::after {
			content: "";
			clear: both;
			display: table;
		}
		#left-menu{
			width:20%;
			float: left; 
			border-right: 2px solid #b8b8b8;
			text-align: center;
		}
		#right-menu{
			width: 79%;
			float:right;
		}
		#fullPage{
			position:fixed;
		}
	</style>
	<div class="clearfix">
		<div id="left-menu">
			<div class="row" id="thumbList"></div>
		</div>
		<div id="right-menu">
			<div id="fullPage"></div>
		</div>
	</div>
	<script type="text/javascript">
		function newXmlHttp(){
			var xmlhttp = false;
			try{
				xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
			}catch(e){
				try{
					xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
				}catch(e){
					xmlhttp = false;
				}
			}
			if(!xmlhttp && document.createElement){
				xmlhttp = new XMLHttpRequest();
			}
			return xmlhttp;
		}

		window.onload = function(){ 
			var request = new newXmlHttp();
			var hn = '<?=$hn;?>';
			request.open('GET', 'http://192.168.131.240:8081/api/getopcard?opcard_id='+hn, true);
			request.onreadystatechange = function () {
				if (request.readyState === 4) {
					if (request.status >= 200 && request.status < 400) { 
						try {
							var d = JSON.parse(request.responseText);
							
							if(d.totalCount>0){ 
								var html = '';
								for (var index = 0; index < d.list.length; index++) {
									const element = d.list[index];
									html += '<div class="column"><img src="'+element.thumbnail+'" alt="Lights" class="thumbImg" onclick="myFunction(\''+element.original+'\');"></div>';
								}
								document.getElementById('thumbList').innerHTML = html;
							}else{
								document.getElementById('thumbList').innerHTML = '<p>ยังไม่มีประวัติ e-OPD</p>';
							}

						} catch (error) {
							// alert("เบราเซอร์เก่าเกินไป กรุณาอัพเกรดเป็นเบราเซอร์เวอร์ชั่นใหม่");
						}
					} else {
						// Error :(
						// document.getElementById("resVacc").innerHTML = 'สัญญาณอินทราเน็ตมีปัญหา กรุณาลองใหม่อีกครั้ง';
					}
				} 
			};

			request.send();
		}
		
		function myFunction(url){ 
			var sh = screen.height-68;
			var p = document.getElementById("fullPage");
			p.setAttribute("style", "max-height: "+sh+"px;");
			p.innerHTML='';

			var img = document.createElement("img");
			img.src = url;
			img.height = sh;

			p.appendChild(img);
		}
	</script>
</body>

</html>