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

function serialize_and_setmax($mouth_detail){
	
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
		'4_6' => 1,
		'5_1' => 1,
	);
	
	$test_max_value = 0;
	
	$mouth_list = array();
	foreach($details_filter as $key => $val){
		
		// คีย์ตัวไหนไม่ถูกส่งมาจะถูกเซ็ตเป็น 0
		$mouth_list[$key] = isset($mouth_detail[$key]) ? intval($val) : 0 ;
		
		// หาค่าสูงสุดของ ระดับสภาวะสุขภาพช่องปาก
		// เช่น user xxx ติ๊กช่อง E,E,F จะถือว่าความรุนแรงอยู่ในระดับ 4
		preg_match('/^\d{1,}/', $key, $match);
		if( !empty($match['0']) && $mouth_list[$key] == 1 ){
			$test_max_value = $match['0'];
		}
	}
	
	$lists = array(
		'details' => serialize($mouth_list),
		'max' => $test_max_value
	);
	
	return $lists;
}

if($action === 'save'){
	
	$item = serialize_and_setmax($_POST['mouth_detail']);
	$lists = $item['details'];
	$test_max_value = $item['max'];
	
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
	// if($insert === false){
	// 	$msg = 'บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ';
	// }
	
	$last_id = DB::get_lastId();
	redirect('survey_oral.php?task=fulldetail&id='.$last_id.'&print=yes', $msg);
	exit;
} else if( $action === 'save_edit' ){
	
	$item = serialize_and_setmax($_POST['mouth_detail']);
	$list = $item['details'];
	$test_max_value = $item['max'];

	$sql = "
	UPDATE `survey_oral` SET 
	`date`=:date,
	`section`=:section,
	`mouth_detail`=:mouth_detail,
	`etc`=:etc, 
	`officer`=:officer,
	`date_edit`=:date_edit,
	`max_status`=:max_status,
	`add_by`=:add_by 
	WHERE  `id` = :id;
	";
	$data = array(
		'date' => $_POST['date'],
		'section' => $_POST['section'],
		'mouth_detail' => $list,
		'etc' => $_POST['etc'],
		'officer' => $_POST['officer'],
		'date_edit' => date('Y-m-d H:i:s'),
		'max_status' => $test_max_value,
		'add_by' => $_POST['add_by'],
		'id' => $_POST['id'],
	);
	$update = DB::exec($sql, $data);
	
	$msg = 'บันทึกข้อมูลเรียบร้อย';
	if($insert === false){
		$msg = 'บันทึกข้อมูลไม่สำเร็จ กรุณาติดต่อผู้ดูแลระบบ';
	}
	
	redirect('survey_oral.php?task=fulldetail&id='.$_POST['id'].'&print=yes', $msg);
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
	#detail_header_print{
		font-size: 16px;
		text-align: center;
	}
	#officer-print{
		text-align: right;
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
				<?php include 'templates/dentistry/survey_home.php'; ?>
				
				<?php } elseif( $task === 'form' ){ ?>
				<?php include 'templates/dentistry/survey_form.php'; ?>
				
				<?php } elseif( $task === 'fulldetail' ){ ?>
				<?php include 'templates/dentistry/fulldetail.php'; ?>
				
				<?php } else if( $task === 'category_form' ) { ?>
				<?php include 'templates/dentistry/category_form.php'; ?>
				
				<?php } else if( $task === 'report' ) { // รายงานผลการสำรวจ ?>
				<?php include 'templates/dentistry/survey_report.php'; ?>
				
				<?php } elseif( $task === 'report_mouth' ){ // รายงานสภาวะช่องปากและระดับ ?>
				<?php include 'templates/dentistry/report_mouth.php'; ?>
				
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