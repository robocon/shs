<?php
// require("fpdf/fpdf.php");
// require("fpdf/pdf.php");

require("connect.php");

$month_ = array(
	'01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', '05' => '����Ҥ�', '06' => '�Զع�¹', 
	'07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�'
);

// $day = sprintf("%02d", $_POST["day"]);
$month = sprintf("%02d", $_POST["month"]);
$year = sprintf("%02d", $_POST["year"]);

$doctor = $_POST["doctor"];
$code = $_POST["code"];

$time = $_POST["time"];
	


list($timeStart, $timeEnd) = explode("-", $_POST["time"]);

// ���ҧ temp 
if($code === '58000'){
	$where = "AND `code` LIKE '$code%' ";
}else{
	$where = "AND ( `code` LIKE '58001%' OR `code` LIKE '58002%' OR `code` LIKE '58003%' )";
}

$sql_temp = "
CREATE TEMPORARY TABLE IF NOT EXISTS patdata_temp 
SELECT `hn`, `ptname`, `idno`, `date`, `detail`, `amount`, DATE_FORMAT(`date`,'%H:%i:%s') AS `time`, DATE_FORMAT(`date`,'%Y-%m-%d') AS `date2`
FROM `patdata` 
WHERE `hn` != '' 
AND `doctor` LIKE '$doctor%' 
AND ( `date` >= '$year-$month-01' AND `date` <= '$year-$month-31') 
$where ;";
mysql_query($sql_temp) or die( mysql_error() );

// �Ѵ���� ��ǧ���ҷӡ�� ��� �͡���ҷӡ��
$setTime = " `time` >= '08:20:00' AND `time` <= '16:20:00' ";
if ( $time !== '08:00:00-16:00:00' ) {
	$setTime = " `time` >= '16:20:00' AND `time` <= '20:20:00' ";
}

$sql = "SELECT *
FROM `patdata_temp` 
WHERE $setTime
GROUP BY `hn` 
HAVING SUM(`amount`) > 0 
ORDER BY `date` ASC";
$result2  = mysql_query($sql) or die( mysql_error() );

$txt = "��Թԡ�͡�����Ҫ��� (�ѧ���) ���� ";
switch( $time ){
	
	case "08:00:00-16:00:00" : $txt .= "08:00 - 16.00"; break;
	case "16:00:00-20:00:00" : $txt .= "16:00 - 20:00"; break;
	
}
?>
<style type="text/css">
	body, th, td{
		font-family: 'TH SarabunPSK';
		font-size: 20px;
	}
	.main-contain{
		width: 80%;
	}
	@media screen and (max-width: 992px){
		.main-contain{
			width: 100%;
		}
	}
	@media print{
		.main-contain{
			width: 100%;
		}
		.fix-head, .fix-bottom{
			display: table-header-group;
		}
	}
</style>
<div class="main-contain">
	<div class="fix-head">
		<div style="text-align: center;">
			<p><?=$txt;?></p>
		</div>
		<div>
			<p>��͹ <?php echo $month_[$month]." $year";?></p>
		</div>
	</div>
	<div>
		<table width="100%" border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
			<thead>
				<tr>
					<th>�ӴѺ</th>
					<th>���� - ʡ�� ����Ѻ��ԡ��</th>
					<th>HN</th>
					<th>�ä</th>
					<th>�ѹ���</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$i=1;
				while( $item = mysql_fetch_assoc($result2) ){
					
					$sql = "SELECT `diag` 
					FROM `depart` 
					WHERE `row_id` = '".$item['idno']."'";
					$query = mysql_query($sql) or die( mysql_error() );
					$res = mysql_fetch_assoc($query);
				
				?>
				<tr>
					<td width="5%" align="center"><?=$i;?></td>
					<td><?=$item['ptname'];?></td>
					<td align="center"><?=$item['hn'];?></td>
					<td align="center"><?=$res['diag'];?></td>
					<td><?=$item['date2'];?></td>
				</tr>
				<?php
					$i++;
				}
				?>
			</tbody>
		</table>
	</div>
	<?php /* ?>
	<div style="padding: 0.5em;"></div>
	<div class="fix-bottom">
		<table width="100%" border="0" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
			<tbody>
				<tr>
					<td width="50%">���ѹ�֡</td>
					<td width="50%">���</td>
				</tr>
				<tr>
					<td><span style="padding-left: 50px;"></span>(<span style="padding: 0 80px;"></span>)</td>
					<td><span style="padding-left: 50px;"></span>(<span style="padding: 0 80px;"></span>)</td>
				</tr>
				<tr>
					<td><span style="padding-left: 65px;"></span>���˹�ҷ���Թԡ�ѧ���</td>
					<td><span style="padding-left: 95px;"></span>ᾷ�����ѡ��</td>
				</tr>
				<tr>
					<td><span style="padding-left: 65px;"></span>........../........../..........</td>
					<td><span style="padding-left: 80px;">........../........../..........</td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php */ ?>
</div>