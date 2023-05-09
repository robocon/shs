<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$hn = sprintf("%s", $_GET['hn']);

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'http://192.168.131.240:8081/api/getopcard?opcard_id='.$hn);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec( $ch );
$items = $json->decode($result);

?>
<style>
	body{
		margin: 0;
	}
	.thumbImg{
		max-height: 200px;
		max-width: 150px;
		box-shadow: 5px 5px 5px #b8b8b8;
	}
	.thumbImg:hover{
		cursor: pointer;
		box-shadow: 5px 5px 5px #666666;
	}
	#thumbList{
		padding-top: 7em;
	}
	#thumbList > .column{
		margin-bottom: 8px;
	}
	.thumbContain{
		border-bottom:1px solid #b8b8b8;
		text-align: center;
	}
	.thumbContain a{
		text-decoration: none;
		color: blue;
	}
</style>
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
<div style="position: fixed;width: 100%;background-color: #ffffff;box-shadow: 0px 4px 4px #b8b8b8; text-align: center;">
	<h3 style="margin:8px;">ข้อมูลการมาโรงพยาบาล</h3>

	<div style="width:100%; text-align:left;">
		<div style="">
			แผนก: <select name="depart" id="depart">
				<option value="">เลือกแผนก</option>
				<option value="เวชกรรมฟื้นฟู">เวชกรรมฟื้นฟู</option>
			</select>
		</div>
		<div>
			ปี: <select name="year" id="year">
				<option value="">เลือกปี</option>
				<option value="2023">2566</option>
			</select>
			เดือน: <select name="month" id="month" onchange="checkYear()">
				<option value="">เลือกเดือน</option>
				<option value="05">พ.ค.</option>
			</select>
		</div>
		<div>
			<button type="submit" onclick="searchData()">ค้นหา</button>
		</div>
	</div>
</div>
<div class="row" id="thumbList">
<?php
if ($items->totalCount > 0) { 
    $items_reverse = array_reverse($items->list);
	
    foreach ($items_reverse as $key => $item) {
        list($dateEp, $timeEp) = explode(' ', $item->actual_date);
        list($y, $m, $d) = explode('-', $dateEp);
        ?>
        <div class="column thumbContain">
            <a href="dt_paperLessFullPage.php?path=<?=rawurlencode($item->original);?>&hn=<?=$hn;?>" target="right">
                <img src="<?=$item->thumbnail;?>" alt="Lights" class="thumbImg" onerror="this.src='images/medical-history.png';">
                <p><b><?=$d.' '.$def_fullm_th[$m].' '.($y+543);?></b></p>
            </a>
        </div>
        <?php
    }
	
}else{
    ?><p style="text-align:center;">ยังไม่มีประวัติ e-OPD</p><?php
}
?>
</div>


<script>

const monthThai = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];

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

	function checkYear(){
		var year = document.getElementById('year').value;
		if(year==''){
			alert('กรุณาเลือกปี');
		}
	}
	function searchData(){ 

		var depart = encodeURIComponent(document.getElementById('depart').value);
		var year = document.getElementById('year').value;
		var month = document.getElementById('month').value;
		var hn = '<?=$hn;?>';
		var url = 'http://192.168.131.240:8081/api/getopcard?opcard_id='+hn;
		var date = '';
		if(year!=''){
			date = year;
		}

		if(month!=''){
			date = year+'-'+month;
			if(year==''){
				alert('กรุณาเลือกปี');
				return false;
			}
		}

		if(date!=''){
			url += '&date='+date;
		}

		if(depart!=''){
			url += '&clinic='+depart;
		}

		getData(url).then((data)=>{
			
			if(data.totalCount>0){
				
				var resHtml = '';
				data.list.forEach(el => { 

					const[getDate,getTime] = el.actual_date.split(" ");
					const[getYear,getMonth,getDay] = getDate.split("-");

					const year = parseInt(getYear);
					const month = parseInt(getMonth)-1;
					const dateThai = getDay+' '+monthThai[month]+' '+(year+543);

					resHtml += '<div class="column thumbContain">';
					resHtml += '<a href="dt_paperLessFullPage.php?path='+el.original+'&hn='+el.hn+'" target="right">';
					resHtml += '<img src="'+el.thumbnail+'" alt="Lights" class="thumbImg" onerror="this.src=\'images/medical-history.png\';">';
					resHtml += '<p><b>'+dateThai+'</b></p>';
					resHtml += '</a>';
					resHtml += '</div>';
				});

				document.getElementById('thumbList').innerHTML = resHtml;

			}else{
				document.getElementById('thumbList').innerHTML = '<p><b>ไม่พบข้อมูล</b></p>';
			}

		});
	}

	async function getData(url){
		const response = await fetch(url);
		const data = await response.json();
		return data;
	}
</script>