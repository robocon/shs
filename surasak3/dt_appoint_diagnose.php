<?php
include 'bootstrap.php';

$login_code = get_session('smenucode');
if(authen() === false){ die('Invalid User'); }
if( $login_code !== 'ADM' ){ die('อนุญาตเฉพาะโปรแกรมเมอร์เท่านั้นที่เข้าถึงได้'); }

$date_in_week = array(
	0 => 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัส', 'ศุกร์', 'เสาร์',
);

$action = input('action');
$db = Mysql::load();

if($action === 'save'){

	$id = input_post('id');
	$date = $_POST['date'];
	
	$db->select("SELECT name FROM doctor WHERE `row_id` = :id ", array(':id' => $id));
	$doctor = $db->get_item();
	
	$sql = "INSERT INTO `dr_limit_appoint` (`id`, `dr_id`, `dr_name`, `date`, `user_row`, `date_add`, `date_edit`, `create_by`, `edit_by`)
	VALUES(:id, :dr_id, :dr_name, :date_inweek, :user_row, :date_add, :date_edit, :create_by, :edit_by)";
	
	$date_add = date('Y-m-d H:i:s');
	
	foreach($date as $key => $count){
		if($count != '-'){
			
			$data = array(
				':id' => null,
				':dr_id' => $id,
				':dr_name' => $doctor['name'],
				':date_inweek' => $key, 
				':user_row' => (int) $count,
				':date_add' => $date_add,
				':date_edit' => null,
				':create_by' => $_SESSION['sIdname'],
				':edit_by' => null
			);

			$insert = $db->insert($sql, $data);
		}
	}

	header('Location: dt_appoint_diagnose.php');
	exit;
}

$title = 'ระบบจำกัดนัดผู้ป่วย';
include 'templates/default/header.php';
?>
<div class="site-body centered-content">
	<div class="site-center">
		<div class="cell">
			<div class="col">
				<div class="cell">
					<div class="page-header">
						<h1>ระบบจำกัดนัดผู้ป่วย</h1>
					</div>
				</div>
			</div>
			<div class="col">
				<div class="cell">
					<form method="post" action="dt_appoint_diagnose.php">
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
									<label for="">จำนวนจำกัดการนัด</label>
								</div>
							</div>
							<div class="col width-1of4">
								<div class="cell">
									วันอาทิตย์<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
								<div class="cell">
									วันจันทร์<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
								<div class="cell">
									วันอังคาร<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
								<div class="cell">
									วันพุธ<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
								<div class="cell">
									วันพฤหัส<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
								<div class="cell">
									วันศุกร์<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
								<div class="cell">
									วันเสาร์<input class="text parsley-validated" name="date[]" type="text" value="-">
								</div>
							</div>
						</div>
						<div class="col">
							<div class="col width-1of4">
								<div class="cell">
									<label for="country"></label>
								</div>
							</div>
							<div class="col width-1of4">
								<div class="cell">
									<button type="submit">เพิ่มข้อมูล</button>
									<input type="hidden" name="action" value="save">
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="col">
				<div class="cell">
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
							$db->select("SELECT * FROM `dr_limit_appoint` ORDER BY id, dr_id ASC;");
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
				</div>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/default/footer.php';