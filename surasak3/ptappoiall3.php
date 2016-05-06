<?php
// Update 31 พค 2553 
//bbm
$appd = isset($_GET['appd']) ? trim($_GET['appd']) : false ;
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<font face='Angsana New'><b>รายชื่อคนไข้นัดตรวจ</b><br>";
print "<b>การนัด:</b> $detail <br>"; 

print "<b>นัดมาวันที่</b> $appd<br> ";
print "วัน/เวลาทำการตรวจสอบ....$Thaidate"; 

?>
<style type="text/css">
*{
	font-family: Angsana New;
	font-size: 20px;
}
table{
	width: 100%;
	border-left: 1px solid #ffffff
	border-top: 1px solid #ffffff;
	border-collapse: collapse;
	border-spacing: 0;
}
table td,
table th{
	border-right: 1px solid #ffffff;
	border-bottom: 1px solid #ffffff;
	column-span: none;
	vertical-align: bottom;
}
table th{
	background-color: #EDEDED;
	font-weight: bold;
	vertical-align: middle;
}
.theBlocktoPrint {
	background-color: #000; 
	color: #FFF; 
}
a{
	text-decoration: underline;
}
@media print{
	#no_print{display:none;}
}
</style>
<br />
<a href="vnprintday.php?nat=<?=$appd?>&detail=<?=$detail?>">พิมพ์ใบตรวจโรค</a>

<table>
	<tr>
		<th bgcolor="6495ED">#</th>
		<th bgcolor="6495ED">HN</th>
		<th bgcolor="6495ED"><font face='Angsana New'>ชื่อ</th>
		<th bgcolor="6495ED"><font face='Angsana New'>เวลานัด</th>
		<th bgcolor="6495ED">ผลการค้นหาประวัติ</th>
		<th bgcolor="6495ED">หมายเหตุ</th>
		<th bgcolor="6495ED">วันที่นัด</th>
	</tr>
	<?php
	include("connect.inc");
	
	if(substr($_GET["detail"],0,4) == "FU07"){
		$sort = "Order by apptime ASC ";
	}else{
		$sort = "Order by hn ";
	}
	
	// Query ตัวเก่า
	// $query = "SELECT hn,ptname,apptime,came,row_id,age,date_format(date,'%d-%m-%Y') 
	// FROM appoint 
	// WHERE appdate = '$appd' 
	// and detail = '$detail' ".$sort;
	
	$query = "SELECT a.`hn`,a.`ptname`,a.`apptime`,a.`came`,a.`row_id`,a.`age`,date_format(a.`date`,'%d-%m-%Y')
FROM `appoint` AS a 
INNER JOIN (
	SELECT `row_id`,`hn`, MAX(`row_id`) AS `id`
	FROM `appoint` 
	WHERE `appdate` = '$appd' 
	GROUP BY `hn` 
) AS b ON b.`id` = a.`row_id` 
WHERE a.`detail` = '$detail' 
";
	$result = mysql_query($query) or die("Query failed");

	
	$date_now = date("d-m-").(date("Y")+543);
	
	$cancel_date = array();
	$user_lists = array();
	while (list ($hn,$ptname,$apptime,$came,$row_id,$age, $date) = mysql_fetch_row ($result)) {
		
		if($date_now == $date){
			$bgcolor = "FFA8A8";
		}else{
			$bgcolor = "66CDAA";
		}
		
		list($key_year, $hn_key) = explode('-', $hn);
		$key = $key_year.sprintf("%08d", intval($hn_key));
		
		$user_lists[$key] = array(
			'hn' => $hn,
			'ptname' => $ptname,
			'apptime' => $apptime,
			'detail' => 'ค้นพบ////ไม่พบ',
			'other' => '...................................................',
			'date' => $date,
			'sort_hn' => $key
		);
	}
	
	// เรียงจากน้อยไปหามากตาม sort_hn
	function sorthn($a, $b){
		return $a['sort_hn'] - $b['sort_hn'];
	}
	usort($user_lists, "sorthn");
	
	$order = 1;
	foreach($user_lists as $key => $user){
		
		// แยกยกเลิกนัด
		if( $user['apptime'] === 'ยกเลิกการนัด' ){
			$cancel_date[] = $user;
			continue;
		}
		
		?>
		<tr bgcolor="66CDAA">
			<td><?=$order;?></td>
			<td><?=$user['hn'];?></td>
			<td><?=$user['ptname'];?></td>
			<td><?=$user['apptime'];?></td>
			<td><?=$user['detail'];?></td>
			<td><?=$user['other'];?></td>
			<td><?=$user['date'];?></td>
		</tr>
		<?php
		$order++;
	}
