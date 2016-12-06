<?php
include 'bootstrap.php';

$user_session = get_session('sOfficer');
if( empty($user_session) ){
	?>
	<p>Session หมดอายุ <a href="../nindex.htm">คลิกที่นี่</a>เพื่อ Login ใหม่</p>
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
		'ADMDEN' => 'ทันตกรรม',
		'ADMER' => 'ห้องฉุกเฉิน',
		'ADMEYE' => 'ห้องตา',
		'ADMFOD' => 'โรงครัว',
		'ADMHEADWARD' => 'พยาบาล',
		'ADMHEM' => 'ไตเทียม',
		'ADMHMIS' => 'ศูนย์คุณภาพ',
		'ADMICU' => 'หอผู้ป่วยหนัก',
		'ADMINOPD' => 'รับป่วยผู้ป่วยใน',
		'ADMLAB' => 'พยาธิ',
		'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
		'ADMNID' => 'ฝังเข็ม',
		'ADMOBG' => 'สูติ',
		'ADMPH' => 'ห้องยา',
		'ADMPHA' => 'ห้องยา',
		'ADMPHARX' => 'เภสัช',
		'ADMPT' => 'กายภาพ',
		'ADMSUB' => 'NCR',
		'ADMSUR' => 'ห้องผ่าตัด',
		'ADMVIP' => 'หอผู้ป่วยพิเศษ',
		'ADMWF' => 'หอผู้ป่วยรวม',
		'ADMXR' => 'รังษีกรรม',
		'ADMLIBRARY' => 'เวชกรรมป้องกัน',
		'ADMCMS' => 'หน่วยจ่ายกลาง',
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
				<li class="active"><a href="../index.htm">หน้าหลัก</a></li>
				<li class="active"><a href="drug_control_index.php">ระบุยาประจำตัว</a></li>
			</ul>
		</div>
	</div>
	
	<div class="col">
		<div class="cell">
			<form action="drug_user_ward.php" method="post">
				<div class="col">
					<div class="cell">
						<h3>เพิ่มผู้ใช้งานสำหรับระบุยาประจำตัว</h3>
					</div>
				</div>
				<div class="col">
					<div class="cell">

						<fieldset>
							<legend>เลือกกลุ่มผู้ใช้งาน</legend>
							<select name="section" id="section" onchange="changeCategory(this.value)">
								<option value="">-- เลือกแผนก --</option>
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
											// 	alert('สถานะของผู้ป่วยยังอยู่ '+txt.msg+' กรุณาติดต่อที่ Ward เพื่อ Discharge');
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
								<legend>เลือกผู้ใช้งาน</legend>
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
						<button type="submit" id="sumitBtn">บันทึก</button>
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
				<h3>รายชื่อผู้ที่อนุญาตให้เข้าใช้ ระบุยาประจำตัว</h3>
			</div>
			<div class="col">
				<div class="cell">
					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>ชื่อ</th>
								<th>หน่วยงาน</th>
								<th>จัดการ</th>
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
									<td><a class="delete" href="drug_user_ward.php?action=delete&id=<?=$item['id'];?>">ลบ</a></td>
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
			var c = confirm('ยืนยันลบข้อมูล?');
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

	redirect('drug_user_ward.php', 'บันทึกข้อมูลเรียบร้อย');
	
}elseif( $action === 'delete' ){
	$id = input_get('id');
	$sql = "DELETE FROM `drug_user_ward` WHERE `id`=:id;";
	$db->delete($sql, array(':id' => $id));

	redirect('drug_user_ward.php', 'ลบข้อมูลเรียบร้อย');
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
		<option value="">-- เลือกชื่อผู้ใช้งาน --</option>
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
