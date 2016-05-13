<?php


include 'bootstrap.php';

function calcage($birth){
	// dump($birth);
	$today = getdate();   
	$nY = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4) - 543;
	$bM = substr($birth,5,2);
	$ageY = $nY - $bY;
	$ageM = $nM - $bM;

	if ($ageM < 0) {
		$ageY = $ageY - 1;
		$ageM = 12 + $ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$action = input_post('action');

if( empty($action) ){
	
	$date = ( date('Y') + 543 ).date('-m-d');
	?>
	ค้นหาใบนัดฉีดยา(ทดลอง)
	<form action="testPharinjHistory.php" method="post">
		<div>
			<label for="hn">
				HN: <input type="text" id="hn" name="hn">
			</label>
		</div>
		<div>
			<label for="drugcode">
				โค้ดยา: <input type="text" id="drugcode" name="drugcode">
			</label>
		</div>
		<div>
			<label for="date">
				วันเริ่มต้นที่ฉีดยา: <input type="text" id="date" name="date" value="<?=$date;?>">
			</label>
		</div>
		<div>
			<button type="submit">ค้นหาใบนัดฉีดยา</button>
			<input type="hidden" name="action" value="show">
		</div>
	</form>
	<?php
} elseif ( $action === 'show' ) {
	
	$month = array(
		'01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', 
		'07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม'
	);

	$date = input_post('date');
	$hn = input_post('hn');
	$drugcode = strtoupper(input_post('drugcode'));
	
	
	$sql = "SELECT a.`hn`,a.`start_date`, b.`date`, b.`ptname`, b.`doctor`, c.`drugcode`, c.`tradname`
	FROM `pharinj_history` AS a
	LEFT JOIN `dphardep` AS b ON b.`row_id` = a.`dphardep_id` 
	LEFT JOIN `ddrugrx` AS c ON c.`idno` = a.`dphardep_id` 
	WHERE a.`start_date` LIKE '$date%' 
	AND a.`hn` = '$hn' 
	AND c.`drugcode` = '$drugcode'";
	$items = DB::select($sql);
	if( empty($items) ){
		echo "ไม่พบการเก็บข้อมูลฉีดยาย้อนหลัง";
		exit;
	}
	
	$itemEtc = $items['0'];
	
	
	$sql = "SELECT * FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
	$testUser = DB::select($sql, null, true);
	// dump($testUser);
	
	// $testUser = $items['0'];
	
	$dgcode = array(
		'0DT' => 'Tetanus Toxoid',
		'0VERO' => 'VERORAB',
		'0SPEE' => 'SPEEDA',
		'0EB1.0' => 'Engerix-B',
		'0HB1.0' => 'Hepavax',
	);
	
	
	
	$codeSelect = $dgcode[$drugcode];
	
	$sql = "SELECT `vn` FROM `opday` WHERE `thidate` LIKE '$date%' AND `hn` = '$hn' ORDER BY `row_id` DESC LIMIT 1";
	$itVn = DB::select($sql, null, true);
	?>
	<html>
		<head>
			<title> นัดฉีดยา </title>
			<style type="text/css">
			*{
				font-family: "Angsana New";
			}
			a:link {color:#FF0000; text-decoration:underline;}
			a:visited {color:#FF0000; text-decoration:underline;}
			a:active {color:#FF0000; text-decoration:underline;}
			a:hover {color:#FF0000; text-decoration:underline;}
			body,td,th {font-size: 16px;}
			.font_title{font-size: 16px;color:#FFFFFF;font-weight: bold;}
			</style>
			<script type="text/javascript">
				window.onload = function(){
					// print();
				}
			</script>
		</head>

		<BODY>
			<BR><BR>
			<TABLE border="1"  bordercolor="#000000" cellspacing="0" cellpadding="0">
				<TR>
					<TD>
						<TABLE border="0">
							<TR>
								<TD valign="top">

									<TABLE border="0" style="font-size: 18px;">
										<TR>
											<TD><B>ใบนัดฉีดยา<BR>รพ.ค่ายสุรศักดิ์มนตรี</B></TD>
											<TD align="center">
												<TABLE border="1" bordercolor="#000000" cellspacing="0" cellpadding="0">
													<TR>
														<TD style="font-size: 24px;" align="center">
															<B>&nbsp;&nbsp;<?=$codeSelect;?>&nbsp;&nbsp;</B>
														</TD>
													</TR>
												</TABLE>
											</TD>
										</TR>
										<TR>
											<TD colspan="2">
												<FONT style="font-size: 24px;">ชื่อ<U>&nbsp;<?=$testUser['yot'].' '.$testUser['name'].' '.$testUser['surname'];?>&nbsp;</U></FONT>
											</TD>
										</TR>
										<TR>
											<TD><FONT style="font-size: 24px;">HN<U>&nbsp;<?php echo $testUser["hn"];?></U></FONT></TD>
											<TD><FONT style="font-size: 24px;">ID<U>&nbsp;<?php echo $testUser["idcard"];?></U></FONT></TD>
										</TR>
										<TR>
											<TD>สิทธิ์&nbsp;:&nbsp;<B><?php echo substr($testUser["ptright"],4);?></TD>
											<TD>อายุ&nbsp;:&nbsp;<?php echo calcage($testUser["dbirth"]);?></TD>
										</TR>
										<TR>
											<TD colspan="2">แพทย์&nbsp;:&nbsp;<?php echo $itemEtc["doctor"];?></TD>
										</TR>
										<TR>
											<TD colspan="2">
												<TABLE border="1" align="center" width="300" bordercolor="#000000" cellspacing="0" cellpadding="0" style="font-size: 30px;">
													<TR align="center">
														<TD width="30">	<FONT style="font-size: 22px;">เข็ม</FONT></TD>
														<TD width="60">	<FONT style="font-size: 22px;">VN</FONT></TD>
														<TD width="90">	<FONT style="font-size: 22px;">ว/ด/ป</FONT></TD>
														<TD width="50">	<FONT style="font-size: 22px;">เวลา</FONT></TD>
														<TD width="50">	<FONT style="font-size: 22px;">ผู้ฉีด</FONT></TD>
													</TR>
													<?php 
													// for($i = 1; $i <= $count; $i++){
													$i = 1;
													foreach( $items as $key => $item ){
														list($date, $time) = explode(' ', $item['date']);
														list($y, $m, $d) = explode('-', $date);
														?>
														<tr>
															<td align="center">
																<font size="4"><?=$i;?></font>
															</td>
															<td>
																<?php
																if( $i === 1 ){
																	echo $itVn['vn'];
																}else{
																	echo '&nbsp;';
																}
																?>
															</td>
															<td align="center">
																<font><?=$d;?> <?=$month[$m];?> <?=$y;?></font>
															</td>
															<td>&nbsp;</td>
															<td>&nbsp;</td>
														</tr>
														<?php
														$i++;
													}
													?>
												</TABLE>
											</TD>
										</TR>
										<tr>
											<td colspan="2">
												รายละเอียด: <?php echo str_replace(array("\n","\n\r"), '<br>', $_POST['detail_etc']); ?>
											</td>
										</tr>
									</TABLE>
								</TD>
								<TD>&nbsp;&nbsp;</TD>
								<TD valign="top">
									<CENTER>
										<B>
										<FONT style="font-size: 22px;">
										ข้อควรปฏิบัติสำหรับผู้ป่วย
										</FONT></B><BR>
									</CENTER>

									<FONT style="font-size: 20px;">
										1. กรุณามาตรงตามวันนัด<BR>
										2. <U><B>มาตรงนัด</B></U><BR>
										&nbsp;&nbsp;&nbsp;&nbsp;ให้ยื่นใบนัดที่แผนกทะเบียนเพื่อออก VN<BR>
										&nbsp;&nbsp;&nbsp;&nbsp;แล้วนำใบนัดไปรับยาที่ห้องจ่ายยา<BR>
										&nbsp;&nbsp;&nbsp;&nbsp;เมื่อได้รับยาให้นำมาฉีดยาที่ห้องฉุกเฉิน<BR>
										3. <B><U>มาไม่ตรงนัด</U></B>
										&nbsp;&nbsp;&nbsp;&nbsp;ให้เข้าพบแพทย์ทุกครั้ง<BR>
										4.  เมื่อต้องการฉีดยาที่โรงพยาบาลอื่น ให้นำใบนัดนี้ไปด้วย<BR>
										5.  มีปัญหาหรือข้อสงสัยในการฉีดยา ติดต่อกองเภสัชกรรม <BR>
										&nbsp;&nbsp;&nbsp;&nbsp;โทร 054-839305  ต่อ 1160
										<CENTER>***************************</CENTER>
										<CENTER><B>เวลาฉีดยา</B></CENTER>
									</FONT>
									<FONT style="font-size: 20px;">
										&nbsp;&nbsp;&nbsp;&nbsp;<B>เช้า</B>&nbsp;&nbsp;08.30  - 12.00 
										&nbsp;&nbsp;<B>บ่าย</B>&nbsp;&nbsp;13.00  - 16.00 
										&nbsp;&nbsp;<B>เย็น</B>&nbsp;&nbsp;16.30  - 20.00
									</FONT>
								</TD>
							</TR>

						</TABLE>
					</TD>
				</TR>
			</TABLE>
		</body>
	</html>
	<?php
}

?>

