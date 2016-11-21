<?php
$mouth_items = array(
	'1_1' => 'A. �آ�Ҿ��ͧ�ҡ��',
	'2_1' => 'B. ���Թ�ٹ ���˧�͡�ѡ�ʺ',
	'2_2' => 'C. ����',
	'3_1' => 'D. �տѹ�ط���ͧ���Ѻ����ش�ѹ',
	'3_2' => 'E. �տѹ�֡����ͧ���Ѻ����ش�ѹ',
	'3_3' => 'F. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ',
	'3_4' => 'G. �٭���¿ѹ ��Ф�����ѹ��᷹',
	'3_5' => 'H. ����',
	'4_1' => 'I. �տѹ�ط��������ͷ����ç����ҷ�ѹ/RR',
	'4_2' => 'J. �տѹ�֡���������ͷ����ç����ҷ�ѹ',
	'4_3' => 'K. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹',
	'4_4' => 'L. �տѹ�ش',
	'4_5' => 'M. ���ҡ�� �Ǵ,��� ���� / ����ä㹪�ͧ�ҡ',
	'4_6' => 'N. ����'
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
				<span style="font-size: 12px;">* �����͹����ѹ��������ʴ��ŷ��੾����Ш��� ������ҧ�� 2558-10-26 �繵�</span>
			</div>
			<div>
				�ʴ��ŵ��˹���
				<?php $sql = "SELECT `id`,`name` FROM `survey_oral_category`"; ?>
				<?php $cattxt_lists = array(); ?>
				<select name="fix_category" id="">
					<option value="">�ء˹���</option>
					<option value="fix_mtb" <?php echo ( $_POST['fix_category'] == 'fix_mtb' ) ? 'selected="selected"' : ''; ?>>˹��·���� ���.32</option>
					<?php
					$db->select($sql);
					$items = $db->get_items();
					
					$section_lists = array();
					foreach ($items as $key => $item) {
						$select = !empty($_POST['fix_category']) ? ( $_POST['fix_category'] === $item['id'] ? 'selected="selected"' : '' ) : '' ;
						?><option value="<?php echo $item['id'];?>" <?php echo $select;?>><?php echo $item['name'];?></option><?php
						$cattxt_lists[$item['id']] = $item['name'];
						$section_lists[$item['id']] = $item['name'];
					}
					?>
				</select>
			</div>
				<button type="submit">���͡����ʴ���</button>
				<input type="hidden" name="show" value="true">
			</div>
		</form>
		<?php
		
		$show = input('show');
		if( $show !== false ){
			
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
					
				$total = 0;
				foreach($mouth_items as $key => $mouth):
					$sql = "SELECT COUNT(`hn`) AS `count` 
					FROM `survey_oral` 
					WHERE `date` LIKE '$date%' 
					AND `mouth_detail` LIKE '%$key\";i:1%'
					$where_is
					";
					// $item = DB::select($sql, null, true);
					$db->select($sql);
					$item = $db->get_item();
					$total += (int) $item['count'];
					?>
					<tr>
						<td><?php echo $mouth;?></td>
						<td align="center"><?php echo $item['count'];?></td>
					</tr>
				<?php 
				endforeach; 
				?>
				<tr>
					<td><b>�ʹ������</b></td>
					<td align="center"><b><?=$total;?></b></td>
				</tr>
			</tbody>
		</table>
		<br>
		<?php 
		$violences = array(1 => '�дѺ 1 �آ�Ҿ��ͧ�ҡ�� ����տѹ�� ������Թ�ٹ ����ҵ�Ǩ�����������',
		'�дѺ 2 ����տѹ�ط���ͧ�ش ���Թ�ٹ��������ä��Էѹ�� ������Ѻ��÷Ӥ������Ҵ��ͧ�ҡ��Ф��й�㹡�ô����آ�Ҿ��ͧ�ҡ',
		'�дѺ 3 �տѹ�� ���ä��Էѹ�� ��������ҡ���ʴ� ������Ѻ����ѡ������ 12 ��͹',
		'�дѺ 4 �ѹ�ط����ç����ҷ �ѹ���ä��Էѹ�� ���ҡ���ʴ��ѹ�¡ �Ǵ �˧�͡�����˹ͧ �ҡ�ѹ��ҧ �ѹ�ش����ҡ�㹪�ͧ�ҡ ������Ѻ����ѡ����觴�ǹ');
		?>
		<table class="custom-table outline-header border box-header outline width-2of5">
			<thead>
				<tr>
					<th>�дѺ�����ع�ç</th>
					<th width="10%">�ӹǹ</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$year_checkup = get_year_checkup(true);
				$sh_year = get_year_checkup();
				$cat = 'n';
				if( $filter_category !== false ){
					$cat = $filter_category;
				}
				$total = 0;
				foreach($violences as $key => $vio):
					
					$sql = "SELECT COUNT(`hn`) AS `count` 
					FROM `survey_oral` 
					WHERE `date` LIKE '$date%' 
					AND `max_status` = '$key' 
					AND `section` = '$filter_category'";
					$db->select($sql);
					$item = $db->get_item();
					// $item = DB::select($sql, null, true);
					$total += (int) $item['count'];
					?>
					<tr>
						<td><?=$vio;?></td>
						<td align="center">
							<a href="survey_oral.php?task=hn_lists&date=<?=$date;?>&category=<?=$cat;?>&max=<?=$key;?>&yearcheck=<?=$year_checkup;?>" target="_blank"><?=$item['count'];?></a>
						</td>
					</tr>
					<?php
				endforeach;

				$sql = "DROP TEMPORARY TABLE IF EXISTS `condxso_tmp`; 
				CREATE TEMPORARY TABLE `condxso_tmp` 
				SELECT * FROM `condxofyear_so`; ";
				mysql_query($sql);
				
				$sql = "DROP TEMPORARY TABLE IF EXISTS `survey_tmp`; 
				CREATE TEMPORARY TABLE `survey_tmp` 
				SELECT b.`hn` FROM `survey_oral` AS b 
				WHERE b.`yearcheck` = '$sh_year' 
				GROUP BY b.`hn` ;";
				mysql_query($sql);
				
				$sql = "SELECT COUNT(c.`hn`) AS `rows` 
				FROM `condxso_tmp` AS c 
				WHERE c.`yearcheck` LIKE  '$year_checkup' ";
				
				if( $filter_category !== false ){
					$sql .= "AND c.`camp` LIKE '%{$section_lists[$filter_category]}%' ";
				}
				
				$sql .= "AND c.`hn` NOT IN (
					SELECT b.`hn` FROM `survey_tmp` AS b
				)";
				$item = DB::select($sql, null, true);
				// �ҵ�Ǩ��� OPD ��������Ǩ�ѹ

				/*
				?>
				<tr>
					<td>�дѺ 5 ����բ�����(������Ѻ��õ�Ǩ�آ�Ҿ��ͧ�ҡ)</td>
					<td align="center">
					<?php 
					if( $item['rows'] > 0 ){
						?><a href="survey_oral.php?task=hn_lists&date=<?=$date;?>&category=<?=$cat;?>&max=5&yearcheck=<?=$year_checkup;?>&shyear=<?=$sh_year;?>" target="_blank"><?=$item['rows'];?></a><?php
						$total += $item['rows'];
					}else{
						echo '-';
					}
					?>
					</td>
				</tr>
				<?php
				*/
				?>
				<tr>
					<td><b>�ʹ������</b></td>
					<td align="center"><b><?=$total;?></b></td>
				</tr>
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
		<?php } // End if show ?>
	</div>
</div>