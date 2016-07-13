<style type="text/css">
* { margin:0; padding:0; }
ody { /*background:rgb(74,81,85); */}
div#menu { margin:5px auto; }
div#copyright { font:11px 'Trebuchet MS'; color:#fff; text-indent:30px; padding:40px 0 0 0; }
td,th { font-family:"TH SarabunPSK"; font-size: 16 pt; }
.fontsara { font-family:"TH SarabunPSK"; font-size: 16 pt; }
@media print{ #no_print{display:none;} }
.theBlocktoPrint { background-color: #000; color: #FFF; } 
.forntsarabun {font-family: "TH SarabunPSK";font-size: 22px;}
</style>
<!-- START MENU -->
<div id="no_print">
	<div id="menu">
		<ul class="menu">
			<!--http://10.0.1.4/sm3/nindex.htm-->
			<li><a href="../../nindex.htm" class="parent"><span>หน้าแรก</span></a></li>
			<li><a href="ncf2.php" class="parent"><span>บันทึกรายงานเหตุการณ์สำคัญ</span></a></li>
			<li><a href="fha_from.php" class="parent"><span>บันทึกรายงานความคลาดเคลื่อนทางยา</span></a></li>
			<li><a href="report_ift.php" class="parent"><span>แบบบันทึกการติดตามภาวะการติดเชื้อ</span></a></li>
			<li><a href="report_accident.php" class="parent"><span>แบบรายงานการได้รับอุบัติเหตุ</span></a></li>
			<?php
			if($_SESSION["statusncr"]=='admin'){
			?>    
			<li>
				<a href="#"><span>ใบรายงานเหตุการณ์ฯ</span></a>
				<ul>
					<li class="last"><a href="ncf_list_clinic.php"><span>ใบรายงานที่ยังไม่ได้บันทึกระดับความรุนแรง</a></span></li>
					<li class="last"><a href="ncf_list_risk.php"><span>ใบรายงานที่ยังไม่ได้บันทึกความเสี่ยง</a></span></li>
					<li class="last"><a href="ncf_list_ic.php"><span>ใบรายงาน เฉพาะ IC และ MR </span></a></li>
					<li class="last"><a href="ncf_listall.php"><span>ใบรายงานทั้งหมด</span></a></li>
					<li class="last"><a href="ncf_list_riskmore2.php"><span>ตรวจสอบใบรายงาน</span></a></li>
				</ul>
			</li>
			<li>
				<a href="#"><span>รายงานสรุป</span></a>
				<ul>
					<li class="last"><a href="ncr_report_all.php"><span>รายงานสรุปอุบัติการณ์ รวมทั้งหมด</span></a></li>
					<li class="last"><a href="ncr_report_progarm.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</span></a></li>
					<li class="last"><a href="ncr_report_event.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามเหตุการณ์</span></a></li>
					<li class="last"><a href="ncf_report_departall.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามแผนก</span></a></li>
					<li class="last"><a href="ncr_report_progarmdepart2.php"><span>รายงานสรุปความเสี่ยงแต่ละแผนก</span></a></li>
					<li class="last"><a href="ncr_report_clinic.php"><span>รายงานสรุประดับความรุนแรง</span></a></li>
					<li class="last"><a href="ncf_report_depart.php"><span>หน่วยงานที่รายงานอุบัติการณ์</a></span></li>
					<li class="last"><a href="fha_report_depart.php"><span>รายงานสรุป ความคลาดเคลื่อนทางยา</a></span></li>
					<li class="last"><a href="report_ic_accident.php"><span>รายงานอุบัติการณ์ IC</span></a></li>
					<li class="last"><a href="ic_report_depart.php"><span>สรุปอุบัติการณ์ IC  ประจำปี</span></a></li>
				</ul>
			</li>
			<li>
				<a href="#"><span>รายงานความคลาดเคลื่อนทางยา</span></a>
				<ul>
					<li class="last"><a href="fha_data_old.php"><span>ข้อมูลเก่า หลังเดือน ม.ค.2555</span></a></li>
					<li class="last"><a href="report_fha.php"><span>ข้อมูลใหม่ ตั้งแต่ ม.ค.2555 ขึ้นไป</a></span></li>
				</ul>
			</li>
			<li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
			<li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
			<?php
			} 
			
			if($_SESSION["statusncr"]=='staff') {
			?>
			<li>
				<a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ</span></a>
				<ul>
					<li class="last"><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมใหม่ 2556)</span></a></li>
					<li class="last"><a href="ncf_list_old.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมเก่า < 2556)</a></span></li>
				</ul>
			</li>
			<li>
				<a href="#"><span>สถิติ</span></a>
				<ul>
					<li class="last"><a href="ncr_report_progarmdepart.php"><span>สถิติความเสี่ยงของแผนก</span></a></li> 
					<li class="last"><a href="ncr_report_all_depart.php"><span>สถิติอุบัติการณ์ </a></span></li>
				</ul>
			</li> 
			<li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
			<li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
			<?php 
			} 
			
			if($_SESSION["statusncr"]=='phar') { 
			?>
			<li>
				<a href="#"><span>รายงานความคลาดเคลื่อนทางยา</span></a>
				<ul>
					<li class="last"><a href="fha_data_old.php"><span>ข้อมูลเก่า หลังเดือน ม.ค.2555</span></a></li>
					<li class="last"><a href="report_fha.php"><span>ข้อมูลใหม่ ตั้งแต่ ม.ค.2555 ขึ้นไป</a></span></li>
				</ul>
			</li>
			<li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
			<?php 
			} 
			
			if($_SESSION["statusncr"]!='admin' && $_SESSION["statusncr"]!='staff' && $_SESSION["statusncr"]!='phar'  && $_SESSION["Userncr"]!=""){ 
			?>
			<li>
				<a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ</span></a>
				<ul>
					<li class="last"><a href="ncf_list_depart.php"><span>ใบรายงานเหตุการณ์ฯ  (โปรแกรมใหม่ 2556)</span></a></li>
					<li class="last"><a href="ncf_list_old.php"><span>ใบรายงานเหตุการณ์ฯ (โปรแกรมเก่า < 2556)</a></span></li>
				</ul>
			</li>
			<li>
				<a href="#"><span>รายงานสรุป</span></a>
				<ul>
					<li class="last"><a href="ncr_report_progarm.php"><span>รายงานสรุปอุบัติการณ์จำแนกตามโปรแกรม</span></a></li>
					<?php if($_SESSION["statusncr"]=='IC'){ ?>
					<li class="last"><a href="report_ic_accident.php"><span>รายงานอุบัติการณ์ IC</span></a></li>
					<li class="last"><a href="ic_report_depart.php"><span>สรุปอุบัติการณ์ IC  ประจำปี</span></a></li>
					<?php } ?>
				<!--	<li class="last"><a href="ncf_report_depart.php"><span>หน่วยงานที่รายงานอุบัติการณ์</a></span></li>-->
				</ul>
			</li>
			<!--<li><a href="ncf_member.php"><span>สถิติความเสี่ยง</span></a></li>--> 
			<li><a href="ncf_member.php"><span>รายชื่อผู้ใช้ในระบบ</span></a></li>
			<li><a href="logout.php"><span>ออกจากระบบ</span></a></li>
			<?php 
			}
			
			if(!$_SESSION["Userncr"]){ 
			?>
			<li class="last"><a href="login.php"><span>เข้าสู่ระบบ</span></a></li>
			<?php 
			}
			?>
		</ul>
	</div>
	<?php
	if(isset($_SESSION["Userncr"])){
		include("connect.inc");
		
		$strSQL = "SELECT * FROM member WHERE  username = '".$_SESSION["Userncr"]."'";
		$objQuery = mysql_query($strSQL);
		$objResult = mysql_fetch_array($objQuery);
		?>
		<span class="fontsara">ผู้ใช้งานขณะนี้ ::  <strong><?=$objResult['name']?></strong> &nbsp;&nbsp;<strong><?=$_SESSION["Untilncr"]?></strong></span> 
	<?php 
	} 
	?>
	<div style="visibility: hidden"><br /><a href="http://apycom.com/">aaa</a><br /></div>
</div>
<!-- END MENU -->