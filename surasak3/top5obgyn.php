<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

$doctors = array('87' => '��� �����Ѿ��', '20' => '���Է�� ǧ�����');

$th_date = !empty($_POST['year_select']) ? trim($_POST['year_select']) : date('Y') + 543 ;
$doctor_id = isset($_POST['doctor']) ? trim($_POST['doctor']) : false ;
?>

<style type="text/css">
body{
	font-family: "TH SarabunPSK";
	font-size:16px;
}
</style>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
				<div class="col width-fill mobile-width-fill no-print">
					<div class="cell">
						<ul class="col nav">
							<li class="active"><a href="../nindex.htm">˹����ѡ����� SHS</a></li>
						</ul>
					</div>
				</div>
				<h3>��ª��� Diag ᾷ�����§����ӹǹ������</h3>
				<form action="top5obgyn.php" method="post" class="no-print">
					<div class="col">
						<div class="cell">
							��-��͹ <input type="text" name="year_select" value="<?php echo $th_date;?>">
						</div>
					</div>
					<div class="col">
						<div class="cell">
							���͡ᾷ�� <select name="doctor" id="">
								<?php foreach($doctors as $key => $item){ ?>
								<?php $selected = ( $key == $doctor_id ) ? 'selected="selected"' : '' ;?>
								<option value="<?=$key;?>" <?=$selected;?>><?=$item;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button type="submit">�ʴ���</button>
							<input type="hidden" name="show" value="1">
						</div>
					</div>
				</form>
				<?php
				$show = isset($_POST['show']) ? true : false ;
				if( $show ){
					
					$sql = "SELECT `name`,`doctorcode` FROM `doctor` WHERE `row_id` = :doctor_id;";
					$doctor = DB::select($sql, array(':doctor_id' => $doctor_id), true);
					
					// ź��ͧ��ҧ�ͧ��ͧ�������ͪ�ͧ����
					list($md, $name, $surname) = explode(' ', str_replace('  ', ' ', $doctor['name']));
					
					$sql = "
					SELECT a.`thidate`,a.`diag`,a.`doctor`,CONCAT('in') AS `patient`,COUNT(a.`diag`) AS `diag_row`,a.`icd10`,
					TIMESTAMPDIFF( 
						YEAR, 
						b.`dbirth`, 
						CONCAT( ( YEAR( NOW() ) + 543 ), DATE_FORMAT( NOW(), '-%m-%d' ) ) 
					)  AS `age`
					FROM `opday` AS a 
					LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
					WHERE a.`thidate` LIKE '$th_date%' 
					AND a.`doctor` LIKE '%$name%' 
					AND ( a.`diag` IS NOT NULL AND a.`diag` NOT LIKE '' )
					GROUP BY a.`diag`
					
					UNION ALL
					
					SELECT a.`date`,a.`diag`,a.`doctor`,CONCAT('out') AS `patient`,COUNT(a.`diag`) AS `diag_row`,a.`icd10`,
					TIMESTAMPDIFF( 
						YEAR, 
						b.`dbirth`, 
						CONCAT( ( YEAR( NOW() ) + 543 ), DATE_FORMAT( NOW(), '-%m-%d' ) ) 
					)  AS `age`
					FROM `ipcard` AS a 
					LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
					WHERE a.`date` LIKE '$th_date%' 
					AND a.`doctor` LIKE '%$name%' 
					AND ( a.`diag` IS NOT NULL AND a.`diag` NOT LIKE '' )
					GROUP BY a.`diag`
					
					ORDER BY `diag_row` DESC
					";
					$items = DB::select($sql);
					$all_rows = DB::rows();
					?>
					<div class="col">
						<div class="cell">
							<table>
								<thead>
									<tr>
										<th>#</th>
										<th>ICD 10</th>
										<th>Diag</th>
										<th>�ӹǹ(��)</th>
										<th>%</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1;
									foreach ($items as $key => $item) {
										
										// ������Է�� �ФѴ���੾�Ф������������Թ 15��
										if( $doctor_id == 20 && $item['age'] > 15 ){ continue; }
									?>
									<tr>
										<td><?=$i;?></td>
										<td><?=$item['icd10'];?></td>
										<td><?=$item['diag'];?></td>
										<td><?=$item['diag_row'];?></td>
										<td>
											<?php 
											echo round( ( $item['diag_row'] * 100 ) / $all_rows, 2 );
											?>
										</td>
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
				?>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';