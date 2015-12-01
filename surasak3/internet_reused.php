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
<h1>แสดงข้อมูลผู้ใช้อินเตอร์เน็ต</h1>
<p>เป็นรายชื่อผู้ที่เข้าใช้งานในรอบหนึ่งอาทิตย์นับจากวันปัจจุบัน, จำนวนครั้งนับเป็นรอบปีปัจจุบัน และ แสดงข้อมูลเฉพาะผู้ที่เข้าใช้งานน้อยกว่าหรือเท่ากับ 5ครั้งเท่านั้น</p>
<table width="100%">
	<tr>
		<th width="3%">#</th>
		<th>username</th>
		<th>password</th>
		<th>ชื่อผู้ลงทะเบียน</th>
		<th>วันที่ลงทะเบียน</th>
		<th>จำนวนครั้ง</th>
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
<p>เวลาในการประมวลผล: <?=( microtime(true) - $test );?></p>