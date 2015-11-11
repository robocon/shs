<?php
include 'bootstrap.php';

include 'templates/classic/header.php';
?>
<div class="site-body">
	<div class="site-center">
		<div class="cell">
			<?php 
			include 'dt_menu.php';
			include 'dt_patient.php';
			?>
			<?php 
// 			dump($_SESSION);
			DB::load();
			
			$sql = "SELECT * FROM `data_patient` WHERE `hn` = :hn ORDER BY `date_add` DESC;";
			$items = DB::select($sql, array(':hn' => $_SESSION['hn_now']));
			
			if ( DB::$rows === 0 ) {
				echo 'ไม่มีประวัติผู้ป่วยในระบบ';
				exit;
			}else{
				?>
				<h3>ประวัติผู้ป่วย</h3>
				<table>
					<tr>
						<th>วันที่</th>
						<th>ไฟล์</th>
					</tr>
				<?php 
				foreach( $items as $key => $item ){
					if( is_file($item['path_file']) ){
						?>
						<tr>
							<td><?php echo $item['date_add'];?></td>
							<td><a href="<?php echo $item['path_file'];?>" target="_blank"><?php echo $item['path_file'];?></a></td>
						</tr>
						<?php 
					}
				}
				?>
				</table>
				<?php 
			}
			?>
		</div>
	</div>
</div>
<?php 
include 'templates/classic/footer.php';