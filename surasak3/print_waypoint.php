<?php 
include 'bootstrap.php';

$page = input('page');
$action = input('action');
$db = Mysql::load();
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
	<h3>�͡㺹ӷҧ�����</h3>
	<div class="cell">
		<ul class="nav">
			<li>
				<a href="../nindex.htm">������ѡ þ.</a>
			</li>
			<!--
			<li>
				<a href="new_waypoint.php">��Ǩ�آ�ҾẺ�����</a>
			</li>
			-->
			<li>
				<a href="print_waypoint.php">�͡㺹ӷҧ�����</a>
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
// Notification

//˹���á
if( empty($page) ){

	?>

	<style>
	#sortable{
		list-style-type: none;
		margin: 0;
		padding: 0;
		width: 20%;
	}
	#sortable li{
		margin: 0 3px 3px 3px;
		padding: 0.4em;
		padding-left: 1.5em;
		height: 18px;
		cursor: pointer;
	}
	#sortable li span{
		position: absolute;
		margin-left: -1.3em;
	}
	</style>

	<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
	<script type="text/javascript" src="epoch_classes.js"></script>
	<script type="text/javascript">
		var popup1, popup2;
		window.onload = function() {
			popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
			popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
			
		};
	</script>

	<link type="text/css" href="jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-ui-1.9.2/js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.min.js"></script>

	<h3>�����㺹ӷҧ</h3>
	<form action="print_waypoint.php" method="post" enctype="multipart/form-data" onsubmit="return checker()">

		<div>
			����˹��§ҹ : <input type="text" name="company">
		</div>

		<div>
			�ѹ����������Ǩ : <input type="text" id="date_start" name="date_start">
			����ش��õ�Ǩ : <input type="text" id="date_end" name="date_end">
		</div>

		<div>
			������� : <input type="file" name="file">
			<div><span style="color: red; font-size: 14px;">�ͧ�Ѻ��� csv</span></div>
		</div>

		<div>
			<p>���͡ʶҹյ�Ǩ</p>
			<ul id="sortable">
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="register" name="step[register]" value="1"> 
					<label for="register">Ἱ�����¹</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="lab" name="step[lab]" value="1"> 
					<label for="lab">LAB</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="xray" name="step[xray]" value="1"> 
					<label for="xray">X-Ray</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="vs" name="step[vs]" value="1"> 
					<label for="vs">V/S �Ѵ�¡</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="pap" name="step[pap]" value="1"> 
					<label for="pap">PAP OPD �ٵ��</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="va" name="step[va]" value="1"> 
					<label for="va">V/A OPD ��</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="vs" name="step[ekg]" value="1"> 
					<label for="ekg">EKG OPD ��</label>
				</li>
			</ul>
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

		$(function(){
			$("#sortable").sortable();
		});
	</script>
	<?php

// ˹�ҹ������� .csv
}else if( $page === 'print_waypoint' ){

	$station_list = array(
		'register' => array(
			'��ͧ����¹' => 'ŧ����¹'
		),
		'lab' => array(
			'��ͧ��Ҹ�' => '������ʹ'
		),
		'xray' => array(
			'��ͧ�������' => 'X-RAY'
		),
		'vs' => array(
			'�ش�Ѵ�¡' => 'V/S'
		),
		'pap' => array(
			'OPD�ٵ��' => 'PAP'
		),
		'va' => array(
			'OPD��' => 'V/A'
		),
		'ekg' => array(
			'OPD��' => 'EKG'
		)
	);

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
	$company = $_POST['company'];
	$date_start = $_POST['date_start'];
	$date_end = $_POST['date_end'];
	$stations = $_POST['step'];

	$file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);

	$i = 1;
	foreach ($items as $key => $item) {

		if( empty($item) ){
			continue;
		}
		
		list($name, $surname, $age, $hn) = explode(',', $item);

		$hn = trim(str_replace(' ', '', $hn));

		// �� �� ���� ���
		list($y3, $m3, $d3) = explode('-', ad_to_bc($date_end));
		
		// !!! �ѧ����ͧ�Ѻ������͹
		list($y, $m, $d) = explode('-', ad_to_bc($date_start));
		if( !empty($d3) && $d !== $d3 ){
			$d .= ' - '.$d3;
		}
		$date_checkup = $d.' '.$def_fullm_th[$m].' '.$y;
		
		$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `fullname`,`idcard`,`dbirth`,`address`,`tambol`,`ampur`,`changwat`,`phone` 
		FROM `opcard` 
		WHERE `hn` = '$hn'";
		$db->select($sql);
		$patient = $db->get_item();
		
		$fullname = $name.' '.$surname;
		$idcard = $patient['idcard'];
		$address = $patient['address'].' �.'.$patient['tambol'].' �.'.$patient['ampur'].' �.'.$patient['changwat'];
		$phone = $patient['phone'];

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
											���� : <?=$age;?> ��
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
					<table width="100%">
						<!--
						<tr>
							<td class="pdxpro" colspan="2"><strong>��¡�õ�Ǩ�آ�Ҿ</strong></td>
						</tr>
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
										<?php 
										$station_i = 1;
										foreach ($stations as $key => $station) {
											$test_key = array_keys($station_list[$key]);
											$test_val = array_values($station_list[$key]);
											?>
											<td>
												<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
													<tr align='center' style='line-height:16px'>
														<td>
															ʶҹ� <?=$station_i;?><br>
															<?=$test_val['0'];?><br>
															<?=$test_key['0'];?><br>
															.............................
														</td>
													</tr>
												</table>
											</td>
											<?php
											$station_i++;
										}
										?>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="pdx" style="margin-left:10px;">
			<strong>*** �����˵� ***</strong><br />
			- ����ͷӡ�õ�Ǩ�ú�ءʶҹ����� ���͡����觤׹���˹�ҷ�� � �ش�Ѵ�¡ <br />
		</div>
		<?php 
		/*
		if( ( $i % 2 ) == 0 ){
			*/
			?>
			<div style="page-break-after: always;"></div>
			<?php
			/*
		}
		*/
		$i++;
	} // End foreach

}
?>