<div class="col width-fill mobile-width-fill no-print">
	<div class="cell">
		<ul class="col nav">
			<li class="active"><a href="../nindex.htm">˹����ѡ����� SHS</a></li>
		</ul>
	</div>
</div>
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
		?>
		<ul class="nav">
			<li <?php echo $home;?>><a href="ward_stat.php">��¡������</a></li>
			<li><a href="ward_stat.php?page=form">Ẻ���������</a></li>
			<li><a href="ward_stat.php?page=form&view=obgyn">Ẻ������ٵ�</a></li>
			<li><a href="ward_stat.php?page=home_acu">��¡�ýѧ���</a></li>
			<li><a href="ward_stat.php?page=form_acu">Ẻ������ѧ���</a></li>
		</ul>
	</div>
</div>
<?php
if( isset($_SESSION['x-msg']) ){
    ?><div class="notify-warning"><?php echo $_SESSION['x-msg'];?></div><?php
    unset($_SESSION['x-msg']);
}