<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');

if( $action === false ){
	include 'menu.php';
?>
	<div>
		<h3>���͡43���</h3>
		<p>�Ѿഷ੾�� ��� charge_ipd </p>
	</div>
	<form action="onlycharge_ipd.php" method="post">
		<div>
			�� <input type="text" name="dateSelect">
			<span style="color: red">* ������ҧ 2559-01</span>
		</div>
		<div>
			<button type="submit">���͡</button>
			<input type="hidden" name="action" value="export">
		</div>
	</form>
<?php
} else if( $action === 'export' ){
	
	$dateSelect = input_post('dateSelect');
	
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>͹حҵ������ٻẺ ��-��͹ �� 2559-04 ��ҹ��</p>
		<a href="onlycharge_ipd.php">��͹��Ѻ</a>
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

	// ������ 27
	include 'libs/charge_ipd.php';
	
	echo '<p><a href="'.$filePath.'">�����Ŵ���</a></p>';
	echo '<p><a href="'.$qofPath.'">�����Ŵ�������Ѻ QOF</a></p>';
	echo '<p><a href="onlycharge_ipd.php">&lt;&lt;&nbsp;��Ѻ�˹����¡��</a></p>';
}