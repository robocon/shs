<?php

include 'bootstrap.php';

$default_bc = get_date_bc('Y-m');
$action = input('action');
$date_select = input_post('date_select', $default_bc);

include 'templates/classic/header.php';

?>
<div class="col no-print">
	<div class="cell">
		<a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลักโปรแกรมโรงพยาบาล</a>
	</div>
</div>
<div class="col no-print">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<h3>ค้นหารายรับแบ่งตามรายการและช่วงเวลาของนวดแผนไทย</h3>
			</div>
		</div>
		<form action="report_income_phy.php" method="post">
			<div class="col">
				<div class="cell">
					<label for="date_select">เลือกปี-เดือน</label>
					<input type="text" id="date_select" name="date_select" value="<?=$date_select;?>">
					<div style="font-size: 16px; color: red;">* ตัวอย่างการค้นหา 2558-11</div>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<button type="submit">แสดงผล</button>
					<input type="hidden" name="action" value="show_table">
				</div>
			</div>
		</form>
	</div>
</div>
<?php

if( $action === 'show_table' ){

	$time_detail = array('intime' => 'ในเวลาราชการ', 'outtime' => 'นอกเวลาราชการ');
	$price_detail = array('yprice' => 'เบิกได้', 'nprice' => 'เบิกไม่ได้');

	// $sql = "SELECT a.`row_id`,a.`date`,a.`hn`,a.`ptname`,a.`staf_massage`,a.`status`, 
	// SUBSTRING(a.`date`, 1, 10) AS `date3`, 
	// SUBSTRING(a.`date`, 12, 9) AS `time`, 
	// CONCAT(( DATE_FORMAT(a.`date`,'%Y') - 543 ), DATE_FORMAT(a.`date`, '-%m-%d') ) AS `date2`, 
	// DATE_FORMAT( CONCAT(( DATE_FORMAT(a.`date`,'%Y') - 543 ), DATE_FORMAT(a.`date`, '-%m-%d')) , '%w') AS `day_name`,
	// b.`code`,b.`yprice`,b.`nprice`
	// FROM `depart` AS a 
	// RIGHT JOIN `patdata` AS b ON b.`idno` = a.`row_id` 
	// WHERE a.`date` LIKE '$date_select%'  
	// AND a.`depart` = 'NID' ";

	// นวดแผนไทย
	$sql = "SELECT a.`row_id`,a.`date`,a.`hn`,a.`ptname`,a.`detail`,a.`staf_massage`,a.`time`,a.`date2`,a.`day_name`,a.`date3`,
	b.`row_id`,b.`date`,b.`code`,b.`idno`,b.`yprice`,b.`nprice`
	FROM (
		SELECT `row_id`,`date`,`hn`,`ptname`,`detail`,`staf_massage`,`status`, 
		SUBSTRING(`date`, 1, 10) AS `date3`, 
		SUBSTRING(`date`, 12, 9) AS `time`, 
		CONCAT(( DATE_FORMAT(`date`,'%Y') - 543 ), DATE_FORMAT(`date`, '-%m-%d') ) AS `date2`, 
		DATE_FORMAT( CONCAT(( DATE_FORMAT(`date`,'%Y') - 543 ), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name`
		FROM `depart` 
		WHERE `date` LIKE '$date_select%'  
		AND ( `staf_massage` != '' AND `staf_massage` IS NOT NULL ) 
	) AS a 
	RIGHT JOIN `patdata` AS b ON a.`row_id` = b.`idno` 
	WHERE a.`status` = 'Y'";
	
	$db = Mysql::load();
	$db->select($sql);
	$items = $db->get_items();

	function test_type($item){
		
		if( $item['time'] >= "08:00:00" && $item['time'] <= "16:00:00" ){

			$key = 'intime';
		}elseif( $item['time'] > "16:00:00" ){ // นอกเวลาราชการ

			$key = 'outtime';
		}

		$type[$key] = array(
			'yprice' => (int) $item['yprice'],
			'nprice' => (int) $item['nprice']
		);

		return $type;
	}



	$new_items = array();
	foreach ($items as $key => $item) {
		
		$item_code = $item['code'];
		$test_item = test_type($item);

		// 
		if( isset($test_item['intime']) ){
			$key = 'intime';
		}elseif( isset($test_item['outtime']) ){
			$key = 'outtime';
		}
		$new_items[$item_code][$key]['yprice'] += $test_item[$key]['yprice'];
		$new_items[$item_code][$key]['nprice'] += $test_item[$key]['nprice'];

	}
	?>
	<div class="col">
		<div class="cell">
			<h3>รายรับแบ่งตามรายการและช่วงเวลาของนวดแผนไทย</h3>
		</div>
	</div>
	<table>
		<thead>
			<tr>
				<th rowspan="2">รหัส - ชื่อรายการ</th>
				<th colspan="2">ในเวลา</th>
				<th colspan="2">นอกเวลา</th>
			</tr>
			<tr>
				<th>เบิกได้</th>
				<th>เบิกไม่ได้</th>
				<th>เบิกได้</th>
				<th>เบิกไม่ได้</th>
			</tr>
		</thead>
		<tbody>
		<?php

		$in_yprice = 0;
		$in_nprice = 0;

		$out_yprice = 0;
		$out_nprice = 0;

		foreach( $new_items as $key => $item ){
			$sql = "SELECT `detail`
			FROM `labcare` WHERE `code` = '$key'";
			$db->select($sql);
			$name = $db->get_item();
			
			?>
			<tr>
				<td><span title="<?=$key;?>"><?=$key;?> - <?=$name['detail'];?></span></td>
				<?php
				if( isset($item['intime']) ){
					$in_yprice += $item['intime']['yprice'];
					$in_nprice += $item['intime']['nprice'];
					?>
					<td align="right"><?=number_format($item['intime']['yprice'], 2);?></td>
					<td align="right"><?=number_format($item['intime']['nprice'], 2);?></td>
					<?php
				}else{
					?>
					<td align="right">0.00</td><td align="right">0.00</td>
					<?php
				}

				if( !isset($item['outtime']) ){
					?>
					<td align="right">0.00</td><td align="right">0.00</td>
					<?php
				}else{
					$out_yprice += $item['outtime']['yprice'];
					$out_nprice += $item['outtime']['nprice'];
					?>
					<td align="right"><?=number_format($item['outtime']['yprice'], 2);?></td>
					<td align="right"><?=number_format($item['outtime']['nprice'], 2);?></td>
					<?php
				}
				?>
			</tr>
			<?php
		}
		?>
			<tr>
				<td align="center">รวม</td>
				<td align="right"><?=number_format($in_yprice, 2);?></td>
				<td align="right"><?=number_format($in_nprice, 2);?></td>
				<td align="right"><?=number_format($out_yprice, 2);?></td>
				<td align="right"><?=number_format($out_nprice, 2);?></td>
			</tr>
		</tbody>
	</table>
	<?php
}

include 'templates/classic/footer.php';