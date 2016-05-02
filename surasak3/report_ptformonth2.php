<?php
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 22px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}
#printable { display: block; }
@media print { 
	#non-printable { display: none; } 
	/*#printable { page-break-after:always; } */
	thead{
		display: table-header-group;
	}
} 
-->
</style>
<div id="non-printable">
	<form id="form1" name="form1" method="post" action="<?=$PHP_SELF;?>">
		<h1 style="text-align: center;">รายงานนวดแผนไทย<u>ประจำเดือน</u>(นอกเวลาราชการ)</h1>
		<input name="act" type="hidden" value="show" />
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td align="center">เลือกเดือน       
					<?php
					$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
					'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
					'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
					
					$selmon = isset($_POST['selmon']) ? $_POST['selmon'] : date('m');
					
					?>
					<select name="selmon" size="1" class="txt">
					<?php
						foreach( $thaimonthFull as $key => $val ){
							$selected = ( $selmon === $key ) ? 'selected="selected"' : '' ;
							?><option value="<?=$key;?>" <?=$selected;?>><?=$val;?></option><?php
						}
					?>
					</select>
					
					ปี 
					<?php
					$y=date("Y")+543;
					$date=date("Y")+543+5;
					$dates=range(2547,$date);
					echo "<select name='selyear' size='1' class='txt'>";
					foreach($dates as $i){
						?>
						<option value="<?=$i;?>" <? if($y==$i){ echo "selected"; }?>><?=$i;?></option>
						<?php
					}
					echo "</select>";
					?>        <span style="margin-left: 65px;">
					<input type="submit" value="ค้นหาข้อมูล" name="B1"  class="txt" />
					</span>
				</td>
			</tr>
			<tr>
				<td align="center"><a href="../nindex.htm">กลับเมนูหลัก</a>  || <a href="report_ptmonth2.php">รายงานนวดแผนไทยตามห้วงเวลา (นอกเวลาราชการ)</a></td>
			</tr>
		</table>
	</form>
