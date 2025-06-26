<?php 
require_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();

$hn = sprintf("%s", $_REQUEST['hn']);
if(empty($hn)){
	echo "Invalid data";
	exit;
}

$depart = sprintf("%s", $_POST['depart']);
$sub_clinic = sprintf("%s", $_POST['sub_clinic']);
$year = sprintf("%s", $_POST['year']);
$month = sprintf("%s", $_POST['month']);
$doctor = sprintf("%s", ($_POST['doctor'] ? $_POST['doctor'] : '' ));

$apiUrl = "http://192.168.131.240:8081/api/getopcard?opcard_id=$hn";

// if(!empty($depart)){
	$apiUrl .= "&clinic=$depart";
// }

if(!empty($year) && empty($month)){
	$apiUrl .= "&date=$year";
}

if(!empty($year) && !empty($month)){
	$apiUrl .= "&date=$year-$month";
}

// if(!empty($doctor)){
	$apiUrl .= "&doctor=$doctor";
// }

if(!empty($sub_clinic)){
	$apiUrl .= "&sub_clinic=$sub_clinic";
}
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

// สร้างรายการ ซับคลินิก กับ รายชื่อแพทย์
$sql = "SELECT c.`row_id` AS `subclinic_id`,c.`clinic_name` AS `subclinic_name`,d.`row_id` AS doctor_id, d.`name` AS `doctor_name` 
FROM (
	SELECT `row_id` FROM `opcard` WHERE `hn` = '$hn' 
) AS a LEFT JOIN `digital_opcard` AS b ON b.`opcard_id` = a.`row_id` 
LEFT JOIN ( 
	SELECT * FROM `sub_clinic` WHERE `status` = 'y'
) AS c ON c.`row_id` = b.`sub_clinic` 
LEFT JOIN ( 
	SELECT * FROM `doctor` WHERE status = 'y' 
) AS d ON d.`row_id` = b.`doctor` 
WHERE b.sub_clinic != '0' AND b.doctor <> ''
GROUP BY b.doctor, b.sub_clinic ";
$qSubclinic = $dbi->query($sql);
if($qSubclinic->num_rows>0){
	$subclinicItem = array();
	$doctorItem = array();
	while($a = $qSubclinic->fetch_assoc()){
		if(!empty($a['doctor_name'])){
			$doctorId = $a['doctor_id'];
			$doctorItem[$doctorId] = $a['doctor_name'];
		}
		if(!empty($a['subclinic_name'])){
			$subclinicKey = $a['subclinic_id'];
			$subclinicItem[$subclinicKey] = $a['subclinic_name'];
		}
	}
}

// $dataType = "API";
// $switchData = "DB";
// if($switchData==="API"){

// 	$ch = curl_init(); 
// 	curl_setopt($ch, CURLOPT_URL, $apiUrl);
// 	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
// 	curl_setopt($ch, CURLOPT_HEADER, 0);
// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// 	curl_setopt($ch, CURLOPT_TIMEOUT, 3);

// 	$result = curl_exec( $ch );
// 	$items = $json->decode($result);
	
// }elseif($switchData==="DB"){

	$actual_date = "";
	if(!empty($year) && empty($month)){ // เลือกปีอย่างเดียว
		$actual_date = " WHERE `actual_date` LIKE '$year%'";

	}elseif(!empty($year) && !empty($month)){
		$actual_date = " WHERE `actual_date` LIKE '$year-$month%'";

	}

	$whereDoctor = "";
	if(!empty($doctor)){
		$whereDoctor = " AND `doctor` = '$doctor'";
	}

	$whereSubclinic = "";
	if(!empty($sub_clinic)){
		$whereSubclinic = " AND `sub_clinic` = '$sub_clinic' ";
	}

	$sql = sprintf("SELECT `row_id` FROM `opcard` WHERE `hn` = '%s' LIMIT 1 ",$dbi->real_escape_string($hn));
	$q = $dbi->query($sql);
	if($q===false){
		echo "ไม่พบข้อมูล HN: $hn";
		exit;
	}else{
		$op = $q->fetch_assoc();
		$opcard_id = $op['row_id'];
	}
	
	
	$sqlDigitalOpcard = "SELECT * FROM 
	( `digital_opcard` WHERE `opcard_id` = '$opcard_id' 
	$actual_date 
	$whereDoctor 
	$whereSubclinic 
	ORDER BY FIELD(`upload_type`, 'summary','normal','other',''),`actual_date` DESC
	) AS a";
	dump($sqlDigitalOpcard);

	$qDitial = $dbi->query($sqlDigitalOpcard);
	$newItems = array();
	$digitalRows = $qDitial->num_rows;
	dump($digitalRows);
	if($digitalRows>0){
		$base_url = 'http://192.168.131.240:8081/storage/';
		while($a = $qDitial->fetch_assoc()){ 
			$a['original'] = $base_url.$a['file_name'];
			$a['thumbnail'] = $base_url.'thumbnail_'.$a['file_name'];
			$a['type'] = $a['upload_type'];
			$newItems[] = (object) $a; // ท่าสร้าง object to array
		}
	}
	$items = new stdClass();
	$items->totalCount = count($newItems);
	$items->list = $newItems;
