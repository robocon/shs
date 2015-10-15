<?php
session_start();
require "../connect.php";
require "../includes/functions.php";

// Verify user before load content
if(!authen()) die('หมดระยะเวลาการใช้งาน <a href="login.php">คลิกที่นี่</a> เพื่อเข้าสู่ระบบอีกครั้ง');

require "header.php";

$sql="
CREATE TEMPORARY TABLE `hypertension_history_temp` 
SELECT `thidate`, `hn`, `bp1`, `bp2`, `organ`
FROM `hypertension_history` 
WHERE `thidate` LIKE '2015%'
AND (`bp1` !='' OR `bp2` !='')
";
mysql_query($sql);

$sql="
CREATE TEMPORARY TABLE `opd_temp` 
SELECT `thidate`, `hn`, `bp1`, `bp2`, `organ`
FROM `opd` 
WHERE `thidate` LIKE '2558%'
AND (`bp1` !='' OR `bp2` !='')
";
mysql_query($sql);

$tbsql="
SELECT * FROM `hypertension_clinic` 
WHERE `thidate` BETWEEN '2015-07-01' AND '2015-09-31'
ORDER BY `joint_disease` DESC, `thidate` ASC
";
$tbquery=mysql_query($tbsql);
$tbnum=mysql_num_rows($tbquery);
?> 
<p align="center"><strong>รายงานผู้ป่วย HT ประจำปีงบประมาณ 2558</strong></p>
<table width="100%" border="1" cellpadding="3" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
	<tr>
		<td width="3%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
		<td width="5%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
		<td width="13%" align="center" bgcolor="#66CC99"><strong>ชื่อ-นามสกุล</strong></td>
		<td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการรักษา</strong></td>
		<td width="13%" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
		<td width="15%" align="center" bgcolor="#66CC99"><strong>โรคร่วม HT </strong></td>
		<td width="14%" align="center" bgcolor="#66CC99">
			<strong>
			<div>มีโรคร่วม</div>
			<div>ความดันโลหิต 3 ครั้งสุดท้ายติดต่อกัน &lt; 130/80 mmHg.</div>
			</strong>
		</td>
		<td width="14%" align="center" bgcolor="#66CC99">
			<strong>
			<div>ไม่มีโรคร่วม</div>
			<div>ความดันโลหิต 3 ครั้งสุดท้ายติดต่อกัน &lt; 140/90 mmHg.</div>
			</strong>
		</td>
		<td width="10%" align="center" bgcolor="#66CC99"><strong>ผป.มาตรวจตามนัด</strong></td>
	</tr>
