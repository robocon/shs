<?php if( !defined('WARD_STAT') ) die ('Invalid') ?>
<?php


$short_months = array('01' => 'ม.ค.', '02' => 'ก.พ.', '03' => 'มี.ค', '04' => 'เม.ษ.', '05' => 'พ.ค.', '06' => 'มิ.ย.', '07' => 'ก.ค.', '08' => 'ส.ค.', '09' => 'ก.ย.', '10' => 'ต.ค.', '11' => 'พ.ย.', '12' => 'ธ.ค.');

$th_year = date('Y') + 543 ;


?>

<div style="padding: 1em; color: red; font-weight: bold;">กำลังดำเนินการพัฒนาโปรแกรม</div>

<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<p>( 10 ) รายงานผู้มารับบริการฝังเข็มจำแนกตามสาเหตุป่วยและความพอใจของผู้มารับบริการฝังเข็ม( รง.ผสต.10 )</p>
			</div>
		</div>
		
		<form action="ward_stat.php" method="post">
			
		
		<div class="col">
			<div class="cell">
				หน่วยงาน<span class="box-underline">ฝังเข็ม</span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<?php $match = null;?>
				ประจำเดือน <?=getMonthList('date_month', $match);?>
				ปี <input type="text" id="date_year" class="width-1of24" name="date_year" value="<?php echo $th_year;?>">
			</div>
		</div>
		<div class="col">
			<div class="cell">
				( 10.1 ) รายงานจำนวนผู้มารับบริการฝังเข็มจำแนกตามสาเหตุป่วย
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<table>
					<thead>
						<tr >
							<th rowspan="2" width="5%">กลุ่มที่</th>
							<th rowspan="2">สาเหตุป่วย( ชื่อโรค )</th>
							<th colspan="2" width="13%">จำนวนผู้ป่วย( ราย )</th>
						</tr>
						<tr>
							<th>ครั้ง</th>
							<th>ราย</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">1</td>
							<td>โรคติดเชื้อและปรสิต(Certain infectious and parasitic diseases)</td>
							<td><input class="width-3of5" type="text" name="1_1" value=""></td>
							<td><input class="width-3of5" type="text" name="1_2" value=""></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>เนื้องอกรวมมะเร็ง(Neoplasms)</td>
							<td><input class="width-3of5" type="text" name="2_1" value=""></td>
							<td><input class="width-3of5" type="text" name="2_2" value=""></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>โรคเลือดและอวัยวะสร้างเลือด และความผิดปกติเกี่ยวกับภูมิคุ้มกัน(Diseases of the blood and blood forming organs and certian disonders involving the immune mechanism)</td>
							<td><input class="width-3of5" type="text" name="3_1" value=""></td>
							<td><input class="width-3of5" type="text" name="3_2" value=""></td>
						</tr>
						<tr>
							<td align="center">4</td>
							<td>โรคเกี่ยวกับต่อมไร้ท่อ โภชนาการ และเมตะบอลิซึม(Endocrine, nutritional and metabolic diseases)</td>
							<td><input class="width-3of5" type="text" name="4_1" value=""></td>
							<td><input class="width-3of5" type="text" name="4_2" value=""></td>
						</tr>
						<tr>
							<td align="center">5</td>
							<td>ภาวะแปรปรวนทางจิตและพฤติกรรม(Mental and behavioural disorders)</td>
							<td><input class="width-3of5" type="text" name="5_1" value=""></td>
							<td><input class="width-3of5" type="text" name="5_2" value=""></td>
						</tr>
						<tr>
							<td align="center">6</td>
							<td>โรคระบบประสาท(Diseases of the nervous system)</td>
							<td><input class="width-3of5" type="text" name="6_1" value=""></td>
							<td><input class="width-3of5" type="text" name="6_2" value=""></td>
						</tr>
						<tr>
							<td align="center">7</td>
							<td>โรคตารวมส่วนประกอบของตา(Diseases of the eye and adnexa)</td>
							<td><input class="width-3of5" type="text" name="7_1" value=""></td>
							<td><input class="width-3of5" type="text" name="7_2" value=""></td>
						</tr>
						<tr>
							<td align="center">8</td>
							<td>โรคหูและปุ่มกกหู(Diseases of the ear and mastoid process)</td>
							<td><input class="width-3of5" type="text" name="8_1" value=""></td>
							<td><input class="width-3of5" type="text" name="8_2" value=""></td>
						</tr>
						<tr>
							<td align="center">9</td>
							<td>โรคระบบไหลเวียนเลือด(Diseases of the cirenlatory system)</td>
							<td><input class="width-3of5" type="text" name="9_1" value=""></td>
							<td><input class="width-3of5" type="text" name="9_2" value=""></td>
						</tr>
						<tr>
							<td align="center">10</td>
							<td>โรคระบบหายใจ(Diseases of the respiratory system)</td>
							<td><input class="width-3of5" type="text" name="10_1" value=""></td>
							<td><input class="width-3of5" type="text" name="10_2" value=""></td>
						</tr>
						<tr>
							<td align="center">11</td>
							<td>โรคระบบย่อยอาหาร รวมโรคในช่องปาก(Diseases fo the digestive system)</td>
							<td><input class="width-3of5" type="text" name="11_1" value=""></td>
							<td><input class="width-3of5" type="text" name="11_2" value=""></td>
						</tr>
						<tr>
							<td align="center">12</td>
							<td>โรคผิวหนังและเนื้อเยื่อใต้ผิวหนัง(Diseases of the skin and subcutaneons tissue)</td>
							<td><input class="width-3of5" type="text" name="12_1" value=""></td>
							<td><input class="width-3of5" type="text" name="12_2" value=""></td>
						</tr>
						<tr>
							<td align="center">13</td>
							<td>โรคระบบกล้ามเนื้อ รวมโครงร่าง และเนื้อยึดเสริม(Diseases of the muscnloskeletal system and connective tissue)</td>
							<td><input class="width-3of5" type="text" name="13_1" value=""></td>
							<td><input class="width-3of5" type="text" name="13_2" value=""></td>
						</tr>
						<tr>
							<td align="center">14</td>
							<td>โรคสืบพันธุ์ร่วมปัสสาวะ(Diseases of the genitourinary system)</td>
							<td><input class="width-3of5" type="text" name="14_1" value=""></td>
							<td><input class="width-3of5" type="text" name="14_2" value=""></td>
						</tr>
						<tr>
							<td align="center">15</td>
							<td>อาการ, อาการแสดงและสิ่งผิดปกติที่พบได้จากการตรวจทางคลินิกและทางห้องปฏิบัติการที่ไม่สามารถจำแนกโรคในกลุ่มอื่นได้(Symptoms, signs and abnormal clinical and laboratory findings, not elsewhere classified)</td>
							<td><input class="width-3of5" type="text" name="15_1" value=""></td>
							<td><input class="width-3of5" type="text" name="15_2" value=""></td>
						</tr>
						<tr>
							<td align="center">16</td>
							<td>สาเหตุป่วยอื่นๆ ที่มิได้จัดจำแนกไว้ในกลุ่มที่ 1-15 ดังกล่าวข้างต้น</td>
							<td><input class="width-3of5" type="text" name="16_1" value=""></td>
							<td><input class="width-3of5" type="text" name="16_2" value=""></td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		<div class="col">
			<div class="cell"></div>
		</div>
		<div class="col">
			<div class="cell">
				( 10.2 ) ความพึงพอใจของผู้มารับบริการฝังเข็ม
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<table>
					<thead>
						<tr >
							<th rowspan="2" width="5%">ลำดับ</th>
							<th rowspan="2">รายการความพึงพอใจ</th>
							<th colspan="3" width="25%">ระดับความพึงพอใจ</th>
						</tr>
						<tr>
							<th >พึงพอใจมาก</th>
							<th>พึงพอใจปานกลาง</th>
							<th>พึงพอใจน้อย</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">1</td>
							<td>ความพึงพอใจของผู้ป่วยที่มารับบริการฝังเข็มต่อการให้บริการของเจ้าหน้าที่</td>
							<td align="center"><input type="radio" name="porjai1" value="1"></td>
							<td align="center"><input type="radio" name="porjai1" value="1"></td>
							<td align="center"><input type="radio" name="porjai1" value="1"></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>ความพึงพอใจของผู้ป่วยที่มารับบริการฝังเข็มต่อแพทย์ผู้ให้การรักษา</td>
							<td align="center"><input type="radio" name="porjai2" value="1"></td>
							<td align="center"><input type="radio" name="porjai2" value="1"></td>
							<td align="center"><input type="radio" name="porjai2" value="1"></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>ความพึงพอใจของผู้มารับบริการฝังเข็มต่อผลการบรรเทาอาการเจ็บป่วยด้วยการฝังเข็ม</td>
							<td align="center"><input type="radio" name="porjai3" value="1"></td>
							<td align="center"><input type="radio" name="porjai3" value="1"></td>
							<td align="center"><input type="radio" name="porjai3" value="1"></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
		<div class="col">
			<div class="cell">
				<button type="submit">บันทึกข้อมูล</button>
				<?php $do_action = ( !isset($id) OR $id === false ) ? 'acu_save' : 'acu_edit' ;?>
				<input type="hidden" name="action" value="<?=$do_action;?>">
			</div>
		</div>
		</form>
		
	</div>
</div>