<?php 

include 'anc_menu.php';

?>

<form action="<? $_SERVER['PHP_SELF']?>" method="post" name="formdeath1">
	<table width="50%" border="1" cellpadding="0" cellspacing="0">
		<tr>
			<td align="center">��� : ANC</td>
		</tr>
		<tr>
			<td height="41" align="center">���ҵ�� HN : 
			<input type="text" name="chn" id="chn" /></td>
		</tr>
		<tr>
			<td height="37" align="center">
			<input name="ok" type="submit" value="����" /></td>
		</tr>
	</table>
</form>

<?php 
if( $_SESSION['msg'] ){
	echo '<div><b>'.$_SESSION['msg'].'</b></div>';
	$_SESSION['msg'] = false;
}
?>

<?php 

$chn = $_POST['chn'];
if( isset($chn) ){

	$sql = "select * from opcard where hn='$chn'";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	if($result['name']==""){
		echo "��辺������ HN ����";	
	}else{
		echo "<table border=1><tr><th>HN</th><th>����-ʡ��</th><th>�ѹ������Ѻ��ԡ��</th></tr>";
		$sql3 = "select * from opday where hn = '$chn' order by thidate desc limit 50";
		$rows3 = mysql_query($sql3);
		while($result3 = mysql_fetch_array($rows3)){
			$d = substr($result3['thidate'],8,2);
			$m = substr($result3['thidate'],5,2);
			$y = substr($result3['thidate'],0,4);
			$t = substr($result3['thidate'],11);
		?>
		<tr>
			<td><?=$result3['hn']?></td>
			<td><?=$result3['ptname']?></td>
			<td><a href="anc.php?show=<?=$result3['row_id']?>"><?="$d-$m-$y $t"?></a></td>
		</tr>
		<?php
		}
		echo "</table>";
	}

}elseif(isset($_POST['conbtn'])){

	// �ѹ�֡������
	$thidate = date("YmdHis");

	$hn = $_POST['nHn'];
	$seq = $_POST['seq'];
	$date_serve = $_POST['dserv'];
	$gravida = $_POST['grav'];
	$ancno = $_POST['ancno'];
	$ga = $_POST['ga'];
	$ancres = $_POST['ancres'];
	$cid = $_POST['idcard'];
	$doctor = $_POST['doctor'];

	$doctorcode = '00000';
	$q = mysql_query("SELECT `doctorcode` FROM `doctor` WHERE `name` = '$doctor' ");
	if ( mysql_num_rows($q) > 0 ) {
		$item = mysql_fetch_assoc($q);
		$doctorcode = $item['doctorcode'];
	}
	
	$provider = $seq.$doctorcode;

	$q = mysql_query("SELECT * FROM `anc` WHERE `pid` = '$hn' and `seq` = '$seq' ") or die(mysql_error());
	$test_row = mysql_num_rows($q);

	if( $test_row > 0 ){ 

		$item = mysql_fetch_assoc($q);
		$id = $item['row_id'];

		// update 
		$sql = "UPDATE `anc` SET `pid`='$hn', 
		`seq`='$seq', 
		`date_serv`='$date_serve', 
		`gravida`='$gravida', 
		`ancno`='$ancno', 
		`ga`='$ga', 
		`ancres`='$ancres', 
		`aplace`='11512', 
		`provider`='$provider', 
		`d_update`='$thidate', 
		`cid`='$cid' 
		WHERE (`row_id`='$id');";
		$result = mysql_query($sql) or die(mysql_error());

	}else{	
		
		$sql = "INSERT INTO `anc` (
		`row_id`, `pid`, `seq`, `date_serv`, `gravida`, `ancno`, `ga`, `ancres`, `aplace`, `provider`, `d_update`, `cid`
		) VALUES (
		NULL, '$hn', '$seq', '$date_serve', '$gravida', '$ancno', '$ga', '$ancres', '11512', '$provider', '$thidate', '$cid'
		);";
		$result = mysql_query($sql) or die(mysql_error());
	}
	
	if($result){

		$_SESSION['msg'] = '�ѹ�֡���������º��������';
		header('Location: anc.php');
	}

}elseif(isset($_GET['show'])){

	$sql = "select * from opday where row_id = '".$_GET['show']."' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	
	$sql2 = "select * from opcard where hn='".$result['hn']."' ";
	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_array($rows2);
	?>
	
	<h3>��سҡ�͡������㹪�ͧ��ҹ��ҧ ��� anc</h3>
	<form action="anc.php" method="post" name="formdeath2">

		<table width="100%" border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse">
		<tr>
			<td colspan="2">
			HN : <input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"><br />
			���� : <?=$result['ptname']?> <br />
			�Ţ���ѵû��. : <input name="idcard" type="text" value="<?=$result2['idcard']?>" readonly="readonly"/>
			</td>
		</tr>
			<?php 
			$d = substr($result['thidate'],8,2);
			$m = substr($result['thidate'],5,2);
			$y = substr($result['thidate'],0,4)-543;
			$seq = "$y$m$d".sprintf("%03d",$result['vn']);
			?>
		<tr>
			<td>�ӴѺ��� :</td>
			<td><input name="seq" type="text" id="seq" value="<?=$seq?>" readonly="readonly"/></td>
		</tr>
		<tr>
			<td width="23%">�ѹ����Ѻ��ԡ�� :</td>
			<td width="77%"><input name="dserv" type="text" id="dserv" value="<?="$y$m$d"?>" readonly="readonly"/></td>
		</tr>
		<tr>
			<td>������� :</td>
			<td><input type="text" name="grav" id="grav" />
			(������ 0 ��˹���� 1,2,10)</td>
		</tr>
		<tr>
			<td>ANC ��ǧ��� :</td>
			<td>
				<select name="ancno">
					<option value="1">��ùѴ��ǧ��� 1 ��������ؤ���� &lt;12 �ѻ����</option>
					<option value="1">��ùѴ��ǧ��� 2 ��������ؤ���� &ge;12 ��� &lt;18 �ѻ����</option>
					<option value="1">��ùѴ��ǧ��� 3 ��������ؤ���� &ge;18 ��� &lt;26 �ѻ����</option>
					<option value="1">��ùѴ��ǧ��� 4 ��������ؤ���� &ge;26 ��� &lt;32 �ѻ����</option>
					<option value="1">��ùѴ��ǧ��� 5 ��������ؤ���� &ge;32 ��� &lt;38 �ѻ����</option>
				</select><br>
				* �����˵� : �ó����ؤ�����������㹪�ǧ�ͧ��ýҡ��������ѹ�֡੾�����ؤ���� �ѹ�֡��ǧ����� �ó��ҵç��ǧ��ùѴ�ҡ�������ҹ��
			</td>
		</tr>
		<tr>
			<td>���ؤ���� (�ѻ����) : </td>
			<td><input type="text" name="ga" id="ga" />
			(�ӹǹ���)</td>
		</tr>
		<tr>
			<td>�š�õ�Ǩ : </td>
			<td>
				<input type="radio" name="ancres" id="ancres1" value="1" /> <label class="radio" for="ancres1">����</label> 
				<input type="radio" name="ancres" id="ancres2" value="2" /> <label class="radio" for="ancres2">�Դ����</label> 
				<input type="radio" name="ancres" id="ancres9" value="9" /> <label class="radio" for="ancres9">����Һ</label> 
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<input name="conbtn" type="submit" value=" �ѹ�֡������ " />
				<input type="hidden" name="doctor" value="<?=$result['doctor'];?>">
			</td>
		</tr>
		</table>
	</form>
	<?php
}
?>