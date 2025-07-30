<?php 
require_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';

if(empty($_SESSION['sIdname'])){
	?>
	<p>Login หมดอายุ</p>
	<p>กรุณา <a href="../nindex.htm">Login</a> อีกครั้ง</p>
	<?php
	exit;
}

$hn = sprintf("%s", $_REQUEST['hn']);
if(empty($hn)){
	echo "Invalid data";
	exit;
}

$json = new Services_JSON();
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$depart = sprintf("%s", $_POST['depart']);
$sub_clinic = sprintf("%s", $_POST['sub_clinic']);
$year = sprintf("%s", $_POST['year']);
$month = sprintf("%s", $_POST['month']);
$doctor = sprintf("%s", $_POST['doctor']);

// เปลี่ยน HN ให้เป็น row_id ของ opcard
$sql = sprintf("SELECT `row_id` FROM `opcard` WHERE `hn` = '%s' LIMIT 1 ",$dbi->real_escape_string($hn));
$q = $dbi->query($sql);
if($q===false){
	echo "ไม่พบข้อมูล HN: $hn";
	exit;
}else{
	$op = $q->fetch_assoc();
	$opcard_id = $op['row_id'];
}

// สร้างรายการ ซับคลินิก
$subclinicItem = array();
$sql = "SELECT c.`row_id` AS `subclinic_id`,c.`clinic_name` AS `subclinic_name` 
FROM `digital_opcard` AS b 
LEFT JOIN ( 
	SELECT * FROM `sub_clinic` WHERE `status` = 'y' 
) AS c ON c.`row_id` = b.`sub_clinic` 
WHERE b.`opcard_id` = '$opcard_id' 
AND b.sub_clinic != '0' 
GROUP BY b.sub_clinic ";
$qSubclinic = $dbi->query($sql);
if($qSubclinic->num_rows>0){
	while($a = $qSubclinic->fetch_assoc()){
		$subclinicKey = $a['subclinic_id'];
		$subclinicItem[$subclinicKey] = $a['subclinic_name'];
	}
}



$whereDoctor = "";
if(!empty($doctor)){

	$sql = "SELECT a.*,b.`codedoctor`,b.`name`,b.`mdcode` FROM (
		SELECT `doctorcode` FROM `doctor` WHERE `row_id` = '$doctor' LIMIT 1
	) AS a LEFT JOIN `inputm` AS b ON b.`codedoctor` = a.`doctorcode` 
	WHERE b.`status` = 'y' LIMIT 1";
	$q = $dbi->query($sql);
	$a = $q->fetch_assoc();

	$whereDoctor = " WHERE b.`doctor` LIKE '%".$a['name']."%' 
	OR b.`doctor` LIKE '%".$a['codedoctor']."%' 
	OR b.`doctor` LIKE '%".$a['mdcode']."%'
	OR a.`doctor` = '$doctor'";

}
if($doctor==="0"){
	$whereDoctor = "WHERE a.`doctor` =  0";
}

################
### เลือกคลินิก เอาไปใช้กับ $sqlDigitalOpcard
###
$whereSubclinic = "";
if(!empty($sub_clinic)){
	$whereSubclinic = " AND `sub_clinic` = '$sub_clinic' ";
}


################
### เลือกวันที่ ใช้กับ $sqlDigitalOpcard
###
$actual_date = "";
if(!empty($year) && empty($month)){ // เลือกปีอย่างเดียว
	$actual_date = " AND `actual_date` LIKE '$year%'";

}elseif(!empty($year) && !empty($month)){
	$actual_date = " AND `actual_date` LIKE '$year-$month%'";

}

$sqlDigitalOpcard = "SELECT a.*,b.`doctor` FROM 
( 
	SELECT * FROM `digital_opcard` WHERE `opcard_id` = '$opcard_id' $actual_date $whereSubclinic ORDER BY FIELD(`upload_type`, 'summary','normal','other',''),`actual_date` DESC
) AS a 
LEFT JOIN `opday` AS b ON a.`opday_id` = b.`row_id` 
$whereDoctor";
$qDitial = $dbi->query($sqlDigitalOpcard);
$digitalRows = $qDitial->num_rows;

