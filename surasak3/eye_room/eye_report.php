<?php
include '../bootstrap.php';
?>
<style type="text/css">
.forntsarabun,select {
  font-family: "TH SarabunPSK";
  font-size: 22px;
}
@media print{
  #no_print{
    display:none;
  }
}
.theBlocktoPrint {
  background-color: #000; 
  color: #FFF; 
} 
</style>

<div id="no_print" >

	<div id="head"></div>

	<form name="f1" action="" method="post">
		<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
			<tr class="forntsarabun">
				<td colspan="2" bgcolor="#99CC99">สถิติยอดผู้ป่วย และ Top 5 โรค ห้องตรวจตา</td>
			</tr>
			<tr class="forntsarabun">
				<td align="right">
					<span class="forntsarabun">ช่วงเดือน</span>
				</td>
				<td>
					<select name='d_start' class="forntsarabun">
						<option value="">ไม่เลือกวัน</option>
						<?php
						$dd=date("d");
						for($d=1;$d<=31;$d++){

							if($d<=9){
								$d="0".$d;
							}

							if($dd==$d){
								?>
								<option value="<?=$d;?>" selected><?=$d;?></option>
								<?php
							}else{
								?>
								<option value="<?=$d;?>"><?=$d;?></option>
								<?php
							}
						}
						?>
					</select>
					<?php $m=date('m'); ?>
					<select name="m_start" class="forntsarabun">
						<option value="">ไม่เลือกเดือน</option>
						<option value="01" <?php if($m=='01'){ echo "selected"; }?>>มกราคม</option>
						<option value="02" <?php if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
						<option value="03" <?php if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
						<option value="04" <?php if($m=='04'){ echo "selected"; }?>>เมษายน</option>
						<option value="05" <?php if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
						<option value="06" <?php if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
						<option value="07" <?php if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
						<option value="08" <?php if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
						<option value="09" <?php if($m=='09'){ echo "selected"; }?>>กันยายน</option>
						<option value="10" <?php if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
						<option value="11" <?php if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
						<option value="12" <?php if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
					</select>
					<?php
					$Y=date("Y")+543;
					$date=date("Y")+543+5;

					$dates=range(2547,$date);
					echo "<select name='y_start' class='forntsarabun'>";
					foreach($dates as $i){
						?>
						<option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
						<?php
					}
					echo "<select>";
					?>
				</td>
			</tr>
			<tr>
				<td colspan="2" align="center">
					<input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
					<a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a>
				</td>
			</tr>
		</table>
	</form>

	<form action="eye_report.php" method="post">
		<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse">
			<tr class="forntsarabun" align="center">
				<td colspan="2" bgcolor="#99CC99">เลือกการแสดงผลตามปีงบประมาณ (ตุลาคม - กันยายน)</td>
			</tr>
			<tr class="forntsarabun" align="center">
				<td colspan="2">
					<?php
					$def_year = get_year_checkup(true, true);
					$range_year = range(( $def_year - 13 ), $def_year);
					?>
					เลือกปี: <?=getYearList('y_start', true, $def_year, $range_year);?>
				</td>
			</tr>
			<tr class="forntsarabun" align="center">
				<td colspan="2">
					<button class="forntsarabun" type="submit">ตกลง</button>
					<input type="hidden" name="checkup" value="yes">
					<input type="hidden" name="submit" value="submit">
				</td>
			</tr>
		</table>
	</form>

</div>

