<?php 

include 'bootstrap.php';

DB::load();
$default_date = ( date('Y') + 543 ).date('-m-d');
$date = input_post('date', $default_date);
$show = input_post('show');
?>
<form action="dt_stat_opd.php" method="post">
	<div>
		<label for="date">���͡�ѹ���</label>
		<input type="text" id="date" name="date" value="<?=$date;?>">
	</div>
	<div>
		<button type="submit">�ʴ���</button>
		<input type="hidden" name="show" value="1">
	</div>
</form>
<?php

if( $show !== false ){
	

	$sql = "SELECT a.`name`,a.`doctorcode`, COUNT(a.`name`) AS `rows`  
	FROM `doctor` AS a 
	LEFT JOIN `opd` AS b ON a.`name` = b.`doctor` 
	WHERE b.`thidate` LIKE '$date%'
	GROUP BY a.`doctorcode`";
	$items = DB::select($sql);
	$rows = DB::rows();
	dump($rows);
	if( $rows > 0 ){
	?>
	<h3></h3>
	<table>
		<thead>
			<tr>
				<th>#</th>
				<th>�������</th>
				<th>�ӹǹ�����·���Ǩ</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach( $items as $key => $item ){
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['name'];?></td>
				<td><?=$item['rows'];?></td>
			</tr>
			<?php
				$i++;
			}
			?>
		</tbody>
	</table>
	<?php
	}else{
		?><p>�������ª�����ͷ���Ǩ��ѹ�ѧ�����</p><?php
	}
}
?>