<div class="col page-header-col">
	<div class="cell">
		<div class="page-header">
			<h1>รายงานผู้มาใช้บริการ</h1>
		</div>
	</div>
</div>
<div class="col nav-menu-col">
	<div class="menu cell">
		<?php 
			$home = ( $page === false ) ? 'class="active"' : false ;
			$form = ( $page === 'form' ) ? 'class="active"' : false ;
		?>
		<ul class="nav">
			<li <?php echo $home;?>><a href="ward_stat.php">หน้าหลัก</a></li>
			<li <?php echo $form;?>><a href="ward_stat.php?page=form">เพิ่มข้อมูล</a></li>
		</ul>
	</div>
</div>