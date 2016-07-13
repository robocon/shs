<?php

include 'bootstrap.php';


$action = input('action');


if( $action === false ){

	include 'templates/classic/header.php';

	$db = Mysql::load();
	$sql = "SELECT `row_id`,`name`,`menucode` FROM `inputm` 
	WHERE level = 'user' 
	ORDER BY `name` ASC";
	$db->select($sql);
	$users = $db->get_items();
	?>
	<div class="col">
		<div class="cell">
			<form action="user_durgcontrol.php" method="post">
				<div class="col">
					<div class="cell">
						<select name="user" id="user">
							<option value="">เลือกผู้ใช้งาน</option>
							<?php
							foreach( $users as $key => $user ){
								?>
								<option value="<?=$user['row_id'];?>"><?=$user['name'];?></option>
								<?php
							}
							?>
						</select>
					</div>
				</div>
				<div class="col">
					<div class="cell">
						<button type="submit">เพิ่มข้อมูล</button>
					</div>
				</div>
			</form>
		</div>
	</div>
    <?php
}elseif( $action === 'test' ){

}