<?php
// ��һ�����㹡���ʴ����ѹ��� �óշ������� POST
$default_date = ( date('Y') + 543 ).'-'.date('m');
$filter_date = input('fix_date', $default_date);
$filter_category = input('fix_category');

$page = input('page', 1);
?>

<div class="col">
	<div class="cell">
		<h3>��ª��ͼ����ӡ�õ�Ǩ</h3>
		<form action="survey_oral.php" method="post" style="margin: 1em 0;" class="no-print">
			<fieldset>
				<legend>���ҵ��˹�������ѹ���</legend>
				<?php
				
				?>
				<div>
					<label for="fix_date">�ʴ��ŵ���ѹ����Ǩ</label>
					<input type="text" id="fix_date" name="fix_date" value="<?=$filter_date?>">
					<span style="font-size: 12px; ">* �����͹����ѹ��������ʴ��ŷ��੾����Ш��� ������ҧ�� 2558-10-26 �繵�</span>
				</div>
				<div>
					�ʴ��ŵ��˹���
					<?php $sql = "SELECT `id`,`name` FROM `survey_oral_category`"; ?>
					<select name="fix_category" id="">
						<option value="">�ء˹���</option>
						<option value="fix_mtb" <?php echo ( $filter_category == 'fix_mtb' ) ? 'selected="selected"' : ''; ?>>˹��·���� ���.32</option>
						<?php
						$db->select($sql);
						$items = $db->get_items();
						foreach ($items as $key => $item) {
							$select = !empty($filter_category) ? ( $filter_category === $item['id'] ? 'selected="selected"' : '' ) : '' ;
							?><option value="<?php echo $item['id'];?>" <?php echo $select;?>><?php echo $item['name'];?></option><?php
						}
						?>
					</select>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">���͡����ʴ���</button>
						<input type="hidden" name="by" value="section">
					</div>
				</div>
			</fieldset>
		</form>
		<form action="survey_oral.php" method="post" style="margin: 1em 0;" class="no-print">
			<fieldset>
				<legend>���ҵ�� HN</legend>
				<div>
					<label for="hn">HN</label>
					<input type="text" id="hn" name="hn" value="<?=$hn;?>">
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">���͡����ʴ���</button>
						<input type="hidden" name="by" value="hn">
					</div>
				</div>
			</fieldset>
		</form>

		<table class="outline-header border box-header outline">
			<thead>
				<tr>
					<th width="4%">�ӴѺ</th>
					<th width="10%">HN</th>
					<th>����-ʡ��</th>
					<th width="15%">˹���</th>
					<th width="15%">�ѹ���ӡ�õ�Ǩ</th>
					<th align="center" width="10%" class="no-print">�Ѵ��â�����</th>
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
						$sql = "SELECT `id` FROM `survey_oral_category` WHERE `name` LIKE '%���.32%';";
						// $mtb_lists = DB::select($sql);
						$db->select($sql);
						$mtb_lists = $db->get_items();
						
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
				
				$sql = "SELECT a.`id`,a.`hn`,a.`date`,a.`fullname`,b.`name` 
				FROM `survey_oral` AS a 
				LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
				$where_is
				ORDER BY a.`id` DESC";
				// $rows = DB::numRows($sql); // All rows from query
				// $items = DB::select($sql.$limit); // Rows with limit

				$db->select($sql);
				$items = $db->get_items();
				$rows = count($items);

				$i = ( $limit_from > 0 ) ? $limit_from + 1 : 1 ;
				foreach($items as $item){
					
					list($y, $m, $d) = explode('-', $item['date']);
					$th_full_date = $d.' '.$full_months[$m].' '.$y;
				?>
				<tr>
					<td><?php echo $i;?></td>
					<td><a href="survey_oral.php?task=fulldetail&id=<?php echo $item['id'];?>" title="��ԡ���ʹ٢�����Ẻ���"><?php echo $item['hn'];?></a></td>
					<td><?php echo $item['fullname'];?></td>
					<td><?php echo $item['name'];?></td>
					<td><?php echo $th_full_date;?></td>
					<td class="no-print">
						<a href="survey_oral.php?task=form&id=<?php echo $item['id'];?>">���</a> | 
						<a href="survey_oral.php?action=delete&id=<?php echo $item['id'];?>" class="survey_remove">ź</a>
					</td>
				</tr>
				<?php $i++; } ?>
			</tbody>
		</table>
		<?php
		// ��˹��
		$params = "survey_oral.php?fix_date=$filter_date&fix_category=$filter_category";
		// pagination($rows, $page, $params, $limit_at);
		?>
	</div>
</div>