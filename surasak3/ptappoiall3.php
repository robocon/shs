<?php
// Update 31 �� 2553 
//bbm
session_start();

$user_menucode = $_SESSION['smenucode'];

$appd = isset($_GET['appd']) ? trim($_GET['appd']) : false ;
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";
print "<b>��ùѴ:</b> $detail <br>"; 

print "<b>�Ѵ���ѹ���</b> $appd<br> ";
print "�ѹ/���ҷӡ�õ�Ǩ�ͺ....$Thaidate"; 

function dump($str){
	echo "<pre>";
	var_dump($str);
	echo "</pre>";
}

?>
<style type="text/css">
*{
	font-family: Angsana New;
	font-size: 20px;
}
table{
	width: 100%;
	border-left: 1px solid #ffffff;
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
<a href="vnprintday.php?nat=<?=$appd?>&detail=<?=$detail?>">�����㺵�Ǩ�ä</a>

<table>
	<tr>
		<th bgcolor="6495ED">#</th>
		<th bgcolor="6495ED">HN</th>
		<th bgcolor="6495ED"><font face='Angsana New'>����</th>
		<th bgcolor="6495ED"><font face='Angsana New'>���ҹѴ</th>
		<th bgcolor="6495ED">�š�ä��һ���ѵ�</th>
		<th bgcolor="6495ED">�����˵�</th>
		<th bgcolor="6495ED">�ѹ���Ѵ</th>
	</tr>
	<?php
	include("connect.inc");
	
	if(substr($_GET["detail"],0,4) == "FU07"){
		$sort = "Order by apptime ASC ";
	}else{
		$sort = "Order by hn ";
	}
	
	// Query ������
	// $query = "SELECT hn,ptname,apptime,came,row_id,age,date_format(date,'%d-%m-%Y') 
	// FROM appoint 
	// WHERE appdate = '$appd' 
	// and detail = '$detail' ".$sort;
	
	$query = "SELECT a.`hn`,a.`ptname`,a.`apptime`,a.`came`,a.`row_id`,a.`age`,
	date_format(a.`date`,'%d-%m-%Y') AS `date`,a.`other`,a.`detail`,SUBSTRING(a.`detail`, 1, 4) AS `detail_code`
	FROM `appoint` AS a 
	INNER JOIN (
		SELECT `row_id`,`hn`, MAX(`row_id`) AS `id`
		FROM `appoint` 
		WHERE `appdate` = '$appd' 
		GROUP BY `hn` 
	) AS b ON b.`id` = a.`row_id` 
	WHERE a.`detail` = '$detail' ";
	$result = mysql_query($query) or die( mysql_error() );

	$date_now = date("d-m-").(date("Y")+543);
	
	$cancel_date = array();
	$user_lists = array();
	while ( $item = mysql_fetch_assoc ($result)) {
		
		$hn = $item['hn'];
		$ptname = $item['ptname'];
		$apptime = $item['apptime'];
		$came = $item['came'];
		$row_id = $item['row_id'];
		$age = $item['age'];
		$date = $item['date'];
		$other = $item['other'];
		$detail = '�鹾�////��辺';
		$detail_code = $item['detail_code'];

		list($key_year, $hn_key) = explode('-', $hn);
		$key = $key_year.sprintf("%08d", intval($hn_key));
		
		$card_status = '';
		if( $detail_code === 'FU03' AND ( $user_menucode === 'ADMMAINOPD' OR $user_menucode === 'ADM' ) ){
			$sql = "SELECT b.`status` 
			FROM (
				SELECT `an` 
				FROM `ipcard` 
				WHERE `hn` = '$hn' 
				ORDER BY `row_id` DESC 
				LIMIT 1 
			) AS a 
			LEFT JOIN `dcstatus` AS b ON a.`an` = b.`an` 
			ORDER BY b.`date` DESC 
			LIMIT 1";
			$q = mysql_query($sql);
			$user = mysql_fetch_assoc($q);
			$card_status = $user['status'];
		}

		$user_lists[$key] = array(
			'hn' => $hn,
			'ptname' => $ptname,
			'apptime' => $apptime,
			'detail' => $detail,
			'other' => $other,
			'date' => $date,
			'sort_hn' => $key,
			'card_status' => $card_status
		);
	}

	// ���§�ҡ��������ҡ��� sort_hn
	function sorthn($a, $b){
		return $a['sort_hn'] - $b['sort_hn'];
	}
	usort($user_lists, "sorthn");
	
	$order = 1;
	foreach($user_lists as $key => $user){
		
		// �¡¡��ԡ�Ѵ
		if( $user['apptime'] === '¡��ԡ��ùѴ' ){
			$cancel_date[] = $user;
			continue;
		}

		// Default color
		$bgcolor = "66CDAA";
		if($date_now == $date){
			$bgcolor = "FFA8A8";
		}

		$other = ( empty($user['other']) ) ? '..............................' : $user['other'] ; 

		?>
		<tr bgcolor="<?=$bgcolor;?>">
			<td><?=$order;?></td>
			<td><?=$user['hn'];?></td>
			<td><?=$user['ptname'];?></td>
			<td><?=$user['apptime'];?></td>
			<td><?=$user['detail'];?></td>
			<td><?=$other.' '.$user['card_status'];?></td>
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
<h3>��ª��ͼ�����¡��ԡ�Ѵ</h3>
<table>
	<thead>
		<tr bgcolor="6495ED">
			<th>#</th>
			<th>HN</th>
			<th>����</th>
			<th>���ҹѴ</th>
			<th>�š�ä��һ���ѵ�</th>
			<th>�����˵�</th>
			<th>�ѹ���Ѵ</th>
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

if($detail=='FU18 �����'){

	include("connect.inc");
	
	$subappd=explode(' ',$appd);
	
	switch($subappd[1]){
		case "���Ҥ�": $printmonth = "01"; break;
		case "����Ҿѹ��": $printmonth = "02"; break;
		case "�չҤ�": $printmonth = "03"; break;
		case "����¹": $printmonth = "04"; break;
		case "����Ҥ�": $printmonth = "05"; break;
		case "�Զع�¹": $printmonth = "06"; break;
		case "�á�Ҥ�": $printmonth = "07"; break;
		case "�ԧ�Ҥ�": $printmonth = "08"; break;
		case "�ѹ��¹": $printmonth = "09"; break;
		case "���Ҥ�": $printmonth = "10"; break;
		case "��Ȩԡ�¹": $printmonth = "11"; break;
		case "�ѹ�Ҥ�": $printmonth = "12"; break;
	}
	$newappd=$subappd[2].'-'.$printmonth.'-'.$subappd[0];
	
	$sqltem="CREATE TEMPORARY TABLE  appoint1  Select * from  appoint  WHERE  `detail` 
	LIKE  '%�����%' AND appdate ='$appd' ";
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
	
		echo "<tr><td colspan='5' align='center'  bgcolor=\"#00CCFF\"><b>��ǧ���  ".$i.' </b>  ����   '.$arrtime['apptime'].'  �� '.$arrtime['cnum']." ��</tr></td>";
		echo "<tr bgcolor='#CCCCCC'>
		<td align='center'>�ӴѺ</td>
		<td align='center'>����-ʡ��</td>
		<td align='center'>HN</td>
		<td align='center'>VN</td>
		<td align='center'>�Է��</td>
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

