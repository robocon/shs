<?php
include 'bootstrap.php';

include 'templates/classic/header.php';
include 'templates/classic/nav.php';

// DB::load();

$db = Mysql::load();

$default_date = ad_to_bc(date('Y-m'));
$date = input('date', $default_date);
?>
<style type="text/css">
	body{
		font-family: 'Angsana New';
		font-size: 16px;
	}
	@media print{
		table, 
		table th, 
		table td{
			border: 0;
		}
	}
		
</style>

<div class="cell">
	<div class="col">
		<h3>��ª��ͼ�����㹤�ҧ�׹�ѵ����§����ѹ���</h3>
	</div>
</div>
<div class="cell no-print">
	<div class="col">
		
		<form action="ipdcardno.php" method="post">
			<div class="cell">
				<div class="col">
					���͡�ѹ��� <input type="text" name="date" value="<?=$date;?>">
				</div>
			</div>
			<div class="cell">
				<div class="col">
					<button type="submit">�ʴ�������</button>
				</div>
			</div>
		</form>
	</div>
</div>
<?php
if( $date !== false ){
	?>
	<div class="cell">
		<div class="col">
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>�ѹ���</th>
						<th>AN</th>
						<th>������</th>
						<th>ʶҹС�����</th>
						<th>ʶҹ�</th>
					</tr>
				</thead>
				<tbody>
					<?php 

					// test format yyyy-mm-dd
					$day_match = preg_match('/\d+\-\d+\-\d+/', $date);
					if ( $day_match > 0 ) {
						$date_checker = $date;
						list($y, $m, $d) = explode('-', $date);
						$date = $y.'-'.$m;
						
					}

					$sql = "SELECT a.*, SUBSTRING(a.`date`, 1, 10) as `date_key` 
					FROM `dcstatus` AS a , 
					(
						SELECT `an`, MAX(`date`) AS `date`
						FROM `dcstatus` 
						WHERE `date` LIKE '$date%' 
						GROUP BY `an`
						ORDER BY `date` DESC
					) AS b 
					WHERE b.`date` = a.`date` AND b.`an` = a.`an`";
					// $items = DB::select($sql);
					$db->select($sql);
					$items = $db->get_items();
					
					$i = 1;
					foreach($items as $key => $item){

						// ��Ҥ��������ѹ����ѹ�� skip �ѹ���价�����ʴ�੾���ѹ����������ѹ�����ҹ��
						if( $day_match > 0 && $item['date_key'] !== $date_checker ){
							continue;
						}
					?>
					<tr>
						<td><?=$i;?></td>
						<td><?=$item['date'];?></td>
						<td><?=$item['an'];?></td>
						<td><?=$item['office'];?></td>
						<td>
							<?php
							$status_txt = trim($item['status']);
							list($status, $ect_txt) = explode(' ', $status_txt);
							
							echo ( $status == '����¹���ᾷ��' ) ? 'Y' : 'N' ;
							?>
						</td>
						<td><?=$status;?></td>
					</tr>
					<?php 
					$i++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<?php
}