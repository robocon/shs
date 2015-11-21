<?php
include 'bootstrap.php';
DB::load();

/**
 * �Ѵ��â�����
 */
// ��á�зӵ�ҧ� �� �ѹ�֡, ���, ź
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false;

// ˹�ҵ�ҧ����ʴ��ŵ�ҧ� �� ˹����¡��, ˹�ҿ����
$page = isset($_REQUEST['page']) ? trim($_REQUEST['page']) : false;

// �ش����ʴ����˹�ҹ���
$view = isset($_REQUEST['view']) ? trim($_REQUEST['view']) : false;
if( $action === 'add' ){

	// �����ż�����ª��Ե
	$dead_rows = isset($_POST['dead_hn']) ? count($_POST['dead_hn']) : 0 ;

	// ����Ѻ�ٵ�
	$newborn_active = isset($_POST['newborn_active']) ? intval($_POST['newborn_active']) : false ;

	$type = $newborn_active === false ? '' : 'obgyn' ;
	$date_write = $_POST['date_year'].'-'.$_POST['date_month'];
	$sql = "
	INSERT INTO `ward_stat` (
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
	);
	";

	$data = array(
		':department' => $_POST['department'],
		':date_write' => $date_write,
		':all_patient' => $_POST['all_patient'],
		':prev_patient' => $_POST['prev_patient'],
		':new_patient' => $_POST['new_patient'],
		':all_admit' => $_POST['all_admit'],
		':prev_admit' => $_POST['prev_admit'],
		':new_admit' => $_POST['new_admit'],
		':avg_bed' => $_POST['avg_bed'],
		':all_bed' => $_POST['all_bed'],
		':refer_patient' => $_POST['refer_patient'],
		':disc_patient' => $_POST['disc_patient'],
		':type' => $type,
	);
	DB::exec($sql, $data);
	$id = DB::get_lastId();

	// ���������ż�����ª��Ե
	if( $dead_rows > 0 ){

		$sql = "
		INSERT INTO `smdb`.`ward_dead_stat` (`id` ,`ward_stat_id` ,`name` ,`hn` ,`an`)
		VALUES (NULL , :ward_stat_id, :name, :hn, :an);
		";

		for ($i=0; $i < $dead_rows; $i++) {

			$data = array(
				':ward_stat_id' => $id,
				':name' => $_POST['dead_name'][$i],
				':hn' => $_POST['dead_hn'][$i],
				':an' => $_POST['dead_an'][$i],
			);
			DB::exec($sql, $data);
		}

	}

	// ��������������Ѻ�ٵ�
	if( $newborn_active > 0 ){
		$sql = "
		INSERT INTO `ward_baby_stat` (
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
		NULL , '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11', '11'
		);
		";
	}

	exit;
}


/**
 * �ʴ����ǹ�ͧ view
 */
include 'templates/classic/header.php';

?>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
			<?php
			// ����
			include 'templates/ward/nav.php';
			if( $page === false ){ // Home && Default page
				?>
				<h3>��¡��</h3>
				<?php
			}elseif( $page === 'form' ){
				include 'templates/ward/form.php';
			}
			?>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';
