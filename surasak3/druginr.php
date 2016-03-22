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
	<a href="../nindex.htm">��Ѻ�˹����ѡ����� SHS</a>
</div>
<div>
	<h3>��ª��ͼ����·�� INR > 6</h3>
</div>
<div class="no-print">
	<form action="druginr.php" method="post">
		<div>
			<div>
				<label for="date">���͡�ѹ���</label>
				<input type="text" id="date" name="date" value="<?=$date;?>">
				<div class="noti">* ���͡�繻� �.�.</div>
				<div class="noti">** ������͡�ʴ���Ẻ��駻� �ռŷ�����к���� þ. ���ŧ㹪�ǧ��������˹��</div>
			</div>
		</div>
		<div>
			<div>
				<button type="submit">�ʴ�������</button>
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
AND ( b.`result` != '¡��ԡ' AND b.`result` != '*' )
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
				<th>�ӴѺ</th>
				<th>�ѹ����Ǩ</th>
				<th>HN</th>
				<th>����</th>
				<th>��� INR</th>
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
		<div>����բ����ż����·�� INR > 6</div>
		<?php
	}
}