</div> 
<?php
if($_POST["act"]=="show"){

	$selmon = trim($_POST["selmon"]);
	$showmon = $thaimonthFull[$selmon];
	
	$thyear = $_POST["selyear"];
	$ksyear = $_POST["selyear"]-543;
	
	
	$sql = "SELECT `date_holiday` 
	FROM `holiday` 
	WHERE `date_holiday` LIKE '$thyear-$selmon%'";
	$q = mysql_query($sql);
	$holidayLists = array();
	while( $item = mysql_fetch_assoc($q) ){
		$holidayLists[] = $item['date_holiday'];
	}
	
	// Statement นี้จะได้ codeของนวด และตัวที่คิดค่า 50บาท
	$sql = "SELECT a.`row_id`,a.`date`,a.`hn`,a.`ptname`,a.`detail`,a.`staf_massage`,a.`time`,a.`date2`,a.`day_name`,
	SUBSTRING(a.`date`, 1, 10) AS `date3`, 
	b.`row_id`,b.`date`,b.`code`,b.`idno` 
	FROM (
		SELECT *, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, 
		CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) AS `date2`, 
		DATE_FORMAT( CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name` 
		FROM `depart` 
		WHERE `staf_massage` != '' 
		AND `staf_massage` IS NOT NULL 
		AND `date` LIKE '$thyear-$selmon%' 
	) AS a 
	RIGHT JOIN `patdata` AS b ON a.`row_id` = b.`idno` 
	WHERE a.`status` = 'Y' 
	AND b.`code` in (
		'58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','clinic50'
	) 
	ORDER BY a.`staf_massage` ASC, a.`date` ASC";

$q = mysql_query($sql);

$data = array();
while( $item = mysql_fetch_assoc($q) ){
	
	$dayNum = (int) $item['day_name'];
	
	$testHoliday = in_array($item['date3'], $holidayLists);
	
	// ถ้าไม่ได้อยู่ในช่วง Holiday และ เวลาอยู่ในช่วงวันธรรมดาตั้งแต่ 8.00 - 16.00 ให้ข้ามไปเลย
	if( $testHoliday === false 
	&& ( $dayNum > 0 && $dayNum < 6 ) && ( $item['time'] >= "08:00:00" && $item['time'] <= "16:00:00" ) ){
		continue;
	}
	
	// filter โค้ดหลักออกไปให้เหลือแต่ 50บาท
	if( $item['code'] !== 'clinic50' ){
		continue;
	}
	
	
	
	$user = array(
		'date' => $item['date'],
		'hn' => $item['hn'],
		'ptname' => $item['ptname']
	);
	
	$key = md5($item['staf_massage']);
	// เฉพาะคนแรกของคนนวดคนนั้น
	if( empty($data[$key]) ){ 
		$data[$key] = array(
			'staff' => $item['staf_massage'],
			'patient' => array(
				$user
			)
		);
	}else{
		$data[$key]['patient'][] = $user;
	}

}

// echo "<pre>";
// var_dump($data);

// exit;
	
	// ห้วงเวลา
	// รายชื่อผู้นวด
	// $date_between = " AND `date` >= '$thyear-$selmon-01' AND `date` <= '$thyear-$selmon-31'";
	
	// $sql = "SELECT `staf_massage` 
	// FROM `depart` 
	// WHERE `staf_massage` !='' 
	// $date_between 
	// GROUP BY `staf_massage` ";
	// $query = mysql_query($sql);
	// $num = mysql_num_rows($query);
	// while( $row = mysql_fetch_array($query) ){
		
	foreach( $data as $key => $val ){
		// $staf_massage = $row["staf_massage"];
		?>
		<div id="printable"> 
			<p align="center"><strong>รายชื่อผู้มารับบริการนวดแผนไทย</strong></p>
			<div style="margin-left: 5%;"><strong>ชื่อพนักงานนวด : </strong><?=$val['staff'];?></div>
			<div style="margin-left: 5%;"><strong>ประจำเดือน <?=$showmon;?> พ.ศ. <?=$thyear;?></div>
			<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
				<thead>
					<tr bgcolor="#FFCCCC">
						<th width="8%" align="center"><strong>ลำดับ</strong></th>
						<th width="12%" align="center" bgcolor="#FFCCCC"><strong>วัน/เดือน/ปี</strong></th>
						<th width="20%" align="center"><strong>HN</strong></th>
						<th width="30%" align="center"><strong>ชื่อ - นามสกุล</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>การจ่ายยา</strong></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					/* Condition เกี่ยวกับเวลา ควรเปลี่ยนเป็น ค.ศ. เพื่อให้ mysql คำนวณวันที่ได้ถูกต้อง */
// 					$sql1 = "SELECT b.*, a.`code`
// FROM `patdata` AS a, (

// 	SELECT *, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, 
// 	CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) AS `date2`, 
// 	DATE_FORMAT( CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name` 
// 	FROM `depart` 
// 	WHERE `staf_massage` !='' 
// 	$date_between

// ) AS b 
// WHERE b.`row_id` = a.`idno` 
// AND a.`code` in (
// 	'58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a'
// ) 
// AND a.`code` LIKE 'clinic50' 
// AND b.`staf_massage` = '$staf_massage'
// AND a.`status` = 'Y'
// ORDER BY b.`date` ASC";
				// echo "<pre>";
				//var_dump($sql1);
				// echo "<pre>";
				
				// $result = mysql_query($sql1) or die( mysql_error() ); 
				$i = 0;
				// while($rows = mysql_fetch_array($result)){
					foreach( $val['patient'] as $k => $pt ){
					// 0 is Sunday
					// 6 is Saturday
					// ถ้าเข้าเคส จันทร์ ถึง ศุกร์ และอยู่ในช่วงเวลาราชการให้ผ่านไปเลย ไม่นับ
					// @todo เซิฟเวอร์มีปัญหาเรื่องเวลาเร็วไป 20 นาที ถ้าเซิฟปรับแล้วโค้ดนี้ก็ต้องปรับเวลาตามด้วย
					// $dayNum = (int) $rows['day_name'];
					// if( ( $dayNum > 0 AND $dayNum < 6 ) AND ( $rows['time'] >= "08:20:00" AND $rows['time'] <= "16:20:00" ) ){
					// 	continue;
					// }
					
					$qdate = substr($pt["date"],0,10);
					list($yy,$mm,$dd) = explode("-",$qdate);
					$dateshow = "$dd/$mm/$yy";
					// $showtime = substr($rows["date"],11,8);
					
					$i++;
					
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td align="center"><?=$dateshow;?></td>
						<td><?=$pt["hn"];?></td>
						<td align="left"><?=$pt["ptname"];?></td>
						<?php
						$sql3 = "select * from drugrx where date like '$qdate%' and hn='".$pt["hn"]."'";
						$query3 = mysql_query($sql3);
						$num3 = mysql_num_rows($query3);
						if( empty($num3) ){
							$showdrug = "";
						}else{
							$item = mysql_fetch_assoc($query3);
							$showdrug = $item['tradname'];
						}
						?>
						<td align="center"><?=$showdrug;?></td>
					</tr>
					<?php
				}
				?>
				</tbody>
			</table>
			<br />
			<table width="100%" border="0" cellspacing="0" cellpadding="2">
				<tr>
					<td width="15%" align="right"><strong>ผู้บันทึก</strong></td>
					<td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td width="18%" align="right"><strong>ตรวจถูกต้อง</strong></td>
					<td width="35%" align="right">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td align="right">น.ส.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:10px;">(ศิริพร&nbsp;&nbsp;&nbsp;&nbsp; อินปัน)</div></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:25px;">แพทย์แผนไทย</div></td>
				</tr>
			</table>
		</div>
		<div style="page-break-after:always;"></div>
	<?php
	} // while
} // end if act show
?>

