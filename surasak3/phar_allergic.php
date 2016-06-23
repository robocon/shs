<?php
include 'bootstrap.php';

if(authen() === false ){ die('Session ������� <a href="login_page.php">��ԡ�����</a> ���ͷӡ���������к��ա����'); }

###### ��á�зӵ�ҧ� �� ���� ź ��� �������ա���ʴ��Ţͧ View ######
$action = input('action');
if( $action === 'save' ){

	$phar_code = input('phar_code');
	$author = get_session('sOfficer');
	$date_add = get_date_ad();

	$db = Mysql::load();

	// recheck �ա�ͺ
	$sql = "SELECT `row_id` 
	FROM `druglst` 
	WHERE `drugcode` LIKE :drug_code ";
	$data = array(':drug_code' => "$phar_code%");
	$db->select($sql, $data);
	$drug_rows = $db->get_rows();

	$sql = "SELECT `drug_code`
	FROM `allergic_list` 
	WHERE `drug_code` = :drug_code ";
	$data = array(':drug_code' => $phar_code);
	$db->select($sql, $data);
	$allergic_rows = $db->get_rows();

	if( $drug_rows > 0 && $allergic_rows === 0 ){
		$sql = "
		INSERT INTO  `smdb`.`allergic_list` (
		`id` ,`drug_code` ,`date_add` ,`date_edit` ,`author` ,`author_edit` ,`status`
		)
		VALUES (
		NULL ,  :drug_code,  :date_add , NULL ,  :author, NULL ,  '1'
		);";
		$data = array(
			':drug_code' => $phar_code,
			':date_add' => $date_add,
			':author' => $author
		);
		$insert = $db->insert($sql, $data);
		$msg = '�ѹ�֡���������º����';
		if( $insert !== true ){
			$msg = errorMsg('add', $insert['id']);
		}
	}else{
		$msg = '�������ö�ѹ�֡�������� ��سҵ�Ǩ�ͺ��͹����ºѹ�֡�ҵ�Ǵѧ�������������ѧ';
	}


	redirect('phar_allergic.php', $msg);
	exit;

}elseif( $action === 'delete' ){

	$id = input_get('id');
	$db = Mysql::load();
	$sql = "DELETE FROM `allergic_list` 
	WHERE `id` = :item_id LIMIT 1";
	$data = array(':item_id' => $id);
	$delete = $db->delete($sql, $data);

	$msg = 'ź���������º����';
	if( $delete !== true ){
		$msg = errorMsg('delete', $delete['id']);
	}

	redirect('phar_allergic.php', $msg);
	exit;


}elseif( $action === 'search_from_code' ){

	$dcode = input_post('dcode');

	$db = Mysql::load();
	$sql = "SELECT `drugcode`, `genname`
	FROM `druglst` 
	WHERE ( `drugcode` LIKE :drug_code OR `genname` LIKE :gen_name ) ";
	$data = array(':drug_code' => "%$dcode%", ':gen_name' => "%$dcode%");
	$db->select($sql, $data);
	$items = $db->get_items();

	$new_items = array();
	foreach( $items as $key => $item ){
		$new_items[] = '{"drug_code": "'.trim($item['drugcode']).'", "genname": "'.trim($item['genname']).'"}';
	}
	$data = implode(',', $new_items);
	echo '['.$data.']';
	exit;
}




###### ˹�� View ��ҧ� ######
include 'templates/classic/header.php';
?>
<div class="col nav-menu-col">
	<div class="menu cell">
		<ul class="nav clear">
			<li><a href="../nindex.htm">˹����ѡ�����þ.</a></li>
		</ul>
	</div>
</div>
<div class="col nav-menu-col">
	<div class="menu cell">
		<ul class="nav clear">
			<li><a href="phar_allergic.php">��¡�������ع�ç</a></li>
			<li><a href="phar_allergic.php?view=form">��������������</a></li>
			<li><a href="phar_allergic.php?view=user">��ª��ͼ�������ع�ç</a></li>
		</ul>
	</div>
</div>
<?php
// Notification
$msg = get_session('x-msg');
if( isset($msg) ){
	?>
	<div class="notify-warning no-print"><?php echo $msg; ?></div>
	<?php
	set_session('x-msg', NULL);
}

