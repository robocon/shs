<?php 
include 'bootstrap.php';

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

	return $pAge;
}

$page = input('page');
$action = input('action');
$db = Mysql::load();

// �ѹ�֡�������
if( $action === 'import' ){

	include 'includes/JSON.php';
	$json = new Services_JSON();

	$file = $_FILES['file'];
	$date_start = input_post('date_start');
	$date_end = input_post('date_end');
	
	if($file['error'] > 0){
		$_SESSION['x-msg'] = '��س����͡�������Ѿ��Ŵ';
		$_SESSION['type'] = 'warning';
		header('Location: new_waypoint.php?page=import');
		exit;
	}
	
	if(strrchr($file['name'], ".") != '.csv'){
		$_SESSION['x-msg'] = '͹حҵ੾����� .csv ��ҹ��';
		$_SESSION['type'] = 'warning';
		header('Location: new_waypoint.php?page=import');
		exit;
	}

	$company_code = input_post('company');
	$sql = "SELECT `name` FROM `chkcompany` WHERE `code` = '$company_code'";
	$db->select($sql);
	$com = $db->get_item();
	$company = $com['name'];

	// ź�����������͹ ���Ǥ���������������������
	$sql = "DELETE FROM `testmatch` WHERE `company_code` = '$company_code' ";
	$db->delete($sql);

	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);
	$bad_lists = array();
	
	foreach ($items as $key => $list) {
		
		$item = explode(',', $list);
		$hn = str_replace(' ', '', $item['3']);
		
		// �� hn dd-ddddd �ֻ���
		$test_match = preg_match('/(\d+)\-(\d+)/', $hn);
		
		if( !empty($list) && $test_match > 0 ){

			$name = trim($item['0']);
			$surname = trim($item['1']);
			$age = trim($item['2']);
			
			$pre_list = array(
				'CBC-sso' => $item['4'],
				'UA-sso' => $item['5'],
				'BS-sso' => $item['6'],
				'CR-sso' => $item['7'],
				'LIPID-sso' => $item['8'],
				'HBSAG-sso' => $item['9'],
				'PAP-sso' => $item['10'],
				'STOCB-sso' => $item['11'],
				'41001-sso' => $item['12'], //x-ray
			);
			
			$list = array();
			foreach ($pre_list as $code => $value) {
				$value = ( !empty($value) ) ? 1 : 0 ;
				if( $value > 0 ){
					$list[] = $code;
				}
			}

			$json_list = $json->encode($list);

			$name = trim(str_replace(array('�ҧ���','���','�ҧ','�.�.'), '', $name));

			$sql = "SELECT `hn` 
			FROM `opcard` 
			WHERE `hn` = '$hn' 
			AND `name` = '$name' 
			AND `surname` = '$surname' ";
			$db->select($sql);
			$user_count = $db->get_rows();
			
			if( $user_count > 0 ){
				$sql = "INSERT INTO `testmatch` VALUES (
				NULL,
				'$hn', 
				'$age',
				'$company', 
				'$company_code', 
				'$date_start', 
				'$date_end',
				'$json_list');";
				
				$insert = $db->insert($sql);
				
			}else{

				$sql = "SELECT CONCAT(`name`,' ',`surname`) AS `fullname` FROM `opcard` WHERE `hn` = '$hn' ";
				$db->select($sql);
				$check_user = $db->get_item();
				$bad_lists[] = "$hn $name $surname (".$check_user['fullname'].")";
			}
		}
	}

	if( count($bad_lists) > 0 ){
		$_SESSION['bad_lists'] = $bad_lists;
	}

	$_SESSION['x-msg'] = '����������������º����';

	header('Location: new_waypoint.php');
	exit;
}


// include 'templates/classic/header.php';
?>
<style type="text/css">
	.nav{
		list-style: none;
		margin: 10px;
		padding: 0;
	}
	.nav li{
		display: inline;
	}
	.nav li a{
		margin: 0;
		padding: 4px;
		border-right: 1px solid #000;
	}
