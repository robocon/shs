<?php
include 'connect.inc';  
include 'includes/functions.php';

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
?>
<style type="text/css">
	.font_tr{ font-family:"TH SarabunPSK"; font-size:20px; background-color:"#F5DEB3"; }
	.font_hd{ font-family:"TH SarabunPSK"; font-size:20px; background-color:"#CD853F"; }

	table, tr, td, th{
		border: 1px solid black;
	}
	table{
		border-collapse: collapse; 
		border-spacing: 0; 
	}
	#soldier_header,
	#soldier_header tr,
	#soldier_header td{
		border: 0;
	}
	@media print{
		.disappear{
			display: none;
		}
		#soldier_header{
			display: block!important;
		}
	}
</style>

<p class="disappear">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;��ª��ͼ���Ң���Ѻ�ͧ��ࡳ�����</p>
<form name="ff1" method="post" action="mc_soldier.php" class="disappear">
	<TABLE>
	<TR id="row2" >
		<TD align="right">������ѹ��� :</TD>
		<TD>
			<INPUT TYPE="text" NAME="start_day" value="<?php if(isset($_POST["start_day"])) echo $_POST["start_day"]; else echo date("d");?>" size="2" maxlength="2"> / 
			<SELECT NAME="start_month">
				<?php
				foreach($month as $value => $index){
					echo "<OPTION VALUE=\"",$value,"\" ";
					if($_POST["start_month"] == $value){ echo " Selected ";}
					else if( !isset($_POST["start_month"]) && date("m") == $value){ echo " Selected ";}
					echo ">",$index;
				}
				?>
			</SELECT> / 
			<INPUT TYPE="text" NAME="start_year" value="<?php if(isset($_POST["start_year"])) echo $_POST["start_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4">
		</TD>
	</TR>
	<TR id="row3">
	<TD align="right">�֧�ѹ��� :</TD>
	<TD><INPUT TYPE="text" NAME="end_day" value="<?php if(isset($_POST["end_day"])) echo $_POST["end_day"]; else echo date("d");?>" size="2" maxlength="2"> / 
	<SELECT NAME="end_month">
	<?php
	foreach($month as $value => $index){
		echo "<OPTION VALUE=\"",$value,"\" ";
		if($_POST["end_month"] == $value){ echo " Selected ";}
		else if( !isset($_POST["end_month"]) && date("m") == $value) echo " Selected ";
		echo ">",$index;

	}
	?>
	</SELECT> / 
	<INPUT TYPE="text" NAME="end_year" value="<?php if(isset($_POST["end_year"])) echo $_POST["end_year"]; else echo date("Y")+543;?>"  size="4" maxlength="4"></TD>
	</TR>
	</TABLE>

 	<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
 
	<input type="submit" value="      ��ŧ      " name="B1">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	<INPUT TYPE="button" value="Print" Onclick="window.open('mc_soldier_print.php?sd='+document.ff1.start_year.value+'-'+document.ff1.start_month.value+'-'+document.ff1.start_day.value+'&ed='+document.ff1.end_year.value+'-'+document.ff1.end_month.value+'-'+document.ff1.end_day.value+'');">
	
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 	
</form>
<div class="disappear">
	<a target=_self  href='../nindex.htm'><<�����</a> | 
	<a href="mc_test.php" target="_blank">�к���Ǩ�ͺ�����ŧ����ࡳ�����</a>
</div>
<?php

