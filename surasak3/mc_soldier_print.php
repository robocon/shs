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
?>
<style>
	.font_tr{ font-family:"THSarabunPSK"; font-size:20px; background-color:"#FFFFFF"; }
	.font_hd{ font-family:"THSarabunPSK"; font-size:20px; background-color:"#FFFFFF"; }
	.font_hd1{ font-family:"THSarabunPSK"; font-size:23px; background-color:"#FFFFFF"; }
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
 <tr class="font_hd">
<th width="2%">ลำดับ</th>
		<th width="15%">ชื่อ-สกุล</th>
		<th>โรคที่ตรวจพบ</th>
		<th width="14%">ตามกฏทรวงฉบับที่ ๗๔ พ.ศ. ๒๕๔๐ 
		และฉบับแก้ไขที่ ๗๖ พ.ศ. ๒๕๕๕</th>
		<th width="14%">คณะแพทย์ผู้ตรวจ</th>
		<th width="15%">ภูมิลำเนาทหาร</th>
		<th width="8%">ว.ด.ป. ที่รับการตรวจ</th>
</tr>

<?php

  $num=0;

    include("connect.inc");


$where = " AND (thidate between '".$_GET["sd"]." 00:00:00' AND '".$_GET["ed"]." 23:59:00' ) ";

// $sql = "SELECT row_id, date_format(thidate,'%d-%m-%Y'), hn, ptname, organ, dx_mc_soldier, dr1_mc_soldier, dr2_mc_soldier, dr3_mc_soldier,address,thdatehn,rule FROM opd WHERE (dx_mc_soldier is not null AND dx_mc_soldier != '' ) ".$where." Order by  thidate ASC ";
$sql = "
		SELECT a.row_id, date_format(a.thidate,'%d-%m-%Y'), a.hn, a.ptname, a.organ, a.dx_mc_soldier, a.dr1_mc_soldier, a.dr2_mc_soldier, a.dr3_mc_soldier, a.address, a.thdatehn, a.rule 
		, b.idcard
	FROM opd AS a
	LEFT JOIN opcard AS b ON b.hn = a.hn 
	WHERE (
		( a.organ LIKE '%รับรอง%' AND a.organ LIKE '%ทหาร%' AND a.organ LIKE '%เกณ%' ) 
		OR ( a.organ LIKE '%รับรอง%' AND a.organ LIKE '%เลือกทหาร%' ) 
		OR a.toborow like 'EX30%'
	) 
	AND dx_mc_soldier IS NOT NULL 
	AND dx_mc_soldier != ''
	".$where." ORDER BY thidate ASC ";
$result = mysql_query($sql) or die("Query failed ".mysql_error());

   
 while (list ($row_id, $date,$hn,$ptname,$organ, $dx_mc_soldier, $dr1_mc_soldier, $dr2_mc_soldier, $dr3_mc_soldier,$address1,$thdatehn,$rule,$idcard) = mysql_fetch_row ($result)) 
{
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
			<td><?php echo $ptname;?><br><?php echo $idcard;?></td>
			<td><?php echo $dx_mc_soldier;?></td>
			<td><?php echo $rule;?></td>
			<td><?php echo $dr1."<br>".$dr2."<br>".$dr3;?></td>
			<td><?php echo $address1;?></td>
			<td><?php echo $thdatehn;?></td>
		</tr>
		<?php
 }

include("unconnect.inc");

?>
</table>