<?php 
include '../bootstrap.php';
include 'libs/functions.php';

$db = Mysql::load();

$action = input_post('action');
if ( $action == 'save' ) { 

	// FORM ANC 
	$PID = $hn = $_POST['nHn'];
	$seq = $_POST['seq'];
	$date_serve = $_POST['dserv'];
	$GRAVIDA = $gravida = $_POST['grav'];
	$ancno = $_POST['ancno'];
	$ga = $_POST['ga'];
	$ancres = $_POST['ancres'];
	$cid = $_POST['idcard'];
	$doctor = $_POST['doctor'];

	$opday_id = $_POST['opday_id'];

	// FORM PRENATAL
	$forcePrenatal = input_post('forcePrenatal');
	$PROVIDER = input_post('PROVIDER'); 

	$HOSPCODE = input_post('HOSPCODE');
    $LMP = input_post('LMP');
    $LMP = bc_to_ad($LMP);
    $LMP = str_replace('-','', $LMP);

    $EDC = input_post('EDC');
    $EDC = bc_to_ad($EDC);
    $EDC = str_replace('-','', $EDC);

    $VDRL_RESULT = input_post('VDRL_RESULT');
    $HB_RESULT = input_post('HB_RESULT');
    $HIV_RESULT = input_post('HIV_RESULT');

    $DATE_HCT = input_post('DATE_HCT');
    $DATE_HCT = bc_to_ad($DATE_HCT);
    $DATE_HCT = str_replace('-','', $DATE_HCT);

    $HCT_RESULT = input_post('HCT_RESULT');
    $THALASSAEMIA = input_post('THALASSAEMIA');
    $D_UPDATE = $d_update = input_post('D_UPDATE');
    $CID = input_post('CID');

	$opday_id = input_post('opday_id');
	
	$anc_id = input_post('anc_id');
	$prenatal_id = input_post('prenatal_id');

	$q = mysql_query("SELECT * FROM `anc` WHERE `pid` = '$hn' and `seq` = '$seq' ") or die(mysql_error());
	$test_row = mysql_num_rows($q);
	if( $test_row > 0 ){ 

		// update 
		$sql = "UPDATE `anc` SET `pid`='$hn', 
		`seq`='$seq', 
		`date_serv`='$date_serve', 
		`gravida`='$gravida', 
		`ancno`='$ancno', 
		`ga`='$ga', 
		`ancres`='$ancres', 
		`aplace`='11512', 
		`provider`='$PROVIDER', 
		`d_update`='$d_update', 
		`cid`='$cid', 
		`opday_id` = '$opday_id' 
		WHERE (`row_id`='$anc_id');";
		$save = $db->update($sql);

		if( $forcePrenatal !== false ){
			$sql = "UPDATE `43prenatal` SET 
			`HOSPCODE`='$HOSPCODE', 
			`PID`='$PID', 
			`GRAVIDA`='$GRAVIDA', 
			`LMP`='$LMP', 
			`EDC`='$EDC', 
			`VDRL_RESULT`='$VDRL_RESULT', 
			`HB_RESULT`='$HB_RESULT', 
			`HIV_RESULT`='$HIV_RESULT', 
			`DATE_HCT`='$DATE_HCT', 
			`HCT_RESULT`='$HCT_RESULT', 
			`THALASSEMIA`='$THALASSAEMIA', 
			`D_UPDATE`='$D_UPDATE', 
			`PROVIDER`='$PROVIDER', 
			`CID`='$CID', 
			`opday_id`='$opday_id' 
			WHERE (`id`='$prenatal_id');";
			$save = $db->update($sql);

		}
		
	}else{	
		
		$sql = "INSERT INTO `anc` (
		`row_id`, `pid`, `seq`, `date_serv`, `gravida`, `ancno`, `ga`, `ancres`, `aplace`, `provider`, `d_update`, `cid` ,`opday_id` 
		) VALUES (
		NULL, '$hn', '$seq', '$date_serve', '$gravida', '$ancno', '$ga', '$ancres', '11512', '$PROVIDER', '$d_update', '$cid', '$opday_id'
		);";
		$save = $db->insert($sql); 

		if( $forcePrenatal !== false ){
		
			$sql = "INSERT INTO `43prenatal` ( 
				`id`, `HOSPCODE`, `PID`, `GRAVIDA`, `LMP`, `EDC`, 
				`VDRL_RESULT`, `HB_RESULT`, `HIV_RESULT`, `DATE_HCT`, `HCT_RESULT`, `THALASSEMIA`, 
				`D_UPDATE`,`PROVIDER`,`CID`,`opday_id` 
			) VALUES ( 
				NULL, '$HOSPCODE', '$PID', '$GRAVIDA', '$LMP', '$EDC', 
				'$VDRL_RESULT', '$HB_RESULT', '$HIV_RESULT', '$DATE_HCT', '$HCT_RESULT', '$THALASSAEMIA', 
				'$D_UPDATE','$PROVIDER','$CID', '$opday_id' 
			);";
			$save = $db->insert($sql);
		}

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
<div class="clearfix">
    <h1 style="margin:0;">ANC</h1> <span>ข้อมูลการให้บริการฝากครรภ์กับหญิงตั้งครรภ์ที่มารับบริการ</span>
