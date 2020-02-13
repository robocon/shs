<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$db = Mysql::load();
$action = input_post('action');
if ( $action == 'save' ) {
	// บันทึกข้อมูล
	$d_update = date("YmdHis");

	$hn = $_POST['nHn'];
	$seq = $_POST['seq'];
	$date_serve = $_POST['dserv'];
	$gravida = $_POST['grav'];
	$ancno = $_POST['ancno'];
	$ga = $_POST['ga'];
	$ancres = $_POST['ancres'];
	$cid = $_POST['idcard'];
	$doctor = $_POST['doctor'];

	$opday_id = $_POST['opday_id'];
	
	if( preg_match('/MD\d+/', $doctor) > 0 ){
		$prefixMd = substr($doctor,0,5);
		$where = "`name` LIKE '$prefixMd%'";

	}elseif ( preg_match('/(\d+){4,5}/', $doctor, $matchs) ) {
		$prefixMd = $matchs['0'];
		$where = "`doctorcode` = '$prefixMd'";
	}

	$sql = "SELECT CONCAT('ว.',`doctorcode`) AS `doctorcode` FROM `doctor` WHERE $where ";
	$db->select($sql);
	$dr = $db->get_item();
	$doctorcode = $dr['doctorcode'];

	$sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
	$db->select($sql);
	$dr = $db->get_item();

	$provider = $dr['PROVIDER'];

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
		`d_update`='$d_update', 
		`cid`='$cid', 
		`opday_id` = '$opday_id' 
		WHERE (`row_id`='$id');";
		$save = $db->update($sql);
		// $result = mysql_query($sql);

	}else{	
		
		$sql = "INSERT INTO `anc` (
		`row_id`, `pid`, `seq`, `date_serv`, `gravida`, `ancno`, `ga`, `ancres`, `aplace`, `provider`, `d_update`, `cid` ,`opday_id` 
		) VALUES (
		NULL, '$hn', '$seq', '$date_serve', '$gravida', '$ancno', '$ga', '$ancres', '11512', '$provider', '$d_update', '$cid', '$opday_id'
		);";
		// $result = mysql_query($sql);
		$save = $db->insert($sql);
	}

	$msg = 'บันทึกข้อมูลเรียบร้อย';
	if( $save !== true ){
        $msg = errorMsg('save', $save['id']);
	}
	
	redirect('anc.php',$msg);
	exit;
}

include 'head.php';
?>
<fieldset>
	<legend>แฟ้ม : ANC</legend>
	<form action="anc.php" method="post" name="formdeath1">
		<table width="50%">
			<tr>
				<td height="41">ค้นหาตาม HN : 
					<input type="text" name="chn" id="chn" />
				</td>
			</tr>
			<tr>
				<td height="37">
					<input name="ok" type="submit" value="ค้นหา" />
					<input type="hidden" name="page" value="search">
				</td>
			</tr>
		</table>
	</form>