$newItems = array(); // รายการแสดงรูป
if($digitalRows>0){
	$base_url = 'http://192.168.131.240:8081/storage/';
	while($a = $qDitial->fetch_assoc()){
		$a['original'] = $base_url.$a['file_name'];
		$a['thumbnail'] = $base_url.'thumbnail_'.$a['file_name'];
		$a['type'] = $a['upload_type'];
		$newItems[] = (object) $a; // ท่าสร้าง object to array
	}
}

########
### แสดงรายชื่อของแพทย์โดยอิงจากใน opday 
### 
$doctorMd = array(); // รหัสแพทย์ที่เป็น MD
$doctorCode = array(); // รหัสแพทย์ที่เป็นเลข 5ตัว
$sqlDoctorInDigital = "SELECT a.*,b.`doctor` FROM 
( 
	SELECT * FROM `digital_opcard` WHERE `opcard_id` = '$opcard_id' 
	ORDER BY FIELD(`upload_type`, 'summary','normal','other',''),`actual_date` DESC
) AS a 
LEFT JOIN `opday` AS b ON a.`opday_id` = b.`row_id` ";
$qIndigital = $dbi->query($sqlDoctorInDigital);
while ($a = $qIndigital->fetch_assoc()) {
	// แยกเลข ว. แบบเลขเต็ม กับแบบที่ขึ้นต้นด้วย MD
	if(!empty($a['doctor'])){
		preg_match('/ว.(\d{3,5})/', $a['doctor'], $matchs2);
		
		if(preg_match('/^MD\d{3}/', $a['doctor'], $matchs)>0 && !in_array($matchs['0'], $doctorMd)){
			$doctorMd[] = $matchs['0'];

		}else if(count($matchs2)>0 && !in_array($matchs2['1'], $doctorCode)){
			$doctorCode[] = $matchs2['1'];

		}
	}
}

// เอาไปหาใน doctor
$doctorItemId = array();
if(count($doctorMd)>0){
	$whereMd = implode('|', $doctorMd);
	$sql = "SELECT `row_id` FROM `doctor` WHERE `name` REGEXP '$whereMd' ";
	$q = $dbi->query($sql);
	while ($a = $q->fetch_assoc()) {
		if( !in_array($a['row_id'], $doctorItemId)){
			$doctorItemId[] = $a['row_id'];
		}else{
			continue;
		}
	}
}

if(count($doctorCode)>0){
	$whereCode = implode('|', $doctorCode);
	$sql = "SELECT `row_id` FROM `doctor` WHERE `doctorcode` REGEXP '$whereCode' ";
	$q = $dbi->query($sql);
	while ($a = $q->fetch_assoc()) {
		if( !in_array($a['row_id'], $doctorItemId)){
			$doctorItemId[] = $a['row_id'];
		}else{
			continue;
		}
	}
}
// เอาไปหาใน doctor

sort($doctorItemId); // sort with asc

$items = new stdClass();
$items->totalCount = count($newItems);
$items->list = $newItems;

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
		/* float: left; */
		margin: 0 0 1em 1em;
		height: 153px;
	}
	.thumbContain:hover{
		/* box-shadow: 2px 2px 2px #b8b8b8; */
		background-color: #dddddd;
	}
	.thumbContain:hover p{
		/* font-weight: bold; */
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
<script>// สคริปห้ามคลิกขวา
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
		if(count($doctorItemId)>0){ 
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

			$whereDrId = implode(',', $doctorItemId);
			$sql = "SELECT `row_id`,`name` FROM `doctor` WHERE `row_id` IN ($whereDrId)";
			$q = $dbi->query($sql);
			$doctorItem = array();
			while ($a = $q->fetch_assoc()) {
				$id = $a['row_id'];
				$doctorItem[$id] = $a['name'];
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
					<option value="0">-- อื่นๆ --</option>
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