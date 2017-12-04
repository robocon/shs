<?php
include 'bootstrap.php';

$defVal = ( date('Y') + 543 ).date('-m');
$def_date = input('dateSearch', $defVal);


$action = input('action');

?>
<div>
	<h3>ค้นหาผู้ป่วยที่มี INR และได้รับยา Warfarin</h3>
</div>
<form action="phar_inr_search.php" method="post">
	<div>
		วันที่: <input type="text" name="dateSearch" value="<?=$def_date;?>">
	</div>
	<div>
		<button type="submit">แสดงผล</button>
		<input type="hidden" name="action" value="showlist">
	</div>	
</form>
<?php

if( $action === 'showlist' ) {
	
	$db = Mysql::load();
	
	$date = input_post('dateSearch');
	$sql = "SELECT c.*,b.`orderdate`,a.`autonumber`,a.`labcode`,a.`result`,CONCAT(e.`yot`,' ',e.`name`,' ',e.`surname`) AS `name` FROM (
		SELECT `date`,`drugcode`, `hn`, CONCAT((SUBSTRING(`date`, 1, 4) - 543), SUBSTRING(`date`, 5, 6)) AS `date2`
		FROM `drugrx`
		WHERE `drugcode` IN('1COUM-C3','1COUM-C5','1COUM-C1','1COUM-C2') 
		AND `date` LIKE :date 
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
	
	$data = array(':date' => "$date%");
	$select = $db->select($sql, $data);
	
	if( $select !== true ){
		echo "ไม่แสดงข้อมูลได้ กรุณาแจ้งโค้ด ".$select['id']." ให้กับโปรแกรมเมอร์";
	}
	
	$items = $db->get_items();
	if( count($items) > 0 ){
	?>
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
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
				
				$link = '?action=insert&hn='.$item['hn'].'&drugdate='.$item['date'].'&drugcode='.trim($item['drugcode']).'&autonumber='.$item['autonumber'].'&labcode='.$item['labcode'].'&result='.$item['result'];
				
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
				<td><a href="phar_inr_search.php<?=$link;?>">Active</a></td>
			</tr>
			<?php
				$i++;
			}
			?>
		</tbody>
	</table>
	<?php
	}
	
}else if ( $action === 'insert' ) {
	
	$hn = input_get('hn');
	$drugdate = input_get('drugdate');
	$drugcode = input_get('drugcode');
	$autonumber = input_get('autonumber');
	$labcode = input_get('labcode');
	$result = input_get('result');
	
	$date_add = get_date_ad();
	
	$db = Mysql::load();
	
	$sql = "INSERT INTO  `smdb`.`phar_user` (
		`id` ,`date_add` ,`hn` ,`drugdate` ,`drugcode` ,`autonumber` ,`labcode` ,`result`)
	VALUES (
	NULL ,  :date_add,  :hn,  :drugdate,  :drugcode,  :autonumber,  :labcode,  :result
	);";
		
	$data = array(
		':date_add' => $date_add,
		':hn' => $hn,
		':drugdate' => $drugdate,
		':drugcode' => $drugcode,
		':autonumber' => $autonumber,
		':labcode' => $labcode,
		':result' => $result,
	);
	
	$insert = $db->insert($sql, $data);
	if( $insert !== true ){
		echo "ไม่สามารถบันทึกข้อมูลได้ กรุณาแจ้งโค้ด ".$insert['id']." ให้กับโปรแกรมเมอร์";
		exit;
	}
}