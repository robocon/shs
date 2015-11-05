<?php
session_start();
include 'connect.php';
include 'includes/functions.php';
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<title>สรุปเวลารับจ่ายยาตามช่วงเวลา</title>
	<style type="text/css">
	.font1 {	font-family:AngsanaUPC;
		font-size: 20px;
	}
	p{ margin: 0; }
	</style>
</head>
<body>
	<div class="font1">
		<a href="stat_timepha.php" class="forntsarabun">&lt;&lt;กลับหน้าโปรแกรมสรุปเวลาประจำวัน</a>
	</div>
	<div class="font1">
		สรุปเวลารับจ่ายยาตามช่วงเวลา
	</div>
	<div>&nbsp;</div>
	<form name="timeline" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" class="font1">
		<?php
		$d = isset($_POST['d1']) ? trim($_POST['d1']) : date("d") ;
		$m = isset($_POST['m1']) ? trim($_POST['m1']) : date("m") ;
		$year = isset($_POST['yr1']) ? trim($_POST['yr1']) : date("Y")+543 ;
		
		$min_date = isset($_POST['min_date']) ? trim($_POST['min_date']) : (date("Y")+543).'-'.date("m") ;
		$max_date = isset($_POST['max_date']) ? trim($_POST['max_date']) : (date("Y")+543).'-'.date("m") ;
		/*
		?>
		พ.ศ.
		<?php echo getYearList('yr1', true, $year); ?>
		<?php */ ?>
		
		วันที่เริ่มต้น
		<input type="text" name="min_date" value="<?php echo $min_date;?>">
		วันที่สิ้นสุด
		<input type="text" name="max_date" value="<?php echo $max_date;?>">
		
		<div style="color: red; font-size: 15px;">
			<p>* ตัวอย่างรูปแบบวันที่เริ่มต้น 2558-10-26 เป็นต้น</p>
			<p>** สามารใช้รูปแบบ 2558-10 เพื่อแสดงเป็นเดือนได้</p>
		</div>
		
		<input name="okbtn" type="submit" value="แสดงผล" class="font1"/>
	</form>
	<?php
	if(isset($_POST['okbtn'])){
		$yr1 = trim($_POST['yr1']);
		$key_month = intval($m);
		?>
		<b>สรุปเวลารับจ่ายยาตามช่วงเวลา</b> 
		<?php /* ?>
		<table width="100%" class="font1" border="1" cellpadding="0" cellspacing="0">
			<tr>
				<td width="2%" rowspan="2" align="center">VN</td>
				<td width="2%" rowspan="2" align="center">วันที่</td>
				<td width="5%" rowspan="2" align="center">HN</td>
				<td width="15%" rowspan="2" align="center">ชื่อ-สกุล</td>
				<td colspan="3" align="center">เวลา</td>
				<td width="6%" rowspan="2" align="center">รวมเวลา(3-1)</td>
			</tr>
			<tr>
				<td width="6%" align="center">รับใบสั่งยา(1)</td>
				<td width="6%" align="center">ตัดยา(2)</td>
				<td width="6%" align="center">เรียกรับ(3)</td>
			</tr>
		<?php
		*/
		// $ymd = $_POST['yr1']."-".$_POST['m1']."-".$_POST['d1'];
		// $y_and_m = trim($_POST['yr1']).'-'.trim($_POST['m1']);
		
		$where = " AND a.`date` LIKE '$min_date'";
		if( $min_date != $max_date){
			$where = "AND a.`date` >= '$min_date' AND a.`date` <= '$max_date'";
		}
		
		// Temp dphardep
		$sql = "
		CREATE TEMPORARY TABLE `dphardep_temp`
		SELECT a.*,b.`idguard`
		FROM `dphardep` AS a 
		LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
		WHERE a.`dr_cancle` IS NULL 
		$where
		";
		// AND ( a.`pharin` >= '11:00:00' AND a.`pharin` <= '13:30:00') 
		// AND b.`idguard` LIKE 'MX01%';
		
		mysql_query($sql);
	
		$count1 = 0;
		$sumtime1 = 0;
		$sumtime2 = 0;
		$user_count_time = 0;
		
		$sum_start = 0;
		$sum_end = 0;
		$sum_total = 0;
		
		$max_time = 0;
		
		// ช่วงเวลา
		$time_8start = '08:30:00';
		$time_8end = '11:00:00';
		
		$time_11start = '11:00:00';
		$time_11end = '13:30:00';
		
		$time_8mx00 = $mx00_rows08 = 0;
		$time_8mx01 = $mx01_rows08 = 0;
		
		$time_11mx00 = $mx00_rows11 = 0;
		$time_11mx01 = $mx01_rows11 = 0;
		
		$sql3 = "SELECT date,pharin,stkcutdate,pharout,pharout1,hn,tvn,ptname,idguard
		FROM dphardep_temp";
		$rows3 = mysql_query($sql3);
		while($item = mysql_fetch_array($rows3)){

			if($item['pharin'] && $item['pharout'] !=''){
				$starttime = $item['pharin'];
				$lasttime = $item['pharout'];
				
				if($starttime && $lasttime!=""){
					
					// เวลาที่ใช้ไป
					$stringtime3 = strtotime($lasttime) - strtotime($starttime);
					
					// สิทธ์
					$user_mx = strtolower(substr($item['idguard'], 0, 4));
					
					// แบ่งตามช่วงเวลา 8.30 - 11.00
					$item_date = strtotime(bc_to_ad($item['date']));
					$test_date = explode(' ', $item['date']);
					$time_8min = strtotime(bc_to_ad($test_date['0']).' '.$time_8start);
					$time_8max = strtotime(bc_to_ad($test_date['0']).' '.$time_8end);
					
					if( $item_date > $time_8min && $item_date < $time_8max ){
						if( $user_mx === 'mx00' ){
							$mx00_rows08++;
							$time_8mx00 += $stringtime3;
						}else{
							$mx01_rows08++;
							$time_8mx01 += $stringtime3;
						}
					}
					
					// แบ่งตามช่วงเวลา 11.00 - 13.00
					$time_11min = strtotime(bc_to_ad($test_date['0']).' '.$time_11start);
					$time_11max = strtotime(bc_to_ad($test_date['0']).' '.$time_11end);
					if( $item_date > $time_11min && $item_date < $time_11max ){
						if( $user_mx === 'mx00' ){
							$mx00_rows11++;
							$time_11mx00 += $stringtime3;
						}else{
							$mx01_rows11++;
							$time_11mx01 += $stringtime3;
						}
					}
					
					$count1++; //ใบสั่งยาเรียกรับทั้งหมด
					
					// เวลาเฉลี่ยรวมต่อคน
					$sum_total += $stringtime3;
					
					$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					
					$sum_start += $lasttime;
					$sum_end += $starttime;
					
					// เวลามากสุดที่ใช้ไป
					if( $stringtime3 > $max_time ){
						$max_time = $stringtime3;
					}
					
					// หาจำนวนเวลาโดยเฉลี่ย
					$test_time = round(abs(strtotime($lasttime) - strtotime($starttime))/60);
					
					$user_count_time += $test_time;
					if($test_time > 30){ // ถ้าเกิน 30 นาที 
						$sumtime1++;
					}else{
						$sumtime2++;
					}
					
					
					// if( $time_8start ){
						
					// }
					
				}else{
					$time3 = "-";
				}
				
			}else{
				$time3 = "-";
			}
		
		/*
		?>
		<tr>
			<td align="center"><?=$item['tvn']?></td>
			<td>
				<?php 
				list($date_ex, $time_ex) = explode(' ', $item['date']);
				echo $date_ex;
				?>
			</td>
			<td><?=$item['hn']?></td>
			<td><?=$item['ptname']?></td>
			<td align="center"><?php if(empty($item['pharin'])){ echo "-";}else{ echo $item['pharin'];}?></td>
			<td align="center"><?php if(empty($item['stkcutdate'])){ echo "-";}else{ echo $item['stkcutdate'];}?></td>
			<td align="center"><?php if(empty($item['pharout'])){ echo "-";}else{ echo $item['pharout'];}?></td>  
			<td align="center"><?php if(empty($time3)){ echo "-";}else{ echo $time3;}?></td>
		</tr>
		<?php
		*/
	} // End while
	?>
	</table>
	<p>รับใบสั่งยา - เรียกรับ <?php echo $count1;?> คน</p>
	<p>จำนวนใบสั่งยาที่ใช้เวลาเกิน 30 นาที  จำนวน <?php echo $sumtime1;?> คน</p>
	<p>จำนวนใบสั่งยาที่ใช้เวลาไม่เกิน 30 นาที จำนวน <?php echo $sumtime2;?> คน</p>
	<?php
	$sum_total_time = round($sum_total/$count1);
	$time_avg = date("H:i:s",mktime(0,0,0+($sum_total_time),date("m"),date("d"),date("Y"))); 
	?>
	<p>เฉลี่ยใช้เวลาการให้บริการ/คน <?php echo $time_avg;?></p>
	<p>เวลามากสุดที่ใช้ไป <?php echo date("H:i:s",mktime(0,0,0+($max_time),date("m"),date("d"),date("Y"))); ?></p>
	
	<?php $round_time = round( $time_8mx00 / $mx00_rows08 );?>
	<p>เวลาโดยเฉลี่ยช่วงเวลา 08:30-11:00 ทหาร จำนวน <?php echo date("H:i:s",mktime(0,0,0+($round_time),date("m"),date("d"),date("Y"))); ?></p>
	<?php $round_time = round( $time_8mx01 / $mx01_rows08 );?>
	<p>เวลาโดยเฉลี่ยช่วงเวลา 08:30-11:00 พลเรือน จำนวน <?php echo date("H:i:s",mktime(0,0,0+($round_time),date("m"),date("d"),date("Y"))); ?></p>
	<?php $round_time = round( $time_11mx00 / $mx00_rows11 );?>
	<p>เวลาโดยเฉลี่ยช่วงเวลา 11:00-13:30 ทหาร จำนวน <?php echo date("H:i:s",mktime(0,0,0+($round_time),date("m"),date("d"),date("Y"))); ?></p>
	<?php $round_time = round( $time_11mx01 / $mx01_rows11 );?>
	<p>เวลาโดยเฉลี่ยช่วงเวลา 11:00-13:30 พลเรือน จำนวน <?php echo date("H:i:s",mktime(0,0,0+($round_time),date("m"),date("d"),date("Y"))); ?></p>
	
	<?php
		
	}
	?>
</body>
</html>