if( !empty($B1) ){
	
	$ymd_start = $_POST["start_year"]."-".$_POST["start_month"]."-".$_POST["start_day"]." 00:00:00";
	$ymd_end = $_POST["end_year"]."-".$_POST["end_month"]."-".$_POST["end_day"]." 23:59:59";

/*	$sql = "SELECT b.`row_id`,b.`hn`,b.`ptname`,b.`thdatehn`,b.`organ`,b.`dx_mc_soldier`,b.`dr1_mc_soldier`,b.`dr2_mc_soldier`,b.`dr3_mc_soldier`,b.`rule`,
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
	LEFT JOIN `opcard` AS c ON c.`hn` = b.`hn`";*/
	
	$sql = "SELECT *, CONCAT(SUBSTRING(a.`thidate`,9,2),'-',SUBSTRING(a.`thidate`,6,2),'-',SUBSTRING(a.`thidate`,1,4)) AS `date`, CONCAT(b.`address`,' ',b.`tambol`,' ',b.`ampur`,' ',b.`changwat`) AS `address`  
	FROM `opday` as a 
	LEFT JOIN `opcard` AS b ON a.`hn` = b.`hn` 
	WHERE a.`thidate` >= '$ymd_start' 
	AND a.`thidate` <= '$ymd_end' 
	AND a.`toborow` LIKE 'EX30%' 
	group by a.hn 
	order by a.thidate desc";	
	
	//echo $sql;


	$notPassed = 0;
	$num = 0;
	$result = mysql_query($sql) or die("Query failed: ".mysql_error());
	?>
	<table style="">
		<thead>
			<tr class="font_hd">
				<th width="2%">�ӴѺ</th>
				<th width="15%">����-ʡ��</th>
				<th>�ä����Ǩ��</th>
				<th width="15%">�������ǧ��Ѻ��� �� �.�. ����<br />
				��Щ�Ѻ��䢷�� �� �.�. ����</th>
				<th width="12%">���ᾷ�����Ǩ</th>
				<th width="15%">�������ҷ���</th>
				<th width="5%">�.�.�. ����Ѻ��õ�Ǩ</th>
				<th class="disappear">����/��䢢�����</th>
			</tr>
		</thead>
		<tbody>
	<?php


	while ( $item = mysql_fetch_assoc($result)) 
	{
		
	$sql1="select * from opd where hn='$item[hn]' and thdatehn='$item[thdatehn]' ";
	$query1=mysql_query($sql1);
	$rows=mysql_fetch_array($query1);		
		
		$row_id = $rows['row_id'];
		$date = $item['date'];
		$hn = $item['hn'];
		$ptname = $item['ptname'];
		$organ = $item['organ'];
		$dx_mc_soldier = $rows['dx_mc_soldier'];
		$dr1_mc_soldier = $rows['dr1_mc_soldier'];
		$dr2_mc_soldier = $rows['dr2_mc_soldier'];
		$dr3_mc_soldier = $rows['dr3_mc_soldier'];
		$address = $item['address'];
		$thdatehn = $item['thdatehn'];
		$rule = $rows['rule'];
		$idcard = $item['idcard'];

		$Total = $Total+$amount; 
		// $sql = "Select concat(address,' ',tambol,' ',ampur,' ',changwat) 
		// From opcard 
		// where hn = '".$hn."' 
		// limit 0,1 ";
		// list($address) = mysql_fetch_row(mysql_query($sql));


		// $thdatehn = substr($thdatehn,0,10);
		$num++;
		
		$dr1 = preg_replace('/MD\d+\s/', '', $dr1_mc_soldier);
		$dr2 = preg_replace('/MD\d+\s/', '', $dr2_mc_soldier);
		$dr3 = preg_replace('/MD\d+\s/', '', $dr3_mc_soldier);
		
		if( empty($dx_mc_soldier) ){
			$notPassed++;
		}
		
		$style = '';
		if( empty($row_id) OR empty($dx_mc_soldier) ){
			$style = 'disappear';
		}
		?>
		<tr class="font_tr <?=$style;?>">
			<td align="center"><?=to_thai_number($num);?></td>
			<td><?php echo $ptname;?><br><?=to_thai_number($idcard);?></td>
			<td><?php echo $dx_mc_soldier;?></td>
			<td><?php echo $rule;?></td>
			<td><?php echo $dr1."<br>".$dr2."<br>".$dr3;?></td>
			<td><?=to_thai_number($address);?></td>
			<td><?=to_thai_number($date);?></td>
			<td class="disappear">
				<?php
				if( !empty($row_id) ){
					?>
					<a href="edit_report_mc.php?id=<?php echo $row_id;?>" target="_blank">����/��䢢�����</a>
					<?php
				}else{
					?>
					<p>����բ����ūѡ����ѵ�</p>
					<?php
				}
				?>
			</td>
		</tr>
		<?php
	}
	

	?>
		</tbody>
	</table>
	<?php
	if( $num > 0 ){
		$passed = $num - $notPassed;
		?>
		<div class="disappear">
			<h3>��ػ�ʹ</h3>
			<p>�ӹǹ��������Ѻ¡���ࡱ����� <?php echo $passed;?> ��</p>
			<p>�ӹǹ�����������Ѻ¡���ࡱ����� <?php echo $notPassed;?> ��</p>
		</div>
		<?php
	}

}
?>