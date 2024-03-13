<?php 
require_once 'bootstrap.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>รายงานส่งAudit</title>
</head>
<body>
	<style>
		*{
			font-family: "Angsana New";
			font-size:20px;
		}
		h3{
			font-size: 32px;
		}
	</style>
	<div style="margin-bottom: 1em;">
		<a href='../nindex.htm'><< กลับไปหน้าหลัก รพ.</a>
	</div>
	<div>
		<h3>รายงานส่ง Audit</h3>
	</div>
	<fieldset>
		<legend>เลือกตาม วัน / เดือน / ปี</legend>
		<form method="POST" action="oia_audit_reportbangkok1.php" target="_blank">
			<div>
				<font face="Angsana New">วันที่
					<?php 
					$def_day = range(1, 31);
					?>
					<select name="date" id="date">
						<option value="">--&nbsp;เลือก&nbsp;--</option>
						<?php foreach($def_day as $key => $day): ?>
						<option value="<?=sprintf('%02d',$day);?>" ><?=$day;?></option>
						<?php endforeach; ?>
					</select>
				</font>

				<font face="Angsana New">&nbsp;&nbsp; เดือน-ปี
					<select name="rptmo" id="rptmo">
						<option value="">--&nbsp;เลือก&nbsp;--</option>
						<?php foreach($def_fullm_th as $key => $month): ?>
						<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
						<?php endforeach; ?>
					</select>

				</font>
				<?php
				$Y = date("Y") + 543;
				$date = date("Y") + 543 + 5;

				$dates = range(2547, $date);
				echo "<select name='thiyr'>";
				foreach ($dates as $i) {
					?>
					<option value='<?= $i ?>' <?php if ($Y == $i) { echo "selected"; } ?>>
						<?= $i; ?>
					</option>
				<?php
				}
				echo "<select>";

				$creditItems = array('กทม','จ่ายตรง','จ่ายตรง อปท.');
				?>
				&nbsp;&nbsp;<font face="Angsana New">ประเภทลูกหนี้</font>
				<select name="credit" id="credit">
					<option value="">--&nbsp;เลือก&nbsp;--</option>
				<?php
				foreach ($creditItems as $key => $value) {
					?>
					<option value="<?=$value;?>"><?=$value;?></option>
					<?php
				}
				?>
				</select>
				
			</div>
			<div>
				<input type="submit" value="    &#3605;&#3585;&#3621;&#3591;    " name="B1">
			</div>
		</form>
	</fieldset>
	<fieldset>
		<legend>ยอดรวม</legend>
		<form action="oia_audit_month.php" method="post" target="_blank">
			<?php 
			$def_day = range(1, 31);
			?>
			<span>เดือน-ปี</span>
			<select name="rptmo" id="rptmo">
				<option value="">--&nbsp;เลือก&nbsp;--</option>
				<?php foreach($def_fullm_th as $key => $month): ?>
				<option value="<?=$key;?>" <?=$select;?>><?=$month;?></option>
				<?php endforeach; ?>
			</select>
			<select name="thiyr" id="thiyr">
				<option value="">--&nbsp;เลือก&nbsp;--</option>
				<?php
				$thisYear = date('Y');
				$y_min = date("Y") - 5 ;
				$y_max = date("Y") + 5 ;
				for($a=$y_min; $a<=$y_max; $a++){
					$selected = $thisYear==$a ? 'selected="selected"' : '' ;
					$at = $a+543;
					?>
					<option value="<?=$at?>" <?=$selected;?> ><?=$at?></option>
					<?php
				}
				?>
			</select>
			<div>
				<button type="submit">&nbsp;&nbsp;&nbsp;ค้นหา&nbsp;&nbsp;&nbsp;</button>
			</div>
		</form>
	</fieldset>
</body>
</html>