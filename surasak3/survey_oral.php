<?php 
include 'bootstrap.php';
if(authen() === false ){ die('Session ������� <a href="login_page.php">��ԡ�����</a> ���ͷӡ���������к��ա����'); }

// Load Databse
DB::load();

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
		
		// �Ҥ���٧�ش�ͧ �дѺ������آ�Ҿ��ͧ�ҡ
		// �� user xxx ��ꡪ�ͧ 4,5,6 �ж�����������дѺ 4
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
	$msg = '�ѹ�֡���������º����';
	if($insert === false){
		$msg = '�ѹ�֡�������������� ��سҵԴ��ͼ������к�';
	}
	
	$last_id = DB::get_lastId();
	
	redirect('survey_oral.php?task=fulldetail&id='.$last_id.'&print=yes', $msg);
	exit;
} else if( $action === 'delete' ){
	
	if( $id === false ){
		echo "���������١��ͧ";
		exit;
	}
	
	$sql = "
	DELETE FROM `survey_oral` WHERE `survey_oral`.`id` = :id LIMIT 1
	";
	$delete = DB::exec($sql, array(':id' => $id) );
	$msg = 'ź���������º����';
	if($delete === false){
		$msg = 'ź�������������� ��سҵԴ��ͼ������к�';
	}
	
	redirect('survey_oral.php', $msg);
	exit;
} else if( $action === 'section_form_save' ){
	
	$name = isset($_POST['section']) ? trim($_POST['section']) : false ;
	if($name === false){
		?>
		<script type="text/javascript">
		alert('��سҡ�͡����˹��§ҹ');
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
	
	$msg = '�ѹ�֡���������º����';
	if($insert === false){
		$msg = '�ѹ�֡�������������� ��سҵԴ��ͼ������к�';
	}
	
	redirect('survey_oral.php?task=category_form', $msg);
	exit;
} else if( $action === 'delete_category' ){
	
	if( $id === false ){
		redirect('survey_oral.php?task=category_form', '���������١��ͧ ��سҵ�Ǩ�ͺ����');
	}else{
		$sql = "
		DELETE FROM `survey_oral_category` 
		WHERE `id` = :id LIMIT 1
		";
		DB::exec($sql, array(':id' => $id));
		redirect('survey_oral.php?task=category_form', 'ź���������º����');
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
                            <h1>�к����Ǩ����Ъ�ͧ�ҡ</h1>
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
							<li <?php echo $home_active;?>><a href="survey_oral.php">˹����ѡ</a></li>
							<li <?php echo $form_active;?>><a href="survey_oral.php?task=form">����������Ẻ���Ǩ</a></li>
							<li <?php echo $form_category;?>><a href="survey_oral.php?task=category_form">�Ѵ��â�����˹��§ҹ</a></li>
							<li <?php echo $den_report;?>><a href="survey_oral.php?task=report">��§ҹ�š�����Ǩ</a></li>
							<li <?php echo $report_mouth;?>><a href="survey_oral.php?task=report_mouth">��§ҹ����Ъ�ͧ�ҡ����дѺ</a></li>
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
								<span class="label">�駨ҡ�к�</span> <?php echo $_SESSION['x-msg']; ?>
							</div>
						</div>
						<?php unset($_SESSION['x-msg']); ?>
						<?php endif; ?>
						
						<h3>��ª��ͼ����ӡ�õ�Ǩ</h3>
						<table class="outline-header border box-header outline">
							<thead>
								<tr>
									<th width="10%">HN</th>
									<th>����-ʡ��</th>
									<th>˹���</th>
									<th width="15%">�ѹ���ӡ�õ�Ǩ</th>
									<th align="center" width="10%">�Ѵ��â�����</th>
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
									<td><a href="survey_oral.php?task=fulldetail&id=<?php echo $item['id'];?>" title="��ԡ���ʹ٢�����Ẻ���"><?php echo $item['hn'];?></a></td>
									<td><?php echo $item['fullname'];?></td>
									<td><?php echo $item['name'];?></td>
									<td><?php echo $th_full_date;?></td>
									<td>
										<a href="#">���</a> | 
										<a href="survey_oral.php?action=delete&id=<?php echo $item['id'];?>" class="survey_remove">ź</a>
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
						<h3>����������Ẻ���Ǩ����Ъ�ͧ�ҡ ���ѧ�� ��.</h3>
						<form action="survey_oral.php?task=form" method="post">
							<div class="col">
								<div>
									<label for="">���ҵ���ŢHN: </label><input type="text" name="hn" value="<?php echo $hn;?>">
								</div>
							</div>
							<div class="col">
								<div>
									<button type="submit">����</button>
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
						<h3>��������´������</h3>
						<form action="survey_oral.php?action=save" method="post">
							<div class="cell">
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
									<input id="hn" name="hn" type="hidden" value="<?php echo $item['hn'];?>">
									</div>
								<div class="input_form"><label for="date">�ѹ����Ǩ:</label>&nbsp;<input class="text" id="date" name="date" type="text" value="<?php echo $th_date;?>"></div>
								<div class="input_form">
									<label for="section">˹���:</label>&nbsp;
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
									<label for="prefix">�ӹ�˹��: </label><?php echo $item['yot'];?>
									<input id="prefix" name="prefix" type="hidden" value="<?php echo $item['yot'];?>">
									</div>
								<div class="input_form">
									<label for="firstname">����: </label><?php echo $item['name'];?>
									<input id="firstname" name="firstname" type="hidden" value="<?php echo $item['name'];?>">
									</div>
								<div class="input_form">
									<label for="lastname">ʡ��: </label><?php echo $item['surname'];?>
									<input id="lastname" name="lastname" type="hidden" value="<?php echo $item['surname'];?>">
									</div>
								
							</div>
							<div class="cell">
								<div class="input_form">
									<label for="age">����: </label><?php echo $age;?> ��
									<input id="age" name="age" type="hidden" value="<?php echo $age;?>">
								</div>
								<div class="input_form">
									<label for="id_card">�Ţ�ѵû�Шӵ�ǻ�ЪҪ�: </label><?php echo $item['idcard'];?>
									<input id="id_card" name="id_card" type="hidden" value="<?php echo $item['idcard'];?>">
								</div>
							</div>
							<div >
								<table class="custom-table outline-header border box-header outline">
									<thead>
										<tr>
											<th class="align-center">����Ъ�ͧ�ҡ</th>
											<th class="align-center" width="5%">�дѺ</th>
											<th class="align-center" width="15%">���й�㹡���ѡ��</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<input name="mouth_detail[1_1]" id="1_1" class="checkbox" type="checkbox" value="1">
												<label for="1_1">1. �آ�Ҿ��ͧ�ҡ��</label>
											</td>
											<td class="align-center">1</td>
											<td class="align-center">������ѡ�ҷء 6 ��͹</td>
										</tr>
										
										<tr>
											<td>
												<input name="mouth_detail[2_1]" id="2_1" class="checkbox" type="checkbox" value="1">
												<label for="2_1">2. ���Թ�ٹ ���˧�͡�ѡ�ʺ</label>
											</td>
											<td class="align-center">2</td>
											<td class="align-center">�ٴ�Թ�ٹ</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[3_1]" id="3_1" class="checkbox" type="checkbox" value="1">
												<label for="3_1">3. �տѹ�ط���ش��</label>
											</td>
											<td class="align-center" rowspan="3">3</td>
											<td class="align-center">�ش�ѹ</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[3_2]" id="3_2" class="checkbox" type="checkbox" value="1">
												<label for="3_2">4. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ</label>
											</td>
											<td class="align-center">�ѡ���ä�˧�͡</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[3_3]" id="3_3" class="checkbox" type="checkbox" value="1">
												<label for="3_3">5. �٭���¿ѹ��Ш��繵�ͧ���ѹ��᷹</label>
											</td>
											<td class="align-center">���ѹ</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_1]" id="4_1" class="checkbox" type="checkbox" value="1">
												<label for="4_1">6. �տѹ�ط����ç����ҷ����ѡ�Ҥ�ͧ�ҡ�ѹ��</label>
											</td>
											<td class="align-center" rowspan="5">4</td>
											<td class="align-center">�ѡ�Ҥ�ͧ�ҡ�ѹ</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_2]" id="4_2" class="checkbox" type="checkbox" value="1">
												<label for="4_2">7. �տѹ�ط����ç����ҷ����ͧ�͹ / �� RR</label>
											</td>
											<td class="align-center">�͹�ѹ</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_3]" id="4_3" class="checkbox" type="checkbox" value="1">
												<label for="4_3">8. �տѹ�ش</label>
											</td>
											<td class="align-center">��ҿѹ�ش</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_4]" id="4_4" class="checkbox" type="checkbox" value="1">
												<label for="4_4">9. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹</label>
											</td>
											<td class="align-center">�͹�ѹ����ѡ���ä�˧�͡</td>
										</tr>
										<tr>
											<td>
												<input name="mouth_detail[4_5]" id="4_5" class="checkbox" type="checkbox" value="1">
												<label for="4_5">10. ���ҡ�� ��� �Ǵ�ѹ �Ǵ�˧�͡</label>
											</td>
											<td class="align-center">����Ѻ��õ�Ǩ���������� þ.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col">
								<div class="cell">
									<label for="etc">11. ���� (�к�)</label>
									<div>
										<textarea name="etc" id="etc" class="col width-3of5" rows="5"></textarea>
									</div>
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<label>����Ǩ: </label>
									<select name="officer">
										<option value="�.�. �����ط�� ǧ��ѹ���">�.�. �����ط�� ǧ��ѹ���</option>
										<option value="�.�.˭ԧ ˹��ķ�� ����ȹѹ��">�.�.˭ԧ ˹��ķ�� ����ȹѹ��</option>
										<option value="�.�.˭ԧ ���͡�� �Ҫ����">�.�.˭ԧ ���͡�� �Ҫ����</option>
										<option value="�.�.�. ������ ���ǧ��">�.�.�. ������ ���ǧ��</option>
										<option value="�.�.�. ���� �Ҥ������">�.�.�. ���� �Ҥ������</option>
									</select>
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<button type="submit" class="add_form_btn">����������</button>
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
							if( $id === false ){ die('��辺������'); }
							
							$sql = "SELECT a.*, b.`name`
							FROM `survey_oral` AS a 
							LEFT JOIN `survey_oral_category` AS b ON b.`id` = a.`section`
							WHERE a.`id` = :id LIMIT 1;";
							$item = DB::select($sql, array(':id' => $id), true);
							
							if( $item === false || count($item) === 0 ){
								?>
								<p>��辺�����ż�����</p>
								<?php
							} else {
								
								$img_checked = '<img src="assets/img/den/box-checked.png" style="width: 16px;">';
						?>
							<h3>�ŵ�Ǩ����Ъ�ͧ�ҡ ���ѧ�� ��.</h3>
							<div class="cell">
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
								</div>
								<div class="input_form"><label for="date">�ѹ����Ǩ:</label>&nbsp;<?php echo $item['date'];?></div>
								<div class="input_form"><label for="section">˹���:</label>&nbsp;<?php echo $item['name'];?></div>
								
							</div>
							<div class="cell">
								<div class="input_form">
									<label for="prefix">����-ʡ��: </label><?php echo $item['fullname'];?>
								</div>
								<div class="input_form">
									<label for="age">����: </label><?php echo $item['age'];?> ��
								</div>
								<div class="input_form">
									<label for="id_card">�Ţ�ѵû�Шӵ�ǻ�ЪҪ�: </label><?php echo $item['id_card'];?>
								</div>
							</div>
							<div class="cell">
								<?php
								$status = unserialize($item['mouth_detail']);
								?>
								<table class="custom-table outline-header border box-header outline">
									<thead>
										<tr>
											<th class="align-center">����Ъ�ͧ�ҡ</th>
											<th class="align-center" width="5%">�дѺ</th>
											<th class="align-center" width="15%">���й�㹡���ѡ��</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>
												<?php $check = ( $status['1_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="1_1">1. �آ�Ҿ��ͧ�ҡ��</label>
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
											<td class="align-center">������ѡ�ҷء 6 ��͹</td>
										</tr>
										
										<tr>
											<td>
												<?php $check = ( $status['2_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="2_1">2. ���Թ�ٹ ���˧�͡�ѡ�ʺ</label>
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
											<td class="align-center">�ٴ�Թ�ٹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="3_1">3. �տѹ�ط���ش��</label>
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
											<td class="align-center">�ش�ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_2'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="3_2">4. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ</label>
											</td>
											<td class="align-center">�ѡ���ä�˧�͡</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_3'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="3_3">5. �٭���¿ѹ��Ш��繵�ͧ���ѹ��᷹</label>
											</td>
											<td class="align-center">���ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_1'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_1">6. �տѹ�ط����ç����ҷ����ѡ�Ҥ�ͧ�ҡ�ѹ��</label>
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
											<td class="align-center">�ѡ�Ҥ�ͧ�ҡ�ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_2'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_2">7. �տѹ�ط����ç����ҷ����ͧ�͹ / �� RR</label>
											</td>
											<td class="align-center">�͹�ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_3'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_3">8. �տѹ�ش</label>
											</td>
											<td class="align-center">��ҿѹ�ش</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_4'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_4">9. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹</label>
											</td>
											<td class="align-center">�͹�ѹ����ѡ���ä�˧�͡</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_5'] == 1 ) ? $img_checked : '' ;?>
												<?php echo $check;?>
												<label for="4_5">10. ���ҡ�� ��� �Ǵ�ѹ �Ǵ�˧�͡</label>
											</td>
											<td class="align-center">����Ѻ��õ�Ǩ���������� þ.</td>
										</tr>
									</tbody>
								</table>
							</div>
							<div class="col">
								<div class="cell">
									<label for="etc">11. ���� (�к�)</label>&nbsp;<?php echo str_replace("\n", '<br>', $item['etc']);?>
									
								</div>
							</div>
							<div class="col">
								<div class="cell">
									<label for=""><b>����Ǩ:</b></label>&nbsp;<?php echo $item['officer'];?>
								</div>
							</div>
							<div class="col" id="print_btn">
								<div class="cell">
									<button onclick="force_print()">��� Print</button>
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
								<h3>��������˹��§ҹ</h3>
								<div class="col">
									<label for="section">����</label>
									<input type="text" id="section" name="section">
								</div>
								<div class="col">
									<button type="submit">����</button>
								</div>
							</form>
						</div>
						<div class="col"><div class="cell"></div></div>
						<div class="col width-3of5 ">
							<h3>��ª���˹��§ҹ</h3>
							<table class="custom-table outline-header border box-header outline">
								<thead>
									<tr>
										<th>����</th>
										<th width="20%">�Ѵ��â�����</th>
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
											<a href="#">���</a>
											 | 
											<a href="survey_oral.php?action=delete_category&id=<?php echo $item['id'];?>" class="survey_remove">ź</a>
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
						<h3>�š�����Ǩ������آ�Ҿ��ͧ�ҡ���ѧ�� ��.</h3>
						<table class="custom-table outline-header border box-header outline">
							<thead>
								<tr>
									<th rowspan="2">�ѹ���</th>
									<th rowspan="2">�ӹǹ������Ѻ��õ�Ǩ�آ�Ҿ��ͧ�ҡ (���)</th>
									<th colspan="4" class="align-center">�дѺ������آ�Ҿ��ͧ�ҡ(���)</th>
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
					'1_1' => '1. �آ�Ҿ��ͧ�ҡ��',
					'2_1' => '2. ���Թ�ٹ ���˧�͡�ѡ�ʺ',
					'3_1' => '3. �տѹ�ط���ش��',
					'3_2' => '4. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ',
					'3_3' => '5. �٭���¿ѹ��Ш��繵�ͧ���ѹ��᷹',
					'4_1' => '6. �տѹ�ط����ç����ҷ����ѡ�Ҥ�ͧ�ҡ�ѹ��',
					'4_2' => '7. �տѹ�ط����ç����ҷ����ͧ�͹ / �� RR',
					'4_3' => '8. �տѹ�ش',
					'4_4' => '9. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹',
					'4_5' => '10. ���ҡ�� ��� �Ǵ�ѹ �Ǵ�˧�͡',
				);
				?>
				<div class="col">
					<div class="cell">
						<h3>��§ҹ����Ъ�ͧ�ҡ �� 2558</h3>
						<table class="custom-table outline-header border box-header outline width-2of5">
							<thead>
								<tr>
									<th>����Ъ�ͧ�ҡ</th>
									<th align="center">�ӹǹ</th>
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
									<th>�дѺ�����ع�ç</th>
									<th>�ӹǹ</th>
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
									<td>�����ع�ç�дѺ <?php echo $vio;?></td>
									<td align="center"><?php echo $item['count'];?></td>
								</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
						<div class="col" id="print_btn">
							<div class="cell">
								<button onclick="force_print()">��� Print</button>
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
			var c = confirm('�׹�ѹ����ź������?');
			if( c == false ){
				return false;
			}
		});
	}
	
	if( $('.add_form_btn').length > 0 ){
		$(document).on('click', '.add_form_btn', function(){
			var c = confirm('�׹�ѹ�׹�ѹ�������������?');
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