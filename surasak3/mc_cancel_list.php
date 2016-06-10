<?php

include 'bootstrap.php';

$action = input('action');

include 'templates/classic/header.php';

$def_date = get_date_bc('Y-m');
$date_select = input('date_select', $def_date);
?>
<div class="cell no-print">
	<div class="col">
		<a href="../nindex.htm">˹����ѡ�����</a>
	</div>
</div>
<div class="col no-print">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<h3>������ҧ ��ª��ͧ����ࡳ�����</h3>
			</div>
		</div>
		<form action="mc_cancel_list.php" method="post">
			<div class="col">
				<div class="cell">
					��-��͹ <input type="text" name="date_select" value="<?=$date_select;?>">
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<button type="submit">�ʴ���</button>
					<input type="hidden" name="action" value="show_list">
				</div>
			</div>
		</form>
	</div>
</div>
<?php


if( $action === false ){

	
}elseif( $action === 'show_list' ){

	$db = Mysql::load();

	$date_select = input_post('date_select');
	// dump($date_select);

	$sql = "SELECT a.`thidate`,a.`hn`,a.`ptname`,a.`diag`,b.`idcard`
	FROM `opday` AS a 
	LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
	WHERE a.`thidate` LIKE :date_select 
	AND a.`toborow` LIKE 'EX30%' ";
	$data = array(':date_select' => "$date_select%");
	$db->select($sql, $data);
	$items = $db->get_items();

	

	// dump($items);
	if( count($items) > 0 ){
		?>
		<div class="col">
			<div class="cell">
				<h3>��ª��ͼ���觴���ࡳ�����</h3>
			</div>
		</div>
		<table>
			<thead>
				<tr>
					<th>#</th>
					<th>�ѹ����� þ.</th>
					<th>HN</th>
					<th>����</th>
					<th>�Ţ�ѵû�ЪҪ�</th>
					<th>Diag</th>
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
					<td><?=$item['idcard'];?></td>
					<td><?=$item['diag'];?></td>
				</tr>
			<?php
				$i++;
			}
			?>
			</tbody>
		</table>
		<?php
	} // end if
	
}
include 'templates/classic/footer.php';
?>