<?php
$start_current_year = (date('Y')+543).'-01-01';
$end_current_year = (date('Y')+543).'-12-31';
$sql = "
SELECT `date`, `max_status`, COUNT(`id`) AS `rows`
FROM `survey_oral` 
WHERE `date` >= :date_start AND `date` <= :date_end 
GROUP BY `date` ,`max_status`
ORDER BY `date` DESC
";
$items = DB::select($sql, array(':date_start' => $start_current_year, ':date_end' => $end_current_year));

$new_item_lists = array();
$total_item_list = array();

foreach ($items as $key => $item) {
	$set_key = $item['date']; // ตั้งคีย์เพื่อแยกตามวัน
	$total_item_list[$set_key] += $item['rows']; // จำนวนรวมในแต่ละวัน
	
	$set_max_status = $item['max_status'];
	$new_item_lists[$set_key][$set_max_status] = $item['rows'];
	
}

?>
<div class="col">
	<div class="cell">
		<h3>ผลการสำรวจสภาวะสุขภาพช่องปากกำลังพล ทบ.</h3>
		<table class="custom-table outline-header border box-header outline">
			<thead>
				<tr>
					<th rowspan="2">วันที่</th>
					<th rowspan="2">จำนวนผู้ได้รับการตรวจสุขภาพช่องปาก (ราย)</th>
					<th colspan="5" class="align-center">ระดับสภาวะสุขภาพช่องปาก(ราย)</th>
				</tr>
				<tr>
					<th class="align-center" width="8%">1</th>
					<th class="align-center" width="8%">2</th>
					<th class="align-center" width="8%">3</th>
					<th class="align-center" width="8%">4</th>
					<th class="align-center" width="8%">5</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					foreach($new_item_lists as $key => $items){
						
						list($y, $m, $d) = explode('-', $key);
						$th_month = $full_months[$m];
						$date = $d.' '.$th_month.' '.$y;
						
						$total = $total_item_list[$key];
				?>
				<tr>
					<td><?php echo $date;?></td>
					<td><?php echo $total;?></td>
				<?php
					$test_set = 1;
					// 5 คือระดับตั้งแต่ 1 ถึง 5
					for($test_set; $test_set <= 5; $test_set++){
						
						$rows = ' - ';
						if($items[$test_set]){
							$rows = $items[$test_set];
						}
						
						?><td class="align-right"><?php echo $rows;?></td><?php
					} // End for
				?>
				</tr>
				<?php
					}
				?>
			</tbody>
		</table>
	</div>
</div>