$view = input('view');
if( $view === false ){

	$db = Mysql::load();
	$sql = "SELECT a.`id`,a.`drug_code`, b.`genname` 
	FROM `allergic_list` AS a 
	LEFT JOIN `druglst` AS b ON b.`drugcode` = a.`drug_code`";
	$db->select($sql);
	$items = $db->get_items();
	
	?>
	<div class="col">
		<div class="cell">
			<h3>��ª����ҷ�����ع�ç</h3>
		</div>
	</div>
	<div class="col">
		<div class="cell width-3of5">
			<table>
				<thead>
					<tr>
						<th>#</th>
						<th>����</th>
						<th>Genname</th>
						<th>�Ѵ���</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$i = 1;
					foreach ($items as $key => $item) {
						?>
						<tr>
							<td><?=$i;?></td>
							<td><?=$item['drug_code'];?></td>
							<td><?=$item['genname'];?></td>
							<td align="center"><a href="phar_allergic.php?action=delete&id=<?=$item['id'];?>" class="delete_item">ź</a></td>
						</tr>
						<?php
						$i++;
					}
					?>
				</tbody>
			</table>
		</div>
	</div>
	<script type="text/javascript">
	$(function(){
		$(document).on('click', '.delete_item', function(){
			var c = confirm('�׹�ѹ�����¢�����?');
			if( c === false ){
				return false;
			}
		});
	});
	</script>
	<?php
	
}elseif( $view === 'form' ){
	?>
	<div class="col">
		<div class="cell">
			<h3>Ẻ��������������������ع�ç</h3>
		</div>
	</div>
	<div class="col">
		<div class="cell">
			<form action="phar_allergic.php" method="post">
				<div class="col">
					<div class="cell">
						<label for="phar_code">���Ҩҡ ������ ���� Genname: </label>
						<input type="text" id="phar_code" name="phar_code">
						<div class="width-2of5" id="show_drug_list"></div>
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">�ѹ�֡������</button>
						<input type="hidden" name="action" value="save">
					</div>
				</div>
			</form>
		</div>
	</div>
	<style type="text/css">
	.drug_item{
		padding: 4px;
		cursor: pointer;
	}
	#show_drug_list{
		border: 1px solid #000000;
		display: none;
	}
	.drug_item:hover{
		background-color: #dddddd;
	}
	</style>
	<script type="text/javascript">
	$(function(){

		$(document).on('keyup', '#phar_code', function(){
			var dcode = $(this).val();

			if( dcode.length >= 3 ){
				$.ajax({
					header: 'x-www-form-urlencoded',
					method: 'POST',
					dataType: 'json',
					url: 'phar_allergic.php',
					data: {'dcode': dcode, 'action': 'search_from_code'},
					success: function(msg){

						var html = '';
						html += '<div><h3>���͡��¡����</h3></div>';
						var i = 0;
						for( i; i < msg.length; i++ ){
							
							var item = msg[i];
							html += '<div class="drug_item" data-code="'+item.drug_code+'">';
							html += '<b>'+item.drug_code+'</b>: '+item.genname;
							html += '</div>';
						}

						$('#show_drug_list').html(html);
						$('#show_drug_list').show();
					}
				});
			}
			
		});
		
		$(document).on('click', '.drug_item', function(){
			var drug_name = $(this).attr('data-code');
			$('#phar_code').val(drug_name);
			$('#show_drug_list').hide();
		});
		
	});
	</script>
	<?php
}elseif( $view === 'user' ){
	
	$hn = input_post('user_hn');
	?>
	<form action="phar_allergic.php" method="post">
		<div class="col">
			<div class="cell">
				<label for="user_hn">HN: </label>
				<input type="text" id="user_hn" name="user_hn" value="<?=$hn;?>">
				<div style="font-size: 16px; color: red;">* ������ HN ���ʹ���ª��ͷ�����</div>
			</div>
		</div>
		<div class="col">
			<div class="cell">
				<button type="submit">�ʴ���</button>
				<input type="hidden" name="view" value="user">
				<input type="hidden" name="show" value="list">
			</div>
		</div>
	</form>
	<?php

	$show = input_post('show');
	if( $show === 'list' ){
		$db = Mysql::load();
		$sql = "SELECT a.*, b.`genname`,c.`yot`,c.`name`,c.`surname`
		FROM `phar_allergic` AS a 
		LEFT JOIN `druglst` AS b ON b.`drugcode` LIKE CONCAT(a.`drug_code`, '%') 
		LEFT JOIN `opcard` AS c ON c.`hn` = a.`hn`";
		$data = array();
		if( !empty($hn) ){
			$sql .= ' WHERE a.`hn` = :user_hn ';
			$data = array(':user_hn' => $hn);
		}

		$db->select($sql, $data);
		$items = $db->get_items();
		if( count($items) > 0 ){
			?>
			<div class="col">
				<div class="cell">
					<table>
						<thead>
							<tr>
								<th>#</th>
								<th>�ѹ�á����红�����</th>
								<th>HN</th>
								<th>����</th>
								<th>����</th>
								<th>Genname</th>
							</tr>
						</thead>
						<tbody>
						<?php
						$i = 1;
						foreach ($items as $key => $item) {
						?>
							<tr>
								<td><?=$i;?></td>
								<td><?=$item['date_save'];?></td>
								<td><?=$item['hn'];?></td>
								<td>
									<?=$item['yot'].' '.$item['name'].' '.$item['surname'];?>
								</td>
								<td><?=$item['drug_code'];?></td>
								<td><?=$item['genname'];?></td>
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
					<p>��辺������</p>
				</div>
			</div>
			<?php
		}
	}

}
include 'templates/classic/footer.php';