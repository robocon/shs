<?php
include("connect.inc");  
$month["01"] = "มกราคม";
$month["02"] = "กุมภาพันธ์";
$month["03"] = "มีนาคม";
$month["04"] = "เมษายน";
$month["05"] = "พฤษภาคม";
$month["06"] = "มิถุนายน";
$month["07"] = "กรกฏาคม";
$month["08"] = "สิงหาคม";
$month["09"] = "กันยายน";
$month["10"] = "ตุลาคม";
$month["11"] = "พฤศจิกายน";
$month["12"] = "ธันวาคม";

function thaiNumber($str){
	$en_num = array(1,2,3,4,5,6,7,8,9,0);
	$th_num = array('๑','๒','๓','๔','๕','๖','๗','๘','๙','๐');
	return str_replace($en_num, $th_num, $str);
}
?>
<style>
.font_tr{ font-family:"TH SarabunPSK"; font-size:20px; background-color:"#FFFFFF"; }
.font_hd{ font-family:"TH SarabunPSK"; font-size:20px; background-color:"#FFFFFF"; }
.font_hd1{ font-family:"TH SarabunPSK"; font-size:23px; background-color:"#FFFFFF"; }
</style>
<table width="100%" border="0" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<TR class="font_hd1" align='center'>
		<TD>รายงานการตรวจโรคชายไทยก่อนเกณฑ์ทหาร (พี่พบความผิดปกติ)</TD>
	</TR>
	<TR class="font_hd1" align='center'>
		<TD>ประจำปี ...........</TD>
	</TR>
	<TR class="font_hd1" align='center'>
		<TD>โรงพยาบาลค่ายสุรศักดิ์มนตรี  ทภ.๓</TD>
	</TR>
</table>
<table width="100%" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<thead>
		<tr class="font_hd">
			<th width="2%">ลำดับ</th>
			<th width="15%">ชื่อ-สกุล</th>
			<th>โรคที่ตรวจพบ</th>
			<th width="14%">ตามกฏทรวงฉบับที่ ๗๔ พ.ศ. ๒๕๔๐ และฉบับแก้ไขที่ ๗๖ พ.ศ. ๒๕๕๕</th>
			<th width="14%">คณะแพทย์ผู้ตรวจ</th>
			<th width="15%">ภูมิลำเนาทหาร</th>
			<th width="8%">ว.ด.ป. ที่รับการตรวจ</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$num=0;
	$where = " AND (thidate between '".$_GET["sd"]." 00:00:00' AND '".$_GET["ed"]." 23:59:00' ) ";

	$ymd_start = $_GET["sd"];
	$ymd_end = $_GET["ed"];

	// $sql = "SELECT row_id, date_format(thidate,'%d-%m-%Y'), hn, ptname, organ, dx_mc_soldier, dr1_mc_soldier, dr2_mc_soldier, dr3_mc_soldier,address,thdatehn,rule FROM opd WHERE (dx_mc_soldier is not null AND dx_mc_soldier != '' ) ".$where." Order by  thidate ASC ";
	// $sql = "
	// SELECT a.row_id, date_format(a.thidate,'%d-%m-%Y'), a.hn, a.ptname, a.organ, a.dx_mc_soldier, a.dr1_mc_soldier, a.dr2_mc_soldier, a.dr3_mc_soldier, a.address, a.thdatehn, a.rule 
	// , b.idcard
	// FROM opd AS a
	// LEFT JOIN opcard AS b ON b.hn = a.hn 
	// WHERE (
	// 	( a.organ LIKE '%รับรอง%' AND a.organ LIKE '%ทหาร%' AND a.organ LIKE '%เกณ%' ) 
	// 	OR ( a.organ LIKE '%รับรอง%' AND a.organ LIKE '%เลือกทหาร%' ) 
	// 	OR a.toborow like 'EX30%'
	// ) 
	// AND dx_mc_soldier IS NOT NULL 
	// AND dx_mc_soldier != ''
	// ".$where." 
	// ORDER BY thidate ASC ";

	$sql = "SELECT b.`row_id`,b.`hn`,b.`ptname`,b.`thdatehn`,b.`organ`,b.`dx_mc_soldier`,b.`dr1_mc_soldier`,b.`dr2_mc_soldier`,b.`dr3_mc_soldier`,b.`rule`,
	CONCAT(c.`address`,' ',c.`tambol`,' ',c.`ampur`,' ',c.`changwat`) AS `address`,
	CONCAT(SUBSTRING(b.`thidate`,9,2),'-',SUBSTRING(b.`thidate`,6,2),'-',SUBSTRING(b.`thidate`,1,4)) AS `date`,
	c.`idcard`
	FROM 
	(
		SELECT MAX(`row_id`) AS `opd_id`
		FROM `opd` 
		WHERE `thidate` >= '$ymd_start' AND `thidate` <= '$ymd_end' 
		AND (
			( `organ` LIKE '%รับรอง%' AND `organ` LIKE '%งดเกณ%' )
			OR `toborow` LIKE 'EX30%' 
		)
		GROUP BY `hn`
	) AS a 
	LEFT JOIN `opd` AS b ON b.`row_id` = a.`opd_id` 
	LEFT JOIN `opcard` AS c ON c.`hn` = b.`hn`";

	$result = mysql_query($sql) or die("Query failed ".mysql_error());
	while ( $item = mysql_fetch_assoc($result)) 
	{
		$row_id = $item['opd_id'];
		$date = $item['date'];
		$hn = $item['hn'];
		$ptname = $item['ptname'];
		$organ = $item['organ'];
		$dx_mc_soldier = $item['dx_mc_soldier'];
		$dr1_mc_soldier = $item['dr1_mc_soldier'];
		$dr2_mc_soldier = $item['dr2_mc_soldier'];
		$dr3_mc_soldier = $item['dr3_mc_soldier'];
		$address1 = $item['address'];
		$thdatehn = $item['thdatehn'];
		$rule = $item['rule'];
		$idcard = $item['idcard'];

		if( empty($dx_mc_soldier) ){
			continue;
		}

		$Total =$Total+$amount; 
		list($address) = mysql_fetch_row(mysql_query("Select concat(address,' ', tambol,' ',  ampur,' ',  changwat  ) From opcard where hn = '".$hn."' limit 0,1 "));
		$thdatehn=substr($thdatehn,0,10);
		
		$num++;
		$dr1 = preg_replace('/MD\d+\s/', '', $dr1_mc_soldier);
		$dr2 = preg_replace('/MD\d+\s/', '', $dr2_mc_soldier);
		$dr3 = preg_replace('/MD\d+\s/', '', $dr3_mc_soldier);
		
		?>
		<tr class="font_tr">
			<td align="center"><?php echo $num;?></td>
			<td><?php echo $ptname;?><br><?php echo thaiNumber($idcard);?></td>
			<td>
				<?php 
				echo thaiNumber($dx_mc_soldier);
				?>
			</td>
			<td><?php echo thaiNumber($rule);?></td>
			<td><?php echo $dr1."<br>".$dr2."<br>".$dr3;?></td>
			<td><?php echo thaiNumber($address1);?></td>
			<td><?php echo thaiNumber($thdatehn);?></td>
		</tr>
		<?php
	}

	include("unconnect.inc");

	?>
</tbody>
</table>