<?php
include 'bootstrap.php';
DB::load();

$test = microtime(true);

$year = date('Y');
$prev_7day = $year.date('-m-d', strtotime('-7 days'));
$sql = "SELECT a.`user`,a.`pass`,a.`ptname`,a.`date_service`,b.`rows` 
FROM `internet` AS a 
LEFT JOIN ( 
	SELECT `ptname`, `date_service`, COUNT(`ptname`) AS `rows`
	FROM `internet` 
	WHERE `date_service` != '' AND `date_service` > '$year'
	GROUP BY `ptname`
) AS b ON b.`date_service`=a.`date_service` 
WHERE a.`type_net` = '7day' 
AND a.`date_service` != '' 
AND a.`date_service` > '$prev_7day' 
AND b.`rows` <= 10 
ORDER BY a.`date_service` DESC;";
$items = DB::select($sql);
?>
<h1>�ʴ������ż�����Թ������</h1>
<p>����ª��ͼ���������ҹ��ͺ˹���ҷԵ��Ѻ�ҡ�ѹ�Ѩ�غѹ, �ӹǹ���駹Ѻ���ͺ�ջѨ�غѹ ��� �ʴ�������੾�м���������ҹ���¡���������ҡѺ 5������ҹ��</p>
<table width="100%">
	<tr>
		<th width="3%">#</th>
		<th>username</th>
		<th>password</th>
		<th>���ͼ��ŧ����¹</th>
		<th>�ѹ���ŧ����¹</th>
		<th>�ӹǹ����</th>
	</tr>
	<?php $i = 0; ?>
	<?php foreach($items as $key => $item): ?>
	<tr>
		<td><?=$i;?></td>
		<td><?=$item['user'];?></td>
		<td><?=$item['pass'];?></td>
		<td><?=$item['ptname'];?></td>
		<td><?=$item['date_service'];?></td>
		<td align="center"><?=$item['rows'];?></td>
	</tr>
	<?php $i++; ?>
	<?php endforeach; ?>
</table>
<p>����㹡�û����ż�: <?=( microtime(true) - $test );?></p>