<?php
include 'bootstrap.php';

if( authen() === false ) die("Invalid User");
DB::load();

$step = (int) input_get('step', 0);
$ward = array(
	'42' => 'หอผู้ป่วยรวม',
	'43' => 'หอผู้ป่วยสูตินรี',
	'44' => 'หอผู้ป่วย ICU',
	'45' => 'หอผู้ป่วยพิเศษ',
);

?>
<style type="text/css">
*{
	font-family: 'TH SarabunPSK';
	font-size: 16pt;
}
</style>
<?php

if( $step === 0 ){
	?>
	<div>
		<a href="../nindex.htm">หน้าหลักโปรแกรม รพ.ค่าย</a>
	</div>
	<div>
		<h3>ยกเลิกการ Admit โดยห้องทะเบียน</h3>
	</div>
	<?php
	if( get_session('x-msg') ){
		?><div style="color: red;"><?=get_session('x-msg');?></div><?php
		set_session('x-msg', false);
	}
	?>
	<table>
		<thead>
			<tr>
				<th>ชื่อ - สกุล</th>
				<th>HN</th>
				<th>AN</th>
				<th>Ward</th>
				<th>เตียง</th>
				<th>สิทธิ์</th>
				<th>การจัดการ</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$sql = "SELECT * FROM `bed` WHERE `ptname` != ''";
			$items = DB::select($sql);
			foreach( $items as $key => $item ){
				$wardCode = substr($item['bedcode'], 0, 2);
				if( $ward[$wardCode] ){
					?>
					<tr>
						<td><?=$item['ptname'];?></td>
						<td><?=$item['hn'];?></td>
						<td><?=$item['an'];?></td>
						<td><?=$ward[$wardCode];?></td>
						<td><?=$item['bedcode'];?></td>
						<td><?=$item['ptright'];?></td>
						<td><a href="cancel_admit.php?step=2&bedcode=<?=$item['bedcode'];?>">ยกเลิก</a></td>
					</tr>
					<?php 
				}
			} 
			?>
		</tbody>
	</table>
	<?
	
} elseif ( $step === 2 ) {
	
	$bedCode = input_get('bedcode');
	
	$sql = "SELECT * FROM `bed` WHERE `bedcode` = '$bedCode' LIMIT 1;";
	$item = DB::select($sql, null, true);
	
	$wardCode = substr($item['bedcode'], 0, 2);
	?>
	<div>
		<a href="cancel_admit.php">กลับไปหน้ารายการ</a>
	</div>
	<form action="cancel_admit.php?step=3" method="post">
		<div>
			<h3>ข้อมูลผู้ป่วยที่จะทำการยกเลิก Admit</h3>
			<p><b>ชื่อ:</b> <?=$item['ptname'];?></p>
			<p><b>HN:</b> <?=$item['hn'];?></p>
			<p><b>AN:</b> <?=$item['an'];?></p>
			<p><b>Ward:</b> <?=$ward[$wardCode];?></p>
			<p><b>เตียง:</b> <?=$item['bedcode'];?></p>
			<p><b>สิทธิ์:</b> <?=$item['ptright'];?></p>
		</div>
		<div>
			<label for="confirm_pass">ยืนยันรหัสผ่านผู้ใช้งาน</label>
			&nbsp;<input type="password" id="confirm_pass" name="confirm_pass">
		</div>
		<div>
			<button type="submit">ยืนยันการลบข้อมูล</button>
			<input type="hidden" name="bedcode" value="<?=$bedCode;?>">
			<input type="hidden" name="hn" value="<?=$item['hn'];?>">
		</div>
	</form>
	<?php
	// แจ้งเตือนกรณีที่รหัสผ่านไม่ถูก
	if( get_session('x-msg') ){
		?><div style="color: red;"><?=get_session('x-msg');?></div><?php
		set_session('x-msg', false);
	}
	
} elseif ( $step === 3 ) {
	
	$userId = get_session('sRowid');
	$pass = input_post('confirm_pass');
	$bedCode = input_post('bedcode');
	$sql = "SELECT `row_id` FROM `inputm` WHERE `row_id` = :user_id AND `pword` = :password ;";
	$item = DB::select($sql, array(':user_id' => $userId, ':password' => $pass), true);
	if( $item !== NULL ){
		
		$thai_date = ( date('Y') + 543 ).date('-m-d H:i:s');
		$editor = get_session('sOfficer');
		$hn = input_post('hn');
		/**
		 * @todo
		 * [x] ตรวจสอบการ lock จากห้องการเงินก่อน
		 * [x] backup `bed`
		 * [x] INSERT `ward_log`
		 * [x] UPDATE `bed`
		 * [x] UPDATE `ipcard`
		 */
		
		// เช็กการล็อคจากส่วนเก็บเงิน
		$sql = "SELECT `lock_dc` FROM `ipcard` WHERE `bedcode` = :bed_code AND `hn` = :hn";
		$item = DB::select($sql, array(':bed_code' => $bedCode, ':hn' => $hn), true);
		
		if( empty($item['lock_dc']) ){
			redirect('cancel_admit.php?step=2&bedcode='.$bedCode, 'กรุณาติดต่อส่วนเก็บเงินรายได้เพื่อทำการปลดล็อคก่อนดำเนินการยกเลิก Admit');
		}
		
		// Backup `bed`
		$sql = "SELECT * FROM `bed` WHERE `bedcode` = :bed_code LIMIT 1;";
		$item = DB::select($sql, array(':bed_code' => $bedCode), true);
		$sql = "INSERT INTO `bed_log`  (
`row_id` ,
`bed` ,
`ptname` ,
`age` ,
`idcard` ,
`address` ,
`muang` ,
`ptright` ,
`doctor` ,
`date` ,
`hn` ,
`an` ,
`diagnos` ,
`bedcode` ,
`price` ,
`paid` ,
`debt` ,
`caldate` ,
`food` ,
`officer` ,
`chgdate` ,
`bedname` ,
`bedpri` ,
`accno` ,
`status` ,
`ajrw` ,
`diag1` ,
`last_drug` ,
`chgwdate` ,
`status_detail` ,
`lastcalroom` ,
`days` ,
`date_edit`
) VALUES (
'".$item['row_id']."', 
'".$item['bed']."', 
'".$item['ptname']."', 
'".$item['age']."', 
'".$item['idcard']."', 
'".$item['address']."', 
'".$item['muang']."', 
'".$item['ptright']."', 
'".$item['doctor']."', 
'".$item['date']."', 
'".$item['hn']."', 
'".$item['an']."', 
'".$item['diagnos']."', 
'".$item['bedcode']."', 
'".$item['price']."', 
'".$item['paid']."', 
'".$item['debt']."', 
'".$item['caldate']."', 
'".$item['food']."', 
'".$item['officer']."', 
'".$item['chgdate']."', 
'".$item['bedname']."', 
'".$item['bedpri']."', 
'".$item['accno']."', 
'".$item['status']."', 
'".$item['ajrw']."', 
'".$item['diag1']."', 
'".$item['last_drug']."', 
'".$item['chgwdate']."', 
'".$item['status_detail']."', 
'".$item['lastcalroom']."', 
'".$item['days']."',
NOW()
);";
		DB::exec($sql);
		// เพิ่มข้อมูลใน ward_log
		$wardCode = substr($item['bedcode'], 0, 2);
		$sql = "INSERT INTO `ward_log` 
		( `regisdate` , `an` , `hn` , `ward` , `bedcode` , `chgcode` , `old` , `new` , day ,  `lastcall` , `office` ) 
		VALUES ( 
			'$thai_date', 
			'".$item['an']."', 
			'".$item['hn']."', 
			'".$ward[$wardCode]."', 
			'".$item['bedcode']."',
			'Delete', 
			'', 
			'', 
			'', 
			'".$item['lastcalroom']."',
			'".$editor."'
		)";
		DB::exec($sql);
		
		// เคลียร์ค่าใน `bed`
		$sql = "UPDATE `bed` SET `ptname`='', `age`='', `idcard`='', `address`='', `muang`='', 
		`ptright`='', `doctor`='', `date`='', `hn`='', `an`='', 
		`diagnos`='', `price`=0, `paid`=0, `debt`=0, `food`='', 
		`diag1`='', `officer`='', `chgdate` = NOW() 
		WHERE `bedcode`='$bedCode';";
		DB::exec($sql);
		
		// อัพเดทใน ipcard
		$sql = "UPDATE `ipcard` SET `dcdate` = '$thai_date', `status_log`='จำหน่าย' WHERE `an`='".$item['an']."'";
		DB::exec($sql);
		
		redirect('cancel_admit.php', 'ดำเนินการยกเลิก Admit เสร็จเรียบร้อย');
	}else{
		redirect('cancel_admit.php?step=2&bedcode='.$bedCode, 'รหัสผู้ใช้งานไม่ถูกต้อง');
	}
	
	exit;
}