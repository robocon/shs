<?php
include '../bootstrap.php';

$defVal = ( date('Y') + 543 ).date('-m');
$def_date = input('dateSearch', $defVal);
?>
<div>
	<h3>ค้นหาผู้ป่วยที่มี INR และได้รับยา Warfarin</h3>
</div>
<form action="search_hn.php" method="post">
	<div>
		วันที่: <input type="text" name="dateSearch" value="<?=$def_date;?>">
	</div>
	<div>
		<button type="submit">แสดงผล</button>
		<input type="hidden" name="action" value="showlist">
	</div>	
</form>
<?php

$action = input('action');
if( $action === 'showlist' ) {
	
	// include '../templates/classic/header.php';
	
	DB::load();
	
	$date = input_post('dateSearch');
	$sql = "SELECT c.*,b.`orderdate`,a.`autonumber`,a.`labcode`,a.`result`,CONCAT(e.`yot`,' ',e.`name`,' ',e.`surname`) AS `name` FROM (
		SELECT `date`,`drugcode`, `hn`, CONCAT((SUBSTRING(`date`, 1, 4) - 543), SUBSTRING(`date`, 5, 6)) AS `date2`
		FROM `drugrx`
		WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
		AND `date` LIKE '$date%' 
		AND `amount` > 0 
		GROUP BY `date2`, `hn` 
	) AS c 
	LEFT JOIN `resulthead` AS b 
		ON b.`hn` = c.`hn`
	LEFT JOIN `resultdetail` AS a
		ON a.`autonumber` = b.`autonumber`
	LEFT JOIN `opcard` AS e 
		ON e.`hn` = c.`hn`
	WHERE b.`orderdate` LIKE CONCAT(`date2`, '%') 
	AND b.`profilecode` = 'PT' 
	AND a.`labcode` = 'INR' 
	AND ( a.`result` < 1.5 OR a.`result` > 6 )";
	$items = DB::select($sql);
	?>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>HN</th>
				<th>ชื่อ</th>
				<th>วันที่ตรวจแลป</th>
				<th>ตรวจหา</th>
				<th>ผล</th>
				<th>วันที่จ่ายยา</th>
				<th>โค้ดยา</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach( $items as $key => $item ){
				
				$link = '?action=insert&hn='.$item['hn'].'&drugdate='.$item['date'].'&drugcode='.trim($item['drugcode']).'&autonumber='.$item['autonumber'].'&labcode='.$item['labcode'].'';
				
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['hn'];?></td>
				<td><?=$item['name'];?></td>
				<td><?=$item['orderdate'];?></td>
				<td><?=$item['labcode'];?></td>
				<td><?=$item['result'];?></td>
				<td><?=$item['date'];?></td>
				<td><?=$item['drugcode'];?></td>
				<td><a href="search_hn.php<?=$link;?>">เพิ่มข้อมูล</a></td>
			</tr>
			<?php
				$i++;
			}
			?>
		</tbody>
	</table>
	<?php
	// include '../templates/classic/footer.php';
	
}else if ( $action === 'insert' ) {
	# code...
	dump($_GET);
}