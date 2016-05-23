<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');

if( $action === false ){
?>
	<div>
		<a href="../../nindex.htm">&lt;&lt;&nbsp;��Ѻ�˹������</a>
	</div>
	<div>
		<h3>���͡43���</h3>
		<p>�Ѿഷ੾�� admission, service, drugallergy, epi, diagnosis_opd, drug_opd</p>
	</div>
	<form action="export_new43.php" method="post">
		<div>
			�� <input type="text" name="dateSelect">
			<span style="color: red">* ������ҧ 2559-01</span>
		</div>
		<div>
			<button type="submit">���͡</button>
			<input type="hidden" name="action" value="export">
		</div>
	</form>
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
	
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>͹حҵ������ٻẺ ��-��͹ �� 2559-04 ��ҹ��</p>
		<a href="export_new43.php">��͹��Ѻ</a>
		<?php
		exit;
	}
	list($thiyr, $rptmo) = explode('-', $dateSelect);
	
	$dirPath = "export/$thiyr/$rptmo";
	
	if( !is_dir("export/$thiyr") ){
		mkdir("export/$thiyr", 0777);
	}
	
	if( !is_dir($dirPath) ){
		mkdir($dirPath, 0777);
	}
	
	// define default val
	// $newyear = "$thiyr$rptmo$day";
	$thimonth = "$thiyr-$rptmo"; // e.g. 2559-05
	$yrmonth = ( $thiyr - 543 )."-$rptmo"; // e.g. 2016-05
	$yy = 543;
	$hospcode = '11512';
	$zipLists = array();
	$qofLists = array();
	
	// ������ 1
	include 'libs/person.php';
	
	// ������ 2
	include 'libs/address.php';
	
	// ������ 11
	include 'libs/drugallergy.php';
	
	// ������ 14
	include 'libs/service.php';
	
	// ������ 23
	include 'libs/admission.php';
	
	// ������ 18
	include 'libs/charge_opd.php';
	
	// ������ 15
	include 'libs/diagnosis_opd.php';
	
	// ������ 16
	include 'libs/drug_opd.php';
	
	// ������ 39
	include 'libs/epi.php';
	
	// ==== ��ҹ��ҧ�ѧ������Ѻ SQL PERFORMANCE ====
	
	// ������ 3
	include 'libs/death.php';
	
	// ������ 5
	include 'libs/card.php';
	
	// ������ 28
	include 'libs/appointment.php';
	
	// ������ 20
	include 'libs/accident.php';
	
	// ������ 17
	include 'libs/procedure_opd.php';
	
	// ������ 24
	include 'libs/diagnosis_ipd.php';
	
	// ������ 26
	include 'libs/procedure_ipd.php';
	
	// ������ 25
	include 'libs/drug_ipd.php';
	
	// ������ 27
	include 'libs/charge_ipd.php';
	
	
	// ���ҧ zip ���
	$main_folder = 'F43_11512_'.$thiyr.$rptmo.'01090000';
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