<?php
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$hn = sprintf("%s", $_GET['hn']);

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
			width: 86%;
			float:right;
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
            position: relative;
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
	</style>
	<div class="clearfix">
		<div id="left-menu">
			<div class="row" id="thumbList"></div>
		</div>
		<div id="right-menu" class="img-zoom-container clearfix">
			<div id="fullPage"></div>
            <div id="myresult" class="img-zoom-result" style="float:left;"></div>
		</div>
	</div>
	<script type="text/javascript">
        
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
            result.style.backgroundSize = (img.width * cx) + "px " + (img.height * cy) + "px";
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
							
							if(d.totalCount>0){ 
								d.list.reverse();
								var html = '';
								for (var index = 0; index < d.list.length; index++) {
									const element = d.list[index];

									var dateSplit = element.date.split(" ");
									var dd = dateSplit[0].split("-");
									var year = parseInt(dd[0])+543;
									var month = def_fullm_th[dd[1]];

									html += '<div class="column thumbContain">';
									html += '<img src="'+element.thumbnail+'" alt="Lights" class="thumbImg" onclick="myFunction(\''+element.original+'\');">';
									html += '<p><b>'+dd[2]+' '+month+' '+year+'</b></p>';
									html += '</div>';
								}
								document.getElementById('thumbList').innerHTML = html;
							}else{
								document.getElementById('thumbList').innerHTML = '<p>ยังไม่มีประวัติ e-OPD</p>';
							}

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
		
		function myFunction(url){ 

			if(window.innerHeight!=='undefined'){
				var scHeight = window.innerHeight;
			}else{
				var scHeight = window.screen.height;
			}
			
			// var p = document.getElementById("fullPage");
			// p.setAttribute("style", "max-height: "+scHeight+"px;");
			// p.innerHTML='';

			var img = document.createElement("img");
			img.src = url;
			img.setAttribute("id", "myZoomImage");
            img.setAttribute("style", "width: 400px; float: left;");
            // img.setAttribute("style", "");

            var rightMenu = document.getElementById("right-menu");
            rightMenu.innerHTML = '';

			rightMenu.append(img);
            rightMenu.innerHTML += '<div id="myresult" class="img-zoom-result" style="float:left;"></div>';

            document.getElementById("myresult").setAttribute("style", "background-image: url("+url+"); float:left; width: 63%;");

            imageZoom("myZoomImage", "myresult");
		}
	</script>
</body>

</html>