<div>
	<p><b>กรุณาเลือกเหตุผลการสั่งใช้ยา</b></p>
	<div>
		<input type="checkbox" onclick="clickINC1()" class="inputInclisiran" id="inputInclisiran1" name="title[]" value="INCIL1"><label for="inputInclisiran1">1.) ผู้ป่วยที่เป็นโรคไขมันในเลือดสูงจากกรรมพันธุ์ (Familial hypercholesterolemia) หรือ (FH) ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า > 100 mg/dl</label>
		<div style="display:none;" id="subIncli1">
			<table class="chk_table" style="width:90%; margin: 0 auto;">
				<tr>
					<td colspan="2" style="text-align:center;"><b>เกณฑ์การประเมิน (Dutch lipid clinical network criteria)</b></td>
					<td align="center"><b>คะแนน</b></td>
				</tr>
				<tr style="font-weight:bold; background-color:#dddddd;">
					<td colspan="3">ประวัติจากครอบครัว</td>
				</tr>
				<?php
				$INCLI1_SUB1_items = array(
					'INCLI1_SUB1_1' => array(
						'name' => 'ครอบครัวมีประวัติโรคหลอดเลือดหัวใจเกิดก่อนวัยอันควร (Premature CVD) ผู้ชาย < 55 ปี, ผู้หญิง < 60 ปี',
						'score' => '1'
					),
					'INCLI1_SUB1_2' => array(
						'name' => 'มีประวัติญาติค่า LDL-C สูงว่าคนปกติทั่วไป (95% tile) ในอายุและเพศ ของญาติสายตรงทั้งหมด',
						'score' => '1'
					),
					'INCLI1_SUB1_3' => array(
						'name' => 'ญาติสายตรงมีภาวะ Tendon Xanthoma และ/หรือ Corneal arcus',
						'score' => '2'
					),
					'INCLI1_SUB1_4' => array(
						'name' => 'มีประวัติญาติที่อายุ &lt; 18 ปี มี ค่า LDL-C สูงว่าคนปกติทั่วไป (95% tile) ในอายุและเพศเดียวกั',
						'score' => '2'
					)
				);
				foreach ($INCLI1_SUB1_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail1" data-score="<?=$v['score'];?>" id="<?=$key;?>" name="INCIL1[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v['name'];?></label></td>
						<td align="center"><?=$v['score'];?></td>
					</tr>
					<?php
				}
				?>
				
				<tr style="font-weight:bold; background-color:#dddddd;">
					<td colspan="3">ประวัติจากตัวคนไข้</td>
				</tr>
				<?php
				$INCLI1_SUB2_items = array(
					'INCLI1_SUB2_1' => array(
						'name' => 'มีภาวะโรคหลอดเลือดหัวใจตีบ (CAD) ก่อนวัยอันควรเช่น (ผู้ชาย &lt; 55 ปี, ผู้หญิง &lt; 60 ปี)',
						'score' => '2'
					),
					'INCLI1_SUB2_2' => array(
						'name' => 'มีภาวะโรคหลอดเลือดสมองและโรคหลอดเลือดส่วนปลายผิดปกติ (ผู้ชาย &lt; 55 ปี, ผู้หญิง &lt; 60 ปี)',
						'score' => '1'
					)
				);
				foreach ($INCLI1_SUB2_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail1" data-score="<?=$v['score'];?>" id="<?=$key;?>" name="INCIL1[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v['name'];?></label></td>
						<td align="center"><?=$v['score'];?></td>
					</tr>
					<?php
				}
				?>
				
				<tr style="font-weight:bold; background-color:#dddddd;">
					<td colspan="3">การตรวจร่างกายคนไข้</td>
				</tr>
				<?php
				$INCLI1_SUB3_items = array(
					'INCLI1_SUB3_1' => array(
						'name' => 'มีภาวะ Tendon Xanthoma',
						'score' => '6'
					),
					'INCLI1_SUB3_2' => array(
						'name' => 'มีภาวะ Corneal arcus โดยคนไข้อายุ &lt; 45 ปี',
						'score' => '4'
					)
				);
				foreach ($INCLI1_SUB3_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail1" data-score="<?=$v['score'];?>" id="<?=$key;?>" name="INCIL1[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v['name'];?></label></td>
						<td align="center"><?=$v['score'];?></td>
					</tr>
					<?php
				}
				?>

				<tr style="font-weight:bold; background-color:#dddddd;">
					<td colspan="3">ระดับ LDL-C ในเลือด</td>
				</tr>
				<?php
				$INCLI1_SUB4_items = array(
					'INCLI1_SUB4_1' => array(
						'name' => '&gt;330 mg/dL (8.5 mmol/L)',
						'score' => '8'
					),
					'INCLI1_SUB4_2' => array(
						'name' => '250–329 mg/dL (6.5–8.5 mmol/L)',
						'score' => '5'
					),
					'INCLI1_SUB4_3' => array(
						'name' => '190–249 mg/dL (4.9–6.4 mmol/L)',
						'score' => '3'
					),
					'INCLI1_SUB4_4' => array(
						'name' => '155–189 mg/dL (4.0–4.9 mmol/L)',
						'score' => '1'
					),
					'INCLI1_SUB4_5' => array(
						'name' => 'มีการกลายพันธุ์ยีนที่ทำงานเกี่ยวกับ LDL-R เช่นยีน  LDL‐R, ApoB, or PCSK9 gene',
						'score' => '8'
					)
				);
				foreach ($INCLI1_SUB4_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail1" data-score="<?=$v['score'];?>" id="<?=$key;?>" name="INCIL1[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v['name'];?></label></td>
						<td align="center"><?=$v['score'];?></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="3" style="text-align:center; font-weight:bold; color:red;">คะแนนในการประเมินต้องมากกว่า 6</td>
				</tr>
			</table>
		</div>
	</div>
	<div style="margin-top:16px;">
		<input type="checkbox" onclick="clickINC2()" class="inputInclisiran" id="inputInclisiran2" name="title[]" value="INCIL2"><label for="inputInclisiran2">2.) ผู้ป่วยที่มีภาวะไขมันในเลือดสูง (dyslipidemia) เป็นโรคเบาหวาน (diabetes) ที่มีความเสี่ยงสูง (high risk) ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า &gt; 100 mg/dl</label>
		<div style="display:none;" id="subIncli2">
			<table class="chk_table" style="width:90%; margin: 0 auto;">
				<tr>
					<td colspan="2" style="text-align:center; font-weight:bold; background-color:#dddddd;">เกณฑ์ประเมินโรคเบาหวาน (diabetes) ที่มีความเสี่ยงสูง (high risk)</td>
				</tr>
				<?php
				$INCLI2_SUB_items = array(
					'INCLI2_SUB_1'=>'มี Target organ damage',
					'INCLI2_SUB_2'=>'เป็นมามากกว่า 10 ปี',
					'INCLI2_SUB_3'=>'มี coronary calcium score ≥ 1,000 หรือ มีประวัติครอบครัวเป็นภาวะ Premature atherosclerosis (ผู้ชาย < 55 ปี, ผู้หญิง < 60 ปี)'
				);
				foreach ($INCLI2_SUB_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail2" id="<?=$key;?>" name="INCIL2[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v;?></label></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<div style="margin-top:16px;">
		<input type="checkbox" onclick="clickINC3()" class="inputInclisiran" id="inputInclisiran3" name="title[]" value="INCIL3"><label for="inputInclisiran3">3.) ผู้ป่วยที่เป็นโรคหัวใจ (Clinical ASCVD) ที่มีสาเหตุมาจากหลอดเลือดแดงแข็ง (Established atherosclerotic cardiovascular disease) และอยู่ในกลุ่มความเสี่ยงสูงมาก (very high risk) ที่ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า > 70 mg/dl</label>
		<div style="display:none;" id="subIncli3">
			<table class="chk_table" style="width:90%; margin: 0 auto;">
				<tr>
					<td colspan="2" style="text-align:center; font-weight:bold; background-color:#dddddd;">เกณฑ์ประเมิณกลุ่มคนไข้ที่มีความเสี่ยงสูงมาก (very high risk )</td>
				</tr>
				<?php
				$INCLI3_SUB_items = array(
					'INCLI3_SUB_1'=>'มีประวัติ major ASCVD events หลายครั้ง',
					'INCLI3_SUB_2'=>'มีประวัติ major ASCVD events 1 ครั้ง + กลุ่มภาวะความเสี่ยงสูง (high risk condition)',
				);
				foreach ($INCLI3_SUB_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail3" id="<?=$key;?>" name="INCIL3[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v;?></label></td>
					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan="2" style="text-align:center; font-weight:bold; color:red;">การประเมินข้อนี้ต้องทำการประเมินในข้อที่ 4 ด้วย</td>
				</tr>
			</table>
		</div>
	</div>

	<div style="margin-top:16px;">
		<input type="checkbox" onclick="clickINC4()" class="inputInclisiran" id="inputInclisiran4" name="title[]" value="INCIL4"><label for="inputInclisiran4">4.) ผู้ป่วยที่เป็นโรคหัวใจ (Clinical ASCVD) ที่มีสาเหตุมาจากหลอดเลือดแดงแข็ง (Established atherosclerotic cardiovascular disease) และอยู่ในกลุ่มภาวะความเสี่ยงสูง (high risk condition) ที่ได้รับยาในกลุ่ม statin + ezetimibe + bempedoic acid ขนาดยาสูงสุด เป็นระยะเวลา 3 เดือนแล้ว LDL-C มีค่า > 100 mg/dl</label>
		<div style="display:none;" id="subIncli4">
			<table class="chk_table" style="width:90%; margin: 0 auto;">
				<tr>
					<td colspan="2" style="text-align:center; font-weight:bold; background-color:#dddddd;">เกณฑ์ประเมิณกลุ่มคนไข้ที่มีความเสี่ยงสูง (high risk condition)</td>
				</tr>
				<?php
				$INCLI4_SUB_items = array(
					'INCLI4_SUB_1'=>'มีภาวะ familial hypercholesterolemia (FH)',
					'INCLI4_SUB_2'=>'มีประวัติ Coronary artery by pass surgery หรือ percutaneous coronary intervention และ อย่างน้อยเคยมีประวัติการเกิด ASCVD event(s) ที่มีระยะเกิน 1 ปี และ ไม่มีภาวะแทรกช้อน',
					'INCLI4_SUB_3'=>'เบาหวาน',
					'INCLI4_SUB_4'=>'ไตเรื้อรัง (eGFR 15-59 ml/min/1.73 m2)',
				);
				foreach ($INCLI4_SUB_items as $key => $v) {
					?>
					<tr valign="top">
						<td><input type="checkbox" class="inputInclisiran detail4" id="<?=$key;?>" name="INCIL4[]" value="<?=$key;?>"></td>
						<td><label for="<?=$key;?>"><?=$v;?></label></td>
					</tr>
					<?php
				}
				?>
			</table>
		</div>
	</div>
	<p style="text-align: center;">
		<button type="button" onclick="confirmInclisiran('{{drugcode}}','{{criteriaCode}}','{{criteria}}')" class="button">บันทึกแบบประเมิน</button>&nbsp;<button type="button" onclick="cancelBtnForm()" class="button cancel">ยกเลิก</button>
	</p>
</div>