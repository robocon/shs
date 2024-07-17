<?php
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$sOfficer = sprintf("%s", $_SESSION['sOfficer']);
$hn = sprintf("%s", $_GET['hn']);

if(empty($hn) OR empty($sOfficer)){
	echo "Invalid value";
	exit;
}

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
		body{
			margin: 0;
		}
		.thumbImg{
			max-height: 200px;
			box-shadow: 5px 5px 5px #b8b8b8;
		}
		.thumbImg:hover{
			cursor: pointer;
			box-shadow: 5px 5px 5px #666666;
		}
		#thumbList{
			/* margin-top: 5em; */
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
			width:13%;
			float: left; 
			border-right: 2px solid #b8b8b8;
			text-align: center;
		}
		#right-menu{
			width: 87%;
			float: right;
			/* padding-left: 13%; */
			top:0;
			right:0;
		}
		#fullPage{
			/* position:fixed; */
            width: 400px;
            float: left;
		}
		.thumbContain{
			border-bottom:1px solid #b8b8b8;
		}
        * {box-sizing: border-box;}

        .img-zoom-container {
			position: fixed;
        }

        .img-zoom-lens {
            position: absolute;
            border: 2px solid red;
            /*set the size of the lens:*/
            width: 180px;
            height: 180px;
        }

        .img-zoom-result {
            border: 1px solid #d4d4d4;
            /*set the size of the result div:*/
            width: 300px;
            height: 700px;
        }
        #myresult{
            float: left;
        }
		#printBtn{
			background-color: #4CAF50;
			padding: 4px 8px;
			color: white;
			text-decoration: none;
			text-align: center;
			display: inline-block;
			font-size: 18px;
			border-radius: 4px;
		}
	</style>
	<div class="clearfix">
		<div id="left-menu">
			<div>
				<form action="javascript:void(0);" method="post" onsubmit="eopdFormSearch();">
					<?php 
					$currentYear = date('Y');
					$currentMonth = date('m');
					$range = range(2019, $currentYear);
					?>
					<select name="selectYear" id="selectYear">
						<option value="">All</option>
						<?php 
						foreach ($range as $key => $value) {
							$select = ( $currentYear == $value ) ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$value;?>" <?=$select;?>><?=($value+543);?></option>
							<?php
						}
						?>
					</select>
					<select name="selectMonth" class="<?=$class_name;?>" id="selectMonth">
						<option value="">All</option>
						<?php foreach($def_month_th as $key => $month): ?>
						<?php $select = ( $currentMonth == $key ) ? 'selected="selected"' : '' ; ?>
						<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
						<?php endforeach; ?>
					</select>
					<button type="submit">show</button>
				</form>
			</div>
			<div class="row" id="thumbList"></div>
		</div>
		<div id="right-menu" class="img-zoom-container clearfix">
		</div>
	</div>
	<script type="text/javascript">
        
		function eopdFormSearch(){
			console.log("Form submit");

			let selectYear = document.getElementById('selectYear').value;
			let selectMonth = document.getElementById('selectMonth').value;
			
			let selectDate = "";
			if(selectYear != "" && selectMonth != ""){
				selectDate = "&date="+document.getElementById('selectYear').value+"-"+document.getElementById('selectMonth').value;
			}else if(selectYear != "" && selectMonth == ""){
				selectDate = "&date="+document.getElementById('selectYear').value;
			}
			
			var request = new newXmlHttp();
			var hn = '<?=$hn;?>';
			request.open('GET', 'http://192.168.131.240:8081/api/getopcard?opcard_id='+hn+selectDate, true);
			request.onreadystatechange = function () {
				if (request.readyState === 4) {
					if (request.status >= 200 && request.status < 400) { 
						try {
							var d = JSON.parse(request.responseText);
							
							addContentToThumbList(d)

						} catch (error) {
							// alert("เบราเซอร์เก่าเกินไป กรุณาอัพเกรดเป็นเบราเซอร์เวอร์ชั่นใหม่");
              				// alert("asdfadsf");
						}
					} else {
						// Error :(
						// document.getElementById("resVacc").innerHTML = 'สัญญาณอินทราเน็ตมีปัญหา กรุณาลองใหม่อีกครั้ง';
					}
				} 
			};

			request.send();
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

        function imageZoom(imgID, resultID) {
            var img, lens, result, cx, cy;
            img = document.getElementById(imgID);
            result = document.getElementById(resultID);
            /* Create lens: */
            lens = document.createElement("DIV");
            lens.setAttribute("class", "img-zoom-lens");
            /* Insert lens: */
            img.parentElement.insertBefore(lens, img);
            /* Calculate the ratio between result DIV and lens: */
            cx = result.offsetWidth / lens.offsetWidth;
            cy = result.offsetHeight / lens.offsetHeight;

            /* Set background properties for the result DIV */
            result.style.backgroundImage = "url('" + img.src + "')";
			
			if(img.height==0){
				img.height=570;
			}

            result.style.backgroundSize = (img.width * Math.floor(cx)) + "px " + (img.height * Math.ceil(cy)) + "px";
            /* Execute a function when someone moves the cursor over the image, or the lens: */
            lens.addEventListener("mousemove", moveLens);
            img.addEventListener("mousemove", moveLens);
            /* And also for touch screens: */
            lens.addEventListener("touchmove", moveLens);
            img.addEventListener("touchmove", moveLens);

            function moveLens(e) {
                var pos, x, y;
                /* Prevent any other actions that may occur when moving over the image */
                e.preventDefault();
                /* Get the cursor's x and y positions: */
                pos = getCursorPos(e);
                /* Calculate the position of the lens: */
                x = pos.x - (lens.offsetWidth / 2);
                y = pos.y - (lens.offsetHeight / 2);
                /* Prevent the lens from being positioned outside the image: */
                if (x > img.width - lens.offsetWidth) {
                    x = img.width - lens.offsetWidth;
                }
                if (x < 0) {
                    x = 0;
                }
                if (y > img.height - lens.offsetHeight) {
                    y = img.height - lens.offsetHeight;
                }
                if (y < 0) {
                    y = 0;
                }
                /* Set the position of the lens: */
                lens.style.left = x + "px";
                lens.style.top = y + "px";
                /* Display what the lens "sees": */
                result.style.backgroundPosition = "-" + (x * cx) + "px -" + (y * cy) + "px";
            }

            function getCursorPos(e) {
                var a, x = 0,
                    y = 0;
                e = e || window.event;
                /* Get the x and y positions of the image: */
                a = img.getBoundingClientRect();
                /* Calculate the cursor's x and y coordinates, relative to the image: */
                x = e.pageX - a.left;
                y = e.pageY - a.top;
                /* Consider any page scrolling: */
                x = x - window.pageXOffset;
                y = y - window.pageYOffset;
                return {
                    x: x,
                    y: y
                };
            }
        }
        
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

		var def_fullm_th = {'01':'มกราคม', '02':'กุมภาพันธ์', '03':'มีนาคม', '04':'เมษายน', '05':'พฤษภาคม', '06':'มิถุนายน', '07':'กรกฎาคม', '08':'สิงหาคม', '09':'กันยายน', '10':'ตุลาคม', '11':'พฤศจิกายน', '12':'ธันวาคม'};
		
		window.onload = function(){ 
			var request = new newXmlHttp();
			var hn = '<?=$hn;?>';
			request.open('GET', 'http://192.168.131.240:8081/api/getopcard?opcard_id='+hn, true);
			request.onreadystatechange = function () {
				if (request.readyState === 4) {
					if (request.status >= 200 && request.status < 400) { 
						try {
							var d = JSON.parse(request.responseText);
							
							addContentToThumbList(d)

						} catch (error) {
							// alert("เบราเซอร์เก่าเกินไป กรุณาอัพเกรดเป็นเบราเซอร์เวอร์ชั่นใหม่");
              // alert("asdfadsf");
						}
					} else {
						// Error :(
						// document.getElementById("resVacc").innerHTML = 'สัญญาณอินทราเน็ตมีปัญหา กรุณาลองใหม่อีกครั้ง';
					}
				} 
			};

			request.send();
		}

		function addContentToThumbList(d){
			if(d.totalCount>0){ 
				// d.list.reverse();
				var html = '';
				for (var index = 0; index < d.list.length; index++) {
					const element = d.list[index];

					var dateSplit = element.date.split(" ");
					var dd = dateSplit[0].split("-");
					var year = parseInt(dd[0])+543;
					var month = def_fullm_th[dd[1]];

					html += '<div class="column thumbContain">';
					html += '<img src="'+element.thumbnail+'" alt="Lights" class="thumbImg" loading="lazy" onclick="myFunction(\''+element.original+'\');">';
					html += '<p><b>'+dd[2]+' '+month+' '+year+'</b></p>';
					html += '</div>';
				}
				document.getElementById('thumbList').innerHTML = html;
			}else{
				document.getElementById('thumbList').innerHTML = '<p>ยังไม่มีประวัติ e-OPD</p>';
			}
		}


		
		// ส่ง url ของรูปเข้ามา
		function myFunction(url){ 

			var data = [];
			data.push(encodeURIComponent('file')+"="+encodeURIComponent(url));
			data.push(encodeURIComponent('sOfficer')+"="+encodeURIComponent('<?=$sOfficer;?>'));
			data.push(encodeURIComponent('hn')+"="+encodeURIComponent('<?=$hn;?>'));
			data.push(encodeURIComponent('date')+"="+encodeURIComponent('<?=date('c');?>'));
			data.push(encodeURIComponent('action')+"="+encodeURIComponent('view'));
			var dataPost = data.join("&");

			sendLog(url, dataPost);

			// clear รูปเดิม
            var rightMenu = document.getElementById("right-menu");
            rightMenu.innerHTML = '';

			// build element ขึ้นมาแล้วยัด url ลงไป พร้อมกับ style อีกนิดหน่อย
			var img = document.createElement("img");
			img.src = url;
			img.setAttribute("id", "myZoomImage");
            img.setAttribute("style", "width: 100%; float: left;");

			// div สำหรับเก็บรูปใหญ่ที่แสดง กับ link
			var previewImgContain = document.createElement("div");
			previewImgContain.setAttribute("style", "float:left; position:relative; width:35%;");
			previewImgContain.appendChild(img);
			
			// สร้างลิ้งสำหรับสั่งพิมพ์
			var pContain = document.createElement("div");
			var aPrint = document.createElement("a");

			aPrint.setAttribute("href", "javascript:void(0);");
			aPrint.setAttribute("id", "printBtn");
			aPrint.setAttribute("onclick", "actionPrint('"+url+"');");
			aPrint.append('สั่งพิมพ์เอกสาร');
			pContain.appendChild(aPrint);

			// ใส่รุปกับลิ้ง
			previewImgContain.appendChild(pContain);

			// เพิ่มไปในเมนูขวา
			rightMenu.appendChild(previewImgContain);

			// แปะ div สำหรับซูม
            rightMenu.innerHTML += '<div id="myresult" class="img-zoom-result" style="float:left;"></div>';
			
            document.getElementById("myresult").setAttribute("style", "background-image: url("+url+"); float:left; width: 65%;");
            
			imageZoom("myZoomImage", "myresult");
		}

		function actionPrint(url){ 

			var data = [];
			data.push(encodeURIComponent('file')+"="+encodeURIComponent(url));
			data.push(encodeURIComponent('sOfficer')+"="+encodeURIComponent('<?=$sOfficer;?>'));
			data.push(encodeURIComponent('hn')+"="+encodeURIComponent('<?=$hn;?>'));
			data.push(encodeURIComponent('date')+"="+encodeURIComponent('<?=date('c');?>'));
			data.push(encodeURIComponent('action')+"="+encodeURIComponent('download'));
			var dataPost = data.join("&");

			sendLog(url, dataPost);
			
			var target = encodeURIComponent('print_eopd.php?img='+url);
			var printUrl = '<?=NOTIFY_HOST;?>/shspdf/printPdf.php?target='+target;
			window.open(printUrl,"myWindow","_blank");
		}

		async function sendLog(url, dataPost){
			await fetch('<?=NOTIFY_HOST;?>/shslog/index.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
				},
				body: dataPost
			});
		}
	</script>
</body>

</html>