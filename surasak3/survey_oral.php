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
	$msg = '�ѹ�֡���������º����';
	if($insert === false){
		$msg = '�ѹ�֡�������������� ��سҵԴ��ͼ������к�';
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
                            <h1>�к����Ǩ����Ъ�ͧ�ҡ</h1>
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
							<li <?php echo $home_active;?>><a href="survey_oral.php">˹����ѡ</a></li>
							<li <?php echo $form_active;?>><a href="survey_oral.php?task=form">����������Ẻ���Ǩ</a></li>
							<li><a href="survey_oral.php?task=category_form">�Ѵ��â�����˹��§ҹ</a></li>
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
									<th>�ѹ���ӡ�õ�Ǩ</th>
									<th align="center">�Ѵ��â�����</th>
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
									<td><a href="survey_oral.php?task=fulldetail&id=<?php echo $item['id'];?>" title="��ԡ���ʹ٢�����Ẻ���"><?php echo $item['hn'];?></a></td>
									<td><?php echo $item['fullname'];?></td>
									<td><?php echo $th_full_date;?></td>
									<td>
										<a href="#">���</a> | 
										<a href="#" class="survey_remove">ź</a>
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
						<h3>��������´������</h3>
						<form action="survey_oral.php?action=save" method="post">
							<div>
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
									<input id="hn" name="hn" type="hidden" value="<?php echo $item['hn'];?>">
									</div>
								<div class="input_form"><label for="date">�ѹ����Ǩ</label><input class="text width-2of5" id="date" name="date" type="text" value="<?php echo $th_date;?>"></div>
								<div class="input_form"><label for="section">˹���</label><input class="text" id="section" name="section" type="text"></div>
								
							</div>
							<div>
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
							<div>
								<div class="input_form">
									<label for="age">����: </label><?php echo $age;?> ��
									<input id="age" name="age" type="hidden" value="<?php echo $age;?>">
								</div>
								<div class="input_form">
									<label for="id_card">�Ţ�ѵû�Шӵ�ǻ�ЪҪ�: </label><?php echo $item['idcard'];?>
									<input id="id_card" name="id_card" type="hidden" value="<?php echo $item['idcard'];?>">
								</div>
							</div>
							<div>
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
									<button type="submit">����������</button>
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
							if( $id === false ){ die('��辺������'); }
							
							$sql = "SELECT * FROM `survey_oral` WHERE `id` = :id LIMIT 1;";
							$item = DB::select($sql, array(':id' => $id), true);
							
							if( $item === false || count($item) === 0 ){
								?>
								<p>��辺�����ż�����</p>
								<?php
							} else {
						?>
							<h3>�ʴ���������´�����·�����Ѻ��õ�Ǩ����Ъ�ͧ�ҡ</h3>
							<div>
								<div class="input_form">
									<label for="hn">HN: </label><?php echo $item['hn'];?>
								</div>
								<div class="input_form"><label for="date">�ѹ����Ǩ</label><?php echo $item['date'];?></div>
								<div class="input_form"><label for="section">˹���</label><?php echo $item['section'];?></div>
								
							</div>
							<div>
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
							<div>
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
												<?php $check = ( $status['1_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="1_1">1. �آ�Ҿ��ͧ�ҡ��</label>
											</td>
											<td class="align-center">1</td>
											<td class="align-center">������ѡ�ҷء 6 ��͹</td>
										</tr>
										
										<tr>
											<td>
												<?php $check = ( $status['2_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="2_1">2. ���Թ�ٹ ���˧�͡�ѡ�ʺ</label>
											</td>
											<td class="align-center">2</td>
											<td class="align-center">�ٴ�Թ�ٹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="3_1">3. �տѹ�ط���ش��</label>
											</td>
											<td class="align-center" rowspan="3">3</td>
											<td class="align-center">�ش�ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_2'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="3_2">4. ���ä��Էѹ���ѡ�ʺ����ѧ�ѡ���� ������ҡ�ûǴ</label>
											</td>
											<td class="align-center">�ѡ���ä�˧�͡</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['3_3'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="3_3">5. �٭���¿ѹ��Ш��繵�ͧ���ѹ��᷹</label>
											</td>
											<td class="align-center">���ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_1'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_1">6. �տѹ�ط����ç����ҷ����ѡ�Ҥ�ͧ�ҡ�ѹ��</label>
											</td>
											<td class="align-center" rowspan="5">4</td>
											<td class="align-center">�ѡ�Ҥ�ͧ�ҡ�ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_2'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_2">7. �տѹ�ط����ç����ҷ����ͧ�͹ / �� RR</label>
											</td>
											<td class="align-center">�͹�ѹ</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_3'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_3">8. �տѹ�ش</label>
											</td>
											<td class="align-center">��ҿѹ�ش</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_4'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
												<label for="4_4">9. ���ä��Էѹ���ѡ�ʺ �ѹ�¡�ҡ��ͧ�͹</label>
											</td>
											<td class="align-center">�͹�ѹ����ѡ���ä�˧�͡</td>
										</tr>
										<tr>
											<td>
												<?php $check = ( $status['4_5'] == 1 ) ? 'icon-check' : 'icon-check-empty' ;?>
												<span class="icon icon-16 <?php echo $check;?>"></span>
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
								<label for="section">��������˹��§ҹ</label>
								<input type="text" id="section" name="section">
								<button>����</button>
							</form>
						</div>
						<div>
							��ª���˹��§ҹ
							<table>
								<thead>
									<tr>
										<th>����</th>
										<th>�Ѵ��â�����</th>
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
		
	
});
})(jQuery);
</script>
<?php
include 'templates/default/footer.php';
?>