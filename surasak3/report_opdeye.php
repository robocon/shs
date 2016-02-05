<?php 

include 'bootstrap.php';

$def_month_th = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');

$title = 'OPD �� ��ػ�ʹ�����';
include 'templates/classic/header.php';

DB::load();

$default_year = ( date('Y') + 543 );
$year = input_post('year', $default_year);
$show = input_post('show');
?>
<style>
	body{
		font-family: 'TH SarabunPSK';
		font-size: 16pt;
	}
</style>

<div class="col nav-menu-col">
	<div class="menu cell">
		<ul class="nav">
			<li><a href="../nindex.htm">˹����ѡ����� SHS</a></li>
			<li><a href="eye_from.php">��ش����¹��</a></li>
		</ul>
	</div>
</div>

<div class="cell">
	<div class="col">
		<h3>OPD �� ��ػ�ʹ�����</h3>
	</div>
</div>
<form action="report_opdeye.php" method="post" class="no-print">
	<div class="cell">
		<div class="col">
			<label for="year">
				���͡�շ���ͧ����ʴ��� <input type="text" id="year" class="width-1of24" name="year" value="<?=$year?>">
			</label>
		</div>
	</div>
	<div class="cell">
		<div class="col">
			<button type="submit">�ʴ���</button>
			<input type="hidden" name="show" value="inyear">
		</div>
	</div>
</form>

<?php
$eye_lists = array(
	'No DR' => 'NoDR',
	'Mild NPDR ' => 'Mild',
	'Moderate NPDR' => 'Moderate',
	'Severe NPDR' => 'Severe',
	'PDR' => 'PDR'
);

if( $show === 'inyear' ){
	
	$en_year = bc_to_ad($year);
	$sql = "SELECT `date_eye`,DATE_FORMAT( `date_eye`, '%Y-%m' ) AS `new_date`,`dr`,COUNT(`hn`) AS `rows` FROM `opd_eye` 
WHERE `dr` != '' 
AND `date_eye` LIKE '$en_year%' 
GROUP BY MONTH(`date_eye`), `dr`
ORDER BY `date_eye`";
	$items = DB::select($sql);
	
	$new_items = array();
	foreach( $items as $key => $item ){
		$key = $item['new_date'].'-'.$item['dr'];
		$new_items[$key] = $item;
	}
	
	?>
	<table>
		<thead>
			<tr>
				<th rowspan="2">�� DR</th>
				<th colspan="13">�ӹǹ������ �� <?=$year;?></th>
			</tr>
			<tr>
				<?php
				foreach( $def_month_th as $key => $month){
					?><th><?=$month;?></th><?php
				}
				?>
				<th>���</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($eye_lists as $key => $list) {
				?>
				<tr>
					<td><?=$list;?></td>
					<?php
					$ii = 0;
					foreach( $def_month_th as $mKey => $month){
						$find_key = $en_year.'-'.$mKey.'-'.$list;
						?>
						<td>
						<?php
							if( $new_items[$find_key] ){
								$month_total = $new_items[$find_key]['rows'];
								$ii += $month_total;
								?><a href="report_opdeye_details.php?date=<?=($en_year.'-'.$mKey);?>&dr=<?=$list;?>" target="_blank"><?=$month_total;?></a> <?php
							}else{
								echo '-';
							}
						?>
						</td>
						<?php
					}
					?>
					<td><?=$ii;?></td>
				</tr>
				<?php
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
	<?php
}

include 'templates/classic/footer.php';