<?php
if($_POST['submit']){

	$checkup = input_post('checkup');

	if($_POST['m_start']==""){
		$date1 = $_POST['y_start'];
	}else{
		$date1 = $_POST['y_start'].'-'.$_POST['m_start'].'-'.$_POST['d_start'];
	}

	switch($_POST['m_start']){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	
	if($_POST['m_start']==""){
		
		$day="ปี";
		$dateshow = $_POST['y_start'];
	
	}else if($_POST['d_start']==""){
		$day="เดือน";
		$dateshow = $printmonth." ".$_POST['y_start'];
	}else{
		$day="วันที่";
		$dateshow = $_POST['d_start'].' '.$printmonth." ".$_POST['y_start'];	
	}

	// ถ้าเลือกการแสดงผลตามปีงบประมาณ
	if( $checkup !== false ){
		$thai_year = ad_to_bc(input_post('y_start'));
		$where = " ( `thidate` >= '".(($thai_year - 1).'-10-01')."' AND `thidate` <= '".($thai_year.'-09-30')."' ) ";
	
		$dateshow = "งบประมาณ".$thai_year;

	}else{ 
		$where = "`thidate` LIKE  '$date1%' ";
	}
 
	$sql1 = "CREATE TEMPORARY TABLE `opday1` 
	SELECT `row_id`,`thidate`,`hn`,`an`,`ptname`,`ptright`,`diag`, TRIM(`icd10`) AS `icd10`
	FROM `opday` 
	WHERE $where 
	AND ( `doctor` LIKE  '%พิศาล%' OR `doctor` LIKE  '%เลอปรัชญ์%' )";
	$query1 = mysql_query($sql1) or die( mysql_error() );
 
	$sql = "SELECT * FROM opday1";
	$objq = mysql_query($sql);
	$row = mysql_num_rows($objq);
	if($row){
		?>
		<div>
			<a href='#top' class='forntsarabun'>Top 5 โรค</a>
		</div>
		<div>
			<font class='forntsarabun' >สถิติห้องตรวจตา ประจำ<?=$day;?> <?=$dateshow;?></font>
		</div>
		
		<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
			<tr bgcolor="#0099FF">
				<td align="center">ลำดับ</td>
				<td align="center">วันที่</td>
				<td align="center">HN</td>
				<td align="center">AN</td>
				<td align="center">ชื่อ-สกุล</td>
				<td align="center">สิทธิ</td>
				<td align="center">Diag</td>
				<td align="center">icd10</td>
			</tr>
			<?php
			$i = 0;
			$empty_i = 0;
			$

			$new_item_set = array();
			while( $item = mysql_fetch_array($objq) ){

				// นับจำนวน icd10 ที่มันเป็นค่าว่าง
				if( empty($item['icd10']) OR is_null($item['icd10']) ){
					++$empty_i;
				}
				?>
				<tr>
					<td align="center"><?=++$i;?></td>
					<td><?=$item['thidate'];?></td>
					<td><?=$item['hn'];?></td>
					<td><?=$item['an'];?></td>
					<td><?=$item['ptname'];?></td>
					<td><?=$item['ptright'];?></td>
					<td><?=$item['diag'];?></td>
					<td><?=$item['icd10'];?></td>
				</tr>
				<?php
			} //End while
			?>
		</table>
		<br />
		<a href="#head" class="forntsarabun">ขึ้นข้างบน</a>

		<a name="top" id="top"></a>
		<h1 class="forntsarabun">Top 5 โรค</h1> 
		<?php
		$sqltop = "SELECT `icd10`,`diag`, COUNT(`icd10`) AS `top` 
		FROM `opday1`
		GROUP BY `icd10`
		ORDER BY `top` DESC ";
		$objtop = mysql_query($sqltop);
		$i=0;
		?>
		<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun">
			<tr align="center">
				<td bgcolor="#0099FF">ลำดับ</td>
				<td bgcolor="#0099FF">ICD10</td>
				<td bgcolor="#0099FF">ชื่อโรค</td>
				<td bgcolor="#0099FF">จำนวน</td>
			</tr>
			<?php
			
			while($array2 = mysql_fetch_array($objtop)){

				// ในตาราง top5 ไม่ต้องแสดง icd10 ที่ว่าง
				if( empty($array2['icd10']) OR $array2['icd10'] === null ){
					continue;
				}

				?>
				<tr>
					<td align="center"><?=++$i;?></td>
					<td>
						<a href="detail.php?do=view&icd10=<?=$array2['icd10'];?>&date=<?=$date1;?>" title="คลิกเพื่่อดูรายละเอียด"><?=$array2['icd10'];?></a>
					</td>
					<td><?=$array2['diag'];?></td>
					<td align="center"><?=$array2['top'];?></td>
				</tr>
				<?php
				$sum += (int) $array2['top'];
			}
			?>
			<tr>
				<td colspan="3" align="center">ไม่มี ICD10</td>
				<td align="center"><?=$empty_i;?></td>
			</tr>
			<tr>
				<td colspan="3" align="center">รวม</td>
				<?php 
				// dump($sum);
				// dump(empty_i);
				$total = $sum + $empty_i;
				?>
				<td align="center"><?=$total;?></td>
			</tr>
		</table>
		<?php
	}else{
		echo "<font class=\"forntsarabun\">ไม่มีข้อมูลของเดือน  $dateshow</font>";
	}
}
?>