</style>
<div id="no_print" class="col">
	<div class="cell">
		<ul class="nav">
			<li>
				<a href="../nindex.htm">������ѡ þ.</a>
			</li>
			<li>
				<a href="new_waypoint.php">�͡㺹ӷҧ</a>
			</li>
			<li>
				<a href="new_waypoint.php?page=import">����Ң�����</a>
			</li>
		</ul>
	</div>
</div>
<?php
// Notification
if( isset($_SESSION['x-msg']) ){
	?>
	<div style="border: 2px solid #c3c300;padding: 4px;background-color: #fffcdd;">
		<p><?=$_SESSION['x-msg'];?></p>
	</div>
	<?php
	unset($_SESSION['x-msg']);
}
if( count($_SESSION['bad_lists']) > 0 ){
	?>
	<div style="border: 2px solid #c3c300;padding: 4px;background-color: #fffcdd;">
		<p>���������١��ͧ HN ���� ����-ʡ�� ���ç�Ѻ�ҹ�����š�سҵ�Ǩ�ͺ�ա����</p>
		<ol>
			<?php
			foreach ($_SESSION['bad_lists'] as $key => $item) {
				?>
				<li><?=$item;?></li>
				<?php
			}
			?>
			
		</ol>
	</div>
	<?php
	unset($_SESSION['bad_lists']);
}
// Notification

