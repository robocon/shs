<?php
$departs = array('หอผู้ป่วยรวม','หอผู้ป่วยหนัก','หอผู้ป่วยพิเศษ','หอผู้ป่วยฉุกเฉิน');
$short_months = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');
$th_year = date('Y') + 543 ;
?>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<h3>แบบฟอร์มกรอกข้อมูลจำนวนผู้มาใช้บริการ</h3>
			</div>
		</div>
		<form action="stat_ward.php">
			<div class="col">
				<div class="cell">
					หอผู้ป่วย: <select name="department">
						<?php foreach( $departs as $key => $depval ): ?>
						<option value="<?php echo $depval;?>"><?php echo $depval;?></option>
						<?php endforeach; ?>
						</select>
					
					ประจำเดือน <select name="date_month">
						<?php foreach( $short_months as $key => $month ): ?>
						<option value="<?php echo $key;?>"><?php echo $month;?></option>
						<?php endforeach; ?>
					</select>
					<label for="date_year">
						พ.ศ. <input type="text" id="date_year" name="date_year" value="<?php echo $th_year;?>">
					</label>
					
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="all_patient">
						1. จำนวนผู้ป่วยในทั้งหมด <input type="text" class="width-1of24" name="all_patient" value="">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="prev_patient">
						1.1 ผู้ป่วยในที่ค้างจากเดือนก่อน <input type="text" class="width-1of24" name="prev_patient" value=""> คน
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="new_patient">
						1.2 รับใหม่ในเดือนนี้ <input type="text" class="width-1of24" name="new_patient" value=""> คน
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						2. จำนวนวันนอนโรงพยาบาล <input type="text" class="width-1of24" name="all_admit" value="">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						2.1 จำนวนวันนอน รพ. ของผู้ป่วยในที่ค้างจากเดือนก่อน <input type="text" class="width-1of24" name="prev_admit" value=""> วัน
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						2.2 จำนวนวันนอน รพ. ของผู้ป่วยในที่รับใหม่ในเดือนนี้ <input type="text" class="width-1of24" name="new_admit" value=""> วัน
					</label>
					<br>
					( วันนอน รพ. ใช้วันที่จำหน่ายลบด้วยวันที่รับ เช่น รับวันที่ 8 จำหน่ายวันที่ 12 จำนวนวันนอนรพ.คือ 4 โดยไม่ต้องคำนึงถึงเวลาที่รับหรือจำหน่าย การนับวันแต่ละวันถ้าเลยเที่ยงคืนถือว่าเป็นวันใหม่ )
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						3. อัตราครองเตียง <input type="text" class="width-1of24" name="" value="">
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						4. จำนวนเตียงของหอผู้ป่วย <input type="text" class="width-1of24" name="" value=""> เตียง
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						5. จำนวนผู้ป่วย Refer <input type="text" class="width-1of24" name="" value=""> ราย
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label for="">
						6. จำนวนผู้ป่วยจำหน่าย <input type="text" class="width-1of24" name="" value=""> ราย
					</label>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label>
						7. ผู้ป่วยที่เสียชีวิตภายในเดือนนี้ ( ไม่รวมดารดาที่เสียชีวิตจากการคลอด, ทารกแรกเกิดที่เสียชีวิตภายใน 7 วันแรก, ผู้ป่วยที่เสียชีวิตระหว่างการผ่าตัด )
					</label>
					<div class="">
						<div class="col">
							<div class="cell">
								ชื่อ - สกุล: <input type="text" name="" value=""> HN: <input type="text" class="width-2of24" name="" value=""> AN: <input type="text" class="width-2of24" name="" value="">
							</div>
						</div>
						<div class="col">
							<div class="cell">
								ชื่อ - สกุล: <input type="text" name="" value=""> HN: <input type="text" class="width-2of24" name="" value=""> AN: <input type="text" class="width-2of24" name="" value="">
							</div>
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button>เพิ่มรายชื่อผู้ป่วยที่เสียชีวิต</button>
						</div>
					</div>
				</div>
			</div>
			<?php
			
			include 'templates/ward/newborn.php';
			
			?>
			<input type="hidden" name="action" value="">
			<input type="hidden" name="id" value="">
			<div class="col">
				<div class="cell">
					<button type="submit">เพิ่มรายการ</button>
				</div>
			</div>
		</form>
	</div>
</div>