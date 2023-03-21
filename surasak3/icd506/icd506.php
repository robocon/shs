<?php
include 'Connections/connect.inc.php';
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
					<? $d = date('d'); ?>
					<select name="d_start" class="forntsarabun">
						<option value="">ไม่เลือกวัน</option>
						<? for ($i = 1; $i <= 31; $i++) {

							if ($i <= 9) {

								$i = "0" . $i;
								?>
								<option value="<?= $i; ?>" <? if ($d == $i) {
									  echo "selected";
								  } ?>><?= $i; ?></option>
							<? } else { ?>
								<option value="<?= $i; ?>" <? if ($d == $i) {
									  echo "selected";
								  } ?>><?= $i; ?></option>
							<? }
						} ?>
					</select>

					<? $m = date('m'); ?>
					<select name="m_start" class="forntsarabun">
						<option value="01" <? if ($m == '01') {
							echo "selected";
						} ?>>มกราคม</option>
						<option value="02" <? if ($m == '02') {
							echo "selected";
						} ?>>กุมภาพันธ์</option>
						<option value="03" <? if ($m == '03') {
							echo "selected";
						} ?>>มีนาคม</option>
						<option value="04" <? if ($m == '04') {
							echo "selected";
						} ?>>เมษายน</option>
						<option value="05" <? if ($m == '05') {
							echo "selected";
						} ?>>พฤษภาคม</option>
						<option value="06" <? if ($m == '06') {
							echo "selected";
						} ?>>มิถุนายน</option>
						<option value="07" <? if ($m == '07') {
							echo "selected";
						} ?>>กรกฎาคม</option>
						<option value="08" <? if ($m == '08') {
							echo "selected";
						} ?>>สิงหาคม</option>
						<option value="09" <? if ($m == '09') {
							echo "selected";
						} ?>>กันยายน</option>
						<option value="10" <? if ($m == '10') {
							echo "selected";
						} ?>>ตุลาคม</option>
						<option value="11" <? if ($m == '11') {
							echo "selected";
						} ?>>พฤศจิกายน</option>
						<option value="12" <? if ($m == '12') {
							echo "selected";
						} ?>>ธันวาคม</option>
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
	ORDER BY a.`row_id`";
	$q_506 = $dbi->query($sql);
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

	$main_items = array(1=>'อาหารเป็นพิษ/โรคอุจจาระร่วง','วัณโรค','โรคไข้เลือดออกเดงกี','โรคไข้ปวดข้อยุงลาย','โรคไข้ซิก้าไวรัส','โรคอีสุกอีใส','โรคหัด','โรคหัดเยอรมัน',
'โรคติดเชื้อเอนเทอโรไวรัส','โรคคางทูม','โรคตาแดงจากเชื้อไวรัส','โรคไข้หวัดใหญ่','โรคปอดบวม');

	?>
	<table class="chk_table">
		<tr>
			<td rowspan="3" align="center">โรคติดต่อสำคัญ</td>
			<td colspan="5" align="center">ประจำ<?=$day.' '.$dateshow;?></td>
		</tr>
		<tr>
			<td colspan="5" align="center">จำนวนผู้ป่วยจำแนกตามประเภท</td>
		</tr>
		<tr>
			<td align="center">ก</td>
			<td align="center">ข</td>
			<td align="center">ค</td>
			<td align="center">ง</td>
			<td align="center">รวม</td>
		</tr>
	<?php
	foreach ($main_items as $key => $mItem) { 

		if(!$count_dt[$key]){
			continue;
		}
		?>
		<tr valign="top">
			<td><?=$mItem;?></td>
			<td align="right"><?=$count_dt[$key]['G1'];?></td>
			<td align="right"><?=$count_dt[$key]['pvt'];?></td>
			<td align="right"><?=$count_dt[$key]['family'];?></td>
			<td align="right"><?=$count_dt[$key]['other'];?></td>
			<td align="right"><?=($count_dt[$key]['G1']+$count_dt[$key]['pvt']+$count_dt[$key]['family']+$count_dt[$key]['other']);?></td>
		</tr>
		<?php
	}
	?>
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
				<th >icd10</th>
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
	?>
	<h3 style="font-size:24px;">ICD10 อื่นๆ</h3>
	<?php
	show_details($out_list);
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