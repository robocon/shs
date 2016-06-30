<?php

include 'bootstrap.php';

$db = Mysql::load();


include 'templates/classic/header.php';
?>
<div class="col no-print">
    <div class="cell">
		<a href="../nindex.htm">&lt;&lt; ˹����ѡ����� þ.</a>
    </div>
</div>
<?php

/**
 * @todo
 * [] �Ѵ��Ҥ���ͧ ptright �͡���� value
 * [] ��� Statement ��ҹ���������
 */


?>
<div class="col">
    <div class="cell">
		<form action="popuckai_read.php" method="post">
			<div class="col">
				<div class="cell">
				<?php

				$pt_code = input_post('pt_code');
				$sql = "SELECT `code`,`name` FROM `ptright`";
				$db->select($sql);
				$items = $db->get_items();
				?>
					<label for="pt_code">�Է�ԡ���ѡ��</label>
					<select name="pt_code" id="pt_code">
						<option value="0">�ʴ������ŷ�����</option>
						<?php
						foreach( $items as $key => $item ){
							$select = ( $pt_code === $item['code'] ) ? 'selected="selected"' : '' ;
							?>
							<option <?=$select;?> value="<?=$item['code'];?>"><?=$item['code'].' '.$item['name'];?></option>
							<?php
						}
						?>
					</select>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<button type="sumit">�ʴ�������</button>
					<input type="hidden" name="show" value="list">
				</div>
			</div>
		</form>
	</div>
</div>

<?php
$show = input_post('show');
if( $show === 'list' ){

	$pt_code = input_post('pt_code');
	$where = '';
	if( $pt_code !== '0' ){
		$where = "WHERE b.`ptright1` LIKE :pt_code ";
	}

	$sql = "SELECT b.`idcard`, b.`hn`, b.`yot`, b.`name`, b.`surname`, b.`ptright`, b.`ptright1` 
	FROM `sso30` AS a 
	INNER JOIN `opcard` AS b ON b.`idcard` = a.`idcard` 
	$where
	ORDER BY b.`idcard` ASC ";
	
	$data = array();
	if( $pt_code !== '0' ){
		$data = array(':pt_code' => "$pt_code%");
	}
	
	$db->select($sql, $data);
	$items = $db->get_items();

	if( count($items) > 0 ){
		?>
		<div class="col">
			<div class="cell">
				<h3>��ª��ͼ�����<?='�Է�� '.$pt_code;?> (<?=count($items);?> ��)</h3>
				<table>
					<thead>
						<tr>
							<td>#</td>
							<td>�ѵû�ЪҪ�</td>
							<td>HN</td>
							<td>����-ʡ��</td>
							<td>�Է����ѡ</td>
							<td>�Է�Է����</td>
						</tr>
					</thead>
					<tbody>
					<?php
					$i = 1;
					foreach( $items as $key => $item ){
					?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['idcard'];?></td>
							<td><?=$item['hn'];?></td>
							<td><?=$item['name'];?></td>
							<td><?=$item['ptright'];?></td>
							<td><?=$item['ptright1'];?></td>
						</tr>
					<?php
						$i++;
					}
					?>
					</tbody>
				</table>
			</div>
		</div>
		<?php
	}else{
		?>
		<div class="col">
			<div class="cell">
				<p>����բ�����</p>
			</div>
		</div>
		<?php
	}
}
include 'templates/classic/footer.php';