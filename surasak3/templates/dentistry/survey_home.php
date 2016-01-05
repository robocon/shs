<?php
// ค่าปริยายในการแสดงผลวันที่ กรณีที่ไม่มี POST
$default_date = ( date('Y') + 543 ).'-'.date('m');
$filter_date = input('fix_date', $default_date);
$filter_category = input('fix_category');

$page = input('page', 1);
?>

<div class="col">
	<div class="cell">
		<h3>รายชื่อผู้ที่ทำการตรวจ</h3>
		<form action="survey_oral.php" method="post" style="margin: 1em 0;" class="no-print">
			<fieldset>
				<legend>ค้นหาตามหน่วยและวันที่</legend>
				<?php
				
				?>
				<div>
					<label for="fix_date">แสดงผลตามวันที่ตรวจ</label>
					<input type="text" id="fix_date" name="fix_date" value="<?=$filter_date?>">
					<span style="font-size: 12px; ">* ใส่เดือนและวันที่เพื่อแสดงผลที่เฉพาะเจาะจงได้ ตัวอย่างเช่น 2558-10-26 เป็นต้น</span>
				</div>
				<div>
					แสดงผลตามหน่วย
					<?php $sql = "SELECT `id`,`name` FROM `survey_oral_category`"; ?>
					<select name="fix_category" id="">
						<option value="">ทุกหน่วย</option>
						<option value="fix_mtb" <?php echo ( $filter_category == 'fix_mtb' ) ? 'selected="selected"' : ''; ?>>หน่วยที่เป็น มทบ.32</option>
						<?php
						$items = DB::select($sql);
						foreach ($items as $key => $item) {
							$select = !empty($filter_category) ? ( $filter_category === $item['id'] ? 'selected="selected"' : '' ) : '' ;
							?><option value="<?php echo $item['id'];?>" <?php echo $select;?>><?php echo $item['name'];?></option><?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">เลือกการแสดงผล</button>
						<input type="hidden" name="by" value="section">
					</div>
				</div>
			</fieldset>
		</form>
		<form action="survey_oral.php" method="post" style="margin: 1em 0;" class="no-print">
			<fieldset>
				<legend>ค้นหาตาม HN</legend>
				<div>
					<label for="hn">HN</label>
					<input type="text" id="hn" name="hn" value="<?=$hn;?>">
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">เลือกการแสดงผล</button>
						<input type="hidden" name="by" value="hn">
					</div>
				</div>
			</fieldset>
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
				
				
				if( $by === 'section' OR $by === false ){
					$where_is = "WHERE `date` LIKE '$default_date%'";
					if( !empty($where) ){
						$where_is = 'WHERE '.implode(' AND ', $where);
					}
				}else{
					$where_is = "WHERE a.`hn` = '$hn' ";
				}
				
				// LIMIT
				$limit_from = 0;
				$limit_at = 70;
				$limit = " LIMIT 0, $limit_at";
				if( $page > 1 ){
					$limit_from = ( $page - 1 ) * $limit_at;
					$limit = " LIMIT $limit_from, $limit_at";
				}
				
				$sql = "
				SELECT a.`id`,a.`hn`,a.`date`,a.`fullname`,b.`name` 
				FROM `survey_oral` AS a 
				LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
				$where_is
				ORDER BY a.`id` DESC
				";
				$rows = DB::numRows($sql); // All rows from query
				
				$items = DB::select($sql.$limit); // Rows with limit
				$i = ( $limit_from > 0 ) ? $limit_from + 1 : 1 ;
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
		<?php
		// แบ่งหน้า
		$params = "survey_oral.php?fix_date=$filter_date&fix_category=$filter_category";
		$page = isset($_GET['page']) ? trim($_GET['page']) : false ;
		pagination($rows, $page, $params, $limit_at);
		?>
	</div>
</div>