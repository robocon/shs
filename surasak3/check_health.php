<?php

session_start();
include("connect.inc");

$sql = "SELECT `hn`,`vn`,`ptname`,`temperature`,`pause`,`rate`,`weight`,`height`,`bp1`,`bp2`,`organ`,`thidate`,`toborow` 
FROM `opd` 
WHERE (`thidate` LIKE '2558-03%' OR `thidate` LIKE '2558-04%') 
AND ( 
	`organ` LIKE '%ตรวจสุขภาพประจำปี58ลูกจ้างรพ.ค่าย%' 
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้างประจำปีรพ.ค่ายปี 58%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างชั่วคราว รพ.ค่าย%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้าง%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างรพ.ค่ายฯ%' 
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างรพ.ค่าย%' 
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้างรพ.ค่ายฯ%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้าง ร.พ. ค่าย%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้าง ร.พ.ค่ายฯ%'
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้างชั่วคราว รพ.ค่าย ปี58%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้างร.พ. ค่าย%'
	OR `organ` LIKE '%ตรวจสุขภาพลูกจ้าง%'
	OR `organ` LIKE '%ตรวจสุขภาพประจำปีลูกจ้าง ร.พ. ค่ายฯ%'
	OR `organ` LIKE '1.ตรวจสุขภาพประจำปี%'
	OR `organ` = 'ตรวจสุขภาพประจำปี'
	OR `organ` = ' ตรวจสุขภาพประจำปี'
	
	OR `organ` LIKE '%ลูกจ้าง%'
	) 
GROUP BY `hn` 
ORDER BY `row_id` DESC ";
$res = mysql_query($sql);
?>
<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=TIS-620" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
	</head>
<body>
	<style type="text/css">
	a{
		text-decoration: none;
	}
	a:hover{
		text-decoration: underline;
	}
	.back-link a{
		padding: 10px 0px;
		display: inline-block;
	}
	table, table tr, table tr td{
		margin: 0;
		padding: 0;
	}
	.table-less{
		width: 100%;
	}
	.table-title{
		background-color: #dddddd;
		text-align: center;
		font-weight: bold;
		height: 40px;
	}
	.table-details{
		height: 40px;
		background-color: #efefef;
	}
	.table-details td{
		padding: 10px 0;
	}
	</style>
	<div class="back-link">
		<a href="../nindex.htm">กลับไปยังหน้าหลัก</a>
	</div>
	<div class="header-title">
		<h1>ตรวจสุขภาพลูกจ้าง ประจำปี 2558 เดือน มีนาคม - เมษายน</h1>
	</div>
	<table class="table-less">
		<tr class="table-title">
			<td>ลำดับที่</td>
			<td>วันที่</td>
			<td width="3%">HN</td>
			<td>VN</td>
			<td>ชื่อ-สกุล</td>
			<td>อุณหภูมิ</td>
			<td>Pause</td>
			<td>Rate</td>
			<td>น้ำหนัก</td>
			<td>ความสูง</td>
			<td>BP1</td>
			<td>BP2</td>
			<td width="10%">Organ</td>
			<td>Toborow</td>
		</tr>
	<?php
	$i = 1;
	while($item = mysql_fetch_assoc($res)){
		list($date, $time) = explode(' ', $item['thidate']);
		?>
		<tr class="table-details">
			<td><?php echo $i;?></td>
			<td><?php echo $date;?></td>
			<td><?php echo $item['hn'];?></td>
			<td><?php echo $item['vn'];?></td>
			<td><?php echo $item['ptname'];?></td>
			<td><?php echo $item['temperature'];?></td>
			<td><?php echo $item['pause'];?></td>
			<td><?php echo $item['rate'];?></td>
			<td><?php echo $item['weight'];?></td>
			<td><?php echo $item['height'];?></td>
			<td><?php echo $item['bp1'];?></td>
			<td><?php echo $item['bp2'];?></td>
			<td><?php echo $item['organ'];?></td>
			<td><?php echo $item['toborow'];?></td>
		</tr>
		<?php
		$i++;
	}
	?>
	</table>
</body>
</html>