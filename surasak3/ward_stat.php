<?php
include 'bootstrap.php';
if( !authen() ) die ('กรุณาเข้าสู่ระบบ <a href="login_page.php">คลิกที่นี่เพื่อเข้าสู่ระบบอีกครั้ง</a>');

define('WARD_STAT', 1);

DB::load();

/**
 * จัดการข้อมูล
 */
// การกระทำต่างๆ เช่น บันทึก, แก้ไข, ลบ
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false;
$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false;

// หน้าต่างการแสดงผลต่างๆ เช่น หน้ารายการ, หน้าฟอร์ม
$page = isset($_REQUEST['page']) ? trim($_REQUEST['page']) : false;

// จุดการแสดงผลในหน้านั้นๆ
$view = isset($_REQUEST['view']) ? trim($_REQUEST['view']) : false;

// 
if( !function_exists('clean_dead_hn') ){
	function clean_dead_hn($post){
		$dead_lists = array();
		$test_count = count($post['dead_hn']);
		for( $i=0; $i<$test_count; $i++ ){
			
			// skip if empty
			if( empty($post['dead_hn'][$i]) ) continue ;
			
			$pre_item = array(
				'dead_hn' => $post['dead_hn'][$i],
				'dead_name' => $post['dead_name'][$i],
				'dead_an' => $post['dead_an'][$i],
			);
			
			if( isset($post['dead_id'][$i]) ){
				$pre_item['dead_id'] = $post['dead_id'][$i];
			}
			
			$dead_lists[] = $pre_item;
		}
		return $dead_lists;
	}
}

function getAcuList(){
	$default_acu = array(
		'1_1' => 0, '1_2' => 0, 
		'2_1' => 0, '2_2' => 0, 
		'3_1' => 0, '3_2' => 0, 
		'4_1' => 0, '4_2' => 0, 
		'5_1' => 0, '5_2' => 0, 
		'6_1' => 0, '6_2' => 0, 
		'7_1' => 0, '7_2' => 0, 
		'8_1' => 0, '8_2' => 0, 
		'9_1' => 0, '9_2' => 0, 
		'10_1' => 0, '10_2' => 0, 
		'11_1' => 0, '11_2' => 0, 
		'12_1' => 0, '12_2' => 0, 
		'13_1' => 0, '13_2' => 0, 
		'14_1' => 0, '14_2' => 0, 
		'15_1' => 0, '15_2' => 0, 
		'16_1' => 0, '16_2' => 0, 
	);
	return $default_acu;
}
	
function getPorjaiList(){
	$default_porjai = array(
		'porjai1' => 0, 'porjai2' => 0, 'porjai3' => 0
	);
	return $default_porjai;
}


