<?php
include 'bootstrap.php';

$user_session = get_session('sOfficer');
if( empty($user_session) ){
	?>
	<p>Session ������� <a href="../nindex.htm">��ԡ�����</a>���� Login ����</p>
	<?php
	exit;
}

$db = Mysql::load();
$action = input('action');

if ( $action === false ) {

	include 'templates/classic/header.php';

	/*
	$sql = "SELECT `row_id`,`name`,`menucode` 
	FROM `inputm` 
	WHERE `status` = 'Y' 
	AND `menucode` NOT IN ('ADM','ADM18FILE','ADM43FILE','ADMCHKOUT','ADMARMYCHKUP',
	'ADMaudit','ADMBC','ADMCHK','ADMxxx','ADMLIBRARY',
	'ADMCHKSO','ADMCHKUP','ADMCHKUP1','ADMCOM','ADMCSCD',
	'ADMDR','ADMDR1','ADMMON','ADMNEW','ADMNHSO','ADMNURSE',
	'ADMOPD','ADMqpha','ADMSCG','ADMSSO','ADMWIN',
	'ADMMAINCHKUP','ADMMMM','CODER','ADMSTD','ADMcom1',
	'ADMCT','ADMCMS','ADMFINANCE','ADMSTD1'
	)
	ORDER BY `menucode`,`row_id` ASC";
	$db->select($sql);
	*/

	$checklist = array(
		'ADMDEN' => '�ѹ�����',
		'ADMER' => '��ͧ�ء�Թ',
		'ADMEYE' => '��ͧ��',
		'ADMFOD' => '�ç����',
		'ADMHEADWARD' => '��Һ��',
		'ADMHEM' => '�����',
		'ADMHMIS' => '�ٹ��س�Ҿ',
		'ADMICU' => '�ͼ�����˹ѡ',
		'ADMINOPD' => '�Ѻ���¼������',
		'ADMLAB' => '��Ҹ�',
		'ADMMAINOPD' => '��ͧ��Ǩ�ä�����¹͡',
		'ADMNID' => '�ѧ���',
		'ADMOBG' => '�ٵ�',
		'ADMPH' => '��ͧ��',
		'ADMPHA' => '��ͧ��',
		'ADMPHARX' => '���Ѫ',
		'ADMPT' => '����Ҿ',
		'ADMSUB' => 'NCR',
		'ADMSUR' => '��ͧ��ҵѴ',
		'ADMVIP' => '�ͼ����¾����',
		'ADMWF' => '�ͼ��������',
		'ADMXR' => '�ѧ�ա���',
		'ADMLIBRARY' => '�Ǫ������ͧ�ѹ',
		'ADMCMS' => '˹��¨��¡�ҧ',
	);
	
	include 'includes/ajax.php';
	?>
	<style type="text/css">
	optgroup, option {
		font-family: 'TH SarabunPSK';
	}
	</style>
	<div class="col width-fill mobile-width-fill">
		<div class="cell">
			<ul class="col nav clear">
				<li class="active"><a href="../index.htm">˹����ѡ</a></li>
				<li class="active"><a href="drug_control_index.php">�к��һ�Шӵ��</a></li>
			</ul>
		</div>
	</div>
	
	<div class="col">
		<div class="cell">
			<form action="drug_user_ward.php" method="post">
				<div class="col">
					<div class="cell">
						<h3>���������ҹ����Ѻ�к��һ�Шӵ��</h3>
					</div>
				</div>
				<div class="col">
					<div class="cell">

						<fieldset>
							<legend>���͡����������ҹ</legend>
							<select name="section" id="section" onchange="changeCategory(this.value)">
								<option value="">-- ���͡Ἱ� --</option>
								<?php
								foreach ($checklist as $key => $name) {
									?>
									<option value="<?=$key;?>"><?=$name;?></option>
									<?php
								}
								?>
							</select>
						</fieldset>
						<script type="text/javascript">
							function changeCategory(val){
								var html = '';
								if( val !== '' ){

									var newSm = new SmHttp();
									newSm.ajax(
										'drug_user_ward.php',
										{ 'category': val, 'action':'search_user' },
										function(html){
											// var txt = JSON.parse(res);
											document.getElementById('user_lists').innerHTML = html;
											// if( txt.state === 400 ){
											// 	alert('ʶҹТͧ�������ѧ���� '+txt.msg+' ��سҵԴ��ͷ�� Ward ���� Discharge');
											// 	SmPreventDefault(ev);
											// }else{
											// 	// window.open(link.href, '_blank');
											// }
										},
										false // true is Syncronous and false is Assyncronous (Default by true)
									);

								}else{
									document.getElementById('user_lists').innerHTML = html;
								}
							}
						</script>
						<div>
							<fieldset>
								<legend>���͡�����ҹ</legend>
								<div id="user_lists"></div>
							</fieldset>
						</div>


						<?php
						/*

						<select name="user" id="user" multiple>
							<?php
							$items = $db->get_items();
							// $prev_item = false;
							$next_item = false;
							$i = 0;
							$prev_row = 0;
							$next_i = 1;
							foreach( $items as $key => $item ){
								$menu_code = trim($item['menucode']);
								$prev_i = ( $i - 1 );
								$prev_item = ( isset($items[$prev_i]) ) ? trim($items[$prev_i]['menucode']) : false ;
								$next_item = ( isset($items[$next_i]) ) ? trim($items[$next_i]['menucode']) : false ;
								
								if( $menu_code !== $prev_item && $prev_row === 0 ){
									?>
									<optgroup label="<?=$checklist[$menu_code];?>">
									<?php
									$prev_row++;
								}
								?>
								<option value="<?=$item['row_id'];?>"><?=$item['name'];?></option>
								<?php
								if ( $next_item !== $menu_code ) {
									?>
									</optgroup>
									<?php
									$prev_row = 0;
								}
								
								$i++;
								$next_i++;
							}
							?>
						</select>
						*/
						?>

					</div>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit" id="sumitBtn">�ѹ�֡</button>
						<input type="hidden" name="action" value="save">
					</div>
				</div>
			</form>
			<?php
			$msg = get_session('x-msg');
			if( !empty($msg) ){
				?>
				<div class="notify-warning">
					<?=$msg;?>
				</div>
				<?php
				set_session('x-msg', null);
			}
			?>
			<?php
			$sql = "SELECT a.`id`,b.`name`,b.`menucode` 
			FROM `drug_user_ward` AS a 
			LEFT JOIN `inputm` AS b ON b.`row_id` = a.`user_id`";
			$db->select($sql);
			?>
			<div>
				<h3>��ª��ͼ����͹حҵ�������� �к��һ�Шӵ��</h3>
			</div>
			<div class="col">
				<div class="cell">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>����</th>
								<th>˹��§ҹ</th>
								<th>�Ѵ���</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$items = $db->get_items();
							$i = 1;
							foreach( $items as $key => $item ){
								$menucode = trim($item['menucode']);
								?>
								<tr>
									<td><?=$i;?></td>
									<td><?=$item['name'];?></td>
									<td><?=$checklist[$menucode];?></td>
									<td><a class="delete" href="drug_user_ward.php?action=delete&id=<?=$item['id'];?>">ź</a></td>
								</tr>
								<?php
								$i++;
							}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
	$(function(){
		$(document).on('click', '#sumitBtn', function(){
			var user_id = $('#user').val();
			if( user_id == '' || typeof user_id === 'undefined' ){
				return false;
			}
		});

		$(document).on('click', '.delete', function(){
			var c = confirm('�׹�ѹź������?');
			if( c === false ){
				return false;
			}
		});
	});
	</script>
	<?php
	include 'templates/classic/footer.php';
}elseif( $action === 'save' ){
	
	$user_id = input_post('user');
	$sql = "INSERT INTO `smdb`.`drug_user_ward` (`user_id`,`author`) VALUES ( :user_id, :author );";
	$data = array(':user_id' => $user_id, ':author' => $user_session);
	$test_insert = $db->insert($sql, $data);

	redirect('drug_user_ward.php', '�ѹ�֡���������º����');
	
}elseif( $action === 'delete' ){
	$id = input_get('id');
	$sql = "DELETE FROM `drug_user_ward` WHERE `id`=:id;";
	$db->delete($sql, array(':id' => $id));

	redirect('drug_user_ward.php', 'ź���������º����');
}elseif( $action === 'search_user' ){

	$category = input_post('category');

	$sql = "SELECT `row_id`,`name`,`menucode` 
	FROM `inputm` 
	WHERE `status` = 'Y' 
	AND `menucode` = '$category'
	ORDER BY `row_id` ASC";

	$db->select($sql);
	$users = $db->get_items();

	?>
	<select name="user" id="user">
		<option value="">-- ���͡���ͼ����ҹ --</option>
		<?php
		foreach ($users as $key => $user) {
			?>
			<option value="<?=$user['row_id'];?>"><?=$user['name'];?></option>
			<?php
		}
		?>
	</select>
	<?php
	exit;
}
?>
