<?php 
session_start();
$smenucode = $_SESSION['smenucode'];
if( !empty($smenucode) && $smenucode == 'ADMPHA' ){
	?>
	<div id="menu">
		<ul class="menu">
			<li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹����ѡ</span></a></li>
			<li><a href="Report_clinic_wellbaby.php"><span>��§ҹ ��Թԡ Well baby</span></a></li>
		</ul>
	</div>
	<?php
}else{
	?>
	<div id="menu">
		<ul class="menu">
			<li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>˹����ѡ</span></a></li>
			<li><a href="service.php"><span>��ش����¹�Ѥ�չ��</span></a></li>
			<li><a href="clinic_well_baby.php"><span>��Թԡ Well baby</span></a></li>
			<li>
				<a href="javascript:void(0);"><span>��§ҹ����Ѻ��ԡ���Ѥ�չ��</span></a>
				<ul>
					<li><a href="Report_m.php"><span>��§ҹ����Ѻ��ԡ�û�Ш���͹</span></a></li>
					<li><a href="Report_vac.php"><span>��§ҹ����Ѻ��ԡ�õ���Ѥ�չ</span></a></li>
					<li><a href="Report_all.php"><span>��§ҹ����Ѻ��ԡ�÷�����</span></a></li>
				</ul>
			</li>
			<li><a href="Report_clinic_wellbaby.php"><span>��§ҹ ��Թԡ Well baby</span></a></li>
			<li><a href="show_edit.php"><span>��䢢������Ѥ�չ</span></a></li>
			<li><a href="add_vac.php"><span>�Ѵ��â������Ѥ�չ</span></a></li>
		</ul>
	</div>
	<?php 
}
?>