if( $action === 'add' ){

	//
	$post = filter_post($_POST, '');
	$officer = get_session('sOfficer');
	$officer_id = get_session('sRowid');

	// ข้อมูลผู้เสียชีวิต
	$dead_lists = clean_dead_hn($post);
	$dead_rows = count($dead_lists);
	
	// สำหรับสูติ
	$newborn_active = isset($post['newborn_active']) ? intval($post['newborn_active']) : false ;

	$type = $newborn_active === false ? '' : 'obgyn' ;
	$date_write = $post['date_year'].'-'.$post['date_month'];
	$sql = "INSERT INTO `ward_stat` (
	`id` ,
	`department` ,
	`date_write` ,
	`all_patient` ,
	`prev_patient` ,
	`new_patient` ,
	`all_admit` ,
	`prev_admit` ,
	`new_admit` ,
	`avg_bed` ,
	`all_bed` ,
	`refer_patient` ,
	`disc_patient` ,
	`date_add` ,
	`author` ,
	`author_id` ,
	`type`,
	`status`
	)
	VALUES (
	NULL , :department, :date_write, :all_patient, :prev_patient, :new_patient, 
	:all_admit, :prev_admit, :new_admit, :avg_bed, :all_bed, :refer_patient, 
	:disc_patient, NOW(), :author, :author_id, :type, 1
	);";

	$data = array(
		':department' => $post['department'],
		':date_write' => $date_write,
		':all_patient' => $post['all_patient'],
		':prev_patient' => $post['prev_patient'],
		':new_patient' => $post['new_patient'],
		':all_admit' => $post['all_admit'],
		':prev_admit' => $post['prev_admit'],
		':new_admit' => $post['new_admit'],
		':avg_bed' => $post['avg_bed'],
		':all_bed' => $post['all_bed'],
		':refer_patient' => $post['refer_patient'],
		':disc_patient' => $post['disc_patient'],
		'author' => $officer,
		'author_id' => $officer_id,
		':type' => $type,
	);
	
	DB::exec($sql, $data);
	$id = DB::get_lastId();

	// เพิ่มข้อมูลผู้เสียชีวิต
	if( $dead_rows > 0 ){

		$sql = "INSERT INTO `smdb`.`ward_dead_stat` (`id` ,`ward_stat_id` ,`name` ,`hn` ,`an`)
		VALUES (NULL , :ward_stat_id, :name, :hn, :an);";

		foreach($dead_lists as $key => $list ){
			$data = array(
				':ward_stat_id' => $id,
				':name' => $list['dead_name'],
				':hn' => $list['dead_hn'],
				':an' => $list['dead_an'],
			);
			DB::exec($sql, $data);
		}
	}

	// เพิ่มข้อมูลสำหรับสูติ
	if( $newborn_active > 0 ){
		$sql = "INSERT INTO `ward_baby_stat` (
		`id` ,
		`ward_stat_id` ,
		`all_baby` ,
		`dead_baby` ,
		`dead_baby_reason` ,
		`baby_seven` ,
		`baby_seven_reason` ,
		`dead_mother` ,
		`dead_mother_reason` ,
		`all_mother` ,
		`all_cs` ,
		`prev_cs` ,
		`first_cs` ,
		`mother_cp` ,
		`eclampsia` ,
		`embolism` ,
		`blood_cp` ,
		`broke_cp` ,
		`infected_cp` ,
		`placenta_cp` ,
		`etc_cp` ,
		`etc_cp_reason` ,
		`hypoxia` ,
		`milk` ,
		`nl` ,
		`ve` ,
		`fe`
		)
		VALUES (
		NULL , :ward_stat_id, :all_baby, :dead_baby, :dead_baby_reason, :baby_seven, :baby_seven_reason,
		:dead_mother, :dead_mother_reason, :all_mother, :all_cs, :prev_cs, :first_cs, :mother_cp,
		:eclampsia, :embolism, :blood_cp, :broke_cp, :infected_cp, :placenta_cp, :etc_cp, :etc_cp_reason,
		:hypoxia, :milk, :nl, :ve, :fe
		);";
		$data = array(
			':ward_stat_id' => $id, ':all_baby' => $post['all_baby'], ':dead_baby' => $post['dead_baby'], ':dead_baby_reason' => $post['dead_baby_reason'], ':baby_seven' => $post['baby_seven'],
			':baby_seven_reason' => $post['baby_seven_reason'], ':dead_mother' => $post['dead_mother'], ':dead_mother_reason' => $post['dead_mother_reason'], ':all_mother' => $post['all_mother'], ':all_cs' => $post['all_cs'],
			':prev_cs' => $post['prev_cs'], ':first_cs' => $post['first_cs'], ':mother_cp' => $post['mother_cp'], ':eclampsia' => $post['eclampsia'], ':embolism' => $post['embolism'],
			':blood_cp' => $post['blood_cp'], ':broke_cp' => $post['broke_cp'], ':infected_cp' => $post['infected_cp'], ':placenta_cp' => $post['placenta_cp'], ':etc_cp' => $post['etc_cp'],
			':etc_cp_reason' => $post['etc_cp_reason'], ':hypoxia' => $post['hypoxia'], ':milk' => $post['milk'], ':nl' => $post['nl'], ':ve' => $post['ve'], ':fe' => $post['fe']
		);
		DB::exec($sql, $data);
	}

	redirect('ward_stat.php', 'บันทึกข้อมูลเรียบร้อย');
	exit;
} elseif ( $action === 'edit' ) {
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : false ;
	$officer = get_session('sOfficer');
	
	//
	$post = filter_post($_POST, '');
	
	// ข้อมูลผู้เสียชีวิต
	$dead_lists = clean_dead_hn($post);
	$dead_rows = count($dead_lists);
	
	$date_write = $post['date_year'].'-'.$post['date_month'];
	$newborn_active = isset($post['newborn_active']) ? intval($post['newborn_active']) : false ;
	
	$sql = "UPDATE `ward_stat` SET `department`=:department, 
	`date_write`=:date_write, `all_patient`=:all_patient, 
	`new_patient`=:new_patient, `all_admit`=:all_admit, 
	`prev_admit`=:prev_admit, `new_admit`=:new_admit, 
	`avg_bed`=:avg_bed, `all_bed`=:all_bed, 
	`refer_patient`=:refer_patient, `disc_patient`=:disc_patient, 
	`date_edit`=NOW(), `author_edit`=:author_edit
	WHERE `id`=:id;";
	$data = array(
		':department' => $post['department'], ':date_write' => $date_write, 
		':all_patient' => $post['all_patient'], ':new_patient' => $post['new_patient'], 
		':all_admit' => $post['all_admit'], ':prev_admit' => $post['prev_admit'], 
		':new_admit' => $post['new_admit'], ':avg_bed' => $post['avg_bed'], 
		':all_bed' => $post['all_bed'], ':refer_patient' => $post['refer_patient'], 
		':disc_patient' => $post['disc_patient'], ':author_edit' => $officer, 
		':id' => $id, 
	);
	DB::exec($sql, $data);

	if( $dead_rows > 0 ){
		
		//ลบตัวเดิมออกไปก่อน
		$sql = "DELETE FROM `ward_dead_stat` WHERE `ward_stat_id`=:ward_stat_id ;";
		DB::exec($sql, array(':ward_stat_id' => $id));
		
		$sql = "INSERT INTO `smdb`.`ward_dead_stat` (`id` ,`ward_stat_id` ,`name` ,`hn` ,`an`)
		VALUES (NULL , :ward_stat_id, :name, :hn, :an);";
		foreach($dead_lists as $key => $list ){
			$data = array(
				':ward_stat_id' => $id,
				':name' => $list['dead_name'],
				':hn' => $list['dead_hn'],
				':an' => $list['dead_an'],
			);
			DB::exec($sql, $data);
		}
		
	}
	
	if( $newborn_active > 0 ){
		$sql = "UPDATE `ward_baby_stat` SET 
		`all_baby`=:all_baby ,
		`dead_baby`=:dead_baby ,
		`dead_baby_reason`=:dead_baby_reason ,
		`baby_seven`=:baby_seven ,
		`baby_seven_reason`=:baby_seven_reason ,
		`dead_mother`=:dead_mother ,
		`dead_mother_reason`=:dead_mother_reason ,
		`all_mother`=:all_mother ,
		`all_cs`=:all_cs ,
		`prev_cs`=:prev_cs ,
		`first_cs`=:first_cs ,
		`mother_cp`=:mother_cp ,
		`eclampsia`=:eclampsia ,
		`embolism`=:embolism ,
		`blood_cp`=:blood_cp ,
		`broke_cp`=:broke_cp ,
		`infected_cp`=:infected_cp ,
		`placenta_cp`=:placenta_cp ,
		`etc_cp`=:etc_cp ,
		`etc_cp_reason`=:etc_cp_reason ,
		`hypoxia`=:hypoxia ,
		`milk`=:milk ,
		`nl`=:nl ,
		`ve`=:ve ,
		`fe`=:fe
		WHERE `ward_stat_id` = :ward_id
		";
		$data = array(
			':all_baby' => $post['all_baby'], ':dead_baby' => $post['dead_baby'], ':dead_baby_reason' => $post['dead_baby_reason'], ':baby_seven' => $post['baby_seven'],
			':baby_seven_reason' => $post['baby_seven_reason'], ':dead_mother' => $post['dead_mother'], ':dead_mother_reason' => $post['dead_mother_reason'], ':all_mother' => $post['all_mother'], ':all_cs' => $post['all_cs'],
			':prev_cs' => $post['prev_cs'], ':first_cs' => $post['first_cs'], ':mother_cp' => $post['mother_cp'], ':eclampsia' => $post['eclampsia'], ':embolism' => $post['embolism'],
			':blood_cp' => $post['blood_cp'], ':broke_cp' => $post['broke_cp'], ':infected_cp' => $post['infected_cp'], ':placenta_cp' => $post['placenta_cp'], ':etc_cp' => $post['etc_cp'],
			':etc_cp_reason' => $post['etc_cp_reason'], ':hypoxia' => $post['hypoxia'], ':milk' => $post['milk'], ':nl' => $post['nl'], ':ve' => $post['ve'], ':fe' => $post['fe'], 
			':ward_id' => $id, 
		);
		DB::exec($sql, $data);
		
	}
	
	redirect('ward_stat.php', 'บันทึกข้อมูลเรียบร้อย');
	exit;
} elseif ( $action === 'delete' ) {
	
	$id = getId();
	$sql = "UPDATE `ward_stat` SET `status` = '0' WHERE `id`=:id LIMIT 1 ;";
	DB::exec($sql, array(':id' => $id));
	
	// $sql = "DELETE FROM `ward_stat` WHERE `id`=:id ;";
	// DB::exec($sql, array(':id' => $id));
	
	// $sql = "DELETE FROM `ward_dead_stat` WHERE `ward_stat_id`=:ward_stat_id ;";
	// DB::exec($sql, array(':ward_stat_id' => $id));
	
	// $sql = "DELETE FROM `ward_baby_stat` WHERE `ward_stat_id`=:ward_stat_id ;";
	// DB::exec($sql, array(':ward_stat_id' => $id));
	
	redirect('ward_stat.php', 'ลบข้อมูลเรียบร้อย');
	exit;
} elseif ( $action === 'acu_save' ) {
	
	$default_acu = getAcuList();
	$default_porjai = getPorjaiList();
	
	$post = filter_post($_POST, '');
	$officer = get_session('sOfficer');
	$officer_id = get_session('sRowid');
	$date_write = $post['date_year'].'-'.$post['date_month'];
	
	// Clean data
	$pre_patient_num = array();
	foreach($default_acu as $key => $item){
		$pre_patient_num[$key] = (!empty($post[$key])) ? $post[$key] : $item ;
	}
	$patient_num = serialize($pre_patient_num);
	
	$pre_porjai = array();
	foreach($default_porjai as $key => $item){
		$pre_porjai[$key] = (!empty($post[$key])) ? $post[$key] : $item ;
	}
	$porjai = serialize($pre_porjai);
	
	
	$sql = "INSERT INTO `smdb`.`ward_acu` (
`id` ,
`date_write` ,
`patient_num` ,
`porjai` ,
`auther` ,
`auther_id` ,
`auther_edit` ,
`date_add` ,
`date_edit`,
`status`
)
VALUES (
NULL , :date_write, :patient_num, :porjai, :auther, :auther_id, NULL , NOW(), NULL, 1
)";

	$data = array(
		':date_write' => $date_write,
		':patient_num' => $patient_num,
		':porjai' => $porjai,
		':auther' => $officer,
		':auther_id' => $officer_id,
	);
	
	$insert = DB::exec($sql, $data);
	$msg = 'บันทึกข้อมูลเรียบร้อย';
	if( $insert['error'] ){
		$msg = 'ไม่สามารถบันทึกข้อมูลได้ กรุณาติดต่อโปรแกรมเมอร์';
	}
	
	redirect('ward_stat.php?page=home_acu', $msg);
	exit;
} elseif ( $action === 'acu_edit' ) {
	
	$default_acu = getAcuList();
	$default_porjai = getPorjaiList();
	
	$post = filter_post($_POST, '');
	$officer = get_session('sOfficer');
	$date_write = $post['date_year'].'-'.$post['date_month'];
	
	// Clean data
	$pre_patient_num = array();
	foreach($default_acu as $key => $item){
		$pre_patient_num[$key] = (!empty($post[$key])) ? $post[$key] : $item ;
	}
	$patient_num = serialize($pre_patient_num);
	
	$pre_porjai = array();
	foreach($default_porjai as $key => $item){
		$pre_porjai[$key] = (!empty($post[$key])) ? $post[$key] : $item ;
	}
	$porjai = serialize($pre_porjai);
	
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : false ;
	
	$sql = "UPDATE `smdb`.`ward_acu` SET `date_write` = :date_write,
`patient_num` = :patient_num,
`porjai` = :porjai,
`auther_edit` = :auther_edit,
`date_edit` = NOW() WHERE `id` = :ward_id LIMIT 1 ;";

	$data = array(
		':date_write' => $date_write,
		':patient_num' => $patient_num,
		':porjai' => $porjai,
		':auther_edit' => $officer,
		':ward_id' => $id,
	);
	$update = DB::exec($sql, $data);
	
	$msg = "บันทึกข้อมูลเรียบร้อย";
	if( $update['error'] ){
		$msg = "ไม่สามารถบันทึกข้อมูลได้";
	}
	
	redirect('ward_stat.php?page=home_acu', $msg);
	exit;
} elseif ( $action === 'delete_acu' ) {
	
	$id = getId();
	$sql = "UPDATE `ward_acu` SET `status` = '0' WHERE `ward_acu`.`id` = :id LIMIT 1 ;";
	$delete = DB::exec($sql, array(':id' => $id));
	$msg = 'ลบข้อมูลเรียบร้อย';
	if( $delete['error'] ){
		$msg = 'ไม่สามารถลบข้อมูลได้';
	}
	redirect('ward_stat.php?page=home_acu', $msg);
	exit;
}

