<?php
include 'bootstrap.php';

define('WARD_STAT', 1);

DB::load();

/**
 * �Ѵ��â�����
 */
// ��á�зӵ�ҧ� �� �ѹ�֡, ���, ź
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false;
$task = isset($_REQUEST['task']) ? trim($_REQUEST['task']) : false;

// ˹�ҵ�ҧ����ʴ��ŵ�ҧ� �� ˹����¡��, ˹�ҿ����
$page = isset($_REQUEST['page']) ? trim($_REQUEST['page']) : false;

// �ش����ʴ����˹�ҹ���
$view = isset($_REQUEST['view']) ? trim($_REQUEST['view']) : false;
if( $action === 'add' ){

	//
	$post = filter_post($_POST);

	// �����ż�����ª��Ե
	$dead_rows = ( isset($post['dead_hn']) && !empty($post['dead_hn']) ) ? count($post['dead_hn']) : 0 ;

	// ����Ѻ�ٵ�
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

	// ���������ż�����ª��Ե
	if( $dead_rows > 0 ){

		$sql = "INSERT INTO `smdb`.`ward_dead_stat` (`id` ,`ward_stat_id` ,`name` ,`hn` ,`an`)
		VALUES (NULL , :ward_stat_id, :name, :hn, :an);";

		for ($i=0; $i < $dead_rows; $i++) {

			$data = array(
				':ward_stat_id' => $id,
				':name' => $post['dead_name'][$i],
				':hn' => $post['dead_hn'][$i],
				':an' => $post['dead_an'][$i],
			);
			DB::exec($sql, $data);
		}

	}

	// ��������������Ѻ�ٵ�
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

	redirect('ward_stat', '�ѹ�֡���������º����');
} elseif ( $action === 'edit' ) {
	/**
	 * @todo
	 * [] �Ѿഷ ward_stat
	 * [] �Ѿഷ ward_stat dead
	 * [] �Ѿഷ ward_stat baby
	 */
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

				$limit = 20;
				$sql = "SELECT `id`,`department`,`date_write`,`date_add`,`type` FROM `ward_stat` ORDER BY `date_add` DESC LIMIT $limit";
				$items = DB::select($sql);

				include 'templates/ward/home.php';

			}elseif( $page === 'form' ){
				$id = isset($_GET['id']) ? intval($_GET['id']) : false ;

				// ����� id �ʴ�����繡�� edit
				if( $id !== false ){
					$sql = "SELECT *
					FROM `ward_stat` AS a
					LEFT JOIN `ward_dead_stat` AS b ON b.`ward_stat_id` = a.`id`
					LEFT JOIN `ward_baby_stat` AS c ON c.`ward_stat_id` = a.`id`
					WHERE a.`id` = :id
					";
					$item = DB::select($sql, array(':id' => $id), true);
					if( empty($item) ){
						redirect( 'ward_stat.php', '����բ�����');
					}
					dump($item);
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
