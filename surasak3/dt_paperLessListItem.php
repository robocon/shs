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
$year = sprintf("%s", $_POST['year']);
$month = sprintf("%s", $_POST['month']);
$doctor = sprintf("%s", ($_POST['doctor'] ? $_POST['doctor'] : '' ));

$url = "http://192.168.131.240:8081/api/getopcard?opcard_id=$hn";

if(!empty($depart)){
	$url .= "&clinic=$depart";
}

if(!empty($year) && empty($month)){
	$url .= "&date=$year";
}

if(!empty($year) && !empty($month)){
	$url .= "&date=$year-$month";
}

if(!empty($doctor)){
	$url .= "&doctor=$doctor";
}

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
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
		max-height: 150px;
		max-width: 150px;
		box-shadow: 5px 5px 5px #b8b8b8;
	}
	.thumbImg:hover{
		cursor: pointer;
		box-shadow: 5px 5px 5px #666666;
	}
	#thumbList{
		padding-top: 12em;
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
	<form action="dt_paperLessListItem.php?hn=<?=$hn;?>" method="post">
	
	<div style="width:100%; text-align:left; padding-left: 4px;">
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
		<div style="margin-bottom:4px; margin-top:5px;" align="center">
			<b>คลินิก:</b> <select name="depart" id="depart" style="max-width:120px;">
				<option value="">-- ทั้งหมด --</option>
				<?php 
				while ($item = $q->fetch_assoc()) {
					?>
					<option value="<?=$item['clinic'];?>"><?=$item['clinic'];?></option>
					<?php
				}
				?>
			</select>
		</div>
		<?php 
		$sqlDoctor = "SELECT c.`row_id`,c.`name`  
		FROM (
			SELECT `row_id` FROM `opcard` WHERE `hn` = '$hn'
		) AS a LEFT JOIN `digital_opcard` AS b ON a.`row_id` = b.`opcard_id` 
		LEFT JOIN `doctor` AS c ON c.`row_id` = b.`doctor` 
		WHERE b.`opcard_id` IS NOT NULL 
		AND c.`name` IS NOT NULL 
		GROUP BY `name`";
		$qDoctor = $dbi->query($sqlDoctor);
		$doctorRows = $qDoctor->num_rows;
		if($doctorRows>0){
			?>
			<div style="margin-bottom:4px; margin-top:5px;" align="center">
				<label for="doctor"><b>แพทย์ : </b></label>
				<select name="doctor" id="doctor">
					<option value="">-- ทั้งหมด --</option>
					<?php 
					while ($d = $qDoctor->fetch_assoc()) { 
						$selected = $d['row_id']===$doctor ? 'selected="selected"' : '' ;
					?>
					<option value="<?=$d['row_id'];?>" <?=$selected;?> ><?=$d['name'];?></option>
					<?php 
					}
					?>
				</select>
			</div>
			<?php
		}
		?>
		<div style="margin-bottom:4px; margin-top:5px;" align="center">
			<?php 
			$y_start = date('Y');
			$y_end = date('Y', strtotime("-5 years"));
			$y_range = range($y_start, $y_end);

			if(empty($year)){
				$year = date('Y');
			}
			
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

			<?php 
			if(empty($month)){
				$month = date('m');
			}
			?>
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
		<div style="margin-bottom:4px; margin-top:10px;" align="center">
			<button type="submit"> ค้นหาข้อมูล </button>
		</div>
	</div>
	</form>
</div>
<div class="row" id="thumbList">
<?php
if ($items->totalCount > 0) { 
    // $items_reverse = array_reverse($items->list);
	$items_reverse = $items->list;
	
    foreach ($items_reverse as $key => $item) {
        list($dateEp, $timeEp) = explode(' ', $item->actual_date);
        list($y, $m, $d) = explode('-', $dateEp);
        ?>
        <div class="column thumbContain">
            <a href="dt_paperLessFullPage.php?path=<?=rawurlencode($item->original);?>&hn=<?=$hn;?>" target="right">
                <img src="<?=$item->thumbnail;?>" alt="Lights" class="thumbImg" loading="lazy" onerror="this.src='images/medical-history.png';">
				<?php 
				$summaryTxt = '';
				if ($item->type==='summary') {
					$summaryTxt = '<span style="color:red;">สรุปประวัติ</span><br>';
				}
				?>
                <p><b><?=$summaryTxt.$d.' '.$def_fullm_th[$m].' '.($y+543);?></b></p>
            </a>
        </div>
        <?php
    }
	
}else{
    ?><p style="text-align:center;"><b>ยังไม่มีประวัติ e-OPD</b></p><?php
}
?>
</div>