<?php 

include 'bootstrap.php';

$def_month_th = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');
$eye_lists = array(
	'No DR' => 'NoDR',
	'Mild NPDR ' => 'Mild',
	'Moderate NPDR' => 'Moderate',
	'Severe NPDR' => 'Severe',
	'PDR' => 'PDR'
);

$title = 'รายชื่อผู้ป่วย OPDตา ตามเดือน';
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
				<h3>รายชื่อผู้ป่วย <?=(array_search($dr, $eye_lists));?> <?=$def_month_th[$m];?> <?=($y + 543);?></h3>
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
							<th>วันที่</th>
							<th>hn</th>
							<th>ชื่อ-สกุล</th>
							<th>FBS</th>
							<th>Hba1c</th>
							<th>หมายเหตุ</th>
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
						<button onclick="printTable()">พิมพ์</button>
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