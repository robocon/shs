<?php
if( !defined('WARD_STAT') ) die('Access denied');

if( $view === 'obgyn' ){
	$departs = array('หอผู้ป่วยสูติ');
}else{
	$departs = array('หอผู้ป่วยรวม','หอผู้ป่วยหนัก','หอผู้ป่วยพิเศษ','หอผู้ป่วยฉุกเฉิน');
}

$short_months = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

if( isset($item['date_write']) ){
	list($th_year, $this_month) = explode('-', $item['date_write']);
}else{
	$th_year = date('Y') + 543 ;
}

?>
<!-- กำหนด Cursor -->
<style type="text/css">
.dead-remove:hover{ text-decoration: underline; cursor: pointer; }
</style>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<h3>แบบฟอร์มกรอกข้อมูลจำนวนผู้มาใช้บริการ</h3>
			</div>
		</div>
		<form action="ward_stat.php" method="post">
			<div class="col">
				<div class="cell">
					หอผู้ป่วย: <select name="department">
						<?php foreach( $departs as $key => $depval ): ?>
						<?php $select = ( isset($item['department']) && $item['department'] == $depval ) ? 'selected="selected"' : '' ; ?>
						<option value="<?=$depval;?>" <?=$select;?>><?=$depval;?></option>
						<?php endforeach; ?>
						</select>

					ประจำเดือน <select name="date_month">
						<?php foreach( $short_months as $key => $month ): ?>
						<?php $select = ( $this_month == $key ) ? 'selected="selected"' : '' ; ?>
						<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
						<?php endforeach; ?>
					</select>
					<label for="date_year">
						พ.ศ. <input type="text" id="date_year" class="width-1of24" name="date_year" value="<?php echo $th_year;?>">
					</label>

				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_patient">
						1. จำนวนผู้ป่วยในทั้งหมด <input type="text" class="width-1of24" name="all_patient" value="<?=$item['all_patient'];?>">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_patient">
						1.1 ผู้ป่วยในที่ค้างจากเดือนก่อน <input type="text" class="width-1of24" name="prev_patient" value="<?=$item['prev_patient'];?>"> คน
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_patient">
						1.2 รับใหม่ในเดือนนี้ <input type="text" class="width-1of24" name="new_patient" value="<?=$item['new_patient'];?>"> คน
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_admit">
						2. จำนวนวันนอนโรงพยาบาล <input type="text" class="width-1of24" name="all_admit" value="<?=$item['all_admit'];?>">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_admit">
						2.1 จำนวนวันนอน รพ. ของผู้ป่วยในที่ค้างจากเดือนก่อน <input type="text" class="width-1of24" name="prev_admit" value="<?=$item['prev_admit'];?>"> วัน
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_admit">
						2.2 จำนวนวันนอน รพ. ของผู้ป่วยในที่รับใหม่ในเดือนนี้ <input type="text" class="width-1of24" name="new_admit" value="<?=$item['new_admit'];?>"> วัน
					</label>
					<br>
					( วันนอน รพ. ใช้วันที่จำหน่ายลบด้วยวันที่รับ เช่น รับวันที่ 8 จำหน่ายวันที่ 12 จำนวนวันนอนรพ.คือ 4 โดยไม่ต้องคำนึงถึงเวลาที่รับหรือจำหน่าย การนับวันแต่ละวันถ้าเลยเที่ยงคืนถือว่าเป็นวันใหม่ )
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="avg_bed">
						3. อัตราครองเตียง <input type="text" class="width-1of24" name="avg_bed" value="<?=$item['avg_bed'];?>">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_bed">
						4. จำนวนเตียงของหอผู้ป่วย <input type="text" class="width-1of24" name="all_bed" value="<?=$item['all_bed'];?>"> เตียง
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="refer_patient">
						5. จำนวนผู้ป่วย Refer <input type="text" class="width-1of24" name="refer_patient" value="<?=$item['refer_patient'];?>"> ราย
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="disc_patient">
						6. จำนวนผู้ป่วยจำหน่าย <input type="text" class="width-1of24" name="disc_patient" value="<?=$item['disc_patient'];?>"> ราย
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label>
						7. ผู้ป่วยที่เสียชีวิตภายในเดือนนี้ ( ไม่รวมดารดาที่เสียชีวิตจากการคลอด, ทารกแรกเกิดที่เสียชีวิตภายใน 7 วันแรก, ผู้ป่วยที่เสียชีวิตระหว่างการผ่าตัด )
					</label>
					<div class="dead_patient_lists">
						<?php foreach( $lists as $key => $list ): ?>
						<div class="col delete-contain">
							<div class="cell">
								ชื่อ - สกุล: <input type="text" name="dead_name[]" value="<?=$list['name'];?>"> HN: <input type="text" class="width-2of24" name="dead_hn[]" value="<?=$list['hn'];?>"> AN: <input type="text" class="width-2of24" name="dead_an[]" value="<?=$list['an'];?>"> <span class="delete-remove">[ลบ]</span>
								<input type="hidden" name="dead_id[]" value="<?=$list['id'];?>">
							</div>
						</div>
						<?php endforeach; ?>
					</div>
					<div class="col">
						<div class="cell">
							<button class="add_dead_patient">เพิ่มรายชื่อผู้ป่วยที่เสียชีวิต</button>
						</div>
					</div>
				</div>
			</div>
			<?php
			if( $view == 'obgyn' ){
				// ส่วนของสูติ
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
					<button type="submit">บันทึกข้อมูล</button>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<span style="color: red;">* เว้นว่างหรือใส่เป็น 0(ศูนย์) ถ้าไม่มีข้อมูลในช่องนั้นๆ</span>
				</div>
			</div>
		</form>
	</div>
</div>
<script type="text/template" id="dead_temp">
	<div class="col delete-contain">
		<div class="cell">
			ชื่อ - สกุล: <input type="text" name="dead_name[]" value=""> HN: <input type="text" class="width-2of24" name="dead_hn[]" value=""> AN: <input type="text" class="width-2of24" name="dead_an[]" value=""> <span class="dead-remove">[ลบ]</span>
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
		var c = confirm('ยืนยันที่จะลบข้อมูล?');
		$(this).parents('div.delete-contain').remove();
	});
});
</script>
