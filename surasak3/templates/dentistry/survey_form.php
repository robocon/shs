<?php // include from survey_oral.php ?>
<?php
$title = 'เพิ่ม';
$action = 'save';
$section = false;
$detail = array();
$etc = '';
$writer = false;

$add_by = isset($_SESSION['sRowid']) ? $_SESSION['sRowid'] : false ;

$officers = array(
	'พ.อ.หญิง หนึ่งฤทัย มหายศนันท์',
	'พ.ท.หญิง เกื้อกูล อาชามาส',
	'ร.ต. เกล็ดแก้ว มะโนวงค์',
	'จ.ส.อ. วีระ นาคเอี่ยม'
);

// ถ้ามีการแก้ไข
if( $id !== false ){
	$sql = "SELECT * FROM `survey_oral` WHERE id = :id;";
	$item = DB::select($sql, array( ':id' => $id ), true);
	$hn = $item['hn'];
	
	$title = 'แก้ไข';
	$action = 'save_edit';
	
	$th_date = $item['date'];
	$section = $item['section'];
	$detail = unserialize($item['mouth_detail']);
	$etc = $item['etc'];
	$writer = $item['officer'];
}
?>
<div class="col">
	<div class="cell">
		<h3><?php echo $title;?>ข้อมูลแบบสำรวจสภาวะช่องปาก กำลังพล ทบ.</h3>
		<form action="survey_oral.php?task=form" method="post">
			<div class="col">
				<div>
					<label for="">ค้นหาตามเลขHN: </label><input type="text" name="hn" value="<?php echo $hn;?>">
				</div>
			</div>
			<div class="col">
				<div>
					<button type="submit">ค้นหา</button>
				</div>
			</div>
		</form>
		
		<?php 
		$sql = "SELECT *  FROM `opcard` WHERE `hn` = :hn LIMIT 1;";
		// $item = DB::select($sql, array(':hn' => $hn), true);
		
		$q = mysql_query(str_replace(':hn', "'$hn'", $sql));
		$item = mysql_fetch_assoc($q);
		// var_dump($item);
		if( $item ){
			
			list($y, $m, $d) = explode('-', $item['dbirth']);
			$user_bd = strtotime(( $y - 543 )."-$m-$d") ;
			$age = floor( abs($user_bd - strtotime('now')) / ( 365*60*60*24 ) );
		?>
		<div class="col">
			<div class="cell">
				&nbsp;
			</div>
		</div>
		<h3>รายละเอียดผู้ป่วย</h3>
		<form action="survey_oral.php" method="post">
			<div class="cell">
				<div class="input_form">
					<label for="hn">HN: </label><?php echo $item['hn'];?>
					<input id="hn" name="hn" type="hidden" value="<?php echo $item['hn'];?>">
				</div>
				<div class="input_form"><label for="date">วันที่ตรวจ:</label>&nbsp;<input class="text" id="date" name="date" type="text" value="<?php echo $th_date;?>"></div>
				<div class="input_form">
					<label for="section">หน่วย:</label>&nbsp;
					<select name="section" id="section">
						<?php
							$sql = "SELECT `id`,`name` FROM `survey_oral_category` ORDER BY `id` ASC;";
							$categories = DB::select($sql);
							foreach ($categories as $key => $value) {
								$selected = ( $section == $value['id'] ) ? 'selected="selected"' : '' ;
								?>
								<option value="<?php echo $value['id'];?>" <?php echo $selected;?>><?php echo $value['name'];?></option>
								<?php
							}
						?>
					</select>
				</div>
			</div>
			<div class="cell">
				<div class="input_form">
					<label for="prefix">คำนำหน้า: </label><?php echo $item['yot'];?>
					<input id="prefix" name="prefix" type="hidden" value="<?php echo $item['yot'];?>">
					</div>
				<div class="input_form">
					<label for="firstname">ชื่อ: </label><?php echo $item['name'];?>
					<input id="firstname" name="firstname" type="hidden" value="<?php echo $item['name'];?>">
					</div>
				<div class="input_form">
					<label for="lastname">สกุล: </label><?php echo $item['surname'];?>
					<input id="lastname" name="lastname" type="hidden" value="<?php echo $item['surname'];?>">
					</div>
				
			</div>
			<div class="cell">
				<div class="input_form">
					<label for="age">อายุ: </label><?php echo $age;?> ปี
					<input id="age" name="age" type="hidden" value="<?php echo $age;?>">
				</div>
				<div class="input_form">
					<label for="id_card">เลขบัตรประจำตัวประชาชน: </label><?php echo $item['idcard'];?>
					<input id="id_card" name="id_card" type="hidden" value="<?php echo $item['idcard'];?>">
				</div>
			</div>
			<div >
				<table class="custom-table outline-header border box-header outline">
					<thead>
						<tr>
							<th class="align-center">สภาวะช่องปาก</th>
							<th class="align-center" width="5%">ระดับ</th>
							<th class="align-center" width="15%">คำแนะนำในการรักษา</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input name="mouth_detail[1_1]" id="1_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['1_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="1_1">A. สุขภาพช่องปากดี</label>
							</td>
							<td class="align-center">1</td>
							<td class="align-center">ควรมารักษาทุก 6 เดือน</td>
						</tr>
						
						<tr>
							<td>
								<input name="mouth_detail[2_1]" id="2_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['2_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="2_1">B. มีหินปูน มีเหงือกอักเสบ</label>
							</td>
							<td class="align-center">2</td>
							<td class="align-center">ขูดหินปูน</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[3_1]" id="3_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_1">C. มีฟันผุที่ต้องได้รับการอุดฟัน</label>
							</td>
							<td class="align-center" rowspan="3">3</td>
							<td class="align-center" rowspan="2">อุดฟัน</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[3_2]" id="3_2" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_2'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_2">D. มีฟันสึกที่ต้องได้รับการอุดฟัน</label>
							</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[3_3]" id="3_3" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_3'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_3">E. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
							</td>
							<td class="align-center">รักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_1]" id="4_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_1">F. มีฟันผุที่ใกล้หรือทะลุโพรงประสาทฟัน/RR</label>
							</td>
							<td class="align-center" rowspan="6">4</td>
							<td class="align-center" rowspan="2">อุดฟัน/รักษาคลองรากฟัน/ถอนฟัน</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_2]" id="4_2" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_2'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_2">G. มีฟันสึกที่ใกล้หรือทะลุโพรงประสาทฟัน</label>
							</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_3]" id="4_3" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_3'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_3">H. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
							</td>
							<td class="align-center">ถอนฟันและรักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_4]" id="4_4" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_4'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_4">I. มีฟันคุด</label>
							</td>
							<td class="align-center">ผ่าฟันคุด</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_5]" id="4_5" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_5'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_5">J. สุญเสียฟันและจำเป็นต้องใส่ฟันทดแทน</label>
							</td>
							<td class="align-center">ใส่ฟัน</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_6]" id="4_6" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_6'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_6">K. มีอาการ ปวด,บวม อื่นๆ / รอยโรคในช่องปาก</label>
							</td>
							<td class="align-center">ควรรับการตรวจเพิ่มเติมที่ รพ.</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[5_1]" id="5_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['5_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="5_1">L. ไม่ได้รับการตรวจ</label>
							</td>
							<td class="align-center" >5</td>
							<td class="align-center" >ไม่มีข้อมูล</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col">
				<div class="cell">
					<label for="etc">บันทึกเพิ่มเติม</label>
					<div>
						<textarea name="etc" id="etc" class="col width-3of5" rows="5"><?php echo $etc;?></textarea>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<label>ผู้ตรวจ: </label>
					<select name="officer">
						<?php foreach ($officers as $key => $officer) { ?>
						<?php $selected = ( $writer == $officer ) ? 'selected="selected"' : '' ; ?>
						<option value="<?php echo $officer;?>" <?php echo $selected;?>><?php echo $officer;?></option>
						<?php } ?>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<button type="submit" class="add_form_btn">บันทึกข้อมูล</button>
					<input type="hidden" name="action" value="<?php echo $action;?>">
					<input type="hidden" name="add_by" value="<?php echo $add_by;?>">
					<input type="hidden" name="id" value="<?php echo isset($id) ? $id : false ;?>">
				</div>
			</div>
		</form>
		<?php } ?>
	</div>
</div>