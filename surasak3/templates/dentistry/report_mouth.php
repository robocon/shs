<?php
$mouth_items = array(
	'1_1' => 'A. สุขภาพช่องปากดี',
	'2_1' => 'B. มีหินปูน มีเหงือกอักเสบ',
	'3_1' => 'C. มีฟันผุที่ต้องได้รับการอุดฟัน',
	'3_2' => 'D. มีฟันสึกที่ต้องได้รับการอุดฟัน',
	'3_3' => 'E. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด',
	'4_1' => 'F. มีฟันผุที่ใกล้หรือทะลุโพรงประสาทฟัน/RR',
	'4_2' => 'G. มีฟันสึกที่ใกล้หรือทะลุโพรงประสาทฟัน',
	'4_3' => 'H. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน',
	'4_4' => 'I. มีฟันคุด',
	'4_5' => 'J. สูญเสียฟันและจำเป็นต้องใส่ฟันทดแทน',
	'4_6' => 'K. มีอาการ ปวด,บวม อื่นๆ / รอยโรคในช่องปาก',
);
?>
<style>
	@media print{
		table.custom-table{
			width: 100% !important;
		}
	}
</style>
<div class="col">
	<div class="cell">
		
		<form action="survey_oral.php?task=report_mouth" method="post" style="margin: 1em 0;" class="no-print">
			<?php
			// ค่าปริยายในการแสดงผลวันที่ กรณีที่ไม่มี POST
			$date = !empty($_POST['date']) ? trim($_POST['date']) : ( date('Y') + 543 ).'-'.date('m') ;
			?>
			<div>
				แสดงผลตามวันที่ <input type="text" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : $date ;?>">
				<span style="font-size: 12px; ">* ใส่เดือนและวันที่เพื่อแสดงผลที่เฉพาะเจาะจงได้ ตัวอย่างเช่น 2558-10-26 เป็นต้น</span>
			</div>
			<div>
				แสดงผลตามหน่วย
				<?php $sql = "SELECT `id`,`name` FROM `survey_oral_category`"; ?>
				<?php $cattxt_lists = array(); ?>
				<select name="fix_category" id="">
					<option value="">ทุกหน่วย</option>
					<option value="fix_mtb" <?php echo ( $_POST['fix_category'] == 'fix_mtb' ) ? 'selected="selected"' : ''; ?>>หน่วยที่เป็น มทบ.32</option>
					<?php
					$items = DB::select($sql);
					foreach ($items as $key => $item) {
						$select = !empty($_POST['fix_category']) ? ( $_POST['fix_category'] === $item['id'] ? 'selected="selected"' : '' ) : '' ;
						?><option value="<?php echo $item['id'];?>" <?php echo $select;?>><?php echo $item['name'];?></option><?php
						$cattxt_lists[$item['id']] = $item['name'];
					}
					?>
				</select>
			</div>
			<div>
				<button type="submit">เลือกการแสดงผล</button>
			</div>
		</form>
		
		<?php
		
		if( strpos($date, '-') !== false ){
			$d_list = explode('-', $date);
			if( count($d_list) === 2 ){
				$after_date = ' เดือน '.$full_months[$d_list['1']];
			} else if( count($d_list) === 3 ){
				$after_date = ' เดือน '.$full_months[$d_list['1']].' วันที่ '.$d_list['2'];
			}
			$at_date = "ปี ".$d_list['0'].$after_date;
		}else{ // only year
			$at_date = "ปี $date";
		}
		
		$category_text = '';
		if( !empty($_POST['fix_category']) && $_POST['fix_category'] !== 'fix_mtb' ){
			$category_text = '('.$cattxt_lists[$_POST['fix_category']].')';
		}else{
			if( $_POST['fix_category'] === 'fix_mtb' ){
				$category_text = '(หน่วยที่เป็น มทบ.32)';
			}
		}
		?>
		<h3>รายงานสภาวะช่องปาก <?php echo $at_date;?> <?php echo $category_text;?></h3>
		<table class="custom-table outline-header border box-header outline width-2of5">
			<thead>
				<tr>
					<th>สภาวะช่องปาก</th>
					<th align="center" width="10%">จำนวน</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$where_is = '';
				$filter_category = !empty($_POST['fix_category']) ? $_POST['fix_category'] : false ;
				if( $filter_category !== false ){
					if( $filter_category !== 'fix_mtb'){
						$where[] = " `section` = '$filter_category'";
					}else{
						$sql = "SELECT `id` FROM `survey_oral_category` WHERE `name` LIKE '%มทบ.32%';";
						$mtb_lists = DB::select($sql);
						
						$set_mtb_where = array();
						foreach($mtb_lists AS $key => $list){
							$set_mtb_where[] = "'".$list['id']."'";
						}
						$test = implode(',', $set_mtb_where);
						$where[] = " `section` IN ($test) ";
					}
					
					$where_is = ' AND '.implode(' AND ', $where);
				}
					
				?>
				<?php foreach($mouth_items as $key => $mouth): ?>
				<?php
				$sql = "SELECT COUNT(`hn`) AS `count` 
				FROM `survey_oral` 
				WHERE `date` LIKE '$date%' 
				AND `mouth_detail` LIKE '%$key\";i:1%'
				$where_is
				";
				$item = DB::select($sql, null, true);
				?>
				<tr>
					<td><?php echo $mouth;?></td>
					<td align="center"><?php echo $item['count'];?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<br>
		<?php 
		$violences = array(1,2,3,4);
		?>
		<table class="custom-table outline-header border box-header outline width-2of5">
			<thead>
				<tr>
					<th>ระดับความรุนแรง</th>
					<th width="10%">จำนวน</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach($violences as $key => $vio): ?>
				<?php
				$sql = "
				SELECT COUNT(`hn`) AS `count` 
				FROM `survey_oral` 
				WHERE `date` LIKE '$date%' 
				AND `max_status` = '$vio'
				$where_is
				";
				$item = DB::select($sql, null, true);
				?>
				<tr>
					<td>ความรุนแรงระดับ <?php echo $vio;?></td>
					<td align="center"><?php echo $item['count'];?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="col" id="print_btn">
			<div class="cell">
				<button onclick="force_print()">สั่ง Print</button>
			</div>
		</div>
		<script type="text/javascript">
		function force_print(){
			window.print();
		}
		</script>
	</div>
</div>