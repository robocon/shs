<?php
include 'bootstrap.php';
unset( $_SESSION['cHn'] );
unset( $_SESSION['cPtname'] );
unset( $_SESSION['cPtright'] );
unset( $_SESSION['nVn'] );
unset( $_SESSION['cAge'] );
unset( $_SESSION['nRunno'] );
unset( $_SESSION['vAN'] );
unset( $_SESSION['thdatehn'] );
unset( $_SESSION['cNote'] );
unset( $_SESSION['Ptright1'] );


?>
<script type="text/javascript">
	document.getElementById('aLink').focus();
</script>
<form method="post" action="ophn.php">
	<p>ค้นหาคนไข้จาก&nbsp; HN</p>
	<p>
		HN: <input type="text" name="hn"size="12" id="aLink">
	</p>
	<p>
		<input type="submit" value="  ตกลง  " name="B1">
		<input type="reset" value="  ลบทิ้ง  " name="B2">
	</p>
</form>
<table>
	<tr>
		<th height="22" bgcolor=6495ED>HN</th>
		<th bgcolor=6495ED width="70">ยศ</th>
		<th bgcolor=6495ED>ชื่อ</th>
		<th bgcolor=6495ED>สกุล</th>
		<th bgcolor=6495ED>ใบต่อแบบใหม่</th>
		<th bgcolor=6495ED>มา รพ.</th>
		<th bgcolor=6495ED>ตรวจนอน</th>
		<th bgcolor=6495ED>ใบต่อ</th>
		<th bgcolor=6495ED colspan="5">ใบตรวจโรค</th>
	</tr>
