<?php

include 'bootstrap.php';

DB::load();

$sql = "SELECT `regisdate`,`hn`,`yot`,`name`,`surname`,`lastupdate`
FROM `opcard` 
WHERE `lastupdate` >= '2547' AND `lastupdate` <= '2554'
ORDER BY `lastupdate` ASC";
$items = DB::select($sql);

?>
<h3>��ª��ͼ����·��������Թ 5 ��</h3>
<table width="100%">
	<thead>
		<tr>
			<th>#</th>
			<th>HN</th>
			<th>����ʡ��</th>
			<th>�շ��ŧ����¹</th>
			<th>�Ҥ�������ش</th>
		</tr>
	</thead>
	<tbody>
		
	<?php
	$i = 1;
	foreach( $items as $key => $item ){
		?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$item['hn'];?></td>
			<td><?=$item['yot'].' '.$item['name'].' '.$item['surname'];?></td>
			<td><?=ad_to_bc($item['regisdate']);?></td>
			<td><?=$item['lastupdate'];?></td>
		</tr>
		<?php
		$i++;
	}
	?>
	</tbody>
</table>

