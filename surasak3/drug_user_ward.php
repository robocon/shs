<?php
include 'bootstrap.php';

/*
DROP TABLE IF EXISTS `drug_user_ward`;

CREATE TABLE `drug_user_ward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
*/

$db = Mysql::load();
$action = input('action');

if ( $action === false ) {

	include 'templates/classic/header.php';

	$sql = "SELECT `row_id`,`name`,`menucode` 
	FROM `inputm` 
	WHERE `status` = 'Y' 
	AND `menucode` NOT IN ('ADM','ADM18FILE','ADM43FILE','ADMCHKOUT','ADMARMYCHKUP',
	'ADMaudit','ADMBC','ADMCHK','ADMxxx','ADMLIBRARY',
	'ADMCHKSO','ADMCHKUP','ADMCHKUP1','ADMCOM','ADMCSCD',
	'ADMDR','ADMDR1','ADMMON','ADMNEW','ADMNHSO','ADMNURSE',
	'ADMOPD','ADMqpha','ADMSCG','ADMSSO','ADMWIN',
	'ADMMAINCHKUP','ADMMMM','CODER','ADMSTD','ADMcom1',
	'ADMCT','ADMCMS'
	)
	ORDER BY `menucode`,`row_id` ASC";
	$db->select($sql);

	$checklist = array(
		'ADMDEN' => '�ѹ�����',
		'ADMER' => '��ͧ�ء�Թ',
		'ADMEYE' => '��ͧ��',
		'ADMFINANCE' => '����Թ',
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
		'ADMOPD' => '',
		'ADMPH' => '��ͧ��',
		'ADMPHA' => '��ͧ��',
		'ADMPHARX' => '���Ѫ',
		'ADMPT' => '����Ҿ',
		'ADMSUB' => 'NCR',
		'ADMSUR' => '��ͧ��ҵѴ',
		'ADMVIP' => '�ͼ����¾����',
		'ADMWF' => '�ͼ��������',
		'ADMXR' => '�ѧ�ա���',
	);
	
	?>
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
						<label for="">���͡�����ҹ</label>
						<select name="user" id="user">
							<option value="">��ª����¡���˹��§ҹ</option>
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
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">�ѹ�֡</button>
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
									<td><a href="drug_user_ward.php?action=delete&id=<?=$item['id'];?>">ź</a></td>
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
	<?php
	include 'templates/classic/footer.php';
}elseif( $action === 'save' ){
	
	$user_id = input_post('user');
	$sql = "INSERT INTO `smdb`.`drug_user_ward` (`user_id`) VALUES ( :user_id );";
	$data = array(':user_id' => $user_id);
	$test_insert = $db->insert($sql, $data);

	redirect('drug_user_ward.php', '�ѹ�֡���������º����');
}elseif( $action === 'delete' ){
	$id = input_get('id');
	$sql = "DELETE FROM `drug_user_ward` WHERE `id`=:id;";
	$db->delete($sql, array(':id' => $id));

	redirect('drug_user_ward.php', 'ź���������º����');
}
?>
