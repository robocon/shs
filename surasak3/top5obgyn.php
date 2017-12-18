<?php
include 'bootstrap.php';

include 'templates/classic/header.php';

$doctors = array(
	'87' => '��� �����Ѿ��', 
	'20' => '���Է�� ǧ�����',
	'129' => '��ɮ�쾧�� ��������ѡ��'
);

$th_date = !empty($_POST['year_select']) ? trim($_POST['year_select']) : date('Y') + 543 ;
$doctor_id = isset($_POST['doctor']) ? trim($_POST['doctor']) : false ;
?>

<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
				<div class="col width-fill mobile-width-fill no-print">
					<div class="cell">
						<ul class="col nav clear">
							<li class="active"><a href="../nindex.htm">˹����ѡ����� SHS</a></li>
						</ul>
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<h3>��ª��� Diag ᾷ�����§����ӹǹ������</h3>
					</div>
				</div>
				<form action="top5obgyn.php" method="post" class="no-print">
					<div class="col">
						<div class="cell">
							��-��͹ <input type="text" name="year_select" value="<?php echo $th_date;?>">
							<span>* ����ö���͡����ʴ��ŵ����͹�� �� 2558-12</span>
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
					
					$where = "AND a.`doctor` LIKE '%$name%'";
					if( $name == '��ɮ�쾧��' ){
						$where = "AND ( a.`doctor` LIKE '%$name%' OR a.`doctor` LIKE '%������ø��%' ) ";
					}

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
					$where 
					AND ( a.`diag` IS NOT NULL AND a.`diag` NOT LIKE '' )
					GROUP BY a.`diag`
					
					ORDER BY `diag_row` DESC
					";
					$items = DB::select($sql);
					// $all_rows = DB::rows();
					
					$all_rows = 0;
					foreach ($items as $key => $item) {
						if( $doctor_id == 20 && $item['age'] > 15 ){ continue; }

						$all_rows += (int) $item['diag_row'];
					}
					
					?>
					<div class="col">
						<div class="cell">
							<table>
								<tr>
									<td style="vertical-align: top!important;">
										<h3>�����¹͡</h3>
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
									<tr>
										<td colspan="3">���</td>
										<td><?=$all_rows;?></td>
										<td></td>
									</tr>
								</tbody>
							</table>
									</td>
									<td style="vertical-align: top!important;">
										
										
										<?php
										$sql = "
										SELECT a.`date`,a.`diag`,a.`doctor`,CONCAT('out') AS `patient`,COUNT(a.`diag`) AS `diag_row`,a.`icd10`,
					TIMESTAMPDIFF( 
						YEAR, 
						b.`dbirth`, 
						CONCAT( ( YEAR( NOW() ) + 543 ), DATE_FORMAT( NOW(), '-%m-%d' ) ) 
					)  AS `age`
					FROM `ipcard` AS a 
					LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
					WHERE a.`date` LIKE '$th_date%' 
					$where 
					AND ( a.`diag` IS NOT NULL AND a.`diag` NOT LIKE '' )
					GROUP BY a.`diag`
					
					ORDER BY `diag_row` DESC
										";
										
										
										$items = DB::select($sql);
					// $all_rows = DB::rows();
					$all_rows = 0;
					foreach ($items as $key => $item) {
						if( $doctor_id == 20 && $item['age'] > 15 ){ continue; }
						
						$all_rows += (int) $item['diag_row'];
					}
										?>
										
										
										
										<h3>�������</h3>
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
									<tr>
										<td colspan="3">���</td>
										<td><?=$all_rows;?></td>
										<td></td>
									</tr>
								</tbody>
							</table>
									</td>
								</tr>
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