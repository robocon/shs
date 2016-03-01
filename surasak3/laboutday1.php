<?php
include 'bootstrap.php';

$default = (date('Y') + 543).date('-m');
$date = input_post('date', $default);
$show = (int) input_post('show', 0);
?>
<style>
	body{
		font-family: 'TH SarabunPSK';
		font-size: 18px;
	}
	th, td{
		padding: 5px;
		font-size: 18px;
	}
	@media print{
		.no-print{
			display: none;
		}
	}
	
</style>
<div style="padding: 0.3em;" class="no-print">
	<div>
		<a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลักโปรแกรมโรงพยาบาล</a>
	</div>
</div>
<div>
	<div>
		<h3>รายงาน Outlab ประจำเดือน</h3>
	</div>
</div>
<form action="laboutday1.php" method="post" class="no-print">
	<div>
		<div>
			<input type="text" name="date" value="<?=$date;?>">
			<div style="color: red;">* กรณีต้องการดูเป็นรายวันสามารถใส่วันที่เพิ่มได้เช่น 2559-02-29</div>
		</div>
	</div>
	<div>
		<div>
			<button type="submit">แสดงข้อมูล</button>
			<input type="hidden" name="show" value="1">
		</div>
	</div>
</form>
<?php

if( $show > 0 ){
	DB::load();
	$start = microtime(true);
	$sql = "CREATE TEMPORARY TABLE `labcare_tmp`
	SELECT `code`,`detail`,`outlab_name` FROM `labcare`
	WHERE `depart` = 'PATHO'
	AND `part` = 'LAB'
	AND `labtype` = 'OUT'
	AND `labpart` = 'Outlab'";
	DB::select($sql);
	
	// $sql = "SELECT * FROM `labcare_tmp`";
	// $items = DB::select($sql);
	
	
	$sql = "CREATE TEMPORARY TABLE `patdata_tmp`
	SELECT `hn`,`date`,`code`,`detail` FROM `patdata`
	WHERE `date` LIKE '$date%'";
	DB::select($sql);
	
	// $sql = "SELECT * FROM `patdata_tmp`";
	// $items = DB::select($sql);
	
	$sql = "
	SELECT a.`hn`,a.`date`,b.`code`,b.`detail`,b.`outlab_name`
	FROM `patdata_tmp` AS a, `labcare_tmp` AS b
	WHERE a.`code` = b.`code`
	ORDER BY a.`code` ASC
	";
	
	?>
	
	<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
		<thead>
			<tr>
				<th>#</th>
				<th>วันที่</th>
				<th>HN</th>
				<th>รายละเอียด</th>
			</tr>
		</thead>
		<tbody>
	<?php
	$items = DB::select($sql);
	
	$end = microtime(true);
	$time = $end - $start;
	
	$i = 1;
	$codes = array();
	foreach ($items as $key => $item) {
		$detail = htmlspecialchars($item['detail'], ENT_QUOTES);
		?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['date'];?></td>
				<td><?=$item['hn'];?></td>
				<td><b><?=$item['code'];?></b> - <?=$detail;?></td>
			</tr>
		<?php
		$i++;
		
		$code_key = $item['code'];
		if( empty($codes[$code_key]) ){
			$codes[$code_key] = array('detail' => $detail, 'rows' => 1);
		}else{
			$codes[$code_key]['rows']++;
		}
	}
	?>
		</tbody>
	</table>
	<table>
		<thead>
			<tr>
				<th>Code</th>
				<th>ยอดรวมแต่ละ Code</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$total = 0;
			foreach ($codes as $key => $code) {
			?>
			<tr>
				<td><span title="<?=$code['detail'];?>"><?=$key;?></span></td>
				<td align="center"><?=$code['rows'];?></td>
			</tr>
			<?php
				$total += $code['rows'];
			}
			?>
			<tr>
				<td><b>สรุปยอดทั้งหมด</b></td>
				<td align="center"><?=$total;?></td>
			</tr>
		</tbody>
	</table>
	<p class="no-print">Process in <?=$time;?> Sec.</p>
	<?php
}