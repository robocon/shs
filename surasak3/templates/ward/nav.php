<div class="col page-header-col">
	<div class="cell">
		<div class="page-header">
			<h1>��§ҹ��������ԡ��</h1>
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
			<li <?php echo $home;?>><a href="ward_stat.php">˹����ѡ</a></li>
			<li <?php echo $form;?>><a href="ward_stat.php?page=form">����������</a></li>
		</ul>
	</div>
</div>