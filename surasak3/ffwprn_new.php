<?php
include ("connect.inc");
//    $Thidate = (date("Y")+543).date("-m-d G:i:s"); 
$Thdate = date("d-m-") . (date("Y") + 543) . '   ' . date("H:i:s");
print "รายงานเมื่อ $Thdate<br>";
if ($_GET['id'] == "41") {
	print "รายการอาหาร หอผู้ป่วยชาย<br>";
} elseif ($_GET['id'] == "42") {
	print "รายการอาหาร หอผู้ป่วยหญิง<br>";
} elseif ($_GET['id'] == "43") {
	print "รายการอาหาร หอผู้ป่วยสูตินรี<br>";
} elseif ($_GET['id'] == "44") {
	print "รายการอาหาร หอผู้ป่วยหนัก(ICU)<br>";
} elseif ($_GET['id'] == "45") {
	print "รายการอาหาร หอผู้ป่วยพิเศษ<br>";
} elseif ($_GET['id'] == "46") {
	print "รายการอาหาร Cohort Ward<br>";
} elseif ($_GET['id'] == "47") {
	print "รายการอาหาร Home Isolation<br>";
} elseif ($_GET['id'] == "48") {
	print "รายการอาหาร รพ.สนาม<br>";
}
?>
<style>
	.font {
		font-family: AngsanaUPC;
		font-size: 18px;
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
</style>
<table width="100%" class="font">
	<tr>
		<th bgcolor=6495ED width="5%">เตียง</th>
		<th bgcolor=6495ED>AN</th>
		<th width="30%" bgcolor=6495ED>ชื่อผู้ป่วย</th>
		<th width="20%" bgcolor=6495ED>โรค</th>
		<th width="15%" bgcolor=6495ED>โรคประจำตัว</th>
		<th width="30%" bgcolor=6495ED>อาหาร</th>
	</tr>
	<?php 
	$id = sprintf("%s", $_GET['id']);
	$query = "SELECT a.bed,a.ptname,a.diagnos,a.diag1,a.food,a.bedcode,a.age,a.hn,b.an 
	FROM bed as a INNER JOIN ipcard as b ON a.an=b.an 
	WHERE b.hi_type !='out' 
	AND a.bedcode LIKE '$id%' ORDER BY a.bed ASC ";
	$result = mysql_query($query) or die("Query failed");
	while (list($bed, $ptname, $diagnos, $diag1, $food, $bedcode, $age, $hn, $an) = mysql_fetch_row($result)) {

		$foodFromBed = $food; 

		$food = str_replace('ไม่ต้องการแยกภาชนะ', '', $food);
		$food = str_replace('ต้องการแยกภาชนะ', 'แยกภาชนะ', $food);

		if ($diag1 == "โรคประจำตัว") {
			$diag1_value = "";
		} else {
			$diag1_value = $diag1;
		}

		$sql = "SELECT *,CONCAT((SUBSTRING(`regisdate`,1,4)-543),SUBSTRING(`regisdate`,5,15)) AS `regisdateEn` FROM `ward_log` WHERE `an` = '$an' AND `chgcode` = 'Food' ORDER BY `row_id` DESC LIMIT 1";
		$r = mysql_query($sql);
		$a = mysql_fetch_assoc($r);

		// $sql = "SELECT thidate,weight,height FROM opd WHERE  hn ='$hn' order by thidate DESC limit 1 ";

		// list($thidate, $weight, $height) = mysql_fetch_row(Mysql_Query($sql));
		// $bmi = '';
		// if ($height != "" && $height > 0 && $weight != "" && $weight > 0) {
		// 	$ht = $height / 100;
		// 	$bmi = number_format(($weight / ($ht * $ht)), 2);
		// }

		//print "<table width='100%' border='1' ><tr><th width='7%'>เตียง</th><th width=37%>ชื่อผู้ป่วย</th><th width=14%>โรค</th><th width=30%>โรคประจำตัว</th><th width=10%>อายุ</th><th width=10%>BMI</th></tr>";
		?>

		<tr style="line-height:16px;">
			<td align="center" valign="top"><?= $bed ?></td>
			<td valign="top"><?=$an;?></td>
			<td valign="top"><?= $ptname ?></td>
			<td valign="top"><?= $diagnos ?></td>
			<td valign="top"><?= $diag1_value ?></td>
			<td valign="top">
				<?php 
				if(!empty($a['new'])){ 

					$time1 = strtotime($a['regisdateEn']);
					$time2 = strtotime(date("Y-m-d H:i:s"));
					$hourDiff = abs($time2 - $time1)/(60*60);
					if($a['old']!==$foodFromBed && $hourDiff<12){
						// แสดง icon new
						echo '<span style="background-color: #ff1f1f; color: white; padding: 0 8px;" title="'.$a['old'].'">NEW</span>';
					}
				}
				?>
				<u>
					<?php
					if ($ptname == "นาย บุญย้าย ดวงสนม") {
						$food = "อาหารปกติ เบาหวาน ZNa<2g/d,pro90g/d,choles<br /><200mg/d,satfat<10,totaalfat<30totalcal800kcal/d";
						echo $food;
					} else {
						echo $food;
					}
					?>
				</u>
				<!-- <p>OLD: <?=$a['old'];?></p>
				<p>NEW: <?=$a['new'];?></p>
				<p>BED: <?=$foodFromBed;?></p> -->
			</td>
		</tr>
	<?
	}
	// include("unconnect.inc");
	?>
</table>
<div id="no_print">
	---------จบรายงาน------------
</div>