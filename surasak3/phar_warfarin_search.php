<?php
include 'bootstrap.php';

$action = input('action');
	
if( $action === false OR $action === 'showlist' ) {
	
	include 'templates/classic/header.php';
	include 'templates/warfarin/nav.php';
	
	$db = Mysql::load();
	$defVal = ( date('Y') + 543 ).date('-m');
	$def_date = input('dateSearch', $defVal);
	?>
	<div class="col">
		<div class="cell">
			<div>
				<h3>���Ҽ����·���� INR ������Ѻ�� Warfarin</h3>
			</div>
			<form action="phar_warfarin_search.php" method="post">
				<div class="col">
					<div class="cell">
						�ѹ���: <input type="text" name="dateSearch" value="<?=$def_date;?>">
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">�ʴ���</button>
						<input type="hidden" name="action" value="showlist">
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	
	if( $action === 'showlist' ){
	
	
		// @doto 
		// ź Session ������������������
	
	
	
	
		$date = input_post('dateSearch');
		$sql = "SELECT c.*,b.`orderdate`,a.`autonumber`,a.`labcode`,a.`result`,CONCAT(e.`yot`,' ',e.`name`,' ',e.`surname`) AS `name`, 
		f.`id`
		FROM (
			SELECT `row_id` AS `drugid`,`date`,`drugcode`, `hn`, CONCAT((SUBSTRING(`date`, 1, 4) - 543), SUBSTRING(`date`, 5, 6)) AS `date2`
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
		LEFT JOIN `phar_user` AS f 
			ON f.`drugid` = c.`drugid`
		WHERE b.`orderdate` LIKE CONCAT(`date2`, '%') 
		AND b.`profilecode` = 'PT' 
		AND a.`labcode` = 'INR' 
		AND ( a.`result` < 1.5 OR a.`result` > 6 )";
		
		$data = array(':date' => "$date%");
		$select = $db->select($sql, $data);
		
		if( $select !== true ){
			echo "����ʴ��������� ��س����� ".$select['id']." ���Ѻ����������";
		}
		
		$items = $db->get_items();
		if( count($items) > 0 ){
		?>
		
		<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
			<thead>
				<tr>
					<th>#</th>
					<th>HN</th>
					<th>����</th>
					<th>�ѹ����Ǩ�Ż</th>
					<th>��Ǩ��</th>
					<th>��</th>
					<th>�ѹ��������</th>
					<th>����</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				foreach( $items as $key => $item ){
					
					$link = '?action=insert&hn='.$item['hn'].'&drugid='.$item['drugid'].'&drugdate='.$item['date'].'&drugcode='.trim($item['drugcode']).'&orderdate='.$item['orderdate'].'&autonumber='.$item['autonumber'].'&labcode='.$item['labcode'].'&result='.$item['result'];
					
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
					<td><a href="phar_warfarin_search.php<?=$link;?>">����������</a></td>
				</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
		<?php
		}
	
	}
	include 'templates/classic/footer.php';
	
} else if ( $action === 'insert' ) {
	
	$db = Mysql::load();
	
	$hn = input_get('hn');
	$drugid = input_get('drugid');
	$drugdate = input_get('drugdate');
	$drugcode = input_get('drugcode');
	$orderdate = input_get('orderdate');
	$autonumber = input_get('autonumber');
	$labcode = input_get('labcode');
	$result = input_get('result');
	$date_add = get_date_ad();
	
	// @todo
	// !!!! ��觷��зӵ��� !!!!
	// ���Ըա�èͧ����������͹ ��ҡ�͡����������п�����������º�������� �������Ѿഷ��ҷ���ѧ
	$sql = "SELECT `id` 
	FROM `phar_user` 
	WHERE `drugid` = :drugid 
	AND `autonumber` = :autonumber ";
	$data = array(
		':drugid' => $drugid,
		':autonumber' => $autonumber
	);
	$db->select($sql, $data);
	$item = $db->get_item();
	if( $item === NULL ){
		
		$sql = "INSERT INTO  `smdb`.`phar_user` (
			`id`,`date_add`,`hn`,`drugid`,`drugdate`,`drugcode`,`orderdate`,`autonumber`,`labcode`,`result`)
		VALUES (
		NULL ,  :date_add,  :hn,  :drugid, :drugdate,  :drugcode,  :orderdate, :autonumber,  :labcode,  :result
		);";
			
		$data = array(
			':date_add' => $date_add,
			':hn' => $hn,
			':drugid' => $drugid,
			':drugdate' => $drugdate,
			':drugcode' => $drugcode,
			':orderdate' => $orderdate,
			':autonumber' => $autonumber,
			':labcode' => $labcode,
			':result' => $result,
		);
		
		$insert = $db->insert($sql, $data);
		if( $insert !== true ){
			echo "�������ö�ѹ�֡�������� ��س����� ".$insert['id']." ���Ѻ����������";
			exit;
		}
		
		$lastId = $db->get_last_id();
	}else{
		$lastId = $item['id'];
	}
	redirect('phar_warfarin.php?page=intervention&id='.$lastId);
}
