<div class="col">
	<div class="cell">
		<div>
			<form action="survey_oral.php?action=section_form_save" method="post">
				<h3>เพิ่มชื่อหน่วยงาน</h3>
				<div class="col">
					<label for="section">ชื่อ</label>
					<input type="text" id="section" name="section">
				</div>
				<div class="col">
					<button type="submit">เพิ่ม</button>
				</div>
			</form>
		</div>
		<div class="col"><div class="cell"></div></div>
		<div class="col width-3of5 ">
			<h3>รายชื่อหน่วยงาน</h3>
			<table class="custom-table outline-header border box-header outline">
				<thead>
					<tr>
						<th>ชื่อ</th>
						<th width="20%">จัดการข้อมูล</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "
					SELECT `id`,`name` FROM `survey_oral_category` ORDER BY `id` ASC;
					";
					$items = DB::select($sql);
					foreach($items as $key => $item){
					?>
					<tr>
						<td><?php echo $item['name'];?></td>
						<td>
							<a href="#">แก้ไข</a>
								| 
							<a href="survey_oral.php?action=delete_category&id=<?php echo $item['id'];?>" class="survey_remove">ลบ</a>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
</div>