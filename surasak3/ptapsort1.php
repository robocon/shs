<?php
session_start();
set_time_limit(5);
include("connect.inc");
$appd = isset($_GET['appd']) ? trim($_GET['appd']) : false ;
$Thaidate=date("d-m-").(date("Y")+543)."  ".date("H:i:s");
print "<font face='Angsana New'><b>��ª��ͤ���Ѵ��Ǩ</b><br>";

if(strlen($doctor) == 5){
	$sql = "Select name From doctor where name like '".$doctor."%' limit 1";
	list($dc) = mysql_fetch_row(mysql_query($sql));
	print "<b>ᾷ��:</b> $dc <br>"; 
}else{
	print "<b>ᾷ��:</b> $doctor <br>"; 
}
print "<b>�Ѵ���ѹ���</b> $appd<br> ";
print "�ѹ/���ҷӡ�õ�Ǩ�ͺ....$Thaidate"; 

?>
<style type="text/css">
*{
	font-family: 'TH SarabunPSK';
	font-size: 20px;
}
@media print{
	*{
		font-size: 18px;
	}
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
<table>
	<tr>
		<th width="2%" >#</th>
		<th>HN</th>
		<th>����</th>
		<th><A HREF="<?php echo $_SERVER["PHP_SELF"];?>?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>&sortby=time">���ҹѴ</A></th>
		<th>�Ѵ����</th>
		<th width="12%">�ѹ����Ҥ�������ش</th>
		<!-- <th width="4%">ʶҹ�</th>
		<th>����</th>
		<th>diag</th> -->
		<th>���</th>
		<th>��蹺ѵ�</th>
		<th>Admit</th>
	</tr>
	<?php
	$sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($menucode) = Mysql_fetch_row($result);
	
	///////////////////////
	// �óշ����ͤ���蹹Ѵ����͹�ѹ
	///////////////////////
	if(strlen($doctor) == 5){
		$doctor2 = " doctor like '".$doctor."%' ";
		$doctor3 = "AND left(doctor,5) <> '".$doctor."' ";

	}else{
		$doctor2 = " doctor = '".$doctor."' ";
		$doctor3 = " AND doctor <> '".$doctor."' ";
	}

	$query = "SELECT count( hn ) , hn, doctor   FROM `appoint` WHERE appdate = '$appd' ".$doctor3." AND apptime <> '¡��ԡ��ùѴ' GROUP BY hn HAVING count( hn ) >= 1 ";
	$result = mysql_query($query);
	
	while($arr = Mysql_fetch_assoc($result)){
		$name_dc = substr($arr["doctor"],5);
		if(substr($arr["doctor"],0,5) != "MD007"){
			$arr["doctor"] = substr($arr["doctor"],0,5);
		}			
		
		$listhn[$arr["hn"]] .= "<A HREF=\"ptappoiall2.php?doctor=".urlencode($arr["doctor"])."&appd=".urlencode($appd)."\" target='_blank'>".$name_dc."</A> &nbsp; ";
	}
		
	

/*	if(isset($_GET["sortby"]) && $_GET["sortby"] != ""){
		$sort = " apptime ASC ,detail asc";
	}else{
		$sort = " detail asc  ASC";
}*/
	
	if(strlen($doctor) == 5){
		$doctor2 = " AND `doctor` LIKE '".$doctor."%' ";
	}else{
		$doctor2 = " AND `doctor` = '".$doctor."' ";
	}

    $query1 = "SELECT hn,ptname,apptime,detail,came,row_id,age,date_format(date,'%d-%m-%Y'),officer, left(apptime,5),diag ,other,room 
	FROM appoint 
	WHERE appdate = '$appd' 
	AND detail NOT LIKE 'FU18%' 
	$doctor2
	ORDER BY `hn` ASC ";

$query1 = "SELECT a.`row_id`,a.`hn`,a.`ptname`,a.`apptime`,a.`detail`,a.`detail2`,a.`came`,a.`row_id`,a.`age`,a.`officer`,a.`diag`,a.`other`,a.`room`, 
date_format(a.`date`,'%d-%m-%Y') AS `date`,
left(a.`apptime`,5) AS `left5`
FROM `appoint` AS a 
INNER JOIN ( 
    SELECT `row_id`,`hn`, MAX(`row_id`) AS `id`, SUBSTRING(`doctor`, 1,5) AS `drcode`
    FROM `appoint` 
    WHERE `appdate` = '$appd' 
    AND `doctor` LIKE '$doctor%' 
	AND detail NOT LIKE 'FU18%' 
    GROUP BY `hn`, `drcode`
) AS b ON b.`id` = a.`row_id` 

ORDER BY `hn` ASC
";



    $result = mysql_query($query1) or die( mysql_error() );

	$date_now = date("d-m-").(date("Y")+543);
	
	// ʡ�չ��ҷ�����͡�
	$user_lists = array();
	while( $item = mysql_fetch_assoc($result) ){
		
		list($key_year, $hn_key) = explode('-', $item['hn']);
		$item['sort_hn'] = $key_year.sprintf("%08d", intval($hn_key)); // ���ҧ key ���������������Ѻ sort ��੾��
		$key = md5($item['hn'].md5($item['room'])); // ���ҧ����ҡ hn ��� room �����ͧ��Ǩ����ͧ���ǡѹ�褹������ �ѹ���ʴ�੾�� row ����ش
		$user_lists[$key] = $item;
	}
	
	// ���§�ҡ��������ҡ��� sort_hn
	function sorthn($a, $b){
		return $a['sort_hn'] - $b['sort_hn'];
	}
	usort($user_lists, "sorthn");
	
	$i = 1;
	$unincome_lists = array();
	foreach( $user_lists AS $item ){
		
		// ����ª��ͤ����¡��ԡ�Ѵ �������ʴ��ա 1 ���ҧ
		if( $item['apptime'] === '¡��ԡ��ùѴ' ){
			$unincome_lists[] = $item;
			continue;
		}
		
		$hn = $item['hn'];
		
		$ptname = $item['ptname'];
		$apptime = $item['apptime'];
		$detail = $item['detail'];
		$came = $item['came'];
		$row_id = $item['row_id'];
		$age = $item['age'];
		$date = $item['date'];
		$officer = $item['officer'];
		$left5 = $item['left5'];
		$diag = $item['diag'];
		$other = $item['other'];
		$room = $item['room'];
		
		
		if($date_now == $date){
			$bgcolor = "FFA8A8";
		}else{
			$bgcolor = "66CDAA";
		}
		
		if($menucode == 'ADMOPD'){
			$detail = substr($detail,4);
		}
		
$chkopcard="select * from opday where hn='$hn' order by row_id desc limit 1";
$chkquery=mysql_query($chkopcard);
$chkrows=mysql_fetch_array($chkquery);				
		?>
		<tr style="background-color: #<?=$bgcolor;?>;">
			<td><?=$i;?></td>
			<td><a href="opdcard_vnprintday.php?act=show1&hn=<?=$hn;?>&nat=<?=$appd;?>&detail=<?=$dc;?>&doctor" target="_blank"><?=$hn;?></a></td>
			<td><?=$ptname;?></td>
			<td><?=$apptime;?></td>
			<td>
				<?=$detail;?>
				<?php
				// �������������ͧ��ͧ����¹���ͧ���
				if( !empty($item['detail2']) && $_SESSION['smenucode'] != 'ADMOPD' ){
					echo ' ('.$item['detail2'].')';
				}
				
				if($room == '��ͧ��Ǩ੾���ä')
				{
					echo '&nbsp;<span style="font-weight:bold; color: red;">(ARI ��Թԡ)</span>';
				}
				?>
				</td>
			<td><?=substr($chkrows["thidate"],0,10);?></td>
			<!-- <td><?=$chkrows["okopd"];?></td> -->
			<td>
				<?php echo ( isset($listhn[$hn]) ) ? $listhn[$hn] : '' ;?>			</td>
			<td>
				<?php echo ( $room === 'Ἱ�����¹' ) ? $room : '' ;?>			</td>
			<td>
				<?php
				$sql5 = "SELECT * FROM `bed` WHERE `hn` = '$hn' ";
				$row5 = mysql_query($sql5);
				$rep5 = mysql_num_rows($row5);
				echo ( $rep5 > 0 ) ? 'Admit' : '' ;
				?>			</td>
		</tr>
		<?php
		$i++;
	}
	?>
</table>
<style type="text/css">
	@media print{
		#cancel-appoint{
			display: none;
		}
	}
