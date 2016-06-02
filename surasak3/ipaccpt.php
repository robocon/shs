<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

$date = get_date_bc('Y-m');
$def_date = input_post('date', $date);
?>
<div class="col no-print">
	<div class="cell">
		<div>
			<a href="../nindex.htm">&lt;&lt ������ѡ�ç��Һ��</a> | <a href="opaccpt.php">����Ѻ�����¹͡�觵���Է��</a> 
		</div>
		<div>
			<h3>�к�����Ѻ��������觵���Է��</h3>
		</div>
		<form action="ipaccpt.php" method="post">
			<div>
				<label for="date">���͡��͹</label>
				<input type="text" id="date" name="date" value="<?=$def_date;?>">
				<span>* �ٻẺ ��-��͹ �� 2559-01</span>
			</div>
			<div>
				<button type="submit">�ʴ���¡��</button>
				<input type="hidden" name="action" value="display">
			</div>
		</form>
	</div>
</div>
<?php
$action = input('action');
if ($action === 'display') {
	
	$db = Mysql::load();
	
	$date = input_post('date');
	$sql = "
	SELECT SUM(`paid`) AS `total`, SUBSTRING(`ptright`, 1, 3) AS `ptcode`
	FROM `ipacc` 
	WHERE `date` LIKE :date_ipacc 
	AND ( `an` IS NOT NULL AND `an` != '' ) 
	AND ( `ptright` IS NOT NULL AND `ptright` != '' ) 
	GROUP BY `ptcode`";
	
	$data = array(
		':date_ipacc' => "$date%"
	);
	$db->select($sql, $data);
	$items = $db->get_items();
	
	$sql = "SELECT `code`, `name` 
	FROM `ptright`";
	$db->select($sql);
	$pt_items = $db->get_items();
	$codes = array();
	
	foreach( $pt_items as $key => $item ){
		$key = $item['code'];
		$codes[$key] = $item['name'];
	}
	
	list($year, $month) = explode('-', $date);
	
	if( count($items) > 0 ){
		?>
		<h3>����Ѻ��������觵���Է�� ��͹ <?=$def_fullm_th[$month];?> �� <?=$year;?></h3>
		<table class="width-4of5">
			<thead>
				<tr>
					<th>#</th>
					<th>�Է��</th>
					<th>�ӹǹ(�ҷ)</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i = 1;
				$final = 0;
				foreach( $items as $key => $item ){
					?>
					<tr>
						<td><?=$i;?></td>
						<td>
							<?php
							$ptc = $item['ptcode'];
							echo $ptc.' '.$codes[$ptc];
							?> 
						</td>
						<td align="right"><?=number_format($item['total'], 2);?></td>
					</tr>
					<?php
					
					$final += $item['total'];
					
					$i++;
				}
				?>
				<tr>
					<td colspan="2"><b>�ʹ���</b></td>
					<td align="right"><b><?=number_format($final, 2);?></b></td>
				</tr>
			</tbody>
		</table>
		<?php
	}
}
include 'templates/classic/footer.php';