<?php
$hn = get_post('hn');
if ( !empty( $hn ) ) {
	
	DB::load();
	$query = "SELECT hn,yot,name,surname,ptright,ptright1,idcard FROM opcard WHERE hn = '$hn'";
	$items = DB::select($query, false);
// 	var_dump($item);
	
// 	while ( list (  ) = mysql_fetch_row ( $result ) ) {
	foreach( $items as $key => $item ){
		$hn = $item['hn'];
		$yot = $item['yot'];
		$name = $item['name'];
		$surname = $item['surname'];
		$ptright = $item['ptright'];
		$ptright1 = $item['ptright1'];
		$idcard = $item['idcard'];
		
		if ( substr( $ptright, 0, 3 ) == 'R07' && !empty($idcard)) {
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if (Mysql_num_rows ( Mysql_Query ( $sql ) ) > 0) {
				$color = "#CCFF00";
			} else {
				$color = "FF8C8C";
			}
		} else if (substr ( $ptright, 0, 3 ) == 'R03') {
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			
			if (Mysql_num_rows ( Mysql_Query ( $sql ) ) > 0) {
				$color = "99CC00";
			} else {
				$color = "FF8C8C";
			}
		} else {
			$color = "66CDAA";
		}
		
		if ( !empty( $idcard ) ) {
			$sql = "Select id From ssodata where id LIKE '$idcard%' limit 1 ";
			if (Mysql_num_rows ( Mysql_Query ( $sql ) ) > 0) {
				echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิประกันสังคม</FONT>";
			} else {
				echo "";
			}
		} else {
			echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มีเลขประจำตัวประชาชน</FONT>";
			?>
			<script type="text/javascript">
				alert('ผู้ป่วยไม่มีเลขประจำตัวประชาชน');
			</script>
			<?php
		}
		
		if (! empty ( $hn )) {
			$sql = "Select hn, status From cscddata where hn = '$hn' AND ( status like '%U%' OR status = '\r' OR status like '%V%')  limit 1 ";
			if (Mysql_num_rows ( Mysql_Query ( $sql ) ) > 0) {
				echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยมีสิทธิจ่ายตรง</FONT>";
			} else {
				echo "";
			}
		} else {
			echo "<FONT SIZE='' COLOR='#FF0033'>ผู้ป่วยไม่มี HN</FONT>";
		}
		
		$link = '';
		?>
		<tr bgcolor="<?php echo $color;?>">
			<td>
				<a href="opedit.php?cHn=<?php echo $hn;?>&cName=<?php echo $name?>&cSurname=<?php echo $surname?>" target="_blank"><?php echo $hn;?></a>
			</td>
			<td><?php echo $yot;?></td>
			<td><?php echo $name;?></td>
			<td><?php echo $surname;?></td>
			<td>
				<a href="opdcard_opregis.php?cHn=<?php echo $hn;?>"><?php echo $ptright;?></a>
			</td>
			<td>
				<a href="hndaycheck.php?hn=<?php echo $hn;?>">มา รพ.</a>
			</td>
			<td>
				<a href="appdaycheck.php?hn=<?php echo $hn;?>">ตรวจนัด</a>
			</td>
			<td>
				<a href="opdprint2.php?cHn=<?php echo $hn;?>">ใบต่อ</a>
			</td>
			<td>
				<a href="rg_appointhdvn.php?cHn=<?php echo $hn;?>">ไต</a>
			</td>
			<td>
				<a href="rg_appointdenvn.php?cHn=<?php echo $hn;?>">ฟัน</a>
			</td>
			<td>
				<a href="rg_appointeyevn.php?cHn=<?php echo $hn;?>">ตา</a>
			</td>
			<td>
				<a href="rg_appointbgvn.php?cHn=<?php echo $hn;?>">สูติ</a>
			</td>
			<td>
				<a href="rg_appoint.php?cHn=<?php echo $hn;?>">ผป.นัด</a>
			</td>
		</tr>
		<?php 
		$_SESSION['hn'] = $hn;
		$_SESSION['name'] = $name;
		$_SESSION['surname'] = $surname;
		
	} // End while
	
	$sql1 = "SELECT  * FROM opcard
	where name='" . $_SESSION ['name'] . "' 
	and surname='" . $_SESSION ['surname'] . "' 
	and hn !='" . $_SESSION ['hn'] . "' ";

	DB::select($sql1, false, true);
	$rows1 = DB::$rows;
	if ($rows1) {
		echo "<font color='#FF0000'>ซ้ำ</font>";
	}
	
	// ตรวจสอบและเปลี่ยน HN AN ตอนขึ้นปีใหม่
	$sql = "Select left(prefix,2) From runno where title = 'HN' ";
	list ( $title_hn ) = Mysql_fetch_row ( Mysql_Query ( $sql ) );
	$year_now = substr ( date ( "Y" ) + 543, 2 );
	if ($title_hn != $year_now) {
		$sql = "Update runno set prefix = '" . $year_now . "-', runno = 0 where  title = 'HN' limit 1;";
		$result = mysql_Query ( $sql );
	}
	
	$sql = "Select left(prefix,2) From runno where title = 'AN' ";
	list ( $title_an ) = Mysql_fetch_row ( Mysql_Query ( $sql ) );
	$year_now = substr ( date ( "Y" ) + 543, 2 );
	if ($title_an != $year_now) {
		$sql = "Update runno set prefix = '" . $year_now . "/', runno = 0 where  title = 'AN' limit 1;";
		$result = mysql_Query ( $sql );
	}
	// END
	?>
</table>

<FONT SIZE="2" COLOR="#990000">***คำอธิบาย***</FONT>
<BR>
<FONT SIZE="" COLOR="66CDAA">สีเขียว คือ ยังไม่ได้ทำการตรวจสิทธิการรักษา</FONT>
<BR>
<FONT SIZE="" COLOR="#CCFF00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิประกันสังคม</FONT>
<BR>
<FONT SIZE="" COLOR="#99CC00">สีเขียวอ่อน คือ ตรวจสอบแล้ว มีสิทธิจ่ายตรง</FONT>
<BR>
<FONT SIZE="" COLOR="#FF0033">สีแดง คือ ไม่มีสิทธิ</FONT>
<BR>
<hr />

<?php
	// ตรวจสอบการนอนใน รพ.
	$alert_msg = null;
	$hn = isset ( $_POST ['hn'] ) ? $_POST ['hn'] : null;
	if ($hn !== null) {
		
		$sql_pre = "
		SELECT b.`my_ward` FROM `bed` AS a 
		LEFT JOIN `ipcard` AS b ON b.`an` = a.`an` 
		WHERE a.`hn` = '%s' ;
		";
		$sql = sprintf ( $sql_pre, $hn );
		$item = DB::select($sql, null, true);
		if ($item != false && $item ['my_ward'] != '') {
			$alert_msg = 'ผู้ป่วยยังอยู่ที่ ' . $item ['my_ward'];
		}
	}
	
	if ($alert_msg !== null) {
		?>
		<script type="text/javascript">
			alert('<?php echo $alert_msg;?>');
		</script>
	<?php
	}

	// ///////////
	/*
	$sql_chkname = "SELECT  * FROM opcard
where name='" . $_SESSION ['name'] . "' and surname='" . $_SESSION ['surname'] . "' and hn !='" . $_SESSION ['hn'] . "'  limit 5";
	$result_chkname = mysql_query ( $sql_chkname );
	$rows = mysql_num_rows ( $result_chkname );
	
	if ($rows) {
		?>


<h2>
	<font color="#FF0000">คำเตือน</font>
</h2>
<h3>มีผู้ป่วย ขื่อ  <?= $_SESSION['name']?> <?=$_SESSION['surname'];?>  ซ้ำ ในระบบทะเบียน</h3>
<h3>กรุณาตรวจสอบผู้ป่วย</h3>
<table>
	<tr>
		<th bgcolor=6495ED>HN</th>
		<th bgcolor=6495ED>ยศ</th>
		<th bgcolor=6495ED>ชื่อ</th>
		<th bgcolor=6495ED>สกุล</th>
		<th bgcolor=6495ED>สิทธิ</th>
		<th bgcolor=6495ED>มา รพ.</th>
		<th bgcolor=6495ED>ตรวจนอน</th>
		<th bgcolor=6495ED>ใบต่อ</th>
		<th bgcolor=6495ED>ใบยานอก</th>
		<th bgcolor=6495ED>ใบสั่งยา</th>
		<th bgcolor=6495ED>ใบตรวจโรค</th>
	</tr>
<?php 
		while ( $dbarr = mysql_fetch_array ( $result_chkname ) ) {
			
			print (" <tr>\n" . "  <td BGCOLOR=" . $color . "><a target=_BLANK  href=\"opedit.php? cHn=$dbarr[hn] & cName=$dbarr[name] &cSurname=$dbarr[surname]\">$dbarr[hn]</a></td>\n" . "  <td BGCOLOR=" . $color . ">$dbarr[yot]</td>\n" . "  <td BGCOLOR=" . $color . ">$dbarr[name]</td>\n" . "  <td BGCOLOR=" . $color . ">$dbarr[surname]</td>\n" . "  <td BGCOLOR=" . $color . ">$dbarr[ptright]</td>\n" . "  <td BGCOLOR=" . $color . "><a target= _BLANK href=\"hndaycheck.php?hn=$dbarr[hn]\">มา รพ.</td>\n" . "  <td BGCOLOR=" . $color . "><a target= _BLANK href=\"appdaycheck.php?hn=$dbarr[hn]\">ตรวจนัด</td>\n" . 
			// " <td BGCOLOR=".$color."><a target= _BLANK href=\"ancheck.php?hn=$hn\">ตรวจนอน</td>\n".
			"  <td BGCOLOR=" . $color . "><a target= _BLANK href=\"opdprint2.php?cHn=$dbarr[hn]\">ใบต่อ</td>\n" . "  <td BGCOLOR=" . $color . "><a target= _BLANK href=\"edprint.php?cHn=$dbarr[hn]\">ใบยานอก</td>\n" . "  <td BGCOLOR=" . $color . "><a target= _BLANK href=\"rg_appoint.php?cHn=$dbarr[hn]\">ผู้ป่วยนัด</td>\n" . "  <td BGCOLOR=" . $color . "><a target= _BLANK href=\"rg_appoint1.php?cHn=$dbarr[hn]\">ใบตรวจโรค</td>\n" . 

			" </tr>\n") ;
		}
	}
	
	unset($_SESSION['hn']);
	unset($_SESSION['name']);
	unset($_SESSION['surname']);
	*/
	
} // End if not empty HN

?>
</table>