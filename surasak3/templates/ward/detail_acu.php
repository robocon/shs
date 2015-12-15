<?php if( !defined('WARD_STAT') ) die ('Invalid') ?>
<?php

if( $id !== false ){
	list($th_year, $this_month) = explode('-', $item['date_write']);
	$patient = unserialize($item['patient_num']);
	$porjai = unserialize($item['porjai']);
	
}else{
	$th_year = date('Y') + 543 ;
	$patient = array();
	$porjai = array();
}

?>
<div class="col">
	<div class="cell">
		<div class="col">
			<div class="cell">
				<p>( 10 ) รายงานผู้มารับบริการฝังเข็มจำแนกตามสาเหตุป่วยและความพอใจของผู้มารับบริการฝังเข็ม( รง.ผสต.10 )</p>
			</div>
		</div>			
		
		<div class="col">
			<div class="cell">
				หน่วยงาน<span class="box-underline">ฝังเข็ม</span>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				ประจำเดือน<span class="box-underline"><?=getMonthValue($this_month);?></span>
				ปี<span class="box-underline"><?=$th_year;?></span>
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
							<th colspan="2" width="14%">จำนวนผู้ป่วย( ราย )</th>
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
							<td align="center"><?=$patient['1_1'];?></td>
							<td align="center"><?=$patient['1_2'];?></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>เนื้องอกรวมมะเร็ง(Neoplasms)</td>
							<td align="center"><?=$patient['2_1'];?></td>
							<td align="center"><?=$patient['2_2'];?></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>โรคเลือดและอวัยวะสร้างเลือด และความผิดปกติเกี่ยวกับภูมิคุ้มกัน(Diseases of the blood and blood forming organs and certian disonders involving the immune mechanism)</td>
							<td align="center"><?=$patient['3_1'];?></td>
							<td align="center"><?=$patient['3_2'];?></td>
						</tr>
						<tr>
							<td align="center">4</td>
							<td>โรคเกี่ยวกับต่อมไร้ท่อ โภชนาการ และเมตะบอลิซึม(Endocrine, nutritional and metabolic diseases)</td>
							<td align="center"><?=$patient['4_1'];?></td>
							<td align="center"><?=$patient['4_2'];?></td>
						</tr>
						<tr>
							<td align="center">5</td>
							<td>ภาวะแปรปรวนทางจิตและพฤติกรรม(Mental and behavioural disorders)</td>
							<td align="center"><?=$patient['5_1'];?></td>
							<td align="center"><?=$patient['5_2'];?></td>
						</tr>
						<tr>
							<td align="center">6</td>
							<td>โรคระบบประสาท(Diseases of the nervous system)</td>
							<td align="center"><?=$patient['6_1'];?></td>
							<td align="center"><?=$patient['6_2'];?></td>
						</tr>
						<tr>
							<td align="center">7</td>
							<td>โรคตารวมส่วนประกอบของตา(Diseases of the eye and adnexa)</td>
							<td align="center"><?=$patient['7_1'];?></td>
							<td align="center"><?=$patient['7_2'];?></td>
						</tr>
						<tr>
							<td align="center">8</td>
							<td>โรคหูและปุ่มกกหู(Diseases of the ear and mastoid process)</td>
							<td align="center"><?=$patient['8_1'];?></td>
							<td align="center"><?=$patient['8_2'];?></td>
						</tr>
						<tr>
							<td align="center">9</td>
							<td>โรคระบบไหลเวียนเลือด(Diseases of the cirenlatory system)</td>
							<td align="center"><?=$patient['9_1'];?></td>
							<td align="center"><?=$patient['9_2'];?></td>
						</tr>
						<tr>
							<td align="center">10</td>
							<td>โรคระบบหายใจ(Diseases of the respiratory system)</td>
							<td align="center"><?=$patient['10_1'];?></td>
							<td align="center"><?=$patient['10_2'];?></td>
						</tr>
						<tr>
							<td align="center">11</td>
							<td>โรคระบบย่อยอาหาร รวมโรคในช่องปาก(Diseases fo the digestive system)</td>
							<td align="center"><?=$patient['11_1'];?></td>
							<td align="center"><?=$patient['11_2'];?></td>
						</tr>
						<tr>
							<td align="center">12</td>
							<td>โรคผิวหนังและเนื้อเยื่อใต้ผิวหนัง(Diseases of the skin and subcutaneons tissue)</td>
							<td align="center"><?=$patient['12_1'];?></td>
							<td align="center"><?=$patient['12_2'];?></td>
						</tr>
						<tr>
							<td align="center">13</td>
							<td>โรคระบบกล้ามเนื้อ รวมโครงร่าง และเนื้อยึดเสริม(Diseases of the muscnloskeletal system and connective tissue)</td>
							<td align="center"><?=$patient['13_1'];?></td>
							<td align="center"><?=$patient['13_2'];?></td>
						</tr>
						<tr>
							<td align="center">14</td>
							<td>โรคสืบพันธุ์ร่วมปัสสาวะ(Diseases of the genitourinary system)</td>
							<td align="center"><?=$patient['14_1'];?></td>
							<td align="center"><?=$patient['14_2'];?></td>
						</tr>
						<tr>
							<td align="center">15</td>
							<td>อาการ, อาการแสดงและสิ่งผิดปกติที่พบได้จากการตรวจทางคลินิกและทางห้องปฏิบัติการที่ไม่สามารถจำแนกโรคในกลุ่มอื่นได้(Symptoms, signs and abnormal clinical and laboratory findings, not elsewhere classified)</td>
							<td align="center"><?=$patient['15_1'];?></td>
							<td align="center"><?=$patient['15_2'];?></td>
						</tr>
						<tr>
							<td align="center">16</td>
							<td>สาเหตุป่วยอื่นๆ ที่มิได้จัดจำแนกไว้ในกลุ่มที่ 1-15 ดังกล่าวข้างต้น</td>
							<td align="center"><?=$patient['16_1'];?></td>
							<td align="center"><?=$patient['16_2'];?></td>
						</tr>
						<tr>
							<td align="center" colspan="2">รวมทั้งสิ้น</td>
							<td align="center">
								<?php
								$sum = ( $patient['1_1'] + $patient['2_1'] + $patient['3_1'] + $patient['4_1'] + $patient['5_1'] + $patient['6_1'] + $patient['7_1'] + $patient['8_1'] + $patient['9_1'] + $patient['10_1'] + $patient['11_1'] + $patient['12_1'] + $patient['13_1'] + $patient['14_1'] + $patient['15_1'] + $patient['16_1'] );
								echo $sum;
								?>
							</td>
							<td align="center">
								<?php
								$sum = ( $patient['1_2'] + $patient['2_2'] + $patient['3_2'] + $patient['4_2'] + $patient['5_2'] + $patient['6_2'] + $patient['7_2'] + $patient['8_2'] + $patient['9_2'] + $patient['10_2'] + $patient['11_2'] + $patient['12_2'] + $patient['13_2'] + $patient['14_2'] + $patient['15_2'] + $patient['16_2'] );
								echo $sum;
								?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col">
			<!-- แบ่งหน้าเวลา print -->
			<div class="cell" style="page-break-before: always;"></div>
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
							<th colspan="3" width="28%">ระดับความพึงพอใจ</th>
						</tr>
						<tr>
							<th width="8%">พึงพอใจมาก</th>
							<th width="8%">พึงพอใจปานกลาง</th>
							<th width="8%">พึงพอใจน้อย</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td align="center">1</td>
							<td>ความพึงพอใจของผู้ป่วยที่มารับบริการฝังเข็มต่อการให้บริการของเจ้าหน้าที่</td>
							<td align="center"><?php echo ( $porjai['porjai1'] === '3' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai1'] === '2' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai1'] === '1' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
						</tr>
						<tr>
							<td align="center">2</td>
							<td>ความพึงพอใจของผู้ป่วยที่มารับบริการฝังเข็มต่อแพทย์ผู้ให้การรักษา</td>
							<td align="center"><?php echo ( $porjai['porjai2'] === '3' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai2'] === '2' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai2'] === '1' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
						</tr>
						<tr>
							<td align="center">3</td>
							<td>ความพึงพอใจของผู้มารับบริการฝังเข็มต่อผลการบรรเทาอาการเจ็บป่วยด้วยการฝังเข็ม</td>
							<td align="center"><?php echo ( $porjai['porjai3'] === '3' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai3'] === '2' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
							<td align="center"><?php echo ( $porjai['porjai3'] === '1' ) ? '<img src="assets/img/ward/check.png" style="width: 16px">' : '' ; ?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
<button class="no-print" onclick="on_print()">สั่ง Print</button>
<script type="text/javascript">
	function on_print(){ window.print(); }
</script>