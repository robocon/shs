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
		<h1 style="text-align: center;">��§ҹ�ǴἹ��<u>��Ш���͹</u>(�͡�����Ҫ���)</h1>
		<input name="act" type="hidden" value="show" />
		<table width="100%" border="0" cellspacing="0" cellpadding="2">
			<tr>
				<td align="center">���͡��͹       
					<?php
					$thaimonthFull = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', 
					'05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', 
					'09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
					
					$selmon = isset($_POST['selmon']) ? $_POST['selmon'] : date('m');
					
					?>
					<select name="selmon" size="1" class="txt">
					<?php
						foreach( $thaimonthFull as $key => $val ){
							$selected = ( $selmon === $key ) ? 'selected="selected"' : '' ;
							?><option value="<?=$key;?>" <?=$selected;?>><?=$val;?></option><?php
						}
					?>
					</select>
					
					�� 
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
					<input type="submit" value="���Ң�����" name="B1"  class="txt" />
					</span>
				</td>
			</tr>
			<tr>
				<td align="center"><a href="../nindex.htm">��Ѻ������ѡ</a>  || <a href="report_ptmonth2.php">��§ҹ�ǴἹ�µ����ǧ���� (�͡�����Ҫ���)</a></td>
			</tr>
		</table>
	</form>
