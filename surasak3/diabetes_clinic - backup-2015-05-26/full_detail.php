<?php
require "../connect.inc";
?>
<html>
	<body>
<style>
body{
	margin: 0;
	padding: 0;
}
.font_title{
	font-family:"TH SarabunPSK"; 
	font-size:25px;
}
.tb_font{
	font-family:"TH SarabunPSK";
	font-size:24px;
	color: #09F;
}
.tb_font_1{
	font-family:"TH SarabunPSK"; 
	font-size:24px; 
	color:#FFFFFF;
	font-weight:bold;
}
.tb_col{
	font-family:"TH SarabunPSK"; 
	font-size:24px;
	background-color:#9FFF9F;
}
.tb_font_2 {
	font-family: "TH SarabunPSK";
	color: #09F;
	font-size: 24px;
	font-weight: bold;
}

.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
	color: #FFF;
}
.forntsarabun1 {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
td{
	font-family:"TH SarabunPSK";
	font-size: 24px;
}
</style>
<?php

// $id = filter_input(INPUT_GET, 'id');
$id = intval($_GET['id']);

$sql = sprintf("SELECT * FROM `diabetes_clinic_history` WHERE `row_id` = '%s'", $id);
	$query = mysql_query($sql);
	$row = mysql_num_rows($query);
	
	if($row === false){
		echo "ไม่เจอข้อมูลผู้ป่วย";
		exit;
	}
	
	$item = mysql_fetch_assoc($query);
	// echo "<pre>";
	// var_dump($item);
	// echo "</pre>";
?>
<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD="post" ACTION="diabetes.php?do=save" name="F1">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff" width="100%">
	<TR>
		<TD>
			<TABLE border="0" cellpadding="0" cellspacing="0" width="100%">
				<TR>
					<TD align="left" bgcolor="#666666" class="forntsarabun">&nbsp;ข้อมูลผู้ป่วย</TD>
				</TR>
				<TR>
					<TD>
						<table border="0">
							<tr>
								<td align="right" class="tb_font_2">วันที่ลงทะเบียน: </td>
								<td>
									<span class="data_show">
										<?php echo $item['thidate']?>
									</span>
								</td>
								<td colspan="2" class="tb_font_2"></td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">DM number :</td>
								<td>
									<span class="data_show"><?php echo $item['dm_no'];?></span>
								</td>
								<td align="right"><span class="tb_font_2">HN :</span></td>
								<td align="left">
									<?php echo $item["hn"];?>
								</td>
							</tr>
							<tr>
								<td  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
								<td class="">
									<?php echo $item["ptname"];?>
								</td>
								<td  align="right" class="tb_font_2">อายุ :</td>
								<td align="left" class="">
									<?php 
									$current_th_year = date('Y')+543;
									list($user_year, $etc) = explode('-', $item['dbbirt'], 2);
									$final_year = $current_th_year - $user_year;
									echo $final_year;
									?>
								</td>
							</tr>
							<tr class="">
								<td  align="right" class="tb_font_2">เพศ :</td>
								<td >
									<?php echo ( $item['sex'] == 0 ) ? 'ชาย' : 'หญิง' ; ?>
								</td>
								<td  align="right" class="tb_font_2">&nbsp;</td>
								<td align="left">&nbsp;</td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">แพทย์ :</td>
								<td>
									<?php echo $item['doctor']; ?>
								</td>
								<td align="right" class="tb_font_2">สิทธิ :</td>
								<td align="left" class="">
									<?php echo $item["ptright"];?>
								</td>
							</tr>
						</table>
						<hr />
						<TABLE class="">
							<tr>
								<td align="right" class="tb_font_2">การวินิจฉัย : </td>
								<td colspan="5" align="left" class="">
									<?php
									if($item['diagnosis'] == '0'){
										echo 'DM type1';
									}else if($item['diagnosis'] == '1'){
										echo 'DM type2';
									}else if($item['diagnosis'] == '2'){
										echo 'Uncertain type';
									}else{
										echo '-';
									}
									?>
								</td>
							</tr>
							<?php
							if($item['diagdetail'] != ''){
							?>
							<tr>
								<td align="right" class="">&nbsp;</td>
								<td colspan="5" align="left" class="">การวินิจฉัยครั้งแรก ประมาณ พ.ศ. <?php echo $item['diagdetail'];?></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td align="right" class="tb_font_2">โรคร่วม HT:</td>
								<td colspan="5" align="left" class="">
									<?php
									if( $item['ht'] == '0' ){
										echo 'No';
									}else if( $item['ht'] == '1' ){
										echo 'Essential HT';
									}else if( $item['ht'] == '2' ){
										echo 'Uncertain type';
									}else if( $item['ht'] == '3' ){
										echo 'Secondary HT';
									}else{
										echo '-';
									}
									?>
								</td>
							</tr>
							<tr>
								<td align="right" valign="top" class="tb_font_2">โรคร่วม อื่นๆ:</td>
								<td colspan="8" align="left" class="">
									<?php
									if( $item['ht_etc'] == 'Neuropathy' ){
										echo 'Neuropathy';
									}else if( $item['ht_etc'] == 'Heart Failure' ){
										echo 'Heart Failure';
									}else if( $item['ht_etc'] == 'Nephropathy' ){
										echo 'Nephropathy';
									}else if( $item['ht_etc'] == 'CVD' ){
										echo 'CVD';
									}else if( $item['ht_etc'] == 'IHD' ){
										echo 'IHD';
									}else if( $item['ht_etc'] == 'Foot ulcer' ){
										echo 'Foot ulcer';
									}else if( $item['ht_etc'] == 'Retinopathy' ){
										echo 'Retinopathy';
									}else if( $item['ht_etc'] == 'Dyslipidemia' ){
										echo 'Dyslipidemia';
									}else{
										echo '-';
									}
									?>
								</td>
							</tr>
							<?php
							if($item['htdetail'] != ''){
							?>
							<tr>
								<td align="right" class="forntsarabun1">&nbsp;</td>
								<td colspan="5" align="left" class="forntsarabun1">การวินิจฉัยครั้งแรก ประมาณ พ.ศ. <?php echo $item['htdetail']; ?></td>
							</tr>
							<?php
							}
							?>
							<tr>
								<td align="right"  class="tb_font_2">ประวัติบุหรี่ : </td>
								<td colspan="5">
									<?php
									if($item['smork'] == '0'){
										echo 'ไม่สูบบุหรี่';
									} else if($item['smork'] == '1'){
										echo 'สูบบุหรี่';
									}else{
										echo 'NA';
									}
									?>
								</td>
							</tr>
						</TABLE>
						<hr />
						<table border="0" class="forntsarabun1" width="100%">
							<TR>
								<TD align="left" bgcolor="#666666" class="forntsarabun" colspan="10">&nbsp;การตรวจร่างกาย</TD>
							</TR>
							<tr>
								<td width="70" align="right" class="tb_font_2">ส่วนสูง : </td>
								<td>
									<?php echo $item['height']; ?> ซม.
								</td>
								<td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
								<td >
									<?php echo $item['weight']; ?> กก. 
								</td>
								<td width="70" align="right" class="tb_font_2">รอบเอว : </td>
								<td>
									<?php echo empty($item['round']) ? '-' : $item['round'] ; ?> ซม.</td>
								<td>&nbsp;</td>
								<td colspan="3">&nbsp;</td>
							</tr>
							<tr>
								<td align="right" class="tb_font_2">T : </td>
								<td>
									<?php echo $item["temperature"]; ?> C&deg;
								</td>
								<td align="right" class="tb_font_2">P : </td>
								<td >
									<?php echo $item["pause"]; ?> ครั้ง/นาที
								</td>
								<td align="right" class="tb_font_2">R :</td>
								<td>
									<?php echo $item["rate"]; ?> ครั้ง/นาที
								</td>
								
							</tr>
							<tr>
								<td align="right" class="tb_font_2">BMI : </td>
								<td><?php echo $item['bmi']; ?></td>
								<td align="right" class="tb_font_2">BP : </td>
								<td>
									<?php echo $item["bp1"]; ?> / <?php echo $item["bp2"]; ?> mmHg
								</td>
							</tr>
							<tr>
								<td colspan="2" align="right" class="tb_font_2">Retinal Exam:</td>
								<td colspan="7" class="">
									<?php
									if($item['retinal_date']){
										list($retinal_date, $etc) = explode(' ', $item['retinal_date']);
										if($retinal_date == '0000-00-00'){
											$retinal_date = '-';
										}
										echo $retinal_date.'&nbsp;';
									}
									
									if($item['retinal'] == 'No DR'){
										echo 'No DR';
									} else if($item['retinal'] == 'Mind DR'){
										echo 'Mind DR';
									} else if($item['retinal'] == 'Moderate DR'){
										echo 'Moderate DR';
									} else if($item['retinal'] == 'Severe DR') {
										echo 'Severe DR';
									} else {
										echo '';
									}
									?>
								</td>
								<td></td>
							</tr>
							<tr>
								<td colspan="2" align="right" class="tb_font_2">Foot Exam:</td>
								<td align="left" class="" colspan="8">
									<?php
									if($item['foot_date']){
										list($foot_date, $etc) = explode(' ', $item['foot_date']);
										if($foot_date == '0000-00-00'){
											$foot_date = '-';
										}
										echo $foot_date.'&nbsp;';
									}
									
									if($item['foot'] == 'Hight Risk'){
										echo 'Hight Risk';
									} else if($item['foot'] == 'Moderate Risk'){
										echo 'Moderate Risk';
									} else if($item['foot'] == 'Low Risk') {
										echo 'Low Risk';
									} else{
										echo '';
									}
									?>
								</td>
							</tr>
						</table>
						<hr />
						<table  width="100%"border="0" cellpadding="2" cellspacing="0" bordercolor="#393939" >
							<tr>
								<td align="left" bgcolor="#666666" class="forntsarabun">&nbsp;ผลการตรวจทางพยาธิ</td>
							</tr>
							<tr>
								<td class="">
									<table border="0">
										<tr>
											<td colspan="3" ><div class="tb_font_2"><span class="tb_font">BS</span></div></td>
										</tr>
										<tr>
											<td>
												<?php
												$sql = sprintf("SELECT result_lab, dateY 
												FROM diabetes_lab 
												WHERE dummy_no = '%s' 
												AND labname = 'BS'", $item['dummy_no']);
												$query = mysql_query($sql);
												$bs_item = mysql_fetch_assoc($query);
							
												if($bs_item === false){
													echo 'ยังไม่เคยตรวจ';
												}else{
													echo $bs_item['result_lab'].' mg/dl วันที่  '.$bs_item['dateY'];
												}
												?>
											</td>
										</tr>
									</table>
									<hr />
								</td>
							</tr>
							<tr>
								<td class="">
									<table border="0">
										<tr>
											<td colspan="3" >
												<div class="tb_font_2">
													<span class="font_title"><span class="tb_font">HbA1c</span></span>
												</div>
											</td>
										</tr>
										<tr>
											<td>
												<?php
												$sql = sprintf("SELECT result_lab, dateY 
												FROM diabetes_lab 
												WHERE dummy_no = '%s' 
												AND labname = 'HbA1c'", $item['dummy_no']);
												$query = mysql_query($sql);
												$HbA1c_item = mysql_fetch_assoc($query);
							
												if($HbA1c_item === false){
													echo 'ยังไม่เคยตรวจ';
												}else{
													echo $HbA1c_item['result_lab'].' % วันที่  '.$HbA1c_item['dateY'];
												}
												?>
											</td>
										</tr>
									</table>
									<hr />
								</td>
							</tr>
							<tr>
								<td class="">
									<table border="0">
										<tr>
											<td colspan="3" ><div class="tb_font_2"><span class="tb_font">LDL</span></div></td>
										</tr>
										<tr>
											<td>
												<?php
												$sql = sprintf("SELECT result_lab, dateY 
												FROM diabetes_lab 
												WHERE dummy_no = '%s' 
												AND labname = 'LDL'", $item['dummy_no']);
												$query = mysql_query($sql);
												$ldl_item = mysql_fetch_assoc($query);
							
												if($ldl_item === false){
													echo 'ยังไม่เคยตรวจ';
												}else{
													echo $ldl_item['result_lab'].' mg% วันที่  '.$ldl_item['dateY'];
												}
												?>
											</td>
										</tr>
									</table>
									<hr />
								</td>
							</tr>
							<tr>
								<td class="">
									<table border="0">
										<tr>
											<td colspan="3" ><div class="tb_font_2"><span class="tb_font">Creatinine</span></div></td>
										</tr>
										<tr>
											<td>
												<?php
												$sql = sprintf("SELECT result_lab, dateY 
												FROM diabetes_lab 
												WHERE dummy_no = '%s' 
												AND labname = 'Creatinine'", $item['dummy_no']);
												$query = mysql_query($sql);
												$creatinine_item = mysql_fetch_assoc($query);
							
												if($creatinine_item === false){
													echo 'ยังไม่เคยตรวจ';
												}else{
													echo $creatinine_item['result_lab'].' mg% วันที่  '.$creatinine_item['dateY'];
												}
												?>
											</td>
										</tr>
									</table>
									<hr />
								</td>
							</tr>
							<tr>
								<td class="">
									<table border="0">
										<tr>
											<td colspan="3" ><div class="tb_font_2"><span class="tb_font">Urine protein</span></div></td>
										</tr>
										<tr>
											<td>
												<?php
												$sql = sprintf("SELECT result_lab, dateY 
												FROM diabetes_lab 
												WHERE dummy_no = '%s' 
												AND labname = 'Urine protein'", $item['dummy_no']);
												$query = mysql_query($sql);
												$urine_item = mysql_fetch_assoc($query);
							
												if($urine_item === false){
													echo 'ยังไม่เคยตรวจ';
												}else{
													echo $urine_item['result_lab'].' วันที่  '.$urine_item['dateY'];
												}
												?>
											</td>
										</tr>
									</table>
									<hr />
								</td>
							</tr>
							<tr>
								<td class="">
									<table border="0">
										<tr>
											<td colspan="3" ><div class="tb_font_2"><span class="tb_font">Microalbuminuria</span></div></td>
										</tr>
										<tr>
											<td>
												<?php
												$sql = sprintf("SELECT result_lab, dateY 
												FROM diabetes_lab 
												WHERE dummy_no = '%s' 
												AND labname = 'Urine Microalbumin'", $item['dummy_no']);
												$query = mysql_query($sql);
												$um_item = mysql_fetch_assoc($query);
							
												if($um_item === false){
													echo 'ยังไม่เคยตรวจ';
												}else{
													echo $um_item['result_lab'].' วันที่  '.$um_item['dateY'];
												}
												?>
											</td>
										</tr>
									</table>
									<hr />
								</td>
							</tr>
						</table>
						<table width="100%" border="0">
							<tr>
								<td bgcolor="#666666" class="forntsarabun">&nbsp;การให้ความรู้ / คำแนะนำ</td>
							</tr>
							<tr>
								<td>
									<table border="0" class="forntsarabun1">
										<tr>
											<td class="tb_font_2">Foot care: </td>
											<td>
												<?php
												if($item['foot_care'] == '1'){
													echo 'ให้ความรู้';
												}else{
													echo 'ไม่ได้ให้ความรู้';
												}
												?>
											</td>
										</tr>
										<tr>
											<td class="tb_font_2">Nutrition: </td>
											<td>
												<?php
												if($item['nutrition'] == '1'){
													echo 'ให้ความรู้';
												}else{
													echo 'ไม่ได้ให้ความรู้';
												}
												?>
											</td>
										</tr>
										<tr>
											<td class="tb_font_2">Exercise: </td>
											<td>
												<?php
												if($item['exercise'] == '1'){
													echo 'ให้ความรู้';
												}else{
													echo 'ไม่ได้ให้ความรู้';
												}
												?>
											</td>
										</tr>
										<tr>
											<td class="tb_font_2">Smoking: </td>
											<td>
												<?php
												if($item['smoking'] == '1'){
													echo 'ให้ความรู้';
												}else{
													echo 'ไม่ได้ให้ความรู้';
												}
												?>
											</td>
										</tr>
									</table>
								</td>
							</tr>
						</table>
						<hr />
						<table class="forntsarabun1">
							<tr>
								<td class="tb_font_2">Admit ด้วยปัญหาเบาหวาน: </td>
								<td>
									<?php
									if($item['admit_dia'] == '1'){
										echo 'มี';
									}else{
										echo 'ไม่มี';
									}
									?>
								</td>
							</tr>
							<tr>
								<td class="tb_font_2">โรคแทรกซ้อนด้านหัวใจ: </td>
								<td>
									<?php
									if($item['dt_heart'] == '1'){
										echo 'มี';
									}else{
										echo 'ไม่มี';
									}
									?>
								</td>
							</tr>
							<tr>
								<td class="tb_font_2">โรคแทรกซ้อนด้านสมอง: </td>
								<td>
									<?php
									if($item['dt_brain'] == '1'){
										echo 'มี';
									}else{
										echo 'ไม่มี';
									}
									?>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</FORM>
</body>
</html>