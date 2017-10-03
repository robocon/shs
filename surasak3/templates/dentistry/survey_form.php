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
	// $item = DB::select($sql, array( ':id' => $id ), true);

	$db->select($sql, array( ':id' => $id ));
	$item = $db->get_item();

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

		if ( $hn !== false ) {
			$sql = "SELECT `hn`,`fullname`,`date`,`yearcheck` FROM `survey_oral` WHERE `hn` = '$hn' ORDER BY `date` DESC LIMIT 1";
			$db->select($sql);
			$oral = $db->get_item();

			$test_year = get_year_checkup();
			if( $test_year == $oral['yearcheck'] ){
				?>
				<div class="notify-warning no-print">
					<?=($oral['fullname']).' เคยบันทึกข้อมูลในรอบปีงบ '.$test_year.' ไปแล้วเมื่อ '.($oral['date'])?>
				</div>
				<?php
			}
		}

		$sql = "SELECT `dbirth`,`hn`,`yot`,`name`,`surname`,`idcard` FROM `opcard` WHERE `hn` = :hn LIMIT 1;";
		$item = $db->get_single($sql, array(':hn' => $hn));
		if( $item !== false ){
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
						$db->select($sql);
						$categories = $db->get_items();
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
							<th class="align-center" width="75%">สภาวะช่องปาก</th>
							<th class="align-center" width="5%">ระดับ</th>
							<th class="align-center" width="20%">คำแนะนำในการรักษา</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<input name="mouth_detail[1_1]" id="1_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['1_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="1_1">A. สุขภาพช่องปากดี</label>
							</td>
							<td class="align-center">1</td>
							<td>ควรมารักษาทุก 6 เดือน</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[2_1]" id="2_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['2_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="2_1">B. มีหินปูน มีเหงือกอักเสบ</label>
							</td>
							<td class="align-center" rowspan="2">2</td>
							<td>ขูดหินปูน</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[2_2]" id="2_2" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['2_2'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="2_2">C. อื่นๆ</label>
								<input type="text" name="mouth_detail[2_2_detail]" class="width-2of5" onclick="document.getElementById('2_2').checked = true" value="<?=$detail['2_2_detail'];?>">
							</td>
							<td class="align-center"></td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[3_1]" id="3_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_1">D. มีฟันผุที่ต้องได้รับการอุดฟัน</label>
							</td>
							<td class="align-center" rowspan="5">3</td>
							<td class="align-left" rowspan="2">อุดฟัน</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[3_2]" id="3_2" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_2'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_2">E. มีฟันสึกที่ต้องได้รับการอุดฟัน</label>
							</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[3_3]" id="3_3" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_3'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_3">F. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
							</td>
							<td>รักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[3_4]" id="3_4" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_4'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_4">G. สูญเสียฟัน และควรใส่ฟันทดแทน</label>
							</td>
							<td>ใส่ฟัน</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[3_5]" id="3_5" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['3_5'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="3_5">H. อื่นๆ</label>
								<input type="text" name="mouth_detail[3_5_detail]" class="width-2of5" onclick="document.getElementById('3_5').checked = true" value="<?=$detail['3_5_detail'];?>">
							</td>
							<td class="align-center"></td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[4_1]" id="4_1" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_1'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_1">I. มีฟันผุที่ใกล้หรือทะลุโพรงประสาทฟัน/RR</label>
							</td>
							<td class="align-center" rowspan="6">4</td>
							<td class="align-left" rowspan="2">อุดฟัน/รักษาคลองรากฟัน/ถอนฟัน</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[4_2]" id="4_2" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_2'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_2">J. มีฟันสึกที่ใกล้หรือทะลุโพรงประสาทฟัน</label>
							</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[4_3]" id="4_3" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_3'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_3">K. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
							</td>
							<td>ถอนฟันและรักษาโรคเหงือก</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[4_4]" id="4_4" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_4'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_4">L. มีฟันคุด</label>
							</td>
							<td>ผ่าฟันคุด</td>
						</tr>
						<tr>
							<td class="tb-bottom-none">
								<input name="mouth_detail[4_5]" id="4_5" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_5'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_5">M. มีอาการ ปวด,บวม อื่นๆ / รอยโรคในช่องปาก</label>
							</td>
							<td>ควรรับการตรวจเพิ่มเติมที่ รพ.</td>
						</tr>
						<tr>
							<td>
								<input name="mouth_detail[4_6]" id="4_6" class="checkbox" type="checkbox" value="1" <?php echo ( $detail['4_6'] == 1 ) ? 'checked="checked"' : '' ;?>>
								<label for="4_6">N. อื่นๆ</label>
								<input type="text" name="mouth_detail[4_6_detail]" class="width-2of5" onclick="document.getElementById('4_6').checked = true" value="<?=$detail['4_6_detail'];?>">
							</td>
							<td></td>
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
<script type="text/javascript">
	
jQuery.noConflict();
(function( $ ) {
$(function() {
	
	// ตรวจสอบว่ามีการเช็กใน checkbox แล้วรึยัง
	function check_radio(){
		var test_check = false;
		$('.checkbox').each(function(){
			if( this.checked === true ){
				test_check = true;
			}
		});
		
		return test_check;
	}
	
	
	if( $('.add_form_btn').length > 0 ){
		
		$(document).on('click', '.add_form_btn', function(){
			
			var do_check = check_radio()
			if( do_check === false ){
				alert('กรุณาเลือกระดับสภาวะช่องปาก');
				return false;
			}
			
			var c = confirm('ยืนยันยืนยันการเพิ่มข้อมูล?');
			if( c == false ){
				return false;
			}
		});
	}
		
	
});
})(jQuery);
</script>