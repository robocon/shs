<p><u>การคลอดและทารกแรกเกิด</u></p>
<div class="col">
	<div class="cell">
		<label for="">
			1. ทารกแรกเกิดทั้งหมด <input type="text" class="width-1of24" name="all_baby" value="<?=$item['all_baby'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="dead_baby">
			2. ทารกตายคลอดทั้งหมด <input type="text" class="width-1of24" name="dead_baby" value="<?=$item['dead_baby'];?>"> คน 
		</label>
		( สาเหตุ <input type="text" name="dead_baby_reson" value="<?=$item['dead_baby_reson'];?>"> )
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="baby_seven">
			3. ทารกแรกเกิดที่เสียชีวิตใน 7 วัน <input type="text" class="width-1of24" name="baby_seven" value="<?=$item['baby_seven'];?>"> คน 
		</label>
		( สาเหตุ <input type="text" name="baby_seven_reson" value="<?=$item['baby_seven_reson'];?>"> )
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="dead_mother">
			4. มารดาเสียชีวิตจากการคลอด <input type="text" class="width-1of24" name="dead_mother" value="<?=$item['dead_mother'];?>"> คน 
		</label>
		( สาเหตุ <input type="text" name="dead_mother_reson" value="<?=$item['dead_mother_reson'];?>"> )
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="all_mother">
			5. มารดาคลอดทั้งหมด <input type="text" class="width-1of24" name="all_mother" value="<?=$item['all_mother'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="all_cs">
			<!-- cs ย่อจาก csection -->
			6. จำนวนผ่าตัดคลอดทั้งหมด <input type="text" class="width-1of24" name="all_cs" value="<?=$item['all_cs'];?>"> คน 
		</label>
		( previous c/s <input type="text" class="width-1of24" name="prev_cs" value="<?=$item['prev_cs'];?>">, ผ่าตัดคลอดครั้งแรก <input type="text" class="width-1of24" name="first_cs" value="<?=$item['first_cs'];?>"> )
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="mother_cp">
			<!-- cp ย่อจาก complication -->
			7. จำนวนมารดาที่เกิดสภาวะแทรกซ้อนรวม <input type="text" class="width-1of24" name="mother_cp" value="<?=$item['mother_cp'];?>"> คน แยกเป็น
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="eclampsia">
			7.1 Eclampsia <input type="text" class="width-1of24" name="eclampsia" value="<?=$item['eclampsia'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="embolism">
			7.2 Embolism <input type="text" class="width-1of24" name="embolism" value="<?=$item['embolism'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="blood_cp">
			7.3 ตกเลือดระหว่างคลอดหรือหลังคลอด <input type="text" class="width-1of24" name="blood_cp" value="<?=$item['blood_cp'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="broke_cp">
			7.4 มีการฉีกขาด แตก ทะลุ <input type="text" class="width-1of24" name="broke_cp" value="<?=$item['broke_cp'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="infected_cp">
			7.5 การติดเชื้อ <input type="text" class="width-1of24" name="infected_cp" value="<?=$item['infected_cp'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="placenta_cp">
			7.6 รกค้าง <input type="text" class="width-1of24" name="placenta_cp" value="<?=$item['placenta_cp'];?>"> คน
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="etc_cp">
			7.7 อื่นๆ <input type="text" class="width-1of24" name="etc_cp" value="<?=$item['etc_cp'];?>"> คน (แจงรายละเอียด)
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="hypoxiz">
			อัตราทารกแรกเกิดขาดออกซิเจน <input type="text" class="width-2of24" name="hypoxiz" value="<?=$item['hypoxiz'];?>">
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="milk">
			ร้อยละการเลี้ยงลูกด้วยนมแม่ <input type="text" class="width-2of24" name="milk" value="<?=$item['milk'];?>">
		</label>
	</div>
</div>
<div class="col">
	<div class="cell">
		<label for="nl">
			NL <input type="text" class="width-1of24" name="nl" value="<?=$item['nl'];?>"> ราย
		</label>
		<label for="ve">
			V/E <input type="text" class="width-1of24" name="ve" value="<?=$item['ve'];?>"> ราย
		</label>
		<label for="fe">
			F/E <input type="text" class="width-1of24" name="fe" value="<?=$item['fe'];?>"> ราย
		</label>
	</div>
</div>

<input type="hidden" name="newborn_active" value="1">