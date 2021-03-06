<?php 
include 'bootstrap.php';
if(authen() === false ){ die('Session ������� <a href="login_page.php">��ԡ�����</a> ���ͷӡ���������к��ա����'); }

define('_SURVEY', 1);

// Load Databse
DB::load();

$db = Mysql::load();
// $db->set_charset('UTF8');

$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false ;
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false ;
$id = isset($_REQUEST['id']) ? intval($_REQUEST['id']) : false ;
$hn = isset($_REQUEST['hn']) ? trim($_REQUEST['hn']) : false ;
$th_date = ( date('Y')+543 ).date('-m-d');
// $full_months = array("���Ҥ�" => "01" ,"����Ҿѹ��" => "02", "�չҤ�" => "03" , "����¹" => "04" ,"����Ҥ�" => "05" ,"�Զع�¹" => "06" , "�á�Ҥ�" => "07" , "�ԧ�Ҥ�" => "08" , "�ѹ��¹" => "09" , "���Ҥ�"  => "10" , "��Ȩԡ�¹" => "11" ,  "�ѹ�Ҥ�" => "12" );

$full_months = array(
	"01" => "���Ҥ�",
	"02" => "����Ҿѹ��",
	"03" => "�չҤ�",
	"04" => "����¹",
	"05" => "����Ҥ�",
	"06" => "�Զع�¹",
	"07" => "�á�Ҥ�",
	"08" => "�ԧ�Ҥ�",
	"09" => "�ѹ��¹",
	"10" => "���Ҥ�",
	"11" => "��Ȩԡ�¹",
	"12" => "�ѹ�Ҥ�"
);

