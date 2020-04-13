<?php
require_once 'bootstrap.php';

$login_code = get_session('smenucode');
if(authen() === false){ 
	?>
	<div style="text-align: center;">
		<h1>กรุณาเข้าสู่ระบบอีกครั้งเพื่อใช้งาน</h1>
		<a href="login_page.php">คลิกที่นี่ เพื่อเข้าสู่ระบบ</a>
	</div>
	<?php
	exit;
}
if( $login_code !== 'ADM' ){ die('อนุญาตเฉพาะโปรแกรมเมอร์เท่านั้นที่เข้าถึงได้'); }

$date_in_week = array(
	0 => 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัส', 'ศุกร์', 'เสาร์',
);

$action = input('action');
$db = Mysql::load();

if($action === 'save'){

	$id = input_post('id');
	$type = input_post('type');
	$date_inweek = $_POST['date_inweek'];
	$user_row = (int)input_post('user_row');
	$dr_contact = input_post('note');
	
	$db->select("SELECT `row_id`,`name` FROM `doctor` WHERE `row_id` = :id ", array(':id' => $id));
	$doctor = $db->get_item();

	$msg = 'บันทึกข้อมูลเรียบร้อย';

	if ($type === 'lock') {
		
		$sql = "INSERT INTO `dr_limit_appoint` ( 
			`dr_id`, `dr_name`, `date`, `user_row`, `date_add`, 
			`date_edit`, `create_by`, `edit_by`, `type`, `dr_contact` 
		) VALUES( 
			:dr_id, :dr_name, :date_inweek, :user_row, :date_add, 
			:date_edit, :create_by, :edit_by, :type, :dr_contact
		)";
		
		$date_add = date('Y-m-d H:i:s');
		$data = array(
			':dr_id' => $doctor['row_id'],
			':dr_name' => $doctor['name'],
			':date_inweek' => $date_inweek, 
			':user_row' => $user_row,
			':date_add' => $date_add,
			':date_edit' => null,
			':create_by' => $_SESSION['sIdname'],
			':edit_by' => null,
			':type' => 'lock',
			':dr_contact' => $dr_contact
		);

		$insert = $db->insert($sql, $data);
		
	}elseif ($type === 'day_lock') {
		
		$first = input_post('date_start');
		$last = input_post('date_end');

		// SET DATE IN RANGE
		$dates = array();
		$current = strtotime( $first );
		$last = strtotime( $last );
		while( $current <= $last ) {
			$dates[] = date( 'Y-m-d', $current );
			$current = strtotime( '+1 day', $current );
		}
		// SET DATE IN RANGE

		foreach ($dates as $key => $dateItem) {

			$sql = "INSERT INTO `dr_limit_appoint` ( 
				`id`, `dr_id`, `dr_name`, `date_lock`, `user_row`, 
				`date_add`, `date_edit`, `create_by`, `edit_by`, `type`
			) VALUES( 
				:id, :dr_id, :dr_name, :date_lock, :user_row, 
				:date_add, :date_edit, :create_by, :edit_by, :type
			)";
			
			$date_add = date('Y-m-d H:i:s');
			$data = array(
				':id' => null,
				':dr_id' => $doctor['row_id'],
				':dr_name' => $doctor['name'],
				':date_lock' => $dateItem, 
				':user_row' => $user_row,
				':date_add' => $date_add,
				':date_edit' => null,
				':create_by' => $_SESSION['sIdname'],
				':edit_by' => null,
				':type' => 'date_lock'
			);

			$insert = $db->insert($sql, $data);

		}

	}

	redirect('dt_appoint_diagnose.php', $msg);
	exit;
}

$title = 'ระบบจำกัดนัดผู้ป่วย';
include 'templates/default/header.php';
?>

<div class="site-body centered-content">
	<div class="site-center">
		<div class="cell">
			<div class="col">
				<div class="menu cell">
					<ul class="nav">
						<li><a href="../nindex.htm">&lt;&lt;&nbsp;กลับหน้าหลัก ร.พ.</a></li>
						<li><a href="dt_appoint_diagnose.php">รายการ</a></li>
						<li><a href="dt_appoint_diagnose.php?page=showlist">ฟอร์มบันทึก</a></li>
					</ul>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<div class="page-header">
						<h1>ระบบจำกัดนัดผู้ป่วย</h1>
					</div>
				</div>
			</div>
