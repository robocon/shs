<?php
// dump($_GET);

$date = isset($_GET['date']) ? trim($_GET['date']) : false ;
$category_id = isset($_GET['category']) ? intval($_GET['category']) : false ;
$max = isset($_GET['max']) ? intval($_GET['max']) : false ;
$yearcheck = isset($_GET['yearcheck']) ? intval($_GET['yearcheck']) : false ;
$sh_year = isset($_GET['shyear']) ? intval($_GET['shyear']) : false ;

if( $category_id !== false ){
	$sql = "SELECT `id`,`name` FROM `survey_oral_category` WHERE `id` = :id ;";
	$category = DB::select($sql, array(':id' => $category_id), true);
}

// เฉพาะความรุนแรงระดับที่ 5
if( $max === 5 ){
	
	$sql = "SELECT c.`thidate`,c.`hn`,c.`ptname`,c.`camp`
		FROM `condxofyear_so` AS c
		WHERE c.`yearcheck` LIKE  '$yearcheck' ";
	
	// ถ้ามีการเลือกหน่วย
	if( $category_id !== false && $category_id > 0 ){
		$sql .= " AND c.`camp` LIKE '%{$category['name']}%' ";
	}
		
	$sql .= "AND c.`hn` NOT IN (
		SELECT b.`hn` FROM `survey_oral` AS b
		WHERE b.`yearcheck` = '$sh_year' 
	";
	
	// ถ้ามีการเลือกหน่วย
	if( $category_id !== false && $category_id > 0 ){
		$sql .= " AND b.`section` = '$category_id' ";
	}
	
	$sql .= "GROUP BY b.`hn`
		)
		GROUP BY c.`hn`";
	$items = DB::select($sql);
} else {
	$sql = "SELECT c.`thidate`,c.`hn`,c.`ptname`,c.`camp` 
	FROM `survey_oral` AS a
	LEFT JOIN `condxofyear_so` AS c ON c.`hn` = a.`hn` AND c.`yearcheck` LIKE  '$yearcheck'
	WHERE a.`date` LIKE '$date%' 
	AND a.`max_status` = '$max' ";
	
	if( $category_id !== false && $category_id > 0 ){
		$sql .= " AND a.`section` = '$category_id' ";
	}
	
	$sql .= "GROUP BY a.`hn`";
	$items = DB::select($sql);
	// dump($sql);
}
?>
<div class="col">
	<div class="cell">
		<h3 id="detail_header_print">รายชื่อตามระดับความรุนแรง</h3>
		
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>เวลาตรวจ OPD</th>
					<th>HN</th>
					<th>ชื่อ</th>
					<th>หน่วยงานตาม OPD</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1; 
				foreach( $items as $key => $item ){
				?>
				<tr>
					<td><?=$i;?></td>
					<td><?=$item['thidate'];?></td>
					<td><?=$item['hn'];?></td>
					<td><?=$item['ptname'];?></td>
					<td><?=$item['camp'];?></td>
				</tr>
				<?php 
				$i++; 
				}
				?>
			</tbody>
		</table>
	</div>
</div>