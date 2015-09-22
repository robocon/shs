<?php 
include 'bootstrap.php';
if(authen() === false ){ die('Session หมดอายุ <a href="login_page.php">คลิกที่นี่</a> เพื่อทำการเข้าสู่ระบบอีกครั้ง'); }

// Load Databse
DB::load();

$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : false ;
$hn = isset($_REQUEST['hn']) ? trim($_REQUEST['hn']) : false ;
$th_date = ( date('Y')+543 ).date('-m-d');
// $full_months = array("มกราคม" => "01" ,"กุมภาพันธ์" => "02", "มีนาคม" => "03" , "เมษายน" => "04" ,"พฤษภาคม" => "05" ,"มิถุนายน" => "06" , "กรกฎาคม" => "07" , "สิงหาคม" => "08" , "กันยายน" => "09" , "ตุลาคม"  => "10" , "พฤศจิกายน" => "11" ,  "ธันวาคม" => "12" );

$full_months = array(
	"01" => "มกราคม",
	"02" => "กุมภาพันธ์",
	"03" => "มีนาคม",
	"04" => "เมษายน",
	"05" => "พฤษภาคม",
	"06" => "มิถุนายน",
	"07" => "กรกฏาคม",
	"08" => "สิงหาคม",
	"09" => "กันยายน",
	"10" => "ตุลาคม",
	"11" => "พฤศจิกายน",
	"12" => "ธันวาคม"
);

