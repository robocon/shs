<div class="col page-header-col">
	<div class="cell">
		<div class="page-header">
			<h1>ระบบสำรวจสภาวะช่องปาก</h1>
		</div>
	</div>
</div>
<div class="col nav-menu-col">
	<div class="menu cell">
		<?php 
			$home_active = ( $task === false ) ? 'class="active"' : false ;
			$form_active = ( $task === 'form' ) ? 'class="active"' : false ;
			$form_category = ( $task === 'category_form' ) ? 'class="active"' : false ;
			$den_report = ( $task === 'report' ) ? 'class="active"' : false ;
			$report_mouth = ( $task === 'report_mouth' ) ? 'class="active"' : false ;
		?>
		<ul class="nav clear">
			<li <?php echo $home_active;?>><a href="survey_oral.php">หน้าหลัก</a></li>
			<li <?php echo $form_active;?>><a href="survey_oral.php?task=form">เพิ่มข้อมูลแบบสำรวจ</a></li>
			<li <?php echo $form_category;?>><a href="survey_oral.php?task=category_form">จัดการข้อมูลหน่วยงาน</a></li>
			<li <?php echo $den_report;?>><a href="survey_oral.php?task=report">รายงานผลการสำรวจ</a></li>
			<li <?php echo $report_mouth;?>><a href="survey_oral.php?task=report_mouth">รายงานสภาวะช่องปากและระดับ</a></li>
		</ul>
	</div>
</div>
<?php // Notification ?>
<?php if( isset($_SESSION['x-msg']) ): ?>
<div class="notify-warning no-print"><?php echo $_SESSION['x-msg']; ?></div>
<?php unset($_SESSION['x-msg']); ?>
<?php endif; ?>