</fieldset>
<?php 
$page = input('page');
if( $page === 'search' ){ 

	$chn = input_post('chn');

	$sql = "select * from opcard where hn='$chn'";
	$rows = mysql_query($sql);
	$result = mysql_fetch_array($rows);
	if($result['name']==""){
		echo "ไม่พบผู้ป่วย HN นี้";	
	}else{

		$sql3 = "SELECT * 
		FROM `opday` 
		WHERE `hn` = '$chn' 
		ORDER BY `thidate` 
		DESC LIMIT 200";
		$rows3 = mysql_query($sql3);

		?>
		<div>&nbsp;</div>
		<table class="chk_table">
			<tr>
				<th>HN</th>
				<th>ชื่อ-สกุล</th>
				<th>แพทย์</th>
				<th>มาเพื่อ</th>
				<th>วันที่มารับบริการ</th>
			</tr>
		<?php
		while($result3 = mysql_fetch_array($rows3)){
			$d = substr($result3['thidate'],8,2);
			$m = substr($result3['thidate'],5,2);
			$y = substr($result3['thidate'],0,4);
			$t = substr($result3['thidate'],11);
			?>
			<tr>
				<td><?=$result3['hn']?></td>
				<td><?=$result3['ptname']?></td>
				<td><?=$result3['doctor']?></td>
				<td><?=$result3['toborow']?></td>
				<td><a href="anc.php?page=form&id=<?=$result3['row_id']?>"><?="$d-$m-$y $t"?></a></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}

}elseif($page === 'form'){

	$id = input_get('id');

	$sql = "select `row_id`,`hn`,`ptname`,`thidate`,`doctor`,`vn`,`clinic` from opday where row_id = '$id' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_assoc($rows);
	
	$sql2 = "select `idcard` from opcard where hn='".$result['hn']."' ";
	$rows2 = mysql_query($sql2);
	$result2 = mysql_fetch_assoc($rows2);
	?>
	<style>
	input[readonly]{
		background-color: #bbbbbb;
	}
	
	table tr{
		vertical-align: top;
	}
    
	</style>
	<fieldset>
		<legend>แบบฟอร์มแฟ้ม ANC</legend>
		<form action="anc.php" method="post" name="formdeath2">
			<table width="100%">
				<tr>
					<td class="txtRight">HN : </td>
					<td><input name="nHn" type="text" value="<?=$result['hn']?>" readonly="readonly"></td>
				</tr>
				<tr>
					<td class="txtRight">ชื่อ : </td>
					<td><?=$result['ptname']?></td>
				</tr>
				<tr>
					<td class="txtRight">เลขที่บัตรปชช. : </td>
					<td>
						<input name="idcard" type="text" value="<?=$result2['idcard']?>" readonly="readonly"/>
					</td>
				</tr>
				<tr>
					<td class="txtRight">ลำดับที่ : </td>
					<td>
						<?php 
						$thidate = bc_to_ad($result['thidate']);
						$seq = genSEQ($thidate, $result['vn'], $result['clinic']);
						$dserv = date('Ymd', strtotime($thidate));
						?>
						<input name="seq" type="text" id="seq" value="<?=$seq?>" readonly="readonly"/>
					</td>
				</tr>
				<tr>
					<td class="txtRight">วันที่รับบริการ : </td>
					<td><input name="dserv" type="text" id="dserv" value="<?="$dserv"?>" readonly="readonly"/></td>
				</tr>
				<tr>
					<td class="txtRight">ครรภ์ที่ : </td>
					<td><input type="text" name="grav" id="grav" />(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
				</tr>
				<tr>
					<td class="txtRight">ANC ช่วงที่ :</td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_anc_178`");
						$ancLists = $db->get_items();
						?>
						<select name="ancno">
							<?php
							foreach ($ancLists as $key => $value) {
								?><option value="<?=$value['code'];?>"><?=$value['detail'];?></option><?php
							}
							?>
						</select><br>
						* หมายเหตุ : กรณีอายุครรภ์ไม่อยู่ในช่วงของการฝากครรภ์ให้บันทึกเฉพาะอายุครรภ์ บันทึกช่วงครรภ์ กรณีมาตรงช่วงการนัดฝากครรภ์เท่านั้น
					</td>
				</tr>
				<tr>
					<td class="txtRight">อายุครรภ์ (สัปดาห์) : </td>
					<td><input type="text" name="ga" id="ga" />(จำนวนเต็ม)</td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจ : </td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_anc_179`");
						$hivLists = $db->get_items();
						$i = 1;
						foreach ($hivLists as $key => $list) {
							?>
							<input type="radio" name="ancres" id="ancres<?=$i;?>" value="<?=$list['code'];?>" ><label for="ancres<?=$i;?>"><?=$list['detail'];?></label>
							<?php
							$i++;
						}
						?>
						
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center">
						<input name="conbtn" type="submit" value=" บันทึกข้อมูล " />
						<input type="hidden" name="doctor" value="<?=$result['doctor'];?>">
						<input type="hidden" name="opday_id" value="<?=$result['row_id'];?>">
						<input type="hidden" name="action" value="save">
					</td>
				</tr>
			</table>
		</form>
	</fieldset>
	<?php
}
?>