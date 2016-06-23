<?php
// define('NEW_SITE', true);
include 'bootstrap.php';


if( !isset($_SESSION['smenucode']) && ( $_SESSION['smenucode'] !== 'ADM' && $_SESSION['smenucode'] !== 'ADMCOM' ) ) die ('�к�੾�����˹�ҷ���ٹ�������������ҹ��');

$action = ( isset($_POST['action']) ) ? trim($_POST['action']) : false ;
if($action == 'add'){
	$file = $_FILES['internet'];
		
	if($file['error'] > 0){
		$_SESSION['x-msg'] = '��س����͡�������Ѿ��Ŵ';
		$_SESSION['type'] = 'warning';
		header('Location: import-internet.php');
		exit;
	}
	
	if(strrchr($file['name'], ".") != '.csv'){
		$_SESSION['x-msg'] = '͹حҵ੾����� .csv ��ҹ��';
		$_SESSION['type'] = 'warning';
		header('Location: import-internet.php');
		exit;
	}
	
	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);
	
	$day_type = ($_POST['day'] == 1) ? '1day' : '7day' ;
	
	$i = 0;
	$sql = "INSERT INTO `internet` (`register`, `type_net`, `user`, `pass`) VALUE ";
	
	$values = array();
	foreach($items as $key => $item){
		
		if(!empty($item)){
			list($user, $pass) = explode(',', $item);
			
			$values[] = "( '0000-00-00 00:00:00', '$day_type', '$user', '$pass' )";
		}
		
		$i++;
	}
	
	$sql .= implode(',', $values);
	
	$db = DB::load('utf8');
	$insert = $db->exec($sql);
	if($insert != false){
		$_SESSION['x-msg'] = '�����ӹǹ�����ҹ�Թ���������º����';
		$_SESSION['type'] = 'success';
	}else{
		$_SESSION['x-msg'] = '�����ӹǹ�����ҹ�Թ������������� ��سҵԴ��ͼ������к�';
		$_SESSION['type'] = 'warning';
	}
	
	// header('Location: import-internet.php');
	redirect('import-internet.php');
	exit;
}

include 'templates/classic/header.php';
?>

<div class="site-body">

	<div class="site-center">
		<div class="cell">
			<div class="col">
				<div class="page-header">
					<h1>�к����������ҹ�Թ������Ẻ 1�ѹ ��� 7�ѹ</h1>
				</div>
			</div>
			<div class="col width-2of4">
				<div class="cell">
					<?php
					$xMsg = get_session('x-msg');
					if( isset($xMsg) ){
						$color = ($_SESSION['type']=='warning') ? 'background-yellow' : 'background-green' ;
					?>
					<div class="col">
						<div class="cell">
							<div class="notify-warning">
								<?php echo $_SESSION['x-msg']; ?>
							</div>
						</div>
					</div>
					<?php
						set_session('x-msg', NULL);
					}
					?>
					<form method="post" action="import-internet.php" enctype="multipart/form-data">
						<div class="col">
							<div class="col width-1of4">���͡��� (�ͧ�Ѻ��� .csv ��ҹ��)</div>
							<div class="col width-fill">
								<div class="cell">
									<input type="file" name="internet">
								</div>
							</div>
						</div>
						<div class="col">
							<div class="col width-1of4">���͡�ٻẺ�ͧ�ѹ���</div>
							<div class="col width-fill">
								<div class="cell">
									<input name="day" id="1day" class="day" type="radio" value="1">
									<label for="1day">1�ѹ</label>
									<input name="day" id="7day" class="day" type="radio" value="7" checked>
									<label for="7day">7�ѹ</label>
								</div>
							</div>
						</div>
						<div class="col">
							<div class="col width-1of4"></div>
							<div class="col width-fill">
								<div class="cell">
									<button class="button" type="submit">����������</button>
									<input type="hidden" name="action" value="add">
								</div>
							</div>
						</div>
					</form>
					<div class="col">
						������ҧ��� .csv <a href="assets/example-internet-import.csv" target="_blank">��ԡ���ʹ����Ŵ</a>
					</div>
				</div>
			</div>
			<div class="col width-fill"></div>
		</div>
	</div>
	
</div>

<?php
include 'templates/classic/footer.php';