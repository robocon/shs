<?php 

include 'bootstrap.php';

$def_month_th = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');
$eye_lists = array(
	'No DR' => 'NoDR',
	'Mild NPDR ' => 'Mild',
	'Moderate NPDR' => 'Moderate',
	'Severe NPDR' => 'Severe',
	'PDR' => 'PDR'
);

$title = '��ª��ͼ����� OPD�� �����͹';
include 'templates/classic/header.php';

DB::load();

$date = input_get('date');
$dr = input_get('dr');

list($y, $m) = explode('-', $date);

?>
<style>
	body{
		font-family: 'TH SarabunPSK';
		font-size: 16pt;
	}
</style>
<div class="cell">
	<div class="col">
		<div class="cell">
			<div class="col">
				<h3>��ª��ͼ����� <?=(array_search($dr, $eye_lists));?> <?=$def_month_th[$m];?> <?=($y + 543);?></h3>
			</div>
		</div>
		<div class="cell">
			<div class="col">
				<?php
				$sql = "SELECT * 
				FROM `opd_eye` 
				WHERE `date_eye` LIKE :date_eye 
				AND `dr` = :dr
				ORDER BY `date_eye` ASC";
				$items = DB::select($sql, array(':date_eye' => $date.'%', ':dr' => $dr));
				
				?>
				<table>
					<thead>
						<tr>
							<th>#</th>
							<th>�ѹ���</th>
							<th>hn</th>
							<th>����-ʡ��</th>
							<th>FBS</th>
							<th>Hba1c</th>
							<th>�����˵�</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$i = 1;
						foreach( $items as $key => $item ){
						?>
						<tr>
							<td><?=$i;?></td>
							<td><?=ad_to_bc($item['date_eye']);?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['ptname'];?></td>
							<td><?=$item['fbs'];?></td>
							<td><?=$item['hba1c'];?></td>
							<td><?=$item['comment'];?></td>
						</tr>
						<?php
							$i++;
						}
						?>
					</tbody>
				</table>
				<div class="cell no-print">
					<div class="col">
						<button onclick="printTable()">�����</button>
					</div>
				</div>
				<script type="text/javascript">
					function printTable(){
						window.print();
					}
				</script>
			</div>
		</div>
	</div>
</div>

<?php

include 'templates/classic/footer.php';
?>