<?php

include 'bootstrap.php';

$def_date = date('Y-m');
$date = input_post('date', $def_date);
$action = input_post('action');
$task = input_get('task');

// �ʴ������� Popup
if( $task == 'detail' ){
	/**
	 * �ʴ���������´ UA ��� CBC �������¤�����Ǩ � �ѹ������͡����ʴ��� inr
	 */
	DB::load();
	$labnumber = input_get('labnumber');
	$hn = input_get('hn');
	
	?>
	<table width="100%">
	<?php
	$sql = "SELECT a.`labname`,a.`result`,a.`unit` FROM `resultdetail` AS a,
	`resulthead` AS b 
	WHERE b.`autonumber` = a.`autonumber` 
	AND b.`labnumber` = :labnumber 
	AND b.`hn` = :hn 
	AND b.`profilecode` = 'UA'
	";
	$items = DB::select($sql, array(':labnumber' => $labnumber, ':hn' => $hn));
	$ua_rows = count($items);
	if( $ua_rows > 0 ){
	?>
		<tr>
			<td>
				<h3>UA</h3>
				<table>
					<?php
					foreach( $items as $key => $item ){
						?>
						<tr>
							<td><b><?=$item['labname'];?></b></td>
							<td><?=$item['result'].' '.$item['unit'];?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</td>
		</tr>
	<?php
	}else{
		?><p>��辺��� UA</p><?php
	}

	$sql = "SELECT a.`labname`,a.`result`,a.`unit` FROM `resultdetail` AS a,
	`resulthead` AS b 
	WHERE b.`autonumber` = a.`autonumber` 
	AND b.`labnumber` = :labnumber 
	AND b.`hn` = :hn 
	AND b.`profilecode` = 'CBC'
	";
	$items = DB::select($sql, array(':labnumber' => $labnumber, ':hn' => $hn));
	$cbc_rows = count($items);
	if( $cbc_rows > 0 ){
		?>
		<tr>
			<td>
				<h3>CBC</h3>
				<table>
					<?php
					foreach( $items as $key => $item ){
						?>
						<tr>
							<td><b><?=$item['labname'];?></b></td>
							<td><?=$item['result'].' '.$item['unit'];?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</td>
		</tr>
		<?php
	}else{
		?><p>��辺��� CBC</p><?php
	}
	?>
	</table>
	<?php
	exit;
}else if( $task === 'alldrug' ){
	/**
	 * �ʴ���������´�ҷ������������¤��������
	 */
	DB::load();
	$hn = input_get('hn');
	
	$sql = "SELECT a.`date`,a.`drugcode`,a.`tradname`,a.`amount`,b.`detail1`,b.`detail2`,b.`detail3` FROM `ddrugrx` AS a,
	`drugslip` AS b 
	WHERE a.`hn` = :hn 
	AND a.`slcode` = b.`slcode` 
	ORDER BY a.`date` DESC";
	$items = DB::select($sql, array(':hn' => $hn));

	?>
	<table>
		<tr>
			<th>#</th>
			<th>�ѹ���</th>
			<th>Drug code</th>
			<th>�ӹǹ</th>
			<th>�Ը���</th>
		</tr>
		<?php $i=1;?>
		<?php foreach( $items as $item ): ?>
		<tr>
			<td><?=$i;?></td>
			<td><?=$item['date'];?></td>
			<td><?=$item['drugcode'];?></td>
			<td><?=$item['amount'];?></td>
			<td>
			<?php 
				echo $item['detail1'].' '.$item['detail2'].' '.$item['detail3'];
			?>
			</td>
		</tr>
		<?php $i++;?>
		<?php endforeach; ?>
	</table>
	<?php
	exit;
}
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
	<a href="../nindex.htm">��Ѻ�˹����ѡ����� SHS</a> | <a href="search_hn_from_drug.php" target="_blank">�˹�� �ʴ���ª��ͼ����·������ Warfarin</a>
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
	SELECT a.`orderdate`,a.`labnumber`,a.`hn`,a.`patientname`,b.`result` FROM `resulthead` AS a ,
`resultdetail` AS b 
WHERE b.`autonumber` = a.`autonumber` 
AND a.`orderdate` LIKE :date_select 
AND ( a.`profilecode` LIKE 'PT' OR a.`profilecode` LIKE 'CBC' OR a.`profilecode` LIKE 'UA' )
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
				<th>�ѹ���(Lab)</th>
				<th>HN</th>
				<th>����</th>
				<th>Diag</th>
				<th>��� INR</th>
				<th>UA & CBC</th>
			</tr>
		</thead>
		<tbody>
			<?php $i = 1; ?>
			<?php 
			foreach( $items AS $key => $item ){ 
				
				// �� Diag ���
				$sql = "SELECT b.`patienttype`, b.`room` 
				FROM `resulthead` AS a, `orderhead` AS b 
				WHERE b.`labnumber` = a.`labnumber` 
				AND a.`hn` = '".$item['hn']."' 
				AND a.`labnumber` = '".$item['labnumber']."'
				GROUP BY b.`room`";
				$type = DB::select($sql, null, true);
				if( $type['patienttype'] == 'IPD' ){
					$sql = "SELECT `diag` FROM `ipcard` WHERE `bedcode` = '".$type['room']."' AND `hn` = '".$item['hn']."' ORDER BY `row_id` DESC LIMIT 1";
				}else{
					$sql = "SELECT `diag` FROM `opday` WHERE `vn` = '".$type['room']."' AND `hn` = '".$item['hn']."'";
				}
				$doctor = DB::select($sql, null, true);
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$item['orderdate'];?></td>
				<td><a href="javascript:void(0);" onclick="detail('<?=$item['hn'];?>')"><?=$item['hn'];?></a></td>
				<td><?=$item['patientname'];?></td>
				<td><?=$doctor['diag'];?></td>
				<td><?=$item['result'];?></td>
				<td><a href="javascript:void(0);" onclick="newWindow('<?=$item['hn'];?>','<?=$item['labnumber'];?>');">����������´</a></td>
			</tr>
			<?php $i++; ?>
			<?php } ?>
		</tbody>
	</table>
	<script type="text/javascript">
		function newWindow(hn,labnum){
			window.open("druginr.php?task=detail&hn="+hn+"&labnumber="+labnum,"_blank","scrollbars=yes, width=800, height=400");
		}
		
		function detail(hn){
			window.open("druginr.php?task=alldrug&hn="+hn,"_blank","scrollbars=yes, width=800, height=400");
		}
	</script>
	<?php
	}else{
		?>
		<div>����բ����ż����·�� INR > 6</div>
		<?php
	}
}
