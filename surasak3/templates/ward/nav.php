<div class="col page-header-col no-print">
	<div class="cell">
		<div class="page-header">
			<h1>ʶԵԢͧ�����»�Ш���͹</h1>
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
			<li><a href="../nindex.htm">˹����ѡ þ.</a></li>
			<li <?php echo $home;?>><a href="ward_stat.php">˹����¡��</a></li>
			
			<li><a href="ward_stat.php?page=form">Ward ��ҧ�</a></li>
					<li><a href="ward_stat.php?page=form&view=obgyn">Ward �ٵ�</a></li>
					<li><a href="ward_stat.php?page=form_acu">�ѧ���</a></li>
		</ul>
	</div>
</div>