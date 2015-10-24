<?php
session_start();
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
	<title>โปรแกรมสรุปเวลาประจำวันทั้งหมด</title>
	<style type="text/css">
	.font1 {	font-family:AngsanaUPC;
		font-size: 20px;
	}
	</style>
</head>
<body>
	<div class="font1">
		<a href="stat_timepha.php" class="forntsarabun">&lt;&lt;กลับหน้าโปรแกรมสรุปเวลาประจำวัน</a>
	</div>
	<div class="font1">
		สรุปเวลาประจำวันทั้งหมดในช่วงเวลา 11โมงครึ่ง ถึง บ่ายโมง
	</div>
	<div>&nbsp;</div>
	<form name="timeline" method="post" action="<?php echo $_SERVER['PHP_SELF']?>" class="font1">
		<?php
		$d = isset($_POST['d1']) ? trim($_POST['d1']) : date("d") ;
		$m = isset($_POST['m1']) ? trim($_POST['m1']) : date("m") ;
		$year = isset($_POST['yr1']) ? trim($_POST['yr1']) : date("Y") ;
		?>
		พ.ศ.
		<select name="yr1">
			<?php
			$year = date("Y")+543;
			for($a=($year-5);$a<($year+5);$a++){
				?>
				<option value="<?=$ss?><?=$a?>" <?php if($year==$a) echo "selected='selected'"?>>
					<?=$a?>
				</option>
				<?php
			}
			?>
		</select>
		<input name="okbtn" type="submit" value="ตกลง" class="font1"/>
	</form>
	<?php
	if(isset($_POST['okbtn'])){
		$yr1 = trim($_POST['yr1']);
		$key_month = intval($m);
		?>
		<center>โปรแกรมสรุปเวลาห้องจ่ายยา เดือน ปี <?=$yr1?></center> 
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
		$ymd = $_POST['yr1']."-".$_POST['m1']."-".$_POST['d1'];
		$y_and_m = trim($_POST['yr1']).'-'.trim($_POST['m1']);
		
		// Temp dphardep
		$sql = "
		CREATE TEMPORARY TABLE `dphardep_temp`
		SELECT a.*,b.`idguard`
		FROM `dphardep` AS a 
		LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn`
		WHERE a.`dr_cancle` IS NULL 
		AND a.`date` >= '2558-02-01' AND a.`date` <= '2558-09-30'
		AND ( a.`pharin` >= '11:00:00' AND a.`pharin` <= '13:30:00') 
		AND b.`idguard` LIKE 'MX01%';
		";
		mysql_query($sql);
	
		$count1 = 0;
		$sumtime1 = 0;
		$sumtime2 = 0;
		$user_count_time = 0;
		
		$sum_start = 0;
		$sum_end = 0;
		$sum_total = 0;
		
		
		$max_time = 0;
		
		$sql3 = "SELECT date,pharin,stkcutdate,pharout,pharout1,hn,tvn,ptname
		FROM dphardep_temp";
		$rows3 = mysql_query($sql3);
		while($result3 = mysql_fetch_array($rows3)){

	
			if($result3['pharin'] && $result3['pharout'] !=''){
				$starttime = $result3['pharin'];
				$lasttime = $result3['pharout'];
				
				if($starttime && $lasttime!=""){
				
					$count1++; //ใบสั่งยาเรียกรับ
					
					$n++;
					$stringtime3 = strtotime($lasttime) - strtotime($starttime);
					$time3 = date("H:i:s",mktime(0,0,0+$stringtime3,date("m"),date("d"),date("Y")));
					
					$sum_start += $lasttime;
					$sum_end += $starttime;
					$sum_total += $stringtime3;
					
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
		
				}else{
					$time3 = "-";
				}
				
			}else{
				$time3="-";
			}
		
		/*
		?>
		<tr>
			<td align="center"><?=$result3['tvn']?></td>
			<td>
				<?php 
				list($date_ex, $time_ex) = explode(' ', $result3['date']);
				echo $date_ex;
				?>
			</td>
			<td><?=$result3['hn']?></td>
			<td><?=$result3['ptname']?></td>
			<td align="center"><?php if(empty($result3['pharin'])){ echo "-";}else{ echo $result3['pharin'];}?></td>
			<td align="center"><?php if(empty($result3['stkcutdate'])){ echo "-";}else{ echo $result3['stkcutdate'];}?></td>
			<td align="center"><?php if(empty($result3['pharout'])){ echo "-";}else{ echo $result3['pharout'];}?></td>  
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
	<?php
		echo date("H:i:s",mktime(0,0,0+($max_time),date("m"),date("d"),date("Y")));
	}
	?>
</body>
</html>