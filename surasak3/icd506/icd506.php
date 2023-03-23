<?php
include '../connect.php';
$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$dbi = new mysqli($ServerName,$User,$Password,$DatabaseName);
$dbi->query("SET NAMES UTF8");

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

?>
<style type="text/css">
	*, .forntsarabun {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}

	@media print {
		#no_print {
			display: none;
		}
	}

	.theBlocktoPrint {
		background-color: #000;
		color: #FFF;
	}
	.chk_table{
    border-collapse: collapse;
	}
	.chk_table th,
	.chk_table td{
		padding: 3px;
		border: 1px solid black;
	}
</style>
<div id="no_print">
	<form name="f1" action="" method="post" onsubmit="JavaScript:return fncSubmit();">
		<table width="971" border="0" cellpadding="3" cellspacing="3">
			<tr class="forntsarabun">
				<td width="111" align="right">เลือก วัน /เดือน /ปี</td>
				<td width="270">
					<select name="d_start" class="forntsarabun">
						<option value="">ไม่เลือกวัน</option>
						<?php 
						$d = (!empty($_POST['d_start'])) ? $_POST['d_start'] : date('d') ;
						$days = range(1,date('t'));
						foreach ($days as $dKey => $vD) {
							$day = sprintf("%02d", $vD);
							$selected = ($d==$day) ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$day;?>" <?=$selected;?>><?=$day;?></option>
							<?php
						}
						?>
						
					</select>
					<?php 
					$m = (!empty($_POST['m_start'])) ? $_POST['m_start'] : date('m') ;
					?>
					<select name="m_start" class="forntsarabun">
						<?php 
						foreach ($def_fullm_th as $mKey => $mV) { 
							$selected = ($m==$mKey) ? 'selected="selected"' : '' ;
							?>
							<option value="<?=$mKey;?>" <?=$selected;?> ><?=$mV;?></option>
							<?php
						}
						?>
						
					</select>
					<?
					$Y = date("Y") + 543;
					$date = date("Y") + 543 + 5;

					$dates = range(2547, $date);
					echo "<select name='y_start' class='forntsarabun'>";
					foreach ($dates as $i) {

						?>

						<option value='<?= $i ?>' <? if ($Y == $i) {
							  echo "selected";
						  } ?>><?= $i; ?></option>
					<?
					}
					echo "<select>";
					?>
				</td>
				<td width="560" rowspan="2" valign="top">* หากต้องการข้อมูล เป็นเดือน -ปี ในช่องวันที่ให้เลือกเป็น
					ไม่เลือกวัน
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center"><input name="submit" type="submit" class="forntsarabun"
						value="ค้นหา" />&nbsp;&nbsp;
					<input type="button" name="button" value="พิมพ์รายงาน" onClick="JavaScript:window.print();"
						class="forntsarabun">
					<a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
				</td>
			</tr>
		</table>
	</form>

	<hr />
