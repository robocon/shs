<?php
include("connect.inc");  
$month["01"] = "���Ҥ�";
$month["02"] = "����Ҿѹ��";
$month["03"] = "�չҤ�";
$month["04"] = "����¹";
$month["05"] = "����Ҥ�";
$month["06"] = "�Զع�¹";
$month["07"] = "�á�Ҥ�";
$month["08"] = "�ԧ�Ҥ�";
$month["09"] = "�ѹ��¹";
$month["10"] = "���Ҥ�";
$month["11"] = "��Ȩԡ�¹";
$month["12"] = "�ѹ�Ҥ�";

function thaiNumber($str){
	$en_num = array(1,2,3,4,5,6,7,8,9,0);
	$th_num = array('�','�','�','�','�','�','�','�','�','�');
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
		<TD>��§ҹ��õ�Ǩ�ä����¡�͹ࡳ����� (��辺�����Դ����)</TD>
	</TR>
	<TR class="font_hd1" align='center'>
		<TD>��Шӻ� ...........</TD>
	</TR>
	<TR class="font_hd1" align='center'>
		<TD>�ç��Һ�Ť�������ѡ��������  ��.�</TD>
	</TR>
</table>
<table width="100%" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
	<thead>
		<tr class="font_hd">
			<th width="2%">�ӴѺ</th>
			<th width="15%">����-ʡ��</th>
			<th>�ä����Ǩ��</th>
			<th width="14%">�������ǧ��Ѻ��� �� �.�. ���� ��Щ�Ѻ��䢷�� �� �.�. ����</th>
			<th width="14%">���ᾷ�����Ǩ</th>
			<th width="15%">�������ҷ���</th>
			<th width="8%">�.�.�. ����Ѻ��õ�Ǩ</th>
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
	// 	( a.organ LIKE '%�Ѻ�ͧ%' AND a.organ LIKE '%����%' AND a.organ LIKE '%ࡳ%' ) 
	// 	OR ( a.organ LIKE '%�Ѻ�ͧ%' AND a.organ LIKE '%���͡����%' ) 
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
			( `organ` LIKE '%�Ѻ�ͧ%' AND `organ` LIKE '%��ࡳ%' )
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