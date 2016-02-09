<?php

include 'bootstrap.php';

$items = array(
	array('hn' => '57-9424', 'date' => '2557-11-15'),
	array('hn' => '58-5347', 'date' => '2558-08-26'),
	array('hn' => '49-8038', 'date' => '2558-07-23'),
	array('hn' => '52-4304', 'date' => '2558-03-25'),
	array('hn' => '58-2651', 'date' => '2558-04-06'),
	array('hn' => '55-1293', 'date' => '2558-06-20'),
	array('hn' => '48-9140', 'date' => '2558-04-22'),
	array('hn' => '48-17403', 'date' => '2558-04-04'),
	array('hn' => '56-10059', 'date' => '2558-03-23'),
	array('hn' => '47-5983', 'date' => '2558-04-21'),
	array('hn' => '50-10086', 'date' => '2558-08-07'),
	array('hn' => '48-6612', 'date' => '2558-04-30'),
	array('hn' => '58-4784', 'date' => '2558-07-07'),
	array('hn' => '48-5536', 'date' => '2558-04-02'),
	array('hn' => '57-1159', 'date' => '2558-01-21'),
	array('hn' => '56-9039', 'date' => '2558-07-04'),
	array('hn' => '47-8055', 'date' => '2558-08-31'),
	array('hn' => '57-8590', 'date' => '2557-110-22'),
	array('hn' => '53-10940', 'date' => '2558-05-14'),
	array('hn' => '52-6157', 'date' => '2558-02-10'),
	array('hn' => '57-781', 'date' => '2558-09-19'),
	array('hn' => '56-10840', 'date' => '2558-02-03'),
	array('hn' => '50-8263', 'date' => '2558-07-05'),
	array('hn' => '57-8954', 'date' => '2558-07-05'),
	array('hn' => '53-10636', 'date' => '2558-08-24'),
	array('hn' => '48-13963', 'date' => '2558-08-07'),
	array('hn' => '47-2114', 'date' => '2558-01-28'),
	array('hn' => '55-4568', 'date' => '2557-12-11'),
	array('hn' => '56-9510', 'date' => '2558-07-05'),
	array('hn' => '48-23615', 'date' => '2558-02-12'),
	array('hn' => '57-5367', 'date' => '2558-06-09'),
	array('hn' => '48-22705', 'date' => '2558-03-18'),
	array('hn' => '51-2024', 'date' => '2558-03-09'),
	array('hn' => '54-8332', 'date' => '2558-05-11'),
	array('hn' => '52-5151', 'date' => '2557-10-01'),
	array('hn' => '47-22653', 'date' => '2557-11-26'),
	array('hn' => '49-14500', 'date' => '2558-01-14'),
	array('hn' => '47-8629', 'date' => '2558-03-29'),
	array('hn' => '47-19657', 'date' => '2557-12-04'),
	array('hn' => '47-12927', 'date' => '2558-05-06'),
	array('hn' => '57-10224', 'date' => '2558-01-28'),
	array('hn' => '58-5877', 'date' => '2558-07-08'),
	array('hn' => '53-5564', 'date' => '2557-10-19'),
	array('hn' => '47-1462', 'date' => '2558-03-16'),
	array('hn' => '52-3834', 'date' => '2558-04-28'),
	array('hn' => '58-6021', 'date' => '2558-08-13'),
	array('hn' => '57-8342', 'date' => '2557-10-10'),
	array('hn' => '58-3848', 'date' => '2558-05-06'),
	array('hn' => '56-6828', 'date' => '2557-11-17'),
	array('hn' => '58-3613', 'date' => '2558-06-23'),
);

DB::load();
?>
<table>
	<tr>
		<th>เลขบัตรประชาชน</th>
		<th>HN</th>
		<th>วันที่รับบริการ</th>
		<th>ชื่อยา</th>
		<th>เหตุผลการใช้ยา</th>
	</tr>
<?php
foreach( $items as $key => $item ){
	
	$sql = "SELECT DATE_FORMAT( `date`, '%Y-%m-%d' ) AS `date`,`hn`,`tradname`,`reason` 
	FROM `ddrugrx` 
	WHERE `hn` LIKE '".$item['hn']."' 
	AND `date` LIKE '".$item['date']."%'";
	$reasons = DB::select($sql);
	foreach( $reasons as $res_key => $res){
		if( !empty($res['reason']) ){
			
			$sql = "SELECT `idcard` FROM `opcard` WHERE `hn` = '".$item['hn']."'";
			$user = DB::select($sql, null, true);
			
			$res['date']
			?>
			<tr>
				<td><?=$user['idcard'];?></td>
				<td><?=$res['hn'];?></td>
				<td><?=$res['date'];?></td>
				<td><?=$res['tradname'];?></td>
				<td><?=$res['reason'];?></td>
			</tr>
			<?php
		}/*else{
			?>
			<tr>
				<td><?=$user['idcard'];?></td>
				<td><?=$res['hn'];?></td>
				<td><?=$res['date'];?></td>
				<td>-</td>
				<td>-</td>
			</tr>
			<?php
		}*/
	}
}
?>
</table>