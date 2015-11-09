<?php
$mouth_items = array(
	'1_1' => 'A. �آ�Ҿ��ͧ�ҡ��',
	'2_1' => 'B. ���Թ�ٹ ���˧�͡�ѡ�ʺ',
	'3_1' => 'C. �տѹ�ط���ͧ���Ѻ����ش�ѹ',
	'3_2' => 'D. �տѹ�֡����ͧ���Ѻ����ش�ѹ',
	'3_3' => 'E. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ',
	'4_1' => 'F. �տѹ�ط��������ͷ����ç����ҷ�ѹ/RR',
	'4_2' => 'G. �տѹ�֡���������ͷ����ç����ҷ�ѹ',
	'4_3' => 'H. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹',
	'4_4' => 'I. �տѹ�ش',
	'4_5' => 'J. �٭���¿ѹ��Ш��繵�ͧ���ѹ��᷹',
	'4_6' => 'K. ���ҡ�� �Ǵ,��� ���� / ����ä㹪�ͧ�ҡ',
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
			// ��һ�����㹡���ʴ����ѹ��� �óշ������� POST
			$date = !empty($_POST['date']) ? trim($_POST['date']) : ( date('Y') + 543 ).'-'.date('m') ;
			?>
			<div>
				�ʴ��ŵ���ѹ��� <input type="text" name="date" value="<?php echo isset($_POST['date']) ? $_POST['date'] : $date ;?>">
				<span style="font-size: 12px; ">* �����͹����ѹ��������ʴ��ŷ��੾����Ш��� ������ҧ�� 2558-10-26 �繵�</span>
			</div>
			<div>
				�ʴ��ŵ��˹���
				<?php $sql = "SELECT `id`,`name` FROM `survey_oral_category`"; ?>
				<?php $cattxt_lists = array(); ?>
				<select name="fix_category" id="">
					<option value="">�ء˹���</option>
					<option value="fix_mtb" <?php echo ( $_POST['fix_category'] == 'fix_mtb' ) ? 'selected="selected"' : ''; ?>>˹��·���� ���.32</option>
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
				<button type="submit">���͡����ʴ���</button>
			</div>
		</form>
		
		<?php
		
		if( strpos($date, '-') !== false ){
			$d_list = explode('-', $date);
			if( count($d_list) === 2 ){
				$after_date = ' ��͹ '.$full_months[$d_list['1']];
			} else if( count($d_list) === 3 ){
				$after_date = ' ��͹ '.$full_months[$d_list['1']].' �ѹ��� '.$d_list['2'];
			}
			$at_date = "�� ".$d_list['0'].$after_date;
		}else{ // only year
			$at_date = "�� $date";
		}
		
		$category_text = '';
		if( !empty($_POST['fix_category']) && $_POST['fix_category'] !== 'fix_mtb' ){
			$category_text = '('.$cattxt_lists[$_POST['fix_category']].')';
		}else{
			if( $_POST['fix_category'] === 'fix_mtb' ){
				$category_text = '(˹��·���� ���.32)';
			}
		}
		?>
		<h3>��§ҹ����Ъ�ͧ�ҡ <?php echo $at_date;?> <?php echo $category_text;?></h3>
		<table class="custom-table outline-header border box-header outline width-2of5">
			<thead>
				<tr>
					<th>����Ъ�ͧ�ҡ</th>
					<th align="center" width="10%">�ӹǹ</th>
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
						$sql = "SELECT `id` FROM `survey_oral_category` WHERE `name` LIKE '%���.32%';";
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
					<th>�дѺ�����ع�ç</th>
					<th width="10%">�ӹǹ</th>
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
					<td>�����ع�ç�дѺ <?php echo $vio;?></td>
					<td align="center"><?php echo $item['count'];?></td>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="col" id="print_btn">
			<div class="cell">
				<button onclick="force_print()">��� Print</button>
			</div>
		</div>
		<script type="text/javascript">
		function force_print(){
			window.print();
		}
		</script>
	</div>
</div>