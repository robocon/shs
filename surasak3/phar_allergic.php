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
			<li><a href="phar_allergic.php?view=user_start">�����������</a></li>
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
	<form action="phar_allergic.php?view=user" method="post">
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
		
		$data = array();
		$where = '';
		if( !empty($hn) ){
			$where = ' WHERE a.`hn` = :user_hn ';
			$data = array(':user_hn' => $hn);
		}

		$sql = "SELECT a.*, b.`genname`,c.`yot`,c.`name`,c.`surname`
		FROM `phar_allergic` AS a 
		LEFT JOIN `druglst` AS b ON b.`drugcode` LIKE CONCAT(a.`drug_code`, '%') 
		LEFT JOIN `opcard` AS c ON c.`hn` = a.`hn` 
		$where
		ORDER BY `date_save` DESC";

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

} elseif( $view === 'user_start' ){

	$db = Mysql::load();

	// �է�����ҳ�Ѩ�غѹ�繻վ�鹰ҹ
	$def_year = get_year_checkup(true, true);
	
	$year_range = range(2004, $def_year);

	$year_start = input_post('year_start', $def_year);
	$year_end = input_post('year_end', $def_year);

	?>
	<div class="col">
		<div class="cell">

			<fieldset>
				<legend>���͡����ʴ��ŵ���է�����ҳ</legend>
				<form action="phar_allergic.php" method="post">
					<div class="col">
						<div class="cell">
							����� 
							<?php 
							echo getYearList('year_start', true, $year_start, $year_range);
							?>-09-30
							�֧ 
							<?php 
							echo getYearList('year_end', true, $year_end, $year_range);
							?>-10-01
						</div>
					</div>
					<div class="col">
						<div class="cell">
							<button type="submit">�ʴ���</button>
							<input type="hidden" name="view" value="user_start">
							<input type="hidden" name="sub_view" value="show">
							<input type="hidden" name="token" value="<?=generate_token('get_user_phar');?>">
						</div>
					</div>
				</form>
			</fieldset>

		</div>
	</div>
	<?php
	$sub_view = input_post('sub_view');
	if( $sub_view === 'show' ){
		$post_token = input_post('token');

		$valid = check_token($post_token, 'get_user_phar');
		if( !$valid ){
			echo 'Invalid token';
			exit;
		}

		$start_time = ad_to_bc($year_start).'-10-01';
		$end_time = ad_to_bc($year_end).'-09-30';
		$date_range = " ( c.`date` >= '$start_time' AND c.`date` <= '$end_time' )  ";
		
		?>
		<div class="col">
			<div class="cell">
			<?php

			$sql = "SELECT a.`id`, a.`drug_code`, b.`tradname`
			FROM `allergic_list` AS a 
			LEFT JOIN `druglst` AS b ON b.`drugcode` = a.`drug_code` 
			WHERE a.`status` = 1 ;";
			$db->select($sql);
			$items = $db->get_items();

			foreach ($items as $key => $item) {

				$drugcode = $item['drug_code'];

				// select ��ҹ㹨������ª����͡�ҡ�͹
				// ���� select ��ҹ�͡�� filter �ա������ѹ�á������Ѻ���������շ���������ֻ���
				$sql = "SELECT c.* 
				FROM ( 
					SELECT MIN(a.`row_id`) AS `row_id`, a.`drugcode`, a.`date`, SUBSTRING(a.`date`, 1, 10) AS `start_on`, a.`hn`, CONCAT(b.`yot`,' ',b.`name`,' ',b.`surname`) AS `ptname` 
					FROM `drugrx` AS a 
					LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
					WHERE a.`drugcode` LIKE '$drugcode%' 
					AND ( a.`hn` != '' AND a.`hn` IS NOT NULL ) 
					GROUP BY a.`hn`
					ORDER BY `row_id` 
				) AS c 
				WHERE $date_range";
				$db->select($sql);

				?>
				<div class="col">
					<div class="cell">
					
						<h3><?=$item['tradname'];?> (<?=$item['drug_code'];?>)</h3>
						<?php
						$user_rows = $db->get_rows();
						if( $user_rows > 0 ){
						?>
							<table style="width: 600px!important;">
								<thead>
									<tr>
										<th width="10%">#</th>
										<th width="20%">HN</th>
										<th width="40%">����-ʡ��</th>
										<th width="30%">�ѹ�á������Ѻ��</th>
									</tr>
								</thead>
								<tbody>
									<?php

									$users = $db->get_items();
									$i = 1;
									foreach($users AS $user_key => $user){
										// dump($user);
									

										?>
										<tr>
											<td><?=$i;?></td>
											<td><?=$user['hn'];?></td>
											<td><?=$user['ptname'];?></td>
											<td><?=$user['start_on'];?></td>
										</tr>
										<?php
										$i++;
									}
									?>
								</tbody>
							</table>

						<?php
						} // check rows
						else{
							?>
							<p>-</p>
							<?php
						}
						?>
					</div>
				</div>
				<?php
			} // End foreach

			?>
			</div>
		</div>
		<?php

	}
	
} // End view
include 'templates/classic/footer.php';