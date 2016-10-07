<?php
if( !defined('_SURVEY') ) die('access deny');

// Default value is for save
$def_action = 'section_form_save';
$title = 'เพิ่มชื่อหน่วยงาน';
if( $id !== false ){
	$def_action = 'section_form_edit';
	$title = 'แก้ไขชื่อหน่วยงาน';
}
?>
<div class="col">
	<div class="cell">
		<div>
			<form action="survey_oral.php" method="post" id="adminForm">
				<h3><?=$title;?></h3>
				<div class="col">
					<label for="section">ชื่อ</label>
					<input type="text" id="section" name="section" value="<?=$item['name'];?>">
				</div>
				<div class="col">
					<button type="submit">บันทึกข้อมูล</button>
					<input type="hidden" name="action" value="<?=$def_action?>">
					<?php if( !empty($id) ){ ?>
					<input type="hidden" name="id" value="<?=$id;?>">
					<?php } ?>
				</div>
			</form>
			<script type="text/javascript">
			
				jQuery.noConflict();
				(function( $ ) {
				$(function() {
					
					$(document).on('submit','#adminForm', function(){
						var section = $('#section').val();
						if( section == '' ){
							alert('กรุณากรอกชื่อหน่วยงาน');
							return false;
						}
					});
					
				});
				})(jQuery);
				
			</script>
		</div>
		<?php if( empty($id) ){ ?>
		<div class="col"><div class="cell"></div></div>
		<div class="col width-3of5 ">
			<h3>รายชื่อหน่วยงาน</h3>
			<table class="custom-table outline-header border box-header outline">
				<thead>
					<tr>
						<th>ชื่อ</th>
						<th width="14%">จัดการข้อมูล</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$sql = "SELECT `id`,`name` FROM `survey_oral_category` ORDER BY `id` ASC;";
					$db->select($sql);
					$items = $db->get_items();
					foreach($items as $key => $item){
					?>
					<tr>
						<td><?php echo $item['name'];?></td>
						<td align="center">
							<a href="survey_oral.php?task=category_edit&id=<?php echo $item['id'];?>">แก้ไข</a>
								| 
							<?php if( $item['id'] != '71' ): ?>
							<a href="survey_oral.php?action=delete_category&id=<?php echo $item['id'];?>" class="survey_remove">ลบ</a>
							<?php endif; ?>
						</td>
					</tr>
					<?php
					}
					?>
				</tbody>
			</table>
		</div>
		<?php } ?>
	</div>
</div>