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
	
	$mouth_list = array();
	foreach($details_filter as $key => $val){
		$mouth_list[$key] = isset($_POST['mouth_detail'][$key]) ? $val : 0 ;
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
		`status`
	)
	VALUES (
		NULL , :hn, :date, :section, :fullname, :age, :id_card, :etc, :officer, :mouth_detail, NOW(), NULL, '1'
	);
	";
	
	$data = array(
		':hn' => $_POST['hn'],
		':date' => $_POST['date'],
		':section' => trim($_POST['section']),
		':fullname' => trim($item['yot']).' '.trim($_POST['firstname']).' '.trim($_POST['lastname']),
		':age' => $_POST['age'],
		':id_card' => $_POST['id_card'],
		':etc' => $_POST['etc'],
		':officer' => $_SESSION['sOfficer'],
		':mouth_detail' => $lists
	);
	$insert = DB::exec($sql, $data);
	$msg = 'บันทึกข้อมูลเรียบร้อย';
	if($insert === false){
		$msg = 'บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ';
	}
	
	redirect('survey_oral.php', $msg);
	exit;
} else if( $action === 'section_form_save' ){
	
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
include 'templates/default/header.php';
?>
<style type="text/css">
@media print {
	.site-center,
	.site-body panel{
		width: 100%!important;
		height: 100%!important;
		margin: 0!important;
	}
	.nav-menu-col,
	.page-header-col{
		display: none!important;
	}
}

.input_form{
	display: inline-block;
	margin-bottom: 0.5em;
}
.input_form label{
	font-weight: bold;
}
.align-center{
	text-align: center;
	vertical-align: middle;
}
.custom-table{
	
}
.custom-table input{
	width: auto;
}
.custom-table table{
	margin: 0;
}

/* Fix calendar CSS */
#popup1_calendar{
	width: 26%;
}
select, input{
	width: auto!important;
	height: auto !important;
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
						?>
						<ul class="nav">
							<li <?php echo $home_active;?>><a href="survey_oral.php">หน้าหลัก</a></li>
							<li <?php echo $form_active;?>><a href="survey_oral.php?task=form">เพิ่มข้อมูลแบบสำรวจ</a></li>
							<li><a href="survey_oral.php?task=category_form">จัดการข้อมูลหน่วยงาน</a></li>
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
									<th>วันที่ทำการตรวจ</th>
									<th align="center">จัดการข้อมูล</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									$sql = "SELECT * FROM `survey_oral` ORDER BY `id` DESC;";
									$items = DB::select($sql);
									foreach($items as $item){
										
										list($y, $m, $d) = explode('-', $item['date']);
										$th_full_date = $d.' '.$full_months[$m].' '.$y;
								?>
								<tr>
									<td><a href="survey_oral.php?task=fulldetail&id=<?php echo $item['id'];?>" title="คลิกเพื่อดูข้อมูลแบบเต็ม"><?php echo $item['hn'];?></a></td>
									<td><?php echo $item['fullname'];?></td>
									<td><?php echo $th_full_date;?></td>
									<td>
										<a href="#">แก้ไข</a> | 
										<a href="#" class="survey_remove">ลบ</a>
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
						$item = DB::select($sql, array(':hn' => $hn), true);
						if($item !== null){
							
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
							<div>
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
									<input id="hn" name="hn" type="hidden" value="<?php echo $item['hn'];?>">
									</div>
								<div class="input_form"><label for="date">วันที่ตรวจ</label><input class="text width-2of5" id="date" name="date" type="text" value="<?php echo $th_date;?>"></div>
								<div class="input_form"><label for="section">หน่วย</label><input class="text" id="section" name="section" type="text"></div>
								
							</div>
							<div>
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
							<div>
								<div class="input_form">
									<label for="age">อายุ: </label><?php echo $age;?> ปี
									<input id="age" name="age" type="hidden" value="<?php echo $age;?>">
								</div>
								<div class="input_form">
									<label for="id_card">เลขบัตรประจำตัวประชาชน: </label><?php echo $item['idcard'];?>
									<input id="id_card" name="id_card" type="hidden" value="<?php echo $item['idcard'];?>">
								</div>
							</div>
							<div>
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
									<button type="submit">เพิ่มข้อมูล</button>
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
							if( $id === false ){ die('ไม่พบข้อมูล'); }
							
							$sql = "SELECT * FROM `survey_oral` WHERE `id` = :id LIMIT 1;";
							$item = DB::select($sql, array(':id' => $id), true);
							
							if( $item === false || count($item) === 0 ){
								?>
								<p>ไม่พบข้อมูลผู้ป่วย</p>
								<?php
							} else {
						?>
							<h3>แสดงรายละเอียดผู้ป่วยที่ได้รับการตรวจสภาวะช่องปาก</h3>
							<div>
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
								</div>
								<div class="input_form"><label for="date">วันที่ตรวจ</label><?php echo $item['date'];?></div>
								<div class="input_form"><label for="section">หน่วย</label><?php echo $item['section'];?></div>
								
							</div>
							<div>
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
							<div>
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
												<?php $check = ( $status['1_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="1_1">1. สุขภาพช่องปากดี</label>
											</td>
											<td class="align-center">1</td>
											<td class="align-center">ควรมารักษาทุก 6 เดือน</td>
										</tr>
										
										<tr>
											<td>
												<?php $check = ( $status['2_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="2_1">2. มีหินปูน มีเหงือกอักเสบ</label>
											</td>
											<td class="align-center">2</td>
											<td class="align-center">ขูดหินปูน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="3_1">3. มีฟันผุที่อุดได้</label>
											</td>
											<td class="align-center" rowspan="3">3</td>
											<td class="align-center">อุดฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_2'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="3_2">4. เป็นโรคปริทันต์อักเสบที่ยังรักษาได้ ไม่มีอาการปวด</label>
											</td>
											<td class="align-center">รักษาโรคเหงือก</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_3'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="3_3">5. สูญเสียฟันและจำเป็นต้องใส่ฟันทดแทน</label>
											</td>
											<td class="align-center">ใส่ฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_1">6. มีฟันผุทะลุโพรงประสาทที่รักษาคลองรากฟันได้</label>
											</td>
											<td class="align-center" rowspan="5">4</td>
											<td class="align-center">รักษาคลองรากฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_2'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_2">7. มีฟันผุทะลุโพรงประสาทที่ต้องถอน / มี RR</label>
											</td>
											<td class="align-center">ถอนฟัน</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_3'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_3">8. มีฟันคุด</label>
											</td>
											<td class="align-center">ผ่าฟันคุด</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_4'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_4">9. เป็นโรคปริทันต์อักเสบ ฟันโยกมากต้องถอน</label>
											</td>
											<td class="align-center">ถอนฟันและรักษาโรคเหงือก</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_5'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
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
										<p><?php echo str_replace("\n", '<br>', $item['etc']);?></p>
									</div>
								</div>
							</div>
							<?php } // End check HN ?>
					</div>
				</div>
				<?php } else if( $task === 'category_form' ) { ?>
				<div class="col">
					<div class="cell">
						<div>
							<form action="survey_oral.php?action=section_form_save" method="post">
								<label for="section">เพิ่มชื่อหน่วยงาน</label>
								<input type="text" id="section" name="section">
								<button>เพิ่ม</button>
							</form>
						</div>
						<div>
							รายชื่อหน่วยงาน
							<table>
								<thead>
									<tr>
										<th>ชื่อ</th>
										<th>จัดการข้อมูล</th>
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
		
	
});
})(jQuery);
</script>
<?php
include 'templates/default/footer.php';
?>