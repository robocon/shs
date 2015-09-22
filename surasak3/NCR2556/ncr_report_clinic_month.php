<?php session_start();?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
    <title>ระบบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</title>
    <link type="text/css" href="menu.css" rel="stylesheet" />
    <script type="text/javascript" src="jquery.js"></script>
    <script type="text/javascript" src="menu.js"></script>
</head>
<body>
<?php include 'menu.php';?>
<div>
	<div id="no_print" style="margin: 1em;">
        <a href="ncr_report_clinic.php">&lt;&lt;&nbsp;กลับไปหน้ารายงานสรุประดับความรุนแรง</a>
    </div>
	<div><h1 class="forntsarabun">หน้ารายงานสรุประดับความรุนแรง(แบ่งตามเดือน)</h1></div>
	<div id="no_print" >
		<form name="f1" action="" method="post">
			<table  border="1" cellpadding="0" cellspacing="0" bordercolor="#666666" style="border-collapse:collapse" width="20%">
				<tr class="forntsarabun">
					<td align="right">ค้นหาตามปี</td>
					<td>
						<select name="y_start" class="forntsarabun">
							<?php 
							$Y=date("Y")+543;
							$date=date("Y")+543+5;
							$dates=range(2547,$date);
							foreach($dates as $i){
								?><option value='<?=$i?>' <?php if($Y==$i){ echo "selected"; }?>><?=$i;?></option><?php
							}
							?>
						<select>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
						<input type="button" name="button" value="พิมพ์รายงาน"  onClick="JavaScript:window.print();" class="forntsarabun">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<br>
<?php
include("connect.inc");

$risk_lists = array(
	'1. Clinical Risk',
	'2. Infection control Risk',
	'3. Medication Risk',
	'4. Medical Equipment Risk',
	'5. Safety and Environment Risk',
	'6. Customer Complaint Risk',
	'7. Financial Risk',
	'8. Utilization Management Risk',
	'9. Information Risk',
);

$date1 = (date("Y")+543);
if( isset($_POST['y_start']) && !empty($_POST['y_start']) ){
    $date1 = ($_POST['y_start']);
}

// สร้าง Temp file
$sqlncr = "CREATE TEMPORARY TABLE ncr SELECT * FROM `ncr2556`  WHERE `nonconf_date` LIKE '".$date1."%' ";
$result = Mysql_Query($sqlncr) or die(mysql_error());

$arr = array("risk1","risk2","risk3","risk4","risk5","risk6","risk7","risk8","risk9");

$months = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฏาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

foreach($months as $key => $month){
	


?>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
	<tr>
		<th rowspan="2" align="center" bgcolor="#00CCFF" class="forntsarabun">
			<p>โปรแกรม</p>
		</th>
		<th colspan="12" align="center" bgcolor="#00CCFF" class="forntsarabun">ระดับความรุนแรงทางคลินิก ปี <?=($date1)?> เดือน <?php echo $month; ?></th>
	</tr>
	<tr>
		<?php for ($i='A'; $i<='I'; $i++) { ?>
		<th align="center" bgcolor="#00CCFF" class="forntsarabun"  width="7%"><?=$i;?></th>
		<?php } ?>
		<th align="center" bgcolor="#00CCFF" class="forntsarabun"  width="7%">รวม</th>
	</tr>
<?php 
$list01 = array();

for($n=0; $n<=8; $n++){
	
	// Get risk item from array
	$risk = $risk_lists[$n];
	?>
	<tr>
		<td class="forntsarabun"><?=$risk;?></td>
		<?php 
		$sum=0;
		
		// แสดง Column A ถึง I
		for ($i='A'; $i<='I'; $i++) {
			$selectsql = "
			SELECT COUNT(*)as count 
			FROM ncr WHERE `nonconf_date` LIKE '$date1-$key%' 
			AND $arr[$n] = '1' 
			AND clinic ='$i' ";
			$result1 = mysql_query($selectsql);
			$numrow1=mysql_num_rows($result1);
			$arr1  = mysql_fetch_array($result1);
			if($arr1['count']!=0){
				?>
				<td align="center" class="forntsarabun" width="7%"><a href="detail_report_progarm.php?y=<?=$date1;?>&m=<?=$key;?>&risk=<?=$arr[$n];?>&clinic=<?=$i;?>" target="_blank"><?=$arr1['count'];?></td>
				<?php 
			}else{
				?><td align="center" class="forntsarabun" width="7%"> <?=$arr1['count'];?></td><?php 
			}
			$sum+=$arr1['count'];
		}
		?>
		<td align="center" class="forntsarabun"  width="7%"><?=$sum;?></td>
	</tr>
	<?php 
}
?>  
<tr>
<td align="center" bgcolor="#FFFFCC" class="forntsarabun">รวม</td>
<?php 
$sumall = 0;
for ($i='A'; $i<='I'; $i++) {
	$selectsql2 = "
	SELECT sum( risk1 ) , sum( risk2 ) , sum( risk3 ) , sum( risk4 ) , sum( risk5 ) , sum( risk6 ) , sum( risk7 ) , sum( risk8 ) , sum( risk9 ) 
	FROM  ncr 
	WHERE `nonconf_date` LIKE '$date1-$key%' 
	AND clinic ='$i' and ( risk1 or risk2 or risk3 or risk4 or risk5 or risk6 or risk7 or risk8 or risk9 !='' )  ";
	$result2 = mysql_query($selectsql2);
	$arr2  = mysql_fetch_array($result2);
	$sum2 = 0;
	for($a=0; $a<=8; $a++){
		$sum2 += $arr2[$a];
	}
	$sumall += $sum2;
	?>
	<td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sum2;?></td>
	<?php 
} 
?>
<td align="center" bgcolor="#FFFFCC" class="forntsarabun"><?=$sumall;?></td>
</tr>
</table>
<br>
<?php } //End for ?>


</div>
</body>
</html>