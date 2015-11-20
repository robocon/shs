<?php 
include 'bootstrap.php';
DB::load();

/**
 * จัดการข้อมูล
 */
// การกระทำต่างๆ เช่น บันทึก, แก้ไข, ลบ
$action = isset($_REQUEST['action']) ? trim($_REQUEST['action']) : false;

// หน้าต่างการแสดงผลต่างๆ เช่น หน้ารายการ, หน้าฟอร์ม
$page = isset($_REQUEST['page']) ? trim($_REQUEST['page']) : false;

// จุดการแสดงผลในหน้านั้นๆ
$view = isset($_REQUEST['view']) ? trim($_REQUEST['view']) : false;
if( $action === 'save' ){
	
}


/**
 * แสดงในส่วนของ view
 */
include 'templates/classic/header.php';

?>
<div class="site-center">
	<div class="site-body panel">
		<div class="body">
			<div class="cell">
			<?php
			// เมนู
			include 'templates/ward/nav.php';
			if( $page === false ){ // Home && Default page
				?>
				<h3>รายการ</h3>
				<?php
			}elseif( $page === 'form' ){
				include 'templates/ward/form.php';
			}
			?>
			</div>
		</div>
	</div>
</div>
<?php
include 'templates/classic/footer.php';