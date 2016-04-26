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
					
					echo "<select name='selmon' size='1'  class='txt'>";
					for($i=1; $i <= count($thaimonthFull); $i++){
						
						$i = sprintf('%02d', $i);
						$selected = ( $selmon === $i ) ? 'selected="selected"' : '' ;
						echo "<option value='$i' $selected>".$thaimonthFull[$i]."</option>";
					}
					echo "</select>";
					?>
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
	if($selmon=="01"){
		$showmon="มกราคม";
	}else if($selmon=="02"){
		$showmon="กุมภาพันธ์";
	}else if($selmon=="03"){
		$showmon="มีนาคม";
	}else if($selmon=="04"){
		$showmon="เมษายน";
	}else if($selmon=="05"){
		$showmon="พฤษภาคม";
	}else if($selmon=="06"){
		$showmon="มิถุนายน";
	}else if($selmon=="07"){
		$showmon="กรกฎาคม";
	}else if($selmon=="08"){
		$showmon="สิงหาคม";
	}else if($selmon=="09"){
		$showmon="กันยายน";
	}else if($selmon=="10"){
		$showmon="ตุลาคม";
	}else if($selmon=="11"){
		$showmon="พฤศจิกายน";
	}else if($selmon=="12"){
		$showmon="ธันวาคม";																				
	}
	
						
	$thyear = $_POST["selyear"];
	$ksyear = $_POST["selyear"]-543;
	
	// ห้วงเวลา
	// รายชื่อผู้นวด
	$date_between = " AND `date` >= '$thyear-$selmon-01' AND `date` <= '$thyear-$selmon-31'";
	
	$sql = "SELECT `staf_massage` 
	FROM `depart` 
	WHERE `staf_massage` !='' 
	$date_between 
	GROUP BY `staf_massage` ";
	$query = mysql_query($sql);
	$num = mysql_num_rows($query);
	while( $row = mysql_fetch_array($query) ){
		$staf_massage = $row["staf_massage"];
		?>
		<div id="printable"> 
			<p align="center"><strong>รายชื่อผู้มารับบริการนวดแผนไทย</strong></p>
			<div style="margin-left: 5%;"><strong>ชื่อพนักงานนวด : </strong><?=$staf_massage;?></div>
			<div style="margin-left: 5%;"><strong>ประจำเดือน <?=$showmon;?> พ.ศ. <?=$thyear;?></div>
			<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
				<thead>
					<tr bgcolor="#FFCCCC">
						<th width="8%" align="center"><strong>ลำดับ</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>วัน/เดือน/ปี</strong></th>
						<th align="center"><strong>HN</strong></th>
						<th align="center"><strong>ชื่อ - นามสกุล</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>การจ่ายยา</strong></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					/* Condition เกี่ยวกับเวลา ควรเปลี่ยนเป็น ค.ศ. เพื่อให้ mysql คำนวณวันที่ได้ถูกต้อง */
					$sql1 = "SELECT b.*, a.`code`
FROM `patdata` AS a, (

	SELECT *, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, 
	CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) AS `date2`, 
	DATE_FORMAT( CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name` 
	FROM `depart` 
	WHERE `staf_massage` !='' 
	$date_between

) AS b 
WHERE b.`row_id` = a.`idno` 
AND a.`code` in (
	'58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a'
) 
AND b.`staf_massage` = '$staf_massage'
AND a.`status` = 'Y'
ORDER BY b.`date` ASC";
				// echo "<pre>";
				//var_dump($sql1);
				// echo "<pre>";
				
				$result = mysql_query($sql1) or die( mysql_error() ); 
				$i = 0;
				while($rows = mysql_fetch_array($result)){
					
					// 0 is Sunday
					// 6 is Saturday
					// ถ้าเข้าเคส จันทร์ ถึง ศุกร์ และอยู่ในช่วงเวลาราชการให้ผ่านไปเลย ไม่นับ
					// @todo เซิฟเวอร์มีปัญหาเรื่องเวลาเร็วไป 20 นาที ถ้าเซิฟปรับแล้วโค้ดนี้ก็ต้องปรับเวลาตามด้วย
					$dayNum = (int) $rows['day_name'];
					if( ( $dayNum > 0 AND $dayNum < 6 ) AND ( $rows['time'] >= "08:20:00" AND $rows['time'] <= "16:20:00" ) ){
						continue;
					}
					
					$qdate = substr($rows["date"],0,10);
					list($yy,$mm,$dd) = explode("-",$qdate);
					$dateshow = "$dd/$mm/$yy";
					// $showtime = substr($rows["date"],11,8);
					
					$i++;
					
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td align="center"><?=$dateshow;?></td>
						<td><?=$rows["hn"];?></td>
						<td align="left"><?=$rows["ptname"];?></td>
						<?php
						$sql3="select * from drugrx where date like '$qdate%' and hn='".$rows["hn"]."'";
						$query3=mysql_query($sql3);
						$num3=mysql_num_rows($query3);
						if(empty($num3)){
							$showdrug="";
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

