<?php 
include 'bootstrap.php';

$db = new mysqli(HOST,USER,PASS,DB);
$db->query("SET NAMES UTF8");

$default_date = ( date('Y') + 543 ).date('-m-d');
$date = input_post('date', $default_date);
$show = input_post('show');
?>
<style>
	@media print{
		#userForm{
			display: none;
		}
		table{
			width: 100%;
		}
	}
	*{
		font-family: "TH SarabunPSK";
		font-size: 18px;
	}
	table, th, td {
		border: 1px solid;
	}
	table {
		border-collapse: collapse;
	}
	th, td{
		padding: 3px;
	}
	ul{
		list-style-type: none;
		padding: 0;
	}
	.item-list li{
		display: flex;
		justify-content: space-between;
	}
</style>

<form action="dt_stat_opd.php" method="post" id="userForm">
	<div>
		<h3>ระบบรายงานยอดผู้มารับบริการแยกตามแพทย์และสิทธิ</h3>
	</div>
	<div>
		<label for="date">เลือกวันที่</label>
		<input type="text" id="date" name="date" value="<?=$date;?>">
	</div>
	<div>
		<button type="submit">แสดงผล</button>
		<input type="hidden" name="show" value="1">
	</div>
</form>
<?php

if( $show !== false ){
	
	list($y,$m,$d) = explode('-', $date);

	if(empty($d))
	{
		echo 'กรุณาใส่วันที่ให้ถูกต้อง<br>ตัวอย่างรูปแบบวันที่ ปี(พ.ศ.)-เดือน-วัน <br>เช่น 2565-07-01 เป็นต้น<br> <a href="dt_stat_opd.php">ย้อนกลับ</a>';
		exit;
	}

	$pre_items = array();
	$room_items = array();
	// query เอาชื่อหมอ
	$sql = "SELECT `doctor`,`room`,`hn` FROM `dt_logs` WHERE `thdatehn` LIKE '$d-$m-$y%' AND `doctor` NOT LIKE 'HD%' GROUP BY `doctor` ORDER BY `room` ASC";
	$q = $db->query($sql);
	while ($a = $q->fetch_assoc()) { 

		$dt_name = $a['doctor'];

		$room_items[$dt_name] = $a['room'];
		
		$sql_dt = "SELECT a.*, b.`ptname`,b.`goup`, b.`ptright` 
		FROM ( 
			SELECT `thdatehn`,`vn`,`hn` FROM `dt_logs` WHERE `doctor` = '$dt_name' AND `thdatehn` LIKE '$d-$m-$y%' 
		) AS a 
		LEFT JOIN `opday` AS b ON b.`thdatehn` = a.`thdatehn` ";
		$qdt = $db->query($sql_dt);
		while ($b = $qdt->fetch_assoc()) { 

			$find_hn = $b['hn'];

			$q_opcard = $db->query("SELECT `yot` FROM `opcard` WHERE `hn` = '$find_hn' LIMIT 1 ");
			$op = $q_opcard->fetch_assoc();
			$b['yot'] = trim($op['yot']);

			$pre_items[$dt_name][] = $b;
			
		}
		
	} // จบชื่อหมอ

	if(empty($pre_items)){
		?>
		<p><b>ไม่พบข้อมูลการออกตรวจ</b></p>
		<?php
		exit;
	}


	$count_dt = array();
	foreach ($pre_items as $dt_name => $items) { 

		$count_dt[$dt_name]['officer'] = 0; //นายทหารสัญญาบัตร
		$count_dt[$dt_name]['nco'] = 0; //นายทหารชั้นประทวน
		$count_dt[$dt_name]['pvt'] = 0; // พลฯ
		$count_dt[$dt_name]['family'] = 0; // ครอบครัวทหาร
		$count_dt[$dt_name]['r020304'] = 0;
		$count_dt[$dt_name]['r07'] = 0;
		$count_dt[$dt_name]['r0608'] = 0;
		$count_dt[$dt_name]['30bath'] = 0;

		$user_runno = 0;
		foreach ($items as $key => $item) {
			
			$yot = trim($item['yot']);
			$test_yot = false;
			if( $yot=='ร.ต.' || $yot=='ร.ท.' || $yot=='ร.อ.' || $yot=='พ.ต.' || $yot=='พ.ท.' || $yot=='พ.อ.' || $yot=='พลตรี' ){ 
				$count_dt[$dt_name]['officer']++;
				$test_yot = true;

			}elseif( $yot=='ส.ต.' || $yot=='ส.ท.' || $yot=='ส.อ.' || $yot=='จ.ส.ต.' || $yot=='จ.ส.ท.' || $yot=='จ.ส.อ.' || $yot=='พลอาสา' || $yot=='พลอาสาสมัคร' ){ 
				$count_dt[$dt_name]['nco']++;
				$test_yot = true;

			}elseif( $yot=='พลฯ' ){ 
				$count_dt[$dt_name]['pvt']++;
				$test_yot = true;
			}

			if($test_yot === true)
			{
				$user_runno++;
				continue;
			}
			
			$goup_code = trim(substr($item['goup'],0,3));
			$test_goup = false;
			if($goup_code=='G31'){
				$count_dt[$dt_name]['family']++;
				$test_goup = true;
				$user_runno++;
				continue;
			}

			$ptright_code = trim(substr($item['ptright'],0,3));
			$test_ptright = false;
			if($ptright_code=='R02' || $ptright_code=='R03' || $ptright_code=='R04'){
				$count_dt[$dt_name]['r020304']++;
				$test_ptright = true;

			}elseif ($ptright_code=='R07') {
				$count_dt[$dt_name]['r07']++;
				$test_ptright = true;

			}elseif ($ptright_code=='R06' || $ptright_code=='R08') {
				$count_dt[$dt_name]['r0608']++;
				$test_ptright = true;
			}

			if($test_ptright===true)
			{
				$user_runno++;
				continue;
			}

			if($test_yot===false && $test_goup===false && $test_ptright===false){
				$count_dt[$dt_name]['30bath']++;
			}
		}
	}

	$pts = array(
		'officer' => 'นายทหารสัญญาบัตร',
		'nco' => 'นายทหารประทวน',
		'pvt' => 'พลทหาร',
		'family' => 'ครอบครัวทหาร',
		'r020304' => 'สิทธิจ่ายตรง/ต้นฯ/รัฐฯ',
		'r07' => 'ประกันสังคม',
		'r0608' => 'พรบ./กท.44',
		'30bath' => 'พลเรือน/30บาท'
	);

	$ptright_sum = array(
		'officer' => 0,
		'nco' => 0,
		'pvt' => 0,
		'family' => 0,
		'r020304' => 0,
		'r07' => 0,
		'r0608' => 0,
		'30bath' => 0,
	);

	?>
	<div align="center"><h3>ยอดผู้มารับบริการแยกตามแพทย์และสิทธิ วันที่ <?=$d.' '.$def_fullm_th[$m].' '.$y;?></h3></div>
	<table>
		<tr>
			<th>ห้องตรวจ</th>
			<th>ชื่อแพทย์</th>
			<?php
			foreach ($pts as $key => $p) {
				?>
				<th><?=$p;?></th>
				<?php
			}
			?>
			<th>ยอดรวมตามแพทย์</th>
		</tr>
		<?php 
		foreach ($count_dt as $key => $values) { 

			$room_code = $room_items[$key];
			$qr = $db->query("SELECT `detail` FROM `queue_room` WHERE `code` = '$room_code' ");
			$room_name = '-';
			if($qr->num_rows > 0){
				$r = $qr->fetch_assoc();
				$room_name = $r['detail'];
			}
			
			?>
			<tr>
				<td><?=$room_name;?></td>
				<td><?=$key;?></td>
				<?php
				$sum = 0;
				foreach ($values as $key2 => $ptright) {
					?>
					<td align="right"><?=$ptright;?></td>
					<?php
					$sum += (int)$ptright;

					$ptright_sum[$key2] += (int)$ptright;
				}
				?>
				<td align="right"><b><?=$sum;?></b></td>

			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="2" align="center">ยอดรวมตามสิทธิ์</td>
			<?php
			$all = 0;
			foreach ($pts as $key => $p) {

				$sum_item = $ptright_sum[$key];
				$all += $sum_item;
				?>
				<td align="right"><b><?=$sum_item;?></b></td>
				<?php
			}
			?>
			<td align="right"><b><?=$all;?></b></td>
		</tr>
	</table>
	<?php

	exit;


	$q = $db->query("SELECT `code`,`name` FROM `ptright` ");
	$all_ptright = array();
	while ($a = $q->fetch_assoc()) {
		$code = $a['code'];
		$all_ptright[$code] = $a['code'].' '.$a['name'];
	}

	$sql = "SELECT a.*, b.`ptright`
	FROM ( 
		SELECT `row_id`,`thidate`,`thdatehn`,`vn`,`hn`,`ptname`,`doctor`,`toborow`,`clinic`,`room` 
		FROM `opd` 
		WHERE `thdatehn` LIKE '$d-$m-$y%' 
		AND `room` <> '' 
	) as a 
	LEFT JOIN `opday` AS b on b.`thdatehn` = a.`thdatehn` ";
	$q = $db->query($sql);
	
	$rooms = array();
	$ptright = array();
	$doctor_list = array();
	while ($a = $q->fetch_assoc()) {
		
		$r = $a['room'];
		$p = substr($a['ptright'],0,3);
		$doc = $a['doctor'];

		$rooms[$r][] = $a;
		$ptright[$r][$p][] = $a['row_id'];
		$doctor_list[$r][$doc][] = $a['row_id'];
	}
	?>
	
	<h3>รายงานจำนวนผู้มารับบริการแยกตามห้องตรวจและสิทธิการรักษา</h3>
	<table>
		<thead>
			<tr>
				<th>ชื่อห้องตรวจ</th>
				<th>จำนวนผู้มารับบริการ</th>
				<th>สิทธิการรักษา</th>
				<th>แพทย์</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$count_all_room = 0;
		foreach ($rooms as $key => $room) {
			$r = $key;
			$count_all_room += count($room);
			?>
			<tr valign="top">
				<td><?=$key;?></td>
				<td align="center"><?=count($room);?></td>
				<td>
					<ul class="item-list">
					<?php 
					foreach ($ptright[$r] as $ptKey => $pt) { 
						echo '<li>'.$all_ptright[$ptKey].' <span>'.count($pt).' ราย</span> </li>';
					}
					?>
					</ul>
				</td>
				<td>
					<ul class="item-list">
					<?php 
					foreach ($doctor_list[$r] as $dtKey => $dtName) { 
						echo '<li>'.$dtKey.' <span>'.count($dtName).' ราย</span> </li>';
					}
					?>
					</ul>
				</td>
			</tr>
			<?php
		}
		?>
		<tr>
			<td colspan="4">ยอดรวมทั้งสิ้น <?=$count_all_room;?> ราย</td>
		</tr>
	</tbody>
	</table>
	<?php
}
?>