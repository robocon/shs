<?php
session_start();
set_time_limit(5);
include("connect.inc");
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
<!--
*{
	font-family: 'TH SarabunPSK';
	font-size: 20px;
}
@media print{
	#no_print{display:none;}
}

.theBlocktoPrint 
{ 
	background-color: #000; 
	color: #FFF; 
} 
-->
</style>
<br />

<table>
 <tr>
  <th bgcolor=6495ED>#</th>

  <th bgcolor=6495ED width='80'>HN</th>
  <th bgcolor=6495ED><font face='Angsana New'>����</font></th>
  <th bgcolor=6495ED><font face='Angsana New'><A HREF="<?php echo $_SERVER["PHP_SELF"];?>?doctor=<?php echo $_GET["doctor"];?>&appd=<?php echo $_GET["appd"];?>&sortby=time">���ҹѴ</A></font></th>
  <th bgcolor=6495ED><font face='Angsana New'>�Ѵ����</font></th>

 
  <th bgcolor=6495ED>���</th>
  <!-- <th bgcolor=6495ED>�ѹ���Ѵ</th> -->
  </tr>

<?php

	$sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' limit 1 ";
	$result = Mysql_Query($sql);
	list($menucode) = Mysql_fetch_row($result);
	
		if(strlen($doctor) == 5){
			$doctor2 = " doctor like '".$doctor."%' ";
			$doctor3 = "AND left(doctor,5) <> '".$doctor."' ";

		}else{
			$doctor2 = " doctor = '".$doctor."' ";
			$doctor3 = " AND doctor <> '".$doctor."' ";
		}

		$query = "SELECT count( hn ) , hn, doctor   
		FROM `appoint` 
		WHERE appdate = '$appd' 
		".$doctor3." 
		AND apptime <> '¡��ԡ��ùѴ' 
		GROUP BY hn 
		HAVING count( hn ) >= 1 ";

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
	
	if(strlen($doctor) == 5)
		$doctor2 = "doctor like '".$doctor."%' ";
	else
		$doctor2 = "doctor = '".$doctor."' ";

    // $query1 = "SELECT hn,ptname,apptime,detail,came,row_id,age,date_format(date,'%d-%m-%Y'),officer, left(apptime,5) 
	// FROM appoint 
	// WHERE appdate = '$appd' 
	// and (".$doctor2.") 
	// and detail='FU07 ��չԡ�ѧ���'  
	// AND apptime <> '¡��ԡ��ùѴ' 
	// order by  hn asc ";

	$query1 = "SELECT hn,ptname,apptime,detail,came,row_id,age,date_format(date,'%d-%m-%Y'),officer, left(apptime,5),diag ,other,room 
	FROM appoint 
	WHERE appdate = '$appd' 
	AND detail LIKE 'FU07%' 
	$doctor2
	ORDER BY `hn` ASC ";
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
		
		?>
		<tr style="background-color: #<?=$bgcolor;?>;">
			<td><?=$i;?></td>
			<td><a href="opdcard_vnprintday.php?act=show1&hn=<?=$hn;?>&nat=<?=$appd;?>&detail=<?=$dc;?>&doctor" target="_blank"><?=$hn;?></a></td>
			<td><?=$ptname;?></td>
			<td><?=$apptime;?></td>
			<td><?=$detail;?></td>
			<td>
				<?php echo ( isset($listhn[$hn]) ) ? $listhn[$hn] : '' ;?>
			</td>
			<td>
				<?php echo ( $room === 'Ἱ�����¹' ) ? $room : '' ;?>
			</td>
			<td>
				<?php
				$sql5 = "SELECT * FROM `bed` WHERE `hn` = '$hn' ";
				$row5 = mysql_query($sql5);
				$rep5 = mysql_num_rows($row5);
				echo ( $rep5 > 0 ) ? 'Admit' : '' ;
				?>
			</td>
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
					<td><?=$item['detail'];?></td>
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