// }
?>
<style>
	body{
		margin: 0;
	}
	p{
		margin:0;
		padding:0;
	}
	a{
		text-decoration: none;
		color: blue;
	}
	body, input, button, select, option{
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}
	.thumbImg{
		max-height: 130px;
		box-shadow: 1px 1px 1px #b8b8b8;
		width: 100px;
	}
	.thumbContain{
		position: relative;
		text-align: center;
		float: left;
		margin: 0 0 1em 1em;
		height: 153px;
	}
	.thumbContain:hover{
		box-shadow: 2px 2px 2px #b8b8b8;
	}
	.thumbContain:hover p{
		font-weight: bold;
	}
	.imgContainer{
		position: relative;
		height: 130px;
	}
	.file_summary{
		color: red;
		position: absolute;
		bottom: 0;
		width: 100%;
		left: 0;
	}
</style>
<script>
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
<div style="width: 100%;background-color: #ffffff;box-shadow: 0px 4px 4px #b8b8b8; text-align: center;">
	<a href="opdcard_font.php?hn=<?=$hn;?>" target="right" style="color: blue;text-decoration: none;"><h3 style="margin-bottom:4px;">ข้อมูลการมาโรงพยาบาล</h3></a>
	<form action="dt_paperLessListItem.php?hn=<?=$hn;?>" method="post">
	
	<div style="width:100%; text-align:left; padding-left: 4px;">
		<div style="margin-bottom:4px;" align="center">
			<b>คลินิก:</b> <select name="sub_clinic" id="sub_clinic" style="max-width:120px;">
				<option value="">-- ทั้งหมด --</option>
				<?php 
				foreach($subclinicItem AS $subclinic_id => $subclinic_name){ 
					$selected = $subclinic_id==$sub_clinic ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$subclinic_id;?>" <?=$selected;?> ><?=$subclinic_name;?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php 
		if(count($doctorItem)>0){ 
			// ถ้า login เป็นแพทย์ให้ default เป็นชื่อแพทย์คนนั้น
			if(empty($doctor) && $_SESSION['smenucode']=='ADMDR1'){
				
				$sqlDr = "SELECT b.`row_id` FROM (
				SELECT `codedoctor` FROM `inputm` WHERE `idname` = '".sprintf("%s", $_SESSION['sIdname'])."' 
				) AS a LEFT JOIN `doctor` AS b ON b.`doctorcode` = a.`codedoctor`";
				$qd = $dbi->query($sqlDr);
				if($qd->num_rows>0){
					$dr = $qd->fetch_assoc();
					$doctor = $dr['row_id'];
				}
			}
			?>
			<div style="margin-bottom:4px;" align="center">
				<label for="doctor"><b>แพทย์ : </b></label>
				<select name="doctor" id="doctor">
					<option value="">-- ทั้งหมด --</option>
					<?php 
					foreach($doctorItem AS $doctor_id => $doctor_name){ 
						$selected = $doctor_id==$doctor ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$doctor_id;?>" <?=$selected;?> ><?=$doctor_name;?></option>
					<?php 
					}
					?>
				</select>
			</div>
			<?php
		}
		?>
		<div style="margin-bottom:4px;" align="center">
			<?php 
			$y_start = date('Y');
			$y_end = date('Y', strtotime("-5 years"));
			$y_range = range($y_start, $y_end);

			// if(empty($year)){
			// 	$year = date('Y');
			// }
			
			?>
			<b>ปี:</b> <select name="year" id="year">
				<option value="">-- ทั้งหมด --</option>
				<?php 
				foreach ($y_range as $key => $value) {
					$dy = ($value==$year) ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$value;?>" <?=$dy;?> ><?=($value+543);?></option>
					<?php
				}
				?>
			</select>
			<b>เดือน:</b> <select name="month" id="month">
				<option value="">-- ทั้งหมด --</option>
				<?php 
				foreach ($def_fullm_th as $key => $value) {
					$dm = ($key==$month) ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$key;?>" <?=$dm;?> ><?=$value;?></option>
					<?php
				}
				
				?>
			</select>
		</div>
		<div style="margin-bottom:4px;padding-bottom:4px;" align="center">
			<button type="submit"> ค้นหาข้อมูล </button>
		</div>
	</div>
	</form>
</div>
<div class="row" id="thumbList">
<?php
if ($items->totalCount > 0) { 
    // $items_reverse = array_reverse($items->list);
	// $items_reverse = $items->list;
	
    foreach ($items->list as $key => $item) {
        list($dateEp, $timeEp) = explode(' ', $item->actual_date);
        list($y, $m, $d) = explode('-', $dateEp);
        ?>
        <div class="column thumbContain">
            <a href="dt_paperLessFullPage.php?path=<?=rawurlencode($item->original);?>&hn=<?=$hn;?>" target="right">
				<div class="imgContainer">
					<img src="<?=$item->thumbnail;?>" alt="Lights" class="thumbImg" loading="lazy" onerror="this.src='images/medical-history.png';">
					<?php 
					if ($item->type==='summary') {
						?><div><span class="file_summary"><b>สรุปประวัติ</b></span></div><?php
					}
					?>
				</div>
                <p><?=$d.' '.$def_fullm_th[$m].' '.($y+543);?></p>
            </a>
        </div>
        <?php
    }
	
}else{
    ?><p style="text-align:center;"><b>ยังไม่มีประวัติ e-OPD</b></p><?php
}
?>
</div>