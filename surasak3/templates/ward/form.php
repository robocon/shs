<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : false ;
if( $view === 'obgyn' ){
	$departs = array('�ͼ������ٵ�');
}else{
	$departs = array('�ͼ��������','�ͼ�����˹ѡ','�ͼ����¾����','�ͼ����©ء�Թ');
}

$short_months = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');
$th_year = date('Y') + 543 ;
?>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<h3>Ẻ�������͡�����Ũӹǹ��������ԡ��</h3>
			</div>
		</div>
		<form action="ward_stat.php" method="post">
			<div class="col">
				<div class="cell">
					�ͼ�����: <select name="department">
						<?php foreach( $departs as $key => $depval ): ?>
						<option value="<?php echo $depval;?>"><?php echo $depval;?></option>
						<?php endforeach; ?>
						</select>

					��Ш���͹ <select name="date_month">
						<?php foreach( $short_months as $key => $month ): ?>
						<option value="<?php echo $key;?>"><?php echo $month;?></option>
						<?php endforeach; ?>
					</select>
					<label for="date_year">
						�.�. <input type="text" id="date_year" class="width-1of24" name="date_year" value="<?php echo $th_year;?>">
					</label>

				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_patient">
						1. �ӹǹ������㹷����� <input type="text" class="width-1of24" name="all_patient" value="">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_patient">
						1.1 ������㹷���ҧ�ҡ��͹��͹ <input type="text" class="width-1of24" name="prev_patient" value=""> ��
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_patient">
						1.2 �Ѻ�������͹��� <input type="text" class="width-1of24" name="new_patient" value=""> ��
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_admit">
						2. �ӹǹ�ѹ�͹�ç��Һ�� <input type="text" class="width-1of24" name="all_admit" value="">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_admit">
						2.1 �ӹǹ�ѹ�͹ þ. �ͧ������㹷���ҧ�ҡ��͹��͹ <input type="text" class="width-1of24" name="prev_admit" value=""> �ѹ
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_admit">
						2.2 �ӹǹ�ѹ�͹ þ. �ͧ������㹷���Ѻ�������͹��� <input type="text" class="width-1of24" name="new_admit" value=""> �ѹ
					</label>
					<br>
					( �ѹ�͹ þ. ���ѹ����˹���ź�����ѹ����Ѻ �� �Ѻ�ѹ��� 8 ��˹����ѹ��� 12 �ӹǹ�ѹ�͹þ.��� 4 ������ͧ�ӹ֧�֧���ҷ���Ѻ���ͨ�˹��� ��ùѺ�ѹ�����ѹ���������§�׹���������ѹ���� )
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="avg_bed">
						3. �ѵ�Ҥ�ͧ��§ <input type="text" class="width-1of24" name="avg_bed" value="">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_bed">
						4. �ӹǹ��§�ͧ�ͼ����� <input type="text" class="width-1of24" name="all_bed" value=""> ��§
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="refer_patient">
						5. �ӹǹ������ Refer <input type="text" class="width-1of24" name="refer_patient" value=""> ���
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="disc_patient">
						6. �ӹǹ�����¨�˹��� <input type="text" class="width-1of24" name="disc_patient" value=""> ���
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label>
						7. �����·�����ª��Ե������͹��� ( ��������ôҷ�����ª��Ե�ҡ��ä�ʹ, ��á�á�Դ������ª��Ե���� 7 �ѹ�á, �����·�����ª��Ե�����ҧ��ü�ҵѴ )
					</label>
					<div class="dead_patient_lists">
						<div class="col">
							<div class="cell">
								���� - ʡ��: <input type="text" name="dead_hn[]" value=""> HN: <input type="text" class="width-2of24" name="dead_name[]" value=""> AN: <input type="text" class="width-2of24" name="dead_an[]" value="">
							</div>
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button class="add_dead_patient">������ª��ͼ����·�����ª��Ե</button>
						</div>
					</div>
				</div>
			</div>
			<?php
			if( $view == 'obgyn' ){
				// ��ǹ�ͧ�ٵ�
				include 'templates/ward/newborn.php';
			}

			$do_action = ( $id === false ) ? 'add' : 'edit' ;
			?>
			<input type="hidden" name="action" value="<?php echo $do_action;?>">
			<?php if( $id !== false ): ?>
			<input type="hidden" name="id" value="<?php echo $id;?>">
			<?php endif; ?>
			<div class="col">
				<div class="cell">
					<button type="submit">�ѹ�֡Ẻ�����</button>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/template" id="dead_temp">
	<div class="col">
		<div class="cell">
			���� - ʡ��: <input type="text" name="dead_hn[]" value=""> HN: <input type="text" class="width-2of24" name="dead_name[]" value=""> AN: <input type="text" class="width-2of24" name="dead_an[]" value="">
		</div>
	</div>
</script>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.add_dead_patient', function(e){
		e.preventDefault();
		var dt = $('#dead_temp').html();
		// console.log(dt);
		$('.dead_patient_lists').append(dt);
	});
});
</script>
