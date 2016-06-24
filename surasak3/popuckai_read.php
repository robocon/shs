<?php

include 'bootstrap.php';

$db = Mysql::load();
$sql = "
SELECT b.`idcard`, b.`hn`, b.`yot`, b.`name`, b.`surname`, b.`ptright`, b.`ptright1` 
FROM `sso30` AS a 
INNER JOIN `opcard` AS b ON b.`idcard` = a.`idcard` 
WHERE b.`ptright1` LIKE 'R09%'
";
$db->select($sql);
$items = $db->get_items();

include 'templates/classic/header.php';
?>
<div class="col">
    <div class="cell">
		<a href="../nindex.htm">&lt;&lt; ˹����ѡ����� þ.</a>
    </div>
</div>
<div class="col">
    <div class="cell">
		<h3>��ª��ͼ������Է�� R09 (<?=count($items);?> ��)</h3>
		<table>
			<thead>
				<tr>
					<td>#</td>
					<td>HN</td>
					<td>����-ʡ��</td>
					<td>�Է����ѡ</td>
					<td>�Է�Է����</td>
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
					<td><?=$item['name'];?></td>
					<td><?=$item['ptright'];?></td>
					<td><?=$item['ptright1'];?></td>
				</tr>
			<?php
				$i++;
			}
			?>
			</tbody>
		</table>
    </div>
</div>
<?php
include 'templates/classic/footer.php';