</div>
<fieldset>
	<legend>แฟ้ม : ANC</legend>
	<form action="anc.php" method="post" name="formdeath1">
		<table width="100%">
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

	$sql = "SELECT * FROM `opcard` WHERE `hn` = '$chn'";
	$rows = mysql_query($sql);
	$result = mysql_fetch_assoc($rows);
	if($result['name']==""){
		echo "ไม่พบผู้ป่วย HN นี้";	
	}else{

		$sql3 = "SELECT a.`row_id`,a.`hn`, a.`ptname`, a.`doctor`, a.`toborow`, a.`thidate`, b.`row_id` AS `anc_id` 
		FROM `opday` AS a 
		LEFT JOIN `anc` AS b ON b.`opday_id` = a.`row_id` 
		WHERE a.`hn` = '$chn' 
		ORDER BY a.`thidate` 
		DESC LIMIT 100";
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
		while($result3 = mysql_fetch_assoc($rows3)){  

			$title = $color = '';
			if ( $result3['anc_id'] ) { 
				$color = 'style="background-color: #abff90;"';
				$title = 'เคยบันทึกข้อมูลแล้ว';
			}

			?>
			<tr <?=$color;?>>
				<td><?=$result3['hn']?></td>
				<td><?=$result3['ptname']?></td>
				<td><?=$result3['doctor']?></td>
				<td><?=$result3['toborow']?></td>
				<td><a href="anc.php?page=form&id=<?=$result3['row_id']?>" title="<?=$title;?>" ><?=$result3['thidate'];?></a></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}

}elseif($page === 'form'){

	$id = input_get('id');

	$sql = "SELECT `row_id`,`thdatehn`,`hn`,`ptname`,`thidate`,`doctor`,`vn`,`clinic`,`idcard` FROM `opday` WHERE `row_id` = '$id' ";
	$rows = mysql_query($sql);
	$result = mysql_fetch_assoc($rows);

	$hn = $result['hn'];
	$idcard = $result['idcard'];
	$opday_id = $result['row_id'];
	$thdatehn = $result['thdatehn'];
	
	if( empty($result['idcard']) ){
		$sql2 = "SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ";
		$rows2 = mysql_query($sql2);
		$result2 = mysql_fetch_assoc($rows2);
		$idcard = $result2['idcard'];
	}
	
	$doctorcode = false;
	if( preg_match('/MD\d+/', $result['doctor']) > 0 ){
		$prefixMd = substr($result['doctor'],0,5);

		$sql = "SELECT `doctorcode` FROM `doctor` WHERE `name` LIKE '$prefixMd%' ";
		$db->select($sql);
		$dr = $db->get_item();
		$doctorcode = $dr['doctorcode'];

	}elseif ( preg_match('/(\d+){4,5}/', $result['doctor'], $matchs) ) {
		$doctorcode = $matchs['0'];

	}

	$dr = false;
	if( $doctorcode !== false ){
		$sql = "SELECT `PROVIDER` FROM `tb_provider_9` WHERE `REGISTERNO` = '$doctorcode' ";
		$db->select($sql);
		$dr = $db->get_item();
	}

	// หา ID จาก anc+prenatal
	$db->select("SELECT * FROM `anc` WHERE `opday_id` = '$opday_id' ");
	if( $db->get_rows() > 0 ){
		$anc = $db->get_item();

		$gravida = $anc['gravida'];
		$ancno = $anc['ancno'];
		$ga = $anc['ga'];
		$ancres = $anc['ancres'];

	}
	?>
	<style>
	input[readonly]{background-color: #bbbbbb;}
	table tr, table td{vertical-align: top;}
	</style>

	<form action="anc.php" method="post" name="formdeath2">
		<fieldset>
			<legend>แบบฟอร์มแฟ้ม ANC</legend>
			<table width="100%">
				<tr>
					<td class="txtRight" width="20%">รหัสสถานบริการ : </td>
					<td><input type="text" name="HOSPCODE" value="11512" readonly></td>
				</tr>
				<tr>
					<td class="txtRight">ทะเบียนบุคคล (HN) : </td>
					<td><input name="nHn" type="text" value="<?=$result['hn'];?>" readonly="readonly"></td>
				</tr>
				<tr>
					<td class="txtRight">ชื่อ : </td>
					<td><?=$result['ptname']?></td>
				</tr>
				<tr>
					<td class="txtRight">เลขที่บัตรปชช. : </td>
					<td>
						<input name="idcard" type="text" value="<?=$idcard;?>" readonly="readonly"/>
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
					<td><input type="text" name="grav" id="grav" value="<?=$gravida;?>"/>(ไม่ใส่ 0 นำหน้าเช่น 1,2,10)</td>
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

								$selected = ( $value['code'] == $ancno ) ? 'selected="selected"' : '' ;

								?><option value="<?=$value['code'];?>" <?=$selected;?> ><?=$value['detail'];?></option><?php
							}
							?>
						</select><br>
						* หมายเหตุ : กรณีอายุครรภ์ไม่อยู่ในช่วงของการฝากครรภ์ให้บันทึกเฉพาะอายุครรภ์ บันทึกช่วงครรภ์ กรณีมาตรงช่วงการนัดฝากครรภ์เท่านั้น
					</td>
				</tr>
				<tr>
					<td class="txtRight">อายุครรภ์ (สัปดาห์) : </td>
					<td><input type="text" name="ga" id="ga" value="<?=$ga;?>"/>(จำนวนเต็ม)</td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจครรภ์ : (ณ วันที่มารับบริการ)</td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_anc_179`");
						$hivLists = $db->get_items();
						$i = 1;
						foreach ($hivLists as $key => $list) {


							$selectedGA = ( $ancres == $list['code'] ) ? 'checked="checked"' : '' ;

							?>
							<input type="radio" name="ancres" id="ancres<?=$i;?>" value="<?=$list['code'];?>" <?=$selectedGA;?>><label for="ancres<?=$i;?>"><?=$list['detail'];?></label>
							<?php
							$i++;
						}
						?>
					</td>
				</tr>
				<tr>
                    <td class="txtRight">เลขที่ผู้ให้บริการ(แพทย์ผู้ตรวจ) : </td>
                    <td>
                        <?php 
                        if( empty($dr) ){ 
                            $db->select("SELECT `PROVIDER`,`REGISTERNO`,`NAME`,`LNAME` FROM `tb_provider_9` ORDER BY `ROW_ID` ");
                            $providerLists = $db->get_items();
                            ?>
                            <select name="PROVIDER" id="">
                                <option value="">กรุณาเลือกผู้ให้บริการ</option>
                                <?php 
                                foreach ($providerLists as $key => $pv) {
                                    
                                    $dr_no = '';
                                    if( $pv['REGISTERNO'] ){
                                        $dr_no = ' ('.$pv['REGISTERNO'].')';
                                    }

									$selected_default = ($pv['PROVIDER'] == '11512382120101') ? 'selected="selected"' : '' ;
                                
									?>
									<option value="<?=$pv['PROVIDER'];?>" <?=$selected_default;?> ><?=$pv['NAME'].' '.$pv['LNAME'].$dr_no;?></option>
									<?php
                                }
                                ?>
                            </select>
                            <?php
                        }else{
                            ?>
                            <input type="text" name="PROVIDER" value="<?=$dr['PROVIDER'];?>" readonly>
                            <?php
                        }
                        ?>
                    </td>
                </tr>
			</table>
		</fieldset>
		
		<?php 
		

		// วันที่ประจำเดือนครั้งสุดท้ายจาก OPD
		$db->select("SELECT `mens`,`mens_date` FROM `opd` WHERE `thdatehn` = '$thdatehn' ");
		$mens = $db->get_item();
		$mensId = $mens['mens'];
		$mensList = array(1 => 'ยังไม่มีประจำเดือน','หมดประจำเดือน','ยังมีประจำเดือน');

		if( $mensList[$mensId] ){
			$lmpNoti = $mensList[$mensId];
		}

		$LMP = '';
		if( $mens['mens_date'] != '0000-00-00' ){
			$LMP = ad_to_bc($mens['mens_date']);
		}

		// หา ID จาก anc+prenatal
		$db->select("SELECT * FROM `43prenatal` WHERE `opday_id` = '$opday_id'");
		$prenatal = false;
		if( $db->get_rows() > 0 ){
			$prenatal = $db->get_item();
			
			$VDRL_RESULT = $prenatal['VDRL_RESULT'];
			$HB_RESULT = $prenatal['HB_RESULT'];
			$HIV_RESULT = $prenatal['HIV_RESULT'];
			$HCT_RESULT = $prenatal['HCT_RESULT'];
			$THALASSEMIA = $prenatal['THALASSEMIA'];

			$DATE_HCT = substr($prenatal['DATE_HCT'],0,4).'-'.substr($prenatal['DATE_HCT'],4,2).'-'.substr($prenatal['DATE_HCT'],6,2);
			$DATE_HCT = ad_to_bc($DATE_HCT);

			$EDC = substr($prenatal['EDC'],0,4).'-'.substr($prenatal['EDC'],4,2).'-'.substr($prenatal['EDC'],6,2);
			$EDC = ad_to_bc($EDC);
			
		}
		?>
		<fieldset>
			<legend>ฟอร์มบันทึก PRENATAL</legend>
			<table width="100%">
				<tr>
					<td></td>
					<td>
						<input type="checkbox" name="forcePrenatal" id="forcePrenatal" value="1"> <label for="forcePrenatal">บังคับส่งออกข้อมูล Prenatal</label>
					</td>
				</tr>
				<tr>
					<td class="txtRight" width="20%">วันแรกของการมีประจำเดือนครั้งสุดท้าย : </td>
					<td><input type="text" name="LMP" id="LMP" value="<?=$LMP;?>"><?=$lmpNoti;?></td>
				</tr>
				<tr>
					<td class="txtRight">วันที่กำหนดคลอด : </td>
					<td><input type="text" name="EDC" id="EDC" value="<?=$EDC;?>"></td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจ VDRL_RS : </td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_prenatal_174`");
						$vdrlLists = $db->get_items();
						$i = 1;
						foreach ($vdrlLists as $key => $item) {

							$checkedVDRL = ( $VDRL_RESULT == $item['code'] ) ? 'checked="checked"' : '' ;

							?>
							<input type="radio" name="VDRL_RESULT" id="vdrl<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedVDRL;?> ><label for="vdrl<?=$i;?>"><?=$item['detail'];?></label>
							<?php
							$i++;
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจ HB_RS : </td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_prenatal_174`");
						$hbLists = $db->get_items();
						$i = 1;
						foreach ($hbLists as $key => $item) { 

							$checkedHB = ( $HB_RESULT == $item['code'] ) ? 'checked="checked"' : '' ;

							?>
							<input type="radio" name="HB_RESULT" id="hb<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedHB;?> ><label for="hb<?=$i;?>"><?=$item['detail'];?></label>
							<?php
							$i++;
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจ HIV_RS : </td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_prenatal_176`");
						$hivLists = $db->get_items();
						$i = 1;
						foreach ($hivLists as $key => $item) { 

							$checkedHIV = ( $HIV_RESULT == $item['code'] ) ? 'checked="checked"' : '' ;

							?>
							<input type="radio" name="HIV_RESULT" id="hiv<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedHIV;?> ><label for="hiv<?=$i;?>"><?=$item['detail'];?></label>
							<?php
							$i++;
						}
						?>
					</td>
				</tr>
				<tr>
					<td class="txtRight">วันที่ตรวจ HCT : </td>
					<td><input type="text" name="DATE_HCT" id="DATE_HCT" value="<?=$DATE_HCT;?>"></td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจ HCT : </td>
					<td><input type="text" name="HCT_RESULT" id="HCT_RESULT" value="<?=$HCT_RESULT;?>">(ระดับฮีมาโตคริค (%) ระบุเป็นตัวเลขไม่เกิน 2 หลัก)</td>
				</tr>
				<tr>
					<td class="txtRight">ผลการตรวจ THALASSAEMIA : </td>
					<td>
						<?php 
						$db->select("SELECT * FROM `f43_prenatal_176`");
						$hctLists = $db->get_items();
						$i = 1;
						foreach ($hctLists as $key => $item) { 

							$checkedTHA = ( $THALASSEMIA == $item['code'] ) ? 'checked="checked"' : '' ;

							?>
							<input type="radio" name="THALASSAEMIA" id="hct<?=$i;?>" value="<?=$item['code'];?>" <?=$checkedTHA;?> ><label for="hct<?=$i;?>"><?=$item['detail'];?></label>
							<?php
							$i++;
						}
						?>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="text-align: center;">
						
						<input name="conbtn" type="submit" value=" บันทึกข้อมูล " />
						<input type="hidden" name="action" value="save">

						<input type="hidden" name="CID" value="<?=$idcard;?>">
						
						<input type="hidden" name="D_UPDATE" value="<?=date('YmdHis');?>">
						<input type="hidden" name="opday_id" value="<?=$opday_id;?>">

						<input type="hidden" name="anc_id" value="<?=$anc['row_id'];?>">
						<input type="hidden" name="prenatal_id" value="<?=$prenatal['id'];?>">

					</td>
				</tr>
			</table>
		</fieldset>
		
		<script type="text/javascript">
			var popup1, popup2, popup3;
			window.onload = function() {
				popup1 = new Epoch('popup1','popup',document.getElementById('LMP'),false);
				popup2 = new Epoch('popup2','popup',document.getElementById('EDC'),false);
				popup3 = new Epoch('popup2','popup',document.getElementById('DATE_HCT'),false);
			};
		</script>

	</form>

	<br><br><br><br><br><br><br><br>
	<?php
}
?>