<div class="col page-header-col no-print">
	<div class="cell">
		<div class="page-header">
			<h1>��§ҹ��������ԡ��</h1>
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
			<li <?php echo $home;?>><a href="ward_stat.php">˹����ѡ</a></li>
			<li <?php echo $form;?> class="sub_nav"><a href="#">����������</a>
				<ul>
					<li><a href="ward_stat.php?page=form">Ward ��ҧ�</a></li>
					<li><a href="ward_stat.php?page=form&view=obgyn">੾�� Ward �ٵ�</a></li>
				</ul>
			</li>
		</ul>
	</div>
</div>