/**
 * แสดงในส่วนของ view
 */
$title = 'สถิติของผู้ป่วยประจำเดือน';
include 'templates/classic/header.php';

?>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
			<?php
			// เมนู กับ notification
			include 'templates/ward/nav.php';
			
			if( $page === false ){ // Home && Default page

				$limit = 20;
				$sql = "SELECT `id`,`department`,`date_write`,`date_add`,`author`,`type` 
				FROM `ward_stat` 
				WHERE `status` = 1
				ORDER BY `id` DESC 
				#LIMIT $limit";
				$items = DB::select($sql);

				include 'templates/ward/home.php';

			}elseif( $page === 'form' ){
				
				$id = getId();

				// ถ้ามี id แสดงว่าเป็นการ edit
				if( $id !== false ){
					$sql = "SELECT *
					FROM `ward_stat` AS a
					LEFT JOIN `ward_baby_stat` AS c ON c.`ward_stat_id` = a.`id`
					WHERE a.`id` = :id ";
					$item = DB::select($sql, array(':id' => $id), true);
					if( empty($item) ){
						redirect( 'ward_stat.php', 'ไม่มีข้อมูล');
					}
					
					$sql = "SELECT `id`,`name`,`hn`,`an` FROM `ward_dead_stat` WHERE `ward_stat_id` = :id ";
					$lists = DB::select($sql, array(':id' => $id));
				}

				include 'templates/ward/form.php';

			}elseif( $page === 'detail' ){
				
				$id = getId();
				
				$sql = "SELECT *
				FROM `ward_stat` AS a
				LEFT JOIN `ward_baby_stat` AS c ON c.`ward_stat_id` = a.`id`
				WHERE a.`id` = :id ";
				$item = DB::select($sql, array(':id' => $id), true);
				if( empty($item) ){
					redirect( 'ward_stat.php', 'ไม่มีข้อมูล');
				}
				
				$sql = "SELECT `id`,`name`,`hn`,`an` FROM `ward_dead_stat` WHERE `ward_stat_id` = :id ";
				$lists = DB::select($sql, array(':id' => $id));
					
				include 'templates/ward/detail.php';
			}elseif( $page === 'home_acu' ){
				
				$limit = 20;
				
				$sql = "SELECT `id`,`date_write`,`auther`,`date_add` 
				FROM `ward_acu` 
				WHERE `status` = 1 
				#LIMIT $limit
				ORDER BY `id` DESC";
				$items = DB::select($sql);
				
				include 'templates/ward/home_acu.php';
			}elseif( $page === 'form_acu' ){
				
				$id = getId();
				if( $id !== false ){
					$sql = "SELECT * FROM `ward_acu` WHERE `id` = :id; ";
					$item = DB::select($sql, array(':id' => $id), true);
				}
				
				include 'templates/ward/form_acu.php';
			}elseif( $page === 'detail_acu' ){
				
				$id = getId();
				$sql = "SELECT * FROM `ward_acu` WHERE `id` = :id; ";
				$item = DB::select($sql, array(':id' => $id), true);
				if( $item === null){
					redirect('ward_stat.php?page=home_acu', 'ไม่มีข้อมูล');
					exit;
				}
				
				include 'templates/ward/detail_acu.php';
			}
			?>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';