</div> 
<?php
if($_POST["act"]=="show"){

	$selmon = trim($_POST["selmon"]);
	$showmon = $thaimonthFull[$selmon];
	
	$thyear = $_POST["selyear"];
	$ksyear = $_POST["selyear"]-543;
	
	
	$sql = "SELECT `date_holiday` 
	FROM `holiday` 
	WHERE `date_holiday` LIKE '$thyear-$selmon%'";
	$q = mysql_query($sql);
	$holidayLists = array();
	while( $item = mysql_fetch_assoc($q) ){
		$holidayLists[] = $item['date_holiday'];
	}
	
	// Statement ������ code�ͧ�Ǵ ��е�Ƿ��Դ��� 50�ҷ
	$sql = "SELECT a.`row_id`,a.`date`,a.`hn`,a.`ptname`,a.`detail`,a.`staf_massage`,a.`time`,a.`date2`,a.`day_name`,
	SUBSTRING(a.`date`, 1, 10) AS `date3`, 
	b.`row_id`,b.`date`,b.`code`,b.`idno` 
	FROM (
		SELECT *, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, 
		CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) AS `date2`, 
		DATE_FORMAT( CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name` 
		FROM `depart` 
		WHERE `staf_massage` != '' 
		AND `staf_massage` IS NOT NULL 
		AND `date` LIKE '$thyear-$selmon%' 
	) AS a 
	RIGHT JOIN `patdata` AS b ON a.`row_id` = b.`idno` 
	WHERE a.`status` = 'Y' 
	AND b.`code` in (
		'58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a','clinic50'
	) 
	ORDER BY a.`staf_massage` ASC, a.`date` ASC";

$q = mysql_query($sql);

$data = array();
while( $item = mysql_fetch_assoc($q) ){
	
	$dayNum = (int) $item['day_name'];
	
	$testHoliday = in_array($item['date3'], $holidayLists);
	
	// ������������㹪�ǧ Holiday ��� ��������㹪�ǧ�ѹ�����ҵ���� 8.00 - 16.00 ����������
	if( $testHoliday === false 
	&& ( $dayNum > 0 && $dayNum < 6 ) && ( $item['time'] >= "08:00:00" && $item['time'] <= "16:00:00" ) ){
		continue;
	}
	
	// filter ����ѡ�͡����������� 50�ҷ
	if( $item['code'] !== 'clinic50' ){
		continue;
	}
	
	
	
	$user = array(
		'date' => $item['date'],
		'hn' => $item['hn'],
		'ptname' => $item['ptname']
	);
	
	$key = md5($item['staf_massage']);
	// ੾�Ф��á�ͧ���Ǵ�����
	if( empty($data[$key]) ){ 
		$data[$key] = array(
			'staff' => $item['staf_massage'],
			'patient' => array(
				$user
			)
		);
	}else{
		$data[$key]['patient'][] = $user;
	}

}

// echo "<pre>";
// var_dump($data);

// exit;
	
	// ��ǧ����
	// ��ª��ͼ��Ǵ
	// $date_between = " AND `date` >= '$thyear-$selmon-01' AND `date` <= '$thyear-$selmon-31'";
	
	// $sql = "SELECT `staf_massage` 
	// FROM `depart` 
	// WHERE `staf_massage` !='' 
	// $date_between 
	// GROUP BY `staf_massage` ";
	// $query = mysql_query($sql);
	// $num = mysql_num_rows($query);
	// while( $row = mysql_fetch_array($query) ){
		
	foreach( $data as $key => $val ){
		// $staf_massage = $row["staf_massage"];
		?>
		<div id="printable"> 
			<p align="center"><strong>��ª��ͼ�����Ѻ��ԡ�ùǴἹ��</strong></p>
			<div style="margin-left: 5%;"><strong>���;�ѡ�ҹ�Ǵ : </strong><?=$val['staff'];?></div>
			<div style="margin-left: 5%;"><strong>��Ш���͹ <?=$showmon;?> �.�. <?=$thyear;?></div>
			<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
				<thead>
					<tr bgcolor="#FFCCCC">
						<th width="8%" align="center"><strong>�ӴѺ</strong></th>
						<th width="12%" align="center" bgcolor="#FFCCCC"><strong>�ѹ/��͹/��</strong></th>
						<th width="20%" align="center"><strong>HN</strong></th>
						<th width="30%" align="center"><strong>���� - ���ʡ��</strong></th>
						<th align="center" bgcolor="#FFCCCC"><strong>��è�����</strong></th>
					</tr>
				</thead>
				<tbody>
				<?php
					
					/* Condition ����ǡѺ���� �������¹�� �.�. ������� mysql �ӹǳ�ѹ�����١��ͧ */
// 					$sql1 = "SELECT b.*, a.`code`
// FROM `patdata` AS a, (

// 	SELECT *, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, 
// 	CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) AS `date2`, 
// 	DATE_FORMAT( CONCAT((DATE_FORMAT(`date`,'%Y')-543), DATE_FORMAT(`date`, '-%m-%d')) , '%w') AS `day_name` 
// 	FROM `depart` 
// 	WHERE `staf_massage` !='' 
// 	$date_between

// ) AS b 
// WHERE b.`row_id` = a.`idno` 
// AND a.`code` in (
// 	'58002' , '58003' ,'58004' ,'58002a','58002b','58002c','58005','58006','58007','58008','58101','58102','58130','58131','58201','58301','58301a'
// ) 
// AND a.`code` LIKE 'clinic50' 
// AND b.`staf_massage` = '$staf_massage'
// AND a.`status` = 'Y'
// ORDER BY b.`date` ASC";
				// echo "<pre>";
				//var_dump($sql1);
				// echo "<pre>";
				
				// $result = mysql_query($sql1) or die( mysql_error() ); 
				$i = 0;
				// while($rows = mysql_fetch_array($result)){
					foreach( $val['patient'] as $k => $pt ){
					// 0 is Sunday
					// 6 is Saturday
					// �������� �ѹ��� �֧ �ء�� �������㹪�ǧ�����Ҫ�������ҹ���� ���Ѻ
					// @todo �Կ������ջѭ������ͧ��������� 20 �ҷ� ����Կ��Ѻ�����鴹����ͧ��Ѻ���ҵ������
					// $dayNum = (int) $rows['day_name'];
					// if( ( $dayNum > 0 AND $dayNum < 6 ) AND ( $rows['time'] >= "08:20:00" AND $rows['time'] <= "16:20:00" ) ){
					// 	continue;
					// }
					
					$qdate = substr($pt["date"],0,10);
					list($yy,$mm,$dd) = explode("-",$qdate);
					$dateshow = "$dd/$mm/$yy";
					// $showtime = substr($rows["date"],11,8);
					
					$i++;
					
					?>
					<tr>
						<td align="center"><?=$i;?></td>
						<td align="center"><?=$dateshow;?></td>
						<td><?=$pt["hn"];?></td>
						<td align="left"><?=$pt["ptname"];?></td>
						<?php
						$sql3 = "select * from drugrx where date like '$qdate%' and hn='".$pt["hn"]."'";
						$query3 = mysql_query($sql3);
						$num3 = mysql_num_rows($query3);
						if( empty($num3) ){
							$showdrug = "";
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
					<td width="15%" align="right"><strong>���ѹ�֡</strong></td>
					<td width="32%" valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td width="18%" align="right"><strong>��Ǩ�١��ͧ</strong></td>
					<td width="35%" align="right">&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td valign="bottom"><div style="width:150px;"><u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u></div></td>
					<td align="right">�.�.</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:10px;">(���Ծ�&nbsp;&nbsp;&nbsp;&nbsp; �Թ�ѹ)</div></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td align="left"><div style="margin-left:25px;">ᾷ��Ἱ��</div></td>
				</tr>
			</table>
		</div>
		<div style="page-break-after:always;"></div>
	<?php
	} // while
} // end if act show
?>

