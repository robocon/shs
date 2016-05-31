<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

$date = get_date_bc('Y-m');
$def_date = input_post('date', $date);
?>
<div class="col no-print">
	<div class="cell">
        <div>
            <a href="../nindex.htm">&lt;&lt เมนูหลักโรงพยาบาล</a> | <a href="report_drug_vaccine.php">รายชื่อเด็กที่ฉีดวัคซีน</a>
        </div>
		<div>
			<h3>รายชื่อเด็กที่นัดฉีดวัคซีน</h3>
		</div>
		<form action="report_vaccine_appoint.php" method="post">
			<div>
				<label for="date">เลือกเดือน</label>
				<input type="text" id="date" name="date" value="<?=$def_date;?>">
				<span>* รูปแบบ ปี-เดือน เช่น 2559-01</span>
			</div>
			<div>
				<button type="submit">แสดงรายการ</button>
				<input type="hidden" name="action" value="display">
			</div>
		</form>
	</div>
</div>
<?php

$action = input('action');
if ($action === 'display') {
	
	$db = Mysql::load();
	
	$date = input_post('date');
	list($year, $month) = explode('-', $date);
	
	$th_date_name = $def_fullm_th[$month];
	
	$sql = "SELECT `hn`,`ptname`,`age`,`appdate`,`apptime`,`detail2`,`other` 
	FROM `appoint` 
	WHERE `appdate` LIKE :date_select 
	AND `apptime` != 'ยกเลิกการนัด' 
	AND (
		`detail2` LIKE '%OPV%' OR `detail2` LIKE '%HBV%' OR `other` LIKE '%MMR%' OR `other` LIKE '%JEV%'
	)";
	
	$data = array(
		':date_select' => '%'.$th_date_name.' '.$year
	);
	
	$db->select($sql, $data);
	$items = $db->get_items();
	
	$date_reverse = array();
	foreach( $def_fullm_th as $key => $val ){
		$date_reverse[$val] = $key;
	}
	
	// แทรกคีย์เข้าไปหนึ่งตัวเป็น เวลาที่เอามาทำ strtotime
	$i = 0;
	foreach( $items as $key => $item ){
		list($d, $m_th, $y) = explode(' ', $item['appdate']);
		list($time, $nore) = explode(' ', $item['apptime']);
		
		$new_time_format = ( $y - 543 ).'-'.$date_reverse[$m_th].'-'.$d.' '.$time.':00';
		
		$items[$i]['time_key'] = strtotime($new_time_format);
		
		$i++;
	}
	
	// เรียงจากน้อยไปมากจาก value
	function sorttime($a, $b){
		return $a['time_key'] - $b['time_key'];
	}
	usort($items, "sorttime");
	
	?>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>วันที่นัด</th>
				<th>HN</th>
				<th>ชื่อ</th>
				<th>อายุ</th>
				<th>รายละเอียดการฉีดวัคซีน</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach( $items as $key => $item ){
				?>
				<tr>
					<td><?=$i;?></td>
					<td><?=$item['appdate'];?> เวลา <?=$item['apptime'];?></td>
					<td><?=$item['hn'];?></td>
					<td><?=$item['ptname'];?></td>
					<td><?=$item['age'];?></td>
					<td>
						<?php
						if( !empty($item['other']) ){
							echo $item['other'];
						}else{
							echo $item['detail2'];
						}
							
						?>
					</td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
	</table>
	<?php
	
	
	
}

include 'templates/classic/footer.php';