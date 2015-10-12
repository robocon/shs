<?php
include 'bootstrap.php';

$drug_name = isset($_REQUEST['drug_name']) ? trim($_REQUEST['drug_name']) : false ;
$year = isset($_REQUEST['year']) ? trim($_REQUEST['year']) : date('Y') + 543 ;

$title = '�к��ʴ��ӹǹ�������';
include 'templates/classic/header.php';
include 'templates/classic/nav.php';

?>
<div class="site-center">
	<div class="col">
		<div class="cell">
			<form class="col" action="search_hn_from_drug.php" method="post">
				<div><h3>�ӹǹ�����·������� þ.</h3></div>
				<div class="col">
					<div class="width-2of5">
						���ҵ���������ѭ: 
					</div>
					<div>
						<input type="text" name="drug_name" id="drug_name" value="<?php echo $drug_name;?>">
					</div>
				</div>
				<div class="col">
					<div class="width-2of5">
						���͡���ʴ���: 
					</div>
					<div>
						<select name="year" id="year">
							<option value="2556">2556</option>
							<option value="2557">2557</option>
							<option value="2558" selected="selected">2558</option>
						</select>
					</div>
				</div>
				<div class="col">
					<div class="width-2of5"></div>
					<div>
						<button type="submit">����</button>
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	DB::load();
	if( $drug_name ){
		
		if( strlen($drug_name) < 3 ){
			echo '��س���Ӥ鹷���ҡ���� 3 ����ѡ��';
			exit;
		}
	?>
	<div class="col">
		<div class="cell">
			<div class="col">
				<h3>�� <?php echo $year; ?></h3>
			</div>
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>������</th>
						<th>�ӹǹ�������</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "
					SELECT a.`drugcode`,a.`tradname`,a.`genname`,COUNT(b.`row_id`) AS `row`
					FROM `druglst` AS a
					LEFT JOIN `ddrugrx` AS b ON b.`drugcode` = a.`drugcode`
					WHERE a.`genname` LIKE :drug_name AND b.`date` LIKE :year_select
					GROUP BY a.`genname`
					";
					$items = DB::select($sql, array(
						':drug_name' => "%$drug_name%",
						':year_select' => "$year%"
					));
					
					$i = 1;
					foreach ($items as $key => $item) {
						$drug_code = trim($item['drugcode']);
					?>
					<tr>
						<td align="center"><?php echo $i;?></td>
						<td><?php echo $item['genname'].' ('.$item['tradname'].')'; ?></td>
						<td><?php echo $item['row'];?></td>
					</tr>
					<?php $i++; ?>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
	<?php } ?>
</div>
<?php
include 'templates/classic/footer.php';