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

// ੾�Ф����ع�ç�дѺ��� 5
if( $max === 5 ){
	
	$sql = "SELECT c.`thidate`,c.`hn`,c.`ptname`,c.`camp`
		FROM `condxofyear_so` AS c
		WHERE c.`yearcheck` LIKE  '$yearcheck' ";
	
	// ����ա�����͡˹���
	if( $category_id !== false && $category_id > 0 ){
		$sql .= " AND c.`camp` LIKE '%{$category['name']}%' ";
	}
		
	$sql .= "AND c.`hn` NOT IN (
		SELECT b.`hn` FROM `survey_oral` AS b
		WHERE b.`yearcheck` = '$sh_year' 
	";
	
	// ����ա�����͡˹���
	if( $category_id !== false && $category_id > 0 ){
		$sql .= " AND b.`section` = '$category_id' ";
	}
	
	$sql .= "GROUP BY b.`hn`
		)
		GROUP BY c.`hn`";
	$items = DB::select($sql);
} else {

	$where_category = '';
	if( $category_id > 0 ){
		$where_category = "AND `section` = '$category_id'";
	}
	$sql = "SELECT c.`thidate`,a.`hn`,a.`fullname` AS `ptname`,c.`camp` 
	FROM (
		SELECT * FROM `survey_oral`
		WHERE `date` LIKE '$date%' 
		AND `max_status` = '$max' 
		$where_category
	) AS a
	LEFT JOIN `condxofyear_so` AS c 
		ON c.`hn` = a.`hn` AND c.`yearcheck` LIKE  '$yearcheck'
	";
	
	if( $category_id !== false && $category_id > 0 ){
		$sql .= " AND a.`section` = '$category_id' ";
	}
	
	$sql .= "GROUP BY a.`hn`";
	
	// $items = DB::select($sql);
	$db->select($sql);
	$items = $db->get_items();
}
?>
<div class="col">
	<div class="cell">
		<h3 id="detail_header_print">��ª��͵���дѺ�����ع�ç</h3>
		
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>���ҵ�Ǩ OPD</th>
					<th>HN</th>
					<th>����</th>
					<th>˹��§ҹ��� OPD</th>
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