//˹���á
if( empty($page) ){

	$sql = "SELECT a.*, COUNT(b.`company_code`) AS rows
	FROM `chkcompany` AS a 
	LEFT JOIN `testmatch` AS b ON b.`company_code` = a.`code`
	WHERE a.`year` = '60' 
	GROUP BY b.`company_code`";
	// dump($sql);
	$db->select($sql);
	$items = $db->get_items();

	?>
	<h3>�����㺹ӷҧ</h3>
	<form action="new_waypoint.php" method="post" onsubmit="return checker()">
		<div>
			���͡˹��§ҹ����ͧ��þ����㺹ӷҧ
			<select name="company" id="company">
				<option value="">˹��§ҹ</option>
				<?php
				foreach( $items AS $key => $item ){
					if( $item['rows'] == 0 ){
						continue;
					}
					?>
					<option value="<?=$item['code'];?>"><?=$item['name'];?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div>
			<input type="checkbox" id="ekg" name="ekg" value="1"> 
			<label for="ekg">�ա�õ�Ǩ EKG</label>
		</div>
		<div>
			<button type="submit">�����</button>
			<input type="hidden" name="page" value="print_waypoint">
		</div>
	</form>
	<script type="text/javascript">
		function checker(){
			var company = document.getElementById('company').value;
			if( company == '' ){
				alert('��س����͡˹��§ҹ');
				return false;
			}
		}
	</script>
	<?php

// ˹�ҹ������� .csv
}else if( $page === 'import' ){
	
	?>
	<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
	<script type="text/javascript" src="epoch_classes.js"></script>
	<script type="text/javascript">
		var popup1, popup2;
		window.onload = function() {
			popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
			popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
			
		};
	</script>
	<h3>����Ң���������Ѻ㺹ӷҧ</h3>
	<form action="new_waypoint.php" method="post" enctype="multipart/form-data" onsubmit="return checker()">
		<div>
			<?php
			$sql = "SELECT * FROM `chkcompany` WHERE `year` = '60'";
			$db->select($sql);
			$items = $db->get_items();
			?>
			���͡˹��§ҹ 
			<select name="company" id="company">
				<option value="">˹��§ҹ</option>
			
			<?php
			foreach( $items AS $key => $item ){
				?>
				<option value="<?=$item['code'];?>"><?=$item['name'];?></option>
				<?php
			}
			?>
			</select>
		</div>
		<div>
			�ѹ����������Ǩ <input type="text" id="date_start" name="date_start">
			����ش��õ�Ǩ <input type="text" id="date_end" name="date_end">
		</div>
		<div>
			������� <input type="file" name="file">
		</div>
		<div>
			<button type="submit">�����</button>
			<input type="hidden" name="action" value="import">
		</div>
	</form>
	<script type="text/javascript">
		function checker(){
			var company = document.getElementById('company').value;
			if( company == '' ){
				alert('��س����͡˹��§ҹ');
				return false;
			}

			var date_start = document.getElementById('date_start').value;
			var date_end = document.getElementById('date_end').value;
			if( date_start == '' || date_end == '' ){
				alert('��س����͡�ѹ���');
				return false;
			}
		}
	</script>
	<?php

// ˹�Ҿ����㺹ӷҧ
}else if( $page === 'print_waypoint' ){

	$company_code = input_post('company');
	$ekg = input_post('ekg');

	$sql = "SELECT * 
	FROM `testmatch` 
	WHERE `company_code` = '$company_code'";
	$db->select($sql);
	$items = $db->get_items();

	?>
	<style type="text/css">
		.pdxhead {font-family: "TH SarabunPSK";font-size: 24px;}
		.pdxpro {font-family: "TH SarabunPSK";font-size: 22px;}
		.pdx {font-family: "TH SarabunPSK";font-size: 20px;}
		.stricker {font-family: "TH SarabunPSK";font-size: 16px;}
		.stricker1 {font-family: "TH SarabunPSK";font-size: 14px;}
		@media print{ #no_print{ display:none; } }
	</style>
	<?php
	$i = 1;
	foreach ($items as $key => $item) {

		$company = $item['company'];
		$hn = $item['hn'];

		// �� �� ���� ���
		list($y3, $m3, $d3) = explode('-', ad_to_bc($item['date_end']));
		
		// !!! �ѧ����ͧ�Ѻ������͹
		list($y, $m, $d) = explode('-', ad_to_bc($item['date_start']));
		if( $d !== $d3 ){
			$d .= ' - '.$d3;
		}
		$date_checkup = $d.' '.$def_fullm_th[$m].' '.$y;
		
		$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `fullname`,`idcard`,`dbirth`,`address`,`tambol`,`ampur`,`changwat`,`phone` 
		FROM `opcard` 
		WHERE `hn` = '$hn'";
		$db->select($sql);
		$patient = $db->get_item();
		
		$fullname = $patient['fullname'];
		$idcard = $patient['idcard'];
		$address = $patient['address'].' �.'.$patient['tambol'].' �.'.$patient['ampur'].' �.'.$patient['changwat'];
		$phone = $patient['phone'];

		$age = calcage($patient['dbirth']);

		list($y2, $m2, $d2) = explode('-', $patient['dbirth']);
		$birth_date = $d2.' '.$def_fullm_th[$m2].' '.$y2;

		if( ($i % 2) == 0 ){
			?>
			<div style="margin-top: 80px;"></div>
			<?php
		}
		?>
		<table width="100%">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="8%" rowspan="3" align="center"><img src="images/logo.jpg" width="87" height="83" /></td>
							<td width="75%" align="center" class="pdx">
								<strong><span class="pdxhead">
								Ẻ��õ�Ǩ�آ�Ҿ <?=$company;?>
								</span></strong>
							</td>
							<td width="17%" align="center" class="pdx">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" class="pdx"><strong>�ç��Һ�Ť�������ѡ�������� �.���ͧ �.�ӻҧ ��. 054-839305</strong></td>
							<td align="center" class="pdx">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" class="pdx"><span class="pdxhead">��Ǩ�ѹ��� <?=$date_checkup;?></span></td>
							<td align="center" class="pdx">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<span class="pdx"><strong>���й�����Ѻ��õ�Ǩ�آ�Ҿ</strong><br />
					<strong>�������Ѻ��õ�Ǩ�آ�Ҿ��ͧ����Ѻ��õ�Ǩ���ʶҹշ���˹��ءʶҹ�</strong></span><br />

					<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td>
								<table>
									<tr>
										<td class="pdxpro">
											HN : <strong><?=$hn?></strong> 
											����-ʡ�� : <strong><?=$fullname?></strong>
											�/�/� �Դ : <?=$birth_date;?>
											���� : <?=$age;?>
										</td>
									</tr>
									<tr>
										<td class="pdx">�Ţ�ѵû�� : <?=$idcard;?>&nbsp;
										������� : <?=$address;?>&nbsp;
										���Ѿ�� : <?=$phone;?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<?php
					// �������Ǩ
					$arrtype = array('��Ǩ x-ray �ʹ','��Ǩ��������ó�ͧ������ʹ(CBC)','��Ǩ�������(UA)','����ҹ(BS)','��ѹ(CHOL) (TRI)','��Ǩ˹�ҷ��ͧ�Ѻ(SGOT,SGPT)','��Ǩ˹�ҷ��ͧ�(BUN,CR)','��Ǩ˹�ҷ��ͧ�(ALK)','��Ǩ�ô���ԡ(URICACID)');
					$arrprice = array('170.00','90.00','50.00','40.00','120.00','100.00','100.00','50','60');
					?>
					<table width="756">
						<tr>
							<td class="pdxpro" colspan="2"><strong>��¡�õ�Ǩ�آ�Ҿ</strong></td>
						</tr>
						<!--
						<tr>
							<td class="pdxpro" colspan="2"><strong><?=$company;?></strong></td>
						</tr>
						-->
						<?php
						$sumpri=0;
						if($program_type=="1"){	
							$program_txt = "�������� 1";
						}elseif($program_type=="2"){
							$program_txt = "�������� 2";
						}elseif($program_type=="3"){
							$program_txt = "�������� 3";
						}elseif($program_type=="4"){
							$program_txt = "�������� 4";
						}else{
							$program_txt = "���������";
						}
						?>
						<!--
						<tr><td class='pdxpro'><strong><?=$program_txt;?></strong></td></tr>
						-->
						<tr>
							<td class="pdx" colspan="2"><strong>ʶҹշ���ͧ����Ѻ��ԡ��</strong></td>
						</tr>
						<tr>
							<td class="pdx" colspan="2">

							<table>
								<tr style='line-height:16px'>
									<!--
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													ʶҹ� 1 <br>ŧ����¹<br>����¹<br>.............................
												</td>
											</tr>
										</table>
									</td>
									-->
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													ʶҹ� 2<br>
													������ʹ<br>
													.............................
												</td>
											</tr>
										</table>
									</td>
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													ʶҹ� 3<br>
													X-RAY<br>
													.............................
												</td>
											</tr>
										</table>
									</td>
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													ʶҹ� 4<br>
													�ѡ����ѵ�<br>
													.............................
												</td>
											</tr>
										</table>
									</td>
							
							<?php
							// if($program_type != "1" && $program_type != "2" && $program_type != "3" && $program_type != "4"){
							if( $ekg > 0 ){
								?>
								<!-- 
								<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 5<br>PAP<br>OPD �ٵ��<br>.............................</td></tr></table></td>
								<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>ʶҹ� 6<br>V/A<br>OPD ��<br>.............................</td></tr></table></td>
								-->
								<td>
									<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										<tr align='center' style='line-height:16px'>
											<td>
												ʶҹ� 4<br>
												EKG<br>
												.............................
											</td>
										</tr>
									</table>
								</td>
								<?php	
							}	
							?>
							</td>
						</tr>
						<tr>
							<td class="pdx">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="pdx" style="margin-left:10px;">
			<strong>*** �����˵� ***</strong><br />
			- ������˹�ҷ���繵���͡ӡѺ�ءʶҹ� ����ͷӡ�õ�Ǩ���������������� <br />
			- ����ͷӡ�õ�Ǩ�ú�ءʶҹ����� ���͡����觤׹���˹�ҷ�� � �شŧ����¹ <br />
			- ��س����ҷ��͡���㺹ӷҧ��� ���ѹ�索Ҵ
		</div>
		<?php
		$i++;

	} // End foreach

}
// include 'templates/classic/footer.php';
?>