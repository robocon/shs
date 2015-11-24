<?php
include 'bootstrap.php';

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


if( $action === 'add' ){

	//
	$post = filter_post($_POST);

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
	`type`
	)
	VALUES (
	NULL , :department, :date_write, :all_patient, :prev_patient, :new_patient, :all_admit, :prev_admit, :new_admit, :avg_bed, :all_bed, :refer_patient, :disc_patient, NOW(), :type
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

	redirect('ward_stat', 'บันทึกข้อมูลเรียบร้อย');
} elseif ( $action === 'edit' ) {
	/**
	 * @todo
	 * [x] อัพเดท ward_stat
	 *		[] ขาด edit date
	 * [x] อัพเดท ward_stat dead
	 * [x] อัพเดท ward_stat baby
	 */
	
	$id = isset($_POST['id']) ? intval($_POST['id']) : false ;
	
	//
	$post = filter_post($_POST);
	
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
	`refer_patient`=:refer_patient, `disc_patient`=:disc_patient 
	WHERE `id`=:id;";
	$data = array(
		':department' => $post['department'], ':date_write' => $date_write, 
		':all_patient' => $post['all_patient'], ':new_patient' => $post['new_patient'], 
		':all_admit' => $post['all_admit'], ':prev_admit' => $post['prev_admit'], 
		':new_admit' => $post['new_admit'], ':avg_bed' => $post['avg_bed'], 
		':all_bed' => $post['all_bed'], ':refer_patient' => $post['refer_patient'], 
		':disc_patient' => $post['disc_patient'], ':id' => $id, 
	);
	DB::exec($sql, $data);

	if( $dead_rows > 0 ){
		foreach($dead_lists as $key => $list ){
			$sql = "UPDATE `ward_dead_stat` SET `name`=:name, 
			`hn`=:hn, 
			`an`=:an 
			WHERE `id`=:id;";
			$data = array(
				':name' => $list['dead_name'],
				':hn' => $list['dead_hn'],
				':an' => $list['dead_an'],
				':id' => $list['dead_id'],
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
	
	exit;
}


/**
 * แสดงในส่วนของ view
 */
$title = 'รายงานผู้มาใช้บริการ';
include 'templates/classic/header.php';

?>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
			<?php
			// เมนู
			include 'templates/ward/nav.php';
			if( $page === false ){ // Home && Default page

				$limit = 20;
				$sql = "SELECT `id`,`department`,`date_write`,`date_add`,`type` FROM `ward_stat` ORDER BY `date_add` DESC LIMIT $limit";
				$items = DB::select($sql);

				include 'templates/ward/home.php';

			}elseif( $page === 'form' ){
				$id = isset($_GET['id']) ? intval($_GET['id']) : false ;

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

			}
			?>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';
