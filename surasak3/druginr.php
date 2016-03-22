<?php

include 'bootstrap.php';

$def_date = date('Y-m');
$date = input_post('date', $def_date);
$action = input_post('action');
?>
<style type="text/css">
	table th,
	table td{
		padding: 5px;
	}
	table th{
		background-color: #dddddd;
	}
	.noti{
		font-size: 12px;
		color: orange;
	}
	@media print{
		.no-print{
			display: none;
		}
	}
	
</style>
<div class="no-print">
	<a href="../nindex.htm">กลับไปหน้าหลักโปรแกรม SHS</a>
</div>
<div>
	<h3>รายชื่อผู้ป่วยที่ INR > 6</h3>
</div>
<div class="no-print">
	<form action="druginr.php" method="post">
		<div>
			<div>
				<label for="date">เลือกวันที่</label>
				<input type="text" id="date" name="date" value="<?=$date;?>">
				<div class="noti">* เลือกเป็นปี ค.ศ.</div>
				<div class="noti">** การเลือกแสดงผลแบบทั้งปี มีผลทำให้ระบบทั้ง รพ. ช้าลงในช่วงระยะเวลาหนึ่ง</div>
			</div>
		</div>
		<div>
			<div>
				<button type="submit">แสดงข้อมูล</button>
				<input type="hidden" name="action" value="show">
			</div>
		</div>
	</form>
</div>
<?php

if( $action !== false && $action === 'show' ){
	DB::load();
	
	$sql = "
	SELECT a.`orderdate`,a.`hn`,a.`patientname`,b.`result` FROM `resulthead` AS a ,
`resultdetail` AS b 
WHERE b.`autonumber` = a.`autonumber` 
AND a.`orderdate` LIKE :date_select 
AND a.`profilecode` LIKE 'PT'
AND b.`labname` = 'INR' 
AND ( b.`result` != 'ยกเลิก' AND b.`result` != '*' )
AND b.`result` > 6 ;
	";
	$data = array(
		':date_select' => "$date%"
	);
	
	$items = DB::select($sql, $data);
	
	if( count($items) > 0 ){
	?>
	<table>
		<thead>
			<tr>
				<th>ลำดับ</th>
				<th>วันที่ตรวจ</th>
				<th>HN</th>
				<th>ชื่อ</th>
				<th>ค่า INR</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php foreach( $items AS $key => $item ){ ?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['orderdate'];?></td>
				<td><?=$item['hn'];?></td>
				<td><?=$item['patientname'];?></td>
				<td><?=$item['result'];?></td>
			</tr>
			<?php $i++; ?>
			<?php } ?>
		</tbody>
	</table>
	<?php
	}else{
		?>
		<div>ไม่มีข้อมูลผู้ป่วยที่ INR > 6</div>
		<?php
	}
}