if($action === 'save'){
	
	$details_filter = array(
		'1_1' => 1,
		'2_1' => 1,
		'3_1' => 1,
		'3_2' => 1,
		'3_3' => 1,
		'4_1' => 1,
		'4_2' => 1,
		'4_3' => 1,
		'4_4' => 1,
		'4_5' => 1,
	);
	
	$test_max_value = 0;
	
	$mouth_list = array();
	foreach($details_filter as $key => $val){
		$mouth_list[$key] = isset($_POST['mouth_detail'][$key]) ? intval($val) : 0 ;
		
		// หาค่าสูงสุดของ ระดับสภาวะสุขภาพช่องปาก
		// เช่น user xxx ติ๊กช่อง 4,5,6 จะถือว่าอยู่ในระดับ 4
		preg_match('/^\d{1,}/', $key, $match);
		if( !empty($match['0']) && $mouth_list[$key] == 1 ){
			$test_max_value = $match['0'];
		}
		/*
		if( $key == '1_1' && $mouth_list[$key] == 1 ){
			$test_max_value = 1;
			
		}else if( $key == '2_1' && $mouth_list[$key] == 1 ){
			$test_max_value = 2;
			
		}else if( ($key == '3_1' && $mouth_list[$key] == 1) OR ($key == '3_2' && $mouth_list[$key] == 1) OR ($key == '3_3' && $mouth_list[$key] == 1) ){
			$test_max_value = 3;
			
		}else if(
			($key == '4_1' && $mouth_list[$key] == 1) 
			OR ($key == '4_2' && $mouth_list[$key] == 1) 
			OR ($key == '4_3' && $mouth_list[$key] == 1) 
			OR ($key == '4_4' && $mouth_list[$key] == 1) 
			OR ($key == '4_5' && $mouth_list[$key] == 1) 
		){
			$test_max_value = 4;
			
		}
		*/
	}
	
	$lists = serialize($mouth_list);
	$sql = "
	INSERT INTO `survey_oral` (
		`id` ,
		`hn` ,
		`date` ,
		`section` ,
		`fullname` ,
		`age` ,
		`id_card` ,
		`etc` ,
		`officer` ,
		`mouth_detail` ,
		`date_add` ,
		`date_edit` ,
		`status`,
		`max_status`
	)
	VALUES (
		NULL , :hn, :date, :section, :fullname, :age, :id_card, :etc, :officer, :mouth_detail, NOW(), NULL, '1', :max_status
	);
	";
	
	$data = array(
		':hn' => $_POST['hn'],
		':date' => $_POST['date'],
		':section' => trim($_POST['section']),
		':fullname' => trim($_POST['prefix']).' '.trim($_POST['firstname']).' '.trim($_POST['lastname']),
		':age' => $_POST['age'],
		':id_card' => $_POST['id_card'],
		':etc' => $_POST['etc'],
		':officer' => $_POST['officer'],
		':mouth_detail' => $lists,
		':max_status' => $test_max_value
	);
	$insert = DB::exec($sql, $data);
	$msg = 'บันทึกข้อมูลเรียบร้อย';
	if($insert === false){
		$msg = 'บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ';
	}
	
	$last_id = DB::get_lastId();
	
	redirect('survey_oral.php?task=fulldetail&id='.$last_id.'&print=yes', $msg);
	exit;
} else if( $action === 'delete' ){
	
	if( $id === false ){
		echo "ข้อมูลไม่ถูกต้อง";
		exit;
	}
	
	$sql = "
	DELETE FROM `survey_oral` WHERE `survey_oral`.`id` = :id LIMIT 1
	";
	$delete = DB::exec($sql, array(':id' => $id) );
	$msg = 'ลบข้อมูลเรียบร้อย';
	if($delete === false){
		$msg = 'ลบข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ';
	}
	
	redirect('survey_oral.php', $msg);
	exit;
} else if( $action === 'section_form_save' ){
	
	$name = isset($_POST['section']) ? trim($_POST['section']) : false ;
	if($name === false){
		?>
		<script type="text/javascript">
		alert('กรุณากรอกชื่อหน่วยงาน');
		window.history.back();
		</script>
		<?php
		exit;
	}
	
	$sql = "
	INSERT INTO `smdb`.`survey_oral_category` (`id` ,`name` ,`date_add` ,`date_edit` )
	VALUES (
	NULL , :name, NOW(), NULL
	);
	";
	
	$insert = DB::exec($sql, array(':name' => $_POST['section']));
	
	$msg = 'บันทึกข้อมูลเรียบร้อย';
	if($insert === false){
		$msg = 'บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ';
	}
	
	redirect('survey_oral.php?task=category_form', $msg);
	exit;
} else if( $action === 'delete_category' ){
	
	if( $id === false ){
		redirect('survey_oral.php?task=category_form', 'ข้อมูลไม่ถูกต้อง กรุณาตรวจสอบใหม่');
	}else{
		$sql = "
		DELETE FROM `survey_oral_category` 
		WHERE `id` = :id LIMIT 1
		";
		DB::exec($sql, array(':id' => $id));
		redirect('survey_oral.php?task=category_form', 'ลบข้อมูลเรียบร้อย');
	}
	
	exit;
}




define('CHARSET', 'TIS-620');
include 'templates/classic/header.php';

include 'templates/classic/nav.php';
?>
<style type="text/css">
@media print {
	body{
		background-color: #ffffff;
		font-size: 14px;
	}
	.site-center,
	.site-body panel{
		width: 100%!important;
		height: 100%!important;
		margin: 0!important;
		border: 0 solid #ffffff!important;
	}
	.panel,
	.panel .body,
	.col,
	.cell{
		margin: 0!important;
		border: 0 solid #ffffff!important;
		box-shadow: 0 rgba(0, 0, 0, 0);
		border-width: 0;
	}
	.nav-menu-col,
	.page-header-col{
		display: none!important;
	}
	#print_btn,
	.site-header-fixture{
		display: none;
	}
}

.input_form{
	display: inline;
	margin-bottom: 0.5em;
}
.input_form label{
	font-weight: bold;
}
.align-center{
	text-align: center;
	vertical-align: middle;
}
.align-right{
	text-align: right;
}

.custom-table input{
	width: auto;
}
.custom-table table{
	margin: 0;
}

