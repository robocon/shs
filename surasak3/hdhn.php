<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>พิมพ์สติ๊กเกอร์ติด TubeLab ห้องไตเทียม</title>
<body>
	<div>
		<a href="../nindex.htm">&lt;&lt; ไปเมนู</a>
	</div>
	<form id="form1" name="form1" method="post" action="hd_sticker_item.php">
		<table border="0">
			<tr>
				<td align="center" colspan="2"><strong>พิมพ์สติ๊กเกอร์ติด Tube Lab</strong></td>
			</tr>
			<tr>
				<td align="right">HN :</td>
				<td align="left"><input name="hn" type="text" size="20" /></td>
			</tr>
			<tr valign="top">
				<td align="right"> เลือกวันที่&nbsp;<br>(optional): </td>
				<td align="left">
					<?php 
					$dayRange = range(1,31);
					$monthRange = range(1,12);
					$yearRange = range(2019, date('Y'));
					$yearRange = array_reverse($yearRange);
					?>
					<select name="d" id="d">
						<option value="">เลือกวัน</option>
					<?php
					foreach ($dayRange as $d) {
						$dTxt = sprintf("%02d", $d);
						?>
						<option value="<?=$dTxt;?>"><?=$dTxt;?></option>
						<?php
					}
					?>
					</select>
					เดือน
					<select name="m" id="m">
					<option value="">เลือกเดือน</option>
					<?php
					foreach ($monthRange as $m) {
						$mTxt = sprintf("%02d", $m);
						?>
						<option value="<?=$mTxt;?>"><?=$mTxt;?></option>
						<?php
					}
					?>
					</select>
					ปี
					<select name="y" id="y">
					<option value="">เลือกปี</option>
					<?php
					foreach ($yearRange as $y) {
						$yTxt = sprintf("%02d", $y);
						$yTxt = $yTxt+543;
						?>
						<option value="<?=$yTxt;?>"><?=$yTxt;?></option>
						<?php
					}
					?>
					</select>
					<br>
					<span>ถ้าไม่เลือกวัน-เดือน-ปี จะใช้วัน-เดือน-ปีที่เป็นปัจจุบัน</span>
				</td>
			</tr>
			<tr>
				<td align="center" colspan="2"><input type="submit" value=" ตกลง " name='ok' /></td>
			</tr>
		</table>
	</form>
</body>
</html>