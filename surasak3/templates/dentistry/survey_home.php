<div class="col">
	<div class="cell">
		<h3>รายชื่อผู้ที่ทำการตรวจ</h3>
		<form action="survey_oral.php" method="post" style="margin: 1em 0;" class="no-print">
			<?php
			// ค่าปริยายในการแสดงผลวันที่ กรณีที่ไม่มี POST
			$default_date = ( date('Y') + 543 ).'-'.date('m');
			?>
			<div>
				แสดงผลตามวันที่ตรวจ <input type="text" name="fix_date" value="<?php echo isset($_POST['fix_date']) ? $_POST['fix_date'] : $default_date ;?>">
				<span style="font-size: 12px; ">* ใส่เดือนและวันที่เพื่อแสดงผลที่เฉพาะเจาะจงได้ ตัวอย่างเช่น 2558-10-26 เป็นต้น</span>
			</div>
			<div>
				แสดงผลตามหน่วย
				<?php $sql = "SELECT `id`,`name` FROM `survey_oral_category`"; ?>
				<select name="fix_category" id="">
					<option value="">ทุกหน่วย</option>
					<option value="fix_mtb" <?php echo ( $_POST['fix_category'] == 'fix_mtb' ) ? 'selected="selected"' : ''; ?>>หน่วยที่เป็น มทบ.32</option>
					<?php
					$items = DB::select($sql);
					foreach ($items as $key => $item) {
						$select = !empty($_POST['fix_category']) ? ( $_POST['fix_category'] === $item['id'] ? 'selected="selected"' : '' ) : '' ;
						?><option value="<?php echo $item['id'];?>" <?php echo $select;?>><?php echo $item['name'];?></option><?php
					}
					?>
				</select>
			</div>
			<div>
				<button type="submit">เลือกการแสดงผล</button>
			</div>
		</form>
		<table class="outline-header border box-header outline">
			<thead>
				<tr>
					<th width="4%">ลำดับ</th>
					<th width="10%">HN</th>
					<th>ชื่อ-สกุล</th>
					<th width="15%">หน่วย</th>
					<th width="15%">วันที่ทำการตรวจ</th>
					<th align="center" width="10%" class="no-print">จัดการข้อมูล</th>
				</tr>
			</thead>
			<tbody>
				<?php 
					$filter_date = !empty($_POST['fix_date']) ? trim($_POST['fix_date']) : false ;
					$filter_category = !empty($_POST['fix_category']) ? $_POST['fix_category'] : false ;
					
					$where = array();
					if( $filter_date ){
						$where[] = " a.`date` LIKE '$filter_date%'";
					}
					
					$where_category = '';
					if( $filter_category ){
						
						if( $filter_category !== 'fix_mtb'){
							$where[] = " a.`section` = '$filter_category'";
						}else{
							$sql = "
							SELECT `id` FROM `survey_oral_category` WHERE `name` LIKE '%มทบ.32%';
							";
							$mtb_lists = DB::select($sql);
							
							$set_mtb_where = array();
							foreach($mtb_lists AS $key => $list){
								$set_mtb_where[] = "'".$list['id']."'";
							}
							$test = implode(',', $set_mtb_where);
							$where[] = " a.`section` IN ($test) ";
						}
					}
					
					$where_is = "WHERE `date` LIKE '$default_date%'";
					if( !empty($where) ){
						$where_is = 'WHERE '.implode(' AND ', $where);
					}
				
					$sql = "
					SELECT a.`id`,a.`hn`,a.`date`,a.`fullname`,b.`name` 
					FROM `survey_oral` AS a 
					LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
					$where_is
					ORDER BY a.`id` DESC;
					";
					$items = DB::select($sql);
					
					$i = 1;
					foreach($items as $item){
						
						list($y, $m, $d) = explode('-', $item['date']);
						$th_full_date = $d.' '.$full_months[$m].' '.$y;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><a href="survey_oral.php?task=fulldetail&id=<?php echo $item['id'];?>" title="คลิกเพื่อดูข้อมูลแบบเต็ม"><?php echo $item['hn'];?></a></td>
					<td><?php echo $item['fullname'];?></td>
					<td><?php echo $item['name'];?></td>
					<td><?php echo $th_full_date;?></td>
					<td class="no-print">
						<a href="survey_oral.php?task=form&id=<?php echo $item['id'];?>">แก้ไข</a> | 
						<a href="survey_oral.php?action=delete&id=<?php echo $item['id'];?>" class="survey_remove">ลบ</a>
					</td>
				</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
	</div>
</div>