<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$hn = sprintf("%s", $_GET['hn']);
if(empty($hn)){
	echo "Invalid data";
	exit;
}

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, 'http://192.168.131.240:8081/api/getopcard?opcard_id='.$hn);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_TIMEOUT, 3);

$result = curl_exec( $ch );
$items = $json->decode($result);

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<style>
	body{
		margin: 0;
	}
	body, input, button, select, option{
		font-family: "TH SarabunPSK";
		font-size: 18px;
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
		padding-top: 9em;
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
	<a href="opdcard_font.php?hn=<?=$hn;?>" target="right" style="color: blue;text-decoration: none;"><h3 style="margin:8px;">ข้อมูลการมาโรงพยาบาล</h3></a>
	<div style="width:100%; text-align:left;">
		<?php 
		$sql = "SELECT b.`clinic`  
		FROM (
		  SELECT `row_id` FROM `opcard` WHERE `hn` = '$hn'
		) AS a LEFT JOIN `digital_opcard` AS b ON a.`row_id` = b.`opcard_id` 
		WHERE b.`opcard_id` IS NOT NULL 
		AND ( b.`clinic` != '' AND b.`clinic` IS NOT NULL ) 
		GROUP BY `clinic`";
		$q = $dbi->query($sql);
		if ($q->num_rows == 0) {
			$q = $dbi->query("SELECT `detail` AS `clinic` FROM `clinic`");
		}
		?>
		<div style="margin-bottom:4px;">
			<b>แผนก:</b> <select name="depart" id="depart" style="max-width:120px;">
				<option value="">เลือกแผนก</option>
				<?php 
				while ($item = $q->fetch_assoc()) {
					?>
					<option value="<?=$item['clinic'];?>"><?=$item['clinic'];?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div style="margin-bottom:4px;">
			<?php 
			$y_start = date('Y');
			$y_end = date('Y', strtotime("-5 years"));
			$y_range = range($y_start, $y_end);

			?>
			<b>ปี:</b> <select name="year" id="year">
				<option value="">เลือกปี</option>
				<?php 
				foreach ($y_range as $key => $value) {
					// $dy = ($value==date('Y')) ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$value;?>" <?=$dy;?> ><?=($value+543);?></option>
					<?php
				}
				?>
				<option value="2023">2566</option>
			</select>
			<b>เดือน:</b> <select name="month" id="month" onchange="checkYear()">
				<option value="">เลือกเดือน</option>
				<?php 
				foreach ($def_fullm_th as $key => $value) {
					// $dm = ($key==date('m')) ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$key;?>" <?=$dm;?> ><?=$value;?></option>
					<?php
				}
				
				?>
				<option value="05">พ.ค.</option>
			</select>
		</div>
		<div style="margin-bottom:4px;">
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
    ?><p style="text-align:center;"><b>ยังไม่มีประวัติ e-OPD</b></p><?php
}
?>
</div>


<script type="text/javascript">

var monthThai = ['มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'];

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

		console.log(url);


		var request = new newXmlHttp();
		request.open('GET', url, true);

		request.onreadystatechange = function () {
		if (request.status >= 200 && request.status < 400) {
			// Success! 

			// var data = JSON.parse(request.responseText);
			alert(request.responseText)
			var data = JSON.parse(request.responseText);
			
			if(data.totalCount>0){
			
				var resHtml = '';
				for (var i = 0; i < data.totalCount; i++) {
					
					var el = data.list[i];

					var ac_date = el.actual_date.split(" ");
					var dateSplit = ac_date[0].split("-");

					var getYear = dateSplit[0];
					var getMonth = dateSplit[1];
					var getDay = dateSplit[2];

					var year = parseInt(getYear);
					var month = parseInt(getMonth)-1;
					var dateThai = getDay+' '+monthThai[month]+' '+(year+543);

					resHtml += '<div class="column thumbContain">';
					resHtml += '<a href="dt_paperLessFullPage.php?path='+el.original+'&hn='+el.hn+'" target="right">';
					resHtml += '<img src="'+el.thumbnail+'" alt="Lights" class="thumbImg" onerror="this.src=\'images/medical-history.png\';">';
					resHtml += '<p><b>'+dateThai+'</b></p>';
					resHtml += '</a>';
					resHtml += '</div>';

				}

				document.getElementById('thumbList').innerHTML = resHtml;

			}else{
				document.getElementById('thumbList').innerHTML = '<p><b>ไม่พบข้อมูล</b></p>';
			}

		} else {
			// We reached our target server, but it returned an error
		}
		};


		// request.onreadystatechange = function () {
		// 	if (this.readyState === 4) {
		// 	if (this.status >= 200 && this.status < 400) {
				
		// 	} else {
		// 		// Error :(
		// 	}
		// 	}
		// };
		request.send();

	}

	/*
	function searchData(){ 

		const depart = encodeURIComponent(document.getElementById('depart').value);
		const year = document.getElementById('year').value;
		const month = document.getElementById('month').value;
		const hn = '<?=$hn;?>';
		let url = 'http://192.168.131.240:8081/api/getopcard?opcard_id='+hn;
		let date = '';
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
				
				let resHtml = '';
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
	*/
</script>