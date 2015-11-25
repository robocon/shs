<?php
if( !defined('WARD_STAT') ) die('Access denied');

if( $view === 'obgyn' ){
	$departs = array('�ͼ������ٵ�');
}else{
	$departs = array('�ͼ��������','�ͼ�����˹ѡ','�ͼ����¾����','�ͼ����©ء�Թ');
}

$short_months = array('01' => '�.�.', '02' => '�.�.', '03' => '��.�', '04' => '��.�.', '05' => '�.�.', '06' => '��.�.', '07' => '�.�.', '08' => '�.�.', '09' => '�.�.', '10' => '�.�.', '11' => '�.�.', '12' => '�.�.');

if( isset($item['date_write']) ){
	list($th_year, $this_month) = explode('-', $item['date_write']);
}else{
	$th_year = date('Y') + 543 ;
}

?>
<!-- ��˹� Cursor -->
<style type="text/css">
.dead-remove:hover{ text-decoration: underline; cursor: pointer; }
</style>
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
						<?php $select = ( isset($item['department']) && $item['department'] == $depval ) ? 'selected="selected"' : '' ; ?>
						<option value="<?=$depval;?>" <?=$select;?>><?=$depval;?></option>
						<?php endforeach; ?>
						</select>

					��Ш���͹ <select name="date_month">
						<?php foreach( $short_months as $key => $month ): ?>
						<?php $select = ( $this_month == $key ) ? 'selected="selected"' : '' ; ?>
						<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
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
						1. �ӹǹ������㹷����� <input type="text" class="width-1of24" name="all_patient" value="<?=$item['all_patient'];?>">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_patient">
						1.1 ������㹷���ҧ�ҡ��͹��͹ <input type="text" class="width-1of24" name="prev_patient" value="<?=$item['prev_patient'];?>"> ��
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_patient">
						1.2 �Ѻ�������͹��� <input type="text" class="width-1of24" name="new_patient" value="<?=$item['new_patient'];?>"> ��
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_admit">
						2. �ӹǹ�ѹ�͹�ç��Һ�� <input type="text" class="width-1of24" name="all_admit" value="<?=$item['all_admit'];?>">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_admit">
						2.1 �ӹǹ�ѹ�͹ þ. �ͧ������㹷���ҧ�ҡ��͹��͹ <input type="text" class="width-1of24" name="prev_admit" value="<?=$item['prev_admit'];?>"> �ѹ
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_admit">
						2.2 �ӹǹ�ѹ�͹ þ. �ͧ������㹷���Ѻ�������͹��� <input type="text" class="width-1of24" name="new_admit" value="<?=$item['new_admit'];?>"> �ѹ
					</label>
					<br>
					( �ѹ�͹ þ. ���ѹ����˹���ź�����ѹ����Ѻ �� �Ѻ�ѹ��� 8 ��˹����ѹ��� 12 �ӹǹ�ѹ�͹þ.��� 4 ������ͧ�ӹ֧�֧���ҷ���Ѻ���ͨ�˹��� ��ùѺ�ѹ�����ѹ���������§�׹���������ѹ���� )
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="avg_bed">
						3. �ѵ�Ҥ�ͧ��§ <input type="text" class="width-1of24" name="avg_bed" value="<?=$item['avg_bed'];?>">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_bed">
						4. �ӹǹ��§�ͧ�ͼ����� <input type="text" class="width-1of24" name="all_bed" value="<?=$item['all_bed'];?>"> ��§
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="refer_patient">
						5. �ӹǹ������ Refer <input type="text" class="width-1of24" name="refer_patient" value="<?=$item['refer_patient'];?>"> ���
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="disc_patient">
						6. �ӹǹ�����¨�˹��� <input type="text" class="width-1of24" name="disc_patient" value="<?=$item['disc_patient'];?>"> ���
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label>
						7. �����·�����ª��Ե������͹��� ( ��������ôҷ�����ª��Ե�ҡ��ä�ʹ, ��á�á�Դ������ª��Ե���� 7 �ѹ�á, �����·�����ª��Ե�����ҧ��ü�ҵѴ )
					</label>
					<div class="dead_patient_lists">
						<?php foreach( $lists as $key => $list ): ?>
						<div class="col delete-contain">
							<div class="cell">
								���� - ʡ��: <input type="text" name="dead_name[]" value="<?=$list['name'];?>"> HN: <input type="text" class="width-2of24" name="dead_hn[]" value="<?=$list['hn'];?>"> AN: <input type="text" class="width-2of24" name="dead_an[]" value="<?=$list['an'];?>"> <span class="delete-remove">[ź]</span>
								<input type="hidden" name="dead_id[]" value="<?=$list['id'];?>">
							</div>
						</div>
						<?php endforeach; ?>
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
					<button type="submit">�ѹ�֡������</button>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<span style="color: red;">* �����ҧ��������� 0(�ٹ��) �������բ�����㹪�ͧ����</span>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/template" id="dead_temp">
	<div class="col delete-contain">
		<div class="cell">
			���� - ʡ��: <input type="text" name="dead_name[]" value=""> HN: <input type="text" class="width-2of24" name="dead_hn[]" value=""> AN: <input type="text" class="width-2of24" name="dead_an[]" value=""> <span class="dead-remove">[ź]</span>
		</div>
	</div>
</script>
<script type="text/javascript">
$(function(){
	$(document).on('click', '.add_dead_patient', function(e){
		e.preventDefault();
		var dt = $('#dead_temp').html();
		$('.dead_patient_lists').append(dt);
	});
	
	$(document).on('click', '.dead-remove', function(){
		var c = confirm('�׹�ѹ����ź������?');
		$(this).parents('div.delete-contain').remove();
	});
});
</script>