// �Ѵ��â����� Checkbox ����Ҥ���٧�ش
function serialize_and_setmax($mouth_detail){

	$details_filter = array(
		'1_1' => 1,
		'2_1' => 1,
		'2_2' => 1,
		'2_2_detail' => $mouth_detail['2_2_detail'],
		'3_1' => 1,
		'3_2' => 1,
		'3_3' => 1,
		'3_4' => 1,
		'3_5' => 1,
		'3_5_detail' => $mouth_detail['3_5_detail'],
		'4_1' => 1,
		'4_2' => 1,
		'4_3' => 1,
		'4_4' => 1,
		'4_5' => 1,
		'4_6' => 1,
		'4_6_detail' => $mouth_detail['4_6_detail']
	);
	
	$test_max_value = 0;
	
	$mouth_list = array();
	foreach($details_filter as $key => $val){
		
		// �������˹���١���Ҩж١���� 0
		// ���͹�� preg_match ���繢ͧ xxx_detail ����� string 
		$mouth_list[$key] = isset($mouth_detail[$key]) ? ( preg_match('/\d/', $val) === true ? intval($val) : $val ) : 0 ;
		
		// �Ҥ���٧�ش�ͧ �дѺ������آ�Ҿ��ͧ�ҡ
		// �� user xxx ��ꡪ�ͧ E,E,F �ж����Ҥ����ع�ç������дѺ 4
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
	
	$year_checkup = get_year_checkup();
	$sql = "SELECT `id`,`hn` FROM `survey_oral` WHERE `hn` = :hn AND `yearcheck` = '$year_checkup';";
	// DB::select($sql, array(':hn' => $_POST['hn']));
	$db->select($sql, array(':hn' => $_POST['hn']));
	$item = $db->get_item();
	$rows = count($item);

	// $rows = DB::rows();
	if( $rows > 0 ){
		// redirect('survey_oral.php', 'HN: '.$_POST['hn'].' �ºѹ�֡����������º����������ͺ�է�����ҳ '.$year_checkup);
		// exit;
	}
	
	$item = serialize_and_setmax($_POST['mouth_detail']);

	// dump($_POST);
	// dump($item);
	// exit;

	$lists = $item['details'];
	$test_max_value = $item['max'];
	
	$sql = "INSERT INTO `survey_oral` (
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
		`max_status`,
		`yearcheck`
	)
	VALUES (
		NULL , :hn, :date, :section, :fullname, :age, :id_card, :etc, :officer, :mouth_detail, NOW(), NULL, '1', :max_status, :yearcheck
	);";
	
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
		':max_status' => $test_max_value,
		':yearcheck' => $year_checkup
	);
	
	$insert = $db->insert($sql, $data);
	// $insert = DB::exec($sql, $data);
	$msg = '�ѹ�֡���������º����';
	if( $insert['error'] ){
		$msg = errorMsg(false, $insert['id']);
	}
	
	// $last_id = DB::get_lastId();
	$last_id = $db->get_last_id();
	redirect('survey_oral.php?task=fulldetail&id='.$last_id.'&print=yes', $msg);
	exit;
} else if( $action === 'save_edit' ){
	
	$item = serialize_and_setmax($_POST['mouth_detail']);
	$list = $item['details'];
	$test_max_value = $item['max'];

	// dump($_POST);
	// dump($item);
	// exit;

	$sql = "UPDATE `survey_oral` SET 
	`date`=:date,
	`section`=:section,
	`mouth_detail`=:mouth_detail,
	`etc`=:etc, 
	`officer`=:officer,
	`date_edit`=:date_edit,
	`max_status`=:max_status,
	`add_by`=:add_by 
	WHERE  `id` = :id;";

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

	$update = $db->update($sql, $data);
	// $update = DB::exec($sql, $data);
	
	$msg = '�ѹ�֡���������º����';
	if( $update['error'] ){
		$msg = errorMsg('update', $update['id']);
	}
	
	redirect('survey_oral.php?task=fulldetail&id='.$_POST['id'].'&print=yes', $msg);
	exit;
	
} else if( $action === 'delete' ){
	
	if( $id === false ){
		echo "���������١��ͧ";
		exit;
	}
	
	$sql = "DELETE FROM `survey_oral` WHERE `survey_oral`.`id` = :id LIMIT 1";
	$delete = $db->delete( $sql, array(':id' => $id) );
	// $delete = DB::exec($sql, array(':id' => $id) );
	$msg = 'ź���������º����';
	if( $delete['error'] ){
		$msg = errorMsg('delete', $delete['id']);
	}
	
	redirect('survey_oral.php', $msg);
	exit;
} else if( $action === 'section_form_save' ){
	
	$name = isset($_POST['section']) ? trim($_POST['section']) : false ;
	
	$sql = "INSERT INTO `smdb`.`survey_oral_category` (`id` ,`name` ,`date_add` ,`date_edit` )
	VALUES (
	NULL , :name, NOW(), NULL
	);";
	$insert = $db->insert($sql, array(':name' => $name));
	
	$msg = '�ѹ�֡���������º����';
	if( $insert['error'] ){
		$msg = errorMsg(NULL, $insert['id']);
	}
	
	redirect('survey_oral.php?task=category_form', $msg);
	exit;
} else if( $action === 'section_form_edit' ){
	
	$name = isset($_POST['section']) ? trim($_POST['section']) : '' ;
	$sql = "UPDATE `survey_oral_category` SET 
	`name`=:name,
	`date_edit`=NOW()
	WHERE `id` = :id;";
	$update = $db->update($sql, array(':name' => $name, ':id' => $id));
	
	$msg = '�ѹ�֡���������º����';
	if( $update['error'] ){
		$msg = errorMsg('update', $update['id']);
	}
	redirect('survey_oral.php?task=category_form', $msg);
	exit;
	
} else if( $action === 'delete_category' ){
	
	if( $id === false ){
		redirect('survey_oral.php?task=category_form', '���������١��ͧ ��سҵ�Ǩ�ͺ����');
		exit;
	}
	
	$sql = "DELETE FROM `survey_oral_category` 
	WHERE `id` = :id LIMIT 1";
	$delete = $db->delete($sql, array(':id' => $id));
	
	$msg = 'ź���������º����';
	if( $delete['error'] ){
		$msg = errorMsg('delete', $delete['id']);
	}
	
	redirect('survey_oral.php?task=category_form', 'ź���������º����');
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
.align-left{
	text-align: left;
	vertical-align: middle;
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
                
				<?php include 'templates/dentistry/nav.php'; ?>
				
				<?php 
				if( $task === false ){ // ˹���á
				
					$by = isset($_POST['by']) ? trim($_POST['by']) : false ;
					include 'templates/dentistry/survey_home.php';
					
				} elseif( $task === 'form' ){ //˹�ҿ��������������
					include 'templates/dentistry/survey_form.php';
					
				} elseif( $task === 'fulldetail' ){ //˹���ʴ���������´��������鹷�
					include 'templates/dentistry/fulldetail.php';
					
				} else if( $task === 'category_form' ) { // ˹��������Ǵ����
					include 'templates/dentistry/category_form.php';
				
				} else if( $task === 'category_edit' ) { //�����Ǵ����
					$id = ( isset($_GET['id']) ) ? intval(trim($_GET['id'])) : false ;
					
					if( $id !== false ){
						$sql = "SELECT * FROM `survey_oral_category` WHERE `id` = :id;";
						$db->select($sql, array(':id' => $id));
						$item = $db->get_item();
					}
					
					include 'templates/dentistry/category_form.php'; 
					
				}else if( $task === 'report' ) { // ��§ҹ�š�����Ǩ
					include 'templates/dentistry/survey_report.php';
				
				} elseif( $task === 'report_mouth' ){ // ��§ҹ����Ъ�ͧ�ҡ����дѺ
					include 'templates/dentistry/report_mouth.php';
					
				} elseif( $task === 'hn_lists' ){ // ��ª��� hn �ͧ�дѺ�����ع�ç
					include 'templates/dentistry/hn_lists.php';
					
				} // End task
				?>
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
			var c = confirm('�׹�ѹ����ź������?');
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