?>
</table>

<?php
if ( count($cancel_date) > 0 ) {
?>
<h3>รายชื่อผู้ป่วยยกเลิกนัด</h3>
<table>
	<thead>
		<tr bgcolor="6495ED">
			<th>#</th>
			<th>HN</th>
			<th>ชื่อ</th>
			<th>เวลานัด</th>
			<th>ผลการค้นหาประวัติ</th>
			<th>หมายเหตุ</th>
			<th>วันที่นัด</th>
		</tr>
	</thead>
	<tbody>
		<?php
		$i = 1;
		foreach ($cancel_date as $key => $item) {
			?>
			<tr bgcolor="66CDAA">
				<td><?=$i;?></td>
				<td><?=$item['hn'];?></td>
				<td><?=$item['ptname'];?></td>
				<td><?=$item['apptime'];?></td>
				<td><?=$item['detail'];?></td>
				<td><?=$item['other'];?></td>
				<td><?=$item['date'];?></td>
			</tr>
			<?php
			$i++;
		}
		?>
		
	</tbody>
</table>

<?php
}

if($detail=='FU18 ไตเทียม'){

	include("connect.inc");
	
	$subappd=explode(' ',$appd);
	
	switch($subappd[1]){
		case "มกราคม": $printmonth = "01"; break;
		case "กุมภาพันธ์": $printmonth = "02"; break;
		case "มีนาคม": $printmonth = "03"; break;
		case "เมษายน": $printmonth = "04"; break;
		case "พฤษภาคม": $printmonth = "05"; break;
		case "มิถุนายน": $printmonth = "06"; break;
		case "กรกฏาคม": $printmonth = "07"; break;
		case "สิงหาคม": $printmonth = "08"; break;
		case "กันยายน": $printmonth = "09"; break;
		case "ตุลาคม": $printmonth = "10"; break;
		case "พฤศจิกายน": $printmonth = "11"; break;
		case "ธันวาคม": $printmonth = "12"; break;
	}
	$newappd=$subappd[2].'-'.$printmonth.'-'.$subappd[0];
	
	$sqltem="CREATE TEMPORARY TABLE  appoint1  Select * from  appoint  WHERE  `detail` 
	LIKE  '%ไตเทียม%' AND appdate ='$appd' ";
	$querytem = mysql_query($sqltem);
	
	$sqltime="SELECT COUNT( * ) AS cnum, apptime
	FROM  `appoint1` 
	GROUP BY apptime";
	$querytime = mysql_query($sqltime);
	
	?>
	<hr />
	<br />
	<table border="1" style="border-collapse:collapse" bordercolor="#666666" cellpadding="0" cellspacing="0"> 
	<?php 
	$n=1;
	$i=1;
	while($arrtime = mysql_fetch_array($querytime)){
	
		echo "<tr><td colspan='5' align='center'  bgcolor=\"#00CCFF\"><b>ช่วงที่  ".$i.' </b>  เวลา   '.$arrtime['apptime'].'  มี '.$arrtime['cnum']." คน</tr></td>";
		echo "<tr bgcolor='#CCCCCC'>
		<td align='center'>ลำดับ</td>
		<td align='center'>ชื่อ-สกุล</td>
		<td align='center'>HN</td>
		<td align='center'>VN</td>
		<td align='center'>สิทธิ</td>
		</tr>";
		
		$show="SELECT * FROM  appoint1 WHERE  apptime ='".$arrtime['apptime']."'";
		$queryshow=mysql_query($show);
		$rows=mysql_num_rows($queryshow);
		while($arrshow=mysql_fetch_array($queryshow)){
		
			$ptright="SELECT * FROM  `opday` WHERE  `hn` =  '".$arrshow['hn']."'  and thidate like '$newappd%'  limit 0,1";
			$querypt=mysql_query($ptright);
			$arrpt=mysql_fetch_array($querypt);
			if($n>$rows){
				$n=1;
			}
			print " <tr>
			<td><font face='Angsana New'>$n</td>
			<td><font face='Angsana New'>$arrshow[ptname]</td>
			<td><font face='Angsana New'>$arrshow[hn]</td>
			<td align='center'><font face='Angsana New' >$arrpt[vn]</td>
			<td><font face='Angsana New'>$arrpt[ptright]</td>
			</tr>"; 
			$n++;
		}
		$i++;
	}
	
	echo "</table>";
	
	include("unconnect.inc");
}
?>

