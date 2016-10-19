<?php
/**
 * ระบบนำเข้าข้อมูลสิทธิ30บาทจาก สปสช เจ้แหม่ม เพื่อนำมาเปรียบเทียมกับข้อมูลของ รพ. ว่ามีใครในรายชื่อบ้างที่มีอยู่ใน รพ.
 * 
 * @author Kritsanasak
 */
include '../bootstrap.php';

$user_code = get_session('smenucode');
// if( $user_code !== 'ADM' ){
// 	echo "อนุญาตเฉพาะผู้ดูแลระบบ และเจ้าหน้าที่43แฟ้ม เท่านั้น";
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
			<h3>อัพเดทข้อมูลผู้ป่วยในรพ.สิทธิ์ 30บาท</h3>
			<form action="popuckai.php" method="post" enctype="multipart/form-data">
				<div>
					<div>
						เลือกไฟล์: <input type="file" name="uc30">
					</div>
				</div>
				<div>
					<div>
						<button type="submit">อัพเดทข้อมูล</button>
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
		echo 'อนุญาตเฉพาะไฟล์ .txt จร๊าาาา ฮิ๊วๆ';
		exit;
	}

	// อัพโหลดไฟล์
	$upload = move_uploaded_file($file['tmp_name'], $file['name']);
	
	$db = Mysql::load();

	// เคลียร์ข้อมูลเดิมออกให้หมดก่อน
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
		echo "ไม่สามารถนำเข้าข้อมูลได้ แค๊ปหน้าจอส่งไปให้โปเกม่อนหน่อยจร๊าาาาาา<br><br>";
		echo implode("\n\r", $errors);
		echo 'ชื่อไฟล์: '.$file['name'];
		unlink($file['name']);
	}else{
		redirect('popuckai.php', 'อัพเดทข้อมูลเรียบร้อยแล๊นนน');
	}

}