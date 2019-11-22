<?php 
include 'bootstrap.php';
$db = Mysql::load();
$id = input_post('id');
$part = input_post('part');

$action = input_post('action');
if ( $action === 'save' ) {
	
	if( $part !== 'foot' AND $part !== 'retinal' AND $part !== 'tooth' ){
		echo 'Invalid input';
		exit;
	}

	$part = input_post('part');
	$id = input_post('id');
	$result = input_post('result');
	$date = input_post('date');
	$dateName = $part.'_date';

	$date_n = input_post('date_n');
	$hn = input_post('hn');

	// คืนปีกลับไปเป็น พ.ศ.
	if( $date !== false ){
		$date = ad_to_bc($date);
	}elseif ($date === false) {
		$date = '0000-00-00';
	}

	// ถ้ามีข้อมูลในตัวหลักให้อัพเดทด้วย
	$db->select("SELECT `row_id` FROM `diabetes_clinic` WHERE `hn` = '$hn' AND `dateN` = '$date_n' ");
	if ($db->get_rows() > 0) {
		$dc = $db->get_item();
		$main_id = $dc['row_id'];
		$sql_dc = "UPDATE `diabetes_clinic` SET `$part` = :result, `$dateName` = :datePart WHERE `row_id` = :main_id ";
		$save_dc = $db->update($sql_dc, array(':result' => $result, ':datePart' => $date, ':main_id' => $main_id));
	}

	$sql = "UPDATE `diabetes_clinic_history` SET `$part` = :result, `$dateName` = :datePart WHERE `row_id` = :id ";
	$save = $db->update($sql, array(':result' => $result, ':datePart' => $date, ':id' => $id));
	$resTxt = 'true';
	$msg = "บันทึกข้อมูลเรียบร้อย";
	if( $save !== true ){
		$resTxt = 'false';
		$msg = errorMsg('save', $save['id']);
	}
	
	echo '{"resTxt":'.$resTxt.',"msg":"'.$msg.'"}';
	exit;
	
}
?>
<style>
label{
	cursor: pointer;
}
#formEditResponse{
	border: 2px solid #868800;
    background-color: #ffff92;
    padding: 2px;
}
</style>
<form action="" id="formEditDiabetes" method="post">
	<?php 
	$sql = "SELECT `row_id`,`hn`,`dateN`,`foot`,`retinal`,`tooth`,SUBSTRING(`foot_date`,1,10) AS `foot_date`,
	SUBSTRING(`retinal_date`,1,10) AS`retinal_date`,
	SUBSTRING(`tooth_date`,1,10) AS`tooth_date` 
	FROM `diabetes_clinic_history` 
	WHERE `row_id` = '$id'"; 
	$db->select($sql);
	$item = $db->get_item($sql);

	$dateN = $item['dateN'];
	$hn = $item['hn'];

    if( $part == 'foot' ){ 
		$lists = array('Low Risk','Moderate Risk','Hight Risk');
        ?>
        <div>
			<div>แก้ไขข้อมูล Foot Exam: </div>
			<?php 
			foreach ($lists as $key => $list) {
				$selected = ( $list == $item['foot'] ) ? 'checked="checked"' : '' ;
				?>
				<label><input type="radio" class="itemEditForm" name="foot" value="<?=$list;?>" <?=$selected;?>><?=$list;?></label> 
				<?php
			}

			// วันที่ในปฏิทินมันรับผลเป็นปี ค.ศ. เลยต้องปรับปี
			?>
			<div>วันที่วินิจฉัย:</div>
			<div><input type="text" id="foot_date" name="foot_date" class="itemDateForm" value="<?=($item['foot_date']!=='0000-00-00' ? bc_to_ad($item['foot_date']) : '' );?>"></div>
        </div>
        <?php
    }elseif( $part == 'retinal' ){
		$lists = array('No DR','Mind DR','Moderate DR','Severe DR');
        ?>
        <div>
			<div>แก้ไขข้อมูล Retinal Exam: </div>
			<div>
            <?php 
			foreach ($lists as $key => $list) {
				$selected = ( $list == $item['retinal'] ) ? 'checked="checked"' : '' ;
				?>
				<label><input type="radio" class="itemEditForm" id="retinal" name="retinal" value="<?=$list;?>" <?=$selected;?>><?=$list;?></label> 
				<?php
			}
			?>
			</div>
			<div>วันที่วินิจฉัย:</div>
			<div><input type="text" id="retinal_date" name="retinal_date" class="itemDateForm" value="<?=($item['retinal_date']!=='0000-00-00' ? bc_to_ad($item['retinal_date']) : '');?>"></div>
        </div>
        <?php
    }elseif( $part == 'tooth' ){
		$lists = array(0 => 'ไม่ได้รับการตรวจ', 1 => 'ได้รับการตรวจ');
        ?>
        <div>
			<div>แก้ไขข้อมูล ตรวจสุขภาพฟัน: </div>
			<div>
			<?php 
			foreach ($lists as $key => $list) {
				$selected = '';
				if( $item['tooth'] != '' ){
					$selected = ( $key == $item['tooth'] ) ? 'checked="checked"' : '' ;
				}
				?>
				<label><input type="radio" class="itemEditForm" name="tooth" value="<?=$key;?>" <?=$selected;?>><?=$list;?></label> 
				<?php
			}
			?>
			</div>
			<div>วันที่วินิจฉัย:</div>
			<div><input type="text" id="tooth_date" name="tooth_date" class="itemDateForm" value="<?=($item['tooth_date']!='0000-00-00' ? bc_to_ad($item['tooth_date']) : '' );?>"></div>
        </div>
        <?php
    }
    ?>
    <div style="margin-top:4px;">
        <button type="submit" id="btnSaveEditForm">บันทึกข้อมูล</button>
        <input type="hidden" name="editFormPart" id="editFormPart" value="<?=$part;?>">
        <input type="hidden" name="editFormId" id="editFormId" value="<?=$id;?>">
		<input type="hidden" name="editFormDateN" id="editFormDateN" value="<?=$dateN;?>">
		<input type="hidden" name="editFormHn" id="editFormHn" value="<?=$hn;?>">
    </div>
</form>
<div id="formEditResponse" style="display: none;"></div>

