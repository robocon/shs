<?php
/**
 * �к�����Ң������Է��30�ҷ�ҡ ʻʪ ������� ���͹������º�����Ѻ�����Ţͧ þ. ����������ª��ͺ�ҧ���������� þ.
 * 
 * @author Kritsanasak
 */
include '../bootstrap.php';

$user_code = get_session('smenucode');
// if( $user_code !== 'ADM' ){
// 	echo "͹حҵ੾�м������к� ������˹�ҷ��43��� ��ҹ��";
// 	exit;
// }

$action = input_post('action');

if( $action === false ){

	include '../templates/classic/header.php';
	include 'menu.php';

	$msg = get_session('x-msg');
	if( $msg !== null ){
		?>
		<div class="notify-warning">
			<div><?=$msg;?></div>
		</div>
		<?php
		set_session('x-msg', null);
	}
	?>
	<div class="col">
		<div class="cell">
			<h3>�Ѿഷ�����ż������þ.�Է��� 30�ҷ</h3>
			<form action="popuckai.php" method="post" enctype="multipart/form-data">
				<div>
					<div>
						���͡���: <input type="file" name="uc30">
					</div>
				</div>
				<div>
					<div>
						<button type="submit">�Ѿഷ������</button>
						<input type="hidden" name="action" value="update_form">
						<input type="hidden" name="token" value="<?=generate_token('uc30baht');?>">
					</div>
				</div>
			</form>
		</div>
	</div>
	<?php
	include '../templates/classic/footer.php';

}else if( $action === 'update_form' ){
	$token = input_post('token');
	$token_test = check_token($token, 'uc30baht');
	if( $token_test === false ){
		echo 'Invalid token';
		exit;
	}

	$file = $_FILES['uc30'];
	if( preg_match('/.+\.txt$/', $file['name']) === 0 ){
		echo '͹حҵ੾����� .txt ������� �����';
		exit;
	}

	// �Ѿ��Ŵ���
	$upload = move_uploaded_file($file['tmp_name'], $file['name']);
	
	$db = Mysql::load();

	// ���������������͡��������͹
	$db->select("TRUNCATE TABLE `sso30`");

	$txt = file_get_contents($file['name'], true);
	$test = false;
	$test_num = 0;
	$errors = array();
	foreach( explode("\n", $txt) as $key => $item ){

		list($idcard, $x1, $name, $surname, $dob, $x2, $x3, $ucs, $date_start, $date_expire, $hos_code1, $hos_code2, $x4, $x5, $x6, $age, $hos_code3) = explode('|', $item);

		if( !empty($idcard) && preg_match('/\d{13,}/', $idcard) > 0 ){
			
			$sql = "INSERT INTO `sso30`
			(`idcard`,`name`,`surname`,`dob`,`date_start`,`date_expire`)
			VALUES
			(:idcard, :name, :surname, :dob, :date_start, :date_expire);";
			$data = array(
				':idcard' => $idcard, 
				':name' => ( is_null($name) ? '' : $name ), 
				':surname' => ( is_null($surname) ? '' : $surname ), 
				':dob' => ( is_null($dob) ? '' : $dob ), 
				':date_start' => ( is_null($date_start) ? '' : $date_start ), 
				':date_expire' => ( is_null($date_expire) ? '' : $date_expire )
			);

			$insert = $db->insert($sql, $data);
			if( $insert !== true ){
				$test = true;
				$errors[] = $insert['error'];
			}

			$test_num++;
		}
	}

	if( $test === true OR $test_num === 0 ){
		echo "�������ö����Ң������� ��˹�Ҩ�����������͹˹��¨��������<br><br>";
		echo implode("\n\r", $errors);
		echo '�������: '.$file['name'];
		unlink($file['name']);
	}else{
		redirect('popuckai.php', '�Ѿഷ���������º������깹�');
	}

}