<?php
$page = input('page');
if ( $page === 'showlist' ) {
	?>
	<div class="col">
		<div class="cell menu-tabs tab-block">
			<div class="tabs">
				<ul class="nav">
					<li class="active"><a href="#tabcontent1">Lock ตลอด</a></li>
					<li class=""><a href="#tabcontent2">Lock รายวัน</a></li>
				</ul>
			</div>
			<div class="tab-content">
				<div class="cell" id="tabcontent1">
					<form action="dt_appoint_diagnose.php" method="post">
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="doctor">เลือกแพทย์</label>
								</div>
							</div>
							<div class="col width-fill">
								<div class="cell">
									<select id="doctor" name="id">
										<?php
										$sql = "SELECT `row_id`,`name` 
										FROM `doctor` 
										WHERE `status` = 'y'";
										
										$db->select($sql);
										$items = $db->get_items();
										
										foreach($items as $key => $item){
										?>
											<option value="<?php echo $item['row_id'];?>"><?php echo $item['name'];?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="date">เลือกวัน</label>
								</div>
							</div>
							<div class="col width-fill">
								<div class="cell">
									<select id="date" name="date_inweek">
										<?php
										foreach($date_in_week as $key => $day){
										?>
											<option value="<?=$key;?>"><?=$day;?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="user_row">จำนวนLockนัด</label>
								</div>
							</div>
							<div class="col width-1of4">
								<div class="cell">
									<input type="text" name="user_row" id="user_row">
									<div class="label background-orange">* ใส่ศูนย์(0) คือการงดนัดตามวันที่เราเลือก</div>
								</div>
							</div>
							<div class="col width-fill"></div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="note">หากต้องการนัดเพิ่มกรุณาติดต่อ</label>
								</div>
							</div>
							<div class="col width-2of4">
								<div class="cell">
									<input type="text" name="note" id="note">
								</div>
							</div>
							<div class="col width-fill"></div>
						</div>
						<div class="col">
							<div class="col width-1of4"></div>
							<div class="col width-fill">
								<div class="cell">
									<button type="submit">บันทึก</button>
									<input type="hidden" name="type" value="lock">
									<input type="hidden" name="action" value="save">
								</div>
							</div>
						</div>
					</form>
				</div>
				<div class="cell hidden-tab" id="tabcontent2">
					<form action="dt_appoint_diagnose.php" method="post">
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="doctor">เลือกแพทย์</label>
								</div>
							</div>
							<div class="col width-fill">
								<div class="cell">
									<select id="doctor" name="id">
										<?php
										$sql = "SELECT `row_id`,`name` 
										FROM `doctor` 
										WHERE `status` = 'y'";
										
										$db->select($sql);
										$items = $db->get_items();
										
										foreach($items as $key => $item){
										?>
											<option value="<?php echo $item['row_id'];?>"><?php echo $item['name'];?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="date">วันที่เริ่ม</label>
								</div>
							</div>
							<div class="col width-1of4">
								<div class="cell">
									<input type="text" name="date_start" id="date_start">
								</div>
							</div>
							<div class="col width-fill"></div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="date">วันที่สิ้นสุด</label>
								</div>
							</div>
							<div class="col width-1of4">
								<div class="cell">
									<input type="text" name="date_end" id="date_end">
									<div class="label background-orange">* กรณีที่ต้องการ lock แค่วันเดียวให้ใส่แค่วันที่เริ่ม</div>
								</div>
							</div>
							<div class="col width-fill"></div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="user_row">จำนวนLockนัด</label>
								</div>
							</div>
							<div class="col width-1of4">
								<div class="cell">
									<input type="text" name="user_row" id="user_row">
									<div class="label background-orange">* ใส่ศูนย์(0) แจ้งแพทย์ไม่ออกตรวจวันนั้นๆ</div>
								</div>
							</div>
							<div class="col width-fill"></div>
						</div>
						<div class="col">
							<div class="col width-1of4"></div>
							<div class="col width-fill">
								<div class="cell">
									<button type="submit">บันทึก</button>
									<input type="hidden" name="type" value="day_lock">
									<input type="hidden" name="action" value="save">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
	<style>
	table.calendar{
		width: auto!important;
	}
	table.calendar input,table.calendar select{
		width: auto!important;
		height: 25px!important;
		font-size: 13px;
	}
	</style>
    <script type="text/javascript" src="epoch_classes.js"></script>
	<script type="text/javascript">
        var popup1,popup2;
        window.onload = function() {
            popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
			popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
        };
	</script>

<?php 
}elseif ($page === false) {
	?>
	<div class="col">
		<div class="cell">
			<h2>Lockนัดแบบตลอด</h2>
			<table class="block box-header outline-header uppercase-header outline">
				<thead>
					<tr>
						<th>ชื่อหมอ</th>
						<th>วันที่จำกัด</th>
						<th>จำนวนที่จำกัด</th>
						<th width="10%">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$db->select("SELECT * FROM `dr_limit_appoint` WHERE `type` = 'lock' ORDER BY `dr_id` ASC, `date` ASC;");
					$items = $db->get_items();
					foreach($items as $key => $item){
						$date_number = (int) $item['date'];
						?>
						<tr>
							<td><?php echo $item['dr_name'];?></td>
							<td><?php echo $date_in_week[$date_number];?></td>
							<td><?php echo $item['user_row'];?></td>
							<td>
								<a href="">แก้ไข</a> / <a href="">ลบ</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<?php 
			$db->select("SELECT * FROM `dr_limit_appoint` WHERE `type` = 'date_lock' ORDER BY `dr_id` ASC, `date` ASC;");
			if ( $db->get_rows() > 0 ) {
			?>
			<h2>Lockนัดรายวัน</h2>
			<table class="block box-header outline-header uppercase-header outline">
				<thead>
					<tr>
						<th>ชื่อหมอ</th>
						<th>วันที่จำกัด</th>
						<th>จำนวนที่จำกัด</th>
						<th width="10%">จัดการ</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$items = $db->get_items();
					foreach($items as $key => $item){
						$date_number = (int) $item['date'];
						?>
						<tr>
							<td><?php echo $item['dr_name'];?></td>
							<td><?php echo $item['date_lock'];?></td>
							<td><?php echo $item['user_row'];?></td>
							<td>
								<a href="">ลบ</a>
							</td>
						</tr>
						<?php
					}
					?>
				</tbody>
			</table>
			<?php 
			} 
			?>
		</div>
	</div>
	<?php 
} // end page
?>
		</div>
	</div>
</div>
<?php

include 'templates/default/footer.php';