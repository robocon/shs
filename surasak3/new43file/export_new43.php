<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');


$file_lists = array(
	'person','address','chronic','disability','icf',
	'provider','dental','home','drugallergy','service',
	'admission','charge_opd','diagnosis_opd','drug_opd','epi',
	'death','card','appointment','accident','procedure_opd',
	'diagnosis_ipd','procedure_ipd','drug_ipd','charge_ipd','anc',
	'prenatal','ncdscreen','labfu','chronicfu',
);

if( $action === false ){
	include 'menu.php';
	?>
	<div>
		<h3>�к����͡43���</h3>
		<div class="btn-log"><b>Log</b></div>
		<div style="display: none;" class="log-detail">
			<p>1. ��͹��61 �Ѿഷ੾�� admission, service, drugallergy, epi, diagnosis_opd, drug_opd</p>
			<p>2. 12-01-2561 ���������� chronic, disability, provider, dental</p>
			<p>3. 29-01-2561 ���������� home, icf</p>
			<p>4. 30-08-2561 - 06-09-2561 ���������� anc, prenatal, ncdscreen, labfu, chronicfu</p>
			<p>2561-09-07 ��Ѻ��ا��� procedure_opd, procedure_ipd ���� CID ��л�Ѻ��ا��ô֧������ icd9-cm</p>
		</div>
	</div>

	<fieldset>
		<legend>���͡���������͡</legend>
		<form action="export_new43.php" method="post">
			<div>
				���͡�� <input type="text" name="dateSelect">
				<span style="color: red">* ������ҧ 2559-01</span>
			</div>
			<br>
			<div>
				<div>
					���͡���ҧ�������͡������ <input type="checkbox" name="checkAll" id="checkAll"> <label for="checkAll">���͡������</label>
				</div>
				
				<div>
					<table> 
						<tr>
						
						<?php 
						$i = 1;
						foreach ($file_lists as $key => $file_name) {
							?>
							<td>
								<input type="checkbox" name="<?=$file_name;?>" id="<?=$file_name;?>"> 
								<label for="<?=$file_name;?>"><?=$file_name;?></label>
							</td>
							<?php
							if( $i % 8 == 0 ){
								?></tr><tr><?php
							}
							$i++;
						}
						?>
						</tr>
					</table>
				</div>
			</div>
			<div>
				<button type="submit">���͡</button>
				<input type="hidden" name="action" value="export">
			</div>
		</form>
	</fieldset>
	<script src="../js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
        $(function() {
			
			$(document).on('click', '.btn-log', function(){
				$('.log-detail').toggle();
			});

			$(document).on('click', "#checkAll", function(){
				$("input:checkbox").not(this).prop("checked", this.checked);
			});
			
        });
        })(jQuery);
	</script>

	<div>
		<div>
			<h3>��ª����������´֧����������</h3>
		</div>
		<?php
		if( isset($_SESSION['x-msg']) ){
			?><div style="color: #FFC107;"><?=$_SESSION['x-msg'];?></div><?php
			$_SESSION['x-msg'] = NULL;
		}
		?>
		<div>
			<?php 
			$zipItems = glob('export/*.zip');
			$i = 1;
			?>
			<table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000">
				<tr>
					<th>#</th>
					<th>�������(��ԡ���ʹ����Ŵ��)</th>
					<th>��������ش���֧������</th>
					<th>�Ѵ���</th>
				</tr>
				<?php
				foreach( $zipItems as $key => $item ){
				?>
				<tr>
					<td><?=$i;?></td>
					<td>
						<?php
						preg_match('/\/(.+\.zip)/', $item, $matchs);
						echo '<a href="'.$item.'">'.$matchs['1'].'</a>';
						?>
					</td>
					<td>
						<?php
						echo date('Y-m-d H:i:s', filemtime($item));
						?>
					</td>
					<td><a href="export_new43.php?action=del&file=<?=urlencode($matchs['1']);?>" onclick="return delFile()">[ź������]</a></td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		function delFile(){
			var c = confirm("�׹�ѹ����ź������?");
			if( c === false ){
				return false;
			}
		}
	</script>
<?php
} else if ( $action === 'del' ) {
	
	$file = input_get('file');
	$testMatch = preg_match('/.+\.zip$/', $file);
	
	$msg = '������١��ͧ';
	if( $testMatch > 0 ){
		unlink('export/'.$file);
		$msg = 'ź������º����';
	}
	
	redirect('export_new43.php', $msg);
	
} else if( $action === 'export' ){
	
	$dateSelect = input_post('dateSelect');
	
	/*
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>͹حҵ������ٻẺ ��-��͹ �� 2559-04 ��ҹ��</p>
		<a href="export_new43.php">��͹��Ѻ</a>
		<?php
		exit;
	}
	*/

	$rptday_for_day = '';
	$rptday = '';
	$day_parth = '';

	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		list($thiyr, $rptmo) = explode('-', $dateSelect);
	}else{
		list($thiyr, $rptmo, $rptday) = explode('-', $dateSelect);

		$rptday_for_day = "-$rptday";

		$day_parth = '/'.$rptday;
	}



	$dirPath = realpath(dirname(__FILE__))."/export/$thiyr/$rptmo$day_parth";
	
	if( !is_dir("export/$thiyr") ){
		mkdir("export/$thiyr", 0777);
	}
	
	if( !is_dir("export/$thiyr/$rptmo") ){
		mkdir("export/$thiyr/$rptmo", 0777);
	}

	if( !is_dir("export/$thiyr/$rptmo$day_parth") ){
		mkdir("export/$thiyr/$rptmo$day_parth", 0777);
	}
	
	// define default val
	// $newyear = "$thiyr$rptmo$day";
	$thimonth = "$thiyr-$rptmo".$rptday_for_day; // e.g. 2559-05
	$yrmonth = ( $thiyr - 543 )."-$rptmo$rptday_for_day"; // e.g. 2016-05
	$yy = 543;
	$hospcode = '11512';
	$zipLists = array();
	$qofLists = array();



	if( $_POST['person'] ){
		// ������ 1
		include 'libs/person.php';
	}
	
	if( $_POST['address'] ){
		// ������ 2
		include 'libs/address.php';
	}
	

	if( $_POST['chronic'] ){ 
		// 4
		include 'libs/chronic.php';
	}
	

	if( $_POST['disability'] ){
		// 8
		include 'libs/disability.php';
	}
	
	if( $_POST['icf'] ){
		include 'libs/icf.php';
	}
	

	if( $_POST['provider'] ){
		include 'libs/provider.php';
	}
	

	if( $_POST['dental'] ){
		include 'libs/dental.php';
	}
	

	if( $_POST['home'] ){
		include 'libs/home.php';
	}
	
	
	if( $_POST['drugallergy'] ){
		// ������ 11
		include 'libs/drugallergy.php';
	}
	
	
	if( $_POST['service'] ){
		// ������ 14
		include 'libs/service.php';
	}
	
	
	if( $_POST['admission'] ){
		// ������ 23
		include 'libs/admission.php';
	}
	
	
	if( $_POST['charge_opd'] ){
		// ������ 18
		include 'libs/charge_opd.php';
	}
	
	
	if( $_POST['diagnosis_opd'] ){
		// ������ 15
		include 'libs/diagnosis_opd.php';
	}
	
	
	if( $_POST['drug_opd'] ){
		// ������ 16
		include 'libs/drug_opd.php';
	}
	
	
	if( $_POST['epi'] ){
		// ������ 39
		include 'libs/epi.php';
	}
	
	
	// ==== ��ҹ��ҧ�ѧ������Ѻ SQL PERFORMANCE ====
	
	if( $_POST['death'] ){ 
		// ������ 3
		include 'libs/death.php';
	}
	
	
	if( $_POST['card'] ){ 
		// ������ 5
		include 'libs/card.php';
	}
	
	
	if( $_POST['appointment'] ){ 
		// ������ 28
		include 'libs/appointment.php';
	}
	
	
	if( $_POST['accident'] ){ 
		// ������ 20
		include 'libs/accident.php';
	}
	
	
	if( $_POST['procedure_opd'] ){ 
		// ������ 17
		include 'libs/procedure_opd.php';
	}
	
	
	if( $_POST['diagnosis_ipd'] ){ 
		// ������ 24
		include 'libs/diagnosis_ipd.php';
	}
	
	if( $_POST['procedure_ipd'] ){ 
		// ������ 26
		include 'libs/procedure_ipd.php';
	}
	
	
	if( $_POST['drug_ipd'] ){ 
		// ������ 25
		include 'libs/drug_ipd.php';
	}
	
	if( $_POST['charge_ipd'] ){ 
		// ������ 27
		include 'libs/charge_ipd.php';
	}
	

	// �������
	if( $_POST['anc'] ){ 
		require_once 'libs/anc.php';
	}
	
	if( $_POST['prenatal'] ){ 
		require_once 'libs/prenatal.php';
	}
	

	if( $_POST['ncdscreen'] ){ 
		require_once 'libs/ncdscreen.php';
	}
	

	if( $_POST['labfu'] ){ 
		require_once 'libs/labfu.php';
		require_once 'libs/labfu2.php';
	}
	
	if( $_POST['chronicfu'] ){ 
		require_once 'libs/chronicfu.php';
	}
	
	
	
	
	// ���ҧ zip ���
	$main_folder = 'F43_11512_'.$thiyr.$rptmo.$rptday.'01090000';
	$zipName = 'export/'.$main_folder.'.zip';
	$zipNameQOF = 'export/QOF_'.$main_folder.'.zip';


	require_once("libs/dZip.inc.php"); // include Class
	
	$zip = new dZip($zipName);
	foreach( $zipLists as $key => $list){
		
		// match ���੾�Ъ������
		preg_match('/\/(\w+\.txt)/', $list, $file);
		
		// $zip->addFile(path���Ѩ�غѹ, ��������������ҧ�zip����);
		$zip->addFile($list, $main_folder.'/'.$file['1']);
	}
	$zip->save();
	
	// ���ҧ zip ����Ѻ�� QOF ��� �ʨ
	$zip = new dZip($zipNameQOF);
	foreach( $qofLists as $key => $list){
		preg_match('/\/(\w+\.txt)/', $list, $file);
		$filename = str_replace('qof_', '', $file['1']); // ź��Ҥ� qof_ �͡
		$zip->addFile($list, $main_folder.'/'.$filename);
	}
	$zip->save();
	
	echo '<p><a href="'.$zipName.'">�����Ŵ���</a></p>';
	echo '<p><a href="'.$zipNameQOF.'">�����Ŵ�������Ѻ QOF</a></p>';
	echo '<p><a href="export_new43.php">&lt;&lt;&nbsp;��Ѻ�˹����¡��</a></p>';
}