</div>
<?php
if ($_POST['submit'] == "ค้นหา") {

	$date1 = $_POST['y_start'] . '-' . $_POST['m_start'] . '-' . $_POST['d_start'];

	$m_start = $_POST['m_start'];
	$printmonth = $def_fullm_th[$m_start];
	
	if ($_POST['d_start'] == "") {
		$dateshow = $printmonth . " " . $_POST['y_start'];
		$day = "เดือน";
		$where = "AND `thidate` LIKE '".$_POST['y_start']."-".$_POST['m_start']."%'";
	} else {
		$dateshow = $_POST['d_start'] . ' ' . $printmonth . " " . $_POST['y_start'];
		$day = "วันที่";
		$where = "AND `thidate` LIKE '".$_POST['y_start']."-".$_POST['m_start']."-".$_POST['d_start']."%'";
	}

	print "<font class='forntsarabun' >แบบรายงาน 506 ประจำ$day  $dateshow </font><br />
<br />";

	// $temp = "CREATE TEMPORARY TABLE  opday1  Select  *  from  opday  WHERE  (icd10 is not null and icd10!='')and thidate  LIKE  '$date1%'";
	// $qtemp = mysql_query($temp);

	// $strsql = "select row_id,icd10 from opday1  order by icd10";
	// $objq = mysql_query($strsql);

	$sql = "SELECT a.`row_id` AS `opday_id`,SUBSTRING(a.`thidate`,1,10) AS `thidate`,a.`thdatehn`,a.`hn`,a.`vn`,a.`ptname`,a.`ptright`,a.`goup`,a.`camp`,a.`typeservice`,a.`doctor`,a.`diag`,a.`icd10`,a.`ref_icd10`,
	b.`row_id` AS `id506`,b.`icd10` AS `icd10_506`,b.`depart_thai`,b.`depart_eng`,b.`code`,
	(CASE WHEN b.`icd10` IN('A01','A03','A04','A05','A08','A09') THEN '1' 
	WHEN b.`icd10` IN('A15','A16') THEN '2' 
	WHEN b.`icd10` IN('A90','A91') THEN '3' 
	WHEN b.`icd10` LIKE 'A92%' THEN '4' 
	WHEN b.`icd10` = 'A925' THEN '5' 
	WHEN b.`icd10` IN('B01','B02') THEN '6' 
	WHEN b.`icd10` LIKE 'B05%' THEN '7' 
	WHEN b.`icd10` = 'B06' THEN '8' 
	WHEN b.`icd10` IN('B084','B085') THEN '9' 
	WHEN b.`icd10` = 'B26' THEN '10' 
	WHEN b.`icd10` LIKE 'B30%' THEN '11' 
	WHEN b.`icd10` IN('J10','J11') THEN '12' 
	WHEN b.`icd10` IN('J12','J13','J14','J15','J16','J18') THEN '13' 
	END) AS `icd10_GROUP` 
	FROM (
		SELECT * FROM  `opday` WHERE (`icd10` IS NOT NULL AND `icd10`!='') $where 
	) AS a 
	LEFT JOIN `icd506` AS b ON a.`icd10` LIKE CONCAT(b.`icd10`,'%') 
	WHERE b.`row_id` IS NOT NULL
	ORDER BY a.`thidate`,a.`icd10` ASC";
	
	$q_506 = $dbi->query($sql);
	if($q_506->num_rows==0){
		echo "<p><b>ไม่พบข้อมูล กรุณาตรวจสอบวันที่อีกครั้ง</b></p>";
		exit;
	}
	$count_dt = array();
	$out_list = array();
	$in_list = array();
	while ($a = $q_506->fetch_assoc()) {
		$icd10_GROUP = $a['icd10_GROUP'];
		if(empty($icd10_GROUP)){ // ตัดคนที่ไม่เข้าเงื่อนไข case when ออกไป
			$out_list[] = $a;
			continue;
		}

		$in_list[] = $a;

		list($yot,$n,$s) = explode(' ', $a['ptname']);

		$test_a = false;

		if( $yot=='พลฯ' ){ 
			$count_dt[$icd10_GROUP]['pvt'] += 1;
			$test_a = true;
		}

		$goup_code = trim(substr($a['goup'],0,3));
		if($goup_code=='G31'){ 
			$count_dt[$icd10_GROUP]['family'] += 1;
			$test_a = true;
		}

		$camp_code = trim(substr($a['camp'],0,3));
		if($camp_code=='M01'){ 
			$count_dt[$icd10_GROUP]['other'] += 1;
			$test_a = true;
		}

		// คนที่ไม่เข้าเงื่อนไขอะไรเลยให้ตีเป็น ทหาร/นายสิบ/ลูกจ้าง/กำลังพล
		if($test_a===false){
			$count_dt[$icd10_GROUP]['G1'] += 1;
		}

	}


	$sql = "SELECT * FROM  `opday` WHERE 1 $where AND `opdtype` IN ('HI','SI','FI')";
	$q = $dbi->query($sql);
	if($q->num_rows > 0){
		while ($a = $q->fetch_assoc()) {
			$in_list[] = $a;

			list($yot,$n,$s) = explode(' ', $a['ptname']);

			$test_a = false;

			if( $yot=='พลฯ' ){ 
				$count_dt[14]['pvt'] += 1;
				$test_a = true;
			}

			$goup_code = trim(substr($a['goup'],0,3));
			if($goup_code=='G31'){ 
				$count_dt[14]['family'] += 1;
				$test_a = true;
			}

			$camp_code = trim(substr($a['camp'],0,3));
			if($camp_code=='M01'){ 
				$count_dt[14]['other'] += 1;
				$test_a = true;
			}

			// คนที่ไม่เข้าเงื่อนไขอะไรเลยให้ตีเป็น ทหาร/นายสิบ/ลูกจ้าง/กำลังพล
			if($test_a===false){
				$count_dt[14]['G1'] += 1;
			}
		}
		
	}

	$main_items = array(1=>'อาหารเป็นพิษ/โรคอุจจาระร่วง','วัณโรค','โรคไข้เลือดออกเดงกี','โรคไข้ปวดข้อยุงลาย','โรคไข้ซิก้าไวรัส','โรคอีสุกอีใส','โรคหัด','โรคหัดเยอรมัน','โรคติดเชื้อเอนเทอโรไวรัส','โรคคางทูม','โรคตาแดงจากเชื้อไวรัส','โรคไข้หวัดใหญ่','โรคปอดบวม','โควิด');
	$icd10_items = array(1=>'A01, A02, A03, A04, A05, A08, A09', 'A15', 'A90, A91', 'A92.0', 'A92.5', 'B01, B02', 'B05', 'B06', 'B08.4, B08.5', 'B26', 'B30', 'J10, J11', 'J12, J13, J14, J15, J16, J18','U099, U089, U072');

	?>
	<table class="chk_table">
		<tr>
			<th rowspan="3" align="center">โรคติดต่อสำคัญ</th>
			<th rowspan="3" align="center">ICD10</th>
			<th colspan="5" align="center">ประจำ<?=$day.' '.$dateshow;?></th>
		</tr>
		<tr>
			<th colspan="5" align="center">จำนวนผู้ป่วยจำแนกตามประเภท</th>
		</tr>
		<tr>
			<th align="center">ก</th>
			<th align="center">ข</th>
			<th align="center">ค</th>
			<th align="center">ง</th>
			<th align="center">จำนวนผู้ป่วย<br>รวม</th>
		</tr>
	<?php
	$sum_all = 0;
	foreach ($main_items as $key => $mItem) { 
		
		if(!$count_dt[$key]){
			continue;
		}

		$icdTxt = $icd10_items[$key];

		$sum_row = (int)($count_dt[$key]['G1']+$count_dt[$key]['pvt']+$count_dt[$key]['family']+$count_dt[$key]['other']);
		$sum_all += $sum_row;
		?>
		<tr valign="top">
			<td><?=$mItem;?></td>
			<td><?=$icdTxt;?></td>
			<td align="right"><?=$count_dt[$key]['G1'];?></td>
			<td align="right"><?=$count_dt[$key]['pvt'];?></td>
			<td align="right"><?=$count_dt[$key]['family'];?></td>
			<td align="right"><?=$count_dt[$key]['other'];?></td>
			<td align="right"><?=$sum_row;?></td>
		</tr>
		<?php
	}
	?>
		<tr>
			<td colspan="6" align="center">รวม</td>
			<td align="right"><?=$sum_all;?></td>
		</tr>
	</table>
	<?php 
	function show_details($items){ 
		?>
		<table class="chk_table">
			<tr>
				<th>#</th>
				<th width="8%">วันที่</th>
				<th width="5%">hn</th>
				<th width="3%">vn</th>
				<th width="15%">ชื่อ-สกุล</th>
				<th width="12%">ประเภท</th>
				<th width="8%">สังกัด</th>
				<th width="8%">ประเภทผู้มารับบริการ</th>
				<th width="18%">diag</th>
				<th>icd10</th>
				<th width="8%">depart_thai</th>
				<th width="8%">depart_eng</th>
			</tr>
		<?php
		$i = 1;
		foreach ($items AS $key => $a) {
			?>
			<tr>
				<td><?=$i;?></td>
				<td><?=$a['thidate'];?></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['vn'];?></td>
				<td><?=$a['ptname'];?></td>
				<td><?=$a['goup'];?></td>
				<td><?=$a['camp'];?></td>
				<td><?=$a['typeservice'];?></td>
				<td><?=$a['diag'];?></td>
				<td><?=$a['icd10'];?></td>
				<td><?=$a['depart_thai'];?></td>
				<td><?=$a['depart_eng'];?></td>
			</tr>
			<?php
			$i++;
		}
		?>
		</table>
		<?php
	}
	?>
	<h3 style="font-size:24px;">รายชื่อ</h3>
	<?php
	show_details($in_list);
	if(count($out_list) > 0){
		?>
		<h3 style="font-size:24px;">ICD10 อื่นๆ</h3>
		<?php
		show_details($out_list);
	}
	exit;
	// $objq = mysql_query($sql);
	// // dump($objq);
	// $count_dt = array();
	// while ($item = mysql_fetch_assoc($objq)) {
	// 	// dump($item);
	// 	$icd10_506 = $item['icd10_506'];
		
	// 	$ptname = trim($item['ptname']);
	// 	list($yot,$n,$s) = explode(' ', $ptname);

	// 	// if ($array['icd10'] == 'A01' || $array['icd10'] == 'A010' || $array['icd10'] == 'B008' || $array['icd10'] == 'B081' || $array['icd10'] == 'B084' || $array['icd10'] == 'B853' || $array['icd10'] == 'A630' || $array['icd10'] == 'A590' || $array['icd10'] == 'T881' || $array['icd10'] == 'T881' || $array['icd10'] == 'B804' || $array['icd10'] == 'T622' || $array['icd10'] == 'G937') {
	// 	// 	$subicd10 = $array['icd10'];
	// 	// 	$select = "select * from icd506 WHERE  icd10 ='$subicd10' ";
	// 	// } else {
	// 	// 	$subicd10 = substr($array['icd10'], 0, 3);
	// 	// 	$select = "select * from icd506 WHERE  icd10 like '$subicd10%' ";
	// 	// }
	// 	// $q1 = mysql_query($select);
	// 	// $dbarr = mysql_fetch_array($q1);

	// 	// $ref = $dbarr['icd10'];

	// 	if( $yot=='พลฯ' ){ 
	// 		$count_dt[$icd10_506]['pvt']++;
	// 		// $test_yot = true;
	// 	}


	// 	$goup_code = trim(substr($item['goup'],0,3));
	// 	// $test_goup = false;
	// 	if($goup_code=='G31'){ 
	// 		$count_dt[$icd10_506]['family'] += 1;
	// 		// $test_goup = true;
	// 		// $user_runno++;
	// 		// continue;
	// 	}

		



	// }

	// dump($count_dt);
	// exit;

	$query = "SELECT  icd506.icd10,depart_thai,depart_eng ,COUNT(*) AS duplicate FROM opday, icd506   Where opday.ref_icd10=icd506.icd10 and thidate like '$date1%' GROUP BY opday.ref_icd10 HAVING duplicate > 0 ORDER BY  icd506.icd10";

	$result = mysql_query($query);
	$rows = mysql_num_rows($result);
	$n = 0;

	//  echo $query."<br />";
	?>

	<table border="1" cellspacing="0" cellpadding="0" class="forntsarabun">
		<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
			<td align="center">ลำดับ</td>
			<td align="center">icd10</td>
			<td align="center">ชื่อโรค(ไทย)</td>
			<td align="center">ชื่อโรค(อังกฤษ)</td>
			<td align="center">จำนวน</td>
		</tr>
		<?
		if ($rows) {
			while ($dbarr1 = mysql_fetch_array($result)) {
				$n++;
				?>
				<tr onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
					<td align="center">
						<?= $n; ?>
					</td>
					<td><a href="icd506_detail.php?icd10=<?= $dbarr1['icd10']; ?>&&date1=<?= $date1; ?>" target="_blank"><?= $dbarr1['icd10']; ?></a></td>
					<td>
						<?= $dbarr1['depart_thai']; ?>
					</td>
					<td>
						<?= $dbarr1['depart_eng']; ?>
					</td>
					<td align="center">
						<?= $dbarr1['duplicate']; ?>
					</td>
				</tr>
			<?
			}
		} else {
			echo " <tr> <td colspan='5' class='forntsarabun' align='center'>ไม่พบรายการ</td>
  </tr>";
		}
		?>
	</table>
<?
}
?>