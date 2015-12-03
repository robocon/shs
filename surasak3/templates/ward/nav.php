<div class="col page-header-col no-print">
	<div class="cell">
		<div class="page-header">
			<h1>สถิติของผู้ป่วยประจำเดือน</h1>
		</div>
	</div>
</div>
<div class="col nav-menu-col no-print">
	<div class="menu cell">
		<?php 
			$home = ( $page === false ) ? 'class="active"' : false ;
			$form = ( $page === 'form' ) ? 'class="active"' : false ;
		?>
		<ul class="nav">
			<li><a href="../nindex.htm">หน้าหลัก รพ.</a></li>
			<li <?php echo $home;?>><a href="ward_stat.php">หน้ารายการ</a></li>
			
			<li><a href="ward_stat.php?page=form">Ward ต่างๆ</a></li>
					<li><a href="ward_stat.php?page=form&view=obgyn">Ward สูติ</a></li>
					<li><a href="ward_stat.php?page=form_acu">ฝังเข็ม</a></li>
		</ul>
	</div>
</div>