</style>
<link type="text/css" href="diabetes_clinic/epoch_styles.css" rel="stylesheet" />
<script type="text/javascript" src="diabetes_clinic/epoch_classes.js"></script>
<script type="text/javascript">
	var popup1;
	window.onload = function() {
		popup1 = new Epoch('popup1','popup',document.getElementById('date'),false);
	};
</script>

<div class="site-center">
    <div class="site-body panel">
        <div class="body">
            <div class="cell">
                <div class="col page-header-col">
                    <div class="cell">
                        <div class="page-header">
                            <h1>ระบบสำรวจสภาวะช่องปาก</h1>
                        </div>
                    </div>
                </div>
				<div class="col nav-menu-col">
					<div class="menu cell">
						<?php 
							$home_active = ( $task === false ) ? 'class="active"' : false ;
							$form_active = ( $task === 'form' ) ? 'class="active"' : false ;
							$form_category = ( $task === 'category_form' ) ? 'class="active"' : false ;
							$den_report = ( $task === 'report' ) ? 'class="active"' : false ;
							$report_mouth = ( $task === 'report_mouth' ) ? 'class="active"' : false ;
						?>
						<ul class="nav">
							<li <?php echo $home_active;?>><a href="survey_oral.php">หน้าหลัก</a></li>
							<li <?php echo $form_active;?>><a href="survey_oral.php?task=form">เพิ่มข้อมูลแบบสำรวจ</a></li>
							<li <?php echo $form_category;?>><a href="survey_oral.php?task=category_form">จัดการข้อมูลหน่วยงาน</a></li>
							<li <?php echo $den_report;?>><a href="survey_oral.php?task=report">รายงานผลการสำรวจ</a></li>
							<li <?php echo $report_mouth;?>><a href="survey_oral.php?task=report_mouth">รายงานสภาวะช่องปากและระดับ</a></li>
						</ul>
					</div>
				</div>
				<?php if( $task === false ){ ?>
				<div class="col">
					<div class="cell">
						
						<?php // Notification ?>
						<?php if( isset($_SESSION['x-msg']) ): ?>
						<div class="col">
							<div class="cell">
								<span class="label">แจ้งจากระบบ</span> <?php echo $_SESSION['x-msg']; ?>
							</div>
						</div>
						<?php unset($_SESSION['x-msg']); ?>
						<?php endif; ?>
						
						<h3>รายชื่อผู้ที่ทำการตรวจ</h3>
						<table class="outline-header border box-header outline">
							<thead>
								<tr>
									<th width="10%">HN</th>
									<th>ชื่อ-สกุล</th>
									<th>หน่วย</th>
									<th width="15%">วันที่ทำการตรวจ</th>
									<th align="center" width="10%">จัดการข้อมูล</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql = "
									SELECT a.`id`,a.`hn`,a.`date`,a.`fullname`,b.`name` 
									FROM `survey_oral` AS a 
									LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
									ORDER BY a.`id` DESC;";
									$items = DB::select($sql);
									foreach($items as $item){
										
										list($y, $m, $d) = explode('-', $item['date']);
										$th_full_date = $d.' '.$full_months[$m].' '.$y;
								?>
								<tr>
									<td><a href="survey_oral.php?task=fulldetail&id=<?php echo $item['id'];?>" title="คลิกเพื่อดูข้อมูลแบบเต็ม"><?php echo $item['hn'];?></a></td>
									<td><?php echo $item['fullname'];?></td>
									<td><?php echo $item['name'];?></td>
									<td><?php echo $th_full_date;?></td>
									<td>
										<a href="#">แก้ไข</a> | 
										<a href="survey_oral.php?action=delete&id=<?php echo $item['id'];?>" class="survey_remove">ลบ</a>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } elseif( $task === 'form' ){ ?>
				<div class="col">
					<div class="cell">
						<h3>เพิ่มข้อมูลแบบสำรวจสภาวะช่องปาก กำลังพล ทบ.</h3>
						<form action="survey_oral.php?task=form" method="post">
							<div class="col">
								<div>
									<label for="">ค้นหาตามเลขHN: </label><input type="text" name="hn" value="<?php echo $hn;?>">
								</div>
							</div>
							<div class="col">
								<div>
									<button type="submit">ค้นหา</button>
								</div>
							</div>
						</form>
						
						<?php 
						$sql = "SELECT *  FROM `opcard` WHERE `hn` = :hn LIMIT 1;";
						// $item = DB::select($sql, array(':hn' => $hn), true);
						
						$q = mysql_query(str_replace(':hn', "'$hn'", $sql));
						$item = mysql_fetch_assoc($q);
						
						if( $item ){
							
							list($y, $m, $d) = explode('-', $item['dbirth']);
							$user_bd = strtotime(( $y - 543 )."-$m-$d") ;
							$age = floor( abs($user_bd - strtotime('now')) / ( 365*60*60*24 ) );
						?>
						<div class="col">
							<div class="cell">
								&nbsp;
							</div>
						</div>
						<h3>รายละเอียดผู้ป่วย</h3>
						<form action="survey_oral.php?action=save" method="post">
							<div class="cell">
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
									<input id="hn" name="hn" type="hidden" value="<?php echo $item['hn'];?>">
									</div>
								<div class="input_form"><label for="date">วันที่ตรวจ:</label>&nbsp;<input class="text" id="date" name="date" type="text" value="<?php echo $th_date;?>"></div>
								<div class="input_form">
									<label for="section">หน่วย:</label>&nbsp;
									<select name="section" id="section">
										<?php
											$sql = "SELECT `id`,`name` FROM `survey_oral_category` ORDER BY `id` ASC;";
											$categories = DB::select($sql);
											foreach ($categories as $key => $value) {
												?>
												<option value="<?php echo $value['id'];?>"><?php echo $value['name'];?></option>
												<?php
											}
										?>
									</select>
								</div>
							</div>
							<div class="cell">
								<div class="input_form">
									<label for="prefix">คำนำหน้า: </label><?php echo $item['yot'];?>
									<input id="prefix" name="prefix" type="hidden" value="<?php echo $item['yot'];?>">
									</div>
								<div class="input_form">
									<label for="firstname">ชื่อ: </label><?php echo $item['name'];?>
									<input id="firstname" name="firstname" type="hidden" value="<?php echo $item['name'];?>">
									</div>
								<div class="input_form">
									<label for="lastname">สกุล: </label><?php echo $item['surname'];?>
									<input id="lastname" name="lastname" type="hidden" value="<?php echo $item['surname'];?>">
									</div>
								
							</div>
							<div class="cell">
								<div class="input_form">
									<label for="age">อายุ: </label><?php echo $age;?> ปี
									<input id="age" name="age" type="hidden" value="<?php echo $age;?>">
								</div>
								<div class="input_form">
									<label for="id_card">เลขบัตรประจำตัวประชาชน: </label><?php echo $item['idcard'];?>
									<input id="id_card" name="id_card" type="hidden" value="<?php echo $item['idcard'];?>">
								</div>
							</div>
							<div >
								<table class="custom-table outline-header border box-header outline">
									<thead>
										<tr>
											<th class="align-center">สภาวะช่องปาก</th>
											<th class="align-center" width="5%">ระดับ</th>
											<th class="align-center" width="15%">คำแนะนำในการรักษา</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<input name="mouth_detail[1_1]" id="1_1" class="checkbox" type="checkbox" value="1">
												<label for="1_1">1. สุขภาพช่องปากดี</label>
											</td>
											<td class="align-center">1</td>
											<td class="align-center">ควรมารักษาทุก 6 เดือน</td>
										</tr>
										
										<tr>
											<td>
												<input name="mouth_detail[2_1]" id="2_1" class="checkbox" type="checkbox" value="1">
												<label for="2_1">2. มีหินปูน มีเหงือกอักเสบ</label>
											</td>
											<td class="align-center">2</td>
											<td class="align-center">ขูดหินปูน</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[3_1]" id="3_1" class="checkbox" type="checkbox" value="1">
												<label for="3_1">3. มีฟันผุที่อุดได้</label>
											</td>
											<td class="align-center" rowspan="3">3</td>
											<td class="align-center">อุดฟัน</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[3_2]" id="3_2" class="checkbox" type="checkbox" value="1">
												<label for="3_2">4. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
											</td>
											<td class="align-center">รักษาโรคเหงือก</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[3_3]" id="3_3" class="checkbox" type="checkbox" value="1">
												<label for="3_3">5. สูญเสียฟันและจำเป็นต้องใส่ฟันทดแทน</label>
											</td>
											<td class="align-center">ใส่ฟัน</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_1]" id="4_1" class="checkbox" type="checkbox" value="1">
												<label for="4_1">6. มีฟันผุทะลุโพรงประสาทที่รักษาคลองรากฟันได้</label>
											</td>
											<td class="align-center" rowspan="5">4</td>
											<td class="align-center">รักษาคลองรากฟัน</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_2]" id="4_2" class="checkbox" type="checkbox" value="1">
												<label for="4_2">7. มีฟันผุทะลุโพรงประสาทที่ต้องถอน / มี RR</label>
											</td>
											<td class="align-center">ถอนฟัน</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_3]" id="4_3" class="checkbox" type="checkbox" value="1">
												<label for="4_3">8. มีฟันคุด</label>
											</td>
											<td class="align-center">ผ่าฟันคุด</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_4]" id="4_4" class="checkbox" type="checkbox" value="1">
												<label for="4_4">9. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
											</td>
											<td class="align-center">ถอนฟันและรักษาโรคเหงือก</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_5]" id="4_5" class="checkbox" type="checkbox" value="1">
												<label for="4_5">10. มีอาการ บวม ปวดฟัน ปวดเหงือก</label>
											</td>
											<td class="align-center">ควรรับการตรวจเพิ่มเติมที่ รพ.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col">
								<div class="cell">
									<label for="etc">11. อื่นๆ (ระบุ)</label>
									<div>
										<textarea name="etc" id="etc" class="col width-3of5" rows="5"></textarea>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<label>ผู้ตรวจ: </label>
									<select name="officer">
										<option value="พ.อ. วีระยุทธ์ วงศ์จันทร์">พ.อ. วีระยุทธ์ วงศ์จันทร์</option>
										<option value="พ.อ.หญิง หนึ่งฤทัย มหายศนันท์">พ.อ.หญิง หนึ่งฤทัย มหายศนันท์</option>
										<option value="พ.ท.หญิง เกื้อกูล อาชามาส">พ.ท.หญิง เกื้อกูล อาชามาส</option>
										<option value="จ.ส.อ. เกล็ดแก้ว มะโนวงค์">จ.ส.อ. เกล็ดแก้ว มะโนวงค์</option>
										<option value="จ.ส.อ. วีระ นาคเอี่ยม">จ.ส.อ. วีระ นาคเอี่ยม</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<button type="submit" class="add_form_btn">เพิ่มข้อมูล</button>
								</div>
							</div>
						</form>
						<?php } ?>
					</div>
				</div>
				<?php } elseif( $task === 'fulldetail' ){ ?>
						
				<div class="col">
					<div class="cell">
						<?php
							$id = ( isset($_GET['id']) ) ? intval($_GET['id']) : false ;
							$print = ( isset($_GET['print']) ) ? trim($_GET['print']) : false ;
							if( $id === false ){ die('ไม่พบข้อมูล'); }
							
							$sql = "SELECT a.*, b.`name`
							FROM `survey_oral` AS a 
							LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
							WHERE a.`id` = :id LIMIT 1;";
							$item = DB::select($sql, array(':id' => $id), true);
							
							if( $item === false || count($item) === 0 ){
								?>
								<p>ไม่พบข้อมูลผู้ป่วย</p>
								<?php
							} else {
								
								$img_checked = '<img src="assets/img/den/box-checked.png" style="width: 16px;">';
						?>
							<h3>ผลตรวจสภาวะช่องปาก กำลังพล ทบ.</h3>
							<div class="cell">
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
								</div>
								<div class="input_form"><label for="date">วันที่ตรวจ:</label>&nbsp;<?php echo $item['date'];?></div>
								<div class="input_form"><label for="section">หน่วย:</label>&nbsp;<?php echo $item['name'];?></div>
								
							</div>
							<div class="cell">
								<div class="input_form">
									<label for="prefix">ชื่อ-สกุล: </label><?php echo $item['fullname'];?>
								</div>
								<div class="input_form">
									<label for="age">อายุ: </label><?php echo $item['age'];?> ปี
								</div>
								<div class="input_form">
									<label for="id_card">เลขบัตรประจำตัวประชาชน: </label><?php echo $item['id_card'];?>
								</div>
							</div>
							<div class="cell">
								<?php
								$status = unserialize($item['mouth_detail']);
								?>
								<table class="custom-table outline-header border box-header outline">
									<thead>
										<tr>
											<th class="align-center">สภาวะช่องปาก</th>
											<th class="align-center" width="5%">ระดับ</th>
											<th class="align-center" width="15%">คำแนะนำในการรักษา</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php $check = ( $status['1_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="1_1">1. สุขภาพช่องปากดี</label>
											</td>
											<td class="align-center">
												<?php
													if( $item['max_status'] == '1' ){
														?>
														<div class="circle-contain">
															<?php echo $img_checked;?>
															<span class="circle-number">1</span>
															
														<?php
													}else{
														?>1<?php
													}
												?>
											</td>
											<td class="align-center">ควรมารักษาทุก 6 เดือน</td>
										</tr>
										
										<tr>
											<td>
												<?php $check = ( $status['2_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="2_1">2. มีหินปูน มีเหงือกอักเสบ</label>
											</td>
											<td class="align-center">
												<?php
													if( $item['max_status'] == '2' ){
														?>
														<div class="circle-contain">
															<?php echo $img_checked;?>
															<span class="circle-number">2</span>
															
														</div>
														<?php
													}else{
														?>2<?php
													}
												?>
											</td>
											<td class="align-center">ขูดหินปูน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="3_1">3. มีฟันผุที่อุดได้</label>
											</td>
											<td class="align-center" rowspan="3">
												<?php
													if( $item['max_status'] == '3' ){
														?>
														<div class="circle-contain">
															<?php echo $img_checked;?>
															<span class="circle-number">3</span>
														</div>
														<?php
													}else{
														?>3<?php
													}
												?>
											</td>
											<td class="align-center">อุดฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_2'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="3_2">4. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
											</td>
											<td class="align-center">รักษาโรคเหงือก</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_3'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="3_3">5. สูญเสียฟันและจำเป็นต้องใส่ฟันทดแทน</label>
											</td>
											<td class="align-center">ใส่ฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_1">6. มีฟันผุทะลุโพรงประสาทที่รักษาคลองรากฟันได้</label>
											</td>
											<td class="align-center" rowspan="5">
												<?php
													if( $item['max_status'] == '4' ){
														?>
														<div class="circle-contain">
															<?php echo $img_checked;?>
															<span class="circle-number">4</span>
														</div>
														<?php
													}else{
														?>4<?php
													}
												?>
											</td>
											<td class="align-center">รักษาคลองรากฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_2'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_2">7. มีฟันผุทะลุโพรงประสาทที่ต้องถอน / มี RR</label>
											</td>
											<td class="align-center">ถอนฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_3'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_3">8. มีฟันคุด</label>
											</td>
											<td class="align-center">ผ่าฟันคุด</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_4'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_4">9. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
											</td>
											<td class="align-center">ถอนฟันและรักษาโรคเหงือก</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_5'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_5">10. มีอาการ บวม ปวดฟัน ปวดเหงือก</label>
											</td>
											<td class="align-center">ควรรับการตรวจเพิ่มเติมที่ รพ.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col">
								<div class="cell">
									<label for="etc">11. อื่นๆ (ระบุ)</label>&nbsp;<?php echo str_replace("\n", '<br>', $item['etc']);?>
									
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<label for=""><b>ผู้ตรวจ:</b></label>&nbsp;<?php echo $item['officer'];?>
								</div>
							</div>
							<div class="col" id="print_btn">
								<div class="cell">
									<button onclick="force_print()">สั่ง Print</button>
								</div>
							</div>
							<script type="text/javascript">
							function force_print(){
								window.print();
							}
							</script>
							<?php } // End check HN ?>
					</div>
				</div>
				<?php
					if( $print === 'yes' ){
						?>
						<script type="text/javascript">
						window.print();
						</script>
						<?php
					}
				?>
				
				<?php } else if( $task === 'category_form' ) { ?>
				<div class="col">
					<div class="cell">
						<div>
							<form action="survey_oral.php?action=section_form_save" method="post">
								<h3>เพิ่มชื่อหน่วยงาน</h3>
								<div class="col">
									<label for="section">ชื่อ</label>
									<input type="text" id="section" name="section">
								</div>
								<div class="col">
									<button type="submit">เพิ่ม</button>
								</div>
							</form>
						</div>
						<div class="col"><div class="cell"></div></div>
						<div class="col width-3of5 ">
							<h3>รายชื่อหน่วยงาน</h3>
							<table class="custom-table outline-header border box-header outline">
								<thead>
									<tr>
										<th>ชื่อ</th>
										<th width="20%">จัดการข้อมูล</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sql = "
									SELECT `id`,`name` FROM `survey_oral_category` ORDER BY `id` ASC;
									";
									$items = DB::select($sql);
									foreach($items as $key => $item){
									?>
									<tr>
										<td><?php echo $item['name'];?></td>
										<td>
											<a href="#">แก้ไข</a>
											 | 
											<a href="survey_oral.php?action=delete_category&id=<?php echo $item['id'];?>" class="survey_remove">ลบ</a>
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
				<?php } else if( $task === 'report' ) { ?>
				<?php
					$start_current_year = (date('Y')+543).'-01-01';
					$end_current_year = (date('Y')+543).'-12-31';
					$sql = "
SELECT `date`, `max_status`, COUNT(`max_status`) AS rows
FROM `survey_oral` 
WHERE `date` >= :date_start AND `date` <= :date_end 
GROUP BY `max_status` 
ORDER BY `date` DESC, `max_status` ASC 
					";
					$items = DB::select($sql, array(':date_start' => $start_current_year, ':date_end' => $end_current_year));
					
					$new_item_lists = array();
					$total_item_list = array();
					
					foreach ($items as $key => $item) {
						$set_key = $item['date'];
						$set_max_status = $item['max_status'];
						$new_item_lists[$set_key][$set_max_status] = $item;
						$total_item_list[$set_key] += $item['rows'];
					}
				?>
				<div class="col">
					<div class="cell">
						<h3>ผลการสำรวจสภาวะสุขภาพช่องปากกำลังพล ทบ.</h3>
						<table class="custom-table outline-header border box-header outline">
							<thead>
								<tr>
									<th rowspan="2">วันที่</th>
									<th rowspan="2">จำนวนผู้ได้รับการตรวจสุขภาพช่องปาก (ราย)</th>
									<th colspan="4" class="align-center">ระดับสภาวะสุขภาพช่องปาก(ราย)</th>
								</tr>
								<tr>
									<th class="align-center">1</th>
									<th class="align-center">2</th>
									<th class="align-center">3</th>
									<th class="align-center">4</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach($new_item_lists as $key => $items){
										
										list($y, $m, $d) = explode('-', $key);
										$th_month = $full_months[$m];
										$date = $d.' '.$th_month.' '.$y;
										
										$total = $total_item_list[$key];
								?>
								<tr>
									<td><?php echo $date;?></td>
									<td><?php echo $total;?></td>
								<?php
									$test_set = 1;
									for($test_set; $test_set <= 4; $test_set++){
										
										$rows = ' - ';
										if($items[$test_set]){
											$rows = $items[$test_set]['rows'];
										}
										
										?><td class="align-right"><?php echo $rows;?></td><?php
									} // End for
								?>
								</tr>
								<?php
									}
								?>
							</tbody>
						</table>
					</div>
				</div>
				<?php } elseif( $task === 'report_mouth' ){ ?>
				<?php
				$mouth_items = array(
					'1_1' => '1. สุขภาพช่องปากดี',
					'2_1' => '2. มีหินปูน มีเหงือกอักเสบ',
					'3_1' => '3. มีฟันผุที่อุดได้',
					'3_2' => '4. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด',
					'3_3' => '5. สูญเสียฟันและจำเป็นต้องใส่ฟันทดแทน',
					'4_1' => '6. มีฟันผุทะลุโพรงประสาทที่รักษาคลองรากฟันได้',
					'4_2' => '7. มีฟันผุทะลุโพรงประสาทที่ต้องถอน / มี RR',
					'4_3' => '8. มีฟันคุด',
					'4_4' => '9. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน',
					'4_5' => '10. มีอาการ บวม ปวดฟัน ปวดเหงือก',
				);
				?>
				<div class="col">
					<div class="cell">
						<h3>รายงานสภาวะช่องปาก ปี 2558</h3>
						<table class="custom-table outline-header border box-header outline width-2of5">
							<thead>
								<tr>
									<th>สภาวะช่องปาก</th>
									<th align="center">จำนวน</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($mouth_items as $key => $mouth): ?>
								<?php
								$sql = "SELECT COUNT(`hn`) AS `count` 
								FROM `survey_oral` 
								WHERE `date` LIKE '2558%' AND `mouth_detail` LIKE '%$key\";i:1%'";
								$item = DB::select($sql, null, true);
								?>
								<tr>
									<td><?php echo $mouth;?></td>
									<td align="center"><?php echo $item['count'];?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<br>
						<?php 
						$violences = array(1,2,3,4);
						?>
						<table class="custom-table outline-header border box-header outline width-2of5">
							<thead>
								<tr>
									<th>ระดับความรุนแรง</th>
									<th>จำนวน</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach($violences as $key => $vio): ?>
								<?php
								$sql = "SELECT COUNT(`hn`) AS `count` 
								FROM `survey_oral` 
								WHERE `date` LIKE '2558%' AND `max_status` = '$vio'";
								$item = DB::select($sql, null, true);
								?>
								<tr>
									<td>ความรุนแรงระดับ <?php echo $vio;?></td>
									<td align="center"><?php echo $item['count'];?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<div class="col" id="print_btn">
							<div class="cell">
								<button onclick="force_print()">สั่ง Print</button>
							</div>
						</div>
						<script type="text/javascript">
						function force_print(){
							window.print();
						}
						</script>
					</div>
				</div>
				
				<?php } // End task ?>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
$(function() {
	
	if( $('.survey_remove').length > 0 ){
		$(document).on('click', '.survey_remove', function(){
			var c = confirm('ยืนยันที่จะลบข้อมูล?');
			if( c == false ){
				return false;
			}
		});
	}
	
	if( $('.add_form_btn').length > 0 ){
		$(document).on('click', '.add_form_btn', function(){
			var c = confirm('ยืนยันยืนยันการเพิ่มข้อมูล?');
			if( c == false ){
				return false;
			}
		});
	}
		
	
});
})(jQuery);
</script>
<?php
include 'templates/classic/footer.php';
?>