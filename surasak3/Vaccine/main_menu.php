<?php 
session_start();
$smenucode = $_SESSION['smenucode'];
if( !empty($smenucode) && $smenucode == 'ADMPHA' ){
	?>
	<div id="menu">
		<ul class="menu">
			<li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าหลัก</span></a></li>
			<li><a href="Report_clinic_wellbaby.php"><span>รายงาน คลินิก Well baby</span></a></li>
		</ul>
	</div>
	<?php
}else{
	?>
	<div id="menu">
		<ul class="menu">
			<li><a href="http://192.168.1.2/sm3/nindex.htm" class="parent"><span>หน้าหลัก</span></a></li>
			<li><a href="service.php"><span>สมุดทะเบียนวัคซีนเด็ก</span></a></li>
			<li><a href="clinic_well_baby.php"><span>คลินิก Well baby</span></a></li>
			<li>
				<a href="javascript:void(0);"><span>รายงานการรับบริการวัคซีนเด็ก</span></a>
				<ul>
					<li><a href="Report_m.php"><span>รายงานการรับบริการประจำเดือน</span></a></li>
					<li><a href="Report_vac.php"><span>รายงานการรับบริการตามวัคซีน</span></a></li>
					<li><a href="Report_all.php"><span>รายงานการรับบริการทั้งหมด</span></a></li>
				</ul>
			</li>
			<li><a href="Report_clinic_wellbaby.php"><span>รายงาน คลินิก Well baby</span></a></li>
			<li><a href="show_edit.php"><span>แก้ไขข้อมูลวัคซีน</span></a></li>
			<li><a href="add_vac.php"><span>จัดการข้อมูลวัคซีน</span></a></li>
		</ul>
	</div>
	<?php 
}
?>