<?php
if($tbnum < 1){
	echo "<tr><td colspan='8' align='center' style='color:red;'>------------------------ ไม่มีข้อมูล ------------------------</td></tr>";
}else{
	$i=0;
	while($tbrows=mysql_fetch_array($tbquery)){
		
	$i++;
	$sql=mysql_query("select idguard, camp from opcard where hn='".$tbrows["hn"]."'");
	list($idguard, $camp)=mysql_fetch_array($sql);
	/*		if($camp=="M01 พลเรือน" && $idguard !="MX01 ทหาร/ครอบครัว"){
	$idguard="MX00 บุคคลทั่วไป";
	}*/
	
	$test_guard = preg_match('/MX.+/', $idguard);
	?>
	<tr>
		<td align="center" bgcolor="#CCFFCC"><?=$i;?></td>
		<td align="left" bgcolor="#CCFFCC"><?=$tbrows["hn"];?></td>
		<td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptname"];?></td>
		<td align="left" bgcolor="#CCFFCC"><?=$tbrows["ptright"];?></td>  
		<td align="left" bgcolor="#CCFFCC"><?php if( $test_guard > 0 ) echo $idguard;?></td>
		<td align="left" bgcolor="#CCFFCC">
			<?php
			/* โรคร่วม HT */
			if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
				
				$joint_disease_list = array();
				if($tbrows["joint_disease_dm"]=="Y"){
					$joint_disease_list[] = "เบาหวาน";
				}
				if($tbrows["joint_disease_nephritic"]=="Y"){
					$joint_disease_list[] = "ไตเรื้อรัง";
				}
				if($tbrows["joint_disease_myocardial"]=="Y"){
					$joint_disease_list[] = "กล้ามเนื้อหัวใจตาย";
				}
				if($tbrows["joint_disease_paralysis"]=="Y"){
					$joint_disease_list[] = "อัมพฤกษ์อัมพาต";
				}	
				
				echo 'มีโรคร่วม ('.implode(',', $joint_disease_list).')';
				
			}else{
				echo 'ไม่มีโรคร่วม';
			}
			?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
			<?php
			if($tbrows["joint_disease_dm"]=="Y" || $tbrows["joint_disease_nephritic"]=="Y" || $tbrows["joint_disease_myocardial"]=="Y" || $tbrows["joint_disease_paralysis"]=="Y"){
				
				$sql = "
				SELECT thidate, bp1, bp2
				FROM hypertension_history_temp
				WHERE hn = '".$tbrows['hn']."' 
				ORDER  BY thidate DESC LIMIT 3
				";
				$query = mysql_query($sql);
				$rownum = mysql_num_rows($query);
				if( !$rownum ){
					$sql="SELECT thidate, bp1, bp2 
					FROM opd_temp 
					WHERE hn = '".$tbrows["hn"]."' 
					ORDER  BY thidate DESC LIMIT 3";
					
					$query=mysql_query($sql);
					$rownum=mysql_num_rows($query);
				}
				
				if($rownum < 3){
					if($rownum < 1){
						echo "ไม่ได้ตรวจ";
					}else{
						echo "ตรวจไม่ถึง 3 ครั้ง";
					}
				}else{ // ถ้ามาตรวจเกิน >= 3 ครั้ง
					$num=0;
					while($rows=mysql_fetch_array($query)){
						if($rows["bp1"] < 130 && $rows["bp2"] < 80){
							$code="y";
							$num++;
						}else{
							$code="n";
						}	
					}  //close while
					
					// ถ้าสามครั้งสุดท้ายความดันเกิน 130/80
					if($num==3){
						echo "1";
					}else{
						echo "0";
					}
				}
			}
			?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
		<?php
		if($tbrows["joint_disease_dm"]=="" && $tbrows["joint_disease_nephritic"]=="" && $tbrows["joint_disease_myocardial"]=="" && $tbrows["joint_disease_paralysis"]==""){
			
			$sql = "
			SELECT thidate, bp1, bp2
			FROM hypertension_history_temp
			WHERE hn = '".$tbrows['hn']."' 
			ORDER  BY thidate DESC LIMIT 3
			";
			$query = mysql_query($sql);
			$rownum = mysql_num_rows($query);
			if( !$rownum ){
				$sql="SELECT thidate, bp1, bp2 
				FROM opd_temp 
				WHERE hn = '".$tbrows["hn"]."' 
				ORDER  BY thidate DESC LIMIT 3";
				
				$query=mysql_query($sql);
				$rownum=mysql_num_rows($query);
			}
				
			if($rownum < 3){
				if($rownum < 1){
					echo "ไม่ได้ตรวจ";
				}else{
					echo "ตรวจไม่ถึง 3 ครั้ง";
				}
			}else{
				$num=0;
				while($rows=mysql_fetch_array($query)){
					if($rows["bp1"] < 140 && $rows["bp2"] < 90){
						$code="y";
						$num++;
					}else{
						$code="n";
					}
				}  //close while
				if($num==3){
					echo "1";
				}else{
					echo "0";
				}
			}		
		}
		?>
		</td>
		<td align="center" bgcolor="#CCFFCC">
			<?php
			$sql="
			SELECT thidate, bp1, bp2, organ 
			FROM opd_temp 
			WHERE hn = '".$tbrows["hn"]."' 
			AND organ like '%ตรวจตามนัด%' 
			ORDER  BY thidate DESC LIMIT 1";
			$query=mysql_query($sql);
			$recode=mysql_num_rows($query);
			if(!empty($recode)){
				echo "1";
			}else{
				echo "0";
			}
			?>
		</td>
	</tr>
	<?php
	} // End While
}
?>
<?php
require "footer.php";
?>