</style>
<?php
$row = count($unincome_lists);
if( $row > 0 ){
?>
<div id="cancel-appoint">
	<div style="page-break-before: always;"></div>
	<h3 style="margin-bottom: 0;">��ª��ͤ���¡��ԡ�Ѵ</h3>
	<table>
		<thead>
			<tr>
				<th width="2%">#</th>
				<th>HN</th>
				<th>����</th>
				<th>���ҹѴ</th>
				<th>�Ѵ����</th>
				<!-- <th>����</th>
				<th>diag</th> -->
				<th>���</th>
				<th>��蹺ѵ�</th>
				<th>Admit</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$i = 1;
			foreach( $unincome_lists as $key => $item ){
				
				if($date_now == $item['date']){
					$bgcolor = "FFA8A8"; // ��ᴧ
				}else{
					$bgcolor = "66CDAA";
				}
				?>
				<tr style="background-color: #<?=$bgcolor;?>;">
					<td><?=$i;?></td>
					<td><?=$item['hn'];?></td>
					<td><?=$item['ptname'];?></td>
					<td><?=$item['apptime'];?></td>
					<td>
						<?=$item['detail'];?>
						<?php
						if( !empty($item['detail2']) && $_SESSION['smenucode'] != 'ADMOPD' ){
							echo ' ('.$item['detail2'].')';
						}
						?>
					</td>
					<!-- <td><?=$item['other'];?></td>
					<td><?=$item['diag'];?></td> -->
					<td>
						<?php
						$hn = $item['hn'];
						echo (isset($listhn[$hn])) ? $listhn[$hn] : '' ;
						?>
					</td>
					<td><?=$item['room'];?></td>
					<td>
						<?php
						$sql5 = "SELECT * FROM `bed` WHERE `hn` = '$hn' ";
						$q2 = mysql_query($sql5) or die( mysql_error() );
						$count = mysql_num_rows($q2);
						echo ( $count > 0 ) ? 'Admit' : '' ;
						?>
					</td>
				</tr>
				<?php
				$i++;
			}
			?>
		</tbody>
	</table>
</div>
<?php } ?>